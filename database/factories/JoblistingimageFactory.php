<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Joblisting;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Joblistingimage>
 */
class JoblistingimageFactory extends Factory
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
            'path' => $this->faker->imageUrl(),
        ];
    }
}
