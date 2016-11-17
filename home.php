<?php
    include_once "common/base.php";
    include_once "common/header.php";
?>

    <body>

        <div class="container">
            <div class="comment-box">
                <?php
                  if(!empty($_POST['post'])):
                        include_once "inc/class.users.inc.php";
                        $users = new dedaloUsers($db);
                        echo $users->createPost();
                    else:
                 ?>

                    <div class="row">

                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div>
                                <div class="status-upload">
                                    <form role="form" method="post">
                                        <textarea placeholder="What would you like to share?" name="post" id="post"></textarea>
                                        <ul>

                                            <li>
                                                <select class="selectpicker" data-width="100%" name="topic" title="Topic">
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
                                            </li>
                                        </ul>
                                        <ul>

                                            <li>
                                                <select class="selectpicker" data-width="100%" name="media" title="Media">
                                                    <option value="1">Video</option>
                                                    <option value="2">Blog</option>
                                                    <option value="3">Podcast</option>
                                                    <option value="4">Article</option>
                                                </select>
                                            </li>
                                        </ul>
                                        <button type="submit" class="btn btn-success green" data-toggle="tooltip" data-placement="bottom" title="Hooray!"><i class="fa fa-share"></i> Share</button>
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
                                    </form>
                                </div>
                                <!-- Status Upload  -->
                            </div>
                            <!-- Widget Area -->
                        </div>
                        <div class="col-md-3"></div>

                    </div>
                    <?php
                            endif;
                        ?>
            </div>


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
        <br>

        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div style="background-color:#F5F5F5; border-radius: 28px; box-shadow: 2px 2px 7px #666666;">
                        <a href=posts.php?topic=1>
                            <div class="panel-body"><img src="images/movies.jpg" class="img-responsive" style="width:100%;" alt="Image">
                                <h1 style="text-align:center;">MOVIES</h1>
                        </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div style="background-color:#F5F5F5; border-radius: 28px; box-shadow: 2px 2px 7px #666666;">
                        <a href=posts.php?topic=2>
                            <div class="panel-body"><img src="images/music.jpg" class="img-responsive" style="width:100%" alt="Image">
                                <h1 style="text-align:center;">MUSIC</h1>
                        </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div style="background-color:#F5F5F5; border-radius: 28px; box-shadow: 2px 2px 7px #666666;">
                        <a href=posts.php?topic=3>
                            <div class="panel-body"><img src="images/events.jpg" class="img-responsive" style="width:100%" alt="Image">
                                <h1 style="text-align:center;">EVENTS</h1>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div style="background-color:#F5F5F5; border-radius: 28px; box-shadow: 2px 2px 7px #666666;">
                        <a href=posts.php?topic=4>
                            <div class="panel-body"><img src="images/food.jpg" class="img-responsive" style="width:100%" alt="Image">
                                <h1 style="text-align:center;">FOOD</h1>
                        </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div style="background-color:#F5F5F5; border-radius: 28px; box-shadow: 2px 2px 7px #666666;">
                        <a href=posts.php?topic=5>
                            <div class="panel-body"><img src="images/restaurants.jpg" class="img-responsive" style="width:100%" alt="Image">
                                <h1 style="text-align:center;">RESTAURANTS</h1>
                        </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div style="background-color:#F5F5F5; border-radius: 28px; box-shadow: 2px 2px 7px #666666;">
                        <a href=posts.php?topic=6>
                            <div class="panel-body"><img src="images/sports.jpg" class="img-responsive" style="width:100%" alt="Image">
                                <h1 style="text-align:center;">SPORTS</h1>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div style="background-color:#F5F5F5; border-radius: 28px; box-shadow: 2px 2px 7px #666666;">
                        <a href=posts.php?topic=7>
                            <div class="panel-body"><img src="images/books.jpg" class="img-responsive" style="width:100%;" alt="Image">
                                <h1 style="text-align:center;">BOOKS</h1>
                        </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div style="background-color:#F5F5F5; border-radius: 28px; box-shadow: 2px 2px 7px #666666;">
                        <a href=posts.php?topic=8>
                            <div class="panel-body"><img src="images/fashion.jpg" class="img-responsive" style="width:100%" alt="Image">
                                <h1 style="text-align:center;">FASHION</h1>
                        </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div style="background-color:#F5F5F5; border-radius: 28px; box-shadow: 2px 2px 7px #666666;">
                        <a href=posts.php?topic=9>
                            <div class="panel-body"><img src="images/wanderlust.jpg" class="img-responsive" style="width:100%" alt="Image">
                                <h1 style="text-align:center;">WANDERLUST</h1>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            print_r($_SESSION);
            ?>
        </div>
        <br>


        <script type="text/javascript" src="toggle_script.js"></script>
    </body>
    <?php include_once "common/footer.php"; ?>