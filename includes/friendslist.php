
<div class="friends">
<ul>

<?php
include 'database/friends.php';
include 'database/profile.php';

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

