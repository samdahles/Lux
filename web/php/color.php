<?php
function rgb2hsl($r, $g, $b)
{
    $r /= 255;
    $g /= 255;
    $b /= 255;
    $max = max($r, $g, $b);
    $min = min($r, $g, $b);
    $h = 0;
    $s = 0;
    $l = ($max + $min) / 2;
    $d = $max - $min;
    if ($d == 0) {
        $h = $s = 0;
    } else {
        $s = $d / (1 - abs(2 * $l - 1));
        switch ($max) {
            case $r:
                $h = 60 * fmod((($g - $b) / $d), 6);
                if ($b > $g) {
                    $h += 360;
                }
                break;
            case $g:
                $h = 60 * (($b - $r) / $d + 2);
                break;
            case $b:
                $h = 60 * (($r - $g) / $d + 4);
                break;
            default:
                $h = 0;
                break;
        }
    }
    return [round($h, 0), round($s * 100, 0), round($l * 100, 0)];
}

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