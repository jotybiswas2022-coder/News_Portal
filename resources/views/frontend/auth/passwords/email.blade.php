@extends('frontend.app')

@section('title', "Forgot Password — ESHA'S ROKOMARIS 2")
@section('body_class', 'auth-page')
@section('meta_description', 'Reset your Esha\'s Rokomaris 2 password.')

@section('content')

@if(session('status'))
    <div class="brand-container">
        <p class="notice" role="status">{{ session('status') }}</p>
    </div>
@endif

<a class="auth-back" href="{{ url('/') }}" aria-label="Back to website">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M19 12H5M11 6l-6 6 6 6"/>
    </svg>
    Back to website
</a>

{{-- ==================================================== PAGE INTRO --}}
<section class="page-head">
    <div class="brand-container">
        <span class="eyebrow">Account</span>
        <h1 class="page-head__title">Reset Password</h1>
        <p class="page-head__text">We'll send you a link to set a new password.</p>
    </div>
</section>

{{-- ======================================================== FORM --}}
<section class="section section--white">
    <div class="brand-container">
        <div class="auth-card">
            <div class="auth-brand">
                <span class="brand__mark" aria-hidden="true">ER</span>
                <span class="brand__name" style="color: inherit;">Esha's Rokomaris 2</span>
            </div>

            <p class="auth-text">
                Enter your email address and we will send you a password reset link.
            </p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-field">
                    <label for="email">Email Address</label>
                    <input id="email" type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}"
                           placeholder="you@example.com"
                           required autofocus autocomplete="email">

                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn--block auth-submit">{{ __('Send Reset Link') }} </button>
            </form>

            <div class="auth-divider">
                <span>or</span>
            </div>

            <p class="auth-switch">
                Remembered your password?
                <a class="auth-switch__link" href="{{ route('login') }}">Login</a>
            </p>
        </div>
    </div>
</section>

@include('frontend.partials.footer')

@endsection