<?php
    include_once "common/base.php";
 
    if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])
        && $_SESSION['LoggedIn']==1):
        
        include_once "common/header.php";
?>

    <body>
        <p>Put something here.</p>

        <!--<form action="upload.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form>-->


        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-md-3">
                    <div class="panel-group level1" id="accordion" role="tablist" aria-multiselectable="true">

                        <div class="panel panel-default admin-menu">
                            <div class="panel-heading" role="tab" id="heading1">
                                <h4 class="panel-title">
                                <a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    Posts
                                </a>
                            </h4>
                            </div>
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

                        <div class="panel panel-default">
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

                        <div class="panel panel-default">
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

                        <div class="panel panel-default">
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
                                                Basic Information
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Change Password
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Change Profile Picture
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Privacy
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
                
                <div class="col-sm-9 col-md-9 well admin-content">
                    <p>Arbitror varias offendit admodum in magna efflorescere appellat minim incididunt. Est minim voluptate efflorescere, sed proident illustriora, enim illustriora pariatur nulla commodo, illum domesticarum mandaremus elit possumus ab nam aliqua quae fore arbitror, id fugiat distinguantur non ut cernantur tractavissent ita elit in incididunt est veniam. Arbitror elit est vidisse sempiternum ita minim voluptate sed illum sint, non dolore appellat mentitum iis anim proident an nescius non duis tempor iis laboris se vidisse de quid sed elit consectetur laborum sunt fabulas, litteris velit laborum nescius. Legam officia ubi fabulas nam ullamco est elit possumus, quamquam veniam est aliquip relinqueret id probant elit sint probant anim eu senserit de tamen, ubi iudicem si doctrina id ingeniis nisi duis nam nulla, nescius aute ipsum expetendis quorum. Ita elit proident praetermissum, occaecat illum e quibusdam sempiternum, esse id iudicem ea magna, mandaremus ea singulis hic veniam ingeniis distinguantur, hic quamquam praesentibus, quibusdam in lorem iis eram ubi eu aute aliquip. Est elit expetendis, nostrud summis amet litteris eram eu iudicem esse ab iudicem fidelissimae ut quae transferrem incididunt velit doctrina. Et sed graviterque. Tamen aut hic aliqua proident, ut fugiat occaecat deserunt.Aute est id multos admodum, ut magna ita malis, e sint excepteur est a tamen comprehenderit. Iis ad elit ullamco et irure est fabulas ita legam, lorem appellat adipisicing, qui de duis illum veniam. Dolor do senserit ita quid id malis hic si aute laborum, ipsum mandaremus ita cohaerescant, anim ne expetendis eu sint te ex malis probant coniunctione, sed ullamco comprehenderit iis cupidatat legam ubi laboris instituendarum ut veniam imitarentur laborum culpa nostrud. Multos voluptate aut excepteur. Legam nescius appellat. Velit iudicem an distinguantur, dolor eiusmod arbitrantur, fabulas an incididunt, in nisi offendit arbitrantur, an enim occaecat probant ut singulis malis voluptate deserunt te iudicem quae a nescius exercitation in elit a tempor.</p>
                </div>

                <?php
                    include_once 'inc/class.posts.inc.php';
                    $posts = new hoheartPosts($db);
                ?>

                    <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-movies">
                        Movies
                        <?php
                            $topic = "1"; 
                            $posts->loadPostsByTopic($topic);
                        ?>
                    </div>
                <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-music"> Music </div>
                <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-events"> Events </div>
                <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-food"> Food </div>
                <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-restaurants"> Restaurants </div>
                <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-sports"> Sports </div>
                <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-books"> Books </div>
                <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-fashion"> Fashion </div>
                <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-travel"> Travel </div>
                <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-funny"> Funny </div>
                <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-interesting"> Interesting </div>
                <div class="col-sm-9 col-md-9 well admin-content" id="posts-topics-lifestyle"> Lifestyle </div>
            </div>
        </div>







    </body>

    <script>
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
    </script>

    <?php 
    include_once "common/footer.php";

    else:
        header("Location: index.php"); 
        exit();
    endif;
?>