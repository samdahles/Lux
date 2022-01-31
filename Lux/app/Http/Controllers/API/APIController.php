<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class APIController extends Controller
{

    public static function authNeeded() {
        return false;
    }

    protected static function toJSON($array)
    {
        return json_encode($array);
    }

    protected static function toArray($JSON)
    {
        return json_decode($JSON, true);
    }

    public static function getSettingsArray()
    {
        return APIController::toArray(File::get(resource_path('settings/settings.json')));
    }

    public static function getLoginArray()
    {
        return APIController::toArray(File::get(resource_path('settings/login.json')));
    }

    public static function getHSLArray()
    {
        return APIController::toArray(File::get(resource_path('settings/hsl.json')));
    }

    protected function HEX2RGB($hex)
    {
        if ($hex[0] == '#') $hex = substr($hex, 1);
        list($r, $g, $b) = array_map("hexdec", str_split($hex, (strlen( $hex ) / 3)));
        return array(floor($r), floor($g), floor($b));
    }

    protected function RGB2HSL($r, $g, $b)
    {
        $oldR = $r;
        $oldG = $g;
        $oldB = $b;

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
            }
        }

        return array(round($h, 2), round($s, 2), round($l, 2));
    }

    protected function HSL2RGB($h, $s, $l)
    {
        $r = 0;
        $g = 0;
        $b = 0;

        $c = (1 - abs(2 * $l - 1)) * $s;
        $x = $c * (1 - abs(fmod(($h / 60), 2) - 1));
        $m = $l - ($c / 2);

        if ($h < 60) {
            $r = $c;
            $g = $x;
            $b = 0;
        } else if ($h < 120) {
            $r = $x;
            $g = $c;
            $b = 0;
        } else if ($h < 180) {
            $r = 0;
            $g = $c;
            $b = $x;
        } else if ($h < 240) {
            $r = 0;
            $g = $x;
            $b = $c;
        } else if ($h < 300) {
            $r = $x;
            $g = 0;
            $b = $c;
        } else {
            $r = $c;
            $g = 0;
            $b = $x;
        }

        $r = ($r + $m) * 255;
        $g = ($g + $m) * 255;
        $b = ($b + $m) * 255;

        return array(floor($r), floor($g), floor($b));
    }

    protected function RGB2HEX($r, $g, $b)
    {
        return sprintf("#%02x%02x%02x", $r, $g, $b);
    }

    protected function auth()
    {
        $isLoggedIn = true; // TODO: Validation
        return $isLoggedIn;
    }

    protected function setSettings(array $object)
    {
        return File::put(resource_path('settings/settings.json'), $this->toJSON($object));
    }

    protected function setLogin(array $object) {
        return File::put(resource_path('settings/login.json'), $this->toJSON($object));
    }

    protected function setHSL(array $object) {
        return File::put(resource_path('settings/hsl.json'), $this->toJSON($object));
    }
}
