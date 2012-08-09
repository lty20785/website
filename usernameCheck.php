<?php

require_once 'database/profile.php';

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Sat, Jan 1, 2000 00:00:00 GMT');
header('Content-type: application/json');

if (isset($_GET['username'])) {
  $username = htmlspecialchars($_GET['username']);
  $avail = !getUserId($username);

  $ret = array(
    "username" => $username,
    "available" => $avail,
  );

  echo json_encode($ret);

}

?>
