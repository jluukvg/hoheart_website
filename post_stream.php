<!--<div class="container"> Para que se vea centrado en User_account.php
    <div class="row">-->
<?php

$default_profile_pic = 'http://localhost/my_projects/hoheart_website/profile_pics/default/post_profile_pic.jpg';

$profile_pic_path = 'http://localhost/my_projects/hoheart_website/profile_pics/'.$user_id.'/post_profile_pic.jpg';

?>
    <div class="[ panel panel-default ] panel-google-plus">
        <div class="dropdown">
            <span class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <span class="[ glyphicon glyphicon-chevron-down ]"></span>
            </span>
            <ul class="dropdown-menu" role="menu">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Report</a></li>
                <!--<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>-->
            </ul>
        </div>
        <div class="panel-heading">
            <a href="profile.php?id=<?php echo $user_id?>">
            <img class="[  pull-left ]" src="<?php echo $profile_pic_path;?>" alt="Mouse0270" onerror="this.src='<?php echo $default_profile_pic;?>'" />
                </a>
            <a href="profile.php?id=<?php echo $user_id?>">
                <h3><?php echo $first_name, ' ', $last_name?></h3>
            </a>
            <h5><span>Shared publicly</span> - <span><?php echo $post_time?></span> </h5>
        </div>

        <?php
            if ($message != NULL):
        ?>
            <div class="text-container">
                <div class="panel-body hideContent">
                    <p id="post-message">
                        <?php echo $message?>
                    </p>
                </div>

                <?php 
                    
                    if (strlen($message) > 145):
                ?>

                    <!--Esto de void(0) es para evitar que la posición de scroll cambie al picarle al texto de Show more-->
                    <div class="show-more">
                        <a href='javascript:void(0)' id="show_more<?php echo $msg_id?>">Show more</a>
                    </div>
                    <?php
                    endif;    
                ?>

            </div>
            <?php
            endif;    
        ?>

                <div class="post_website">
                    <a href="<?php echo $link_url?>" target="_blank" style="text-decoration:none; color:black;">
                        <div class="stuff">
                            <div class="info">

                                <?php 
    
            if ($image_url != "EMPTY" AND $image_url != NULL):
                            
                $parts = parse_url($link_url);
            
            
            if ($parts['host'] == 'www.youtube.com'): 
                            
                $video_id = $parts['query'];
                $video_id = ltrim($video_id, 'v=');
                $video_url = "http://www.youtube.com/v/" . $video_id;
                               
                                
                            
        ?>
                                    <div class="image">
                                        <object width="450" height="250" data=<?php echo $video_url; ?> type="application/x-shockwave-flash">
                                            <param name="src" value=<?php echo $video_url; ?> /></object>
                                    </div>

                                    <?php
                        else:
                                ?>
                                        <div class="image">
                                            <img src="<?php echo $image_url?>" alt="Oops!" height="250px">
                                        </div>
                                        <?php

                        endif;
    else:
                                                 
                                        if ($link_url != "EMPTY"):
                                ?>
                                            <div>
                                                <a href="<?php echo $link_url?>" target="_blank" style="text-decoration:none; color:black;">
                                                    <?php echo $link_url?>
                                                </a>
                                            </div>

                                            <?php
                                        endif;

        endif;
                                     
                                ?>

                                                <?php if ($link_title != "This URL didn't work" AND $link_title != "EMPTY" AND $link_title != NULL):?>
                                                    <!--                                Cambiar esto a "EMPTY" después de pruebas-->
                                                    <div class="title">
                                                        <p>
                                                            <?php echo $link_title?>
                                                        </p>
                                                    </div>
                                                    <?php endif;?>

                                                        <?php if ($link_description != "EMPTY" AND $link_description != NULL):?>
                                                            <div class="description">
                                                                <p>
                                                                    <?php echo $link_description?>
                                                                </p>
                                                            </div>
                                                            <?php endif;?>
                                                                <div class="url" title="url"> </div>
                            </div>
                    </a>
                    </div>



                </div>
                <div class="panel-footer">
                    <button type="button" class="[ btn btn-default ]">+1</button>
                    <button type="button" class="[ btn btn-default ]">
                        <span class="[ glyphicon glyphicon-share-alt ]"></span>
                    </button>
                    <div class="input-placeholder">Add a comment...</div>
                </div>
                <div class="panel-google-plus-comment">
                    <img class="img-circle" src="https://lh3.googleusercontent.com/uFp_tsTJboUY7kue5XAsGA=s46" alt="User Image" />
                    <div class="panel-google-plus-textarea">
                        <textarea rows="4"></textarea>
                        <button type="submit" class="[ btn btn-success disabled ]">Post comment</button>
                        <button type="reset" class="[ btn btn-default ]">Cancel</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
    </div>
    <!--    </div>
</div>-->
    </br>

    <script>
        $('#show_more<?php echo $msg_id?>').on("click", function () {



            var $this = $(this);
            var $content = $this.parent().prev("div.panel-body");
            var linkText = $this.text().toUpperCase();

            if (linkText === "SHOW MORE") {
                linkText = "Show less";
                $content.addClass('showContent').removeClass('hideContent');
            } else {
                linkText = "Show more";
                $content.addClass('hideContent').removeClass('showContent');
            };
            $this.text(linkText);
        });
    </script>