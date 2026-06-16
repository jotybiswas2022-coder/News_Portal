<!-- =====================================================
     TRADING DARK THEME — LOGIN PAGE
     ===================================================== -->

<!-- Background -->
<div class="trade-bg">
    <div class="trade-grid"></div>

    <!-- Animated Candlestick Patterns -->
    <div class="candle-container">
        <div class="candle candle-green c1"></div>
        <div class="candle candle-red c2"></div>
        <div class="candle candle-green c3"></div>
        <div class="candle candle-red c4"></div>
        <div class="candle candle-green c5"></div>
        <div class="candle candle-red c6"></div>
        <div class="candle candle-green c7"></div>
        <div class="candle candle-red c8"></div>
        <div class="candle candle-green c9"></div>
        <div class="candle candle-red c10"></div>
        <div class="candle candle-green c11"></div>
        <div class="candle candle-red c12"></div>
        <div class="candle candle-green c13"></div>
        <div class="candle candle-red c14"></div>
        <div class="candle candle-green c15"></div>
    </div>

    <!-- Floating Particles -->
    <div class="particle particle-1"></div>
    <div class="particle particle-2"></div>
    <div class="particle particle-3"></div>
    <div class="particle particle-4"></div>
    <div class="particle particle-5"></div>
</div>

<!-- Live Market Ticker -->
<div class="trade-ticker">
    <div class="ticker-label">
        <span class="live-dot"></span>
        LIVE
    </div>
    <div class="ticker-wrap">
        <div class="ticker-content">
            <span class="ticker-item"><span class="ticker-pair">EUR/USD</span><span class="ticker-price">1.0852</span><span class="ticker-change up">+0.12%</span></span>
            <span class="ticker-item"><span class="ticker-pair">GBP/USD</span><span class="ticker-price">1.2734</span><span class="ticker-change down">-0.08%</span></span>
            <span class="ticker-item"><span class="ticker-pair">USD/JPY</span><span class="ticker-price">149.87</span><span class="ticker-change up">+0.23%</span></span>
            <span class="ticker-item"><span class="ticker-pair">BTC/USD</span><span class="ticker-price">67,234</span><span class="ticker-change up">+1.45%</span></span>
            <span class="ticker-item"><span class="ticker-pair">ETH/USD</span><span class="ticker-price">3,521</span><span class="ticker-change down">-0.67%</span></span>
            <span class="ticker-item"><span class="ticker-pair">XAU/USD</span><span class="ticker-price">2,312</span><span class="ticker-change up">+0.31%</span></span>
            <!-- Duplicate for seamless scrolling -->
            <span class="ticker-item"><span class="ticker-pair">EUR/USD</span><span class="ticker-price">1.0852</span><span class="ticker-change up">+0.12%</span></span>
            <span class="ticker-item"><span class="ticker-pair">GBP/USD</span><span class="ticker-price">1.2734</span><span class="ticker-change down">-0.08%</span></span>
            <span class="ticker-item"><span class="ticker-pair">USD/JPY</span><span class="ticker-price">149.87</span><span class="ticker-change up">+0.23%</span></span>
            <span class="ticker-item"><span class="ticker-pair">BTC/USD</span><span class="ticker-price">67,234</span><span class="ticker-change up">+1.45%</span></span>
            <span class="ticker-item"><span class="ticker-pair">ETH/USD</span><span class="ticker-price">3,521</span><span class="ticker-change down">-0.67%</span></span>
            <span class="ticker-item"><span class="ticker-pair">XAU/USD</span><span class="ticker-price">2,312</span><span class="ticker-change up">+0.31%</span></span>
        </div>
    </div>
</div>

<!-- Login Container -->
<div class="login-container">

    <div class="card login-card">

        <!-- HEADER -->
        <div class="card-header login-header">

            <!-- Brand Icon -->
            <div class="trade-brand-icon">
                <i class="bi bi-graph-up-arrow"></i>
            </div>

            <!-- Brand Name -->
            <div class="trade-brand-name">Trade<span>Vault</span></div>
            <div class="trade-brand-sub">Secure Trading Platform</div>

            <!-- Status Bar -->
            <div class="trade-status-bar">
                <span class="status-dot"></span>
                <span class="status-text">System Online</span>
                <span>|</span>
                <span>v3.2.1</span>
            </div>

        </div>

        <!-- BODY -->
        <div class="card-body login-body">

            <div class="section-headline">
                <i class="bi bi-shield-check"></i>
                Account Login
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- EMAIL -->
                <div class="form-group-custom">

                    <label for="email" class="login-label">
                        <i class="bi bi-envelope"></i>
                        {{ __('Email Address') }}
                    </label>

                    <input id="email"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="login-input @error('email') error @enderror"
                           placeholder="trader@example.com"
                           required
                           autocomplete="email"
                           autofocus>

                    <i class="bi bi-envelope input-icon"></i>
                    <div class="input-glow-line"></div>

                    @error('email')                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>

                    @enderror

                </div>

                <!-- PASSWORD -->
                <div class="form-group-custom">

                    <label for="password" class="login-label">
                        <i class="bi bi-shield-lock"></i>
                        {{ __('Password') }}
                    </label>

                    <input id="password"
                           type="password"
                           name="password"
                           class="login-input @error('password') error @enderror"
                           placeholder="••••••••"
                           required
                           autocomplete="current-password">

                    <i class="bi bi-lock input-icon"></i>

                    <button type="button"
                            class="password-toggle"
                            id="togglePassword">
                        <i class="bi bi-eye" id="toggleIcon"></i>
                    </button>

                    <div class="input-glow-line"></div>

                    @error('password')
                    <span class="invalid-feedback d-block">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <!-- REMEMBER -->
                <div class="custom-check">

                    <input type="checkbox"
                           name="remember"
                           id="remember"
                           {{ old('remember') ? 'checked' : '' }}>

                    <label class="check-box" for="remember"></label>

                    <label class="login-remember" for="remember">
                        {{ __('Remember Me') }}
                    </label>

                </div>

                <!-- LOGIN BUTTON -->
                <button type="submit"
                        class="login-btn"
                        id="loginBtn">

                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Sign In</span>
                    <i class="bi bi-arrow-repeat btn-spinner"></i>

                </button>

                <!-- FORGOT PASSWORD -->
                @if (Route::has('password.request'))                            <div class="tk-text-end tk-mt-2">

                    <a href="{{ route('password.request') }}"
                       class="login-link">

                        <i class="bi bi-key"></i>
                        Forgot Password?

                    </a>

                </div>
                @endif

            </form>

            <div class="divider tk-mt-3">
                <i class="bi bi-diamond-fill"></i>
                <span>New Here?</span>
                <i class="bi bi-diamond-fill"></i>
            </div>

            <div class="tk-text-center">

                <span class="signup-text">
                    Don't have an account yet?
                </span>

                <br>

                <a href="{{ route('register') }}"
                   class="signup-btn">

                    <i class="bi bi-person-plus"></i>
                    Create Account

                </a>

            </div>

        </div>

        <!-- FOOTER -->
        <div class="login-footer">
            <span>
                <i class="bi bi-shield-fill-check"></i>
                Secured &bull; v3.2.1 &bull; TradeVault
            </span>
        </div>

    </div>
</div>

<!-- ===== CSS & SCRIPTS ===== -->
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<!-- External CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/login.css') }}">

<script>
    // ===== CURRENT DATE =====
    const dateEl = document.getElementById('currentDate');
    if (dateEl) {
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        dateEl.textContent = new Date().toLocaleDateString('en-US', options);
    }

    // ===== PASSWORD TOGGLE =====
    const toggleBtn = document.getElementById('togglePassword');
    const toggleIcon = document.getElementById('toggleIcon');
    const passwordInput = document.getElementById('password');

    if (toggleBtn && toggleIcon && passwordInput) {
        toggleBtn.addEventListener('click', function () {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            toggleIcon.classList.toggle('bi-eye');
            toggleIcon.classList.toggle('bi-eye-slash');
        });
    }

    // ===== LOGIN BUTTON LOADING STATE =====
    const loginBtn = document.getElementById('loginBtn');
    if (loginBtn) {
        loginBtn.closest('form').addEventListener('submit', function () {
            loginBtn.classList.add('loading');
            loginBtn.disabled = true;
        });
    }

    // ===== BUTTON RIPPLE EFFECT =====
    document.querySelectorAll('.login-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            const rect = this.getBoundingClientRect();
            const ripple = document.createElement('span');
            ripple.classList.add('btn-ripple');
            const size = Math.max(rect.width, rect.height);
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
            ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });
    });

    // ===== CANDLE COLOR FLICKER (cosmetic - toggles class only) =====
    setInterval(() => {
        document.querySelectorAll('.candle').forEach(candle => {
            if (Math.random() > 0.85) {
                candle.classList.toggle('candle-green');
                candle.classList.toggle('candle-red');
            }
        });
    }, 4000);
</script>
