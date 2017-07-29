<?php

class Controller {
	function generateScheduleTable($schedule_date) {
		echo "<div class='w3-container w3-border'><h2>SCHEDULE DATE: " . $schedule_date . "</h2></div>";
		echo "<header class='w3-container w3-padding-32 w3-center w3-white' id='home'>";

		$database = new Database();
		$database->connectDB();
		$schedules =  $database->getSchedules($schedule_date);
		$schedules_hdg = $schedules[0];
		echo "<div class='w3-responsive'>";
		echo "<table id=testtable class='w3-table-all w3-centered w3-border w3-small'>";
		echo "<tr class='w3-border'>";
		foreach($schedules_hdg as $key => $value) {
				echo "<th class='w3-border'>";
				
				if($key === "slot_time") {
					echo "SLOT";
				} else {
					echo $key;
				}
				echo "</th>";
		}
		echo "</tr>";

		foreach($schedules as $schedule) {
			
			echo "<tr>";
			
			foreach($schedule as $sched_key => $sched_value) {
				$date_row = $schedule['date'];
				$slot_row = $schedule['slot_time'];
				echo "<td class='w3-border'>";
				if($sched_value == NULL) {
					echo "None";
					echo "<p><button onclick=openEditModal('" 
						.$sched_key.
						"','"
						.$schedule_date.
						"','"
						.$slot_row
						."') class=\"w3-button w3-blue w3-small\">EDIT SCHEDULE</button></p>";
					//echo "<p><button onclick=\"document.getElementById('id01').style.display='block'\" class=\"w3-button w3-blue w3-small\">EDIT</button></p>";
				} else if (ctype_digit($sched_value))  {
					$schedule_detail = $database->getScheduleDetails($sched_value);
					echo "<p>" . "CAPT. " . $schedule_detail['instructor'] . "</p>";
					echo "<p>" . "STUDENT: " . $schedule_detail['student'] . "</p>";
					echo "<p>" . "PURPOSE: " .$schedule_detail['purpose'] . "</p>";
					echo "<p><button onclick=openEditModal() class=\"w3-button w3-blue w3-small\">EDIT SCHEDULE</button></p>";
					//echo "<p><button onclick=\"document.getElementById('id01').style.display='block'\" class=\"w3-button w3-blue w3-small\">EDIT</button></p>";
				} else {
					echo "<p>" . $sched_value . "</p>";
				}

				echo "</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
		echo "</div>";
		echo "</header>";
		unset($database);
	}

	function generateStudentsTable() {
		$database = new Database();
		$database->connectDB();

		echo "<header class='w3-container w3-padding-32 w3-center w3-white' id='home'>";
		echo "<div class='w3-responsive'>";
		echo "<table id=studentstable class='w3-table-all w3-centered w3-border w3-tiny'>";

		$students =  $database->getStudents();
		echo "<tr class='w3-border'>";
		echo "<th class='w3-border'>STUDENT ID</th>";
		echo "<th class='w3-border'>FIRST NAME</th>";
		echo "<th class='w3-border'>MIDDLE NAME</th>";
		echo "<th class='w3-border'>LAST NAME</th>";
		echo "</tr>";
		
		foreach($students as $student) {
			//print_r($student); echo "</br>";
			echo "<tr>";
			
			foreach($student as $student_detail) {
				echo "<td class='w3-border'>";
				echo "<p>" . $student_detail . "</p>";
				echo "</td>";
			}
			echo "</tr>";
		}		
		echo "</table>";
		echo "</div>";
		echo "</header>";
	}

	function generateInstructorsTable() {
		$database = new Database();
		$database->connectDB();

		echo "<header class='w3-container w3-padding-32 w3-center w3-white' id='home'>";
		echo "<div class='w3-responsive'>";
		echo "<table id=studentstable class='w3-table-all w3-centered w3-border w3-tiny'>";

		$instructors =  $database->getInstructors();
		echo "<tr class='w3-border'>";
		echo "<th class='w3-border'>INSTRUCTOR ID</th>";
		echo "<th class='w3-border'>FIRST NAME</th>";
		echo "<th class='w3-border'>MIDDLE NAME</th>";
		echo "<th class='w3-border'>LAST NAME</th>";
		echo "</tr>";
		
		foreach($instructors as $instructor) {
			//print_r($student); echo "</br>";
			echo "<tr>";
			
			foreach($instructor as $instructor_detail) {
				echo "<td class='w3-border'>";
				echo "<p>" . $instructor_detail . "</p>";
				echo "</td>";
			}
			echo "</tr>";
		}		
		echo "</table>";
		echo "</div>";
		echo "</header>";
	}

	function generateSlotTable() {
		$database = new Database();
		$database->connectDB();

		echo "<header class='w3-container w3-padding-32 w3-center w3-white' id='home'>";
		echo "<div class='w3-responsive'>";
		echo "<table id=studentstable class='w3-table-all w3-centered w3-border w3-tiny'>";

		$slots =  $database->getSlots();
		echo "<tr class='w3-border'>";
		echo "<th class='w3-border'>SLOT ID</th>";
		echo "<th class='w3-border'>SLOT</th>";
		echo "</tr>";
		
		foreach($slots as $slot) {
			//print_r($student); echo "</br>";
			echo "<tr>";
			
			foreach($slot as $slot_detail) {
				echo "<td class='w3-border'>";
				echo "<p>" . $slot_detail . "</p>";
				echo "</td>";
			}
			echo "</tr>";
		}		
		echo "</table>";
		echo "</div>";
		echo "</header>";
	}

	function generateAircraftTable() {
		$database = new Database();
		$database->connectDB();

		echo "<header class='w3-container w3-padding-32 w3-center w3-white' id='home'>";
		echo "<div class='w3-responsive'>";
		echo "<table id=studentstable class='w3-table-all w3-centered w3-border w3-tiny'>";

		$aircrafts =  $database->getAircrafts();
		echo "<tr class='w3-border'>";
		echo "<th class='w3-border'>AIRCRAFT ID</th>";
		echo "<th class='w3-border'>REGISTRATION</th>";
		echo "</tr>";
		
		foreach($aircrafts as $aircraft) {
			//print_r($student); echo "</br>";
			echo "<tr>";
			
			foreach($aircraft as $aircraft_detail) {
				echo "<td class='w3-border'>";
				echo "<p>" . $aircraft_detail . "</p>";
				echo "</td>";
			}
			echo "</tr>";
		}		
		echo "</table>";
		echo "</div>";
		echo "</header>";
	}

}

?>