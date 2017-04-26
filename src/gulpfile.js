var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    var gulp = require('gulp');
    var sass = require('gulp-sass');
    var minifyCss = require('gulp-minify-css');

    // console error 
    // var gutil = require('gulp-util');

    //  Strip console, alert, and debugger statements from JavaScript code
    // var stripDebug = require('gulp-strip-debug');

    // var sass = require('gulp-sass');
    //var sourcemaps = require('gulp-sourcemaps');
    // var uglify = require('gulp-uglify');

    // var pump = require('pump');

    // var concat = require('gulp-concat');
    // var count = require('gulp-count');
    // var clean = require('gulp-rimraf');

    // var autoprefixer = require('gulp-autoprefixer');

    gulp.task('bcss', function() {
        mix.sass('main.scss', 'public/flexcms/css/main.css');
        mix.sass('theme.scss', 'public/flexcms/css/theme.css');
        mix.sass('vendor.scss', 'public/flexcms/css/vendor.css');
    });
});