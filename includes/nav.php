<?php

require_once 'database/profile.php';

$isAdmin = isAdmin();

?>

<nav>
<ul>
<li><a href="main.php">Main</a></li>
<li><a href="organise.php">Organize a Game</a></li>
<li><a href="search.php">Search</a></li>

<?php

echo <<<HTML1
<li><a href="friends.php?userid={$_SESSION['userId']}">Friends</a></li>
<li><a href="profile.php?userid={$_SESSION['userId']}">Edit Profile</a></li>
HTML1;

if ($isAdmin) {
  echo <<<HTML2
<li><a href="admin.php">Admin</a></li>
HTML2;

}

?>

<li><a href="logout.php">Logout</a></li>
</ul>
</nav>

