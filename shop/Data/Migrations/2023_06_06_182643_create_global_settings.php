<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Isell');
        $this->migrator->add('general.site_active', true);
        $this->migrator->add('general.stripe_active', true);
        $this->migrator->add('general.paypal_active', true);
    }
};
