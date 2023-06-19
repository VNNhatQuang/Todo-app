<?php

use App\Http\Controllers\AllController;
use App\Http\Controllers\ImportantController;
use App\Http\Controllers\CompleteController;
use App\Http\Controllers\UserController;
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


Route::redirect('/', '/login', 301);

Route::prefix('all')->group(function () {
    Route::get('/', [AllController::class, 'index'])->name('note.all');
    Route::get('/create', [AllController::class, 'create'])->name('note.all.create');
    Route::get('/edit/{id}', [AllController::class, 'edit'])->name('note.all.edit');
    Route::get('/delete/{id}', [AllController::class, 'delete'])->name('note.all.delete');
    Route::get('/markComplete', [AllController::class, 'markComplete'])->name('note.all.complete');
    Route::get('/markImportant/{id}', [AllController::class, 'markImportant'])->name('note.all.important');
    Route::get('/unMarkImportant/{id}', [AllController::class, 'unMarkImportant'])->name('note.all.unMarkImportant');
});


Route::prefix('important')->group(function () {
    Route::get('/', [ImportantController::class, 'index'])->name('note.important');
    Route::get('/create', [ImportantController::class, 'create'])->name('note.important.create');
    Route::get('/edit/{id}', [ImportantController::class, 'edit'])->name('note.important.edit');
    Route::get('/delete/{id}', [ImportantController::class, 'delete'])->name('note.important.delete');
    Route::get('/markComplete', [ImportantController::class, 'markComplete'])->name('note.important.complete');
    Route::get('/unMarkImportant/{id}', [ImportantController::class, 'unMarkImportant'])->name('note.important.unMarkImportant');
});


Route::prefix('complete')->group(function () {
    Route::get('/', [CompleteController::class, 'index'])->name('note.complete');
    Route::get('/delete/{id}', [CompleteController::class, 'delete'])->name('note.complete.delete');
});



Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


Route::get('/account', [UserController::class, 'showUser'])->name('user');
