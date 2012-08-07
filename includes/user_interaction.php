<?php
/**
 * Description of user_interaction
 *
 * @author lty
 */

class user_interaction {
    
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
        
        $this->gameid = trim(htmlspecialchars($_GET['gameid']));
         
         */
    }
    
    
    function get_game_info()
    {
        /*
         * list the information about this game, including location, date,...etc
         */
        
    }
    
    function get_game_participants()
    {
        /* 
         * list all users who have joined this game 
         */
        
    }
    
    function has_joined()
    {
        /* 
         * return true if the user has joined this game, otherwise false
         */
        
        return TRUE;
        
    }
    
    function is_creater()
    {
        /*
         * return true if the user is the creater of this game, otherwise false
         */
        
        return FALSE;
    }
    
    function create_game()
    {
        /* create a game, if succesed, return the game id of the newly created.
         * otherwise, return FALSE
         */
        
        
    }
    
    function change_description()
    {
        /* 
         * change the description of a game, the user must be the creater
         */
        
        
    }
    
    function rate_players()
    {
        
    }
    
    function rate_organizer()
    {
        
    }
    
}

?>
