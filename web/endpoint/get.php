<?php
require "../php/color.php";
header("Content-Type: application/json");

$github_release_url = "https://api.github.com/repos/samdahles/Lux/releases";


if(!isset($_GET['data'])) {
   $data = "{\"error\" : \"No ?data GET parameter has been specified.\"}";
} else {
    if($_GET['data'] == "rgb") {
        $raw = file_get_contents("../php/hsl.json");
        $raw = str_replace(array("[", "]"), "", $raw);
        $raw = explode(",", $raw);
        $rgb = hsl2rgb($raw[0], $raw[1], $raw[2]);
        $raw[0] = $rgb[0];
        $raw[1] = $rgb[1];
        $raw[2] = $rgb[2];
        $raw[3] = filter_var($raw[3], FILTER_VALIDATE_BOOLEAN);
        $data = json_encode($raw);
    } elseif($_GET['data'] == "hsl") {
        $data = file_get_contents("../php/hsl.json", true);
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
        $data = json_encode($settings);
        file_put_contents("../php/settings.json", $data);
    } else {
        $data = "{\"error\" : \"Argument '{$_GET['data']}' for ?data GET parameter is unknown.\"}";
    }
}

echo $data;
?>