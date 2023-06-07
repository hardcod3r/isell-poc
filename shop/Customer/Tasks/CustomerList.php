<?php


namespace Shop\Customer\Tasks;

use Shop\Customer\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

/**
 * @return Customer
 * @throws Exception
 */
class CustomerList
{
    public function __construct(
        protected Customer $customer
    ) {
    }
    public function run(): Collection|string
    {
        try {
            return $this->customer->all();
        } catch (\Exception $exception) {
            return  $exception->getMessage();
        }
    }
}
