<?php
require "../php/color.php";
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
session_start();

if(!isset($_GET['type'])) {die();}
if(!isset($_GET['nosave'])) {$_GET['nosave'] = "false";}

$nosave = filter_var($_GET['nosave'], FILTER_VALIDATE_BOOLEAN);

function dieError($index) {
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

function safeDomain($address) {
      $hostname = $address . "";
      $hostname = str_replace("https://", "", $hostname);
      $hostname = str_replace("http://", "", $hostname);
      if(substr($hostname, -1) == "/") {
            $hostname = substr($hostname, 0, -1);
      }
      $hostname_paths = explode("/", $address);
      $hostname_paths_urlencoded = $hostname_paths;
      for($i=0; $i<sizeof($hostname_paths); $i++){
            $path = $hostname_paths[$i];
            $hostname_paths_urlencoded[$i] = urlencode($path);
      }
      $hostname = join("/", $hostname_paths_urlencoded);
      return $hostname;
}

function storeHSLValues($h, $s, $l, $isOn) {
      $raw = file_get_contents("../php/hsl.json");
      $raw = str_replace(array("[", "]"), "", $raw);
      $raw = explode(",", $raw);
      $raw[0] = $h;
      $raw[1] = $s;
      $raw[2] = $l;
      $raw[3] = filter_var($isOn, FILTER_VALIDATE_BOOLEAN);
      return file_put_contents("../php/hsl.json", json_encode($raw));
}

if($_GET['type'] == "hsl") {
      validatePassword();
      if(!isset($_GET['h']) || !isset($_GET['s']) || !isset($_GET['l']) || !isset($_GET['isOn'])) {
            dieError(4);
      }
      $hue = $_GET['h'];
      $sat = $_GET['s'];
      $lum = $_GET['l'];
      $isOn = $_GET['isOn'];

      $settingsJSON = json_decode(file_get_contents("../php/settings.json"), true);


      $r = 0;
      $g = 0;
      $b = 0;
      if(filter_var($isOn, FILTER_VALIDATE_BOOLEAN)){
            $rgb = hsl2rgb($hue, $sat, $lum);
            $r = $rgb[0];
            $g = $rgb[1];
            $b = $rgb[2];
      }
      $addresses = $settingsJSON['IOHandler']['address'];

      foreach ($addresses as $address) {
            file_get_contents("http://". $address ."/?r${r}g${g}b${b}");
      }

      if(!$nosave){
            $ret = storeHSLValues($hue, $sat, $lum, $isOn);
            if($ret != false) {
                  echo json_encode(array("success" => $ret . " bytes have been written."));
            } else {
                  echo json_encode(array("error" => "Could not write to file."));
            }
      }

} elseif($_GET['type'] == "direct") {
      if(!isset($_GET['r']) || !isset($_GET['g']) || !isset($_GET['b'])) {
            dieError(4);
      }
      $settingsJSON = json_decode(file_get_contents("../php/settings.json"), true);
      $addresses = $settingsJSON['IOHandler']['address'];
      $r = $_GET['r'];
      $g = $_GET['g'];
      $b = $_GET['b'];
      foreach ($addresses as $address) {
            file_get_contents("http://". $address ."/?r${r}g${g}b${b}");
      }
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
} elseif($_GET['type'] == "setpass") {
      validatePassword();
      if(!isset($_GET['oldcode']) || !isset($_GET['code'])) {
            dieError(4);
      }


      $loginJSON = json_decode(file_get_contents("../php/login.json"), true);
      $hashed = hash("sha256", $_GET['oldcode']);

      if($hashed != $loginJSON['password']) {
            dieError(0);
      }

      if(!is_numeric($_GET['code']) || strlen($_GET['code']) != 4){
            dieError(5);
      }

      $loginJSON['password'] = hash("sha256", $_GET['code']);
      $_SESSION['pass_hash'] = $loginJSON['password'];
      file_put_contents("../php/login.json", json_encode($loginJSON));
      echo json_encode(array("success" => "Your password has been set to " . $_GET['code'] . "."));
} elseif($_GET['type'] == "forwardenable") {
      validatePassword();
      $settingsJSON = json_decode(file_get_contents("../php/settings.json"), true);
      if(isset($_GET['enableForward'])) {
            if($_GET['enableForward'] == "on") {
                  $settingsJSON['forward']['enabled'] = true;
            } elseif($_GET['enableForward'] == "off") {
                  $settingsJSON['forward']['enabled'] = false;
            }
      } else {
            $settingsJSON['forward']['enabled'] = false;
      }
      file_put_contents("../php/settings.json", json_encode($settingsJSON));
} elseif($_GET['type'] == "forwardcode") {
      validatePassword();
      if(!isset($_GET['code'])) {dieError(4);}
      if(!is_numeric($_GET['code']) || strlen($_GET['code']) != 4) { dieError(5); }
      $loginJSON = json_decode(file_get_contents("../php/login.json"), true);
      $loginJSON['forwardPassword'] = $_GET['code'];
      file_put_contents("../php/login.json", json_encode($loginJSON));      
} elseif($_GET['type'] == "forwardaddress") {
      validatePassword();
      if(!isset($_GET['address'])) {dieError(4);}
      $settingsJSON = json_decode(file_get_contents("../php/settings.json"), true);
      $address = safeDomain($_GET['address']);
      $settingsJSON['forward']['to'] = $address;
      file_put_contents("../php/settings.json", json_encode($settingsJSON));
} elseif($_GET['type'] == "addIOHandlerAddress" || $_GET['type'] == "removeIOHandlerAddress") {
      validatePassword();
      if(!isset($_GET['address'])) {dieError(4); }
      $settingsJSON = json_decode(file_get_contents("../php/settings.json"), true);
      $address = safeDomain($_GET['address']);     
      if($_GET['type'] == "addIOHandlerAddress") {
            if (($key = array_search($address, $settingsJSON['IOHandler']['address'])) !== false) {
                  $ret = json_encode(array("error" => $address . " already exists."));
            } else {
                  array_push($settingsJSON['IOHandler']['address'], $address);
                  $ret = json_encode(array("success" => "Successfully added " . $address . " to the list."));
            }
      } else {
            if (($key = array_search($address, $settingsJSON['IOHandler']['address'])) !== false) {
                  unset($settingsJSON['IOHandler']['address'][$key]);
                  $ret = json_encode(array("success" => "Successfully deleted " . $address . " from the list."));
            } else {
                  $ret = json_encode(array("error" => $address . " does not exist. It probably has already been deleted."));
            }
      }
      file_put_contents("../php/settings.json", json_encode($settingsJSON));
      die($ret);
} else {
      dieError(5);
}