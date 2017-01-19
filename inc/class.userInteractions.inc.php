<?php
include_once "constants.inc.php";
/* Handles user interactions within the website */

class echoheartInteractions
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
            $this->_db = new PDO($dsn, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }
    }
    
    public function search($search_term)
    {
        
        // tambien following o no
        $sql = "SELECT user_id, first_name, last_name, email
                FROM users
                WHERE first_name LIKE :srch_trm 
                OR last_name LIKE :srch_trm
                OR email LIKE :srch_trm";
        
        $stmt = $this->_db->prepare($sql);
        $stmt->bindValue(':srch_trm', '%' . $search_term . '%', PDO::PARAM_STR);
        //$stmt->bindParam(':srch_trm', $search_term, PDO::PARAM_STR);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0)
        {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $iterator = new IteratorIterator($stmt);
            
            foreach ($iterator as $row) 
            {
                $s_user_id = $row['user_id'];
                $s_first_name = $row['first_name'];
                $s_last_name = $row['last_name'];
                $s_email = $row['email'];
                
                include("results_stream.php");
                /*echo "<p>" . $s_user_id . " " . $s_first_name . " " . $s_last_name . " " . $s_email . "</p>";*/
            }
        }
        else
        {
            echo "No results were found. Try again with a different query.";
        }
    }
}
?>