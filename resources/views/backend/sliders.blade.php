@extends('backend.app')

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show ad-alert ad-alert-success" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show ad-alert ad-alert-danger" role="alert">
    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="ad-page-header">
    <div>
        <h4 class="ad-page-title">
            <i class="bi bi-images"></i> Manage Sliders
        </h4>
        <p class="ad-page-sub">
            <i class="bi bi-house-door"></i> Dashboard / <span class="fw-medium">Sliders</span>
            <span class="ad-page-sep">·</span>
            <i class="bi bi-image"></i> Hero Images on homepage
        </p>
    </div>
    <span class="ad-header-badge">
        <i class="bi bi-images"></i> Hero Sliders
    </span>
</div>

<div class="ad-panel">
    <div class="ad-panel-header">
        <div class="d-flex align-items-center gap-2">
            <span class="ad-panel-icon"><i class="bi bi-images"></i></span>
            <div>
                <h5 class="mb-0">Slider Images</h5>
                <small class="text-muted" style="font-size: 12px;">Upload the hero slider images that appear on the homepage</small>
            </div>
        </div>
    </div>
    <div class="ad-panel-body">
        <form action="/admin/sliders/store" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-12 col-lg-6">
                    <div class="ad-upload-card" id="uploadCard1">
                        <div class="ad-upload-header ad-upload-header-1">
                            <div class="ad-upload-badge">
                                <i class="bi bi-1-circle"></i>
                            </div>
                            <div class="ad-upload-title">
                                <h6 class="fw-bold mb-1" style="color: #1e293b;">Slider Image 1</h6>
                                <span class="text-muted" style="font-size: 11px;">Recommended: 1920 x 900 px</span>
                            </div>
                        </div>
                        <div class="ad-drop-zone" id="dropZone1" onclick="document.getElementById('slider1').click()">
                            <input type="file" accept="image/*" name="slider1" id="slider1" class="d-none" onchange="handleFileSelect(event, 'preview1', 'dropZone1', 'uploadCard1')">
                            <div class="ad-drop-content" id="dropContent1">
                                @if($slider && $slider->slider1)
                                <img id="preview1" src="{{ config('app.storage_url').$slider->slider1 }}" class="ad-preview-img active" alt="Slider 1">
                                <div class="ad-drop-placeholder d-none" id="placeholder1">
                                    <span class="ad-drop-icon"><i class="bi bi-cloud-arrow-up"></i></span>
                                    <span class="fw-medium">Drop image here or click to browse</span>
                                    <small class="text-muted">JPEG, PNG, WebP up to 4MB</small>
                                </div>
                                @else
                                <div class="ad-drop-placeholder" id="placeholder1">
                                    <span class="ad-drop-icon"><i class="bi bi-cloud-arrow-up"></i></span>
                                    <span class="fw-medium">Drop image here or click to browse</span>
                                    <small class="text-muted">JPEG, PNG, WebP up to 4MB</small>
                                </div>
                                <img id="preview1" class="ad-preview-img" alt="Preview">
                                @endif
                            </div>
                        </div>
                        <div class="ad-card-footer">
                            @if($slider && $slider->slider1)
                            <div class="ad-upload-footer" id="footer1">
                                <span class="ad-file-status text-success"><i class="bi bi-check-circle-fill me-1"></i> Image uploaded</span>
                                <button type="button" class="ad-btn-sm ad-btn-remove" onclick="removeImage('slider1','preview1','placeholder1','footer1','{{ $slider->id }}',1)">
                                    <i class="bi bi-trash3 me-1"></i> Remove
                                </button>
                            </div>
                            @else
                            <div class="ad-upload-footer d-none" id="footer1"></div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="ad-upload-card" id="uploadCard2">
                        <div class="ad-upload-header ad-upload-header-2">
                            <div class="ad-upload-badge">
                                <i class="bi bi-2-circle"></i>
                            </div>
                            <div class="ad-upload-title">
                                <h6 class="fw-bold mb-1" style="color: #1e293b;">Slider Image 2</h6>
                                <span class="text-muted" style="font-size: 11px;">Recommended: 1920 x 900 px</span>
                            </div>
                        </div>
                        <div class="ad-drop-zone" id="dropZone2" onclick="document.getElementById('slider2').click()">
                            <input type="file" accept="image/*" name="slider2" id="slider2" class="d-none" onchange="handleFileSelect(event, 'preview2', 'dropZone2', 'uploadCard2')">
                            <div class="ad-drop-content" id="dropContent2">
                                @if($slider && $slider->slider2)
                                <img id="preview2" src="{{ config('app.storage_url').$slider->slider2 }}" class="ad-preview-img active" alt="Slider 2">
                                <div class="ad-drop-placeholder d-none" id="placeholder2">
                                    <span class="ad-drop-icon"><i class="bi bi-cloud-arrow-up"></i></span>
                                    <span class="fw-medium">Drop image here or click to browse</span>
                                    <small class="text-muted">JPEG, PNG, WebP up to 4MB</small>
                                </div>
                                @else
                                <div class="ad-drop-placeholder" id="placeholder2">
                                    <span class="ad-drop-icon"><i class="bi bi-cloud-arrow-up"></i></span>
                                    <span class="fw-medium">Drop image here or click to browse</span>
                                    <small class="text-muted">JPEG, PNG, WebP up to 4MB</small>
                                </div>
                                <img id="preview2" class="ad-preview-img" alt="Preview">
                                @endif
                            </div>
                        </div>
                        <div class="ad-card-footer">
                            @if($slider && $slider->slider2)
                            <div class="ad-upload-footer" id="footer2">
                                <span class="ad-file-status text-success"><i class="bi bi-check-circle-fill me-1"></i> Image uploaded</span>
                                <button type="button" class="ad-btn-sm ad-btn-remove" onclick="removeImage('slider2','preview2','placeholder2','footer2','{{ $slider->id }}',2)">
                                    <i class="bi bi-trash3 me-1"></i> Remove
                                </button>
                            </div>
                            @else
                            <div class="ad-upload-footer d-none" id="footer2"></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="ad-form-footer">
                <div>
                    <small class="text-muted"><i class="bi bi-info-circle me-1"></i> Select new images or keep existing ones</small>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="ad-btn-primary"><i class="bi bi-check-lg me-1"></i> Save Sliders</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function handleFileSelect(event, previewId, dropZoneId, cardId) {
    const file = event.target.files[0];
    if (!file) return;
    const preview = document.getElementById(previewId);
    const dropZone = document.getElementById(dropZoneId);
    const placeholder = dropZone.querySelector('.ad-drop-placeholder');
    preview.src = URL.createObjectURL(file);
    preview.classList.add('active');
    if (placeholder) placeholder.classList.add('d-none');
    const card = document.getElementById(cardId);
    const footer = card.querySelector('.ad-upload-footer');
    if (footer) {
        footer.classList.remove('d-none');
        footer.innerHTML = '<span class="ad-file-status text-primary"><i class="bi bi-file-earmark-image me-1"></i> '+file.name+'</span> <button type="button" class="ad-btn-sm ad-btn-change" onclick="document.getElementById(\''+dropZoneId.replace('dropZone','slider')+'\').click()"><i class="bi bi-arrow-repeat me-1"></i> Change</button>';
    }
    dropZone.classList.add('ad-has-file');
    const existingNotice = card.querySelector('.ad-pending-remove');
    if (existingNotice) existingNotice.remove();
}

function removeImage(inputId, previewId, placeholderId, footerId, sliderId, sliderNum) {
    document.getElementById(inputId).value = '';
    document.getElementById(previewId).classList.remove('active');
    document.getElementById(placeholderId).classList.remove('d-none');
    document.getElementById(footerId).classList.add('d-none');
    const dropZoneId = 'dropZone' + inputId.replace('slider', '');
    const dropZone = document.getElementById(dropZoneId);
    if (dropZone) dropZone.classList.remove('ad-has-file');
    const card = document.getElementById(inputId === 'slider1' ? 'uploadCard1' : 'uploadCard2');
    const existingNotice = card.querySelector('.ad-pending-remove');
    if (!existingNotice) {
        const notice = document.createElement('div');
        notice.className = 'ad-pending-remove';
        notice.innerHTML = '<i class="bi bi-clock-history me-1"></i> Will be removed on save';
        card.querySelector('.ad-drop-zone').parentNode.insertBefore(notice, card.querySelector('.ad-drop-zone'));
    }
}

document.querySelectorAll('.ad-drop-zone').forEach(function(zone) {
    zone.addEventListener('dragover', function(e) { e.preventDefault(); zone.classList.add('ad-dragover'); });
    zone.addEventListener('dragleave', function() { zone.classList.remove('ad-dragover'); });
    zone.addEventListener('drop', function(e) {
        e.preventDefault();
        zone.classList.remove('ad-dragover');
        var file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            var input = zone.querySelector('input[type="file"]');
            var dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            input.files = dataTransfer.files;
            var changeEvent = new Event('change', { bubbles: true });
            input.dispatchEvent(changeEvent);
        }
    });
});
</script>

<style>
    .ad-alert { border-radius: 12px; border: none; padding: 14px 18px; font-size: 13px; font-weight: 500; margin-bottom: 20px; }
    .ad-alert-success { background: rgba(16, 185, 129, 0.08); color: #10b981; }
    .ad-alert-danger { background: rgba(239, 68, 68, 0.08); color: #ef4444; }

    /* Page header (shared with dashboard) */
    .ad-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 24px;
    }
    .ad-page-title {
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 4px;
        font-size: 22px;
    }
    .ad-page-title i { color: #6366f1; margin-right: 10px; }
    .ad-page-sub {
        color: #94a3b8;
        font-size: 13px;
        margin: 0;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px;
    }
    .ad-page-sep { color: #dbe2eb; }
    .ad-header-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 18px;
        border-radius: 10px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        font-size: 12px;
        font-weight: 600;
        box-shadow: 0 6px 18px rgba(99, 102, 241, 0.28);
    }

    .ad-panel {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e9eef3;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
        box-shadow: 0 1px 4px rgba(15, 23, 42, 0.04);
    }
    .ad-panel:hover { box-shadow: 0 10px 28px rgba(15, 23, 42, 0.08); }
    .ad-panel-header {
        padding: 18px 24px;
        border-bottom: 1px solid #f1f5f9;
        background: linear-gradient(90deg, rgba(99,102,241,0.03), transparent);
    }
    .ad-panel-header h5 { font-size: 15px; font-weight: 700; color: #1e293b; }
    .ad-panel-icon {
        width: 40px;
        height: 40px;
        border-radius: 11px;
        background: rgba(99, 102, 241, 0.1);
        color: #6366f1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }
    .ad-panel-body { padding: 24px; }

    /* Upload Cards */
    .ad-upload-card {
        background: #fafbfd;
        border: 1px solid #e9eef3;
        border-radius: 14px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .ad-upload-card:hover {
        border-color: #d7dee9;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.07);
        transform: translateY(-2px);
    }
    .ad-upload-card::before {
        content: '';
        display: block;
        height: 4px;
    }
    .ad-upload-card-1::before { background: linear-gradient(90deg, #6366f1, #8b5cf6); }
    .ad-upload-card-2::before { background: linear-gradient(90deg, #10b981, #34d399); }

    .ad-upload-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 18px;
        background: #fff;
        border-bottom: 1px solid #eef2f7;
        position: relative;
    }
    .ad-upload-title { min-width: 0; }
    .ad-upload-badge {
        width: 40px;
        height: 40px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
        flex-shrink: 0;
    }
    .ad-upload-header-1 .ad-upload-badge { background: rgba(99, 102, 241, 0.12); color: #6366f1; }
    .ad-upload-header-2 .ad-upload-badge { background: rgba(16, 185, 129, 0.12); color: #10b981; }

    .ad-drop-zone {
        margin: 16px;
        border: 2px dashed #d9e0ea;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #fff;
        min-height: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        flex: 1;
    }
    .ad-drop-zone.ad-has-file#dropZone2 { border-color: #10b981; }
    .ad-drop-zone:hover {
        border-color: #6366f1;
        background: rgba(99, 102, 241, 0.02);
    }
    .ad-drop-zone.ad-dragover {
        border-color: #6366f1;
        background: rgba(99, 102, 241, 0.06);
        transform: scale(1.01);
        box-shadow: inset 0 0 0 3px rgba(99, 102, 241, 0.08);
    }
    .ad-drop-zone.ad-has-file {
        border-style: solid;
        border-color: #c7d2e1;
    }
    .ad-drop-content {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .ad-drop-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        text-align: center;
        padding: 30px 20px;
        color: #94a3b8;
    }
    .ad-drop-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(99,102,241,0.1), rgba(139,92,246,0.08));
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 6px;
    }
    .ad-drop-icon i { font-size: 26px; color: #6366f1; }
    .ad-drop-placeholder span.fw-medium { font-size: 13px; color: #475569; }
    .ad-drop-placeholder small { font-size: 11px; }

    .ad-preview-img {
        display: none;
        width: 100%;
        border-radius: 8px;
        max-height: 240px;
        object-fit: cover;
    }
    .ad-preview-img.active { display: block; }

    .ad-card-footer { margin-top: auto; }
    .ad-upload-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 18px 16px;
    }
    .ad-file-status { font-size: 12px; font-weight: 600; }

    .ad-btn-sm {
        padding: 6px 15px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
    }
    .ad-btn-remove { background: rgba(239, 68, 68, 0.08); color: #ef4444; }
    .ad-btn-remove:hover { background: rgba(239, 68, 68, 0.15); }
    .ad-btn-change { background: rgba(99, 102, 241, 0.08); color: #6366f1; }
    .ad-btn-change:hover { background: rgba(99, 102, 241, 0.15); }

    .ad-form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 24px;
        padding-top: 18px;
        border-top: 1px solid #f1f5f9;
    }
    .ad-form-footer small { font-size: 12px; }

    .ad-btn-primary {
        padding: 11px 30px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
    }
    .ad-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(99, 102, 241, 0.3); }
    .ad-btn-primary:active { transform: translateY(0); }

    .ad-pending-remove {
        font-size: 11px;
        color: #f59e0b;
        padding: 6px 14px;
        margin: 8px 16px 0;
        background: rgba(245, 158, 11, 0.08);
        border-radius: 8px;
        border: 1px solid rgba(245, 158, 11, 0.12);
    }

    @media (max-width: 1199.98px) {
        .ad-page-title { font-size: 20px; }
    }
    @media (max-width: 767.98px) {
        .ad-page-header { flex-direction: column; align-items: flex-start; }
        .ad-panel-body { padding: 16px; }
        .ad-drop-zone { margin: 12px; min-height: 170px; }
        .ad-drop-placeholder { padding: 20px 14px; }
        .ad-drop-placeholder span.fw-medium { font-size: 12px; }
        .ad-preview-img { max-height: 170px; }
        .ad-form-footer { flex-direction: column; align-items: stretch; }
        .ad-form-footer .ad-btn-primary { width: 100%; justify-content: center; }
        .ad-header-badge { align-self: flex-start; }
    }
    @media (max-width: 575.98px) {
        .ad-panel-header { padding: 14px 16px; }
        .ad-drop-zone { min-height: 150px; }
        .ad-upload-footer { flex-wrap: wrap; gap: 8px; }
        .ad-drop-icon { width: 52px; height: 52px; }
    }
</style>

@endsection