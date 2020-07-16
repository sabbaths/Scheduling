<?php

include_once('database_model.php');

$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : null;
$first_name = isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : null;
$middle_name = isset($_REQUEST['middle_name']) ? $_REQUEST['middle_name'] : null;
$last_name = isset($_REQUEST['last_name']) ? $_REQUEST['last_name'] : null;
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;
$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
$phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : null;
$user_type = isset($_REQUEST['user_type']) ? $_REQUEST['user_type'] : 1;

$database = new Database();
$database->connectDB();

$status_code = $database->register($username, $password, $first_name, $middle_name, $last_name, $email, $phone, $user_type);

echo $status_code;

?>