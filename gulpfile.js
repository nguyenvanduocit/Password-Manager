var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');
    mix.scripts([
        "node_modules/clipboard/dist/clipboard.js",
        "node_modules/notifyjs-browser/dist/notify.js"
    ],  "public/js/vendor.js",'./');
    mix.scripts([
        "destroylink.js",
        "password.js",
        "group.js",
        "user.js",
        "all.js"
    ]);
    mix.version(['public/js/all.js','public/js/vendor.js','public/css/app.css']);
});
