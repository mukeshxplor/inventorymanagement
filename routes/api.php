<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthcheckMiddleware;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware([AuthcheckMiddleware::class])->group(function(){
    Route::resource('/category', CategoryController::class);
    Route::resource('/product', ProductController::class);
});

// Route::middleware([EnsureTokenIsValid::class])->group(function () {
//     Route::resource('/category', CategoryController::class);
//     Route::resource('/product', ProductController::class);
// });


