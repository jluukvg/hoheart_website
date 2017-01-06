<!--<div class="container"> Para que se vea centrado en User_account.php
    <div class="row">-->
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
        <img class="[ img-circle pull-left ]" src="images/user_pic.jpg" alt="Mouse0270" />
        <h3><?php echo $first_name, ' ', $last_name?></h3>
        <h5><span>Shared publicly</span> - <span><?php echo $post_time?></span> </h5>
    </div>
    <div class="panel-body">
        <p>
            <?php echo $message?>
        </p>
    </div>
    <div class="post_website">
        <a href="<?php echo $link_url?>" target="_blank" style="text-decoration:none; color:black;">
            <div class="stuff">
                <div class="info">
                    <div class="image">
                        
                        <?php 
                            
                             $parts = parse_url($link_url);
            
            
                            if ($parts['host'] == 'www.youtube.com'): 
                            
                                $video_id = $parts['query'];
                                $video_id = ltrim($video_id, 'v=');
                                $video_url = "http://www.youtube.com/v/" . $video_id;
                               
                                
                            
                                ?>
                        
                                <object width="425" height="150" data=<?php echo $video_url; ?> type="application/x-shockwave-flash"><param name="src" value=<?php echo $video_url; ?> /></object>
                    
                         <?php
                        
                        else:
                            
                        ?>
                        
                        
                        <img src="<?php echo $image_url?>" alt="Oops!" height="250px"></div>
<?php
                    endif;
                                ?>
                    
                    
                    
                    
                    
                    <?php if ($link_title != NULL):?>
                        <div class="title">
                            <p>
                                <?php echo $link_title?>
                            </p>
                        </div>
                        <?php endif;?>
                            <div class="description">
                                <p>
                                    <?php echo $link_description?>
                                </p>
                            </div>
                            <div class="url" title="url"> </div>
                </div>

            </div>
        </a>
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