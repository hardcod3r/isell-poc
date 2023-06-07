<?php

namespace Shop\Common\CLI\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run app installation';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call('db:wipe');
        $this->info('Wipe is done');
        Artisan::call('migrate');
        $this->info('Migrate is done');
        Artisan::call('db:seed', ['class' => 'Shop\Data\Seeders\ShopSeeder']);
        $this->info('Seeding done!');
        Artisan::call('key:generate');
        $this->info('Installation done!');
    }
}
