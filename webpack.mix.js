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

mix
.sass('resources/sass/soft-ui-dashboard.scss','public/css/',{
    processUrls: false,
})
.copy('resources/copy/js','public/js')
.copy('resources/copy/fonts','public/fonts')
.copy('resources/copy/css/nucleo-icons.css','public/css/nucleo-icons.css')
.copy('resources/copy/css/nucleo-svg.css','public/css/nucleo-svg.css')
// .copy('resources/copy/css/soft-ui-dashboard.css','public/css/soft-ui-dashboard.css')
.copy('resources/copy/img','public/img')
.copy('resources/copy/bootstrap-icons','public/bootstrap-icons')
.copy('resources/copy/DataTables','public/DataTables')
.copy('resources/copy/template_excel','public/template_excel')
.sourceMaps()
.disableNotifications()
;
