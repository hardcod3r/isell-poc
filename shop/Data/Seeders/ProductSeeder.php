<?php

namespace Shop\Data\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Shop\Product\Models\Product;
use Shop\Product\Models\ProductCategory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Lets fetch some real dummy data:)
        $fetched_categories = Http::get('https://dummyjson.com/products/categories')->json();
        // get only first 3
        $categories = array_slice($fetched_categories, 0, 5);
        foreach ($categories as $category) {
            // grab some products by category
            $fetched_products = Http::get('https://dummyjson.com/products/category/' . $category)->json();
            // get only first 3 products from this category
            $products = array_slice($fetched_products['products'], 0, 5);
            $products = Arr::map($products, function ($item) {
                return Arr::only(
                    $item,
                    [
                        'title',
                        'description',
                        'price',
                    ]
                );
            });
            // check if model exists
            $pc = ProductCategory::where('title', $category)->first();
            if (!$pc) {
                // build your category model
                $pc = ProductCategory::factory()->state(['title' => $category])->create();
            }

            foreach ($products as $product) {
                // check if model exists
                $p = Product::where('name', $category)->first();
                if (!$p) {
                    //Build persistent products
                    Product::factory()->state([
                        'product_categories_id' => $pc->id,
                        'name' => $product['title'],
                        'description' => $product['description'],
                    ])->hasPrices(1, ['price' => $product['price']])->create();
                }
            }
        }
    }
}
