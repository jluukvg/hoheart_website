<?php
  include_once "common/base.php";

  if(isset($_GET['v']) && isset($_GET['e']))
  {
    include_once "inc/class.users.inc.php";
    $users = new dedaloUsers($db);
    $ret = $users->verifyAccount();
    print_r($_SESSION);
    header("Location: home.php");
  }
  elseif(isset($_POST['v']))
  {
    include_once "inc/class.users.inc.php";
    $users = new dedaloUsers($db);
    $ret = $users->updatePassword();
  }
  else
  {
    header("Location: index.php");
  }
  
  if(isset($ret[0]))
    echo isset($ret[1]) ? $ret[1] : NULL; 
 ?>
