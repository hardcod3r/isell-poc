<?php

namespace Shop\Product\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shop\Data\Factories\ProductCategoryFactory;
use Shop\Product\Models\Traits\HasManyProductsTrait;

class ProductCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasManyProductsTrait;

    protected static function newFactory(): Factory
    {
        return ProductCategoryFactory::new();
    }

    protected $fillable = [
        'title',
        'description',
        'in_order',
        'available',
    ];
}
