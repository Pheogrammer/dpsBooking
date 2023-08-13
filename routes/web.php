<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('users', [HomeController::class, 'users'])->name('users');

Route::get('rooms', [HomeController::class, 'rooms'])->name('rooms');
Route::get('roomsRegistration', [HomeController::class, 'roomsRegistration'])->name('roomsRegistration');
Route::post('roomsRegistrationPost', [HomeController::class, 'roomsRegistrationPost'])->name('roomsRegistrationPost');

Route::get('roomsEdit/{id}', [HomeController::class, 'roomsEdit'])->name('roomsEdit');
Route::post('roomsEditPost', [HomeController::class, 'roomsEditPost'])->name('roomsEditPost');
Route::get('roomsDelete/{id}', [HomeController::class, 'roomsDelete'])->name('roomsDelete');
