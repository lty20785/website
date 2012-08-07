<?php
session_start();
include_once 'includes/check_login.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="stylesheets/common.css" type="text/css" />
        <link rel="stylesheet" href="stylesheets/main.css" type="text/css" />

        <title>Password successfully changed</title>
    </head>
    <body>
        <?php
        $header="Password changed";
        include 'includes/header.php';

        $addr="organise.php";
        include 'includes/nav.php';
        ?>
    </body>
</html>
