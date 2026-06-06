@extends('frontend.app')

@section('content')

<style>
    :root {
        --blog-text: var(--text-primary, #e2e8f0);
        --blog-text-secondary: var(--text-secondary, #94a3b8);
        --blog-text-muted: var(--text-muted, #64748b);
        --blog-border: var(--border-color, rgba(59, 130, 246, 0.12));
    }
    html.light-theme {
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

    .post-header {
        background: linear-gradient(180deg, var(--bg-secondary, #0c1322) 0%, var(--bg-primary, #0f172a) 100%);
        padding: 6rem 2rem 3rem;
        text-align: center;
        position: relative;
        z-index: 1;
    }
    .post-header::before {
        content: '';
        position: absolute;
        width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.08), transparent 70%);
        border-radius: 50%;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
    }
    .post-header .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-muted, #64748b);
        text-decoration: none;
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
        transition: color 0.3s;
        position: relative;
    }
    .post-header .back-link:hover { color: #3b82f6; }
    .post-header .category-tag {
        display: inline-block;
        background: rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.2);
        padding: 0.3rem 1rem;
        border-radius: 20px;
        color: #60a5fa;
        font-size: 0.85rem;
        font-weight: 500;
        margin-bottom: 1rem;
        position: relative;
    }
    .post-header h1 {
        font-size: clamp(1.8rem, 4vw, 3rem);
        font-weight: 900;
        line-height: 1.2;
        max-width: 800px;
        margin: 0 auto 1.5rem;
        position: relative;
    }
    .post-meta {
        display: flex;
        justify-content: center;
        gap: 2rem;
        flex-wrap: wrap;
        color: var(--text-muted, #64748b);
        font-size: 0.9rem;
        position: relative;
    }
    .post-meta span {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .post-featured-image {
        max-width: 900px;
        margin: -2rem auto 0;
        padding: 0 2rem;
        position: relative;
        z-index: 2;
    }
    .post-featured-image img {
        width: 100%;
        max-height: 450px;
        object-fit: cover;
        border-radius: 20px;
        box-shadow: var(--shadow-md, 0 20px 60px rgba(0,0,0,0.3));
    }

    .post-body {
        max-width: 800px;
        margin: 0 auto;
        padding: 3rem 2rem 4rem;
        position: relative;
        z-index: 1;
    }
    .post-content {
        font-size: 1.05rem;
        line-height: 1.9;
        color: var(--text-secondary, #cbd5e1);
    }
    html.light-theme .post-content { color: #334155 !important; }
    .post-content h1, .post-content h2, .post-content h3 {
        color: var(--text-primary, #e2e8f0);
        margin-top: 2.5rem;
        margin-bottom: 1rem;
        font-weight: 700;
    }
    .post-content h2 { font-size: 1.6rem; }
    .post-content h3 { font-size: 1.3rem; }
    .post-content p { margin-bottom: 1.5rem; }
    .post-content ul, .post-content ol {
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }
    .post-content ul li, .post-content ol li { margin-bottom: 0.5rem; }
    .post-content a {
        color: #60a5fa;
        text-decoration: none;
    }
    .post-content a:hover { color: #3b82f6; }
    .post-content blockquote {
        border-left: 4px solid #3b82f6;
        background: rgba(59, 130, 246, 0.05);
        padding: 1.2rem 1.5rem;
        margin: 1.5rem 0;
        border-radius: 0 12px 12px 0;
        font-style: italic;
        color: var(--text-muted, #94a3b8);
    }
    .post-content code {
        background: var(--bg-card, #1e293b);
        padding: 0.2rem 0.5rem;
        border-radius: 6px;
        font-size: 0.9em;
        color: #f472b6;
    }
    html.light-theme .post-content code { background: #f1f5f9 !important; color: #d946ef !important; }
    .post-content pre {
        background: var(--bg-card, #1e293b);
        border: 1px solid var(--blog-border);
        border-radius: 12px;
        padding: 1.2rem;
        overflow-x: auto;
        margin: 1.5rem 0;
    }
    html.light-theme .post-content pre { background: #f8fafc !important; }
    .post-content pre code {
        background: none;
        padding: 0;
        color: var(--text-primary, #e2e8f0);
    }
    .post-content img {
        max-width: 100%;
        border-radius: 12px;
        margin: 1.5rem 0;
    }

    /* Tags */
    .post-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--blog-border);
    }
    .post-tags .tag {
        padding: 0.3rem 0.9rem;
        background: rgba(59, 130, 246, 0.08);
        border: 1px solid rgba(59, 130, 246, 0.15);
        border-radius: 20px;
        font-size: 0.8rem;
        color: #60a5fa;
        text-decoration: none;
        transition: all 0.3s;
    }
    .post-tags .tag:hover {
        background: rgba(59, 130, 246, 0.15);
    }

    /* Related Posts */
    .related-section {
        background: linear-gradient(180deg, var(--bg-primary, #0f172a) 0%, var(--bg-secondary, #0c1322) 100%);
        padding: 4rem 2rem;
        position: relative;
        z-index: 1;
    }
    .related-section h2 {
        text-align: center;
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }
    .related-section .subtitle {
        text-align: center;
        color: var(--text-muted, #64748b);
        margin-bottom: 3rem;
        font-size: 1rem;
    }
    .related-grid {
        max-width: 1100px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }
    .related-card {
        background: var(--bg-card, rgba(30, 41, 59, 0.4));
        border: 1px solid var(--blog-border);
        border-radius: 16px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
        display: block;
    }
    .related-card:hover {
        transform: translateY(-5px);
        border-color: var(--border-hover, rgba(59, 130, 246, 0.3));
        box-shadow: var(--shadow-md, 0 15px 40px rgba(59, 130, 246, 0.08));
    }
    .related-card .cat {
        font-size: 0.75rem;
        color: #60a5fa;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .related-card h4 {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }
    .related-card .date {
        font-size: 0.8rem;
        color: var(--text-muted, #64748b);
    }

    @media (max-width: 768px) {
        .post-meta { gap: 0.8rem; flex-direction: column; align-items: center; font-size: 0.82rem; }
        .post-header { padding: 5rem 1.5rem 2rem; }
        .post-header h1 { font-size: clamp(1.4rem, 4vw, 2rem); }
        .post-body { padding: 2rem 1.5rem 3rem; }
        .post-content { font-size: 0.95rem; line-height: 1.8; }
        .post-content h2 { font-size: 1.4rem; }
        .post-content h3 { font-size: 1.15rem; }
        .post-content pre { padding: 0.8rem; font-size: 0.82rem; }
        .related-grid { grid-template-columns: 1fr; gap: 1rem; }
        .related-section { padding: 3rem 1.5rem; }
        .related-section h2 { font-size: 1.5rem; }
        .post-featured-image { padding: 0 1rem; }
        .post-featured-image img { max-height: 300px; border-radius: 14px; }
        .post-tags .tag { font-size: 0.73rem; padding: 0.2rem 0.7rem; }
    }
    @media (max-width: 480px) {
        .post-header { padding: 4rem 1rem 1.5rem; }
        .post-header h1 { font-size: 1.3rem; }
        .post-header .back-link { font-size: 0.82rem; }
        .post-body { padding: 1.5rem 1rem 2rem; }
        .post-content { font-size: 0.88rem; }
        .post-content h2 { font-size: 1.2rem; }
        .post-content h3 { font-size: 1.05rem; }
        .post-content pre { font-size: 0.78rem; }
        .post-content blockquote { padding: 0.8rem 1rem; font-size: 0.85rem; }
        .post-featured-image { margin: -1rem auto 0; }
        .post-featured-image img { max-height: 220px; }
        .related-section { padding: 2rem 1rem; }
        .related-card { padding: 1rem; }
        .related-card h4 { font-size: 0.9rem; }
    }
</style>

<!-- Back link -->
<div class="post-header">
    <a href="{{ route('blog.index') }}" class="back-link">
        <i class="bi bi-arrow-left"></i> {{ __('messages.back_to_blog') }}
    </a>

    @if($post->category)
        <div class="category-tag"><i class="bi bi-folder2 me-1"></i>{{ $post->category }}</div>
    @endif

    <h1>{{ $post->title }}</h1>

    <div class="post-meta">
        <span><i class="bi bi-calendar3"></i> {{ $post->formatted_date }}</span>
        <span><i class="bi bi-clock"></i> {{ $post->reading_time }}</span>
        @if($post->author)
            <span><i class="bi bi-person"></i> {{ $post->author->name }}</span>
        @endif
    </div>
</div>

<!-- Featured Image -->
@if($post->featured_image)
    <div class="post-featured-image">
        <img src="{{ config('app.storage_url') }}{{ $post->featured_image }}" alt="{{ $post->title }}">
    </div>
@endif

<!-- Post Content -->
<div class="post-body">
    <div class="post-content">
        {!! nl2br($post->content) !!}
    </div>

    <!-- Tags -->
    @if($post->tags)
        <div class="post-tags">
            @foreach($post->getTagsArray() as $tag)
                <span class="tag"><i class="bi bi-tag me-1"></i>{{ $tag }}</span>
            @endforeach
        </div>
    @endif
</div>

<!-- Related Posts -->
@if($relatedPosts->isNotEmpty())
    <div class="related-section">
        <h2>{{ __('messages.related_posts') }}</h2>
        <p class="subtitle">{{ __('messages.related_subtitle') }}</p>
        <div class="related-grid">
            @foreach($relatedPosts as $related)
                <a href="{{ route('blog.show', $related->slug) }}" class="related-card">
                    @if($related->category)
                        <div class="cat">{{ $related->category }}</div>
                    @endif
                    <h4>{{ $related->title }}</h4>
                    <div class="date">
                        <i class="bi bi-calendar3 me-1"></i>{{ $related->formatted_date }}
                        <span class="ms-2"><i class="bi bi-clock me-1"></i>{{ $related->reading_time }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endif

@endsection
