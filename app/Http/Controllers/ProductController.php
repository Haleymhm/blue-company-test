<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    
    public function index(Request $request)
    {
        $txtSearch = $request->input('search');
        $searchCat = $request->input('cat');
                            
        if($searchCat){
            $productos = Product::join('categories','categories.id', '=' ,'products.category_id')
                                ->select('products.*', 'categories.categoria')
                                ->Where('products.category_id','=',$searchCat)->paginate(10);
        }elseif($txtSearch){
            $productos = Product::join('categories','categories.id', '=' ,'products.category_id')
                                ->select('products.*', 'categories.categoria')
                                ->where('nombre_prod', 'LIKE', '%'. $txtSearch. '%')->paginate(10);
        }else{
            $productos = Product::join('categories','categories.id', '=' ,'products.category_id')
                                ->select('products.*', 'categories.categoria')->paginate(10);
        }
                            
        return response()->json($productos);
    }

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
