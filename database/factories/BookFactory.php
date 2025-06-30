<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => fake()->sentence(3), 
            "author_id" => fake()->numberBetween(1, 5), 
            "isbn" => fake()->isbn13(), 
            "publication_year" => fake()->year(), 
            "genre" => fake()->word(), 
            "available_copies" => fake()->numberBetween(0, 5),
        ];
    }
}
