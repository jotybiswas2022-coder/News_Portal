@extends('frontend.app')

@section('title', "Shopping Bag — ESHA'S ROKOMARIS 2")
@section('meta_description', 'Review your pieces before checking out at Esha\'s Rokomaris 2.')

@section('content')

@php
    use App\Models\Setting;

    $settings         = Setting::first();
    $deliveryInside   = (float) ($settings?->delivery_charge ?? 0);
    $deliveryOutside  = (float) ($settings?->delivery_outside ?? 0);
    $delivery         = $deliveryInside;
    $taxPercent       = (int) ($settings?->tax_percentage ?? 0);
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

{{-- =================================================== BAG HEADER --}}
<section class="page-band">
    <div class="brand-container">

        <nav class="breadcrumbs page-band__crumbs" aria-label="Breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            <span class="breadcrumbs__sep" aria-hidden="true">/</span>
            <span class="breadcrumbs__current">Shopping Bag</span>
        </nav>

        <div class="page-band__inner">
            <div class="page-band__intro">
                <span class="eyebrow">Your Bag</span>
                <h1 class="page-band__title">Shopping Bag</h1>
                <p class="page-band__text">
                    @if($rows->isEmpty())
                        Nothing here yet — let's find something you love.
                    @else
                        {{ $rows->count() }} {{ $rows->count() === 1 ? 'piece' : 'pieces' }} waiting for checkout.
                    @endif
                </p>
            </div>

            <ol class="checkout-steps" aria-label="Checkout progress">
                <li class="checkout-step is-current" aria-current="step">
                    <span class="checkout-step__num">1</span>
                    <span class="checkout-step__label">Bag</span>
                </li>
                <li class="checkout-step">
                    <span class="checkout-step__num">2</span>
                    <span class="checkout-step__label">Details</span>
                </li>
                <li class="checkout-step">
                    <span class="checkout-step__num">3</span>
                    <span class="checkout-step__label">Payment</span>
                </li>
            </ol>
        </div>

    </div>
</section>

{{-- ========================================================= EMPTY --}}
@if($rows->isEmpty())

<section class="section section--ivory">
    <div class="brand-container">
        <div class="cart-empty">
            <span class="cart-empty__icon" aria-hidden="true">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 8h12l-1 12H7L6 8Z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/>
                </svg>
            </span>

            <h2 class="cart-empty__title">Your bag is empty</h2>
            <p class="cart-empty__text">
                Add a few pieces you love and come back when you're ready to check out.
            </p>
            <a class="btn" href="{{ url('/search') }}">Start Shopping</a>
        </div>
    </div>
</section>

@else

{{-- =========================================================== BAG --}}
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
                            <img src="{{ $row['image'] }}" alt="{{ $row['name'] }}" width="300" height="400" loading="lazy" decoding="async">
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
                                <span class="cart-item__stock cart-item__stock--out">
                                    <i aria-hidden="true"></i>Out of Stock
                                </span>
                            @elseif($row['stock'] <= 5)
                                <span class="cart-item__stock cart-item__stock--low">
                                    <i aria-hidden="true"></i>Only {{ $row['stock'] }} left
                                </span>
                            @endif

                            <a class="cart-item__remove" href="/manage/destroy/{{ $row['id'] }}" aria-label="Remove {{ $row['name'] }}">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M3 6h18"/>
                                    <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
                                    <path d="M10 11v6M14 11v6"/>
                                </svg>
                                Remove
                            </a>
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

                <div class="cart-summary__region" id="cart-region">
                    <span class="cart-form__label">Delivery Region</span>
                    <div class="cart-form__options">
                        <label class="cart-form__option">
                            <input type="radio" name="delivery_region" value="inside">
                            <span class="cart-form__option-btn">
                                <span class="cart-form__option-name">Inside Khulna</span>
                                <span class="cart-form__option-price">{{ $currency }} {{ number_format($deliveryInside, 2) }}</span>
                            </span>
                        </label>
                        <label class="cart-form__option">
                            <input type="radio" name="delivery_region" value="outside">
                            <span class="cart-form__option-btn">
                                <span class="cart-form__option-name">Outside Khulna</span>
                                <span class="cart-form__option-price">{{ $currency }} {{ number_format($deliveryOutside, 2) }}</span>
                            </span>
                        </label>
                    </div>
                </div>

                <ul class="cart-summary__rows">
                    <li class="cart-summary__row">
                        <span>Subtotal</span>
                        <span>{{ $currency }} {{ number_format($subtotal, 2) }}</span>
                    </li>
                    <li class="cart-summary__row">
                        <span>Tax ({{ $taxPercent }}%)</span>
                        <span>{{ $currency }} {{ number_format($taxAmount, 2) }}</span>
                    </li>
                    <li class="cart-summary__row cart-summary__row--delivery" data-inside="{{ $deliveryInside }}" data-outside="{{ $deliveryOutside }}">
                        <span>Delivery <span class="cart-summary__row-region"></span></span>
                        <span class="cart-summary__delivery-value">{{ $currency }} {{ number_format($delivery, 2) }}</span>
                    </li>
                </ul>

                <div class="cart-summary__total">
                    <span>Grand Total</span>
                    <span id="cart-grand-total" data-base="{{ number_format($grandTotal, 2, '.', '') }}" data-currency="{{ $currency }}">{{ $currency }} {{ number_format($grandTotal, 2) }}</span>
                </div>

                <a class="btn btn--block" href="{{ url('/billing') }}" data-checkout-anchor>Proceed to Checkout</a>

                <p class="cart-summary__note">Shipping details are confirmed at checkout.</p>
            </aside>

        </div>
    </div>
</section>

{{-- =========================================== MOBILE CHECKOUT BAR --}}
<div class="checkout-bar" data-checkout-bar>
    <div class="checkout-bar__info">
        <span class="checkout-bar__label">Grand Total</span>
        <span class="checkout-bar__total" id="cart-bar-total">{{ $currency }} {{ number_format($grandTotal, 2) }}</span>
    </div>

    <a class="btn" href="{{ url('/billing') }}">Checkout</a>
</div>

@endif

@include('frontend.partials.footer')

<script>
(function () {
    var regionBox = document.getElementById('cart-region');
    if (!regionBox) { return; }

    var radios = Array.prototype.slice.call(regionBox.querySelectorAll('input[name="delivery_region"]'));
    var deliveryRow = document.querySelector('.cart-summary__row--delivery');
    var grandTotal  = document.getElementById('cart-grand-total');
    if (!deliveryRow || !grandTotal) { return; }

    var deliveryValue = deliveryRow.querySelector('.cart-summary__delivery-value');
    var regionTag     = deliveryRow.querySelector('.cart-summary__row-region');
    var barTotal      = document.getElementById('cart-bar-total');
    var inside  = parseFloat(deliveryRow.getAttribute('data-inside')) || 0;
    var outside = parseFloat(deliveryRow.getAttribute('data-outside')) || 0;
    var base    = parseFloat(grandTotal.getAttribute('data-base')) || 0;
    var cur     = grandTotal.getAttribute('data-currency') || '';
    var names   = { inside: 'Inside Khulna', outside: 'Outside Khulna' };

    function fmt(n) { return cur + ' ' + n.toFixed(2); }

    function apply(region) {
        var charge = region === 'outside' ? outside : inside;
        var total  = base - inside + charge;

        deliveryValue.textContent = fmt(charge);
        regionTag.textContent = '(' + names[region] + ')';
        grandTotal.textContent = fmt(total);
        if (barTotal) { barTotal.textContent = fmt(total); }

        radios.forEach(function (r) { r.checked = (r.value === region); });
        try { localStorage.setItem('cart_region', region); } catch (e) {}
    }

    var saved = null;
    try { saved = localStorage.getItem('cart_region'); } catch (e) {}
    if (saved === 'inside' || saved === 'outside') { apply(saved); }
    else { apply('inside'); }

    radios.forEach(function (r) {
        r.addEventListener('change', function () { if (r.checked) { apply(r.value); } });
    });
})();
</script>

@endsection
