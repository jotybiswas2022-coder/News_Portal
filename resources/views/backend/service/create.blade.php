@extends('backend.app')

@section('content')

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white rounded-top-4">
                    <h5 class="mb-0">
                        <i class="bi bi-plus-circle me-2"></i>
                        Add New Service
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.services.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Service Title <span class="text-danger">*</span></label>
                            <input type="text" name="title"
                                   class="form-control form-control-lg shadow-sm @error('title') is-invalid @enderror"
                                   value="{{ old('title') }}" placeholder="e.g. Web Development" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Short Description</label>
                            <textarea name="short_description" rows="3"
                                      class="form-control shadow-sm @error('short_description') is-invalid @enderror"
                                      placeholder="Brief description for the service card (max 500 characters)">{{ old('short_description') }}</textarea>
                            @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Description</label>
                            <textarea name="description" rows="5"
                                      class="form-control shadow-sm @error('description') is-invalid @enderror"
                                      placeholder="Detailed description of the service">{{ old('description') }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Icon (Bootstrap Icons class)</label>
                                <input type="text" name="icon" id="iconInput"
                                       class="form-control shadow-sm @error('icon') is-invalid @enderror"
                                       value="{{ old('icon') }}" placeholder="e.g. bi-code-slash, bi-phone">
                                <div class="form-text">
                                    Browse icons at <a href="https://icons.getbootstrap.com" target="_blank">icons.getbootstrap.com</a>
                                    — Use full class like <code>bi-code-slash</code>
                                </div>
                                @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-semibold">Sort Order</label>
                                <input type="number" name="sort_order" min="0"
                                       class="form-control form-control-lg shadow-sm @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', 0) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 mb-3 d-flex align-items-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                    <label class="form-check-label fw-semibold" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 text-center">
                                <div class="icon-preview border rounded p-3 d-inline-block">
                                    <div class="small text-muted mb-1">Icon Preview:</div>
                                    <i class="bi bi-star fs-2" id="iconPreview"></i>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary btn-lg rounded-3 px-4">
                                <i class="bi bi-arrow-left me-1"></i> Back
                            </a>
                            <button type="submit" class="btn btn-dark btn-lg rounded-3 shadow-sm flex-grow-1">
                                <i class="bi bi-check-circle me-1"></i>
                                Create Service
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
document.getElementById('iconInput').addEventListener('input', function() {
    const preview = document.getElementById('iconPreview');
    preview.className = 'bi ' + (this.value || 'bi-star') + ' fs-2';
});
</script>

<style>
.card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
.card:hover { transform: translateY(-3px); box-shadow: 0 12px 24px rgba(0,0,0,0.15); }
@media (prefers-color-scheme: dark) {
    .card { background-color: #1c1c1e; }
    .card-body, .card-header { color: #f1f1f1; }
    textarea.form-control, input.form-control {
        background-color: #2c2c2e; color: #f1f1f1; border-color: #444;
    }
    textarea.form-control:focus, input.form-control:focus {
        background-color: #2c2c2e; color: #f1f1f1; border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
    }
}
</style>

@endsection
