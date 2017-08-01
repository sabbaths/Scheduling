<!DOCTYPE html>
<html>
<title>SCHEDULING</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/user.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="javascript/script.js"></script>

<body class="w3-white">

<?php

include_once('nav.php');

?>
    
<div class="w3-padding-large" id="main">
  <header class="w3-container w3-padding-32 w3-center w3-white" id="home">
  		<h2>USERS</h2>
	  		<?php
				echo "<p><button onclick=openAddEditModal('') class=\"w3-button w3-panel w3-blue w3-xxlarge w3-left w3-border w3-round-xlarge \">ADD</button></p>";

	  			require('controller.php');
	  			require('database_model.php');
	  			$controller = new Controller();
	  			$controller->generateStudentsTable();
	  		?>
  </header> 
</div>


</body>
</html>
