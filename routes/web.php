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
Route::get('/profile', [ProfileController::class, 'getViewDetailAnUser']);
Route::put('/profile', [ProfileController::class, 'updateAnUserData']);

Route::get('/delete', [ProfileController::class, 'deleteAnUserAccount']);

Route::get('/profile/campaigner', [ProfileController::class, 'detailDataCampaigner']);
Route::put('/profile/campaigner', [ProfileController::class, 'processDataCampaigner']);

Route::get('/change', [ProfileController::class, 'getViewChangePassword']);
Route::put('/change', [ProfileController::class, 'changePassword']);

//? =========================
//! Route Auth
//? =========================
Route::get('/login', [AuthController::class, 'getViewLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'postDataLogin'])->name('postLogin');

Route::get('/register', [AuthController::class, 'getViewRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'postDataRegister'])->name('postRegister');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot', [AuthController::class, 'getViewForgotPassword']);
Route::post('/forgot', [AuthController::class, 'postDataForgotPassword'])->name('forgot');

Route::get('/reset/{email}/{token}', [AuthController::class, 'getViewResetPassword']);
Route::post('/reset', [AuthController::class, 'postResetPassword'])->name('reset');

//? =========================
//! Route Event Umum
//? =========================
Route::get('/category', [EventController::class, 'getAllCategoriesEvent']);
Route::post('/event/create/verification', [EventController::class, 'verifyProfileCreateEvent']);

//? =========================
//! Route Petition
//? =========================
//* --- pemanggilan ajax ---
Route::get('/petition/type', [PetitionController::class, 'getListPetitionByStatus']);
Route::get('/petition/search', [PetitionController::class, 'searchPetition']);
Route::get('/petition/sort', [PetitionController::class, 'sortPetition']);

Route::get('/petition', [PetitionController::class, 'getActivePetition']);
Route::get('/petition/create', [PetitionController::class, 'getViewCreatePetition']);
Route::post('/petition/create', [PetitionController::class, 'saveDataEventPetition']);
Route::get('/petition/{id}', [PetitionController::class, 'getDetailPetition']);

Route::get('/petition/edit/{id}', [PetitionController::class, 'getViewEditPetition']);
Route::put('/petition/{id}', [PetitionController::class, 'updatePetition']);

Route::get('/petition/comments/{id}', [PetitionController::class, 'getCommentsCertainPetition']);

Route::get('/petition/progress/{id}', [PetitionController::class, 'getProgressCertainPetition']);
Route::post('/petition/progress/{id}', [PetitionController::class, 'saveProgressPetition']);

Route::post('/petition/{id}', [PetitionController::class, 'signedThePetition']);

//? =========================
//! Route Donation
//? =========================
//* --- pemanggilan ajax ---
Route::get('/donation/search', [DonationController::class, 'searchDonation']);
Route::get('/donation/sort', [DonationController::class, 'sortDonation']);

//* --- buat donasi ---
Route::get('/donation/create', [DonationController::class, 'getViewCreateDonation']);
Route::post('/donation/create', [DonationController::class, 'saveEventDonation']);

//* --- menampilkan donasi ---
Route::get('/donation', [DonationController::class, 'getAllDonation']);
Route::get('/donation/{id}', [DonationController::class, 'getADonation']);
Route::get('/donation/edit/{id}', [DonationController::class, 'getViewEditDonation']);
Route::put('/donation/{id}', [DonationController::class, 'updateEventDonation']);

//* --- partisipasi dalam donasi ---
Route::get('/donation/donate/{id}', [DonationController::class, 'getDonateForm'])->middleware();
Route::post('/donation/donate/{id}', [DonationController::class, 'postDonate']);

Route::patch('/donation/donate/{id}', [DonationController::class, 'updateDonate']);
Route::get('/donation/donate/edit/{id}', [DonationController::class, 'getViewEditDonate']);

//* --- konfirmasi pembayaran donasi ---
Route::get('/donation/confirm_donate/{id}', [DonationController::class, 'formPaymentConfirm']);
Route::patch('/donation/confirm_donate/{id}', [DonationController::class, 'postPaymentConfirm']);

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

//* -------- ajax -----------
Route::get('/admin/listUser/role', [ControllingController::class, 'getUsersByRole'])->middleware('admin');
Route::get('/admin/listUser/sort', [ControllingController::class, 'sortListUser'])->middleware('admin');
Route::get('/admin/listUser/search', [ControllingController::class, 'searchUser'])->middleware('admin');
Route::get('/admin/user/diikuti/{id}', [ControllingController::class, 'getEventParticipate'])->middleware('admin');
Route::get('/admin/user/dibuat/{id}', [ControllingController::class, 'getEventMade'])->middleware('admin');
Route::get('/admin/listUser/countEvent', [ControllingController::class, 'countEventParticipate'])->middleware('admin');

Route::get('/admin/user/{id}', [ControllingController::class, 'getUserInfo'])->middleware('admin');
Route::patch('/admin/user/terimaPengajuan/{id}', [ControllingController::class, 'acceptUserToCampaigner'])->middleware('admin');
Route::patch('/admin/user/tolakPengajuan/{id}', [ControllingController::class, 'rejectUserToCampaigner'])->middleware('admin');

//! Petition
Route::get('/admin/petition', [ControllingController::class, 'getAllPetition'])->middleware('admin');
Route::patch('/admin/petition/accept/{id}', [ControllingController::class, 'acceptPetition'])->middleware('admin');
Route::patch('/admin/petition/reject/{id}', [ControllingController::class, 'rejectPetition'])->middleware('admin');
Route::patch('/admin/petition/close/{id}', [ControllingController::class, 'closePetition'])->middleware('admin');

//! Donation dan Transaction
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
