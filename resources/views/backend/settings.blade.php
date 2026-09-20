@extends('backend.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid" style="height: calc(100vh - 80px); overflow-y: auto; padding-bottom: 20px;">

    <div class="row m-3 align-items-center mb-3">
        <div class="col-md-6">
            <h2 class="fw-bold mb-1">
                <i class="bi bi-gear me-2 text-primary"></i> Settings
            </h2>
            <small class="text-muted">Manage general, payment, and contact settings</small>
        </div>
    </div>

    <form action="{{ url('admin/settings') }}" method="POST">
        @csrf

        {{-- ------------------------------------------ GENERAL SETTINGS --}}
        <div class="card mx-3 mb-3 shadow-sm border-0 rounded-4">
            <div class="card-header bg-gradient-primary text-white rounded-top-4 py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-sliders me-2"></i> General Settings
                </h5>
            </div>
            <div class="card-body p-4">

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-currency-exchange me-1 text-secondary"></i>
                            Currency
                        </label>
                        <select name="currency" class="form-select">
                            <option value="BDT" {{ $settings?->currency == 'BDT' ? 'selected' : '' }}>BDT (৳)</option>
                            <option value="USD" {{ $settings?->currency == 'USD' ? 'selected' : '' }}>USD ($)</option>
                            <option value="EUR" {{ $settings?->currency == 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                            <option value="INR" {{ $settings?->currency == 'INR' ? 'selected' : '' }}>INR (₹)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-translate me-1 text-secondary"></i>
                            Language
                        </label>
                        <select name="language" class="form-select">
                            <option value="en" {{ $settings?->language == 'en' ? 'selected' : '' }}>English</option>
                            <option value="bn" {{ $settings?->language == 'bn' ? 'selected' : '' }}>Bangla</option>
                            <option value="ar" {{ $settings?->language == 'ar' ? 'selected' : '' }}>Arabic</option>
                            <option value="fr" {{ $settings?->language == 'fr' ? 'selected' : '' }}>French</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-truck me-1 text-secondary"></i>
                            Delivery Charge (Inside)
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">{{ $currency ?? '৳' }}</span>
                            <input type="number" step="1" name="delivery_charge" class="form-control" value="{{ $settings?->delivery_charge ?? 0 }}" placeholder="Inside charge">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-truck me-1 text-secondary"></i>
                            Delivery Charge (Outside)
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">{{ $currency ?? '৳' }}</span>
                            <input type="number" step="1" name="delivery_outside" class="form-control" value="{{ $settings?->delivery_outside ?? 0 }}" placeholder="Outside charge">
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-percent me-1 text-secondary"></i>
                            Tax Percentage (%)
                        </label>
                        <div class="input-group">
                            <input type="number" step="0.1" name="tax_percentage" class="form-control" value="{{ $settings?->tax_percentage ?? 0 }}" placeholder="Tax %">
                            <span class="input-group-text bg-light">%</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ------------------------------------------ PAYMENT METHODS --}}
        <div class="card mx-3 mb-3 shadow-sm border-0 rounded-4">
            <div class="card-header bg-gradient-success text-white rounded-top-4 py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-credit-card me-2"></i> Payment Methods
                </h5>
            </div>
            <div class="card-body p-4">

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-phone me-1 text-danger"></i>
                            bKash Number
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-phone"></i></span>
                            <input type="text" name="bkash_number" class="form-control" value="{{ $settings?->bkash_number }}" placeholder="Enter bKash number">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-wallet2 me-1 text-warning"></i>
                            Nagad Number
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-wallet2"></i></span>
                            <input type="text" name="nagad_number" class="form-control" value="{{ $settings?->nagad_number }}" placeholder="Enter Nagad number">
                        </div>
                    </div>
                </div>

                <p class="form-text text-muted small mb-0">
                    These numbers will be shown to customers when they pick bKash or Nagad at checkout.
                </p>

            </div>
        </div>

        {{-- ------------------------------------------ CONTACT INFO --}}
        <div class="card mx-3 mb-3 shadow-sm border-0 rounded-4">
            <div class="card-header bg-gradient-info text-white rounded-top-4 py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-telephone me-2"></i> Contact Information
                </h5>
            </div>
            <div class="card-body p-4">

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-instagram me-1 text-danger"></i>
                            Instagram
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-instagram"></i></span>
                            <input type="text" name="contact_instagram" class="form-control" value="{{ $settings?->contact_instagram }}" placeholder="@username">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-facebook me-1 text-primary"></i>
                            Facebook URL
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-facebook"></i></span>
                            <input type="text" name="contact_facebook" class="form-control" value="{{ $settings?->contact_facebook }}" placeholder="https://facebook.com/yourpage">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-phone me-1 text-success"></i>
                            Phone
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-phone"></i></span>
                            <input type="text" name="contact_phone" class="form-control" value="{{ $settings?->contact_phone }}" placeholder="+880 1XXXXXXXXX">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-envelope me-1"></i>
                            Email
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="contact_email" class="form-control" value="{{ $settings?->contact_email }}" placeholder="hello@example.com">
                        </div>
                    </div>
                </div>

                <p class="form-text text-muted small mb-0">
                    These are shown in the "Let's Connect" section on the homepage.
                </p>

            </div>
        </div>

        {{-- ------------------------------------------ SAVE BUTTON --}}
        <div class="row mx-3">
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary rounded-pill px-5">
                    <i class="bi bi-save me-1"></i> Save All Settings
                </button>
            </div>
        </div>

    </form>

</div>

<style>
.bg-gradient-primary { background: linear-gradient(45deg, #4f46e5, #6366f1); }
.bg-gradient-success { background: linear-gradient(45deg, #059669, #10b981); }
.bg-gradient-info { background: linear-gradient(45deg, #0d9488, #14b8a6); }

.card { border-radius: 14px; }
.card-header { border-radius: 14px 14px 0 0 !important; }

.form-control:focus, .form-select:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 0.15rem rgba(79,70,229,0.15);
}

.input-group-text { background: #f8f9fa; border-color: #dee2e6; }

.btn-primary { background: #4f46e5; border: none; transition: 0.2s; }
.btn-primary:hover { background: #4338ca; transform: translateY(-1px); }

/* Responsive */
@media (max-width: 991px) {
    .row.m-3 { margin: 1rem !important; }
    .card.mx-3 { margin: 0.5rem !important; }
}

@media (max-width: 767px) {
    .card-body { padding: 1.5rem; }
    h2 { font-size: 1.4rem; }
    .btn-primary { width: 100%; margin-top: 0.5rem; }
}

@media (max-width: 575px) {
    .container-fluid { padding: 0.75rem; }
}
</style>

@endsection