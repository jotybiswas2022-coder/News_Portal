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

    <style>
        /* ===== CSS VARIABLES ===== */
        :root {
            --np-black: #000000;
            --np-red: #D32F2F;
            --np-red-hover: #E53935;
            --np-red-dark: #B71C1C;
            --np-white: #FFFFFF;
            --np-light-gray: #F5F5F5;
            --np-gray: #E0E0E0;
            --np-mid-gray: #9E9E9E;
            --np-dark-gray: #333333;
            --np-cream: #FFF8F0;
            --np-shadow: rgba(0, 0, 0, 0.15);
        }

        /* ===== GLOBAL RESET ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: var(--np-white);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ===== NEWSPAPER BACKGROUND PATTERN ===== */
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background:
                linear-gradient(180deg, rgba(245,245,245,0.5) 0%, rgba(255,255,255,1) 30%, rgba(255,255,255,1) 70%, rgba(245,245,245,0.5) 100%);
            overflow: hidden;
        }

        /* Animated newspaper text background */
        .login-container::before {
            content: "BREAKING NEWS • WORLD REPORT • POLITICS • ECONOMY • SPORTS • TECHNOLOGY • CULTURE • OPINION • EDITORIAL • HEADLINE • EXCLUSIVE • INVESTIGATION • BREAKING NEWS • WORLD REPORT • POLITICS • ECONOMY • SPORTS • TECHNOLOGY • CULTURE • OPINION • EDITORIAL • HEADLINE • EXCLUSIVE • INVESTIGATION • BREAKING NEWS • WORLD REPORT • POLITICS • ECONOMY • SPORTS • TECHNOLOGY • CULTURE • OPINION • EDITORIAL • HEADLINE • EXCLUSIVE • INVESTIGATION •";
            position: absolute;
            top: 0;
            left: 0;
            width: 300%;
            font-family: 'Roboto', sans-serif;
            font-size: 12px;
            font-weight: 300;
            letter-spacing: 4px;
            color: rgba(0, 0, 0, 0.04);
            line-height: 2.5;
            word-spacing: 8px;
            white-space: nowrap;
            animation: scrollText 60s linear infinite;
            pointer-events: none;
            z-index: 0;
        }

        .login-container::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                repeating-linear-gradient(
                    0deg,
                    transparent,
                    transparent 28px,
                    rgba(0,0,0,0.015) 28px,
                    rgba(0,0,0,0.015) 29px
                );
            pointer-events: none;
            z-index: 0;
        }

        @keyframes scrollText {
            0% { transform: translateX(0); }
            100% { transform: translateX(-33.33%); }
        }

        /* ===== FLOATING NEWSPAPER ELEMENTS ===== */
        .floating-paper {
            position: absolute;
            width: 40px;
            height: 50px;
            background: var(--np-white);
            border: 1px solid rgba(0,0,0,0.08);
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            z-index: 0;
            pointer-events: none;
            opacity: 0.5;
        }

        .floating-paper::before {
            content: "";
            position: absolute;
            top: 6px;
            left: 5px;
            right: 5px;
            height: 3px;
            background: var(--np-red);
            opacity: 0.4;
        }

        .floating-paper::after {
            content: "";
            position: absolute;
            top: 13px;
            left: 5px;
            right: 5px;
            bottom: 6px;
            background: repeating-linear-gradient(
                0deg,
                rgba(0,0,0,0.1),
                rgba(0,0,0,0.1) 1px,
                transparent 1px,
                transparent 4px
            );
        }

        .floating-paper:nth-child(1) {
            top: 10%;
            left: 5%;
            animation: floatPaper1 12s ease-in-out infinite;
            transform: rotate(-15deg);
        }

        .floating-paper:nth-child(2) {
            top: 60%;
            right: 8%;
            left: auto;
            animation: floatPaper2 15s ease-in-out infinite;
            transform: rotate(10deg);
            width: 35px;
            height: 45px;
        }

        .floating-paper:nth-child(3) {
            bottom: 15%;
            left: 8%;
            animation: floatPaper3 18s ease-in-out infinite;
            transform: rotate(20deg);
            width: 30px;
            height: 38px;
        }

        .floating-paper:nth-child(4) {
            top: 20%;
            right: 12%;
            left: auto;
            animation: floatPaper1 14s ease-in-out infinite reverse;
            transform: rotate(-8deg);
            width: 28px;
            height: 35px;
            opacity: 0.35;
        }

        .floating-paper:nth-child(5) {
            bottom: 30%;
            right: 5%;
            left: auto;
            animation: floatPaper2 16s ease-in-out infinite;
            transform: rotate(25deg);
            width: 32px;
            height: 40px;
            opacity: 0.3;
        }

        @keyframes floatPaper1 {
            0%, 100% { transform: rotate(-15deg) translateY(0) translateX(0); }
            25% { transform: rotate(-10deg) translateY(-20px) translateX(10px); }
            50% { transform: rotate(-18deg) translateY(-10px) translateX(-5px); }
            75% { transform: rotate(-12deg) translateY(-25px) translateX(8px); }
        }

        @keyframes floatPaper2 {
            0%, 100% { transform: rotate(10deg) translateY(0) translateX(0); }
            33% { transform: rotate(15deg) translateY(-15px) translateX(-10px); }
            66% { transform: rotate(8deg) translateY(-25px) translateX(5px); }
        }

        @keyframes floatPaper3 {
            0%, 100% { transform: rotate(20deg) translateY(0); }
            50% { transform: rotate(15deg) translateY(-20px); }
        }

        /* ===== BREAKING NEWS TICKER (Top) ===== */
        .breaking-ticker {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 36px;
            background: var(--np-red);
            display: flex;
            align-items: center;
            z-index: 10;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(211, 47, 47, 0.3);
        }

        .breaking-label {
            background: var(--np-black);
            color: var(--np-white);
            font-family: 'Roboto', sans-serif;
            font-weight: 700;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 0 16px;
            height: 100%;
            display: flex;
            align-items: center;
            white-space: nowrap;
            position: relative;
            z-index: 2;
            animation: pulseLabel 2s ease-in-out infinite;
        }

        .breaking-label i {
            margin-right: 6px;
            font-size: 10px;
            animation: blink 1s step-end infinite;
        }

        @keyframes pulseLabel {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.85; }
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        .ticker-wrap {
            flex: 1;
            overflow: hidden;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .ticker-content {
            display: flex;
            white-space: nowrap;
            animation: ticker 35s linear infinite;
            color: var(--np-white);
            font-size: 13px;
            font-weight: 400;
            letter-spacing: 0.3px;
        }

        .ticker-content span {
            padding: 0 30px;
        }

        .ticker-content span::before {
            content: "◆";
            margin-right: 12px;
            font-size: 6px;
            vertical-align: middle;
            opacity: 0.7;
        }

        @keyframes ticker {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* ===== LOGIN CARD ===== */
        .login-card {
            width: 100%;
            max-width: 440px;
            border: none;
            border-radius: 0;
            background: var(--np-white);
            position: relative;
            z-index: 2;
            overflow: visible;
            box-shadow:
                0 0 0 1px rgba(0,0,0,0.08),
                0 4px 24px rgba(0,0,0,0.08),
                0 12px 48px rgba(0,0,0,0.05);
            animation: cardSlideIn 0.8s cubic-bezier(0.23, 1, 0.32, 1) forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        @keyframes cardSlideIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Newspaper fold line effect */
        .login-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 1px;
            height: 100%;
            background: linear-gradient(
                180deg,
                transparent 0%,
                rgba(0,0,0,0.04) 20%,
                rgba(0,0,0,0.04) 80%,
                transparent 100%
            );
            z-index: 0;
            pointer-events: none;
        }

        /* Top red accent bar */
        .login-card::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--np-red);
            z-index: 5;
        }

        /* ===== NEWSPAPER MASTHEAD DECORATION ===== */
        .masthead-deco {
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 10;
        }

        .masthead-deco .deco-line {
            width: 40px;
            height: 2px;
            background: var(--np-red);
        }

        .masthead-deco .deco-icon {
            width: 32px;
            height: 32px;
            background: var(--np-red);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--np-white);
            font-size: 14px;
            box-shadow: 0 2px 8px rgba(211,47,47,0.3);
            animation: spinIcon 8s linear infinite;
        }

        @keyframes spinIcon {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* ===== PRESS PRINTING LINE ===== */
        .press-line {
            position: absolute;
            top: 4px;
            left: 0;
            width: 60px;
            height: 2px;
            background: linear-gradient(90deg, var(--np-red), transparent);
            animation: pressSlide 3s ease-in-out infinite;
            z-index: 6;
        }

        @keyframes pressSlide {
            0% { left: -60px; opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { left: calc(100% + 60px); opacity: 0; }
        }

        /* ===== INK SPLATTER DECORATION ===== */
        .ink-dot {
            position: absolute;
            border-radius: 50%;
            background: var(--np-red);
            opacity: 0.06;
            z-index: 1;
            pointer-events: none;
        }

        .ink-dot:nth-child(1) {
            width: 80px;
            height: 80px;
            top: -20px;
            right: -20px;
            animation: inkPulse 4s ease-in-out infinite;
        }

        .ink-dot:nth-child(2) {
            width: 50px;
            height: 50px;
            bottom: -10px;
            left: -10px;
            animation: inkPulse 5s ease-in-out infinite 1s;
        }

        .ink-dot:nth-child(3) {
            width: 30px;
            height: 30px;
            top: 40%;
            right: -8px;
            animation: inkPulse 6s ease-in-out infinite 2s;
        }

        @keyframes inkPulse {
            0%, 100% { transform: scale(1); opacity: 0.06; }
            50% { transform: scale(1.2); opacity: 0.1; }
        }

        /* ===== HEADER ===== */
        .login-header {
            background: var(--np-white) !important;
            border-bottom: 3px double var(--np-black);
            padding: 28px 24px 20px !important;
            position: relative;
        }

        .login-header::before {
            content: "";
            position: absolute;
            top: 8px;
            left: 24px;
            right: 24px;
            height: 1px;
            background: var(--np-black);
        }

        .edition-line {
            font-family: 'Roboto', sans-serif;
            font-size: 9px;
            font-weight: 400;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--np-mid-gray);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .edition-line .dot {
            width: 3px;
            height: 3px;
            border-radius: 50%;
            background: var(--np-red);
            display: inline-block;
        }

        .brand-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-bottom: 6px;
        }

        .brand-icon i {
            font-size: 36px;
            color: var(--np-red);
            filter: drop-shadow(0 2px 4px rgba(211,47,47,0.2));
            animation: pressStamp 3s ease-in-out infinite;
        }

        @keyframes pressStamp {
            0%, 100% { transform: scale(1); }
            5% { transform: scale(0.95); }
            10% { transform: scale(1.02); }
            15% { transform: scale(1); }
        }

        .brand-name {
            font-family: 'UnifrakturMaguntia', 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 400;
            color: var(--np-black);
            letter-spacing: 1px;
            line-height: 1.1;
            text-shadow: 1px 1px 0 rgba(0,0,0,0.05);
        }

        .brand-subtitle {
            font-family: 'Old Standard TT', serif;
            font-size: 12px;
            font-weight: 400;
            color: var(--np-mid-gray);
            letter-spacing: 4px;
            text-transform: uppercase;
            margin-top: 4px;
            display: inline-block;
            position: relative;
        }

        .brand-subtitle::before,
        .brand-subtitle::after {
            content: "—";
            margin: 0 6px;
            color: var(--np-red);
            font-weight: 300;
        }

        .date-line {
            font-family: 'Roboto', sans-serif;
            font-size: 10px;
            color: var(--np-mid-gray);
            margin-top: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .date-line i {
            color: var(--np-red);
            margin-right: 4px;
            font-size: 9px;
        }

        /* ===== CARD BODY ===== */
        .login-body {
            padding: 28px 32px 24px !important;
            position: relative;
        }

        .section-headline {
            font-family: 'Playfair Display', serif;
            font-size: 16px;
            font-weight: 700;
            color: var(--np-black);
            text-align: center;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: relative;
            padding-bottom: 12px;
        }

        .section-headline::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 2px;
            background: var(--np-red);
        }

        /* ===== FORM GROUPS ===== */
        .form-group-custom {
            margin-bottom: 20px;
            position: relative;
        }

        .login-label {
            font-family: 'Roboto', sans-serif;
            font-size: 11px;
            font-weight: 700;
            color: var(--np-black);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 6px;
        }

        .login-label i {
            color: var(--np-red);
            font-size: 13px;
        }

        .login-input {
            font-family: 'Roboto', sans-serif;
            font-size: 14px;
            color: var(--np-black);
            background: var(--np-white);
            border: 1.5px solid var(--np-gray);
            border-radius: 0;
            padding: 12px 44px 12px 16px;
            transition: all 0.3s ease;
            width: 100%;
            position: relative;
        }

        .login-input::placeholder {
            color: #BDBDBD;
            font-size: 13px;
        }

        .login-input:focus {
            outline: none;
            border-color: var(--np-red);
            box-shadow: 0 0 0 3px rgba(211,47,47,0.08);
            background: var(--np-white);
        }

        .login-input:focus + .input-icon {
            color: var(--np-red);
        }

        .input-icon {
            position: absolute;
            right: 14px;
            top: 42px;
            color: var(--np-mid-gray);
            font-size: 16px;
            transition: color 0.3s ease;
            pointer-events: none;
        }

        /* ===== PASSWORD TOGGLE ===== */
        .password-toggle {
            position: absolute;
            right: 14px;
            top: 38px;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--np-mid-gray);
            font-size: 16px;
            padding: 4px;
            transition: color 0.3s ease;
            z-index: 3;
        }

        .password-toggle:hover {
            color: var(--np-red);
        }

        /* ===== REMEMBER ME ===== */
        .custom-check {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 16px 0;
        }

        .custom-check .form-check-input {
            width: 16px;
            height: 16px;
            border: 1.5px solid var(--np-gray);
            border-radius: 0;
            cursor: pointer;
            margin: 0;
            transition: all 0.2s ease;
        }

        .custom-check .form-check-input:checked {
            background-color: var(--np-red);
            border-color: var(--np-red);
        }

        .custom-check .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(211,47,47,0.1);
        }

        .login-remember {
            font-family: 'Roboto', sans-serif;
            font-size: 13px;
            color: var(--np-dark-gray);
            cursor: pointer;
            user-select: none;
        }

        .login-remember i {
            color: var(--np-red);
        }

        /* ===== LOGIN BUTTON ===== */
        .login-btn {
            width: 100%;
            padding: 13px 24px;
            font-family: 'Roboto', sans-serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--np-white);
            background: var(--np-red);
            border: none;
            border-radius: 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .login-btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255,255,255,0.15),
                transparent
            );
            transition: left 0.5s ease;
        }

        .login-btn:hover {
            background: var(--np-red-dark);
            box-shadow: 0 4px 16px rgba(211,47,47,0.3);
            transform: translateY(-1px);
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(211,47,47,0.2);
        }

        .login-btn .btn-spinner {
            display: none;
            animation: spin 1s linear infinite;
        }

        .login-btn.loading .btn-spinner {
            display: inline-block;
        }

        .login-btn.loading span {
            display: none;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* ===== TYPEWRITER ANIMATION ON BUTTON ===== */
        .login-btn span {
            position: relative;
        }

        /* ===== FORGOT PASSWORD LINK ===== */
        .login-link {
            font-family: 'Roboto', sans-serif;
            font-size: 12px;
            font-weight: 500;
            color: var(--np-red);
            text-decoration: none;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .login-link:hover {
            color: var(--np-red-dark);
            text-decoration: underline;
        }

        .login-link i {
            font-size: 11px;
        }

        /* ===== DIVIDER ===== */
        .divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin: 24px 0;
            color: var(--np-mid-gray);
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 2px;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: linear-gradient(
                90deg,
                transparent,
                var(--np-gray),
                transparent
            );
        }

        .divider i {
            font-size: 6px;
            color: var(--np-red);
        }

        .divider span {
            font-family: 'Playfair Display', serif;
            color: var(--np-dark-gray);
        }

        /* ===== SIGNUP SECTION ===== */
        .signup-text {
            font-family: 'Roboto', sans-serif;
            font-size: 13px;
            color: var(--np-mid-gray);
        }

        .signup-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 8px;
            padding: 10px 28px;
            font-family: 'Roboto', sans-serif;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--np-black);
            background: transparent;
            border: 1.5px solid var(--np-black);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .signup-btn:hover {
            background: var(--np-black);
            color: var(--np-white);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .signup-btn i {
            font-size: 15px;
        }

        /* ===== FOOTER ===== */
        .login-footer {
            text-align: center;
            padding: 14px 24px;
            border-top: 3px double var(--np-black);
            background: var(--np-white);
            position: relative;
        }

        .login-footer::before {
            content: "";
            position: absolute;
            bottom: 6px;
            left: 24px;
            right: 24px;
            height: 1px;
            background: var(--np-black);
            opacity: 0.15;
        }

        .login-footer span {
            font-family: 'Roboto', sans-serif;
            font-size: 11px;
            color: var(--np-mid-gray);
            letter-spacing: 1px;
        }

        .login-footer span i {
            color: var(--np-red);
            margin-right: 2px;
        }

        /* ===== PRINTING PRESS ANIMATION OVERLAY ===== */
        .press-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--np-white);
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            animation: pressReveal 1.5s ease-out forwards;
            pointer-events: none;
        }

        .press-overlay .press-text {
            font-family: 'UnifrakturMaguntia', serif;
            font-size: 28px;
            color: var(--np-black);
            animation: stampIn 0.6s ease-out 0.3s forwards;
            opacity: 0;
            transform: scale(1.5);
        }

        .press-overlay .press-bar {
            width: 60px;
            height: 3px;
            background: var(--np-red);
            margin-top: 10px;
            animation: expandBar 0.4s ease-out 0.7s forwards;
            transform: scaleX(0);
        }

        @keyframes pressReveal {
            0%, 70% { opacity: 1; }
            100% { opacity: 0; }
        }

        @keyframes stampIn {
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes expandBar {
            to { transform: scaleX(1); }
        }

        /* ===== COLUMN RULE (Newspaper Style) ===== */
        .column-rule {
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            gap: 6px;
            z-index: 10;
        }

        .column-rule .rule-line {
            width: 30px;
            height: 1px;
            background: var(--np-black);
            opacity: 0.3;
        }

        .column-rule .rule-diamond {
            width: 6px;
            height: 6px;
            background: var(--np-red);
            transform: rotate(45deg);
        }

        /* ===== INVALID FEEDBACK ===== */
        .invalid-feedback {
            font-family: 'Roboto', sans-serif;
            font-size: 12px;
            color: var(--np-red) !important;
            margin-top: 4px;
        }

        .invalid-feedback i {
            margin-right: 4px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 576px) {
            .login-container {
                padding: 50px 12px 20px;
            }

            .login-card {
                max-width: 100%;
            }

            .login-body {
                padding: 24px 20px 20px !important;
            }

            .brand-name {
                font-size: 26px;
            }

            .breaking-ticker {
                height: 30px;
            }

            .breaking-label {
                font-size: 9px;
                padding: 0 10px;
                letter-spacing: 1px;
            }

            .ticker-content {
                font-size: 11px;
            }

            .floating-paper {
                display: none;
            }
        }

        /* ===== EXTRA NEWSPAPER ANIMATIONS ===== */

        /* Ink stamp effect on header icon */
        @keyframes inkStamp {
            0% { transform: scale(0) rotate(-30deg); opacity: 0; }
            60% { transform: scale(1.15) rotate(5deg); opacity: 1; }
            80% { transform: scale(0.95) rotate(-2deg); }
            100% { transform: scale(1) rotate(0deg); opacity: 1; }
        }

        .brand-icon {
            animation: inkStamp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.5s forwards;
            opacity: 0;
        }

        /* Form fields entrance animation */
        .form-group-custom:nth-child(1) {
            animation: slideInColumn 0.5s ease-out 0.8s forwards;
            opacity: 0;
            transform: translateX(-20px);
        }

        .form-group-custom:nth-child(2) {
            animation: slideInColumn 0.5s ease-out 1s forwards;
            opacity: 0;
            transform: translateX(-20px);
        }

        @keyframes slideInColumn {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Subtle paper texture on card */
        .login-card {
            background-image:
                url("data:image/svg+xml,%3Csvg width='100' height='100' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.02'/%3E%3C/svg%3E");
            background-color: var(--np-white);
        }

        /* Typewriter cursor blink on focused input */
        .login-input:focus {
            animation: typewriterFocus 0.1s;
        }

        /* Corner fold effect */
        .corner-fold {
            position: absolute;
            top: 0;
            right: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 28px 28px 0;
            border-color: transparent var(--np-light-gray) transparent transparent;
            z-index: 6;
        }

        .corner-fold::after {
            content: "";
            position: absolute;
            top: 0;
            right: -28px;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 28px 0 0 28px;
            border-color: transparent transparent transparent rgba(0,0,0,0.03);
        }

        /* Live dot indicator */
        .live-dot {
            display: inline-block;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--np-red);
            margin-right: 4px;
            animation: livePulse 1.5s ease-in-out infinite;
        }

        @keyframes livePulse {
            0%, 100% { opacity: 1; transform: scale(1); box-shadow: 0 0 0 0 rgba(211,47,47,0.4); }
            50% { opacity: 0.7; transform: scale(1.3); box-shadow: 0 0 0 4px rgba(211,47,47,0); }
        }
    </style>

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