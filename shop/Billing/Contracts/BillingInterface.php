<?php

namespace Shop\Billing\Contracts;

use Shop\Product\Models\Product;
use Shop\Customer\Models\Customer;

//We are gonna to use multiple payment gateways
//so interfacing them
interface BillingInterface
{
    public function isEnabled(): bool;

    public function create(): string;
}
