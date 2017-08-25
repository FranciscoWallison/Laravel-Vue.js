const elixir = require('laravel-elixir');
const webpackConfig = require('./webpack.config');
const webpackDevConfig = require('./webpack.dev.config');


require('laravel-elixir-vue');
require('laravel-elixir-webpack-official');

Elixir.webpack.config.module.loaders = [];

Elixir.webpack.mergeConfig(webpackConfig);
Elixir.webpack.mergeConfig(webpackDevConfig);


/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

// elixir((mix) => {
//     mix.sass('./resources/assets/admin/sass/admin.scss')
//     	.copy('./node_modules/materialize-css/fonts/roboto','./public/fonts/roboto');
//        //.webpack('app.js');
//     //ficar onhado os aquivos blade e publica
//     mix.browserSync({
//     	host: '0.0.0.0',
//     	proxy: 'http://192.168.1.2:8000'
//     });
// });
