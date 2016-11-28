<?php
    include_once "common/base.php";
 
    if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])
        && $_SESSION['LoggedIn']==1):
        
        include_once "common/header.php";

        include_once 'inc/class.posts.inc.php';
        $posts = new hoheartPosts($db);

        if (isset($_GET['topic'])):
            $posts_array = $posts->loadPostsByTopic();
        elseif (isset($_GET['media'])):
            $posts_array = $posts->loadPostsByMedia();
        endif;

?>
    <script src="post_window.js">
    </script>

    </body>

    <?php    
        include_once "common/footer.php";

        else:
            header("Location: index.php"); 
            exit();
        endif;
?>