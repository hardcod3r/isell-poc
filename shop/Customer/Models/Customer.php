<?php

namespace Shop\Customer\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shop\Customer\Models\Traits\HasContactsTrait;
use Shop\Customer\Models\Traits\HasPlacesTrait;
use Shop\Customer\Models\Traits\UserTrait;
use Shop\Data\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    use UserTrait;
    use HasContactsTrait;
    use HasPlacesTrait;
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'first_name',
        'last_name',
    ];
    protected $appends = ['full_name'];
    /**
     * The attributes that should be cast.
     */
    protected $casts = [];

    protected static function newFactory(): Factory
    {
        return CustomerFactory::new();
    }

    protected function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
