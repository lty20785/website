<?php
session_start();
include_once 'includes/check_login.php';

require_once("includes/user_interaction.php");
$game_uinter = new user_interaction();

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

$game_gameid = htmlspecialchars($_GET['g']);

//show the date, time, sport, and location of this game
$game_uinter->get_game_info();

//list the users participating in this game
$game_uinter->get_game_participants();

//display the actions can be taken based on the role of the user
if(!$game_uinter->is_creater())
{
    if($game_uinter->has_joined())
    {
        echo"
            <form name='game_action' action='game_action.php' method='post'>
            <input type='hidden' name='gameid' value='$game_gameid' />
            <input type='submit' name='join' value='unjoin this game' />
            </form>";
    }
    else
    {
        echo"
            <form name='game_action' action='game_action.php' method='post'>
            <input type='hidden' name='gameid' value='$game_gameid' />
            <input type='submit' name='join' value='join this game' />
            </form>";    
    }
}
else
{
    echo"
        <form name='game_action' action='game_action.php' method='post'>
        <input type='hidden' name='gameid' value='$game_gameid' />
        <input type='submit' name='join' value='cancel this game' />
        </form>";
    
    echo"<br/>
        <a href='change_description.php'>change description</a>
        
        ";
}



?>

</div>


</body>
</html>
