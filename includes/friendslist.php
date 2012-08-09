
<div class="friends">
<ul>

<?php
include_once 'database/friends.php';
include_once 'database/profile.php';

//get the list of friends' uid
$frd_list= getFriends();
$frdId=-1;

//iterate over each userid and display the info
foreach ($frd_list as $frd)
{
    $frdId=$frd;
    include 'includes/friend.php';
}



?>

</ul>
</div>

