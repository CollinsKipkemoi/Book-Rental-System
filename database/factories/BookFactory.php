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
            'title' => $this->faker->sentence(3),
            'authors' => $this->faker->name(),
            'description' => $this->faker->paragraph(),
            'released_at' => $this->faker->date(),
            'cover_image' => $this->faker->imageUrl(),
            'pages' => $this->faker->numberBetween(100, 1000),
            'language_code' => $this->faker->languageCode(),
            'isbn' => $this->faker->isbn13(),
            'in_stock' => $this->faker-> numberBetween(0,100),
        ];
    }
}
