<!DOCTYPE html>
<html lang="en">

<head>
    <title>Echoheart</title>
    <meta charset="utf-8">
    <meta name="description" content="Share, save, review">
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
    <!-- Bootstrap Validator (1000Hz) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
    <!-- Bootstrap Notifications (skywalk) -->
    <link rel="stylesheet" href="vendor/skywalkapps/bootstrap-dropmenu-0.9.0/dist/stylesheets/bootstrap-dropmenu.min.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="vendor/skywalkapps/bootstrap-navbar-toggle-master/dist/stylesheets/bootstrap-navbar-toggle.min.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="vendor/skywalkapps/bootstrap-notifications-0.9.0/dist/stylesheets/bootstrap-notifications.min.css" type="text/css" media="screen" />
    <!-- My CSS -->
    <link rel="stylesheet" href="this_website.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="liveurl.css" type="text/css" media="screen" />

    <!-- PROBANDO -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js"></script>


    <link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Oswald|Patua+One|Muli|Lora" rel="stylesheet">

</head>

<body style="background-color:white;">

    <?php
    if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])
        && $_SESSION['LoggedIn']==1):
    
        include_once 'inc/class.users.inc.php';
        $users = new dedaloUsers($db);
        list($userID, $first_name, $last_name, $gender) = $users->retrieveAccountInfo();
    
        $_SESSION["user_id"] = $userID;
    
    
    
            //<?php echo $profile_pic_path?
        
        // CHECAR EL RELATIVE PATH DE ESTO!
    
        $default_profile_pic = 'http://localhost/my_projects/hoheart_website/profile_pics/default/navbar_profile_pic.jpg';
    
        $profile_pic_path = 'http://localhost/my_projects/hoheart_website/profile_pics/'.$userID.'/navbar_profile_pic.jpg';
?>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="home.php">Echoheart</a>
                </div>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="user_account.php" data-toggle="tooltip" data-placement="bottom" title="See or modify your account settings"><img src="<?php echo $profile_pic_path;?>" class="profile-image" onerror="this.src='<?php echo $default_profile_pic;?>'">
                            <strong><?php echo " ", $first_name, " ", $last_name?></strong></a>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown dropdown-notifications">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i data-count="3" class="glyphicon glyphicon-bell notification-icon"></i>
                        </a>

                        <div class="dropdown-container">

                            <div class="dropdown-toolbar">
                                <div class="dropdown-toolbar-actions">
                                    <a href="#">Mark all as read</a>
                                </div>
                                <h3 class="dropdown-toolbar-title">Notifications (3)</h3>
                            </div>
                            <!-- /dropdown-toolbar -->

                            <ul class="dropdown-menu">
                                <li class="notification">
                                    <div class="media">
                                        <div class="media-left">
                                            <div class="media-object">
                                                <img data-src="holder.js/50x50?bg=cccccc" class="img-circle" alt="Name">
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <strong class="notification-title"><a href="#">Dave Lister</a> commented on <a href="#">DWARF-13 - Maintenance</a></strong>
                                            <p class="notification-desc">I totally don't wanna do it. Rimmer can do it.</p>

                                            <div class="notification-meta">
                                                <small class="timestamp">27. 11. 2015, 15:00</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="notification">
                                    <div class="media">
                                        <div class="media-left">
                                            <div class="media-object">
                                                <img data-src="holder.js/50x50?bg=cccccc" class="img-circle" alt="Name">
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <strong class="notification-title"><a href="#">Nikola Tesla</a> resolved <a href="#">T-14 - Awesome stuff</a></strong>

                                            <p class="notification-desc">Resolution: Fixed, Work log: 4h</p>

                                            <div class="notification-meta">
                                                <small class="timestamp">27. 10. 2015, 08:00</small>
                                            </div>

                                        </div>
                                    </div>
                                </li>

                                <li class="notification">
                                    <div class="media">
                                        <div class="media-left">
                                            <div class="media-object">
                                                <img data-src="holder.js/50x50?bg=cccccc" class="img-circle" alt="Name">
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <strong class="notification-title"><a href="#">James Bond</a> resolved <a href="#">B-007 - Desolve Spectre organization</a></strong>

                                            <div class="notification-meta">
                                                <small class="timestamp">1. 9. 2015, 08:00</small>
                                            </div>

                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <div class="dropdown-footer text-center">
                                <a href="#">View All</a>
                            </div>
                            <!-- /dropdown-footer -->

                        </div>
                        <!-- /dropdown-container -->
                    </li>
                </ul>



                <div class="col-sm-3 col-md-3 pull-right">
                    <form class="navbar-form" data-toggle="validator" role="search" method="get" action="search.php" id="searchform">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Find people..." name="srch-term" id="srch-term" data-toggle="tooltip" data-placement="bottom" title="Look for people by name or email" required>
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
                                <label style="font-size: 10px;">
                                    <input type="checkbox" style="font-size: 20px; margin-right: 10px;"> Remember me</label>
                            </div>
                            <input type="submit" class="btn btn-success" value="Log In">
                        </form>

                    </div>
                </nav>
                <?php endif; ?>