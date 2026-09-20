@extends('backend.app')

@section('content')

<div class="container-fluid" style="height: calc(100vh - 80px); overflow-y: auto; padding-bottom: 20px;">

    <div class="row px-3 pt-3 pb-2 align-items-center">
        <div class="col-md-8">
            <h3 class="fw-bold mb-1">
                <i class="bi bi-folder-plus me-2 text-primary"></i> Add New Category
            </h3>
            <small class="text-muted">Fill the form below to create a new category</small>
        </div>
        <div class="col-md-4 text-md-end mt-2 mt-md-0">
            <a href="{{ url('admin/category') }}" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left"></i> Go Back
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm mx-3 mt-3 category-card">
        <div class="card-body p-4 p-md-5">

            <form action="{{ url('admin/category/store') }}" method="post">
                @csrf

                <div class="row g-3">

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-tag me-1 text-secondary"></i>
                            Category Name <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-tag"></i></span>
                            <input type="text" class="form-control" name="name" placeholder="Enter category name" required>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <button type="submit" class="btn btn-success rounded-pill px-5 w-100 w-md-auto">
                            <i class="bi bi-save me-1"></i> Save Category
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>

<style>
.category-card { border-radius: 16px; }

.form-control:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 0.15rem rgba(79,70,229,0.15);
}

.btn-success { background: #10b981; border: none; transition: 0.2s; }
.btn-success:hover { background: #059669; transform: translateY(-1px); }

.input-group-text { background: #f8f9fa; border-color: #dee2e6; }

/* Responsive */
@media (max-width: 991px) { .card-body { padding: 1.5rem; } }
@media (max-width: 575px) {
    .btn-success { width: 100%; }
    .container-fluid { padding: 0.75rem; }
    .card.mx-3 { margin: 0.5rem !important; }
}
</style>

@endsection