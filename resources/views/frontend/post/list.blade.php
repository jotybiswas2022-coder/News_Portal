@extends('frontend.app')

@section('content')

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

    .np-alert-error {
        background: rgba(211, 47, 47, 0.1);
        border-bottom: 1px solid rgba(211, 47, 47, 0.15);
        color: #ef5350;
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

    .np-breaking-bar {
        background: var(--np-dark-3);
        border-bottom: 1px solid var(--np-border);
        padding: 10px 0;
        overflow: hidden;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .np-breaking-label {
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
        white-space: nowrap;
        flex-shrink: 0;
        animation: npPulseGlow 2s ease-in-out infinite;
    }

    .np-breaking-label i { font-size: 11px; }

    @keyframes npPulseGlow {
        0%, 100% { box-shadow: 0 0 0 0 rgba(211,47,47,0.4); }
        50% { box-shadow: 0 0 0 8px rgba(211,47,47,0); }
    }

    .np-ticker-wrap {
        flex: 1;
        overflow: hidden;
    }

    .np-ticker-content {
        display: flex;
        gap: 60px;
        white-space: nowrap;
        animation: npTickerScroll 35s linear infinite;
        font-size: 13px;
        color: var(--np-text-dim);
    }

    .np-ticker-content span {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .np-ticker-content span::before {
        content: '\25C6';
        color: var(--np-red);
        font-size: 8px;
    }

    @keyframes npTickerScroll {
        0% { transform: translateX(100%); }
        100% { transform: translateX(-100%); }
    }

    .np-list-wrap { padding: 40px 0 60px; }

    .np-list-header {
        text-align: center;
        padding: 20px 0 30px;
        position: relative;
    }

    .np-edition-date {
        font-size: 11px;
        color: var(--np-text-muted);
        text-transform: uppercase;
        letter-spacing: 3px;
        margin-bottom: 12px;
    }

    .np-masthead-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(211,47,47,0.1);
        color: var(--np-red);
        padding: 4px 14px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 16px;
        border: 1px solid rgba(211,47,47,0.15);
    }

    .np-list-title {
        font-family: var(--font-headline);
        font-size: 2.6rem;
        font-weight: 800;
        color: var(--np-white);
        margin-bottom: 10px;
        line-height: 1.15;
    }

    .np-list-title span { color: var(--np-red); text-shadow: 0 0 20px rgba(211,47,47,0.2); }

    .np-list-subtitle {
        color: var(--np-text-dim);
        font-size: 15px;
        max-width: 520px;
        margin: 0 auto 20px;
        line-height: 1.7;
    }

    .np-list-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        margin-bottom: 10px;
    }

    .np-list-divider .np-line { width: 60px; height: 1px; background: rgba(255,255,255,0.08); }
    .np-list-divider .np-line-thick { width: 40px; height: 2px; background: var(--np-red); }
    .np-list-divider i { color: var(--np-red); font-size: 10px; }

    .np-list-rule {
        border: none;
        height: 1px;
        background: linear-gradient(to right, transparent, rgba(255,255,255,0.08), transparent);
        margin: 0 0 30px;
    }

    .np-news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 28px;
    }

    @media (max-width: 768px) { .np-news-grid { grid-template-columns: 1fr; gap: 20px; } }

    .np-card {
        background: rgba(18, 18, 30, 0.85);
        backdrop-filter: blur(16px);
        border: 1px solid var(--np-border);
        overflow: hidden;
        transition: all 0.4s ease;
        position: relative;
        display: flex;
        flex-direction: column;
        opacity: 0;
        transform: translateY(30px);
    }

    .np-card.np-visible { opacity: 1; transform: translateY(0); }

    .np-card:hover { transform: translateY(-6px); border-color: rgba(211,47,47,0.08); box-shadow: var(--np-shadow); }

    .np-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: var(--np-red);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.5s ease;
        z-index: 3;
    }

    .np-card:hover::before { transform: scaleX(1); }

    .np-card-media {
        position: relative;
        overflow: hidden;
        height: 210px;
        background: var(--np-dark-2);
    }

    .np-card-media img,
    .np-card-media video {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .np-card:hover .np-card-media img { transform: scale(1.06); }

    .np-card-overlay {
        position: absolute;
        inset: 0;
        background: rgba(10,10,15,0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .np-card:hover .np-card-overlay { opacity: 1; }

    .np-read-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--np-white);
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        padding: 10px 22px;
        border: 2px solid rgba(255,255,255,0.8);
        transition: all 0.3s;
        transform: translateY(10px);
        transition: transform 0.4s ease, background 0.3s, border-color 0.3s;
    }

    .np-card:hover .np-read-btn { transform: translateY(0); }
    .np-read-btn:hover { background: var(--np-red); border-color: var(--np-red); }

    .np-cat-ribbon {
        position: absolute;
        top: 12px; left: 12px;
        background: var(--np-red);
        color: var(--np-white);
        padding: 3px 12px;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        z-index: 2;
        box-shadow: 0 2px 8px rgba(211,47,47,0.3);
    }

    .np-card-media-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        background: var(--np-dark-3);
        color: var(--np-text-muted);
        gap: 8px;
    }

    .np-card-media-placeholder i { font-size: 2rem; }
    .np-card-media-placeholder p { font-size: 12px; color: var(--np-text-muted); }

    .np-card-body { padding: 18px 20px 22px; flex: 1; display: flex; flex-direction: column; }

    .np-card-title {
        font-family: var(--font-headline);
        font-size: 17px;
        font-weight: 700;
        color: var(--np-white);
        line-height: 1.35;
        margin-bottom: 12px;
        transition: color 0.3s;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .np-card:hover .np-card-title { color: var(--np-red); }

    .np-card-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: auto;
        padding-top: 14px;
        border-top: 1px solid var(--np-border);
    }

    .np-meta-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        font-size: 10px;
        font-weight: 600;
        letter-spacing: 0.5px;
        border: 1px solid var(--np-border);
        color: var(--np-text-dim);
        background: rgba(255,255,255,0.02);
    }

    .np-meta-badge i { color: var(--np-red); font-size: 9px; }

    .np-empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 80px 30px;
        border: 1px dashed var(--np-border);
        background: var(--np-dark-2);
    }

    .np-empty-icon {
        width: 80px; height: 80px;
        margin: 0 auto 20px;
        background: rgba(211,47,47,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        animation: npEmptyPulse 2.5s ease-in-out infinite;
    }

    .np-empty-icon i { font-size: 2rem; color: var(--np-red); }

    @keyframes npEmptyPulse {
        0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(211,47,47,0.3); }
        50% { transform: scale(1.05); box-shadow: 0 0 0 15px rgba(211,47,47,0); }
    }

    .np-empty-state h5 {
        font-family: var(--font-headline);
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--np-white);
        margin-bottom: 10px;
    }

    .np-empty-state p { color: var(--np-text-dim); font-size: 14px; }

    .np-scroll-top {
        position: fixed;
        bottom: 30px; right: 30px;
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

    @media (max-width: 992px) {
        .np-list-title { font-size: 2rem; }
        .np-news-grid { grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); }
    }

    @media (max-width: 576px) {
        .np-list-title { font-size: 1.6rem; }
        .np-card-media { height: 180px; }
        .np-card-title { font-size: 15px; }
    }
</style>

@if(session('success'))
<div class="np-alert-bar">
    <i class="bi bi-check-circle"></i> {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="np-alert-error">
    <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
</div>
@endif

<div class="np-breaking-bar">
    <div class="np-container" style="display:flex;align-items:center;gap:16px;width:100%;">
        <span class="np-breaking-label"><i class="bi bi-lightning-charge-fill"></i> Breaking</span>
        <div class="np-ticker-wrap">
            <div class="np-ticker-content">
                <span>Stay updated with the latest news from around the world</span>
                <span>News Portal brings you real-time coverage of events that matter</span>
                <span>Your trusted source for breaking news and in-depth analysis</span>
                <span>Subscribe now for exclusive stories and daily briefings</span>
            </div>
        </div>
    </div>
</div>

<main class="np-list-wrap">
    <div class="np-container">

        <div class="np-list-header">
            <div class="np-edition-date">
                <i class="bi bi-calendar3"></i> Today's Edition &bull; {{ now()->timezone('Asia/Dhaka')->format('l, d F Y') }}
            </div>
            <div class="np-masthead-label">
                <i class="bi bi-newspaper"></i> News Portal
            </div>
            <h2 class="np-list-title">Latest <span>News</span></h2>
            <p class="np-list-subtitle">Browse the latest news articles, stories, and updates from our newsroom</p>
            <div class="np-list-divider">
                <span class="np-line"></span>
                <span class="np-line-thick"></span>
                <i class="bi bi-diamond-fill"></i>
                <span class="np-line-thick"></span>
                <span class="np-line"></span>
            </div>
        </div>

        <hr class="np-list-rule">

        <div class="np-news-grid">
            @forelse(($posts ?? collect())->sortByDesc('created_at') as $post)
            <article class="np-card">
                <div class="np-card-media">
                    @php
                        $ext = strtolower(pathinfo($post->file, PATHINFO_EXTENSION));
                        $videoExtensions = ['mp4','webm','ogg','avi','mkv'];
                        $imageExtensions = ['jpg','jpeg','png','gif','webp'];
                        $isImage = in_array($ext, $imageExtensions);
                        $isVideo = in_array($ext, $videoExtensions);
                    @endphp

                    @if($post->file && $isImage)
                        <img src="{{ config('app.storage_url') }}{{ $post->file }}" alt="{{ $post->title }}" loading="lazy">
                    @elseif($post->file && $isVideo)
                        <video muted><source src="{{ config('app.storage_url') }}{{ $post->file }}" type="video/mp4"></video>
                    @else
                        <div class="np-card-media-placeholder">
                            <i class="bi bi-image"></i>
                            <p>No Media Available</p>
                        </div>
                    @endif

                    <span class="np-cat-ribbon"><i class="bi bi-tag-fill"></i> {{ $post->PostCategory->name ?? 'News' }}</span>

                    <div class="np-card-overlay">
                        <a href="{{ url('/post/'.$post->id) }}" class="np-read-btn">
                            <i class="bi bi-book-half"></i> Read Article
                        </a>
                    </div>
                </div>

                <div class="np-card-body">
                    <h3 class="np-card-title">{{ $post->title }}</h3>
                    <div class="np-card-meta">
                        <span class="np-meta-badge">
                            <i class="bi bi-calendar-event"></i>
                            {{ \Carbon\Carbon::parse($post->created_at)->timezone('Asia/Dhaka')->format('d M Y') }}
                        </span>
                        <span class="np-meta-badge">
                            <i class="bi bi-clock"></i>
                            {{ \Carbon\Carbon::parse($post->created_at)->timezone('Asia/Dhaka')->format('h:i A') }}
                        </span>
                    </div>
                </div>
            </article>
            @empty
            <div class="np-empty-state">
                <div class="np-empty-icon">
                    <i class="bi bi-newspaper"></i>
                </div>
                <h5>No News Articles Available</h5>
                <p>Check back later for the latest updates and breaking stories.</p>
            </div>
            @endforelse
        </div>

    </div>
</main>

<button class="np-scroll-top" id="scrollTopBtn" onclick="window.scrollTo({top:0,behavior:'smooth'})">
    <i class="bi bi-arrow-up"></i>
</button>

<script>
    window.addEventListener('scroll', function() {
        var btn = document.getElementById('scrollTopBtn');
        if (btn) { btn.classList.toggle('visible', window.scrollY > 300); }
    });

    document.addEventListener('DOMContentLoaded', function() {
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('np-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('.np-card').forEach(function(el) {
            observer.observe(el);
        });

        document.querySelectorAll('.np-alert-bar, .np-alert-error').forEach(function(alert) {
            setTimeout(function() {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(function() { if (alert.parentNode) alert.remove(); }, 500);
            }, 5000);
        });
    });
</script>

@endsection
