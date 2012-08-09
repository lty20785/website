
<div class="friends">
<ul>

<?php
include_once 'database/friends.php';
include_once 'database/profile.php';

$frd_list= getFriends();
$frdId=-1;

foreach ($frd_list as $frd)
{
    $frdId=$frd;
    include 'includes/friend.php';
}



?>

</ul>
</div>

