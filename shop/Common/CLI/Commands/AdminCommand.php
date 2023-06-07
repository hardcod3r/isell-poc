<?php

namespace Shop\Common\CLI\Commands;

use Illuminate\Console\Command;
use Shop\Customer\Controllers\CustomerController;
use Carbon\Carbon;

class AdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run shop admin menu';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //Simple implementation of cli auth flow // Always password is password ;)
        $password = $this->secret('Please type your password :)');
        while ($password !== 'password') {
            $this->error('Password is wrong .Try again!');
            $password = $this->secret('Please type your password :)');
        }
        $object = $this->choice(
            'Choose the entity (number) you want to manage',
            ['Customer', 'Product', 'Order', 'Cart'],
        );
        $action = $this->choice(
            'Choose an action',
            ['List', 'View', 'Edit', 'Delete', 'Back to entities'],
        );
        switch ($object) {
            case 'Customer':
                switch ($action) {
                    case 'List':
                        $this->table(
                            ['ID', 'Name', 'Last Name', 'Created'],
                            app(CustomerController::class)->index()
                        );
                        break;
                    case 'View':
                        $id = $this->ask('Give a customer id to show');
                        $customer = app(CustomerController::class)->show($id);
                        $this->line($customer->full_name);
                        $this->line($customer->user->email);
                        $this->line('Created : ' . $customer->created_at->diffForHumans());
                        break;
                    case 'Edit':
                        $id = $this->ask('Give a customer id to edit');
                        $data = [];
                        $data['first_name'] = $this->ask('Set a new first name', fake()->firstName());
                        $data['last_name'] = $this->ask('Set a new last name', fake()->lastName());
                        $customer = app(CustomerController::class)->show($id);
                        app(CustomerController::class)->update($customer, $data);
                        $this->info('Customer with id ' . $customer->id . ' updated successfully');
                        break;
                    case 'Delete':
                        $id = $this->ask('Give a customer id to delete');
                        $customer = app(CustomerController::class)->show($id);
                        app(CustomerController::class)->destroy($customer);
                        $this->info('Customer with id ' . $id . ' deleted successfully');
                        break;
                }
                break;
            case 'Product':
                break;
            case 'Order':
                break;
            case 'Cart':
                break;
        }
        $action = $this->choice(
            'Choose an action',
            ['List', 'View', 'Edit', 'Delete', 'Back to entities'],
        );
    }
}
