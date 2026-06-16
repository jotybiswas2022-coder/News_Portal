@extends('frontend.app')

@section('content')

@if(session('success'))
<div class="np-alert-bar">
    <i class="bi bi-check-circle"></i> {{ session('success') }}
</div>
@endif

<div class="np-home-wrap">

    <!-- ===== HERO SLIDER ===== -->
    <section class="np-hero-section">
        <div class="np-hero-slider" id="heroSlider">
            @if($slider && ($slider->slider1 || $slider->slider2))
                @if($slider->slider1)
                <div class="np-hero-slide active" data-index="0">
                    <img src="{{ config('app.storage_url') }}{{ $slider->slider1 }}" alt="Breaking News">
                    <div class="np-hero-overlay"></div>
                    <div class="np-hero-content">
                        <span class="np-hero-badge"><i class="bi bi-megaphone"></i> Breaking News</span>
                        <h2 class="np-hero-title">Welcome to <span>News Portal</span></h2>
                        <p class="np-hero-desc">Stay informed with the latest headlines, in-depth reports, and stories from around the world.</p>
                        <a href="#latestNews" class="np-hero-btn">Read Latest News <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                @endif

                @if($slider->slider2)
                <div class="np-hero-slide {{ !$slider->slider1 ? 'active' : '' }}" data-index="{{ $slider->slider1 ? 1 : 0 }}">
                    <img src="{{ config('app.storage_url') }}{{ $slider->slider2 }}" alt="Latest Updates">
                    <div class="np-hero-overlay"></div>
                    <div class="np-hero-content">
                        <span class="np-hero-badge"><i class="bi bi-stars"></i> Latest Updates</span>
                        <h2 class="np-hero-title">Discover <span>Latest Stories</span></h2>
                        <p class="np-hero-desc">Explore breaking news, trending topics, and in-depth coverage from trusted sources.</p>
                        <a href="#categories" class="np-hero-btn">Explore Categories <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                @endif
            @else
                <div class="np-hero-slide active">
                    <div class="np-hero-placeholder">
                        <div class="np-hero-content" style="position:relative;bottom:auto;left:auto;text-align:center;">
                            <span class="np-hero-badge"><i class="bi bi-newspaper"></i> News Portal</span>
                            <h2 class="np-hero-title">Welcome to <span>News Portal</span></h2>
                            <p class="np-hero-desc">Your trusted source for the latest news, stories, and updates from around the world.</p>
                        </div>
                    </div>
                </div>
            @endif

            <button class="np-hero-arrow np-hero-prev" onclick="changeSlide(-1)"><i class="bi bi-chevron-left"></i></button>
            <button class="np-hero-arrow np-hero-next" onclick="changeSlide(1)"><i class="bi bi-chevron-right"></i></button>

            <div class="np-hero-dots" id="slideDots">
                @if($slider && ($slider->slider1 || $slider->slider2))
                    @if($slider->slider1) <button class="np-hero-dot active" data-index="0" onclick="goToSlide(0)"></button> @endif
                    @if($slider->slider2) <button class="np-hero-dot" data-index="{{ $slider->slider1 ? 1 : 0 }}" onclick="goToSlide({{ $slider->slider1 ? 1 : 0 }})"></button> @endif
                @endif
            </div>
        </div>
    </section>

    <!-- ===== LATEST NEWS ===== -->
    <section class="np-section" id="latestNews">
        <div class="np-container">
            <div class="np-section-head">
                <span class="np-section-label"><i class="bi bi-newspaper"></i> News Portal</span>
                <h2 class="np-section-title">Latest <span>News</span></h2>
                <div class="np-section-line">
                    <span class="np-s-line"></span>
                    <i class="bi bi-diamond-fill"></i>
                    <span class="np-s-line"></span>
                </div>
                <p class="np-section-desc">Stay updated with the most recent news, stories, and reports from our newsroom</p>
            </div>

            <div class="np-news-grid" id="newsGrid">
                @if(isset($posts) && $posts->count() > 0)
                    @foreach($posts->take(6) as $index => $post)
                    <article class="np-card" style="--card-delay: {{ $index * 0.08 }}s;">
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
                                    <div class="np-card-no-media"><i class="bi bi-image"></i></div>
                                @endif

                                <div class="np-card-overlay">
                                    <span class="np-card-read">Read Article <i class="bi bi-arrow-right"></i></span>
                                </div>

                                @if($post->PostCategory)
                                <span class="np-card-cat">{{ $post->PostCategory->name ?? 'News' }}</span>
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
                    <div class="np-empty">
                        <div class="np-empty-icon"><i class="bi bi-newspaper"></i></div>
                        <h4>No News Articles Yet</h4>
                        <p>Check back soon for the latest updates and breaking stories.</p>
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

    <!-- ===== FEATURED STORY ===== -->
    @if(isset($posts) && $posts->count() >= 2)
    @php $featured = $posts->sortByDesc('created_at')->first(); @endphp
    <section class="np-featured">
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
                            <div class="np-featured-placeholder"><i class="bi bi-image"></i></div>
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
                                    <div class="np-featured-placeholder" style="height:100%;min-height:80px;"><i class="bi bi-image"></i></div>
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

    <!-- ===== CATEGORIES ===== -->
    <section class="np-section np-categories" id="categories">
        <div class="np-container">
            <div class="np-section-head">
                <span class="np-section-label"><i class="bi bi-grid"></i> Browse</span>
                <h2 class="np-section-title">News <span>Categories</span></h2>
                <div class="np-section-line">
                    <span class="np-s-line"></span>
                    <i class="bi bi-diamond-fill"></i>
                    <span class="np-s-line"></span>
                </div>
                <p class="np-section-desc">Explore news by category — find the stories that matter to you</p>
            </div>

            <div class="np-cat-grid">
                @foreach($categories as $category)
                <a href="{{ url('category/'.$category->id) }}" class="np-cat-card">
                    <div class="np-cat-icon"><i class="bi bi-collection"></i></div>
                    <h3 class="np-cat-name">{{ $category->name }}</h3>
                    <p class="np-cat-desc">{{ $category->description ?? 'Latest news and reports in this category' }}</p>
                    <span class="np-cat-arrow"><i class="bi bi-arrow-right"></i></span>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ===== NEWSLETTER ===== -->
    <section class="np-newsletter">
        <div class="np-container">
            <div class="np-newsletter-content">
                <div class="np-newsletter-icon"><i class="bi bi-envelope-paper"></i></div>
                <h2 class="np-newsletter-title">Subscribe to Our <span>Newsletter</span></h2>
                <p class="np-newsletter-text">Get daily news delivered straight to your inbox. Stay informed with the stories that matter.</p>
                <form class="np-newsletter-form" onsubmit="handleSubscribe(event)">
                    <input type="email" placeholder="Enter your email address" required>
                    <button type="submit">Subscribe <i class="bi bi-send"></i></button>
                </form>
            </div>
        </div>
    </section>

    <!-- ===== STATS ===== -->
    <div class="np-stats">
        <div class="np-container">
            <div class="np-stats-grid">
                <div class="np-stat">
                    <div class="np-stat-icon"><i class="bi bi-newspaper"></i></div>
                    <div class="np-stat-num" data-count="{{ $posts ? $posts->count() : 0 }}">{{ $posts ? $posts->count() : 0 }}</div>
                    <div class="np-stat-label">Published Articles</div>
                </div>
                <div class="np-stat">
                    <div class="np-stat-icon"><i class="bi bi-collection"></i></div>
                    <div class="np-stat-num" data-count="{{ $categories->count() }}">{{ $categories->count() }}</div>
                    <div class="np-stat-label">News Categories</div>
                </div>
                <div class="np-stat">
                    <div class="np-stat-icon"><i class="bi bi-people"></i></div>
                    <div class="np-stat-num" data-count="24">24</div>
                    <div class="np-stat-label">Team Members</div>
                </div>
                <div class="np-stat">
                    <div class="np-stat-icon"><i class="bi bi-globe2"></i></div>
                    <div class="np-stat-num" data-count="7">7</div>
                    <div class="np-stat-label">Days a Week</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== SCROLL TOP ===== -->
    <button class="np-scroll-top" id="scrollTopBtn" onclick="window.scrollTo({top:0,behavior:'smooth'})">
        <i class="bi bi-arrow-up"></i>
    </button>

</div>

@include('frontend.partials.footer')

<script>
    window.addEventListener('load', () => {
        setTimeout(() => {
            const loader = document.querySelector('.np-page-loader');
            if (loader) loader.classList.add('np-hidden');
        }, 500);
    });

    let currentSlide = 0;
    const slides = document.querySelectorAll('.np-hero-slide');
    const dots = document.querySelectorAll('.np-hero-dot');
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
        const content = slides[currentSlide].querySelector('.np-hero-content');
        if (content) {
            content.style.animation = 'none';
            content.offsetHeight;
            content.style.animation = 'npHeroUp 0.8s ease-out';
        }
    }

    function changeSlide(direction) {
        goToSlide(currentSlide + direction);
        clearInterval(sliderInterval);
        sliderInterval = setInterval(() => changeSlide(1), 5000);
    }

    sliderInterval = setInterval(() => changeSlide(1), 5000);

    const revealEls = document.querySelectorAll('.np-card, .np-cat-card, .np-stat, .np-side-card');
    const revealObs = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('np-visible');
                revealObs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
    revealEls.forEach(el => revealObs.observe(el));

    const counters = document.querySelectorAll('.np-stat-num[data-count]');
    const counterObs = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.getAttribute('data-count'));
                const duration = 2000;
                const step = Math.max(1, target / (duration / 16));
                let current = 0;
                const counter = setInterval(() => {
                    current += step;
                    if (current >= target) { current = target; clearInterval(counter); }
                    el.textContent = Math.floor(current).toLocaleString();
                }, 16);
                counterObs.unobserve(el);
            }
        });
    }, { threshold: 0.5 });
    counters.forEach(el => counterObs.observe(el));

    window.addEventListener('scroll', () => {
        const btn = document.getElementById('scrollTopBtn');
        if (window.scrollY > 400) btn.classList.add('visible');
        else btn.classList.remove('visible');
    });

    function handleSubscribe(e) {
        e.preventDefault();
        const input = e.target.querySelector('input');
        const email = input.value;
        const msg = document.createElement('div');
        msg.className = 'np-alert-bar';
        msg.innerHTML = '<i class="bi bi-check-circle"></i> Thank you for subscribing! You will receive daily news at ' + email;
        document.body.insertBefore(msg, document.body.firstChild);
        input.value = '';
        setTimeout(() => { msg.style.opacity = '0'; msg.style.transition = 'opacity 0.5s'; setTimeout(() => msg.remove(), 500); }, 4000);
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
    const slider = document.querySelector('.np-hero-slider');
    if (slider) {
        slider.addEventListener('touchstart', (e) => { touchStartX = e.changedTouches[0].screenX; }, { passive: true });
        slider.addEventListener('touchend', (e) => {
            const diff = touchStartX - e.changedTouches[0].screenX;
            if (Math.abs(diff) > 50) { if (diff > 0) changeSlide(1); else changeSlide(-1); }
        }, { passive: true });
    }
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap');

    :root {
        --np-dark-1: #0a0a0f;
        --np-dark-2: #111118;
        --np-dark-3: #1a1a24;
        --np-dark-4: #242430;
        --np-red: #D32F2F;
        --np-red-dark: #B71C1C;
        --np-white: #FFFFFF;
        --np-text: #d0d0d8;
        --np-text-dim: #8888a0;
        --np-text-muted: #555568;
        --np-border: rgba(255,255,255,0.06);
        --np-border-light: rgba(255,255,255,0.04);
        --font-headline: 'Playfair Display', Georgia, serif;
        --font-ui: 'Inter', Arial, sans-serif;
        --np-shadow: 0 4px 24px rgba(0,0,0,0.3);
    }

    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
    html { scroll-behavior: smooth; }
    body { font-family: var(--font-ui); color: var(--np-text); background: var(--np-dark-1); overflow-x: hidden; }
    a { text-decoration: none; color: inherit; }
    img { max-width: 100%; height: auto; }

    .np-container { max-width: 1280px; margin: 0 auto; padding: 0 24px; }
    @media (max-width: 768px) { .np-container { padding: 0 16px; } }

    .np-alert-bar {
        background: rgba(0, 200, 83, 0.1);
        border-bottom: 1px solid rgba(0, 200, 83, 0.15);
        color: #00c853;
        padding: 12px 24px;
        text-align: center;
        font-size: 13px;
        font-weight: 500;
        animation: npAlertDown 0.5s ease-out;
    }

    @keyframes npAlertDown {
        from { transform: translateY(-100%); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .np-hero-section { position: relative; }
    .np-hero-slider {
        position: relative;
        width: 100%;
        height: 520px;
        overflow: hidden;
        background: var(--np-dark-1);
    }
    .np-hero-slide {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        opacity: 0;
        transition: opacity 1s ease-in-out, transform 1.2s ease;
        transform: scale(1.05);
    }
    .np-hero-slide.active { opacity: 1; transform: scale(1); z-index: 1; }
    .np-hero-slide img { width: 100%; height: 100%; object-fit: cover; filter: brightness(0.4); }
    .np-hero-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(10,10,15,0.95) 0%, rgba(10,10,15,0.5) 40%, rgba(10,10,15,0.2) 100%);
    }
    .np-hero-placeholder {
        width: 100%; height: 100%;
        display: flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, var(--np-dark-2), var(--np-dark-3));
    }
    .np-hero-content {
        position: absolute;
        bottom: 70px;
        left: 60px;
        right: 60px;
        z-index: 2;
        max-width: 680px;
        animation: npHeroUp 0.8s ease-out;
    }
    @keyframes npHeroUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    .np-hero-badge {
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
        animation: npHeroBadgeIn 0.6s ease-out 0.3s both;
    }
    @keyframes npHeroBadgeIn { from { transform: translateX(-30px); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
    .np-hero-title {
        font-family: var(--font-headline);
        font-size: 44px;
        font-weight: 800;
        color: var(--np-white);
        line-height: 1.15;
        margin-bottom: 14px;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
    }
    .np-hero-title span { color: var(--np-red); }
    .np-hero-desc {
        color: rgba(255,255,255,0.8);
        font-size: 16px;
        line-height: 1.7;
        margin-bottom: 24px;
        max-width: 520px;
    }
    .np-hero-btn {
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
        transition: all 0.3s ease;
    }
    .np-hero-btn:hover { background: var(--np-red-dark); transform: translateY(-2px); box-shadow: 0 8px 25px rgba(211,47,47,0.35); color: var(--np-white); }
    .np-hero-btn i { transition: transform 0.3s; }
    .np-hero-btn:hover i { transform: translateX(4px); }

    .np-hero-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 5;
        background: rgba(0,0,0,0.5);
        border: 1px solid var(--np-border);
        color: var(--np-white);
        width: 46px; height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 18px;
        transition: all 0.3s;
        opacity: 0;
    }
    .np-hero-slider:hover .np-hero-arrow { opacity: 1; }
    .np-hero-arrow:hover { background: var(--np-red); border-color: var(--np-red); }
    .np-hero-prev { left: 20px; }
    .np-hero-next { right: 20px; }

    .np-hero-dots {
        position: absolute;
        bottom: 24px;
        right: 60px;
        display: flex;
        gap: 8px;
        z-index: 5;
    }
    .np-hero-dot {
        width: 12px; height: 4px;
        border-radius: 2px;
        background: rgba(255,255,255,0.4);
        border: none;
        cursor: pointer;
        transition: all 0.3s;
    }
    .np-hero-dot.active { width: 32px; background: var(--np-red); }

    .np-section { padding: 70px 0; background: var(--np-dark-1); position: relative; }
    .np-section-head { text-align: center; margin-bottom: 40px; }
    .np-section-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(211,47,47,0.1);
        color: var(--np-red);
        padding: 4px 14px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 14px;
        border: 1px solid rgba(211,47,47,0.15);
    }
    .np-section-title {
        font-family: var(--font-headline);
        font-size: 38px;
        font-weight: 800;
        color: var(--np-white);
        margin-bottom: 12px;
        line-height: 1.2;
    }
    .np-section-title span { color: var(--np-red); text-shadow: 0 0 20px rgba(211,47,47,0.2); }
    .np-section-line { display: flex; align-items: center; justify-content: center; gap: 12px; margin-bottom: 12px; }
    .np-section-line .np-s-line { width: 60px; height: 1px; background: rgba(255,255,255,0.08); }
    .np-section-line i { color: var(--np-red); font-size: 10px; }
    .np-section-desc { color: var(--np-text-dim); font-size: 15px; max-width: 520px; margin: 0 auto; line-height: 1.7; }

    .np-news-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; }
    @media (max-width: 992px) { .np-news-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 576px) { .np-news-grid { grid-template-columns: 1fr; } }

    .np-card {
        background: rgba(18, 18, 30, 0.85);
        backdrop-filter: blur(16px);
        border: 1px solid var(--np-border);
        overflow: hidden;
        transition: all 0.4s ease;
        opacity: 0;
        transform: translateY(30px);
        animation: npCardIn 0.6s ease-out var(--card-delay, 0s) forwards;
    }
    .np-card.np-visible { opacity: 1; transform: translateY(0); }
    @keyframes npCardIn { to { opacity: 1; transform: translateY(0); } }
    .np-card:hover { transform: translateY(-6px); border-color: rgba(211,47,47,0.08); box-shadow: 0 12px 50px rgba(0,0,0,0.3); }
    .np-card-link { display: block; color: inherit; }
    .np-card-media { position: relative; overflow: hidden; height: 200px; background: var(--np-dark-2); }
    .np-card-media img, .np-card-media video { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease; }
    .np-card:hover .np-card-media img { transform: scale(1.06); }
    .np-card-no-media { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: var(--np-dark-3); color: var(--np-text-muted); font-size: 2.5rem; }
    .np-card-overlay {
        position: absolute; inset: 0;
        background: rgba(10,10,15,0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.4s ease;
    }
    .np-card:hover .np-card-overlay { opacity: 1; }
    .np-card-read {
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
    }
    .np-card-read:hover { background: var(--np-red); border-color: var(--np-red); }
    .np-card-cat {
        position: absolute;
        top: 12px; left: 12px;
        background: var(--np-red);
        color: var(--np-white);
        padding: 3px 12px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        z-index: 2;
    }
    .np-card-body { padding: 18px 20px 22px; }
    .np-card-meta { display: flex; gap: 14px; font-size: 11px; color: var(--np-text-muted); margin-bottom: 8px; }
    .np-card-meta i { color: var(--np-red); margin-right: 3px; }
    .np-card-title {
        font-family: var(--font-headline);
        font-size: 17px;
        font-weight: 700;
        color: var(--np-white);
        line-height: 1.35;
        margin-bottom: 8px;
        transition: color 0.3s;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .np-card:hover .np-card-title { color: var(--np-red); }
    .np-card-excerpt { font-size: 13px; color: var(--np-text-dim); line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

    .np-empty {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 30px;
        border: 1px dashed var(--np-border);
    }
    .np-empty-icon { width: 80px; height: 80px; margin: 0 auto 20px; background: rgba(211,47,47,0.1); display: flex; align-items: center; justify-content: center; border-radius: 50%; }
    .np-empty-icon i { font-size: 2rem; color: var(--np-red); }
    .np-empty h4 { font-family: var(--font-headline); font-size: 1.5rem; font-weight: 700; color: var(--np-white); margin-bottom: 8px; }
    .np-empty p { color: var(--np-text-dim); font-size: 1rem; }

    .np-view-all { text-align: center; margin-top: 40px; }
    .np-btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 32px;
        border: 1px solid rgba(255,255,255,0.1);
        color: var(--np-text);
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        transition: all 0.3s;
    }
    .np-btn-outline:hover { border-color: var(--np-red); color: var(--np-white); background: rgba(211,47,47,0.05); transform: translateY(-2px); }

    .np-featured { padding: 0 0 70px; background: var(--np-dark-2); position: relative; }
    .np-featured-grid { display: grid; grid-template-columns: 1.5fr 1fr; gap: 30px; align-items: start; }
    @media (max-width: 992px) { .np-featured-grid { grid-template-columns: 1fr; } }
    .np-featured-media { position: relative; overflow: hidden; height: 420px; }
    .np-featured-media img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s ease; }
    .np-featured-media:hover img { transform: scale(1.05); }
    .np-featured-placeholder { width: 100%; height: 100%; min-height: 200px; display: flex; align-items: center; justify-content: center; background: var(--np-dark-3); color: var(--np-text-muted); font-size: 3rem; }
    .np-featured-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(10,10,15,0.9) 0%, rgba(10,10,15,0.4) 40%, transparent 100%); }
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
    }
    .np-featured-text h2 { font-family: var(--font-headline); font-size: 26px; font-weight: 800; color: var(--np-white); line-height: 1.25; margin-bottom: 8px; }
    .np-featured-text h2 a { color: var(--np-white); transition: color 0.3s; }
    .np-featured-text h2 a:hover { color: var(--np-red); }
    .np-featured-text p { color: rgba(255,255,255,0.8); font-size: 14px; line-height: 1.7; margin-bottom: 10px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    .np-featured-meta { display: flex; gap: 16px; font-size: 11px; color: rgba(255,255,255,0.6); }
    .np-featured-meta i { color: var(--np-red); margin-right: 3px; }
    .np-featured-side { display: flex; flex-direction: column; gap: 16px; }
    .np-side-card { background: rgba(18, 18, 30, 0.85); border: 1px solid var(--np-border); overflow: hidden; transition: all 0.4s ease; opacity: 0; transform: translateX(20px); }
    .np-side-card.np-visible { opacity: 1; transform: translateX(0); }
    .np-side-card:hover { transform: translateX(6px); border-color: rgba(211,47,47,0.08); }
    .np-side-link { display: flex; gap: 14px; padding: 14px; color: inherit; }
    .np-side-media { width: 100px; min-width: 100px; height: 80px; overflow: hidden; }
    .np-side-media img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
    .np-side-card:hover .np-side-media img { transform: scale(1.08); }
    .np-side-text { flex: 1; }
    .np-side-text h4 { font-family: var(--font-headline); font-size: 14px; font-weight: 700; color: var(--np-white); line-height: 1.35; margin-bottom: 6px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; transition: color 0.3s; }
    .np-side-card:hover .np-side-text h4 { color: var(--np-red); }
    .np-side-date { font-size: 11px; color: var(--np-text-muted); }
    .np-side-date i { color: var(--np-red); margin-right: 3px; }

    .np-categories { background: var(--np-dark-1); }
    .np-cat-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 24px; }
    .np-cat-card {
        background: rgba(18, 18, 30, 0.85);
        border: 1px solid var(--np-border);
        padding: 32px 24px;
        text-align: center;
        transition: all 0.4s ease;
        opacity: 0;
        transform: translateY(30px);
    }
    .np-cat-card.np-visible { opacity: 1; transform: translateY(0); }
    .np-cat-card:hover { border-color: rgba(211,47,47,0.08); transform: translateY(-6px); box-shadow: var(--np-shadow); }
    .np-cat-icon { width: 56px; height: 56px; margin: 0 auto 16px; background: rgba(211,47,47,0.1); display: flex; align-items: center; justify-content: center; font-size: 22px; color: var(--np-red); transition: all 0.3s; }
    .np-cat-card:hover .np-cat-icon { background: var(--np-red); color: var(--np-white); transform: rotate(-5deg) scale(1.1); }
    .np-cat-name { font-family: var(--font-headline); font-size: 20px; font-weight: 700; color: var(--np-white); margin-bottom: 8px; transition: color 0.3s; }
    .np-cat-card:hover .np-cat-name { color: var(--np-red); }
    .np-cat-desc { font-size: 13px; color: var(--np-text-dim); line-height: 1.6; margin-bottom: 14px; }
    .np-cat-arrow i { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: rgba(255,255,255,0.03); color: var(--np-text); font-size: 14px; transition: all 0.3s; }
    .np-cat-card:hover .np-cat-arrow i { background: var(--np-red); color: var(--np-white); transform: translateX(4px); }

    .np-newsletter {
        padding: 70px 0;
        background: var(--np-dark-2);
        position: relative;
        overflow: hidden;
    }
    .np-newsletter-content { max-width: 600px; margin: 0 auto; text-align: center; position: relative; z-index: 1; }
    .np-newsletter-icon { width: 64px; height: 64px; margin: 0 auto 20px; background: rgba(211,47,47,0.1); display: flex; align-items: center; justify-content: center; font-size: 26px; color: var(--np-red); }
    .np-newsletter-title { font-family: var(--font-headline); font-size: 32px; font-weight: 800; color: var(--np-white); margin-bottom: 12px; }
    .np-newsletter-title span { color: var(--np-red); }
    .np-newsletter-text { color: var(--np-text-dim); font-size: 15px; margin-bottom: 24px; line-height: 1.7; }
    .np-newsletter-form { display: flex; justify-content: center; gap: 0; max-width: 480px; margin: 0 auto; }
    .np-newsletter-form input {
        flex: 1;
        padding: 14px 18px;
        border: 1px solid var(--np-border);
        background: rgba(255,255,255,0.03);
        color: var(--np-text);
        font-size: 14px;
        outline: none;
        transition: border-color 0.3s;
        font-family: var(--font-ui);
    }
    .np-newsletter-form input::placeholder { color: var(--np-text-muted); }
    .np-newsletter-form input:focus { border-color: rgba(211,47,47,0.3); }
    .np-newsletter-form button {
        padding: 14px 24px;
        background: var(--np-red);
        color: var(--np-white);
        border: 1px solid var(--np-red);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s;
        font-family: var(--font-ui);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .np-newsletter-form button:hover { background: var(--np-red-dark); border-color: var(--np-red-dark); }

    .np-stats { padding: 50px 0; background: var(--np-dark-1); border-top: 1px solid var(--np-border); border-bottom: 1px solid var(--np-border); }
    .np-stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; text-align: center; }
    @media (max-width: 768px) { .np-stats-grid { grid-template-columns: repeat(2, 1fr); } }
    .np-stat { padding: 16px; opacity: 0; transform: translateY(20px); }
    .np-stat.np-visible { opacity: 1; transform: translateY(0); }
    .np-stat-icon { font-size: 26px; color: var(--np-red); margin-bottom: 10px; }
    .np-stat-num { font-family: var(--font-headline); font-size: 36px; font-weight: 800; color: var(--np-white); margin-bottom: 4px; }
    .np-stat-label { font-size: 12px; text-transform: uppercase; letter-spacing: 2px; color: var(--np-text-dim); font-weight: 500; }

    .np-scroll-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 44px; height: 44px;
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
    .np-scroll-top:hover { background: var(--np-red-dark); transform: translateY(-3px); }

    @media (max-width: 576px) {
        .np-hero-slider { height: 360px; }
        .np-hero-content { bottom: 40px; left: 24px; right: 24px; }
        .np-hero-title { font-size: 28px; }
        .np-hero-desc { font-size: 14px; }
        .np-section-title { font-size: 28px; }
        .np-hero-arrow { display: none; }
    }
</style>

@endsection
