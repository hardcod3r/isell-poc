<?php

namespace Shop\Billing\Stripe;

use Shop\Billing\Contracts\BillingInterface;
use Shop\Customer\Models\Customer;
use Shop\Settings\ShopSettings;

/**
 * Stripe payment gateway
 */
class Stripe implements BillingInterface
{
    public function isEnabled(): bool
    {
        return app(ShopSettings::class)->stripe_active;
    }

    public function create(): string
    {
        //mock things up
        return 'Stripe';
    }
}
