<?php

namespace Shop\Product\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Shop\Data\Factories\ProductPriceFactory;
use Shop\Product\Models\Traits\ProductTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProductPrice extends Model
{
    use HasFactory;
    use ProductTrait;

    protected $appends = [
        'formatted_price'
    ];
    protected static function newFactory(): Factory
    {
        return ProductPriceFactory::new();
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => price_in_cents($value),
            get: fn (int $value) => price_in_float($value),
        );
    }

    protected function getFormattedPriceAttribute()
    {
        return env('CASHIER_CURRENCY_SIGN') . $this->price;
    }
}
