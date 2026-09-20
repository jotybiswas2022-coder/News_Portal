@extends('frontend.app')

@section('title', "Verify Email — ESHA'S ROKOMARIS 2")
@section('body_class', 'auth-page')
@section('meta_description', 'Verify your Esha\'s Rokomaris 2 email address.')

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
        <h1 class="page-head__title">Verify Your Email</h1>
        <p class="page-head__text">One more step before you can shop with Esha's Rokomaris 2.</p>
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

            @if (session('resent'))
                <p class="notice" role="status">A fresh verification link has been sent to your email address.</p>
            @endif

            <p class="auth-text">
                Before proceeding, please check your email for a verification link. If you did not receive the email, request another below.
            </p>

            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn--block auth-submit">
                    {{ __('Send Verification Link Again') }}
                </button>
            </form>

            <div class="auth-divider">
                <span>or</span>
            </div>

            <p class="auth-switch">
                <a class="auth-switch__link" href="{{ url('/') }}">Back to website</a>
            </p>
        </div>
    </div>
</section>

@include('frontend.partials.footer')

@endsection