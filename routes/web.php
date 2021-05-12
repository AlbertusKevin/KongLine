<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\PetitionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ControllingController;
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
Route::get('/category', [PetitionController::class, 'getAllCategory']);
Route::get('/petition/type', [PetitionController::class, 'listPetitionType']);
Route::get('/petition/search', [PetitionController::class, 'searchPetition']);
Route::get('/petition/sort', [PetitionController::class, 'sortPetition']);
Route::post('/petition/create/verification', [PetitionController::class, 'verifyProfile']);

Route::get('/petition', [PetitionController::class, 'getAllActivePetition']);
Route::get('/petition/create', [PetitionController::class, 'createPetition']);
Route::post('/petition/create', [PetitionController::class, 'storePetition']);
Route::get('/petition/{id}', [PetitionController::class, 'showPetition']);

Route::get('/petition/edit/{id}', [PetitionController::class, 'editPetition']);
Route::put('/petition/{id}', [PetitionController::class, 'updatePetition']);

Route::get('/petition/comments/{id}', [PetitionController::class, 'commentPetition']);

Route::get('/petition/progress/{id}', [PetitionController::class, 'progressPetition']);
Route::post('/petition/progress/{id}', [PetitionController::class, 'storeProgressPetition']);

Route::post('/petition/{id}', [PetitionController::class, 'signPetition']);

//? =========================
//! Route Donation
//? =========================
//* --- pemanggilan ajax ---
Route::get('/donation/search', [DonationController::class, 'searchDonation']);
Route::get('/donation/sort', [DonationController::class, 'sortDonation']);

//* --- buat donasi ---
Route::get('/donation/create', [DonationController::class, 'createView']);
Route::post('/donation/create', [DonationController::class, 'storeDonation']);

//* --- menampilkan donasi ---
Route::get('/donation', [DonationController::class, 'getAllDonation']);
Route::get('/donation/{id}', [DonationController::class, 'getADonation']);
Route::get('/donation/edit/{id}', [DonationController::class, 'editDonation']);
Route::put('/donation/{id}', [DonationController::class, 'updateDonation']);

//* --- partisipasi dalam donasi ---
Route::get('/donation/donate/{id}', [DonationController::class, 'formDonate']);
Route::post('/donation/donate/{id}', [DonationController::class, 'postDonate']);

Route::patch('/donation/donate/{id}', [DonationController::class, 'updateDonate']);
Route::get('/donation/donate/edit/{id}', [DonationController::class, 'editDonate']);

//* --- konfirmasi pembayaran donasi ---
Route::get('/donation/confirm_donate/{id}', [DonationController::class, 'formConfirm']);
Route::patch('/donation/confirm_donate/{id}', [DonationController::class, 'postConfirm']);

//? =========================
//! Route Communication
//? =========================
Route::get('/inbox', [ServiceController::class, 'index'])->name('inbox');
Route::get('/inbox/{id}', [ServiceController::class, 'show'])->name('inbox.show')->middleware('admin');

//? =========================
//! Route Forum
//? =========================
Route::get('/forum', [ForumController::class, 'index'])->name('forum');
Route::get('/forum/{id}', [ForumController::class, 'comment'])->name('forum.comment');
Route::get('/forumerror', [ForumController::class, 'error']);
Route::get('/inputforum', [ForumController::class, 'inputforum']);
Route::post('/input', [ForumController::class, 'input']);

//? =========================
//! Route Admin
//? =========================

Route::get('/admin', [ControllingController::class, 'home'])->name('admin')->middleware('admin');

//! Users
Route::get('/admin/listUser', [ControllingController::class, 'getAllUsers'])->middleware('admin');
Route::get('/admin/listUser/role', [ControllingController::class, 'getUsersByRole'])->middleware('admin');

Route::get('/admin/listUser/sort', [ControllingController::class, 'sortListUser'])->middleware('admin'); //Sort List User
Route::get('/admin/listUser/search', [ControllingController::class, 'searchUser'])->middleware('admin');
Route::get('/admin/listUser/countEvent', [ControllingController::class, 'countEventParticipate'])->middleware('admin');
Route::get('/admin/user/{id}', [ControllingController::class, 'getUserInfo'])->middleware('admin');
Route::get('/admin/user/diikuti/{id}', [ControllingController::class, 'getEventParticipate'])->middleware('admin');
Route::get('/admin/user/dibuat/{id}', [ControllingController::class, 'getEventMade'])->middleware('admin');
Route::patch('/admin/user/terimaPengajuan/{id}', [ControllingController::class, 'acceptUserToCampaigner'])->middleware('admin');
Route::patch('/admin/user/tolakPengajuan/{id}', [ControllingController::class, 'rejectUserToCampaigner'])->middleware('admin');

//! Petition
Route::get('/admin/petition', [ControllingController::class, 'getListPetition'])->middleware('admin');
Route::patch('/admin/petition/accept/{id}', [ControllingController::class, 'acceptPetition'])->middleware('admin');
Route::patch('/admin/petition/reject/{id}', [ControllingController::class, 'rejectPetition'])->middleware('admin');
Route::patch('/admin/petition/close/{id}', [ControllingController::class, 'closePetition'])->middleware('admin');

//! Donation
Route::get('/admin/donation', [ControllingController::class, 'getListDonation'])->middleware('admin');
Route::get('/admin/donation/transaction', [ControllingController::class, 'getAllTransaction'])->middleware('admin');
Route::get('/admin/donation/transaction/{idEvent}', [ControllingController::class, 'getATransaction'])->middleware('admin');

Route::patch('/admin/donation/transaction/confirm/{id}', [ControllingController::class, 'confirmTransaction'])->middleware('admin');
Route::patch('/admin/donation/transaction/reject/{id}', [ControllingController::class, 'rejectTransaction'])->middleware('admin');

Route::patch('/admin/donation/accept/{id}', [ControllingController::class, 'acceptDonation'])->middleware('admin');
Route::patch('/admin/donation/reject/{id}', [ControllingController::class, 'rejectDonation'])->middleware('admin');
Route::patch('/admin/donation/close/{id}', [ControllingController::class, 'closeDonation'])->middleware('admin');

//* -------- ajax -----------
Route::get('/admin/donation/sort', [ControllingController::class, 'adminSortDonation'])->middleware('admin');
Route::get('/admin/donation/search', [ControllingController::class, 'adminSearchDonation'])->middleware('admin');
Route::get('/admin/donation/type', [ControllingController::class, 'donationType'])->middleware('admin');

Route::get('/admin/transaction/type', [ControllingController::class, 'transactionType'])->middleware('admin');
Route::get('/admin/transaction/search', [ControllingController::class, 'searchTransaction'])->middleware('admin');
