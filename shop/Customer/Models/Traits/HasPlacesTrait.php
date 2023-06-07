<?php

namespace Shop\Customer\Models\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Shop\Customer\Models\Place;

trait HasPlacesTrait
{
    /**
     * Get the customer's places.
     */
    public function places(): HasMany
    {
        return $this->hasMany(Place::class);
    }
}
