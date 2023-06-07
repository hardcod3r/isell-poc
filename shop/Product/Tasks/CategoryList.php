<?php


namespace Shop\Product\Tasks;

use Shop\Product\Models\ProductCategory;
use Illuminate\Database\Eloquent\Collection;

/**
 * @return ProductCategory
 * @throws Exception
 */
class CategoryList
{
    public function __construct(
        protected ProductCategory $category
    ) {
    }
    public function run(): Collection|string
    {
        try {
            return $this->category->all();
        } catch (\Exception $exception) {
            return  $exception->getMessage();
        }
    }
}
