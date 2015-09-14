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

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', ['as' => 'user.login', 'uses' => 'Auth\AuthController@postLogin']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect('/dashboard');
    });
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('logout', 'Auth\AuthController@getLogout');
    Route::get('user/password', 'PegawaiController@editPassword');
    Route::patch('user/password/update', ['as' => 'user.update.password', 'uses' => 'PegawaiController@updatePassword']);

    Route::post('prospek/store', ['as' => 'prospek.ajax.store', 'uses' => 'ProspekController@ajaxStore']);
    Route::post('pelatihan/store', ['as' => 'pelatihan.ajax.store', 'uses' => 'PelatihanController@ajaxStore']);
});

Route::group(['middleware' => 'role:super_admin'], function () {
    Route::resource('user', 'PegawaiController', ['except' => 'show']);
    Route::resource('kota', 'KotaController', ['except' => 'show']);
    Route::resource('prospek', 'ProspekController', ['except' => 'show']);
    Route::resource('project', 'ProjectController', ['except' => 'show']);
    Route::resource('pelatihan', 'PelatihanController',['except' => 'show']);
    Route::resource('jenis-biaya', 'JenisBiayaController', ['except' => 'show']);

    // transportasi
    Route::get('transportasi/{transportasi}', 'TransportasiController@show');
    Route::get('transportasi/create', 'TransportasiController@createTransportation');
    Route::get('transportasi/{transportasi}/edit', 'TransportasiController@editTransportation');
    Route::get('transportasi/{transportasi}/biaya/create', 'TransportasiController@createCost');
    Route::get('transportasi/{transportasi}/biaya/{id}/edit', 'TransportasiController@editCost');
    Route::post('transportasi', 'TransportasiController@storeTransportation');
    Route::patch('transportasi/{transportasi}', 'TransportasiController@updateTransportation');
    Route::delete('transportasi/{transportasi}', 'TransportasiController@deleteTransportation');
    Route::post('transportasi/{transportasi}/biaya', 'TransportasiController@storeCost');
    Route::patch('transportasi/{transportasi}/biaya/{id}', 'TransportasiController@updateCost');
    Route::delete('transportasi{transportasi}/biaya/{id}', 'TransportasiController@deleteCost');


});



Route::post('rpd', ['as' => 'rpd.action', 'uses' => 'RpdController@createAction']);

//RPD
Route::get('rpd/create', 'RpdController@create');
Route::get('rpd/draft', 'RpdController@draft');
Route::get('rpd/draft/{rpd}/edit', 'RpdController@editRpd');
Route::patch('rpd/{rpd}/update', ['as' => 'rpd.update', 'uses' => 'RpdController@updateAction']);

Route::get('rpd/submitted', 'RpdController@submitted');

//LPD
Route::get('lpd', 'LpdController@index');
Route::get('lpd/log', 'LpdController@log');

//JSON
Route::get('json/pegawai', 'JsonController@pegawai');
Route::get('json/project', 'JsonController@project');
Route::get('json/prospek', 'JsonController@prospek');
Route::get('json/pelatihan', 'JsonController@pelatihan');

//(tes) cek user yang login
Route::get('cek', function () {

    return;
});
//(tes) cek relasi
Route::get('rpd/tes', 'RpdController@generateCode');

Route::get('indexpegawai','testController@index');
