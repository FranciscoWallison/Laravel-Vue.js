const gulp = require('gulp');
const elixir = require('laravel-elixir');
const webpack = require('webpack');
const WebpackDevServer = require('webpack-dev-server');
const webpackConfig = require('./webpack.config');
const webpackDevConfig = require('./webpack.dev.config');
const HOST = "localhost"; // contant alterar host de forma global,

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

gulp.task('webpack-dev-server', () => {
	let config = Elixir.webpack.config;
	new WebpackDevServer(webpack(config), {		
		proxy: {
			'*': `http://${HOST}:8000`
		},
		watchOptions: {
			poll: true,
			aggregateTimeout: 300
		},
		publicPath: config.output.publicPath,
		notInfo: true, // não vai mostra os success
		stats: { colors: true}

	}).listen(8080, HOST, () => {
		console.log("Bundling project...");
	})
});

elixir((mix) => {
    mix.sass('./resources/assets/admin/sass/admin.scss')
    	.copy('./node_modules/materialize-css/fonts/roboto','./public/fonts/roboto');
       //.webpack('app.js');
    //ficar onhado os aquivos blade e publica
    gulp.start('webpack-dev-server');

    mix.browserSync({
    	host: HOST,
    	proxy: `http://${HOST}:8080`
    });
});
