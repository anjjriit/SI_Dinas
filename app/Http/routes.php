<?php

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', ['as' => 'user.login', 'uses' => 'Auth\AuthController@postLogin']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect('/dashboard');
    });
    Route::get('/dashboard', 'PagesController@dashboard');

    Route::get('logout', 'Auth\AuthController@getLogout');
    Route::get('user/password', 'PegawaiController@editPassword');
    Route::patch('user/password/update', ['as' => 'user.update.password', 'uses' => 'PegawaiController@updatePassword']);

    Route::post('prospek/store', ['as' => 'prospek.ajax.store', 'uses' => 'ProspekController@ajaxStore']);
    Route::post('pelatihan/store', ['as' => 'pelatihan.ajax.store', 'uses' => 'PelatihanController@ajaxStore']);

    // List RPD
    Route::get('rpd/draft', 'RpdController@draft');
    Route::get('rpd/submitted', 'RpdController@submitted');
    Route::get('rpd/approved', 'RpdController@approved');
    Route::get('rpd/log', 'RpdController@log');
    // Pengajuan RPD
    Route::post('rpd', ['as' => 'rpd.action', 'uses' => 'RpdController@createAction']);
    Route::get('rpd/create', 'RpdController@create');
    Route::get('rpd/{rpd}/edit', 'RpdController@editRpd');
    Route::patch('rpd/{rpd}/update', ['as' => 'rpd.update', 'uses' => 'RpdController@updateAction']);
    Route::post('rpd/recall/{rpd}', 'RpdController@recall');
    Route::get('rpd/{rpd}/pdf', 'RpdController@toPdf');
});

Route::group(['middleware' => 'role:administration'], function () {
    Route::get('rpd/{id}/approval', 'RpdController@approval');
    Route::post('rpd/{id}/approval', 'RpdController@submitApproval');
});

Route::group(['middleware' => 'role:super_admin'], function () {
    // CRUD user/pegawai
    Route::resource('user', 'PegawaiController', ['except' => 'show']);
    // CRUD kota
    Route::resource('kota', 'KotaController', ['except' => 'show']);
    // CRUD prospek
    Route::resource('prospek', 'ProspekController', ['except' => 'show']);
    // CRUD project
    Route::resource('project', 'ProjectController', ['except' => 'show']);
    // CRUD pelatihan
    Route::resource('pelatihan', 'PelatihanController',['except' => 'show']);
    // CRUD jenis biaya pengeluaran standar
    Route::resource('jenis-biaya', 'JenisBiayaController', ['except' => 'show']);
    // CRUD penginapan
    Route::resource('penginapan', 'PenginapanController', ['except' => 'show']);
    // Transportasi
    Route::group(['prefix' => 'transportasi'], function () {
        // CRUD transportasi
        Route::get('/', 'TransportasiController@index');
        Route::post('/', 'TransportasiController@storeTransportation');
        Route::get('create', 'TransportasiController@createTransportation');
        Route::get('{transportasi}/edit', 'TransportasiController@editTransportation');
        Route::patch('{transportasi}', 'TransportasiController@updateTransportation');
        Route::delete('{transportasi}', 'TransportasiController@deleteTransportation');
        // CRUD biaya transportasi
        Route::get('{transportasi}', 'TransportasiController@show');
        Route::post('{transportasi}/biaya', 'TransportasiController@storeCost');
        Route::get('{transportasi}/biaya/create', 'TransportasiController@createCost');
        Route::get('{transportasi}/biaya/{biaya_transportasi}/edit', 'TransportasiController@editCost');
        Route::patch('{transportasi}/biaya/{biaya_transportasi}', 'TransportasiController@updateCost');
        Route::delete('{transportasi}/biaya/{biaya_transportasi}', 'TransportasiController@deleteCost');
    });
});

// LPD
Route::get('lpd', 'LpdController@index');
Route::get('lpd/log', 'LpdController@log');
Route::get('lpd/submitted/all', 'LpdController@submittedAll');
Route::get('lpd/processed', 'LpdController@processed');
Route::get('lpd/approved', 'LpdController@approved');

Route::group(['middleware' => 'role:administration'], function () {
    Route::get('lpd/{id}/approval', 'LpdController@approval');
    Route::post('lpd/{id}/approval', 'LpdController@submitApproval');
});

// JSON Output
Route::get('json/pegawai', 'JsonController@pegawai');
Route::get('json/project', 'JsonController@project');
Route::get('json/prospek', 'JsonController@prospek');
Route::get('json/pelatihan', 'JsonController@pelatihan');

//tes
Route::get('cek', function () {
    dd(auth()->check());

    return;
});
