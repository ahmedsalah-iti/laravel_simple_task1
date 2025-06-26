<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return response()->json($books,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookStoreRequest $request)
    {
        $validated = $request->validated();
        $book = Book::create($validated);
        return response()->json($book,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $book = Book::findOrFail($id);
        return response()->json($book,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request, int $id)
    {
        $book = Book::findOrFail($id);
        $validated = $request->validated();
        $book->update($validated);
        return response()->json($book,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json($book,204);
    }
    public function getCategories(int $id){
        $book = Book::findOrFail($id);
        $categories = $book->categories();
        return response()->json($categories, 200);
    }
    public function getBookDetails(int $id){
        $book = Book::findOrFail($id);
        $book_details = $book->detail();
        return response()->json($book_details,200);
    }
}
