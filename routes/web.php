<?php

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




// Route::resource('user', [App\Http\Controllers\UserController::class]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/daftar', [App\Http\Controllers\AdminController::class, 'create'])->name('daftar');

Auth::routes();
Route::group(['middleware' => 'auth', 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::resource('', App\Http\Controllers\AdminController::class);
    Route::resource('pengguna', App\Http\Controllers\Admin\UserController::class);
    Route::resource('pertanyaan', App\Http\Controllers\Admin\QuestionController::class);
});

Route::group(['middleware' => 'auth', 'user', 'as' => 'user.', 'prefix' => 'user'], function () {
    Route::resource('', App\Http\Controllers\UserController::class);
    Route::post('/score', [App\Http\Controllers\UserController::class, 'storeScore']);
    Route::get('/test', [App\Http\Controllers\UserController::class, 'startTest'])->name('test');
});
