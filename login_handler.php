<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$post_data = file_get_contents("php://input");
$json_data = json_decode($post_data);

include_once('database_model.php');

$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null; 
$username = $json_data->username;
$password = $json_data->password;



$database = new Database();
$database->connectDB();

$status_code = $database->login($username, $password);

$response_data = [ 'status_code' => $status_code[0]];
echo json_encode($status_code[0]); 

?>