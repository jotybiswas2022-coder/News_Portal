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
            <i class="bi bi-tags me-2" style="color: #6366f1;"></i>Category List
        </h4>
        <p class="text-muted mb-0" style="font-size: 13px;">
            <i class="bi bi-house-door me-1"></i> Dashboard / <span class="fw-medium" style="color: #6366f1;">Categories</span>
            <span class="badge ms-2" style="background: rgba(99,102,241,0.1); color: #6366f1; font-size: 11px; font-weight: 600;">
                <i class="bi bi-tags me-1"></i> {{ $categories->count() }} Categories
            </span>
        </p>
    </div>
    <div>
        <a href="{{ url('admin/category/create') }}" class="ad-btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add New Category
        </a>
    </div>
</div>

<div class="ad-panel">
    <div class="ad-panel-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h5><i class="bi bi-tags me-2" style="color: #6366f1;"></i>All Categories</h5>
        <div class="ad-search-wrap">
            <i class="bi bi-search ad-search-icon"></i>
            <input type="text" id="categorySearch" class="ad-search-input" placeholder="Search categories...">
            <i class="bi bi-x-lg ad-search-clear d-none" id="searchClear" onclick="clearSearch()"></i>
        </div>
    </div>
    <div class="ad-panel-body p-0">
        <div class="ad-table-responsive">
            <table class="ad-table">
                <thead>
                    <tr>
                        <th style="width:60px;">#</th>
                        <th>Category Name</th>
                        <th style="width:180px;">Created At</th>
                        <th style="width:180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td class="text-muted fw-bold">{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="ad-cat-color-dot" style="background: {{ ['#6366f1','#10b981','#f59e0b','#ef4444','#8b5cf6','#0891b2'][$loop->index % 6] }};"></div>
                                <span class="fw-medium" style="color: #1e293b;">{{ $category->name }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="ad-date-stack">
                                <span class="ad-date-day">{{ $category->created_at->format('d M Y') }}</span>
                                <span class="ad-date-time">{{ $category->created_at->format('h:i A') }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="ad-action-btn ad-action-edit" data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="ad-action-btn ad-action-delete" onclick="confirmation({{ $category->id }})" title="Delete">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="ad-empty-state">
                                <i class="bi bi-tag"></i>
                                <h6>No Categories Yet</h6>
                                <p class="text-muted">Create your first category to organize your posts</p>
                                <a href="{{ url('admin/category/create') }}" class="ad-btn-primary" style="display: inline-flex; font-size: 12px; padding: 8px 20px;">
                                    <i class="bi bi-plus-lg me-1"></i> Create Category
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

<!-- Edit Modals -->
@foreach($categories as $category)
<div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ad-modal-content">
            <div class="ad-modal-header" style="background: linear-gradient(135deg,#6366f1,#8b5cf6); color: #fff;">
                <h5 class="ad-modal-title" style="color: #fff;"><i class="bi bi-pencil-square me-2"></i>Edit Category</h5>
                <button class="ad-modal-close ad-modal-close-white" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
            </div>
            <form action="{{ url('admin/category/update/'.$category->id) }}" method="POST">
                @csrf
                <div class="ad-modal-body">
                    <label class="ad-form-label">Category Name <span class="text-danger">*</span></label>
                    <input type="text" class="ad-form-input" name="name" value="{{ $category->name }}" required>
                </div>
                <div class="ad-modal-footer">
                    <button type="button" class="ad-btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle me-1"></i> Cancel</button>
                    <button type="submit" class="ad-btn-primary"><i class="bi bi-check-lg me-1"></i> Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<script>
function confirmation(id) {
    Swal.fire({
        title: 'Delete Category',
        text: 'Are you sure you want to delete this category?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Yes, delete it',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/admin/category/delete/' + id;
        }
    });
}

window.clearSearch = function() {
    document.getElementById('categorySearch').value = '';
    document.getElementById('searchClear').classList.add('d-none');
    document.querySelectorAll('table tbody tr').forEach(function(r) {
        if (!r.querySelector('.ad-empty-state')) r.style.display = '';
    });
    var nr = document.getElementById('noResultsRow');
    if (nr) nr.remove();
};

document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.getElementById('categorySearch');
    var searchClear = document.getElementById('searchClear');

    searchInput.addEventListener('keyup', function () {
        var filter = this.value.toLowerCase().trim();
        if (filter.length > 0) searchClear.classList.remove('d-none');
        else searchClear.classList.add('d-none');

        var rows = document.querySelectorAll('table tbody tr');
        var visibleCount = 0;

        rows.forEach(function(row) {
            if (row.querySelector('.ad-empty-state')) return;
            var name = (row.querySelector('td:nth-child(2)')?.textContent || '').toLowerCase();
            var match = name.includes(filter);
            row.style.display = match ? '' : 'none';
            if (match) visibleCount++;
        });

        var noRow = document.getElementById('noResultsRow');
        if (visibleCount === 0) {
            if (!noRow) {
                var tbody = document.querySelector('table tbody');
                var nr = document.createElement('tr');
                nr.id = 'noResultsRow';
                nr.innerHTML = '<td colspan="4" class="text-center py-5"><div class="ad-empty-state"><i class="bi bi-search"></i><h6>No Results</h6><p class="text-muted">No categories match your search</p></div></td>';
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
.ad-panel { background: #fff; border-radius: 14px; border: 1px solid #e9eef3; overflow: hidden; transition: box-shadow 0.3s; }
.ad-panel:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.04); }
.ad-panel-header { padding: 16px 20px; border-bottom: 1px solid #f1f5f9; }
.ad-panel-header h5 { font-size: 14px; font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; }
.ad-panel-body { padding: 0; }
.ad-search-wrap { position: relative; width: 240px; }
.ad-search-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 13px; pointer-events: none; }
.ad-search-input { width: 100%; padding: 8px 34px 8px 34px; border: 1px solid #e9eef3; border-radius: 8px; font-size: 12px; color: #334155; background: #fafbfc; outline: none; transition: all 0.3s; font-family: inherit; }
.ad-search-input:focus { border-color: #6366f1; background: #fff; box-shadow: 0 0 0 3px rgba(99,102,241,0.06); }
.ad-search-clear { position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 10px; cursor: pointer; padding: 4px; }
.ad-search-clear:hover { color: #ef4444; background: rgba(239,68,68,0.06); border-radius: 4px; }
.ad-table-responsive { overflow-x: auto; }
.ad-table { width: 100%; border-collapse: collapse; }
.ad-table th { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: #94a3b8; padding: 12px 16px; border-bottom: 1px solid #f1f5f9; text-align: left; white-space: nowrap; background: #fafbfc; }
.ad-table td { padding: 12px 16px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; font-size: 13px; color: #334155; }
.ad-table tbody tr { transition: background 0.2s; }
.ad-table tbody tr:hover { background: rgba(99,102,241,0.02); }
.ad-table tbody tr:last-child td { border-bottom: none; }
.ad-cat-color-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
.ad-date-stack { display: flex; flex-direction: column; gap: 2px; }
.ad-date-day { font-size: 11px; font-weight: 600; color: #475569; }
.ad-date-time { font-size: 10px; color: #94a3b8; }
.ad-action-btn { width: 32px; height: 32px; border-radius: 8px; border: none; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; font-size: 13px; transition: all 0.2s; }
.ad-action-edit { background: rgba(99,102,241,0.08); color: #6366f1; }
.ad-action-edit:hover { background: rgba(99,102,241,0.15); transform: translateY(-1px); }
.ad-action-delete { background: rgba(239,68,68,0.08); color: #ef4444; }
.ad-action-delete:hover { background: rgba(239,68,68,0.15); transform: translateY(-1px); }
.ad-empty-state { text-align: center; padding: 30px; }
.ad-empty-state i { font-size: 40px; color: #cbd5e1; display: block; margin-bottom: 12px; }
.ad-empty-state h6 { font-size: 15px; font-weight: 700; color: #1e293b; margin-bottom: 4px; }
.ad-empty-state p { font-size: 12px; margin-bottom: 14px; }
.ad-btn-primary { padding: 10px 24px; border-radius: 10px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; gap: 6px; background: linear-gradient(135deg,#6366f1,#8b5cf6); color: #fff; box-shadow: 0 4px 12px rgba(99,102,241,0.2); text-decoration: none; }
.ad-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(99,102,241,0.3); color: #fff; }
.ad-modal-content { border: none; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.12); overflow: hidden; }
.ad-modal-header { display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; border-bottom: 1px solid #f1f5f9; background: #fafbfc; }
.ad-modal-title { font-size: 14px; font-weight: 700; color: #1e293b; margin: 0; }
.ad-modal-close { width: 32px; height: 32px; border-radius: 8px; border: none; background: rgba(0,0,0,0.04); color: #64748b; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 12px; }
.ad-modal-close-white { background: rgba(255,255,255,0.15); color: #fff; }
.ad-modal-close-white:hover { background: rgba(255,255,255,0.25); color: #fff; }
.ad-modal-body { padding: 20px; }
.ad-form-label { display: block; font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 6px; }
.ad-form-input { width: 100%; padding: 10px 12px; border: 1px solid #e9eef3; border-radius: 8px; font-size: 13px; color: #334155; outline: none; transition: border-color 0.3s; font-family: inherit; }
.ad-form-input:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,0.06); }
.ad-modal-footer { display: flex; justify-content: flex-end; gap: 8px; padding: 16px 20px; border-top: 1px solid #f1f5f9; }
.ad-btn-secondary { padding: 9px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; border: 1px solid #e9eef3; cursor: pointer; transition: all 0.2s; background: #fff; color: #64748b; }
.ad-btn-secondary:hover { background: #f8fafc; border-color: #cbd5e1; }
@media (max-width: 768px) { .ad-panel-header { flex-direction: column; align-items: stretch !important; gap: 10px; } .ad-search-wrap { width: 100%; } }
</style>

@endsection