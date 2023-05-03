<?php

use App\Http\Controllers\Auth\RegisterController;
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

//login
Route::post('login', [App\Http\Controllers\API\UserController::class, 'login']);
//register
Route::post('register', [App\Http\Controllers\API\UserController::class, 'register']);
//logout
Route::post('logout', [App\Http\Controllers\API\UserController::class, 'logout'])->middleware('auth:sanctum');
//update-password
Route::post('update-password', [App\Http\Controllers\API\UserController::class, 'updatePassword'])->middleware('auth:sanctum');

//get all category
Route::get('category', [App\Http\Controllers\API\CategoryController::class, 'index']);
//store category
Route::post('category', [App\Http\Controllers\API\CategoryController::class, 'store'])->middleware('auth:sanctum');
//show category
Route::get('category/{slug}', [App\Http\Controllers\API\CategoryController::class, 'show']);
//update category
Route::put('category/{id}', [App\Http\Controllers\API\CategoryController::class, 'update'])->middleware('auth:sanctum');
