<?php

namespace Shop\Customer\Models\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Shop\User\Models\User;

trait UserTrait
{
    /**
     * Get the user associated with the customer.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
