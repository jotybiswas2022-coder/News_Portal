@extends('backend.app')

@section('content')

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show ad-alert ad-alert-success" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show ad-alert ad-alert-danger" role="alert">
    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="ad-page-header">
    <div class="ad-page-header-main">
        <h4 class="ad-page-title">
            <i class="bi bi-journal-text"></i> Post List
        </h4>
        <p class="ad-page-sub">
            <i class="bi bi-house-door"></i> Dashboard / <span class="fw-medium">Posts</span>
            <span class="ad-page-sep">·</span>
            <span class="ad-page-count">{{ $posts->count() }} posts</span>
        </p>
    </div>
    <a href="{{ url('admin/posts/create') }}" class="ad-btn-primary ad-btn-primary-sm">
        <i class="bi bi-plus-lg me-1"></i> Add New Post
    </a>
</div>

<div class="ad-panel">
    <div class="ad-panel-header">
        <div class="d-flex align-items-center gap-2">
            <span class="ad-panel-icon"><i class="bi bi-collection-fill"></i></span>
            <div>
                <h5 class="mb-0">All Posts</h5>
                <small class="text-muted" style="font-size: 12px;">Manage every post on the portal</small>
            </div>
        </div>
        <div class="ad-search-wrap">
            <i class="bi bi-search ad-search-icon"></i>
            <input type="text" id="postSearch" class="ad-search-input" placeholder="Search by title or category...">
            <i class="bi bi-x-lg ad-search-clear d-none" id="searchClear" onclick="clearSearch()"></i>
        </div>
    </div>
    <div class="ad-panel-body p-0">
        <div class="ad-table-responsive">
            <table class="ad-table ad-posts-table">
                <thead>
                    <tr>
                        <th style="width:52px;">#</th>
                        <th style="width:280px;">Title</th>
                        <th style="width:120px;">Category</th>
                        <th style="width:70px;">File</th>
                        <th style="width:100px;">Status</th>
                        <th style="width:130px;">Actions</th>
                        <th style="width:150px;">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                    <tr>
                        <td data-label="#" class="ad-td-index"><span class="ad-index-badge">{{ $loop->iteration }}</span></td>
                        <td data-label="Title"><div class="ad-post-title-cell">{{ $post->title }}</div></td>
                        <td data-label="Category">
                            @if($post->PostCategory)
                            <span class="ad-cat-tag"><i class="bi bi-tag-fill me-1" style="font-size:9px;"></i>{{ $post->PostCategory->name }}</span>
                            @else
                            <span class="text-muted" style="font-size:12px;">—</span>
                            @endif
                        </td>
                        <td data-label="File">
                            @if($post->file)
                                @php
                                    $ext = strtolower(pathinfo($post->file, PATHINFO_EXTENSION));
                                    $videoExtensions = ['mp4','webm','ogg','asf','avi','flv','mkv'];
                                    $imageExtensions = ['jpg','jpeg','png','gif','webp'];
                                    $isImage = in_array($ext, $imageExtensions);
                                    $isVideo = in_array($ext, $videoExtensions);
                                @endphp
                                @if($isImage)
                                <button type="button" class="media-preview p-0 border-0 bg-transparent" data-type="image" data-src="{{ config('app.storage_url') }}{{ $post->file }}" data-bs-toggle="modal" data-bs-target="#mediaModal">
                                    <div class="ad-file-thumb">
                                        <img src="{{ config('app.storage_url') }}{{ $post->file }}" alt="">
                                    </div>
                                </button>
                                @elseif($isVideo)
                                <button type="button" class="media-preview p-0 border-0 bg-transparent" data-type="video" data-src="{{ config('app.storage_url') }}{{ $post->file }}" data-bs-toggle="modal" data-bs-target="#mediaModal">
                                    <div class="ad-file-thumb ad-video-thumb">
                                        <video src="{{ config('app.storage_url') }}{{ $post->file }}" muted></video>
                                        <span class="ad-play-badge"><i class="bi bi-play-fill"></i></span>
                                    </div>
                                </button>
                                @else
                                <span class="text-muted small">—</span>
                                @endif
                            @else
                            <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td data-label="Status">
                            @if($post->status == 1)
                            <span class="ad-status-pill ad-status-active"><i class="bi bi-check-circle-fill"></i> Active</span>
                            @else
                            <span class="ad-status-pill ad-status-inactive"><i class="bi bi-x-circle-fill"></i> Inactive</span>
                            @endif
                        </td>
                        <td data-label="Actions">
                            <div class="ad-action-group">
                                <button class="ad-action-btn ad-action-edit" data-bs-toggle="modal" data-bs-target="#editModal{{ $post->id }}" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="ad-action-btn ad-action-delete" onclick="confirmation({{ $post->id }})" title="Delete">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        </td>
                        <td data-label="Date">
                            <div class="ad-date-stack">
                                <span class="ad-date-day">{{ \Carbon\Carbon::parse($post->created_at)->timezone('Asia/Dhaka')->format('d M Y') }}</span>
                                <span class="ad-date-time">{{ \Carbon\Carbon::parse($post->created_at)->timezone('Asia/Dhaka')->format('h:i A') }}</span>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="ad-empty-state">
                                <span class="ad-empty-icon"><i class="bi bi-journal-plus"></i></span>
                                <h6>No Posts Yet</h6>
                                <p class="text-muted">Create your first post to get started</p>
                                <a href="{{ url('admin/posts/create') }}" class="ad-btn-primary ad-btn-primary-sm">
                                    <i class="bi bi-plus-lg me-1"></i> Create Post
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="mediaModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content ad-modal-content">
            <div class="ad-modal-header">
                <h5 class="ad-modal-title"><i class="bi bi-eye me-2"></i>Media Preview</h5>
                <button class="ad-modal-close" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="ad-modal-body text-center">
                <img id="mediaImage" class="img-fluid d-none" style="max-height:500px; border-radius: 8px;">
                <video id="mediaVideo" class="img-fluid d-none" controls style="max-height:500px; border-radius: 8px;">
                    <source id="mediaVideoSource">
                </video>
                <iframe id="mediaIframe" class="d-none" style="width:100%;height:500px;border:0;border-radius:8px;"></iframe>
            </div>
        </div>
    </div>
</div>

<script>
let lastMediaData = null;

document.addEventListener('DOMContentLoaded', function () {
    const mediaModalEl = document.getElementById('mediaModal');
    const mediaImage = document.getElementById('mediaImage');
    const mediaVideo = document.getElementById('mediaVideo');
    const mediaVideoSource = document.getElementById('mediaVideoSource');
    const mediaIframe = document.getElementById('mediaIframe');

    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.media-preview');
        if (!btn) return;
        lastMediaData = { type: btn.dataset.type, src: btn.dataset.src };
    });

    if (mediaModalEl) {
        mediaModalEl.addEventListener('show.bs.modal', function () {
            if (!lastMediaData) return;
            const type = lastMediaData.type;
            const src = lastMediaData.src;
            const ext = src.split('.').pop().toLowerCase();
            mediaImage.classList.add('d-none');
            mediaVideo.classList.add('d-none');
            mediaIframe.classList.add('d-none');
            mediaVideo.pause();
            if (type === 'image') {
                mediaImage.src = src;
                mediaImage.classList.remove('d-none');
            } else if (type === 'video') {
                if (ext === 'asf') {
                    mediaIframe.src = src;
                    mediaIframe.classList.remove('d-none');
                } else {
                    mediaVideoSource.src = src;
                    mediaVideo.load();
                    mediaVideo.classList.remove('d-none');
                }
            }
        });

        mediaModalEl.addEventListener('hidden.bs.modal', function () {
            mediaVideo.pause();
            mediaImage.src = '';
            mediaVideoSource.src = '';
            mediaIframe.src = '';
        });
    }

    window.confirmation = function (id) {
        Swal.fire({
            title: 'Delete Post',
            text: 'Are you sure you want to delete this post?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, delete it',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/admin/posts/delete/' + id;
            }
        });
    }

    const postSearch = document.getElementById('postSearch');
    const searchClear = document.getElementById('searchClear');
    const tableRows = document.querySelectorAll('table tbody tr');

    window.clearSearch = function() {
        postSearch.value = '';
        searchClear.classList.add('d-none');
        tableRows.forEach(row => {
            if (!row.querySelector('.ad-empty-state')) { row.style.display = ''; }
        });
        const nr = document.getElementById('noPostsRow');
        if (nr) nr.remove();
        postSearch.focus();
    };

    postSearch.addEventListener('keyup', function () {
        const query = this.value.toLowerCase().trim();
        if (query.length > 0) searchClear.classList.remove('d-none');
        else searchClear.classList.add('d-none');
        tableRows.forEach(row => {
            if (row.querySelector('.ad-empty-state')) return;
            const title = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
            const category = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase() || '';
            row.style.display = (title.includes(query) || category.includes(query)) ? '' : 'none';
        });
        const visibleRows = Array.from(tableRows).filter(r => r.style.display !== 'none' && !r.querySelector('.ad-empty-state'));
        const noRow = document.getElementById('noPostsRow');
        if (visibleRows.length === 0) {
            if (!noRow) {
                const tbody = document.querySelector('table tbody');
                const nr = document.createElement('tr');
                nr.id = 'noPostsRow';
                nr.innerHTML = '<td colspan="7" class="text-center py-5"><div class="ad-empty-state"><span class="ad-empty-icon"><i class="bi bi-search"></i></span><h6>No Results</h6><p class="text-muted">No posts match your search</p></div></td>';
                tbody.appendChild(nr);
            }
        } else {
            if (noRow) noRow.remove();
        }
    });
});
</script>

<style>
    .ad-alert { border-radius: 12px; border: none; padding: 13px 18px; font-size: 13px; font-weight: 500; margin-bottom: 18px; }
    .ad-alert-success { background: rgba(16,185,129,0.08); color: #10b981; }
    .ad-alert-danger { background: rgba(239,68,68,0.08); color: #ef4444; }

    /* Page header */
    .ad-page-header {
        display: flex; justify-content: space-between; align-items: center;
        flex-wrap: wrap; gap: 12px; margin-bottom: 22px;
    }
    .ad-page-header-main { min-width: 0; }
    .ad-page-title { font-weight: 800; color: #1e293b; margin-bottom: 4px; font-size: 22px; }
    .ad-page-title i { color: #6366f1; margin-right: 10px; }
    .ad-page-sub { color: #94a3b8; font-size: 13px; margin: 0; display: flex; align-items: center; flex-wrap: wrap; gap: 6px; }
    .ad-page-sub i { font-size: 12px; color: #a8b4c8; }
    .ad-page-sub .fw-medium { color: #6366f1; }
    .ad-page-sep { color: #dbe2eb; }
    .ad-page-count { color: #475569; font-weight: 600; }
    .ad-btn-primary {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 11px 24px; border-radius: 10px;
        font-size: 14px; font-weight: 600;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff; border: none; cursor: pointer;
        box-shadow: 0 4px 12px rgba(99,102,241,0.25);
        transition: all 0.25s; text-decoration: none;
    }
    .ad-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(99,102,241,0.35); color: #fff; }
    .ad-btn-primary-sm { padding: 9px 18px; font-size: 13px; }

    /* Panel + table */
    .ad-panel {
        background: #fff; border: 1px solid var(--ad-border);
        border-radius: 16px; overflow: hidden;
        box-shadow: 0 2px 14px rgba(15,23,42,0.05);
    }
    .ad-panel-header {
        padding: 16px 20px; border-bottom: 1px solid #eef2f7;
        display: flex; justify-content: space-between; align-items: center;
        flex-wrap: wrap; gap: 12px;
    }
    .ad-panel-header h5 { font-size: 15px; font-weight: 700; color: #1e293b; }
    .ad-panel-icon {
        width: 38px; height: 38px; border-radius: 11px;
        display: flex; align-items: center; justify-content: center;
        background: rgba(99,102,241,0.10); color: #6366f1; font-size: 17px;
        flex-shrink: 0;
    }
    .ad-search-wrap { position: relative; width: 270px; }
    .ad-search-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 13px; pointer-events: none; }
    .ad-search-input {
        width: 100%; padding: 9px 34px 9px 36px;
        border: 1px solid var(--ad-border); border-radius: 10px;
        font-size: 13px; color: #334155; background: #f6f8fb;
        outline: none; transition: all 0.25s; font-family: inherit;
    }
    .ad-search-input::placeholder { color: #94a3b8; }
    .ad-search-input:focus { border-color: #a5b4fc; background: #fff; box-shadow: 0 0 0 3px rgba(99,102,241,0.08); }
    .ad-search-clear { position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 10px; cursor: pointer; padding: 4px; border-radius: 5px; transition: all 0.2s; }
    .ad-search-clear:hover { color: #ef4444; background: rgba(239,68,68,0.06); }

    .ad-table-responsive { overflow-x: auto; }
    .ad-table { width: 100%; border-collapse: collapse; }
    .ad-table th {
        font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px;
        color: #94a3b8; padding: 13px 16px; border-bottom: 1px solid #eef2f7;
        text-align: left; white-space: nowrap; background: #fafbfc;
    }
    .ad-table td { padding: 12px 16px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; font-size: 13px; color: #334155; }
    .ad-table tbody tr { transition: background 0.15s; }
    .ad-table tbody tr:hover { background: #fafbff; }
    .ad-table tbody tr:last-child td { border-bottom: none; }

    .ad-index-badge {
        width: 26px; height: 26px; border-radius: 8px;
        background: #f1f5f9; color: #64748b;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 12px; font-weight: 700;
    }
    .ad-post-title-cell { font-weight: 600; color: #1e293b; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; max-width: 260px; }
    .ad-cat-tag { display: inline-flex; align-items: center; padding: 3px 10px; font-size: 11px; font-weight: 600; background: rgba(99,102,241,0.08); color: #6366f1; border-radius: 7px; white-space: nowrap; }
    .ad-file-thumb { width: 44px; height: 44px; border-radius: 9px; overflow: hidden; border: 1px solid var(--ad-border); position: relative; transition: all 0.2s; cursor: pointer; display: block; }
    .ad-file-thumb:hover { border-color: #6366f1; transform: scale(1.06); box-shadow: 0 3px 10px rgba(99,102,241,0.15); }
    .ad-file-thumb img, .ad-file-thumb video { width: 100%; height: 100%; object-fit: cover; }
    .ad-video-thumb { position: relative; }
    .ad-play-badge { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.35); color: #fff; font-size: 15px; }
    .ad-status-pill { display: inline-flex; align-items: center; gap: 5px; font-size: 11px; font-weight: 600; padding: 4px 11px; border-radius: 7px; white-space: nowrap; }
    .ad-status-active { background: rgba(16,185,129,0.10); color: #10b981; }
    .ad-status-inactive { background: rgba(239,68,68,0.08); color: #ef4444; }
    .ad-action-group { display: flex; gap: 6px; }
    .ad-action-btn { width: 34px; height: 34px; border-radius: 9px; border: none; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; font-size: 14px; transition: all 0.2s; }
    .ad-action-edit { background: rgba(99,102,241,0.08); color: #6366f1; }
    .ad-action-edit:hover { background: #6366f1; color: #fff; transform: translateY(-2px); }
    .ad-action-delete { background: rgba(239,68,68,0.08); color: #ef4444; }
    .ad-action-delete:hover { background: #ef4444; color: #fff; transform: translateY(-2px); }
    .ad-date-stack { display: flex; flex-direction: column; gap: 2px; }
    .ad-date-day { font-size: 11px; font-weight: 600; color: #475569; white-space: nowrap; }
    .ad-date-time { font-size: 10px; color: #94a3b8; }

    .ad-empty-state { text-align: center; padding: 26px; }
    .ad-empty-icon { width: 52px; height: 52px; border-radius: 14px; background: #f1f5f9; display: inline-flex; align-items: center; justify-content: center; font-size: 24px; color: #94a3b8; margin-bottom: 12px; }
    .ad-empty-state h6 { font-size: 15px; font-weight: 700; color: #1e293b; margin-bottom: 4px; }
    .ad-empty-state p { font-size: 12px; margin-bottom: 14px; }

    /* Modal (shared with edit modal) */
    .ad-modal-content { border: none; border-radius: 18px; box-shadow: 0 25px 80px rgba(0,0,0,0.18); overflow: hidden; background: #fff; border: 1px solid var(--ad-border); }
    .ad-modal-header { display: flex; justify-content: space-between; align-items: center; padding: 17px 24px; background: linear-gradient(135deg,#6366f1,#8b5cf6); }
    .ad-modal-title { font-size: 15px; font-weight: 700; color: #fff; margin: 0; }
    .ad-modal-close { width: 34px; height: 34px; border-radius: 10px; border: none; background: rgba(255,255,255,0.2); color: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s; font-size: 12px; }
    .ad-modal-close:hover { background: rgba(255,255,255,0.35); transform: rotate(90deg); }
    .ad-modal-body { padding: 24px; }
    .ad-modal-footer { display: flex; justify-content: flex-end; gap: 10px; padding: 16px 24px; border-top: 1px solid #f1f5f9; background: #fafbfc; }

    .ad-form-label { display: block; font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 5px; }
    .ad-form-input {
        width: 100%; padding: 10px 12px;
        border: 1px solid var(--ad-border); border-radius: 9px;
        font-size: 13px; color: #334155; background: #fff;
        outline: none; transition: border-color 0.25s, box-shadow 0.25s;
        font-family: inherit;
    }
    .ad-form-input:focus { border-color: #a5b4fc; box-shadow: 0 0 0 3px rgba(99,102,241,0.08); }
    .ad-form-textarea { min-height: 110px; resize: vertical; }
    .ad-btn-secondary {
        padding: 9px 20px; border-radius: 9px; font-size: 13px; font-weight: 600;
        border: 1px solid var(--ad-border); cursor: pointer; transition: all 0.2s;
        background: #fff; color: #64748b;
    }
    .ad-btn-secondary:hover { background: #f1f5f9; border-color: #cbd5e1; }
    .ad-progress { height: 8px; border-radius: 5px; background: #f1f5f9; }
    .ad-progress .progress-bar { background: linear-gradient(90deg,#6366f1,#8b5cf6); border-radius: 5px; font-size: 0; }
    .ad-edit-preview { max-height: 100px; border-radius: 8px; border: 1px solid var(--ad-border); margin-top: 8px; }

    /* ===== Mobile: table -> stacked cards ===== */
    @media (max-width: 767.98px) {
        .ad-table-responsive { overflow-x: visible; }
        .ad-page-header-main { flex: 1 1 100%; }
        .ad-panel-header { flex-direction: column; align-items: stretch !important; gap: 12px; }
        .ad-search-wrap { width: 100%; }
        .ad-post-title-cell { -webkit-line-clamp: 2; max-width: none; }

        .ad-posts-table thead { display: none; }
        .ad-posts-table, .ad-posts-table tbody, .ad-posts-table tr, .ad-posts-table td { display: block; width: 100%; }
        .ad-posts-table tbody tr {
            background: #fff; border: 1px solid #e6ebf2; border-radius: 14px;
            margin: 0 8px 12px; overflow: hidden;
            box-shadow: 0 2px 8px rgba(15,23,42,0.04);
        }
        .ad-posts-table tbody tr:hover { background: #fff; }
        .ad-posts-table tbody tr:last-child { margin-bottom: 8px; }
        .ad-posts-table td {
            display: flex; align-items: center; justify-content: space-between; gap: 14px;
            padding: 10px 16px; border-bottom: 1px solid #f1f5f9; font-size: 13px;
        }
        .ad-posts-table td::before {
            content: attr(data-label);
            font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px;
            color: #94a3b8; flex-shrink: 0;
        }
        .ad-posts-table td[data-label="Title"] { justify-content: flex-start; padding: 14px 16px 10px; }
        .ad-posts-table td[data-label="Title"]::before { display: none; }
        .ad-posts-table td[data-label="#"] { display: none; }
        .ad-posts-table td[data-label="Actions"] { border-bottom: none; padding-bottom: 14px; }
        .ad-posts-table td[data-label="Actions"]::before { display: none; }
        .ad-posts-table td[data-label="Actions"] .ad-action-group { width: 100%; display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
        .ad-posts-table td[data-label="Actions"] .ad-action-btn { width: 100%; height: 38px; font-size: 14px; }
        .ad-index-badge { width: 22px; height: 22px; font-size: 11px; }
        .ad-file-thumb { width: 48px; height: 48px; }
    }

    @media (max-width: 575.98px) {
        .ad-page-title { font-size: 19px; }
        .ad-btn-primary-sm { width: 100%; justify-content: center; }
        .ad-panel-header { padding: 14px 16px; }
        .ad-posts-table tbody tr { margin: 0 4px 10px; }
        .ad-posts-table td { padding: 9px 14px; }
        .ad-modal-footer { flex-direction: column; }
        .ad-modal-footer .ad-btn-secondary, .ad-modal-footer .ad-btn-primary { width: 100%; justify-content: center; }
        .ad-modal-body { padding: 18px 16px; }
        .ad-modal-header { padding: 14px 16px; }
    }
</style>

@foreach($posts as $post)
    @include('backend.posts.editmodal')
@endforeach

@endsection