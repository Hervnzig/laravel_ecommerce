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

/*
 * Admin Routes
 */

Route::prefix('admin')->group(function(){
    // dashboard
    Route::get('/', 'DashboardController@index');

    // product
    Route::resource('/products', 'ProductController');

    // orders
    Route::resource('/orders', 'OrderController');
    Route::get('/confirm/{id}', 'OrderController@confirm')->name('order.confirm');
    Route::get('/pending/{id}', 'OrderController@pending')->name('order.pending');

    // Users
    Route::resource('/users', 'UsersController');

    // Admin Login
    Route::get('/admin/login', 'AdminUserController@index');
    Route::post('/admin/login', 'AdminUserController@store');

});

/*
 * Frontend Routes
 */