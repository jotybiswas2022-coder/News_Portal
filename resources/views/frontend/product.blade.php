@extends('frontend.app')

@section('title', $product->name . " — ESHA'S ROKOMARIS 2")
@section('meta_description', 'Shop ' . $product->name . ' from the Esha\'s Rokomaris 2 collection.')

@section('content')

@php
    $placeholder = 'https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?auto=format&fit=crop&w=900&q=80';
    $image       = $product->image ? config('app.storage_url') . $product->image : $placeholder;

    $categoryName = optional($product->ProductCategory)->name ?? 'The Collection';
    $categoryUrl  = $product->category_id ? url('/search?category=' . $product->category_id) : url('/search');

    $hasDiscount = (int) $product->discount > 0;
    $finalPrice  = $hasDiscount
        ? $product->price * (100 - $product->discount) / 100
        : (float) $product->price;

    $soldOut = (int) $product->stock <= 0;
    $inBag   = auth()->check() && IsAddedToCart(auth()->id(), $product->id);

    /* Named $contact so the shared footer reuses the same settings row. */
    $contact = \App\Models\Setting::first();

    $paymentMethods = collect([
        $contact?->bkash_number ? 'bKash' : null,
        $contact?->nagad_number ? 'Nagad' : null,
    ])->filter()->values();

    $paymentSummary = $paymentMethods->isNotEmpty()
        ? $paymentMethods->implode(', ') . ' & cash on delivery'
        : 'Cash on delivery available';
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

{{-- ================================================ BREADCRUMB BAR --}}
<div class="catalogue-bar">
    <div class="brand-container">
        <nav class="breadcrumbs catalogue-bar__crumbs" aria-label="Breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            <span class="breadcrumbs__sep" aria-hidden="true">/</span>
            <a href="{{ url('/search') }}">Shop</a>
            <span class="breadcrumbs__sep" aria-hidden="true">/</span>
            <a href="{{ $categoryUrl }}">{{ $categoryName }}</a>
            <span class="breadcrumbs__sep" aria-hidden="true">/</span>
            <span class="breadcrumbs__current">{{ $product->name }}</span>
        </nav>
    </div>
</div>

{{-- ================================================= PRODUCT DETAIL --}}
<section class="section section--white product-detail-section">
    <div class="brand-container">
        <div class="product-detail">

            <div class="product-detail__media">
                <figure class="product-detail__frame">
                    <img src="{{ $image }}"
                         alt="{{ $product->name }} — {{ $categoryName }}"
                         width="900" height="1200" decoding="async">
                </figure>

                @if($hasDiscount)
                    <span class="product-detail__badge">{{ $product->discount }}% Off</span>
                @elseif($soldOut)
                    <span class="product-detail__badge product-detail__badge--out">Sold Out</span>
                @endif
            </div>

            <div class="product-detail__body">
                <a class="product-detail__cat" href="{{ $categoryUrl }}">{{ $categoryName }}</a>

                <h1 class="product-detail__title">{{ $product->name }}</h1>

                <div class="product-detail__price">
                    @if($hasDiscount)
                        <s class="product-detail__old">{{ currency() }} {{ number_format($product->price, 0) }}</s>
                    @endif
                    <span class="product-detail__current">{{ currency() }} {{ number_format($finalPrice, 0) }}</span>

                    @if($hasDiscount)
                        <span class="product-detail__save">Save {{ $product->discount }}%</span>
                    @endif
                </div>

                @if(!$soldOut)
                    <p class="product-detail__stock product-detail__stock--in">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M20 6 9 17l-5-5"/>
                        </svg>
                        In stock — {{ $product->stock }} available
                    </p>
                @else
                    <p class="product-detail__stock product-detail__stock--out">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true">
                            <path d="M18 6 6 18M6 6l12 12"/>
                        </svg>
                        Currently sold out
                    </p>
                @endif

                @if(!empty($product->details))
                    <div class="product-detail__desc">
                        <p>{!! $product->details !!}</p>
                    </div>
                @endif

                <ul class="pd-facts">
                    <li class="pd-fact">
                        <span class="pd-fact__icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 7h11v10H3z"/><path d="M14 10h4l3 3v4h-7z"/><circle cx="7" cy="18" r="1.6"/><circle cx="17" cy="18" r="1.6"/>
                            </svg>
                        </span>
                        <span>
                            <strong class="pd-fact__label">Nationwide delivery</strong>
                            <span class="pd-fact__note">
                                @if($contact?->delivery_charge)
                                    Inside Dhaka from {{ currency() }} {{ number_format((float) $contact->delivery_charge, 0) }}
                                @else
                                    Delivered anywhere in Bangladesh
                                @endif
                            </span>
                        </span>
                    </li>

                    <li class="pd-fact">
                        <span class="pd-fact__icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2.5" y="6" width="19" height="12" rx="2"/><path d="M2.5 10h19"/>
                            </svg>
                        </span>
                        <span>
                            <strong class="pd-fact__label">Pay your way</strong>
                            <span class="pd-fact__note">{{ $paymentSummary }}</span>
                        </span>
                    </li>

                    <li class="pd-fact">
                        <span class="pd-fact__icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 12a9 9 0 1 1-9-9"/><path d="M21 3v6h-6"/><path d="M12 7v5l3 2"/>
                            </svg>
                        </span>
                        <span>
                            <strong class="pd-fact__label">Styling help</strong>
                            <span class="pd-fact__note">Message us about sizing or styling before you order</span>
                        </span>
                    </li>
                </ul>

                <div class="product-detail__actions" data-buy-anchor>
                    @if($soldOut)
                        <button class="btn btn--block" disabled>Sold Out</button>
                    @elseif($inBag)
                        <button class="btn btn--block" disabled>In Bag</button>
                    @else
                        <a class="btn btn--block" href="{{ url('/add_cart/' . $product->id) }}">Add to Bag</a>
                    @endif
                </div>

                <a class="link-arrow" href="{{ url('/search') }}">
                    Continue Shopping
                    <svg width="18" height="10" viewBox="0 0 18 10" fill="none" stroke="currentColor" stroke-width="1.4" aria-hidden="true">
                        <path d="M0 5h16M12 1l4 4-4 4"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</section>

{{-- ======================================== MOBILE STICKY BUY BAR --}}
@if(!$soldOut)
    <div class="buy-bar" data-buy-bar>
        <div class="buy-bar__info">
            <span class="buy-bar__name">{{ $product->name }}</span>
            <span class="buy-bar__price">{{ currency() }} {{ number_format($finalPrice, 0) }}</span>
        </div>

        @if($inBag)
            <button class="btn" disabled>In Bag</button>
        @else
            <a class="btn" href="{{ url('/add_cart/' . $product->id) }}">Add to Bag</a>
        @endif
    </div>
@endif

{{-- ============================================== RELATED PIECES --}}
@if($otherProducts->count())
    <section class="section">
        <div class="brand-container">

            <div class="section-head reveal">
                <span class="eyebrow">You May Also Like</span>
                <h2>Related Pieces</h2>
                <p>More from the {{ $categoryName }} edit worth a closer look.</p>
                <span class="deco-line" aria-hidden="true"></span>
            </div>

            <div class="product-grid">
                @foreach($otherProducts as $item)
                    @include('frontend.partials.product-card', ['card' => product_card($item)])
                @endforeach
            </div>

        </div>
    </section>
@endif

@include('frontend.partials.footer')

@endsection
