<?php 
include_once('check_session.php');
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

?>
    
<div class="w3-padding-large" id="main">
  <header class="w3-container w3-padding-32 w3-center w3-white" id="home">
  		<h2>USERS</h2>
	  		<?php
				echo "<p><button onclick=openAddEditModal('ac_table_view','add') class=\"w3-button w3-panel w3-large w3-left w3-border \">ADD USER</button></p>";

	  			require('controller.php');
	  			require('database_model.php');
	  			$controller = new Controller();
	  			//$controller->generateStudentsTable();
	  		?>
  </header> 
</div>


</body>
</html>
