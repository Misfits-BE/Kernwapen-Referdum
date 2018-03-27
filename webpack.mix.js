let tailwind = require('tailwindcss');
let mix      = require('laravel-mix');
               require('laravel-mix-purgecss');

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
    .sass('resources/assets/sass/errors.scss', 'public/css')

    // Authencation views
    .sass('resources/assets/sass/auth.scss', 'public/css')
    .js('resources/assets/js/auth.js', 'public/js')

    .options({processCssUrls: false, postCss: [ tailwind('tailwind.js') ]})
    .purgeCss();
