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

mix.scripts(
    [
        "node_modules/videojs-resolution-switcher/lib/videojs-resolution-switcher.js",
    ],
    "public/assets/js/player.js"
).styles(
    [
        "node_modules/videojs-resolution-switcher/lib/videojs-resolution-switcher.css",
    ],
    "public/assets/css/player.css"
);
