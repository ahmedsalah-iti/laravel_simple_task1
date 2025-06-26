<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();
        $category = Category::create($validated);
        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, int $id)
    {
        $category = Category::findOrFail($id);
        $validated = $request->validated();
        $category->update($validated);
        return response()->json($category, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json($category, 204);
    }
    public function getBooks(int $id)
    {
        $category = Category::findOrFail($id);
        $books = $category->books();
        return response()->json($books, 200);
    }
    public function addBooks(Request $request,$id){
        $booksIds = is_array($request->book_id) ? $request->book_id : [$request->book_id];
        $request->validate([
            'book_id'=>'required',
            'book_id.*' =>'integer|exists:books,id'
        ]);
        
        $category = Category::findOrFail($id);
        $category->books()->attach($booksIds);
        return response()->json(['msg'=>'books attached successfuly']);
    }
}
