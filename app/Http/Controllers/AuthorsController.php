<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Get all authors',
            'data' => Author::all(),
        ], 200);
    }

    /**
     * Store a newly created author.
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'nationality' => 'nullable|string|max:255',
        ]);

        $author = Author::create($validated);

        return response()->json([
            'message' => 'Author created successfully',
            'data' => $author
        ], 201);
    }

    /**
     * Display the specified author.
     */
   

    public function show($id)
    {
        $author = Author::with('books')->find($id);
        return response()->json([
            'id' => $author->id,
            'name' => $author->name,
            'bio' => $author->bio,
            'nationality' => $author->nationality,
            'books' => $author->books,
        ]);
    }






    /**
     * Update the specified author.
     */
    public function update(Request $request, string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        $author->update($request->all());

        return response()->json([
            'message' => 'Author updated successfully',
            'data' => $author
        ], 200);
    }

    /**
     * Remove the specified author.
     */
    public function delete(string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'message' => 'Author not found, cannot delete'
            ], 404);
        }

        $author->delete();

        return response()->json([
            'message' => 'Author deleted successfully',
            'data' => $author
        ], 200);
    }

    /**
     * Show all books created by the specified author ID.
     */
    
}
