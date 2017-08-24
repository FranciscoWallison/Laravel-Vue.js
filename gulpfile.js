const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

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

elixir((mix) => {
    mix.sass('./resources/assets/admin/sass/admin.scss')
    	.copy('./node_modules/materialize-css/fonts/roboto','./public/fonts/roboto');
       //.webpack('app.js');
});
