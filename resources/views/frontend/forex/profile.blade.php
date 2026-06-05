@extends('frontend.forex.layouts.app')

@section('title', 'My Profile — SMART BINARY ZONE')

@section('content')
<style>
.profile-page{min-height:100vh;padding-top:6rem;padding-bottom:4rem;position:relative;overflow:hidden}
.profile-inner{max-width:40rem;margin:0 auto;padding:0 1rem;position:relative;z-index:10}
@media (min-width:640px){.profile-inner{padding:0 1.5rem}}
@media (min-width:1024px){.profile-inner{padding:0 2rem}}
.profile-header{margin-bottom:2.5rem;text-align:center}
.profile-avatar-wrap{width:5rem;height:5rem;border-radius:1rem;background:linear-gradient(135deg,#00c8ff,#00c8ff);display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;box-shadow:0 8px 32px rgba(0,200,255,0.2);position:relative}
.profile-avatar-text{color:#05050f;font-size:2rem;font-weight:800;font-family:'DM Sans',sans-serif}
.profile-form-group{margin-bottom:1.5rem}
.profile-form-label{display:block;color:rgba(234,234,234,0.6);font-size:0.8125rem;font-weight:600;margin-bottom:0.5rem;text-transform:uppercase;letter-spacing:0.5px}
.profile-input{width:100%;padding:0.875rem 1rem;background:rgba(5,5,15,0.6);border:1px solid rgba(255,255,255,0.08);border-radius:0.75rem;color:#EAEAEA;font-size:0.9375rem;font-family:'DM Sans',sans-serif;transition:all 0.3s ease;outline:none;box-sizing:border-box}
.profile-input:focus{border-color:#00c8ff;box-shadow:0 0 0 3px rgba(0,200,255,0.12)}
.profile-input::placeholder{color:rgba(234,234,234,0.2)}
.profile-input.error{border-color:rgba(239,68,68,0.4);box-shadow:0 0 0 3px rgba(239,68,68,0.08)}
.profile-error-text{color:#ef4444;font-size:0.75rem;margin-top:0.375rem;display:none}
.profile-divider{height:1px;background:rgba(255,255,255,0.06);margin:2rem 0}
.profile-section-title{color:#EAEAEA;font-size:0.9375rem;font-weight:600;margin-bottom:0.25rem}
.profile-section-desc{color:rgba(234,234,234,0.35);font-size:0.8125rem;margin-bottom:1.5rem}
.profile-submit-btn{width:100%;padding:0.875rem 1.5rem;background:linear-gradient(135deg,#00c8ff,#0099ff);color:#fff;font-weight:600;font-size:0.9375rem;border:none;border-radius:0.75rem;cursor:pointer;transition:all 0.3s ease;font-family:'DM Sans',sans-serif;display:flex;align-items:center;justify-content:center;gap:0.5rem;box-sizing:border-box}
.profile-submit-btn:hover{transform:translateY(-2px);box-shadow:0 8px 30px rgba(0,200,255,0.25)}
.profile-submit-btn:disabled{opacity:0.5;cursor:not-allowed;transform:none}
.profile-submit-btn .spinner{display:none;width:1rem;height:1rem;border:2px solid rgba(255,255,255,0.3);border-top-color:#fff;border-radius:50%;animation:spin 0.6s linear infinite}
@keyframes spin{to{transform:rotate(360deg)}}
.profile-submit-btn.loading .spinner{display:inline-block}
.profile-submit-btn.loading .btn-text{display:none}
.profile-info-card{display:flex;align-items:center;gap:0.75rem;padding:0.875rem 1rem;background:rgba(0,200,255,0.06);border:1px solid rgba(0,200,255,0.12);border-radius:0.75rem;margin-bottom:2rem}
.profile-info-icon{width:1.25rem;height:1.25rem;color:#00c8ff;flex-shrink:0}
.profile-info-text{color:rgba(234,234,234,0.5);font-size:0.8125rem;line-height:1.5}
.profile-password-hint{color:rgba(234,234,234,0.25);font-size:0.75rem;margin-top:0.375rem}
</style>

<section class="profile-page">
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="grid-bg" style="position:absolute;inset:0;opacity:0.3;pointer-events:none"></div>

    <div class="profile-inner">
        <!-- Header -->
        <div class="profile-header reveal">
            <div class="profile-avatar-wrap">
                <span class="profile-avatar-text">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
            </div>
            <div class="badge" style="justify-content:center">
                <span class="badge-dot"></span>
                Account Settings
            </div>
            <h1 class="section-title">My <span class="gradient-text">Profile</span></h1>
            <p class="section-subtitle">Manage your account name and password</p>
        </div>

        <!-- Info Card -->
        <div class="reveal" style="transition-delay:0.05s">
            <div class="profile-info-card">
                <svg class="profile-info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="profile-info-text">Your email ({{ $user->email }}) is used for login and cannot be changed here. You can update your display name and password below.</span>
            </div>
        </div>

        <!-- Profile Form -->
        <form id="profileForm" class="reveal" style="transition-delay:0.1s">
            @csrf

            <!-- Name -->
            <div class="profile-form-group">
                <label class="profile-form-label" for="name">Display Name</label>
                <input type="text" id="name" name="name" class="profile-input" value="{{ old('name', $user->name) }}" placeholder="Your full name" required>
                <div id="nameError" class="profile-error-text"></div>
            </div>

            <!-- Email (Read-only) -->
            <div class="profile-form-group">
                <label class="profile-form-label" for="email">Email Address</label>
                <input type="email" id="email" class="profile-input" value="{{ $user->email }}" disabled style="opacity:0.5;cursor:not-allowed">
            </div>

            <div class="profile-divider"></div>

            <!-- Password Section -->
            <div class="profile-section-title">Change Password</div>
            <div class="profile-section-desc">Leave blank to keep your current password</div>

            <!-- Current Password -->
            <div class="profile-form-group">
                <label class="profile-form-label" for="current_password">Current Password</label>
                <input type="password" id="current_password" name="current_password" class="profile-input" placeholder="Enter current password" autocomplete="current-password">
                <div id="currentPasswordError" class="profile-error-text"></div>
            </div>

            <!-- New Password -->
            <div class="profile-form-group">
                <label class="profile-form-label" for="password">New Password</label>
                <input type="password" id="password" name="password" class="profile-input" placeholder="Enter new password" autocomplete="new-password">
                <div id="passwordError" class="profile-error-text"></div>
                <div class="profile-password-hint">Minimum 8 characters with at least one letter and one number</div>
            </div>

            <!-- Confirm New Password -->
            <div class="profile-form-group">
                <label class="profile-form-label" for="password_confirmation">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="profile-input" placeholder="Confirm new password" autocomplete="new-password">
                <div id="passwordConfirmationError" class="profile-error-text"></div>
            </div>

            <!-- Submit -->
            <button type="submit" id="profileSubmitBtn" class="profile-submit-btn">
                <span class="spinner"></span>
                <span class="btn-text">
                    <svg style="width:1rem;height:1rem;display:inline;margin-right:0.25rem;vertical-align:middle" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Save Changes
                </span>
            </button>
        </form>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('profileForm');
    const submitBtn = document.getElementById('profileSubmitBtn');

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Clear previous errors
            document.querySelectorAll('.profile-error-text').forEach(function(el) {
                el.style.display = 'none';
            });
            document.querySelectorAll('.profile-input.error').forEach(function(el) {
                el.classList.remove('error');
            });

            // Basic client-side validation
            const name = document.getElementById('name').value.trim();
            if (!name) {
                const nameError = document.getElementById('nameError');
                nameError.textContent = 'Name is required.';
                nameError.style.display = 'block';
                document.getElementById('name').classList.add('error');
                return;
            }

            const currentPwd = document.getElementById('current_password').value;
            const newPwd = document.getElementById('password').value;
            const confirmPwd = document.getElementById('password_confirmation').value;

            if (newPwd || currentPwd || confirmPwd) {
                if (!currentPwd) {
                    const err = document.getElementById('currentPasswordError');
                    err.textContent = 'Current password is required to set a new password.';
                    err.style.display = 'block';
                    document.getElementById('current_password').classList.add('error');
                    return;
                }
                if (newPwd.length < 8) {
                    const err = document.getElementById('passwordError');
                    err.textContent = 'New password must be at least 8 characters.';
                    err.style.display = 'block';
                    document.getElementById('password').classList.add('error');
                    return;
                }
                if (newPwd !== confirmPwd) {
                    const err = document.getElementById('passwordConfirmationError');
                    err.textContent = 'Passwords do not match.';
                    err.style.display = 'block';
                    document.getElementById('password_confirmation').classList.add('error');
                    return;
                }
            }

            // Submit
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;

            fetch('{{ route('forex.profile.update') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    name: name,
                    current_password: currentPwd,
                    password: newPwd,
                    password_confirmation: confirmPwd
                })
            })
            .then(function(res) { return res.json(); })
            .then(function(data) {
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;

                if (data.success) {
                    showToast(data.message, 'success');
                    // Clear password fields
                    document.getElementById('current_password').value = '';
                    document.getElementById('password').value = '';
                    document.getElementById('password_confirmation').value = '';
                } else {
                    showToast(data.message || 'An error occurred.', 'error');
                }
            })
            .catch(function() {
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
                showToast('An unexpected error occurred. Please try again.', 'error');
            });
        });
    }
});
</script>
@endsection
