<?php

if (!isset($_SESSION['username']) || !isset($_SESSION['userId']))
{
    
    header("Location: ../need_login.html");
}
?>
