<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Gate;

Route::get('/', function () {

	if( Gate::allows('access-admin') ){
		require 'admin';
	}else{
		return 'cliente';
	}
    //return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
