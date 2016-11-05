<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="description" content="Working with bootstrap">
    <meta name="author" content="Jesus Aguilar/Carlos Morales">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Bootstrap-select Plugin -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script>
    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
    <!-- My CSS -->
    <link rel="stylesheet" href="this_website.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="liveurl.css" type="text/css" media="screen" />

    <!-- PROBANDO -->
    <link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">

</head>

<body style="background-color:white;">

    <?php
    if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])
        && $_SESSION['LoggedIn']==1):
    
        include_once 'inc/class.users.inc.php';
        $users = new dedaloUsers($db);
        list($userID, $first_name, $last_name) = $users->retrieveAccountInfo();
    
        $_SESSION["user_id"] = $userID;

?>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="home.php">hoheart</a>
                </div>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-left">
                    <li><a href="user_account.php" data-toggle="tooltip" data-placement="bottom" title="See or modify your account settings"><span class="glyphicon glyphicon-user"></span>
                            <strong><?php echo $first_name, " ", $last_name?></strong></a></li>
                </ul>

                <div class="col-sm-3 col-md-3 pull-right">
                    <form class="navbar-form" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search..." name="srch-term" id="srch-term">
                            <div class="input-group-btn">
                                <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </nav>
        <?php //echo $userID, $_SESSION["user_id"]?>

        <?php else: ?>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"></a>
                </div>

                <form class="navbar-form navbar-right" action="login.php" method="post" role="form">
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="E-mail">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="checkbox" style="color:white;">
                        <label style="font-size: 10px;"><input type="checkbox" style="font-size: 20px; margin-right: 10px;"> Remember me</label>
                    </div>
                    <input type="submit" class="btn btn-success" value="Log In">
                </form>

            </div>
        </nav>
        <?php endif; ?>
