<?php

namespace Shop\Settings;

use Spatie\LaravelSettings\Settings;

class ShopSettings extends Settings
{

    public string $site_name;
    public bool $site_active;
    public bool $stripe_active;
    public bool $paypal_active;
    public static function group(): string
    {
        return 'global';
    }
}
