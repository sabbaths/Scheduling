<?php

class Database {
    public static $connection;
    private static $servername = "127.0.0.1";
    private static $username = "root"; //apgiaa godaddy.com
    private static $password = "password";
    private static $database = "wcc_scheduling"; //apgiaa godaddy.com
//put your code here
    function brk() {
        echo "</br>";
    }

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
        //echo "DATABASE: Connected successfully";
        return $status_code;
    }

    function getSchedules($schedule_date) {
        $schedule_date_arr = array();
        $sql = "SELECT s.slot_time, st.*
                FROM wcc_scheduling.schedule_test st
                RIGHT JOIN slots s ON st.slot = s.slot_id 
                    AND st.date = '" . $schedule_date . "'";

        $result = self::$connection->query($sql);   

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $temp_array = array($row);
                array_push($schedule_date_arr ,$row);
            }  
        } else {
            echo "wala";
        }
        //print_r($courses_arr);
        
        return $schedule_date_arr;       
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
                $temp_array = array($aircraft_id, $registration);
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
                p.purpose
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
    
    function getCourses() {
        $courses_arr = array();
        $sql = "SELECT course_id, course_code, course_name FROM course;";
        $result = self::$connection->query($sql);   

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $course_id = $row["course_id"];
                $course_name = $row["course_code"];
                $course_code = $row["course_name"];
                $temp_array = array($course_id, $course_code, $course_name);
                array_push($courses_arr ,$temp_array);
            }  
        }
        //print_r($courses_arr);
        
        return $courses_arr;
    }
    
    function getSubjects($course_id = "") {
        $subj_arr = array();
        $where = !empty($course_id) ? "WHERE course_id = $course_id " : "";
        $sql = "SELECT subject_id, subject_code, subject_name, time_limit FROM subjects $where ;";
        $result = self::$connection->query($sql);   

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $subj_id = $row["subject_id"];
                $subject_code = $row["subject_code"];
                $subj_name = $row["subject_name"];
                $subj_time_limit = $row["time_limit"];
                $temp_array = array($subj_id, $subject_code, $subj_name, $subj_time_limit);
                array_push($subj_arr ,$temp_array);
            }  
        }
        //print_r($courses_arr);
        
        return $subj_arr;       
    }
    
    function getGI() {
        $instructors_arr = array();
        $sql = "SELECT id, IFNULL(first_name, '') as first_name, IFNULL(middle_name, '') as middle_name, 
            IFNULL(last_name, '') as last_name FROM instructors;";
        $result = self::$connection->query($sql);   

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $first_name = $row["first_name"];
                $middle_name = $row["middle_name"];
                $last_name = $row["last_name"];
                $temp_array = array($id, $first_name, $middle_name, $last_name);
                array_push($instructors_arr ,$temp_array);
            }  
        }
        //print_r($courses_arr);
        
        return $instructors_arr;   
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
    
    function generateExam($course_id, $subject_id, $student_id, $instructor_id, $user_id = 1) {
        $sql_insert_new_exam = " INSERT INTO student_exams(student_id, examiner_id,instructor_id, course_id, subject_id)"
              . "VALUES($student_id, $user_id, $instructor_id, $course_id, $subject_id)";
       
       $sql_question_count = "
            SELECT COUNT(*) number_of_questions
            FROM questions 
            WHERE subject_id = $subject_id "; 

         $result_question_count =  self::$connection->query($sql_question_count);
         $how_many_questions = $result_question_count->fetch_array()[0]; 
         
        if($how_many_questions < 30) {
            return ["status_code" => 3003]; //no questions available
        }       

        $sql_is_still_doing_exam = "
            SELECT student_exam_id
            FROM student_exams
            WHERE subject_id = $subject_id
                AND is_done = 0
                AND student_id = $student_id ";

        //check if still doing exam
        
        $result_is_still_doing_exam = self::$connection->query($sql_is_still_doing_exam);

        if ($result_is_still_doing_exam->num_rows > 0) {
            $student_exam_id;
            while($row = $result_is_still_doing_exam->fetch_assoc()) {
                $student_exam_id = $row["student_exam_id"];
            }
            return ["status_code" => 3002, "student_exam_id" => $student_exam_id];  
        }

        //then insert new exam
        
        if (self::$connection->query($sql_insert_new_exam) === TRUE) {
            //echo "New record created successfully";
            return ["status_code" => 3001, "student_exam_id" => mysqli_insert_id(self::$connection)];
        } else {
            echo "Error: " . $sql . "<br>" . self::$connection->error;
        } 
    }
    
    function updateExamQuestion($exam_id, $is_correct = 0) {
        $sql = "UPDATE exam_questions
                SET is_done = 1, is_correct = $is_correct
                WHERE exam_id = $exam_id";
        
        if (self::$connection->query($sql) === TRUE) {
            return 5001;
        } else {
            return 5002;
        }
    }
    
    function getNextQuestion($student_exam_id = 1) {
        $sql = "SELECT 
                    eq.exam_id, q.question_id, 
                    q.question, q.choice_1, 
                    q.choice_2, q.choice_3, 
                    q.choice_4, q.answer, q.answer_letter
                FROM exam_questions eq
                LEFT JOIN questions q ON eq.question_id = q.question_id
                WHERE student_exam_id = $student_exam_id
                    AND eq.is_done = 0
                ORDER BY RAND()
                LIMIT 1;";

    

        $result = self::$connection->query($sql);   
        $instructors_arr = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $exam_id = $row["exam_id"];
                $question_id = $row["question_id"];
                $question = $row["question"];
                $choice_1 = $row["choice_1"];
                $choice_2 = $row["choice_2"];
                $choice_3 = $row["choice_3"];
                $choice_4 = $row["choice_4"];
                $answer_letter = $row["answer_letter"];
                $answer = $row["answer"];
                $instructors_arr = array($exam_id, $question_id, 
                    $question, $choice_1, $choice_2, $choice_3,
                    $choice_4, $answer_letter, $answer);
                //array_push($instructors_arr ,$temp_array);
            }

            //get question number
            $sql_count = "
                SELECT 
                    COUNT(*) as question_number
                FROM exam_questions eq
                LEFT JOIN questions q ON eq.question_id = q.question_id
                WHERE student_exam_id = $student_exam_id
                    AND eq.is_done = 1;";    

            $result_count = self::$connection->query($sql_count);   
     
            if ($result_count->num_rows > 0) {
                while($row = $result_count->fetch_assoc()) {
                    $question_number = $row["question_number"];
                    array_push($instructors_arr ,$question_number);
                }  
            }  
        } else {
            $sql_finish_exam = "
            UPDATE student_exams
            SET is_done = 1
            WHERE student_exam_id = $student_exam_id";

            if (self::$connection->query($sql_finish_exam) === TRUE) {
            } else {
            }
        }

        //print_r($instructors_arr);
        $arr = array_map('utf8_encode', $instructors_arr);
        return $arr;
    }

    function getExamScore($student_exam_id) {
        $sql_correct = "
            SELECT COUNT(*) correct_answers_count, max(date_time) as date_time
            FROM exam_questions
            WHERE student_exam_id = $student_exam_id
                AND is_correct = 1";
             
        $sql_all ="        
            SELECT COUNT(*) all_answers_count, max(date_time) as date_time
            FROM exam_questions
            WHERE student_exam_id = $student_exam_id";

        $result_correct = mysqli_query(self::$connection, $sql_correct);
        $row_correct = mysqli_fetch_assoc($result_correct);

        $result_all = mysqli_query(self::$connection, $sql_all);
        $row_all = mysqli_fetch_assoc($result_all);

        
        return ["correct" => $row_correct['correct_answers_count'], 
            "all" => $row_all['all_answers_count'], 
            "date_time" => !is_null($row_correct['date_time']) ? $row_correct['date_time'] : $row_all['date_time'] ];
    }

    function getAllQuestions($subject_id = 1) {
        $question_array = array();
        $where = $subject_id == 0 ? "" : "WHERE subject_id = $subject_id";
        $sql = "
            SELECT * 
            FROM questions
            $where
        ";

        $result = self::$connection->query($sql);

        while($row = $result->fetch_assoc()) {
            array_push($question_array , $row);
        }

        return $question_array;
    }

    function addSubjectQuestion($subject_id, 
        $question, $choice_1,
        $choice_2, $choice_3, $choice_4, $answer_letter, $is_active = 0) {
        $sql_insert_question = " INSERT INTO questions 
                (subject_id, question, choice_1, 
                choice_2, choice_3, 
                choice_4, answer_letter, 
                is_active) 
                VALUES ($subject_id, 
                '".$question."', 
                '".$choice_1."',
                '".$choice_2."',
                '".$choice_3."',
                '".$choice_4."',
                '".$answer_letter."',
                $is_active)";

        if (self::$connection->query($sql_insert_question) === TRUE) {
            //echo "New record created successfully";
            return mysqli_insert_id(self::$connection);
        } else {
            echo "Error: " . $sql_insert_question . "<br>" . self::$connection->error;
        }
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
