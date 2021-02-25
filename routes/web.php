<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;

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
Route::get('/', function () {
    return view('home');
});

Route::get('/petition', function () {
    return view('petition');
});

Route::get('/petition/detail', function () {
    return view('petitionDetail');
});

//? =========================
//! Router Aplikasi
//? =========================
Route::get('/profile/{id}', [ProfileController::class, 'edit']);
Route::put('/profile/{id}', [ProfileController::class, 'update']);

Route::get('/petisi', [EventController::class, 'indexPetition']);
