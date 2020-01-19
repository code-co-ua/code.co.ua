let mix = require('laravel-mix');
require('laravel-mix-purgecss');

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/welcome.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css').purgeCss()
    .sass('resources/sass/article/articles.scss', 'public/css')
    .sass('resources/sass/article/post.scss', 'public/css')
    .sass('resources/sass/article/clean-blog.scss', 'public/css');
