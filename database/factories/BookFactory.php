<?php

namespace Database\Factories;

use App\Models\Genre;
use App\Models\Author;
use App\Models\Book;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
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
            'author_id' => Author::inRandomOrder()->first()->id ?? Author::factory()->create()->id,
            'genre_id' => Genre::inRandomOrder()->first()->id ?? Genre::factory()->create()->id,
            'title' => $this->faker->city,
            'description' => $this->faker->paragraph,
            'isbn' => $this->faker->isbn10(),
            'language' => $this->faker->randomElement(['English', 'French', 'Other']),
            'published_year' => $this->faker->year,
            'is_bookan_original' => false,
            'image' => $this->faker->image('public/storage/books_images',640,480, null, false)
        ];
    }
}
