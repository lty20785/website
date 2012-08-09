<?php
require_once("includes/class.phpmailer.php");

class user_functions
{
    function user_functions()
    {
        //init 
        $this->sitename = "pickupgame website";
        $this->randomkey = "joiaw4j90a5h";
        $this->from_addr = "admin@HighPickupGame";
    }
    function user_authentification()
    {
        //authenticate the user, if the user is signing up, automatically log in afterwards 
        include_once 'database/session.php';
        
        $userId=false;
        $action = htmlspecialchars($_POST["action"]);
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);
        $passwordAlt = htmlspecialchars($_POST["password2"]);
        $email = htmlspecialchars($_POST["email"]);


        if ($action == "login") {
          $userId = login($username, $password);

          if ($userId) {
            $_SESSION['userId'] = $userId;
            $_SESSION['username'] = $username;
            return array();
          }

          // Failed to login
          return array(
            "where" => "login",
            "msg" => "Incorrect username or password.",
          );

        } elseif ($action == "signup") {
            /* check that passwords match */
          if ($password != $passwordAlt) {
            return array(
              "where" => "signup",
              "msg" => "Password do not match.",
            );
          }

          /* Attempt to create new username and password in database, 
           * then automatically log in */
          $userId = signup($username, $password, $email);

          if (!$userId) {
            return array(
              "where" => "signup",
              "msg" => "Username is already in use.",
            );
          }
            
          $_SESSION['username'] = $username;
          $_SESSION['userId'] = $userId;
          $this->send_welcome_email($username, $email);

          return array();
        }

    }
    
    public function logout()
    {
        //log out function, simply destroy the session
        session_unset();
        session_destroy();    
    }
    
    public function forgot_pwd()
    {
        //send the password to the user's email address as long as the user 
        //provided the correct combination of user name and email address

        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);

        require_once 'database/profile.php';
        require_once 'database/session.php';

        $usernameId = getUserId($username);
        if (!$usernameId) {
          return "Username does not exist.";
        }

        $userInfo = getProfile($usernameId);
        if ($userInfo["email"] != $email) {
          return "Email doesn't match the one we have on file.";
        }

        $password = getPassword($userId);
        return $this->send_forgotten_pwd($username, $password, $email);
       
    }
    
    function change_pwd()
    {
        //change the password, need OldPwd to match with the original password
        include 'database/session.php';
        $OldPwd = htmlspecialchars($_POST['OldPwd']);
        $NewPwd1 = htmlspecialchars($_POST['NewPwd1']);
        $NewPwd2 = htmlspecialchars($_POST['NewPwd2']);
        
        if ($NewPwd1!=$NewPwd2) return false;
           
        return(changePassword($OldPwd, $NewPwd1));
    }
    
    private function send_welcome_email($username, $user_email)
    {
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($user_email, $username);
        
        $mailer->Subject = "Hello, ".$username."! Welcome to the Pickup Game Website";

        $mailer->From = $this->from_addr;        
        
        $mailer->Body ="Hello ".$username.",\r\n\r\n".
        "Welcome! Your registration is completed.\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n";

        if(!$mailer->Send())
        {
            echo "Sending Welcome message failed";
            return FALSE;
        }
    }

    private function send_forgotten_pwd($username, $pwd, $email) 
    {
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email, $username);
        
        $mailer->Subject = "Hello, ".$username."! Here's your forgotten password
            at the Pickup Game Website";

        $mailer->From = $this->from_addr;        
        
        $mailer->Body ="Hello ".$username.",\r\n\r\n".
        "This is your password: ".$pwd."\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n";

        if(!$mailer->Send())
        {
            echo "Sending Welcome message failed";
            return FALSE;
        }
        
        return false;
    }
    
    
    
    
}




?>
