<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('products')->group(function() {
	Route::post('create', 'ProductsController@create');
	Route::get('read', 'ProductsController@read');
	Route::delete('delete', 'ProductsController@delete');
	Route::get('get', 'ProductsController@get');
});

Route::prefix('orders')->group(function() {
	Route::get('get', 'OrdersController@get');
});

Route::prefix('tickets')->group(function() {
	Route::post('complete', 'TicketsController@complete');
	Route::get('get', 'TicketsController@get');
});