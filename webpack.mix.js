const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/ajax.js', 'public/js')
    .css('resources/css/login.css', 'public/css')
    .css('resources/css/app.css', 'public/css')
    .css('resources/css/responsive.css', 'public/css');
