<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\ColorController;
use App\Http\Controllers\API\HTTPController;
use App\Http\Controllers\API\SettingController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/hsl', [ColorController::class, 'getCurrentHSL'])->name('getHSL');
Route::get('/rgb', [ColorController::class, 'getCurrentRGB'])->name('getRGB');

Route::post('/hsl/{h}-{s}-{l}-{isOn}', [ColorController::class, 'setCurrentHSL'])->name('setHSL');
Route::post('/rgb/{r}-{g}-{b}-{isOn}', [ColorController::class, 'setCurrentRGB'])->name('setRGB');

Route::post('/direct/hsl/{h}-{s}-{l}-{isOn}', [ColorController::class, 'setDirectHSL'])->name('setDirectHSL');
Route::post('/direct/rgb/{r}-{g}-{b}-{isOn}', [ColorController::class, 'setDirectRGB'])->name('setDirectRGB');

Route::get('/http/{url}', [HTTPController::class, 'http'])->name('base64redirect');

Route::get('/settings', [SettingController::class, 'getSettings'])->name('getSettings');

Route::put('/settings/password', [SettingController::class, 'enablePassword'])->name('setEnablePassword');
Route::delete('/settings/password', [SettingController::class, 'disablePassword'])->name('setDisablePassword');
Route::post('/settings/password/{password}', [SettingController::class, 'setPassword'])->name('setPassword');

Route::put('/settings/forward', [SettingsController::class, 'enableForward'])->name('setEnableForward');
Route::delete('/settings/forward', [SettingsController::class, 'disableForward'])->name('setDisableForward');
Route::post('/settings/forward/code/{code}', [SettingsController::class, 'setForwardCode'])->name('setForwardCode');
Route::post('/settings/forward/address/{address}', [SettingsController::class, 'setForwardAddress'])->name('setForwardAddress');

Route::post('/settings/io/{address}', [SettingsController::class, 'addIOAddress'])->name('addIOAddress');
Route::get('/settings/io', [SettingsController::class, 'getIOAddresses'])->name('getIOAddresses');
Route::delete('/settings/io/{address}', [SettingsController::class, 'removeIOAddress'])->name('removeIOAddress');