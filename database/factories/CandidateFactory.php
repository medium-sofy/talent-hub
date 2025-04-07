<?php

namespace Database\Factories;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\candidate>
 */
class CandidateFactory extends Factory
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
            'resume_url' => $this->faker->url,
            'linkedin_profile' => $this->faker->url,
            'phone_number' => $this->faker->phoneNumber,
=======
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
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
        ];
    }
}
