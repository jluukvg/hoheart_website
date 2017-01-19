<?php
    include_once "common/base.php";
    include_once "inc/class.users.inc.php";
    
    $userObj = new dedaloUsers($db);

    if(!empty($_POST['action']) && isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn']==1)
    {
        switch($_POST['action'])
        {
            case 'changeBasicInfo':
                $status = $userObj->updateBasicInfo() ? "changed" : "failed";
                header("Location: user_account.php?basicinfostatus=$status");
                break;
            case 'changepassword':
                $status = $userObj->updatePassword();
                switch($status)
                {
                    case "1":
                        header("Location: user_account.php?password=wrongpass");
                        break;
                    case "2":
                        header("Location: user_account.php?password=nomatch");
                        break;
                    case "3":
                        header("Location: user_account.php?password=dberror");
                        break;
                    case "4":
                        echo "<div class='message good'>Your password " . "has been changed.</div>";
                        exit;
                        header("Location: user_account.php?password=changed");
                        break;
                }
            case 'changeProfilePic':
                $status =  $userObj->uploadProfilePic() ? "changed" : "failed";
                header("Location: user_account.php?profilepicstatus=$status");;
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
        header("Location: user_account.php");
        exit;
    }
    
?>