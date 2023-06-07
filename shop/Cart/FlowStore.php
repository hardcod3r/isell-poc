<?php


namespace Shop\Cart;

use Illuminate\Support\Str;

/**
 * FlowStore a very simple session  implementation using just built in lr helpers (for cli session destruct on exit)
 */
class FlowStore
{


    //first of all create unique signature for user's cart
    public function create()
    {
        $signature =  (string) Str::uuid();
        return session()->put('signature', $signature);
    }

    public function set($key, $value)
    {
        return session()->put($key, $value);
    }

    public function get($key)
    {
        return session()->get($key);
    }
}
