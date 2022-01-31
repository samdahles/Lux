<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UpdatesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/broadcast', [BroadcastController::class, 'index'])->name('broadcast');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/link', [LinkController::class, 'index'])->name('link');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LogoutController::class, 'index'])->name('logout');
Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
Route::get('/updates', [UpdatesController::class, 'index'])->name('updates');