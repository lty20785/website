<?php

require_once 'dbinterface.php';
require_once 'database/profile.php';



function getTotalUsers() {
try {

  if (!isAdmin()) {
    return false;
  }

  if (!$conn = connectDB()) {
    return false;
  }

  $args = array();
  $sql = <<<SQL
SELECT COUNT(*)
FROM WebUser;
SQL;

  $result = executeSQL($conn, $sql, $args);
  $row = nextRow($result);
  $users = $row[0];

  closeDB($conn);
  return $users;

} catch (Exception $e) {
  error("getTotalUsers: {$e}");
  closeDB($conn);
  return false;
}
}

function getTotalGames() {
try {

  if (!isAdmin()) {
    return false;
  }

  if (!$conn = connectDB()) {
    return false;
  }

  $args = array();
  $sql = <<<SQL
SELECT COUNT(*), SUM(CASE WHEN date>=current_timestamp THEN 1 ELSE 0 END)
FROM Game;
SQL;

  $result = executeSQL($conn, $sql, $args);
  $row = nextRow($result);
  $ret = array(
    "totalGames" => $row[0],
    "openGames" => $row[1],
  );

  closeDB($conn);
  return $ret;


} catch (Exception $e) {
  error("getTotalUsers: {$e}");
  closeDB($conn);
  return false;
}
}



function getTotalFriendships() {
try {

  if (!isAdmin()) {
    return false;
  }

  if (!$conn = connectDB()) {
    return false;
  }

  $args = array();
  $sql = <<<SQL
SELECT COUNT(*)
FROM Friend;
SQL;

  $results = executeSQL($conn, $sql, $args);
  $row = nextRow($results);
  $friendships = $row[0];

  closeDB($conn);
  return $friendships;

} catch (Exception $e) {
  error("getTotalUsers: {$e}");
  closeDB($conn);
  return false;
}
}

function getUsersNoFriends() {
try {

  if (!isAdmin()) {
    return false;
  }

  if (!$conn = connectDB()) {
    return false;
  }

  $args = array();
  $sql = <<<SQL
SELECT COUNT(*)
FROM WebUser AS wu
LEFT OUTER JOIN Friend AS f
    ON wu.userID IN (f.userID1, f.userID2)
WHERE f.userID1 IS NULL AND f.userID2 IS NULL;
SQL;

  $result = executeSQL($conn, $sql, $args);
  $row = nextRow($result);
  $lonelies = $row[0];

  closeDB($conn);
  return $lonelies;

} catch (Exception $e) {
  error("getTotalUsers: {$e}");
  closeDB($conn);
  return false;
}
}


?>
