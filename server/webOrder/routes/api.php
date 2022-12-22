<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', 'Customer\Auth\RegisterController@register')->name('register');
Route::post('/login', 'Customer\Auth\LoginController@authenticate')->name('login');
Route::post('/logout', 'Customer\Auth\LoginController@logout')->name('logout');
Route::post('/order/store', 'Customer\OrderController@store')->name('order.store');;

Route::get('/shops', 'Customer\ShopController@index')->name('shop.index');
Route::get('/shop/detail', 'Customer\ShopController@getShopDetail')->name('shop.detail');

Route::get('/products', 'Customer\ProductController@index')->name('product.index');

Route::get('/shop/reservable-dateTime', 'Customer\ShopController@getReservableDateTime')->name('shop.reservable-dateTime');
Route::get('/my-page/order-histories', 'Customer\MyPageController@getOrderHistories')->name('my-page.order-histories');



Route::get('/user', fn() => Auth::guard('customer')->user())->name('user');