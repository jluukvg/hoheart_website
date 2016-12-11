<?php
    include_once "common/base.php";
    include_once "inc/class.users.inc.php";
    
    $userObj = new dedaloUsers($db);

    if(!empty($_POST['action']) && isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn']==1)
    {
        switch($_POST['action'])
        {
            case 'changeemail':
                $status = $userObj->updateEmail() ? "changed" : "failed";
                header("Location: /user_account.php?email=$status");
                break;
            case 'changepassword':
                $status = $userObj->updatePassword() ? "changed" : "nomatch";
                header("Location: /user_account.php?password=$status");
                break;
            case 'deleteaccount':
                $userObj->deleteAccount();
                break;
            default:
                header("Location: /");
                break;
        }
    }
    else
    {
        echo "WHAT THE HELL??";
        /*header("Location: /");
        exit;*/
    }
    
?>