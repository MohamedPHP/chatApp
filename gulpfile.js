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

require('laravel-elixir-vueify');

elixir(function(mix) {
    mix.styles([
        'fontawesome.css',
        'bootstrap.css',
        'sweetalert.css',
        'alertify.core.css',
        'alertify.default.css',
        'style.css',
    ], 'public/css/style.css');

    mix.scripts([
        'lips/jquery.min.js',
        'lips/bootstrap.min.js',
        'lips/sweetalert.min.js',
        'lips/alertify.min.js',
    ], 'public/js/main.js');

    mix.browserify([
        'app.js',
    ], 'public/js/app.js');
});
