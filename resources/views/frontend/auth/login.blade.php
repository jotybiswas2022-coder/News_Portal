@extends('frontend.app')

@section('title', "Login — ESHA'S ROKOMARIS 2")
@section('body_class', 'auth-page')
@section('meta_description', 'Sign in to your Esha\'s Rokomaris 2 account.')

@section('content')

@if(session('success'))
    <div class="brand-container">
        <p class="notice" role="status">{{ session('success') }}</p>
    </div>
@endif

@if(session('error'))
    <div class="brand-container">
        <p class="notice" role="status">{{ session('error') }}</p>
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
        <h1 class="page-head__title">Welcome Back</h1>
        <p class="page-head__text">Sign in to continue shopping with Esha's Rokomaris 2.</p>
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

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-field">
                    <label for="email">Email Address</label>
                    <input id="email" type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}"
                           placeholder="you@example.com"
                           required autocomplete="email" autofocus>

                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-field">
                    <label for="password">Password</label>
                    <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password" placeholder="••••••••"
                           required autocomplete="current-password">

                    @error('password')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="auth-check">
                    <label for="remember">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Remember Me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="auth-link" href="{{ route('password.request') }}">Forgot Password?</a>
                    @endif
                </div>

                <button type="submit" class="btn btn--block auth-submit">{{ __('Login') }}</button>
            </form>

            <div class="auth-divider">
                <span>or</span>
            </div>

            <p class="auth-switch">
                Don't have an account?
                <a class="auth-switch__link" href="{{ route('register') }}">Create One</a>
            </p>
        </div>
    </div>
</section>

@include('frontend.partials.footer')

@endsection