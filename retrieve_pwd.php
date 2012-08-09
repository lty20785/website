<?php
//if the form has been submitted, then try to send the password to the user
       if(isset($_POST['submit']))
       {
           require_once("includes/user_system.php");

           $uf = new user_functions();
           $error = $uf->forgot_pwd();
           if(!$error)
           {
               header("Location: pwd_sent.php");
           }
       }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <link rel="stylesheet" href="stylesheets/common.css" type="text/css" />
        <title>Password Recovery</title>
    </head>
    <body>
        
        <div id="retrieve_pwd">
        <h2>Retrieve Your Password</h2>
<?php
if ($error) {
  echo "<p class='errmsg'>{$error}</p>";
}
?>
        <form name="retrieve_pwd" action="retrieve_pwd.php" method="post">
        User name: <input type="text" name="username" placeholder="User name" class="vUsername"/><br />
        Email: <input type="email" name="email" placeholder="Email" class="vEmail" /><br />
        <input type="submit" name ="submit" value="Retrieve password" />
        </form>
        </div>
        
       
    </body>
</html>
