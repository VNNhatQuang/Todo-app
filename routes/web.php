<?php

use App\Http\Controllers\AllController;
use App\Http\Controllers\ImportantController;
use App\Http\Controllers\CompleteController;
use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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


Route::get('/', function () {
    return view('index');
});

Route::prefix('all')->group(function() {
    Route::get('/', [AllController::class, 'index'])->name('note.all');
    Route::get('/create', [AllController::class, 'create'])->name('note.all.create');
});


Route::get('important', [ImportantController::class, 'index'])->name('note.important');

Route::get('complete', [CompleteController::class, 'index'])->name('note.complete');

