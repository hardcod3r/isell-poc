<?php

namespace Shop\Product\Models\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Shop\Product\Models\ProductPrice;

trait PriceTrait
{
    /**
     * Get all prices that belongs to product.
     */
    public function prices(): HasMany
    {
        return $this->hasMany(ProductPrice::class, 'product_id', 'id');
    }

    public function active_price()
    {
        //get latest active price . We avoid archived models. We can not use latest() in Collection
        return $this->prices->where('is_current', 1)->where('is_archived', 0)->sortByDesc('created_at')->first();
    }
}
