<?php

include '../database/friends.php';

/* Test making and getting */
function testFriends($activeId, $userId) {


  /* Did it stick? */
  $friends = getFriends($userId);
  if (!$friends) {
    echo "testFriends--Failed to get friends.\n";
    return false;
  }
  if (!in_array($activeId, $friends)) {
    echo "testFriends--Befriending failed to stick.\n";
    return false;
  }

  return true;
}


/* Test rating */
function testRating_Friends($activeId, $userId) {

  $oldRating = getRating($userId, $activeId);
  if ($oldRating === false) {
    echo "testRating_Friends--Failed to get rating.\n";
    return false;
  }

  if ($oldRating === null) {
    $oldRating = 0;
  }

  /* Invalid rating */
  if (ratePlayer($userId, +2, 20)) {
    echo "testRating_Friends--Allowed an invalid rating.\n";
    return false;
  }

  return true;
}


function testRating_unFriends($activeId, $userId) {
  if (getRating($userId, $activeId) !== null) {
    echo "TestRating_unFriends--Rating not deleted when not friends.\n";
    return false;
  }

  if (ratePlayer($userId, +1, 20)) {
    echo "testRating_unFriends--Allowed to rate non-friend.\n";
    return false;
  }
  return true;
}

/* Clean up*/
function testUnfriend($activeId, $userId) {

  if (!unFriend($activeId, $userId)) {
    echo "testUnfriend--Failed to un-friend.\n";
    return false;
  }

  if (areFriends($activeId, $userId)) {
    echo "testUnfriend--Incorrectly reported that they are friends.\n";
    return false;
  }

  return true;
}



$_SESSION['userId'] = 1;


if (testFriends(1, 2)) {
  echo "testFriends--All passed.\n";
}

if (testRating_Friends(1, 2)) {
  echo "testRating_Friends--All passed.\n";
}

if (testUnfriend(1, 2)) {
  echo "testUnfriend--All passed.\n";
}

if (testRating_unFriends(1, 2)) {
  echo "testRating_unFriends--All passed.\n";
}

?>
