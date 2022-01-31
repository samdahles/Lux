<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ColorController extends APIController
{
    public function getCurrentHSL(Request $request) {
        return $this->toJSON($this->getHSLArray());
    }

    public function getCurrentRGB(Request $request) {
        $hsl = $this->getHSLArray();
        $rgb = $this->HSL2RGB($hsl[0], $hsl[1], $hsl[2]);
        $rgb[3] = $hsl[3];
        return $this->toJSON($rgb);
    }

    public function setCurrentHSL(Request $request, $h, $s, $l, $isOn) {
        $this->storeHSL($h, $s, $l, $isOn);
        $this->sendToPeers($h, $s, $l, $isOn);
    }

    public function setCurrentRGB(Request $request, $r, $g, $b, $isOn) {
        [$h, $s, $l] = $this->RGB2HSL($r, $g, $b);
        $this->storeHSL($h, $s, $l, $isOn);
        $this->sendToPeers($h, $s, $l, $isOn);
    }

    public function setDirectHSL(Request $request, $h, $s, $l, $isOn) {
        $this->sendToPeers($h, $s, $l, $isOn);
    }

    public function setDirectRGB(Request $request, $r, $g, $b, $isOn) {
        [$h, $s, $l] = $this->RGB2HSL($r, $g, $b);
        $this->sendToPeers($h, $s, $l, $isOn);
    }

    private function sendToPeers($h, $s, $l) {
        // Send to forwarded device
        // Send to linked devices
    }

    private function storeHSL($h, $s, $l, $isOn) {
        $this->setHSL([$h, $s, $l, $isOn]);
    }
}
