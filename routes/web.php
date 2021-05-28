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
Route::get('/profile', [ProfileController::class, 'getViewDetailAnUser'])->middleware('user');
Route::put('/profile', [ProfileController::class, 'updateAnUserData'])->middleware('user');

Route::get('/delete', [ProfileController::class, 'deleteAnUserAccount'])->middleware('user');
Route::post('/delete/profile/verification', [ProfileController::class, 'verifyProfileDeleteAccount'])->middleware('user');

Route::get('/profile/campaigner', [ProfileController::class, 'detailDataCampaigner'])->middleware('campaigner');
Route::put('/profile/campaigner', [ProfileController::class, 'processDataCampaigner'])->middleware('campaigner');

Route::get('/change', [ProfileController::class, 'getViewChangePassword'])->middleware('user');
Route::put('/change', [ProfileController::class, 'changePassword'])->middleware('user');

//? =========================
//! Route Auth
//? =========================
Route::get('/login', [AuthController::class, 'getViewLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'postDataLogin'])->name('postLogin')->middleware('guest');

Route::get('/register', [AuthController::class, 'getViewRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'postDataRegister'])->name('postRegister')->middleware('guest');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot', [AuthController::class, 'getViewForgotPassword'])->middleware('guest');
Route::post('/forgot', [AuthController::class, 'postDataForgotPassword'])->name('forgot')->middleware('guest');

Route::get('/reset/{email}/{token}', [AuthController::class, 'getViewResetPassword'])->middleware('guest');
Route::post('/reset', [AuthController::class, 'postResetPassword'])->name('reset')->middleware('guest');

//? =========================
//! Route Event Umum
//? =========================
Route::get('/category', [EventController::class, 'getAllCategoriesEvent']);
Route::post('/event/create/verification', [EventController::class, 'verifyProfileCreateEvent'])->middleware('campaigner');

//? =========================
//! Route Petition
//? =========================
//* --- pemanggilan ajax ---
Route::get('/petition/type', [PetitionController::class, 'getListPetitionByStatus']);
Route::get('/petition/search', [PetitionController::class, 'searchPetition']);
Route::get('/petition/sort', [PetitionController::class, 'sortPetition']);

Route::get('/petition', [PetitionController::class, 'getActivePetition']);
Route::get('/petition/create', [PetitionController::class, 'getViewCreatePetition'])->middleware('campaigner');
Route::post('/petition/create', [PetitionController::class, 'saveDataEventPetition'])->middleware('campaigner');
Route::get('/petition/{id}', [PetitionController::class, 'getDetailPetition']);

Route::get('/petition/{id}', [PetitionController::class, 'getDetailPetition']);

Route::get('/petition/edit/{id}', [PetitionController::class, 'getViewEditPetition'])->middleware('campaigner');
Route::put('/petition/{id}', [PetitionController::class, 'updatePetition'])->middleware('campaigner');

Route::get('/petition/comments/{id}', [PetitionController::class, 'getCommentsCertainPetition']);

Route::get('/petition/progress/{id}', [PetitionController::class, 'getProgressCertainPetition']);
Route::post('/petition/progress/{id}', [PetitionController::class, 'saveProgressPetition'])->middleware('campaigner');

Route::post('/petition/{id}', [PetitionController::class, 'signedThePetition'])->middleware('user');

//? =========================
//! Route Donation
//? =========================
//* --- pemanggilan ajax ---
Route::get('/donation/search', [DonationController::class, 'searchDonation']);
Route::get('/donation/sort', [DonationController::class, 'sortDonation']);

//* --- buat donasi ---
Route::get('/donation/create', [DonationController::class, 'getViewCreateDonation'])->middleware('campaigner');
Route::post('/donation/create', [DonationController::class, 'saveEventDonation'])->middleware('campaigner');

//* --- menampilkan donasi ---
Route::get('/donation', [DonationController::class, 'getListActiveDonation']);
Route::get('/donation/{id}', [DonationController::class, 'getADonation']);

//* --- Edit event donasi ---
Route::get('/donation/edit/{id}', [DonationController::class, 'getViewEditDonation'])->middleware('campaigner');
Route::put('/donation/{id}', [DonationController::class, 'updateEventDonation'])->middleware('campaigner');

//* --- partisipasi dalam donasi ---
Route::get('/donation/donate/{id}', [DonationController::class, 'getDonateForm'])->middleware('user');
Route::post('/donation/donate/{id}', [DonationController::class, 'postDonate'])->middleware('user');

Route::patch('/donation/donate/{id}', [DonationController::class, 'updateDonate'])->middleware('user');
Route::get('/donation/donate/edit/{id}', [DonationController::class, 'getViewEditDonate'])->middleware('user');

//* --- konfirmasi pembayaran donasi ---
Route::get('/donation/confirm_donate/{id}', [DonationController::class, 'formPaymentConfirm'])->middleware('user');
Route::patch('/donation/confirm_donate/{id}', [DonationController::class, 'postPaymentConfirm'])->middleware('user');

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
Route::get('/forumerror', [ForumController::class, 'error'])->middleware('user');
Route::get('/inputforum', [ForumController::class, 'inputforum'])->middleware('user');
Route::post('/input', [ForumController::class, 'input'])->middleware('user');

//? =========================
//! Route Admin
//? =========================
Route::get('/admin', [ControllingController::class, 'home'])->name('admin')->middleware('admin');

//! Users
Route::get('/admin/user', [ControllingController::class, 'getAllUsers'])->middleware('admin');

//* -------- ajax -----------
Route::get('/admin/user/role', [ControllingController::class, 'getUsersByRole'])->middleware('admin');
Route::get('/admin/user/sort', [ControllingController::class, 'sortListUser'])->middleware('admin');
Route::get('/admin/user/search', [ControllingController::class, 'searchUser'])->middleware('admin');
Route::get('/admin/user/diikuti/{id}', [ControllingController::class, 'getEventParticipate'])->middleware('admin');
Route::get('/admin/user/dibuat/{id}', [ControllingController::class, 'getEventMade'])->middleware('admin');
Route::get('/admin/user/countEvent', [ControllingController::class, 'countEventParticipate'])->middleware('admin');

Route::get('/admin/user/{id}', [ControllingController::class, 'getUserInfo'])->middleware('admin');
Route::patch('/admin/user/terimaPengajuan/{id}', [ControllingController::class, 'acceptUserToCampaigner'])->middleware('admin');
Route::patch('/admin/user/tolakPengajuan/{id}', [ControllingController::class, 'rejectUserToCampaigner'])->middleware('admin');

//! Petition
Route::get('/admin/petition', [ControllingController::class, 'getAllPetition'])->middleware('admin');
Route::patch('/admin/petition/accept/{id}', [ControllingController::class, 'acceptPetition'])->middleware('admin');
Route::patch('/admin/petition/reject/{id}', [ControllingController::class, 'rejectPetition'])->middleware('admin');
Route::patch('/admin/petition/close/{id}', [ControllingController::class, 'closePetition'])->middleware('admin');
Route::patch('/admin/petition/proceed/{id}', [ControllingController::class, 'proceedPetition'])->middleware('admin');

//! Donation dan Transaction
Route::get('/admin/donation', [ControllingController::class, 'getListDonation'])->middleware('admin');
Route::get('/admin/donation/transaction', [ControllingController::class, 'getAllTransaction'])->middleware('admin');
Route::get('/admin/donation/transaction/{idEvent}', [ControllingController::class, 'getATransaction'])->middleware('admin');

Route::patch('/admin/donation/transaction/confirm/{idTransaction}', [ControllingController::class, 'confirmTransaction'])->middleware('admin');
Route::patch('/admin/donation/transaction/reject/{idTransaction}', [ControllingController::class, 'rejectTransaction'])->middleware('admin');

Route::patch('/admin/donation/accept/{id}', [ControllingController::class, 'acceptDonation'])->middleware('admin');
Route::patch('/admin/donation/reject/{id}', [ControllingController::class, 'rejectDonation'])->middleware('admin');
Route::patch('/admin/donation/close/{id}', [ControllingController::class, 'closeDonation'])->middleware('admin');
Route::patch('/admin/donation/proceed/{id}', [ControllingController::class, 'proceedDonation'])->middleware('admin');

//* -------- ajax -----------
Route::get('/admin/donation/sort', [ControllingController::class, 'adminSortDonation'])->middleware('admin');
Route::get('/admin/donation/search', [ControllingController::class, 'adminSearchDonation'])->middleware('admin');
Route::get('/admin/donation/type', [ControllingController::class, 'donationType'])->middleware('admin');

Route::get('/admin/transaction/type', [ControllingController::class, 'transactionType'])->middleware('admin');
Route::get('/admin/transaction/search', [ControllingController::class, 'searchTransaction'])->middleware('admin');
