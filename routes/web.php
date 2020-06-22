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

/* If already logged in  */
Route::get('/home', function () {
    if (!auth()->check()) return redirect('/');
    $role = auth()->user()->role;
    return redirect()->route($role . '.index');
})->name('home');


/* Auth Routes */
Auth::routes();
Route::group([
    'middleware'    => ['auth', 'isDelete'],
    'namespace'     => 'User',
    'prefix'        => 'settings',
    'as'            => 'settings.'
], function () {

    Route::resource('/', 'SettingController');

    Route::post('general/{id}', 'SettingController@generalUpdate')->name('general.update');
    Route::post('security/{id}', 'SettingController@securityUpdate')->name('security.update');

    /* Include */
    Route::get('general', 'SettingController@general')->name('general');
    # Route::get('news', 'SettingController@news')->name('news');
    Route::get('api', 'SettingController@api')->name('api');
    Route::get('security', 'SettingController@security')->name('security');
    # Route::get('partnership', 'SettingController@partnership')->name('partnership');
    # Route::get('finance', 'SettingController@finance')->name('finance');
    
});


/* Admin Routes */
Route::group([
    'middleware'    => ['auth', 'role:admin', 'isDelete'], 
    'prefix'        => 'admin',
    'namespace'     => 'Admin',
    'as'            => 'admin.',
], function () {
    Route::resource('/', 'HomeController');

    /* Manager Route */
    Route::group(['prefix' => 'manager'], function () {

        Route::resource('user', 'UserManagerController');

        /* Recyle route */
        Route::get('recyle/user', 'UserManagerController@recyle')->name('user.recyle');
        Route::get('recyle/d/user', 'UserManagerController@recyleDelete')->name('user.recyle.delete');

        /* Restore Account */
        Route::get('restore/user/{id}', 'UserManagerController@restore')->name('user.restore');

        /* Soft Delete */
        Route::get('user/softDelete/{id}', 'UserManagerController@softDelete')->name('user.softdelete');
        
    });
    
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