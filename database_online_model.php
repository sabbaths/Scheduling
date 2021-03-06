<?php

class Database {
    public static $connection;
    private static $servername = "localhost";
    private static $username = "id2432317_sabbathsco"; //apgiaa godaddy.com
    private static $password = "ac2am9jlqwxl0";
    private static $database = "id2432317_sabbathsco"; //apgiaa godaddy.com
    //put your code here

    function setEnvironment($environment = 1) {
        if($environment == 1) { //dev
            self::$username == "";
        } else if ($environment == 2) { //prod

        } else { //godaddy

        }
    }
    
    function connectDB() {
        $status_code = 900; //901 connected 900 failed

        // Create connection
        $conn = new mysqli(self::$servername, self::$username, self::$password);
        $conn->select_db(self::$database);
        self::$connection = $conn;
        // Check connection
        if ($conn->connect_error) {
            $status_code = 901;
            die("Connection failed: " . $conn->connect_error);
        }
        return $status_code;
    }

    function getSchedules($schedule_date) {
        $schedule_date_arr = array();
        $ac_arr = array();

        $sql = "SELECT s.slot_time, s.slot_id, st.*
                FROM wcc_scheduling.schedule_test st
                RIGHT JOIN slots s ON st.slot = s.slot_id 
                    AND st.date = '" . $schedule_date . "' ORDER BY s.slot_id";

        $sql_get_not_active_ac = "
            SELECT registration
            FROM aircraft
            WHERE is_active = 0";

        $result = self::$connection->query($sql);   
        $result_ac = self::$connection->query($sql_get_not_active_ac);   

        
        if ($result_ac->num_rows > 0) {
            while($row = $result_ac->fetch_assoc()) {
                array_push($ac_arr ,$row['registration']);
            }  
        }
        //print_r($ac_arr);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $temp_array = array($row);
                foreach($row as $row_columns_key => $col_val) {
                    if (in_array($row_columns_key, $ac_arr)) {
                        unset($row[$row_columns_key]);
                    }
                }
                array_push($schedule_date_arr ,$row);
            }  
        }
        //print_r($schedule_date_arr);
        
        return $schedule_date_arr;       
    }

    function aircraftHandler($mode, $aircraft_id, $is_active, $registration, $bew, $moment) {

        if($mode == 'edit') {
            $sql_update_aircraft = "
                UPDATE aircraft
                SET is_active = $is_active
                WHERE aircraft_id = $aircraft_id";

                
                if (self::$connection->query($sql_update_aircraft) === TRUE) {
                    return 7001; //good
                } else {
                    return 7002; //bad
                }             
        } else if ($mode == 'add') {
            $sql_insert = "INSERT INTO aircraft(REGISTRATION, IS_ACTIVE, BEW, MOMENT
                ) VALUES ('$registration', 1, '$bew', '$moment')";

            //echo $sql_insert;
            if (self::$connection->query($sql_insert) === TRUE) {
                $sql_add_ac_column = "ALTER TABLE schedule_test ADD `$registration` VARCHAR(45)";
                echo $sql_add_ac_column;
                if(self::$connection->query($sql_add_ac_column) == TRUE) {
                    return 7006;    
                } else {
                    return 7007;
                }
            } else {
                return 7005; //bad
            }             
        }
    }

    function studentHandler($mode, $is_active, $first_name, $middle_name, $last_name) {

        if($mode == 'edit') {          
        } else if ($mode == 'add') {
            $sql_insert = "INSERT INTO students(first_name, middle_name, last_name) VALUES ('$first_name', '$middle_name', '$last_name')";

            //echo $sql_insert;
            if (self::$connection->query($sql_insert) === TRUE) {
                return 8001;
            } else {
                return 8002;
            }             
        }

    }

    function instructorHandler($mode, $is_active, $first_name, $middle_name, $last_name) {
        
        if($mode == 'edit') {  
            //           
        } else if ($mode == 'add') {
            $sql_insert = "INSERT INTO instructors(first_name, middle_name, last_name) VALUES ('$first_name', '$middle_name', '$last_name')";

            //echo $sql_insert;
            if (self::$connection->query($sql_insert) === TRUE) {
                return 9001;
            } else {
                return 9002;
            }             
        }

    }

    function createEditSchedule($slot_id, $instructor_id, $student_id, $aircrat_id, $date_flight, $purpose_id) {
        $sql_insert_schedule_details = " INSERT INTO schedule_test_ins 
                (instructor, student, purpose) 
                VALUES ( 
                '".$instructor_id."', 
                '".$student_id."',
                '".$purpose_id."')";

        $sql_check_schedule = "SELECT * FROM schedule_test WHERE slot = $slot_id
                AND date = '$date_flight'";
        
        echo $sql_check_schedule;
        if (self::$connection->query($sql_insert_schedule_details) === TRUE) {
            $inserted_sched_detail_id = mysqli_insert_id(self::$connection);

            //check if there is a schedule
            $result = self::$connection->query($sql_check_schedule); 

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $schedule_id = $row['schedule_id'];
                $sql_update_schedule = "
                    UPDATE schedule_test 
                    SET `$aircrat_id`= $inserted_sched_detail_id
                    WHERE date = '$date_flight'
                        AND schedule_id = $schedule_id";
                if (self::$connection->query($sql_update_schedule) === TRUE) {
                    return 5012; //good
                } else {
                    return 5042;
                } 
            } else {
                $sql_insert_schedule = " 
                    INSERT INTO schedule_test
                    (date, slot, `$aircrat_id`) 
                    VALUES ( 
                    '".$date_flight."', 
                    '".$slot_id."',
                    '".$inserted_sched_detail_id."')";
                echo $sql_insert_schedule;

                if (self::$connection->query($sql_insert_schedule) === TRUE) {
                    return 5011; //good
                } else {
                    return 5044;
                } 
            }
        } else {   
            return 5004; //error
        }    
    }

    function cancelFlightSchedule($slot_id, $instructor_id, $student_id, $aircrat_id, $date_flight, $purpose_id) {

        $sql_check_schedule = "SELECT * FROM schedule_test WHERE slot = $slot_id
                AND date = '$date_flight'
                AND `$aircrat_id` IS NOT NULL";
        
        //echo $sql_check_schedule;
        //check if there is a schedule
        
        $result = self::$connection->query($sql_check_schedule);//check if there is a schedule 
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $schedule_id = $row['schedule_id'];
            $sql_update_schedule = "
                UPDATE schedule_test 
                SET `$aircrat_id`= 'CANCELLED'
                WHERE date = '$date_flight'
                    AND schedule_id = $schedule_id";
            //return $sql_update_schedule;       
            if (self::$connection->query($sql_update_schedule) === TRUE) {
                return 6012; //good
            } else {
                return 6042;
            }
        } else {
            return 6013;
        }
    }

    function getStudents() {
        $students_arr = array();
        $sql = "SELECT student_id, first_name, middle_name, last_name FROM students;";
        $result = self::$connection->query($sql);   

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $student_id = $row["student_id"];
                $first_name = $row["first_name"];
                $middle_name = $row["middle_name"];
                $last_name = $row["last_name"];
                $temp_array = array($student_id, $first_name, $middle_name, $last_name);
                array_push($students_arr ,$temp_array);
            }  
        }
        //print_r($courses_arr);
        
        return $students_arr;       
    }

    function getPurpose() {
        $purpose_arr = array();
        $sql = "SELECT * FROM flight_purpose;";
        $result = self::$connection->query($sql);   

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $purpose_id = $row["purpose_id"];
                $purpose = $row["purpose"];
                $temp_array = array($purpose_id, $purpose);
                array_push($purpose_arr ,$temp_array);
            }  
        }
        
        return $purpose_arr;       
    }

    function getInstructors() {
        $students_arr = array();
        $sql = "SELECT id, first_name, middle_name, last_name FROM instructors;";
        $result = self::$connection->query($sql);   

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $first_name = $row["first_name"];
                $middle_name = $row["middle_name"];
                $last_name = $row["last_name"];
                $temp_array = array($id, $first_name, $middle_name, $last_name);
                array_push($students_arr ,$temp_array);
            }  
        }
        //print_r($courses_arr);
        
        return $students_arr;       
    }

    function getSlots() {
        $students_arr = array();
        $sql = "SELECT * FROM slots;";
        $result = self::$connection->query($sql);   

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $slot_id = $row["slot_id"];
                $slot_time = $row["slot_time"];
                $temp_array = array($slot_id, $slot_time);
                array_push($students_arr ,$temp_array);
            }  
        }
        //print_r($courses_arr);
        
        return $students_arr;       
    }

    function getAircrafts() {
        $students_arr = array();
        $sql = "SELECT * FROM aircraft;";
        $result = self::$connection->query($sql);   

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $aircraft_id = $row["aircraft_id"];
                $registration = $row["registration"];
                $is_active = $row["is_active"];
                $bew = $row["bew"];
                $temp_array = array($aircraft_id, $registration, $is_active, $bew);
                array_push($students_arr ,$temp_array);
            }  
        }
        //print_r($courses_arr);
        
        return $students_arr;       
    }

    function getScheduleDetails($schedule_detail_id) {
        $sql = "
            SELECT 
                CONCAT(i.first_name, ' ',i.last_name) AS instructor, 
                CONCAT(s.first_name, ' ',s.last_name) AS student, 
                p.purpose, p.purpose_id as purpose_id, s.student_id as student_id, i.id as instructor_id
            FROM wcc_scheduling.schedule_test_ins sti
            INNER JOIN instructors i ON i.id = sti.instructor
            INNER JOIN students s ON s. student_id =  sti.student
            INNER JOIN flight_purpose p ON p.purpose_id = sti.purpose
            WHERE sti.id = $schedule_detail_id";
        
        $result = self::$connection->query($sql);  
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return "";
        }

       }
    
    function login($username, $password) {
        //103 does not exist 102 incorrect pw 101 all good
        $status_code = 103;
        $is_account_exists = false;
        $user = array();
        
        try {
            $sql = "SELECT COUNT(*) as is_account_exists FROM users WHERE username = '" . $username . "' and is_active = 1 ";
            $result = self::$connection->query($sql);
            
            if ($result->num_rows > 0) {
                $is_account_exists = false;
                while($row = $result->fetch_assoc()) {
                    $firstRow = $row["is_account_exists"];
                    if($firstRow == 1) {
                       $is_account_exists = true;
                    }
                } 
            }
            
            if($is_account_exists) {
                $is_correct_un_pw = false;
                $sql = "SELECT count(*) as is_correct_un_pw FROM users WHERE username = '" .
                        $username . "' and password = '" . $password . "' and is_active = 1 ";   
                $result = self::$connection->query($sql);

                if ($result->num_rows > 0) {
                    $status_code = 102;

                    while($row = $result->fetch_assoc()) {
                        $firstRow = $row["is_correct_un_pw"];
                        if($firstRow == 1) {
                           $status_code = 101;

                            $sql = "SELECT *  FROM users WHERE username = '" .
                                $username . "' and password = '" . $password . "' and is_active = 1 ";   
                            $result_user = self::$connection->query($sql); 

                            while($row_user = $result_user->fetch_assoc()) {
                                $user_id = $row_user["user_id"];
                                $user = $row_user;
                            }
                        }
                    }
                } else {
                    $status_code = 102;
                }
                
            }
        } catch (Exception $ex) {
            echo $ex;
        }

        return [$status_code, $user];
    }
    
    function getStudentList() {
        
    }
    
    function getStudentsOld() {
        $students_arr = array();
        $sql = "SELECT student_id, first_name, middle_name, last_name FROM students;";
        $result = self::$connection->query($sql);   

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $student_id = $row["student_id"];
                $first_name = $row["first_name"];
                $middle_name = $row["middle_name"];
                $last_name = $row["last_name"];
                $temp_array = array($student_id, $first_name, $middle_name, $last_name);
                array_push($students_arr ,$temp_array);
            }  
        }
        //print_r($courses_arr);
        
        return $students_arr;       
    }
    


    function register($username, $password, $first_name, $middle_name, $last_name) {
        $sql_insert_question = " INSERT INTO users 
                (username, password, first_name, middle_name, last_name) 
                VALUES ( 
                '".$username."', 
                '".$password."',
                '".$first_name."',
                '".$middle_name."',
                '".$last_name."')";

        $sql_check_user = "SELECT * FROM users WHERE username = '$username'";
        $result_check_user = self::$connection->query($sql_check_user); 

        if ($result_check_user->num_rows > 0) { 
            return 5002;
        }


        if (self::$connection->query($sql_insert_question) === TRUE) {
            return 5001; //good
        } else {   
            return 5004; //error
        }
    }

    function addStudent($first_name, $middle_name, $last_name, $id = "") {
        $sql_insert_student = !$id ? " INSERT INTO students 
                (first_name, middle_name, last_name) 
                VALUES ( 
                '".$first_name."',
                '".$middle_name."',
                '".$last_name."')" :
                "UPDATE students
                 SET first_name = '".$first_name."',
                 middle_name = '".$middle_name."',
                 last_name = '".$last_name."'
                 WHERE student_id = $id ";

        if (self::$connection->query($sql_insert_student) === TRUE) {
            return 7001; //good
        } else {   
            echo self::$connection->error;
            return 7004; //error
        }
    }
}
