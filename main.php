<?php session_start(); ?>

<?php


?>


<!DOCTYPE html>

<html>
<head>
<title>Main page</title>

<script type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" href="stylesheets/common.css" type="text/css" />
<link rel="stylesheet" href="stylesheets/main.css" type="text/css" />

</head>

<body>

<?php

require_once("includes/usersystem.php");
$uf = new user_functions();

if ($uf->user_authentication()) {

  $header = "Main Page";
  include 'includes/header.php';

  $addr = "main.php";
  include 'includes/nav.php';

  include 'includes/alerts.php';

  include 'includes/relevantgames.php';

} else {

  echo $error;
  echo $_SESSION['view'];
  echo "</br>";
  header("Location: splash.php");
}

?>


</body>
</html>
