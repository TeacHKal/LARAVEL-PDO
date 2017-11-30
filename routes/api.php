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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(array('prefix' => 'v1'), function()
{
    Route::resource('customer', 'CustomersController');
    Route::get('customers/createTable', 'CustomersController@createTable');
    Route::put('customer/{id}/deposit/', 'CustomersController@depositMoney');
    Route::put('customer/{id}/withdraw/', 'CustomersController@withdrawMoney');
    Route::get('customers/report/', 'CustomersController@customersReport');
    Route::get('customers/report/{timeFrameDays}', 'CustomersController@customersReport');

});


