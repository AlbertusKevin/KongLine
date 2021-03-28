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
Route::get('/profile', [ProfileController::class, 'edit']);
Route::put('/profile', [ProfileController::class, 'update']);

Route::get('/delete', [ProfileController::class, 'delete']);

Route::get('/profile/campaigner', [ProfileController::class, 'editCampaigner']);
Route::put('/profile/campaigner', [ProfileController::class, 'updateCampaigner']);

Route::get('/campaigner', [ProfileController::class, 'dataCampaigner']);

Route::get('/change', [ProfileController::class, 'viewChangePassword']);
Route::put('/change', [ProfileController::class, 'changePassword']);



//? =========================
//! Router Auth
//? =========================
Route::get('/login', [AuthController::class, 'getLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('/register', [AuthController::class, 'getRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgot', [AuthController::class, 'getForgot']);
Route::post('/forgot', [AuthController::class, 'postForgot'])->name('forgot');
Route::get('/reset/{email}/{token}', [AuthController::class, 'getReset']);
Route::post('/reset', [AuthController::class, 'postReset'])->name('reset');

//? =========================
//! Router Petition
//? =========================
//* --- pemanggilan ajax ---
Route::get('/petition/type', [EventController::class, 'listPetitionType']);
Route::get('/petition/search', [EventController::class, 'searchPetition']);
Route::get('/petition/sort', [EventController::class, 'sortPetition']);
Route::post('/petition/create/verification', [EventController::class, 'verifyProfile']);

Route::get('/petition', [EventController::class, 'indexPetition']);
Route::get('/petition/create', [EventController::class, 'createPetition']);
Route::post('/petition/create', [EventController::class, 'storePetition']);
Route::get('/petition/{id}', [EventController::class, 'showPetition']);
Route::get('/petition/comments/{id}', [EventController::class, 'commentPetition']);
Route::get('/petition/progress/{id}', [EventController::class, 'progressPetition']);
Route::post('/petition/progress/{id}', [EventController::class, 'storeProgressPetition']);

Route::post('/petition/{id}', [EventController::class, 'signPetition']);

//? =========================
//! Router Donation
//? =========================
Route::get('/donation/search', [EventController::class, 'searchDonation']);
Route::get('/donation/sort', [EventController::class, 'sortDonation']);

Route::get('/donation', [EventController::class, 'listDonation']);
Route::get('/donation/create', [EventController::class, 'createView']);
Route::get('/donation/{id}', [EventController::class, 'getADonation']);
Route::get('/donation/donate/{id}', [EventController::class, 'formDonate']);

//? =========================
//! Route Communication
//? =========================
Route::get('/inbox', [ServiceController::class, 'index'])->name('inbox');
Route::get('/inbox/{id}', [ServiceController::class, 'show'])->name('inbox.show');

//? =========================
//! Router Admin
//? =========================
Route::get('/admin/listUser/role', [AdminController::class, 'listUserByRole']);

Route::get('/admin/listUser/countEvent', [AdminController::class, 'countEventParticipate']);
Route::get('/admin/listUser', [AdminController::class, 'getAll']);
