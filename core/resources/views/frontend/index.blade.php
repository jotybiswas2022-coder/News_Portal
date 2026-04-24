@extends('frontend.app')

@section('content')

@if(session('success'))
<div class="alert-success-custom">
    {{ session('success') }}
</div>
@endif

<!-- TOP BAR -->
<div class="news-top-bar">
    <div class="container">
        <div class="top-bar-left">
            <span><i class="bi bi-calendar3"></i> <span id="currentDate"></span></span>
            <span><i class="bi bi-clock"></i> <span id="currentTime"></span></span>
            <span><i class="bi bi-geo-alt"></i> Worldwide</span>
        </div>
    </div>
</div>

<!-- MASTHEAD -->
<header class="masthead newspaper-fold">
    <div class="masthead-date" id="mastheadDate"></div>
    <div class="masthead-logo">News <span>Portal</span></div>
    <div class="masthead-tagline">Your Trusted Source for Breaking News & Stories</div>
    <div class="edition-badge"><i class="bi bi-lightning-fill"></i> Online Edition</div>
</header>

<!-- MAIN NAVIGATION -->
<nav class="main-nav">
    <div class="container">
        <ul class="nav-links">
            <li><a href="#" class="active"><i class="bi bi-house-door"></i> Home</a></li>
            <li><a href="#products"><i class="bi bi-grid"></i> Categories</a></li>
        </ul>
    </div>
</nav>

<div class="cafe-wrapper">

    <!-- ================= HERO SLIDER ================= -->
    <div class="slider-container">
        @if($slider && ($slider->slider1 || $slider->slider2))
            @if($slider->slider1)
            <div class="slide active">
                <img src="{{ config('app.storage_url') }}{{ $slider->slider1 }}" alt="News Portal Slide">
                <div class="slide-overlay"></div>
                <div class="slide-content">
                    <span class="badge-tag"><i class="bi bi-newspaper"></i> Breaking News</span>
                    <h1>Welcome to <span>News Portal</span></h1>
                    <p>Stay informed with the latest headlines, in-depth reports, and stories from around the world.</p>
                    <div class="slide-btns">
                        <a href="#products" class="btn-primary-custom">Read News <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endif

            @if($slider->slider2)
            <div class="slide {{ !$slider->slider1 ? 'active' : '' }}">
                <img src="{{ config('app.storage_url') }}{{ $slider->slider2 }}" alt="News Portal Slide">
                <div class="slide-overlay"></div>
                <div class="slide-content">
                    <span class="badge-tag"><i class="bi bi-stars"></i> Latest Updates</span>
                    <h1>Discover <span>Latest Stories</span></h1>
                    <p>Explore breaking news, trending topics, and in-depth coverage from trusted sources.</p>
                    <div class="slide-btns">
                        <a href="#products" class="btn-primary-custom">Explore Stories <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endif
        @endif

        <!-- Slider Arrows -->
        <button class="slider-arrow prev" onclick="changeSlide(-1)"><i class="bi bi-chevron-left"></i></button>
        <button class="slider-arrow next" onclick="changeSlide(1)"><i class="bi bi-chevron-right"></i></button>

        <!-- Slider Dots -->
        <div class="slider-dots">
            @if($slider && ($slider->slider1 || $slider->slider2))
                @if($slider->slider1)
                <button class="slider-dot active" onclick="goToSlide(0)"></button>
                @endif
                @if($slider->slider2)
                <button class="slider-dot {{ !$slider->slider1 ? 'active' : '' }}" onclick="goToSlide(1)"></button>
                @endif
            @endif
        </div>
    </div>

    <!-- ================= NEWS CATEGORIES SECTION ================= -->
    <section class="category-section paper-texture" id="products">
        <div class="container" style="position: relative;">
            <div class="coffee-ring coffee-ring-1"></div>
            <div class="coffee-ring coffee-ring-2"></div>
            <div class="coffee-ring coffee-ring-3"></div>
            <div class="pour-line"></div>

            <div class="newspaper-divider" style="margin-bottom: 20px;">
                <i class="bi bi-diamond-fill"></i>
            </div>

            <h2 class="section-title text-center mb-3 print-reveal" style="display: block;">Browse News Categories</h2>
            <p class="section-subtitle text-center">
                Stay updated with the latest news, trending stories, and important reports from different categories.
            </p>

            <div class="latte-art-loader">
                <div class="latte-swirl"></div>
            </div>

            <div class="menu-grid d-flex flex-wrap justify-content-center gap-4 mt-4">
                @foreach($categories as $category)
                <div class="menu-card-wrapper reveal-on-scroll">
                    <a href="{{ url('category/'.$category->id) }}" class="category-box d-block">
                        <h5>{{ $category->name }}</h5>
                        <span class="menu-desc">{{ $category->description ?? 'Latest news and reports' }}</span>
                        <div class="menu-arrow mt-2">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

@include('frontend.partials.footer')


<script>
        // ===== PAGE LOADER =====
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.getElementById('pageLoader').classList.add('hidden');
            }, 800);
        });

        // ===== DATE & TIME =====
        function updateDateTime() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const dateStr = now.toLocaleDateString('en-US', options);
            const timeStr = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

            const currentDateEl = document.getElementById('currentDate');
            const currentTimeEl = document.getElementById('currentTime');
            const mastheadDateEl = document.getElementById('mastheadDate');

            if (currentDateEl) currentDateEl.textContent = dateStr;
            if (currentTimeEl) currentTimeEl.textContent = timeStr;
            if (mastheadDateEl) mastheadDateEl.textContent = dateStr + ' | Online Edition';
        }
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // ===== HERO SLIDER =====
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.slider-dot');
        let sliderInterval;

        function goToSlide(index) {
            slides[currentSlide].classList.remove('active');
            dots[currentSlide].classList.remove('active');
            currentSlide = index;
            if (currentSlide >= slides.length) currentSlide = 0;
            if (currentSlide < 0) currentSlide = slides.length - 1;
            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');

            // Re-trigger content animation
            const content = slides[currentSlide].querySelector('.slide-content');
            if (content) {
                content.style.animation = 'none';
                content.offsetHeight; // trigger reflow
                content.style.animation = 'slideContentIn 0.8s ease-out';
            }

            const badge = slides[currentSlide].querySelector('.badge-tag');
            if (badge) {
                badge.style.animation = 'none';
                badge.offsetHeight;
                badge.style.animation = 'badgeSlide 0.6s ease-out 0.3s both';
            }
        }

        function changeSlide(direction) {
            goToSlide(currentSlide + direction);
            resetSliderInterval();
        }

        function resetSliderInterval() {
            clearInterval(sliderInterval);
            sliderInterval = setInterval(() => changeSlide(1), 5000);
        }

        sliderInterval = setInterval(() => changeSlide(1), 5000);

        // ===== SCROLL REVEAL =====
        const revealElements = document.querySelectorAll('.reveal-on-scroll');

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -50px 0px'
        });

        revealElements.forEach(el => revealObserver.observe(el));

        // ===== COUNTER ANIMATION =====
        const counterElements = document.querySelectorAll('.stat-number[data-count]');

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const target = parseInt(el.getAttribute('data-count'));
                    const duration = 2000;
                    const step = target / (duration / 16);
                    let current = 0;

                    const counter = setInterval(() => {
                        current += step;
                        if (current >= target) {
                            current = target;
                            clearInterval(counter);
                        }
                        el.textContent = Math.floor(current).toLocaleString();
                    }, 16);

                    counterObserver.unobserve(el);
                }
            });
        }, { threshold: 0.5 });

        counterElements.forEach(el => counterObserver.observe(el));

        // ===== SCROLL TO TOP BUTTON =====
        window.addEventListener('scroll', () => {
            const scrollTop = document.getElementById('scrollTop');
            if (window.scrollY > 400) {
                scrollTop.classList.add('visible');
            } else {
                scrollTop.classList.remove('visible');
            }
        });

        // ===== NEWSLETTER SUBSCRIBE =====
        function handleSubscribe(e) {
            e.preventDefault();
            const input = e.target.querySelector('input');
            const email = input.value;

            // Create success message
            const msg = document.createElement('div');
            msg.className = 'alert-success-custom';
            msg.innerHTML = '<i class="bi bi-check-circle"></i> Thank you for subscribing! You will receive daily news at ' + email;
            document.body.insertBefore(msg, document.body.firstChild);

            input.value = '';

            setTimeout(() => {
                msg.style.opacity = '0';
                msg.style.transition = 'opacity 0.5s';
                setTimeout(() => msg.remove(), 500);
            }, 4000);
        }

        // ===== SMOOTH SCROLL FOR NAV LINKS =====
        document.querySelectorAll('.nav-links a[href^="#"]').forEach(link => {
            link.addEventListener('click', (e) => {
                const href = link.getAttribute('href');
                if (href !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }
            });
        });

        // ===== NAVBAR ACTIVE STATE ON SCROLL =====
        const sections = document.querySelectorAll('section[id]');
        window.addEventListener('scroll', () => {
            let scrollY = window.pageYOffset;
            sections.forEach(section => {
                const sectionHeight = section.offsetHeight;
                const sectionTop = section.offsetTop - 100;
                const sectionId = section.getAttribute('id');
                const navLink = document.querySelector('.nav-links a[href="#' + sectionId + '"]');
                if (navLink) {
                    if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                        document.querySelectorAll('.nav-links a').forEach(a => a.classList.remove('active'));
                        navLink.classList.add('active');
                    }
                }
            });
        });

        // ===== KEYBOARD SUPPORT FOR SLIDER =====
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') changeSlide(-1);
            if (e.key === 'ArrowRight') changeSlide(1);
        });

        // ===== TOUCH SUPPORT FOR SLIDER =====
        let touchStartX = 0;
        let touchEndX = 0;
        const sliderContainer = document.querySelector('.slider-container');

        sliderContainer.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        sliderContainer.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            const diff = touchStartX - touchEndX;
            if (Math.abs(diff) > 50) {
                if (diff > 0) changeSlide(1);
                else changeSlide(-1);
            }
        }, { passive: true });
    </script>

    <style>
        /* ===== RESET & BASE ===== */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --black: #000000;
            --red: #D32F2F;
            --red-bright: #E53935;
            --white: #FFFFFF;
            --gray-light: #F5F5F5;
            --gray-medium: #E0E0E0;
            --gray-dark: #333333;
            --font-heading: 'Playfair Display', Georgia, serif;
            --font-body: 'Inter', 'Segoe UI', sans-serif;
            --font-masthead: 'UnifrakturMaguntia', cursive;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-body);
            color: var(--black);
            background-color: var(--white);
            overflow-x: hidden;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* ===== SUCCESS ALERT ===== */
        .alert-success-custom {
            background: linear-gradient(135deg, #2e7d32, #43a047);
            color: var(--white);
            padding: 16px 24px;
            text-align: center;
            font-weight: 500;
            font-size: 15px;
            position: relative;
            z-index: 1000;
            animation: slideDown 0.5s ease-out;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        @keyframes slideDown {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* ===== NEWSPAPER HEADER BAR ===== */
        .news-top-bar {
            background: var(--black);
            color: var(--white);
            padding: 8px 0;
            font-size: 12px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .news-top-bar .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .top-bar-left i {
            color: var(--red);
            margin-right: 4px;
        }

        .top-bar-right {
            display: flex;
            gap: 12px;
        }

        .top-bar-right a {
            color: var(--white);
            font-size: 15px;
            transition: color 0.3s;
        }

        .top-bar-right a:hover {
            color: var(--red);
        }

        /* ===== MASTHEAD ===== */
        .masthead {
            background: var(--white);
            text-align: center;
            padding: 30px 20px 20px;
            border-bottom: none;
            position: relative;
        }

        .masthead::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
        }

        .masthead-date {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: var(--gray-dark);
            margin-bottom: 8px;
        }

        .masthead-logo {
            font-family: var(--font-masthead);
            font-size: 62px;
            color: var(--black);
            line-height: 1.1;
            margin-bottom: 6px;
            animation: mastheadReveal 1.2s ease-out;
        }

        .masthead-logo span {
            color: var(--red);
        }

        @keyframes mastheadReveal {
            from { opacity: 0; letter-spacing: 20px; }
            to { opacity: 1; letter-spacing: normal; }
        }

        .masthead-tagline {
            font-size: 13px;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--gray-dark);
        }

        .edition-badge {
            display: inline-block;
            background: var(--red);
            color: var(--white);
            padding: 3px 14px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 700;
            margin-top: 10px;
            animation: pulseBadge 2s ease-in-out infinite;
        }

        @keyframes pulseBadge {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        /* ===== NAVIGATION ===== */
        .main-nav {
            background: var(--black);
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 2px 20px rgba(0,0,0,0.3);
        }

        .main-nav .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 0;
        }

        .nav-links li a {
            display: block;
            color: var(--white);
            padding: 14px 22px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links li a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: var(--red);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-links li a:hover {
            background: rgba(211, 47, 47, 0.1);
            color: var(--red-bright);
        }

        .nav-links li a:hover::after {
            width: 100%;
        }

        .nav-links li a.active {
            color: var(--red);
        }

        .nav-links li a.active::after {
            width: 100%;
        }

        /* ===== BREAKING NEWS TICKER ===== */
        .breaking-ticker {
            background: var(--red);
            color: var(--white);
            padding: 10px 0;
            overflow: hidden;
            position: relative;
        }

        .breaking-label {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            background: var(--black);
            color: var(--white);
            padding: 10px 20px;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 2;
        }

        .breaking-label i {
            animation: flashIcon 1s ease-in-out infinite;
        }

        @keyframes flashIcon {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        .ticker-content {
            display: flex;
            animation: tickerScroll 30s linear infinite;
            padding-left: 200px;
            white-space: nowrap;
        }

        .ticker-content span {
            padding: 0 40px;
            font-size: 14px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .ticker-content span::before {
            content: '●';
            font-size: 8px;
        }

        @keyframes tickerScroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* ===== CAFE WRAPPER ===== */
        .cafe-wrapper {
            position: relative;
        }

        /* ===== HERO SLIDER ===== */
        .slider-container {
            position: relative;
            width: 100%;
            height: 600px;
            overflow: hidden;
            background: var(--black);
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1.2s ease-in-out, transform 1.2s ease;
            transform: scale(1.05);
        }

        .slide.active {
            opacity: 1;
            transform: scale(1);
            z-index: 1;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.45);
        }

        .slide-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to top,
                rgba(0, 0, 0, 0.9) 0%,
                rgba(0, 0, 0, 0.4) 40%,
                rgba(0, 0, 0, 0.2) 100%
            );
        }

        .slide-content {
            position: absolute;
            bottom: 80px;
            left: 60px;
            z-index: 2;
            max-width: 700px;
            animation: slideContentIn 0.8s ease-out;
        }

        @keyframes slideContentIn {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .badge-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--red);
            color: var(--white);
            padding: 6px 18px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
            animation: badgeSlide 0.6s ease-out 0.3s both;
        }

        @keyframes badgeSlide {
            from { transform: translateX(-30px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .slide-content h1 {
            font-family: var(--font-heading);
            font-size: 52px;
            font-weight: 800;
            color: var(--white);
            line-height: 1.15;
            margin-bottom: 16px;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
        }

        .slide-content h1 span {
            color: var(--red-bright);
            position: relative;
        }

        .slide-content h1 span::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--red);
            opacity: 0.5;
        }

        .slide-content p {
            color: rgba(255,255,255,0.85);
            font-size: 17px;
            line-height: 1.7;
            margin-bottom: 28px;
            max-width: 550px;
        }

        .slide-btns {
            display: flex;
            gap: 16px;
        }

        .btn-primary-custom {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--red);
            color: var(--white);
            padding: 14px 32px;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            border: none;
            cursor: pointer;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary-custom:hover::before {
            left: 100%;
        }

        .btn-primary-custom:hover {
            background: var(--red-bright);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(211, 47, 47, 0.4);
        }

        .btn-primary-custom i {
            transition: transform 0.3s;
        }

        .btn-primary-custom:hover i {
            transform: translateX(4px);
        }

        /* Slider Navigation Dots */
        .slider-dots {
            position: absolute;
            bottom: 30px;
            right: 60px;
            display: flex;
            gap: 10px;
            z-index: 5;
        }

        .slider-dot {
            width: 14px;
            height: 4px;
            background: rgba(255,255,255,0.4);
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }

        .slider-dot.active {
            width: 36px;
            background: var(--red);
        }

        /* Slider Arrows */
        .slider-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 5;
            background: rgba(0,0,0,0.6);
            border: 1px solid rgba(255,255,255,0.2);
            color: var(--white);
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 20px;
            transition: all 0.3s;
        }

        .slider-arrow:hover {
            background: var(--red);
            border-color: var(--red);
        }

        .slider-arrow.prev { left: 20px; }
        .slider-arrow.next { right: 20px; }

        /* ===== NEWSPAPER DECORATIVE ELEMENTS ===== */
        .newspaper-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin: 0 auto;
            max-width: 500px;
        }

        .newspaper-divider::before,
        .newspaper-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--black);
        }

        .newspaper-divider i {
            color: var(--red);
            font-size: 18px;
        }

        /* ===== CATEGORY SECTION ===== */
        .category-section {
            padding: 80px 0;
            background: var(--white);
            position: relative;
            overflow: hidden;
        }

        .category-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: repeating-linear-gradient(
                90deg,
                var(--black) 0px,
                var(--black) 8px,
                transparent 8px,
                transparent 12px
            );
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
        }

        /* Coffee Ring → Newspaper Ink Spots */
        .coffee-ring {
            position: absolute;
            border-radius: 50%;
            border: 2px solid rgba(211, 47, 47, 0.06);
            pointer-events: none;
            animation: inkSpotFade 6s ease-in-out infinite;
        }

        .coffee-ring-1 {
            width: 200px;
            height: 200px;
            top: -40px;
            right: -60px;
            animation-delay: 0s;
        }

        .coffee-ring-2 {
            width: 150px;
            height: 150px;
            bottom: 20px;
            left: -30px;
            animation-delay: 2s;
        }

        .coffee-ring-3 {
            width: 100px;
            height: 100px;
            top: 50%;
            right: 10%;
            animation-delay: 4s;
        }

        @keyframes inkSpotFade {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.1); }
        }

        /* Pour Line → Ink Drop Line */
        .pour-line {
            position: absolute;
            top: -60px;
            left: 50%;
            width: 2px;
            height: 60px;
            background: linear-gradient(to bottom, transparent, var(--red));
            animation: inkDrip 2s ease-in-out infinite;
        }

        @keyframes inkDrip {
            0%, 100% { height: 40px; opacity: 0.5; }
            50% { height: 60px; opacity: 1; }
        }

        /* Section Title */
        .section-title {
            font-family: var(--font-heading);
            font-size: 42px;
            font-weight: 800;
            color: var(--black);
            text-align: center;
            margin-bottom: 12px;
            position: relative;
            display: block;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: var(--red);
            margin: 16px auto 0;
        }

        .section-subtitle {
            text-align: center;
            color: var(--gray-dark);
            font-size: 16px;
            max-width: 600px;
            margin: 0 auto 20px;
            line-height: 1.7;
        }

        /* Latte Art → Newspaper Spinner */
        .latte-art-loader {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .latte-swirl {
            width: 40px;
            height: 40px;
            border: 3px solid var(--gray-medium);
            border-top-color: var(--red);
            border-radius: 50%;
            animation: swirlSpin 1.5s linear infinite;
            display: none;
        }

        @keyframes swirlSpin {
            to { transform: rotate(360deg); }
        }

        /* ===== MENU/CATEGORY GRID ===== */
        .menu-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 24px;
            margin-top: 40px;
        }

        .menu-card-wrapper {
            width: 280px;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .menu-card-wrapper.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .menu-card-wrapper:nth-child(1) { transition-delay: 0.05s; }
        .menu-card-wrapper:nth-child(2) { transition-delay: 0.1s; }
        .menu-card-wrapper:nth-child(3) { transition-delay: 0.15s; }
        .menu-card-wrapper:nth-child(4) { transition-delay: 0.2s; }
        .menu-card-wrapper:nth-child(5) { transition-delay: 0.25s; }
        .menu-card-wrapper:nth-child(6) { transition-delay: 0.3s; }
        .menu-card-wrapper:nth-child(7) { transition-delay: 0.35s; }
        .menu-card-wrapper:nth-child(8) { transition-delay: 0.4s; }

        .category-box {
            display: block;
            background: var(--white);
            border: 2px solid var(--gray-medium);
            padding: 32px 24px;
            text-align: center;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .category-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 0;
            background: var(--red);
            transition: height 0.4s ease;
        }

        .category-box::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 0;
            background: linear-gradient(to top, rgba(211, 47, 47, 0.05), transparent);
            transition: height 0.4s ease;
        }

        .category-box:hover {
            border-color: var(--red);
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        }

        .category-box:hover::before {
            height: 100%;
        }

        .category-box:hover::after {
            height: 100%;
        }

        .category-box h5 {
            font-family: var(--font-heading);
            font-size: 22px;
            font-weight: 700;
            color: var(--black);
            margin-bottom: 10px;
            transition: color 0.3s;
        }

        .category-box:hover h5 {
            color: var(--red);
        }

        .menu-desc {
            display: block;
            font-size: 14px;
            color: #666;
            line-height: 1.6;
        }

        .menu-arrow {
            margin-top: 16px;
        }

        .menu-arrow i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background: var(--gray-light);
            color: var(--black);
            font-size: 16px;
            transition: all 0.3s;
        }

        .category-box:hover .menu-arrow i {
            background: var(--red);
            color: var(--white);
            transform: translateX(4px);
        }

        /* ===== TRENDING / FEATURED SECTION ===== */
        .trending-section {
            padding: 80px 0;
            background: var(--gray-light);
            position: relative;
        }

        .trending-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--black) 0%, var(--red) 50%, var(--black) 100%);
        }

        .trending-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .trending-card {
            background: var(--white);
            border: 1px solid var(--gray-medium);
            overflow: hidden;
            transition: all 0.4s ease;
            position: relative;
        }

        .trending-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--red);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .trending-card:hover::before {
            transform: scaleX(1);
        }

        .trending-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .trending-card-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            filter: grayscale(30%);
            transition: filter 0.4s;
        }

        .trending-card:hover .trending-card-img {
            filter: grayscale(0%);
        }

        .trending-card-body {
            padding: 24px;
        }

        .trending-card-tag {
            display: inline-block;
            background: var(--red);
            color: var(--white);
            padding: 3px 12px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        .trending-card-title {
            font-family: var(--font-heading);
            font-size: 20px;
            font-weight: 700;
            color: var(--black);
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .trending-card-excerpt {
            font-size: 14px;
            color: #666;
            line-height: 1.7;
            margin-bottom: 16px;
        }

        .trending-card-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: 12px;
            color: #999;
        }

        .trending-card-meta i {
            color: var(--red);
            margin-right: 4px;
        }

        /* ===== NEWSLETTER SECTION ===== */
        .newsletter-section {
            padding: 80px 0;
            background: var(--black);
            color: var(--white);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .newsletter-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                repeating-linear-gradient(
                    0deg,
                    transparent,
                    transparent 40px,
                    rgba(255,255,255,0.02) 40px,
                    rgba(255,255,255,0.02) 41px
                );
            pointer-events: none;
        }

        .newsletter-title {
            font-family: var(--font-heading);
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .newsletter-title span {
            color: var(--red);
        }

        .newsletter-text {
            color: rgba(255,255,255,0.7);
            font-size: 16px;
            max-width: 500px;
            margin: 0 auto 30px;
        }

        .newsletter-form {
            display: flex;
            justify-content: center;
            gap: 0;
            max-width: 480px;
            margin: 0 auto;
        }

        .newsletter-form input {
            flex: 1;
            padding: 14px 20px;
            border: 2px solid rgba(255,255,255,0.2);
            background: rgba(255,255,255,0.05);
            color: var(--white);
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s;
        }

        .newsletter-form input::placeholder {
            color: rgba(255,255,255,0.4);
        }

        .newsletter-form input:focus {
            border-color: var(--red);
        }

        .newsletter-form button {
            padding: 14px 28px;
            background: var(--red);
            color: var(--white);
            border: none;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 13px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .newsletter-form button:hover {
            background: var(--red-bright);
        }

        /* ===== STATS BAR ===== */
        .stats-bar {
            padding: 50px 0;
            background: var(--white);
            border-top: 1px solid var(--gray-medium);
            border-bottom: 1px solid var(--gray-medium);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            text-align: center;
        }

        .stat-item {
            padding: 20px;
        }

        .stat-icon {
            font-size: 28px;
            color: var(--red);
            margin-bottom: 12px;
        }

        .stat-number {
            font-family: var(--font-heading);
            font-size: 36px;
            font-weight: 800;
            color: var(--black);
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--gray-dark);
        }

        /* ===== FOOTER ===== */
        .site-footer {
            background: var(--black);
            color: rgba(255,255,255,0.7);
            padding: 60px 0 0;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            padding-bottom: 40px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .footer-brand h3 {
            font-family: var(--font-masthead);
            font-size: 32px;
            color: var(--white);
            margin-bottom: 16px;
        }

        .footer-brand h3 span {
            color: var(--red);
        }

        .footer-brand p {
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .footer-social {
            display: flex;
            gap: 10px;
        }

        .footer-social a {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255,255,255,0.2);
            color: var(--white);
            font-size: 16px;
            transition: all 0.3s;
        }

        .footer-social a:hover {
            background: var(--red);
            border-color: var(--red);
        }

        .footer-col h4 {
            color: var(--white);
            font-family: var(--font-heading);
            font-size: 18px;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-col h4::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 30px;
            height: 2px;
            background: var(--red);
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col ul li {
            margin-bottom: 10px;
        }

        .footer-col ul li a {
            color: rgba(255,255,255,0.6);
            font-size: 14px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-col ul li a i {
            font-size: 10px;
            color: var(--red);
        }

        .footer-col ul li a:hover {
            color: var(--white);
            padding-left: 6px;
        }

        .footer-bottom {
            text-align: center;
            padding: 20px 0;
            font-size: 13px;
            color: rgba(255,255,255,0.4);
        }

        .footer-bottom span {
            color: var(--red);
        }

        /* ===== SCROLL TO TOP ===== */
        .scroll-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 46px;
            height: 46px;
            background: var(--red);
            color: var(--white);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(211,47,47,0.4);
        }

        .scroll-top.visible {
            opacity: 1;
            visibility: visible;
        }

        .scroll-top:hover {
            background: var(--black);
            transform: translateY(-3px);
        }

        /* ===== NEWSPAPER PRINT ANIMATION ===== */
        .print-reveal {
            animation: printReveal 1s ease-out;
        }

        @keyframes printReveal {
            from {
                clip-path: inset(0 0 100% 0);
                opacity: 0;
            }
            to {
                clip-path: inset(0 0 0 0);
                opacity: 1;
            }
        }

        /* Typewriter effect for headings */
        .typewriter {
            overflow: hidden;
            border-right: 3px solid var(--red);
            white-space: nowrap;
            animation: typing 3s steps(30, end), blinkCaret 0.8s step-end infinite;
        }

        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }

        @keyframes blinkCaret {
            from, to { border-color: transparent; }
            50% { border-color: var(--red); }
        }

        /* Newspaper fold effect */
        .newspaper-fold {
            animation: unfold 0.8s ease-out;
            transform-origin: top center;
        }

        @keyframes unfold {
            from {
                transform: perspective(800px) rotateX(-15deg);
                opacity: 0;
            }
            to {
                transform: perspective(800px) rotateX(0deg);
                opacity: 1;
            }
        }

        /* Ink stamp effect */
        .ink-stamp {
            animation: stampIn 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        @keyframes stampIn {
            0% { transform: scale(2) rotate(-10deg); opacity: 0; }
            60% { transform: scale(0.95) rotate(1deg); opacity: 1; }
            100% { transform: scale(1) rotate(0deg); opacity: 1; }
        }

        /* Paper texture overlay */
        .paper-texture {
            position: relative;
        }

        .paper-texture::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
        }

        /* ===== PAGE LOADING ANIMATION ===== */
        .page-loader {
            position: fixed;
            inset: 0;
            background: var(--white);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            transition: opacity 0.5s, visibility 0.5s;
        }

        .page-loader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loader-press {
            width: 60px;
            height: 60px;
            position: relative;
        }

        .loader-press::before {
            content: '';
            position: absolute;
            inset: 0;
            border: 4px solid var(--gray-medium);
            border-top-color: var(--red);
            border-radius: 50%;
            animation: swirlSpin 0.8s linear infinite;
        }

        .loader-text {
            margin-top: 20px;
            font-family: var(--font-heading);
            font-size: 18px;
            color: var(--black);
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .masthead-logo {
                font-size: 38px;
            }
            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }
            .nav-links li a {
                padding: 10px 14px;
                font-size: 11px;
            }
            .slider-container {
                height: 450px;
            }
            .slide-content {
                left: 24px;
                right: 24px;
                bottom: 50px;
            }
            .slide-content h1 {
                font-size: 30px;
            }
            .slide-content p {
                font-size: 14px;
            }
            .section-title {
                font-size: 30px;
            }
            .menu-card-wrapper {
                width: 100%;
                max-width: 340px;
            }
            .breaking-label {
                position: relative;
                display: flex;
                justify-content: center;
            }
            .ticker-content {
                padding-left: 0;
            }
            .trending-grid {
                grid-template-columns: 1fr;
            }
            .footer-grid {
                grid-template-columns: 1fr;
            }
            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }
            .newsletter-form {
                flex-direction: column;
            }
            .top-bar-left span:not(:first-child) {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .masthead-logo {
                font-size: 30px;
            }
            .slider-container {
                height: 380px;
            }
            .slide-content h1 {
                font-size: 24px;
            }
            .stats-grid {
                grid-template-columns: 1fr;
            }
            .slider-arrow {
                display: none;
            }
        }
    </style>

@endsection