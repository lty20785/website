<?php
/**
 * Description of user_interaction
 *
 * @author lty
 */

require_once 'database/game.php';
require_once 'database/comment.php';
require_once 'database/friends.php';

class user_interaction {
    
    public $gameid;
    public $ispast;
    public $isparticipant;
    public $userid;
    
    function user_interaction()
    {
        /*
         * set the gameid of this instance
         *
        if(!isset($_GET['gameid']) && !is_numeric($_GET['gameid']))
        {
            echo "No game id specified, you can go to the
                <a href='search.php'>search</a> page.";
            return FALSE;
        }
        */
        
        $this->userid = $_SESSION['userId']; 
        $this->gameid = trim(htmlspecialchars($_GET['gameid']));
        $this->ispast = isGamePast($this->gameid);
        $this->isparticipant = hasJoined($this->userid, $this->gameid, true);

        if ($this->ispast === null) {
          $this->gameid = null;
        }


    }
    
    
    function get_game_info()
    {
        /*
         * list the information about this game, including location, date,...etc
         */

         return getGameInfo($this->gameid);
        
    }
    
    function get_game_participants()
    {
        /* 
         * list all users who have joined this game 
         */

         return getParticipants($this->gameid);
        
    }

    function get_gameid()
    {
        /*
         * Get the gameid for this game
         */

        return $this->gameid;

    }

    function join_game()
    {
        /*
         * Join the game
         */
        
        return joinGame($this->gameid);
    }

    function leave_game()
    {
        /*
         * Leave the game
         */

        return leaveGame($this->gameid);

    }
    
    function has_joined()
    {
        /* 
         * return true if the user has joined this game, otherwise false
         */
        
        return hasJoined($this->userid, $this->gameid);
        
    }
    
    function is_creator()
    {
        /*
         * return true if the user is the creater of this game, otherwise false
         */
        
        return isOrganiser($this->userid, $this->gameid);
    }
    
    function create_game()
    {
        /* create a game, if succesed, return the game id of the newly created.
         * otherwise, return FALSE
         */
        
        $sportId = htmlspecialchars($_POST['sport']);
        $location = htmlspecialchars($_POST['location']);
        $date = new DateTime(htmlspecialchars($_POST['date']));
        $time = htmlspecialchars($_POST['time']);
        $privacy = 'public';  # Disabled for now;
        $description = htmlspecialchars($_POST['description']);
        
        $gameInfo = array(
          "sportId" => $sportId,
          "location" => $location,
          "date" => $date->format("Y-m-d"),
          "time" => $time,
          "privacy" => $privacy,
          "description" => $description,
        );

        return createGame($gameInfo);
    }

    function update_details()
    {
        /*
         * Update a game's info
         */

        $date = new DateTime(htmlspecialchars($_POST['date']));

        $gameInfo = array(
          "location" => htmlspecialchars($_POST['location']),
          "date" => $date->format("Y-m-d"),
          "time" => htmlspecialchars($_POST['time']),
          "privacy" => "public", // Not enabled just now
          "description" => htmlspecialchars($_POST['description']),
        );

        return setGameInfo($this->gameid, $gameInfo);

    }
    
    function cancel_game()
    {
        /*
         * Cancel a game
         */

        cancelGame($this->gameid);

    }
    
    function can_rate($ratee = null)
    {
        if (!$this->ispast
            or !$this->isparticipant
            or alreadyRated($this->userid, $this->gameid)
            or $this->userid == $ratee) {
          return false;
        }
        
        return true;
    }


    function rate_player($userId, $rating)
    {
        return ratePlayer($userId, $rating, $this->gameid);
    }
    
    
    function invite_players()
    {
        //for any game, send invitations to the players listed in $_POST
        //the invitations will be sent via email
        
    }
    
    function suggest_games()
    {
        //for any user, send suggestion of games to the user
        //the invitation will be sent via email
        
    }


    function get_comments()
    {
        /*
         * Get a game's comments
         */

        return getComments($this->gameid);

    }

    function post_comment()
    {
        /*
         * Post a comment
         */

        return commentGame($this->gameid, $_POST['commentText']);

    }
    
}

?>
