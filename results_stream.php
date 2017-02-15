<?php
    include "common/base.php";
include_once "inc/class.userInteractions.inc.php";
    

$default_profile_pic = 'http://localhost/my_projects/hoheart_website/profile_pics/default/search_profile_pic.jpg';

$profile_pic_path = 'http://localhost/my_projects/hoheart_website/profile_pics/'.$s_user_id.'/search_profile_pic.jpg';

?>

    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12"></div>
            <div class="col-md-6 col-sm-6 col-xs-12 well result-box">
                <div class="col-md-3 s-photo">
                    <a href="profile.php?id=<?php echo $s_user_id?>">
                    <img src="<?php echo $profile_pic_path;?>" onerror="this.src='<?php echo $default_profile_pic;?>'" />
                        </a>
                </div>
                <a href="profile.php?id=<?php echo $s_user_id?>">
                    <div class="col-md-6 s-name">
                        <?php
                        echo "<p>" . $s_first_name . " " . $s_last_name . "</p>";
                    ?>
                    </div>
                </a>
                <div class="col-md-3">

                    <?php
                    
                    
                    $interaction = new echoheartInteractions($db);
                    $follow = $interaction->checkIfFollowing($_SESSION["user_id"], $s_user_id);
                    
                    if ($follow == FALSE):
                    
                    ?>

                        <a href='javascript:void(0)' class="btn btn-primary" role="button" style="width: 90px;" id="follow_button<?php echo $s_user_id?>">Follow</a>

                        <?php
                    else:
                    ?>

                            <a href='javascript:void(0)' class="btn btn-success" role="button" style="width: 90px;" id="follow_button<?php echo $s_user_id?>">Following</a>


                            <?php
                    endif;
                    ?>


                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12"></div>
        </div>
    </div>





    <script>
        // this is for the FOLLOW button
        $(function () {
            $('#follow_button<?php echo $s_user_id?>').click(function () {
                var $this = $(this);

                if ($(this).text().match('Follow')) {
                    $.ajax({
                        url: 'follow_request.php',
                        type: 'POST', // GET or POST
                        data: 'f_user_id=<?php echo $s_user_id?>&user_id=<?php echo $_SESSION["user_id"]?>', // will be in $_POST on PHP side
                        success: function (data) { // data is the response from your php script
                            // This function is called if your AJAX query was successful
                            $('#follow_button<?php echo $s_user_id?>').removeClass('btn-primary').addClass('btn-success');
                            $('#follow_button<?php echo $s_user_id?>').text("Following");
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
                        data: 'f_user_id=<?php echo $s_user_id?>&user_id=<?php echo $_SESSION["user_id"]?>', // will be in $_POST on PHP side
                        success: function (data) { // data is the response from your php script
                            // This function is called if your AJAX query was successful
                            $('#follow_button<?php echo $s_user_id?>').removeClass('btn-danger').addClass('btn-primary');
                            $('#follow_button<?php echo $s_user_id?>').text("Follow");
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
        $("#follow_button<?php echo $s_user_id?>").on({

            mouseenter: function () {
                var $this = $(this);
                if ($(this).text().match('Following')) {
                    $('#follow_button<?php echo $s_user_id?>').removeClass('btn-success').addClass('btn-danger');
                    $('#follow_button<?php echo $s_user_id?>').text("Unfollow");
                }
            },
            mouseleave: function () {
                var $this = $(this);

                if ($(this).text().match('Unfollow')) {
                    $('#follow_button<?php echo $s_user_id?>').removeClass('btn-danger').addClass('btn-success');
                    $('#follow_button<?php echo $s_user_id?>').text("Following");
                }


            }
        });
    </script>