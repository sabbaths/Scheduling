<?php 
include_once('check_session.php');
?>


<!DOCTYPE html>
<html>
<title>WCC SCHEDULING</title>
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
  		<h2>REQUESTS</h2>
	  		<?php
	  			require('controller.php');
	  			require('database_model.php');
	  			$controller = new Controller();

				$date = new DateTime(date("Y/m/d"));
				$controller->generateScheduleTable($date->format('Y-m-d'));
	  		?>



  </header> 
</div>

<?php

include_once('edit_schedule_modal.php');

?>


</body>
</html>
