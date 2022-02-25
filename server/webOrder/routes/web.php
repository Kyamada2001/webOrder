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

//管理側
Route::get('/business/shops', 'Business\ShopController@index')->name('business.shop.index');
Route::get('/business/shops/create', 'Business\ShopController@create')->name('business.shop.create');
Route::post('/business/shop/store', 'Business\ShopController@store')->name('business.shop.store');

Route::get('/business/products', 'Business\ProductController@index')->name('business.product.index');


//お客さん側
