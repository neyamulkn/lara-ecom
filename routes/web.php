<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'HomeController@index')->name('home');
Route::get('category/{catslug?}/{subslug?}/{childslug?}', 'HomeController@category')->name('home.category');
//search products
Route::get('search', 'HomeController@search')->name('product.search');

Route::get('apicategory/{catslug?}/{subslug?}/{childslug?}', 'HomeController@apicategory')->name('home.apicategory');

Route::get('cart/add', 'CartController@cartAdd')->name('cart.add');
Route::get('cart/view', 'CartController@cartView')->name('cart.view');
Route::get('cart/update', 'CartController@cartUpdate')->name('cart.update');
Route::get('cart/item/remove/{id}', 'CartController@itemRemove')->name('cart.itemRemove');
Route::get('cart/remove/allitem', 'CartController@clearCart')->name('cart.clear');
Route::get('cart/view/header', 'AjaxController@getCartHead')->name('getCartHead');

//apply coupon
Route::get('coupon/apply', 'HomeController@couponApply')->name('coupon.apply');

Route::get('product/{slug?}', 'HomeController@product_details')->name('product_details');
Route::get('cart', 'HomeController@cart')->name('cart');
Route::get('checkout', 'HomeController@checkout')->name('checkout');
Route::get('wishlist', 'HomeController@wishlist')->name('wishlist');
Route::get('account', 'HomeController@my_account')->name('my_account');

Auth::routes();

