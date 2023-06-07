<?php

namespace Shop\Data\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Shop\Common\Models\Contact;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop\Common\Models\Contact>
 */
class ContactFactory extends Factory
{
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $options = ['Home phone', 'Office phone', 'Mobile phone'];

        return [
            'name' =>  $options[rand(0, 2)],
            'phone_type' => 0,
            'phone' => fake()->e164PhoneNumber(),
        ];
    }
}
