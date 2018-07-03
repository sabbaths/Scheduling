<?php 
session_start(); 

if(isset($_SESSION['username'])) {
} else if(isset($_POST['username'])) {
  $_SESSION['username']= $_POST['username'];
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

<?php 
  include_once('nav.php'); 
  include_once('open_edit_modal.php');
?>

<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
  <header class="w3-container w3-center w3-white" id="home">

  <?php //echo "<p><button class=\"w3-button w3-panel w3-large w3-left w3-border \">EDIT</button></p>";   ?>
	<?php
    include_once('nav.php');
    require('database_model.php');
    require('controller.php');

    $controller = new Controller();
    $controller->generateGroundScheduleTable();	
	?>

  </header>

<?php
?>


</div>
</body>
</html>
