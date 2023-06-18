<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
// Public Routes
//Route::resource('users',UserController::class);
//Route::resource('product',ProductController::class);
Route::post('/users/login',[UserController::class,'login']);
Route::get('/users',[UserController::class,'index']);
Route::post('/users',[UserController::class,'store']);
Route::put('/users/{id}', [UserController::class,'update']);
Route::delete('/users/{id}', [UserController::class,'destroy']);

// protected routes
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::get('/users/{users}',[UserController::class,'show']);
});

 Route::middleware('auth:api')->get('/user', function (Request $request) {
     return $request->user();
 });
