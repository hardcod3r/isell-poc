<?php

namespace Shop\Billing\Paypal;

use Shop\Billing\Contracts\BillingInterface;
use Shop\Customer\Models\Customer;
use Shop\Settings\ShopSettings;

/**
 * Paypal payment gateway
 */
class Paypal implements BillingInterface
{
    public function isEnabled(): bool
    {
        return app(ShopSettings::class)->paypal_active;
    }

    public function create(): string
    {
        return 'Paypal';
    }
}
