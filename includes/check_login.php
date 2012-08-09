<?php
//check, at the start of each page whether the user is still logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['userId']))
{
    
    header("Location: ../need_login.html");
}
?>
