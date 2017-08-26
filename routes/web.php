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

Route::get('/test', function (){
	//Illuminate\Support\Facades\Auth::loginUsingId(1);

	dd('test')
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function(){
	return redirect()->action('HomeController@index');
});

Route::group([
	'prefix' => 'admin',
	'as' => 'admin.'
], function () {

	Auth::routes();

	Route::group(['middleware' => 'can:access-admin'], function(){
		Route::get('home', 'HomeController@index')->name('home');
	});
});
