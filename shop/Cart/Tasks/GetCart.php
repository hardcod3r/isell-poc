<?php


namespace Shop\Cart\Tasks;

use Shop\Cart\Models\Cart;
use Illuminate\Database\Eloquent\Collection;

/**
 * @return AddToCart
 * @throws Exception
 */
class GetCart
{
    public function __construct(
        protected Cart $cart
    ) {
    }
    public function run(): Collection|string
    {

        try {
            //get all current carts
            $this->cart->refresh(); //refresh before get
            return $this->cart->fullcart(session('signature'))->get();
        } catch (\Exception $exception) {
            return  $exception->getMessage();
        }
    }
}
