<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GigController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [GigController::class, 'index'])->name('home');
Route::get('/gig/{id}', [GigController::class, 'show'])->name('gig.show');
Route::post('/gig/search', [GigController::class, 'search'])->name('gig.search');

Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');

    Route::get('/register', [AuthController::class, 'viewRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');
});


Route::middleware('auth')->group(function() {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('gig/create', [GigController::class, 'create'])->name('gig.create');
    Route::post('gig/store', [GigController::class, 'store'])->name('gig.store');



});

