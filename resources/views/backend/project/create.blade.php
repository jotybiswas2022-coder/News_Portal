@extends('backend.app')

@section('content')

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white rounded-top-4">
                    <h5 class="mb-0">
                        <i class="bi bi-plus-circle me-2"></i>
                        Add New Project
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <!-- Title -->
                            <div class="col-md-8 mb-3">
                                <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                                <input type="text" id="title" name="title"
                                       class="form-control form-control-lg shadow-sm @error('title') is-invalid @enderror"
                                       value="{{ old('title') }}"
                                       placeholder="e.g. E-Commerce Platform" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div class="col-md-4 mb-3">
                                <label for="category" class="form-label fw-semibold">Category</label>
                                <input type="text" id="category" name="category"
                                       class="form-control form-control-lg shadow-sm @error('category') is-invalid @enderror"
                                       value="{{ old('category') }}"
                                       placeholder="e.g. Web App">
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea id="description" name="description" rows="4"
                                      class="form-control shadow-sm @error('description') is-invalid @enderror"
                                      placeholder="Describe your project...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Tech Stack -->
                            <div class="col-md-6 mb-3">
                                <label for="tech_stack" class="form-label fw-semibold">Tech Stack</label>
                                <input type="text" id="tech_stack" name="tech_stack"
                                       class="form-control shadow-sm @error('tech_stack') is-invalid @enderror"
                                       value="{{ old('tech_stack') }}"
                                       placeholder="e.g. Laravel, MySQL, Stripe">
                                <div class="form-text">Separate with commas (e.g. Laravel, MySQL, Vue.js)</div>
                                @error('tech_stack')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sort Order -->
                            <div class="col-md-3 mb-3">
                                <label for="sort_order" class="form-label fw-semibold">Sort Order</label>
                                <input type="number" id="sort_order" name="sort_order" min="0"
                                       class="form-control shadow-sm @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', 0) }}">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Active Status -->
                            <div class="col-md-3 mb-3 d-flex align-items-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                           value="1" checked>
                                    <label class="form-check-label fw-semibold" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Live Link -->
                            <div class="col-md-6 mb-3">
                                <label for="live_link" class="form-label fw-semibold">Live Link</label>
                                <input type="url" id="live_link" name="live_link"
                                       class="form-control shadow-sm @error('live_link') is-invalid @enderror"
                                       value="{{ old('live_link') }}"
                                       placeholder="https://example.com">
                                @error('live_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- GitHub Link -->
                            <div class="col-md-6 mb-3">
                                <label for="github_link" class="form-label fw-semibold">GitHub Link</label>
                                <input type="url" id="github_link" name="github_link"
                                       class="form-control shadow-sm @error('github_link') is-invalid @enderror"
                                       value="{{ old('github_link') }}"
                                       placeholder="https://github.com/username/repo">
                                @error('github_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="mb-4">
                            <label for="image" class="form-label fw-semibold">Project Image</label>
                            <input type="file" accept="image/*" id="image" name="image"
                                   class="form-control shadow-sm @error('image') is-invalid @enderror"
                                   onchange="previewImage(event)">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-3 text-center">
                                <img id="preview" src="" style="display:none;"
                                     class="img-fluid rounded shadow-sm" style="max-width:300px; max-height:180px;">
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary btn-lg rounded-3 px-4">
                                <i class="bi bi-arrow-left me-1"></i> Back
                            </a>
                            <button type="submit" class="btn btn-dark btn-lg rounded-3 shadow-sm flex-grow-1">
                                <i class="bi bi-check-circle me-1"></i>
                                Create Project
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        preview.style.display = 'block';
    }
}
</script>

<style>
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.15);
}

@media (prefers-color-scheme: dark) {
    .card {
        background-color: #1c1c1e;
    }
    .card-body, .card-header {
        color: #f1f1f1;
    }
    input.form-control, textarea.form-control {
        background-color: #2c2c2e;
        color: #f1f1f1;
        border-color: #444;
    }
    input.form-control:focus, textarea.form-control:focus {
        background-color: #2c2c2e;
        color: #f1f1f1;
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
    }
}
</style>

@endsection
