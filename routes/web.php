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

//* Routes for Landing Page
Route::get('/', 'LandingPageController@index')->name('landing-page');

//* Routes for Shop Page

Route::get('/shop', 'ShopController@index')->name('shop.index');

Route::get('/shop/{product}', 'ShopController@show')->name('shop.show');

//* Routes for Cart Page
Route::get('/cart', 'CartController@index')->name('cart.index');

Route::post('/cart', 'CartController@store')->name('cart.store');

Route::put('/cart/{id}', 'CartController@update')->name('cart.update');

Route::delete('/cart/{id}', 'CartController@destroy')->name('cart.destroy');

Route::post('/cart/moveToWishList/{id}', 'CartController@moveToWishList')->name('cart.moveToWishList');

//* Routes for WishList Page
Route::delete('/wishList/{id}', 'WishListController@destroy')->name('wishList.destroy');

Route::post('/wishList/moveToCart/{id}', 'WishListController@moveToCart')->name('wishList.moveToCart');

//* Routes for CheckOut Page
Route::get('/checkout', 'CheckOutController@index')->name('checkout.index');

Route::post('/checkout', 'CheckOutController@store')->name('checkout.store');

//* Routes for Confirmation Page
Route::get('/thankyou', 'ConfirmationController@index')->name('confirmation.index');

//* Route for Coupon
Route::post('/coupon', 'CouponController@store')->name('coupon.store');

Route::delete('/coupon', 'CouponController@destroy')->name('coupon.destroy');

//* Routes for Testing
Route::get('/empty', function () {
    Cart::instance('shopping')->destroy();
    session()->forget('coupon');
});

Route::get('/emptywish', function () {
    Cart::instance('wishList')->destroy();
    session()->forget('coupon');
});
