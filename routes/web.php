<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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
// ini router coba coba asik
Route::get('/', function () {
    return view('home');
    // return view('auth.register');
});

Route::get('/petition', function () {
    return view('petition');
});

Route::get('/petition/detail', function () {
    return view('petitionDetail');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth
Route::get('/login', [App\Http\Controllers\AuthController::class, 'getLogin'])->name('login')->middleware('guest');
Route::post('/postLogin', [App\Http\Controllers\AuthController::class, 'postLogin'])->name('postLogin');
Route::get('/register', [App\Http\Controllers\AuthController::class, 'getRegister'])->name('register')->middleware('guest');
Route::post('/postRegister', [App\Http\Controllers\AuthController::class, 'postRegister'])->name('postRegister');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/profile/{id}', [ProfileController::class, 'edit']);
Route::put('/profile/{id}', [ProfileController::class, 'update']);
