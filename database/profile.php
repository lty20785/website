<?php

require_once 'dbinterface.php';


/* Retrieve a user's profile info */
function getProfile($viewUserId) {
try {
  if (!$conn = connectDB()) {
    return false;
  }

  $args = array($viewUserId);
  $sql = <<<SQL
SELECT userName, firstName, lastName, phoneNumber, emailAddress, location
FROM WebUser
WHERE userID=$1;
SQL;

  $result = executeSQL($conn, $sql, $args);

  if (getResultCount($result) != 1) {
    /* UserID does not exist */
    closeDB($conn);
    return -1;
  }

  $row = nextRow($result);
  $ret = array(
    "username" => $row[0],
    "firstName" => $row[1],
    "lastName" => $row[2],
    "phone" => $row[3],
    "email" => $row[4],
    "location" => $row[5],
  );

  closeDB($conn);
  return $ret;

} catch (Exception $e) {
  error("getProfile: {$e}");
  closeDB($conn);
  return -2;
}
}


/* Update a user's profle */
function updateProfile($data) {
try {

  if (!$conn = connectDB()) {
    return false;
  }

  $userId = $_SESSION["userId"];
  $args = array(
    $data["firstName"], $data["lastName"],
    $data["phone"], $data["email"], $data["location"],
    $userId
  );

  $sql = <<<SQL
UPDATE WebUser
SET firstName=$1, lastName=$2,
    phonenumber=$3, emailaddress=$4, location=$5
WHERE userId=$6
SQL;

  $result = executeSQL($conn, $sql, $args);

  if (getUpdateCount($result) != 1) {
    /* Update was unsuccessful */
    closeDB($conn);
    return false;
  }

  /* Update succeeded */
  closeDB($conn);
  return true;

} catch (Exception $e) {
  error("updateProfile");
  closeDB($conn);
  return false;
}
}


/* Get just a username */
function getUserName($userId) {
  $profile = getProfile($userId);
  if (!$profile) {
    return false;
  }

  return $profile["username"];
}

/* Return true if $userId is the admin.  Default's for current user. */
function isAdmin($userId = null) {
try {

  if (!$conn = connectDB()) {
    return false;
  }

  // Default to current user
  if (!isset($userId)) {
    $userId = $_SESSION['userId'];
  }

  // Still not set?  Error
  if (!isset($userId)) {
    return false;
  }

  $args = array($userId);
  $sql = <<<SQL
SELECT *
FROM WebUser
WHERE userID=$1
    AND admin=true;
SQL;

  $result = executeSQL($ocnn, $sql, $args);
  if (getResultCount($result) == 1) {
    closeDB($conn);
    return true;
  }

  closeDB($conn);
  return false;

} catch (Exception $e) {
  error("isAdmin: {$e}");
  closeDB($conn);
  return false;
}
}

?>
