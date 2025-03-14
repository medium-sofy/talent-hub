<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Joblisting>
 */
class JoblistingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employer_id' => Employer::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'requirements' => $this->faker->paragraph,
            'benefits' => $this->faker->paragraph,
            'location' => $this->faker->city,
            'category_id' => Category::factory(),
            'workplace' => $this->faker->randomElement(['remote', 'onsite', 'hybrid']),
            'job_type' => $this->faker->randomElement(['Full-time', 'Part-time', 'freelance']),
            'upper_salary' => $this->faker->numberBetween(12000, 25000),
            'lower_salary' => $this->faker->numberBetween(5000, 10000),
            'application_deadline' => $this->faker->dateTimeBetween('now', '+1 month'),
            'is_approved' => $this->faker->boolean,
        ];
    }
}
