<?php

require_once('OpenGraph.php');


$url = "http://www.imdb.com/title/tt2543164/";

$graph = OpenGraph::fetch($url);
//var_dump($graph->keys());


if (OpenGraph::fetch($url)){
    echo "Title: " . $graph->title . "<br>";
    echo "Description: " . $graph->description . "<br>";
    echo "Image: " . $graph->image . "<br>";
    echo "Site name: " . $graph->site_name . "<br>";
    echo "URL: " . $graph->url . "<br>";
    
} else {
    echo "IT WAS NOT POSSIBLE TO EXTRACT STUFF!";
}


/*if ($graph->__isset('title')){
    echo "TITLE FOUND";
} else {
    echo "TITLE NOT FOUND!!";
}

echo $graph->hasLocation();*/



//var_dump($graph->schema);

/*foreach ($graph as $key => $value) {
    echo "$key -- $value"."<br>";
}*/



?>