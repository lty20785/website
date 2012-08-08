<?php

include '../database/sport.php';

function testSport() {
  $sportId = addSport("fakeSport");
  if (!$sportId) {
    echo "testSport--Failed to create sport.\n";
    return false;
  }

  $sportName = getSportName($sportId);
  if (!$sportName
      or $sportName != "fakeSport") {
    echo "testSport--Sport creation failed to stick.\n";
    return false;
  }

  if (getSportId($sportName) != $sportId) {
    echo "testSport--Couldn't look up sport by ID.\n";
    return false;
  }

  if (!deleteSport($sportId)) {
    echo "testSport--Failed to delete sport.\n";
    return false;
  }

  return true;

}


if (testSport()) {
  echo "testSport--All passed.\n";
}

?>
