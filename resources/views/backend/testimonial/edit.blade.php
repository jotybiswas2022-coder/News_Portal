@extends('backend.app')

@section('content')

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white rounded-top-4">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i>
                        Edit Testimonial: {{ $testimonial->name }}
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-semibold">Client Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name"
                                       class="form-control form-control-lg shadow-sm @error('name') is-invalid @enderror"
                                       value="{{ old('name', $testimonial->name) }}"
                                       placeholder="e.g. John Doe" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Rating -->
                            <div class="col-md-3 mb-3">
                                <label for="rating" class="form-label fw-semibold">Rating</label>
                                <select id="rating" name="rating"
                                        class="form-select form-select-lg shadow-sm @error('rating') is-invalid @enderror">
                                    @for($i = 5; $i >= 1; $i--)
                                        <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>
                                            {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                        </option>
                                    @endfor
                                </select>
                                @error('rating')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sort Order -->
                            <div class="col-md-3 mb-3">
                                <label for="sort_order" class="form-label fw-semibold">Sort Order</label>
                                <input type="number" id="sort_order" name="sort_order" min="0"
                                       class="form-control form-control-lg shadow-sm @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', $testimonial->sort_order) }}">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Designation -->
                            <div class="col-md-6 mb-3">
                                <label for="designation" class="form-label fw-semibold">Designation</label>
                                <input type="text" id="designation" name="designation"
                                       class="form-control shadow-sm @error('designation') is-invalid @enderror"
                                       value="{{ old('designation', $testimonial->designation) }}"
                                       placeholder="e.g. CEO">
                                @error('designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Company -->
                            <div class="col-md-6 mb-3">
                                <label for="company" class="form-label fw-semibold">Company</label>
                                <input type="text" id="company" name="company"
                                       class="form-control shadow-sm @error('company') is-invalid @enderror"
                                       value="{{ old('company', $testimonial->company) }}"
                                       placeholder="e.g. Acme Inc.">
                                @error('company')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="mb-3">
                            <label for="message" class="form-label fw-semibold">Review Message <span class="text-danger">*</span></label>
                            <textarea id="message" name="message" rows="4"
                                      class="form-control shadow-sm @error('message') is-invalid @enderror"
                                      placeholder="What did the client say about your work?" required>{{ old('message', $testimonial->message) }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row align-items-end">
                            <!-- Avatar -->
                            <div class="col-md-9 mb-3">
                                <label for="avatar" class="form-label fw-semibold">Client Avatar</label>
                                @if($testimonial->avatar)
                                    <div class="mb-2">
                                        <img src="{{ config('app.storage_url') }}{{ $testimonial->avatar }}"
                                             alt="{{ $testimonial->name }}"
                                             class="rounded-circle shadow-sm"
                                             style="width:80px; height:80px; object-fit:cover;">
                                    </div>
                                @endif
                                <input type="file" accept="image/*" id="avatar" name="avatar"
                                       class="form-control shadow-sm @error('avatar') is-invalid @enderror"
                                       onchange="previewImage(event)">
                                @error('avatar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="mt-2">
                                    <img id="preview" src="" style="display:none; width:80px; height:80px; object-fit:cover;"
                                         class="rounded-circle shadow-sm">
                                </div>
                            </div>

                            <!-- Active Status -->
                            <div class="col-md-3 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                           value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="d-flex gap-2 mt-2">
                            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary btn-lg rounded-3 px-4">
                                <i class="bi bi-arrow-left me-1"></i> Back
                            </a>
                            <button type="submit" class="btn btn-dark btn-lg rounded-3 shadow-sm flex-grow-1">
                                <i class="bi bi-check-circle me-1"></i>
                                Update Testimonial
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
    input.form-control, textarea.form-control, select.form-select {
        background-color: #2c2c2e;
        color: #f1f1f1;
        border-color: #444;
    }
    input.form-control:focus, textarea.form-control:focus, select.form-select:focus {
        background-color: #2c2c2e;
        color: #f1f1f1;
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
    }
}
</style>

@endsection
