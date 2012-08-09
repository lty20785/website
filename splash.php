<?php
session_start();

require_once "includes/user_system.php";

$uf = new user_functions();
$error = $uf->user_authentification();

if (isset($_SESSION['userId'])) {
  // Logged in or signed up succesfully, or already logged int
  // So redirect
  header("Location: main.php");

}

?>

<!DOCTYPE html>
<html>
<head>
<title>PickUp</title>

<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/validation.js"></script>
<script type="text/javascript" src="scripts/splash.js"></script>
<link rel="stylesheet" href="stylesheets/common.css" type="text/css"/>
<link rel="stylesheet" href="stylesheets/splash.css" type="text/css"/>

</head>


<body>
<h2>Welcome to PickUp</h2>

<div id="about">
<h4>About Us</h4>
<p>Ever wanted to play a pick-up hockey game but couldn't find one nearby?</p>
<p>Ever tried to play soccer with two friends, wishing you had a few more people to play with?</p>
<p>Ever watched a basketball court sit empty when people could be playing on it?</p>
<p>Join now!</p>
</div>

<div id="login">
<h4>Log In</h4>
<?php
if ($error and $error["where"] == "login") {
  echo "<p class='errmsg'>{$error['msg']}</p>";
}
?>
<form name="login" action="splash.php" method="post">
User name: <input type="text" name="username" placeholder="User name" class="vUsername" /><br />
Password: <input type="password" name="password" placeholder="Password" class="vPassword" /><br />
<input type="hidden" name="action" value="login" />
<input type="submit" value="Log In" />
</form>
<a href="retrieve_pwd.php"> Forgot your password? </a>
</div>

<div id="signup">
<h4>New User?</h4>
<?php
if ($error and $error["where"] == "signup") {
  echo "<p class='errmsg'>{$error['msg']}</p>";
}
?>
<form name="signup" action="splash.php" method="post" >
User name: <input type="text" name="username" placeholder="User name" class="vUsername" /><br />
Email: <input type="email" name="email" placeholder="Email" class="vEmail" /><br />
Password: <input type="password" name="password" placeholder="Password" class="vPassword1" /><br />
Repeat password: <input type="password" name="password2" placeholder="Password" class = "vPassword2" /><br />
<input type="hidden" name="action" value="signup" />
<input type="submit" value="Sign Up" />
</form>
</div>

<div id="usernameAvailability" class="unsure">
<h4 id="spacer">Spacer</h4>
<div id="usernameAvailable">Free! <img src="images/check.png"></div>
<div id="usernameUnavailable">In use. <img src="images/ecks.png"></div>
</div>

</body>
</html>
