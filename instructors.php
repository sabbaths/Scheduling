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
include_once('open_edit_modal.php');

?>
    
<div class="w3-padding-large" id="main">
  <header class="w3-container w3-padding-32 w3-center w3-white" id="home">
  		<h2>INSTRUCTOR</h2>
	  		<?php
	  			/*
				echo "<p><button onclick=openAddEditModal('instructors_table_view','add') class=\"w3-button w3-panel w3-large w3-left w3-border \">ADD INSTRUCTOR</button></p>";
				*/
	  			require('controller.php');
	  			require('database_model.php');
	  			$controller = new Controller();
	  			$controller->generateInstructorsTable();
	  		?>
  </header> 
</div>

</body>
</html>
