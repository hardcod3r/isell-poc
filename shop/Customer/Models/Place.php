<?php

namespace Shop\Customer\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Shop\Data\Factories\PlaceFactory;

class Place extends Model
{
    use HasFactory;

    protected $spatialFields = [
        'location',

    ];

    protected static function newFactory(): Factory
    {
        return PlaceFactory::new();
    }
}
