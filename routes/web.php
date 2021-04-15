<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForumController;
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
//? =========================
//! App Start
//? =========================
Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

//? =========================
//! Route Profile
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
//! Route Auth
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
//! Route Petition
//? =========================
//* --- pemanggilan ajax ---
Route::get('/category', [EventController::class, 'getAllCategory']);
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
//! Route Donation
//? =========================
//* --- pemanggilan ajax ---
Route::get('/donation/search', [EventController::class, 'searchDonation']);
Route::get('/donation/sort', [EventController::class, 'sortDonation']);

//* --- buat donasi ---
Route::get('/donation/create', [EventController::class, 'createView']);
Route::post('/donation/create', [EventController::class, 'storeDonation']);

//* --- menampilkan donasi ---
Route::get('/donation', [EventController::class, 'listDonation']);
Route::get('/donation/{id}', [EventController::class, 'getADonation']);

//* --- partisipasi dalam donasi ---
Route::get('/donation/donate/{id}', [EventController::class, 'formDonate']);
Route::post('/donation/donate/{id}', [EventController::class, 'postDonate']);

//* --- konfirmasi pembayaran donasi ---
Route::get('/donation/confirm_donate/{id}', [EventController::class, 'formConfirm']);
Route::patch('/donation/confirm_donate/{id}', [EventController::class, 'postConfirm']);

//? =========================
//! Route Communication
//? =========================
Route::get('/inbox', [ServiceController::class, 'index'])->name('inbox');
Route::get('/inbox/{id}', [ServiceController::class, 'show'])->name('inbox.show');

//? =========================
//! Route Forum
//? =========================
Route::get('/forum', [ForumController::class, 'index'])->name('forum');
Route::get('/forum/{id}', [ForumController::class, 'comment'])->name('forum.comment');

//? =========================
//! Route Admin
//? =========================
Route::get('/admin', [AdminController::class, 'home'])->name('admin')->middleware('admin');

//! Users
Route::get('/admin/listUser', [AdminController::class, 'getAll']);
Route::get('/admin/listUser/role', [AdminController::class, 'listUserByRole']);
Route::get('/admin/listUser/countEvent', [AdminController::class, 'countEventParticipate']);

//! Petition
Route::get('/admin/petition', [AdminController::class, 'getListPetition'])->middleware('admin');
Route::patch('/admin/petition/accept/{id}', [AdminController::class, 'acceptPetition'])->middleware('admin');
Route::patch('/admin/petition/reject/{id}', [AdminController::class, 'rejectPetition'])->middleware('admin');
Route::patch('/admin/petition/close/{id}', [AdminController::class, 'closePetition'])->middleware('admin');

//! Donation
Route::get('/admin/donation', [AdminController::class, 'getListDonation'])->middleware('admin');
Route::get('/admin/donation/transaction', [AdminController::class, 'getAllTransaction'])->middleware('admin');
Route::get('/admin/donation/transaction/{idEvent}', [AdminController::class, 'getATransaction'])->middleware('admin');

Route::patch('/admin/donation/transaction/confirm/{id}', [AdminController::class, 'confirmTransaction'])->middleware('admin');
Route::patch('/admin/donation/transaction/reject/{id}', [AdminController::class, 'rejectTransaction'])->middleware('admin');

Route::patch('/admin/donation/accept/{id}', [AdminController::class, 'acceptDonation'])->middleware('admin');
Route::patch('/admin/donation/reject/{id}', [AdminController::class, 'rejectDonation'])->middleware('admin');
Route::patch('/admin/donation/close/{id}', [AdminController::class, 'closeDonation'])->middleware('admin');

//* -------- ajax -----------
Route::get('/admin/donation/sort', [AdminController::class, 'adminSortDonation'])->middleware('admin');
Route::get('/admin/donation/search', [AdminController::class, 'adminSearchDonation'])->middleware('admin');
Route::get('/admin/donation/type', [AdminController::class, 'donationType']);

Route::get('/admin/transaction/type', [AdminController::class, 'transactionType']);
Route::get('/admin/transaction/search', [AdminController::class, 'searchTransaction']);
