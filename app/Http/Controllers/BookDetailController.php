<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookDetailRequest;
use App\Http\Requests\UpdateBookDetailRequest;
use App\Models\BookDetail;
use Illuminate\Http\Request;

class BookDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $details = BookDetail::all();
        return response()->json($details,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookDetailRequest $request)
    {
        $validated = $request->validated();
        $detail = BookDetail::create($validated);
        return response()->json($detail,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $detail = BookDetail::findOrFail($id);
        return response()->json($detail,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookDetailRequest $request, int $id)
    {
        $detail = BookDetail::findOrFail($id);
        $validated = $request->validated();
        $detail->update($validated);
        return response()->json($detail,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $detail = BookDetail::findOrFail($id);
        $detail->delete();
        return response()->json($detail,204);
    }
}
