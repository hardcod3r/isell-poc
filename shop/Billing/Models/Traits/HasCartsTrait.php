<?php

namespace Shop\Billing\Models\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Shop\Cart\Models\Cart;
use Shop\Product\Models\Product;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

trait HasCartsTrait
{
    /**
     * Get related carts by signature
     */
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'signature', 'cart_signature');
    }

    public function products(): HasManyThrough
    {
        return $this->hasManyThrough(
            Product::class,
            Cart::class,
            'product_id',
            'id',
            'cart_signature',
            'signature'
        );
    }
}
