<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        $router->model('user', 'App\Pegawai');
        $router->model('kota', 'App\Kota');
        $router->model('prospek', 'App\Prospek');
        $router->model('project', 'App\Project');
        $router->model('pelatihan','App\Pelatihan');
        $router->model('jenis-biaya', 'App\JenisBiaya');
        $router->model('transportasi', 'App\Transportasi');
        $router->model('biaya_transportasi', 'App\BiayaTransportasi');
        $router->model('penginapan', 'App\Penginapan');
        $router->model('rpd', 'App\Rpd');
        $router->model('lpd', 'App\Lpd');
        $router->model('pengeluaran', 'App\Pengeluaran');

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
