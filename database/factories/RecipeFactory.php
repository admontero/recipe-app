<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->word(),
            'excerpt' => fake()->text(500),
            'description' => fake()->realText(),
            'ingredients' => fake()->realText(),
            'preparation' => fake()->realText(),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'image' => 'recipes/' . FakerPicsumImagesProvider::image('public/storage/recipes', 400, 300, false),
            'published_at' => fake()->dateTimeThisMonth(),
        ];
    }

    public function existing(): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => rand(1, 2),
            'category_id' => rand(1, 6),
        ]);
    }
}
