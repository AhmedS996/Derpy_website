<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\App>
 */
class AppFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_name' => fake()->unique()->userName,
            'name' => fake()->name(),
            'phone_number' => fake()->phoneNumber,
            'profile_image' => fake()->imageUrl(),
            'events' => json_encode([fake()->word, fake()->word, fake()->word]),
            'groups' => json_encode([fake()->word, fake()->word]),
            'dob' => fake()->date(),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'updated_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
