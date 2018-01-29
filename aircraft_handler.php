<?php

include_once('database_model.php');

$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : null;
$is_active = isset($_REQUEST['is_active']) ? $_REQUEST['is_active'] : null;
$aircraft_id = isset($_REQUEST['aircraft_id']) ? $_REQUEST['aircraft_id'] : null;
$registration = isset($_REQUEST['registration']) ? $_REQUEST['registration'] : null;
$bew = isset($_REQUEST['bew']) ? $_REQUEST['bew'] : null;
$moment = isset($_REQUEST['moment']) ? $_REQUEST['moment'] : null;
$aircraft_id = isset($_REQUEST['id_input']) ? $_REQUEST['id_input'] : null;

$database = new Database();
$database->connectDB();

$status_code = $database->aircraftHandler(
	$mode, 
	$aircraft_id, 
	$registration,
	$bew,
	$moment,
	$is_active);

$response_data = [ 'status_code' => $status_code];
echo json_encode( $response_data );

?>