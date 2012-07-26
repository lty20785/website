<?php
/**
 * Description of user_interaction
 *
 * @author lty
 */

class user_interaction {
    
    function user_interaction()
    {
        
    }
    
    function get_game_full_info()
    {
        if(!isset($_GET['gameid']))
        {
            echo "No game id specified, you can go to the
                <a href='search.php'>search</a> page.";
            return FALSE;
        }
        
        $gameid = trim(htmlspecialchars($_GET['gameid']));
        
    }
}

?>
