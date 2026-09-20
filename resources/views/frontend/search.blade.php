@extends('frontend.app')

@section('title', $heading . " — ESHA'S ROKOMARIS 2")
@section('meta_description', "Browse the Esha's Rokomaris 2 collection by category.")

@section('content')

@php
    /* Keeps the active keyword when the visitor switches category. */
    $filterUrl = function ($categoryId = null) use ($query) {
        $params = array_filter([
            'q'        => $query,
            'category' => $categoryId,
        ], fn ($value) => $value !== null && $value !== '');

        return url('/search') . ($params ? '?' . http_build_query($params) : '');
    };
@endphp

{{-- ==================================================== PAGE INTRO --}}
<section class="page-head">
    <div class="brand-container">
        <span class="eyebrow">Shop</span>
        <h1 class="page-head__title">{{ $heading }}</h1>
        <p class="page-head__text">
            {{ $products->total() }} {{ Str::plural('piece', $products->total()) }} available right now
        </p>

        <form class="search-bar" action="{{ url('/search') }}" method="GET" role="search">
            <label class="sr-only" for="shop-search">Search the collection</label>
            <input id="shop-search" type="search" name="q" value="{{ $query }}"
                   placeholder="Search for a piece or a category…">

            @if($activeCategory)
                <input type="hidden" name="category" value="{{ $activeCategory->id }}">
            @endif

            <button class="btn" type="submit">Search</button>
        </form>
    </div>
</section>

{{-- ==================================================== CATALOGUE --}}
<section class="section section--white">
    <div class="brand-container">

        @if($categories->isNotEmpty())
            <nav class="filter-bar" aria-label="Browse by category">
                <a class="chip {{ $activeCategory ? '' : 'is-active' }}" href="{{ $filterUrl() }}">
                    All <span class="chip__count">{{ $totalProducts }}</span>
                </a>

                @foreach($categories as $category)
                    @php $isActive = $activeCategory && $activeCategory->id === $category->id; @endphp
                    <a class="chip {{ $isActive ? 'is-active' : '' }}"
                       href="{{ $filterUrl($category->id) }}"
                       @if($isActive) aria-current="true" @endif>
                        {{ $category->name }} <span class="chip__count">{{ $category->products_count }}</span>
                    </a>
                @endforeach
            </nav>
        @endif

        @if($products->count())
            <div class="product-grid">
                @foreach($products as $product)
                    @include('frontend.partials.product-card', ['card' => product_card($product)])
                @endforeach
            </div>

            @if($products->hasPages())
                <div class="pagination-wrap">
                    {{ $products->links('pagination::brand') }}
                </div>
            @endif
        @else
            <div class="collection-empty">
                <p class="collection-empty__title">
                    @if($query !== '')
                        Nothing matched &ldquo;{{ $query }}&rdquo;.
                    @elseif($activeCategory)
                        Nothing in {{ $activeCategory->name }} just yet.
                    @else
                        The new collection is on its way.
                    @endif
                </p>
                <p class="collection-empty__text">
                    Try a different keyword, or browse everything we have in store.
                </p>
                <a class="link-arrow" href="{{ url('/search') }}">
                    Browse Everything
                    <svg width="18" height="10" viewBox="0 0 18 10" fill="none" stroke="currentColor" stroke-width="1.4" aria-hidden="true">
                        <path d="M0 5h16M12 1l4 4-4 4"/>
                    </svg>
                </a>
            </div>
        @endif

    </div>
</section>

@include('frontend.partials.footer')

@endsection
