<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends APIController
{
    public function getSettings(Request $request) {
        if(!$this->auth()) return redirect('/');
        $settings = $this->getSettingsArray();
        $hsl = $this->getHSLArray();
        $login = $this->getLoginArray();
        
        // TODO: Check github for update !      

        $settings['hsl'] = array(
            'hue' => $hsl[0],
            'saturation' => $hsl[1],
            'luminosity' => $hsl[2],
            'isOn' => $hsl[3]
        );

        unset($login['password']);
        $settings['login'] = $login;

        return $this->toJSON($settings);
    }

    public function enablePassword(Request $request) {
        if(!$this->auth()) return redirect('/');
    }

    public function disablePassword(Request $request) {
        if(!$this->auth()) return redirect('/');
        
    }

    public function setPassword(Request $request, $password) {
        if(!$this->auth()) return redirect('/');

    }

    public function enableForward(Request $request) {
        if(!$this->auth()) return redirect('/');

    }

    public function disableForward(Request $request) {
        if(!$this->auth()) return redirect('/');

    }

    public function setForwardCode(Request $request, $code) {
        if(!$this->auth()) return redirect('/');

    }

    public function setForwardAddress(Request $request, $address) {
        if(!$this->auth()) return redirect('/');

    }

    public function addIOAddress(Request $request, $address) {
        if(!$this->auth()) return redirect('/');

    }

    public function getIOAddresses(Request $request) {
        if(!$this->auth()) return redirect('/');

    }

    public function removeIOAddress(Request $request, $address) {
        if(!$this->auth()) return redirect('/');
        
    }
}
