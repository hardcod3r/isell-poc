<?php

namespace Shop\Billing\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelFlags\Models\Concerns\HasFlags;
use Shop\Billing\Models\Traits\HasCartsTrait;
use Shop\Billing\Models\Traits\HasCustomerTrait;

class Order extends Model
{
    use HasFactory;
    use HasFlags;
    use HasCustomerTrait;
    use HasCartsTrait;


    protected $fillable = [
        'cart_signature',
        'customer_id',
        'total',
        'payment_method'
    ];
}
