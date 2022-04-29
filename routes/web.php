<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\OldsubController;
use GuzzleHttp\Middleware;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/book/new', function () {
//     return view('employee/new_book');
// });

//-------------------------------------------------EMPLOYEE---------------------------------------------------------------------

Route::group(['middleware' => ['empPages']], function(){

    Route::view('/newbook','employee/new_book');
    Route::post('/newbook',[BookController::class,'addBook']);
    Route::get('/books',[BookController::class,'showBooks']);
    Route::get('/edit-book/{id}',[BookController::class,'edit']);
    Route::put('/update-book/{id}',[BookController::class,'update']);
    Route::get('/emp-search-books-results',[BookController::class,'searchBooksByEmp']);

    Route::get('/users',[UserController::class,'showUsers']);
    Route::get('/member/{id}',[UserController::class,'index']);
    Route::put('/update-member-data/{id}',[UserController::class,'updateAsEmp']);

    Route::get('/activate/{id}',[UserController::class,'activateSub']);

    Route::get('/reservations',[ReservationController::class,'showAllReservations']);

    Route::get('/rent/{id}',[RentalController::class,'rentBook']);
    Route::get('rent-from-res/{id}',[RentalController::class,'rentFromReservations']);

    Route::get('/active-rentals',[RentalController::class,'showActiveRentals']);
    Route::get('/closed-rentals',[RentalController::class,'showClosedRentals']);

    Route::get('book-is-back/{id}',[RentalController::class,'bookIsBack']);

    Route::view('/new-user','employee/new_user');
    Route::get('/add-user', [UserController::class,'addUser']);
});

//--------------------------------------------------MEMBER----------------------------------------------------------------------

Route::group(['middleware' => ['memPages']], function(){

    Route::get('/books-available',[BookController::class,'showAvailableBooks']);
    Route::get('/book/{id}',[ReservationController::class,'showBook']);
    Route::get('/mem-search-books-results',[BookController::class,'searchBooksByMem']);

    Route::get('/reserveBook/{id}',[ReservationController::class,'reserve']);
    Route::get('/myreservations',[ReservationController::class,'showMyReservations']);
    Route::get('/deleteReservation/{id}',[ReservationController::class,'delete']);
    Route::get('/myrentals',[RentalController::class,'showMyRentals']);

    Route::get('/subscriptions',[OldsubController::class,'showMySubs']);

    Route::get('/suggestions',[SuggestionController::class,'makeSuggestions']);

    Route::get('/badges',[BadgeController::class,'numbersForBadges']);
});

//---------------------------------------------COMMON----------------------------------------------------------------------------

Route::group(['middleware' => ['comPages']], function(){

    Route::get('/profile', function () {
        return view('/common/profile');
    });

    Route::post('/update-data',[UserController::class,'update']);
});

//--------------------------------------------------NOT FINISHED------------------------------------------------------








