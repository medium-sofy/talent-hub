<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'commentable_id' => $this->faker->numberBetween(1, 100), // Adjust range as needed
            'commentable_type' => $this->faker->randomElement(['JobListing']),
            'content' => $this->faker->paragraph,
        ];

    }
}
