@extends('backend.app')

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <!-- Header -->
                <div class="card-header bg-white border-0 px-4 py-3">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div>
                            <h4 class="fw-bold mb-1 mb-0">
                                <i class="bi bi-images text-primary me-2"></i>Manage Sliders
                            </h4>
                            <p class="text-muted small mb-0">
                                আপনার হোমপেজের হিরো সেকশনের ছবিগুলো এখানে ম্যানেজ করুন
                            </p>
                        </div>
                        <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                            <i class="bi bi-info-circle me-1"></i> slider1 = Desktop | slider2 = Mobile
                        </span>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if(!$slider)
                        <!-- No slider yet -->
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-muted">
                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <path d="M21 15l-5-5L5 21"/>
                                </svg>
                            </div>
                            <h5 class="fw-semibold text-dark">এখনো কোনো স্লাইডার নেই</h5>
                            <p class="text-muted small mb-4">নিচে ছবি আপলোড করে স্লাইডার তৈরি করুন</p>
                        </div>
                    @endif

                    <!-- Sliders Grid -->
                    <div class="row g-4">
                        <!-- Slider 1 Card -->
                        <div class="col-12 col-lg-6">
                            <div class="card border-0 shadow-sm rounded-4 h-100 hover-shadow transition-shadow">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <label class="form-label fw-semibold mb-0">
                                            <i class="bi bi-display me-1 text-primary"></i>slider1 — Desktop / Tablet
                                        </label>
                                        @if($slider && $slider->slider1)
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-2 py-1">
                                                <i class="bi bi-check-lg me-1"></i>Uploaded
                                            </span>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 rounded-pill px-2 py-1">
                                                <i class="bi bi-hourglass me-1"></i>No image
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Preview -->
                                    <div class="position-relative rounded-3 overflow-hidden bg-light mb-3" style="aspect-ratio: 16/9; min-height: 180px;">
                                        <img id="preview1"
                                             src="{{ $slider && $slider->slider1 ? config('app.storage_url').$slider->slider1 : 'https://placehold.co/800x450/e2e8f0/94a3b8?text=No+Image+Yet' }}"
                                             class="w-100 h-100 object-fit-cover"
                                             style="transition: opacity 0.3s ease;"
                                             alt="Slider 1 preview"
                                             onerror="this.src='https://placehold.co/800x450/e2e8f0/94a3b8?text=Invalid+Image'">
                                        @if($slider && $slider->slider1)
                                            <button class="btn btn-sm btn-outline-danger position-absolute top-0 end-0 m-2 rounded-pill" onclick="clearImage('slider1')" title="Remove image">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        @endif
                                    </div>

                                    <!-- Upload Input -->
                                    <label class="form-label fw-medium text-dark">📁 নতুন ছবি আপলোড করুন</label>
                                    <input type="file"
                                           accept="image/*"
                                           class="form-control form-control-lg"
                                           name="slider1"
                                           id="slider1"
                                           onchange="previewImage(event, 'preview1')"
                                    >
                                    <div class="form-text text-muted">
                                        <i class="bi bi-info-circle me-1"></i>JPG, PNG, WebP — সর্বোচ্চ ৪MB
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slider 2 Card -->
                        <div class="col-12 col-lg-6">
                            <div class="card border-0 shadow-sm rounded-4 h-100 hover-shadow transition-shadow">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <label class="form-label fw-semibold mb-0">
                                            <i class="bi bi-phone me-1 text-success"></i>slider2 — Mobile
                                        </label>
                                        @if($slider && $slider->slider2)
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-2 py-1">
                                                <i class="bi bi-check-lg me-1"></i>Uploaded
                                            </span>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 rounded-pill px-2 py-1">
                                                <i class="bi bi-hourglass me-1"></i>No image
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Preview -->
                                    <div class="position-relative rounded-3 overflow-hidden bg-light mb-3" style="aspect-ratio: 9/16; min-height: 200px;">
                                        <img id="preview2"
                                             src="{{ $slider && $slider->slider2 ? config('app.storage_url').$slider->slider2 : 'https://placehold.co/450x800/e2e8f0/94a3b8?text=No+Image+Yet' }}"
                                             class="w-100 h-100 object-fit-cover"
                                             style="transition: opacity 0.3s ease;"
                                             alt="Slider 2 preview"
                                             onerror="this.src='https://placehold.co/450x800/e2e8f0/94a3b8?text=Invalid+Image'">
                                        @if($slider && $slider->slider2)
                                            <button class="btn btn-sm btn-outline-danger position-absolute top-0 end-0 m-2 rounded-pill" onclick="clearImage('slider2')" title="Remove image">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        @endif
                                    </div>

                                    <!-- Upload Input -->
                                    <label class="form-label fw-medium text-dark">📁 নতুন ছবি আপলোড করুন</label>
                                    <input type="file"
                                           accept="image/*"
                                           class="form-control form-control-lg"
                                           name="slider2"
                                           id="slider2"
                                           onchange="previewImage(event, 'preview2')"
                                    >
                                    <div class="form-text text-muted">
                                        <i class="bi bi-info-circle me-1"></i>JPG, PNG, WebP — সর্বোচ্চ ৪MB
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row g-3 mt-4">
                        <div class="col-12 col-sm-6 text-start">
                            @if($slider)
                                <a class="btn btn-outline-danger w-100 rounded-pill shadow-sm"
                                   href="{{ url('/admin/sliders/delete', $slider->id) }}"
                                   onclick="return confirmDelete()">
                                    <i class="bi bi-trash3 me-2"></i>সব মুছুন (Delete All)
                                </a>
                            @else
                                <button class="btn btn-outline-secondary w-100 rounded-pill shadow-sm" disabled>
                                    <i class="bi bi-trash3 me-2"></i>সব মুছুন (Delete All)
                                </button>
                            @endif
                        </div>
                        <div class="col-12 col-sm-6 text-end">
                            <button type="submit" form="sliderForm" class="btn btn-gradient w-100 rounded-pill shadow-sm">
                                <i class="bi bi-cloud-upload me-2"></i>সংরক্ষণ করুন (Save)
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Form (hidden, handles save) -->
            <form id="sliderForm" action="/admin/sliders/store" method="POST" enctype="multipart/form-data" class="d-none">
                @csrf
                <input type="hidden" id="sliderId" name="id" value="{{ $slider ? $slider->id : '' }}">
                <button type="submit" class="d-none">Submit</button>
            </form>
        </div>
    </div>
</div>

<!-- Preview Script -->
<script>
function previewImage(event, previewId) {
    const preview = document.getElementById(previewId);
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.opacity = '0';
            setTimeout(() => { preview.style.opacity = '1'; }, 50);
        };
        reader.readAsDataURL(file);
    }
}

function clearImage(sliderName) {
    if (confirm('এই ছবিটি মুছে ফেলতে চান?')) {
        // Create a form to submit via update route
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/sliders/update/' + document.getElementById('sliderId').value;
        
        // Add CSRF token
        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';
        form.appendChild(csrf);
        
        // Add empty file input for the slider to clear
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.name = sliderName;
        // Don't set files - empty means clear
        form.appendChild(fileInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}

function confirmDelete() {
    return confirm('সতর্কবার্তা: এই অপশনে সব স্লাইডার মুছে ফেলা হবে। এটি বাতিল করতে "Cancel" চাপুন।
    
    আপনি কি নিশ্চিত যে আপনি সব স্লাইডার মুছে ফেলতে চান?');
}
</script>

<!-- Styles -->
<style>
/* Card hover shadow */
.hover-shadow { transition: box-shadow 0.3s ease; }
.hover-shadow:hover { box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.12) !important; }

/* Custom gradient button */
.btn-gradient {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: #fff;
    font-weight: 600;
    border: none;
    transition: all 0.3s ease;
}
.btn-gradient:hover {
    transform: translateY(-1px);
    opacity: 0.95;
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
}

.btn-gradient:active {
    transform: translateY(0);
}

/* Form control styling */
.form-control {
    border-radius: 10px;
    border: 1.5px solid #e2e8f0;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}
.form-control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

/* Image placeholder styling */
.bg-light {
    background-image: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

/* Smooth transitions */
.transition-shadow { transition: box-shadow 0.3s ease; }

/* Responsive card heights */
@media (max-width: 991px) {
    .col-lg-6 {
        max-width: 100%;
    }
}

@media (max-width: 576px) {
    .card-body {
        padding: 0.75rem;
    }
    
    .position-relative {
        min-height: 150px;
    }
    
    .btn-gradient,
    .btn-outline-danger,
    .btn-outline-secondary {
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
    }
}
</style>

@endsection
