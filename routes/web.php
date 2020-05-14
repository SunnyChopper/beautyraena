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

// Admin Views
Route::get('/admin', 'AdminController@admin_login');
Route::get('/admin/register', 'AdminController@admin_register');
Route::post('/admin/register', 'AdminController@register');
Route::post('/admin/login', 'AdminController@login');
Route::get('admin/dashboard', 'AdminController@dashboard');

// Product Views
Route::get('/admin/products', 'ProductsController@admin_view');