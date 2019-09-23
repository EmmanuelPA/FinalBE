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

Route::resource('productos', 'ProductController');
Route::get('/', 'ProductController@index');
Route::get('/createProductos', 'ProductController@create');
Route::get('/showAllProductos', 'ProductController@showAll');
/**
 * Display All Products
 */
//Route::get('/productos', 'ProductController@index');
 
/**
 * Add A New Product
 */
/*Route::post('/producto', function (Request $request) {
    //
    /*$validator = Validator::make($request->all(), [
     'name' => 'required|max:70',
    'price' => 'required'
    ])->validate();
    */
    
    
   /* if($validator->fails()){
        return redirect('/productos')
            ->withInput()
            ->withErrors($validator);
    }*/
    
   /* $producto = new Product;
    $producto->name = $request->name;
    $producto->price = $request->price;
    $producto->save();
    
    return redirect('/productos');
});*/
 
/**
 * Delete An Existing Product
 */
//Route::delete('/producto/{id}', 'ProductController@destroy');