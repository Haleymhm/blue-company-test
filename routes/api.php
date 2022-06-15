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

//Route::resource('category',\App\Http\Controllers\CategoryController::class);
Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('category');
Route::post('/category/savercat', [App\Http\Controllers\CategoryController::class, 'store'])->name('savecat');
Route::post('/category/updatecat', [App\Http\Controllers\CategoryController::class, 'update'])->name('updatecat');
Route::post('/category/deletecat', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('deletecat');

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::post('/product/saveprod', [App\Http\Controllers\ProductController::class, 'store'])->name('saveprod');
Route::post('/product/updateprod', [App\Http\Controllers\ProductController::class, 'update'])->name('updateprod');
Route::post('/product/deleteprod', [App\Http\Controllers\ProductController::class, 'destroy'])->name('deleteprod');