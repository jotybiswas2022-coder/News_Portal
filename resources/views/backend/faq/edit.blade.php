@extends('backend.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white rounded-top-4">
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit FAQ</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Question <span class="text-danger">*</span></label>
                            <input type="text" name="question" class="form-control form-control-lg shadow-sm @error('question') is-invalid @enderror"
                                   value="{{ old('question', $faq->question) }}" required>
                            @error('question')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Answer <span class="text-danger">*</span></label>
                            <textarea name="answer" rows="5" class="form-control shadow-sm @error('answer') is-invalid @enderror"
                                      required>{{ old('answer', $faq->answer) }}</textarea>
                            @error('answer')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Sort Order</label>
                                <input type="number" name="sort_order" min="0" class="form-control form-control-lg shadow-sm"
                                       value="{{ old('sort_order', $faq->sort_order) }}">
                            </div>
                            <div class="col-md-6 mb-3 d-flex align-items-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                           {{ old('is_active', $faq->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary btn-lg rounded-3 px-4">
                                <i class="bi bi-arrow-left me-1"></i> Back
                            </a>
                            <button type="submit" class="btn btn-dark btn-lg rounded-3 shadow-sm flex-grow-1">
                                <i class="bi bi-check-circle me-1"></i> Update FAQ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
