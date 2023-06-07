<?php

namespace Shop\User\Models\Traits;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Shop\Customer\Models\Customer;

trait HasCustomerTrait
{
    /**
     * Get the customer associated with the user.
     */
    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }
}
