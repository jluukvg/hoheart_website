<?php

$data = $_POST['base64data'];

$text_file = "text_file.txt";
file_put_contents($text_file, $data);

$file = "test.jpg";

$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));

$success = file_put_contents($file, $data);
print $success ? $file : 'Unable to save the file.';

?>