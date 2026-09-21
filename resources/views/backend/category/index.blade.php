@extends('backend.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid" style="height: calc(100vh - 80px); overflow-y: auto; padding-bottom: 20px;">

    <div class="row m-3 align-items-center mb-3">
        <div class="col-md-6">
            <h2 class="fw-bold mb-1">
                <i class="bi bi-tags me-2 text-primary"></i> Category List
            </h2>
            <small class="text-muted">Manage all categories efficiently</small>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ url('admin/category/create') }}" class="btn btn-primary rounded-pill px-4">
                <i class="bi bi-plus-circle me-1"></i> Add New Category
            </a>
        </div>
    </div>

    <div class="card mx-3 shadow-sm border-0 rounded-4">
        <div class="card-body p-2 p-md-3">

            <div class="mb-3">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                    <input type="text" id="categorySearch" class="form-control" placeholder="Search categories...">
                </div>
            </div>

            <div class="table-responsive rounded-3">
                <table class="table table-hover table-bordered align-middle text-center mb-0" id="categoryTable">
                    <thead class="table-light sticky-top">
                        <tr>
                            <th style="width:50px;">#</th>
                            <th style="width:90px;">Preview</th>
                            <th class="text-start" style="min-width:250px;">Name</th>
                            <th style="min-width:180px;">Created</th>
                            <th style="width:160px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td class="fw-medium">{{ $loop->iteration }}</td>
                                <td>
                                    @if($category->image)
                                        <img src="{{ config('app.storage_url').$category->image }}"
                                             alt="{{ $category->name }}" class="cat-thumb"
                                             onerror="this.replaceWith(document.createTextNode('—'))">
                                    @else
                                        <span class="text-muted small" title="Falls back to the newest product photo">—</span>
                                    @endif
                                </td>
                                <td class="text-start fw-semibold">{{ $category->name }}</td>
                                <td class="text-muted small">{{ $category->created_at->format('d M, Y H:i') }}</td>
                                <td>
                                    <div class="d-flex flex-wrap justify-content-center gap-2">
                                        <button class="btn btn-sm btn-primary rounded-pill px-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $category->id }}"
                                                title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        @include('backend.category.editmodal')

                                        <button class="btn btn-sm btn-danger rounded-pill px-3"
                                                onclick="confirmation({{ $category->id }})"
                                                title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <i class="bi bi-tags fs-1 d-block mb-2"></i>
                                    No categories found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<script>
function confirmation(id) {
    Swal.fire({
        title: 'Delete Category?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it',
        cancelButtonText: 'Cancel',
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-danger rounded-pill px-4',
            cancelButton: 'btn btn-secondary rounded-pill px-4'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/admin/category/delete/' + id;
        }
    });
}

/* Live preview of a newly picked image inside an edit modal. */
function previewModalImage(event, id) {
    var file = event.target.files[0];
    if (!file) return;

    var thumb = document.getElementById('categoryThumb' + id);
    if (thumb) thumb.src = URL.createObjectURL(file);
}

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('categorySearch');
    const rows = document.querySelectorAll('#categoryTable tbody tr');

    searchInput.addEventListener('input', function () {
        const filter = searchInput.value.toLowerCase();

        rows.forEach(row => {
            if (row.cells.length < 2) return;
            const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            row.style.display = name.includes(filter) ? '' : 'none';
        });
    });
});
</script>

<style>
/* Category preview thumbnails */
.cat-thumb {
    width: 64px;
    height: 44px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #e9ecef;
    background: #f8f9fa;
}

.modal-thumb {
    width: 84px;
    height: 56px;
    object-fit: cover;
    border-radius: 10px;
    border: 1px solid #e9ecef;
    background: #f8f9fa;
    flex-shrink: 0;
}

.table-hover tbody tr:hover {
    background-color: rgba(13, 110, 253, 0.03);
    transition: background 0.15s;
}

.card-body {
    border-radius: 14px;
}

.btn-sm {
    padding: 0.35rem 0.75rem;
    font-size: 0.82rem;
}

.input-group-text {
    border-color: #dee2e6;
}

.form-control:focus,
.form-select:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 0.15rem rgba(79,70,229,0.15);
}

.table th {
    font-weight: 600;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    color: #6c757d;
    border-bottom: 2px solid #e9ecef;
}

.table td {
    font-size: 0.88rem;
    vertical-align: middle;
}

/* Responsive */
@media (max-width: 1199px) {
    .table td, .table th { padding: 0.5rem 0.4rem; }
}

@media (max-width: 991px) {
    .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    #categoryTable { min-width: 650px; }
    .d-flex.flex-wrap.justify-content-center { flex-direction: row; gap: 4px; }
    .row.m-3 { margin: 1rem !important; }
}

@media (max-width: 767px) {
    .card-body { padding: 1rem; }
    h2 { font-size: 1.4rem; }
    .btn-primary { width: 100%; margin-top: 0.5rem; }
    .table th, .table td { font-size: 0.8rem; padding: 0.4rem 0.3rem; }
    .btn-sm { padding: 0.25rem 0.5rem; font-size: 0.75rem; }
}

@media (max-width: 575px) {
    .container-fluid { padding-left: 0.75rem; padding-right: 0.75rem; }
    .card.mx-3 { margin: 0.5rem !important; }
    .table th, .table td { font-size: 0.75rem; padding: 0.3rem 0.25rem; }
    .input-group-sm .form-control { font-size: 0.82rem; }
}
</style>

@endsection