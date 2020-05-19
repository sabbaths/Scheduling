<?php

include_once('database_model.php');

$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : null;
$is_active = isset($_REQUEST['is_active']) ? $_REQUEST['is_active'] : null;
$slot_id = isset($_REQUEST['slot_id']) ? $_REQUEST['slot_id'] : null;
$slot_time = isset($_REQUEST['slot_time']) ? $_REQUEST['slot_time'] : null;
$id_input = isset($_REQUEST['id_input']) ? $_REQUEST['id_input'] : null;


$database = new Database();
$database->connectDB();

$status_code = $database->slotHandler($mode,
	$id_input,
	$slot_id,
	$slot_time,
	$is_active);

$response_data = [ 'status_code' => $status_code];
echo json_encode( $response_data );

?>