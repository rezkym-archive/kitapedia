<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('settings', 'User\SettingController');

Route::post('settings/{id}', 'User\SettingController@update')->name('settings.update');

Route::post('settings/security/{id}', 'User\SettingController@securityUpdate');

/* Route::post('settings/{id}', function ($id) {
    return 'awdawdawd';
}); */
