<?php

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
                    FOLLOW
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12"></div>
        </div>
    </div>