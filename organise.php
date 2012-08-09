<?php
session_start();
include_once 'includes/check_login.php';


require_once 'includes/user_interaction.php';

//if the form has been submitted, try to create the game
if (isset($_POST['submit']))
{
    $org_uinter = new user_interaction();
    $org_gameid = $org_uinter->create_game();

    if(!$org_gameid)
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

<link rel="stylesheet" href="stylesheets/jquery/jquery-ui-1.8.22.custom.css" type="text/css" />
<script type="text/javascript" src="scripts/jquery/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery-ui-1.8.22.custom.min.js"></script>

<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/validation.js"></script>
<script type="text/javascript" src="scripts/organise.js"></script>
<link rel="stylesheet" href="stylesheets/common.css" type="text/css" />
<link rel="stylesheet" href="stylesheets/organise.css" type="text/css" />

</head>

<body>
<?php
$header="Organize a game";
include 'includes/header.php';

$addr="organise.php";
include 'includes/nav.php';
?>

<form name="organise" action="organise.php" method="post">
Sport: <select name="sport" >
<?php
require_once 'database/sport.php';
$sports = getAllSports();
foreach ($sports as $sport) {
  $sportName = $sport['sportName'];
  $sportId = $sport['sportId'];
  echo "<option value='$sportId'>$sportName</option>\n";
}
?>
</select><br/>
Date: <input type="text" id="datepicker" name="date" class="vDate" ><br/>
Time: <input type="time" name="time" class="vTime" /><br/>
Location: <input type="text" name="location" /><br/>
<span class="unhidden">Description: </span>
<textarea name="description" cols="30" rows="6" placeholder=
               "Enter a description of your game, or anything other players should know"></textarea><br/>

<input type="submit" name="submit" value="Create" />
</form>

</body>
</html>
