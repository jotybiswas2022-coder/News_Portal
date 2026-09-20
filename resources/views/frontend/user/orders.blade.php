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
        <p class="page-head__text">Track your orders and their payment status.</p>
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

            <div class="os-toolbar">
                <label class="sr-only" for="order-search">Search my orders</label>
                <input class="form-control" type="search" id="order-search"
                       placeholder="Search orders or products…">
            </div>

            <div class="os-list" id="orders-list">

                @foreach($orders as $order)

                    @php
                        $status    = strtolower(trim($order->status ?? 'pending'));
                        $method    = strtolower(trim($order->payment_method ?? ''));
                        $payStatus = strtolower(trim($order->payment_status ?? 'unpaid'));

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
                            'paid' => 'Payment received',
                            'submitted' => 'Payment submitted, awaiting confirmation',
                            default => ($method === 'cod')
                                ? 'Pay delivery charge in advance to confirm'
                                : 'Payment not received yet',
                        };
                    @endphp

                    <article class="os-card">
                        <div class="os-card__top">
                            <span class="os-num">Order #{{ $loop->iteration }}</span>
                            <span class="os-date">{{ $order->created_at ? $order->created_at->format('d M Y, h:i A') : '' }}</span>
                            <span class="os-status os-status--{{ $status }}">{{ $statusLabel }}</span>
                        </div>

                        <ul class="os-items">
                            @foreach($order->orderdetails as $item)
                                <li class="os-item">
                                    <span class="os-item__name">{{ $item->product_name }}</span>
                                    <span class="os-item__qty">× {{ $item->product_quantity }}</span>
                                    <span class="os-item__price">
                                        {{ $currency }} {{ number_format(($item->product_price ?? 0) * $item->product_quantity, 2) }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>

                        <div class="os-total">
                            <span>Order Total</span>
                            <span>{{ $currency }} {{ number_format($order->total_price ?? 0, 2) }}</span>
                        </div>

                        <div class="os-pay">
                            <span class="os-pay__method">{{ $methodLabel }} · {{ $payLabel }}</span>

                            @if($payStatus === 'unpaid')
                                <a class="os-pay__btn" href="{{ url('/user/order/payment/' . $order->id) }}">Pay Now</a>
                            @endif
                        </div>

                        @if($payStatus !== 'unpaid' && ($order->sender_number || $order->transaction_id || $order->payment_screenshot))
                            <ul class="os-proof">
                                @if($order->advance_method && $method === 'cod')
                                    <li>Delivery paid in advance via {{ ucfirst($order->advance_method) }}
                                        ({{ $currency }} {{ number_format($order->delivery_charge ?? 0, 2) }})</li>
                                @endif
                                @if($order->sender_number)
                                    <li>Sent from {{ $order->sender_number }}</li>
                                @endif
                                @if($order->transaction_id)
                                    <li>Transaction ID: {{ $order->transaction_id }}</li>
                                @endif
                                @if($order->payment_screenshot)
                                    <li>
                                        <a href="{{ config('app.storage_url') . $order->payment_screenshot }}"
                                           target="_blank" rel="noopener">View payment screenshot</a>
                                    </li>
                                @endif
                            </ul>
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
        list.querySelectorAll('.os-card').forEach(function (card) {
            if (!v) { card.style.display = ''; return; }
            card.style.display = (card.innerText || '').toLowerCase().includes(v) ? '' : 'none';
        });
    });
})();
</script>

@endsection