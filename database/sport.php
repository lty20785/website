<?php

require_once 'dbinterface.php';


/* Get a list of all sports and ids */
function getAllSports() {
try {

  if (!$conn = connectDB()) {
    return false;
  }

  $args = array();
  $sql = <<<SQL
SELECT sportID, sportName
FROM Sport
SQL;

  $result = executeSQL($conn, $sql, $args);
  
  $ret = array();
  while ($row = nextRow($result)) {
      array_push($ret, array(
        "sportId" => $row[0],
        "sportName" => $row[1],
      ));
  }

  return $ret;

} catch (Exception $e) {
  error("getAllSports: {$e}");
  closeDB($conn);
  return false;
}
}


/* Get a sport name by id */
function getSportName($sportId) {
  $sports = getAllSports();

  foreach($sports as $sport) {
    if ($sport["sportId"] == $sportId) {
      return $sport["sportName"];
    }
  }

  return false;
}


/* Get an id by sport name */
function getSportId($sportName) {
  $sports = getAllSports();

  foreach($sports as $sport) {
    if ($sport["sportName"] == $sportName) {
      return $sport["sportId"];
    }
  }

  return false;
}


/* Add a new sport */
function addSport($sportName) {
try {

  if (!$conn = connectDB()) {
    return false;
  }

  $args = array($sportName);
  $sql = <<<SQL
INSERT INTO Sport (sportName)
SELECT $1
WHERE NOT EXISTS (SELECT * FROM Sport WHERE sportName=$1)
RETURNING sportID;
SQL;

  $result = executeSQL($conn, $sql, $args);
  if (getUpdateCount($result) != 1) {
    closeDB($conn);
    return false;
  }

  $row = nextRow($result);
  $sportId = $row[0];

  closeDB($conn);
  return $sportId;

} catch (Exception $e) {
  error("addSport: {$e}");
  closeDB($conn);
  return false;
}
}


/* Delete a sport */
function deleteSport($sportId) {
try {

  if (!$conn = connectDB()) {
    return false;
  }

  $args = array($sportId);
  $sql = <<<SQL
DELETE FROM Sport
WHERE sportID=$1;
SQL;

  $result = executeSQL($conn, $sql, $args);
  if (getUpdateCount($result) != 1) {
    closeDB($conn);
    return false;
  }

  closeDB($conn);
  return true;

} catch (Exception $e) {
  error("deleteSport: {$e}");
  closeDB($conn);
  return false;
}
}

?>
