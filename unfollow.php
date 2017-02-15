<?php
    
    include_once "common/base.php";
    $f_user_id = trim($_POST['f_user_id']);
    $user_id = trim($_POST['user_id']);

    include_once 'inc/class.userInteractions.inc.php';

    $interaction = new echoheartInteractions($db);
    $interaction->unfollow($user_id, $f_user_id);

?>