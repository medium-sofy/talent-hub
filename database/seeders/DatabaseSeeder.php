<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Analytic;
use App\Models\Application;
use App\Models\Candidate;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Employer;
use App\Models\JobListing;
use App\Models\JobListingImage;
use App\Models\Notification;
use App\Models\Skill;
use App\Models\Technology;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::factory(10)->create()->each(function ($user) {
            // Employers & Candidates (Randomly assign some users)
            if (rand(0, 1)) {
                Employer::factory(1)->create(['user_id' => $user->id]);
            } else {
                Candidate::factory(1)->create(['user_id' => $user->id]);
            }
        });

        Category::factory(5)->create();

        Technology::factory(10)->create();

        Skill::factory(15)->create();

        JobListing::factory(20)->create()->each(function ($jobListing) {
            // Job Listing Skills (Pivot)
            $skills = Skill::inRandomOrder()->take(rand(2, 5))->pluck('id');
            $jobListing->skills()->attach($skills);

            // Job Listing Technologies (Pivot)
            $technologies = Technology::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $jobListing->technologies()->attach($technologies);

            JobListingImage::factory(rand(1, 3))->create(['job_listing_id' => $jobListing->id]);

            Analytic::factory()->create(['job_listing_id' => $jobListing->id]);
        });

        Application::factory(30)->create();

        Comment::factory(50)->create();

        Notification::factory(20)->create();
    }
}
