<?php
    include_once "common/base.php";
 
    if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])
        && $_SESSION['LoggedIn']==1):
        
        header("Location: home.php"); 
        exit();

    else:
        include_once "common/header.php";
        
        if(!empty($_POST['first_name'])):
            include_once "inc/class.users.inc.php";
            $users = new dedaloUsers($db);
            echo $users->createAccount();
        else:
?>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-6" id="index-logo">
                    <div class="thumbnail text-center">
                        <img src="images/tree.jpg">
                        <div class="caption" id="index-logo-caption">
                            <p>ECHOHEART</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5" id="signup-form">
                    <div class="panel-body">
                        <h1>Sign Up</h1>
                        <form data-toggle="validator" role="form" method="post">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="first_name" id="f_name" class="form-control" placeholder="First Name" data-error="Please enter your First Name" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="last_name" id="l_name" class="form-control" placeholder="Last Name" data-error="Please enter your Last Name" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="email" name=email id="email" class="form-control" placeholder="Enter Email" data-error="Please enter a valid email address" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <input type="password" data-minlength="6" name="password" id="pass" class="form-control" placeholder="Password" data-error="Password must be at least 6 characters" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="birth_date" id="b_date" class="form-control margin-bottom" placeholder="Birth Date" required>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <select class="selectpicker" data-width="100%" name="gender" title="Gender" required>
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select>

                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <input type="submit" class="btn btn-block btn-lg btn-success" value="Sign Up">
                            </div>

                            <?php
                            endif;
                        ?>

                        </form>
                    </div>
                </div>

            </div>
        </div>


        <?php
        endif;
        //print_r($_SESSION);
    ?>


            <script type="text/javascript" src="datepicker_script.js"></script>
    </body>

    <?php include_once "common/footer.php"; ?>