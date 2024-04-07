<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // faker is a library that generates fake data
        return [
            "name" => $this->faker->name(),
            "email" => $this->faker->unique()->safeEmail(),
            "email_verified_at" => $this->faker->dateTime(),
            "password" => $this->faker->password(),
            "is_librarian" => $this->faker->boolean(),
            "remember_token" => $this->faker->text(),
            "created_at" => $this->faker->dateTime(),
            "updated_at" => $this->faker->dateTime(),

        ];
    }
}
