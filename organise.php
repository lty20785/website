<?php
session_start();
include_once 'includes/check_login.php';


require_once('includes/user_interaction.php');

//if the form has been submitted, try to create the game
if (isset($_POST['submit']))
{
    $org_uinter = new user_interaction();
    if(($org_gameid=$org_uinter->create_game())==-1)
    {
        echo "The game info you have entered is invalid, please try again";
    }
    else
    {
        header("Location: game.php?gameid=$org_gameid");
    }
}
?>

<html>
<head>
<title>Organize a Game</title>

<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/validation.js"></script>
<script type="text/javascript" src="scripts/organise.js"></script>
<link rel="stylesheet" href="stylesheets/common.css" type="text/css" />

</head>

<body>
<?php
$header="Organize a game";
include 'includes/header.php';

$addr="organise.php";
include 'includes/nav.php';
?>

<form name="organise" action="organise.php" method="post">
Sport: <input type="text" name="sport" /><br/>
Date: <input type="date" name="date" class="vDate" ><br/>
Time: <input type="time" name="time" class="vTime" /><br/>
Location: <input type="text" name="location" /><br/>
Description: (anything you want the players to know)
<br/><textarea name="description" cols="30" rows="6" placeholder=
               "description, this could be the weather, requirements, etc."></textarea><br/>

<input type="submit" name="submit" value="Create" />
</form>

</body>
</html>
