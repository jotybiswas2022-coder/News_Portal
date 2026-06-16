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

    .np-article-wrap { padding: 40px 0 60px; }

    .np-edition-bar {
        text-align: center;
        padding-bottom: 20px;
        margin-bottom: 20px;
        border-bottom: 1px solid var(--np-border);
        animation: npFadeIn 0.6s ease-out;
    }

    .np-edition-bar span {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--np-text-muted);
    }

    .np-edition-bar i { color: var(--np-red); margin-right: 4px; }

    .np-article-masthead {
        text-align: center;
        padding: 10px 0 24px;
        animation: npPaperDrop 0.7s ease-out;
    }

    .np-cat-flag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--np-red);
        color: var(--np-white);
        padding: 5px 16px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 16px;
        animation: npStampIn 0.5s ease-out 0.3s both;
    }

    .np-article-title {
        font-family: var(--font-headline);
        font-size: 2.4rem;
        font-weight: 800;
        color: var(--np-white);
        line-height: 1.15;
        max-width: 800px;
        margin: 0 auto;
        animation: npRevealUp 0.6s ease-out 0.2s both;
    }

    .np-article-meta {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 18px;
        margin-top: 16px;
        flex-wrap: wrap;
        animation: npFadeIn 0.6s ease-out 0.5s both;
    }

    .np-article-meta .np-meta-item {
        font-size: 12px;
        color: var(--np-text-dim);
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .np-article-meta .np-meta-item i { color: var(--np-red); font-size: 11px; }
    .np-meta-dot { width: 3px; height: 3px; background: var(--np-text-muted); border-radius: 50%; }

    .np-article-rule {
        border: none;
        height: 2px;
        background: linear-gradient(to right, transparent, var(--np-red), transparent);
        margin: 0 0 30px;
        animation: npLineExtend 0.8s ease-out;
        transform-origin: center;
    }

    @keyframes npLineExtend {
        from { transform: scaleX(0); opacity: 0; }
        to { transform: scaleX(1); opacity: 1; }
    }

    @keyframes npPaperDrop {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes npStampIn {
        from { transform: scale(2.5) rotate(-10deg); opacity: 0; }
        to { transform: scale(1) rotate(0deg); opacity: 1; }
    }

    @keyframes npRevealUp {
        from { opacity: 0; transform: translateY(25px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes npFadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .np-article-layout { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start; }
    @media (max-width: 992px) { .np-article-layout { grid-template-columns: 1fr; } }

    .np-featured-media {
        position: relative;
        overflow: hidden;
        background: var(--np-dark-2);
        animation: npRevealUp 0.7s ease-out 0.3s both;
    }

    .np-featured-media img,
    .np-featured-media video {
        width: 100%;
        max-height: 480px;
        object-fit: cover;
        display: block;
        transition: transform 0.6s ease;
    }

    .np-featured-media:hover img { transform: scale(1.03); }

    .np-media-label {
        position: absolute;
        top: 0; left: 0;
        background: var(--np-red);
        color: var(--np-white);
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        padding: 6px 14px;
        animation: npStampIn 0.5s ease-out 0.8s both;
    }

    .np-no-media {
        background: var(--np-dark-3);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 300px;
        color: var(--np-text-muted);
        font-size: 14px;
        gap: 10px;
    }

    .np-no-media i { font-size: 2.5rem; color: var(--np-text-muted); }

    .np-share-strip {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 16px 0;
        border-bottom: 1px solid var(--np-border);
        margin-top: 16px;
        animation: npFadeIn 0.5s ease-out 0.8s both;
    }

    .np-share-label {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--np-text-dim);
    }

    .np-share-btn {
        width: 34px; height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--np-text);
        font-size: 14px;
        transition: all 0.3s;
        cursor: pointer;
        border: 1px solid var(--np-border);
        background: transparent;
    }

    .np-share-btn:hover { color: var(--np-red); border-color: var(--np-red); background: rgba(211,47,47,0.05); transform: translateY(-2px); }

    .np-article-body {
        animation: npRevealUp 0.6s ease-out 0.5s both;
    }

    .np-body-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--np-red);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .np-body-rule {
        border: none;
        height: 1px;
        background: linear-gradient(to right, var(--np-red), transparent);
        margin-bottom: 20px;
    }

    .np-body-text {
        font-family: var(--font-ui);
        color: var(--np-text);
        font-size: 15px;
        line-height: 1.85;
    }

    .np-body-text p { margin-bottom: 1rem; }

    .np-body-text p:first-of-type::first-letter {
        font-family: var(--font-headline);
        font-size: 3.2rem;
        font-weight: 900;
        float: left;
        line-height: 0.8;
        margin: 5px 10px 0 0;
        color: var(--np-red);
    }

    .np-body-text a {
        color: var(--np-red);
        border-bottom: 1px solid var(--np-red);
        transition: all 0.3s;
    }

    .np-body-text a:hover { color: var(--np-red-dark); border-bottom-width: 2px; }

    .np-related-section { padding: 50px 0; }

    .np-related-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 30px;
        animation: npRevealUp 0.5s ease-out;
    }

    .np-related-title {
        font-family: var(--font-headline);
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--np-white);
        text-transform: uppercase;
        letter-spacing: 1px;
        white-space: nowrap;
    }

    .np-related-title i { color: var(--np-red); margin-right: 6px; }

    .np-related-line {
        flex: 1;
        height: 1px;
        background: linear-gradient(to right, rgba(255,255,255,0.1), transparent);
    }

    .np-related-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
    @media (max-width: 992px) { .np-related-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 576px) { .np-related-grid { grid-template-columns: 1fr; } }

    .np-related-card {
        background: rgba(18, 18, 30, 0.85);
        backdrop-filter: blur(16px);
        border: 1px solid var(--np-border);
        overflow: hidden;
        transition: all 0.4s ease;
        opacity: 0;
        transform: translateY(30px);
    }

    .np-related-card.np-animate-in {
        opacity: 1;
        transform: translateY(0);
    }

    .np-related-card:hover { transform: translateY(-5px); border-color: rgba(211,47,47,0.08); box-shadow: var(--np-shadow); }

    .np-related-card a { display: block; color: inherit; }

    .np-related-img {
        position: relative;
        overflow: hidden;
        height: 170px;
        background: var(--np-dark-2);
    }

    .np-related-img img,
    .np-related-img video {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .np-related-card:hover .np-related-img img { transform: scale(1.06); }

    .np-related-number {
        position: absolute;
        top: 0; left: 0;
        background: var(--np-red);
        color: var(--np-white);
        font-family: var(--font-headline);
        font-size: 13px;
        font-weight: 800;
        width: 28px; height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .np-related-body { padding: 14px 16px 18px; }

    .np-related-body h6 {
        font-family: var(--font-headline);
        font-size: 14px;
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

    .np-related-card:hover .np-related-body h6 { color: var(--np-red); }

    .np-related-meta {
        font-size: 11px;
        color: var(--np-text-muted);
        display: flex;
        gap: 12px;
    }

    .np-related-meta i { color: var(--np-red); margin-right: 3px; }

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

    @media (max-width: 576px) {
        .np-article-title { font-size: 1.5rem; }
        .np-body-text { font-size: 14px; }
        .np-body-text p:first-of-type::first-letter { font-size: 2.5rem; }
        .np-related-title { font-size: 1rem; }
        .np-featured-media img, .np-featured-media video { max-height: 260px; }
        .np-article-meta { gap: 10px; }
        .np-meta-dot { display: none; }
    }

    @media print {
        .np-share-strip, .np-scroll-top, .np-edition-bar { display: none !important; }
        body { background: white; color: black; }
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

<div class="np-article-wrap">
    <div class="np-container">

        <div class="np-edition-bar">
            <span><i class="bi bi-newspaper"></i> News Portal — Daily Edition</span>
        </div>

        <div class="np-article-masthead">
            <div class="np-cat-flag">
                <i class="bi bi-bookmark-fill"></i>
                {{ $post->PostCategory->name ?? 'News Article' }}
            </div>
            <h1 class="np-article-title">{{ $post->title }}</h1>
            <div class="np-article-meta">
                <span class="np-meta-item">
                    <i class="bi bi-calendar3"></i>
                    {{ \Carbon\Carbon::parse($post->created_at)->timezone('Asia/Dhaka')->format('d M Y') }}
                </span>
                <span class="np-meta-dot"></span>
                <span class="np-meta-item">
                    <i class="bi bi-clock"></i>
                    {{ \Carbon\Carbon::parse($post->created_at)->timezone('Asia/Dhaka')->format('h:i A') }}
                </span>
                <span class="np-meta-dot"></span>
                <span class="np-meta-item">
                    <i class="bi bi-eye"></i> News Portal
                </span>
            </div>
        </div>

        <hr class="np-article-rule">

        <div class="np-article-layout">

            <div>
                <div class="np-featured-media">
                    @if($post->file)
                        @php
                            $ext = strtolower(pathinfo($post->file, PATHINFO_EXTENSION));
                            $videoExtensions = ['mp4','webm','ogg','avi','mkv'];
                            $imageExtensions = ['jpg','jpeg','png','gif','webp'];
                            $isImage = in_array($ext, $imageExtensions);
                            $isVideo = in_array($ext, $videoExtensions);
                        @endphp

                        @if($isImage)
                            <img src="{{ config('app.storage_url') }}{{ $post->file }}" alt="{{ $post->title }}">
                            <span class="np-media-label"><i class="bi bi-camera-fill"></i> Photo</span>
                        @elseif($isVideo)
                            <video controls style="max-height:480px;object-fit:cover;">
                                <source src="{{ config('app.storage_url') }}{{ $post->file }}" type="video/mp4">
                            </video>
                            <span class="np-media-label"><i class="bi bi-play-circle-fill"></i> Video</span>
                        @else
                            <div class="np-no-media">
                                <i class="bi bi-file-earmark-x"></i>
                                <span>Unsupported Media Format</span>
                            </div>
                        @endif
                    @else
                        <div class="np-no-media">
                            <i class="bi bi-image"></i>
                            <span>No Media Available</span>
                        </div>
                    @endif
                </div>

                <div class="np-share-strip">
                    <span class="np-share-label"><i class="bi bi-share-fill"></i> Share</span>
                    <a href="#" class="np-share-btn" title="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="np-share-btn" title="Twitter"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="np-share-btn" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                    <a href="#" class="np-share-btn" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    <button class="np-share-btn" title="Copy Link" onclick="copyArticleLink(event)"><i class="bi bi-link-45deg"></i></button>
                </div>
            </div>

            <div class="np-article-body">
                <div class="np-body-label">
                    <i class="bi bi-newspaper"></i> Article Details
                </div>
                <hr class="np-body-rule">
                <div class="np-body-text">
                    {!! $post->details !!}
                </div>
            </div>

        </div>

    </div>
</div>

@if($otherPosts->count() > 0)
<section class="np-related-section">
    <div class="np-container">
        <div class="np-related-header">
            <span class="np-related-title">
                <i class="bi bi-grid-3x2-gap-fill"></i> Related News
            </span>
            <div class="np-related-line"></div>
        </div>
        <div class="np-related-grid">
            @foreach($otherPosts->take(4) as $index => $otherpost)
            <div class="np-related-card" data-delay="{{ $index * 120 }}">
                <a href="{{ url('/post/'.$otherpost->id) }}">
                    <div class="np-related-img">
                        @if($otherpost->file)
                            @php
                                $ext = strtolower(pathinfo($otherpost->file, PATHINFO_EXTENSION));
                                $videoExtensions = ['mp4','webm','ogg','avi','mkv'];
                                $imageExtensions = ['jpg','jpeg','png','gif','webp'];
                                $isImage = in_array($ext, $imageExtensions);
                                $isVideo = in_array($ext, $videoExtensions);
                            @endphp
                            @if($isImage)
                                <img src="{{ config('app.storage_url') }}{{ $otherpost->file }}" alt="{{ $otherpost->title }}" loading="lazy">
                            @elseif($isVideo)
                                <video muted><source src="{{ config('app.storage_url') }}{{ $otherpost->file }}"></video>
                            @endif
                        @endif
                        <span class="np-related-number">{{ $index + 1 }}</span>
                    </div>
                    <div class="np-related-body">
                        <h6>{{ $otherpost->title }}</h6>
                        <div class="np-related-meta">
                            <span><i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($otherpost->created_at)->timezone('Asia/Dhaka')->format('d M Y') }}</span>
                            <span><i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($otherpost->created_at)->timezone('Asia/Dhaka')->format('h:i A') }}</span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<button class="np-scroll-top" id="scrollTopBtn" onclick="window.scrollTo({top:0,behavior:'smooth'})">
    <i class="bi bi-arrow-up"></i>
</button>

<script>
    window.addEventListener('scroll', function() {
        var btn = document.getElementById('scrollTopBtn');
        if (btn) { btn.classList.toggle('visible', window.scrollY > 300); }
    });

    function copyArticleLink(e) {
        e.preventDefault();
        navigator.clipboard.writeText(window.location.href).then(function() {
            var icon = e.currentTarget.querySelector('i');
            icon.className = 'bi bi-check-lg';
            e.currentTarget.style.color = '#00c853';
            setTimeout(function() {
                icon.className = 'bi bi-link-45deg';
                e.currentTarget.style.color = '';
            }, 2000);
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var delay = parseInt(entry.target.getAttribute('data-delay')) || 0;
                    setTimeout(function() {
                        entry.target.classList.add('np-animate-in');
                    }, delay);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        document.querySelectorAll('.np-related-card').forEach(function(item) {
            observer.observe(item);
        });
    });
</script>

@endsection
