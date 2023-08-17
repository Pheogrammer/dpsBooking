<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ViewerController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[ViewerController::class, 'index'])->name('index');
Route::get('viewDetails/{id}',[ViewerController::class, 'viewDetails'])->name('viewDetails');
Route::get('bookVenue/{id}',[ViewerController::class, 'bookVenue'])->name('bookVenue');
Route::post('bookVenuePost',[ViewerController::class, 'bookVenuePost'])->name('bookVenuePost');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('users', [HomeController::class, 'users'])->name('users');

Route::get('rooms', [HomeController::class, 'rooms'])->name('rooms');
Route::get('roomsRegistration', [HomeController::class, 'roomsRegistration'])->name('roomsRegistration');
Route::post('roomsRegistrationPost', [HomeController::class, 'roomsRegistrationPost'])->name('roomsRegistrationPost');
Route::get('viewRoom/{id}', [HomeController::class, 'viewRoom'])->name('viewRoom');

Route::post('roomsEditPost', [HomeController::class, 'roomsEditPost'])->name('roomsEditPost');
Route::get('roomsDelete/{id}', [HomeController::class, 'roomsDelete'])->name('roomsDelete');
