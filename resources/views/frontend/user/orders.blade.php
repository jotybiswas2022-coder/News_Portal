@extends('frontend.app')

@section('title', 'My Orders — ESHA\'S ROKOMARIS 2')
@section('meta_description', 'Track your orders and payments at Esha\'s Rokomaris 2.')

@section('content')

@php
    $currency = \App\Models\Setting::first()?->currency ?? '৳';
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

<section class="page-head">
    <div class="brand-container">
        <span class="eyebrow">Your Account</span>
        <h1 class="page-head__title">My Orders</h1>
        <p class="page-head__text">
            Track your past orders and their payment status.
            @if($orders->isNotEmpty())
                You have {{ $orders->count() }} {{ Str::plural('order', $orders->count()) }}.
            @endif
        </p>
    </div>
</section>

<section class="section section--ivory">
    <div class="brand-container">

        @if($orders->isEmpty())

            <div class="cart-empty">
                <span class="cart-empty__mark brand__mark" aria-hidden="true">ER</span>
                <h2 class="cart-empty__title">No orders yet</h2>
                <p class="cart-empty__text">
                    Once you place an order, you can track it — and its payment — right here.
                </p>
                <a class="btn" href="{{ url('/search') }}">Start Shopping</a>
            </div>

        @else

            <div class="orders-toolbar">
                <label class="sr-only" for="order-search">Search my orders</label>
                <input class="form-control" type="search" id="order-search" placeholder="Search by order #, product or payment…">
            </div>

            <div class="orders-list" id="orders-list">

                @foreach($orders as $order)

                    @php
                        $status     = strtolower(trim($order->status ?? 'pending'));
                        $method     = strtolower(trim($order->payment_method ?? ''));
                        $payStatus  = strtolower(trim($order->payment_status ?? 'unpaid'));

                        $statusLabel = match($status) {
                            'approved' => 'Approved',
                            'delivered' => 'Delivered',
                            'canceled', 'cancelled' => 'Canceled',
                            default => 'Pending',
                        };
                        $methodLabel = match($method) {
                            'cod' => 'Cash on Delivery',
                            'bkash' => 'bKash',
                            'nagad' => 'Nagad',
                            default => $order->payment_method ?? 'COD',
                        };
                        $payLabel = match($payStatus) {
                            'paid' => 'Payment Received',
                            'submitted' => 'Payment Submitted',
                            default => 'Payment Pending',
                        };
                    @endphp

                    <article class="order-card">

                        <header class="order-card__head">

                            <div class="order-card__ref">
                                <span class="order-card__id">Order #{{ $order->id }}</span>
                                <span class="order-card__date">{{ $order->created_at ? $order->created_at->format('d M Y, h:i A') : '' }}</span>
                            </div>

                            <div class="order-card__tags">
                                <span class="tag tag--order tag--{{ $status }}">{{ $statusLabel }}</span>
                                <span class="tag tag--method tag--{{ $method }}">{{ $methodLabel }}</span>
                                <span class="tag tag--pay tag--{{ $payStatus }}">{{ $payLabel }}</span>
                            </div>

                        </header>

                        <div class="order-card__body">

                            <ul class="order-items">
                                @foreach($order->orderdetails as $item)
                                    @php
                                        $img = ($item->product && $item->product->image)
                                            ? config('app.storage_url') . $item->product->image
                                            : '';
                                        $unitPrice = ($item->product_price ?? 0) * ((100 - ($item->product->discount ?? 0)) / 100);
                                    @endphp
                                    <li class="order-item">
                                        @if($img)
                                            <span class="order-item__img">
                                                <img src="{{ $img }}" alt="{{ $item->product_name }}" loading="lazy">
                                            </span>
                                        @endif
                                        <span class="order-item__name">
                                            {{ $item->product_name }}
                                            <span class="order-item__qty">Qty: {{ $item->product_quantity }}</span>
                                        </span>
                                        <span class="order-item__price">
                                            {{ $currency }} {{ number_format($unitPrice * $item->product_quantity, 2) }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="order-card__aside">

                                <ul class="order-totals">
                                    <li>
                                        <span>Subtotal</span>
                                        <span>{{ $currency }} {{ number_format($order->product_price_after_discount ?? 0, 2) }}</span>
                                    </li>
                                    <li>
                                        <span>Tax</span>
                                        <span>{{ $currency }} {{ number_format($order->tax ?? 0, 2) }}</span>
                                    </li>
                                    <li>
                                        <span>Delivery</span>
                                        <span>{{ $currency }} {{ number_format($order->delivery_charge ?? 0, 2) }}</span>
                                    </li>
                                </ul>

                                <div class="order-totals__grand">
                                    <span>Order Total</span>
                                    <span>{{ $currency }} {{ number_format($order->total_price ?? 0, 2) }}</span>
                                </div>

                                <span class="order-card__customer">
                                    {{ $order->firstname }} {{ $order->lastname }} · {{ $order->phone }}
                                </span>

                            </div>

                        </div>

                        {{-- Payment details block --}}
                        @if($payStatus === 'paid' || $payStatus === 'submitted' || $order->sender_number)

                            <footer class="order-payment">

                                <div class="order-payment__title">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true">
                                        <rect x="2" y="5" width="20" height="14" rx="2"/>
                                        <path d="M2 10h20"/>
                                    </svg>
                                    Payment Details
                                </div>

                                <dl class="order-payment__rows">
                                    @if($order->advance_method && $method === 'cod')
                                        <div>
                                            <dt>Paid in advance</dt>
                                            <dd>
                                                {{ ucfirst($order->advance_method) }}
                                                ({{ $currency }} {{ number_format($order->delivery_charge ?? 0, 2) }})
                                            </dd>
                                        </div>
                                    @endif
                                    @if($order->sender_number)
                                        <div>
                                            <dt>Sent from</dt>
                                            <dd>{{ $order->sender_number }}</dd>
                                        </div>
                                    @endif
                                    @if($order->transaction_id)
                                        <div>
                                            <dt>Transaction ID</dt>
                                            <dd>{{ $order->transaction_id }}</dd>
                                        </div>
                                    @endif
                                    @if($order->payment_screenshot)
                                        <div>
                                            <dt>Proof</dt>
                                            <dd>
                                                <a href="{{ config('app.storage_url') . $order->payment_screenshot }}"
                                                   target="_blank" rel="noopener">View payment screenshot</a>
                                            </dd>
                                        </div>
                                    @endif
                                </dl>

                            </footer>

                        @endif

                        {{-- Pending payment CTA --}}
                        @if($payStatus === 'unpaid')
                            <footer class="order-payment order-payment--cta">
                                @if($method === 'cod')
                                    To confirm this order, pay the delivery charge
                                    ({{ $currency }} {{ number_format($order->delivery_charge ?? 0, 2) }})
                                    in advance via bKash or Nagad.
                                @else
                                    Complete the {{ ucfirst($methodLabel) }} payment to confirm this order.
                                @endif
                                <a class="btn btn--block" href="{{ url('/user/order/payment/' . $order->id) }}">Complete Payment</a>
                            </footer>
                        @endif

                    </article>

                @endforeach

            </div>

        @endif

    </div>
</section>

@include('frontend.partials.footer')

<script>
(function () {
    var input = document.getElementById('order-search');
    var list  = document.getElementById('orders-list');
    if (!input || !list) { return; }

    input.addEventListener('input', function () {
        var v = this.value.toLowerCase().trim();
        list.querySelectorAll('.order-card').forEach(function (card) {
            if (!v) { card.style.display = ''; return; }
            card.style.display = (card.innerText || '').toLowerCase().includes(v) ? '' : 'none';
        });
    });
})();
</script>

@endsection