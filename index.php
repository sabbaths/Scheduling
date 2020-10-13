<?php

// Use HTTP Strict Transport Security to force client to use secure connections only
//$use_sts = true;

// iis sets HTTPS to 'off' for non-SSL requests
/*
if ($use_sts && isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    header('Strict-Transport-Security: max-age=31536000');
} elseif ($use_sts) {
    header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
    
    die();
}
*/
/*
if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
} */

?>

<!DOCTYPE html>
<html>
<title>APG FLIGHT SCHEDULE</title>
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
   <!--<p><a class='w3' href='registration.php'>REGISTER</a></p> -->
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

<div class="w3-container">
  <h2>ANNOUNCEMENT</h2>

  <div id="id01" class="w3-modal">
    <div class="w3-modal-content">
      <div id='div_announcement_container' class="w3-container">
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <h1>ANNOUNCEMENT:</h1>
        <p>Everyone(Mechanic, Pilot, Student, Admin) needs to submit COVID test result before initial work or training AS PER CAAP REQUIREMENT,even if you just stayed in SUBIC for the whole quarantine. <p>PLEASE DONT ASK AGAIN.</p>



        <p>-CAPT JAMES - CAPT. JAYLORD</p>

        <h1>AIRPORT OPERATIONS 0700-1700</h1>
        </p>
      </div>
    </div>
  </div>
</div>

</body>
</html>
