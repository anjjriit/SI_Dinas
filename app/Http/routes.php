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

Route::resource('user', 'PegawaiController', ['except' => 'show']);
Route::resource('kota', 'KotaController', ['except' => 'show']);
Route::resource('prospek', 'ProspekController', ['except' => 'show']);
Route::resource('project', 'ProjectController', ['except' => 'show']);

Route::get('layout/master', function () {
    return view('test.master');
});
