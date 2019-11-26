const mix = require('laravel-mix');

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
    .js('resources/js/utils/stripe.js', 'public/js')
    .js('resources/js/utils/ajax.js', 'public/js')
    .js('resources/js/utils/thumbnail.js', 'public/js')
    .js('resources/js/utils/algoliaAutoComplete.js', 'public/js')
    .js('resources/js/utils/algoliaInstantSearch.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/responsive.scss', 'public/css')
    .sourceMaps()
    .webpackConfig({ devtool: 'source-map' })
    .disableNotifications();
