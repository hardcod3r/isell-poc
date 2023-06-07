<?php

namespace Shop\Product\Models\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Shop\Product\Models\ProductCategory;

trait CategoryTrait
{
    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
