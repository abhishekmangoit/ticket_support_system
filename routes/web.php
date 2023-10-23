<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'isactive'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('ticket', TicketController::class);
    Route::get('/ticket/{id}/log', [TicketController::class, 'log'])->name('ticket.log');
    Route::get('/ticket/{id}/close', [TicketController::class, 'close'])->name('ticket.close');
    Route::resource('comment', CommentController::class);
});

require __DIR__.'/auth.php';

Route::middleware(['checkrole','auth'])->group(function () {
    Route::resource('category', CategoryController::class);
    // Route::get('ticket.edit', [TicketController::class, 'edit'])->name('ticket.edit');
    Route::resource('user', UserController::class);
});




