<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [AuthenticatedSessionController::class, 'create']);


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/add-book', [BookController::class, 'addBook'])->name('add-book');
    Route::post('/add-book', [BookController::class, 'newBook'])->name('new-book');
    Route::get('/edit/{id}', [BookController::class, 'editBook'])->name('edit-book');
    Route::put('/edit/{id}', [BookController::class, 'updateBook'])->name('update-book');
    Route::delete('/delete/{id}', [BookController::class, 'deleteBook'])->name('delete-book');
    Route::post('/create-booking/{id}', [BookController::class, 'createBooking'])->name('create-booking');
    Route::delete('/delete-booking/{id}', [BookController::class, 'deleteBooking'])->name('delete-booking');
    Route::get('/search/{search?}', [BookController::class, 'searchBook'])->name('search-books');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
