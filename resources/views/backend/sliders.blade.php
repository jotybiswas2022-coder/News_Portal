@extends('backend.app')

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show ad-alert" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show ad-alert" role="alert">
    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color: #1e293b;">
            <i class="bi bi-images me-2" style="color: #6366f1;"></i>Manage Sliders
        </h4>
        <p class="text-muted mb-0" style="font-size: 13px;">
            <i class="bi bi-house-door me-1"></i> Dashboard / <span class="fw-medium" style="color: #6366f1;">Sliders</span>
        </p>
    </div>
    <div>
        <span class="badge px-3 py-2" style="background: linear-gradient(135deg, #6366f1, #8b5cf6); font-size: 12px; font-weight: 500;">
            <i class="bi bi-image me-1"></i> Hero Images
        </span>
    </div>
</div>

<div class="ad-panel">
    <div class="ad-panel-header">
        <h5><i class="bi bi-images me-2" style="color: #6366f1;"></i>Slider Images</h5>
        <p class="text-muted mb-0" style="font-size: 12px;">Upload the hero slider images that appear on the homepage</p>
    </div>
    <div class="ad-panel-body">
        <form action="/admin/sliders/store" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-12 col-lg-6">
                    <div class="ad-upload-card" id="uploadCard1">
                        <div class="ad-upload-header">
                            <div class="ad-upload-badge" style="background: rgba(99,102,241,0.12); color: #6366f1;">
                                <i class="bi bi-1-circle"></i>
                            </div>
                            <div>
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
                                    <i class="bi bi-cloud-arrow-up"></i>
                                    <span class="fw-medium">Drop image here or click to browse</span>
                                    <small class="text-muted">JPEG, PNG, WebP up to 4MB</small>
                                </div>
                                @else
                                <div class="ad-drop-placeholder" id="placeholder1">
                                    <i class="bi bi-cloud-arrow-up"></i>
                                    <span class="fw-medium">Drop image here or click to browse</span>
                                    <small class="text-muted">JPEG, PNG, WebP up to 4MB</small>
                                </div>
                                <img id="preview1" class="ad-preview-img" alt="Preview">
                                @endif
                            </div>
                        </div>
                        @if($slider && $slider->slider1)
                        <div class="ad-upload-footer" id="footer1">
                            <span class="text-success small"><i class="bi bi-check-circle-fill me-1"></i> Image uploaded</span>
                            <button type="button" class="ad-btn-sm ad-btn-remove" onclick="removeImage('slider1','preview1','placeholder1','footer1','{{ $slider->id }}',1)">
                                <i class="bi bi-trash3 me-1"></i> Remove
                            </button>
                        </div>
                        @else
                        <div class="ad-upload-footer d-none" id="footer1"></div>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="ad-upload-card" id="uploadCard2">
                        <div class="ad-upload-header">
                            <div class="ad-upload-badge" style="background: rgba(16,185,129,0.12); color: #10b981;">
                                <i class="bi bi-2-circle"></i>
                            </div>
                            <div>
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
                                    <i class="bi bi-cloud-arrow-up"></i>
                                    <span class="fw-medium">Drop image here or click to browse</span>
                                    <small class="text-muted">JPEG, PNG, WebP up to 4MB</small>
                                </div>
                                @else
                                <div class="ad-drop-placeholder" id="placeholder2">
                                    <i class="bi bi-cloud-arrow-up"></i>
                                    <span class="fw-medium">Drop image here or click to browse</span>
                                    <small class="text-muted">JPEG, PNG, WebP up to 4MB</small>
                                </div>
                                <img id="preview2" class="ad-preview-img" alt="Preview">
                                @endif
                            </div>
                        </div>
                        @if($slider && $slider->slider2)
                        <div class="ad-upload-footer" id="footer2">
                            <span class="text-success small"><i class="bi bi-check-circle-fill me-1"></i> Image uploaded</span>
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
            <div class="d-flex justify-content-between align-items-center mt-4 pt-3" style="border-top: 1px solid #f1f5f9;">
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
        footer.innerHTML = '<span class="text-primary small"><i class="bi bi-file-earmark-image me-1"></i> '+file.name+'</span> <button type="button" class="ad-btn-sm ad-btn-change" onclick="document.getElementById(\''+dropZoneId.replace('dropZone','slider')+'\').click()"><i class="bi bi-arrow-repeat me-1"></i> Change</button>';
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
.ad-alert {
    border-radius: 12px;
    border: none;
    padding: 14px 18px;
    font-size: 13px;
    font-weight: 500;
}
.alert-success {
    background: rgba(16, 185, 129, 0.08);
    color: #10b981;
}
.alert-danger {
    background: rgba(239, 68, 68, 0.08);
    color: #ef4444;
}
.ad-panel {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid #e9eef3;
    overflow: hidden;
    transition: box-shadow 0.3s ease;
}
.ad-panel:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
}
.ad-panel-header {
    padding: 18px 24px;
    border-bottom: 1px solid #f1f5f9;
}
.ad-panel-header h5 {
    font-size: 15px;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
    display: flex;
    align-items: center;
}
.ad-panel-body {
    padding: 24px;
}
.ad-upload-card {
    background: #fafbfc;
    border: 1px solid #e9eef3;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
}
.ad-upload-card:hover {
    border-color: #dde3ea;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
}
.ad-upload-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 18px;
    background: #fff;
    border-bottom: 1px solid #f1f5f9;
}
.ad-upload-badge {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}
.ad-drop-zone {
    margin: 16px;
    border: 2px dashed #dde3ea;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #fff;
    min-height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}
.ad-drop-zone:hover {
    border-color: #6366f1;
    background: rgba(99, 102, 241, 0.02);
}
.ad-drop-zone.ad-dragover {
    border-color: #6366f1;
    background: rgba(99, 102, 241, 0.06);
    transform: scale(1.01);
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
    gap: 6px;
    text-align: center;
    padding: 30px 20px;
    color: #94a3b8;
}
.ad-drop-placeholder i {
    font-size: 42px;
    color: #cbd5e1;
    margin-bottom: 8px;
}
.ad-drop-placeholder span {
    font-size: 13px;
    color: #64748b;
}
.ad-drop-placeholder small {
    font-size: 11px;
}
.ad-preview-img {
    display: none;
    width: 100%;
    border-radius: 8px;
    max-height: 220px;
    object-fit: cover;
}
.ad-preview-img.active {
    display: block;
}
.ad-upload-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 18px 14px;
}
.ad-btn-sm {
    padding: 5px 14px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
}
.ad-btn-remove {
    background: rgba(239, 68, 68, 0.08);
    color: #ef4444;
}
.ad-btn-remove:hover {
    background: rgba(239, 68, 68, 0.15);
}
.ad-btn-change {
    background: rgba(99, 102, 241, 0.08);
    color: #6366f1;
}
.ad-btn-change:hover {
    background: rgba(99, 102, 241, 0.15);
}
.ad-btn-primary {
    padding: 10px 28px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: #fff;
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
}
.ad-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(99, 102, 241, 0.3);
}
.ad-btn-primary:active {
    transform: translateY(0);
}
.ad-pending-remove {
    font-size: 11px;
    color: #f59e0b;
    padding: 6px 14px;
    margin: 0 16px;
    background: rgba(245, 158, 11, 0.08);
    border-radius: 8px;
    border: 1px solid rgba(245, 158, 11, 0.12);
}
@media (max-width: 768px) {
    .ad-panel-body { padding: 16px; }
    .ad-drop-zone { margin: 12px; min-height: 160px; }
    .ad-drop-placeholder i { font-size: 32px; }
    .ad-preview-img { max-height: 160px; }
}
</style>

@endsection