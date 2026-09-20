@extends('backend.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid" style="height: calc(100vh - 80px); overflow-y: auto; padding: 20px 0;">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <form action="{{ url('admin/settings') }}" method="POST">
                @csrf

            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-gear-fill me-2"></i> Settings
                    </h4>
                </div>

                <div class="card-body">

                        <div class="mb-4">
                            <label for="currency" class="form-label fw-semibold">Currency</label>
                            <select name="currency" id="currency" class="form-select">
                                <option value="BDT" {{ $settings?->currency == 'BDT' ? 'selected' : '' }}>BDT</option>
                                <option value="USD" {{ $settings?->currency == 'USD' ? 'selected' : '' }}>USD</option>
                                <option value="EUR" {{ $settings?->currency == 'EUR' ? 'selected' : '' }}>EUR</option>
                                <option value="INR" {{ $settings?->currency == 'INR' ? 'selected' : '' }}>INR</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="language" class="form-label fw-semibold">Language</label>
                            <select name="language" id="language" class="form-select">
                                <option value="en" {{ $settings?->language == 'en' ? 'selected' : '' }}>English</option>
                                <option value="bn" {{ $settings?->language == 'bn' ? 'selected' : '' }}>Bangla</option>
                                <option value="ar" {{ $settings?->language == 'ar' ? 'selected' : '' }}>Arabic</option>
                                <option value="fr" {{ $settings?->language == 'fr' ? 'selected' : '' }}>French</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold d-block">
                                <i class="bi bi-truck me-1"></i> Delivery Charge
                            </label>

                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <label for="delivery_charge" class="form-label small text-muted mb-1">Inside Khulna</label>
                                    <input type="number" step="1" name="delivery_charge" id="delivery_charge"
                                           class="form-select" value="{{ $settings?->delivery_charge ?? 0 }}"
                                           placeholder="Enter inside charge">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="delivery_outside" class="form-label small text-muted mb-1">Outside Khulna</label>
                                    <input type="number" step="1" name="delivery_outside" id="delivery_outside"
                                           class="form-select" value="{{ $settings?->delivery_outside ?? 0 }}"
                                           placeholder="Enter outside charge">
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="tax_percentage" class="form-label fw-semibold">Tax Percentage (%)</label>
                            <input type="number" step="0.1" name="tax_percentage" id="tax_percentage"
                                   class="form-select" value="{{ $settings?->tax_percentage ?? 0 }}"
                                   placeholder="Enter tax percentage">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-dark px-4">
                                <i class="bi bi-save me-1"></i> Save Settings
                            </button>
                        </div>

                </div>
            </div>

            {{-- ------------------------------------------ PAYMENT METHODS --}}
            <div class="card mt-4 shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-credit-card me-2"></i> Payment Methods
                    </h4>
                </div>

                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label for="bkash_number" class="form-label fw-semibold">
                                <i class="bi bi-phone me-1 text-danger"></i> bKash Number
                            </label>
                            <input type="text" name="bkash_number" id="bkash_number"
                                   class="form-select" value="{{ $settings?->bkash_number }}"
                                   placeholder="Enter bKash number">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="nagad_number" class="form-label fw-semibold">
                                <i class="bi bi-wallet2 me-1 text-warning"></i> Nagad Number
                            </label>
                            <input type="text" name="nagad_number" id="nagad_number"
                                   class="form-select" value="{{ $settings?->nagad_number }}"
                                   placeholder="Enter Nagad number">
                        </div>
                    </div>

                    <p class="form-text text-muted mt-3 mb-0">
                        These numbers will be shown to customers when they pick bKash or Nagad at checkout.
                    </p>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-dark px-4">
                            <i class="bi bi-save me-1"></i> Save Payment Methods
                        </button>
                    </div>
                </div>
            </div>

            {{-- ------------------------------------------ CONTACT INFO --}}
            <div class="card mt-4 shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-telephone me-2"></i> Contact Information
                    </h4>
                </div>

                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label for="contact_instagram" class="form-label fw-semibold">
                                <i class="bi bi-instagram me-1 text-danger"></i> Instagram
                            </label>
                            <input type="text" name="contact_instagram" id="contact_instagram"
                                   class="form-select" value="{{ $settings?->contact_instagram }}"
                                   placeholder="@eshas_rokomaris2">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="contact_facebook" class="form-label fw-semibold">
                                <i class="bi bi-facebook me-1 text-primary"></i> Facebook URL
                            </label>
                            <input type="text" name="contact_facebook" id="contact_facebook"
                                   class="form-select" value="{{ $settings?->contact_facebook }}"
                                   placeholder="https://facebook.com/yourpage">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="contact_phone" class="form-label fw-semibold">
                                <i class="bi bi-phone me-1 text-success"></i> Phone
                            </label>
                            <input type="text" name="contact_phone" id="contact_phone"
                                   class="form-select" value="{{ $settings?->contact_phone }}"
                                   placeholder="+880 1XXXXXXXXX">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="contact_email" class="form-label fw-semibold">
                                <i class="bi bi-envelope me-1"></i> Email
                            </label>
                            <input type="email" name="contact_email" id="contact_email"
                                   class="form-select" value="{{ $settings?->contact_email }}"
                                   placeholder="hello@example.com">
                        </div>
                    </div>

                    <p class="form-text text-muted mt-3 mb-0">
                        These are shown in the "Let's Connect" section on the homepage.
                    </p>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-dark px-4">
                            <i class="bi bi-save me-1"></i> Save Contact Info
                        </button>
                    </div>
                </div>
            </div>

            </form>

        </div>
    </div>

</div>

<style>
.card {
    border-radius: 14px;
    overflow: hidden;
    transition: all .3s ease;
}

.card:hover {
    box-shadow: 0 12px 35px rgba(0,0,0,.15);
    transform: translateY(-2px);
}

.card-header {
    padding: 18px 24px;
    letter-spacing: .5px;
}

.form-label {
    font-size: 15px;
    color: #333;
}

.form-select {
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 15px;
    border: 1px solid #ddd;
    transition: all .3s ease;
}

.form-select:focus {
    border-color: #000;
    box-shadow: 0 0 0 .15rem rgba(0,0,0,.15);
}

.btn-dark {
    border-radius: 30px;
    padding: 10px 26px;
    font-weight: 600;
    transition: all .3s ease;
}

.btn-dark:hover {
    background-color: #111;
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(0,0,0,.25);
}

.alert {
    border-radius: 12px;
    font-size: 14px;
}
</style>

@endsection