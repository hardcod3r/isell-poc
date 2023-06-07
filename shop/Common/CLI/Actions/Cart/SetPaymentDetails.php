<?php

namespace Shop\Common\CLI\Actions\Cart;

use PhpSchool\CliMenu\Builder\CliMenuBuilder;
use Shop\Common\CLI\Actions\Cart\ChoosePaymentProfile;
use PhpSchool\CliMenu\CliMenu;
use Shop\Customer\Tasks\NewCustomer;
use Illuminate\Support\Str;
use Shop\Cart\FlowStore;

/**
 * ChoosePaymentGateway radio switcher to select payment method
 */
class SetPaymentDetails
{

    public function run(CliMenuBuilder $builder)
    {
        $itemCallable = function (CliMenu $menu) {
            $result = $menu->askText()
                ->setPromptText('Enter your full name')
                ->setPlaceholderText('')
                ->setValidationFailedText('Please enter your full name')
                ->ask();
            $full_name = $this->splitOrGenerate($result->fetch()); //get first and last name or generate it if is empty
            app(NewCustomer::class)->run($full_name);
            echo 'Your profile just created with id ' . app(FlowStore::class)->get('customer_id');
        };

        $menu = $builder
            ->setTitle('Profile & Payment Details')
            ->addItem('Enter your full name', $itemCallable)
            ->addLineBreak('-')
            ->build();
        return $menu;
    }

    protected function splitOrGenerate($name)
    {
        if ($name) {
            $pieces = Str::of($name)->explode(' ');
            return [
                'first_name' => $pieces[0],
                'last_name' => $pieces[1]
            ];
        }
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
        ];
    }
}
