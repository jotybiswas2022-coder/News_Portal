@extends('frontend.app')

@section('title', "Confirm Password — ESHA'S ROKOMARIS 2")
@section('meta_description', 'Confirm your password to continue.')

@section('content')

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
        <h1 class="page-head__title">Confirm Password</h1>
        <p class="page-head__text">Please confirm your password before continuing.</p>
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
                Please confirm your password before continuing.
            </p>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

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

                <button type="submit" class="btn btn--block auth-submit">{{ __('Confirm Password') }}</button>
            </form>

            @if (Route::has('password.request'))
                <div class="auth-divider">
                    <span>or</span>
                </div>

                <p class="auth-switch">
                    <a class="auth-switch__link" href="{{ route('password.request') }}">Forgot Your Password?</a>
                </p>
            @endif
        </div>
    </div>
</section>

@include('frontend.partials.footer')

@endsection