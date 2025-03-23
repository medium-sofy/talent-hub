<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\JobListing;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Analytic>
 */
class AnalyticFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_listing_id' => JobListing::factory(),
            'views_count' => $this->faker->numberBetween(0, 1000),
            'applications_count' => $this->faker->numberBetween(0, 100),
        ];
    }
}
