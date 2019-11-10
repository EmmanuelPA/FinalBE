<?php

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
# routes/api.php

Route::get('/greeting', function (Request $request){
    return '';
});

# routes/api.php

Route::get('/greeting', function (Request $request){
    return 'Hello World!';
});

Route::post('/products', 'ProductController@store')->name("product.store");

Route::put('/products/{id}', "ProductController@update");

Route::delete('/products/{id}', "ProductController@destroy");

Route::get('/products/{id}', "ProductController@show")->name("product.show");

Route::get('/products', 'ProductController@showAll');