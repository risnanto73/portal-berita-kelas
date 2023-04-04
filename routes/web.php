<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::match(['get', 'post'], '/register', function () {
    return redirect('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/category', CategoryController::class);
    Route::resource('/news', NewsController::class);
    Route::resource('/slider', SliderController::class);
    
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class,'index'])->name('profile');
    Route::post('/profile', [\App\Http\Controllers\ProfileController::class, 'storeProfile'])->name('storeProfile');
});


Route::get('/', [\App\Http\Controllers\FrontEndController::class, 'index']);
Route::get('/detailCategory/{slug}', [\App\Http\Controllers\FrontEndController::class, 'detailCategory'])->name('detailCategory');
Route::get('/detailNews/{slug}', [\App\Http\Controllers\FrontEndController::class, 'detailNews'])->name('detailNews');


