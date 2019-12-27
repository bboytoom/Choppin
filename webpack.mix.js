const mix = require('laravel-mix')

mix.js('resources/js/app.js', 'public/js').sass('resources/sass/app.scss', 'public/css')

mix.scripts(['resources/js/sb-admin-2.js'], 'public/js/build.js')
