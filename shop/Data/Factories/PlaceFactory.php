<?php

namespace Shop\Data\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Shop\Customer\Models\Customer;
use Shop\Customer\Models\Place;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop\Customer\Models\Place>
 */
class PlaceFactory extends Factory
{
    protected $model = Place::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $options = ['Home', 'Office', 'Work'];

        return [
            'customer_id' => Customer::factory(),
            'name' => $options[rand(0, 2)],
            'address' => fake()->address(),
        ];
    }
}
