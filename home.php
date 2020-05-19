<?php 
session_start(); 

if(isset($_SESSION['username'])) {
} else if(isset($_POST['username'])) {
  $_SESSION['username'] = $_POST['username'];
} else {
  echo "UNAUTHORIZED";
  exit();
}

?>

<!DOCTYPE html>
<html>
<title>SCHEDULING</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="javascript/jquery.min.js"></script>
<script src="javascript/script.js"></script>
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/user.css">

<body class="w3-white">

<?php include_once('nav.php'); ?>

<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
  <header class="w3-container w3-center w3-white" id="home">
  	<?php
      include_once('nav.php');
      require('database_model.php');
      require('controller.php');

      $controller = new Controller();

      $date = new DateTime(date("Y/m/d"));
      $controller->generateScheduleTable($date->format('Y-m-d'));
      for($i = 0; $i<6;$i++) {
        $date->modify('+1 day');
        $controller->generateScheduleTable($date->format('Y-m-d'));	
      }	
  	?>

  </header>

<?php

include_once('edit_schedule_modal.php');

?>


</div>
</body>
</html>
