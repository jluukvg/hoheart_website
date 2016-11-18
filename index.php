<?php include_once "common/base.php"; ?>
<?php include_once "common/header.php"; ?>


<?php
  if(!empty($_POST['first_name'])):
        include_once "inc/class.users.inc.php";
        $users = new dedaloUsers($db);
        echo $users->createAccount();
    else:

 ?>


    <div class="container">
        <div class="row">
            <div class="col-sm-6" style="background-color:white; padding:10px 40px 40px 40px; border-radius: 28px; box-shadow: 2px 2px 7px; margin-right: 40px;"><img src="images/tree.jpg" ; style="display: inline; max-width:100%; max-height:100%; position: relative">
                <h1 style="font-size:60px; text-align:center;">HOHEART</h1>
            </div>
            <div class="col-sm-5" style="background-color:#F5F5F5; border-radius: 28px; box-shadow: 2px 2px 7px #666666;">
                <div class="panel-body">
                    <h1>Sign Up</h1>
                    <form role="form" method="post">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="first_name" id="f_name" class="form-control" placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="last_name" id="l_name" class="form-control" placeholder="Last Name">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="email" name=email id="email" class="form-control" placeholder="Enter E-mail">
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" id="pass" class="form-control" placeholder="Password">
                        </div>

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="birth_date" id="b_date" class="form-control margin-bottom" placeholder="Birth Date">
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <select class="selectpicker" data-width="100%" name="gender" title="Gender">
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
print_r($_SESSION);
?>


            <script type="text/javascript" src="datepicker_script.js"></script>
        </body>

        <?php include_once "common/footer.php"; ?>
