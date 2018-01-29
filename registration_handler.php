<?php

include_once('database_model.php');

$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : null;
$first_name = isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : null;
$middle_name = isset($_REQUEST['middle_name']) ? $_REQUEST['middle_name'] : null;
$last_name = isset($_REQUEST['last_name']) ? $_REQUEST['last_name'] : null;
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;
$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
$phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : null;

$database = new Database();
$database->connectDB();

$status_code = $database->register($username, $password, $first_name, $middle_name, $last_name, $email, $phone);

//$response_data = [ 'status_code' => $status_code[0]];
echo $status_code;

?>