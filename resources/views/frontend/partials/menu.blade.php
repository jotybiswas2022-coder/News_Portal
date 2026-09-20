@php
    /* On the homepage the in-page anchors are handled by brand.js (smooth scroll
       with sticky-header offset). On every other page we send the visitor back
       to the matching homepage section. */
    $navPrefix = request()->is('/') ? '' : url('/');
    $bagCount  = function_exists('cart') ? cart() : 0;
@endphp

<a class="skip-link" href="#main">Skip to content</a>

<header class="site-header" data-header>
    <div class="brand-container">
        <div class="nav">

            {{-- Mobile: hamburger --}}
            <button class="icon-btn nav__toggle" type="button"
                    data-nav-toggle aria-expanded="false" aria-controls="primary-drawer"
                    aria-label="Open navigation menu">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" aria-hidden="true">
                    <path d="M3 6h18M3 12h18M3 18h18"/>
                </svg>
            </button>

            {{-- Brand --}}
            <a class="brand" href="{{ url('/') }}" aria-label="Esha's Rokomaris 2 — home">
                <span class="brand__mark" aria-hidden="true">ER</span>
                <span class="brand__name">Esha's Rokomaris 2</span>
            </a>

            {{-- Centre navigation --}}
            <ul class="nav__links" aria-label="Primary navigation">
                <li><a class="nav__link {{ request()->is('/') ? 'is-active' : '' }}" href="{{ url('/') }}">Home</a></li>
                <li><a class="nav__link" href="{{ $navPrefix }}#products">Shop</a></li>
                <li><a class="nav__link" href="{{ $navPrefix }}#about">About</a></li>
                <li><a class="nav__link" href="{{ $navPrefix }}#contact">Contact</a></li>

                @auth
                    @if(auth()->user()->is_admin == 1)
                        <li>
                            <a class="nav__link nav__link--admin {{ request()->is('admin*') ? 'is-active' : '' }}"
                               href="{{ url('/admin') }}">Admin Panel</a>
                        </li>
                    @endif
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="nav__link nav__link--logout" type="submit">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>

            {{-- Right actions --}}
            <div class="nav__actions">
                <button class="icon-btn" type="button"
                        data-search-toggle aria-expanded="false" aria-controls="search-panel"
                        aria-label="Search products">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" aria-hidden="true">
                        <circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/>
                    </svg>
                </button>

                <a class="icon-btn" href="{{ url('/cart') }}" aria-label="Shopping bag, {{ $bagCount }} item(s)">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M6 8h12l-1 12H7L6 8Z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/>
                    </svg>
                    @if($bagCount > 0)
                        <span class="icon-btn__badge">{{ $bagCount }}</span>
                    @endif
                </a>

                <a class="icon-btn icon-btn--social" href="https://instagram.com/eshas_rokomaris2" target="_blank" rel="noopener"
                   aria-label="Esha's Rokomaris 2 on Instagram">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>

    {{-- Collapsible search --}}
    <div class="search-panel" id="search-panel" data-search-panel>
        <div class="brand-container">
            <form action="{{ url('/search') }}" method="GET" role="search">
                <label class="sr-only" for="site-search">Search products</label>
                <input id="site-search" type="search" name="q" placeholder="Search for a piece or a category…" required>
                <button class="btn" type="submit">Search</button>
            </form>
        </div>
    </div>

    {{-- Mobile drawer --}}
    <div class="nav__drawer" id="primary-drawer" data-nav-drawer>
        <ul>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ $navPrefix }}#products">Shop</a></li>
            <li><a href="{{ $navPrefix }}#about">About</a></li>
            <li><a href="{{ $navPrefix }}#contact">Contact</a></li>

            @auth
                @if(auth()->user()->is_admin == 1)
                    <li><a href="{{ url('/admin') }}">Admin Panel</a></li>
                @endif

                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="drawer-logout" type="submit">Logout</button>
                    </form>
                </li>
            @endauth

            <li>
                @auth
                    <a href="{{ url('/orders') }}">My Orders</a>
                @else
                    <a href="{{ url('/login') }}">Sign In</a>
                @endauth
            </li>
        </ul>
    </div>
</header>
