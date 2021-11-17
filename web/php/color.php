<?php
function hsl2rgb($h, $s, $l)
{
    $c = (1 - abs(2 * ($l / 100) - 1)) * $s / 100;
    $x = $c * (1 - abs(fmod(($h / 60), 2) - 1));
    $m = ($l / 100) - ($c / 2);
    if ($h < 60) {
        $r = $c;
        $g = $x;
        $b = 0;
    } elseif ($h < 120) {
        $r = $x;
        $g = $c;
        $b = 0;
    } elseif ($h < 180) {
        $r = 0;
        $g = $c;
        $b = $x;
    } elseif ($h < 240) {
        $r = 0;
        $g = $x;
        $b = $c;
    } elseif ($h < 300) {
        $r = $x;
        $g = 0;
        $b = $c;
    } else {
        $r = $c;
        $g = 0;
        $b = $x;
    }
    return [floor(($r + $m) * 255), floor(($g + $m) * 255), floor(($b + $m) * 255)];
} 
?>