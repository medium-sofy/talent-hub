<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Candidate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CandidateFactory extends Factory
{
    protected $model = Candidate::class;

    public function definition(): array
    {
        $user = User::factory()->create();
        $fullName = $user->f_name . ' ' . $user->l_name;

        return [
            'user_id' => $user->id,
            'slug' => Str::slug($fullName),
            'resume_url' => $this->faker->optional()->url(),
            'linkedin_profile' => $this->faker->optional()->url(),
            'phone_number' => $this->faker->optional()->phoneNumber(),
        ];
    }
}
