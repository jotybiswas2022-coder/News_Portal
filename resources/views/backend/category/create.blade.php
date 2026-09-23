@extends('backend.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color: #1e293b;">
            <i class="bi bi-folder-plus me-2" style="color: #6366f1;"></i>Add New Category
        </h4>
        <p class="text-muted mb-0" style="font-size: 13px;">
            <i class="bi bi-house-door me-1"></i> Dashboard / <a href="{{ url('admin/category') }}" class="text-decoration-none" style="color: #6366f1;">Categories</a> / <span class="fw-medium" style="color: #6366f1;">New</span>
        </p>
    </div>
    <div>
        <a href="{{ url('admin/category') }}" class="ad-btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Go Back
        </a>
    </div>
</div>

<div class="ad-panel">
    <div class="ad-panel-header">
        <h5><i class="bi bi-folder-plus me-2" style="color: #6366f1;"></i>New Category</h5>
    </div>
    <div class="ad-panel-body">
        <form action="{{ url('admin/category/store') }}" method="post">
            @csrf
            <div class="row" style="max-width: 600px;">
                <div class="col-12">
                    <label class="ad-form-label">Category Name <span class="text-danger">*</span></label>
                    <div class="ad-input-group">
                        <span class="ad-input-icon"><i class="bi bi-tag"></i></span>
                        <input type="text" class="ad-form-input ad-input-with-icon" name="name" placeholder="Enter category name" required>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <button type="submit" class="ad-btn-primary">
                        <i class="bi bi-check-lg me-1"></i> Save Category
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
.ad-panel { background: rgba(255,255,255,0.88); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-radius: 14px; border: 1px solid rgba(233,238,243,0.8); overflow: hidden; transition: box-shadow 0.3s; }
.ad-panel:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.04); background: rgba(255,255,255,0.95); }
.ad-panel-header { padding: 16px 20px; border-bottom: 1px solid #f1f5f9; }
.ad-panel-header h5 { font-size: 14px; font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; }
.ad-panel-body { padding: 24px; }
.ad-form-label { display: block; font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 6px; }
.ad-form-input { width: 100%; padding: 10px 12px; border: 1px solid rgba(233,238,243,0.7); border-radius: 8px; font-size: 13px; color: #334155; outline: none; transition: border-color 0.3s; font-family: inherit; background: rgba(255,255,255,0.7); backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px); }
.ad-form-input:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,0.06); background: rgba(255,255,255,0.95); }
.ad-input-group { position: relative; }
.ad-input-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 14px; pointer-events: none; }
.ad-input-with-icon { padding-left: 36px; }
.ad-btn-primary { padding: 10px 28px; border-radius: 10px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; gap: 6px; background: linear-gradient(135deg,#6366f1,#8b5cf6); color: #fff; box-shadow: 0 4px 12px rgba(99,102,241,0.2); text-decoration: none; }
.ad-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(99,102,241,0.3); }
.ad-btn-secondary { padding: 10px 24px; border-radius: 10px; font-size: 13px; font-weight: 600; border: 1px solid rgba(233,238,243,0.5); cursor: pointer; transition: all 0.2s; background: rgba(255,255,255,0.5); backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px); color: #64748b; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; }
.ad-btn-secondary:hover { background: rgba(248,250,252,0.8); border-color: #cbd5e1; color: #475569; }
</style>

@endsection