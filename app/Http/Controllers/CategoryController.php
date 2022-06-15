<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $txtSearch = $request->input('search');
        //$category = Category::All();
        $category = Category::where('categoria','LIKE', '%'. $txtSearch. '%')
                            ->paginate(10);
        return response()->json($category);
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
            $category = new Category;
            $category->categoria = $request->categoria_nombre;
            $category->save();
            return response()->json([
                'category' => $category
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Error al crear categoria'
            ],400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        try {
            $category = Category::find($request->categoria_id);
            $category->categoria = $request->categoria_nombre;
            $category->save();
            return response()->json([
                'category' => $category
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Error al editar categoria'
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
            $category = Category::find($request->categoria_id);
            $category->delete();
            return response()->json([
                'msg' => 'Categoria elminada'
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Error al editar categoria'
            ],400);
        }
    }
}
