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
	Illuminate\Support\Facades\Auth::loginUsingId(2);
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function(){
	return back()->withInput();
});

Route::group([
	'prefix' => 'admin', 
	'middleware' => 'can:access-admin', 
	'as' => 'admin.' 
], function () {
	Route::get('home', 'HomeController@index')->name('home');
});
