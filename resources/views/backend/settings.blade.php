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
    <div class="ad-page-header-main">
        <h4 class="ad-page-title">
            <i class="bi bi-gear-fill"></i> Settings
        </h4>
        <p class="ad-page-sub">
            <i class="bi bi-house-door"></i> Dashboard / <span class="fw-medium">Settings</span>
            <span class="ad-page-sep">·</span>
            <span class="ad-page-count">Site options</span>
        </p>
    </div>
    <span class="ad-header-badge">
        <i class="bi bi-sliders"></i> General Settings
    </span>
</div>

<div class="ad-panel">
    <div class="ad-panel-header">
        <div class="d-flex align-items-center gap-2">
            <span class="ad-panel-icon"><i class="bi bi-gear"></i></span>
            <div>
                <h5 class="mb-0">General Settings</h5>
                <small class="text-muted" style="font-size: 12px;">Contact details shown across the portal</small>
            </div>
        </div>
    </div>
    <div class="ad-panel-body ad-panel-body-narrow">
        <form action="{{ url('admin/settings') }}" method="POST">
            @csrf

            @if ($errors->any())
            <div class="ad-form-errors">
                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                <ul class="mb-0 ps-3" style="font-size: 12px;">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="mb-4">
                <label for="email" class="ad-form-label">Email <span class="ad-req">*</span></label>
                <div class="ad-input-group">
                    <span class="ad-input-icon"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" id="email" class="ad-form-input ad-input-with-icon" value="{{ old('email', $settings?->email ?? '') }}" placeholder="Enter email address">
                </div>
            </div>

            <div class="mb-4">
                <label for="phone" class="ad-form-label">Phone <span class="ad-req">*</span></label>
                <div class="ad-input-group">
                    <span class="ad-input-icon"><i class="bi bi-telephone"></i></span>
                    <input type="text" name="phone" id="phone" class="ad-form-input ad-input-with-icon" value="{{ old('phone', $settings?->phone ?? '') }}" placeholder="Enter phone number">
                </div>
            </div>

            <div class="mb-4">
                <label for="location" class="ad-form-label">Location <span class="ad-req">*</span></label>
                <div class="ad-input-group">
                    <span class="ad-input-icon"><i class="bi bi-geo-alt"></i></span>
                    <input type="text" name="location" id="location" class="ad-form-input ad-input-with-icon" value="{{ old('location', $settings?->location ?? '') }}" placeholder="Enter location">
                </div>
            </div>

            <div class="ad-form-footer">
                <button type="submit" class="ad-btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Save Settings
                </button>
            </div>

        </form>
    </div>
</div>

<style>
    .ad-alert { border-radius: 12px; border: none; padding: 13px 18px; font-size: 13px; font-weight: 500; margin-bottom: 18px; }
    .ad-alert-success { background: rgba(16,185,129,0.08); color: #10b981; }
    .ad-alert-danger { background: rgba(239,68,68,0.08); color: #ef4444; }

    .ad-page-header { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 22px; }
    .ad-page-header-main { min-width: 0; }
    .ad-page-title { font-weight: 800; color: #1e293b; margin-bottom: 4px; font-size: 22px; }
    .ad-page-title i { color: #6366f1; margin-right: 10px; }
    .ad-page-sub { color: #94a3b8; font-size: 13px; margin: 0; display: flex; align-items: center; flex-wrap: wrap; gap: 6px; }
    .ad-page-sub i { font-size: 12px; color: #a8b4c8; }
    .ad-page-sub .fw-medium { color: #6366f1; }
    .ad-page-sep { color: #dbe2eb; }
    .ad-page-count { color: #475569; font-weight: 600; }
    .ad-header-badge { display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 10px; font-size: 12px; font-weight: 700; color: #6366f1; background: rgba(99,102,241,0.10); }

    .ad-panel { background: #fff; border: 1px solid var(--ad-border); border-radius: 16px; overflow: hidden; box-shadow: 0 2px 14px rgba(15,23,42,0.05); }
    .ad-panel-header { padding: 16px 24px; border-bottom: 1px solid #eef2f7; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; }
    .ad-panel-header h5 { font-size: 15px; font-weight: 700; color: #1e293b; }
    .ad-panel-icon { width: 38px; height: 38px; border-radius: 11px; display: flex; align-items: center; justify-content: center; background: rgba(99,102,241,0.10); color: #6366f1; font-size: 17px; flex-shrink: 0; }
    .ad-panel-body { padding: 24px; }
    .ad-panel-body-narrow { max-width: 720px; }

    .ad-form-errors { background: rgba(239,68,68,0.06); border: 1px solid rgba(239,68,68,0.2); border-radius: 10px; padding: 12px 16px; color: #ef4444; font-size: 13px; margin-bottom: 18px; }
    .ad-form-label { display: block; font-size: 12.5px; font-weight: 600; color: #475569; margin-bottom: 6px; }
    .ad-req { color: #ef4444; }
    .ad-input-group { position: relative; }
    .ad-input-icon { position: absolute; left: 13px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 14px; pointer-events: none; }
    .ad-form-input { width: 100%; padding: 10px 13px 10px 40px; border: 1px solid var(--ad-border); border-radius: 9px; font-size: 13.5px; color: #334155; background: #fff; outline: none; transition: border-color 0.25s, box-shadow 0.25s; font-family: inherit; }
    .ad-form-input:focus { border-color: #a5b4fc; box-shadow: 0 0 0 3px rgba(99,102,241,0.08); }
    .ad-form-input::placeholder { color: #94a3b8; }

    .ad-form-footer { display: flex; justify-content: flex-end; padding-top: 20px; border-top: 1px solid #eef2f7; margin-top: 4px; }
    .ad-btn-primary { display: inline-flex; align-items: center; gap: 6px; padding: 11px 26px; border-radius: 10px; font-size: 14px; font-weight: 600; background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff; border: none; cursor: pointer; box-shadow: 0 4px 12px rgba(99,102,241,0.25); transition: all 0.25s; text-decoration: none; }
    .ad-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(99,102,241,0.35); color: #fff; }

    @media (max-width: 767.98px) {
        .ad-panel-body { padding: 18px 16px; }
        .ad-panel-header { padding: 14px 16px; }
    }

    @media (max-width: 575.98px) {
        .ad-page-title { font-size: 19px; }
        .ad-header-badge { width: 100%; justify-content: center; }
        .ad-form-footer .ad-btn-primary { width: 100%; justify-content: center; }
    }
</style>

@endsection