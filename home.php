<?php
    include_once "common/base.php";
    include_once "common/header.php";
?>

    <body>



        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 post-box">
                    <form role="form" method="post">
                        <?php
                            if(!empty($_POST['post'])):
                            include_once "inc/class.users.inc.php";
                            $users = new dedaloUsers($db);
                            echo $users->createPost();
                            else:
                        ?>
                            <textarea placeholder="What would you like to share?" name="post" id="post"></textarea>

                            <div class="form-group post-options">
                                <select class="selectpicker post-dropdown" data-width="25%" name="topic" title="Topic">>
                                    <option value="1">Movies</option>
                                    <option value="2">Music</option>
                                    <option value="3">Events</option>
                                    <option value="4">Food</option>
                                    <option value="5">Restaurants</option>
                                    <option value="6">Sports</option>
                                    <option value="7">Books</option>
                                    <option value="8">Fashion</option>
                                    <option value="9">Wanderlust</option>
                                    <option value="10">Funny</option>
                                    <option value="11">Interesting</option>
                                    <option value="12">Lifestyle</option>
                                </select>
                                <select class="selectpicker post-dropdown" data-width="25%" name="media" title="Media">
                                    <option value="1">Video</option>
                                    <option value="2">Blog</option>
                                    <option value="3">Podcast</option>
                                    <option value="4">Article</option>
                                </select>
                                <button type="submit" class="btn btn-success pull-right" id="share_button"> Share</button>
                                <div class="liveurl">
                                    <div class="close" title="Remove"></div>
                                    <div class="inner">

                                        <div class="details">
                                            <div class="info">
                                                <div class="title"> </div>
                                                <div class="image"> </div>
                                                <div class="description"> </div>
                                                <div class="url" title="url"> </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php
                            endif;
                        ?>
                    </form>
                </div>
                <div class="col-md-4"></div>

                <script src="jquery.liveurl.js">
                </script>
                <script>
                    var curImages = new Array();

                    $('textarea').liveUrl({
                        // para empezar a mostrar el "loading"
                        loadStart: function () {
                            $('.liveurl-loader').show();
                        },
                        // para dejar de mostrar el "loading"
                        loadEnd: function () {
                            $('.liveurl-loader').hide();
                        },
                        // si se encuentra una URL válida, empieza el proceso principal
                        success: function (data) {
                            var output = $('.liveurl');
                            output.find('.title').text(data.title);
                            output.find('.description').text(data.description);
                            output.find('.url').text(data.url);
                            output.find('.image').empty();

                            // esto es sólo para cerrar el liveURL picándole a la X
                            output.find('.close').one('click', function () {
                                var liveUrl = $(this).parent();
                                liveUrl.hide('fast');
                                liveUrl.find('.video').html('').hide();
                                liveUrl.find('.image').html('');
                                liveUrl.find('.controls .prev').addClass('inactive');
                                liveUrl.find('.controls .next').addClass('inactive');
                                liveUrl.find('.thumbnail').hide();
                                liveUrl.find('.image').hide();

                                $('textarea').trigger('clear');
                                curImages = new Array();
                            });

                            output.show('fast');

                        },
                        // sin esta función no se puede(n) mostrar la(s) imagen(es)
                        addImage: function (image) {
                            var output = $('.liveurl');
                            var jqImage = $(image);
                            jqImage.attr('alt', 'Preview');

                            if ((image.width / image.height) > 16 ||
                                (image.height / image.width) > 9) {
                                // we dont want extra large images...
                                return false;
                            }

                            curImages.push(jqImage.attr('src'));
                            output.find('.image').append(jqImage);


                            if (curImages.length == 1) {
                                // first image...

                                output.find('.thumbnail .current').text('1');
                                output.find('.thumbnail').show();
                                output.find('.image').show();
                                jqImage.addClass('active');

                            }

                            if (curImages.length == 2) {
                                output.find('.controls .next').removeClass('inactive');
                            }

                            output.find('.thumbnail .max').text(curImages.length);
                        }
                    });
                </script>
            </div>
        </div>


        <div class="container">
            <div class="row">

                <div class="col-md-4 col-sm-6 col-xs-12 topic-box">
                    <div class="thumbnail text-center topic-image">
                        <a href="posts.php?topic=1">
                            <img src="images/movies.jpg" alt="" height="600" width="700">
                            <div class="caption" id="topic-caption">
                                <p>Movies</p>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="col-md-4 col-sm-6 col-xs-12 topic-box">
                    <div class="thumbnail text-center topic-image">
                        <a href="posts.php?topic=2">
                            <img src="images/music.jpg" alt="" height="600" width="700">
                            <div class="caption" id="topic-caption">
                                <p>Music</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 topic-box">
                    <div class="thumbnail text-center topic-image">
                        <a href="posts.php?topic=3">
                            <img src="images/events.jpg" alt="" height="600" width="700">
                            <div class="caption" id="topic-caption">
                                <p>Events</p>
                            </div>
                        </a>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-4 col-sm-6 col-xs-12 topic-box">
                    <div class="thumbnail text-center topic-image">
                        <a href="posts.php?topic=4">
                            <img src="images/food.jpg" alt="" height="600" width="700">
                            <div class="caption" id="topic-caption">
                                <p>Food</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 topic-box">
                    <div class="thumbnail text-center topic-image">
                        <a href="posts.php?topic=5">
                            <img src="images/restaurants.jpg" alt="" height="600" width="700">
                            <div class="caption" id="topic-caption">
                                <p>Restaurants</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 topic-box">
                    <div class="thumbnail text-center topic-image">
                        <a href="posts.php?topic=6">
                            <img src="images/sports.jpg" alt="" height="600" width="700">
                            <div class="caption" id="topic-caption">
                                <p>Sports</p>
                            </div>
                        </a>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-4 col-sm-6 col-xs-12 topic-box">
                    <div class="thumbnail text-center topic-image">
                        <a href="posts.php?topic=7">
                            <img src="images/books.jpg" alt="" height="600" width="700">
                            <div class="caption" id="topic-caption">
                                <p>Books</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 topic-box">
                    <div class="thumbnail text-center topic-image">
                        <a href="posts.php?topic=8">
                            <img src="images/fashion.jpg" alt="" height="600" width="700">
                            <div class="caption" id="topic-caption">
                                <p>Fashion</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 topic-box">
                    <div class="thumbnail text-center topic-image">
                        <a href="posts.php?topic=9">
                            <img src="images/wanderlust.jpg" alt="" height="600" width="700">
                            <div class="caption" id="topic-caption">
                                <p>Travel</p>
                            </div>
                        </a>
                    </div>
                </div>

            </div>

        </div>

        <script>
            $(document).ready(function () {
                $(".topic-box").hover(function () {
                        $(this).stop().animate({
                            "opacity": "0.5"
                        }, "fast");
                    },
                    function () {
                        $(this).stop().animate({
                            "opacity": "1"
                        }, "fast");
                    });
            });
        </script>

        <div class="container">
            <div class="row">
                <div class="col-sm-3 media-box">
                    <a href="posts.php?media=4" style="text-decoration:none; color:black;">
                        <div class="panel-body">
                            <h1 style="text-align:center;">Articles</h1>
                        </div>
                    </a>
                </div>
                <div class="col-sm-3 media-box">
                    <a href="posts.php?media=2" style="text-decoration:none; color:black;">
                        <div class="panel-body">
                            <h1 style="text-align:center;">Blogs</h1>
                        </div>
                    </a>
                </div>
                <div class="col-sm-3 media-box">
                    <a href="posts.php?media=1" style="text-decoration:none; color:black;">
                        <div class="panel-body">
                            <h1 style="text-align:center;">Videos</h1>
                        </div>
                    </a>
                </div>
                <div class="col-sm-3 media-box">
                    <a href="posts.php?media=3" style="text-decoration:none; color:black;">
                        <div class="panel-body">
                            <h1 style="text-align:center;">Podcasts</h1>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $(".media-box").hover(function () {
                        $(this).stop().animate({
                            "opacity": "0.5"
                        }, "fast");
                    },
                    function () {
                        $(this).stop().animate({
                            "opacity": "1"
                        }, "fast");
                    });
            });
        </script>
        <br>

        <?php
            print_r($_SESSION);
            ?>
            <script type="text/javascript" src="toggle_script.js"></script>
    </body>
    <?php include_once "common/footer.php"; ?>