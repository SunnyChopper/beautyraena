<?php

use Illuminate\Support\Facades\Route;

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

// Guest Views
Route::get('/', 'PagesController@index');
Route::get('/contact', 'PagesController@contact');
Route::post('/contact/submit', 'TicketsController@create');
Route::get('/shop', 'PagesController@shop');

// Admin Views
Route::get('/admin', 'AdminController@admin_login');
Route::get('/admin/register', 'AdminController@admin_register');
Route::post('/admin/register', 'AdminController@register');
Route::post('/admin/login', 'AdminController@login');
Route::get('admin/dashboard', 'AdminController@dashboard');
Route::get('/admin/logout', 'AdminController@logout');

// Product Views
Route::get('/admin/products', 'ProductsController@admin_view');
Route::get('/products/file/download/{product_id}', 'ProductsController@download');
Route::get('/shop/products/{product_id}', 'ProductsController@view_product');

// Order Views
Route::get('/admin/orders', 'OrdersController@admin_view');

// Ticket Views
Route::get('/admin/tickets', 'TicketsController@admin_view');