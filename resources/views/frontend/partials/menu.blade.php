<style>
    /* ===== NAVBAR (SHARED ACROSS ALL PAGES) ===== */
    .navbar-main {
        position: fixed; top: 0; left: 0; right: 0;
        z-index: 1000; padding: 1rem 2rem;
        display: flex; justify-content: space-between; align-items: center;
        background: rgba(10, 15, 30, 0.88);
        backdrop-filter: blur(24px) saturate(1.4);
        -webkit-backdrop-filter: blur(24px) saturate(1.4);
        border-bottom: 1px solid rgba(59, 130, 246, 0.12);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    html.light-theme .navbar-main {
        background: rgba(248, 250, 252, 0.92);
        border-bottom: 1px solid rgba(59, 130, 246, 0.12);
    }
    .navbar-main.scrolled {
        padding: 0.6rem 2rem;
        background: rgba(10, 15, 30, 0.96);
        border-bottom: 1px solid rgba(59, 130, 246, 0.25);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
    }
    html.light-theme .navbar-main.scrolled {
        background: rgba(248, 250, 252, 0.96);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
    }
    .nav-logo {
        font-size: 1.4rem; font-weight: 800;
        background: linear-gradient(135deg, #3b82f6, #60a5fa, #a78bfa, #3b82f6);
        background-size: 300% 300%;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: navGradient 4s ease infinite;
        letter-spacing: -0.5px;
        text-decoration: none;
    }
    @keyframes navGradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* ===== DESKTOP NAV LINKS ===== */
    .nav-links { display: flex; gap: 0.25rem; list-style: none; align-items: center; margin: 0; padding: 0; }
    .nav-links a { 
        color: #94a3b8; font-weight: 500; font-size: 0.88rem;
        padding: 0.5rem 0.9rem; border-radius: 8px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        text-decoration: none; white-space: nowrap;
    }
    html.light-theme .nav-links a { color: #475569; }
    .nav-links a:hover { color: #60a5fa; background: rgba(59, 130, 246, 0.08); }
    .nav-links a.nav-active { color: #3b82f6; background: rgba(59, 130, 246, 0.12); }

    .nav-action-login { 
        color: #60a5fa !important; border: 1px solid rgba(59, 130, 246, 0.25); 
        padding: 0.45rem 1rem !important; border-radius: 8px !important; font-weight: 600 !important;
    }
    .nav-action-login:hover { background: rgba(59, 130, 246, 0.12) !important; border-color: #3b82f6 !important; }
    .nav-action-signup { 
        background: linear-gradient(135deg, #3b82f6, #2563eb) !important; color: #fff !important; 
        border: none !important; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.25);
        padding: 0.45rem 1rem !important; border-radius: 8px !important; font-weight: 600 !important;
    }
    .nav-action-signup:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4) !important; }
    .nav-action-admin { 
        background: rgba(59, 130, 246, 0.1) !important; color: #60a5fa !important; 
        border: 1px solid rgba(59, 130, 246, 0.2) !important; font-weight: 600 !important;
    }
    .nav-action-logout { 
        color: #f87171 !important; border: 1px solid rgba(248, 113, 113, 0.2) !important; font-weight: 600 !important;
    }
    .nav-action-logout:hover { background: rgba(248, 113, 113, 0.1) !important; }

    /* ===== RIGHT GROUP ===== */
    .nav-right-group {
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    /* Theme Toggle */
    .theme-toggle-btn {
        width: 36px; height: 36px;
        border-radius: 50%; border: 1px solid rgba(59, 130, 246, 0.25);
        background: rgba(59, 130, 246, 0.08);
        color: #60a5fa; font-size: 1rem;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        padding: 0;
    }
    .theme-toggle-btn:hover {
        background: rgba(59, 130, 246, 0.18);
        transform: scale(1.1);
    }
    html.light-theme .theme-toggle-btn {
        color: #f59e0b;
        border-color: rgba(245, 158, 11, 0.3);
        background: rgba(245, 158, 11, 0.1);
    }
    html.light-theme .theme-toggle-btn:hover {
        background: rgba(245, 158, 11, 0.2);
    }

    /* ===== HAMBURGER ===== */
    .hamburger {
        display: none; flex-direction: column; gap: 5px;
        cursor: pointer; z-index: 1002; padding: 5px;
        background: none; border: none;
    }
    .hamburger span {
        width: 24px; height: 2px; background: #e2e8f0;
        border-radius: 2px; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        transform-origin: center;
    }
    html.light-theme .hamburger span { background: #334155; }
    .hamburger.active span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
    .hamburger.active span:nth-child(2) { opacity: 0; transform: scaleX(0); }
    .hamburger.active span:nth-child(3) { transform: rotate(-45deg) translate(5px, -5px); }

    /* ===== LANGUAGE SWITCHER ===== */
    .lang-switcher { display: flex; align-items: center; gap: 2px; margin: 0 0.3rem; }
    .lang-btn {
        color: #64748b; font-size: 0.78rem; font-weight: 600;
        padding: 3px 6px; border-radius: 4px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        text-decoration: none !important;
        letter-spacing: 0.3px;
    }
    .lang-btn:hover { color: #60a5fa; }
    .lang-btn.active { color: #3b82f6; background: rgba(59, 130, 246, 0.12); }
    .lang-divider { color: #475569; font-size: 0.75rem; }

    /* ===== MOBILE: DRAWER + BACKDROP ===== */
    .mobile-backdrop {
        position: fixed; top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1001;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        cursor: pointer;
    }
    .mobile-backdrop.show {
        opacity: 1;
        visibility: visible;
    }
    html.light-theme .mobile-backdrop {
        background: rgba(0, 0, 0, 0.3);
    }

    .mobile-drawer {
        position: fixed;
        top: 0; right: 0;
        width: 85%; max-width: 360px;
        height: 100vh;
        z-index: 1002;
        background: rgba(10, 15, 30, 0.98);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        display: flex;
        flex-direction: column;
        transform: translateX(100%);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: -10px 0 50px rgba(0, 0, 0, 0.5);
        overflow-y: auto;
    }
    html.light-theme .mobile-drawer {
        background: rgba(248, 250, 252, 0.98);
    }
    .mobile-drawer.open {
        transform: translateX(0);
    }

    /* Drawer Header */
    .drawer-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.2rem;
        border-bottom: 1px solid rgba(59, 130, 246, 0.1);
        flex-shrink: 0;
    }
    .drawer-logo {
        font-size: 1.1rem;
        font-weight: 800;
        background: linear-gradient(135deg, #3b82f6, #60a5fa, #a78bfa, #3b82f6);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: navGradient 4s ease infinite;
        letter-spacing: -0.5px;
        text-decoration: none;
    }
    .drawer-close {
        width: 34px; height: 34px;
        border-radius: 10px;
        border: 1px solid rgba(59, 130, 246, 0.2);
        background: rgba(59, 130, 246, 0.06);
        color: var(--text-muted, #64748b);
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 0;
    }
    .drawer-close:hover {
        background: rgba(59, 130, 246, 0.15);
        color: #60a5fa;
        transform: rotate(90deg);
    }

    /* Drawer Body */
    .drawer-body {
        flex: 1;
        padding: 0.8rem 1rem 1rem;
        display: flex;
        flex-direction: column;
    }
    .drawer-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .drawer-nav li {
        margin-bottom: 2px;
    }
    .drawer-nav a,
    .drawer-nav button {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.7rem 0.8rem;
        border-radius: 10px;
        font-size: 0.95rem;
        font-weight: 500;
        color: var(--text-secondary, #94a3b8);
        text-decoration: none;
        transition: all 0.2s ease;
        width: 100%;
        background: none;
        border: none;
        cursor: pointer;
        font-family: inherit;
        text-align: left;
    }
    .drawer-nav a i,
    .drawer-nav button i {
        width: 22px;
        text-align: center;
        font-size: 1.05rem;
        color: var(--text-muted, #64748b);
        transition: color 0.2s;
    }
    .drawer-nav a:hover {
        background: rgba(59, 130, 246, 0.08);
        color: #60a5fa;
    }
    .drawer-nav a:hover i {
        color: #60a5fa;
    }
    .drawer-nav a.active {
        background: rgba(59, 130, 246, 0.12);
        color: #3b82f6;
    }
    .drawer-nav a.active i {
        color: #3b82f6;
    }

    /* Divider */
    .drawer-divider {
        height: 1px;
        background: rgba(59, 130, 246, 0.1);
        margin: 0.6rem 0;
    }

    /* Auth buttons in drawer */
    .drawer-login-btn {
        justify-content: center !important;
        background: rgba(59, 130, 246, 0.08) !important;
        border: 1px solid rgba(59, 130, 246, 0.25) !important;
        color: #60a5fa !important;
        font-weight: 600 !important;
    }
    .drawer-login-btn:hover {
        background: rgba(59, 130, 246, 0.15) !important;
    }
    .drawer-signup-btn {
        justify-content: center !important;
        background: linear-gradient(135deg, #3b82f6, #2563eb) !important;
        border: none !important;
        color: #fff !important;
        font-weight: 600 !important;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }
    .drawer-signup-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4) !important;
    }
    .drawer-logout-btn {
        color: #f87171 !important;
    }
    .drawer-logout-btn:hover {
        background: rgba(248, 113, 113, 0.08) !important;
        color: #f87171 !important;
    }
    .drawer-admin-btn {
        color: #60a5fa !important;
        border: 1px solid rgba(59, 130, 246, 0.2) !important;
    }
    .drawer-admin-btn:hover {
        background: rgba(59, 130, 246, 0.1) !important;
    }

    /* Drawer Footer (lang) */
    .drawer-footer {
        margin-top: auto;
        padding-top: 0.8rem;
        border-top: 1px solid rgba(59, 130, 246, 0.08);
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }

    /* ===== MOBILE RESPONSIVE ===== */
    @media (max-width: 768px) {
        .navbar-main {
            padding: 0.8rem 1.2rem;
        }
        .navbar-main.scrolled {
            padding: 0.5rem 1.2rem;
        }
        .nav-logo {
            font-size: 1.2rem;
        }
        .nav-links {
            display: none !important;
        }
        .hamburger {
            display: flex;
        }
    }

    @media (max-width: 480px) {
        .navbar-main {
            padding: 0.65rem 1rem;
        }
        .navbar-main.scrolled {
            padding: 0.4rem 1rem;
        }
        .nav-logo {
            font-size: 1.05rem;
        }
        .theme-toggle-btn {
            width: 32px; height: 32px; font-size: 0.85rem;
        }
        .lang-btn { font-size: 0.7rem; padding: 2px 4px; }
        .mobile-drawer { width: 100%; max-width: none; }
        .drawer-nav a, .drawer-nav button { font-size: 0.9rem; padding: 0.6rem 0.7rem; }
    }

    /* ===== BODY SCROLL LOCK ===== */
    body.menu-open {
        overflow: hidden !important;
    }
</style>

<nav class="navbar-main" id="navbar">
    <!-- Logo -->
    <a href="/" class="nav-logo">{{ config('app.name', 'Portfolio') }}</a>

    <!-- Desktop Nav Links -->
    <ul class="nav-links" id="navLinks">
        <li><a href="/" class="{{ request()->is('/') ? 'nav-active' : '' }}"><i class="bi bi-house-fill me-1"></i>{{ __('messages.home') }}</a></li>
        <li><a href="/#about"><i class="bi bi-person-fill me-1"></i>{{ __('messages.about') }}</a></li>
        <li><a href="/#services"><i class="bi bi-gear me-1"></i>{{ __('messages.services') }}</a></li>
        <li><a href="/#skills"><i class="bi bi-lightning-fill me-1"></i>{{ __('messages.skills') }}</a></li>
        <li><a href="/#projects"><i class="bi bi-folder-fill me-1"></i>{{ __('messages.projects') }}</a></li>
        <li><a href="/#contact"><i class="bi bi-envelope-fill me-1"></i>{{ __('messages.contact') }}</a></li>
        <li><a href="/#faq"><i class="bi bi-question-circle me-1"></i>FAQ</a></li>
        <li><a href="{{ url('/blog') }}" class="{{ request()->is('blog') || request()->is('blog/*') ? 'nav-active' : '' }}"><i class="bi bi-journal-text me-1"></i>{{ __('messages.blog') }}</a></li>

        @auth
            @if(auth()->user()->is_admin == 1)
                <li><a href="/admin" class="nav-action-admin">{{ __('messages.admin') }}</a></li>
            @endif
            <li>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-action-logout" style="background:none; border:none; cursor:pointer; font-family:inherit; font-size:0.88rem; display:inline-flex; align-items:center; gap:0.4rem; padding:0.45rem 1rem; border-radius:8px; font-weight:600;">
                        {{ __('messages.logout') }}
                    </button>
                </form>
            </li>
        @else
            <li><a href="/login" class="nav-action-login">{{ __('messages.login') }}</a></li>
            <li><a href="/register" class="nav-action-signup">{{ __('messages.signup') }}</a></li>
        @endauth
    </ul>

    <!-- Right Group -->
    <div class="nav-right-group">
        <div class="lang-switcher d-none d-md-flex">
            <a href="{{ route('language.switch', 'en') }}" 
               class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}"
               title="{{ __('messages.english') }}">EN</a>
            <span class="lang-divider">|</span>
            <a href="{{ route('language.switch', 'bn') }}" 
               class="lang-btn {{ app()->getLocale() == 'bn' ? 'active' : '' }}"
               title="{{ __('messages.bengali') }}">বাংলা</a>
        </div>
        <button class="theme-toggle-btn" id="themeToggle" aria-label="{{ __('messages.toggle_theme') }}">
            <i class="bi bi-sun-fill"></i>
        </button>
        <button class="hamburger" id="hamburger" aria-label="Toggle navigation menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<!-- Mobile Backdrop -->
<div class="mobile-backdrop" id="mobileBackdrop"></div>

<!-- Mobile Drawer -->
<div class="mobile-drawer" id="mobileDrawer">
    <!-- Drawer Header -->
    <div class="drawer-header">
        <a href="/" class="drawer-logo">{{ config('app.name', 'Portfolio') }}</a>
        <button class="drawer-close" id="drawerClose" aria-label="Close menu">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <!-- Drawer Body -->
    <div class="drawer-body">
        <ul class="drawer-nav">
            <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}"><i class="bi bi-house-fill"></i>{{ __('messages.home') }}</a></li>
            <li><a href="/#about"><i class="bi bi-person-fill"></i>{{ __('messages.about') }}</a></li>
            <li><a href="/#services"><i class="bi bi-gear"></i>{{ __('messages.services') }}</a></li>
            <li><a href="/#skills"><i class="bi bi-lightning-fill"></i>{{ __('messages.skills') }}</a></li>
            <li><a href="/#projects"><i class="bi bi-folder-fill"></i>{{ __('messages.projects') }}</a></li>
            <li><a href="/#contact"><i class="bi bi-envelope-fill"></i>{{ __('messages.contact') }}</a></li>
            <li><a href="/#faq"><i class="bi bi-question-circle"></i>FAQ</a></li>
            <li><a href="{{ url('/blog') }}" class="{{ request()->is('blog') || request()->is('blog/*') ? 'active' : '' }}"><i class="bi bi-journal-text"></i>{{ __('messages.blog') }}</a></li>
        </ul>

        <div class="drawer-divider"></div>

        <ul class="drawer-nav">
            @auth
                @if(auth()->user()->is_admin == 1)
                    <li><a href="/admin" class="drawer-admin-btn"><i class="bi bi-speedometer2"></i>{{ __('messages.admin') }}</a></li>
                @endif
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="drawer-logout-btn">
                            <i class="bi bi-box-arrow-right"></i>{{ __('messages.logout') }}
                        </button>
                    </form>
                </li>
            @else
                <li><a href="/login" class="drawer-login-btn"><i class="bi bi-person-circle"></i>{{ __('messages.login') }}</a></li>
                <li><a href="/register" class="drawer-signup-btn"><i class="bi bi-person-plus"></i>{{ __('messages.signup') }}</a></li>
            @endauth
        </ul>

        <div class="drawer-footer">
            <a href="{{ route('language.switch', 'en') }}" 
               class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}"
               title="{{ __('messages.english') }}">EN</a>
            <span class="lang-divider">|</span>
            <a href="{{ route('language.switch', 'bn') }}" 
               class="lang-btn {{ app()->getLocale() == 'bn' ? 'active' : '' }}"
               title="{{ __('messages.bengali') }}">বাংলা</a>
        </div>
    </div>
</div>

<script>
// ===== MOBILE MENU TOGGLE =====
(function() {
    var hamburger = document.getElementById('hamburger');
    var drawer = document.getElementById('mobileDrawer');
    var backdrop = document.getElementById('mobileBackdrop');
    var closeBtn = document.getElementById('drawerClose');
    var body = document.body;

    if (!hamburger || !drawer || !backdrop) return;

    function openMenu() {
        drawer.classList.add('open');
        backdrop.classList.add('show');
        hamburger.classList.add('active');
        body.classList.add('menu-open');
    }

    function closeMenu() {
        drawer.classList.remove('open');
        backdrop.classList.remove('show');
        hamburger.classList.remove('active');
        body.classList.remove('menu-open');
    }

    hamburger.addEventListener('click', function(e) {
        e.stopPropagation();
        if (drawer.classList.contains('open')) {
            closeMenu();
        } else {
            openMenu();
        }
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', closeMenu);
    }

    // Click backdrop to close
    backdrop.addEventListener('click', closeMenu);

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && drawer.classList.contains('open')) {
            closeMenu();
        }
    });

    // Close when a nav link is clicked
    drawer.querySelectorAll('a').forEach(function(link) {
        link.addEventListener('click', closeMenu);
    });

    // Close when logout form is submitted (but allow form to submit)
    drawer.querySelectorAll('form').forEach(function(form) {
        form.addEventListener('submit', function() {
            // Small delay to allow form submission
            setTimeout(closeMenu, 100);
        });
    });

    // Prevent clicks inside drawer from closing via backdrop
    drawer.addEventListener('click', function(e) {
        e.stopPropagation();
    });
})();
</script>
