<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookDetailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookDetail;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);
Route::post('logout',[UserController::class,'logout'])->middleware('auth:sanctum');

Route::apiResource('authors',AuthorController::class)->middleware('auth:sanctum');
Route::get('authors/{id}/books',[Author::class,'getBooks']);

Route::apiResource('books',BookController::class);
Route::get('books/{id}/details',[BookController::class,'getBookDetails']);
Route::get('books/{id}/categories',[BookController::class,'getCategories']);

Route::apiResource('categories',CategoryController::class);
Route::get('categories/{id}/books',[CategoryController::class,'getBooks']);
Route::post('categories/{id}/books',[CategoryController::class,'addBooks']);

Route::post('book-details',[BookDetailController::class,'store']);
Route::put('book-details/{id}',[BookDetailController::class,'update']);
Route::delete('book-detail/{id}',[BookDetailController::class,'destroy']);
