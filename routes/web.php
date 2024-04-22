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
Route::get('/addBook', [brs_controller::class, 'addBook'])->name('addBook');
Route::post('/addBook', [brs_controller::class, 'store_book'])->name('storeBook');
Route::get('/profile', [brs_controller::class, 'profile'])->name('profile');
Route::post('/login', [brs_controller::class, 'signin'])->name('login');
Route::get('/logout', [brs_controller::class, 'logout'])->name('logout');
Route::post('/borrow', [brs_Controller::class, 'borrow'])->name('borrow');
Route::get('/book/{bookId}', [brs_controller::class, 'show'])->name('book_details');
Route::get('/book/{bookId}/edit', [brs_controller::class, 'edit'])->name('book_edit');
Route::post('/book/{bookId}/edit', [brs_controller::class, 'update'])->name('book_update');
Route::delete('/book/{bookId}', [brs_controller::class, 'destroy'])->name('book_destroy');
Route::get('/genres', [brs_controller::class, 'genres'])->name('genres_index');
Route::post('/genres', [brs_controller::class, 'storeGenre'])->name('genres_store');
Route::get('/genres/create', [brs_controller::class, 'createGenre'])->name('genres_create');
Route::delete('/genres/{genreId}',[brs_controller::class, 'destr
oyGenre'])->name('genre_destroy');
Route::get('/genres/{genreId}/edit', [brs_controller::class, 'editGenre'])->name('genre_edit');
Route::post('/genres/{genreId}/edit', [brs_controller::class, 'updateGenre'])->name('genres_update');