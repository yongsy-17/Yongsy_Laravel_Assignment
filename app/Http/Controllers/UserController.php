<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public $Users =[
         [
        "id" => "1",
        "name" => "Sok Dara",
        "email" => "sok.dara@gmail.com",
        "membershipDate" => "2023-01-10"
    ],
    [
        "id" => "2",
        "name" => "Chan Sophea",
        "email" => "chan.sophea@gmail.com",
        "membershipDate" => "2022-05-25"
    ],
    [
        "id" => "3",
        "name" => "Kim Leng",
        "email" => "kim.leng@gmail.com",
        "membershipDate" => "2024-03-18"
    ],
    [
        "id" => "4",
        "name" => "Ly Ratanak",
        "email" => "ly.ratanak@gmail.com",
        "membershipDate" => "2021-09-02"
    ]
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            "message"=>"Get data successfully",
            "data"=>$this->Users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //  Validate user input
        $validated = $request->validate([
            'id' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string',
            'membershipDate' => 'required|date',
        ]);

        // Create new user array (fake, not saved to DB)
        $newUser = [
            'id' => $validated['id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'membershipDate' => $validated['membershipDate'],
        ];

        // Return JSON response
        return response()->json([
            'message' => 'User created successfully',
            'data' => $newUser
        ], 201);
    }

    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        foreach($this->Users as $User){
            if ($User["id"]==$id){
                return $User;
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
        // Validate input (no need for 'id' — we get it from URL)
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'membershipDate' => 'required|date',
        ]);

        // Find and update the user
        foreach ($this->Users as $key => $user) {
            if ($user["id"] == $id) {
                $this->Users[$key] = array_merge($user, $data);

                return response()->json([
                    "message" => "User {$id} updated successfully",
                    "data" => $this->Users[$key]
                ]);
            }
        }

        return response()->json(['message' => "User with ID {$id} not found."], 404);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        foreach ($this->Users as $key => $user) {
            if ($user['id'] == $id) {
                unset($this->Users[$key]);
                $this->Users = array_values($this->Users); // reindex array

                return response()->json([
                    'message' => "User with ID {$id} deleted successfully!",
                    'data' => $this->Users
                ]);
            }
        }

        return response()->json(['message' => "User with ID {$id} not found."], 404);
    }

}
