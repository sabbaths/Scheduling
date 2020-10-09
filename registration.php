<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="javascript/jquery.min.js"></script>
<script src="javascript/script.js"></script>
<link rel="stylesheet" href="css/user.css">
<link rel="stylesheet" href="css/w3.css">
<body>

<form id='registration_form' action="index.php" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin">

<h2 class="w3-center">REGISTRATION</h2>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input id='username' class="w3-input w3-border" name="first" type="text" placeholder="Username" minlength="5" maxlength="16" required>
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
    <div class="w3-rest">
      <input id='password' class="w3-input w3-border" name="message" type="password" placeholder="Password" minlength="8" maxlength="16" required>
    </div>
</div>
 
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input id='first_name' class="w3-input w3-border" name="first" type="text" placeholder="First Name" maxlength="20" required>
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input id='middle_name' class="w3-input w3-border" name="last" type="text" placeholder="Middle Name" maxlength="20" required>
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input id='last_name' class="w3-input w3-border" name="last" type="text" placeholder="Last Name" maxlength="20" required>
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
    <div class="w3-rest">
      <input id='email' class="w3-input w3-border" name="email" type="text" placeholder="Email"
      maxlength="20"  required>
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-phone"></i></div>
    <div class="w3-rest">
      <input id='phone' class="w3-input w3-border" name="phone" type="text" placeholder="Phone" maxlength="20" required>
    </div>
  <input class="w3-radio" id='rdt_btn_stud' type="radio" name="gender" value="student" checked>
  <label>Student</label>

  <input class="w3-radio" id='rdt_btn_fi' type="radio" name="gender" value="instructor">
  <label>Instructor</label>

  <input class="w3-radio" id='rdt_btn_admin' type="radio" name="gender" value="admin">
  <label>Admin</label>
</div>

<button class="w3-button w3-block w3-section w3-blue w3-ripple w3-padding length=8">Send</button>
<h8 class="w3-left-center"><a href='index.php'>BACK</a></h8>
</form>

</body>
</html> 
