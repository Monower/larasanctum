<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AuthController;


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




//Route::resource('products', ProductsController::class);

//public routes
Route::get('products',[ProductsController::class,'index']);
Route::get('products/search/{name}',[ProductsController::class,'search']);
Route::get('products/{id}',[ProductsController::class,'show']);
Route::post('register',[AuthController::class,'register']);




//protected routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('products',[ProductsController::class,'store']);
    Route::put('products/{id}',[ProductsController::class,'update']);
    Route::delete('products/{id}',[ProductsController::class,'destry']);

});