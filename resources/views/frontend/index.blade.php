@extends('frontend.app')

@section('content')

@if(session('success'))
<div class="alert-success-custom">
    <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
</div>
@endif

<!-- ================= NEWS TOP BAR ================= -->
<div class="np-top-bar">
    <div class="np-container">
        <div class="np-top-bar-left">
            <span><i class="bi bi-calendar3"></i> <span id="currentDate"></span></span>
            <span class="top-sep">|</span>
            <span><i class="bi bi-clock"></i> <span id="currentTime"></span></span>
            <span class="top-sep">|</span>
            <span><i class="bi bi-geo-alt"></i> Worldwide Edition</span>
        </div>
        <div class="np-top-bar-right">
            <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
        </div>
    </div>
</div>

<!-- ================= BREAKING NEWS TICKER ================= -->
<div class="np-breaking-bar">
    <div class="np-breaking-label">
        <i class="bi bi-lightning-charge-fill"></i> Breaking
    </div>
    <div class="np-ticker-wrap">
        <div class="np-ticker-content">
            <span>Stay informed with the latest headlines from around the world</span>
            <span>Global markets react to latest economic developments</span>
            <span>Technology: New breakthrough in renewable energy announced</span>
            <span>Weather alert: Heavy rainfall expected in multiple regions</span>
            <span>Stay informed with the latest headlines from around the world</span>
            <span>Global markets react to latest economic developments</span>
            <span>Technology: New breakthrough in renewable energy announced</span>
            <span>Weather alert: Heavy rainfall expected in multiple regions</span>
        </div>
    </div>
</div>

<!-- ================= MASTHEAD ================= -->
<header class="np-masthead">
    <div class="np-container">
        <div class="np-masthead-date" id="mastheadDate"></div>
        <div class="np-masthead-logo">
            News <span>Portal</span>
        </div>
        <div class="np-masthead-tagline">Your Trusted Source for Breaking News &amp; In-Depth Stories</div>
        <div class="np-edition-badge">
            <i class="bi bi-newspaper"></i> Online Edition
        </div>
    </div>
</header>

<!-- ================= HERO SLIDER ================= -->
<section class="np-hero-section">
    <div class="np-hero-slider" id="heroSlider">
        @if($slider && ($slider->slider1 || $slider->slider2))
            @if($slider->slider1)
            <div class="np-slide active" data-index="0">
                <img src="{{ config('app.storage_url') }}{{ $slider->slider1 }}" alt="Breaking News">
                <div class="np-slide-overlay"></div>
                <div class="np-slide-content">
                    <span class="np-badge-tag"><i class="bi bi-megaphone"></i> Breaking News</span>
                    <h2 class="np-slide-title">Welcome to <span>News Portal</span></h2>
                    <p class="np-slide-desc">Stay informed with the latest headlines, in-depth reports, and stories from around the world.</p>
                    <div class="np-slide-actions">
                        <a href="#latestNews" class="np-btn-primary">Read Latest News <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endif

            @if($slider->slider2)
            <div class="np-slide {{ !$slider->slider1 ? 'active' : '' }}" data-index="{{ $slider->slider1 ? 1 : 0 }}">
                <img src="{{ config('app.storage_url') }}{{ $slider->slider2 }}" alt="Latest Updates">
                <div class="np-slide-overlay"></div>
                <div class="np-slide-content">
                    <span class="np-badge-tag"><i class="bi bi-stars"></i> Latest Updates</span>
                    <h2 class="np-slide-title">Discover <span>Latest Stories</span></h2>
                    <p class="np-slide-desc">Explore breaking news, trending topics, and in-depth coverage from trusted sources.</p>
                    <div class="np-slide-actions">
                        <a href="#categories" class="np-btn-primary">Explore Categories <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endif
        @else
            <div class="np-slide active">
                <div class="np-slide-placeholder">
                    <div class="np-slide-content" style="position:relative;bottom:auto;left:auto;text-align:center;">
                        <span class="np-badge-tag"><i class="bi bi-newspaper"></i> News Portal</span>
                        <h2 class="np-slide-title">Welcome to <span>News Portal</span></h2>
                        <p class="np-slide-desc">Your trusted source for the latest news, stories, and updates from around the world.</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Slider Controls -->
        <button class="np-slide-arrow np-prev" onclick="changeSlide(-1)" aria-label="Previous slide">
            <i class="bi bi-chevron-left"></i>
        </button>
        <button class="np-slide-arrow np-next" onclick="changeSlide(1)" aria-label="Next slide">
            <i class="bi bi-chevron-right"></i>
        </button>

        <div class="np-slide-dots" id="slideDots">
            @if($slider && ($slider->slider1 || $slider->slider2))
                @if($slider->slider1)
                <button class="np-dot active" data-index="0" onclick="goToSlide(0)" aria-label="Slide 1"></button>
                @endif
                @if($slider->slider2)
                <button class="np-dot" data-index="{{ $slider->slider1 ? 1 : 0 }}" onclick="goToSlide({{ $slider->slider1 ? 1 : 0 }})" aria-label="Slide 2"></button>
                @endif
            @endif
        </div>
    </div>
</section>

<!-- ================= LATEST NEWS SECTION ================= -->
<section class="np-section" id="latestNews">
    <div class="np-container">
        <div class="np-section-header">
            <span class="np-section-label"><i class="bi bi-newspaper"></i> News Portal</span>
            <h2 class="np-section-title">Latest <span>News</span></h2>
            <div class="np-title-line">
                <span class="np-line"></span>
                <i class="bi bi-diamond-fill"></i>
                <span class="np-line"></span>
            </div>
            <p class="np-section-desc">Stay updated with the most recent news, stories, and reports from our newsroom</p>
        </div>

        <div class="np-news-grid" id="newsGrid">
            @if(isset($posts) && $posts->count() > 0)
                @foreach($posts->take(6) as $index => $post)
                <article class="np-news-card" style="--card-delay: {{ $index * 0.08 }}s;">
                    <a href="{{ url('/post/'.$post->id) }}" class="np-card-link">
                        <div class="np-card-media">
                            @php
                                $ext = strtolower(pathinfo($post->file, PATHINFO_EXTENSION));
                                $videoExt = ['mp4','webm','ogg','avi','mkv'];
                                $imgExt = ['jpg','jpeg','png','gif','webp'];
                                $isImage = in_array($ext, $imgExt);
                                $isVideo = in_array($ext, $videoExt);
                            @endphp

                            @if($post->file && $isImage)
                                <img src="{{ config('app.storage_url') }}{{ $post->file }}" alt="{{ $post->title }}" loading="lazy">
                            @elseif($post->file && $isVideo)
                                <video muted><source src="{{ config('app.storage_url') }}{{ $post->file }}" type="video/mp4"></video>
                            @else
                                <div class="np-card-no-media">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif

                            <div class="np-card-overlay">
                                <span class="np-read-more">Read Article <i class="bi bi-arrow-right"></i></span>
                            </div>

                            @if($post->PostCategory)
                            <span class="np-card-category">{{ $post->PostCategory->name ?? 'News' }}</span>
                            @endif
                        </div>
                        <div class="np-card-body">
                            <div class="np-card-meta">
                                <span><i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}</span>
                                <span><i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($post->created_at)->format('h:i A') }}</span>
                            </div>
                            <h3 class="np-card-title">{{ $post->title }}</h3>
                            <p class="np-card-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($post->details ?? ''), 120) }}</p>
                        </div>
                    </a>
                </article>
                @endforeach
            @else
                <div class="np-empty-state">
                    <div class="np-empty-icon">
                        <i class="bi bi-newspaper"></i>
                    </div>
                    <h4>No News Articles Yet</h4>
                    <p>Check back soon for the latest updates and breaking stories from our newsroom.</p>
                </div>
            @endif
        </div>

        @if(isset($posts) && $posts->count() > 0)
        <div class="np-view-all">
            <a href="#categories" class="np-btn-outline">Browse Categories <i class="bi bi-arrow-right"></i></a>
        </div>
        @endif
    </div>
</section>

<!-- ================= FEATURED STORY ================= -->
@if(isset($posts) && $posts->count() >= 2)
@php
    $featured = $posts->sortByDesc('created_at')->first();
@endphp
<section class="np-featured-section">
    <div class="np-container">
        <div class="np-featured-grid">
            <div class="np-featured-main">
                <div class="np-featured-media">
                    @php
                        $fExt = strtolower(pathinfo($featured->file, PATHINFO_EXTENSION));
                        $fImgExt = ['jpg','jpeg','png','gif','webp'];
                        $fIsImage = in_array($fExt, $fImgExt);
                    @endphp
                    @if($featured->file && $fIsImage)
                        <img src="{{ config('app.storage_url') }}{{ $featured->file }}" alt="{{ $featured->title }}" loading="lazy">
                    @else
                        <div class="np-featured-placeholder">
                            <i class="bi bi-image"></i>
                        </div>
                    @endif
                    <div class="np-featured-overlay"></div>
                    <div class="np-featured-text">
                        <span class="np-featured-badge"><i class="bi bi-star-fill"></i> Featured Story</span>
                        <h2><a href="{{ url('/post/'.$featured->id) }}">{{ $featured->title }}</a></h2>
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($featured->details ?? ''), 180) }}</p>
                        <div class="np-featured-meta">
                            <span><i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($featured->created_at)->format('d M Y') }}</span>
                            <span><i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($featured->created_at)->format('h:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="np-featured-side">
                @foreach($posts->skip(1)->take(3) as $sidePost)
                <div class="np-side-card">
                    <a href="{{ url('/post/'.$sidePost->id) }}" class="np-side-link">
                        <div class="np-side-media">
                            @php
                                $sExt = strtolower(pathinfo($sidePost->file, PATHINFO_EXTENSION));
                                $sImgExt = ['jpg','jpeg','png','gif','webp'];
                                $sIsImage = in_array($sExt, $sImgExt);
                            @endphp
                            @if($sidePost->file && $sIsImage)
                                <img src="{{ config('app.storage_url') }}{{ $sidePost->file }}" alt="{{ $sidePost->title }}" loading="lazy">
                            @else
                                <div class="np-featured-placeholder" style="height:100%;min-height:80px;">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </div>
                        <div class="np-side-text">
                            <h4>{{ $sidePost->title }}</h4>
                            <span class="np-side-date"><i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($sidePost->created_at)->format('d M Y') }}</span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

<!-- ================= CATEGORIES SECTION ================= -->
<section class="np-section np-category-section" id="categories">
    <div class="np-container">
        <div class="np-section-header">
            <span class="np-section-label"><i class="bi bi-grid"></i> Browse</span>
            <h2 class="np-section-title">News <span>Categories</span></h2>
            <div class="np-title-line">
                <span class="np-line"></span>
                <i class="bi bi-diamond-fill"></i>
                <span class="np-line"></span>
            </div>
            <p class="np-section-desc">Explore news by category — find the stories that matter to you</p>
        </div>

        <div class="np-category-grid">
            @foreach($categories as $category)
            <a href="{{ url('category/'.$category->id) }}" class="np-category-card">
                <div class="np-category-icon">
                    <i class="bi bi-collection"></i>
                </div>
                <h3 class="np-category-name">{{ $category->name }}</h3>
                <p class="np-category-desc">{{ $category->description ?? 'Latest news and reports in this category' }}</p>
                <span class="np-category-arrow">
                    <i class="bi bi-arrow-right"></i>
                </span>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- ================= NEWSLETTER SECTION ================= -->
<section class="np-newsletter">
    <div class="np-container">
        <div class="np-newsletter-content">
            <div class="np-newsletter-icon">
                <i class="bi bi-envelope-paper"></i>
            </div>
            <h2 class="np-newsletter-title">Subscribe to Our <span>Newsletter</span></h2>
            <p class="np-newsletter-text">Get daily news delivered straight to your inbox. Stay informed with the stories that matter.</p>
            <form class="np-newsletter-form" onsubmit="handleSubscribe(event)">
                <input type="email" placeholder="Enter your email address" required>
                <button type="submit">Subscribe <i class="bi bi-send"></i></button>
            </form>
        </div>
    </div>
</section>

<!-- ================= STATS BAR ================= -->
<div class="np-stats-bar">
    <div class="np-container">
        <div class="np-stats-grid">
            <div class="np-stat-item">
                <div class="np-stat-icon"><i class="bi bi-newspaper"></i></div>
                <div class="np-stat-number" data-count="{{ $posts ? $posts->count() : 0 }}">{{ $posts ? $posts->count() : 0 }}</div>
                <div class="np-stat-label">Published Articles</div>
            </div>
            <div class="np-stat-item">
                <div class="np-stat-icon"><i class="bi bi-collection"></i></div>
                <div class="np-stat-number" data-count="{{ $categories->count() }}">{{ $categories->count() }}</div>
                <div class="np-stat-label">News Categories</div>
            </div>
            <div class="np-stat-item">
                <div class="np-stat-icon"><i class="bi bi-people"></i></div>
                <div class="np-stat-number" data-count="24">24</div>
                <div class="np-stat-label">Team Members</div>
            </div>
            <div class="np-stat-item">
                <div class="np-stat-icon"><i class="bi bi-globe2"></i></div>
                <div class="np-stat-number" data-count="7">7</div>
                <div class="np-stat-label">Days a Week</div>
            </div>
        </div>
    </div>
</div>

<!-- ================= PAGE LOADER ================= -->
<div class="page-loader" id="pageLoader">
    <div class="loader-spinner"></div>
    <div class="loader-text">Loading</div>
</div>

@include('frontend.partials.footer')

<!-- ================= SCROLL TO TOP ================= -->
<button class="np-scroll-top" id="scrollTopBtn" onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="Scroll to top">
    <i class="bi bi-arrow-up"></i>
</button>

<!-- ================= JAVASCRIPT ================= -->
<script>
    window.addEventListener('load', () => {
        setTimeout(() => {
            const loader = document.getElementById('pageLoader');
            if (loader) loader.classList.add('hidden');
        }, 800);
    });

    function updateDateTime() {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const dateStr = now.toLocaleDateString('en-US', options);
        const timeStr = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        const dateEl = document.getElementById('currentDate');
        const timeEl = document.getElementById('currentTime');
        const mastEl = document.getElementById('mastheadDate');
        if (dateEl) dateEl.textContent = dateStr;
        if (timeEl) timeEl.textContent = timeStr;
        if (mastEl) mastEl.textContent = dateStr + ' | Online Edition';
    }
    updateDateTime();
    setInterval(updateDateTime, 1000);

    let currentSlide = 0;
    const slides = document.querySelectorAll('.np-slide');
    const dots = document.querySelectorAll('.np-dot');
    let sliderInterval;

    function goToSlide(index) {
        if (!slides.length) return;
        slides.forEach(s => s.classList.remove('active'));
        dots.forEach(d => d.classList.remove('active'));
        currentSlide = index;
        if (currentSlide >= slides.length) currentSlide = 0;
        if (currentSlide < 0) currentSlide = slides.length - 1;
        slides[currentSlide].classList.add('active');
        if (dots[currentSlide]) dots[currentSlide].classList.add('active');
        const content = slides[currentSlide].querySelector('.np-slide-content');
        if (content) {
            content.style.animation = 'none';
            content.offsetHeight;
            content.style.animation = 'npSlideUp 0.8s ease-out';
        }
        const badge = slides[currentSlide].querySelector('.np-badge-tag');
        if (badge) {
            badge.style.animation = 'none';
            badge.offsetHeight;
            badge.style.animation = 'npBadgeIn 0.6s ease-out 0.3s both';
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

    const revealElements = document.querySelectorAll('.np-news-card, .np-category-card, .np-stat-item, .np-side-card');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('np-visible');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
    revealElements.forEach(el => revealObserver.observe(el));

    const counterElements = document.querySelectorAll('.np-stat-number[data-count]');
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.getAttribute('data-count'));
                const duration = 2000;
                const step = Math.max(1, target / (duration / 16));
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

    window.addEventListener('scroll', () => {
        const btn = document.getElementById('scrollTopBtn');
        if (window.scrollY > 400) {
            btn.classList.add('visible');
        } else {
            btn.classList.remove('visible');
        }
    });

    function handleSubscribe(e) {
        e.preventDefault();
        const input = e.target.querySelector('input');
        const email = input.value;
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

    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', (e) => {
            const href = link.getAttribute('href');
            if (href !== '#') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') changeSlide(-1);
        if (e.key === 'ArrowRight') changeSlide(1);
    });

    let touchStartX = 0;
    const sliderContainer = document.querySelector('.np-hero-slider');
    if (sliderContainer) {
        sliderContainer.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });
        sliderContainer.addEventListener('touchend', (e) => {
            const touchEndX = e.changedTouches[0].screenX;
            const diff = touchStartX - touchEndX;
            if (Math.abs(diff) > 50) {
                if (diff > 0) changeSlide(1);
                else changeSlide(-1);
            }
        }, { passive: true });
    }
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&family=Source+Serif+4:wght@300;400;600&display=swap');

    :root {
        --np-black: #000000;
        --np-red: #D32F2F;
        --np-red-dark: #B71C1C;
        --np-red-light: #E53935;
        --np-white: #FFFFFF;
        --np-gray-50: #FAFAFA;
        --np-gray-100: #F5F5F5;
        --np-gray-200: #EEEEEE;
        --np-gray-300: #E0E0E0;
        --np-gray-400: #BDBDBD;
        --np-gray-500: #9E9E9E;
        --np-gray-600: #757575;
        --np-gray-700: #616161;
        --np-text: #222222;
        --font-headline: 'Playfair Display', Georgia, serif;
        --font-body: 'Source Serif 4', Georgia, serif;
        --font-ui: 'Inter', Arial, sans-serif;
        --np-shadow-sm: 0 2px 8px rgba(0,0,0,0.06);
        --np-shadow-md: 0 4px 20px rgba(0,0,0,0.1);
        --np-shadow-lg: 0 8px 40px rgba(0,0,0,0.12);
        --np-shadow-hover: 0 12px 50px rgba(0,0,0,0.18);
        --np-transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
    html { scroll-behavior: smooth; }
    body {
        font-family: var(--font-ui);
        color: var(--np-text);
        background: var(--np-white);
        overflow-x: hidden;
        line-height: 1.6;
    }
    a { text-decoration: none; color: inherit; }
    img { max-width: 100%; height: auto; }

    .np-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 24px;
    }
    @media (max-width: 768px) { .np-container { padding: 0 16px; } }

    .alert-success-custom {
        background: linear-gradient(135deg, #1B5E20, #2E7D32);
        color: var(--np-white);
        padding: 14px 24px;
        text-align: center;
        font-weight: 500;
        font-size: 14px;
        position: relative;
        z-index: 1000;
        animation: npSlideDown 0.5s ease-out;
    }
    @keyframes npSlideDown {
        from { transform: translateY(-100%); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .np-top-bar {
        background: var(--np-black);
        color: rgba(255,255,255,0.8);
        padding: 7px 0;
        font-size: 12px;
        font-family: var(--font-ui);
        letter-spacing: 0.3px;
    }
    .np-top-bar .np-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }
    .np-top-bar-left {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    .np-top-bar-left i { color: var(--np-red); margin-right: 3px; }
    .top-sep { color: rgba(255,255,255,0.2); font-size: 10px; }
    .np-top-bar-right { display: flex; gap: 12px; }
    .np-top-bar-right a { color: rgba(255,255,255,0.6); font-size: 14px; transition: color 0.3s; }
    .np-top-bar-right a:hover { color: var(--np-red); }

    .np-breaking-bar {
        background: var(--np-red);
        color: var(--np-white);
        display: flex;
        align-items: stretch;
        height: 38px;
        overflow: hidden;
        position: relative;
    }
    .np-breaking-label {
        background: var(--np-black);
        color: var(--np-white);
        padding: 0 20px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        white-space: nowrap;
        z-index: 2;
        position: relative;
    }
    .np-breaking-label i {
        animation: npFlash 1s ease-in-out infinite;
        font-size: 13px;
    }
    @keyframes npFlash { 0%,100% { opacity: 1; } 50% { opacity: 0.3; } }
    .np-ticker-wrap { flex: 1; overflow: hidden; display: flex; align-items: center; padding-left: 16px; }
    .np-ticker-content {
        display: flex;
        gap: 60px;
        white-space: nowrap;
        animation: npTickerScroll 35s linear infinite;
        font-size: 13px;
        font-weight: 500;
    }
    .np-ticker-content span { display: flex; align-items: center; gap: 8px; }
    .np-ticker-content span::before { content: '\25C6'; font-size: 7px; color: rgba(255,255,255,0.6); }
    @keyframes npTickerScroll { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

    .np-masthead {
        background: var(--np-white);
        text-align: center;
        padding: 32px 24px 24px;
        position: relative;
        border-bottom: 1px solid var(--np-gray-300);
    }
    .np-masthead::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        height: 3px;
        background: var(--np-black);
    }
    .np-masthead-date {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 3px;
        color: var(--np-gray-600);
        margin-bottom: 6px;
        font-family: var(--font-ui);
    }
    .np-masthead-logo {
        font-family: var(--font-headline);
        font-size: 56px;
        font-weight: 900;
        color: var(--np-black);
        line-height: 1.1;
        margin-bottom: 6px;
        animation: npMastheadReveal 1.2s ease-out;
        letter-spacing: -1px;
    }
    .np-masthead-logo span { color: var(--np-red); }
    @keyframes npMastheadReveal { from { opacity: 0; letter-spacing: 15px; } to { opacity: 1; letter-spacing: -1px; } }
    .np-masthead-tagline {
        font-size: 12px;
        letter-spacing: 4px;
        text-transform: uppercase;
        color: var(--np-gray-600);
        font-family: var(--font-ui);
        font-weight: 400;
    }
    .np-edition-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--np-red);
        color: var(--np-white);
        padding: 3px 14px;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 700;
        margin-top: 10px;
        font-family: var(--font-ui);
        animation: npPulse 2s ease-in-out infinite;
    }
    @keyframes npPulse { 0%,100% { transform: scale(1); } 50% { transform: scale(1.04); } }

    .np-hero-slider {
        position: relative;
        width: 100%;
        height: 520px;
        overflow: hidden;
        background: var(--np-black);
    }
    .np-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 1s ease-in-out, transform 1.2s ease;
        transform: scale(1.05);
    }
    .np-slide.active { opacity: 1; transform: scale(1); z-index: 1; }
    .np-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.4);
    }
    .np-slide-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.5) 40%, rgba(0,0,0,0.2) 100%);
    }
    .np-slide-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #1a1a1a, #2a2a2a);
    }
    .np-slide-content {
        position: absolute;
        bottom: 70px;
        left: 60px;
        right: 60px;
        z-index: 2;
        max-width: 680px;
        animation: npSlideUp 0.8s ease-out;
    }
    @keyframes npSlideUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    .np-badge-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--np-red);
        color: var(--np-white);
        padding: 5px 16px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 16px;
        font-family: var(--font-ui);
        animation: npBadgeIn 0.6s ease-out 0.3s both;
    }
    @keyframes npBadgeIn { from { transform: translateX(-30px); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
    .np-slide-title {
        font-family: var(--font-headline);
        font-size: 44px;
        font-weight: 800;
        color: var(--np-white);
        line-height: 1.15;
        margin-bottom: 14px;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
    }
    .np-slide-title span { color: var(--np-red-light); position: relative; }
    .np-slide-title span::after { content: ''; position: absolute; bottom: 2px; left: 0; width: 100%; height: 3px; background: var(--np-red); opacity: 0.5; }
    .np-slide-desc {
        color: rgba(255,255,255,0.85);
        font-size: 16px;
        line-height: 1.7;
        margin-bottom: 24px;
        max-width: 520px;
        font-family: var(--font-body);
    }
    .np-slide-actions { display: flex; gap: 16px; }
    .np-btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--np-red);
        color: var(--np-white);
        padding: 12px 28px;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: var(--font-ui);
    }
    .np-btn-primary:hover { background: var(--np-red-dark); transform: translateY(-2px); box-shadow: 0 8px 25px rgba(211,47,47,0.35); color: var(--np-white); }
    .np-btn-primary i { transition: transform 0.3s; }
    .np-btn-primary:hover i { transform: translateX(4px); }

    .np-slide-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 5;
        background: rgba(0,0,0,0.5);
        border: 1px solid rgba(255,255,255,0.15);
        color: var(--np-white);
        width: 46px;
        height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 18px;
        transition: all 0.3s;
        opacity: 0;
    }
    .np-hero-slider:hover .np-slide-arrow { opacity: 1; }
    .np-slide-arrow:hover { background: var(--np-red); border-color: var(--np-red); }
    .np-prev { left: 20px; }
    .np-next { right: 20px; }

    .np-slide-dots {
        position: absolute;
        bottom: 24px;
        right: 60px;
        display: flex;
        gap: 8px;
        z-index: 5;
    }
    .np-dot {
        width: 12px;
        height: 4px;
        border-radius: 2px;
        background: rgba(255,255,255,0.4);
        border: none;
        cursor: pointer;
        transition: all 0.3s;
    }
    .np-dot.active { width: 32px; background: var(--np-red); }

    .np-section { padding: 70px 0; background: var(--np-white); position: relative; }
    .np-section-header { text-align: center; margin-bottom: 40px; }
    .np-section-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--np-black);
        color: var(--np-white);
        padding: 4px 14px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 14px;
        font-family: var(--font-ui);
    }
    .np-section-title {
        font-family: var(--font-headline);
        font-size: 38px;
        font-weight: 800;
        color: var(--np-black);
        margin-bottom: 12px;
        line-height: 1.2;
    }
    .np-section-title span { color: var(--np-red); }
    .np-title-line { display: flex; align-items: center; justify-content: center; gap: 12px; margin-bottom: 12px; }
    .np-title-line .np-line { width: 60px; height: 1px; background: var(--np-gray-400); }
    .np-title-line i { color: var(--np-red); font-size: 10px; }
    .np-section-desc { color: var(--np-gray-600); font-size: 15px; max-width: 520px; margin: 0 auto; line-height: 1.7; font-family: var(--font-ui); }

    .np-news-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; }
    .np-news-card {
        background: var(--np-white);
        border: 1px solid var(--np-gray-200);
        overflow: hidden;
        transition: var(--np-transition);
        opacity: 0;
        transform: translateY(30px);
        animation: npCardFadeIn 0.6s ease-out var(--card-delay, 0s) forwards;
    }
    .np-news-card.np-visible { opacity: 1; transform: translateY(0); }
    @keyframes npCardFadeIn { to { opacity: 1; transform: translateY(0); } }
    .np-news-card:hover { transform: translateY(-6px); box-shadow: var(--np-shadow-hover); border-color: rgba(211,47,47,0.15); }
    .np-card-link { display: block; color: inherit; }
    .np-card-media { position: relative; overflow: hidden; height: 200px; background: var(--np-gray-100); }
    .np-card-media img, .np-card-media video { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease; }
    .np-news-card:hover .np-card-media img { transform: scale(1.06); }
    .np-card-no-media { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f5f5f5, #e8e8e8); color: #ccc; font-size: 2.5rem; }
    .np-card-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.4s ease;
    }
    .np-news-card:hover .np-card-overlay { opacity: 1; }
    .np-read-more {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--np-white);
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        padding: 10px 22px;
        border: 2px solid rgba(255,255,255,0.8);
        transition: all 0.3s;
        font-family: var(--font-ui);
    }
    .np-read-more:hover { background: var(--np-red); border-color: var(--np-red); }
    .np-read-more i { transition: transform 0.3s; }
    .np-read-more:hover i { transform: translateX(4px); }
    .np-card-category {
        position: absolute;
        top: 12px;
        left: 12px;
        background: var(--np-red);
        color: var(--np-white);
        padding: 3px 12px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-family: var(--font-ui);
        z-index: 2;
    }
    .np-card-body { padding: 18px 20px 22px; }
    .np-card-meta { display: flex; gap: 14px; font-size: 11px; color: var(--np-gray-500); margin-bottom: 8px; font-family: var(--font-ui); }
    .np-card-meta i { color: var(--np-red); margin-right: 3px; }
    .np-card-title {
        font-family: var(--font-headline);
        font-size: 17px;
        font-weight: 700;
        color: var(--np-black);
        line-height: 1.35;
        margin-bottom: 8px;
        transition: color 0.3s;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .np-news-card:hover .np-card-title { color: var(--np-red); }
    .np-card-excerpt { font-size: 13px; color: var(--np-gray-600); line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-family: var(--font-body); }

    .np-empty-state { grid-column: 1 / -1; text-align: center; padding: 60px 30px; background: var(--np-gray-50); border: 2px dashed var(--np-gray-300); }
    .np-empty-icon { width: 80px; height: 80px; margin: 0 auto 20px; background: var(--np-red); display: flex; align-items: center; justify-content: center; border-radius: 50%; animation: npPulse 2s ease-in-out infinite; }
    .np-empty-icon i { font-size: 2rem; color: var(--np-white); }
    .np-empty-state h4 { font-family: var(--font-headline); font-size: 1.5rem; font-weight: 700; color: var(--np-black); margin-bottom: 8px; }
    .np-empty-state p { color: var(--np-gray-600); font-size: 1rem; }

    .np-view-all { text-align: center; margin-top: 40px; }
    .np-btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 32px;
        border: 2px solid var(--np-black);
        color: var(--np-black);
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        transition: all 0.3s;
        font-family: var(--font-ui);
    }
    .np-btn-outline:hover { background: var(--np-black); color: var(--np-white); transform: translateY(-2px); }
    .np-btn-outline i { transition: transform 0.3s; }
    .np-btn-outline:hover i { transform: translateX(4px); }

    .np-featured-section { padding: 0 0 70px; background: var(--np-gray-50); position: relative; }
    .np-featured-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: repeating-linear-gradient(90deg, var(--np-black) 0px, var(--np-black) 6px, transparent 6px, transparent 10px);
    }
    .np-featured-grid { display: grid; grid-template-columns: 1.5fr 1fr; gap: 30px; align-items: start; }
    .np-featured-media { position: relative; overflow: hidden; height: 420px; }
    .np-featured-media img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s ease; }
    .np-featured-media:hover img { transform: scale(1.05); }
    .np-featured-placeholder { width: 100%; height: 100%; min-height: 200px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f0f0f0, #e0e0e0); color: #ccc; font-size: 3rem; }
    .np-featured-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.4) 40%, transparent 100%); }
    .np-featured-text { position: absolute; bottom: 0; left: 0; right: 0; padding: 30px; z-index: 2; }
    .np-featured-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--np-red);
        color: var(--np-white);
        padding: 4px 14px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 12px;
        font-family: var(--font-ui);
        animation: npPulse 2s ease-in-out infinite;
    }
    .np-featured-text h2 { font-family: var(--font-headline); font-size: 26px; font-weight: 800; color: var(--np-white); line-height: 1.25; margin-bottom: 8px; }
    .np-featured-text h2 a { color: var(--np-white); transition: color 0.3s; }
    .np-featured-text h2 a:hover { color: var(--np-red-light); }
    .np-featured-text p { color: rgba(255,255,255,0.8); font-size: 14px; line-height: 1.7; margin-bottom: 10px; font-family: var(--font-body); display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    .np-featured-meta { display: flex; gap: 16px; font-size: 11px; color: rgba(255,255,255,0.6); font-family: var(--font-ui); }
    .np-featured-meta i { color: var(--np-red-light); margin-right: 3px; }

    .np-featured-side { display: flex; flex-direction: column; gap: 16px; }
    .np-side-card {
        background: var(--np-white);
        border: 1px solid var(--np-gray-200);
        overflow: hidden;
        transition: var(--np-transition);
        opacity: 0;
        transform: translateX(20px);
    }
    .np-side-card.np-visible { opacity: 1; transform: translateX(0); }
    .np-side-card:nth-child(1) { transition-delay: 0.1s; }
    .np-side-card:nth-child(2) { transition-delay: 0.2s; }
    .np-side-card:nth-child(3) { transition-delay: 0.3s; }
    .np-side-card:hover { transform: translateX(6px); box-shadow: var(--np-shadow-md); border-color: rgba(211,47,47,0.15); }
    .np-side-link { display: flex; gap: 14px; padding: 14px; color: inherit; }
    .np-side-media { width: 100px; min-width: 100px; height: 80px; overflow: hidden; }
    .np-side-media img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
    .np-side-card:hover .np-side-media img { transform: scale(1.08); }
    .np-side-text { flex: 1; }
    .np-side-text h4 { font-family: var(--font-headline); font-size: 14px; font-weight: 700; color: var(--np-black); line-height: 1.35; margin-bottom: 6px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; transition: color 0.3s; }
    .np-side-card:hover .np-side-text h4 { color: var(--np-red); }
    .np-side-date { font-size: 11px; color: var(--np-gray-500); font-family: var(--font-ui); }
    .np-side-date i { color: var(--np-red); margin-right: 3px; }

    .np-category-section { background: var(--np-gray-50); }
    .np-category-section::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px; background: repeating-linear-gradient(90deg, var(--np-gray-300) 0px, var(--np-gray-300) 6px, transparent 6px, transparent 10px); }
    .np-category-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 24px; }
    .np-category-card {
        background: var(--np-white);
        border: 1px solid var(--np-gray-200);
        padding: 32px 24px;
        text-align: center;
        transition: var(--np-transition);
        position: relative;
        overflow: hidden;
        opacity: 0;
        transform: translateY(30px);
    }
    .np-category-card.np-visible { opacity: 1; transform: translateY(0); }
    .np-category-card:nth-child(1) { transition-delay: 0.05s; }
    .np-category-card:nth-child(2) { transition-delay: 0.1s; }
    .np-category-card:nth-child(3) { transition-delay: 0.15s; }
    .np-category-card:nth-child(4) { transition-delay: 0.2s; }
    .np-category-card:nth-child(5) { transition-delay: 0.25s; }
    .np-category-card:nth-child(6) { transition-delay: 0.3s; }
    .np-category-card::before { content: ''; position: absolute; top: 0; left: 0; width: 3px; height: 0; background: var(--np-red); transition: height 0.4s ease; }
    .np-category-card:hover { border-color: var(--np-red); transform: translateY(-6px); box-shadow: var(--np-shadow-hover); }
    .np-category-card:hover::before { height: 100%; }
    .np-category-icon { width: 56px; height: 56px; margin: 0 auto 16px; background: var(--np-gray-100); display: flex; align-items: center; justify-content: center; font-size: 22px; color: var(--np-red); transition: all 0.3s; }
    .np-category-card:hover .np-category-icon { background: var(--np-red); color: var(--np-white); transform: rotate(-5deg) scale(1.1); }
    .np-category-name { font-family: var(--font-headline); font-size: 20px; font-weight: 700; color: var(--np-black); margin-bottom: 8px; transition: color 0.3s; }
    .np-category-card:hover .np-category-name { color: var(--np-red); }
    .np-category-desc { font-size: 13px; color: var(--np-gray-500); line-height: 1.6; margin-bottom: 14px; font-family: var(--font-ui); }
    .np-category-arrow i { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: var(--np-gray-100); color: var(--np-black); font-size: 14px; transition: all 0.3s; }
    .np-category-card:hover .np-category-arrow i { background: var(--np-red); color: var(--np-white); transform: translateX(4px); }

    .np-newsletter {
        padding: 70px 0;
        background: var(--np-black);
        color: var(--np-white);
        position: relative;
        overflow: hidden;
    }
    .np-newsletter::before { content: ''; position: absolute; inset: 0; background: repeating-linear-gradient(0deg, transparent, transparent 40px, rgba(255,255,255,0.015) 40px, rgba(255,255,255,0.015) 41px); pointer-events: none; }
    .np-newsletter-content { max-width: 600px; margin: 0 auto; text-align: center; position: relative; z-index: 1; }
    .np-newsletter-icon { width: 64px; height: 64px; margin: 0 auto 20px; background: var(--np-red); display: flex; align-items: center; justify-content: center; font-size: 26px; animation: npPulse 2s ease-in-out infinite; }
    .np-newsletter-title { font-family: var(--font-headline); font-size: 32px; font-weight: 800; margin-bottom: 12px; }
    .np-newsletter-title span { color: var(--np-red); }
    .np-newsletter-text { color: rgba(255,255,255,0.7); font-size: 15px; margin-bottom: 24px; line-height: 1.7; font-family: var(--font-ui); }
    .np-newsletter-form { display: flex; justify-content: center; gap: 0; max-width: 480px; margin: 0 auto; }
    .np-newsletter-form input { flex: 1; padding: 14px 18px; border: 2px solid rgba(255,255,255,0.15); background: rgba(255,255,255,0.06); color: var(--np-white); font-size: 14px; outline: none; transition: border-color 0.3s; font-family: var(--font-ui); }
    .np-newsletter-form input::placeholder { color: rgba(255,255,255,0.35); }
    .np-newsletter-form input:focus { border-color: var(--np-red); }
    .np-newsletter-form button { padding: 14px 24px; background: var(--np-red); color: var(--np-white); border: 2px solid var(--np-red); font-weight: 700; text-transform: uppercase; letter-spacing: 1px; font-size: 13px; cursor: pointer; transition: all 0.3s; font-family: var(--font-ui); display: flex; align-items: center; gap: 8px; }
    .np-newsletter-form button:hover { background: var(--np-red-dark); border-color: var(--np-red-dark); }
    .np-newsletter-form button i { transition: transform 0.3s; }
    .np-newsletter-form button:hover i { transform: translateX(4px); }

    .np-stats-bar { padding: 50px 0; background: var(--np-white); border-top: 1px solid var(--np-gray-200); border-bottom: 1px solid var(--np-gray-200); }
    .np-stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; text-align: center; }
    .np-stat-item { padding: 16px; opacity: 0; transform: translateY(20px); }
    .np-stat-item.np-visible { opacity: 1; transform: translateY(0); }
    .np-stat-item:nth-child(1) { transition: all 0.5s ease 0.05s; }
    .np-stat-item:nth-child(2) { transition: all 0.5s ease 0.1s; }
    .np-stat-item:nth-child(3) { transition: all 0.5s ease 0.15s; }
    .np-stat-item:nth-child(4) { transition: all 0.5s ease 0.2s; }
    .np-stat-icon { font-size: 26px; color: var(--np-red); margin-bottom: 10px; }
    .np-stat-number { font-family: var(--font-headline); font-size: 36px; font-weight: 800; color: var(--np-black); margin-bottom: 4px; }
    .np-stat-label { font-size: 12px; text-transform: uppercase; letter-spacing: 2px; color: var(--np-gray-600); font-family: var(--font-ui); font-weight: 500; }

    .np-scroll-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 44px;
        height: 44px;
        background: var(--np-red);
        color: var(--np-white);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        cursor: pointer;
        z-index: 999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(211,47,47,0.4);
    }
    .np-scroll-top.visible { opacity: 1; visibility: visible; }
    .np-scroll-top:hover { background: var(--np-black); transform: translateY(-3px); }

    .page-loader {
        position: fixed;
        inset: 0;
        background: var(--np-white);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        z-index: 10000;
        transition: opacity 0.5s, visibility 0.5s;
    }
    .page-loader.hidden { opacity: 0; visibility: hidden; }
    .loader-spinner { width: 50px; height: 50px; border: 4px solid var(--np-gray-200); border-top-color: var(--np-red); border-radius: 50%; animation: npSpin 0.8s linear infinite; }
    @keyframes npSpin { to { transform: rotate(360deg); } }
    .loader-text { margin-top: 16px; font-family: var(--font-headline); font-size: 16px; color: var(--np-black); letter-spacing: 3px; text-transform: uppercase; }

    @media (max-width: 1024px) {
        .np-news-grid { grid-template-columns: repeat(2, 1fr); }
        .np-featured-grid { grid-template-columns: 1fr; }
        .np-featured-media { height: 350px; }
        .np-category-grid { grid-template-columns: repeat(auto-fill, minmax(230px, 1fr)); }
    }

    @media (max-width: 768px) {
        .np-masthead-logo { font-size: 38px; }
        .np-masthead-tagline { font-size: 10px; letter-spacing: 2px; }
        .np-hero-slider { height: 420px; }
        .np-slide-content { left: 24px; right: 24px; bottom: 50px; }
        .np-slide-title { font-size: 28px; }
        .np-slide-desc { font-size: 14px; }
        .np-slide-arrow { width: 38px; height: 38px; font-size: 14px; }
        .np-prev { left: 10px; }
        .np-next { right: 10px; }
        .np-slide-dots { right: 24px; }
        .np-section { padding: 50px 0; }
        .np-section-title { font-size: 28px; }
        .np-news-grid { grid-template-columns: 1fr; gap: 20px; }
        .np-card-media { height: 220px; }
        .np-featured-grid { grid-template-columns: 1fr; }
        .np-featured-media { height: 300px; }
        .np-featured-text h2 { font-size: 20px; }
        .np-side-link { padding: 12px; }
        .np-side-media { width: 80px; min-width: 80px; height: 65px; }
        .np-category-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
        .np-category-card { padding: 24px 16px; }
        .np-category-name { font-size: 17px; }
        .np-stats-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
        .np-stat-number { font-size: 28px; }
        .np-newsletter-title { font-size: 26px; }
        .np-newsletter-form { flex-direction: column; gap: 10px; }
        .np-newsletter-form input { text-align: center; }
        .np-newsletter-form button { justify-content: center; }
        .np-top-bar-right { display: none; }
        .np-breaking-label { padding: 0 12px; font-size: 10px; letter-spacing: 1px; }
        .np-ticker-content { font-size: 11px; gap: 40px; }
        .np-masthead { padding: 24px 16px 20px; }
    }

    @media (max-width: 480px) {
        .np-masthead-logo { font-size: 30px; }
        .np-hero-slider { height: 360px; }
        .np-slide-content { left: 16px; right: 16px; bottom: 40px; }
        .np-slide-title { font-size: 22px; }
        .np-slide-desc { font-size: 13px; margin-bottom: 16px; }
        .np-btn-primary { padding: 10px 20px; font-size: 11px; }
        .np-slide-arrow { display: none; }
        .np-section-title { font-size: 24px; }
        .np-news-grid { gap: 16px; }
        .np-card-media { height: 190px; }
        .np-card-body { padding: 14px 16px 18px; }
        .np-card-title { font-size: 16px; }
        .np-featured-media { height: 250px; }
        .np-featured-text { padding: 20px; }
        .np-featured-text h2 { font-size: 18px; }
        .np-category-grid { grid-template-columns: 1fr; }
        .np-category-card { padding: 20px 16px; }
        .np-stats-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
        .np-stat-item { padding: 12px; }
        .np-stat-number { font-size: 24px; }
        .np-newsletter { padding: 50px 0; }
        .np-newsletter-title { font-size: 22px; }
        .np-masthead-tagline { font-size: 9px; letter-spacing: 1.5px; }
        .np-edition-badge { font-size: 9px; padding: 2px 10px; }
        .np-scroll-top { bottom: 16px; right: 16px; width: 38px; height: 38px; font-size: 15px; }
    }
</style>

@endsection