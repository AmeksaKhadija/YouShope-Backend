<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProductController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });




// authentication
Route::post('register',[RegisterController::class,'register']);
Route::post('login',[LoginController::class,'login']);

// crud des produits et categories
Route::apiResource('products',ProductController::class);
Route::apiResource('categories',CategorieController::class);

// Route::get('test',[ProductController::class,'test']);

// addToCart
Route::post('cart',[CartController::class,'storeInSession']);
Route::get('cart',[CartController::class,'getCart']);
Route::delete('cart/remove/{product_id}',[CartController::class,'removeFromCart']);
Route::delete('cart/clear',[CartController::class,'clearCart']);
 