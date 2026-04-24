@extends('frontend.app')

@section('content')

{{-- ========== NEWSPAPER THEME STYLES ========== --}}
<style>
  @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800;900&family=Merriweather:wght@300;400;700&family=Source+Sans+3:wght@300;400;500;600;700&display=swap');

  :root {
    --np-primary: #D32F2F;
    --np-primary-dark: #B71C1C;
    --np-primary-light: #E53935;
    --np-black: #000000;
    --np-dark: #1A1A1A;
    --np-gray-dark: #333333;
    --np-gray: #666666;
    --np-gray-light: #999999;
    --np-gray-lighter: #E0E0E0;
    --np-bg: #FFFFFF;
    --np-bg-cream: #FAFAF8;
    --np-bg-section: #F5F5F3;
    --np-font-headline: 'Playfair Display', Georgia, serif;
    --np-font-subhead: 'Merriweather', Georgia, serif;
    --np-font-body: 'Source Sans 3', 'Segoe UI', sans-serif;
    --np-shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
    --np-shadow-md: 0 4px 15px rgba(0,0,0,0.1);
    --np-shadow-lg: 0 8px 30px rgba(0,0,0,0.12);
    --np-shadow-hover: 0 12px 40px rgba(0,0,0,0.18);
    --np-radius: 6px;
    --np-transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  }

  /* ===== ALERT STYLES ===== */
  .np-alert {
    font-family: var(--np-font-body);
    border: none;
    border-radius: var(--np-radius);
    padding: 14px 20px;
    font-size: 0.95rem;
    font-weight: 500;
    animation: npAlertSlideIn 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
    position: relative;
    overflow: hidden;
  }
  .np-alert::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 4px;
  }
  .np-alert-success {
    background: #E8F5E9;
    color: #2E7D32;
    border: 1px solid #C8E6C9;
  }
  .np-alert-success::before { background: #2E7D32; }
  .np-alert-danger {
    background: #FFEBEE;
    color: #C62828;
    border: 1px solid #FFCDD2;
  }
  .np-alert-danger::before { background: #C62828; }
  .np-alert .btn-close { filter: none; opacity: 0.6; }
  .np-alert .btn-close:hover { opacity: 1; }

  @keyframes npAlertSlideIn {
    from { opacity: 0; transform: translateY(-15px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* ===== BREAKING NEWS TICKER ===== */
  .np-breaking-bar {
    background: var(--np-primary);
    color: #fff;
    padding: 0;
    overflow: hidden;
    display: flex;
    align-items: stretch;
    height: 42px;
    font-family: var(--np-font-body);
    position: relative;
  }
  .np-breaking-label {
    background: var(--np-black);
    color: #fff;
    padding: 0 20px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 700;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    white-space: nowrap;
    z-index: 2;
    position: relative;
  }
  .np-breaking-label::after {
    content: '';
    position: absolute;
    right: -12px;
    top: 0; bottom: 0;
    width: 24px;
    background: var(--np-black);
    transform: skewX(-15deg);
    z-index: 1;
  }
  .np-breaking-label i {
    animation: npPulseIcon 1s ease-in-out infinite;
    font-size: 0.85rem;
  }
  @keyframes npPulseIcon {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(1.2); }
  }
  .np-ticker-wrap {
    flex: 1;
    overflow: hidden;
    display: flex;
    align-items: center;
    padding-left: 24px;
  }
  .np-ticker-content {
    display: flex;
    gap: 60px;
    white-space: nowrap;
    animation: npTickerScroll 30s linear infinite;
    font-size: 0.9rem;
    font-weight: 500;
  }
  .np-ticker-content span {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .np-ticker-content span::before {
    content: '\25C6';
    color: rgba(255,255,255,0.6);
    font-size: 0.5rem;
  }
  @keyframes npTickerScroll {
    0% { transform: translateX(100%); }
    100% { transform: translateX(-100%); }
  }

  /* ===== MAIN SECTION ===== */
  .np-news-section {
    background: var(--np-bg);
    padding: 0 0 60px;
    min-height: 70vh;
  }

  .np-section-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 20px;
  }

  /* ===== SECTION HEADER ===== */
  .np-section-header {
    text-align: center;
    padding: 50px 0 40px;
    position: relative;
  }

  .np-edition-date {
    font-family: var(--np-font-body);
    font-size: 0.85rem;
    color: var(--np-gray-light);
    text-transform: uppercase;
    letter-spacing: 3px;
    margin-bottom: 12px;
  }

  .np-masthead-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--np-primary);
    color: #fff;
    padding: 6px 18px;
    border-radius: 3px;
    font-family: var(--np-font-body);
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 18px;
  }

  .np-main-headline {
    font-family: var(--np-font-headline);
    font-size: 3rem;
    font-weight: 900;
    color: var(--np-black);
    margin: 0 0 12px;
    line-height: 1.15;
    letter-spacing: -0.5px;
  }

  .np-sub-headline {
    font-family: var(--np-font-subhead);
    font-size: 1.05rem;
    color: var(--np-gray);
    font-weight: 300;
    max-width: 550px;
    margin: 0 auto 28px;
    line-height: 1.6;
  }

  /* Decorative divider */
  .np-divider {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    margin-bottom: 10px;
  }
  .np-divider-line {
    width: 80px;
    height: 1px;
    background: var(--np-gray-lighter);
  }
  .np-divider-line.thick {
    height: 3px;
    background: var(--np-primary);
    width: 40px;
  }
  .np-divider i {
    color: var(--np-primary);
    font-size: 1rem;
  }

  /* Double rule newspaper style */
  .np-double-rule {
    border: none;
    border-top: 3px double var(--np-black);
    margin: 0 0 35px;
    opacity: 0.15;
  }

  /* ===== NEWS GRID ===== */
  .np-news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 28px;
  }

  /* ===== NEWS CARD ===== */
  .np-news-card {
    background: var(--np-bg);
    border-radius: var(--np-radius);
    overflow: hidden;
    border: 1px solid rgba(0,0,0,0.06);
    box-shadow: var(--np-shadow-sm);
    transition: var(--np-transition);
    position: relative;
    display: flex;
    flex-direction: column;
  }
  .np-news-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--np-shadow-hover);
    border-color: rgba(211,47,47,0.15);
  }

  /* Red top accent line */
  .np-news-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--np-primary), var(--np-primary-light));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    z-index: 3;
  }
  .np-news-card:hover::before {
    transform: scaleX(1);
  }

  /* Card image wrapper */
  .np-card-media {
    position: relative;
    overflow: hidden;
    height: 220px;
    background: var(--np-bg-section);
  }
  .np-card-media img,
  .np-card-media video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  }
  .np-news-card:hover .np-card-media img,
  .np-news-card:hover .np-card-media video {
    transform: scale(1.06);
  }

  /* Overlay on hover */
  .np-card-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
      180deg,
      transparent 30%,
      rgba(0,0,0,0.7) 100%
    );
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding-bottom: 25px;
    opacity: 0;
    transition: opacity 0.4s ease;
  }
  .np-news-card:hover .np-card-overlay {
    opacity: 1;
  }

  .np-read-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--np-primary);
    color: #fff;
    padding: 10px 24px;
    border-radius: 4px;
    font-family: var(--np-font-body);
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 1px;
    transform: translateY(15px);
    transition: var(--np-transition);
    border: none;
    cursor: pointer;
  }
  .np-news-card:hover .np-read-btn {
    transform: translateY(0);
  }
  .np-read-btn:hover {
    background: var(--np-primary-dark);
    color: #fff;
    text-decoration: none;
  }
  .np-read-btn i {
    font-size: 0.9rem;
  }

  /* Category ribbon */
  .np-category-ribbon {
    position: absolute;
    top: 14px;
    left: 14px;
    background: var(--np-primary);
    color: #fff;
    padding: 4px 12px;
    font-family: var(--np-font-body);
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-radius: 3px;
    z-index: 2;
    box-shadow: 0 2px 8px rgba(211,47,47,0.3);
  }

  /* Card body */
  .np-card-body {
    padding: 20px 22px 22px;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .np-card-title {
    font-family: var(--np-font-headline);
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--np-black);
    line-height: 1.4;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: color 0.3s ease;
  }
  .np-news-card:hover .np-card-title {
    color: var(--np-primary);
  }

  /* Meta info */
  .np-card-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: auto;
    padding-top: 14px;
    border-top: 1px solid rgba(0,0,0,0.06);
  }
  .np-meta-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: 3px;
    font-family: var(--np-font-body);
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.3px;
  }
  .np-meta-date {
    background: #FFF3E0;
    color: #E65100;
  }
  .np-meta-time {
    background: #E3F2FD;
    color: #1565C0;
  }
  .np-meta-badge i {
    font-size: 0.7rem;
  }

  /* Placeholder states */
  .np-media-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    background: linear-gradient(135deg, #F5F5F5, #EEEEEE);
    color: var(--np-gray-light);
  }
  .np-media-placeholder i {
    font-size: 2.5rem;
    margin-bottom: 8px;
    color: #BDBDBD;
  }
  .np-media-placeholder p {
    font-family: var(--np-font-body);
    font-size: 0.85rem;
    margin: 0;
    color: #BDBDBD;
  }

  /* ===== EMPTY STATE ===== */
  .np-empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 30px;
    background: var(--np-bg-section);
    border-radius: var(--np-radius);
    border: 2px dashed var(--np-gray-lighter);
  }
  .np-empty-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 24px;
    background: linear-gradient(135deg, var(--np-primary), var(--np-primary-light));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: npEmptyPulse 2.5s ease-in-out infinite;
  }
  .np-empty-icon i {
    font-size: 2.5rem;
    color: #fff;
  }
  @keyframes npEmptyPulse {
    0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(211,47,47,0.3); }
    50% { transform: scale(1.05); box-shadow: 0 0 0 15px rgba(211,47,47,0); }
  }
  .np-empty-state h5 {
    font-family: var(--np-font-headline);
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--np-black);
    margin-bottom: 10px;
  }
  .np-empty-state p {
    font-family: var(--np-font-body);
    color: var(--np-gray);
    font-size: 1rem;
  }

  /* ===== SCROLL ANIMATIONS ===== */
  .np-animate {
    opacity: 0;
    transform: translateY(35px);
    transition: opacity 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  }
  .np-animate.np-visible {
    opacity: 1;
    transform: translateY(0);
  }

  /* Stagger children */
  .np-news-grid .np-news-card:nth-child(1) { transition-delay: 0.05s; }
  .np-news-grid .np-news-card:nth-child(2) { transition-delay: 0.12s; }
  .np-news-grid .np-news-card:nth-child(3) { transition-delay: 0.19s; }
  .np-news-grid .np-news-card:nth-child(4) { transition-delay: 0.26s; }
  .np-news-grid .np-news-card:nth-child(5) { transition-delay: 0.33s; }
  .np-news-grid .np-news-card:nth-child(6) { transition-delay: 0.40s; }
  .np-news-grid .np-news-card:nth-child(7) { transition-delay: 0.47s; }
  .np-news-grid .np-news-card:nth-child(8) { transition-delay: 0.54s; }
  .np-news-grid .np-news-card:nth-child(9) { transition-delay: 0.61s; }

  /* Newspaper fold-in animation */
  @keyframes npFoldIn {
    0% { opacity: 0; transform: perspective(800px) rotateX(-8deg) translateY(30px); }
    100% { opacity: 1; transform: perspective(800px) rotateX(0deg) translateY(0); }
  }

  /* Typewriter cursor for headline */
  .np-typewriter-cursor::after {
    content: '|';
    animation: npBlink 1s step-end infinite;
    color: var(--np-primary);
    font-weight: 300;
  }
  @keyframes npBlink {
    50% { opacity: 0; }
  }

  /* Print press line animation */
  .np-press-line {
    position: relative;
    overflow: hidden;
  }
  .np-press-line::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(211,47,47,0.06), transparent);
    animation: npPressPass 4s ease-in-out infinite;
  }
  @keyframes npPressPass {
    0% { left: -100%; }
    50% { left: 100%; }
    100% { left: 100%; }
  }

  /* Stamp effect for category */
  .np-stamp-effect {
    animation: npStamp 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
  }
  @keyframes npStamp {
    0% { transform: scale(2) rotate(-5deg); opacity: 0; }
    60% { transform: scale(0.95) rotate(1deg); opacity: 1; }
    100% { transform: scale(1) rotate(0deg); opacity: 1; }
  }

  /* Ink spread on hover */
  .np-news-card .np-ink-spread {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 0;
    background: linear-gradient(to top, rgba(211,47,47,0.03), transparent);
    transition: height 0.5s ease;
    pointer-events: none;
    z-index: 1;
  }
  .np-news-card:hover .np-ink-spread {
    height: 100%;
  }

  /* ===== RESPONSIVE ===== */
  @media (max-width: 992px) {
    .np-main-headline { font-size: 2.4rem; }
    .np-news-grid { grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 22px; }
  }
  @media (max-width: 768px) {
    .np-main-headline { font-size: 2rem; }
    .np-section-header { padding: 35px 0 30px; }
    .np-news-grid { grid-template-columns: 1fr; gap: 20px; }
    .np-breaking-label { padding: 0 12px; font-size: 0.7rem; letter-spacing: 1px; }
    .np-card-body { padding: 16px 18px 18px; }
  }
  @media (max-width: 480px) {
    .np-main-headline { font-size: 1.7rem; }
    .np-section-container { padding: 0 14px; }
    .np-card-media { height: 190px; }
  }
</style>

{{-- ========== ALERTS ========== --}}
@if (session('success'))
  <div class="alert alert-success alert-dismissible fade show m-3 np-alert np-alert-success">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

@if (session('error'))
  <div class="alert alert-danger alert-dismissible fade show m-3 np-alert np-alert-danger">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

{{-- ========== BREAKING NEWS TICKER ========== --}}
<div class="np-breaking-bar">
  <div class="np-breaking-label">
    <i class="bi bi-lightning-charge-fill"></i> Breaking News
  </div>
  <div class="np-ticker-wrap">
    <div class="np-ticker-content">
      <span>Stay updated with the latest news from around the world</span>
      <span>News Portal brings you real-time coverage of events that matter</span>
      <span>Your trusted source for breaking news and in-depth analysis</span>
      <span>Subscribe now for exclusive stories and daily briefings</span>
    </div>
  </div>
</div>

{{-- ========== NEWS POSTS SECTION ========== --}}
<main>
  <section class="np-news-section">
    <div class="np-section-container">

      {{-- Section Header --}}
      <div class="np-section-header np-animate np-press-line">
        <div class="np-edition-date">
          <i class="bi bi-calendar3 me-1"></i> Today's Edition &bull; {{ now()->timezone('Asia/Dhaka')->format('l, d F Y') }}
        </div>
        <div class="np-masthead-label">
          <i class="bi bi-newspaper"></i> News Portal
        </div>
        <h2 class="np-main-headline">Latest News</h2>
        <p class="np-sub-headline">
          Browse the latest news articles, stories, and updates from our newsroom
        </p>
        <div class="np-divider">
          <span class="np-divider-line"></span>
          <span class="np-divider-line thick"></span>
          <i class="bi bi-diamond-fill"></i>
          <span class="np-divider-line thick"></span>
          <span class="np-divider-line"></span>
        </div>
      </div>

      <hr class="np-double-rule">

      {{-- News Grid --}}
      <div class="np-news-grid">

        @forelse(($posts ?? collect())->sortByDesc('created_at') as $post)
          <div class="np-news-card np-animate">

            {{-- Media --}}
            <div class="np-card-media">

              @php
                $ext = strtolower(pathinfo($post->file, PATHINFO_EXTENSION));
                $videoExtensions = ['mp4','webm','ogg','avi','mkv'];
                $imageExtensions = ['jpg','jpeg','png','gif','webp'];
                $isImage = in_array($ext, $imageExtensions);
                $isVideo = in_array($ext, $videoExtensions);
              @endphp

              @if($post->file)

                @if($isImage)
                  <img
                    src="{{ config('app.storage_url') }}{{ $post->file }}"
                    alt="{{ $post->title }}"
                    loading="lazy">
                @elseif($isVideo)
                  <video controls>
                    <source src="{{ config('app.storage_url') }}{{ $post->file }}" type="video/mp4">
                  </video>
                @else
                  <div class="np-media-placeholder">
                    <i class="bi bi-file-earmark-x"></i>
                    <p>Unsupported Media</p>
                  </div>
                @endif

              @else
                <div class="np-media-placeholder">
                  <i class="bi bi-image"></i>
                  <p>No Media Available</p>
                </div>
              @endif

              {{-- Category ribbon --}}
              <span class="np-category-ribbon np-stamp-effect">
                <i class="bi bi-tag-fill me-1"></i> News
              </span>

              {{-- Hover overlay --}}
              <div class="np-card-overlay">
                <a href="{{ url('/post/'.$post->id) }}" class="np-read-btn">
                  <i class="bi bi-book-half"></i> Read Article
                </a>
              </div>

            </div>

            {{-- Card Body --}}
            <div class="np-card-body">
              <h3 class="np-card-title">{{ $post->title }}</h3>

              <div class="np-card-meta">
                <span class="np-meta-badge np-meta-date">
                  <i class="bi bi-calendar-event"></i>
                  {{ \Carbon\Carbon::parse($post->created_at)->timezone('Asia/Dhaka')->format('d M Y') }}
                </span>
                <span class="np-meta-badge np-meta-time">
                  <i class="bi bi-clock"></i>
                  {{ \Carbon\Carbon::parse($post->created_at)->timezone('Asia/Dhaka')->format('h:i A') }}
                </span>
              </div>
            </div>

            {{-- Ink spread effect --}}
            <div class="np-ink-spread"></div>

          </div>
        @empty
          <div class="np-empty-state np-animate">
            <div class="np-empty-icon">
              <i class="bi bi-newspaper"></i>
            </div>
            <h5>No News Articles Available</h5>
            <p>Please check back later for the latest updates and breaking stories.</p>
          </div>
        @endforelse

      </div>
    </div>
  </section>
</main>

{{-- ========== SCROLL ANIMATION SCRIPT ========== --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

  // Intersection Observer for scroll animations
  const animElements = document.querySelectorAll('.np-animate');
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('np-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

    animElements.forEach(function (el) { observer.observe(el); });
  } else {
    // Fallback
    animElements.forEach(function (el) { el.classList.add('np-visible'); });
  }

  // Auto-dismiss alerts after 5 seconds
  document.querySelectorAll('.np-alert').forEach(function (alert) {
    setTimeout(function () {
      var bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
      if (bsAlert) bsAlert.close();
    }, 5000);
  });
});
</script>

@endsection
