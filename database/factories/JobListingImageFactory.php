<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\JobListing;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobListingImage>
 */
class JobListingImageFactory extends Factory
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
