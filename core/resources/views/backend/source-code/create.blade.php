@extends('backend.app')

@section('title', (isset($sourceCode) ? 'Edit' : 'Add') . ' Source Code — Admin')

@section('content')

@if ($errors->any())
    <input type="hidden" id="formErrors" value="{{ json_encode($errors->all()) }}">
@endif

<div class="sc-form-page">
    {{-- Back Link --}}
    <a href="{{ route('admin.source-codes.index') }}" class="sc-back-link">
        <i class="bi bi-arrow-left"></i>
        Back to Source Codes
    </a>

    {{-- Header --}}
    <div class="sc-form-header">
        <div class="sc-form-header-left">
            <div class="sc-form-header-icon">
                <i class="bi bi-code-slash"></i>
            </div>
            <div>
                <h4 class="sc-form-title">{{ isset($sourceCode) ? 'Edit Source Code' : 'Add New Source Code' }}</h4>
                <p class="sc-form-sub">{{ isset($sourceCode) ? 'Update "' . $sourceCode->name . '" details' : 'Create a new source code product' }}</p>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <form method="POST" action="{{ isset($sourceCode) ? route('admin.source-codes.update', $sourceCode->id) : route('admin.source-codes.store') }}"
          enctype="multipart/form-data" class="sc-form" id="sourceCodeForm">
        @csrf
        @if(isset($sourceCode))
            @method('PUT')
        @endif

        <div class="sc-form-grid">

            {{-- LEFT COLUMN: Basic Info --}}
            <div>
                <div class="sc-form-card">
                    <div class="sc-form-card-hd">
                        <i class="bi bi-info-circle"></i>
                        <span>Basic Information</span>
                    </div>
                    <div class="sc-form-card-bd">
                        <div class="sc-fg">
                            <label class="sc-label">Name <span class="sc-req">*</span></label>
                            <input type="text" name="name" id="scName" class="sc-input"
                                   value="{{ old('name', $sourceCode->name ?? '') }}"
                                   placeholder="e.g. Dark Algo EA" required>
                            @error('name') <span class="sc-err">{{ $message }}</span> @enderror
                        </div>

                        <div class="sc-fg">
                            <label class="sc-label">Slug <span class="sc-req">*</span></label>
                            <div style="position:relative">
                                <input type="text" name="slug" id="scSlug" class="sc-input sc-input-mono"
                                       value="{{ old('slug', $sourceCode->slug ?? '') }}"
                                       placeholder="e.g. dark-algo-ea" required>
                                <button type="button" id="genSlug" class="sc-slug-gen" title="Generate from name">
                                    <i class="bi bi-arrow-repeat"></i>
                                </button>
                            </div>
                            <span class="sc-hint">Auto-generated from name. Use lowercase with hyphens.</span>
                            @error('slug') <span class="sc-err">{{ $message }}</span> @enderror
                        </div>

                        <div class="sc-fg">
                            <label class="sc-label">Tagline <span class="sc-req">*</span></label>
                            <input type="text" name="tagline" class="sc-input"
                                   value="{{ old('tagline', $sourceCode->tagline ?? '') }}"
                                   placeholder="e.g. Complete MQL4/MQL5 Source Code" required>
                            @error('tagline') <span class="sc-err">{{ $message }}</span> @enderror
                        </div>

                        <div class="sc-fg">
                            <label class="sc-label">Description</label>
                            <textarea name="description" class="sc-input sc-textarea" rows="4"
                                      placeholder="Full description of the source code...">{{ old('description', $sourceCode->description ?? '') }}</textarea>
                            @error('description') <span class="sc-err">{{ $message }}</span> @enderror
                        </div>

                        <div class="sc-fg">
                            <label class="sc-label">Download Link</label>
                            <input type="url" name="download_link" class="sc-input" value="{{ old('download_link', $sourceCode->download_link ?? '') }}"
                                placeholder="e.g. https://example.com/download/source-code.zip">
                            <span class="sc-hint">Direct URL for users to download the source code after purchase</span>
                            @error('download_link') <span class="sc-err">{{ $message }}</span> @enderror
                        </div>

                        <div class="sc-fg">
                            <label class="sc-label">Preview Image</label>
                            <div class="sc-img-upload" id="imgUploadArea">
                                <input type="file" name="image" id="scImage" accept="image/jpeg,image/png,image/webp" style="display:none">
                                <div class="sc-img-placeholder" id="imgPlaceholder">
                                    <i class="bi bi-cloud-upload" style="font-size:28px;color:var(--scprimary);margin-bottom:8px;display:block"></i>
                                    <span style="color:var(--scmuted);font-size:13px">Click to upload preview image</span>
                                    <span style="color:var(--scsub);font-size:11px;margin-top:4px">JPEG, PNG or WebP — Max 2MB</span>
                                </div>
                                <div class="sc-img-preview" id="imgPreview" style="display:none">
                                    <img id="previewImg" src="" alt="Preview">
                                    <button type="button" id="removeImg" class="sc-img-remove"><i class="bi bi-x-lg"></i></button>
                                </div>
                            </div>
                            @if(isset($sourceCode) && $sourceCode->image)
                                <div style="margin-top:8px;padding:10px;background:rgba(16,185,129,0.06);border:1px solid rgba(16,185,129,0.12);border-radius:8px;">
                                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px">
                                        <img src="{{ config('app.storage_url') }}{{ $sourceCode->image }}" alt="{{ $sourceCode->name }}" style="width:60px;height:60px;border-radius:6px;object-fit:cover;border:1px solid var(--scborder)">
                                        <div>
                                            <span style="font-size:12px;color:var(--scmuted);display:block">{{ basename($sourceCode->image) }}</span>
                                            <span style="font-size:11px;color:#10b981"><i class="bi bi-check-circle"></i> Uploaded</span>
                                        </div>
                                    </div>
                                    <label style="display:inline-flex;align-items:center;gap:6px;cursor:pointer;padding:4px 10px;background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.15);border-radius:6px;font-size:12px;color:#ef4444;transition:all 0.2s" onmouseover="this.style.background='rgba(239,68,68,0.15)'" onmouseout="this.style.background='rgba(239,68,68,0.08)'">
                                        <input type="checkbox" name="remove_image" value="1" style="accent-color:#ef4444">
                                        <i class="bi bi-trash"></i> Remove this image
                                    </label>
                                </div>
                            @endif
                            @error('image') <span class="sc-err">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                {{-- PRICING --}}
                <div class="sc-form-card">
                    <div class="sc-form-card-hd">
                        <i class="bi bi-currency-dollar"></i>
                        <span>Pricing</span>
                    </div>
                    <div class="sc-form-card-bd">
                        <div class="sc-inline-group">
                            <div class="sc-fg" style="flex:1">
                                <label class="sc-label">Price ($) <span class="sc-req">*</span></label>
                                <input type="number" step="0.01" min="0" name="price" class="sc-input"
                                       value="{{ old('price', $sourceCode->price ?? '') }}"
                                       placeholder="199.00" required>
                                @error('price') <span class="sc-err">{{ $message }}</span> @enderror
                            </div>
                            <div class="sc-fg" style="flex:1">
                                <label class="sc-label">Old Price ($)</label>
                                <input type="number" step="0.01" min="0" name="old_price" class="sc-input"
                                       value="{{ old('old_price', $sourceCode->old_price ?? '') }}"
                                       placeholder="299.00 (strikethrough)">
                                @error('old_price') <span class="sc-err">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- STATUS --}}
                <div class="sc-form-card">
                    <div class="sc-form-card-hd">
                        <i class="bi bi-toggle-on"></i>
                        <span>Status</span>
                    </div>
                    <div class="sc-form-card-bd">
                        <label class="sc-toggle">
                            <input type="checkbox" name="available" value="1" {{ old('available', $sourceCode->available ?? true) ? 'checked' : '' }}>
                            <span class="sc-toggle-slider"></span>
                            <span class="sc-toggle-label">Available — show on the frontend</span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- RIGHT COLUMN: Tech Details & Content --}}
            <div>
                {{-- TECHNOLOGY & CATEGORY --}}
                <div class="sc-form-card">
                    <div class="sc-form-card-hd">
                        <i class="bi bi-cpu"></i>
                        <span>Technology & Category</span>
                    </div>
                    <div class="sc-form-card-bd">
                        <div class="sc-inline-group">
                            <div class="sc-fg" style="flex:1">
                                <label class="sc-label">Language <span class="sc-req">*</span></label>
                                <input type="text" name="language" id="scLanguage" class="sc-input"
                                       value="{{ old('language', $sourceCode->language ?? '') }}"
                                       placeholder="e.g. Python, MQL5" required>
                                @error('language') <span class="sc-err">{{ $message }}</span> @enderror
                            </div>
                            <div class="sc-fg" style="flex:1">
                                <label class="sc-label">Category <span class="sc-req">*</span></label>
                                <input type="text" name="category" class="sc-input"
                                       value="{{ old('category', $sourceCode->category ?? '') }}"
                                       placeholder="e.g. EA, Indicator" required>
                                @error('category') <span class="sc-err">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="sc-inline-group">
                            <div class="sc-fg" style="flex:1">
                                <label class="sc-label">Platform</label>
                                <input type="text" name="platform" class="sc-input"
                                       value="{{ old('platform', $sourceCode->platform ?? '') }}"
                                       placeholder="e.g. MetaTrader 5">
                                @error('platform') <span class="sc-err">{{ $message }}</span> @enderror
                            </div>
                            <div class="sc-fg" style="flex:1">
                                <label class="sc-label">Version</label>
                                <input type="text" name="version" class="sc-input"
                                       value="{{ old('version', $sourceCode->version ?? '') }}"
                                       placeholder="e.g. 1.0, 2.5">
                                @error('version') <span class="sc-err">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FEATURES --}}
                <div class="sc-form-card">
                    <div class="sc-form-card-hd">
                        <i class="bi bi-stars"></i>
                        <span>Key Features</span>
                    </div>
                    <div class="sc-form-card-bd">
                        <div class="sc-fg">
                            <label class="sc-label">Features <span class="sc-req">*</span></label>
                            <textarea name="features" class="sc-input sc-textarea" rows="4"
                                      placeholder="Enter features separated by commas&#10;e.g. Real-time signals, Multi-timeframe analysis, Risk management">{{ old('features', isset($sourceCode) && $sourceCode->features ? (is_array($sourceCode->features) ? implode(', ', $sourceCode->features) : $sourceCode->features) : '') }}</textarea>
                            <span class="sc-hint">Separate each feature with a comma</span>
                            @error('features') <span class="sc-err">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                {{-- SOURCE CODE --}}
                <div class="sc-form-card">
                    <div class="sc-form-card-hd">
                        <i class="bi bi-file-earmark-code"></i>
                        <span>Source Code</span>
                    </div>
                    <div class="sc-form-card-bd">
                        <div class="sc-fg">
                            <label class="sc-label">Code Content</label>
                            <div class="sc-code-editor">
                                <div class="sc-code-header">
                                    <span class="sc-code-label">📄 Source Code</span>
                                    <span class="sc-code-lang" id="langIndicator">
                                        <i class="bi bi-circle-fill" style="font-size:6px;color:#10b981;margin-right:6px;vertical-align:middle"></i>
                                        {{ old('language', $sourceCode->language ?? 'N/A') }}
                                    </span>
                                </div>
                                <textarea name="code" class="sc-input sc-code-area" rows="12"
                                          placeholder="Paste your source code here...">{{ old('code', $sourceCode->code ?? '') }}</textarea>
                            </div>
                            @error('code') <span class="sc-err">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <div class="sc-form-actions">
            <a href="{{ route('admin.source-codes.index') }}" class="sc-btn-cancel">Cancel</a>
            <button type="submit" class="sc-btn-submit" id="formSubmitBtn">
                <i class="bi bi-check-lg"></i>
                {{ isset($sourceCode) ? 'Update Source Code' : 'Create Source Code' }}
            </button>
        </div>
    </form>
</div>

<style>
:root {
    --scbg: #0f172a;
    --scrd: rgba(255,255,255,0.04);
    --sctext: #f1f5f9;
    --scmuted: #94a3b8;
    --scsub: #64748b;
    --scborder: rgba(255,255,255,0.08);
    --scprimary: #60A5FA;
    --scprimary-dim: rgba(96,165,250,0.12);
    --schover: rgba(255,255,255,0.06);
}
.sc-form-page {
    padding: 24px 28px;
    height: 100%;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    color: var(--sctext);
    max-width: 1200px;
}

/* Back link */
.sc-back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: var(--scmuted);
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    margin-bottom: 20px;
    padding: 6px 14px;
    border-radius: 8px;
    background: var(--scrd);
    border: 1px solid var(--scborder);
    transition: all 0.2s ease;
}
.sc-back-link:hover { color: var(--sctext); background: var(--schover); gap: 8px; }

/* Header */
.sc-form-header {
    background: var(--scrd);
    border: 1px solid var(--scborder);
    border-radius: 14px;
    padding: 18px 22px;
    backdrop-filter: blur(8px);
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
}
.sc-form-header-left { display: flex; align-items: center; gap: 14px; }
.sc-form-header-icon {
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, rgba(96,165,250,0.15), rgba(96,165,250,0.05));
    border: 1px solid rgba(96,165,250,0.12);
    border-radius: 12px;
    font-size: 20px;
    color: var(--scprimary);
    flex-shrink: 0;
}
.sc-form-title { font-size: 18px; font-weight: 700; margin: 0 0 2px 0; }
.sc-form-sub { font-size: 13px; color: var(--scmuted); margin: 0; }

/* Grid layout */
.sc-form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

/* Cards */
.sc-form-card {
    background: var(--scrd);
    border: 1px solid var(--scborder);
    border-radius: 14px;
    overflow: hidden;
    backdrop-filter: blur(8px);
    margin-bottom: 20px;
}
.sc-form-card-hd {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 14px 20px;
    background: linear-gradient(135deg, rgba(96,165,250,0.08), rgba(96,165,250,0.02));
    border-bottom: 1px solid var(--scborder);
    font-size: 13px;
    font-weight: 600;
    color: var(--scprimary);
    text-transform: uppercase;
    letter-spacing: 0.4px;
}
.sc-form-card-hd i { font-size: 15px; }
.sc-form-card-bd { padding: 20px; }

/* Form groups */
.sc-fg { margin-bottom: 16px; }
.sc-fg:last-child { margin-bottom: 0; }
.sc-label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: var(--scmuted);
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}
.sc-req { color: #ef4444; }
.sc-input {
    width: 100%;
    padding: 10px 14px;
    font-size: 14px;
    background: rgba(10,10,10,0.6);
    border: 1px solid var(--scborder);
    border-radius: 8px;
    color: var(--sctext);
    transition: all 0.2s;
    box-sizing: border-box;
    font-family: inherit;
    outline: none;
}
.sc-input:focus { border-color: var(--scprimary); box-shadow: 0 0 0 3px rgba(96,165,250,0.12); }
.sc-input-mono { font-family: 'JetBrains Mono', 'SF Mono', monospace; font-size: 13px; }
.sc-textarea { resize: vertical; min-height: 80px; line-height: 1.6; }
.sc-code-area {
    min-height: 280px;
    font-family: 'JetBrains Mono', 'Fira Code', monospace;
    font-size: 13px;
    line-height: 1.7;
    border-radius: 0 0 8px 8px;
    border-top: none;
    tab-size: 4;
    white-space: pre;
    resize: vertical;
}
.sc-hint { display: block; font-size: 11px; color: var(--scsub); margin-top: 4px; }
.sc-err { display: block; font-size: 12px; color: #ef4444; margin-top: 4px; }

/* Inline group */
.sc-inline-group { display: flex; gap: 12px; }

/* Slug generator */
.sc-slug-gen {
    position: absolute;
    right: 6px;
    top: 50%;
    transform: translateY(-50%);
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--scprimary-dim);
    border: 1px solid rgba(96,165,250,0.15);
    border-radius: 6px;
    color: var(--scprimary);
    cursor: pointer;
    transition: all 0.2s;
    font-size: 14px;
}
.sc-slug-gen:hover { background: rgba(96,165,250,0.2); }

/* Image upload */
.sc-img-upload {
    border: 2px dashed var(--scborder);
    border-radius: 10px;
    padding: 24px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
    position: relative;
}
.sc-img-upload:hover { border-color: var(--scprimary); background: rgba(96,165,250,0.03); }
.sc-img-preview {
    position: relative;
    display: inline-block;
}
.sc-img-preview img {
    max-height: 160px;
    border-radius: 8px;
    border: 1px solid var(--scborder);
}
.sc-img-remove {
    position: absolute;
    top: -8px;
    right: -8px;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background: #ef4444;
    color: #fff;
    border: 2px solid #0f172a;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 10px;
    transition: all 0.2s;
}
.sc-img-remove:hover { transform: scale(1.1); }
.sc-current-img {
    margin-top: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    background: rgba(16,185,129,0.08);
    border: 1px solid rgba(16,185,129,0.15);
    border-radius: 8px;
    font-size: 12px;
    color: var(--scmuted);
}

/* Toggle */
.sc-toggle {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    position: relative;
    padding: 4px 0;
    width: 100%;
}
.sc-toggle input { position: absolute; opacity: 0; width: 0; height: 0; }
.sc-toggle-slider {
    position: relative;
    width: 36px;
    height: 20px;
    background: rgba(255,255,255,0.1);
    border-radius: 10px;
    transition: all 0.3s;
    flex-shrink: 0;
}
.sc-toggle-slider::before {
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    left: 2px;
    top: 2px;
    background: #fff;
    border-radius: 50%;
    transition: all 0.3s;
}
.sc-toggle input:checked + .sc-toggle-slider {
    background: linear-gradient(135deg, #2563EB, #1E40AF);
}
.sc-toggle input:checked + .sc-toggle-slider::before {
    transform: translateX(16px);
}
.sc-toggle-label { font-size: 13px; color: var(--scmuted); }

/* Code editor */
.sc-code-editor {
    border: 1px solid var(--scborder);
    border-radius: 10px;
    overflow: hidden;
    background: rgba(10,10,10,0.6);
}
.sc-code-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 14px;
    background: linear-gradient(135deg, rgba(96,165,250,0.06), transparent);
    border-bottom: 1px solid var(--scborder);
}
.sc-code-label {
    font-size: 12px;
    font-weight: 600;
    color: var(--scmuted);
}
.sc-code-lang {
    font-size: 11px;
    color: var(--scsub);
    background: rgba(255,255,255,0.04);
    padding: 3px 10px;
    border-radius: 4px;
    font-weight: 500;
    font-family: 'JetBrains Mono', monospace;
}

/* Actions */
.sc-form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    padding: 10px 0 40px;
}
.sc-btn-cancel {
    padding: 10px 24px;
    font-size: 14px;
    font-weight: 500;
    background: rgba(255,255,255,0.04);
    border: 1px solid var(--scborder);
    border-radius: 8px;
    color: var(--scmuted);
    text-decoration: none;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.sc-btn-cancel:hover { background: rgba(255,255,255,0.08); color: var(--sctext); }
.sc-btn-submit {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 28px;
    font-size: 14px;
    font-weight: 600;
    background: linear-gradient(135deg, #2563EB, #1E40AF);
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s;
    font-family: inherit;
}
.sc-btn-submit:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 16px rgba(37,99,235,0.3);
}
.sc-btn-submit:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

@media (max-width: 992px) {
    .sc-form-page { padding: 20px 22px; }
    .sc-form-grid { grid-template-columns: 1fr; gap: 0; }
}
@media (max-width: 768px) {
    .sc-form-page { padding: 16px; }
    .sc-form-header { padding: 14px 16px; flex-direction: column; align-items: flex-start; }
    .sc-form-header-left { gap: 10px; }
    .sc-inline-group { flex-direction: column; gap: 0; }
    .sc-code-area { min-height: 200px; }
    .sc-form-card-hd { padding: 12px 16px; font-size: 12px; }
    .sc-form-card-bd { padding: 16px; }
    .sc-input { font-size: 13px; padding: 8px 12px; }
    .sc-img-upload { padding: 16px; }
}
@media (max-width: 480px) {
    .sc-form-page { padding: 10px; }
    .sc-form-card { border-radius: 12px; margin-bottom: 14px; }
    .sc-form-card-bd { padding: 12px; }
    .sc-form-header { padding: 12px 14px; border-radius: 12px; }
    .sc-form-header-icon { width: 36px; height: 36px; font-size: 16px; }
    .sc-form-title { font-size: 15px; }
    .sc-form-sub { font-size: 12px; }
    .sc-fg { margin-bottom: 12px; }
    .sc-label { font-size: 11px; }
    .sc-input { font-size: 13px; padding: 8px 10px; border-radius: 6px; }
    .sc-textarea { min-height: 60px; }
    .sc-code-area { min-height: 160px; font-size: 12px; }
    .sc-code-header { padding: 8px 12px; }
    .sc-code-label { font-size: 11px; }
    .sc-inline-group { gap: 0; }
    .sc-form-actions { flex-direction: column; padding: 12px 0 24px; }
    .sc-btn-cancel, .sc-btn-submit { width: 100%; justify-content: center; font-size: 13px; padding: 8px 20px; }
    .sc-back-link { font-size: 12px; padding: 5px 12px; margin-bottom: 14px; }
    .sc-hint { font-size: 10px; }
}
@media (max-width: 380px) {
    .sc-form-page { padding: 8px; }
    .sc-form-card-bd { padding: 10px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Show validation errors via SweetAlert
    var errEl = document.getElementById('formErrors');
    if (errEl && errEl.value) {
        try {
            var errors = JSON.parse(errEl.value);
            if (errors.length) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: errors[0],
                    background: '#1e293b',
                    color: '#f1f5f9',
                    iconColor: '#ef4444'
                });
            }
        } catch(e) {}
    }

    // Auto-slug from name
    var nameInput = document.getElementById('scName');
    var slugInput = document.getElementById('scSlug');
    var genBtn = document.getElementById('genSlug');
    var autoSlug = true;

    if (nameInput && slugInput) {
        if (slugInput.value) autoSlug = false;

        nameInput.addEventListener('input', function() {
            if (autoSlug) {
                slugInput.value = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/^-+|-+$/g, '');
            }
        });

        slugInput.addEventListener('input', function() {
            autoSlug = false;
        });

        if (genBtn) {
            genBtn.addEventListener('click', function() {
                autoSlug = true;
                slugInput.value = nameInput.value
                    .toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                slugInput.dispatchEvent(new Event('input'));
            });
        }
    }

    // Image upload preview
    var imgInput = document.getElementById('scImage');
    var uploadArea = document.getElementById('imgUploadArea');
    var placeholder = document.getElementById('imgPlaceholder');
    var preview = document.getElementById('imgPreview');
    var previewImg = document.getElementById('previewImg');
    var removeBtn = document.getElementById('removeImg');

    if (uploadArea && imgInput) {
        uploadArea.addEventListener('click', function() {
            imgInput.click();
        });

        imgInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    placeholder.style.display = 'none';
                    preview.style.display = 'inline-block';
                    previewImg.src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

        if (removeBtn) {
            removeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                imgInput.value = '';
                preview.style.display = 'none';
                placeholder.style.display = 'block';
                previewImg.src = '';
            });
        }
    }

    // Update language indicator
    var langInput = document.getElementById('scLanguage');
    var langIndicator = document.getElementById('langIndicator');
    if (langInput && langIndicator) {
        langInput.addEventListener('input', function() {
            langIndicator.innerHTML = '<i class="bi bi-circle-fill" style="font-size:6px;color:#10b981;margin-right:6px;vertical-align:middle"></i> ' + (this.value || 'N/A');
        });
    }

    // Submit button loading state
    var form = document.getElementById('sourceCodeForm');
    var submitBtn = document.getElementById('formSubmitBtn');
    if (form && submitBtn) {
        form.addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-arrow-repeat" style="animation:spin 0.8s linear infinite"></i> Saving...';
        });
    }
});


</script>

@endsection
