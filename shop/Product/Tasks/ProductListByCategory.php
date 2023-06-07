<?php


namespace Shop\Product\Tasks;

use Shop\Product\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductListByCategory
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
    public function run($id): Collection|string
    {
        try {
            //Other way to get category's products e.x $category->products->all()
            //I choose this for performance reasons
            return $this->product->where('product_categories_id', $id)->get();
        } catch (\Exception $exception) {
            throw new ModelNotFoundException('Products not found by category ID ' . $id);
        }
    }
}
