<?php

require_once('OpenGraph.php');
require_once('simple_html_dom.php');

$url = "http://www.elnorte.com/aplicaciones/articulo/default.aspx?id=991573";

$graph = OpenGraph::fetch($url);
//var_dump($graph->keys());


if (OpenGraph::fetch($url)){
    if (isset($graph->description)){
        echo "Title: " . $graph->title . "<br>";
    }
    echo "Title: " . $graph->title . "<br>";
    echo "Description: " . $graph->description . "<br>";
    echo "Image: " . $graph->image . "<br>";
    echo "Site name: " . $graph->site_name . "<br>";
    echo "URL: " . $graph->url . "<br>";
} else{
   echo "IT WAS NOT POSSIBLE TO EXTRACT STUFF!"; 
}



$html = file_get_html($url);


foreach($html->find('og:title') as $element) 
       echo $element->content . '<br>';

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