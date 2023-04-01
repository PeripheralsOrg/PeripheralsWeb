<?php

namespace Database\Factories;

use App\Models\AdmUsers;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdmUsers>
 */
class AdmUsersFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdmUsers::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '123456', // password
            'poder' => 9,
            'status' => 1,
            'remember_token' => Str::random(10),
            'remember_token' => Str::random(10),

        ];
    }
}
