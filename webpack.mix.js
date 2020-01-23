const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

   mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

//css mixing
// mix.styles([
//    'public/mediexpert.css',
//    'public/mediexpert-mq.css',
//    'public/css/bootstrap.min.css', 
//    'public/css/ladda-themeless.min.css',
// ], 'public/css/all.css');

//scripts mixing
// mix.scripts([
//    'public/admin/js/jquery.min.js',
//    'public/admin/js/bootstrap.min.js',
//    'public/js/tinymce.min.js',
//    'public/mediexpert.js',
//    'public/js/utils.js',
//    'public/js/spin.min.js',
//    'public/js/ladda.min.js',
// ], 'public/js/all.js');