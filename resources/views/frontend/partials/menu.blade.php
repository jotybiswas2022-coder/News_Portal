<nav class="navbar-main" id="navbar">
    <!-- Logo -->
    <a href="/" class="nav-logo">{{ config('app.name', 'Portfolio') }}</a>

    <!-- Nav Links -->
    <ul class="nav-links" id="navLinks">
        <li><a href="/" class="{{ request()->is('/') ? 'nav-active' : '' }}"><i class="bi bi-house-fill me-1"></i>Home</a></li>
        <li><a href="/#about"><i class="bi bi-person-fill me-1"></i>About</a></li>
        <li><a href="/#skills"><i class="bi bi-lightning-fill me-1"></i>Skills</a></li>
        <li><a href="/#projects"><i class="bi bi-folder-fill me-1"></i>Projects</a></li>
        <li><a href="/#contact"><i class="bi bi-envelope-fill me-1"></i>Contact</a></li>
        <li><a href="{{ url('/blog') }}" class="{{ request()->is('blog') || request()->is('blog/*') ? 'nav-active' : '' }}"><i class="bi bi-journal-text me-1"></i>Blog</a></li>

        @auth
            @if(auth()->user()->is_admin == 1)
                <li>
                    <a href="/admin" class="nav-action nav-action-admin">
                        <i class="bi bi-speedometer2 me-1"></i> Admin
                    </a>
                </li>
            @endif
            <li>
                <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                    @csrf
                    <button type="submit" class="nav-action nav-action-logout" style="background:none; border:none; cursor:pointer; font-family:inherit; font-size:inherit; display:inline-flex; align-items:center; gap:0.4rem; padding:0.45rem 1rem; border-radius:8px; font-weight:600; font-size:0.85rem;">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </button>
                </form>
            </li>
        @else
            <li>
                <a href="/login" class="nav-action nav-action-login">
                    <i class="bi bi-person-circle me-1"></i> Login
                </a>
            </li>
            <li>
                <a href="/register" class="nav-action nav-action-signup">
                    <i class="bi bi-person-plus me-1"></i> Signup
                </a>
            </li>
        @endauth
    </ul>

    <!-- Hamburger -->
    <button class="hamburger" id="hamburger" aria-label="Toggle menu">
        <span></span>
        <span></span>
        <span></span>
    </button>
</nav>

<!-- Spacer for fixed navbar -->
<div style="height: 0;"></div>
