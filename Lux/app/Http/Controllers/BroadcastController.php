<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BroadcastController extends Controller
{
    public function index(Request $request) {
        return view('broadcast');
    }
}
