@extends('frontend.app')

@section('title', 'My Orders — ESHA\'S ROKOMARIS 2')
@section('meta_description', 'Track your orders and payments at Esha\'s Rokomaris 2.')

@section('content')

@php
    $currency = currency();

    /* Status buckets used by the filter row — only the ones in play are shown. */
    $statusMeta = [
        'pending'   => 'Pending',
        'approved'  => 'Approved',
        'delivered' => 'Delivered',
        'canceled'  => 'Canceled',
    ];

    $statusCounts = [];
    foreach ($orders as $order) {
        $key = match (strtolower(trim($order->status ?? 'pending'))) {
            'approved'  => 'approved',
            'delivered' => 'delivered',
            'canceled', 'cancelled' => 'canceled',
            default     => 'pending',
        };

        $statusCounts[$key] = ($statusCounts[$key] ?? 0) + 1;
    }
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

{{-- ===================================================== ACCOUNT HEAD --}}
<section class="page-band">
    <div class="brand-container">

        <nav class="breadcrumbs page-band__crumbs" aria-label="Breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            <span class="breadcrumbs__sep" aria-hidden="true">/</span>
            <span class="breadcrumbs__current">My Orders</span>
        </nav>

        <div class="page-band__inner">
            <div class="page-band__intro">
                <span class="eyebrow">Your Account</span>
                <h1 class="page-band__title">My Orders</h1>
                <p class="page-band__text">
                    @if($orders->isEmpty())
                        Once you place an order, you can track it — and its payment — right here.
                    @else
                        {{ $orders->count() }} {{ \Illuminate\Support\Str::plural('order', $orders->count()) }}
                        placed so far. Track delivery and settle any payment due.
                    @endif
                </p>
            </div>
        </div>

    </div>
</section>

<section class="section section--ivory">
    <div class="brand-container">

        @if($orders->isEmpty())

            <div class="cart-empty">
                <span class="cart-empty__icon" aria-hidden="true">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2h9l4 4v16H6z"/><path d="M14 2v5h5M9 13h6M9 17h4"/>
                    </svg>
                </span>

                <h2 class="cart-empty__title">No orders yet</h2>
                <p class="cart-empty__text">
                    Once you place an order, you can track it — and its payment — right here.
                </p>
                <a class="btn" href="{{ url('/search') }}">Start Shopping</a>
            </div>

        @else

            <div class="os-toolbar reveal">
                <div class="os-search">
                    <span class="os-search__icon" aria-hidden="true">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true">
                            <circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/>
                        </svg>
                    </span>
                    <label class="sr-only" for="order-search">Search my orders</label>
                    <input class="form-control" type="search" id="order-search"
                           placeholder="Search orders or products…">
                </div>

                <nav class="chip-row os-filters" aria-label="Filter orders by status">
                    <button class="chip is-active" type="button" data-status-filter="all">
                        All <span class="chip__count">{{ $orders->count() }}</span>
                    </button>

                    @foreach($statusMeta as $statusKey => $statusLabel)
                        @if(!empty($statusCounts[$statusKey]))
                            <button class="chip" type="button" data-status-filter="{{ $statusKey }}">
                                {{ $statusLabel }} <span class="chip__count">{{ $statusCounts[$statusKey] }}</span>
                            </button>
                        @endif
                    @endforeach
                </nav>
            </div>

            <p class="os-noresults" id="orders-empty" hidden>
                No orders match that search.
            </p>

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
                        $statusKey = match($status) {
                            'approved' => 'approved',
                            'delivered' => 'delivered',
                            'canceled', 'cancelled' => 'canceled',
                            default => 'pending',
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

                    <article class="os-card" data-status="{{ $statusKey }}">
                        <div class="os-card__top">
                            <span class="os-num">Order #{{ $order->id }}</span>
                            <span class="os-date">{{ $order->created_at ? $order->created_at->format('d M Y, h:i A') : '' }}</span>
                            <span class="os-status os-status--{{ $status }}">{{ $statusLabel }}</span>
                        </div>

                        <ul class="os-items">
                            @foreach($order->orderdetails as $item)
                                @php
                                    $itemImg = ($item->product && $item->product->image)
                                        ? config('app.storage_url') . $item->product->image
                                        : '';
                                @endphp
                                <li class="os-item">
                                    @if($itemImg)
                                        <span class="os-item__img">
                                            <img src="{{ $itemImg }}" alt="{{ $item->product_name }}" loading="lazy" decoding="async">
                                        </span>
                                    @endif
                                    <span class="os-item__name">{{ $item->product_name }}</span>
                                    <span class="os-item__qty">× {{ $item->product_quantity }}</span>
                                    <span class="os-item__price">
                                        {{ $currency }} {{ number_format(($item->product_price ?? 0) * $item->product_quantity, 2) }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>

                        {{-- Cost breakdown stays tucked away so cards remain scannable --}}
                        <details class="os-breakdown">
                            <summary>
                                <span>Order breakdown</span>
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                                    <path d="m6 9 6 6 6-6"/>
                                </svg>
                            </summary>

                            <ul class="os-rows">
                                <li>
                                    <span>Items</span>
                                    <span>{{ $currency }} {{ number_format($order->product_price_after_discount ?? 0, 2) }}</span>
                                </li>
                                <li>
                                    <span>Delivery</span>
                                    <span>{{ $currency }} {{ number_format($order->delivery_charge ?? 0, 2) }}</span>
                                </li>
                                <li>
                                    <span>Tax</span>
                                    <span>{{ $currency }} {{ number_format($order->tax ?? 0, 2) }}</span>
                                </li>
                            </ul>
                        </details>

                        <div class="os-total">
                            <span>Order Total</span>
                            <span>{{ $currency }} {{ number_format($order->total_price ?? 0, 2) }}</span>
                        </div>

                        <div class="os-pay">
                            <span class="os-pay__method os-pay__method--{{ $payStatus }}">
                                <span class="os-pay__chip">{{ $methodLabel }}</span>
                                {{ $payLabel }}
                            </span>

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
    var empty = document.getElementById('orders-empty');
    var chips = Array.prototype.slice.call(document.querySelectorAll('[data-status-filter]'));
    if (!list) { return; }

    var cards = Array.prototype.slice.call(list.querySelectorAll('.os-card'));
    var activeStatus = 'all';

    function apply() {
        var term = ((input && input.value) || '').toLowerCase().trim();
        var shown = 0;

        cards.forEach(function (card) {
            var matchesStatus = (activeStatus === 'all') || (card.getAttribute('data-status') === activeStatus);
            // textContent, not innerText: hidden cards must still be searchable.
            var matchesTerm = !term || (card.textContent || '').toLowerCase().indexOf(term) !== -1;
            var visible = matchesStatus && matchesTerm;

            card.style.display = visible ? '' : 'none';
            if (visible) { shown++; }
        });

        if (empty) { empty.hidden = shown !== 0; }
    }

    if (input) { input.addEventListener('input', apply); }

    chips.forEach(function (chip) {
        chip.addEventListener('click', function () {
            activeStatus = chip.getAttribute('data-status-filter');
            chips.forEach(function (c) { c.classList.toggle('is-active', c === chip); });
            apply();
        });
    });

    apply();
})();
</script>

@endsection
