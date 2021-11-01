<?php
require "../php/color.php";

if(!isset($_GET['type'])) {die();}
if(!isset($_GET['nosave'])) {$_GET['nosave'] = "false";}

$nosave = filter_var($_GET['nosave'], FILTER_VALIDATE_BOOLEAN);

function storeHSLValues($h, $s, $l, $isOn) {
      $raw = file_get_contents("../php/hsl.json");
      $raw = str_replace(array("[", "]"), "", $raw);
      $raw = explode(",", $raw);
      $raw[0] = $h;
      $raw[1] = $s;
      $raw[2] = $l;
      $raw[3] = filter_var($isOn, FILTER_VALIDATE_BOOLEAN);
      file_put_contents("../php/hsl.json", json_encode($raw));
}


if($_GET['type'] == "hsl") {
      $hue = $_GET['h'];
      $sat = $_GET['s'];
      $lum = $_GET['l'];
      $isOn = $_GET['isOn'];
      if(!$nosave){
            storeHSLValues($hue, $sat, $lum, $isOn);
      }
      $r = 0;
      $g = 0;
      $b = 0;
      if(filter_var($isOn, FILTER_VALIDATE_BOOLEAN)){
            $rgb = hsl2rgb($hue, $sat, $lum);
            $r = $rgb[0];
            $g = $rgb[1];
            $b = $rgb[2];
      }
      // TODO GPIO: Temporary pass to ESP8266
      file_get_contents("http://192.168.2.7/?r${r}g${g}b${b}");
}