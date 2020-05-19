<?php

// Use HTTP Strict Transport Security to force client to use secure connections only
$use_sts = true;

// iis sets HTTPS to 'off' for non-SSL requests
/*
if ($use_sts && isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    header('Strict-Transport-Security: max-age=31536000');
} elseif ($use_sts) {
    header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
    
    die();
}
*/
?>

<!DOCTYPE html>
<html>
<title>FLIGHT SCHEDULE</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="javascript/jquery.min.js"></script>
<script src="javascript/script.js"></script>
<link rel="stylesheet" href="css/user.css">
<link rel="stylesheet" href="css/w3.css">

<body class="w3-white">

<form id='login_form' method='post' action="home.php" class="w3-container w3-card-4 w3-light-grey w3-text-red w3-margin">
  <h1 class="w3-center">FLIGHT SCHEDULE</h2>
   
  <div class="w3-row w3-section">
    <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
      <div class="w3-rest">
        <input id='username' name='username' class="w3-input w3-border" name="first" type="text" placeholder="Username">
      </div>
  </div>

  <div class="w3-row w3-section">
    <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
      <div class="w3-rest">
        <input id='password' name='password' class="w3-input w3-border" name="last" type="password" placeholder="Password">
      </div>
  </div>

  <div class="w3-row w3-section">
      <div class="w3-rest">
        <a href="registration.php"></a>
      </div>
  </div>

  <button class="w3-button w3-block w3-section w3-grey w3-ripple w3-padding">Login</button>

</form>



<div class="w3-padding-large" id="main">

  <!-- Header/Home -->
  <header class="w3-container w3-center w3-white" id="home">

      <p><a href='index.php'>FLIGHT SCHEDULE</a></p>
      <p><a href='index.php?table=ground'>GROUND SCHEDULE</a></p>

  	<?php
      require('database_model.php');
      require('controller.php');

      $controller = new Controller();

      //echo "<p><a href='index.php'>FLIGHT SCHEDULE</a> 
      //<p><a href='index.php?table=ground'>GROUND SCHEDULE</a>";

      $table = isset($_REQUEST['table']) ? $_REQUEST['table'] : null;

      if($table == "ground") {
        $controller->generateGroundScheduleTable("index");
      } else {
        $date = new DateTime(date("Y/m/d"));
        $controller->generateIndexScheduleTable($date->format('Y-m-d'));
        for($i = 0; $i<6;$i++) {
          $date->modify('+1 day');
          $controller->generateIndexScheduleTable($date->format('Y-m-d'));  
        }         
      }
  	?>

  </header>
</div>
</body>
</html>
