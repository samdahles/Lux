<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\APIController;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $settings = APIController::getSettingsArray();
        $hsl = APIController::getHSLArray();
        return view('dashboard', ['settings' => $settings, 'hsl' => $hsl]);
    }
}
