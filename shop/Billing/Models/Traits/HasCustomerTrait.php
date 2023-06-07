<?php

namespace Shop\Billing\Models\Traits;


use Shop\Customer\Models\Customer;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasCustomerTrait
{
    /**
     * Get related customer
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
