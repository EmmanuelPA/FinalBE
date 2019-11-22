<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\ProductCollection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['products'] = Product::paginate(20);
        return view('index', $datos);
         //return view('createProd');
        //
    }
    
        /**
     * Display all resources.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function showAll(Product $product)
    {
        $products = ProductResource::collection(Product::all());
        return $products;
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('createProd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $type = $request->data["type"];
        $nombre = $request->data["attributes"]["name"];
        $precio = $request->data["attributes"]["price"];
        
        if(is_null($nombre)){
                return response()->json([
               "errors"=> ["code"=> "ERROR-1",
               "title"=>  "Unprocessable Entity",
               ]]  , 422);
        } elseif(is_null($precio)){
                return response()->json([
                 "errors"=> ["code"=> "ERROR-1",
                 "title"=>  "Unprocessable Entity",
                 ]]  , 422);
        }elseif(!(is_numeric($precio))){
              return response()->json([
                   "errors"=> ["code"=> "ERROR-1",
                   "title"=>  "Unprocessable Entity",
                   ]]  , 422);
        }elseif($precio<=0){
                return response()->json([
                           "errors"=> ["code"=> "ERROR-1",
                           "title"=>  "Unprocessable Entity",
                           ]]  , 422);
        }
        else{

        $product = new ProductResource(Product::create([

            "name" => $nombre,
            "price" => $precio
        ]));
       
        return $product;
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        //  public function show($id)
   if (!(Product::find($product))) {
        return response()->json([
             "errors"=> ["code"=> "ERROR-2",
             "title"=>  "Not found"
             ]]  , 404);
        }else{
       return new ProductResource(Product::findOrFail($product), 200);
   }
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $producto = Product::findOrFail($id);
        return view('editProd', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product)
    {
        
        $nombre = $request->data["attributes"]["name"];
        $precio = $request->data["attributes"]["price"];
       
        if (!(is_numeric($precio))) {
              return response()->json([
                   "errors"=> ["code"=> "ERROR-1",
                   "title"=>  "Unprocessable Entity",
                   ]]  , 422);
        }elseif (($precio)<=0) {
                      return response()->json([
                           "errors"=> ["code"=> "ERROR-1",
                           "title"=>  "Unprocessable Entity",
                           ]]  , 422);
                } elseif (!(Product::find($product))) {
        return response()->json([
             "errors"=> ["code"=> "ERROR-2",
             "title"=>  "Not found",
             ]]  , 404);
        } else {
        $update = Product::findOrFail($product);
        $update->name = $nombre;
        $update->price = $precio;
        $update->save();
        return new ProductResource(Product::findOrFail($id), 200);
       
     }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($identificador)
    {
        //
             if (!(Product::find($identificador))) {
        return response()->json([
             "errors"=> ["code"=> "ERROR-2",
             "title"=>  "Not found"
             
             ]]  , 404);
        } else{
        $request = Product::findOrFail($identificador);
        $delete = Product::destroy($identificador);
        return response()->json(200);
        //return response()->json(200);
        //return redirect('/');
    }
    }
}
