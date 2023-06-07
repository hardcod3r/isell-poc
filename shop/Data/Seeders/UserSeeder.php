<?php

namespace Shop\Data\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Shop\Customer\Models\Customer;
use Shop\Customer\Models\Place;
use Shop\User\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Seed the users & customers data.
     */
    public function run(): void
    {
        //create customers
        $customers = Customer::factory()->count(10)
            ->has(User::factory())
            ->hasContacts(1) //add one contact
            ->create();
        //assign customer role to each one
        foreach ($customers as $customer) {
            $customer->user->assignRole('customer');
            // add a place for him
            Place::factory()->state([
                'customer_id' => $customer->id,
            ])->create();
        }
        //create manager
        $manager = User::firstOrCreate(
            ['email' => 'manager@example.com'],
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'password' => bcrypt('password')
            ],

        );
        //assign manager role
        $manager->assignRole('manager');

        //create admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'first_name' => 'Kon',
                'last_name' => 'Kak',
                'password' => bcrypt('password')
            ],
        );
        //assign admin role
        $admin->assignRole('admin');
    }
}
