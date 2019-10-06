let mix = require('laravel-mix');
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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/welcome.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')//.purgeCss()
    .sass('resources/sass/article/articles.scss', 'public/css')
    .sass('resources/sass/article/post.scss', 'public/css')
    .sass('resources/sass/article/clean-blog.scss', 'public/css');