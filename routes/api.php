<?php

// use App\Http\Controllers\Auth\RegisterController;

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

//route login
Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'login']);
//route register
Route::post('register', [\App\Http\Controllers\API\AuthController::class, 'register']);
//route logout
Route::post('logout', [\App\Http\Controllers\API\AuthController::class, 'logout'])->middleware('auth:sanctum');
//route update-password
Route::post('update-password', [\App\Http\Controllers\API\AuthController::class, 'updatePassword'])->middleware('auth:sanctum');

//get all user
Route::get('getAllUser', [\App\Http\Controllers\API\UserController::class, 'getAllUser'])->middleware('auth:sanctum');
Route::get('getUserById/{id}', [\App\Http\Controllers\API\UserController::class, 'getUserById'])->middleware('auth:sanctum');


//category
Route::get('category', [\App\Http\Controllers\API\CategoryController::class, 'index']);
Route::post('category', [\App\Http\Controllers\API\CategoryController::class, 'create'])->middleware('auth:sanctum');
Route::delete('category/{id}', [\App\Http\Controllers\API\CategoryController::class, 'destroy'])->middleware('auth:sanctum');
//update category
Route::post('category/{id}', [\App\Http\Controllers\API\CategoryController::class, 'update'])->middleware('auth:sanctum');
