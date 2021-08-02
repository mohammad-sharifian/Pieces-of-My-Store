const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/admin/layout.scss', 'public/css/admin')
   .js('resources/js/admin/layout.js', 'public/js/admin')
   .sass('resources/sass/admin/index.scss', 'public/css/admin')
   .sass('resources/sass/admin/create.scss', 'public/css/admin')
   .sass('resources/sass/admin/show.scss', 'public/css/admin')
   .sass('resources/sass/home/layout.scss', 'public/css/home')
   .js('resources/js/home/layout.js', 'public/js/home')
   .sass('resources/sass/home/index.scss', 'public/css/home')
   .js('resources/js/home/index.js', 'public/js/home');
