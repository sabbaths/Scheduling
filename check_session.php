<?php 
session_start(); 

if(!isset($_SESSION['username'])) {
	header("HTTP/1.1 401 Unauthorized");
	exit;
}

?>