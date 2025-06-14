<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use GuzzleHttp\Promise\Create;

class BookController extends Controller
{
    public $Books=
        [
  [
    "id"=> "1",
    "authorId"=>"12",
    "title"=>"Learning Laravel 10",
    "isbn"=>"978-0-12345-678-9",
    "publicationYear"=>2024,
    "genre"=>"Technology",
    "availableCopies"=>7
  ],
  [
    "id"=>"2",
    "authorId"=>"15",
    "title"=>"Mastering PHP 8",
    "isbn"=>"978-1-98765-432-0",
    "publicationYear"=>2023,
    "genre"=>"Programming",
    "availableCopies"=>3
  ],
  [
    "id"=>"3",
    "authorId"=>"18",
    "title"=>"The Art of APIs",
    "isbn"=>"978-3-45678-901-2",
    "publicationYear"=>2022,
    "genre"=>"Software Development",
    "availableCopies"=>5
  ]
];

    /**
     * Display a listing of the resource.
     */
      public function index(){
        return response()->json([
            'message' => 'Data successfully',
            'data' => $this->Books,
        ]);
    }

    /**
     * GET /api/books/{id}: Retrieve a single book by its ID. 
     */
   public function show($id)
    {
        foreach ($this->Books as $book) {
            if ($book['id'] == $id) {
                return $book;
            }
        }
    }
    

    /**
     *  POST /api/books: Add a new book.
     */
     public function create(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'title' => 'required|string',
            'authorId' => 'required|string',
            'isbn' => 'nullable|string',
            'publicationYear' => 'nullable|integer',
            'genre' => 'nullable|string',
            'availableCopies' => 'nullable|integer',
        ]);

        // book data
        $newBook = [
            "id" => rand(100, 999),
            "title" => $validated['title'],
            "authorId" => $validated['authorId'],
            "isbn" => $validated['isbn'],
            "publicationYear" => $validated['publicationYear'] ,
            "genre" => $validated['genre'] ,
            "availableCopies" => $validated['availableCopies'] ,
        ];

        return response()->json([
            'message' => 'created successfully!',
            'data' => $newBook
        ], 201);
    }
    /**
     * Update the specified resource in storage.
     * PUT /api/books/{id}: Update an existing book by its ID.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'authorId' => 'required|string',
            'isbn' => 'nullable|string',
            'publicationYear' => 'nullable|integer',
            'genre' => 'nullable|string',
            'availableCopies' => 'nullable|integer',
        ]);

        foreach ($this->Books as $key => $book) {
            if ($book['id'] == $id) {
                $this->Books[$key] = array_merge($book, $data);
                return response()->json([
                    'message' => "Book with ID {$id} updated successfully!",
                    'data' => $this->Books[$key]
                ]);
            }
        }

        return response()->json(['message' => "Book with ID {$id} not found."], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
    {
        foreach ($this->Books as $key => $book) {
            if ($book['id'] == $id) {
                unset($this->Books[$key]);
                $this->Books = array_values($this->Books); // reindex
                return response()->json([
                    'message' => "Book with ID {$id} deleted successfully!",
                    'data' => $this->Books
                ]);
            }
        }

        return response()->json(['message' => "Book with ID {$id} not found."], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

}