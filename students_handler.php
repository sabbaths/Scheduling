<?php

include_once('database_model.php');

$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : null;
$is_active = isset($_REQUEST['is_active']) ? $_REQUEST['is_active'] : null;
$first_name = isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : null;
$middle_name = isset($_REQUEST['middle_name']) ? $_REQUEST['middle_name'] : null;
$last_name = isset($_REQUEST['last_name']) ? $_REQUEST['last_name'] : null;
$id_input = isset($_REQUEST['id_input']) ? $_REQUEST['id_input'] : null;


$database = new Database();
$database->connectDB();

$status_code = $database->studentHandler($mode,
	$id_input,
	$first_name,
	$middle_name,
	$last_name,
	$is_active);

$response_data = [ 'status_code' => $status_code];
echo json_encode( $response_data );

?>