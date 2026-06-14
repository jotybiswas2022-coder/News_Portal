<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'items',
        'subtotal',
        'total',
        'payment_method',
        'status',
        'customer_name',
        'customer_email',
        'phone',
        'trading_account',
        'transaction_id',
        'payment_screenshot',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'items' => 'array',
            'subtotal' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    /**
     * Generate a unique order number.
     */
    public static function generateOrderNumber(): string
    {
        $prefix = 'ORD-';
        $timestamp = now()->format('ymd');
        $random = strtoupper(substr(uniqid(), -4));

        // Ensure uniqueness
        $orderNumber = $prefix . $timestamp . '-' . $random;
        while (static::where('order_number', $orderNumber)->exists()) {
            $random = strtoupper(substr(uniqid(), -4));
            $orderNumber = $prefix . $timestamp . '-' . $random;
        }

        return $orderNumber;
    }

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
