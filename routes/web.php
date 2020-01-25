<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::resource('products', 'ProductController')->middleware('auth');
Route::resource('address', 'AddressController')->middleware('auth');
// Route::resource('cart', 'AddressController')->middleware('auth');
Route::get('add-to-cart/{product}', 'ProductController@addToCart')->name('cart');

Route::get('admin', function () {
    return view('admin.dashboard');
})->name('admin')->middleware('auth');

