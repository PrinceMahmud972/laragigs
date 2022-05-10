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

Route::get('/gig/create', [GigController::class, 'create'])->name('gig.create');
Route::post('/gig', [GigController::class, 'store'])->name('gig.store');
Route::get('/gig/{id}', [GigController::class, 'show'])->name('gig.show');
Route::get('/gig/{id}/edit', [GigController::class, 'edit'])->name('gig.edit');
Route::put('/gig/{id}', [GigController::class, 'update'])->name('gig.update');
Route::post('/gig/search', [GigController::class, 'search'])->name('gig.search');
Route::delete('/gig/{id}', [GigController::class, 'destroy'])->name('gig.delete');

Route::get('/tag/{id}', [GigController::class, 'FindByTag'])->name('gig.tag');

Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');

    Route::get('/register', [AuthController::class, 'viewRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');
});


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/manage', [GigController::class, 'adminHome'])->name('adminHome');


