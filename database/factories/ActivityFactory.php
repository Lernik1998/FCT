<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(10),
            'description' => fake()->paragraph(10),
            'image' => fake()->imageUrl(800, 600),
            'price' => fake()->randomFloat(2, 10, 100),
            'duration' => fake()->time('H:i:s'),
            'status' => fake()->randomElement(['active', 'inactive']),
            'date' => fake()->date(),
            'user_id' => 2,
            'category_id' => 1,
        ];
    }
}
