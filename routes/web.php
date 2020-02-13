<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::resource('products', 'ProductController')->middleware('can:seller,admin');

Route::resource('address', 'AddressController')->middleware('auth');

Route::get('add-to-cart/{product}', 'ProductController@addToCart')->name('cart');
Route::get('remove-cart-item/{product}', 'ProductController@reduceQuantity')->name('cart.reduce');
Route::get('view-cart', 'ProductController@viewCart')->name('cart.view');
Route::get('delete-cart/{productId}', 'ProductController@deleteCart')->name('cart.delete');


Route::get('cart/checkout', 'CartController@checkout')->name('cart.checkout');

Route::resource('orders', 'OrderController')->middleware('auth');
Route::resource('shops', 'ShopController')->middleware('auth');


Route::view('order-completed', 'order-completed');



Route::get('admin', function () {
    $shop = auth()->user()->shop;

    return view('admin.dashboard', compact('shop'));

})->name('admin')->middleware('auth');
