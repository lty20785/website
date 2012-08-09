<?php

require_once 'database/sport.php';

$sports = getAllSports();
foreach ($sports as $sport) {
  $sportName = $sport['sportName'];
  $sportId = $sport['sportId'];
  echo "<option value='$sportId'>$sportName</option>\n";
}
?>
