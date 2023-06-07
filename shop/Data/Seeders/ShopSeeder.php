<?php

namespace Shop\Data\Seeders;

use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            ProductSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,

        ]);
    }
}
