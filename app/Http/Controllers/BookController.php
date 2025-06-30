<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Show all books with author name
    // public function index()
    // {
    //     $books = Book::with('author')->get();

    //     return response()->json($books->map(function ($book) {
    //         return [
    //             'id' => $book->id,
    //             'title' => $book->title,
    //             'author' => $book->author ? $book->author->name : null
    //         ];
    //     }));
    // }

    // Create a new book
    public function create(CreateBookRequest $request)
    {
        $book = Book::create($request->validated()); // Use validated data only

        return response()->json([
            'message' => 'Book created successfully',
            'data' => $book
        ], 201);
    }

    // Show book by id with author info
     public function index()
    {
        return response()->json([
            'message' => 'Get all authors',
            'data' => Book::all(),
        ], 200);
    }

  public function show($id)
    {
        $book = Book::with('author')->find($id);
        return response()->json([
            'id' => $book->id,
            'title' => $book->title,
            'isbn' => $book->isbn,
            'publication_year' => $book->publication_year,
            'genre' => $book->genre,
            'available_copies' => $book->available_copies,
            'author' => $book->author,
        ]);
    }


    // Update book by id
    public function update(CreateBookRequest $request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->update($request->validated());

        return response()->json([
            'message' => 'Book updated successfully',
            'data' => $book
        ], 200);
    }

    // Delete book by id
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found, cannot delete'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted successfully'], 200);
    }
}
