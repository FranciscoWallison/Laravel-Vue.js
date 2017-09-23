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
	dd('test');
});

Route::get('/home', function(){
	return redirect()->action('HomeController@index');
});


Route::get('/app', function () {
    return view('layouts.spa');
});

Route::group([
	'prefix' => 'admin',
	'as' => 'admin.'
], function () {

	Auth::routes();

	Route::group(['middleware' => 'can:access-admin'], function(){
		Route::get('home', 'HomeController@index')->name('home');
		Route::resource('banks', 'Admin\BanksController', ['except' => 'show']);
	});
});


Route::group(['prefix' => '/', 'as' => 'site.'], function () {
    Route::get('/', function(){
        return view('site.home');
    })->name('home');

    Route::group(['prefix' => 'subscriptions','as' => 'subscriptions.','middleware'=>'auth'], function(){
        Route::get('create','Site\SubscriptionsController@create')->name('create');
        Route::post('store','Site\SubscriptionsController@store')->name('store');
        Route::get('successfully','Site\SubscriptionsController@successfully')->name('successfully');
    });

    // Route::group(['prefix'=>'my-financial','as'=>'my_financial','middleware'=>'auth.from_token'],function(){
    //    Route::get('/', function(){
    //        echo 'teste';
    //    });
    // });

    // Route::get('register','Site\Auth\RegisterController@create')->name('auth.register.create');
    // Route::post('register','Site\Auth\RegisterController@store')->name('auth.register.store');

    // Route::get('login','Site\Auth\LoginController@showLoginForm')->name('login');
    // Route::post('login','Site\Auth\LoginController@login');
    // Route::post('logout','Site\Auth\LoginController@logout');
});