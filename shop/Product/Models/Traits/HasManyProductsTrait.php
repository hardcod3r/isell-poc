<?php

namespace Shop\Product\Models\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Shop\Product\Models\Product;

trait HasManyProductsTrait
{
    /**
     * Get all products that belongs to categort.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'product_categories_id', 'id');
    }
}
