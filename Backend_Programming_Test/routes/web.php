<?php

use App\Http\Controllers\BookController;

Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/top-authors', [BookController::class, 'topAuthors'])->name('authors.top');
Route::get('/add-rating', [BookController::class, 'addRating'])->name('ratings.create');
Route::post('/add-rating', [BookController::class, 'storeRating'])->name('ratings.store');


