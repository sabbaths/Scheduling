<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

print_r(file_get_contents("php://input"));
/*
$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : null;
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;



$database = new Database();
$database->connectDB();

$status_code = $database->login($username, $password);

$response_data = [ 'status_code' => $status_code[0]];
echo $status_code[0]  */
?>