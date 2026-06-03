<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg py-2 dark-navbar" id="mainNavbar">
    <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center fw-bold text-light" href="/">
            <div class="brand-icon-wrap">
                <i class="bi bi-droplet-fill brand-drop"></i>
            </div>
            <span class="brand-text">ব্লাড ব্যাংক</span>
        </a>

        <!-- Theme Toggle -->
        <button class="theme-toggle-btn" id="themeToggle" type="button" title="Toggle theme" aria-label="Toggle dark/light mode">
            <i class="bi bi-sun-fill"></i>
        </button>

        <!-- Animated Hamburger Toggler -->
        <button class="navbar-toggler border-0 custom-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarTopNav"
                aria-controls="navbarTopNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
                id="navToggler">
            <div class="hamburger-lines">
                <span class="hamb-line ham-top"></span>
                <span class="hamb-line ham-mid"></span>
                <span class="hamb-line ham-bot"></span>
            </div>
        </button>

        <!-- Top Nav Links -->
        <div class="collapse navbar-collapse" id="navbarTopNav">
            <!-- Mobile-only theme toggle inside collapse -->
            <div class="mobile-theme-toggle d-lg-none text-center mb-3">
                <button class="theme-toggle-btn mobile" id="mobileThemeToggle" type="button" title="Toggle theme">
                    <i class="bi bi-sun-fill"></i>
                    <span class="ms-2">Theme</span>
                </button>
            </div>
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

                <li class="nav-item nav-link-wrap">
                    <a class="nav-link top-nav-link {{ request()->is('profile') ? 'active-link' : '' }}" href="{{ url('/profile') }}">
                        <i class="bi bi-person-circle me-1"></i> My Profile
                        <span class="link-underline"></span>
                    </a>
                </li>

                @auth
                    @if(auth()->user()->is_admin == 1)
                        <li class="nav-item nav-link-wrap">
                            <a class="nav-link top-nav-link {{ request()->is('admin') ? 'active-link' : '' }}" href="/admin">
                                <i class="bi bi-speedometer2 me-1"></i> Admin Panel
                                <span class="link-underline"></span>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item nav-link-wrap">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                            @csrf
                            <button type="submit" class="btn-logout w-100 text-start">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item nav-link-wrap">
                        <a class="nav-link top-nav-link {{ request()->is('login') ? 'active-link' : '' }}" href="/login">
                            <i class="bi bi-person-circle me-1"></i> Login
                            <span class="link-underline"></span>
                        </a>
                    </li>

                    <li class="nav-item nav-link-wrap">
                        <a class="nav-link signup-btn text-center" href="/register">
                            <i class="bi bi-person-plus me-1"></i> Signup
                        </a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

<!-- ===== CSS ===== -->
<style>
/* ===== Navbar Base ===== */
.dark-navbar {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    padding: 14px 0;
}

/* ===== Scroll Effect (glassmorphism) ===== */
.dark-navbar.navbar-scrolled {
    background: rgba(26, 26, 46, 0.92);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    padding: 8px 0;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.25);
    border-bottom: 1px solid rgba(255, 255, 255, 0.06);
}

/* ===== Brand ===== */
.navbar-brand {
    gap: 10px;
    display: flex;
    align-items: center;
    font-size: 1.4rem !important;
}

.brand-icon-wrap {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #dc2626, #ef4444);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 2px 12px rgba(220, 38, 38, 0.35);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.navbar-brand:hover .brand-icon-wrap {
    transform: scale(1.05) rotate(-5deg);
    box-shadow: 0 4px 20px rgba(220, 38, 38, 0.5);
}

.brand-drop {
    font-size: 1.3rem !important;
    color: #fff !important;
    animation: brand-drop-pulse 3s ease-in-out infinite;
}

@keyframes brand-drop-pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.15); }
}

.brand-text {
    font-size: 1.3rem;
    font-weight: 800;
    background: linear-gradient(135deg, #fff 60%, rgba(255,255,255,0.7));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* ===== Nav Links ===== */
.nav-link-wrap {
    position: relative;
}

.top-nav-link {
    color: rgba(255,255,255,0.8) !important;
    font-weight: 500;
    padding: 8px 18px !important;
    border-radius: 10px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    font-size: 0.92rem;
}

.top-nav-link:hover {
    color: #fff !important;
    background: rgba(255,255,255,0.08);
    transform: translateY(-1px);
}

/* ===== Animated Underline ===== */
.link-underline {
    position: absolute;
    bottom: 2px;
    left: 50%;
    width: 0;
    height: 2.5px;
    background: linear-gradient(90deg, #dc2626, #ef4444);
    border-radius: 4px;
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    transform: translateX(-50%);
    opacity: 0;
}

.top-nav-link:hover .link-underline {
    width: 60%;
    opacity: 1;
}

/* ===== Active Link ===== */
.active-link {
    color: #fff !important;
    background: rgba(220, 38, 38, 0.25) !important;
    border: 1px solid rgba(220, 38, 38, 0.3);
}

.active-link .link-underline {
    width: 60%;
    opacity: 1;
}

/* ===== Signup Button ===== */
.signup-btn {
    background: linear-gradient(135deg, #dc2626, #ef4444) !important;
    color: #fff !important;
    padding: 8px 24px !important;
    border-radius: 25px !important;
    font-weight: 700 !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    border: none !important;
    box-shadow: 0 3px 12px rgba(220, 38, 38, 0.3);
}

.signup-btn:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 24px rgba(220, 38, 38, 0.45) !important;
}

/* ===== Logout Button ===== */
.btn-logout {
    background: transparent;
    border: 1.5px solid rgba(255,255,255,0.2);
    color: rgba(255,255,255,0.8);
    padding: 8px 20px;
    border-radius: 10px;
    font-size: 0.92rem;
    font-family: inherit;
    font-weight: 500;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
}    .btn-logout:hover {
        background: rgba(220, 38, 38, 0.15);
        border-color: #dc2626;
        color: #fff;
    }

    /* ===== Theme Toggle Button ===== */
    .theme-toggle-btn {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        border: 1.5px solid rgba(255, 255, 255, 0.15);
        background: rgba(255, 255, 255, 0.06);
        color: rgba(255, 255, 255, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 16px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        margin-right: 6px;
        flex-shrink: 0;
    }

    .theme-toggle-btn:hover {
        background: rgba(255, 255, 255, 0.12);
        border-color: rgba(255, 255, 255, 0.3);
        color: #fff;
        transform: rotate(15deg);
    }

    .theme-toggle-btn.mobile {
        width: auto;
        height: 40px;
        padding: 0 18px;
        border-radius: 10px;
        margin: 0 auto;
        display: inline-flex;
        font-size: 14px;
        font-weight: 600;
    }

    .theme-toggle-btn.mobile:hover {
        transform: none;
    }

    .light-mode .theme-toggle-btn {
        border-color: rgba(0, 0, 0, 0.12);
        background: rgba(0, 0, 0, 0.04);
        color: rgba(0, 0, 0, 0.5);
    }

    .light-mode .theme-toggle-btn:hover {
        background: rgba(0, 0, 0, 0.08);
        border-color: rgba(0, 0, 0, 0.2);
        color: rgba(0, 0, 0, 0.8);
    }

    .light-mode .theme-toggle-btn.mobile {
        border-color: rgba(220, 38, 38, 0.2);
        background: rgba(220, 38, 38, 0.06);
        color: var(--theme-primary);
    }

/* ===== Animated Hamburger ===== */
.custom-toggler {
    padding: 4px 8px !important;
    background: transparent !important;
    position: relative;
    z-index: 1050;
}

.custom-toggler:focus,
.custom-toggler:active {
    outline: none !important;
    box-shadow: none !important;
}

.hamburger-lines {
    width: 28px;
    height: 22px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.hamb-line {
    display: block;
    height: 2.5px;
    width: 100%;
    background: #fff;
    border-radius: 4px;
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    transform-origin: center;
}

/* Active (open) state - hamburger to X */
.custom-toggler[aria-expanded="true"] .ham-top {
    transform: translateY(9.75px) rotate(45deg);
    width: 100%;
}

.custom-toggler[aria-expanded="true"] .ham-mid {
    opacity: 0;
    transform: scaleX(0);
}

.custom-toggler[aria-expanded="true"] .ham-bot {
    transform: translateY(-9.75px) rotate(-45deg);
    width: 100%;
}

/* ===== Mobile Menu ===== */
.navbar-collapse {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

@media (max-width: 991.98px) {
    .dark-navbar {
        padding: 10px 0 !important;
    }

    .dark-navbar.navbar-scrolled {
        padding: 6px 0 !important;
    }

    .navbar-collapse {
        background: linear-gradient(135deg, rgba(26, 26, 46, 0.98), rgba(15, 52, 96, 0.98));
        border-radius: 0 0 18px 18px;
        padding: 20px 20px 24px;
        margin-top: 12px;
        border: 1px solid rgba(255,255,255,0.06);
        border-top: none;
        box-shadow: 0 24px 60px rgba(0,0,0,0.4);
        max-height: calc(100vh - 80px);
        overflow-y: auto;
    }

    .navbar-nav {
        text-align: center;
        gap: 6px !important;
    }

    .top-nav-link {
        padding: 10px 16px !important;
        border-radius: 10px;
        font-size: 0.95rem;
        display: flex !important;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .link-underline {
        display: none;
    }

    .active-link {
        border: 1px solid rgba(220, 38, 38, 0.4);
    }

    .signup-btn {
        display: inline-flex !important;
        padding: 11px 28px !important;
        font-size: 1rem !important;
    }

    .btn-logout {
        width: 100%;
        text-align: center;
        padding: 11px 20px;
        font-size: 0.95rem;
    }

    .navbar-brand {
        font-size: 1.2rem !important;
    }

    .brand-icon-wrap {
        width: 34px;
        height: 34px;
    }

    .brand-drop {
        font-size: 1.1rem !important;
    }
}

@media (max-width: 575.98px) {
    .dark-navbar {
        padding: 8px 0 !important;
    }

    .dark-navbar.navbar-scrolled {
        padding: 5px 0 !important;
    }

    .navbar-brand {
        font-size: 1rem !important;
    }

    .brand-text {
        font-size: 1.1rem;
    }

    .brand-icon-wrap {
        width: 30px;
        height: 30px;
        border-radius: 10px;
    }

    .brand-drop {
        font-size: 0.95rem !important;
    }

    .hamburger-lines {
        width: 24px;
        height: 18px;
    }

    .hamb-line {
        height: 2px;
    }

    .custom-toggler[aria-expanded="true"] .ham-top {
        transform: translateY(8px) rotate(45deg);
    }

    .custom-toggler[aria-expanded="true"] .ham-bot {
        transform: translateY(-8px) rotate(-45deg);
    }

    .navbar-collapse {
        padding: 16px 16px 20px;
    }

    .top-nav-link {
        padding: 8px 12px !important;
        font-size: 0.88rem;
    }
}
</style>

<!-- ===== Scroll Effect Script ===== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('mainNavbar');
    let ticking = false;

    function updateNavbar() {
        if (window.scrollY > 30) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
        ticking = false;
    }

    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(updateNavbar);
            ticking = true;
        }
    });

    // Collapse mobile menu on link click
    const navLinks = document.querySelectorAll('#navbarTopNav .nav-link, #navbarTopNav .btn-logout, #navbarTopNav .signup-btn');
    const collapseEl = document.getElementById('navbarTopNav');

    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (collapseEl.classList.contains('show')) {
                const bsCollapse = bootstrap.Collapse.getInstance(collapseEl);
                if (bsCollapse) bsCollapse.hide();
            }
        });
    });

    // Sync mobile theme toggle with desktop
    const desktopToggle = document.getElementById('themeToggle');
    const mobileToggle = document.getElementById('mobileThemeToggle');
    if (desktopToggle && mobileToggle) {
        mobileToggle.addEventListener('click', function() {
            desktopToggle.click();
        });

        // Sync icon on load and on toggle
        function syncMobileIcon() {
            var isLight = document.documentElement.classList.contains('light-mode');
            mobileToggle.innerHTML = isLight
                ? '<i class="bi bi-moon-stars-fill"></i> <span class="ms-2">Dark</span>'
                : '<i class="bi bi-sun-fill"></i> <span class="ms-2">Light</span>';
        }

        syncMobileIcon();

        // Observe class changes on html element
        var observer = new MutationObserver(function() {
            syncMobileIcon();
        });
        observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
    }
});
</script>