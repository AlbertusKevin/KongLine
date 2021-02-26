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

Route::get('/donation', function(){
    return view('donation');
});

Route::get('/profile/{id}', [ProfileController::class, 'edit']);
Route::put('/profile/{id}', [ProfileController::class, 'update']);

