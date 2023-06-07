<?php

namespace Shop\Cart\Models\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Shop\Product\Models\Product;

trait ProductTrait
{
    /**
     * Get the category that owns the product.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
