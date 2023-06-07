<?php

namespace Shop\Data\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Shop\Product\Models\ProductCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop\Product\Models\ProductCategory>
 */
class ProductCategoryFactory extends Factory
{
    protected $model = ProductCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            //'title' => fake()->sentence(), //just to get start before we get more acurrate data
            'description' => fake()->paragraph(),
            'available' => 1,
        ];
    }
}
