@extends('backend.app')

@section('content')

<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-1"><i class="bi bi-folder2-open me-2" style="color:#6366f1;"></i>Projects</h4>
            <p class="text-muted small mb-0">Manage your portfolio projects</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge rounded-pill px-3 py-2" style="background:rgba(99,102,241,0.1); color:#6366f1; font-weight:500;">
                <i class="bi bi-database me-1"></i> {{ $projects->count() }} Projects
            </span>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary rounded-3 px-3" style="background:#6366f1; border-color:#6366f1;">
                <i class="bi bi-plus-lg me-1"></i> Add Project
            </a>
        </div>
    </div>

    {{-- Table Card --}}
    @if($projects->isEmpty())
        <div class="text-center py-5">
            <div class="empty-state">
                <i class="bi bi-folder-plus"></i>
                <div class="fw-semibold mb-2">No Projects Found</div>
                <p class="text-muted small">Start by adding your first project!</p>
                <a href="{{ route('admin.projects.create') }}" class="btn btn-primary rounded-3 px-4" style="background:#6366f1; border-color:#6366f1;">
                    <i class="bi bi-plus-lg me-1"></i> Add Project
                </a>
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm rounded-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="min-width:800px;">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-muted small fw-semibold">#</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:70px;">Image</th>
                            <th class="py-3 text-muted small fw-semibold">Title</th>
                            <th class="py-3 text-muted small fw-semibold">Category</th>
                            <th class="py-3 text-muted small fw-semibold">Tech Stack</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:70px;">Order</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:90px;">Status</th>
                            <th class="pe-4 py-3 text-muted small fw-semibold" style="width:130px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td class="ps-4 fw-semibold text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    @if($project->image)
                                        <img src="{{ config('app.storage_url') }}{{ $project->image }}"
                                             alt="{{ $project->title }}"
                                             class="rounded"
                                             style="width:48px; height:36px; object-fit:cover;">
                                    @else
                                        <div class="rounded d-inline-flex align-items-center justify-content-center"
                                             style="width:48px; height:36px; background:#f1f5f9; color:#cbd5e1;">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $project->title }}</td>
                                <td>
                                    @if($project->category)
                                        <span class="badge rounded-pill px-3 py-1" style="background:rgba(99,102,241,0.08); color:#6366f1; font-weight:500;">
                                            {{ $project->category }}
                                        </span>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="display:flex; flex-wrap:wrap; gap:3px; max-width:220px;">
                                        @foreach($project->getTechStackArray() as $tech)
                                            <span class="tech-tag">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td><span class="badge rounded-pill px-3 py-1" style="background:#f1f5f9; color:#475569; font-weight:500;">{{ $project->sort_order }}</span></td>
                                <td>
                                    <a href="{{ route('admin.projects.toggleStatus', $project->id) }}"
                                       class="badge rounded-pill px-3 py-1 text-decoration-none status-badge {{ $project->is_active ? 'active-badge' : 'inactive-badge' }}"
                                       data-title="{{ $project->title }}">
                                        {{ $project->is_active ? 'Active' : 'Inactive' }}
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.projects.edit', $project->id) }}"
                                           class="btn btn-sm btn-outline-primary rounded-3 px-2">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger rounded-3 px-2 delete-btn"
                                                data-id="{{ $project->id }}"
                                                data-title="{{ $project->title }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <form id="delete-form-{{ $project->id }}"
                                              action="{{ route('admin.projects.destroy', $project->id) }}"
                                              method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>

<style>
.tech-tag {
    display: inline-block;
    padding: 2px 9px;
    background: rgba(99,102,241,0.08);
    border: 1px solid rgba(99,102,241,0.18);
    border-radius: 12px;
    font-size: 0.7rem;
    color: #6366f1;
    white-space: nowrap;
    line-height: 1.6;
}

.status-badge {
    transition: all 0.2s;
}

.status-badge:hover {
    transform: scale(1.05);
}

.active-badge {
    background: rgba(16,185,129,0.12);
    color: #059669;
}

.inactive-badge {
    background: #f1f5f9;
    color: #94a3b8;
}
</style>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteBtns = document.querySelectorAll('.delete-btn');
    deleteBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const title = this.dataset.title;
            Swal.fire({
                title: 'Delete Project?',
                text: 'Are you sure you want to delete "' + title + '"? This cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: '<i class="bi bi-trash me-1"></i> Delete',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        });
    });

    const statusBadges = document.querySelectorAll('.status-badge');
    statusBadges.forEach(badge => {
        badge.addEventListener('click', function (e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            const title = this.dataset.title;
            var current = this.textContent.trim();
            Swal.fire({
                title: 'Toggle Status?',
                text: 'Change "' + title + '" from ' + current + ' to ' + (current === 'Active' ? 'Inactive' : 'Active') + '?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#6366f1',
                cancelButtonColor: '#64748b',
                confirmButtonText: '<i class="bi bi-arrow-repeat me-1"></i> Toggle',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
    });
});
</script>
@endsection

@endsection
