<!DOCTYPE html>
<html>
<title>WCC SCHEDULING</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/user.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="javascript/script.js"></script>



<body class="w3-white">

<?php include_once('nav.php');?>

<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
  <header class="w3-container w3-padding-32 w3-center w3-white" id="home">
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

include_once('modal.php');

?>


</div>
</body>
</html>
