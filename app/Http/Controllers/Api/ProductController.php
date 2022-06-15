<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProducts()
    {
        $productos = Product::join('categories','categories.id', '=' ,'products.category_id')
                            ->select('products.*', 'categories.categoria')->paginate(10);
        return response()->json($productos);
    }

    public function getForCategory(Request $request)
    {
        $searchCat = $request->input('category_id');
        $productos = Product::join('categories','categories.id', '=' ,'products.category_id')
                            ->select('products.*', 'categories.categoria')
                            ->Where('products.category_id','=',$searchCat)->paginate(10);
        return response()->json($productos);
    }

    public function getForText(Request $request)
    {
        $txtSearch = $request->input('search');
        $productos = Product::join('categories','categories.id', '=' ,'products.category_id')
                            ->select('products.*', 'categories.categoria')
                            ->where('nombre_prod', 'LIKE', '%'. $txtSearch. '%')->paginate(10);
        return response()->json($productos);
    }

    public function getCategories()
    {
        $category = Category::All();
        return response()->json($category);
    }


}
