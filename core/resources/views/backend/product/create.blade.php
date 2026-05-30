@extends('backend.app')

@section('title', (isset($product) ? 'Edit' : 'Add') . ' Product — Admin')

@section('content')

@if ($errors->any())
    <input type="hidden" id="formErrors" value="{{ json_encode($errors->all()) }}">
@endif

<div class="prod-form-page">
    {{-- Back Link --}}
    <a href="{{ route('admin.products.index') }}" class="prod-back-link">
        <i class="bi bi-arrow-left"></i>
        Back to Products
    </a>

    {{-- Header --}}
    <div class="prod-form-header">
        <div class="prod-form-header-left">
            <div class="prod-form-header-icon">
                <i class="bi bi-box-seam"></i>
            </div>
            <div>
                <h4 class="prod-form-title">{{ isset($product) ? 'Edit Product' : 'Add New Product' }}</h4>
                <p class="prod-form-sub">{{ isset($product) ? 'Update "' . $product->name . '" details' : 'Create a new Expert Advisor product' }}</p>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <form method="POST" action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}"
          enctype="multipart/form-data" class="prod-form" id="productForm">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif

        <div class="prod-form-grid">

            {{-- LEFT COLUMN: Basic Info --}}
            <div>
                <div class="prod-form-card">
                    <div class="prod-form-card-hd">
                        <i class="bi bi-info-circle"></i>
                        <span>Basic Information</span>
                    </div>
                    <div class="prod-form-card-bd">
                        <div class="prod-fg">
                            <label class="prod-label">Product Name <span class="prod-req">*</span></label>
                            <input type="text" name="name" class="prod-input" value="{{ old('name', $product->name ?? '') }}"
                                placeholder="e.g. Dark Algo" required>
                            @error('name') <span class="prod-err">{{ $message }}</span> @enderror
                        </div>

                        <div class="prod-fg">
                            <label class="prod-label">Slug <span class="prod-req">*</span></label>
                            <div style="position:relative">
                                <input type="text" name="slug" id="prodSlug" class="prod-input prod-input-mono"
                                    value="{{ old('slug', $product->slug ?? '') }}"
                                    placeholder="e.g. dark-algo" required>
                                <button type="button" id="genSlug" class="prod-slug-gen" title="Generate from name">
                                    <i class="bi bi-arrow-repeat"></i>
                                </button>
                            </div>
                            @error('slug') <span class="prod-err">{{ $message }}</span> @enderror
                        </div>

                        <div class="prod-fg">
                            <label class="prod-label">Tagline</label>
                            <input type="text" name="tagline" class="prod-input" value="{{ old('tagline', $product->tagline ?? '') }}"
                                placeholder="e.g. EURUSD & GBPUSD Mastery">
                            @error('tagline') <span class="prod-err">{{ $message }}</span> @enderror
                        </div>

                        <div class="prod-fg">
                            <label class="prod-label">Description</label>
                            <textarea name="description" class="prod-input prod-textarea" rows="4"
                                placeholder="Full product description...">{{ old('description', $product->description ?? '') }}</textarea>
                            @error('description') <span class="prod-err">{{ $message }}</span> @enderror
                        </div>

                        <div class="prod-fg">
                            <label class="prod-label">Download Link</label>
                            <input type="url" name="download_link" class="prod-input" value="{{ old('download_link', $product->download_link ?? '') }}"
                                placeholder="e.g. https://example.com/download/product.zip">
                            <span class="prod-hint">Direct URL for users to download the product after purchase</span>
                            @error('download_link') <span class="prod-err">{{ $message }}</span> @enderror
                        </div>

                        <div class="prod-fg">
                            <label class="prod-label">Product Image</label>
                            <div class="prod-img-upload" id="imgUploadArea">
                                <input type="file" name="image" id="prodImage" accept="image/jpeg,image/png,image/webp" style="display:none">
                                <div class="prod-img-placeholder" id="imgPlaceholder">
                                    <i class="bi bi-cloud-upload" style="font-size:28px;color:var(--pprimary);margin-bottom:8px;display:block"></i>
                                    <span style="color:var(--pmuted);font-size:13px">Click to upload product image</span>
                                    <span style="color:var(--psub);font-size:11px;margin-top:4px">JPEG, PNG or WebP — Max 2MB</span>
                                </div>
                                <div class="prod-img-preview" id="imgPreview" style="display:none">
                                    <img id="previewImg" src="" alt="Preview">
                                    <button type="button" id="removeImg" class="prod-img-remove"><i class="bi bi-x-lg"></i></button>
                                </div>
                            </div>
                            @if(isset($product) && $product->image)
                                <div style="margin-top:8px;padding:10px;background:rgba(16,185,129,0.06);border:1px solid rgba(16,185,129,0.12);border-radius:8px;">
                                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px">
                                        <img src="{{ config('app.storage_url') }}{{ $product->image }}" alt="{{ $product->name }}" style="width:60px;height:60px;border-radius:6px;object-fit:cover;border:1px solid var(--pborder)">
                                        <div>
                                            <span style="font-size:12px;color:var(--pmuted);display:block">{{ basename($product->image) }}</span>
                                            <span style="font-size:11px;color:#10b981"><i class="bi bi-check-circle"></i> Uploaded</span>
                                        </div>
                                    </div>
                                    <label style="display:inline-flex;align-items:center;gap:6px;cursor:pointer;padding:4px 10px;background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.15);border-radius:6px;font-size:12px;color:#ef4444;transition:all 0.2s" onmouseover="this.style.background='rgba(239,68,68,0.15)'" onmouseout="this.style.background='rgba(239,68,68,0.08)'">
                                        <input type="checkbox" name="remove_image" value="1" style="accent-color:#ef4444">
                                        <i class="bi bi-trash"></i> Remove this image
                                    </label>
                                </div>
                            @endif
                            @error('image') <span class="prod-err">{{ $message }}</span> @enderror
                        </div>

                        <div class="prod-fg">
                            <label class="prod-label">Available / Active</label>
                            <label class="prod-toggle">
                                <input type="checkbox" name="available" value="1" {{ old('available', $product->available ?? true) ? 'checked' : '' }}>
                                <span class="prod-toggle-slider"></span>
                                <span class="prod-toggle-label">Product is visible on the frontend</span>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- HERO SECTION --}}
                <div class="prod-form-card">
                    <div class="prod-form-card-hd">
                        <i class="bi bi-megaphone"></i>
                        <span>Hero Section</span>
                    </div>
                    <div class="prod-form-card-bd">
                        <div class="prod-fg">
                            <label class="prod-label">Hero Tagline</label>
                            <input type="text" name="hero_tagline" class="prod-input" value="{{ old('hero_tagline', $product->hero_tagline ?? '') }}"
                                placeholder="e.g. Precision Scalping at Your Fingertips">
                            @error('hero_tagline') <span class="prod-err">{{ $message }}</span> @enderror
                        </div>
                        <div class="prod-fg">
                            <label class="prod-label">Hero Description</label>
                            <textarea name="hero_description" class="prod-input prod-textarea" rows="3"
                                placeholder="Hero section description...">{{ old('hero_description', $product->hero_description ?? '') }}</textarea>
                            @error('hero_description') <span class="prod-err">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT COLUMN: Trading Details & Features --}}
            <div>
                {{-- TRADING DETAILS --}}
                <div class="prod-form-card">
                    <div class="prod-form-card-hd">
                        <i class="bi bi-bar-chart"></i>
                        <span>Trading Details</span>
                    </div>
                    <div class="prod-form-card-bd">
                        <div class="prod-fg">
                            <label class="prod-label">Indicator</label>
                            <input type="text" name="indicator" class="prod-input" value="{{ old('indicator', $product->indicator ?? '') }}"
                                placeholder="e.g. Stochastic Indicator">
                            @error('indicator') <span class="prod-err">{{ $message }}</span> @enderror
                        </div>
                        <div class="prod-fg">
                            <label class="prod-label">Trading Pairs</label>
                            <input type="text" name="pairs" class="prod-input" value="{{ old('pairs', isset($product) && $product->pairs ? implode(', ', $product->pairs) : '') }}"
                                placeholder="e.g. EURUSD, GBPUSD">
                            <span class="prod-hint">Comma-separated list of currency pairs</span>
                            @error('pairs') <span class="prod-err">{{ $message }}</span> @enderror
                        </div>
                        <div class="prod-inline-group">
                            <div class="prod-fg" style="flex:1">
                                <label class="prod-label">Reviews Count</label>
                                <input type="number" name="reviews" class="prod-input" value="{{ old('reviews', $product->reviews ?? 0) }}" min="0">
                                @error('reviews') <span class="prod-err">{{ $message }}</span> @enderror
                            </div>
                            <div class="prod-fg" style="flex:1">
                                <label class="prod-label">Live Signal (Years)</label>
                                <input type="number" name="live_signal_years" class="prod-input" value="{{ old('live_signal_years', $product->live_signal_years ?? 0) }}"
                                    min="0" max="99.9" step="0.1">
                                @error('live_signal_years') <span class="prod-err">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FEATURES --}}
                <div class="prod-form-card">
                    <div class="prod-form-card-hd">
                        <i class="bi bi-stars"></i>
                        <span>Features (3)</span>
                    </div>
                    <div class="prod-form-card-bd">
                        @php
                            $features = old('features', $product->features ?? [
                                ['tagline' => '', 'title' => '', 'text' => ''],
                                ['tagline' => '', 'title' => '', 'text' => ''],
                                ['tagline' => '', 'title' => '', 'text' => ''],
                            ]);
                        @endphp
                        @foreach($features as $i => $feature)
                            <div class="prod-sub-section {{ $loop->last ? '' : 'prod-sub-border' }}">
                                <div style="display:flex;align-items:center;gap:8px;margin-bottom:12px">
                                    <span class="prod-sub-num">{{ $i + 1 }}</span>
                                    <span style="font-size:13px;font-weight:600;color:var(--ptext)">Feature {{ $i + 1 }}</span>
                                </div>
                                <div class="prod-fg">
                                    <label class="prod-label">Tagline</label>
                                    <input type="text" name="features[{{ $i }}][tagline]" class="prod-input"
                                        value="{{ $feature['tagline'] ?? '' }}"
                                        placeholder="e.g. Advanced Signal Detection">
                                </div>
                                <div class="prod-fg">
                                    <label class="prod-label">Title</label>
                                    <input type="text" name="features[{{ $i }}][title]" class="prod-input"
                                        value="{{ $feature['title'] ?? '' }}"
                                        placeholder="e.g. Optimize Your Trades Accuracy">
                                </div>
                                <div class="prod-fg">
                                    <label class="prod-label">Text</label>
                                    <textarea name="features[{{ $i }}][text]" class="prod-input prod-textarea" rows="3"
                                        placeholder="Feature description...">{{ $feature['text'] ?? '' }}</textarea>
                                </div>
                                {{-- Feature Image --}}
                                <div class="prod-fg">
                                    <label class="prod-label">Feature Image {{ $i + 1 }}</label>
                                    <div class="prod-feat-img-upload" id="featImgUpload{{ $i }}">
                                        <input type="file" name="feature_image_{{ $i + 1 }}" id="featImage{{ $i }}" accept="image/jpeg,image/png,image/webp" style="display:none">
                                        <div class="prod-img-placeholder" id="featImgPlaceholder{{ $i }}">
                                            <i class="bi bi-image" style="font-size:22px;color:var(--pprimary);margin-bottom:6px;display:block"></i>
                                            <span style="color:var(--pmuted);font-size:12px">Upload image for this feature</span>
                                        </div>
                                        <div class="prod-img-preview" id="featImgPreview{{ $i }}" style="display:none">
                                            <img id="featPreviewImg{{ $i }}" src="" alt="Feature {{ $i + 1 }}">
                                            <button type="button" class="prod-img-remove feat-remove" data-feat="{{ $i }}"><i class="bi bi-x-lg"></i></button>
                                        </div>
                                    </div>
                                    @if(isset($product) && $product->{'feature_image_' . ($i + 1)})
                                        <div style="margin-top:6px;padding:8px;background:rgba(16,185,129,0.06);border:1px solid rgba(16,185,129,0.12);border-radius:6px;">
                                            <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px">
                                                <img src="{{ config('app.storage_url') }}{{ $product->{'feature_image_' . ($i + 1)} }}" alt="Feature {{ $i + 1 }}" style="width:50px;height:50px;border-radius:4px;object-fit:cover;border:1px solid var(--pborder)">
                                                <span style="font-size:11px;color:var(--pmuted)">{{ basename($product->{'feature_image_' . ($i + 1)}) }}</span>
                                            </div>
                                            <label style="display:inline-flex;align-items:center;gap:5px;cursor:pointer;padding:3px 8px;background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.15);border-radius:5px;font-size:11px;color:#ef4444;transition:all 0.2s" onmouseover="this.style.background='rgba(239,68,68,0.15)'" onmouseout="this.style.background='rgba(239,68,68,0.08)'">
                                                <input type="checkbox" name="remove_feature_image_{{ $i + 1 }}" value="1" style="accent-color:#ef4444">
                                                <i class="bi bi-trash"></i> Remove
                                            </label>
                                        </div>
                                    @endif
                                    @error('feature_image_' . ($i + 1)) <span class="prod-err">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- PRICING PLANS --}}
        <div class="prod-form-card" style="margin-top:20px">
            <div class="prod-form-card-hd">
                <i class="bi bi-currency-dollar"></i>
                <span>Pricing Plans</span>
            </div>
            <div class="prod-form-card-bd">
                @php
                    $plans = old('plans', $product->plans ?? [
                        ['name' => '', 'price' => '', 'old_price' => '', 'licenses' => 5, 'vps' => '1 Month', 'features' => '', 'popular' => false],
                        ['name' => '', 'price' => '', 'old_price' => '', 'licenses' => 10, 'vps' => '3 Months', 'features' => '', 'popular' => false],
                        ['name' => '', 'price' => '', 'old_price' => '', 'licenses' => '', 'vps' => 'Lifetime', 'features' => '', 'popular' => false],
                    ]);
                @endphp
                <div class="prod-plans-grid">
                    @foreach($plans as $i => $plan)
                        <div class="prod-plan-card {{ (isset($plan['popular']) && $plan['popular']) ? 'prod-plan-popular' : '' }}" id="planCard{{ $i }}">
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
                                <div style="display:flex;align-items:center;gap:8px">
                                    <span class="prod-sub-num">{{ $i + 1 }}</span>
                                    <span style="font-size:14px;font-weight:600;color:var(--ptext)">Plan {{ $i + 1 }}</span>
                                </div>
                                <label class="prod-toggle" style="margin:0">
                                    <input type="checkbox" name="plans[{{ $i }}][popular]" value="1"
                                        {{ (isset($plan['popular']) && $plan['popular']) ? 'checked' : '' }}
                                        onchange="document.getElementById('planCard{{ $i }}').classList.toggle('prod-plan-popular', this.checked)">
                                    <span class="prod-toggle-slider" style="width:28px;height:16px"></span>
                                    <span class="prod-toggle-label" style="font-size:12px">Popular</span>
                                </label>
                            </div>
                            <div class="prod-inline-group">
                                <div class="prod-fg" style="flex:2">
                                    <label class="prod-label">Plan Name</label>
                                    <input type="text" name="plans[{{ $i }}][name]" class="prod-input"
                                        value="{{ $plan['name'] ?? '' }}"
                                        placeholder="e.g. Dark Algo">
                                </div>
                                <div class="prod-fg" style="flex:1">
                                    <label class="prod-label">Price ($)</label>
                                    <input type="number" name="plans[{{ $i }}][price]" class="prod-input"
                                        value="{{ $plan['price'] ?? '' }}" min="0" step="0.01"
                                        placeholder="399">
                                </div>
                                <div class="prod-fg" style="flex:1">
                                    <label class="prod-label">Old Price ($)</label>
                                    <input type="number" name="plans[{{ $i }}][old_price]" class="prod-input"
                                        value="{{ $plan['old_price'] ?? '' }}" min="0" step="0.01"
                                        placeholder="599">
                                    <span class="prod-hint">Original price (shown with strikethrough)</span>
                                </div>
                            </div>
                            <div class="prod-inline-group">
                                <div class="prod-fg" style="flex:1">
                                    <label class="prod-label">Licenses</label>
                                    <input type="number" name="plans[{{ $i }}][licenses]" class="prod-input"
                                        value="{{ $plan['licenses'] ?? 5 }}" min="0">
                                </div>
                                <div class="prod-fg" style="flex:1">
                                    <label class="prod-label">Validity</label>
                                    <input type="text" name="plans[{{ $i }}][vps]" class="prod-input"
                                        value="{{ $plan['vps'] ?? '' }}"
                                        placeholder="e.g. 1 Month">
                                </div>
                            </div>
                            <div class="prod-fg">
                                <label class="prod-label">Features</label>
                                <textarea name="plans[{{ $i }}][features]" class="prod-input prod-textarea" rows="3"
                                    placeholder="Comma-separated list of features&#10;e.g. 5 Flexible Licenses, MT4 & MT5, Free Updates">{{ isset($plan['features']) && is_array($plan['features']) ? implode(', ', $plan['features']) : ($plan['features'] ?? '') }}</textarea>
                                <span class="prod-hint">Comma-separated list of plan features</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <div class="prod-form-actions">
            <a href="{{ route('admin.products.index') }}" class="prod-btn-cancel">Cancel</a>
            <button type="submit" class="prod-btn-submit" id="formSubmitBtn">
                <i class="bi bi-check-lg"></i>
                {{ isset($product) ? 'Update Product' : 'Create Product' }}
            </button>
        </div>
    </form>
</div>

<style>
:root {
    --pbg: #0f172a;
    --prd: rgba(255,255,255,0.04);
    --ptext: #f1f5f9;
    --pmuted: #94a3b8;
    --psub: #64748b;
    --pborder: rgba(255,255,255,0.08);
    --pprimary: #60A5FA;
    --pprimary-dim: rgba(96,165,250,0.12);
    --phover: rgba(255,255,255,0.06);
}
.prod-form-page {
    padding: 24px 28px; height: 100%;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    color: var(--ptext); max-width: 1200px;
}

/* Back link */
.prod-back-link {
    display: inline-flex; align-items: center; gap: 6px;
    color: var(--pmuted); font-size: 14px; font-weight: 500;
    text-decoration: none; margin-bottom: 20px;
    padding: 6px 14px; border-radius: 8px;
    background: var(--prd); border: 1px solid var(--pborder);
    transition: all 0.2s ease;
}
.prod-back-link:hover { color: var(--ptext); background: var(--phover); gap: 8px; }

/* Header */
.prod-form-header {
    background: var(--prd); border: 1px solid var(--pborder);
    border-radius: 14px; padding: 18px 22px;
    backdrop-filter: blur(8px); margin-bottom: 20px;
    display: flex; justify-content: space-between; align-items: center; gap: 16px;
}
.prod-form-header-left { display: flex; align-items: center; gap: 14px; }
.prod-form-header-icon {
    width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, rgba(96,165,250,0.15), rgba(96,165,250,0.05));
    border: 1px solid rgba(96,165,250,0.12); border-radius: 12px;
    font-size: 20px; color: var(--pprimary); flex-shrink: 0;
}
.prod-form-title { font-size: 18px; font-weight: 700; margin: 0 0 2px 0; }
.prod-form-sub { font-size: 13px; color: var(--pmuted); margin: 0; }

/* Grid layout */
.prod-form-grid {
    display: grid; grid-template-columns: 1fr 1fr; gap: 20px;
}

/* Cards */
.prod-form-card {
    background: var(--prd); border: 1px solid var(--pborder);
    border-radius: 14px; overflow: hidden; backdrop-filter: blur(8px);
    margin-bottom: 20px;
}
.prod-form-card-hd {
    display: flex; align-items: center; gap: 8px;
    padding: 14px 20px;
    background: linear-gradient(135deg, rgba(96,165,250,0.08), rgba(96,165,250,0.02));
    border-bottom: 1px solid var(--pborder);
    font-size: 13px; font-weight: 600; color: var(--pprimary);
    text-transform: uppercase; letter-spacing: 0.4px;
}
.prod-form-card-hd i { font-size: 15px; }
.prod-form-card-bd { padding: 20px; }

/* Form groups */
.prod-fg { margin-bottom: 16px; }
.prod-fg:last-child { margin-bottom: 0; }
.prod-label {
    display: block; font-size: 12px; font-weight: 600;
    color: var(--pmuted); margin-bottom: 6px;
    text-transform: uppercase; letter-spacing: 0.3px;
}
.prod-req { color: #ef4444; }
.prod-input {
    width: 100%; padding: 10px 14px; font-size: 14px;
    background: rgba(10,10,10,0.6); border: 1px solid var(--pborder);
    border-radius: 8px; color: var(--ptext); transition: all 0.2s;
    box-sizing: border-box; font-family: inherit; outline: none;
}
.prod-input:focus { border-color: var(--pprimary); box-shadow: 0 0 0 3px rgba(96,165,250,0.12); }
.prod-input-mono { font-family: 'JetBrains Mono', 'SF Mono', monospace; font-size: 13px; }
.prod-textarea { resize: vertical; min-height: 80px; line-height: 1.6; }
.prod-hint { display: block; font-size: 11px; color: var(--psub); margin-top: 4px; }
.prod-err { display: block; font-size: 12px; color: #ef4444; margin-top: 4px; }

/* Inline group */
.prod-inline-group { display: flex; gap: 12px; }

/* Slug generator */
.prod-slug-gen {
    position: absolute; right: 6px; top: 50%; transform: translateY(-50%);
    width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;
    background: var(--pprimary-dim); border: 1px solid rgba(96,165,250,0.15);
    border-radius: 6px; color: var(--pprimary); cursor: pointer;
    transition: all 0.2s; font-size: 14px;
}
.prod-slug-gen:hover { background: rgba(96,165,250,0.2); }

/* Image upload */
.prod-img-upload, .prod-feat-img-upload {
    border: 2px dashed var(--pborder); border-radius: 10px;
    padding: 24px; text-align: center; cursor: pointer;
    transition: all 0.2s; position: relative;
}
.prod-img-upload:hover, .prod-feat-img-upload:hover { border-color: var(--pprimary); background: rgba(96,165,250,0.03); }
.prod-feat-img-upload { padding: 16px; min-height: 80px; display: flex; align-items: center; justify-content: center; }
.prod-img-preview {
    position: relative; display: inline-block;
}
.prod-img-preview img {
    max-height: 120px; border-radius: 8px; border: 1px solid var(--pborder);
}
.prod-img-remove {
    position: absolute; top: -8px; right: -8px;
    width: 26px; height: 26px; border-radius: 50%;
    background: #ef4444; color: #fff; border: 2px solid #0f172a;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; font-size: 10px; transition: all 0.2s;
}
.prod-img-remove:hover { transform: scale(1.1); }

/* Toggle */
.prod-toggle {
    display: inline-flex; align-items: center; gap: 10px; cursor: pointer;
    position: relative; padding: 4px 0;
}
.prod-toggle input { position: absolute; opacity: 0; width: 0; height: 0; }
.prod-toggle-slider {
    position: relative; width: 36px; height: 20px;
    background: rgba(255,255,255,0.1); border-radius: 10px;
    transition: all 0.3s; flex-shrink: 0;
}
.prod-toggle-slider::before {
    content: ''; position: absolute; width: 16px; height: 16px;
    left: 2px; top: 2px; background: #fff;
    border-radius: 50%; transition: all 0.3s;
}
.prod-toggle input:checked + .prod-toggle-slider {
    background: linear-gradient(135deg, #2563EB, #1E40AF);
}
.prod-toggle input:checked + .prod-toggle-slider::before {
    transform: translateX(16px);
}
.prod-toggle-label { font-size: 13px; color: var(--pmuted); }

/* Sub sections */
.prod-sub-section { margin-bottom: 20px; }
.prod-sub-border { padding-bottom: 20px; border-bottom: 1px solid var(--pborder); }
.prod-sub-num {
    width: 24px; height: 24px; border-radius: 50%;
    background: var(--pprimary-dim); color: var(--pprimary);
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 700; flex-shrink: 0;
}

/* Plans grid */
.prod-plans-grid {
    display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 16px;
}
.prod-plan-card {
    background: rgba(10,10,10,0.4); border: 1px solid var(--pborder);
    border-radius: 12px; padding: 20px; transition: all 0.3s;
}
.prod-plan-popular {
    border-color: var(--pprimary);
    box-shadow: 0 0 20px rgba(96,165,250,0.08);
}

/* Actions */
.prod-form-actions {
    display: flex; justify-content: flex-end; gap: 12px;
    padding: 20px 0 40px;
}
.prod-btn-cancel {
    padding: 10px 24px; font-size: 14px; font-weight: 500;
    background: rgba(255,255,255,0.04); border: 1px solid var(--pborder);
    border-radius: 8px; color: var(--pmuted); text-decoration: none;
    transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px;
}
.prod-btn-cancel:hover { background: rgba(255,255,255,0.08); color: var(--ptext); }
.prod-btn-submit {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 10px 28px; font-size: 14px; font-weight: 600;
    background: linear-gradient(135deg, #2563EB, #1E40AF);
    color: #fff; border: none; border-radius: 8px; cursor: pointer;
    transition: all 0.3s; font-family: inherit;
}
.prod-btn-submit:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 16px rgba(37,99,235,0.3);
}
.prod-btn-submit:disabled {
    opacity: 0.5; cursor: not-allowed; transform: none; box-shadow: none;
}

@media (max-width: 992px) {
    .prod-form-page { padding: 20px 22px; }
    .prod-form-grid { grid-template-columns: 1fr; gap: 0; }
    .prod-plans-grid { grid-template-columns: 1fr; }
}
@media (max-width: 768px) {
    .prod-form-page { padding: 16px; }
    .prod-form-header { padding: 14px 16px; flex-direction: column; align-items: flex-start; }
    .prod-form-header-left { gap: 10px; }
    .prod-inline-group { flex-direction: column; gap: 0; }
    .prod-plans-grid { grid-template-columns: 1fr; }
    .prod-form-card-hd { padding: 12px 16px; font-size: 12px; }
    .prod-form-card-bd { padding: 16px; }
    .prod-input { font-size: 13px; padding: 8px 12px; }
    .prod-img-upload { padding: 16px; }
}
@media (max-width: 480px) {
    .prod-form-page { padding: 10px; }
    .prod-form-card { border-radius: 12px; margin-bottom: 14px; }
    .prod-form-card-bd { padding: 12px; }
    .prod-form-header { padding: 12px 14px; border-radius: 12px; }
    .prod-form-header-icon { width: 36px; height: 36px; font-size: 16px; }
    .prod-form-title { font-size: 15px; }
    .prod-form-sub { font-size: 12px; }
    .prod-fg { margin-bottom: 12px; }
    .prod-label { font-size: 11px; }
    .prod-input { font-size: 13px; padding: 8px 10px; border-radius: 6px; }
    .prod-textarea { min-height: 60px; }
    .prod-inline-group { gap: 0; }
    .prod-form-actions { flex-direction: column; padding: 12px 0 24px; }
    .prod-btn-cancel, .prod-btn-submit { width: 100%; justify-content: center; font-size: 13px; padding: 8px 20px; }
    .prod-back-link { font-size: 12px; padding: 5px 12px; margin-bottom: 14px; }
    .prod-sub-section { margin-bottom: 14px; }
    .prod-sub-border { padding-bottom: 14px; }
    .prod-sub-num { width: 20px; height: 20px; font-size: 10px; }
    .prod-plan-card { padding: 14px; }
    .prod-hint { font-size: 10px; }
}
@media (max-width: 380px) {
    .prod-form-page { padding: 8px; }
    .prod-form-card-bd { padding: 10px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Show validation errors
    var errEl = document.getElementById('formErrors');
    if (errEl && errEl.value) {
        try {
            var errors = JSON.parse(errEl.value);
            if (errors.length) {
                Swal.fire({
                    icon: 'error', title: 'Validation Error',
                    text: errors[0],
                    background: '#1e293b', color: '#f1f5f9',
                    iconColor: '#ef4444'
                });
            }
        } catch(e) {}
    }

    // Slug auto-generation
    var nameInput = document.querySelector('input[name="name"]');
    var slugInput = document.getElementById('prodSlug');
    var genBtn = document.getElementById('genSlug');
    var autoSlug = true;

    if (nameInput && slugInput) {
        // Only auto-generate if slug is empty
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
                // Trigger input event to update any listeners
                slugInput.dispatchEvent(new Event('input'));
            });
        }
    }

    function setupFeatImgUpload(idx) {
        var input = document.getElementById('featImage' + idx);
        var area = document.getElementById('featImgUpload' + idx);
        var placeholder = document.getElementById('featImgPlaceholder' + idx);
        var preview = document.getElementById('featImgPreview' + idx);
        var previewImg = document.getElementById('featPreviewImg' + idx);

        if (area && input) {
            area.addEventListener('click', function() { input.click(); });

            input.addEventListener('change', function() {
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

            // Remove button click handler
            var removeBtns = area.querySelectorAll('.feat-remove');
            removeBtns.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    input.value = '';
                    preview.style.display = 'none';
                    placeholder.style.display = 'block';
                    previewImg.src = '';
                });
            });
        }
    }

    // Setup feature image uploads for all 3 features
    for (var fi = 0; fi < 3; fi++) { setupFeatImgUpload(fi); }

    // Main image upload preview
    var imgInput = document.getElementById('prodImage');
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

    // Form submit loading state
    var form = document.getElementById('productForm');
    var submitBtn = document.getElementById('formSubmitBtn');
    if (form && submitBtn) {
        form.addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-arrow-repeat" style="animation:spin 0.8s linear infinite"></i> Saving...';
        });
    }
});
</script>

<style>
@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
</style>

@endsection
