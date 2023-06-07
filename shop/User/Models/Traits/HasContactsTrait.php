<?php

namespace Shop\User\Models\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Shop\Common\Models\Contact;

trait HasContactsTrait
{
    /**
     * Get the user's contacts.
     */
    public function contacts(): MorphMany
    {
        return $this->morphMany(Contact::class, 'contactable');
    }
}
