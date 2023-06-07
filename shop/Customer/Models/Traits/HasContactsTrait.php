<?php

namespace Shop\Customer\Models\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Shop\Common\Models\Contact;

trait HasContactsTrait
{
    /**
     * Get the customer's contacts.
     */
    public function contacts(): MorphMany
    {
        return $this->morphMany(Contact::class, 'contactable');
    }
}
