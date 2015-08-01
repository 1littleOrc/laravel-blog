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

elixir(function (mix) {
    mix.styles([
        "zerogrid.css",
        "style.css",
        "css-stars.css"
    ], 'public/css/style.min.css');
    mix.scripts([
        "highlight.pack.js",
        "jquery-2.1.4.min.js",
        "jquery.barrating.min.js",
        "custom.js"
    ], 'public/js/main.js');
});
