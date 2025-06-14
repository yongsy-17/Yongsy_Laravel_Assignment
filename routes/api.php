<?php

use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BookController;
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
Route::prefix("/book")->group(function() {
Route::get("/books",[BookController::class,"index"]);
Route::get("/books/{id}",[BookController::class,"show"]);
Route::post("/books", [BookController::class, "create"]);
Route::put("/books/{id}", [BookController::class, "update"]);
Route::delete("/books/{id}", [BookController::class, "destroy"]);
});
Route::prefix("/author")->group(function(){
    Route::get("/authors",[AuthorsController::class,"index"]);
    Route::get("/authors/{id}",[AuthorsController::class,"show"]);
    Route::post('/authors', [AuthorsController::class,"create"]);
    Route::put('/authors/{id}', [AuthorsController::class, "update"]);
    Route::delete("/authors/{id}",[AuthorsController::class,"destroy"]);
});





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
