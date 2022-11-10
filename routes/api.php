<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\PhotoApiController;
use App\Http\Controllers\ApiAuthController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register',[ApiAuthController::class,'register'])->name('api.register');
Route::post('/login',[ApiAuthController::class,'login'])->name('api.login');


Route::middleware('auth:sanctum')->group(function (){
    Route::apiResource('products',ProductApiController::class);
    Route::apiResource('photos',PhotoApiController::class);
    Route::post('/logout',[ApiAuthController::class,'logout'])->name('api.logout');
    Route::get('/tokens',[ApiAuthController::class,'tokens'])->name('api.tokens');
});
