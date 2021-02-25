<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

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
    session(['id_user' => 4]);
    return view('home');
});

Route::get('/logout', function (Request $request) {
    session()->flush();
    return redirect('/');
});

//? =========================
//! Router Profile
//? =========================
Route::get('/profile/{id}', [ProfileController::class, 'edit']);
Route::put('/profile/{id}', [ProfileController::class, 'update']);

//? =========================
//! Router Petition
//? =========================
Route::get('/petisi', [EventController::class, 'indexPetition']);
Route::get('/petisi/{id}', [EventController::class, 'showPetition']);
