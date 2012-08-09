<?php 
session_start(); 
include_once 'includes/check_login.php';

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
$header = "Main Page";
include 'includes/header.php';

$addr = "main.php";
include 'includes/nav.php';
?>

<div id="listcontainer">
<?php
include 'includes/mygames.php';
include 'includes/relevantgames.php';
?>
</div>

</body>
</html>
