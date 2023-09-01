const mix = require('laravel-mix');

mix.js('resources/js/app.jsx', 'public/js')
    .css('resources/css/app.css', 'public/css')
    .react(); // Indicate that it includes React components
