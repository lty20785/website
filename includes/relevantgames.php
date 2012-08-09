<?php

require_once 'database/search.php';
require_once 'database/game.php';

$recGames = suggestGames(5);

?>

<div id="gamelist">
<h3>Relevant Games</h3>

<ul>
<?php

# loop through all relevant games
foreach ($recGames as $gameId) {
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

?>
</ul>
</div>
