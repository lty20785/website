
<div class="friend">
<span class="username">
    <?php
    include '../database/profile.php';
    $frd_detail=getProfile($frdId);
    
    echo "Friend's name: ".$frd_detail['firstName']." ".$frd_detail['lastName']."<br/>";
    echo "Location: ". $frd_detail['location']."<br/>";
    echo $frd_detail['firstName']."'s profile is ";
    echo "<a href='../profile.php?userid=$frdId' >here</a><br/><br/>";


    ?>
</span>
<div class="frienddetails">

</div>

</div>

