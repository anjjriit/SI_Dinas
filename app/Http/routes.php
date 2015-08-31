<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('user');
});

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', ['as' => 'user.login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('logout', 'Auth\AuthController@getLogout');

Route::resource('user', 'PegawaiController', ['except' => 'show']);
Route::resource('kota', 'KotaController', ['except' => 'show']);
Route::resource('prospek', 'ProspekController', ['except' => 'show']);
Route::resource('project', 'ProjectController', ['except' => 'show']);

Route::patch('user/password', ['as' => 'user.update.password', 'uses' => 'PegawaiController@updatePassword']);
Route::get('user/password', 'PegawaiController@editPassword');

//cek user yang login
Route::get('cek/user', function () {
    return dd(Auth::user());
});
