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
    
/*    public function loadPostsByTopic()
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
            }
            $stmt->closeCursor();
        }
        else
        {
            echo "tttt<li> Something went wrong with the database. ", $db->errorInfo, "</li>n";
        }
        
        return array($UID, $MID, $MESS, $URL, $PT);
    }*/
    
    public function loadPostsByTopic()
    {
        try {
                
                echo $_GET['topic'];
                $topic = $_GET['topic'];
                
                // Find out how many items are in the table
                $row_count_sql = "SELECT COUNT(message_id) FROM posts WHERE topic_id=:topic AND message IS NOT NULL";
            
                $stmt = $this->_db->prepare($row_count_sql);
            
                $stmt->bindParam(':topic', $topic, PDO::PARAM_INT);
            
                $stmt->execute();
            
                $row_count = $stmt->fetchColumn(0);
            
                echo "total:$row_count";
                
                // How many items to list per page
                $limit = 10;
                echo " limit:$limit";
                
                // How many pages will there be
                $pages = ceil($row_count / $limit);
                echo " pages:$pages";
            
                // What page are we currently on?
                $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array('options' => array('default' => 1, 'min_range' => 1,),)));
                echo " page:$page";
            
                // Calculate the offset for the query
                $offset = ($page - 1)  * $limit;
                echo " offset:$offset";
            
                // Some information to display to the user
                $start = $offset + 1;
                $end = min(($offset + $limit), $row_count);
                echo " start:$start end:$end";
            
                // The "back" link
                $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

                // The "forward" link
                $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

                
                
                // Prepare the paged query
                $sql = "SELECT message_id, user_id, media_id, message, link_url, post_time
                FROM posts
                WHERE topic_id=:topic AND message IS NOT NULL
                ORDER BY post_time DESC
                LIMIT :limit
                OFFSET :offset";    
            
                $stmt2 = $this->_db->prepare($sql);
            
                // Bind the query params
                $stmt2->bindParam(':topic', $_GET['topic'], PDO::PARAM_STR);
                $stmt2->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt2->bindParam(':offset', $offset, PDO::PARAM_INT);
                $stmt2->execute();
            
                // Do we have any results?
                if ($stmt2->rowCount() > 0) {
                    // Define how we want to fetch the results
                    $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                    $iterator = new IteratorIterator($stmt2);

                    // Display the results
                    foreach ($iterator as $row) {
                        //echo '<p>', $row['message_id'], $row['message'], '</p>';
                        echo '<p>', $row['user_id'], ' ', $row['post_time'], ' ', $row['message'], ' ', $row['link_url'], '</p>';  
                    }

                } else {
                    echo '<p>No results could be displayed.</p>';
                }
    
            // Display the paging information
            echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $row_count, ' results ', $nextlink, ' </p></div>';
        
        } catch (Exception $e) {
            echo '<p>', $e->getMessage(), '</p>';
        }   
    }
}
    
    


