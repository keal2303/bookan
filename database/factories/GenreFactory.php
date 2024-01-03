<?php

namespace Database\Factories;

use App\Models\Genre;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Genre>
 */
class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        static $genres = ['fiction', 'non-fiction', 'poetry', 'fantasy', 'thriller'];

        return [
            'name' => array_shift($genres), // Get the first element and remove it from the array
            'description' => $this->faker->paragraph,
            'image' => $this->faker->image('public/storage/genres_images', 640, 480, null, false)
        ];
    }
}
