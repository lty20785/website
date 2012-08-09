
<?php
session_start();
include_once 'includes/check_login.php';

include_once 'database/profile.php';


$viewuserid = htmlspecialchars($_GET["userid"]);
$userid = $_SESSION["userId"];

if (!$viewuserid) {
  $viewuserid = $userid;
}

/* Update the user's profile  if they edited it */
if (isset($_POST["Save"])) {
  $profile = array(
    "firstname" => htmlspecialchars($_POST["firstname"]),
    "lastname" => htmlspecialchars($_POST["lastname"]),
    "location" => htmlspecialchars($_POST["location"]),
    "email" => htmlspecialchars($_POST["emailaddress"]),
    "phone" => htmlspecialchars($_POST["phonenumber"]),
  );

  updateProfile($data);
}  

$profile = getProfile($viewuserid);
if (!$profile) {
  $error = "Invalid userid.";
}

?>

<!DOCTYPE html>

<html>
<head>
<title>Profile</title>

<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/validation.js"></script>
<script type="text/javascript" src="scripts/profile.js"></script>
<link rel="stylesheet" href="stylesheets/common.css" type="text/css" />
<link rel="stylesheet" href="stylesheets/profile.css" type="text/css" />

</head>

<body>

<?php

if ($error) {
  echo $error;
} else {

  $header="Profile";
  include 'includes/header.php';

  $addr="profile.php";
  include 'includes/nav.php';

echo <<<HTML1
<p>
<a href="change_pwd.php">Change password</a><br/>
</p>

<form name="profile" action="profile.php" method="post" id="editableForm" class="uneditable">
Username: {$profile['username']}<br/>
First Name: <span class="editfield" name="firstname">{$profile['firstName']}</span>
<input type="text" name="firstname" value="{$profile['firstName']}" /><br/>
Last Name: <span class="editfield" name="lastname">{$profile['lastName']}</span>
<input type="text" name="lastname" value="{$profile['lastName']}" /><br/>
Location: <span class="editfield" name="location">{$profile['location']}</span>
<input type="text" name="location" value="{$profile['location']}" /><br/>
Email: <span class="editfield" name="email">{$profile['email']}</span>
<input type="email" name="emailaddress" value="{$profile['email']}" class="vEmail" /><br/>
Phone: <span class="editfield" name="phone">{$profile['phone']}</span>
<input type="text" name="phonenumber" value="{$profile['phone']}" class="vPhone" /><br/>
HTML1;

  if ($viewuserid == $userid) {
    echo <<<HTML2
<input type="submit" value="Save" />
<button type="button" id="editButton" onclick="return false;">Edit</button>
HTML2;
  }

  echo "</form>";

}
?>

</body>
</html>
