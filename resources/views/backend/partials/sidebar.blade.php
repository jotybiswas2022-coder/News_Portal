@php
use Illuminate\Support\Str;
@endphp

<!-- Top Bar (Desktop + Mobile) -->
<nav class="navbar navbar-expand-lg shadow-sm py-0" style="background: #ffffff; border-bottom: 1px solid #eef2f7;">
    <div class="container-fluid px-4">
        <!-- Mobile Menu Toggle -->
        <button class="btn btn-outline-secondary d-lg-none me-3" type="button" id="menuToggle" aria-label="Toggle menu">
            <i class="bi bi-list fs-5"></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center fw-semibold fs-4 text-dark" href="/admin" style="padding-left: 0;">
            <i class="bi bi-speedometer2 me-2 fs-2 text-primary"></i>
            <span>Admin Dashboard</span>
        </a>

        <!-- Desktop Top Nav Links -->
        <div class="collapse navbar-collapse d-none d-lg-flex" id="navbarTopNav">
            <ul class="navbar-nav ms-auto gap-1 align-items-center">
                <li class="nav-item">
                    <a class="nav-link top-nav-link d-flex align-items-center gap-2 px-3 py-2 rounded-pill {{ request()->is('/') ? 'active-link' : '' }}" href="/">
                        <i class="bi bi-house-door fs-5"></i>
                        <span class="d-none d-sm-inline">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link top-nav-link d-flex align-items-center gap-2 px-3 py-2 rounded-pill {{ request()->is('orders') ? 'active-link' : '' }}" href="/orders">
                        <i class="bi bi-bag-check fs-5"></i>
                        <span class="d-none d-sm-inline">Orders</span>
                    </a>
                </li>

                @auth
                    @if(auth()->user()->is_admin == 1)
                        <li class="nav-item">
                            <a class="nav-link top-nav-link d-flex align-items-center gap-2 px-3 py-2 rounded-pill {{ Str::startsWith(request()->path(), 'admin') ? 'active-link' : '' }}" href="/admin">
                                <i class="bi bi-speedometer2 fs-5"></i>
                                <span class="d-none d-sm-inline">Admin Panel</span>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link top-nav-link d-flex align-items-center gap-2 px-3 py-2 rounded-pill text-danger fw-medium">
                                <i class="bi bi-box-arrow-right fs-5"></i>
                                <span class="d-none d-sm-inline">Logout</span>
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link top-nav-link d-flex align-items-center gap-2 px-3 py-2 rounded-pill {{ request()->is('login') ? 'active-link' : '' }}" href="/login">
                            <i class="bi bi-person-circle fs-5"></i>
                            <span class="d-none d-sm-inline">Login</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded-pill signup-btn text-white" href="/register">
                            <i class="bi bi-person-plus fs-5"></i>
                            <span class="d-none d-sm-inline">Signup</span>
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Mobile Menu Overlay -->
<div class="menu-overlay d-lg-none" id="menuOverlay"></div>

<!-- Sidebar + Content -->
<div class="row m-0" style="min-height: 100vh;">

    <!-- Desktop Sidebar (Hidden on Mobile) -->
    <div class="col-md-3 p-0 d-none d-lg-block">
        <div class="sidebar">
            <!-- Sidebar Brand -->
            <div class="sidebar-brand d-flex align-items-center px-4 py-4 mb-4 border-bottom" style="border-color: rgba(255,255,255,0.1) !important;">
                <i class="bi bi-speedometer2 me-2 fs-1 text-primary"></i>
                <span class="fw-bold fs-4 text-white">Admin</span>
            </div>

            <!-- Navigation -->
            <nav class="px-3">
                <ul class="sidebar-menu">
                    <li>
                        <a href="/admin" class="{{ request()->is('admin') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/sliders" class="{{ request()->is('admin/sliders') ? 'active' : '' }}">
                            <i class="bi bi-images"></i>
                            <span>Sliders</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/product" class="{{ request()->is('admin/product') ? 'active' : '' }}">
                            <i class="bi bi-box-seam"></i>
                            <span>Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/category" class="{{ request()->is('admin/category') ? 'active' : '' }}">
                            <i class="bi bi-tags"></i>
                            <span>Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/orders" class="{{ request()->is('admin/orders') ? 'active' : '' }}">
                            <i class="bi bi-cart-check"></i>
                            <span>Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/customers" class="{{ request()->is('admin/customers') ? 'active' : '' }}">
                            <i class="bi bi-people"></i>
                            <span>Customers</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/contacts" class="{{ request()->is('admin/contacts') ? 'active' : '' }}">
                            <i class="bi bi-envelope"></i>
                            <span>Contacts</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/profit_loss" class="{{ request()->is('admin/profit_loss') ? 'active' : '' }}">
                            <i class="bi bi-currency-dollar"></i>
                            <span>Profit & Loss</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/settings" class="{{ request()->is('admin/settings') ? 'active' : '' }}">
                            <i class="bi bi-gear"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Sidebar Footer -->
            <div class="sidebar-footer mt-auto p-4 border-top" style="border-color: rgba(255,255,255,0.1) !important;">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; flex-shrink: 0;">
                        <i class="bi bi-person-fill text-white fs-5"></i>
                    </div>
                    <div class="flex-grow-1 min-width-0">
                        <div class="text-white fw-medium text-truncate">{{ auth()->user()->name ?? 'Admin' }}</div>
                        <div class="text-muted small text-truncate">{{ auth()->user()->email ?? 'admin@example.com' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Slide-in Menu (Hidden on Desktop) -->
    <div class="col-md-3 p-0 d-lg-none">
        <div class="mobile-menu" id="mobileMenu">
            <div class="mobile-menu-header d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                <h6 class="mb-0 fw-bold">Menu</h6>
                <button class="btn btn-sm btn-outline-secondary" id="menuClose" aria-label="Close menu">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <div class="mobile-menu-section p-2">
                <h6 class="text-muted text-uppercase small fw-bold mb-1 px-1">Navigation</h6>
                <ul class="nav flex-column gap-1">
                    <li>
                        <a class="nav-link d-flex align-items-center gap-2 text-dark px-3 py-2 {{ request()->is('/') ? 'active' : '' }}" href="/">
                            <i class="bi bi-house-door fs-6"></i> Home
                        </a>
                    </li>
                    <li>
                        <a class="nav-link d-flex align-items-center gap-2 text-dark px-3 py-2 {{ request()->is('orders') ? 'active' : '' }}" href="/orders">
                            <i class="bi bi-bag-check fs-6"></i> Orders
                        </a>
                    </li>

                    @auth
                        @if(auth()->user()->is_admin == 1)
                            <li>
                                <a class="nav-link d-flex align-items-center gap-2 text-dark px-3 py-2 {{ Str::startsWith(request()->path(), 'admin') ? 'active' : '' }}" href="/admin">
                                    <i class="bi bi-speedometer2 fs-6"></i> Admin Panel
                                </a>
                            </li>
                        @endif
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-danger fw-semibold d-flex align-items-center gap-2 w-100 text-start px-3 py-2">
                                    <i class="bi bi-box-arrow-right fs-6"></i> Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li>
                            <a class="nav-link d-flex align-items-center gap-2 text-dark px-3 py-2 {{ request()->is('login') ? 'active' : '' }}" href="/login">
                                <i class="bi bi-person-circle fs-6"></i> Login
                            </a>
                        </li>
                        <li>
                            <a class="nav-link d-flex align-items-center gap-2 text-white signup-btn px-3 py-2 rounded mx-3" href="/register">
                                <i class="bi bi-person-plus me-1"></i> Signup
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>

            <div class="mobile-menu-section pt-1 pb-2" style="padding-top: 12px !important;">
                <h6 class="text-muted text-uppercase small fw-bold mb-1 px-1">Admin Panel</h6>
                <ul class="sidebar-menu">
                    <li>
                        <a href="/admin" class="{{ request()->is('admin') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/sliders" class="{{ request()->is('admin/sliders') ? 'active' : '' }}">
                            <i class="bi bi-images"></i>
                            <span>Sliders</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/product" class="{{ request()->is('admin/product') ? 'active' : '' }}">
                            <i class="bi bi-box-seam"></i>
                            <span>Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/category" class="{{ request()->is('admin/category') ? 'active' : '' }}">
                            <i class="bi bi-tags"></i>
                            <span>Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/orders" class="{{ request()->is('admin/orders') ? 'active' : '' }}">
                            <i class="bi bi-cart-check"></i>
                            <span>Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/customers" class="{{ request()->is('admin/customers') ? 'active' : '' }}">
                            <i class="bi bi-people"></i>
                            <span>Customers</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/contacts" class="{{ request()->is('admin/contacts') ? 'active' : '' }}">
                            <i class="bi bi-envelope"></i>
                            <span>Contacts</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/profit_loss" class="{{ request()->is('admin/profit_loss') ? 'active' : '' }}">
                            <i class="bi bi-currency-dollar"></i>
                            <span>Profit & Loss</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/settings" class="{{ request()->is('admin/settings') ? 'active' : '' }}">
                            <i class="bi bi-gear"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="col-md-9 p-4">
        @yield('content')
    </div>
</div>

<style>
/* ===== DESKTOP TOPBAR ===== */
.navbar { min-height: 64px; }
.navbar-brand { font-size: 1.25rem; letter-spacing: -0.02em; }

.top-nav-link {
    font-weight: 500;
    color: #475569;
    transition: all 0.2s ease;
}
.top-nav-link:hover {
    color: #4f46e5;
    background: rgba(79,70,229,0.08);
}
.top-nav-link.active-link {
    color: #4f46e5;
    background: rgba(79,70,229,0.12);
}

/* Signup button */
.signup-btn {
    background: linear-gradient(135deg, #4f46e5, #6366f1);
    transition: all 0.2s;
}
.signup-btn:hover {
    opacity: 0.9;
    transform: translateY(-1px);
}

/* ===== DESKTOP SIDEBAR ===== */
.sidebar {
    background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
    min-height: 100vh;
    box-shadow: 4px 0 30px rgba(0,0,0,0.15);
    padding: 0;
    border-right: 1px solid rgba(255,255,255,0.05);
    display: flex;
    flex-direction: column;
}

.sidebar-menu {
    list-style: none;
    padding: 0 8px;
    margin: 0;
    flex: 1;
}

.sidebar-menu li { margin-bottom: 4px; }

.sidebar-menu a {
    display: flex;
    align-items: center;
    gap: 14px;
    color: #94a3b8;
    padding: 14px 16px;
    font-weight: 500;
    font-size: 0.9rem;
    border-radius: 10px;
    transition: all 0.2s ease;
    border-left: 3px solid transparent;
}
.sidebar-menu a i { 
    font-size: 1.1rem; 
    width: 24px; 
    text-align: center;
    transition: transform 0.2s ease;
}
.sidebar-menu a:hover {
    background: rgba(255,255,255,0.05);
    color: #f1f5f9;
    border-left-color: #4f46e5;
}
.sidebar-menu a:hover i {
    transform: scale(1.1);
}
.sidebar-menu a.active {
    background: linear-gradient(90deg, rgba(79,70,229,0.2), transparent);
    color: #fff;
    border-left-color: #4f46e5;
}
.sidebar-menu a.active i {
    color: #a5b4fc;
}

/* Sidebar Brand */
.sidebar-brand {
    background: rgba(255,255,255,0.02);
}

/* Sidebar Footer */
.sidebar-footer { background: rgba(255,255,255,0.02); }

/* ===== MOBILE MENU ===== */
.mobile-menu {
    position: fixed;
    top: 0;
    left: -320px;
    width: 320px;
    height: 100vh;
    background: #fff;
    z-index: 1040;
    box-shadow: 4px 0 30px rgba(0,0,0,0.15);
    transition: left 0.3s ease;
    display: flex;
    flex-direction: column;
    overflow-y: auto;
}
.mobile-menu.show { left: 0; }
.mobile-menu-header { background: #fafafa; }
.mobile-menu-section { flex: 0 0 auto; }
.mobile-menu-section + .mobile-menu-section { padding-top: 8px; }

.mobile-menu .sidebar-menu li { margin-bottom: 4px; }
.mobile-menu .sidebar-menu a {
    padding: 12px 16px;
    gap: 12px;
    border-radius: 8px;
}
.mobile-menu .sidebar-menu a i { font-size: 1.1rem; }

.menu-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 1035;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}
.menu-overlay.show {
    opacity: 1;
    visibility: visible;
}

@media (max-width: 991.98px) {
    .col-md-9 { width: 100%; }
    .col-md-3 { width: 100%; padding: 0; }
}

@media (min-width: 992px) {
    .mobile-menu { display: none !important; }
    .menu-overlay { display: none !important; }
    #menuToggle { display: none !important; }
}

/* Responsive tweaks */
@media (max-width: 768px) {
    .navbar-brand span { font-size: 1rem; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('menuToggle');
    const closeBtn = document.getElementById('menuClose');
    const menu = document.getElementById('mobileMenu');
    const overlay = document.getElementById('menuOverlay');

    if (!toggle || !menu || !overlay) return;

    function openMenu() {
        menu.classList.add('show');
        overlay.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
        menu.classList.remove('show');
        overlay.classList.remove('show');
        document.body.style.overflow = '';
    }

    toggle.addEventListener('click', openMenu);
    closeBtn.addEventListener('click', closeMenu);
    overlay.addEventListener('click', closeMenu);

    // Close on link click
    menu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    // Close on escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && menu.classList.contains('show')) {
            closeMenu();
        }
    });

    // Handle resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 992 && menu.classList.contains('show')) {
            closeMenu();
        }
    });
});
</script>