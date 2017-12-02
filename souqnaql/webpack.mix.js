const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

// mix.styles([
//     'public/css/SouqNaql_css/bootstrap.min.css',
//     'node_modules/font-awesome/css/font-awesome.min.css',
//     'public/css/SouqNaql_css/bootstrap-arabic.min.css',
//     'public/css/SouqNaql_css/styles.css'
// ], 'public/css/styles_all.css');

// mix.scripts([
//     'public/js/soqnal_js/jquery.js',
//     'public/js/soqnal_js/bootstrap-arabic.min.js',
//     'public/js/soqnal_js/smoothscroll.js',
//     'public/js/soqnal_js/wow.min.js'
// ], 'public/js/js_all.js');