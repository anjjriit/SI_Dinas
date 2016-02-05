<?php

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', ['as' => 'user.login', 'uses' => 'Auth\AuthController@postLogin']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect('/dashboard');
    });
    Route::get('/dashboard', 'PagesController@dashboard');
    Route::get('/homepage','PagesController@homepage');

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
    Route::post('rpd/recall/{rpd}', ['as' => 'rpd.recall', 'uses' => 'RpdController@recall']);

    // LPD
    Route::get('lpd', 'LpdController@index');
    Route::get('lpd/draft', 'LpdController@draft');
    Route::get('lpd/log', 'LpdController@log');
    Route::get('lpd/submitted/all', 'LpdController@submittedAll');
    Route::get('lpd/processed', 'LpdController@processed');
    Route::get('lpd/approved', 'LpdController@approved');
    Route::get('lpd/submitted', 'LpdController@submitted');

    Route::get('lpd/create/{rpd}', 'LpdController@create');
    Route::post('lpd/recall/{id}', 'LpdController@recall');
    Route::get('lpd/{lpd}/edit', 'LpdController@edit');
    Route::post('lpd/{lpd}', 'LpdController@updateAction');
    Route::post('lpd/{lpd}/pengeluaran/add', 'LpdController@addExpense');
    Route::get('lpd/{lpd}/pengeluaran/{pengeluaran}/edit', 'LpdController@editExpense');
    Route::patch('lpd/{lpd}/pengeluaran/{pengeluaran}', 'LpdController@updateExpense');
    Route::delete('lpd/pengeluaran/{pengeluaran}', 'LpdController@deleteExpense');

    Route::get('lpd/{lpd}/approval', 'LpdController@approval');
    Route::post('lpd/{lpd}/approval', 'LpdController@submitApproval');

    Route::get('report/bulanan', 'ReportController@bulanan');
    Route::get('report/tahunan', 'ReportController@tahunan');
    Route::get('report/prospek', 'ReportController@prospek');
    Route::get('report/project', 'ReportController@project');
    Route::get('report/pelatihan', 'ReportController@pelatihan');
});

Route::group(['middleware' => 'role:administration'], function () {
    Route::get('rpd/{rpd}/pdf', 'RpdController@toPdf');
    Route::get('lpd/{lpd}/pdf', 'LpdController@toPdf');
    Route::get('rpd/submitted/all', 'RpdController@submittedAll');
    Route::get('rpd/{rpd}/approval', 'RpdController@approval');
    Route::post('rpd/{rpd}/approval', 'RpdController@submitApproval');
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
    //CRUD pengeluaran
    Route::resource('tipepengeluaran','TipePengeluaranController',['except' => 'show']);

    Route::get('setting', 'SettingController@edit');
    Route::patch('setting', 'SettingController@update');
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

Route::get('components/pdf/header.html', function () {
    return view('rpd.pdf_header');
});
