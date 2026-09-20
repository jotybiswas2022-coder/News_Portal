@extends('frontend.app')

@section('title', $product->name . " — ESHA'S ROKOMARIS 2")
@section('meta_description', 'Shop ' . $product->name . ' from the Esha\'s Rokomaris 2 collection.')

@section('content')

@php
    $card        = product_card($product);
    $placeholder = 'https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?auto=format&fit=crop&w=900&q=80';
    $image       = $product->image ? config('app.storage_url') . $product->image : $placeholder;
    $categoryName = optional($product->ProductCategory)->name ?? 'The Collection';
    $hasDiscount  = (int) $product->discount > 0;
    $finalPrice   = $hasDiscount ? $product->price * (100 - $product->discount) / 100 : (float) $product->price;
@endphp

@if(session('success'))
    <div class="brand-container">
        <p class="notice" role="status">{{ session('success') }}</p>
    </div>
@endif

@if(session('error'))
    <div class="brand-container">
        <p class="notice" role="status">{{ session('error') }}</p>
    </div>
@endif

{{-- ==================================================== PAGE INTRO --}}
<section class="page-head">
    <div class="brand-container">
        <span class="eyebrow">Shop</span>
        <h1 class="page-head__title">{{ $product->name }}</h1>
        <p class="page-head__text">{{ $categoryName }}</p>

        <nav class="breadcrumbs" aria-label="Breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            <span class="breadcrumbs__sep" aria-hidden="true">/</span>
            <a href="{{ url('/search') }}">Shop</a>
            <span class="breadcrumbs__sep" aria-hidden="true">/</span>
            <span class="breadcrumbs__current">{{ $product->name }}</span>
        </nav>
    </div>
</section>

{{-- ============================================ PRODUCT DETAIL --}}
<section class="section section--white">
    <div class="brand-container">
        <div class="product-detail">

            <div class="product-detail__media">
                <figure class="product-detail__frame">
                    <img src="{{ $image }}" alt="{{ $product->name }} — {{ $categoryName }}">
                </figure>

                @if($hasDiscount)
                    <span class="product-detail__badge">{{ $product->discount }}% Off</span>
                @endif
            </div>

            <div class="product-detail__body">
                <span class="eyebrow">{{ $categoryName }}</span>

                <h1 class="product-detail__title">{{ $product->name }}</h1>

                <div class="product-detail__price">
                    @if($hasDiscount)
                        <s class="product-detail__old">{{ currency() }} {{ number_format($product->price, 0) }}</s>
                    @endif
                    <span class="product-detail__current">{{ currency() }} {{ number_format($finalPrice, 0) }}</span>
                </div>

                @if($product->stock > 0)
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

                <div class="product-detail__actions">
                    @if($product->stock <= 0)
                        <button class="btn btn--block" disabled>Sold Out</button>
                    @elseif(auth()->check() && IsAddedToCart(auth()->id(), $product->id))
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

{{-- ============================================ RELATED PRODUCTS --}}
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