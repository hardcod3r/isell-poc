<?php


namespace Shop\Product\Tasks;

use Shop\Product\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetProductById
{
    /**
     * @param $id
     * @return Product
     * @throws ModelNotFoundException
     */
    public function __construct(
        protected Product $product
    ) {
    }
    public function run($id): Product|string
    {
        try {
            return $this->product->where('id', $id)->first();
        } catch (ModelNotFoundException) {
            throw new ModelNotFoundException('Product not found with ID ' . $id);
        }
    }
}
