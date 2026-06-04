@extends('backend.app')

@section('content')

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white rounded-top-4">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i>
                        Edit Post: {{ $post->title }}
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.blog.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Title -->
                            <div class="col-md-8 mb-3">
                                <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                                <input type="text" id="title" name="title"
                                       class="form-control form-control-lg shadow-sm @error('title') is-invalid @enderror"
                                       value="{{ old('title', $post->title) }}"
                                       placeholder="Enter post title" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div class="col-md-4 mb-3">
                                <label for="category" class="form-label fw-semibold">Category</label>
                                <input type="text" id="category" name="category"
                                       class="form-control form-control-lg shadow-sm @error('category') is-invalid @enderror"
                                       value="{{ old('category', $post->category) }}"
                                       placeholder="e.g. Laravel, Tutorial">
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="mb-3">
                            <label for="content" class="form-label fw-semibold">Content <span class="text-danger">*</span></label>
                            <textarea id="content" name="content" rows="14"
                                      class="form-control shadow-sm @error('content') is-invalid @enderror"
                                      placeholder="Write your post content here..." required>{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Excerpt -->
                        <div class="mb-3">
                            <label for="excerpt" class="form-label fw-semibold">Excerpt (Short Summary)</label>
                            <textarea id="excerpt" name="excerpt" rows="2"
                                      class="form-control shadow-sm @error('excerpt') is-invalid @enderror"
                                      placeholder="Brief summary of the post (optional)">{{ old('excerpt', $post->excerpt) }}</textarea>
                            @error('excerpt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Tags -->
                            <div class="col-md-6 mb-3">
                                <label for="tags" class="form-label fw-semibold">Tags</label>
                                <input type="text" id="tags" name="tags"
                                       class="form-control shadow-sm @error('tags') is-invalid @enderror"
                                       value="{{ old('tags', $post->tags) }}"
                                       placeholder="e.g. Laravel, PHP, Tutorial">
                                <div class="form-text">Separate with commas</div>
                                @error('tags')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Featured Image -->
                            <div class="col-md-4 mb-3">
                                <label for="featured_image" class="form-label fw-semibold">Featured Image</label>
                                @if($post->featured_image)
                                    <div class="mb-2">
                                        <img src="{{ config('app.storage_url') }}{{ $post->featured_image }}"
                                             alt="{{ $post->title }}"
                                             class="rounded shadow-sm"
                                             style="max-width:200px; max-height:100px;">
                                    </div>
                                @endif
                                <input type="file" accept="image/*" id="featured_image" name="featured_image"
                                       class="form-control shadow-sm @error('featured_image') is-invalid @enderror"
                                       onchange="previewImage(event)">
                                @error('featured_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Published Status -->
                            <div class="col-md-2 mb-3 d-flex align-items-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_published" name="is_published"
                                           value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="is_published">Published</label>
                                </div>
                            </div>
                        </div>

                        <!-- Image Preview -->
                        <div class="mb-3 text-center" id="previewContainer" style="display:none;">
                            <img id="preview" src="" class="img-fluid rounded shadow-sm" style="max-width:400px; max-height:200px;">
                        </div>

                        <!-- Submit -->
                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary btn-lg rounded-3 px-4">
                                <i class="bi bi-arrow-left me-1"></i> Back
                            </a>
                            <button type="submit" class="btn btn-dark btn-lg rounded-3 shadow-sm flex-grow-1">
                                <i class="bi bi-check-circle me-1"></i>
                                Update Post
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
    const container = document.getElementById('previewContainer');
    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        container.style.display = 'block';
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
