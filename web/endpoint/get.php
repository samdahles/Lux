<?php
require "../php/color.php";
header("Content-Type: application/json");



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
        $data = file_get_contents("../php/hsl.json");
    } elseif($_GET['data'] == "settings") {
        $data = file_get_contents("../php/settings.json");
    } else {
        $data = "{\"error\" : \"Argument '{$_GET['data']}' for ?data GET parameter is unknown.\"}";
    }
}

echo $data;
?>