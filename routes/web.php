<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookReturnController;
use App\Http\Controllers\BookshelfController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanDetailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('books', BookController::class);
    Route::resource('bookshelves', BookshelfController::class);
    Route::resource('categories', CategoryController::class);

    Route::resource('users', UserController::class);
    Route::resource('loans', LoanController::class);
    Route::resource('loan_details', LoanDetailController::class);
    Route::resource('book_returns', BookReturnController::class);
    Route::post('/loans/{loanDetail}/return', [LoanController::class, 'returnBook'])->name('loans.return');
});

require __DIR__ . '/auth.php';
