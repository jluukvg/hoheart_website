<?php
include_once "constants.inc.php";
/* Handles user interactions within the website */

class dedaloUsers
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

  public function createAccount()
  {
    $u = trim($_POST['first_name']);
    $u2 = trim($_POST['last_name']);
    $u3 = trim($_POST['email']);
    $password = sha1(trim($_POST['password']));
    //$birth_date = trim($_POST['birth_date']);
    // Esto quizá no es la mejor opción. Revisar luego.
    // http://stackoverflow.com/questions/12120433/php-mysql-insert-date-format  
    $dt = \DateTime::createFromFormat('d/m/Y', $_POST['birth_date']);
    $date = $dt->format('Y-m-d');
      
    $gender = trim($_POST['gender']);
    $v = sha1(time());

    $sql = "SELECT COUNT(email) AS theCount
            FROM users
            WHERE email=:email";

    if($stmt = $this->_db->prepare($sql)) {
      $stmt->bindParam(":email", $u3, PDO::PARAM_STR);
      $stmt->execute();
      $row = $stmt->fetch();
      if($row['theCount']!=0){
        return "<h2>Error!!!</h2>"
              . "<p>That Email is already in use.</p>";
      }
      if(!$this->sendVerificationEmail($u, $u2, $u3, $v)) {
        return "<h2>Error!!!</h2>"
              . "<p>A verification Email could not be sent.</p>";
      }
      $stmt->closeCursor();
    }

    $sql = "INSERT INTO users(first_name, last_name, email, password, birth, gender, ver_code)
            VALUES(:first_name, :last_name, :email, :password, :birth, :gender, :ver)";

    if($stmt = $this->_db->prepare($sql)) {
      $stmt->bindParam(":first_name", $u, PDO::PARAM_STR);
      $stmt->bindParam(":last_name", $u2, PDO::PARAM_STR);
      $stmt->bindParam(":email", $u3, PDO::PARAM_STR);
      $stmt->bindParam(":password", $password, PDO::PARAM_STR);
      $stmt->bindParam(":birth", $date, PDO::PARAM_STR);
      $stmt->bindParam(":gender", $gender, PDO::PARAM_STR);
      $stmt->bindParam(":ver", $v, PDO::PARAM_STR);
      $stmt->execute();
      $stmt->closeCursor();

      return "<h2> Success! </h2>"."<p>Your account was successfully created.</p>";
    }
    else {
      return "<h2> Error </h2>"."<p>No account created.</p>";
    }
  }

  private function sendVerificationEmail($first, $last, $email, $ver)
  {
    $e = sha1($email); // For verification purposes
    $to = trim($email);

    $subject = "[dedalo] Please Verify Your Account";

    $headers = <<<MESSAGE
From: Dedalo <donotreply@dedalo.com>
Content-Type: text/plain;
MESSAGE;

    $msg = <<<EMAIL
You have a new account at Dedalo!

To get started, please activate your account and choose a
password by following the link below.

Your Username: $first $last

Activate your account: http://localhost/my_projects/hoheart_website/accountverify.php?v=$ver&e=$e

If you have any questions, please contact help@dedalo.com.


--
Thanks!

www.dedalo.com
EMAIL;

        return mail($to, $subject, $msg, $headers);
  }

  public function verifyAccount()
  {
    $sql = "SELECT email
            FROM users
            WHERE ver_code=:ver
            AND SHA1(email)=:user
            AND verified=0";
      
    if($stmt = $this->_db->prepare($sql))
    {
      $stmt->bindParam(':ver', $_GET['v'], PDO::PARAM_STR);
      $stmt->bindParam(':user', $_GET['e'], PDO::PARAM_STR);
      $stmt->execute();
      $row = $stmt->fetch();
      if(isset($row['email']))
      {
        echo "AAAAAAAAAA";
        // Logs the user in if verification is successful
        $_SESSION['Username'] = $row['email'];
        $_SESSION['LoggedIn'] = 1;
        print_r($_SESSION);
      }
      else
      {
        return array(4, "<h2>Verification Error</h2>"
                     . "<p>This account has already been verified. "
                     . "Did you forget "
                     . "your password?");
      }
      $stmt->closeCursor();

      // No error message is required if verification is successful
      // ESTA SECCION PODRIA SER TRANSFERIDA A LA updatePassword function!
      $sql = "UPDATE users
              SET verified=1, setup_time=NOW()
              WHERE ver_code=:ver
              LIMIT 1";

      try
      {
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(":ver", $_GET['v'], PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();

        return TRUE;
      }
      catch (PDOException $e)
      {
          return FALSE;
      }
      //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!    

      return array(0, NULL);
    }
    else
    {
      return array(2, "<h2>Error</h2>n<p>Database error.</p>");
    }
  }

  public function updatePassword()
  {
      $sql = "SELECT password 
              FROM users 
              WHERE email=:user";
      
      try
      {
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(":user", $_SESSION['Username'], PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        $stmt->closeCursor();
      }
      catch (PDOException $e)
      {
        return "3"; // database error
      }
        
    $user_pass = $row['password'];

    if(isset($_POST['current-pass']))
    {
        $current_pass = sha1($_POST['current-pass']);
        if($user_pass == $current_pass)
        {
            if(isset($_POST['new-pass']) && isset($_POST['re-new-pass']) && $_POST['new-pass']==$_POST['re-new-pass'])
            {
                $sql = "UPDATE users
                        SET password=sha1(:pass)
                        WHERE email=:user
                        LIMIT 1";

                try
                {
                    $stmt = $this->_db->prepare($sql);
                    $stmt->bindParam(":pass", $_POST['new-pass'], PDO::PARAM_STR);
                    $stmt->bindParam(":user", $_SESSION['Username'], PDO::PARAM_STR);
                    $stmt->execute();
                    $stmt->closeCursor();

                    return "4"; // everything was successful
                }
                catch (PDOException $e)
                {
                    return "3"; // database error
                }
            }
            else
            {
                return "2"; // new password and re-new password do not match
            }

        }
        else
        {
            return "1"; // wrong current user password
        }
    }     
  }
    
  public function updateBasicInfo()
  {
      $sql = "UPDATE users
              SET first_name=:first_name, last_name=:last_name, email=:email, gender=:gender
              WHERE email=:user
              LIMIT 1";
      
      try
      {
          /*echo "IM HEdfffffffffsRE!!!";
          echo $_POST['last_name'];
          echo $_POST['email'];
          echo $_POST['gender'];
          echo $_SESSION['Username'];*/
               
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(":first_name", $_POST['first_name'], PDO::PARAM_STR);
        $stmt->bindParam(":last_name", $_POST['last_name'], PDO::PARAM_STR);
        $stmt->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
        $stmt->bindParam(":gender", $_POST['gender'], PDO::PARAM_STR);
        $stmt->bindParam(":user", $_SESSION['Username'], PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
          
        return TRUE; // everything was successful
      }
      catch (PDOException $e)
      {
         return FALSE; // database error
      }
  }

  public function uploadProfilePic()
  {
      $user_id = $this->retrieveAccountInfo()[0];
      echo $user_id;

      // __DIR__ gives the current script path
      include_once __DIR__.'/../vendor/verot/class.upload.php/src/class.upload.php';
      
      $profiles_dir = __DIR__.'/../profile_pics/'.$user_id.'/';

      $handle = new upload($_FILES['image_field']);
      if ($handle->uploaded) 
      {
        $handle->file_new_name_body   = 'main_profile_pic';
        $handle->image_min_width      = 180;
        $handle->image_min_height     = 180;
        $handle->image_resize         = true;
        $handle->image_x              = 260;
        $handle->image_y              = 260;
        $handle->image_convert        = 'jpg';
        $handle->file_overwrite = true;
        $handle->process($profiles_dir);
          
        $handle->file_new_name_body   = 'post_profile_pic';
        $handle->image_min_width      = 180;
        $handle->image_min_height     = 180;
        $handle->image_resize         = true;
        $handle->image_x              = 50;
        $handle->image_y              = 50;
        $handle->image_convert        = 'jpg';
        $handle->file_overwrite = true;
        $handle->process($profiles_dir);
          
        $handle->file_new_name_body   = 'navbar_profile_pic';
        $handle->image_min_width      = 180;
        $handle->image_min_height     = 180;
        $handle->image_resize         = true;
        $handle->image_x              = 30;
        $handle->image_y              = 30;
        $handle->image_convert        = 'jpg';
        $handle->file_overwrite = true;
        $handle->process($profiles_dir);
        
        $handle->file_new_name_body   = 'search_profile_pic';
        $handle->image_min_width      = 180;
        $handle->image_min_height     = 180;
        $handle->image_resize         = true;
        $handle->image_x              = 100;
        $handle->image_y              = 100;
        $handle->image_convert        = 'jpg';
        $handle->file_overwrite = true;
        $handle->process($profiles_dir);
        if ($handle->processed) 
        {
            echo 'image resized';
            $handle->clean();
            return TRUE;
        } 
        else 
        {
            echo 'error : ' . $handle->error;
            exit;
            return FALSE;
        }
      }
  }

  public function accountLogin()
  {
    $sql = "SELECT email
            FROM users
            WHERE email=:user
            AND password=sha1(:pass)
            LIMIT 1";
    try
    {
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':user', $_POST['email'], PDO::PARAM_STR);
        $stmt->bindParam(':pass', $_POST['password'], PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount()==1)
        {
          $_SESSION['Username'] = htmlentities($_POST['email'], ENT_QUOTES);
          $_SESSION['LoggedIn'] = 1;
          return TRUE;
        }
        else
        {
          return FALSE;
        }
    }
    catch (Exception $e)
    {
        return FALSE;
    }
  }
    
 
    public function retrieveAccountInfo()
    {
        $sql = "SELECT user_id, first_name, last_name, gender
                FROM users
                WHERE email=:email";
        try
        {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':email', $_SESSION['Username'], PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            $stmt->closeCursor();
            return array($row['user_id'], $row['first_name'], $row['last_name'], $row['gender']);
        }
        catch(PDOException $e)
        {
            return FALSE;
        }
    }
  
}
?>