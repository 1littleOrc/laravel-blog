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
    ], 'public/css/all.css');

    // desctop version of scripts
    mix.scripts([
        "highlight.pack.js",
        "../../../bower_components/jquery/dist/jquery.js",
        "jquery.barrating.min.js",
        "../../../bower_components/jscroll/jquery.jscroll.js",
        "custom.js",
        "infinite.scrolling.js"
    ], 'public/js/main.js');

    //mobile version of scripts
    mix.scripts([
        "highlight.pack.js",
        "../../../bower_components/jquery/dist/jquery.js",
        "jquery.barrating.min.js",
        "custom.js"
    ], 'public/js/main.mobile.js');

    mix.version(["css/all.css", "js/main.js", "js/main.mobile.js"]);
});

var replace = require('gulp-replace');
var gulp = require('gulp');

gulp.task('compress', function() {
    return gulp.src('./storage/framework/views/*')
        .pipe(replace(/\n/g, ' '))
        .pipe(replace(/(\s){2,}/g, '$1'))
        .pipe(gulp.dest('./storage/framework/views/'));

});