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

mix
    .js('resources/js/admin/app.js', 'public/js/admin.js')
    .js('resources/js/auth/app.js', 'public/js/auth.js')

    .sass('resources/sass/admin/main.scss', 'public/css/admin.css')
    .sass('resources/sass/auth/app.scss', 'public/css/auth.css');
