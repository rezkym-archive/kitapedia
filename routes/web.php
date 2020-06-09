<?php

use Illuminate\Support\Facades\Route;
use DataTables as DataTables;
use App\User;


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

/* Landing Route */
Route::get('/', function () { 
    if(auth()->check()) return redirect('/'.auth()->user()->role);
    return view('/auth/login'); 
});
Route::get('/home', function () {
    if (!auth()->check()) return redirect('/');
    $role = auth()->user()->role;
    return redirect()->route($role . '.home');
})->name('home');


/* Auth Routes */
Auth::routes();
/* Route::group([
    'prefix' => ''
], function () {
    Route::get('setting', 'Auth\SettingController@index')->name('auth.setting');
    Route::put('setting', 'Auth\SettingController@update')->name('auth.setting.update');
    
}); */


/* Admin Routes */
Route::group([
    'middleware'    => ['auth', 'role:admin', 'isDelete'], 
    'prefix'        => 'admin',
    'namespace'     => 'Admin',
    'as'            => 'admin.',
], function () {
    Route::resource('/', 'HomeController');
    Route::resource('/manager/user', 'UserManagerController');

    /**
     * Recyle route
     * result is admin.user.recyle
     */
    Route::get('/manager/user/recyle', 'UserManagerController@recyle')->name('user.recyle');

    /* Soft Delete */
    Route::get('/manager/user/softDelete/{id}', 'UserManagerController@softDelete');
}); 



/* Reseller Routes */
/* Route::group([
    'middleware'    => ['auth', 'role:reseller'],
    'prefix'        => 'reseller',
    'namespace'     => 'Reseller', 
    'as'            => 'reseller.',
], function () {
    Route::get('/', 'HomeController@index')->name('home');
}); */


/* User Routes */
/* Route::group([
    'middleware'    => ['auth', 'role:client'],
    'prefix'        => 'client',
    'namespace'     => 'Client',
    'as'            => 'client.',
], function () {
    Route::get('/', 'HomeController@index')->name('home');
}); */