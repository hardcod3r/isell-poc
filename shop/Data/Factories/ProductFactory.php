<?php

namespace Shop\Data\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Shop\Product\Models\Product;
use Shop\Product\Models\ProductCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop\Product\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'product_categories_id' => ProductCategory::factory(),
        ];
    }

/*     public function configure(): static
    {
        return $this->afterMaking(function (Product $product) {
            //lets grab some data from dummy json
            $category = ProductCategory::where('id', $product->product_categories_id)->first();
            $fetched_products = Http::get('https://dummyjson.com/products/category/' . $category->title)->json();
            //loop in collection
            foreach ($fetched_products['products'] as $fp) {
                //check whether this product name exists;
                $exists = Product::where('name', $fp['title'])->first();
                if (!$exists) {
                    //if not set model name and break this loop
                    $product->name = $fp['title'];
                    $product->description = $fp['description'];
                    break;
                }
            }
        });
    } */
}
