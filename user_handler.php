<?php

include_once('database_model.php');

$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : null;
$user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : null;
$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : null;
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;
$first_name = isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : null;
$middle_name = isset($_REQUEST['middle_name']) ? $_REQUEST['middle_name'] : null;
$last_name = isset($_REQUEST['last_name']) ? $_REQUEST['last_name'] : null;
$phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : null;
$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
$is_active = isset($_REQUEST['is_active']) ? $_REQUEST['is_active'] : null;
$user_type_id = isset($_REQUEST['user_type_id']) ? $_REQUEST['user_type_id'] : null;

$database = new Database();
$database->connectDB();

$status_code = $database->userHandler($mode,
	$user_id,
	$username,
	$password,
	$first_name,
	$middle_name,
	$last_name,
	$phone,
	$email,
	$is_active,
	$user_type_id);

$response_data = [ 'status_code' => $status_code];
echo json_encode( $response_data );

?>