<?php

require_once 'database/search.php';
require_once 'database/game.php';

$myGames = myGames(5);

?>

<div id="mygamelist">
<h3>Your Games</h3>

<ul>
<?php

# loop through all relevant games
if (count($myGames) > 0) {
  foreach ($myGames as $gameId) {
    $info = getGameInfo($gameId);

    $sport = $info['sportName'];
    $date = $info['date'];
    $time = $info['time'];
    $loc = $info['location'];
    $gameid = $gameId;
    echo '<li>';
    include 'includes/gamebox.php';
    echo '</li>';
  }

} else {

  // No games to show !
  echo "<p>You have no games!</p>";
  echo '<p>Why not <a href="search.php">find</a> or <a href="organise.php">start</a> one?</p>';
  echo '<p>Or you can check the ones over there <img src="images/right_arrow.png" id="rightArrow" /></p>';

}

?>
</ul>
</div>
