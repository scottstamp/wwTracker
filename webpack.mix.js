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
   .sass('resources/assets/sass/app.scss', 'public/css')
   .styles([
       'node_modules/jquery-ui/themes/base/core.css',
       'node_modules/jquery-ui/themes/base/menu.css',
       'node_modules/jquery-ui/themes/base/autocomplete.css',
       'node_modules/jquery-ui/themes/base/theme.css'
    ], 'public/css/jquery-ui.css');