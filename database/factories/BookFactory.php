<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'author' => fake()->name(),
            'genre' => fake()->word(),
            'isbn' => fake()->unique()->isbn13(),
            'year' => fake()->date(),
            'description' => fake()->sentence(10),
            'quantity' => fake()->numberBetween(1, 10),
        ];
    }
}
