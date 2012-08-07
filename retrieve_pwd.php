<?php
//if the form has been submitted, then try to send the password to the user
       if(isset($_POST['submit']))
       {
           require_once("includes/user_system.php");
           $uf = new user_functions();
           if($uf->forgot_pwd())
           {
               header("Location: pwd_sent.php");
           }else{
               echo "Incorrect username or email! Please try again. ";
           }
       }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        
        <div id="retrieve_pwd">
        <h4>Retrieve Your Password</h4>
        <form name="retrieve_pwd" action="retrieve_pwd.php" method="post">
        User name: <input type="text" name="username" placeholder="User name" class="vUsername"/><br />
        Email: <input type="email" name="email" placeholder="Email" class="vEmail" /><br />
        <input type="submit" name ="submit" value="retrieve password" />
        </form>
        </div>
        
       
    </body>
</html>