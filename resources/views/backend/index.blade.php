@extends('backend.app')

@section('title', 'Dashboard')

@section('content')

    <!-- Page Header -->
    <div class="ad-page-header">
        <div>
            <h4 class="ad-page-title">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard Overview
            </h4>
            <p class="ad-page-sub">
                <i class="bi bi-calendar3"></i> {{ now()->format('l, F d, Y') }}
                <span class="ad-page-sep">·</span>
                <i class="bi bi-clock-history"></i> {{ now()->format('h:i A') }}
            </p>
        </div>
        <span class="ad-header-badge">
            <i class="bi bi-lightning-charge-fill"></i> Live Overview
        </span>
    </div>

    <!-- ===== STATS CARDS ROW ===== -->
    <div class="row g-3 mb-4">

        <!-- Total Posts -->
        <div class="col-xl-3 col-md-6">
            <div class="ad-stat-card ad-stat-posts">
                <div class="ad-stat-top">
                    <div class="ad-stat-icon ad-icon-posts">
                        <i class="bi bi-journal-text"></i>
                    </div>
                    <div class="ad-stat-body">
                        <div class="ad-stat-label">Total Posts</div>
                        <div class="ad-stat-number">{{ $totalPosts }}</div>
                    </div>
                </div>
                <div class="ad-stat-footer">
                    <span class="ad-stat-badge ad-badge-published">
                        <i class="bi bi-check-circle-fill"></i> {{ $publishedPosts }} Published
                    </span>
                    <span class="ad-stat-badge ad-badge-draft">
                        <i class="bi bi-pencil-fill"></i> {{ $draftPosts }} Draft
                    </span>
                </div>
            </div>
        </div>

        <!-- Total Categories -->
        <div class="col-xl-3 col-md-6">
            <div class="ad-stat-card ad-stat-categories">
                <div class="ad-stat-top">
                    <div class="ad-stat-icon ad-icon-categories">
                        <i class="bi bi-tags"></i>
                    </div>
                    <div class="ad-stat-body">
                        <div class="ad-stat-label">Categories</div>
                        <div class="ad-stat-number">{{ $totalCategories }}</div>
                    </div>
                </div>
                <div class="ad-stat-footer">
                    <span class="ad-stat-note">
                        <i class="bi bi-collection"></i> Content organization
                    </span>
                </div>
            </div>
        </div>

        <!-- Total Contacts -->
        <div class="col-xl-3 col-md-6">
            <div class="ad-stat-card ad-stat-contacts">
                <div class="ad-stat-top">
                    <div class="ad-stat-icon ad-icon-contacts">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <div class="ad-stat-body">
                        <div class="ad-stat-label">Messages</div>
                        <div class="ad-stat-number">{{ $totalContacts }}</div>
                    </div>
                </div>
                <div class="ad-stat-footer">
                    <a href="/admin/contacts" class="ad-stat-link">
                        <i class="bi bi-arrow-right-circle"></i> View all messages
                    </a>
                </div>
            </div>
        </div>

        <!-- Total Sliders -->
        <div class="col-xl-3 col-md-6">
            <div class="ad-stat-card ad-stat-sliders">
                <div class="ad-stat-top">
                    <div class="ad-stat-icon ad-icon-sliders">
                        <i class="bi bi-images"></i>
                    </div>
                    <div class="ad-stat-body">
                        <div class="ad-stat-label">Sliders</div>
                        <div class="ad-stat-number">{{ $totalSliders }}</div>
                    </div>
                </div>
                <div class="ad-stat-footer">
                    <a href="/admin/sliders" class="ad-stat-link">
                        <i class="bi bi-arrow-right-circle"></i> Manage sliders
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
                    <h5><i class="bi bi-pie-chart"></i>Posts by Category</h5>
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
                        <div class="ad-empty-state">
                            <i class="bi bi-inbox"></i>
                            <h6>No categories yet</h6>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Posts -->
        <div class="col-xl-8 col-lg-7">
            <div class="ad-panel">
                <div class="ad-panel-header ad-panel-header-row">
                    <h5><i class="bi bi-clock-history"></i>Recent Posts</h5>
                    <a href="/admin/posts" class="ad-btn-outline">
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
                        <div class="ad-empty-state ad-empty-state-lg">
                            <i class="bi bi-newspaper"></i>
                            <h6>No posts yet</h6>
                            <p class="text-muted">Create your first post to get started</p>
                            <a href="/admin/posts/create" class="ad-btn-primary" style="display: inline-flex; font-size: 12px; padding: 8px 20px;">
                                <i class="bi bi-plus-lg me-1"></i> Create Post
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <!-- ===== BOTTOM ROW: Recent Contacts + Quick Notes ===== -->
    <div class="row g-3">

        <!-- Recent Contacts -->
        <div class="col-xl-7">
            <div class="ad-panel">
                <div class="ad-panel-header ad-panel-header-row">
                    <h5><i class="bi bi-chat-dots" style="color: #0891b2;"></i>Recent Messages</h5>
                    <a href="/admin/contacts" class="ad-btn-outline">
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
                        <div class="ad-empty-state">
                            <i class="bi bi-envelope-open"></i>
                            <h6>No messages yet</h6>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Overview -->
        <div class="col-xl-5">
            <div class="ad-panel">
                <div class="ad-panel-header">
                    <h5><i class="bi bi-info-circle" style="color: #f59e0b;"></i>Quick Overview</h5>
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
                        <small class="ad-quick-section-label">
                            <i class="bi bi-collection"></i> Latest Categories
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
    /* ===== DASHBOARD STYLES ===== */

    .ad-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 24px;
    }
    .ad-page-title {
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 4px;
        font-size: 22px;
    }
    .ad-page-title i { color: #6366f1; margin-right: 10px; }
    .ad-page-sub {
        color: #94a3b8;
        font-size: 13px;
        margin: 0;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px;
    }
    .ad-page-sep { color: #dbe2eb; }
    .ad-header-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 18px;
        border-radius: 10px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        font-size: 12px;
        font-weight: 600;
        box-shadow: 0 6px 18px rgba(99, 102, 241, 0.28);
    }

    /* --- Stats Cards --- */
    .ad-stat-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #e9eef3;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        height: 100%;
        box-shadow: 0 1px 4px rgba(15, 23, 42, 0.04);
    }
    .ad-stat-card::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
    }
    .ad-stat-posts::after { background: linear-gradient(90deg, #6366f1, #8b5cf6); }
    .ad-stat-categories::after { background: linear-gradient(90deg, #10b981, #34d399); }
    .ad-stat-contacts::after { background: linear-gradient(90deg, #0891b2, #06b6d4); }
    .ad-stat-sliders::after { background: linear-gradient(90deg, #7c3aed, #a78bfa); }

    .ad-stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 34px rgba(15, 23, 42, 0.1);
        border-color: transparent;
    }
    .ad-stat-top {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 16px;
    }
    .ad-stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
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

    .ad-stat-body { min-width: 0; }
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
        font-family: 'Inter', system-ui, sans-serif;
    }
    .ad-stat-footer {
        border-top: 1px solid #f1f5f9;
        padding-top: 12px;
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        align-items: center;
    }
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
    .ad-stat-note {
        font-size: 11px;
        color: #94a3b8;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-weight: 500;
    }
    .ad-stat-link {
        font-size: 12px;
        font-weight: 600;
        color: #0891b2;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.2s;
    }
    .ad-stat-link:hover { color: #4f46e5; }
    .ad-stat-sliders .ad-stat-link { color: #7c3aed; }

    /* --- Panels --- */
    .ad-panel {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e9eef3;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
        height: 100%;
        box-shadow: 0 1px 4px rgba(15, 23, 42, 0.04);
    }
    .ad-panel:hover {
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.08);
    }
    .ad-panel-header {
        padding: 16px 20px;
        border-bottom: 1px solid #f1f5f9;
    }
    .ad-panel-header-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }
    .ad-panel-header h5 {
        font-size: 14px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
    }
    .ad-panel-header h5 i {
        color: #6366f1;
        font-size: 16px;
        margin-right: 9px;
    }
    .ad-panel-body { padding: 18px 20px; }

    /* --- Bar Chart --- */
    .ad-bar-item { margin-bottom: 14px; }
    .ad-bar-item:last-child { margin-bottom: 0; }
    .ad-bar-label { font-size: 12px; font-weight: 600; color: #475569; }
    .ad-bar-value { font-size: 11px; font-weight: 700; color: #6366f1; }
    .ad-bar-track {
        height: 8px;
        background: #f1f5f9;
        border-radius: 6px;
        overflow: hidden;
    }
    .ad-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #6366f1, #8b5cf6);
        border-radius: 6px;
        transition: width 1s ease;
    }

    /* --- Tables --- */
    .ad-table-responsive { overflow-x: auto; }
    .ad-table { width: 100%; border-collapse: collapse; min-width: 480px; }
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
    .ad-table tbody tr { transition: background 0.2s ease; }
    .ad-table tbody tr:hover { background: rgba(99, 102, 241, 0.03); }
    .ad-table tbody tr:last-child td { border-bottom: none; }

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
        white-space: nowrap;
    }
    .ad-status {
        font-size: 11px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 10px;
        border-radius: 6px;
        white-space: nowrap;
    }
    .ad-status-active { background: rgba(16, 185, 129, 0.1); color: #10b981; }
    .ad-status-draft { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }

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
    .ad-msg-preview { color: #64748b; font-size: 12px; }

    .ad-btn-outline {
        border: 1px solid #e9eef3;
        color: #64748b;
        font-size: 12px;
        font-weight: 600;
        padding: 5px 14px;
        border-radius: 8px;
        transition: all 0.3s ease;
        background: #fff;
        white-space: nowrap;
    }
    .ad-btn-outline:hover { border-color: #6366f1; color: #6366f1; background: rgba(99, 102, 241, 0.04); }

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
        padding: 12px;
        border-radius: 12px;
        background: #fafbfd;
        border: 1px solid #f1f5f9;
        transition: all 0.25s ease;
    }
    .ad-quick-item:hover {
        background: #fff;
        border-color: #e2e8f0;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(15, 23, 42, 0.06);
    }
    .ad-quick-icon {
        width: 38px;
        height: 38px;
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

    .ad-quick-text { display: flex; flex-direction: column; min-width: 0; }
    .ad-quick-label {
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #94a3b8;
    }
    .ad-quick-value { font-size: 18px; font-weight: 800; color: #1e293b; line-height: 1.2; }

    .ad-quick-section-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 6px;
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
        white-space: nowrap;
    }
    .ad-cat-pill:hover { background: rgba(99, 102, 241, 0.12); }

    .ad-empty-state { text-align: center; padding: 26px; color: #94a3b8; }
    .ad-empty-state-lg { padding: 44px 20px; }
    .ad-empty-state i { font-size: 38px; color: #cbd5e1; display: block; margin-bottom: 10px; }
    .ad-empty-state h6 { font-size: 14px; font-weight: 700; color: #475569; margin-bottom: 4px; }
    .ad-empty-state p { font-size: 12px; margin-bottom: 12px; }

    /* --- Responsive --- */
    @media (max-width: 1199.98px) {
        .ad-page-title { font-size: 20px; }
    }
    @media (max-width: 767.98px) {
        .ad-stat-number { font-size: 26px; }
        .ad-stat-icon { width: 46px; height: 46px; font-size: 19px; }
        .ad-quick-grid { grid-template-columns: 1fr 1fr; }
        .ad-page-header { flex-direction: column; align-items: flex-start; }
        .ad-table th, .ad-table td { padding: 10px 14px; }
    }
    @media (max-width: 575.98px) {
        .ad-panel-header { padding: 14px 16px; }
        .ad-panel-body { padding: 14px 16px; }
        .ad-stat-card { padding: 16px; }
        .ad-quick-grid { grid-template-columns: 1fr; }
    }
</style>

@endsection