<?php

namespace Shop\Cart\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Shop\Cart\Models\Traits\ProductTrait;

class Cart extends Model
{
    use HasFactory;
    use SoftDeletes;
    use ProductTrait;

    protected $fillable = [
        'product_price_id',
        'product_id',
        'signature',
        'quantity',
        'total'
    ];

    protected $appends = [
        'formatted_total'
    ];

    protected function quantity(): Attribute
    {
        return Attribute::make(
            set: fn (int $value) => abs($value) //always positive num
        );
    }

    public function scopeFullCart($query, $signature)
    {
        return $query->whereSignature($signature);
    }

    protected function total(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => price_in_cents($value),
            get: fn (int $value) => price_in_float($value),
        );
    }

    protected function getFormattedTotalAttribute()
    {
        return env('CASHIER_CURRENCY_SIGN') . $this->total;
    }
}
