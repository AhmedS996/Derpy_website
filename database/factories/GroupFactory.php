<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'group_id' => fake()->uuid,
            'admin_id' => fake()->uuid,
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph,
            'group_image' => fake()->imageUrl(),
            'category' => fake()->word,
            'location' => fake()->address,
            'access_modifier' => fake()->boolean,
            'members' => json_encode([fake()->name, fake()->name, fake()->name]),
            'events' => json_encode([fake()->sentence, fake()->sentence]),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'updated_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
