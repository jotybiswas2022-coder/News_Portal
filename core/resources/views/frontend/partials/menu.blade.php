<!-- ================= TOP NAVBAR ================= -->
<nav class="navbar navbar-expand-lg shadow-sm py-2 dark-navbar page-unfold">
    <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center fw-bold fs-5 stamp-animate" href="{{ url('/') }}">
            <i class="bi bi-newspaper"></i>
            <span>News Portal</span>
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler border-0" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarTopNav"
                aria-controls="navbarTopNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Top Nav Links -->
        <div class="collapse navbar-collapse" id="navbarTopNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">

                <!-- Home Link -->
                <li class="nav-item">
                    <a class="nav-link top-nav-link {{ request()->is('/') ? 'active-link' : '' }}" href="{{ url('/') }}">
                        <i class="bi bi-house-door me-1"></i> Home
                    </a>
                </li>

                @auth
                    <!-- Admin Panel (only for admin users) -->
                    @if(auth()->user()->is_admin == 1)
                        <li class="nav-item">
                            <a class="nav-link top-nav-link {{ request()->is('admin') ? 'active-link' : '' }}" href="{{ url('/admin') }}">
                                <i class="bi bi-speedometer2 me-1"></i> Admin Panel
                            </a>
                        </li>
                    @endif

                    <!-- Logout Button -->
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                            @csrf
                            <button type="submit" class="btn-logout w-100 text-start">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <!-- Login Link -->
                    <li class="nav-item">
                        <a class="nav-link top-nav-link {{ request()->is('login') ? 'active-link' : '' }}" href="{{ url('/login') }}">
                            <i class="bi bi-person-circle me-1"></i> Login
                        </a>
                    </li>

                    <!-- Register Button -->
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link signup-btn text-center" href="{{ url('/register') }}">
                            <i class="bi bi-person-plus me-1"></i> Register
                        </a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // ===== Current Date =====
    const dateEl = document.getElementById('currentDate');
    const now = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    dateEl.textContent = now.toLocaleDateString('en-US', options);

    // ===== Navbar Scroll Effect =====
    const navbar = document.querySelector('.dark-navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 10) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // ===== Ink Drop Effect on Nav Links =====
    document.querySelectorAll('.top-nav-link, .btn-logout, .category-nav .nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            const drop = document.createElement('span');
            drop.classList.add('ink-drop');
            const rect = this.getBoundingClientRect();
            drop.style.left = (e.clientX - rect.left) + 'px';
            drop.style.top = (e.clientY - rect.top) + 'px';
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(drop);
            setTimeout(() => drop.remove(), 600);
        });
    });

    // ===== Category Active Toggle =====
    document.querySelectorAll('.category-nav .nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('.category-nav .nav-link').forEach(l => l.classList.remove('cat-active'));
            this.classList.add('cat-active');
        });
    });

    // ===== Staggered Nav Item Animation =====
    document.querySelectorAll('.navbar-nav .nav-item').forEach((item, index) => {
        item.style.animation = `fadeInUp 0.5s ease-out ${0.8 + index * 0.1}s both`;
    });

    document.querySelectorAll('.category-nav .nav-item').forEach((item, index) => {
        item.style.animation = `fadeInUp 0.4s ease-out ${1 + index * 0.07}s both`;
    });
</script>

<!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        /* ============================================
           ROOT VARIABLES & RESET
        ============================================ */
        :root {
            --primary-black: #000000;
            --primary-red: #D32F2F;
            --accent-red: #E53935;
            --bg-white: #FFFFFF;
            --light-gray: #F5F5F5;
            --border-gray: #E0E0E0;
            --text-muted: #757575;
            --font-heading: 'Playfair Display', Georgia, serif;
            --font-body: 'Roboto', Arial, sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-body);
            background: var(--bg-white);
            color: var(--primary-black);
            overflow-x: hidden;
        }

        /* ============================================
           TOP INFO BAR (Above Navbar)
        ============================================ */
        .top-info-bar {
            background: var(--primary-black);
            color: #ccc;
            font-size: 0.78rem;
            padding: 6px 0;
            border-bottom: 2px solid var(--primary-red);
            letter-spacing: 0.3px;
            animation: slideDownBar 0.6s ease-out forwards;
        }

        @keyframes slideDownBar {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .top-info-bar a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .top-info-bar a:hover {
            color: var(--accent-red);
        }

        .top-info-bar .bi {
            color: var(--accent-red);
            margin-right: 4px;
        }

        .top-info-bar .separator {
            color: #555;
            margin: 0 12px;
        }

        /* ============================================
           BREAKING NEWS TICKER
        ============================================ */
        .breaking-news-bar {
            background: var(--primary-red);
            color: var(--bg-white);
            padding: 0;
            overflow: hidden;
            position: relative;
            height: 36px;
            display: flex;
            align-items: center;
        }

        .breaking-label {
            background: var(--primary-black);
            color: var(--bg-white);
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            padding: 0 18px;
            height: 100%;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            z-index: 2;
            position: relative;
            letter-spacing: 1px;
        }

        .breaking-label .bi {
            animation: pulseIcon 1s ease-in-out infinite;
            color: var(--accent-red);
            font-size: 0.9rem;
        }

        @keyframes pulseIcon {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(1.2); }
        }

        .ticker-wrap {
            flex: 1;
            overflow: hidden;
            height: 100%;
            display: flex;
            align-items: center;
            position: relative;
        }

        .ticker-content {
            display: flex;
            align-items: center;
            white-space: nowrap;
            animation: tickerScroll 30s linear infinite;
            font-size: 0.85rem;
            font-weight: 500;
            gap: 0;
        }

        .ticker-content span {
            padding: 0 30px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .ticker-content span::before {
            content: '\25CF';
            font-size: 0.5rem;
            opacity: 0.7;
        }

        @keyframes tickerScroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* ============================================
           MAIN NAVBAR
        ============================================ */
        .dark-navbar {
            background: var(--bg-white);
            border-bottom: 3px solid var(--primary-black);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1050;
            animation: navFadeIn 0.8s ease-out 0.3s both;
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        }

        @keyframes navFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .dark-navbar .container-fluid {
            padding: 0 20px;
        }

        /* ===== BRAND / LOGO ===== */
        .navbar-brand {
            font-family: var(--font-heading) !important;
            font-weight: 900 !important;
            font-size: 1.75rem !important;
            color: var(--primary-black) !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 0;
            position: relative;
            transition: all 0.3s ease;
            letter-spacing: -0.5px;
        }

        .navbar-brand:hover {
            color: var(--primary-red) !important;
        }

        .navbar-brand .bi-newspaper {
            font-size: 1.6rem;
            color: var(--bg-white);
            background: var(--primary-red);
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 3px 10px rgba(211, 47, 47, 0.3);
        }

        .navbar-brand:hover .bi-newspaper {
            transform: rotate(-8deg) scale(1.08);
            background: var(--primary-black);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .navbar-brand span {
            position: relative;
        }

        .navbar-brand span::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 3px;
            background: var(--primary-red);
            transition: width 0.4s ease;
        }

        .navbar-brand:hover span::after {
            width: 100%;
        }

        /* ===== TOGGLER (Mobile) ===== */
        .navbar-toggler {
            border: 2px solid var(--primary-black) !important;
            padding: 6px 10px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .navbar-toggler:hover {
            background: var(--primary-red);
            border-color: var(--primary-red) !important;
        }

        .navbar-toggler:hover .navbar-toggler-icon {
            filter: brightness(0) invert(1);
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(211, 47, 47, 0.3);
        }

        .navbar-toggler-icon {
            transition: filter 0.3s ease;
        }

        /* ===== NAV LINKS ===== */
        .top-nav-link {
            color: var(--primary-black) !important;
            font-weight: 500;
            font-size: 0.92rem;
            padding: 24px 16px !important;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            position: relative;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .top-nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background: var(--primary-red);
            transition: width 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .top-nav-link:hover {
            color: var(--primary-red) !important;
        }

        .top-nav-link:hover::after {
            width: 80%;
        }

        .top-nav-link .bi {
            font-size: 1rem;
            transition: transform 0.3s ease;
        }

        .top-nav-link:hover .bi {
            transform: translateY(-2px);
        }

        /* Active Link */
        .active-link {
            color: var(--primary-red) !important;
            font-weight: 700;
        }

        .active-link::after {
            width: 80% !important;
            background: var(--primary-red) !important;
        }

        .active-link .bi {
            color: var(--primary-red);
        }

        /* ===== LOGOUT BUTTON ===== */
        .btn-logout {
            background: transparent;
            border: none;
            color: var(--primary-black);
            font-weight: 500;
            font-size: 0.92rem;
            padding: 24px 16px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            position: relative;
        }

        .btn-logout::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background: var(--primary-red);
            transition: width 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .btn-logout:hover {
            color: var(--primary-red);
        }

        .btn-logout:hover::after {
            width: 80%;
        }

        .btn-logout:hover .bi {
            transform: translateX(3px);
        }

        .btn-logout .bi {
            transition: transform 0.3s ease;
            font-size: 1rem;
        }

        /* ===== SIGNUP / REGISTER BUTTON ===== */
        .signup-btn {
            background: var(--primary-red) !important;
            color: var(--bg-white) !important;
            font-weight: 600 !important;
            font-size: 0.85rem !important;
            padding: 9px 22px !important;
            border-radius: 4px;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            box-shadow: 0 3px 12px rgba(211, 47, 47, 0.3);
        }

        .signup-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .signup-btn:hover {
            background: var(--primary-black) !important;
            color: var(--bg-white) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .signup-btn:hover::before {
            left: 100%;
        }

        .signup-btn .bi {
            font-size: 1rem;
            transition: transform 0.3s ease;
        }

        .signup-btn:hover .bi {
            transform: scale(1.15);
        }     
    </style>