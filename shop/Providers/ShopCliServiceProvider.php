<?php

namespace Shop\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use PhpSchool\CliMenu\Builder\CliMenuBuilder;
use Illuminate\Database\Eloquent\Model;
use Shop\Billing\Contracts\BillingInterface;
use Shop\Billing\Paypal\Paypal;
use Shop\Billing\Stripe\Stripe;
use Shop\Customer\Models\Customer;
use Shop\Cart\FlowStore;
use Shop\Billing\Models\Order;
use Shop\Billing\Observers\OrderObserver;


class ShopCliServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    protected $availableServices = ['Paypal', 'Stripe'];
    public function register(): void
    {
        //zero configuration cli - builder binding . Nothing special here!
        $this->app->bind(ExternalApiHelper::class, function () {
            return new FlowStore();
        });
        $this->app->bind(CliMenuBuilder::class, function (Application $app) {
            return new CliMenuBuilder();
        });
        //binding billing interface with implementation dynamically
        if (app()->runningInConsole()) {
            $selected = app(FlowStore::class)->get('payment_method');
            $service = ($selected === 'Stripe') ? Stripe::class : Paypal::class;
            $this->app->bind(BillingInterface::class, $service);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //we need to take all shop migrations for specific folder
        $path = shop_path('Data/Migrations');
        $directories = glob($path . '/*', GLOB_ONLYDIR);
        $paths = array_merge([$path], $directories);
        $this->loadMigrationsFrom($paths);
        Model::preventLazyLoading(app()->isProduction()); //Disable lazy loading
        Order::observe(OrderObserver::class);
    }
}
