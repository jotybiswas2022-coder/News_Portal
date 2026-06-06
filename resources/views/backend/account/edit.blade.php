@extends('backend.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white rounded-top-4">
                    <h5 class="mb-0">
                        <i class="bi bi-person-plus me-2"></i>
                        Edit Account
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ url('/admin/account/update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Name</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name"
                                class="form-control form-control-lg shadow-sm"
                                value="{{ $account->name ?? '' }}"
                                placeholder="Enter name"
                                required
                            >
                        </div>

                        <!-- Phone / WhatsApp -->
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-semibold">
                                <i class="bi bi-whatsapp text-success me-1"></i> WhatsApp Number
                            </label>
                            <input 
                                type="text" 
                                id="phone" 
                                name="phone"
                                class="form-control form-control-lg shadow-sm"
                                value="{{ $account->phone ?? '' }}"
                                placeholder="e.g. +8801XXXXXXXXX"
                            >
                            <div class="form-text">This number will be used for the WhatsApp floating button.</div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email"
                                class="form-control form-control-lg shadow-sm"
                                value="{{ $account->email ?? '' }}"
                                placeholder="e.g. hello@example.com"
                            >
                        </div>

                        <!-- Profile Picture -->
                        <div class="mb-4">
                            <label for="image" class="form-label fw-semibold">Profile Picture</label>
                            <input 
                                type="file" 
                                accept="image/*" 
                                id="image" 
                                name="image"
                                class="form-control shadow-sm"
                                onchange="previewImage(event)"
                            >

                            <!-- Preview -->
                            <div class="mt-3 text-center">
                                <img id="preview"
                                     @if(isset($account) && $account->image)
                                         src="{{ config('app.storage_url') }}{{ $account->image }}" 
                                         style="display:block;"
                                     @else
                                         src=""
                                         style="display:none;"
                                     @endif
                                     class="img-fluid rounded-circle shadow-sm"
                                     style="max-width:120px;">
                            </div>
                        </div>

                        <!-- CV Upload -->
                        <div class="mb-4">
                            <label for="cv" class="form-label fw-semibold">
                                <i class="bi bi-file-pdf me-1 text-danger"></i> CV/Resume (PDF, DOC, DOCX)
                            </label>
                            <input 
                                type="file" 
                                accept=".pdf,.doc,.docx"
                                id="cv" 
                                name="cv"
                                class="form-control shadow-sm"
                            >
                            <div class="form-text">Maximum file size: 5MB. Allowed formats: PDF, DOC, DOCX.</div>

                            @if(isset($account) && $account->cv)
                                <div class="mt-2 d-flex align-items-center gap-3">
                                    <a href="{{ config('app.storage_url') }}{{ $account->cv }}" 
                                       target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye me-1"></i> View Current CV
                                    </a>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               name="remove_cv" id="removeCv" value="1">
                                        <label class="form-check-label text-danger" for="removeCv">
                                            Remove CV
                                        </label>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark btn-lg rounded-3 shadow-sm">
                                <i class="bi bi-check-circle me-1"></i>
                                Update
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Image Preview Script --}}
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

{{-- Custom CSS --}}
<style>
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.15);
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .card {
        background-color: #1c1c1e;
    }
    .card-body, .card-header {
        color: #f1f1f1;
    }
    input.form-control {
        background-color: #2c2c2e;
        color: #f1f1f1;
        border-color: #444;
    }
    input.form-control:focus {
        background-color: #2c2c2e;
        color: #f1f1f1;
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
    }
}
</style>

@endsection