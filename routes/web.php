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

    Route::resource('books', BookController::class)->except(['show']);
    Route::prefix('books')->group(function () {
        Route::get('/print-pdf', [BookController::class, 'printPDF'])->name('books.print-pdf');
        Route::get('/export-excel', [BookController::class, 'exportExcel'])->name('books.export-excel');
        Route::get('/import', [BookController::class, 'importForm'])->name('books.import-form');
        Route::post('/import', [BookController::class, 'importExcel'])->name('books.import-excel');
    });

    Route::resource('bookshelves', BookshelfController::class)->except(['show']);
    Route::prefix('bookshelves')->group(function () {
        Route::get('/print-pdf', [BookshelfController::class, 'printPDF'])->name('bookshelves.print-pdf');
        Route::get('/export-excel', [BookshelfController::class, 'exportExcel'])->name('bookshelves.export-excel');
        Route::get('/import', [BookshelfController::class, 'importForm'])->name('bookshelves.import-form');
        Route::post('/import', [BookshelfController::class, 'importExcel'])->name('bookshelves.import-excel');
    });

    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::prefix('categories')->group(function () {
        Route::get('/print-pdf', [CategoryController::class, 'printPDF'])->name('categories.print-pdf');
        Route::get('/export-excel', [CategoryController::class, 'exportExcel'])->name('categories.export-excel');
        Route::get('/import', [CategoryController::class, 'importForm'])->name('categories.import-form');
        Route::post('/import', [CategoryController::class, 'importExcel'])->name('categories.import-excel');
    });

    Route::resource('users', UserController::class)->except(['show']);
    Route::prefix('users')->group(function () {
        Route::get('/print-pdf', [UserController::class, 'printPDF'])->name('users.print-pdf');
        Route::get('/export-excel', [UserController::class, 'exportExcel'])->name('users.export-excel');
        Route::get('/import', [UserController::class, 'importForm'])->name('users.import-form');
        Route::post('/import', [UserController::class, 'importExcel'])->name('users.import-excel');
    });

    Route::prefix('loans')->group(function () {
        Route::get('/print-pdf', [LoanController::class, 'printPDF'])->name('loans.print-pdf');
        Route::get('/export-excel', [LoanController::class, 'exportExcel'])->name('loans.export-excel');
    });
    Route::resource('loans', LoanController::class);
    Route::post('/loans/{loanDetail}/return', [LoanController::class, 'returnBook'])->name('loans.return');

    Route::resource('loan_details', LoanDetailController::class);

    Route::resource('book_returns', BookReturnController::class)->except(['show']);
    Route::prefix('book_returns')->group(function () {
        Route::get('/print-pdf', [BookReturnController::class, 'printPDF'])->name('book_returns.print-pdf');
        Route::get('/export-excel', [BookReturnController::class, 'exportExcel'])->name('book_returns.export-excel');
    });



});

require __DIR__ . '/auth.php';
