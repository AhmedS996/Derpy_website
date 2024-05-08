<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => fake()->uuid,
            'admin_id' => fake()->uuid,
            'name' => fake()->sentence(3),
            'event_avatar' => fake()->imageUrl(),
            'description' => fake()->paragraph,
            'category' => fake()->word,
            'date' => fake()->date(),
            'time_start' => fake()->time(),
            'time_end' => fake()->time(),
            'location' => fake()->address,
            'members' => json_encode([fake()->name, fake()->name, fake()->name]),
            'number_of_members' => fake()->numberBetween(1, 100),
            'price' => fake()->randomFloat(2, 0, 1000),
            'cancel_event' => fake()->boolean,
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'updated_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
