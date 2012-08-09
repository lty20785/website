<?php
session_start();
include_once 'includes/check_login.php';

require_once("includes/user_interaction.php");
$game_uinter = new user_interaction();

if (!$game_uinter->userid) {
  // Not logged int
  header("Location: splash.php");
}


// Updated the game
if ($game_uinter->gameid and isset($_POST)) {

if (!$game_uinter->ispast) {

  // User is updating game details
  if ($game_uinter->is_creator()) {
    if (isset($_POST['save'])) {
      $game_uinter->update_details();
    }

    if (isset($_POST['cancel'])) {
      $game_uinter->cancel_game();
      header("Location: main.php");
    }
  }

  // User is trying to join or leave game
  if ($game_uinter->has_joined()) {
    if(isset($_POST['unjoin'])) {
      $game_uinter->leave_game();
    }
  } else {
    if (isset($_POST['join'])) {
      $game_uinter->join_game();
    }
  }

}

  // User is trying to rate someone
  if ($game_uinter->can_rate()) {
    if (isset($_POST['ratePlayers'])) {
      // Loop through every item in the form, and try to rate that player

      $participants = $game_uinter->get_game_participants();

      foreach ($_POST as $k => $v) {
        if (in_array($k, $participants)) {
          if ($v == "+1" or $v =="-1") {
            $game_uinter->rate_player($k, (int) $v);
          }
        }
      }
    }

  }


  // User is posting a comment
  if (isset($_POST['postComment'])) {
    $game_uinter->post_comment();
  }
}


?>

<!DOCTYPE html>
<html>
<head>
<title>Game page</title>

<link rel="stylesheet" href="stylesheets/jquery/jquery-ui-1.8.22.custom.css" type="text/css" />
<script type="text/javascript" src="scripts/jquery/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery-ui-1.8.22.custom.min.js"></script>

<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/validation.js"></script>
<script type="text/javascript" src="scripts/game.js"></script>
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

if (!$game_uinter->gameid) {
  // Invalid gameid
  echo "<p>Sorry, bad gameId!</p>";
} else {

$gameid = $game_uinter->get_gameid();

//show the date, time, sport, and location of this game
$gameInfo = $game_uinter->get_game_info();

echo <<<HTML1
<form name='game_action' action='game.php?gameid={$gameid}' method='post' id="editableForm" class="uneditable">

Sport: {$gameInfo['sportName']}<br/>

Organiser: 
<a href="profile.php?userid={$gameInfo['organiserId']}">{$gameInfo['organiserUsername']}</a><br/>

Location:
<span class="editfield" name="location">{$gameInfo['location']}</span>
<input type="text" name="location" value="{$gameInfo['location']}" /><br/>

Date:
<span class="editfield" name="date">{$gameInfo['date']}</span>
<input type="text" id="datepicker" name="date" value="{$gameInfo['date']}" class="vDate" /><br/>

Time:
<span class="editfield" name="time">{$gameInfo['time']}</span>
<input type="text" name="time" value="{$gameInfo['time']}" class="vTime" /><br/>

<span class="unhidden">Description: </span>
<span class="editfield" name="description">{$gameInfo['description']}</span>
<textarea name="description" cols="30" rows="6">{$gameInfo['description']}</textarea><br/>
HTML1;

// Edit details, cancel the agme */
if ($game_uinter->is_creator() and !$game_uinter->ispast)
{
    echo <<<HTML2
<input type='submit' name='cancel' value='Cancel Game' /> 
<input type="submit" name="save" value="Save" />
<button type='button' id='editButton' onclick='return false;'>
Edit Details
</button><br/>
HTML2;
}




//list the users participating in this game
$participants = $game_uinter->get_game_participants();

echo "<h3>Participants</h3>\n";
if ($game_uinter->can_rate()) {echo "Rate the participants:\n";}
echo '<ul id="participants">';

foreach ($participants as $participant) {
  include 'includes/gameParticipant.php';
}

echo "</ul>";

if (count($participants) == 0) {
  $joinText = "Be the first!";
} else {
  $joinText = "Join too!";
}

if ($game_uinter->ispast) {
  // Game has happened, give them the option to rate if they played
  if ($game_uinter->can_rate()) {
    echo <<<RATEHTML
<input type="submit" name="ratePlayers" value="Rate players" class="unhidden" />
RATEHTML;
  }

} else {
  // Game hasn't hapened, give them the option to join or leave
  if(!$game_uinter->has_joined()) {
    echo <<<JOINHTML
  <input type='submit' name='join' value='{$joinText}' class='unhidden' /><br/>
JOINHTML;
  } else {
  echo <<<LEAVEHTML
  <input type='submit' name='unjoin' value='Leave game' class="unhidden" /><br/>
LEAVEHTML;
  }
}



// Show comments
echo <<<COMMENT_HEADER_HTML
<h3>Comments</h3>
<ul id="comments">
COMMENT_HEADER_HTML;

$comments = $game_uinter->get_comments();

foreach($comments as $comment) {
  include 'includes/gameComment.php';
}

echo "</ul>";

echo <<<POST_COMMENT_HTML
New Comment: <input type='text' id='commentField' name='commentText' placeholder="Enter a comment..." class="unhidden" /><br/>
<input type='submit' name='postComment' value='Post comment' class="unhidden" />
POST_COMMENT_HTML;
}
?>


</form>
</div>


</body>
</html>
