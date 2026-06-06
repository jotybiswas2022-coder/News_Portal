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
    /* Theme Toggle */
    .theme-toggle-btn {
        width: 36px; height: 36px;
        border-radius: 50%; border: 1px solid rgba(59, 130, 246, 0.25);
        background: rgba(59, 130, 246, 0.08);
        color: #60a5fa; font-size: 1rem;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        padding: 0; margin-left: 0.5rem;
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

    .nav-links { display: flex; gap: 0.5rem; list-style: none; align-items: center; margin: 0; padding: 0; }    .nav-links a { color: #94a3b8; font-weight: 500; font-size: 0.88rem;
    html.light-theme .nav-links a { color: #475569; }
        padding: 0.5rem 1rem; border-radius: 8px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        text-decoration: none;
    }
    .nav-links a:hover { color: #60a5fa; background: rgba(59, 130, 246, 0.08); }
    .nav-links a.nav-active { color: #3b82f6; background: rgba(59, 130, 246, 0.1); }
    .nav-action {
        display: inline-flex !important; align-items: center; gap: 0.4rem;
        padding: 0.45rem 1rem !important;
        border-radius: 8px !important; font-weight: 600 !important;
        font-size: 0.85rem !important;
    }
    .nav-action-login { color: #60a5fa !important; border: 1px solid rgba(59, 130, 246, 0.25); text-decoration: none !important; }
    .nav-action-login:hover { background: rgba(59, 130, 246, 0.12) !important; border-color: #3b82f6 !important; }
    .nav-action-signup { background: linear-gradient(135deg, #3b82f6, #2563eb) !important; color: #fff !important; border: none !important; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.25); text-decoration: none !important; }
    .nav-action-signup:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4) !important; }
    .nav-action-admin { background: rgba(59, 130, 246, 0.1) !important; color: #60a5fa !important; border: 1px solid rgba(59, 130, 246, 0.2) !important; text-decoration: none !important; }
    .nav-action-logout { color: #f87171 !important; border: 1px solid rgba(248, 113, 113, 0.2) !important; text-decoration: none !important; }
    .nav-action-logout:hover { background: rgba(248, 113, 113, 0.1) !important; }
    .hamburger {
        display: none; flex-direction: column; gap: 5px;
        cursor: pointer; z-index: 1001; padding: 5px;
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
    @media (max-width: 768px) {
        .nav-links {
            display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(10, 15, 30, 0.98);
            flex-direction: column; align-items: center; justify-content: center;
            gap: 1.5rem; backdrop-filter: blur(20px);
        }
        html.light-theme .nav-links { background: rgba(248, 250, 252, 0.98); }
        .nav-links.open { display: flex; }
        .nav-links a { font-size: 1.2rem; padding: 0.7rem 1.5rem; }
        .hamburger { display: flex; }
    }
    /* Language Switcher */
    .lang-switcher { margin-left: 0.5rem; }
    .lang-btn {
        color: #64748b; font-size: 0.78rem; font-weight: 600;
        padding: 3px 6px; border-radius: 4px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        text-decoration: none !important;
        letter-spacing: 0.3px;
    }
    .lang-btn:hover { color: #60a5fa; }
    .lang-btn.active {
        color: #3b82f6;
        background: rgba(59, 130, 246, 0.12);
    }
    html { padding-top: 0 !important; }
    body { padding-top: 0 !important; }
</style>
<nav class="navbar-main" id="navbar">
    <!-- Logo -->
    <a href="/" class="nav-logo">{{ config('app.name', 'Portfolio') }}</a>

    <!-- Nav Links -->
    <ul class="nav-links" id="navLinks">
        <li><a href="/" class="{{ request()->is('/') ? 'nav-active' : '' }}"><i class="bi bi-house-fill me-1"></i>{{ __('messages.home') }}</a></li>
        <li><a href="/#about"><i class="bi bi-person-fill me-1"></i>{{ __('messages.about') }}</a></li>
        <li><a href="/#services"><i class="bi bi-gear me-1"></i>{{ __('messages.services') }}</a></li>
        <li><a href="/#skills"><i class="bi bi-lightning-fill me-1"></i>{{ __('messages.skills') }}</a></li>
        <li><a href="/#projects"><i class="bi bi-folder-fill me-1"></i>{{ __('messages.projects') }}</a></li>
        <li><a href="/#contact"><i class="bi bi-envelope-fill me-1"></i>{{ __('messages.contact') }}</a></li>
        <li><a href="/#faq"><i class="bi bi-question-circle me-1"></i>FAQ</a></li>
        <li><a href="{{ url('/blog') }}" class="{{ request()->is('blog') || request()->is('blog/*') ? 'nav-active' : '' }}"><i class="bi bi-journal-text me-1"></i>{{ __('messages.blog') }}</a></li>
        <li><button class="theme-toggle-btn" id="themeToggle" aria-label="{{ __('messages.toggle_theme') }}"><i class="bi bi-sun-fill"></i></button></li>

        @auth
            @if(auth()->user()->is_admin == 1)
                <li>
                    <a href="/admin" class="nav-action nav-action-admin">
                        <i class="bi bi-speedometer2 me-1"></i> {{ __('messages.admin') }}
                    </a>
                </li>
            @endif
            <li>
                <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                    @csrf
                    <button type="submit" class="nav-action nav-action-logout" style="background:none; border:none; cursor:pointer; font-family:inherit; font-size:inherit; display:inline-flex; align-items:center; gap:0.4rem; padding:0.45rem 1rem; border-radius:8px; font-weight:600; font-size:0.85rem;">
                        <i class="bi bi-box-arrow-right me-1"></i> {{ __('messages.logout') }}
                    </button>
                </form>
            </li>
        @else
            <li>
                <a href="/login" class="nav-action nav-action-login">
                    <i class="bi bi-person-circle me-1"></i> {{ __('messages.login') }}
                </a>
            </li>
            <li>
                <a href="/register" class="nav-action nav-action-signup">
                    <i class="bi bi-person-plus me-1"></i> {{ __('messages.signup') }}
                </a>
            </li>
        @endauth
        <!-- Language Switcher -->
        <li class="nav-item" style="list-style: none;">
            <div class="lang-switcher d-flex align-items-center" style="gap: 2px;">
                <a href="{{ route('language.switch', 'en') }}" 
                   class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}"
                   title="{{ __('messages.english') }}">
                    EN
                </a>
                <span style="color: #475569; font-size: 0.75rem;">|</span>
                <a href="{{ route('language.switch', 'bn') }}" 
                   class="lang-btn {{ app()->getLocale() == 'bn' ? 'active' : '' }}"
                   title="{{ __('messages.bengali') }}">
                    বাংলা
                </a>
            </div>
        </li>
    </ul>

    <!-- Hamburger -->
    <button class="hamburger" id="hamburger" aria-label="{{ __('messages.toggle_theme') }}">
        <span></span>
        <span></span>
        <span></span>
    </button>
</nav>

<!-- Spacer for fixed navbar -->
<div style="height: 0;"></div>
