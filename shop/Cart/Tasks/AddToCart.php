<?php


namespace Shop\Cart\Tasks;

use Shop\Cart\Models\Cart;
use Illuminate\Database\Eloquent\Collection;

/**
 * @return AddToCart
 * @throws Exception
 */
class AddToCart
{
    public function __construct(
        protected Cart $cart
    ) {
    }
    public function run($data): Cart|string
    {
        try {
            $data['signature'] = session('signature'); //get cart signature
            // check if exists cart item with same product id & signature
            $exists = $this->cart->where('signature', $data['signature'])->where('product_id', $data['product_id'])->first();
            if ($exists) {
                //we just increase the quantity && total
                $exists->increment('quantity', $data['quantity']); //first we increase the proper column
                return  $exists->update(['total' =>  $exists->quantity * $data['price']]); /// then set total
            }
            $data['total'] = intval($data['quantity']) * $data['price'];
            return $this->cart->create($data);
        } catch (\Exception $exception) {
            return  $exception->getMessage();
        }
    }
}
