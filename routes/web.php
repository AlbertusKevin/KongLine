<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DummyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

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
//! ========================== Controller untuk uji coba ==========================
Route::get('/uji_coba', [DummyController::class, 'cobaModifikasiEntity']);

Route::get('/donation', function () {
    return view('donation');
});

//? =========================
//! App Start
//? =========================
Route::get('/', function () {
    return redirect('/home');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');

//? =========================
//! Router Profile
//? =========================
Route::get('/profile/{id}', [ProfileController::class, 'edit']);
Route::put('/profile/{id}', [ProfileController::class, 'update']);

//? =========================
//! Router Auth
//? =========================
Route::get('/login', [AuthController::class, 'getLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('/register', [AuthController::class, 'getRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

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

//? =========================
//! Router Communication
//? =========================
Route::get('/inbox', [ServiceController::class, 'index'])->name('inbox');
Route::get('/inbox/{id}', [ServiceController::class, 'show'])->name('inbox.show');

//? =========================
//! Router Admin
//? =========================
Route::get('/admin/listUser', [AdminController::class, 'getAll']);
