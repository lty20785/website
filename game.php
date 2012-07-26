<?php
session_start();

require_once("includes/user_interaction.php");
$uinter = new user_interaction();
$uinter->get_game_full_info();
?>

<!DOCTYPE html>
<html>
<head>
<title>Game page</title>

<script type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" href="stylesheets/common.css" type="text/css" />
<link rel="stylesheet" href="stylesheets/game.css" type="text/css" />

</head>

<body>

<?php
$header = "Game Page";
include 'includes/header.php';

$addr = "game.php";
include 'includes/nav.php';
?>

<div class="details">
<h3>Details</h3>

<?php


?>
<a href="#">Interested in this game?</a>
</div>

<?php
# pull the posts
include 'includes/gameposts.php';
?>

</body>
</html>
