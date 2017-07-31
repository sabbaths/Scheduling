<?php

include_once('database_model.php');

$slot_id = isset($_REQUEST['slot_id']) ? $_REQUEST['slot_id'] : null;
$instructor_id = isset($_REQUEST['instructor_id']) ? $_REQUEST['instructor_id'] : null;
$student_id = isset($_REQUEST['student_id']) ? $_REQUEST['student_id'] : null;
$aircraft_id = isset($_REQUEST['aircraft_id']) ? $_REQUEST['aircraft_id'] : null;
$date_flight = isset($_REQUEST['date_flight']) ? $_REQUEST['date_flight'] : null;
$purpose_id = isset($_REQUEST['purpose_id']) ? $_REQUEST['purpose_id'] : null;

$database = new Database();
$database->connectDB();
$status_code = $database->createEditSchedule($slot_id, $instructor_id, $student_id, $aircraft_id, $date_flight, $purpose_id);

$response_data = [ 'status_code' => $status_code];
echo json_encode( $response_data );

?>