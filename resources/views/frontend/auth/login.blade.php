@extends('frontend.app')

@section('title', "Login — ESHA'S ROKOMARIS 2")
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

@section('styles')
<style>
    @media (max-width: 560px) {
        .site-header,
        .site-footer,
        .page-head { display: none; }

        main#main {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        main#main .section--white {
            width: 100%;
            padding-block: 20px;
        }
        .auth-card {
            max-width: 420px;
            width: 100%;
            margin-inline: auto;
            padding: 42px 30px 44px;
        }
        .auth-brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
        }
        .auth-brand .brand__mark {
            width: 46px;
            height: 46px;
            background: var(--color-primary);
            border-color: var(--color-primary);
            color: var(--color-white);
            font-size: 1.05rem;
        }
        .auth-brand .brand__name { font-size: 0.95rem; }

        .auth-card .form-field { margin-bottom: 22px; }
        .auth-card .form-field label { font-size: 0.7rem; margin-bottom: 9px; }
        .auth-card .form-control { padding: 16px 18px; font-size: 1rem; }

        .auth-check { margin: 2px 0 26px; font-size: 0.9rem; }
        .auth-check input[type="checkbox"] { width: 18px; height: 18px; }
        .auth-link { font-size: 0.88rem; }

        .auth-card .btn--block {
            padding: 17px;
            font-size: 0.85rem;
            min-height: 54px;
        }
        .auth-divider { margin: 30px 0 26px; }
        .auth-switch { font-size: 0.95rem; }
    }
</style>
@endsection