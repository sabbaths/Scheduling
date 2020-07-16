<?php

include_once('database_model.php');
/*
$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : null;
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;
*/
/*
$username = 'scheduler';
$password = 'scheduler';

$database = new Database();
$database->connectDB();

$status_code = $database->login($username, $password);

$response_data = [ 'status_code' => $status_code[0]];
echo $status_code[0];
*/
echo "test";
$database = new Database();
$database->connectDB();
$test = $database->getUsers();
print_r($test[0]);


?>