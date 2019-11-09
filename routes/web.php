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

Route::get('/', 'LandingPageController@index')->name('landing-page');

Route::get('/shop', 'ShopController@index')->name('shop.index');

Route::get('/shop/{product}', 'ShopController@show')->name('shop.show');

Route::get('/cart', 'CartController@index')->name('cart.index');

Route::post('/cart', 'CartController@store')->name('cart.store');

Route::delete('/cart/{id}', 'CartController@destroy')->name('cart.destroy');

Route::post('/cart/moveToWishList/{id}', 'CartController@moveToWishList')->name('cart.moveToWishList');

Route::delete('/wishList/{id}', 'WishListController@destroy')->name('wishList.destroy');

Route::post('/wishList/moveToCart/{id}', 'WishListController@moveToCart')->name('wishList.moveToCart');

Route::get('/empty', function () {
    Cart::instance('shopping')->destroy();
});

Route::get('/emptywish', function () {
    Cart::instance('wishList')->destroy();
});

// Route::view('/product', 'product');

// Route::view('/cart', 'cart');

Route::view('/checkout', 'checkout');

Route::view('/thankyou', 'thankyou');
