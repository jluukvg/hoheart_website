<?php
include_once "constants.inc.php";
/* Handles post interactions within the website */

class hoheartPosts
{
    private $_db;

    public function __construct($db=NULL)
    {
        if(is_object($db))
        {
            $this->_db = $db;
        }
        else
        {
            $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
            $this->_db = new PDO($dsn, DB_USER, DB_PASS);
        }
    }
    
    public function loadPostsByTopic()
    {
        $posts_array = array();
        $temp_array = array();
        
        
        $sql = "SELECT message_id, user_id, media_id, message, link_url, post_time
                FROM posts
                WHERE topic_id=:topic
                ORDER BY post_time";
        
        if($stmt = $this->_db->prepare($sql))
        {
            $stmt->bindParam(':topic', $_GET['topic'], PDO::PARAM_STR);
            $stmt->execute();
            
            while($row = $stmt->fetch())
            {
                echo "ESTOY EN UNA LOOP!";
                $MESSID = $row['message_id'];
                $UID = $row['user_id'];
                $MID = $row['media_id'];
                $MESS = $row['message'];
                $URL = $row['link_url'];
                $PT = $row['post_time'];
                
                /*list($MESSID, $UID, $MID, $MESS, $URL, $PT) = $temp_array;
                
                print_r($temp_array);
                
                array_push($posts_array, $temp_array);*/
            }
            $stmt->closeCursor();
        }
        else
        {
            echo "tttt<li> Something went wrong with the database. ", $db->errorInfo, "</li>n";
        }
        
        return array($UID, $MID, $MESS, $URL, $PT);
        //return $posts_array;
    }
}
    


