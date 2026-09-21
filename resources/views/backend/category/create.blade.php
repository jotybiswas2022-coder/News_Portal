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

            @if ($errors->any())
                <div class="alert alert-danger rounded-3">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ url('admin/category/store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-tag me-1 text-secondary"></i>
                            Category Name <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-tag"></i></span>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter category name" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-image me-1 text-secondary"></i>
                            Preview Image <span class="text-muted fw-normal small">(optional)</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-upload"></i></span>
                            <input type="file" class="form-control" name="image" id="categoryImage"
                                   accept="image/*" onchange="previewCategoryImage(event)">
                        </div>
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>
                            Shown on the homepage "Shop by Category" tile. JPG, PNG or WebP — max 2MB.
                            Leave empty to use the newest product photo instead.
                        </div>

                        <div class="image-preview d-none" id="categoryPreviewWrap">
                            <img id="categoryPreview" src="" alt="Selected preview image">
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

<script>
function previewCategoryImage(event) {
    var file = event.target.files[0];
    var wrap = document.getElementById('categoryPreviewWrap');
    var img  = document.getElementById('categoryPreview');

    if (!file) {
        wrap.classList.add('d-none');
        return;
    }

    img.src = URL.createObjectURL(file);
    wrap.classList.remove('d-none');
}
</script>

<style>
.category-card { border-radius: 16px; }

.image-preview {
    margin-top: 14px;
    max-width: 320px;
}
.image-preview img {
    display: block;
    width: 100%;
    height: 190px;
    object-fit: cover;
    border: 1px solid #e9ecef;
    border-radius: 12px;
    background: #f8f9fa;
}

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