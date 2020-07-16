<div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left w3-light-grey" style="width:150px;" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close()">Close &times;</button>

  <?php
    $user_type_id = $_SESSION['user_type_id'];

    echo "
      <a href='home.php' class='w3-bar-item w3-hover-black w3-button'>
        HOME
      </a>
    ";

    echo "
      <a href='ground_schedule.php' class='w3-bar-item w3-hover-black w3-button'>
        GROUND SCHEDULE
      </a>
    ";

    if($user_type_id == 1)
    echo "
      <a class='w3-bar-item w3-button w3-hover-black' href='students.php'>
        STUDENTS
      </a>
    ";
    if($user_type_id == 1)
    echo "
      <a class='w3-bar-item w3-button w3-hover-black' href='instructors.php'>
        INSTRUCTORS
        </a>
    ";

    if($user_type_id == 1)
    echo "
      <a class='w3-bar-item w3-button w3-hover-black' href='aircrafts.php'>
      AIRCRAFTS
      </a>
    ";

    if($user_type_id == 1)
    echo "
      <a class='w3-bar-item w3-button w3-hover-black' href='slots.php'>
      SLOTS
      </a>
    ";
    if($user_type_id == 1)
    echo "
      <a class='w3-bar-item w3-button w3-hover-black' href='test.php'>
      TEST
      </a>
    ";
    if($user_type_id == 1)
    echo "
      <a class='w3-bar-item w3-button w3-hover-black' href='users.php'>
      USERS
      </a>
    ";

    echo "
      <!--<a class='w3-bar-item w3-button w3-hover-black' href='requests.php'>
      MANAGE REQUESTS
      </a>-->
      </a>
    ";

    echo "      
      <a class='w3-bar-item w3-button w3-hover-black' href='logout.php'>
      LOGOUT
      </a>
    ";
  ?>
</div>

<div class="w3-main" >
<div class="w3-light-grey">
  <button class="w3-button w3-grey w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</button>
</div>
