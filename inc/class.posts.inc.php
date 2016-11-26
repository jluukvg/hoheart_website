<?php
include_once "constants.inc.php";
include_once('OpenGraph.php');
/* Handles post interactions within the website */

class hoheartPosts
{
    private $_db;

    public function __construct($db=NULL)
    {
        if(is_object($db))
        {
            $this->_db = $db;
        }
        else
        {
            $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
            $this->_db = new PDO($dsn, DB_USER, DB_PASS);
        }
    }

    
    public function createPost()
    {
      $post = trim($_POST['post']);

      // The Regular Expression filter
      $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

      // Check if there is a url in the text
      if(preg_match($reg_exUrl, $post, $url)) {

         // make the urls hyper links
         $final_text = preg_replace($reg_exUrl, '', $post);

      } else {

         // if no urls in the text just return the text
         $final_text = $post;

      }

      $topic = trim($_POST['topic']);
      $media = trim($_POST['media']);
      $userID = $_SESSION["user_id"];

      $sql = "INSERT INTO posts(message, topic_id, media_id, link_url, user_id, post_time)
              VALUES(:post, :topic, :media, :url, :user, NOW())";

      if($stmt = $this->_db->prepare($sql)) {
        $stmt->bindParam(":post", $final_text, PDO::PARAM_STR);
        $stmt->bindParam(":topic", $topic, PDO::PARAM_STR);
        $stmt->bindParam(":media", $media, PDO::PARAM_STR);
        $stmt->bindParam(":url", $url[0], PDO::PARAM_STR);
        $stmt->bindParam(":user", $userID, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
          
        $this->extractLinkInfo($url[0]);

        return "<h2> Success! </h2>"."<p>Your post was successfully created.</p>";
      }
      else {
        return "<h2> Error </h2>"."<p>No post created.</p>";
      }
    }
    
    private function extractLinkInfo($url)
    {
        if (OpenGraph::fetch($url)){
            $extracted = $this->checkIfExtracted($url);
            if (!$extracted){
                $graph = OpenGraph::fetch($url);
                if (isset($graph->title)){
                    $link_title = $graph->title;
                    $link_url = $url;
                    if (isset($graph->image)){
                        $image_url = $graph->image;
                    } else {
                        $image_url = NULL;
                    }
                    if (isset($graph->description)){
                        $link_description = $graph->description;
                    } else {
                        $link_description = NULL;
                    }
                    if (isset($graph->site_name)){
                        $link_site = $graph->site_name;
                    } else {
                        $link_site = NULL;
                    }

                } else {
                    $link_title = "No title found";
                    $link_description = $row['link_url'];
                    $image_url = NULL;
                    $link_site = NULL;
                    $link_url = $url;
                } 
                
                $sql = "INSERT INTO `extracts`(`url`, `title`, `description`, `link_site`, `image_url`) VALUES (:url, :title, :description , :link_site, :image_url)";
        
                if($stmt = $this->_db->prepare($sql)) {
                    $stmt->bindParam(":url", $link_url, PDO::PARAM_STR);
                    $stmt->bindParam(":title", $link_title, PDO::PARAM_STR);
                    $stmt->bindParam(":description", $link_description, PDO::PARAM_STR);
                    $stmt->bindParam(":link_site", $link_site, PDO::PARAM_STR);
                    $stmt->bindParam(":image_url", $image_url, PDO::PARAM_STR);
                    $stmt->execute();
                    $stmt->closeCursor();
                }
            
            } else{
                $link_url = $url;
                list ($link_title, $link_description, $image_url, $link_site) = $extracted;
            }
                
        } else {
            $link_title = "This URL didn't work";
            $link_description = $row['link_url'];
            $image_url = "EMPTY";
            $link_site = "EMPTY";
            $link_url = $url;
        }
        /*echo $link_title . "<br>";
        echo $link_description . "<br>";
        echo $image_url . "<br>";
        echo $link_site . "<br>";
        echo $link_url . "<br>"; */  
    }
    
    private function checkIfExtracted($url)
    {
        $sql = "SELECT *
                FROM extracts
                WHERE url=:url
                LIMIT 1";
        try
        {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':url', $url, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            $stmt->closeCursor();
            if (isset($row['url'])){
                return array($row['title'], $row['description'], $row['image_url'], $row['link_site']);
            } else{
                return FALSE;
            }
        }
        catch(PDOException $e)
        {
            return FALSE;
        }
    }
    
    public function loadPostsByTopic()
    {
        try {
                
                //echo $_GET['topic'];
                $topic = $_GET['topic'];
                
                // Find out how many items are in the table
                $row_count_sql = "SELECT COUNT(message_id) FROM posts WHERE topic_id=:topic AND message IS NOT NULL";
            
                $stmt = $this->_db->prepare($row_count_sql);
            
                $stmt->bindParam(':topic', $topic, PDO::PARAM_INT);
            
                $stmt->execute();
            
                $row_count = $stmt->fetchColumn(0);
            
                //echo "total:$row_count";
                
                // How many items to list per page
                $limit = 10;
                //echo " limit:$limit";
                
                // How many pages will there be
                $pages = ceil($row_count / $limit);
                //echo " pages:$pages";
            
                // What page are we currently on?
                $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array('options' => array('default' => 1, 'min_range' => 1,),)));
                //echo " page:$page";
            
                // Calculate the offset for the query
                $offset = ($page - 1)  * $limit;
                //echo " offset:$offset";
            
                // Some information to display to the user
                $start = $offset + 1;
                $end = min(($offset + $limit), $row_count);
                //echo " start:$start end:$end";
            
                // The "back" link
                $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

                // The "forward" link
                $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

                // Prepare the paged query
                $sql = "SELECT posts.message_id, posts.user_id, posts.message, posts.link_url, posts.post_time, users.first_name, users.last_name, extracts.title, extracts.description, extracts.link_site, extracts.image_url
                FROM posts
                INNER JOIN users ON posts.user_id = users.user_id
                INNER JOIN extracts ON posts.link_url = extracts.url
                WHERE posts.topic_id = :topic AND posts.message IS NOT NULL
                ORDER BY posts.post_time DESC
                LIMIT :limit
                OFFSET :offset"; 
            
                $stmt2 = $this->_db->prepare($sql);
            
                // Bind the query params
                $stmt2->bindParam(':topic', $_GET['topic'], PDO::PARAM_STR);
                $stmt2->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt2->bindParam(':offset', $offset, PDO::PARAM_INT);
                $stmt2->execute();
            
                // Do we have any results?
                if ($stmt2->rowCount() > 0) {
                    // Define how we want to fetch the results
                    $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                    $iterator = new IteratorIterator($stmt2);

                    // Display the results
                    foreach ($iterator as $row) {
                        $link_title = $row['title'];
                        $link_description = $row['description'];
                        $image_url = $row['image_url'];
                        $link_site = $row['link_site'];
                        $link_url = $row['link_url'];
                        
                        ?>
    <div class="container">
        <div class="row">
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
                    <h3><?php echo $row['first_name'], ' ', $row['last_name']?></h3>
                    <h5><span>Shared publicly</span> - <span><?php echo $row['post_time']?></span> </h5>
                </div>
                <div class="panel-body">
                    <p>
                        <?php echo $row['message']?>
                    </p>
                </div>
                <div class="post_website">
                    <a href="<?php echo $link_url?>" target="_blank" style="text-decoration:none; color:black;">
                        <div class="stuff">
                            <div class="info">
                                <div class="image">
                                    <img src="<?php echo $image_url?>" alt="Oops!" width="475px" height="250px"></div>

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
        </div>
    </div>



    </br>
    <?php
                        
                    }

                } else {
                    echo '<p>No results could be displayed.</p>';
                }
    
            // Display the paging information
            echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $row_count, ' results ', $nextlink, ' </p></div>';
        
        } catch (Exception $e) {
            echo '<p>', $e->getMessage(), '</p>';
        }   
    }
    
    public function loadPostsByMedia()
    {
        try {
                
                echo $_GET['media'];
                $media = $_GET['media'];
                
                // Find out how many items are in the table
                $row_count_sql = "SELECT COUNT(message_id) FROM posts WHERE media_id=:media AND message IS NOT NULL";
            
                $stmt = $this->_db->prepare($row_count_sql);
            
                $stmt->bindParam(':media', $media, PDO::PARAM_INT);
            
                $stmt->execute();
            
                $row_count = $stmt->fetchColumn(0);
            
                echo "total:$row_count";
                
                // How many items to list per page
                $limit = 10;
                echo " limit:$limit";
                
                // How many pages will there be
                $pages = ceil($row_count / $limit);
                echo " pages:$pages";
            
                // What page are we currently on?
                $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array('options' => array('default' => 1, 'min_range' => 1,),)));
                echo " page:$page";
            
                // Calculate the offset for the query
                $offset = ($page - 1)  * $limit;
                echo " offset:$offset";
            
                // Some information to display to the user
                $start = $offset + 1;
                $end = min(($offset + $limit), $row_count);
                echo " start:$start end:$end";
            
                // The "back" link
                $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

                // The "forward" link
                $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

                $sql = "SELECT posts.message_id, posts.user_id, posts.message, posts.link_url, posts.post_time, users.first_name, users.last_name, extracts.title, extracts.description, extracts.link_site, extracts.image_url
                FROM posts
                INNER JOIN users ON posts.user_id = users.user_id
                INNER JOIN extracts ON posts.link_url = extracts.url
                WHERE posts.media_id = :media AND posts.message IS NOT NULL
                ORDER BY posts.post_time DESC
                LIMIT :limit
                OFFSET :offset"; 
            
                $stmt2 = $this->_db->prepare($sql);
            
                // Bind the query params
                $stmt2->bindParam(':media', $_GET['media'], PDO::PARAM_STR);
                $stmt2->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt2->bindParam(':offset', $offset, PDO::PARAM_INT);
                $stmt2->execute();
            
                // Do we have any results?
                if ($stmt2->rowCount() > 0) {
                    // Define how we want to fetch the results
                    $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                    $iterator = new IteratorIterator($stmt2);

                    // Display the results
                    foreach ($iterator as $row) {
                        //echo '<p>', $row['message_id'], $row['message'], '</p>';
                        //echo '<p>', $row['user_id'], ' ', $row['post_time'], ' ', $row['message'], ' ', $row['link_url'], $row['first_name'], ' ', $row['last_name'], '</p>';
                        $link_title = $row['title'];
                        $link_description = $row['description'];
                        $image_url = $row['image_url'];
                        $link_site = $row['link_site'];
                        $link_url = $row['link_url'];
                        
                        ?>
    <div class="container">
        <div class="row">
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
                    <h3><?php echo $row['first_name'], ' ', $row['last_name']?></h3>
                    <h5><span>Shared publicly</span> - <span><?php echo $row['post_time']?></span> </h5>
                </div>
                <div class="panel-body">
                    <p>
                        <?php echo $row['message']?>
                    </p>
                </div>
                <div class="post_website">
                    <a href="<?php echo $link_url?>" target="_blank" style="text-decoration:none; color:black;">
                        <div class="stuff">
                            <div class="info">
                                <div class="image">
                                    <img src="<?php echo $image_url?>" alt="Oops!" width="475px" height="250px"></div>

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
        </div>
    </div>



    </br>
    <?php
                        
                             
                        
                        
                        
                        
                        
                    }

                } else {
                    echo '<p>No results could be displayed.</p>';
                }
    
            // Display the paging information
            echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $row_count, ' results ', $nextlink, ' </p></div>';
        
        } catch (Exception $e) {
            echo '<p>', $e->getMessage(), '</p>';
        }   
    }
}
?>