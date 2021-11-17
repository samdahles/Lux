<?php
require "../php/color.php";
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$github_release_url = "https://api.github.com/repos/samdahles/Lux/releases";

function dieError($index) {
    header("Content-Type: application/json");
    $errorJSON = json_decode(file_get_contents("../php/error.json"), true);
    $return = array("error" => $errorJSON[$index]);
    die(json_encode($return));
}

if(!isset($_GET['data'])) {
    dieError(4);
} else {

    if($_GET['data'] == "rgb") {
        $hsl = json_decode(file_get_contents("../php/hsl.json"), true);
        $rgb = hsl2rgb($hsl[0], $hsl[1], $hsl[2]);
        $hsl[3] = filter_var($hsl[3], FILTER_VALIDATE_BOOLEAN);
        $data = json_encode($hsl);
    } elseif($_GET['data'] == "hsl") {
        $data = file_get_contents("../php/hsl.json");
    } elseif($_GET['data'] == "settings") {
        $settings = json_decode(file_get_contents("../php/settings.json"), true);
        $context = stream_context_create(
            array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                )
            )
        );
        $github_releases = @file_get_contents($github_release_url, false, $context);
        if($github_releases != false) { // i.e. rate limit
            $github_latest = json_decode($github_releases, true)[0]['tag_name'];
            $settings['latest'] = $github_latest;
        }
        if($settings['build'] != $settings['latest']) {
            $settings['isUpdate'] = true;
        } else {
            $settings['isUpdate'] = false;
        }

        $loginInfo = json_decode(file_get_contents("../php/login.json"), true);
        
        $settingsOnly = json_encode($settings);
        file_put_contents("../php/settings.json", $settingsOnly);

        $settings['isLoginEnabled'] = $loginInfo['enabled'];
        $settings['latestLogin'] = $loginInfo['lastLogin'];
        $settings['forward']['code'] = $loginInfo['forwardPassword'];
        $data = json_encode($settings);

    } else {
        dieError(5);
    }
}

echo $data;
?>