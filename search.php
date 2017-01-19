<?php
    include_once "common/base.php";

    if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])
        && $_SESSION['LoggedIn']==1):
        
        include_once "common/header.php";

    

?>

    <body>
        <br>
        <br>
        <?php
            include_once "inc/class.userInteractions.inc.php";

            if(($_SERVER['REQUEST_METHOD'] == 'GET') && (isset($_GET['srch-term'])) && (preg_match("/^[A-Z  | a-z]+/", $_GET['srch-term'])))
            {
                $srch_term = $_GET['srch-term'];
                $search_results = new echoheartInteractions($db);
                $search_results->search($srch_term);
            }    
            else
            {
                echo "<p>Please enter a valid search query</p>";    
            }
    
        ?>



    </body>

    <?php 
    include_once "common/footer.php";

    else:
        header("Location: index.php"); 
        exit();
    endif;
?>