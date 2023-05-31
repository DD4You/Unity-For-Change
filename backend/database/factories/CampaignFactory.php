<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::factory()->create();

        return [
            'category_id' => $category->id,
            'name' => fake()->company(),
            'goal' => fake()->numberBetween(100, 10000),
            'description' => fake()->text(100)
        ];
    }
}
