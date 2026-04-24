@extends('backend.app')

@section('content')

<div class="container-fluid" style="height: calc(100vh - 80px); overflow-y: auto; padding-bottom: 20px;">

    <!-- Header -->
    <div class="row px-3 pt-3 pb-2 align-items-center">
        <div class="col-md-8">
            <h3 class="fw-bold mb-1">
                <i class="bi bi-plus-circle me-2 text-primary"></i> Add New Post
            </h3>
            <small class="text-muted">Fill the form below to add a new Post</small>
        </div>
        <div class="col-md-4 text-md-end mt-2 mt-md-0">
            <a href="{{ url('admin/posts') }}" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left"></i> Go Back
            </a>
        </div>
    </div>

    <!-- Card -->
    <div class="card border-0 shadow-sm mx-3 mt-3 product-card">
        <div class="card-body p-4">

            <form action="{{ url('/admin/posts/store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">

                    <!-- Post Title -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-box-seam me-1 text-secondary"></i>
                            Post Title <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-box"></i></span>
                            <input type="text" class="form-control" name="title" placeholder="Enter post title" required>
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="col-md-6">
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

                    <!-- Details -->
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-card-text me-1 text-secondary"></i>
                            Post Details
                        </label>
                        <textarea class="form-control editor" name="details" rows="5" placeholder="Enter post details"></textarea>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-list-check me-1 text-secondary"></i>
                            Status <span class="text-danger">*</span>
                        </label>
                        <select name="status" class="form-select" required>
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <!-- File Upload -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-image me-1 text-secondary"></i>
                            Post File <span class="text-danger">*</span>
                        </label>
                        <input type="file"
                               class="form-control"
                               name="file"
                               id="file"
                               accept="image/*,video/mp4"
                               required>

                        <div class="mt-3">
                            <img id="preview"
                                 src=""
                                 class="img-fluid rounded shadow-sm d-none"
                                 style="max-height: 150px;">
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="col-12 mt-2">
                        <button type="submit" class="btn btn-success px-4 rounded-pill w-100 w-md-auto">
                            <i class="bi bi-check-circle me-1"></i> Save Post
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// File validation & preview
document.getElementById('file').addEventListener('change', function(e) {
    const preview = document.getElementById('preview');
    const file = e.target.files[0];
    if (!file) return;

    const fileType = file.type;

    const allowedImages = ['image/jpeg','image/png','image/gif','image/webp'];

    if (allowedImages.includes(fileType)) {
        preview.src = URL.createObjectURL(file);
        preview.classList.remove('d-none');
        return;
    }

    if (fileType === 'video/mp4') {
        preview.classList.add('d-none');
        Swal.fire({
            icon: 'success',
            title: 'MP4 Video Selected',
            text: file.name,
            confirmButtonColor: '#4f46e5'
        });
        return;
    }

    // invalid file
    Swal.fire({
        icon: 'error',
        title: 'Invalid File',
        text: 'Only Image and MP4 video allowed!',
        confirmButtonColor: '#4f46e5'
    });

    e.target.value = '';
    preview.classList.add('d-none');
});

// Laravel session messages
@if(session('success'))
Swal.fire({icon:'success', title:'Success!', text:"{{ session('success') }}", confirmButtonColor:'#4f46e5'});
@endif

@if(session('error'))
Swal.fire({icon:'error', title:'Error!', text:"{{ session('error') }}", confirmButtonColor:'#4f46e5'});
@endif

@if ($errors->any())
let errorMessages = @json($errors->all());
Swal.fire({icon:'error', title:'Validation Error', html:errorMessages.join('<br>'), confirmButtonColor:'#4f46e5'});
@endif
</script>

<style>
.product-card { border-radius: 14px; }
.form-control:focus, .form-select:focus { border-color:#4f46e5; box-shadow:0 0 0 0.15rem rgba(79,70,229,0.25);}
.btn-success { transition:.25s; }
.btn-success:hover { background:#4f46e5; border-color:#4f46e5; }
@media (max-width: 992px) { .card-body { padding:20px; } }
@media (max-width: 576px) { .row.g-3 > [class*='col-'] { width:100%; } .btn-success { width:100%; } }
</style>

@endsection