<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'email',
        'phone',
        'address',
        'product_price_after_discount',
        'delivery_charge',
        'tax',
        'total_price',
        'status',
        'payment_method',
        'sender_number',
        'transaction_id',
        'payment_screenshot',
        'advance_method',
        'payment_status',
    ];

    public function orderdetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}