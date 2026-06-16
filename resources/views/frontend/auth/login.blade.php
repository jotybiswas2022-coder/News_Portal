<!-- ===== NEWS PORTAL — LOGIN PAGE ===== -->

<div class="np-login-wrapper">

    <!-- ===== ANIMATED BACKGROUND PARTICLES ===== -->
    <div class="np-bg-particle" style="top:15%;left:5%;width:12px;height:12px;animation-delay:0s;"></div>
    <div class="np-bg-particle" style="top:65%;right:8%;width:8px;height:8px;animation-delay:1.5s;"></div>
    <div class="np-bg-particle" style="top:30%;right:12%;width:10px;height:10px;animation-delay:3s;"></div>
    <div class="np-bg-particle" style="bottom:20%;left:10%;width:6px;height:6px;animation-delay:2s;"></div>
    <div class="np-bg-particle" style="top:50%;left:3%;width:14px;height:14px;animation-delay:4s;"></div>
    <div class="np-bg-particle" style="bottom:35%;right:5%;width:7px;height:7px;animation-delay:0.8s;"></div>

    <!-- ===== BREAKING NEWS TICKER ===== -->
    <div class="np-ticker-bar">
        <div class="np-ticker-label">
            <i class="bi bi-lightning-fill"></i> BREAKING
        </div>
        <div class="np-ticker-scroll">
            <div class="np-ticker-track">
                <span>Stay informed with the latest headlines from around the world</span>
                <span>Global markets react to latest economic developments</span>
                <span>Technology: New breakthrough in renewable energy announced</span>
                <span>Weather alert: Heavy rainfall expected in multiple regions</span>
                <span>Stay informed with the latest headlines from around the world</span>
                <span>Global markets react to latest economic developments</span>
                <span>Technology: New breakthrough in renewable energy announced</span>
                <span>Weather alert: Heavy rainfall expected in multiple regions</span>
            </div>
        </div>
    </div>

    <!-- ===== LOGIN CARD ===== -->
    <div class="np-login-center">

        <div class="np-card np-login-card">

            <!-- Decorative top line -->
            <div class="np-card-accent"><span></span></div>

            <!-- ===== HEADER ===== -->
            <div class="np-card-head">

                <div class="np-head-badge">
                    <i class="bi bi-newspaper"></i> Online Edition
                </div>

                <div class="np-head-icon">
                    <i class="bi bi-newspaper"></i>
                </div>

                <h1 class="np-head-title">
                    News <span>Portal</span>
                </h1>

                <p class="np-head-sub">
                    Truth in Every Word
                </p>

                <div class="np-head-bar">
                    <span class="np-bar-line"></span>
                    <i class="bi bi-diamond-fill"></i>
                    <span class="np-bar-line"></span>
                </div>

                <div class="np-head-meta">
                    <span class="np-meta-dot" style="background:var(--np-red);animation:npLivePulse 1.5s ease-in-out infinite;"></span>
                    <span>Live</span>
                    <span style="color:rgba(255,255,255,0.15);">|</span>
                    <span><i class="bi bi-calendar3"></i> <span id="loginDate"></span></span>
                </div>

            </div>

            <!-- ===== BODY ===== -->
            <div class="np-card-body">

                <div class="np-section-title-bar">
                    <span class="np-section-line"></span>
                    <span class="np-section-label"><i class="bi bi-person-badge"></i> Subscriber Login</span>
                    <span class="np-section-line"></span>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- EMAIL -->
                    <div class="np-field" style="--f-delay:0.15s;">
                        <label for="email" class="np-field-label">
                            <i class="bi bi-envelope"></i> {{ __('Email Address') }}
                        </label>
                        <div class="np-input-wrap">
                            <input id="email"
                                   type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   class="np-input @error('email') np-input-error @enderror"
                                   placeholder="you@example.com"
                                   required
                                   autocomplete="email"
                                   autofocus>
                            <i class="bi bi-envelope np-input-icon"></i>
                            <div class="np-input-glow"></div>
                        </div>
                        @error('email')
                        <span class="np-feedback">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <!-- PASSWORD -->
                    <div class="np-field" style="--f-delay:0.3s;">
                        <label for="password" class="np-field-label">
                            <i class="bi bi-shield-lock"></i> {{ __('Password') }}
                        </label>
                        <div class="np-input-wrap">
                            <input id="password"
                                   type="password"
                                   name="password"
                                   class="np-input @error('password') np-input-error @enderror"
                                   placeholder="••••••••"
                                   required
                                   autocomplete="current-password">
                            <i class="bi bi-lock np-input-icon"></i>
                            <button type="button" class="np-pw-toggle" id="pwToggle" tabindex="-1">
                                <i class="bi bi-eye" id="pwIcon"></i>
                            </button>
                            <div class="np-input-glow"></div>
                        </div>
                        @error('password')
                        <span class="np-feedback">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <!-- REMEMBER + FORGOT -->
                    <div class="np-row" style="--f-delay:0.45s;">
                        <label class="np-check-label">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="np-check-box"></span>
                            <span>{{ __('Remember Me') }}</span>
                        </label>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="np-forgot-link">
                            <i class="bi bi-key"></i> Forgot?
                        </a>
                        @endif
                    </div>

                    <!-- SUBMIT -->
                    <button type="submit" class="np-submit-btn" id="loginBtn" style="--f-delay:0.6s;">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span>Sign In</span>
                        <i class="bi bi-arrow-repeat np-spinner"></i>
                    </button>

                </form>

                <!-- OR DIVIDER -->
                <div class="np-or-divider" style="--f-delay:0.75s;">
                    <span class="np-or-line"></span>
                    <span class="np-or-text"><i class="bi bi-diamond-fill" style="font-size:6px;color:var(--np-red);"></i> OR <i class="bi bi-diamond-fill" style="font-size:6px;color:var(--np-red);"></i></span>
                    <span class="np-or-line"></span>
                </div>

                <!-- REGISTER -->
                <div class="np-register-wrap" style="--f-delay:0.85s;">
                    <p class="np-register-text">Don't have an account?</p>
                    <a href="{{ route('register') }}" class="np-register-btn">
                        <i class="bi bi-person-plus"></i> Subscribe Now
                    </a>
                </div>

            </div>

            <!-- ===== FOOTER ===== -->
            <div class="np-card-foot">
                <span>
                    <i class="bi bi-newspaper" style="font-size:0.55rem;"></i>
                    News Portal &copy; {{ date('Y') }} &bull; All Rights Reserved
                </span>
            </div>

        </div>
    </div>

</div>

<!-- ===== BOOTSTRAP ICONS ===== -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<!-- ===== SCRIPTS ===== -->
<script>
    // Current date display
    document.addEventListener('DOMContentLoaded', function() {
        const el = document.getElementById('loginDate');
        if (el) {
            el.textContent = new Date().toLocaleDateString('en-US', {
                weekday: 'short', year: 'numeric', month: 'short', day: 'numeric'
            });
        }
    });

    // Password toggle
    const pwToggle = document.getElementById('pwToggle');
    const pwIcon = document.getElementById('pwIcon');
    const pwInput = document.getElementById('password');
    if (pwToggle && pwIcon && pwInput) {
        pwToggle.addEventListener('click', function() {
            const isPassword = pwInput.type === 'password';
            pwInput.type = isPassword ? 'text' : 'password';
            pwIcon.classList.toggle('bi-eye');
            pwIcon.classList.toggle('bi-eye-slash');
        });
    }

    // Submit loading state
    const loginBtn = document.getElementById('loginBtn');
    if (loginBtn) {
        loginBtn.closest('form').addEventListener('submit', function() {
            loginBtn.classList.add('np-loading');
            loginBtn.disabled = true;
        });
    }

    // Ripple effect on submit button
    document.querySelectorAll('.np-submit-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            const rect = this.getBoundingClientRect();
            const ripple = document.createElement('span');
            ripple.className = 'np-btn-ripple';
            const size = Math.max(rect.width, rect.height);
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
            ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 700);
        });
    });

    // Form field focus effects
    document.querySelectorAll('.np-input').forEach(input => {
        input.addEventListener('focus', function() {
            this.closest('.np-input-wrap').classList.add('np-focused');
        });
        input.addEventListener('blur', function() {
            this.closest('.np-input-wrap').classList.remove('np-focused');
        });
    });
</script>

<!-- ===== INLINE CSS ===== -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap');

    :root {
        --np-black: #000000;
        --np-red: #D32F2F;
        --np-red-dark: #B71C1C;
        --np-red-light: #E53935;
        --np-white: #FFFFFF;
        --np-gray-50: #FAFAFA;
        --np-gray-100: #F5F5F5;
        --np-gray-200: #EEEEEE;
        --np-gray-300: #E0E0E0;
        --np-gray-400: #BDBDBD;
        --np-gray-500: #9E9E9E;
        --np-gray-600: #757575;
        --np-gray-700: #616161;
        --np-text: #222222;
        --font-headline: 'Playfair Display', Georgia, serif;
        --font-ui: 'Inter', Arial, sans-serif;
    }

    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: var(--font-ui);
        color: var(--np-text);
        background: var(--np-white);
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* ===== WRAPPER (centers the card) ===== */
    .np-login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        background:
            radial-gradient(ellipse at 20% 50%, rgba(211,47,47,0.03) 0%, transparent 60%),
            radial-gradient(ellipse at 80% 50%, rgba(0,0,0,0.02) 0%, transparent 60%),
            linear-gradient(180deg, #fafafa 0%, #ffffff 50%, #fafafa 100%);
        padding: 80px 16px 20px;
        overflow: hidden;
    }

    /* Subtle newspaper ruled lines */
    .np-login-wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background:
            repeating-linear-gradient(0deg, transparent, transparent 29px, rgba(0,0,0,0.02) 29px, rgba(0,0,0,0.02) 30px);
        pointer-events: none;
        z-index: 0;
    }

    .np-login-wrapper::after {
        content: 'BREAKING NEWS • WORLD REPORT • POLITICS • ECONOMY • SPORTS • TECHNOLOGY • CULTURE • INVESTIGATION •';
        position: absolute;
        top: 50%;
        left: 0;
        width: 400%;
        font-family: var(--font-ui);
        font-size: 10px;
        font-weight: 300;
        letter-spacing: 6px;
        color: rgba(0,0,0,0.025);
        white-space: nowrap;
        transform: translateY(-50%) rotate(-12deg);
        pointer-events: none;
        z-index: 0;
        animation: npBgScroll 80s linear infinite;
    }

    @keyframes npBgScroll {
        0% { transform: translateY(-50%) rotate(-12deg) translateX(0); }
        100% { transform: translateY(-50%) rotate(-12deg) translateX(-25%); }
    }

    /* ===== FLOATING PARTICLES ===== */
    .np-bg-particle {
        position: absolute;
        width: 8px;
        height: 8px;
        background: var(--np-red);
        border-radius: 50%;
        opacity: 0.08;
        z-index: 1;
        pointer-events: none;
        animation: npParticle 12s ease-in-out infinite;
    }

    @keyframes npParticle {
        0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.06; }
        25% { transform: translate(15px, -25px) scale(1.4); opacity: 0.12; }
        50% { transform: translate(-10px, -45px) scale(0.8); opacity: 0.04; }
        75% { transform: translate(20px, -15px) scale(1.2); opacity: 0.1; }
    }

    /* ===== BREAKING NEWS TICKER ===== */
    .np-ticker-bar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 38px;
        background: var(--np-red);
        display: flex;
        align-items: center;
        z-index: 100;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(211,47,47,0.3);
    }

    .np-ticker-label {
        background: var(--np-black);
        color: var(--np-white);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 2px;
        padding: 0 16px;
        height: 100%;
        display: flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
        text-transform: uppercase;
        position: relative;
        z-index: 2;
    }

    .np-ticker-label i {
        font-size: 10px;
        animation: npTickerFlash 1s step-end infinite;
    }

    @keyframes npTickerFlash {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.2; }
    }

    .np-ticker-scroll {
        flex: 1;
        overflow: hidden;
        height: 100%;
        display: flex;
        align-items: center;
    }

    .np-ticker-track {
        display: flex;
        white-space: nowrap;
        gap: 0;
        animation: npTickerMove 40s linear infinite;
        font-size: 12px;
        font-weight: 500;
        color: var(--np-white);
    }

    .np-ticker-track span {
        padding: 0 28px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .np-ticker-track span::before {
        content: '◆';
        font-size: 6px;
        opacity: 0.6;
        margin-right: 4px;
    }

    @keyframes npTickerMove {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* ===== LOGIN CENTER ===== */
    .np-login-center {
        position: relative;
        z-index: 5;
        width: 100%;
        max-width: 420px;
        animation: npCardEntry 0.9s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    @keyframes npCardEntry {
        from { opacity: 0; transform: translateY(40px) scale(0.97); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* ===== LOGIN CARD ===== */
    .np-card {
        background: var(--np-white);
        border: 1px solid var(--np-gray-300);
        position: relative;
        overflow: visible;
        box-shadow:
            0 2px 8px rgba(0,0,0,0.04),
            0 8px 30px rgba(0,0,0,0.06),
            0 20px 60px rgba(0,0,0,0.04);
        transition: box-shadow 0.4s ease;
    }

    .np-card:hover {
        box-shadow:
            0 2px 8px rgba(0,0,0,0.04),
            0 12px 40px rgba(0,0,0,0.08),
            0 24px 80px rgba(0,0,0,0.06);
    }

    /* Top red accent bar */
    .np-card-accent {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--np-black);
        overflow: hidden;
    }

    .np-card-accent span {
        display: block;
        width: 60%;
        height: 100%;
        background: var(--np-red);
        animation: npAccentSlide 3s ease-in-out infinite;
    }

    @keyframes npAccentSlide {
        0%, 100% { transform: translateX(-30%); }
        50% { transform: translateX(100%); }
    }

    /* ===== HEADER ===== */
    .np-card-head {
        text-align: center;
        padding: 36px 28px 20px;
        border-bottom: 3px double var(--np-black);
        position: relative;
        background: linear-gradient(180deg, var(--np-gray-50) 0%, var(--np-white) 100%);
    }

    .np-card-head::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 2px;
        background: var(--np-red);
    }

    .np-head-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: var(--np-black);
        color: var(--np-white);
        padding: 3px 12px;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 14px;
    }

    .np-head-badge i {
        color: var(--np-red);
        font-size: 10px;
    }

    .np-head-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 12px;
        background: var(--np-white);
        border: 2px solid var(--np-red);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        color: var(--np-red);
        position: relative;
        animation: npIconStamp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.3s both;
        transition: all 0.4s ease;
    }

    .np-card:hover .np-head-icon {
        transform: rotate(-5deg) scale(1.05);
        box-shadow: 0 4px 15px rgba(211,47,47,0.15);
    }

    @keyframes npIconStamp {
        0% { transform: scale(0) rotate(-30deg); opacity: 0; }
        60% { transform: scale(1.15) rotate(5deg); opacity: 1; }
        80% { transform: scale(0.95) rotate(-2deg); }
        100% { transform: scale(1) rotate(0deg); opacity: 1; }
    }

    .np-head-title {
        font-family: var(--font-headline);
        font-size: 30px;
        font-weight: 900;
        color: var(--np-black);
        letter-spacing: -0.5px;
        line-height: 1.15;
    }

    .np-head-title span {
        color: var(--np-red);
        position: relative;
    }

    .np-head-title span::after {
        content: '';
        position: absolute;
        bottom: 1px;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--np-red);
        opacity: 0.3;
    }

    .np-head-sub {
        font-size: 11px;
        color: var(--np-gray-500);
        letter-spacing: 4px;
        text-transform: uppercase;
        margin-top: 4px;
        font-weight: 400;
    }

    .np-head-bar {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin: 10px 0;
    }

    .np-bar-line {
        width: 40px;
        height: 1px;
        background: var(--np-gray-300);
    }

    .np-head-bar i {
        font-size: 7px;
        color: var(--np-red);
    }

    .np-head-meta {
        font-size: 10px;
        color: var(--np-gray-500);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .np-head-meta i {
        color: var(--np-red);
        margin-right: 2px;
    }

    .np-meta-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        display: inline-block;
    }

    @keyframes npLivePulse {
        0%, 100% { opacity: 1; transform: scale(1); box-shadow: 0 0 0 0 rgba(211,47,47,0.4); }
        50% { opacity: 0.6; transform: scale(1.3); box-shadow: 0 0 0 4px rgba(211,47,47,0); }
    }

    /* ===== BODY ===== */
    .np-card-body {
        padding: 24px 28px 28px;
    }

    .np-section-title-bar {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 22px;
    }

    .np-section-line {
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--np-gray-300), transparent);
    }

    .np-section-label {
        font-size: 12px;
        font-weight: 700;
        color: var(--np-black);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .np-section-label i {
        color: var(--np-red);
        font-size: 13px;
    }

    /* ===== FORM FIELDS ===== */
    .np-field {
        margin-bottom: 18px;
        opacity: 0;
        animation: npFieldIn 0.5s ease-out var(--f-delay, 0s) forwards;
    }

    @keyframes npFieldIn {
        to { opacity: 1; transform: translateX(0); }
        from { opacity: 0; transform: translateX(-12px); }
    }

    .np-field-label {
        font-size: 11px;
        font-weight: 600;
        color: var(--np-gray-700);
        text-transform: uppercase;
        letter-spacing: 1.2px;
        display: flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 6px;
    }

    .np-field-label i {
        color: var(--np-red);
        font-size: 12px;
    }

    .np-input-wrap {
        position: relative;
    }

    .np-input {
        width: 100%;
        padding: 12px 44px 12px 16px;
        font-family: var(--font-ui);
        font-size: 14px;
        color: var(--np-text);
        background: var(--np-white);
        border: 1.5px solid var(--np-gray-300);
        outline: none;
        transition: all 0.3s ease;
        position: relative;
        z-index: 2;
    }

    .np-input::placeholder {
        color: var(--np-gray-400);
        font-size: 13px;
    }

    .np-input:focus {
        border-color: var(--np-red);
        box-shadow: 0 0 0 3px rgba(211,47,47,0.06);
    }

    .np-input-error {
        border-color: var(--np-red) !important;
    }

    .np-input-icon {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--np-gray-400);
        font-size: 15px;
        transition: color 0.3s ease;
        pointer-events: none;
        z-index: 3;
    }

    .np-input-wrap.np-focused .np-input-icon {
        color: var(--np-red);
    }

    /* Input glow line */
    .np-input-glow {
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--np-red), transparent);
        transition: width 0.4s ease;
        z-index: 3;
        opacity: 0;
    }

    .np-input-wrap.np-focused .np-input-glow {
        width: 80%;
        opacity: 1;
    }

    /* ===== PASSWORD TOGGLE ===== */
    .np-pw-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: var(--np-gray-400);
        font-size: 15px;
        padding: 4px;
        transition: color 0.3s;
        z-index: 4;
    }

    .np-pw-toggle:hover {
        color: var(--np-red);
    }

    /* ===== FEEDBACK ===== */
    .np-feedback {
        font-size: 12px;
        color: var(--np-red);
        margin-top: 4px;
        display: block;
    }

    .np-feedback i {
        margin-right: 3px;
        font-size: 11px;
    }

    /* ===== ROW (remember + forgot) ===== */
    .np-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 16px 0 20px;
        opacity: 0;
        animation: npFieldIn 0.5s ease-out var(--f-delay, 0s) forwards;
    }

    .np-check-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        font-size: 13px;
        color: var(--np-gray-600);
        user-select: none;
    }

    .np-check-label input {
        display: none;
    }

    .np-check-box {
        width: 17px;
        height: 17px;
        border: 1.5px solid var(--np-gray-400);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.3s ease;
        position: relative;
    }

    .np-check-label input:checked + .np-check-box {
        background: var(--np-red);
        border-color: var(--np-red);
    }

    .np-check-label input:checked + .np-check-box::after {
        content: '✓';
        color: #fff;
        font-size: 11px;
        font-weight: 700;
    }

    .np-forgot-link {
        font-size: 12px;
        color: var(--np-gray-500);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 3px;
        transition: color 0.3s;
    }

    .np-forgot-link:hover {
        color: var(--np-red);
    }

    .np-forgot-link i {
        font-size: 11px;
    }

    /* ===== SUBMIT BUTTON ===== */
    .np-submit-btn {
        width: 100%;
        padding: 14px 24px;
        font-family: var(--font-ui);
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--np-white);
        background: var(--np-black);
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        position: relative;
        overflow: hidden;
        transition: all 0.35s ease;
        opacity: 0;
        animation: npFieldIn 0.5s ease-out var(--f-delay, 0s) forwards;
    }

    .np-submit-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.12), transparent);
        transition: left 0.6s ease;
    }

    .np-submit-btn:hover {
        background: var(--np-red);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(211,47,47,0.3);
    }

    .np-submit-btn:hover::before {
        left: 100%;
    }

    .np-submit-btn:active {
        transform: translateY(0);
    }

    .np-submit-btn .np-spinner {
        display: none;
        animation: npSpin 1s linear infinite;
    }

    .np-submit-btn.np-loading .np-spinner {
        display: inline-block;
    }

    .np-submit-btn.np-loading span {
        display: none;
    }

    @keyframes npSpin {
        to { transform: rotate(360deg); }
    }

    /* Button ripple */
    .np-btn-ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        transform: scale(0);
        animation: npRippleAnim 0.7s ease-out;
        pointer-events: none;
        z-index: 5;
    }

    @keyframes npRippleAnim {
        to { transform: scale(4); opacity: 0; }
    }

    /* ===== DIVIDER ===== */
    .np-or-divider {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 24px 0;
        opacity: 0;
        animation: npFadeIn 0.5s ease-out var(--f-delay, 0s) forwards;
    }

    @keyframes npFadeIn {
        to { opacity: 1; }
    }

    .np-or-line {
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--np-gray-300), transparent);
    }

    .np-or-text {
        font-size: 11px;
        font-weight: 500;
        color: var(--np-gray-500);
        letter-spacing: 2px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* ===== REGISTER ===== */
    .np-register-wrap {
        text-align: center;
        opacity: 0;
        animation: npFadeIn 0.5s ease-out var(--f-delay, 0s) forwards;
    }

    .np-register-text {
        font-size: 13px;
        color: var(--np-gray-500);
        margin-bottom: 8px;
    }

    .np-register-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 28px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: var(--np-black);
        background: transparent;
        border: 1.5px solid var(--np-black);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .np-register-btn:hover {
        background: var(--np-black);
        color: var(--np-white);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    }

    .np-register-btn i {
        font-size: 14px;
    }

    /* ===== FOOTER ===== */
    .np-card-foot {
        text-align: center;
        padding: 12px 24px;
        border-top: 3px double var(--np-black);
        background: var(--np-gray-50);
    }

    .np-card-foot span {
        font-size: 10px;
        color: var(--np-gray-500);
        letter-spacing: 1px;
    }

    .np-card-foot span i {
        color: var(--np-red);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 576px) {
        .np-login-wrapper {
            padding: 60px 10px 16px;
        }
        .np-card-head {
            padding: 28px 20px 16px;
        }
        .np-card-body {
            padding: 20px 20px 24px;
        }
        .np-head-title {
            font-size: 26px;
        }
        .np-head-icon {
            width: 50px;
            height: 50px;
            font-size: 22px;
        }
        .np-ticker-bar {
            height: 32px;
        }
        .np-ticker-label {
            font-size: 9px;
            padding: 0 10px;
            letter-spacing: 1px;
        }
        .np-ticker-track {
            font-size: 11px;
        }
        .np-ticker-track span {
            padding: 0 16px;
        }
        .np-bg-particle {
            display: none;
        }
        .np-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
    }

    @media (max-width: 380px) {
        .np-card-head {
            padding: 22px 16px 14px;
        }
        .np-card-body {
            padding: 16px 16px 20px;
        }
        .np-head-title {
            font-size: 22px;
        }
        .np-head-sub {
            font-size: 10px;
            letter-spacing: 2px;
        }
        .np-section-label {
            font-size: 11px;
        }
        .np-submit-btn {
            padding: 12px 20px;
            font-size: 13px;
        }
    }
</style>
