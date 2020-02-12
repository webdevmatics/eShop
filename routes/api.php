<?php

use App\Product;
use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::get('/products','Api\ProductController@index');
// Route::post('/products','Api\ProductController@store');
// Route::put('/products','Api\ProductController@update');
// Route::delete('/products','Api\ProductController@delete');

Route::apiResource('products','Api\ProductController');

