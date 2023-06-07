<?php

namespace Shop\Data\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Shop\Customer\Models\Customer;
use Shop\User\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop\Product\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function (Customer $customer) {
            //update attributes as user
            $user = User::where('id', $customer->user_id)->first();
            $customer->first_name = $user->first_name;
            $customer->last_name = $user->last_name;
        });
    }
}
