<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $txtSearch = $request->input('search');
        $productos = Product::join('categories','categories.id', '=' ,'products.category_id')
                            ->where('nombre_prod', 'LIKE', '%'. $txtSearch. '%')
                            ->select('products.*', 'categories.categoria')
                            ->paginate(10);
        return response()->json($productos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $product = new Product();
            $product->category_id = $request->categoria_id;
            $product->nombre_prod = $request->producto_nombre;
            $product->valor = $request->producto_valor;
            $product->fecha_expiracion = $request->producto_fechae;
            $product->save();
            return response()->json([
                'product' => $product
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Error al crear categoria'
            ],400);
        }
    }


    public function update(Request $request)
    {
        try {
            $product = Product::find($request->producto_id);

            $product->category_id = $request->categoria_id;
            $product->nombre_prod = $request->producto_nombre;
            $product->valor = $request->producto_valor;
            $product->fecha_expiracion = $request->producto_fechae;
            $product->save();
            return response()->json([
                'product' => $product
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Error al crear categoria'
            ],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $product = Product::find($request->producto_id);
            $product->delete();
            return response()->json([
                'msg' => 'Categoria elminada'
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Error al crear categoria'
            ],400);
        }
    }
        
    
}
