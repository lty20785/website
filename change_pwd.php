<?php 
session_start(); 
include_once 'includes/check_login.php';

//if the form has been submitted, then try to change the password
if (isset($_POST['submit']))
{
    require_once("includes/user_system.php");
    $uf = new user_functions();
    if($uf->change_pwd())
    {
        header("Location: pwd_changed.php");
    }else{
        echo "Failed to change password! Please try again. ";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Change your password</title>
    </head>
    <body>
        
        <h1>Change Password</h1><br/>
        
        <form name="changePwd" action="change_pwd.php" method="post">
        Old Password: <input type="password" name="oldPwd" placeholder="Old Password" class="vPassword1" /><br />
        New Password: <input type="password" name="NewPwd1" placeholder="New Password" class="vPassword1" /><br />
        Repeat new password: <input type="password" name="NewPwd2" placeholder="repear new password" class = "vPassword2" /><br />
        
        <input type="submit" name="submit" value="change my password" />
        </form>
        
        <h4> Changed your mind? go back to the main page <a href="main.php">here</a>.</h4>
    </body>
</html>
