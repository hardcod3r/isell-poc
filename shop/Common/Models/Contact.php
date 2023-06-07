<?php

namespace Shop\Common\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Shop\Data\Factories\ContactFactory;

class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'phone_type',
        'phone',
    ];

    public function contactable(): MorphTo
    {
        return $this->morphTo();
    }

    protected static function newFactory(): Factory
    {
        return ContactFactory::new();
    }
}
