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
Route::get('/business/shops/{shop}/edit', 'Business\ShopController@edit')->name('business.shop.edit');
Route::post('/business/shop/{shop}/update', 'Business\ShopController@update')->name('business.shop.update');

Route::get('/business/products', 'Business\ProductController@index')->name('business.product.index');
Route::get('/business/products/create', 'Business\ProductController@create')->name('business.product.create');
Route::post('/business/products/store', 'Business\ProductController@store')->name('business.product.store');
Route::get('/business/products/{product}/edit', 'Business\ProductController@edit')->name('business.product.edit');
Route::post('/business/products/{product}/update', 'Business\ProductController@update')->name('business.product.update');



//お客さん側

Route::get('/', function(){
    return view('customer.home');
});

Route::get('/{any}', function(){ 
    return view('customer.home');
})->where('{any}','.+');

Route::get('/{any}/{any2}', function(){ //応急処置的な書き方。2スラッシュ以降URLがある際にどのようなコードがあるのか
    return view('customer.home');
})->where('{any}','.+')
->where('{any2}','.+');

Route::get('/{any}/{any2}/{any3}', function(){ //応急処置的な書き方。2スラッシュ以降URLがある際にどのようなコードがあるのか
    return view('customer.home');
})->where('{any}','.+')
->where('{any2}','.+')
->where('{any3}','.+');


Auth::routes();
