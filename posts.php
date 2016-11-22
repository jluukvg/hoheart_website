<?php
    include_once "common/base.php";
    include_once "common/header.php";
    
    if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])):
    
        include_once 'inc/class.posts.inc.php';
        $posts = new hoheartPosts($db);
        if (isset($_GET['topic'])):
            $posts_array = $posts->loadPostsByTopic();
        elseif (isset($_GET['media'])):
            $posts_array = $posts->loadPostsByMedia();
        endif;
        
        
    else:
        echo "Something went wrong!";

    endif;
?>

    <div class="container">
        <div class="row">
            <div class="[ panel panel-default ] panel-google-plus">
                <div class="dropdown">
                    <span class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <span class="[ glyphicon glyphicon-chevron-down ]"></span>
                    </span>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                    </ul>
                </div>
                <div class="panel-heading">
                    <img class="[ img-circle pull-left ]" src="images/user_pic.jpg" alt="Mouse0270" />
                    <h3>Solas Dreadwolf</h3>
                    <h5><span>Shared publicly</span> - <span>Jun 27, 2014</span> </h5>
                </div>
                <div class="panel-body">
                    <p>I just found out about this weird food thing. I never tought about it but it makes sense.. Food can actually be delicious, right?</p>
                </div>
                <div class="post_website">
                    <div class="stuff">
                        <div class="info">
                            <div class="image">
                                <img src="http://lorempixel.com/475/250/food" alt="Smiley face"></div>
                            <div class="title">
                                <p>Food can be quite delicious</p>
                            </div>
                            <div class="description">
                                <p>Some people say that food can be very tasty, while some others say it can't. However, it has been shown that food is, in fact, delicious, or that at least it can be.</p>
                            </div>
                            <div class="url" title="url"> </div>
                        </div>

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
        </div>
    </div>

    <script src="post_window.js">
    </script>






    </body>

    <?php include_once "common/footer.php"; ?>