<div class="login-container">

    <!-- Floating Newspaper Pages -->
    <div class="floating-paper"></div>
    <div class="floating-paper"></div>
    <div class="floating-paper"></div>
    <div class="floating-paper"></div>
    <div class="floating-paper"></div>

    <div class="container">
        <div class="row justify-content-center w-100 m-0">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 d-flex justify-content-center">

                <div class="card login-card">

                    <!-- Press Overlay -->
                    <div class="press-overlay">
                        <div class="press-text">News Portal</div>
                        <div class="press-bar"></div>
                    </div>

                    <!-- Decorations -->
                    <div class="corner-fold"></div>

                    <div class="ink-dot"></div>
                    <div class="ink-dot"></div>
                    <div class="ink-dot"></div>

                    <div class="masthead-deco">
                        <div class="deco-line"></div>
                        <div class="deco-icon">
                            <i class="bi bi-globe-americas"></i>
                        </div>
                        <div class="deco-line"></div>
                    </div>

                    <div class="press-line"></div>

                    <!-- HEADER -->
                    <div class="card-header login-header text-center">

                        <div class="edition-line">
                            <span class="dot"></span>
                            <span>Daily Edition</span>
                            <span class="dot"></span>
                            <span class="live-dot"></span>
                            <span>Live</span>
                            <span class="dot"></span>
                        </div>

                        <div class="brand-icon">
                            <i class="bi bi-newspaper"></i>
                        </div>

                        <div class="brand-name">News Portal</div>

                        <span class="brand-subtitle">
                            Truth in Every Word
                        </span>

                        <div class="date-line">
                            <i class="bi bi-calendar3"></i>
                            <span id="currentDate"></span>
                        </div>

                    </div>

                    <!-- BODY -->
                    <div class="card-body login-body">

                        <div class="section-headline">
                            <i class="bi bi-person-badge"
                               style="color:var(--np-red);margin-right:4px;font-size:14px;"></i>
                            Subscriber Login
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- EMAIL -->
                            <div class="form-group-custom">

                                <label for="email" class="login-label pb-2">
                                    <i class="bi bi-envelope"></i>
                                    {{ __('Email Address') }}
                                </label>

                                <input id="email"
                                       type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       class="form-control login-input @error('email') is-invalid @enderror"
                                       placeholder="you@example.com"
                                       required
                                       autocomplete="email"
                                       autofocus>

                                <i class="bi bi-envelope input-icon"></i>

                                @error('email')
                                <span class="invalid-feedback d-block">
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
                                       class="form-control login-input @error('password') is-invalid @enderror"
                                       placeholder="••••••••"
                                       required
                                       autocomplete="current-password">

                                <i class="bi bi-lock input-icon"></i>

                                <button type="button"
                                        class="password-toggle"
                                        id="togglePassword">
                                    <i class="bi bi-eye" id="toggleIcon"></i>
                                </button>

                                @error('password')
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <!-- REMEMBER -->
                            <div class="form-check custom-check">

                                <input type="checkbox"
                                       name="remember"
                                       id="remember"
                                       class="form-check-input"
                                       {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label login-remember"
                                       for="remember">

                                    <i class="bi bi-bookmark-check"
                                       style="font-size:0.8rem;margin-right:2px;"></i>

                                    {{ __('Remember Me') }}

                                </label>

                            </div>

                            <!-- LOGIN BUTTON -->
                            <button type="submit"
                                    class="login-btn mt-3"
                                    id="loginBtn">

                                <i class="bi bi-box-arrow-in-right"></i>

                                <span>Sign In</span>

                                <i class="bi bi-arrow-repeat btn-spinner"></i>

                            </button>

                            <!-- FORGOT PASSWORD -->
                            @if (Route::has('password.request'))
                            <div class="text-end mt-2">

                                <a href="{{ route('password.request') }}"
                                   class="login-link">

                                    <i class="bi bi-key"></i>
                                    Forgot Password?

                                </a>

                            </div>
                            @endif

                        </form>

                        <div class="divider">
                            <i class="bi bi-diamond-fill"></i>
                            <span>OR</span>
                            <i class="bi bi-diamond-fill"></i>
                        </div>

                        <div class="text-center">

                            <span class="signup-text">
                                Don't have an account?
                            </span>

                            <br>

                            <a href="{{ route('register') }}"
                               class="signup-btn">

                                <i class="bi bi-person-plus"></i>
                                Subscribe Now

                            </a>

                        </div>

                    </div>

                    <!-- COLUMN RULE -->
                    <div class="column-rule">
                        <div class="rule-line"></div>
                        <div class="rule-diamond"></div>
                        <div class="rule-line"></div>
                    </div>

                    <!-- FOOTER -->
                    <div class="login-footer">

                        <span>
                            <i class="bi bi-newspaper"
                               style="font-size:0.6rem;"></i>

                            News Portal &copy; 2025
                        </span>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800;900&family=Old+Standard+TT:wght@400;700&family=Roboto:wght@300;400;500;700&family=UnifrakturMaguntia&display=swap" rel="stylesheet">
    <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/login.css') }}">

    <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Set current date
    const dateEl = document.getElementById('currentDate');
    if (dateEl) {
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        dateEl.textContent = new Date().toLocaleDateString('en-US', options);
    }

    // Password toggle
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

    // Login button loading state
    const loginBtn = document.getElementById('loginBtn');
    if (loginBtn) {
        loginBtn.closest('form').addEventListener('submit', function () {
            loginBtn.classList.add('loading');
            loginBtn.disabled = true;
        });
    }

    // Remove press overlay after animation
    setTimeout(() => {
        const overlay = document.querySelector('.press-overlay');
        if (overlay) overlay.remove();
    }, 1600);
</script>