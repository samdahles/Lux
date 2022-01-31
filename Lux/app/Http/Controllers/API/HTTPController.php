<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HTTPController extends APIController
{
    public function http(Request $request, $url) {
        $plain = base64_decode($url);
        if(!str_starts_with($plain, 'http')) {
            $plain = 'http://' . $plain;
        }
        return redirect($plain);
    }
}
