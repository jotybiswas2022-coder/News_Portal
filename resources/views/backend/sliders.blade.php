@extends('backend.app')

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show m-3" role="alert">
    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
    <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@php
    /* Each image the homepage reads, with the shape it is actually shown in
       (see the hero / promise frames in public/frontend/css/brand.css). */
    $fields = [
        [
            'key'   => 'slider1',
            'icon'  => 'bi-display',
            'tint'  => 'primary',
            'title' => 'Desktop / Tablet banner',
            'role'  => 'Hero slider — wide screens',
            'ratio' => '16 / 10',
            'w'     => 1600,
            'h'     => 1000,
            'where' => 'Homepage hero, from 768px wide',
            'hint'  => 'Wide landscape banner. JPG, PNG or WebP — max 4MB.',
        ],
        [
            'key'   => 'slider2',
            'icon'  => 'bi-phone',
            'tint'  => 'success',
            'title' => 'Mobile banner',
            'role'  => 'Hero slider — phones',
            'ratio' => '3 / 4',
            'w'     => 900,
            'h'     => 1200,
            'where' => 'Homepage hero, under 768px',
            'hint'  => 'Portrait crop. Leave it empty and phones reuse the desktop banner.',
        ],
        [
            'key'   => 'about_image',
            'icon'  => 'bi-award',
            'tint'  => 'warning',
            'title' => 'Our Promise image',
            'role'  => '“Soft, wearable pieces…” band',
            'ratio' => '4 / 5',
            'w'     => 800,
            'h'     => 1000,
            'where' => 'Homepage — Our Promise section',
            'hint'  => 'Portrait crop. Leave it empty and the newest product photo is used.',
        ],
    ];

    $anyImage = $slider && ($slider->slider1 || $slider->slider2 || $slider->about_image);
@endphp

<div class="container-fluid py-4 px-3 px-md-4">

    {{-- ===================================================== Page header --}}
    <div class="row align-items-center g-3 mb-3">
        <div class="col-md-7">
            <h2 class="fw-bold mb-1">
                <i class="bi bi-images text-primary me-2"></i>Manage Sliders
            </h2>
            <small class="text-muted">
                আপনার হোমপেজের হিরো স্লাইডার ও “Our Promise” সেকশনের ছবিগুলো এখানে ম্যানেজ করুন
            </small>
        </div>
        <div class="col-md-5">
            <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                <span class="slider-legend">
                    <i class="bi bi-display text-primary"></i> slider1 · Desktop
                </span>
                <span class="slider-legend">
                    <i class="bi bi-phone text-success"></i> slider2 · Mobile
                </span>
                <span class="slider-legend">
                    <i class="bi bi-award text-warning"></i> about_image · Promise
                </span>
            </div>
        </div>
    </div>

    @unless($anyImage)
        <div class="alert alert-light border rounded-4 d-flex align-items-center gap-3 mb-3" role="status">
            <i class="bi bi-images fs-4 text-muted"></i>
            <div>
                <div class="fw-semibold text-dark">এখনো কোনো ছবি আপলোড করা হয়নি</div>
                <small class="text-muted">
                    নিচের যেকোনো কার্ড থেকে ছবি বেছে নিয়ে <strong>Save</strong> চাপুন — হোমপেজে সাথে সাথে দেখা যাবে।
                </small>
            </div>
        </div>
    @endunless

    {{-- The file inputs live inside this form, so Save really does upload them. --}}
    <form id="sliderForm" action="{{ url('/admin/sliders/store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="sliderId" name="id" value="{{ $slider ? $slider->id : '' }}">

        <div class="row g-4">
            @foreach($fields as $field)
                @php
                    $path      = $slider ? $slider->{$field['key']} : null;
                    $hasImage  = (bool) $path;
                    $badgeId   = 'badge-' . $field['key'];
                    $previewId = 'preview-' . $field['key'];
                    $placeholder = 'https://placehold.co/' . $field['w'] . 'x' . $field['h']
                                 . '/eef1f4/94a3b8?text=' . rawurlencode($field['title']);
                @endphp

                <div class="col-12 col-lg-6">
                    <div class="card slider-card border-0 shadow-sm rounded-4 h-100" id="card-{{ $field['key'] }}">
                        <div class="card-body p-3 p-md-4">

                            {{-- Field header ---------------------------------- --}}
                            <div class="d-flex align-items-start justify-content-between gap-2 mb-3">
                                <div class="d-flex align-items-start gap-2">
                                    <span class="slider-card__icon text-{{ $field['tint'] }}">
                                        <i class="bi {{ $field['icon'] }}"></i>
                                    </span>
                                    <div>
                                        <div class="slider-card__title">{{ $field['title'] }}</div>
                                        <div class="slider-card__key">
                                            <code>{{ $field['key'] }}</code> · {{ $field['role'] }}
                                        </div>
                                    </div>
                                </div>

                                <span id="{{ $badgeId }}" class="badge rounded-pill {{ $hasImage
                                    ? 'bg-success bg-opacity-10 text-success border border-success border-opacity-25'
                                    : 'bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25' }}">
                                    @if($hasImage)
                                        <i class="bi bi-check-lg me-1"></i>Uploaded
                                    @else
                                        <i class="bi bi-hourglass me-1"></i>No image
                                    @endif
                                </span>
                            </div>

                            {{-- Preview -------------------------------------- --}}
                            <div class="slider-preview" style="aspect-ratio: {{ $field['ratio'] }};">
                                <img id="{{ $previewId }}"
                                     src="{{ $hasImage ? config('app.storage_url') . $path : $placeholder }}"
                                     alt="{{ $field['title'] }} preview"
                                     onerror="this.src='{{ $placeholder }}'">

                                @if($hasImage)
                                    <button type="button"
                                            class="slider-preview__clear"
                                            onclick="clearImage('{{ $field['key'] }}')"
                                            title="Delete this image"
                                            aria-label="Delete {{ $field['key'] }}">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                @endif

                                <span class="slider-preview__where">
                                    <i class="bi bi-eye"></i> {{ $field['where'] }}
                                </span>
                            </div>

                            {{-- Upload -------------------------------------- --}}
                            <label class="form-label fw-medium text-dark mt-3 mb-1" for="{{ $field['key'] }}">
                                📁 নতুন ছবি আপলোড করুন
                            </label>
                            <input type="file"
                                   accept="image/*"
                                   class="form-control"
                                   name="{{ $field['key'] }}"
                                   id="{{ $field['key'] }}"
                                   onchange="previewImage(event, '{{ $previewId }}', '{{ $field['key'] }}')">
                            <div class="form-text">{{ $field['hint'] }}</div>

                            {{-- Per-image delete ----------------------------- --}}
                            @if($hasImage)
                                <button type="button"
                                        class="btn btn-sm btn-outline-danger rounded-pill w-100 mt-3"
                                        onclick="clearImage('{{ $field['key'] }}')">
                                    <i class="bi bi-trash3 me-1"></i>Delete this image
                                </button>
                            @else
                                <button type="button"
                                        class="btn btn-sm btn-outline-secondary rounded-pill w-100 mt-3"
                                        disabled>
                                    <i class="bi bi-slash-circle me-1"></i>No image to delete
                                </button>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- ================================================ Action row --}}
        <div class="row g-3 mt-4 align-items-center">
            <div class="col-12 col-sm-6">
                @if($slider)
                    <button type="button"
                            class="btn btn-outline-danger w-100 rounded-pill shadow-sm"
                            onclick="confirmDeleteAll()">
                        <i class="bi bi-trash3 me-2"></i>সব মুছুন (Delete All)
                    </button>
                @else
                    <button type="button" class="btn btn-outline-secondary w-100 rounded-pill shadow-sm" disabled>
                        <i class="bi bi-trash3 me-2"></i>সব মুছুন (Delete All)
                    </button>
                @endif
            </div>
            <div class="col-12 col-sm-6">
                <button type="submit" class="btn btn-gradient w-100 rounded-pill shadow-sm">
                    <i class="bi bi-cloud-upload me-2"></i>সংরক্ষণ করুন (Save)
                </button>
            </div>
        </div>
    </form>
</div>

<script>
/* Instant preview of a file that has been picked but not saved yet. */
function previewImage(event, previewId, fieldKey) {
    var preview = document.getElementById(previewId);
    var file = event.target.files[0];
    if (!file || !preview) return;

    var reader = new FileReader();
    reader.onload = function (e) {
        preview.style.opacity = '0';
        preview.src = e.target.result;
        setTimeout(function () { preview.style.opacity = '1'; }, 50);
    };
    reader.readAsDataURL(file);

    // Make it obvious the change is only local until Save is pressed.
    var card = document.getElementById('card-' + fieldKey);
    if (card) card.classList.add('is-pending');

    var badge = document.getElementById('badge-' + fieldKey);
    if (badge) {
        badge.className = 'badge rounded-pill bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25';
        badge.innerHTML = '<i class="bi bi-arrow-up-circle me-1"></i>Ready to save';
    }
}

/* Delete one image — confirm with SweetAlert, then post an explicit
   remove_<field> flag so the controller drops the column and the file. */
function clearImage(fieldName) {
    var sliderId = document.getElementById('sliderId').value;
    if (!sliderId) return;

    Swal.fire({
        title: 'Delete this image?',
        html: '<code>' + fieldName + '</code> এর ছবিটি মুছে ফেলা হবে।<br>হোমপেজ থেকে সাথে সাথে সরে যাবে।',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it',
        cancelButtonText: 'Cancel',
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-danger rounded-pill px-4',
            cancelButton: 'btn btn-secondary rounded-pill px-4'
        }
    }).then(function (result) {
        if (result.isConfirmed) {
            postFlag('remove_' + fieldName, sliderId);
        }
    });
}

/* Delete every image at once. */
function confirmDeleteAll() {
    Swal.fire({
        title: 'Delete all sliders?',
        text: 'slider1, slider2 ও about_image — সব ছবি মুছে ফেলা হবে। এটি ফেরানো যাবে না!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete all',
        cancelButtonText: 'Cancel',
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-danger rounded-pill px-4',
            cancelButton: 'btn btn-secondary rounded-pill px-4'
        }
    }).then(function (result) {
        if (result.isConfirmed) {
            postFlag(null, document.getElementById('sliderId').value, true);
        }
    });
}

/* A detached POST — used because the main form carries the file inputs. */
function postFlag(flagName, sliderId, isDeleteAll) {
    if (!sliderId) return;

    var form = document.createElement('form');
    form.method = 'POST';
    form.action = isDeleteAll
        ? '/admin/sliders/delete/' + sliderId
        : '/admin/sliders/update/' + sliderId;

    var csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = '{{ csrf_token() }}';
    form.appendChild(csrf);

    if (flagName) {
        var flag = document.createElement('input');
        flag.type = 'hidden';
        flag.name = flagName;
        flag.value = '1';
        form.appendChild(flag);
    }

    document.body.appendChild(form);
    form.submit();
}
</script>

<style>
/* Card shell --------------------------------------------------------- */
.slider-card { transition: box-shadow 0.3s ease; }
.slider-card:hover { box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1) !important; }
.slider-card.is-pending { border: 1px solid rgba(255, 193, 7, 0.5); }
.slider-card.is-pending .slider-preview { outline: 2px dashed rgba(255, 193, 7, 0.6); outline-offset: -2px; }

.slider-card__icon {
    display: grid;
    place-items: center;
    width: 38px;
    height: 38px;
    flex-shrink: 0;
    border-radius: 12px;
    background: #f1f3f9;
    font-size: 1.05rem;
}
.slider-card__title { font-weight: 600; font-size: 0.95rem; line-height: 1.3; color: #1f2937; }
.slider-card__key { font-size: 0.74rem; color: #6c757d; }
.slider-card__key code { font-size: 0.72rem; color: #4f46e5; }

/* Preview frame — the shape the image is actually displayed in --------- */
.slider-preview {
    position: relative;
    overflow: hidden;
    border-radius: 14px;
    background: linear-gradient(135deg, #f8fafc 0%, #e9edf3 100%);
    max-height: 420px;
}
.slider-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: opacity 0.3s ease;
}
.slider-preview__clear {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 34px;
    height: 34px;
    display: grid;
    place-items: center;
    border: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.92);
    color: #dc3545;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.18);
    transition: background 0.2s ease, transform 0.2s ease;
}
.slider-preview__clear:hover { background: #dc3545; color: #fff; transform: scale(1.06); }
.slider-preview__where {
    position: absolute;
    left: 10px;
    bottom: 10px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 11px;
    border-radius: 999px;
    background: rgba(17, 24, 39, 0.72);
    color: #fff;
    font-size: 0.68rem;
    letter-spacing: 0.02em;
    backdrop-filter: blur(4px);
}

/* Bits from the shared admin chrome ----------------------------------- */
.slider-legend {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border: 1px solid #e9ecef;
    border-radius: 999px;
    background: #fff;
    font-size: 0.76rem;
    color: #495057;
}

.btn-gradient {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: #fff;
    font-weight: 600;
    border: none;
    transition: all 0.3s ease;
}
.btn-gradient:hover {
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(99, 102, 241, 0.38);
}
.btn-gradient:active { transform: translateY(0); }

#sliderForm .form-control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
}

/* Responsive ---------------------------------------------------------- */
@media (max-width: 991px) {
    .slider-preview { max-height: 360px; }
}

@media (max-width: 575px) {
    .container-fluid { padding-left: 0.75rem; padding-right: 0.75rem; }
    .slider-card .card-body { padding: 0.85rem !important; }
    .slider-card__title { font-size: 0.9rem; }
    .slider-preview { max-height: 300px; border-radius: 12px; }
    .slider-preview__where { font-size: 0.62rem; padding: 4px 9px; }
    .slider-preview__clear { width: 30px; height: 30px; top: 8px; right: 8px; }
    .slider-legend { font-size: 0.72rem; padding: 5px 10px; }
    .btn-gradient,
    .btn-outline-danger,
    .btn-outline-secondary { font-size: 0.85rem; padding: 0.55rem 1rem; }
}
</style>

@endsection
