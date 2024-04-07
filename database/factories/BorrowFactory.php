<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrow>
 */
class BorrowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reader_id' => \App\Models\User::factory(),
            'book_id' => \App\Models\Book::factory(),
            'status' => $this->faker->randomElement(['PENDING', 'ACCEPTED', 'REJECTED', 'RETURNED']),
            'request_processed_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'request_managed_by' => \App\Models\User::factory(),
            'deadline' => $this->faker->dateTimeBetween('now', '+1 month'),
            'returned_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'return_managed_by' => \App\Models\User::factory(),
        ];
    }
}
