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

    var basePath = null;
    basePath = './public/flexcms';
    // basePath = './public/vendor/flexcms';

    var gulp = require('gulp');
    var sass = require('gulp-sass');
    var minifyCss = require('gulp-minify-css');

    // console error 
    var gutil = require('gulp-util');

    //  Strip console, alert, and debugger statements from JavaScript code
    var stripDebug = require('gulp-strip-debug');

    // var sass = require('gulp-sass');
    //var sourcemaps = require('gulp-sourcemaps');
    var uglify = require('gulp-uglify');

    var pump = require('pump');

    var concat = require('gulp-concat');
    var count = require('gulp-count');
    var clean = require('gulp-rimraf');

    var autoprefixer = require('gulp-autoprefixer');

    gulp.task('bcss', function() {
        mix.sass('main.scss', 'public/flexcms/css/main.css');
        mix.sass('theme.scss', 'public/flexcms/css/theme.css');
        mix.sass('vendor.scss', 'public/flexcms/css/vendor.css');
    });

    // minify js for admin 
    gulp.task('minify_js_admin', function() {

        return gulp.src([
            // './public/js/app.js',
            
            basePath + '/vendors/jquery/dist/jquery.min.js',
            basePath + '/vendors/moment/min/moment.min.js',
            basePath + '/vendors/magnific-popup/dist/jquery.magnific-popup.min.js',
            basePath + '/vendors/underscore/underscore-min.js',
            basePath + '/vendors/angular/angular.min.js',
            basePath + '/vendors/angular-animate/angular-animate.js',
            basePath + '/vendors/angular-google-maps/dist/angular-google-maps.min.js',
            basePath + '/vendors/lodash/dist/lodash.min.js',
            basePath + '/vendors/angular-simple-logger/dist/angular-simple-logger.min.js',

            basePath + '/vendors/ngmap/build/scripts/ng-map.min.js',
            basePath + '/vendors/angular-resource/angular-resource.min.js',
            basePath + '/vendors/angular-drag-and-drop-lists/angular-drag-and-drop-lists.js',
            // basePath + '/vendors/angular-drag-and-drop-lists/angular-drag-and-drop-lists.min.js',
            basePath + '/vendors/angular-aria/angular-aria.min.js',
            basePath + '/vendors/angular-material/angular-material.min.js',
            basePath + '/vendors/angular-route/angular-route.min.js',
            basePath + '/vendors/angular-sanitize/angular-sanitize.min.js',
            basePath + '/vendors/ng-file-upload/ng-file-upload.min.js',

            basePath + '/vendors/material-angular-paging/build/dist.min.js',
            basePath + '/vendors/ng-file-upload-shim/ng-file-upload-shim.min.js',
            basePath + '/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
            basePath + '/vendors/angular-material-data-table/dist/md-data-table.min.js',

            basePath + '/vendors/angular-material-datetimepicker/js/angular-material-datetimepicker.min.js',

            basePath + '/vendors-download/ckeditor/ckeditor.js',

            basePath + '/js/util/namespace.js',

            basePath + '/js/apps/dashboard.js',
            basePath + '/js/apps/dashboard.config.js',

            basePath + '/js/config/env.js',

            basePath + '/js/util/route.js',
            basePath + '/js/util/menu.js',
            basePath + '/js/util/crypt/aes.js',
            basePath + '/js/util/crypt/pbkdf2.js',
            basePath + '/js/util/jsencrypt.js',
            basePath + '/js/util/endpoint.js',

            basePath + '/js/services/resource.js',
            basePath + '/js/services/crypt.js',

            basePath + '/js/directives/**/*.js',

            basePath + '/js/controllers/**/*.js',
            basePath + '/js/services/**/*.js',

            basePath + '/js/controllers/alert.js',
            basePath + '/js/controllers/left.js',
            basePath + '/js/controllers/loading.js',

        ])
        .pipe(count('## js-files selected admin script'))   
        .pipe(concat('hh-admin-script.js'))
        // .pipe(uglify({
        //     // mangle: false
        //     mangle: {
        //         except: ['angular', '_', 'app', 'namespace', 'dataMock']
        //     }
        // }))
        .pipe(gulp.dest('./public/build/js'));
    });


    gulp.task('mix_css_admin', function() {

        return gulp.src([
            basePath + '/css/**/*.css',
        ])
        .pipe(count('## css-files admin selected'))
        .pipe(autoprefixer())      
        .pipe(concat('admin_style.css'))
        .pipe(gulp.dest('./public/build/css/'));

    });

    gulp.task('minify_css_admin', function() {
        return gulp.src('./public/build/css/*.css')
            .pipe(minifyCss())
            .pipe(gulp.dest('./public/build/css/'));
    });

    gulp.task('copy_file', function(cb) {
        return gulp.src('./public/flexcms/fonts/icomoon/fonts/*')
             .pipe(gulp.dest('./public/build/css/fonts'));
    });

    gulp.task('version_admin', function() {
        mix.version(["public/build/*"]);
    });

    gulp.task('clean_before', function() {
        return gulp.src('./public/build', {read: false, force: true})
            .pipe(clean());
    });

    gulp.task('prod_admin', ['clean_before','mix_css_admin', 'minify_css_admin', 'minify_js_admin', 'copy_file']);

    // GULP FOR DEV ASSET
    // TO Run: gulp dev watch
    const SRC = './public/flexcms/**/*';
    const DEST = './../../../../public/vendor/flexcms/**/*';

    var execShell = require('child_process').exec;

    gulp.task('dev-publish-public', function(){
        execShell('npm run publish-dev-public', function (er, stdin, stdout){
            console.log('Run completed', stdout);
        });
        return gulp.src(SRC);
        });

    gulp.task('watch-dev', function(){
        gulp.watch(SRC, ['dev-publish-public']);
    });

});