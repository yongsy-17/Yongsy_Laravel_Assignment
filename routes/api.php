<?php

use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Route book
Route::prefix("/books")->group(function() {
Route::get("/",[BookController::class,"index"]);
Route::get("/{id}",[BookController::class,"show"]);
Route::post("/", [BookController::class, "create"]);
Route::put("/{id}", [BookController::class, "update"]);
Route::delete("/{id}", [BookController::class, "destroy"]);
});
Route::prefix("/authors")->group(function(){
    Route::get("/",[AuthorsController::class,"index"]);
    Route::get("/{id}",[AuthorsController::class,"show"]);
    Route::post("/", [AuthorsController::class,"create"]);
    Route::put("/{id}", [AuthorsController::class, "update"]);
    Route::delete("/{id}",[AuthorsController::class,"destroy"]);
});

Route::prefix("/users")->group(function(){
    Route::get("/",[UserController::class,"index"]);
    Route::get("/{id}",[UserController::class,"show"]);
    Route::post("/",[UserController::class,"create"]);
    Route::put("/{id}", [UserController::class, 'update']);
    Route::delete("/{id}",[UserController::class,"destroy"]);
});





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
