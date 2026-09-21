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

    $pieceCount = $products->total();
    $hasFilter  = $query !== '' || $activeCategory;
@endphp

{{-- ================================================== CATALOGUE HEAD --}}
<section class="shop-head">
    <span class="shop-head__blob" aria-hidden="true"></span>

    <div class="brand-container">

        <nav class="breadcrumbs shop-head__crumbs" aria-label="Breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            <span class="breadcrumbs__sep" aria-hidden="true">/</span>

            @if($activeCategory)
                <a href="{{ url('/search') }}">Shop</a>
                <span class="breadcrumbs__sep" aria-hidden="true">/</span>
                <span class="breadcrumbs__current">{{ $activeCategory->name }}</span>
            @elseif($query !== '')
                <a href="{{ url('/search') }}">Shop</a>
                <span class="breadcrumbs__sep" aria-hidden="true">/</span>
                <span class="breadcrumbs__current">Search</span>
            @else
                <span class="breadcrumbs__current">Shop</span>
            @endif
        </nav>

        <div class="shop-head__inner">
            <div class="shop-head__intro">
                <span class="eyebrow">Shop</span>
                <h1 class="shop-head__title">{{ $heading }}</h1>
                <p class="shop-head__text">
                    {{ $pieceCount }} {{ Str::plural('piece', $pieceCount) }} to browse right now.
                </p>
            </div>

            <form class="search-bar search-bar--lg" action="{{ url('/search') }}" method="GET" role="search">
                <label class="sr-only" for="shop-search">Search the collection</label>

                <div class="search-bar__field">
                    <span class="search-bar__icon" aria-hidden="true">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true">
                            <circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/>
                        </svg>
                    </span>
                    <input id="shop-search" type="search" name="q" value="{{ $query }}"
                           placeholder="Search for a piece or a category…">
                </div>

                @if($activeCategory)
                    <input type="hidden" name="category" value="{{ $activeCategory->id }}">
                @endif

                <button class="btn" type="submit">Search</button>
            </form>
        </div>

    </div>
</section>

{{-- ==================================================== CATALOGUE --}}
<section class="section section--white">
    <div class="brand-container">

        @if($categories->isNotEmpty())
            <div class="shop-toolbar reveal">
                <div class="shop-toolbar__meta">
                    <span class="shop-toolbar__count">
                        {{ $pieceCount }} {{ Str::plural('piece', $pieceCount) }}
                    </span>

                    @if($query !== '')
                        <span class="shop-toolbar__tag">&ldquo;{{ $query }}&rdquo;</span>
                    @endif
                </div>

                <nav class="chip-row" aria-label="Browse by category">
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

                @if($hasFilter)
                    <a class="shop-toolbar__clear" href="{{ url('/search') }}">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                            <path d="M6 6l12 12M18 6L6 18"/>
                        </svg>
                        Clear
                    </a>
                @endif
            </div>
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
            <div class="collection-empty reveal">
                <span class="collection-empty__icon" aria-hidden="true">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/>
                    </svg>
                </span>

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
