@extends('frontend.app')

@section('title', "Checkout — ESHA'S ROKOMARIS 2")
@section('meta_description', 'Complete your order securely at Esha\'s Rokomaris 2.')

@section('content')

@php
    use App\Models\Setting;

    $settings   = Setting::first();
    $delivery   = (float) ($settings?->delivery_charge ?? 0);
    $deliveryOutside = (float) ($settings?->delivery_outside ?? 0);
    $taxPercent = (int) ($settings?->tax_percentage ?? 0);
    $currency   = $settings?->currency ?? '৳';
    $bkashNo    = $settings?->bkash_number;
    $nagadNo    = $settings?->nagad_number;
    $user       = auth()->user();

    $subtotal = 0;
    foreach ($carts as $cart) {
        if ($cart->product) {
            $subtotal += ($cart->product->price * (100 - ($cart->product->discount ?? 0)) / 100) * $cart->quantity;
        }
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

@if($errors->any())
    <div class="brand-container">
        <p class="notice notice--error" role="status">
            @foreach($errors->all() as $error)
                {{ $error }}@if(!$loop->last)<br>@endif
            @endforeach
        </p>
    </div>
@endif

@if($carts->isEmpty())

    <section class="page-head">
        <div class="brand-container">
            <span class="eyebrow">Checkout</span>
            <h1 class="page-head__title">Your bag is empty</h1>
            <p class="page-head__text">Add a few pieces you love before checking out.</p>
        </div>
    </section>

    <section class="section section--ivory">
        <div class="brand-container">
            <div class="cart-empty">
                <span class="cart-empty__mark brand__mark" aria-hidden="true">ER</span>
                <h2 class="cart-empty__title">Nothing to check out yet</h2>
                <p class="cart-empty__text">
                    Head back to the shop and fill your bag with pieces you love.
                </p>
                <a class="btn" href="{{ url('/search') }}">Start Shopping</a>
            </div>
        </div>
    </section>

@else

<section class="page-head">
    <div class="brand-container">
        <span class="eyebrow">Checkout</span>
        <h1 class="page-head__title">Complete your order</h1>
        <p class="page-head__text">Confirm your details and choose how you'd like to pay.</p>
    </div>
</section>

<section class="section section--ivory">
    <div class="brand-container">

        <form action="/user/order/store" method="post" class="checkout-layout">
            @csrf

            {{-- ================================================ MAIN --}}
            <div class="checkout-main">

                {{-- ------------------------------- BILLING DETAILS --}}
                <div class="checkout-card">
                    <h2 class="checkout-card__title">Billing Details</h2>

                    <div class="form-row">
                        <div class="form-field">
                            <label for="firstname">First Name <span class="req">*</span></label>
                            <input class="form-control" type="text" id="firstname" name="firstname"
                                   value="{{ old('firstname', $user->firstname ?? '') }}" required>
                        </div>
                        <div class="form-field">
                            <label for="lastname">Last Name <span class="req">*</span></label>
                            <input class="form-control" type="text" id="lastname" name="lastname"
                                   value="{{ old('lastname', $user->lastname ?? '') }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-field">
                            <label for="email">Email <span class="req">*</span></label>
                            <input class="form-control" type="email" id="email" name="email"
                                   value="{{ old('email', $user->email ?? '') }}" required>
                        </div>
                        <div class="form-field">
                            <label for="phone">Phone <span class="req">*</span></label>
                            <input class="form-control" type="tel" id="phone" name="phone"
                                   value="{{ old('phone', $user->phone ?? '') }}" required>
                        </div>
                    </div>

                    <div class="form-field">
                        <label for="address">Full Address <span class="req">*</span></label>
                        <textarea class="form-control" id="address" name="address" rows="3"
                                  required>{{ old('address', $user->address ?? '') }}</textarea>
                    </div>
                </div>

                {{-- -------------------------------- PAYMENT METHOD --}}
                <div class="checkout-card">
                    <h2 class="checkout-card__title">Payment Method</h2>
                    <p class="checkout-card__hint">Choose how you want to pay for this order.</p>

                    <div class="pay-options">
                        <label class="pay-option">
                            <input type="radio" name="payment_method" value="cod"
                                   {{ old('payment_method', 'cod') === 'cod' ? 'checked' : '' }} required>
                            <span class="pay-option__box">
                                <span class="pay-option__name">Cash on Delivery</span>
                                <span class="pay-option__sub">Pay the product amount when your order arrives</span>
                            </span>
                        </label>

                        <label class="pay-option">
                            <input type="radio" name="payment_method" value="bkash"
                                   {{ old('payment_method') === 'bkash' ? 'checked' : '' }}>
                            <span class="pay-option__box">
                                <span class="pay-option__name">bKash</span>
                                <span class="pay-option__sub">
                                    @if($bkashNo)
                                        Pay now to {{ $bkashNo }}
                                    @else
                                        Instant mobile payment
                                    @endif
                                </span>
                            </span>
                        </label>

                        <label class="pay-option">
                            <input type="radio" name="payment_method" value="nagad"
                                   {{ old('payment_method') === 'nagad' ? 'checked' : '' }}>
                            <span class="pay-option__box">
                                <span class="pay-option__name">Nagad</span>
                                <span class="pay-option__sub">
                                    @if($nagadNo)
                                        Pay now to {{ $nagadNo }}
                                    @else
                                        Secure online payment
                                    @endif
                                </span>
                            </span>
                        </label>
                    </div>

                    <div class="checkout-note">
                        <strong>Cash on Delivery:</strong>
                        even on COD orders, the delivery charge
                        ({{ $currency }} {{ number_format($delivery, 2) }}) must be paid in advance
                        via bKash or Nagad. You'll be guided to do that on the next step.
                    </div>
                </div>

            </div>

            {{-- ============================================= ASIDE --}}
            <aside class="checkout-aside">
                <div class="checkout-summary">

                    <h3 class="checkout-summary__title">Order Summary</h3>

                    <ul class="checkout-summary__items">
                        @foreach($carts as $cart)
                            @if($cart->product)
                            <li class="checkout-summary__item">
                                <span class="checkout-summary__item-name">
                                    {{ $cart->product->name }}
                                    <span class="checkout-summary__item-qty">× {{ $cart->quantity }}</span>
                                </span>
                                @php
                                    $itemTotal = ($cart->product->price * (100 - ($cart->product->discount ?? 0)) / 100) * $cart->quantity;
                                @endphp
                                <span class="checkout-summary__item-price">{{ $currency }} {{ number_format($itemTotal, 2) }}</span>
                            </li>
                            @endif
                        @endforeach
                    </ul>

                    <ul class="checkout-summary__rows">
                        <li class="checkout-summary__row">
                            <span>Subtotal</span>
                            <span id="checkout-subtotal">{{ $currency }} {{ number_format($subtotal, 2) }}</span>
                        </li>
                        <li class="checkout-summary__row">
                            <span>Tax ({{ $taxPercent }}%)</span>
                            <span>{{ $currency }} {{ number_format($taxAmount, 2) }}</span>
                        </li>
                        <li class="checkout-summary__row checkout-summary__row--delivery"
                            data-inside="{{ $delivery }}" data-outside="{{ $deliveryOutside }}"
                            data-subtotal="{{ $subtotal + $taxAmount }}">
                            <span>Delivery <span class="checkout-summary__row-region"></span></span>
                            <span class="checkout-summary__delivery-value">{{ $currency }} {{ number_format($delivery, 2) }}</span>
                        </li>
                    </ul>

                    <div class="checkout-summary__total" id="checkout-grand-total"
                         data-base="{{ $subtotal + $taxAmount + $delivery }}"
                         data-currency="{{ $currency }}">
                        <span>Grand Total</span>
                        <span>{{ $currency }} {{ number_format($grandTotal, 2) }}</span>
                    </div>

                    <input type="hidden" name="delivery_region" id="delivery-region-input" value="inside">

                    <button type="submit" class="btn btn--block">Proceed to Payment</button>

                    <p class="checkout-summary__note">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="3" y="11" width="18" height="11" rx="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        Your information is safe and shared only for order processing.
                    </p>

                    <a class="checkout-summary__back" href="{{ url('/cart') }}">← Back to bag</a>
                </div>
            </aside>

        </form>

    </div>
</section>

@endif

@include('frontend.partials.footer')

<script>
(function () {
    var deliveryRow = document.querySelector('.checkout-summary__row--delivery');
    var grandTotal  = document.getElementById('checkout-grand-total');
    var regionInput = document.getElementById('delivery-region-input');
    if (!deliveryRow || !grandTotal || !regionInput) { return; }

    var deliveryValue = deliveryRow.querySelector('.checkout-summary__delivery-value');
    var regionTag     = deliveryRow.querySelector('.checkout-summary__row-region');
    var inside  = parseFloat(deliveryRow.getAttribute('data-inside')) || 0;
    var outside = parseFloat(deliveryRow.getAttribute('data-outside')) || 0;
    var base    = parseFloat(grandTotal.getAttribute('data-base')) || 0;
    var cur     = grandTotal.getAttribute('data-currency') || '';
    var names   = { inside: 'Inside Khulna', outside: 'Outside Khulna' };

    function fmt(n) { return cur + ' ' + n.toFixed(2); }

    function apply(region) {
        var charge = region === 'outside' ? outside : inside;
        deliveryValue.textContent = fmt(charge);
        regionTag.textContent = '(' + names[region] + ')';
        grandTotal.querySelector('span:last-child').textContent =
            fmt(base - inside + charge);
        regionInput.value = region;
        try { localStorage.setItem('cart_region', region); } catch (e) {}
    }

    var saved = null;
    try { saved = localStorage.getItem('cart_region'); } catch (e) {}
    if (saved === 'inside' || saved === 'outside') { apply(saved); }
    else { apply('inside'); }
})();
</script>

@endsection