@extends('backend.app')

@section('content')

@if(session('success'))
    <div class="ad-alert ad-alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color: #1e293b;">
            <i class="bi bi-gear-fill me-2" style="color: #6366f1;"></i>Settings
        </h4>
        <p class="text-muted mb-0" style="font-size: 13px;">
            <i class="bi bi-house-door me-1"></i> Dashboard / <span class="fw-medium" style="color: #6366f1;">Settings</span>
        </p>
    </div>
    <div>
        <span class="badge px-3 py-2" style="background: linear-gradient(135deg, #6366f1, #8b5cf6); font-size: 12px; font-weight: 500;">
            <i class="bi bi-sliders me-1"></i> General Settings
        </span>
    </div>
</div>

<div class="ad-panel">
    <div class="ad-panel-header" style="background: linear-gradient(135deg,#6366f1,#8b5cf6);">
        <h5 style="color: #fff; margin: 0; display: flex; align-items: center;">
            <i class="bi bi-gear-fill me-2"></i> General Settings
        </h5>
    </div>
    <div class="ad-panel-body">
        <form action="{{ url('admin/settings') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="email" class="ad-form-label">Email <span class="text-danger">*</span></label>
                <div class="ad-input-group">
                    <span class="ad-input-icon"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" id="email" class="ad-form-input ad-input-with-icon" value="{{ $settings?->email ?? '' }}" placeholder="Enter email address">
                </div>
            </div>

            <div class="mb-4">
                <label for="phone" class="ad-form-label">Phone <span class="text-danger">*</span></label>
                <div class="ad-input-group">
                    <span class="ad-input-icon"><i class="bi bi-telephone"></i></span>
                    <input type="text" name="phone" id="phone" class="ad-form-input ad-input-with-icon" value="{{ $settings?->phone ?? '' }}" placeholder="Enter phone number">
                </div>
            </div>

            <div class="mb-4">
                <label for="location" class="ad-form-label">Location <span class="text-danger">*</span></label>
                <div class="ad-input-group">
                    <span class="ad-input-icon"><i class="bi bi-geo-alt"></i></span>
                    <input type="text" name="location" id="location" class="ad-form-input ad-input-with-icon" value="{{ $settings?->location ?? '' }}" placeholder="Enter location">
                </div>
            </div>

            <div class="d-flex justify-content-end pt-3" style="border-top: 1px solid rgba(241,245,249,0.5);">
                <button type="submit" class="ad-btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Save Settings
                </button>
            </div>

        </form>
    </div>
</div>

<style>
.ad-alert {
    border-radius: 12px;
    border: none;
    padding: 14px 18px;
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 20px;
}
.ad-alert-success {
    background: rgba(16, 185, 129, 0.08);
    color: #10b981;
}
.ad-panel {
    background: rgba(255, 255, 255, 0.88);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: 14px;
    border: 1px solid rgba(233, 238, 243, 0.8);
    overflow: hidden;
    transition: box-shadow 0.3s ease;
}
.ad-panel:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    background: rgba(255, 255, 255, 0.95);
}
.ad-panel-header {
    padding: 16px 24px;
    border-bottom: 1px solid rgba(241, 245, 249, 0.5);
}
.ad-panel-body {
    padding: 24px;
}
.ad-form-label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #475569;
    margin-bottom: 8px;
}
.ad-input-group {
    position: relative;
}
.ad-input-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 16px;
    pointer-events: none;
}
.ad-form-input {
    width: 100%;
    padding: 12px 14px 12px 42px;
    border: 1px solid rgba(233, 238, 243, 0.7);
    border-radius: 10px;
    font-size: 14px;
    color: #334155;
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    outline: none;
    transition: border-color 0.3s, box-shadow 0.3s;
    font-family: inherit;
}
.ad-form-input:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.08);
    background: rgba(255, 255, 255, 0.95);
}
.ad-form-input::placeholder {
    color: #94a3b8;
}
.ad-btn-primary {
    padding: 11px 32px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: #fff;
    box-shadow: 0 4px 15px rgba(99, 102, 241, 0.25);
}
.ad-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(99, 102, 241, 0.35);
}
.ad-btn-primary:active {
    transform: translateY(0);
}
</style>

@endsection