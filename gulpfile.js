var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');

    mix.styles([
        'css/app.css',
        'vendor/font-awesome/css/font-awesome.css',
        'vendor/adminLTE/css/adminLTE.css',
        'vendor/adminLTE/css/skins/skin-black.css',
    ], null, 'public');
});
