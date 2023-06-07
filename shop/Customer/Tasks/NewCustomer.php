<?php


namespace Shop\Customer\Tasks;

use Shop\Customer\Models\Customer;
use Shop\User\Tasks\NewUser;

/**
 * @return Customer
 * @throws Exception
 */
class NewCustomer
{
    public function __construct(
        protected Customer $customer
    ) {
    }
    public function run($data): Customer|string
    {
        try {
            $user = app(NewUser::class)->run($data);
            app(FlowStore::class)->set('user_id', $user->id); //dirty workaround :(
            // just for this we use orm style
            $customer = new Customer($data);
            //assign customer to user model
            $user->customer()->save($customer);
            $user->refresh(); //refresh model
            logger($user->customer->id);
            app(FlowStore::class)->set('customer_id', $user->customer->id); //useful to proceed checkout //dirty workaround :(
            app(FlowStore::class)->set('full_name', $user->customer->full_name); //useful to proceed checkout //dirty workaround :(
            return $user->customer;
        } catch (\Exception $exception) {
            return  $exception->getMessage();
        }
    }
}
