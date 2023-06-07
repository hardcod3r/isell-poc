<?php

namespace Shop\Product\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shop\Data\Factories\ProductFactory;
use Shop\Product\Models\Traits\CategoryTrait;
use Shop\Product\Models\Traits\PriceTrait;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use CategoryTrait;
    use PriceTrait;

    protected static function newFactory(): Factory
    {
        return ProductFactory::new();
    }

    protected $fillable = [
        'product_categories_id',
        'name',
        'description',
        'in_order',
        'available',
    ];

}
