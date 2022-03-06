const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

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

mix.js('resources/js/business/app.js', 'public/js/business')
    .sass('resources/sass/business/app.scss', 'public/css/business')
    .js('resources/js/customer/app.js', 'public/js/customer')
    .sass('resources/sass/customer/app.scss', 'public/css/customer')
    .version()
    .vue()
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.config.js') ],
    });