<!DOCTYPE html>
<html>
<title>FLIGHT SCHEDULE</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/user.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="javascript/script.js"></script>

<body class="w3-white">

<form id='testf' method='post' action="home.php" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin">
<h1 class="w3-center">FLIGHT SCHEDULE</h2>
 
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input id='username' class="w3-input w3-border" name="first" type="text" placeholder="Username">
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input id='password' class="w3-input w3-border" name="last" type="password" placeholder="Password">
    </div>
</div>

<div class="w3-row w3-section">
   <!--
    <div class="w3-rest">
      <a href="registration.php">REGISTER</a>
    </div> -->
</div>



<button class="w3-button w3-block w3-section w3-blue w3-ripple w3-padding">Login</button>

</form>

<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
  <header class="w3-container w3-padding-32 w3-center w3-white" id="home">
  	<?php
      require('database_model.php');
      require('controller.php');

      $controller = new Controller();

      $date = new DateTime(date("Y/m/d"));
      $controller->generateIndexScheduleTable($date->format('Y-m-d'));
      for($i = 0; $i<6;$i++) {
        $date->modify('+1 day');
        $controller->generateIndexScheduleTable($date->format('Y-m-d'));	
      }	
  	?>

  </header>

<?php

include_once('modal.php');

?>

<script>

$('#testf').submit(function(e) {
     var form = this;
     e.preventDefault();
    
    var username = $('#username').val();
    var password = $('#password').val();

    if(username.length == 0 || password.length == 0) {
          $("#idnga").find('h1').remove();
          $( "#idnga" ).append( "<h1>DUH!!!</h1>" );
          alert("Input Username and Password.");
    } else {
      if(username == 'admin' && password == 'password') {
        form.submit();
      } else {
        alert("WRONG USERNAME AND PASSWORD.");
      }      
    }

});


</script>


</div>
</body>
</html>
