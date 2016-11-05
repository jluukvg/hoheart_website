<?php
    include_once "common/base.php";
    include_once "common/header.php";
?>

    <!--<p>You are currently <strong>logged in.</strong></p>-->

    <?php
    if(!empty($_POST['email']) && !empty($_POST['password'])):
        include_once 'inc/class.users.inc.php';
        $users = new dedaloUsers($db);
        if($users->accountLogin()===TRUE):
            header("Location: home.php");
            exit;
        else:
            echo "login failed";
        endif;
    
    else:   // En caso de dejar en blanco el E-mail o el password
?>
        <meta http-equiv="refresh" content="0;index.php">

        <?php
    endif;
?>
