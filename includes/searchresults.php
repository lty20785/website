<?php

if (isset($results)) {

    echo <<<HTML
<div id="searchResults">
<h3>Search Results</h3>
HTML;

  if ($results === false) {
    echo "<p>Search error.  Sorry!</p>";
  } elseif (count($results) == 0) {
    echo "<p>No games found that match your criteria.  Try being less picky.</p>"; 
  } else {

    echo "<ul>";

    require_once 'database/game.php';

    foreach($results as $result) {
      $info = getGameInfo($result);
      $sport = $info["sportName"];
      $date = $info["date"];
      $time = $info["time"];
      $loc = $info["location"];
      $gameid = $result;

      include 'includes/gamebox.php';
    }
    
    echo "</ul>";
  }

  echo "</div>";

}

?>
