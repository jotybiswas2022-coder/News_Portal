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

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color: #1e293b;">
            <i class="bi bi-journal-text me-2" style="color: #6366f1;"></i>Post List
        </h4>
        <p class="text-muted mb-0" style="font-size: 13px;">
            <i class="bi bi-house-door me-1"></i> Dashboard / <span class="fw-medium" style="color: #6366f1;">Posts</span>
            <span class="badge ms-2" style="background: rgba(99,102,241,0.1); color: #6366f1; font-size: 11px; font-weight: 600;">
                <i class="bi bi-journal-text me-1"></i> {{ $posts->count() }} Posts
            </span>
        </p>
    </div>
    <div>
        <a href="{{ url('admin/posts/create') }}" class="ad-btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add New Post
        </a>
    </div>
</div>

<div class="ad-panel">
    <div class="ad-panel-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h5><i class="bi bi-journal-text me-2" style="color: #6366f1;"></i>All Posts</h5>
        <div class="ad-search-wrap">
            <i class="bi bi-search ad-search-icon"></i>
            <input type="text" id="postSearch" class="ad-search-input" placeholder="Search by title or category...">
            <i class="bi bi-x-lg ad-search-clear d-none" id="searchClear" onclick="clearSearch()"></i>
        </div>
    </div>
    <div class="ad-panel-body p-0">
        <div class="ad-table-responsive">
            <table class="ad-table">
                <thead>
                    <tr>
                        <th style="width:50px;">#</th>
                        <th style="width:280px;">Title</th>
                        <th style="width:110px;">Category</th>
                        <th style="width:80px;">File</th>
                        <th style="width:90px;">Status</th>
                        <th style="width:180px;">Actions</th>
                        <th style="width:160px;">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                    <tr>
                        <td class="text-muted fw-bold">{{ $loop->iteration }}</td>
                        <td><div class="ad-post-title-cell">{{ $post->title }}</div></td>
                        <td>
                            @if($post->PostCategory)
                            <span class="ad-cat-tag">{{ $post->PostCategory->name }}</span>
                            @else
                            <span class="text-muted" style="font-size:12px;">—</span>
                            @endif
                        </td>
                        <td>
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
                        <td>
                            @if($post->status == 1)
                            <span class="ad-status-pill ad-status-active"><i class="bi bi-check-circle-fill"></i> Active</span>
                            @else
                            <span class="ad-status-pill ad-status-inactive"><i class="bi bi-x-circle-fill"></i> Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="ad-action-btn ad-action-edit" data-bs-toggle="modal" data-bs-target="#editModal{{ $post->id }}" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="ad-action-btn ad-action-delete" onclick="confirmation({{ $post->id }})" title="Delete">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        </td>
                        <td>
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
                                <i class="bi bi-journal-plus"></i>
                                <h6>No Posts Yet</h6>
                                <p class="text-muted">Create your first post to get started</p>
                                <a href="{{ url('admin/posts/create') }}" class="ad-btn-primary" style="display: inline-flex; font-size: 12px; padding: 8px 20px;">
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
            <div class="ad-modal-header" style="background: linear-gradient(135deg,#6366f1,#8b5cf6); color: #fff;">
                <h5 class="ad-modal-title" style="color: #fff;"><i class="bi bi-eye me-2"></i>Media Preview</h5>
                <button class="ad-modal-close ad-modal-close-white" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
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
                nr.innerHTML = '<td colspan="7" class="text-center py-5"><div class="ad-empty-state"><i class="bi bi-search"></i><h6>No Results</h6><p class="text-muted">No posts match your search</p></div></td>';
                tbody.appendChild(nr);
            }
        } else {
            if (noRow) noRow.remove();
        }
    });
});
</script>

<style>
.ad-alert { border-radius: 12px; border: none; padding: 14px 18px; font-size: 13px; font-weight: 500; margin-bottom: 20px; }
.ad-alert-success { background: rgba(16,185,129,0.08); color: #10b981; }
.ad-alert-danger { background: rgba(239,68,68,0.08); color: #ef4444; }
.ad-panel { background: rgba(255,255,255,0.88); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-radius: 14px; border: 1px solid rgba(233,238,243,0.8); overflow: hidden; transition: box-shadow 0.3s ease; }
.ad-panel:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.04); background: rgba(255,255,255,0.95); }
.ad-panel-header { padding: 16px 20px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
.ad-panel-header h5 { font-size: 14px; font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; }
.ad-panel-body { padding: 0; }
.ad-search-wrap { position: relative; width: 260px; }
.ad-search-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 13px; pointer-events: none; }
.ad-search-input { width: 100%; padding: 8px 34px 8px 34px; border: 1px solid rgba(233,238,243,0.7); border-radius: 8px; font-size: 12px; color: #334155; background: rgba(250,251,252,0.8); backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px); outline: none; transition: all 0.3s; font-family: inherit; }
.ad-search-input::placeholder { color: #94a3b8; }
.ad-search-input:focus { border-color: #6366f1; background: rgba(255,255,255,0.95); box-shadow: 0 0 0 3px rgba(99,102,241,0.06); }
.ad-search-clear { position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 10px; cursor: pointer; padding: 4px; border-radius: 4px; transition: all 0.2s; }
.ad-search-clear:hover { color: #ef4444; background: rgba(239,68,68,0.06); }
.ad-table-responsive { overflow-x: auto; }
.ad-table { width: 100%; border-collapse: collapse; }
.ad-table th { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: #94a3b8; padding: 12px 16px; border-bottom: 1px solid #f1f5f9; text-align: left; white-space: nowrap; background: #fafbfc; }
.ad-table td { padding: 12px 16px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; font-size: 13px; color: #334155; }
.ad-table tbody tr { transition: background 0.2s; }
.ad-table tbody tr:hover { background: rgba(99,102,241,0.02); }
.ad-table tbody tr:last-child td { border-bottom: none; }
.ad-post-title-cell { font-weight: 600; color: #1e293b; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; max-width: 280px; }
.ad-cat-tag { display: inline-block; padding: 2px 10px; font-size: 11px; font-weight: 600; background: rgba(99,102,241,0.08); color: #6366f1; border-radius: 6px; }
.ad-file-thumb { width: 42px; height: 42px; border-radius: 8px; overflow: hidden; border: 1px solid #e9eef3; position: relative; transition: all 0.2s; cursor: pointer; }
.ad-file-thumb:hover { border-color: #6366f1; transform: scale(1.05); }
.ad-file-thumb img, .ad-file-thumb video { width: 100%; height: 100%; object-fit: cover; }
.ad-video-thumb { position: relative; }
.ad-play-badge { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.3); color: #fff; font-size: 14px; }
.ad-status-pill { display: inline-flex; align-items: center; gap: 4px; font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 6px; }
.ad-status-active { background: rgba(16,185,129,0.1); color: #10b981; }
.ad-status-inactive { background: rgba(239,68,68,0.08); color: #ef4444; }
.ad-action-btn { width: 32px; height: 32px; border-radius: 8px; border: none; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; font-size: 13px; transition: all 0.2s; }
.ad-action-edit { background: rgba(99,102,241,0.08); color: #6366f1; }
.ad-action-edit:hover { background: rgba(99,102,241,0.15); transform: translateY(-1px); }
.ad-action-delete { background: rgba(239,68,68,0.08); color: #ef4444; }
.ad-action-delete:hover { background: rgba(239,68,68,0.15); transform: translateY(-1px); }
.ad-date-stack { display: flex; flex-direction: column; gap: 2px; }
.ad-date-day { font-size: 11px; font-weight: 600; color: #475569; }
.ad-date-time { font-size: 10px; color: #94a3b8; }
.ad-empty-state { text-align: center; padding: 30px; }
.ad-empty-state i { font-size: 40px; color: #cbd5e1; display: block; margin-bottom: 12px; }
.ad-empty-state h6 { font-size: 15px; font-weight: 700; color: #1e293b; margin-bottom: 4px; }
.ad-empty-state p { font-size: 12px; margin-bottom: 14px; }
.ad-btn-primary { padding: 10px 24px; border-radius: 10px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; gap: 6px; background: linear-gradient(135deg,#6366f1,#8b5cf6); color: #fff; box-shadow: 0 4px 12px rgba(99,102,241,0.2); text-decoration: none; }
.ad-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(99,102,241,0.3); color: #fff; }
.ad-modal-content { border: none; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.12); overflow: hidden; background: rgba(255,255,255,0.92); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); }
.ad-modal-header { display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; border-bottom: 1px solid #f1f5f9; background: #fafbfc; }
.ad-modal-title { font-size: 14px; font-weight: 700; color: #1e293b; margin: 0; }
.ad-modal-close { width: 32px; height: 32px; border-radius: 8px; border: none; background: rgba(0,0,0,0.04); color: #64748b; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s; font-size: 12px; }
.ad-modal-close:hover { background: rgba(239,68,68,0.08); color: #ef4444; }
.ad-modal-close-white { background: rgba(255,255,255,0.15); color: #fff; }
.ad-modal-close-white:hover { background: rgba(255,255,255,0.25); color: #fff; }
.ad-modal-body { padding: 20px; }
@media (max-width: 992px) { .ad-table th, .ad-table td { white-space: nowrap; font-size: 12px; padding: 10px 12px; } .ad-search-wrap { width: 200px; } }
@media (max-width: 768px) { .ad-panel-header { flex-direction: column; align-items: stretch !important; gap: 10px; } .ad-search-wrap { width: 100%; } .ad-post-title-cell { max-width: 180px; } }
@media (max-width: 576px) { .ad-table th, .ad-table td { font-size: 11px; padding: 8px 10px; } .ad-action-btn { width: 28px; height: 28px; font-size: 11px; } }
</style>

@foreach($posts as $post)
    @include('backend.posts.editmodal')
@endforeach

@endsection