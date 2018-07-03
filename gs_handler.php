<?php

include_once('database_model.php');

$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : null;
$gs_id = isset($_REQUEST['gs_id']) ? $_REQUEST['gs_id'] : null;
$class_a = isset($_REQUEST['class_a']) ? $_REQUEST['class_a'] : null;
$class_b = isset($_REQUEST['class_b']) ? $_REQUEST['class_b'] : null;


$database = new Database();
$database->connectDB();

$status_code = $database->gsHandler(
	$mode, 
	$gs_id, 
	$class_a,
	$class_b);

$response_data = [ 'status_code' => $status_code];
echo json_encode( $response_data );

?>