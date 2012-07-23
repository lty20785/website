<?php
session_start();

require_once("includes/usersystem.php");
$uf = new user_functions();
$uf->logout();
?>

<!DOCTYPE html>
<html>
<head>
<title>Logout</title>

<script type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" href="stylesheets/common.css" type="text/css"/>

</head>


<body>
<h2>Goodbye!</h2>

<p>You are now successfully logged out.  Congratulations!</p>
<p>Click <a href="splash.php">here</a> to log back in.</p>

</body>
</html>
