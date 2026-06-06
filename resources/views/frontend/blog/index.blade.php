@extends('frontend.app')

@section('content')

<style>
    :root {
        --blog-bg: transparent;
        --blog-card-bg: var(--bg-card, rgba(17, 28, 46, 0.8));
        --blog-text: var(--text-primary, #e2e8f0);
        --blog-text-secondary: var(--text-secondary, #94a3b8);
        --blog-text-muted: var(--text-muted, #64748b);
        --blog-border: var(--border-color, rgba(59, 130, 246, 0.12));
    }
    html.light-theme {
        --blog-bg: #f8fafc;
        --blog-card-bg: rgba(255, 255, 255, 0.9);
        --blog-text: #0f172a;
        --blog-text-secondary: #475569;
        --blog-text-muted: #94a3b8;
        --blog-border: rgba(59, 130, 246, 0.15);
    }

    body {
        font-family: 'Inter', sans-serif;
        background: var(--bg-primary, #0f172a);
        color: var(--text-primary, #e2e8f0);
        overflow-x: hidden;
    }

    .blog-page-header {
        background: linear-gradient(180deg, var(--bg-secondary, #0c1322) 0%, var(--bg-primary, #0f172a) 100%);
        padding: 6rem 2rem 4rem;
        text-align: center;
        position: relative;
        z-index: 1;
    }
    .blog-page-header::before {
        content: '';
        position: absolute;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.08), transparent 70%);
        border-radius: 50%;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
    }
    .blog-page-header h1 {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 900;
        margin-bottom: 0.8rem;
        position: relative;
    }
    .blog-page-header h1 .gradient-text {
        background: linear-gradient(135deg, #3b82f6, #60a5fa, #a78bfa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .blog-page-header p {
        color: var(--text-secondary, #94a3b8);
        font-size: 1.1rem;
        position: relative;
    }

    .blog-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 4rem 2rem;
        position: relative;
        z-index: 1;
    }

    .blog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 2rem;
    }

    .blog-card {
        background: var(--blog-card-bg);
        border: 1px solid var(--blog-border);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s ease;
        backdrop-filter: blur(10px);
    }
    .blog-card:hover {
        transform: translateY(-8px);
        border-color: var(--border-hover, rgba(59, 130, 246, 0.3));
        box-shadow: 0 20px 50px rgba(59, 130, 246, 0.12);
    }
    .blog-card-image {
        height: 200px;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #1e3a5f, #1a1a3e);
    }
    .blog-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .blog-card:hover .blog-card-image img {
        transform: scale(1.05);
    }
    .blog-card-image .img-fallback {
        font-size: 4rem;
        opacity: 0.4;
    }
    html.light-theme .blog-card-image::after {
        background: linear-gradient(transparent, rgba(255, 255, 255, 0.95));
    }
    .blog-card-image::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 60px;
        background: linear-gradient(transparent, rgba(17, 28, 46, 0.95));
    }
    .blog-card-body {
        padding: 1.5rem;
    }
    .blog-card-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.8rem;
        font-size: 0.8rem;
        color: var(--text-muted, #64748b);
    }
    .blog-card-meta .category {
        background: rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.2);
        padding: 0.2rem 0.8rem;
        border-radius: 20px;
        color: #60a5fa;
        font-weight: 500;
    }
    .blog-card-body h3 {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 0.7rem;
        line-height: 1.4;
    }
    .blog-card-body h3 a {
        color: var(--text-primary, #e2e8f0);
        text-decoration: none;
        transition: color 0.3s;
    }
    .blog-card-body h3 a:hover {
        color: #3b82f6;
    }
    .blog-card-body .excerpt {
        color: var(--text-secondary, #94a3b8);
        font-size: 0.9rem;
        line-height: 1.7;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .blog-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid var(--blog-border);
        font-size: 0.8rem;
    }
    .blog-card-footer .read-more {
        color: #3b82f6;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        transition: gap 0.3s;
    }
    .blog-card-footer .read-more:hover { gap: 0.6rem; }
    .blog-card-footer .reading-time {
        color: var(--text-muted, #64748b);
    }

    /* Pagination */
    .pagination-wrap {
        margin-top: 3rem;
        display: flex;
        justify-content: center;
    }
    .pagination-wrap nav .pagination {
        gap: 0.5rem;
    }
    .pagination-wrap nav .page-link {
        background: var(--bg-card, rgba(30, 41, 59, 0.5));
        border: 1px solid var(--blog-border);
        color: var(--text-secondary, #94a3b8);
        border-radius: 10px !important;
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: all 0.3s;
    }
    .pagination-wrap nav .page-link:hover {
        background: rgba(59, 130, 246, 0.15);
        border-color: #3b82f6;
        color: #3b82f6;
    }
    .pagination-wrap nav .page-item.active .page-link {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border-color: #3b82f6;
        color: #fff;
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 4rem 2rem;
    }

    @media (max-width: 968px) {
        .blog-grid { grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; }
    }
    @media (max-width: 768px) {
        .blog-grid { grid-template-columns: 1fr; gap: 1.2rem; }
        .blog-page-header { padding: 5rem 1.5rem 3rem; }
        .blog-page-header h1 { font-size: clamp(1.6rem, 5vw, 2.2rem); }
        .blog-page-header p { font-size: 0.95rem; }
        .blog-content { padding: 2.5rem 1.5rem; }
        .blog-card-image { height: 170px; }
        .blog-card-body { padding: 1.2rem; }
        .blog-card-body h3 { font-size: 1.05rem; }
        .blog-card-body .excerpt { font-size: 0.85rem; }
        .blog-card-footer .read-more { font-size: 0.82rem; }
        .blog-card-meta { font-size: 0.73rem; flex-direction: column; gap: 0.4rem; align-items: flex-start; }
        .pagination-wrap nav .page-link { padding: 0.4rem 0.8rem; font-size: 0.82rem; }
        .pagination-wrap nav .pagination { gap: 0.3rem; }
    }
    @media (max-width: 480px) {
        .blog-page-header { padding: 4rem 1rem 2.5rem; }
        .blog-page-header h1 { font-size: 1.5rem; }
        .blog-content { padding: 1.5rem 1rem; }
        .blog-card-body { padding: 1rem; }
        .blog-card-body h3 { font-size: 0.95rem; }
        .blog-card-footer { flex-direction: column; gap: 0.6rem; align-items: flex-start; }
        .blog-search-wrapper form { flex-direction: column; }
        .blog-search-wrapper input { width: 100% !important; }
        .blog-search-wrapper button { width: 100%; }
        .empty-state { padding: 3rem 1rem; }
    }
</style>

<!-- Header -->
<div class="blog-page-header">
    <h1>{{ __('messages.blog_title') }} <span class="gradient-text">{{ __('messages.blog') }}</span></h1>
    <p>{{ __('messages.blog_subtitle') }}</p>

    <!-- Search Bar -->
    <div class="blog-search-wrapper" style="max-width: 500px; margin: 2rem auto 0; position: relative; z-index: 1;">
        <form action="{{ route('blog.index') }}" method="GET" style="display: flex; gap: 0.5rem;">
            <input type="text" name="q" value="{{ $query ?? '' }}"                   placeholder="{{ __('messages.search_blog') }}"
                                   style="flex: 1; padding: 0.8rem 1.2rem; border-radius: 12px; border: 1px solid rgba(59,130,246,0.2); background: var(--bg-card, rgba(15,23,42,0.8)); color: var(--text-primary, #e2e8f0); font-family: 'Inter', sans-serif; font-size: 0.9rem; outline: none; transition: all 0.3s;">
            <button type="submit" 
                    style="padding: 0.8rem 1.5rem; border-radius: 12px; border: none; background: linear-gradient(135deg, #3b82f6, #2563eb); color: #fff; font-weight: 600; cursor: pointer; transition: all 0.3s; font-family: 'Inter', sans-serif;">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>
</div>

<div class="blog-content">
    @if($posts->isEmpty())
        <div class="empty-state">
            <i class="bi bi-journal-text fs-1 text-muted mb-3 d-block"></i>
            <div class="fw-semibold fs-5 mb-2">{{ __('messages.no_posts') }}</div>
            <p class="text-muted">{{ __('messages.no_posts_desc') }}</p>
        </div>
    @else
        <div class="blog-grid">
            @foreach($posts as $post)
                <div class="blog-card">
                    <div class="blog-card-image" style="background: linear-gradient(135deg, #1e3a5f, #1a1a3e);">
                        @if($post->featured_image)
                            <img src="{{ config('app.storage_url') }}{{ $post->featured_image }}" alt="{{ $post->title }}">
                        @else
                            <span class="img-fallback"><i class="bi bi-journal-text"></i></span>
                        @endif
                    </div>
                    <div class="blog-card-body">
                        <div class="blog-card-meta">
                            @if($post->category)
                                <span class="category"><i class="bi bi-folder2 me-1"></i>{{ $post->category }}</span>
                            @else
                                <span></span>
                            @endif
                            <span><i class="bi bi-calendar3 me-1"></i>{{ $post->formatted_date }}</span>
                        </div>
                        <h3><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h3>
                        <div class="excerpt">{{ $post->getExcerpt(200) }}</div>
                        <div class="blog-card-footer">
                            <a href="{{ route('blog.show', $post->slug) }}" class="read-more">
                                {{ __('messages.read_more') }} <i class="bi bi-arrow-right"></i>
                            </a>
                            <span class="reading-time"><i class="bi bi-clock me-1"></i>{{ $post->reading_time }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination-wrap">
            {{ $posts->links() }}
        </div>
    @endif
</div>

@endsection
