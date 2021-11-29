<?php

if(!isset($_GET['url'])) {die();}

$url = base64_decode($_GET['url']);
$url = str_replace("https://", "", $url);
$url = str_replace("http://", "", $url);


file_get_contents("http://" . $url);