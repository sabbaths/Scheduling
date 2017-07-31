<?php

include_once('database_model.php');

$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : null;
$is_active = isset($_REQUEST['is_active']) ? $_REQUEST['is_active'] : null;
$aircraft_id = isset($_REQUEST['aircraft_id']) ? $_REQUEST['aircraft_id'] : null;

$database = new Database();
$database->connectDB();

$status_code = $database->aircraftHandler($mode, $aircraft_id, $is_active);

$response_data = [ 'status_code' => $status_code];
echo json_encode( $response_data );

?>