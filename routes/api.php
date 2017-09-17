<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'cors' , 'as' => 'api.'], function(){


	Route::post('/access_token', 'Api\AuthController@accessToken')->name('access_token');
	Route::post('/refresh_token', 'Api\AuthController@refreshToken')->name('refresh_token');
	

	Route::group(['middleware' => 'auth:api'], function(){
		Route::resource('banks', 'Api\BanksController', ['only' => ['index']]);

		Route::get('bank_accounts/lists', 'Api\BankAccountsController@lists')->name('bank_accounts.lists');
		Route::resource('bank_accounts', 'Api\BankAccountsController', ['except'=> ['create' , 'edit'] ]);

		Route::resource('category_expenses', 'Api\CategoryExpensesController', ['except'=> ['create' , 'edit'] ]);
		Route::resource('category_revenues', 'Api\CategoryRevenuesController', ['except'=> ['create' , 'edit'] ]);
		Route::resource('bill_pays', 'Api\BillPaysController', ['except'=> ['create' , 'edit'] ]);
		Route::resource('bill-receives', 'Api\BillReceivesController', ['except'=> ['create' , 'edit'] ]);

		Route::get('cash_flows', 'Api\CashFlowsController@index');
		Route::post('/logout', 'Api\AuthController@logout')->name('logout');

		Route::get('/test_auth', function (Request $request) {
		    return response()->json([
		    		'message' => 'Hello World'
		    	]);
		});	

		Route::get('/user', function(Request $request){
			//$user = Auth::guard('api')->user();
			$user = $request->user('api');
			return $user;
		})->name('user');

	});
});
