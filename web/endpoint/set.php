<?php
require "../php/color.php";
session_start();

if(!isset($_GET['type'])) {die();}
if(!isset($_GET['nosave'])) {$_GET['nosave'] = "false";}

$nosave = filter_var($_GET['nosave'], FILTER_VALIDATE_BOOLEAN);

function dieError($index) {
      header("Content-Type: application/json");
      $errorJSON = json_decode(file_get_contents("../php/error.json"), true);
      $return = array("error" => $errorJSON[$index]);
      die(json_encode($return));
}

function validatePassword() {
      $loginJSON = json_decode(file_get_contents("../php/login.json"), true);
      if(isset($_SESSION['pass_hash'])){
            if($_SESSION['pass_hash'] != $loginJSON['password']) {
                  dieError(0);
            }
      } elseif(isset($_GET['pass'])) {
            $hashed = hash("sha256", $_GET['pass']);
            if($hashed != $loginJSON['password']) {
                  dieError(0);
            }
      } else {
            dieError(2);
      }
}


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
} elseif($_GET['type'] == "enablepass") {
      validatePassword();
      $loginJSON = json_decode(file_get_contents("../php/login.json"), true);
      if(isset($_GET['enablePassword'])) {
            if($_GET['enablePassword'] == "on") {
                  $loginJSON['enabled'] = true;
            } elseif($_GET['enablePassword'] == "off") {
                  $loginJSON['enabled'] = false;
            }
      } else {
            $loginJSON['enabled'] = false;
      }
      file_put_contents("../php/login.json", json_encode($loginJSON));
}