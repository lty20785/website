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
        
        $connstr = "host=dbsrv1 dbname=csc309g9 user=csc309g9 password=ohs7ohd4";
        $conn = pg_connect($connstr);

        $action = htmlspecialchars($_POST["action"]);
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);
        $passwordAlt = htmlspecialchars($_POST["password2"]);
        $email = htmlspecialchars($_POST["email"]);


        $loginSuccess = false;

        if ($action == "signup") {
            /* check that passwords match */
            if ($password != $passwordAlt) {
                $error = "Passwords do not match";
            } else {

                /* Attempt to create new username and password in database */
                $args = array($username, $password, $email);
                $sql = <<<SQL
                INSERT INTO WebUser (userName, password, emailaddress)
                VALUES ($1, $2, $3);
SQL;

                $result = pg_query_params($conn, $sql, $args);

                if (pg_affected_rows($result) != 1) {
                    /* User creation failed, set error message */
                    $error = "Username already in use.  Please pick another.";
                }
            }
            $this->send_welcome_email($username, $email);
        }

        /* Now we retrieve the user's information.
        If they just signed up, this will still work. */
        if (!$error) {
            $args = array($username, $password);
            
            $sql = <<<SQL
            SELECT userID, firstname, active, admin
            FROM WebUser
            WHERE userName=$1
                AND password=$2;
SQL;

            $result = pg_query_params($conn, $sql, $args);

            if (pg_num_rows($result) != 1) {
                /* Login failed, redirect to splash page */
                $num = pg_num_rows($result);
                $error = "Incorrect username and password combination.";

            } else {
                /* If success, logged in */
                $loginSuccess = true;
                $userRow = pg_fetch_row($result);

                $userid = $userRow[0];
                $firstname = $userRow[1];
                $active = $userRow[2];
                $admin = $userRow[3];

                if ($active == "f") {
                    $error = "You're banned!";
                    $loginSuccess = false;
                }
                
                $this->logout();
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['userId'] = $userid;
                
            }
        }


        if ($loginSuccess) return TRUE;
        else return FALSE;


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
        
        $connstr = "host=dbsrv1 dbname=csc309g9 user=csc309g9 password=ohs7ohd4";
        $conn = pg_connect($connstr);
        $username = htmlspecialchars($_POST["username"]);
        $email = htmlspecialchars($_POST["email"]);
        
        $query = "select password from webuser where username='$username' and 
        emailaddress='$email';";
        echo $query;
        
        $result = pg_query($query);
        
        if(pg_num_rows($result)!=1)
        {
            echo "Wrong username and email combination!";
            return FALSE;
        }
        
        $entry = pg_fetch_assoc($result);
        $pwd = $entry['password'];
        echo $pwd;
        
        return $this->send_forgotten_pwd($username, $pwd, $email);
        
        
    }
    
    function change_pwd()
    {
        //change the password, need OldPwd to match with the original password
        
        $OldPwd = htmlspecialchars($_POST['OldPwd']);
        $NewPwd1 = htmlspecialchars($_POST['NewPwd1']);
        $NewPwd2 = htmlspecialchars($_POST['NewPwd2']);
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
        
        return TRUE;
    }
    
    
    
    
}




?>