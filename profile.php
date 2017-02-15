<?php
    include_once "common/base.php";
 
    if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])
        && $_SESSION['LoggedIn']==1):

    if(isset($_GET['id']))
    {
        $profile_id = $_GET['id'];

        if($profile_id == $_SESSION['user_id']){
            header("Location: user_account.php");
        }

        include_once 'inc/class.userInteractions.inc.php';
        $profile_info = new echoheartInteractions($db);

        list($profile_first_name, $profile_last_name) = $profile_info->retrieveProfileInfo($profile_id);
    }
    else
    {
        header("Location: home.php");
    }
            
    include_once "common/header.php";

    $default_profile_pic = 'http://localhost/my_projects/hoheart_website/profile_pics/default/main_profile_pic.jpg';
// hay que checar bien como hacer este path relativo
    $profile_pic_path = 'http://localhost/my_projects/hoheart_website/profile_pics/'.$profile_id.'/main_profile_pic.jpg';       
?>

    <body>
        <br>
        <br>

        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-md-3">
                    <img src="<?php echo $profile_pic_path;?>" class="img-responsive" onerror="this.src='<?php echo $default_profile_pic;?>'">
                    <h2><?php echo $profile_first_name." ".$profile_last_name;?></h2>

                    <?php
                    
                    
                    $interaction = new echoheartInteractions($db);
                    $follow = $interaction->checkIfFollowing($_SESSION["user_id"], $profile_id);
                    
                   if ($follow == FALSE):
                    
                    ?>

                        <a href='javascript:void(0)' class="btn btn-primary" role="button" style="width: 90px;" id="follow_button<?php echo $profile_id?>">Follow</a>

                        <?php
                    else:
                    ?>

                            <a href='javascript:void(0)' class="btn btn-success" role="button" style="width: 90px;" id="follow_button<?php echo $profile_id?>">Following</a>


                            <?php
                    endif;
                    ?>



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
                            $posts->loadPostsByTopic($topic, $profile_id);
                        ?>
                    </div>
                    <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-music">
                        <?php
                            $topic = "2"; 
                            $posts->loadPostsByTopic($topic, $profile_id);
                        ?>
                    </div>
                    <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-events">
                        <?php
                            $topic = "3"; 
                            $posts->loadPostsByTopic($topic, $profile_id);
                        ?>
                    </div>
                    <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-food">
                        <?php
                            $topic = "4"; 
                            $posts->loadPostsByTopic($topic, $profile_id);
                        ?>
                    </div>
                    <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-restaurants">
                        <?php
                            $topic = "5"; 
                            $posts->loadPostsByTopic($topic, $profile_id);
                        ?>
                    </div>
                    <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-sports">
                        <?php
                            $topic = "6"; 
                            $posts->loadPostsByTopic($topic, $profile_id);
                        ?>
                    </div>
                    <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-books">
                        <?php
                            $topic = "7"; 
                            $posts->loadPostsByTopic($topic, $profile_id);
                        ?>
                    </div>
                    <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-fashion">
                        <?php
                            $topic = "8"; 
                            $posts->loadPostsByTopic($topic, $profile_id);
                        ?>
                    </div>
                    <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-travel">
                        <?php
                            $topic = "9"; 
                            $posts->loadPostsByTopic($topic, $profile_id);
                        ?>
                    </div>
                    <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-funny">
                        <?php
                            $topic = "10"; 
                            $posts->loadPostsByTopic($topic, $profile_id);
                        ?>
                    </div>
                    <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-interesting">
                        <?php
                            $topic = "11"; 
                            $posts->loadPostsByTopic($topic, $profile_id);
                        ?>
                    </div>
                    <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-lifestyle">
                        <?php
                            $topic = "12"; 
                            $posts->loadPostsByTopic($topic, $profile_id);
                        ?>
                    </div>

                    <div class="col-sm-9 col-md-9 well admin-content" id="posts-media-articles">
                        <?php
                            $media = "4"; 
                            $posts->loadPostsByMedia($media, $profile_id);
                        ?>
                    </div>
                    <div class="col-sm-9 col-md-9 well admin-content" id="posts-media-blogs">
                        <?php
                            $media = "2"; 
                            $posts->loadPostsByMedia($media, $profile_id);
                        ?>
                    </div>
                    <div class="col-sm-9 col-md-9 well admin-content" id="posts-media-videos">
                        <?php
                            $media = "1"; 
                            $posts->loadPostsByMedia($media, $profile_id);
                        ?>
                    </div>
                    <div class="col-sm-9 col-md-9 well admin-content" id="posts-media-podcasts">
                        <?php
                            $media = "3"; 
                            $posts->loadPostsByMedia($media, $profile_id);
                        ?>
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


    <script>
        // this is for the FOLLOW button
        $(function () {
            $('#follow_button<?php echo $profile_id?>').click(function () {
                var $this = $(this);
                console.log($(this).text());

                if ($(this).text().match('Follow')) {
                    $.ajax({
                        url: 'follow_request.php',
                        type: 'POST', // GET or POST
                        data: 'f_user_id=<?php echo $profile_id?>&user_id=<?php echo $_SESSION["user_id"]?>', // will be in $_POST on PHP side
                        success: function (data) { // data is the response from your php script
                            // This function is called if your AJAX query was successful
                            $('#follow_button<?php echo $profile_id?>').removeClass('btn-primary').addClass('btn-success');
                            $('#follow_button<?php echo $profile_id?>').text("Following");
                        },
                        error: function () {
                            // This callback is called if your AJAX query has failed
                            alert("Error!");
                        }
                    });
                } else if ($(this).text().match('Unfollow')) {
                    $.ajax({
                        url: 'unfollow.php',
                        type: 'POST', // GET or POST
                        data: 'f_user_id=<?php echo $profile_id?>&user_id=<?php echo $_SESSION["user_id"]?>', // will be in $_POST on PHP side
                        success: function (data) { // data is the response from your php script
                            // This function is called if your AJAX query was successful
                            $('#follow_button<?php echo $profile_id?>').removeClass('btn-danger').addClass('btn-primary');
                            $('#follow_button<?php echo $profile_id?>').text("Follow");
                        },
                        error: function () {
                            // This callback is called if your AJAX query has failed
                            alert("Error!");
                        }
                    });

                }
            });
        });
    </script>


    <script>
        $("#follow_button<?php echo $profile_id?>").on({

            mouseenter: function () {
                var $this = $(this);
                if ($(this).text().match('Following')) {
                    $('#follow_button<?php echo $profile_id?>').removeClass('btn-success').addClass('btn-danger');
                    $('#follow_button<?php echo $profile_id?>').text("Unfollow");
                }
            },
            mouseleave: function () {
                var $this = $(this);
                if ($(this).text().match('Unfollow')) {
                    $('#follow_button<?php echo $profile_id?>').removeClass('btn-danger').addClass('btn-success');
                    $('#follow_button<?php echo $profile_id?>').text("Following");
                }


            }
        });
    </script>



    <?php 
    include_once "common/footer.php";

    else:
        header("Location: index.php"); 
        exit();
    endif;
?>