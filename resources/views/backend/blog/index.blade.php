@extends('backend.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mx-3 mt-3 shadow-sm" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid" style="padding: 20px 0;">

    <!-- Header -->
    <div class="blog-header mx-3 mt-3 mb-3">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1">
                    <i class="bi bi-pencil-square me-2 text-primary"></i>Blog Posts
                </h4>
                <p class="text-muted small mb-0">Manage your blog articles</p>
            </div>

            <div class="mt-2 mt-md-0 d-flex gap-2">
                <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                    <i class="bi bi-database me-1"></i>
                    {{ $posts->count() }} Posts
                </span>
                <a href="{{ route('admin.blog.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                    <i class="bi bi-plus-lg me-1"></i> New Post
                </a>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="mx-3">
        @if($posts->isEmpty())
            <div class="text-center py-5">
                <div class="empty-state">
                    <i class="bi bi-pencil fs-1 text-muted mb-3 d-block"></i>
                    <div class="fw-semibold mb-2">No Posts Found</div>
                    <p class="text-muted small">Start writing your first blog post!</p>
                    <a href="{{ route('admin.blog.create') }}" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-plus-lg me-1"></i> Write Post
                    </a>
                </div>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 blog-table">
                    <thead>
                        <tr>
                            <th style="width:50px;">#</th>
                            <th style="width:70px;">Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th style="width:130px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td class="fw-semibold text-muted">{{ $loop->iteration }}</td>

                                <td>
                                    @if($post->featured_image)
                                        <img src="{{ config('app.storage_url') }}{{ $post->featured_image }}"
                                             alt="{{ $post->title }}"
                                             class="rounded"
                                             style="width: 60px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                                             style="width: 60px; height: 40px;">
                                            <i class="bi bi-image text-white opacity-50"></i>
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <div class="fw-semibold">{{ $post->title }}</div>
                                    <a href="{{ url('/blog/' . $post->slug) }}" target="_blank" class="text-muted small text-decoration-none">
                                        <i class="bi bi-box-arrow-up-right"></i> View
                                    </a>
                                </td>

                                <td>
                                    @if($post->category)
                                        <span class="badge bg-info-subtle text-info">{{ $post->category }}</span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>

                                <td class="small text-muted">{{ $post->author->name ?? 'Unknown' }}</td>

                                <td class="small">
                                    <span class="badge date-badge" title="Created: {{ $post->created_at->format('d M Y h:i A') }}">
                                        <i class="bi bi-calendar3 me-1"></i>{{ $post->formatted_date }}
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route('admin.blog.toggleStatus', $post->id) }}"
                                       class="badge text-decoration-none {{ $post->is_published ? 'bg-success' : 'bg-secondary' }}"
                                       onclick="return confirm('Toggle published status for \'{{ $post->title }}\'?')">
                                        {{ $post->is_published ? 'Published' : 'Draft' }}
                                    </a>
                                </td>

                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.blog.edit', $post->id) }}"
                                           class="btn btn-sm btn-outline-primary py-1 px-2">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('admin.blog.destroy', $post->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete \'{{ $post->title }}\'? This cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger py-1 px-2">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>

<style>
.blog-header{
    background:#fff;
    border-radius:14px;
    padding:18px 20px;
    box-shadow:0 2px 10px rgba(0,0,0,.04);
}

.blog-table thead{
    background:#f8fafc;
    position:sticky;
    top:0;
    z-index:5;
}

.table-hover tbody tr:hover{
    background:rgba(13,110,253,.06);
    transition:.18s ease;
}

.date-badge {
    background:#f1f5f9;
    color:#334155;
    border:1px solid #e2e8f0;
    font-weight:500;
    font-size:0.75rem;
}

.alert{
    border-radius:12px;
    font-size:14px;
}

@media (max-width: 768px) {
    .table-responsive {
        overflow-x: auto;
    }
}
</style>

@endsection
