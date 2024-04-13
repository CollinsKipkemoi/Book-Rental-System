<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\brs_controller;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [brs_controller::class, 'index']);
Route::get('/create', [brs_controller::class, 'create']);
Route::get('/login', [brs_controller::class, 'login']);
Route::post('/create', [brs_controller::class, 'store']);
Route::get('/books/genre/{genre}', [brs_controller::class, 'listBooksByGenre'])->name('books.genre');
Route::get('/books/search', [brs_controller::class, 'search'])->name('books.search');
Route::get('/books/{id}', [brs_controller::class, 'show'])->name('books.show');

Route::post('/borrow', [brs_controller::class, 'borrowBook'])->name('borrow');
Route::get('/rentals', [brs_controller::class, 'showRentals'])->name('rentals');
// rental details
Route::get('/rentals/{id}', [brs_controller::class, 'showRentalDetails'])->name('rental.details');
Route::get('/addBook', [brs_controller::class, 'addBook']) ->name('addBook');
Route::post('/addBook', [brs_controller::class, 'store_book']) ->name('storeBook');
