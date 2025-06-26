<?php

use App\Models\Author;
use App\Models\Book;
use App\Models\BookDetail;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('authors',Author::class);
Route::get('authors/{id}/books',[Author::class,'getBooks']);

Route::apiResource('books',Book::class);
Route::get('books/{id}/details',[Book::class,'getBookDetails']);
Route::get('books/{id}/categories',[Book::class,'getCategories']);

Route::apiResource('categories',Category::class);
Route::get('categories/{id}/books',[Category::class,'getBooks']);
Route::post('categories/{id}/books',[Category::class,'addBooks']);

Route::post('book-details',[BookDetail::class,'store']);
Route::put('book-details/{id}',[BookDetail::class,'update']);
Route::delete('book-detail/{id}',[BookDetail::class,'destroy']);