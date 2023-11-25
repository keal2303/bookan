<?php

namespace Database\Factories;

use App\Models\Genre;
use App\Models\Author;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends Factory<Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'genre_id' => Genre::inRandomOrder()->first()->id ?? Genre::factory()->create()->id,
            'name' => $this->faker->name,
            'bio' => $this->faker->paragraph,
            'birth_year' => $this->faker->year,
            'death_year' => $this->faker->year,
            'is_alive' => $this->faker->randomElement([true, false]),
            'language' => $this->faker->randomElement(['English', 'French', 'Other']),
            'link' => $this->faker->url,
            'media' => $this->faker->url
        ];
    }
}
