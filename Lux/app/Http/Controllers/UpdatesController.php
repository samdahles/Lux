<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpdatesController extends Controller
{
    public function index(Request $request) {
        return view('updates');
    }
}
