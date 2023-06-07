<?php


namespace Shop\Billing\Tasks;

use Shop\Billing\Models\Order;
use Shop\Customer\Models\Customer;
use Shop\Cart\Models\Cart;
use Shop\Billing\Contracts\BillingInterface;
use Shop\Cart\FlowStore;

/**
 * @return Order
 * @throws Exception
 */
class CreateOrder
{
    public function __construct(
        protected Order $order,
        protected BillingInterface $billing
    ) {
    }
    public function run(): Order|string
    {
        try {
            $data = [];
            $data['payment_method'] = $this->billing->create(); // already from provider
            $customer = app(FlowStore::class)->get('customer_id'); // get if exists one
            $data['customer_id'] = ($customer) ?? Customer::inRandomOrder()->first()->id; // if not get a random one
            $data['cart_signature'] = app(FlowStore::class)->get('signature'); // get signature
            $data['total'] = Cart::fullcart($data['cart_signature'])->sum('total'); // get total of cart
            return $this->order->create($data);
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            return  $exception->getMessage();
        }
    }
}
