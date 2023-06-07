<?php

namespace Shop\Data\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Shop\Product\Models\Product;
use Shop\Product\Models\ProductPrice;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop\Product\Models\ProductPrice>
 */
class ProductPriceFactory extends Factory
{
    protected $model = ProductPrice::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'is_taxable' => 1,
            'is_current' => 1,
        ];
    }
}
