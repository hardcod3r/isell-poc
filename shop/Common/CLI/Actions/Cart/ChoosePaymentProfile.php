<?php

namespace Shop\Common\CLI\Actions\Cart;

use PhpSchool\CliMenu\Builder\CliMenuBuilder;
use Shop\Customer\Tasks\CustomerList;
use PhpSchool\CliMenu\CliMenu;

class ChoosePaymentProfile
{

    public function run(CliMenuBuilder $builder)
    {
        $customers = app(CustomerList::class)->run();
        $menu = (new CliMenuBuilder)->setTitle('Choose your payment method');
        foreach ($customers as $customer) {
            $menu->addRadioItem($customer->full_name,  function ($customer) {
                echo $customer->places->first()->address;
            });
        }
        return $menu;
    }
}
