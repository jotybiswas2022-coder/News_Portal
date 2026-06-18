@extends('backend.app')

@section('title', 'Dashboard')

@section('content')

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color: #1e293b;">
                <i class="bi bi-speedometer2 me-2" style="color: #6366f1;"></i>Dashboard Overview
            </h4>
            <p class="text-muted mb-0" style="font-size: 13px;">
                <i class="bi bi-calendar3 me-1"></i> {{ now()->format('l, F d, Y') }}
            </p>
        </div>
        <div>
            <span class="badge px-3 py-2" style="background: linear-gradient(135deg, #6366f1, #8b5cf6); font-size: 12px; font-weight: 500;">
                <i class="bi bi-clock-history me-1"></i> Last updated: {{ now()->format('h:i A') }}
            </span>
        </div>
    </div>

    <!-- ===== STATS CARDS ROW ===== -->
    <div class="row g-3 mb-4">

        <!-- Total Posts -->
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="ad-stat-card ad-stat-posts">
                <div class="d-flex align-items-center">
                    <div class="ad-stat-icon ad-icon-posts">
                        <i class="bi bi-journal-text"></i>
                    </div>
                    <div class="ms-3">
                        <div class="ad-stat-label">Total Posts</div>
                        <div class="ad-stat-number">{{ $totalPosts }}</div>
                    </div>
                </div>
                <div class="ad-stat-footer mt-2">
                    <span class="ad-stat-badge ad-badge-published">
                        <i class="bi bi-check-circle-fill"></i> {{ $publishedPosts }} Published
                    </span>
                    <span class="ad-stat-badge ad-badge-draft ms-2">
                        <i class="bi bi-pencil-fill"></i> {{ $draftPosts }} Draft
                    </span>
                </div>
            </div>
        </div>

        <!-- Total Categories -->
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="ad-stat-card ad-stat-categories">
                <div class="d-flex align-items-center">
                    <div class="ad-stat-icon ad-icon-categories">
                        <i class="bi bi-tags"></i>
                    </div>
                    <div class="ms-3">
                        <div class="ad-stat-label">Categories</div>
                        <div class="ad-stat-number">{{ $totalCategories }}</div>
                    </div>
                </div>
                <div class="ad-stat-footer mt-2">
                    <span class="text-muted small">
                        <i class="bi bi-collection me-1"></i> Content organization
                    </span>
                </div>
            </div>
        </div>

        <!-- Total Contacts -->
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="ad-stat-card ad-stat-contacts">
                <div class="d-flex align-items-center">
                    <div class="ad-stat-icon ad-icon-contacts">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <div class="ms-3">
                        <div class="ad-stat-label">Messages</div>
                        <div class="ad-stat-number">{{ $totalContacts }}</div>
                    </div>
                </div>
                <div class="ad-stat-footer mt-2">
                    <a href="/admin/contacts" class="text-decoration-none small fw-medium" style="color: #0891b2;">
                        <i class="bi bi-arrow-right-circle me-1"></i> View all messages
                    </a>
                </div>
            </div>
        </div>

        <!-- Total Sliders -->
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="ad-stat-card ad-stat-sliders">
                <div class="d-flex align-items-center">
                    <div class="ad-stat-icon ad-icon-sliders">
                        <i class="bi bi-images"></i>
                    </div>
                    <div class="ms-3">
                        <div class="ad-stat-label">Sliders</div>
                        <div class="ad-stat-number">{{ $totalSliders }}</div>
                    </div>
                </div>
                <div class="ad-stat-footer mt-2">
                    <a href="/admin/sliders" class="text-decoration-none small fw-medium" style="color: #7c3aed;">
                        <i class="bi bi-arrow-right-circle me-1"></i> Manage sliders
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- ===== MIDDLE ROW: Category Distribution + Recent Posts ===== -->
    <div class="row g-3 mb-4">

        <!-- Posts by Category -->
        <div class="col-xl-4 col-lg-5">
            <div class="ad-panel">
                <div class="ad-panel-header">
                    <h5><i class="bi bi-pie-chart me-2" style="color: #6366f1;"></i>Posts by Category</h5>
                </div>
                <div class="ad-panel-body">
                    @if($categoryPostCounts->count() > 0)
                        @php $maxCount = $categoryPostCounts->max('posts_count'); @endphp
                        @foreach($categoryPostCounts as $catStat)
                        <div class="ad-bar-item">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="ad-bar-label">{{ $catStat->name }}</span>
                                <span class="ad-bar-value">{{ $catStat->posts_count }} posts</span>
                            </div>
                            <div class="ad-bar-track">
                                <div class="ad-bar-fill" style="width: {{ $maxCount > 0 ? ($catStat->posts_count / $maxCount) * 100 : 0 }}%;">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 8px;"></i>
                            <span>No categories yet</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Posts -->
        <div class="col-xl-8 col-lg-7">
            <div class="ad-panel">
                <div class="ad-panel-header d-flex justify-content-between align-items-center">
                    <h5><i class="bi bi-clock-history me-2" style="color: #6366f1;"></i>Recent Posts</h5>
                    <a href="/admin/posts" class="btn btn-sm ad-btn-outline">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="ad-panel-body p-0">
                    @if($recentPosts->count() > 0)
                    <div class="ad-table-responsive">
                        <table class="ad-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentPosts as $post)
                                <tr>
                                    <td>
                                        <div class="ad-post-title">
                                            @if($post->file)
                                                @php
                                                    $ext = strtolower(pathinfo($post->file, PATHINFO_EXTENSION));
                                                    $imgExt = ['jpg','jpeg','png','gif','webp'];
                                                @endphp
                                                @if(in_array($ext, $imgExt))
                                                <img src="{{ config('app.storage_url') }}{{ $post->file }}" class="ad-post-thumb" alt="">
                                                @endif
                                            @endif
                                            <span>{{ \Illuminate\Support\Str::limit($post->title, 35) }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($post->PostCategory)
                                        <span class="ad-cat-tag">{{ $post->PostCategory->name }}</span>
                                        @else
                                        <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td class="text-muted small">{{ $post->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if($post->status == '1')
                                        <span class="ad-status ad-status-active">
                                            <i class="bi bi-check-circle-fill"></i> Published
                                        </span>
                                        @else
                                        <span class="ad-status ad-status-draft">
                                            <i class="bi bi-pencil-fill"></i> Draft
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center text-muted py-5">
                        <i class="bi bi-newspaper" style="font-size: 2.5rem; display: block; margin-bottom: 10px; opacity: 0.5;"></i>
                        <span>No posts yet</span>
                        <div class="mt-2">
                            <a href="/admin/posts/create" class="btn btn-sm" style="background: #6366f1; color: #fff;">
                                <i class="bi bi-plus-lg me-1"></i> Create Post
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <!-- ===== BOTTOM ROW: Recent Contacts + Quick Categories ===== -->
    <div class="row g-3">

        <!-- Recent Contacts -->
        <div class="col-xl-7">
            <div class="ad-panel">
                <div class="ad-panel-header d-flex justify-content-between align-items-center">
                    <h5><i class="bi bi-chat-dots me-2" style="color: #0891b2;"></i>Recent Messages</h5>
                    <a href="/admin/contacts" class="btn btn-sm ad-btn-outline">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="ad-panel-body p-0">
                    @if($recentContacts->count() > 0)
                    <div class="ad-table-responsive">
                        <table class="ad-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentContacts as $contact)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="ad-avatar">{{ strtoupper(substr($contact->name, 0, 1)) }}</div>
                                            <span class="fw-medium">{{ $contact->name }}</span>
                                        </div>
                                    </td>
                                    <td class="small">{{ $contact->email }}</td>
                                    <td>
                                        <span class="ad-msg-preview">{{ \Illuminate\Support\Str::limit($contact->message, 40) }}</span>
                                    </td>
                                    <td class="text-muted small">{{ $contact->created_at->format('d M Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center text-muted py-5">
                        <i class="bi bi-envelope-open" style="font-size: 2.5rem; display: block; margin-bottom: 10px; opacity: 0.5;"></i>
                        <span>No messages yet</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Info / Categories List -->
        <div class="col-xl-5">
            <div class="ad-panel">
                <div class="ad-panel-header">
                    <h5><i class="bi bi-info-circle me-2" style="color: #f59e0b;"></i>Quick Overview</h5>
                </div>
                <div class="ad-panel-body">
                    <div class="ad-quick-grid">
                        <div class="ad-quick-item">
                            <div class="ad-quick-icon ad-qi-posts">
                                <i class="bi bi-journal-text"></i>
                            </div>
                            <div class="ad-quick-text">
                                <span class="ad-quick-label">Total Posts</span>
                                <span class="ad-quick-value">{{ $totalPosts }}</span>
                            </div>
                        </div>
                        <div class="ad-quick-item">
                            <div class="ad-quick-icon ad-qi-cats">
                                <i class="bi bi-tags"></i>
                            </div>
                            <div class="ad-quick-text">
                                <span class="ad-quick-label">Categories</span>
                                <span class="ad-quick-value">{{ $totalCategories }}</span>
                            </div>
                        </div>
                        <div class="ad-quick-item">
                            <div class="ad-quick-icon ad-qi-msgs">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div class="ad-quick-text">
                                <span class="ad-quick-label">Messages</span>
                                <span class="ad-quick-value">{{ $totalContacts }}</span>
                            </div>
                        </div>
                        <div class="ad-quick-item">
                            <div class="ad-quick-icon ad-qi-sliders">
                                <i class="bi bi-images"></i>
                            </div>
                            <div class="ad-quick-text">
                                <span class="ad-quick-label">Sliders</span>
                                <span class="ad-quick-value">{{ $totalSliders }}</span>
                            </div>
                        </div>
                        <div class="ad-quick-item">
                            <div class="ad-quick-icon ad-qi-pub">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="ad-quick-text">
                                <span class="ad-quick-label">Published</span>
                                <span class="ad-quick-value" style="color: #10b981;">{{ $publishedPosts }}</span>
                            </div>
                        </div>
                        <div class="ad-quick-item">
                            <div class="ad-quick-icon ad-qi-draft">
                                <i class="bi bi-pencil"></i>
                            </div>
                            <div class="ad-quick-text">
                                <span class="ad-quick-label">Drafts</span>
                                <span class="ad-quick-value" style="color: #f59e0b;">{{ $draftPosts }}</span>
                            </div>
                        </div>
                    </div>

                    @if($latestCategories->count() > 0)
                    <hr class="my-3" style="border-color: #e9eef3;">
                    <div>
                        <small class="text-muted fw-semibold text-uppercase" style="letter-spacing: 0.5px;">
                            <i class="bi bi-collection me-1"></i> Latest Categories
                        </small>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            @foreach($latestCategories as $cat)
                            <span class="ad-cat-pill">{{ $cat->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>


<style>
    /* ===== ADMIN DASHBOARD STYLES ===== */

    /* --- Stats Cards --- */
    .ad-stat-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 20px 22px;
        border: 1px solid #e9eef3;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .ad-stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        transition: height 0.3s ease;
    }

    .ad-stat-posts::before { background: linear-gradient(90deg, #6366f1, #8b5cf6); }
    .ad-stat-categories::before { background: linear-gradient(90deg, #10b981, #34d399); }
    .ad-stat-contacts::before { background: linear-gradient(90deg, #0891b2, #06b6d4); }
    .ad-stat-sliders::before { background: linear-gradient(90deg, #7c3aed, #a78bfa); }

    .ad-stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
        border-color: transparent;
    }

    .ad-stat-card:hover::before {
        height: 4px;
    }

    .ad-stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .ad-icon-posts { background: rgba(99, 102, 241, 0.12); color: #6366f1; }
    .ad-icon-categories { background: rgba(16, 185, 129, 0.12); color: #10b981; }
    .ad-icon-contacts { background: rgba(8, 145, 178, 0.12); color: #0891b2; }
    .ad-icon-sliders { background: rgba(124, 58, 237, 0.12); color: #7c3aed; }

    .ad-stat-label {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #94a3b8;
        margin-bottom: 2px;
    }

    .ad-stat-number {
        font-size: 30px;
        font-weight: 800;
        color: #1e293b;
        line-height: 1.1;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    .ad-stat-footer { border-top: 1px solid #f1f5f9; padding-top: 10px; }

    .ad-stat-badge {
        font-size: 11px;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .ad-badge-published { background: rgba(16, 185, 129, 0.1); color: #10b981; }
    .ad-badge-draft { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }

    /* --- Panels --- */
    .ad-panel {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #e9eef3;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
        height: 100%;
    }

    .ad-panel:hover {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    }

    .ad-panel-header {
        padding: 16px 20px;
        border-bottom: 1px solid #f1f5f9;
    }

    .ad-panel-header h5 {
        font-size: 14px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
    }

    .ad-panel-body {
        padding: 18px 20px;
    }

    /* --- Bar Chart (Category Distribution) --- */
    .ad-bar-item {
        margin-bottom: 14px;
    }

    .ad-bar-item:last-child {
        margin-bottom: 0;
    }

    .ad-bar-label {
        font-size: 12px;
        font-weight: 600;
        color: #475569;
    }

    .ad-bar-value {
        font-size: 11px;
        font-weight: 700;
        color: #6366f1;
    }

    .ad-bar-track {
        height: 7px;
        background: #f1f5f9;
        border-radius: 4px;
        overflow: hidden;
    }

    .ad-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #6366f1, #8b5cf6);
        border-radius: 4px;
        transition: width 1s ease;
        position: relative;
    }

    /* --- Tables --- */
    .ad-table-responsive {
        overflow-x: auto;
    }

    .ad-table {
        width: 100%;
        border-collapse: collapse;
    }

    .ad-table th {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #94a3b8;
        padding: 12px 20px;
        border-bottom: 1px solid #f1f5f9;
        text-align: left;
        white-space: nowrap;
        background: #fafbfc;
    }

    .ad-table td {
        padding: 12px 20px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
        font-size: 13px;
        color: #334155;
    }

    .ad-table tbody tr {
        transition: background 0.2s ease;
    }

    .ad-table tbody tr:hover {
        background: rgba(99, 102, 241, 0.03);
    }

    .ad-table tbody tr:last-child td {
        border-bottom: none;
    }

    .ad-post-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 500;
    }

    .ad-post-thumb {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #e9eef3;
        flex-shrink: 0;
    }

    .ad-cat-tag {
        display: inline-block;
        padding: 2px 10px;
        font-size: 11px;
        font-weight: 600;
        background: rgba(99, 102, 241, 0.08);
        color: #6366f1;
        border-radius: 6px;
    }

    .ad-status {
        font-size: 11px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 10px;
        border-radius: 6px;
    }

    .ad-status-active {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .ad-status-draft {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    .ad-avatar {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .ad-msg-preview {
        color: #64748b;
        font-size: 12px;
    }

    .ad-btn-outline {
        border: 1px solid #e9eef3;
        color: #64748b;
        font-size: 12px;
        font-weight: 600;
        padding: 4px 14px;
        border-radius: 8px;
        transition: all 0.3s ease;
        background: #fff;
    }

    .ad-btn-outline:hover {
        border-color: #6366f1;
        color: #6366f1;
        background: rgba(99, 102, 241, 0.04);
    }

    /* --- Quick Overview Grid --- */
    .ad-quick-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .ad-quick-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 12px;
        border-radius: 10px;
        background: #fafbfc;
        border: 1px solid #f1f5f9;
        transition: all 0.3s ease;
    }

    .ad-quick-item:hover {
        background: #fff;
        border-color: #e9eef3;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .ad-quick-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .ad-qi-posts { background: rgba(99, 102, 241, 0.1); color: #6366f1; }
    .ad-qi-cats { background: rgba(16, 185, 129, 0.1); color: #10b981; }
    .ad-qi-msgs { background: rgba(8, 145, 178, 0.1); color: #0891b2; }
    .ad-qi-sliders { background: rgba(124, 58, 237, 0.1); color: #7c3aed; }
    .ad-qi-pub { background: rgba(16, 185, 129, 0.08); color: #10b981; }
    .ad-qi-draft { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }

    .ad-quick-text {
        display: flex;
        flex-direction: column;
    }

    .ad-quick-label {
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #94a3b8;
    }

    .ad-quick-value {
        font-size: 18px;
        font-weight: 800;
        color: #1e293b;
        line-height: 1.2;
    }

    .ad-cat-pill {
        display: inline-block;
        padding: 4px 14px;
        font-size: 11px;
        font-weight: 600;
        background: rgba(99, 102, 241, 0.06);
        color: #6366f1;
        border-radius: 20px;
        border: 1px solid rgba(99, 102, 241, 0.1);
        transition: all 0.2s ease;
    }

    .ad-cat-pill:hover {
        background: rgba(99, 102, 241, 0.12);
    }

    /* --- Responsive --- */
    @media (max-width: 768px) {
        .ad-stat-number { font-size: 24px; }
        .ad-stat-icon { width: 44px; height: 44px; font-size: 18px; }
        .ad-table th, .ad-table td { padding: 10px 14px; }
        .ad-quick-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 576px) {
        .ad-panel-header { padding: 14px 16px; }
        .ad-panel-body { padding: 14px 16px; }
        .ad-stat-card { padding: 16px; }
    }
</style>

@endsection
