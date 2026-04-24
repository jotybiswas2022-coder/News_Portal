@extends('frontend.app')

@section('content')

{{-- ===== Inline Styles for News Portal Theme ===== --}}
<style>
    /* ===== GOOGLE FONTS ===== */
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800;900&family=Source+Serif+4:wght@300;400;500;600&family=Inter:wght@400;500;600&display=swap');

    /* ===== ROOT VARIABLES ===== */
    :root {
        --np-black: #000000;
        --np-red: #D32F2F;
        --np-red-hover: #E53935;
        --np-white: #FFFFFF;
        --np-gray-100: #F8F8F8;
        --np-gray-200: #EEEEEE;
        --np-gray-400: #BDBDBD;
        --np-gray-600: #757575;
        --np-text: #222222;
        --np-text-light: #555555;
        --font-headline: 'Playfair Display', Georgia, serif;
        --font-body: 'Source Serif 4', Georgia, serif;
        --font-ui: 'Inter', Arial, sans-serif;
    }

    /* ===== KEYFRAME ANIMATIONS ===== */

    @keyframes paperDrop {
        0% {
            opacity: 0;
            transform: translateY(-40px) rotate(-1deg);
        }
        60% {
            opacity: 1;
            transform: translateY(6px) rotate(0.3deg);
        }
        100% {
            opacity: 1;
            transform: translateY(0) rotate(0deg);
        }
    }

    @keyframes revealLeft {
        0% {
            clip-path: inset(0 100% 0 0);
            opacity: 0;
        }
        100% {
            clip-path: inset(0 0 0 0);
            opacity: 1;
        }
    }

    @keyframes revealUp {
        0% {
            opacity: 0;
            transform: translateY(25px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes lineExtend {
        0% { transform: scaleX(0); }
        100% { transform: scaleX(1); }
    }

    @keyframes tickerScroll {
        0% { transform: translateX(100%); }
        100% { transform: translateX(-100%); }
    }

    @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    @keyframes stampIn {
        0% {
            transform: scale(3) rotate(-12deg);
            opacity: 0;
        }
        70% {
            transform: scale(0.95) rotate(1deg);
            opacity: 0.9;
        }
        100% {
            transform: scale(1) rotate(0deg);
            opacity: 1;
        }
    }

    @keyframes typewriter {
        0% { width: 0; }
        100% { width: 100%; }
    }

    @keyframes blinkCaret {
        0%, 100% { border-right-color: var(--np-red); }
        50% { border-right-color: transparent; }
    }

    @keyframes pulseGlow {
        0%, 100% { box-shadow: 0 0 0 0 rgba(211,47,47,0.4); }
        50% { box-shadow: 0 0 0 10px rgba(211,47,47,0); }
    }

    @keyframes slideInRight {
        0% { opacity: 0; transform: translateX(50px); }
        100% { opacity: 1; transform: translateX(0); }
    }

    @keyframes columnFade {
        0% { opacity: 0; transform: translateY(30px) scale(0.97); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* ===== NEWS PAGE WRAPPER ===== */
    .news-page {
        background-color: var(--np-white);
        min-height: 100vh;
        position: relative;
    }

    /* ===== ALERT STYLES ===== */
    .alert-success-custom {
        background: var(--np-white);
        border: none;
        border-bottom: 2px solid #2E7D32;
        color: #1B5E20;
        font-weight: 500;
        border-radius: 0;
        font-family: var(--font-ui);
        font-size: 0.9rem;
        animation: revealLeft 0.5s ease-out;
    }

    .alert-danger-custom {
        background: var(--np-white);
        border: none;
        border-bottom: 2px solid var(--np-red);
        color: #B71C1C;
        font-weight: 500;
        border-radius: 0;
        font-family: var(--font-ui);
        font-size: 0.9rem;
        animation: revealLeft 0.5s ease-out;
    }

    /* ===== EDITION BAR ===== */
    .edition-bar {
        border-bottom: 1px solid var(--np-gray-200);
        padding: 10px 0;
        animation: fadeIn 0.6s ease-out;
    }

    .edition-bar .edition-text {
        font-family: var(--font-ui);
        font-size: 0.75rem;
        color: var(--np-gray-600);
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .edition-bar .edition-text i {
        color: var(--np-red);
    }

    /* ===== MASTHEAD AREA ===== */
    .article-masthead {
        text-align: center;
        padding: 2.5rem 0 1.5rem;
        position: relative;
        animation: paperDrop 0.7s ease-out;
    }

    .article-masthead .category-flag {
        display: inline-block;
        background: var(--np-red);
        color: var(--np-white);
        font-family: var(--font-ui);
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2.5px;
        padding: 5px 18px;
        margin-bottom: 1.2rem;
        animation: stampIn 0.5s ease-out 0.3s both;
    }

    .article-masthead .news-title {
        font-family: var(--font-headline);
        color: var(--np-black);
        font-size: 2.6rem;
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -0.5px;
        max-width: 800px;
        margin: 0 auto;
        animation: revealUp 0.6s ease-out 0.2s both;
    }

    .article-meta-line {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        margin-top: 1.2rem;
        flex-wrap: wrap;
        animation: fadeIn 0.6s ease-out 0.5s both;
    }

    .meta-item {
        font-family: var(--font-ui);
        font-size: 0.78rem;
        color: var(--np-gray-600);
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .meta-item i {
        color: var(--np-red);
        font-size: 0.75rem;
    }

    .meta-dot {
        width: 3px;
        height: 3px;
        background: var(--np-gray-400);
        border-radius: 50%;
    }

    /* ===== THICK RULE LINES ===== */
    .rule-thick {
        border: none;
        height: 3px;
        background: var(--np-black);
        margin: 0;
        animation: lineExtend 0.8s ease-out both;
        transform-origin: left;
    }

    .rule-thin {
        border: none;
        height: 1px;
        background: var(--np-black);
        margin: 0;
        animation: lineExtend 0.8s ease-out 0.1s both;
        transform-origin: left;
    }

    .rule-double {
        border: none;
        height: 0;
        border-top: 3px solid var(--np-black);
        border-bottom: 1px solid var(--np-black);
        padding-top: 3px;
        margin: 0;
        animation: lineExtend 0.8s ease-out both;
        transform-origin: left;
    }

    .rule-red {
        border: none;
        height: 2px;
        background: var(--np-red);
        margin: 0;
        animation: lineExtend 0.6s ease-out 0.3s both;
        transform-origin: left;
    }

    .rule-gray {
        border: none;
        height: 1px;
        background: var(--np-gray-200);
        margin: 0;
    }

    /* ===== FEATURED IMAGE ===== */
    .featured-media {
        position: relative;
        margin: 1.5rem 0;
        animation: revealUp 0.7s ease-out 0.3s both;
    }

    .featured-media img,
    .featured-media video {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
        display: block;
        transition: filter 0.4s ease;
    }

    .featured-media:hover img {
        filter: brightness(1.03) contrast(1.02);
    }

    .featured-media .media-label {
        position: absolute;
        top: 0;
        left: 0;
        background: var(--np-red);
        color: var(--np-white);
        font-family: var(--font-ui);
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        padding: 5px 14px;
        animation: stampIn 0.5s ease-out 0.8s both;
    }

    .featured-media .photo-credit {
        position: absolute;
        bottom: 0;
        right: 0;
        background: rgba(0,0,0,0.7);
        color: rgba(255,255,255,0.8);
        font-family: var(--font-ui);
        font-size: 0.65rem;
        padding: 4px 12px;
        letter-spacing: 0.5px;
    }

    .no-media-area {
        background: var(--np-gray-100);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 280px;
        color: var(--np-gray-400);
        font-family: var(--font-body);
        font-style: italic;
        font-size: 0.95rem;
    }

    .no-media-area i {
        font-size: 2.5rem;
        margin-bottom: 10px;
        color: var(--np-gray-200);
    }

    /* ===== ARTICLE BODY ===== */
    .article-body-area {
        animation: revealUp 0.6s ease-out 0.5s both;
    }

    .article-label {
        font-family: var(--font-ui);
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--np-red);
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .article-label i {
        font-size: 0.85rem;
    }

    .article-body-text {
        font-family: var(--font-body);
        color: var(--np-text);
        font-size: 1.05rem;
        line-height: 1.85;
        text-align: justify;
        hyphens: auto;
    }

    .article-body-text p {
        margin-bottom: 1.1rem;
    }

    .article-body-text p:first-of-type::first-letter {
        font-family: var(--font-headline);
        font-size: 3.5rem;
        font-weight: 900;
        float: left;
        line-height: 0.8;
        margin: 5px 10px 0 0;
        color: var(--np-red);
    }

    .article-body-text a {
        color: var(--np-red);
        text-decoration: none;
        border-bottom: 1px solid var(--np-red);
        transition: all 0.3s;
    }

    .article-body-text a:hover {
        color: var(--np-red-hover);
        border-bottom-width: 2px;
    }

    /* ===== SHARE BAR ===== */
    .share-strip {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 1rem 0;
        animation: fadeIn 0.5s ease-out 0.8s both;
    }

    .share-strip .share-label {
        font-family: var(--font-ui);
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--np-gray-600);
    }

    .share-icon-btn {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--np-black);
        font-size: 0.85rem;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        position: relative;
        background: none;
        border: none;
    }

    .share-icon-btn::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: var(--np-red);
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .share-icon-btn:hover {
        color: var(--np-red);
        transform: translateY(-2px);
    }

    .share-icon-btn:hover::after {
        width: 100%;
    }

    /* ===== RELATED NEWS SECTION ===== */
    .related-section {
        padding: 2rem 0 3rem;
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 2rem;
        animation: revealUp 0.5s ease-out;
    }

    .section-header-title {
        font-family: var(--font-headline);
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--np-black);
        text-transform: uppercase;
        letter-spacing: 1px;
        white-space: nowrap;
    }

    .section-header-line {
        flex: 1;
        height: 0;
        border-top: 2px solid var(--np-black);
        border-bottom: 1px solid var(--np-black);
        padding-top: 3px;
        animation: lineExtend 0.8s ease-out 0.3s both;
        transform-origin: left;
    }

    /* Related Article Item — No box */
    .related-item {
        padding: 0;
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .related-item.animate-in {
        opacity: 1;
        transform: translateY(0);
    }

    .related-item-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .related-item-img {
        position: relative;
        overflow: hidden;
        margin-bottom: 0.75rem;
    }

    .related-item-img img,
    .related-item-img video {
        width: 100%;
        height: 190px;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease, filter 0.3s ease;
        filter: grayscale(20%);
    }

    .related-item-link:hover .related-item-img img,
    .related-item-link:hover .related-item-img video {
        transform: scale(1.05);
        filter: grayscale(0%);
    }

    .related-item-img .item-number {
        position: absolute;
        top: 0;
        left: 0;
        background: var(--np-black);
        color: var(--np-white);
        font-family: var(--font-headline);
        font-size: 1rem;
        font-weight: 800;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .related-item h6 {
        font-family: var(--font-headline);
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--np-black);
        line-height: 1.35;
        margin-bottom: 0.4rem;
        transition: color 0.3s;
    }

    .related-item-link:hover h6 {
        color: var(--np-red);
    }

    .related-item .rel-meta {
        font-family: var(--font-ui);
        font-size: 0.7rem;
        color: var(--np-gray-600);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .related-item .rel-meta i {
        color: var(--np-red);
        font-size: 0.65rem;
    }

    /* Column divider for related items */
    .col-divider {
        border-right: 1px solid var(--np-gray-200);
    }

    @media (max-width: 991px) {
        .col-divider {
            border-right: none;
            border-bottom: 1px solid var(--np-gray-200);
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }
    }

    /* ===== BACK TO TOP ===== */
    .back-to-top-news {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 42px;
        height: 42px;
        background: var(--np-black);
        color: var(--np-white);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 999;
    }

    .back-to-top-news.visible {
        opacity: 1;
        visibility: visible;
    }

    .back-to-top-news:hover {
        background: var(--np-red);
        animation: pulseGlow 1.5s infinite;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .article-masthead .news-title {
            font-size: 1.7rem;
        }

        .article-body-text {
            font-size: 0.95rem;
        }

        .article-body-text p:first-of-type::first-letter {
            font-size: 2.8rem;
        }

        .section-header-title {
            font-size: 1.1rem;
        }

        .featured-media img,
        .featured-media video {
            max-height: 300px;
        }

        .related-item-img img,
        .related-item-img video {
            height: 160px;
        }
    }

    @media (max-width: 576px) {
        .article-masthead .news-title {
            font-size: 1.45rem;
        }

        .article-meta-line {
            gap: 10px;
        }

        .meta-dot {
            display: none;
        }
    }

    /* ===== PRINT STYLES ===== */
    @media print {
        .featured-media .media-label,
        .featured-media .photo-credit,
        .back-to-top-news,
        .share-strip,
        .edition-bar {
            display: none !important;
        }

        .news-page {
            background: white;
        }
    }
</style>

{{-- ===== Alert Messages ===== --}}
@if (session('success'))
	<div class="alert alert-success alert-dismissible fade show m-3 alert-success-custom">
		<i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
		<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
	</div>
@endif

@if (session('error'))
	<div class="alert alert-danger alert-dismissible fade show m-3 alert-danger-custom">
		<i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
		<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
	</div>
@endif

<div class="news-page">

	<!-- ================= EDITION BAR ================= -->
	<div class="edition-bar">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
				<span class="edition-text">
					<i class="bi bi-newspaper me-1"></i> News Portal — Daily Edition
				</span>
				<span class="edition-text">
					<i class="bi bi-geo-alt-fill me-1"></i> Online Edition
				</span>
			</div>
		</div>
	</div>

	<!-- ================= ARTICLE DETAIL ================= -->
	<div class="container">

		<!-- Masthead / Title Area -->
		<div class="article-masthead">
			<div class="category-flag">
				<i class="bi bi-bookmark-fill me-1"></i> News Article
			</div>
			<h1 class="news-title">{{ $post->title }}</h1>
			<div class="article-meta-line">
				<span class="meta-item">
					<i class="bi bi-calendar3"></i>
					{{ \Carbon\Carbon::parse($post->created_at)->timezone('Asia/Dhaka')->format('d M Y') }}
				</span>
				<span class="meta-dot"></span>
				<span class="meta-item">
					<i class="bi bi-clock"></i>
					{{ \Carbon\Carbon::parse($post->created_at)->timezone('Asia/Dhaka')->format('h:i A') }}
				</span>
				<span class="meta-dot"></span>
				<span class="meta-item">
					<i class="bi bi-eye"></i> News Portal
				</span>
			</div>
		</div>

		<!-- Top Rule Lines -->
		<hr class="rule-thick">
		<hr class="rule-thin mt-1">

		<div class="row g-4 g-lg-5 mt-0">

			<!-- ===== LEFT: FEATURED MEDIA ===== -->
			<div class="col-lg-7">

				<div class="featured-media">

					@if($post->file)

						@php
							$ext = strtolower(pathinfo($post->file, PATHINFO_EXTENSION));
							$videoExtensions = ['mp4','webm','ogg','avi','mkv'];
							$imageExtensions = ['jpg','jpeg','png','gif','webp'];
							$isImage = in_array($ext,$imageExtensions);
							$isVideo = in_array($ext,$videoExtensions);
						@endphp

						@if($isImage)
							<img src="{{ config('app.storage_url') }}{{ $post->file }}"
								alt="{{ $post->title }}">
							<span class="media-label"><i class="bi bi-camera-fill me-1"></i> Photo</span>
						@elseif($isVideo)
							<video controls class="w-100" style="max-height:500px;object-fit:cover;">
								<source src="{{ config('app.storage_url') }}{{ $post->file }}" type="video/mp4">
							</video>
							<span class="media-label"><i class="bi bi-play-circle-fill me-1"></i> Video</span>
						@else
							<div class="no-media-area">
								<i class="bi bi-file-earmark-x"></i>
								<span>Unsupported Media Format</span>
							</div>
						@endif

					@else
						<div class="no-media-area">
							<i class="bi bi-image"></i>
							<span>No Media Available</span>
						</div>
					@endif

				</div>

				<!-- Share Strip -->
				<div class="share-strip">
					<span class="share-label"><i class="bi bi-share-fill me-1"></i> Share</span>
					<a href="#" class="share-icon-btn" title="Facebook"><i class="bi bi-facebook"></i></a>
					<a href="#" class="share-icon-btn" title="Twitter"><i class="bi bi-twitter-x"></i></a>
					<a href="#" class="share-icon-btn" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
					<a href="#" class="share-icon-btn" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
					<button class="share-icon-btn" title="Copy Link" onclick="copyArticleLink(event)"><i class="bi bi-link-45deg"></i></button>
				</div>

			</div>

			<!-- ===== RIGHT: ARTICLE CONTENT ===== -->
			<div class="col-lg-5">

				<div class="article-body-area">

					<div class="article-label">
						<i class="bi bi-newspaper"></i> Article Details
					</div>

					<hr class="rule-red mb-3">

					<div class="article-body-text">
						{!! $post->details !!}
					</div>

				</div>

			</div>

		</div>

		<!-- Bottom Double Rule -->
		<hr class="rule-double mt-4">

	</div>

	<!-- ================= RELATED NEWS ================= -->
	<div class="container related-section">

		<div class="section-header">
			<span class="section-header-title">
				<i class="bi bi-grid-3x2-gap-fill me-1" style="color:var(--np-red);"></i> Related News
			</span>
			<div class="section-header-line"></div>
		</div>

		@if($otherPosts->count() > 0)

			<div class="row g-4">

				@foreach($otherPosts->take(4) as $index => $otherpost)
					<div class="col-lg-3 col-md-6 col-12 {{ $index < 3 ? 'col-divider' : '' }}">

						<div class="related-item" data-delay="{{ $index * 120 }}">

							<a href="{{ url('/post/'.$otherpost->id) }}" class="related-item-link">

								<div class="related-item-img">

									@if($otherpost->file)

										@php
											$ext = strtolower(pathinfo($otherpost->file, PATHINFO_EXTENSION));
											$videoExtensions = ['mp4','webm','ogg','avi','mkv'];
											$imageExtensions = ['jpg','jpeg','png','gif','webp'];
											$isImage = in_array($ext,$imageExtensions);
											$isVideo = in_array($ext,$videoExtensions);
										@endphp

										@if($isImage)
											<img src="{{ config('app.storage_url') }}{{ $otherpost->file }}"
												alt="{{ $otherpost->title }}">
										@elseif($isVideo)
											<video class="w-100" muted>
												<source src="{{ config('app.storage_url') }}{{ $otherpost->file }}">
											</video>
										@endif

									@endif

									<span class="item-number">{{ $index + 1 }}</span>

								</div>

								<h6>{{ $otherpost->title }}</h6>

								<div class="rel-meta">
									<span>
										<i class="bi bi-calendar3 me-1"></i>
										{{ \Carbon\Carbon::parse($otherpost->created_at)->timezone('Asia/Dhaka')->format('d M Y') }}
									</span>
									<span>
										<i class="bi bi-clock me-1"></i>
										{{ \Carbon\Carbon::parse($otherpost->created_at)->timezone('Asia/Dhaka')->format('h:i A') }}
									</span>
								</div>

							</a>

						</div>

					</div>
				@endforeach

			</div>

		@endif

	</div>

	<!-- Final Rule -->
	<div class="container">
		<hr class="rule-thick mb-0">
	</div>

</div>

<!-- Back to Top Button -->
<button class="back-to-top-news" id="backToTopBtn" onclick="window.scrollTo({top:0,behavior:'smooth'})" title="Back to Top">
	<i class="bi bi-chevron-up"></i>
</button>

{{-- ===== JavaScript ===== --}}
<script>
	// Back to top visibility
	window.addEventListener('scroll', function() {
		const btn = document.getElementById('backToTopBtn');
		if (btn) {
			btn.classList.toggle('visible', window.scrollY > 300);
		}
	});

	// Copy article link
	function copyArticleLink(e) {
		e.preventDefault();
		navigator.clipboard.writeText(window.location.href).then(function() {
			const icon = e.currentTarget.querySelector('i');
			icon.className = 'bi bi-check-lg';
			e.currentTarget.style.color = '#2E7D32';
			setTimeout(() => {
				icon.className = 'bi bi-link-45deg';
				e.currentTarget.style.color = '';
			}, 2000);
		});
	}

	// Intersection Observer for scroll-triggered animations on related items
	document.addEventListener('DOMContentLoaded', function() {
		const observer = new IntersectionObserver(function(entries) {
			entries.forEach(function(entry) {
				if (entry.isIntersecting) {
					const delay = entry.target.getAttribute('data-delay') || 0;
					setTimeout(function() {
						entry.target.classList.add('animate-in');
					}, parseInt(delay));
					observer.unobserve(entry.target);
				}
			});
		}, { threshold: 0.15 });

		document.querySelectorAll('.related-item').forEach(function(item) {
			observer.observe(item);
		});
	});
</script>

@endsection
