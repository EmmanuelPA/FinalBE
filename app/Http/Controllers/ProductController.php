<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        return $product->all();

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
        if(is_null($request->name)){
                return response()->json([
               "errors"=> ["code"=> "ERROR-1",
               "title"=>  "Unprocessable Entity",
               ]]  , 422);
        } elseif (is_null($request->price)) {
                 return response()->json([
                 "errors"=> ["code"=> "ERROR-1",
                 "title"=>  "Unprocessable Entity",
                 ]]  , 422);
        } elseif (!(is_numeric($request->price))) {
              return response()->json([
                   "errors"=> ["code"=> "ERROR-1",
                   "title"=>  "Unprocessable Entity",
                   ]]  , 422);
        }elseif (($request->price)<=0) {
                      return response()->json([
                           "errors"=> ["code"=> "ERROR-1",
                           "title"=>  "Unprocessable Entity",
                           ]]  , 422);
                }else {
                    //$datosEmpleado = request()->all();
                   $datosEmpleado = Product::create(request()->all());
                     // Product::insert($datosEmpleado);
                     return response()->json($datosEmpleado,201);
                }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //  public function show($id)
       if (!(Product::find($id))) {
        return response()->json([
             "errors"=> ["code"=> "ERROR-2",
             "title"=>  "Not found"
             ]]  , 404);
        }else{

        $producto = Product::findOrFail($id);
        return response()->json($producto, 200);
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
    public function update(Request $request, $id)
    {
        if (!(is_numeric($request->price))) {
              return response()->json([
                   "errors"=> ["code"=> "ERROR-1",
                   "title"=>  "Unprocessable Entity",
                   ]]  , 422);
        }elseif (($request->price)<=0) {
                      return response()->json([
                           "errors"=> ["code"=> "ERROR-1",
                           "title"=>  "Unprocessable Entity",
                           ]]  , 422);
                } elseif (!(Product::find($id))) {
        return response()->json([
             "errors"=> ["code"=> "ERROR-2",
             "title"=>  "Not found",
             ]]  , 404);
        } else {

         $datosEmpleado = request()->except(['_token', '_method']);
        Product::where('id', "=", $id)->update($datosEmpleado);
                $producto = Product::findOrFail($id);
         return response()->json($producto,201);
        return view('editProd', compact('producto'));
                }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
           if (!(Product::find($id))) {
        return response()->json([
             "errors"=> ["code"=> "ERROR-2",
             "title"=>  "Not found"
             
             ]]  , 404);
        } else{

        Product::destroy($id);
        return response()->json(200);
        return redirect('/');
    }
        }
}
