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

mix // Laravel asset runnes 

    // Global assets
    .js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/errors.scss', 'public/css')

    // Markdown textarea assets
    .js('node_modules/bootstrap-markdown/js/bootstrap-markdown.js', 'public/js') 
    .copy('node_modules/bootstrap-markdown/css/bootstrap-markdown.min.css', 'public/css')
    .copy('node_modules/bootstrap/fonts', 'public/fonts/bootstrap')

    // Authencation views
    .sass('resources/assets/sass/auth.scss', 'public/css')
    .js('resources/assets/js/auth.js', 'public/js')

    // Options
    .options({processCssUrls: false, postCss: [ tailwind('tailwind.js') ]})
