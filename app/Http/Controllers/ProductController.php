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
        
        
        $product = new ProductResource(Product::create([
            "name" => $request->input('name'),
            "price" => $request->input('price')
        ]));
       
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //  public function show($id)

        return new ProductResource($product);
    
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
    public function update(Request $request, Product $product)
    {
        $product->fill([
            "name" => $request->input('name'),
            "price" => $request->input('price')
        ]);
        $product->save();
        return new ProductResource($product);
       
       // return view('editProd', compact('producto'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $id, $identificador)
    {
        //
        $id->delete();
        Product::destroy($identificador);
        return new ProductResource($id);
        //return response()->json(200);
        //return redirect('/');
    }
}
