<?php
    include_once "common/base.php";
 
    if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])
        && $_SESSION['LoggedIn']==1):
        
        include_once "common/header.php";
?>

    <body>
        <br>
        <br>
        <?php           
                        if(isset($_GET['profilepicstatus']) && $_GET['profilepicstatus']=="changed")
                        {
                            echo "<div class='message good'>Your profile pic " . "has been changed.</div>";
                        }
                        elseif(isset($_GET['profilepicstatus']) && $_GET['profilepicstatus']=="failed")
                        {
                            echo "<div class='message bad'>Your profile pic " . "could not be changed. Try again!</div>";   
                        }
        
                        if(isset($_GET['basicinfostatus']) && $_GET['basicinfostatus']=="changed")
                        {
                            echo "<div class='message good'>Your basic information " . "has been changed.</div>";
                        }
                        elseif(isset($_GET['basicinfostatus']) && $_GET['basicinfostatus']=="failed")
                        {
                            echo "<div class='message bad'>Your basic information" . "could not be changed. Try again!</div>";    
                        }
        
                        if(isset($_GET['password']) && $_GET['password']=="changed")
                        {
                            echo "<div class='message good'>Your password " . "has been changed.</div>";
                        }
                        elseif(isset($_GET['password']) && $_GET['password']=="nomatch")
                        {
                            echo "<div class='message bad'>The two passwords " . "did not match. Try again!</div>";
                        }
                        elseif(isset($_GET['password']) && $_GET['password']=="wrongpass")
                        {
                            echo "<div class='message bad'>The old password you entered " . "is incorrect. Try again!</div>";
                        }
                        elseif(isset($_GET['password']) && $_GET['password']=="dberror")
                        {
                            echo "<div class='message bad'>There was a database error. " . "Sorry!</div>";
                        }
                    ?>

            <!--<form action="upload.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form>-->

            <?php 
        
            $default_profile_pic = 'http://localhost/my_projects/hoheart_website/profile_pics/default/main_profile_pic.jpg';
        // hay que checar bien como hacer este path relativo
            $profile_pic_path = 'http://localhost/my_projects/hoheart_website/profile_pics/'.$userID.'/main_profile_pic.jpg';
        ?>

                <div class="container">
                    <div class="row">
                        <div class="col-sm-3 col-md-3">
                            <img src="<?php echo $profile_pic_path;?>" class="img-responsive" onerror="this.src='<?php echo $default_profile_pic;?>'">
                            <h2><?php echo $first_name." ".$last_name;?></h2>
                            <div class="panel-group level1" id="accordion" role="tablist" aria-multiselectable="true">

                                <div class="panel panel-default admin-menu">
                                    <a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                        <div class="panel-heading" role="tab" id="heading1">

                                            <h4 class="panel-title">
                                
                                    Posts
                                
                            </h4>

                                        </div>
                                    </a>
                                    <div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
                                        <div class="panel-body">

                                            <div class="panel-group level2" id="accordion1" role="tablist" aria-multiselectable="true">

                                                <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab" id="heading1_1">
                                                        <h4 class="panel-title">
                                                <a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse1_1" aria-expanded="true" aria-controls="collapse1_1">
                                                    Topics
                                                </a>
			                                </h4>
                                                    </div>
                                                    <div id="collapse1_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1_1">
                                                        <div class="panel-body">
                                                            <table class="table">
                                                                <tr>
                                                                    <td>
                                                                        <li class="active" style="list-style-type: none;"><a href="#" style="text-decoration:none; color:black;" data-target-id="posts-topics-movies">Movies</a></li>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <li class="active" style="list-style-type: none;"><a href="#" style="text-decoration:none; color:black;" data-target-id="posts-topics-music">Music</a></li>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <li class="active" style="list-style-type: none;"><a href="#" style="text-decoration:none; color:black;" data-target-id="posts-topics-events">Events</a></li>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <li class="active" style="list-style-type: none;"><a href="#" style="text-decoration:none; color:black;" data-target-id="posts-topics-food">Food</a></li>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <li class="active" style="list-style-type: none;"><a href="#" style="text-decoration:none; color:black;" data-target-id="posts-topics-restaurants">Restaurants</a></li>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <li class="active" style="list-style-type: none;"><a href="#" style="text-decoration:none; color:black;" data-target-id="posts-topics-sports">Sports</a></li>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <li class="active" style="list-style-type: none;"><a href="#" style="text-decoration:none; color:black;" data-target-id="posts-topics-books">Books</a></li>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <li class="active" style="list-style-type: none;"><a href="#" style="text-decoration:none; color:black;" data-target-id="posts-topics-fashion">Fashion</a></li>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <li class="active" style="list-style-type: none;"><a href="#" style="text-decoration:none; color:black;" data-target-id="posts-topics-travel">Travel</a></li>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <li class="active" style="list-style-type: none;"><a href="#" style="text-decoration:none; color:black;" data-target-id="posts-topics-funny">Funny</a></li>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <li class="active" style="list-style-type: none;"><a href="#" style="text-decoration:none; color:black;" data-target-id="posts-topics-interesting">Interesting</a></li>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <li class="active" style="list-style-type: none;"><a href="#" style="text-decoration:none; color:black;" data-target-id="posts-topics-lifestyle">Lifestyle</a></li>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab" id="heading1_2">
                                                        <h4 class="panel-title">
                                                <a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse1_2" aria-expanded="true" aria-controls="collapse1_2">
                                                    Media
                                                </a>
			                                </h4>
                                                    </div>
                                                    <div id="collapse1_2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1_2">
                                                        <div class="panel-body">
                                                            <table class="table">
                                                                <tr>
                                                                    <td>
                                                                        <li class="active" style="list-style-type: none;"><a href="#" style="text-decoration:none; color:black;" data-target-id="posts-media-articles">Articles</a></li>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <li class="active" style="list-style-type: none;"><a href="#" style="text-decoration:none; color:black;" data-target-id="posts-media-blogs">Blogs</a></li>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <li class="active" style="list-style-type: none;"><a href="#" style="text-decoration:none; color:black;" data-target-id="posts-media-videos">Videos</a></li>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <li class="active" style="list-style-type: none;"><a href="#" style="text-decoration:none; color:black;" data-target-id="posts-media-podcasts">Podcasts</a></li>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default admin-menu">
                                    <div class="panel-heading" role="tab" id="heading2">
                                        <h4 class="panel-title">
                                <a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                    Likes
                                </a>
                            </h4>
                                    </div>
                                    <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                                        <div class="panel-body">

                                            <div class="panel-group level2" id="accordion2" role="tablist" aria-multiselectable="true">

                                                <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab" id="heading2_1">
                                                        <h4 class="panel-title">
                                                <a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse2_1" aria-expanded="true" aria-controls="collapse2_1">
                                                    Topics
                                                </a>
			                                </h4>
                                                    </div>
                                                    <div id="collapse2_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2_1">
                                                        <div class="panel-body">
                                                            <table class="table">
                                                                <tr>
                                                                    <td>
                                                                        Movies
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Music
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Events
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Food
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Restaurants
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Sports
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Books
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Fashion
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Travel
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Funny
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Interesting
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Lifestyle
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab" id="heading2_2">
                                                        <h4 class="panel-title">
                                                <a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse2_2" aria-expanded="true" aria-controls="collapse2_2">
                                                    Media
                                                </a>
			                                </h4>
                                                    </div>
                                                    <div id="collapse2_2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2_2">
                                                        <div class="panel-body">
                                                            <table class="table">
                                                                <tr>
                                                                    <td>
                                                                        Articles
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Blogs
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Videos
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Podcasts
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default admin-menu">
                                    <div class="panel-heading" role="tab" id="heading3">
                                        <h4 class="panel-title">
                                <a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                    Friends
                                </a>
                            </h4>
                                    </div>
                                    <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
                                        <div class="panel-body">
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        Followers
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Following
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Find Friends
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default admin-menu">
                                    <div class="panel-heading" role="tab" id="heading4">
                                        <h4 class="panel-title">
                                <a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                    Account
                                </a>
                            </h4>
                                    </div>
                                    <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
                                        <div class="panel-body">
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <li class="active" style="list-style-type: none;"><a href="#" style="text-decoration:none; color:black;" data-target-id="account-basicInformation">Basic Information</a></li>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <li class="active" style="list-style-type: none;"><a href="#" style="text-decoration:none; color:black;" data-target-id="account-changePassword">Change Password</a></li>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <li class="active" style="list-style-type: none;"><a href="#" style="text-decoration:none; color:black;" data-target-id="account-changeProfilePic">Change Profile Picture</a></li>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <li class="active" style="list-style-type: none;"><a href="#" style="text-decoration:none; color:black;" data-target-id="account-privacySettings">Privacy</a></li>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>

                        <div class="col-sm-9 col-md-9 well admin-content">
                            <p></p>
                        </div>

                        <?php
                    include_once 'inc/class.posts.inc.php';
                    $posts = new hoheartPosts($db);
                ?>

                            <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-movies">
                                Movies
                                <?php
                            $topic = "1"; 
                            $posts->loadPostsByTopic($topic, $userID);
                        ?>
                            </div>
                            <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-music">
                                <?php
                            $topic = "2"; 
                            $posts->loadPostsByTopic($topic, $userID);
                        ?>
                            </div>
                            <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-events">
                                <?php
                            $topic = "3"; 
                            $posts->loadPostsByTopic($topic, $userID);
                        ?>
                            </div>
                            <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-food">
                                <?php
                            $topic = "4"; 
                            $posts->loadPostsByTopic($topic, $userID);
                        ?>
                            </div>
                            <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-restaurants">
                                <?php
                            $topic = "5"; 
                            $posts->loadPostsByTopic($topic, $userID);
                        ?>
                            </div>
                            <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-sports">
                                <?php
                            $topic = "6"; 
                            $posts->loadPostsByTopic($topic, $userID);
                        ?>
                            </div>
                            <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-books">
                                <?php
                            $topic = "7"; 
                            $posts->loadPostsByTopic($topic, $userID);
                        ?>
                            </div>
                            <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-fashion">
                                <?php
                            $topic = "8"; 
                            $posts->loadPostsByTopic($topic, $userID);
                        ?>
                            </div>
                            <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-travel">
                                <?php
                            $topic = "9"; 
                            $posts->loadPostsByTopic($topic, $userID);
                        ?>
                            </div>
                            <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-funny">
                                <?php
                            $topic = "10"; 
                            $posts->loadPostsByTopic($topic, $userID);
                        ?>
                            </div>
                            <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-interesting">
                                <?php
                            $topic = "11"; 
                            $posts->loadPostsByTopic($topic, $userID);
                        ?>
                            </div>
                            <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-lifestyle">
                                <?php
                            $topic = "12"; 
                            $posts->loadPostsByTopic($topic, $userID);
                        ?>
                            </div>


                            <div class="col-sm-9 col-md-9 well admin-content" id="posts-media-articles">
                                <?php
                            $media = "4"; 
                            $posts->loadPostsByMedia($media, $userID);
                        ?>
                            </div>
                            <div class="col-sm-9 col-md-9 well admin-content" id="posts-media-blogs">
                                <?php
                            $media = "2"; 
                            $posts->loadPostsByMedia($media, $userID);
                        ?>
                            </div>
                            <div class="col-sm-9 col-md-9 well admin-content" id="posts-media-videos">
                                <?php
                            $media = "1"; 
                            $posts->loadPostsByMedia($media, $userID);
                        ?>
                            </div>
                            <div class="col-sm-9 col-md-9 well admin-content" id="posts-media-podcasts">
                                <?php
                            $media = "3"; 
                            $posts->loadPostsByMedia($media, $userID);
                        ?>
                            </div>



                            <div class="col-sm-9 col-md-9 well admin-content" id="account-basicInformation">

                                <?php

                                if ($gender == "M"){
                                    $gender = "Male";
                                }
                                elseif ($gender == "F"){
                                    $gender = "Female";
                                }
                            ?>

                                    <h1>Basic Information</h1>
                                    <form role="form" method="post" action="users.php">
                                        <input type="hidden" name="action" value="changeBasicInfo">
                                        <div class="form-group row">
                                            <div class="col-xs-6">

                                                <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $first_name;?>">




                                                <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo $last_name;?>">





                                                <input type="email" name=email id="email" class="form-control" value="<?php echo $_SESSION['Username'];?>">




                                                <select class="selectpicker" data-width="100%" name="gender" id="gender" title="<?php echo $gender;?>">
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="offeset-xs-2 col-xs-10">
                                                <input type="submit" class="btn btn-success" style="align-items:center;" value="Edit Information">
                                            </div>
                                        </div>
                                    </form>

                            </div>


                            <div class="col-sm-9 col-md-9 well admin-content" id="account-changePassword">
                                <div class="container">
                                    <h1>Change Password</h1>
                                    <form data-toggle="validator" role="form" method="post" action="users.php">
                                        <div class="form-group row">
                                            <div class="col-xs-3">
                                                <input type="hidden" name="action" value="changepassword">
                                                <input type="password" data-minlength="2" name="current-pass" id="current-pass" class="form-control" placeholder="Current password" data-error="Password must be at least 6 characters" required>
                                                <input type="password" data-minlength="2" name="new-pass" id="new-pass" class="form-control" placeholder="New password" data-error="Password must be at least 6 characters" required>
                                                <input type="password" data-minlength="2" name="re-new-pass" id="re-new-pass" class="form-control" placeholder="Retype password" data-error="Password must be at least 6 characters" required>
                                            </div>
                                            <div class="col-xs-9"></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-xs-6 col-xs-6">
                                                <input type="submit" class="btn btn-success" value="Change password">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-sm-9 col-md-9 well admin-content" id="account-changeProfilePic">
                                <div class="container">
                                    <h1>Upload Profile Picture</h1>
                                    <!--<form enctype="multipart/form-data" method="post" action="upload.php">
                                    <input type="file" size="32" name="image_field" value="">
                                    <input type="submit" name="Submit" value="upload">
                                </form>-->



                                    <form name="form5" role="form" enctype="multipart/form-data" method="post" action="users.php">
                                        <input type="hidden" name="action" value="changeProfilePic">
                                        <p>
                                            <input type="file" size="32" name="image_field" value="" id="dnd_field" />
                                        </p>
                                        <div id="dnd_drag">... drag and drop here ...</div>
                                        <div id="dnd_status"></div>
                                        <p class="button">

                                            <input type="submit" name="Submit" value="upload" id="dnd_upload" />
                                        </p>
                                    </form>
                                    <div id="dnd_result"></div>
                                </div>

                            </div>

                            <div class="col-sm-9 col-md-9 well admin-content" id="account-privacySettings">
                                <div class="container">
                                    <h1>Privacy Settings</h1>
                                </div>
                            </div>


                    </div>
                </div>

    </body>

    <script type="text/javascript">
        $(document).ready(function () {
            var navItems = $('.admin-menu li > a');
            var navListItems = $('.admin-menu li');
            var allWells = $('.admin-content');
            var allWellsExceptFirst = $('.admin-content:not(:first)');

            allWellsExceptFirst.hide();
            navItems.click(function (e) {
                e.preventDefault();
                navListItems.removeClass('active');
                $(this).closest('li').addClass('active');

                allWells.hide();
                var target = $(this).attr('data-target-id');
                $('#' + target).show();
            });
        });


        $('.panel-collapse').on('hidden.bs.collapse', function () {
            // find the children and close them
            $(this).find('.collapse.in').collapse('hide');
        });
    </script>

    <?php 
    include_once "common/footer.php";

    else:
        header("Location: index.php"); 
        exit();
    endif;
?>