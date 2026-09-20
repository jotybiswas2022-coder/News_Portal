@extends('frontend.app')

@section('title', "Shopping Bag — ESHA'S ROKOMARIS 2")
@section('meta_description', 'Review your pieces before checking out at Esha\'s Rokomaris 2.')

@section('content')

@php
    use App\Models\Setting;

    $settings    = Setting::first();
    $delivery    = (float) ($settings?->delivery_charge ?? 0);
    $taxPercent  = (int) ($settings?->tax_percentage ?? 0);
    $currency    = currency();
    $placeholder = 'https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?auto=format&fit=crop&w=700&q=80';

    $validCarts = collect();
    foreach ($carts as $cart) {
        if ($cart->product) {
            $validCarts->push($cart);
        }
    }

    $subtotal = 0;
    $rows = collect();
    foreach ($validCarts as $cart) {
        $product = $cart->product;

        $discount    = (int) ($product->discount ?? 0);
        $price       = (float) ($product->price ?? 0);
        $finalPrice  = $discount > 0 ? $price - ($price * $discount / 100) : $price;
        $soldOut     = (int) ($product->stock ?? 0) <= 0;
        $lineTotal   = $soldOut ? 0 : $finalPrice * $cart->quantity;

        $subtotal += $lineTotal;

        $rows->push([
            'id'         => $cart->id,
            'name'       => $product->name,
            'productUrl' => url('/product/' . $product->id),
            'category'   => optional($product->ProductCategory)->name ?? "Women's Collection",
            'image'      => $product->image ? config('app.storage_url') . $product->image : $placeholder,
            'qty'        => (int) $cart->quantity,
            'price'      => $finalPrice,
            'oldPrice'   => $discount > 0 ? $price : null,
            'lineTotal'  => $lineTotal,
            'stock'      => (int) $product->stock,
            'soldOut'    => $soldOut,
        ]);
    }

    $taxAmount  = ($subtotal * $taxPercent) / 100;
    $grandTotal = $subtotal + $taxAmount + $delivery;
@endphp

@if(session('success'))
    <div class="brand-container">
        <p class="notice" role="status">{{ session('success') }}</p>
    </div>
@endif

@if(session('error'))
    <div class="brand-container">
        <p class="notice notice--error" role="status">{{ session('error') }}</p>
    </div>
@endif

{{-- ==================================================== PAGE INTRO --}}
<section class="page-head">
    <div class="brand-container">
        <span class="eyebrow">Your Bag</span>
        <h1 class="page-head__title">Shopping Bag</h1>
        <p class="page-head__text">Review your pieces before checkout.</p>
    </div>
</section>

{{-- ====================================================== EMPTY --}}
@if($rows->isEmpty())

<section class="section section--ivory">
    <div class="brand-container">
        <div class="cart-empty">
            <span class="cart-empty__mark brand__mark" aria-hidden="true">ER</span>
            <h2 class="cart-empty__title">Your bag is empty</h2>
            <p class="cart-empty__text">
                Add a few pieces you love and come back when you're ready to check out.
            </p>
            <a class="btn" href="{{ url('/search') }}">Start Shopping</a>
        </div>
    </div>
</section>

@else

{{-- ======================================================= BAG --}}
<section class="section section--ivory">
    <div class="brand-container">
        <div class="cart-layout">

            {{-- ------------------------------------------------- ITEMS --}}
            <div class="cart-panel">
                <header class="cart-panel__head">
                    <h2 class="cart-panel__title">
                        {{ $rows->count() }} {{ $rows->count() === 1 ? 'Item' : 'Items' }}
                    </h2>
                </header>

                <ul class="cart-list">
                    @foreach($rows as $row)
                    <li class="cart-item{{ $row['soldOut'] ? ' cart-item--sold-out' : '' }}">

                        <a class="cart-item__img" href="{{ $row['productUrl'] }}" aria-label="{{ $row['name'] }}">
                            <img src="{{ $row['image'] }}" alt="{{ $row['name'] }}" width="300" height="400">
                        </a>

                        <div class="cart-item__main">
                            <span class="cart-item__category">{{ $row['category'] }}</span>
                            <a class="cart-item__name" href="{{ $row['productUrl'] }}">{{ $row['name'] }}</a>

                            <div class="cart-item__price">
                                @if($row['oldPrice'] !== null)
                                    <span class="cart-item__price-old">{{ $currency }} {{ number_format($row['oldPrice'], 2) }}</span>
                                @endif
                                <span class="cart-item__price-now">{{ $currency }} {{ number_format($row['price'], 2) }}</span>
                            </div>

                            @if($row['soldOut'])
                                <span class="cart-item__stock cart-item__stock--out">Out of Stock</span>
                            @elseif($row['stock'] <= 5)
                                <span class="cart-item__stock cart-item__stock--low">Only {{ $row['stock'] }} left</span>
                            @endif
                        </div>

                        <div class="cart-item__qty">
                            @if(!$row['soldOut'])
                            <span class="cart-item__qty-label">Qty</span>
                            <div class="qty-control">
                                <a class="qty-control__btn" href="/manage/minus/{{ $row['id'] }}" aria-label="Decrease quantity">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                                        <path d="M5 12h14"/>
                                    </svg>
                                </a>
                                <span class="qty-control__value">{{ $row['qty'] }}</span>
                                <a class="qty-control__btn" href="/manage/plus/{{ $row['id'] }}" aria-label="Increase quantity">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                                        <path d="M12 5v14M5 12h14"/>
                                    </svg>
                                </a>
                            </div>
                            @else
                            <span class="cart-item__qty-label">—</span>
                            @endif
                        </div>

                        <div class="cart-item__line {{ $row['soldOut'] ? 'cart-item__line--muted' : '' }}">
                            <span class="cart-item__line-label">Total</span>
                            <span class="cart-item__line-value">{{ $currency }} {{ number_format($row['lineTotal'], 2) }}</span>
                        </div>

                        <a class="cart-item__remove" href="/manage/destroy/{{ $row['id'] }}" aria-label="Remove {{ $row['name'] }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true">
                                <path d="M18 6 6 18M6 6l12 12"/>
                            </svg>
                        </a>

                    </li>
                    @endforeach
                </ul>

                <div class="cart-panel__foot">
                    <a class="cart-panel__continue" href="{{ url('/search') }}">Continue Shopping</a>
                </div>
            </div>

            {{-- ----------------------------------------------- SUMMARY --}}
            <aside class="cart-summary">
                <h3 class="cart-summary__title">Order Summary</h3>

                <ul class="cart-summary__rows">
                    <li class="cart-summary__row">
                        <span>Subtotal</span>
                        <span>{{ $currency }} {{ number_format($subtotal, 2) }}</span>
                    </li>
                    <li class="cart-summary__row">
                        <span>Tax ({{ $taxPercent }}%)</span>
                        <span>{{ $currency }} {{ number_format($taxAmount, 2) }}</span>
                    </li>
                    <li class="cart-summary__row">
                        <span>Delivery</span>
                        <span>{{ $currency }} {{ number_format($delivery, 2) }}</span>
                    </li>
                </ul>

                <div class="cart-summary__total">
                    <span>Grand Total</span>
                    <span>{{ $currency }} {{ number_format($grandTotal, 2) }}</span>
                </div>

                <a class="btn btn--block" href="{{ url('/billing') }}">Proceed to Checkout</a>

                <p class="cart-summary__note">Shipping details are confirmed at checkout.</p>
            </aside>

        </div>
    </div>
</section>

@endif

@include('frontend.partials.footer')

@endsection