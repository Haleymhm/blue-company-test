<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('category');
Route::post('/category/savercat', [App\Http\Controllers\CategoryController::class, 'store'])->name('savecat');
Route::post('/category/updatecat', [App\Http\Controllers\CategoryController::class, 'update'])->name('updatecat');
Route::post('/category/deletecat', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('deletecat');

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::post('/product/saveprod', [App\Http\Controllers\ProductController::class, 'store'])->name('saveprod');
Route::post('/product/updateprod', [App\Http\Controllers\ProductController::class, 'update'])->name('updateprod');
Route::post('/product/deleteprod', [App\Http\Controllers\ProductController::class, 'destroy'])->name('deleteprod');


Route::get('/getProducts', [App\Http\Controllers\Api\ProductController::class, 'getProducts'])->name('getProducts');
Route::get('/getCategories', [App\Http\Controllers\Api\ProductController::class, 'getCategories'])->name('getCategories');
Route::get('/getForCategory', [App\Http\Controllers\Api\ProductController::class, 'getForCategory'])->name('getForCategory');
Route::get('/getForText', [App\Http\Controllers\Api\ProductController::class, 'getForText'])->name('getForText');