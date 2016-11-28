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
                    <div class="panel-group" id="accordion_master">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion_master" href="#collapse1">Posts</a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="panel-group" id="accordion_posts">
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion_posts" href="#posts_collapse1">Topics</a>
                                </h4>
                                                    <div id="posts_collapse1" class="panel-collapse collapse">
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
                                                            </table>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion_posts" href="#posts_collapse2">Media</a>
                                </h4>
                                                    <div id="posts_collapse2" class="panel-collapse collapse">
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
                                                            </table>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion_master" href="#collapse2">Likes</a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <table class="table">
                                        <tr>
                                            <td>
                                                Topics
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Media
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion_master" href="#collapse3">Friends</a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
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
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion_master" href="#collapse4">Account</a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
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
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-9 col-md-9">
                    <p>This is a text.This is a text.This is a text.This is a text.This is a text.This is a text.This is a text.This is a text.This is a text.This is a text.This is a text.This is a text.This is a text.This is a text.This is a text.This is a text.</p>
                </div>
            </div>
        </div>







    </body>

    <?php 
    include_once "common/footer.php";

    else:
        header("Location: index.php"); 
        exit();
    endif;
?>