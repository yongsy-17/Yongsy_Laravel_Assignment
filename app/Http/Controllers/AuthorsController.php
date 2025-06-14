<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Prompts\Key;
use PharIo\Manifest\Author;

class AuthorsController extends Controller
{
    public $Authors = [
    [
        "id" => "1",
        "name" => "John Doe",
        "bio" => "Author and software engineer.",
        "nationality" => "American"
    ],
    [
        "id" => "2",
        "name" => "Jane Smith",
        "bio" => "Novelist and historian.",
        "nationality" => "British"
    ],
    [
        "id" => "3",
        "name" => "Michael Johnson",
        "bio" => "Technical writer and editor.",
        "nationality" => "Canadian"
    ],
    [
        "id" => "4",
        "name" => "Emily Davis",
        "bio" => "Researcher and academic author.",
        "nationality" => "Australian"
    ],
];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            "message"=>"Get data successfully",
            "data"=>$this->Authors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string',
            'name' => 'required|string',
            'bio' => 'required|string',
            'nationality' => 'required|string',
        ]);

        $newAuthor = [
            'id' => $validated['id'],
            'name' => $validated['name'],
            'bio' => $validated['bio'],
            'nationality' => $validated['nationality'],
        ];

        return response()->json([
            'message' => 'Created successfully',
            'data' => $newAuthor
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        foreach($this->Authors as $Author){
            if ($Author["id"]==$id){
                return $Author;
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate input (no need for 'id' because you get it from the URL)
        $data = $request->validate([
            'name' => 'required|string',
            'bio' => 'required|string',
            'nationality' => 'required|string',
        ]);

        // Find and update
        foreach ($this->Authors as $key => $Author) {
            if ($Author["id"] == $id) {
                // Correct assignment
                $this->Authors[$key] = array_merge($Author, $data);

                return response()->json([
                    "message" => "Author {$id} updated successfully",
                    "data" => $this->Authors[$key]
                ]);
            }
        }

        return response()->json(['message' => "Author with ID {$id} not found."], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        foreach ($this->Authors as $key => $Author) {
            if ($Author['id'] == $id) {
                unset($this->Authors[$key]);
                $this->Authors = array_values($this->Authors); // reindex
                return response()->json([
                    'message' => "Author with ID {$id} deleted successfully!",
                    'data' => $this->Authors
                ]);
            }
        }

        return response()->json(['message' => "Author with ID {$id} not found."], 404);
    }
}

