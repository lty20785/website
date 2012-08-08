<?php 
session_start(); 
?>

<!DOCTYPE html>

<html>
<head>
<title>Main page</title>

<script type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" href="stylesheets/common.css" type="text/css" />
<link rel="stylesheet" href="stylesheets/main.css" type="text/css" />
<script type="text/javascript">
<!--
function delayer(){
    window.location = "splash.php"
}
//-->
</script>

</head>

<?php
require_once("includes/user_system.php");
$uf = new user_functions();

//if the user has logged in or successfully logs in
$main_userId = false;
$main_userId = $uf->user_authentification();
if ( /*$main_userId != false || */isset($_SESSION['userId'])) {
/**************************************
 * DO NOT:
 * display anything before this line 
 */    
    
    echo "<body>";
    
    $header = "Main Page";
    include 'includes/header.php';

    $addr = "main.php";
    include 'includes/nav.php';
    
    echo '<a href= change_pwd.php>change pwd</a><br/>';

    include 'includes/relevantgames.php';
  
    //otherwise print the error msg, and then re-direct to splash.php
}   else {
?>

<body onLoad ="setTimeout('delayer()', 3000)">
<h2>If you were trying to log in, Wrong username password combination!<br/><br/>
    If you were signing up, The username you entered might have been taken already<br/><br/>
    You will be re-directed to the splash page in a moment!


</h2>
<?php } ?>

</body>
</html>
