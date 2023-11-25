<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Book;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_id' => Book::inRandomOrder()->first()->id ?? Book::factory()->create()->id,
            'message' => $this->faker->paragraph,
            'review_note' => $this->faker->randomElement(['0', '1', '2', '3', '4', '5'])
        ];
    }
}
