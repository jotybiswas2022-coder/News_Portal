<?php

use App\Models\Cart;
use App\Models\Setting;
use App\Models\Product;

function cart($user_id = null) {
    $user_id = $user_id ?? auth()->id();
    if ($user_id) {
        return Cart::where('user_id', $user_id)->count();
    }
    return 0;
}

function IsAddedToCart($user_id, $product_id) {
    return Cart::where('user_id', $user_id)->where('product_id', $product_id)->exists();
}

function currency() {
    static $currency = null;

    if ($currency === null) {
        $currency = Setting::first()?->currency ?? '৳';
    }

    return $currency;
}

function buyprice($id){
    return Product::find($id)->base_price;
}

/**
 * Normalise a product into the shape used by frontend.partials.product-card,
 * so the homepage and the shop listing stay in sync.
 */
function product_card($product) {
    $currency   = currency();
    $placeholder = 'https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?auto=format&fit=crop&w=700&q=80';

    $discount    = (int) ($product->discount ?? 0);
    $hasDiscount = $discount > 0;
    $soldOut     = (int) ($product->stock ?? 0) <= 0;
    $price       = (float) ($product->price ?? 0);
    $finalPrice  = $hasDiscount ? $price - ($price * $discount / 100) : $price;

    return [
        'name'        => $product->name,
        'category'    => optional($product->ProductCategory)->name ?? "Women's Collection",
        'url'         => url('/product/' . $product->id),
        'image'       => $product->image ? config('app.storage_url') . $product->image : $placeholder,
        'price'       => $currency . ' ' . number_format($finalPrice, 0),
        'old_price'   => $hasDiscount ? $currency . ' ' . number_format($price, 0) : null,
        'badge'       => $soldOut ? 'Sold Out' : ($hasDiscount ? $discount . '% Off' : null),
        'badge_style' => $soldOut ? '' : 'gold',
        'sold_out'    => $soldOut,
        'in_cart'     => auth()->check() && IsAddedToCart(auth()->id(), $product->id),
    ];
}
