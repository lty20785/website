<?php
session_start();
include_once 'includes/check_login.php';

require_once 'database/game.php';
require_once 'database/session.php';
require_once 'database/sport.php';

if (isset($_POST['deleteGame'])) {
  $gameId = htmlspecialchars($_POST['gameId']);
  if (deleteGame($gameId)) {
    $msg = "Game deleted.";
  } else {
    $msg = "Game not found.";
  }

} elseif (isset($_POST['deleteUser'])) {
  $targetUserId = htmlspecialchars($_POST['userId']);
  if (deleteUser($userId)) {
    $msg = "User deleted.";
  } else {
    $msg = "User not found.";
  }

} elseif (isset($_POST['addSport'])) {
  $sportName = htmlspecialchars($_POST['sportName']);
  if (addSport($sportName)) {
    $msg = "Success!  New sport created.";
  } else {
    $msg = "Sport creation failed.";
  }

} elseif (isset($_POST['deleteSport'])) {
  $sportId = htmlspecialchars($_POST['sport']);
  if (deleteSport($sportId)) {
    $msg = "Sport deleted.";
  } else {
    $msg = "Sport deletion failed.";
  }

}

?>

<!DOCTYPE html>

<html>
<head>
<title>Main page</title>

<script type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" href="stylesheets/common.css" type="text/css" />
<link rel="stylesheet" href="stylesheets/admin.css" type="text/css" />

</head>

<body>

<?php
$header = "Admin Page";
include 'includes/header.php';

$addr = "admin.php";
include 'includes/nav.php';
?>

<div class="adminables">
<h3>Administration Tasks</h3>

<?php
if (isset($msg)) {
  echo "<p>$msg</p>";
}
?>

<form name="administrivia" action='admin.php' method='post'>

Delete game: <input type="text" name="gameId" placeholder="Game ID" />
<input type='submit' name='deleteGame' value='Delete' /><br/>

Delete user: <input type="text" name="userId" placeholder="User ID" />
<input type='submit' name='deleteUser' value='Delete' /><br/>

Add sport: <input type="text" name="sportName" placeholder="Sport name" />
<input type='submit' name='addSport' value='Add' /><br/>

Delete sport: <select name='sport'>
<?php include 'includes/sportOptions.php'; ?>
</select>
<input type='submit' name='deleteSport' value='Delete' /><br/>

</form>
</div>

<div id="statistics">
<h3>Statistics</h3>
<?php

require_once 'database/admin.php';
require_once 'database/sport.php';

$gameData = getTotalGames();
$totalGames = $gameData["totalGames"];
$openGames = $gameData["openGames"];
$totalUsers = getTotalUsers();
$totalFriendships = getTotalFriendships();
$lonelies = getUsersNoFriends();
$totalSports = count(getAllSports());

echo <<<HTML
<ul>
<li>Users: {$totalUsers}</li>
<li>Games: {$totalGames}</li>
<li>Open games: {$openGames}</li>
<li>Total friendships: {$totalFriendships}</li>
<li>Users without a friend: {$lonelies}</li>
<li>Sports: {$totalSports}</li>
</ul>
</div>
HTML;
?>

</body>
</html>
