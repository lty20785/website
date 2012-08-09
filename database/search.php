<?php

require_once 'dbinterface.php';


/* Search */
function search($criteria, $numResults, $offset) {
try {

  if (!$conn = connectDB()) {
    return false;
  }

  $userId = $_SESSION['userId'];
  if (!$userId) {
    return false;
  }

  /* Run the search stored proc */
  $args = array(
    $criteria["sportID"], $criteria["startDate"],
    $criteria["endDate"], $criteria["location"],
    $userId, $numResults, $offset,
  );
  $sql = <<<SQL
SELECT gameID, resultRank, totalResults
FROM search(($1, $2, $3, $4), $5, $6, $7)
ORDER by resultRank;
SQL;

  $result = executeSQL($conn, $sql, $args);
  
  if (!$result) {
    closeDB($conn);
    return false;
  }

  $ret = array();
  while ($row = nextRow($result)) {
    array_push($ret, $row[0]);
  }

  closeDB();
  return $ret;

} catch (Exception $e) {
  error("search: {$e}");
  closeDB($conn);
  return false;
}
}


/* Get a list of relevant games */
function suggestGames($numGames) {
  $criteria = array(
    "sportID" => null,
    "startDate" => null,
    "endDate" => null,
    "location" => null,
  );
  return search($criteria, $numGames, 0);
}


/* Get a list of my games */
function myGames($numResults = 5) {
try {

  if (!$conn = connectDB()) {
    return false;
  }

  $activeUser = $_SESSION['userId'];
  if (!$activeUser) {
    return false;
  }

  /* Get a ilst of games you've played in and haven't rated in */
  $args = array($activeUser, $numResults);
  $sql = <<<SQL
SELECT g.gameID
FROM Game AS g
LEFT OUTER JOIN RatedGame AS rg
    ON rg.gameID=g.gameID
    AND rg.userID=$1
LEFT OUTER JOIN Joined AS j
    ON j.gameID=g.gameID
    AND j.userID=$1
WHERE rg.gameID IS NULL
    AND (j.gameID IS NOT NULL
        OR g.organiserID=$1)
ORDER BY g.date
LIMIT $2;
SQL;

  $result = executeSQL($conn, $sql, $args);
  
  $ret = array();
  while ($row = nextRow($result)) {
    array_push($ret, $row[0]);
  }

  closeDB($conn);
  return $ret;

} catch (Exception $e) {
  error("myGames: {$e}");
  closeDB($conn);
  return false;
}
}
?>
