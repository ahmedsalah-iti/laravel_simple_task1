<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();
        return response()->json($authors,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {
        $validated = $request->validated();
        $author = Author::create($validated);
        return response()->json($author,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $author = Author::findOrFail($id);
        return response()->json($author,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, int $id)
    {
        $author = Author::findOrFail($id);
        $validated = $request->validated();
        $author->update($validated);
        return response()->json($author,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $author = Author::findOrFail($id);
        $author->delete();
        return response()->json(null,204);
    }
    public function getBooks(int $id){
        $author = Author::findOrFail($id);
        $books = $author->books();
        return response()->json($books,200);
    }
}
