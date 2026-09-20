@extends('backend.app')

@section('content')

<div class="container-fluid" style="height: calc(100vh - 80px); overflow-y: auto; padding-bottom: 20px;">

    <div class="row px-3 pt-3 pb-2 align-items-center">
        <div class="col-md-8">
            <h3 class="fw-bold mb-1">
                <i class="bi bi-plus-circle me-2 text-primary"></i> Add New Product
            </h3>
            <small class="text-muted">Fill the form below to add a new product</small>
        </div>
        <div class="col-md-4 text-md-end mt-2 mt-md-0">
            <a href="{{ url('admin/product') }}" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left"></i> Go Back
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm mx-3 mt-3 product-card">
        <div class="card-body p-4 p-md-5">

            <form action="/admin/product/store" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-box-seam me-1 text-secondary"></i>
                            Product Name <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-box"></i></span>
                            <input type="text" class="form-control" name="name" placeholder="Enter product name" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-tags me-1 text-secondary"></i>
                            Category <span class="text-danger">*</span>
                        </label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-cash-coin me-1 text-secondary"></i>
                            Base Price <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">{{ $currency ?? '৳' }}</span>
                            <input type="number" class="form-control" name="base_price" placeholder="Enter base price" required step="0.01" min="0">
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-currency-dollar me-1 text-secondary"></i>
                            Sell Price <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">{{ $currency ?? '৳' }}</span>
                            <input type="number" class="form-control" name="price" placeholder="Enter sell price" required step="0.01" min="0">
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-percent me-1 text-secondary"></i>
                            Discount (%)
                        </label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="discount" placeholder="Discount %" min="0" max="100" value="0">
                            <span class="input-group-text bg-light">%</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-boxes me-1 text-secondary"></i>
                            Stock <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-hash"></i></span>
                            <input type="number" class="form-control" name="stock" placeholder="Enter stock quantity" required min="0">
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-card-text me-1 text-secondary"></i>
                            Product Details
                        </label>
                        <textarea class="form-control editor" name="details" rows="5" placeholder="Enter product details"></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-image me-1 text-secondary"></i>
                            Product Image <span class="text-danger">*</span>
                        </label>
                        <div class="border rounded-3 p-3 bg-light text-center" id="dropZone">
                            <input type="file" accept="image/*" class="form-control d-none" name="image" id="image" required>
                            <i class="bi bi-cloud-upload fs-1 text-muted mb-2 d-block"></i>
                            <p class="mb-1 fw-medium">Drag & drop or click to upload</p>
                            <small class="text-muted">PNG, JPG, WebP up to 2MB</small>
                        </div>
                        <div class="mt-3">
                            <img id="preview" src="" class="img-fluid rounded shadow-sm d-none" style="max-height: 180px;">
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <button type="submit" class="btn btn-success rounded-pill px-5 w-100 w-md-auto">
                            <i class="bi bi-check-circle me-1"></i> Save Product
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>

<script>
const dropZone = document.getElementById('dropZone');
const fileInput = document.getElementById('image');
const preview = document.getElementById('preview');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropZone.addEventListener(eventName, () => dropZone.classList.add('border-primary', 'bg-primary-subtle'), false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, () => dropZone.classList.remove('border-primary', 'bg-primary-subtle'), false);
});

dropZone.addEventListener('drop', handleDrop, false);
dropZone.addEventListener('click', () => fileInput.click());

function handleDrop(e) {
    const dt = e.dataTransfer;
    const file = dt.files[0];
    if (file) handleFile(file);
}

fileInput.addEventListener('change', function(e) {
    if (e.target.files[0]) handleFile(e.target.files[0]);
});

function handleFile(file) {
    if (!file.type.match('image.*')) return;
    if (file.size > 2 * 1024 * 1024) return alert('File too large. Max 2MB.');
    
    const dt = new DataTransfer();
    dt.items.add(file);
    fileInput.files = dt.files;
    
    preview.src = URL.createObjectURL(file);
    preview.classList.remove('d-none');
    dropZone.classList.add('d-none');
}
</script>

<style>
.product-card { border-radius: 16px; }

.form-control:focus, .form-select:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 0.15rem rgba(79,70,229,0.15);
}

.btn-success { background: #10b981; border: none; transition: 0.2s; }
.btn-success:hover { background: #059669; transform: translateY(-1px); }

#dropZone { cursor: pointer; transition: 0.2s; border: 2px dashed #dee2e6; }
#dropZone.border-primary { border-style: solid; }

.input-group-text { background: #f8f9fa; border-color: #dee2e6; }

/* Responsive */
@media (max-width: 991px) { .card-body { padding: 1.5rem; } }
@media (max-width: 575px) {
    .row.g-3 > [class*='col-'] { width: 100%; }
    .btn-success { width: 100%; }
    .container-fluid { padding: 0.75rem; }
    .card.mx-3 { margin: 0.5rem !important; }
}
</style>

@endsection