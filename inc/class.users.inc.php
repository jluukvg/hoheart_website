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
      $this->_db = new PDO($dsn, DB_USER, DB_PASS);
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
    if(isset($_POST['p'])
    && isset($_POST['r'])
    && $_POST['p']==$_POST['r'])
    {
      $sql = "UPDATE users
              SET pass=MD5(:pass), verify=1
              WHERE ver_code=:ver
              LIMIT 1";

      try
      {
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(":pass", $_POST['p'], PDO::PARAM_STR);
        $stmt->bindParam(":ver", $_POST['v'], PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();

        return TRUE;
      }
      catch (PDOException $e)
      {
          return FALSE;
      }
    }
    else
    {
      return FALSE;
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
    
  public function createPost()
  {
    $post = trim($_POST['post']);
    $topic = trim($_POST['topic']);
    $media = trim($_POST['media']);
    $url = trim($_POST['url']);
    $userID = $_SESSION["user_id"];

    $sql = "INSERT INTO posts(message, topic_id, media_id, link_url, user_id, post_time)
            VALUES(:post, :topic, :media, :url, :user, NOW())";

    if($stmt = $this->_db->prepare($sql)) {
      $stmt->bindParam(":post", $post, PDO::PARAM_STR);
      $stmt->bindParam(":topic", $topic, PDO::PARAM_STR);
      $stmt->bindParam(":media", $media, PDO::PARAM_STR);
      $stmt->bindParam(":url", $url, PDO::PARAM_STR);
      $stmt->bindParam(":user", $userID, PDO::PARAM_STR);
      $stmt->execute();
      $stmt->closeCursor();

      return "<h2> Success! </h2>"."<p>Your post was successfully created.</p>";
    }
    else {
      return "<h2> Error </h2>"."<p>No post created.</p>";
    }
  }
    public function retrieveAccountInfo()
    {
        $sql = "SELECT user_id, first_name, last_name
                FROM users
                WHERE email=:email";
        try
        {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':email', $_SESSION['Username'], PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            $stmt->closeCursor();
            return array($row['user_id'], $row['first_name'], $row['last_name']);
        }
        catch(PDOException $e)
        {
            return FALSE;
        }
    }
  
}
?>
