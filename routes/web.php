<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use Illuminate\Routing\Router;
use App\Http\Controllers\AdminController;

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
//? =========================
//! Router percobaan
//? =========================
// Route::get('/', function () {
//     // 1 guest, 2 admin, 3 participant, 4 campaigner
//     session(['id_user' => 3]);
//     return view('home');
//     // return view('auth.register');
// });

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/donation', function () {
    return view('donation');
});

Route::get('/admin/listUser', function(){
    return view('listUser');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//? =========================
//! Router Profile
//? =========================
Route::get('/profile/{id}', [ProfileController::class, 'edit']);
Route::put('/profile/{id}', [ProfileController::class, 'update']);

//? =========================
//! Router Auth
//? =========================
Route::get('/login', [App\Http\Controllers\AuthController::class, 'getLogin'])->name('login')->middleware('guest');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'postLogin'])->name('postLogin');
Route::get('/register', [App\Http\Controllers\AuthController::class, 'getRegister'])->name('register')->middleware('guest');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'postRegister'])->name('postRegister');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

//? =========================
//! Router Petition
//? =========================
//* --- pemanggilan ajax ---
Route::get('/petisi/type', [EventController::class, 'listPetitionType']);
Route::get('/petisi/search', [EventController::class, 'searchPetition']);
Route::get('/petisi/sort', [EventController::class, 'sortPetition']);

Route::get('/petisi', [EventController::class, 'indexPetition']);
Route::get('/petisi/{id}', [EventController::class, 'showPetition']);

Route::post('/petisi/{id}', [EventController::class, 'signPetition']);

Route::get('/admin/listUser', [AdminController::class, 'getAll']);

