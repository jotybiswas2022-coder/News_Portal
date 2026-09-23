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
            <i class="bi bi-plus-circle"></i> Add New Post
        </h4>
        <p class="ad-page-sub">
            <i class="bi bi-house-door"></i> Dashboard / Posts / <span class="fw-medium">Add New</span>
        </p>
    </div>
    <a href="{{ url('admin/posts') }}" class="ad-btn-outline">
        <i class="bi bi-arrow-left"></i> Go Back
    </a>
</div>

<div class="ad-panel">
    <div class="ad-panel-header">
        <div class="d-flex align-items-center gap-2">
            <span class="ad-panel-icon"><i class="bi bi-journal-richtext"></i></span>
            <div>
                <h5 class="mb-0">Post Details</h5>
                <small class="text-muted" style="font-size: 12px;">Fill the form below to publish a new post</small>
            </div>
        </div>
    </div>
    <div class="ad-panel-body">

        <form action="{{ url('/admin/posts/store') }}" method="post" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
            <div class="ad-form-errors">
                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                <ul class="mb-0 ps-3" style="font-size: 12px;">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="row g-4">

                <div class="col-md-6">
                    <label class="ad-form-label">
                        Post Title <span class="ad-req">*</span>
                    </label>
                    <input type="text" class="ad-form-input" name="title" placeholder="Enter post title" required>
                </div>

                <div class="col-md-6">
                    <label class="ad-form-label">
                        Category <span class="ad-req">*</span>
                    </label>
                    <select name="category_id" class="ad-form-input" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <label class="ad-form-label">
                        Post Details
                    </label>
                    <textarea class="ad-form-input ad-form-textarea editor" name="details" rows="6" placeholder="Enter post details"></textarea>
                </div>

                <div class="col-md-6">
                    <label class="ad-form-label">
                        Status <span class="ad-req">*</span>
                    </label>
                    <select name="status" class="ad-form-input" required>
                        <option value="">Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="ad-form-label">
                        Post File <span class="ad-req">*</span>
                    </label>
                    <div class="ad-upload-zone" id="uploadZone" onclick="document.getElementById('file').click()">
                        <input type="file" name="file" id="file" class="d-none" accept="image/*,video/mp4" required>
                        <div class="ad-upload-placeholder" id="uploadPlaceholder">
                            <span class="ad-upload-icon"><i class="bi bi-cloud-arrow-up"></i></span>
                            <span class="fw-medium">Click to browse</span>
                            <small class="text-muted">Image or MP4 video up to 500MB</small>
                        </div>
                        <img id="preview" class="ad-upload-preview d-none" alt="">
                        <div class="ad-upload-file d-none" id="uploadFile">
                            <i class="bi bi-file-earmark-play"></i>
                            <span id="uploadFileName" class="fw-medium"></span>
                        </div>
                    </div>
                    <small class="ad-upload-hint" id="fileHint">JPG, PNG, GIF, WebP or MP4</small>
                </div>

                <div class="col-12">
                    <div class="ad-form-footer">
                        <a href="{{ url('admin/posts') }}" class="ad-btn-secondary">
                            <i class="bi bi-x-lg me-1"></i> Cancel
                        </a>
                        <button type="submit" class="ad-btn-primary">
                            <i class="bi bi-check-lg me-1"></i> Save Post
                        </button>
                    </div>
                </div>

            </div>
        </form>

    </div>
</div>

<script>
document.getElementById('file').addEventListener('change', function(e) {
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('uploadPlaceholder');
    const uploadFile = document.getElementById('uploadFile');
    const uploadFileName = document.getElementById('uploadFileName');
    const fileHint = document.getElementById('fileHint');
    const zone = document.getElementById('uploadZone');
    const file = e.target.files[0];
    if (!file) return;

    const allowedImages = ['image/jpeg','image/png','image/gif','image/webp'];

    if (allowedImages.includes(file.type)) {
        preview.src = URL.createObjectURL(file);
        preview.classList.remove('d-none');
        placeholder.classList.add('d-none');
        uploadFile.classList.add('d-none');
        fileHint.classList.add('d-none');
        zone.classList.add('ad-upload-has-file');
        return;
    }

    if (file.type === 'video/mp4') {
        preview.classList.add('d-none');
        placeholder.classList.add('d-none');
        uploadFileName.textContent = file.name;
        uploadFile.classList.remove('d-none');
        fileHint.classList.add('d-none');
        zone.classList.add('ad-upload-has-file');
        return;
    }

    Swal.fire({
        icon: 'error',
        title: 'Invalid File',
        text: 'Only Image and MP4 video allowed!',
        confirmButtonColor: '#4f46e5'
    });

    e.target.value = '';
    preview.classList.add('d-none');
    placeholder.classList.remove('d-none');
    uploadFile.classList.add('d-none');
    fileHint.classList.remove('d-none');
    zone.classList.remove('ad-upload-has-file');
});

document.getElementById('uploadZone').addEventListener('dragover', function(e) { e.preventDefault(); this.classList.add('ad-dragover'); });
document.getElementById('uploadZone').addEventListener('dragleave', function() { this.classList.remove('ad-dragover'); });
document.getElementById('uploadZone').addEventListener('drop', function(e) {
    e.preventDefault();
    this.classList.remove('ad-dragover');
    const file = e.dataTransfer.files[0];
    if (file) {
        const input = document.getElementById('file');
        const dt = new DataTransfer();
        dt.items.add(file);
        input.files = dt.files;
        input.dispatchEvent(new Event('change', { bubbles: true }));
    }
});
</script>

<style>
    .ad-alert { border-radius: 12px; border: none; padding: 13px 18px; font-size: 13px; font-weight: 500; margin-bottom: 18px; }
    .ad-alert-success { background: rgba(16,185,129,0.08); color: #10b981; }
    .ad-alert-danger { background: rgba(239,68,68,0.08); color: #ef4444; }

    .ad-page-header { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 22px; }
    .ad-page-header-main { min-width: 0; }
    .ad-page-title { font-weight: 800; color: #1e293b; margin-bottom: 4px; font-size: 22px; }
    .ad-page-title i { color: #6366f1; margin-right: 10px; }
    .ad-page-sub { color: #94a3b8; font-size: 13px; margin: 0; display: flex; align-items: center; flex-wrap: wrap; gap: 6px; }
    .ad-page-sub i { font-size: 12px; color: #a8b4c8; }
    .ad-page-sub .fw-medium { color: #6366f1; }
    .ad-btn-outline {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 10px 20px; border-radius: 10px; font-size: 13px; font-weight: 600;
        background: #fff; color: #475569; border: 1px solid var(--ad-border);
        transition: all 0.25s; text-decoration: none;
    }
    .ad-btn-outline:hover { border-color: #a5b4fc; color: #6366f1; background: #eef2ff; transform: translateY(-2px); }

    .ad-panel { background: #fff; border: 1px solid var(--ad-border); border-radius: 16px; overflow: hidden; box-shadow: 0 2px 14px rgba(15,23,42,0.05); }
    .ad-panel-header { padding: 16px 24px; border-bottom: 1px solid #eef2f7; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; }
    .ad-panel-header h5 { font-size: 15px; font-weight: 700; color: #1e293b; }
    .ad-panel-icon { width: 38px; height: 38px; border-radius: 11px; display: flex; align-items: center; justify-content: center; background: rgba(99,102,241,0.10); color: #6366f1; font-size: 17px; flex-shrink: 0; }
    .ad-panel-body { padding: 24px; }

    .ad-form-errors { background: rgba(239,68,68,0.06); border: 1px solid rgba(239,68,68,0.2); border-radius: 10px; padding: 12px 16px; color: #ef4444; font-size: 13px; margin-bottom: 18px; }

    .ad-form-label { display: block; font-size: 12.5px; font-weight: 600; color: #475569; margin-bottom: 6px; }
    .ad-req { color: #ef4444; }
    .ad-form-input {
        width: 100%; padding: 10px 13px; border: 1px solid var(--ad-border); border-radius: 9px;
        font-size: 13.5px; color: #334155; background: #fff; outline: none;
        transition: border-color 0.25s, box-shadow 0.25s; font-family: inherit;
    }
    .ad-form-input:focus { border-color: #a5b4fc; box-shadow: 0 0 0 3px rgba(99,102,241,0.08); }
    .ad-form-input::placeholder { color: #94a3b8; }
    .ad-form-textarea { min-height: 150px; resize: vertical; }

    .ad-upload-zone {
        border: 2px dashed var(--ad-border); border-radius: 11px; cursor: pointer;
        min-height: 140px; display: flex; align-items: center; justify-content: center;
        padding: 14px; transition: all 0.3s; background: #fafbfd; overflow: hidden; position: relative;
    }
    .ad-upload-zone:hover, .ad-upload-zone.ad-dragover { border-color: #6366f1; background: rgba(99,102,241,0.03); }
    .ad-upload-zone.ad-upload-has-file { border-style: solid; border-color: #6366f1; background: rgba(99,102,241,0.02); }
    .ad-upload-placeholder { display: flex; flex-direction: column; align-items: center; gap: 4px; text-align: center; font-size: 13px; color: #475569; }
    .ad-upload-placeholder small { font-size: 11px; }
    .ad-upload-icon { width: 44px; height: 44px; border-radius: 12px; background: rgba(99,102,241,0.1); color: #6366f1; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 4px; }
    .ad-upload-preview { max-height: 130px; border-radius: 9px; max-width: 100%; object-fit: contain; }
    .ad-upload-file { display: flex; align-items: center; gap: 9px; color: #6366f1; font-size: 13px; }
    .ad-upload-file i { font-size: 20px; }
    .ad-upload-hint { font-size: 11px; color: #94a3b8; display: block; margin-top: 6px; }

    .ad-form-footer { display: flex; justify-content: flex-end; gap: 10px; padding-top: 20px; border-top: 1px solid #eef2f7; margin-top: 4px; }
    .ad-btn-secondary {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 10px 22px; border-radius: 10px; font-size: 13px; font-weight: 600;
        background: #fff; color: #64748b; border: 1px solid var(--ad-border);
        cursor: pointer; transition: all 0.2s; text-decoration: none;
    }
    .ad-btn-secondary:hover { background: #f1f5f9; border-color: #cbd5e1; color: #475569; }
    .ad-btn-primary {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 11px 26px; border-radius: 10px; font-size: 14px; font-weight: 600;
        background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff; border: none;
        cursor: pointer; box-shadow: 0 4px 12px rgba(99,102,241,0.25);
        transition: all 0.25s; text-decoration: none;
    }
    .ad-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(99,102,241,0.35); color: #fff; }

    @media (max-width: 767.98px) {
        .ad-panel-body { padding: 18px 16px; }
        .ad-panel-header { padding: 14px 16px; }
        .ad-form-footer { flex-direction: column-reverse; }
        .ad-form-footer .ad-btn-secondary, .ad-form-footer .ad-btn-primary { width: 100%; justify-content: center; }
        .ad-page-header .ad-btn-outline { width: 100%; justify-content: center; }
    }

    @media (max-width: 575.98px) {
        .ad-page-title { font-size: 19px; }
        .ad-upload-zone { min-height: 120px; }
    }
</style>

@endsection