<!-- Floating Newspaper Snippets -->
<div class="floating-snippet">
    BREAKING: Markets surge to new highs amid global recovery efforts across sectors...
</div>

<div class="floating-snippet">
    EDITORIAL: The future of digital journalism and its impact on modern society...
</div>

<div class="floating-snippet">
    WORLD: International summit addresses climate change with bold new proposals...
</div>

<div class="floating-snippet">
    TECH: Artificial intelligence reshaping the landscape of modern newsrooms...
</div>

<div class="floating-snippet">
    SPORTS: Championship finals deliver historic overtime victory for underdogs...
</div>

<div class="floating-snippet">
    OPINION: Democracy thrives when the press remains free and accountable...
</div>


<!-- LOGIN CONTAINER -->
<div class="login-container">

    <div class="login-wrapper">

        <div class="card login-card">


            <!-- HEADER -->
            <div class="card-header login-header">

                <div class="edition-bar">
                    <span>
                        <i class="bi bi-geo-alt-fill" style="color:#D32F2F;"></i>
                        Worldwide Edition
                    </span>

                    <span id="currentDate"></span>

                    <span>
                        Est. 2025
                    </span>
                </div>


                <div class="header-icon">
                    <i class="bi bi-newspaper"></i>
                </div>


                <div class="masthead-title">
                    News Portal
                </div>


                <div class="news-separator">

                    <div class="sep-line"></div>

                    <i class="bi bi-diamond-fill"></i>
                    <i class="bi bi-hexagon-fill"></i>
                    <i class="bi bi-diamond-fill"></i>

                    <div class="sep-line"></div>

                </div>


                <span class="brand-tagline">
                    Create Your Account
                    <span class="typewriter-cursor"></span>
                </span>

            </div>


            <!-- BODY -->
            <div class="card-body login-body">


                <div class="headline-deco">
                    <i class="bi bi-pencil-fill"></i>
                    Reader Registration
                    <i class="bi bi-pencil-fill"></i>
                </div>


                <form method="POST" action="{{ route('register') }}" autocomplete="off">

                    @csrf


                    <!-- NAME -->
                    <div class="input-group-animated">

                        <label for="name" class="login-label">
                            <i class="bi bi-person"></i>
                            Full Name
                        </label>

                        <div class="input-icon-wrap">

                            <i class="bi bi-person-fill"></i>

                            <input
                                id="name"
                                type="text"
                                class="form-control login-input @error('name') is-invalid @enderror"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Enter your full name"
                                required
                                autofocus
                                autocomplete="name"
                            >

                        </div>

                        @error('name')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>



                    <!-- EMAIL -->
                    <div class="input-group-animated">

                        <label for="email" class="login-label">
                            <i class="bi bi-envelope"></i>
                            Email Address
                        </label>

                        <div class="input-icon-wrap">

                            <i class="bi bi-envelope-fill"></i>

                            <input
                                id="email"
                                type="email"
                                class="form-control login-input @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="you@newsportal.com"
                                required
                                autocomplete="email"
                            >

                        </div>

                        @error('email')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>



                    <!-- PASSWORD -->
                    <div class="input-group-animated">

                        <label for="password" class="login-label">
                            <i class="bi bi-shield-lock"></i>
                            Password
                        </label>

                        <div class="input-icon-wrap">

                            <i class="bi bi-lock-fill"></i>

                            <input
                                id="password"
                                type="password"
                                class="form-control login-input @error('password') is-invalid @enderror"
                                name="password"
                                placeholder="••••••••"
                                required
                                autocomplete="new-password"
                            >

                            <button
                                type="button"
                                class="password-toggle"
                                onclick="togglePassword('password', this)"
                            >
                                <i class="bi bi-eye-slash"></i>
                            </button>

                        </div>

                        @error('password')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>



                    <!-- CONFIRM PASSWORD -->
                    <div class="input-group-animated">

                        <label for="password-confirm" class="login-label">
                            <i class="bi bi-shield-check"></i>
                            Confirm Password
                        </label>

                        <div class="input-icon-wrap">

                            <i class="bi bi-lock-fill"></i>

                            <input
                                id="password-confirm"
                                type="password"
                                class="form-control login-input"
                                name="password_confirmation"
                                placeholder="••••••••"
                                required
                                autocomplete="new-password"
                            >

                            <button
                                type="button"
                                class="password-toggle"
                                onclick="togglePassword('password-confirm', this)"
                            >
                                <i class="bi bi-eye-slash"></i>
                            </button>

                        </div>

                    </div>



                    <!-- DIVIDER -->
                    <div class="divider">

                        <span>
                            <i class="bi bi-newspaper" style="font-size:10px;"></i>
                            Start Your Story
                            <i class="bi bi-newspaper" style="font-size:10px;"></i>
                        </span>

                    </div>



                    <!-- BUTTON -->
                    <div class="input-group-animated mt-3 d-flex flex-column gap-3">

                        <button type="submit" class="btn login-btn">
                            <i class="bi bi-person-plus-fill"></i>
                            Register Now
                        </button>

                        <div class="text-center">

                            <a href="{{ route('login') }}" class="login-link">
                                <i class="bi bi-box-arrow-in-right"></i>
                                Already have an account? Sign In
                            </a>

                        </div>

                    </div>


                </form>

            </div>



            <!-- FOOTER -->
            <div class="card-footer-stamp">

                <div class="footer-text">
                    News Portal
                    <i class="bi bi-heart-fill"></i>
                    Trusted Journalism Since 2025
                </div>

            </div>


        </div>

    </div>

</div>


<!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800;900&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600;700&family=UnifrakturMaguntia&display=swap" rel="stylesheet">

    <style>
        /* ===== RESET & BASE ===== */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #F5F0EB;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            position: relative;
        }

        /* ===== NEWSPAPER BACKGROUND TEXTURE ===== */
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background:
                repeating-linear-gradient(
                    0deg,
                    transparent,
                    transparent 28px,
                    rgba(0,0,0,0.015) 28px,
                    rgba(0,0,0,0.015) 29px
                ),
                repeating-linear-gradient(
                    90deg,
                    transparent,
                    transparent 100px,
                    rgba(0,0,0,0.008) 100px,
                    rgba(0,0,0,0.008) 101px
                );
            pointer-events: none;
            z-index: 0;
        }

        /* ===== FLOATING NEWSPAPER SNIPPETS ===== */
        .floating-snippet {
            position: fixed;
            font-family: 'Libre Baskerville', serif;
            color: rgba(0,0,0,0.04);
            font-size: 11px;
            line-height: 1.4;
            max-width: 180px;
            pointer-events: none;
            z-index: 0;
            animation: floatSnippet 20s ease-in-out infinite;
        }
        .floating-snippet:nth-child(1) { top: 5%; left: 3%; animation-delay: 0s; }
        .floating-snippet:nth-child(2) { top: 15%; right: 5%; animation-delay: -4s; }
        .floating-snippet:nth-child(3) { bottom: 20%; left: 5%; animation-delay: -8s; }
        .floating-snippet:nth-child(4) { bottom: 10%; right: 3%; animation-delay: -12s; }
        .floating-snippet:nth-child(5) { top: 50%; left: 2%; animation-delay: -6s; }
        .floating-snippet:nth-child(6) { top: 40%; right: 2%; animation-delay: -10s; }

        @keyframes floatSnippet {
            0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.5; }
            25% { transform: translateY(-15px) rotate(0.5deg); opacity: 0.8; }
            50% { transform: translateY(-8px) rotate(-0.3deg); opacity: 0.6; }
            75% { transform: translateY(-20px) rotate(0.2deg); opacity: 0.9; }
        }

        /* ===== LOGIN CONTAINER ===== */
        .login-container {
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
            position: relative;
            z-index: 1;
        }

        /* ===== BREAKING NEWS TICKER (Top) ===== */
        .breaking-ticker {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #D32F2F;
            color: #FFFFFF;
            z-index: 100;
            height: 36px;
            display: flex;
            align-items: center;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(211,47,47,0.3);
        }

        .ticker-label {
            background: #000000;
            color: #FFFFFF;
            padding: 0 16px;
            height: 100%;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 700;
            font-size: 11px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            white-space: nowrap;
            position: relative;
            z-index: 2;
            font-family: 'Inter', sans-serif;
        }

        .ticker-label i {
            animation: blink 1s ease-in-out infinite;
            color: #D32F2F;
            font-size: 8px;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.2; }
        }

        .ticker-content {
            flex: 1;
            overflow: hidden;
            position: relative;
        }

        .ticker-scroll {
            display: flex;
            animation: tickerScroll 35s linear infinite;
            white-space: nowrap;
        }

        .ticker-scroll span {
            padding: 0 40px;
            font-size: 12.5px;
            font-weight: 500;
            letter-spacing: 0.3px;
            font-family: 'Inter', sans-serif;
        }

        .ticker-scroll span::before {
            content: '\25C6';
            margin-right: 12px;
            font-size: 6px;
            vertical-align: middle;
            opacity: 0.7;
        }

        @keyframes tickerScroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* ===== MAIN WRAPPER ===== */
        .login-wrapper {
            width: 100%;
            max-width: 480px;
            perspective: 1200px;
            margin-top: 20px;
        }

        /* ===== CARD ===== */
        .login-card {
            background: #FFFFFF;
            border: none;
            border-radius: 0;
            box-shadow:
                0 1px 0 0 #000000,
                0 -1px 0 0 #000000,
                1px 0 0 0 #000000,
                -1px 0 0 0 #000000,
                0 20px 60px rgba(0,0,0,0.08),
                0 8px 25px rgba(0,0,0,0.06);
            position: relative;
            overflow: hidden;
            animation: cardSlideIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
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
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 1px;
            height: 100%;
            background: linear-gradient(
                to bottom,
                transparent 0%,
                rgba(0,0,0,0.03) 10%,
                rgba(0,0,0,0.03) 90%,
                transparent 100%
            );
            z-index: 1;
            pointer-events: none;
        }

        /* Corner fold effect */
        .login-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 30px 30px 0;
            border-color: transparent #F5F0EB transparent transparent;
            z-index: 10;
            filter: drop-shadow(-1px 1px 1px rgba(0,0,0,0.08));
        }

        /* ===== HEADER ===== */
        .login-header {
            background: #FFFFFF;
            border-bottom: 3px double #000000;
            padding: 28px 30px 20px;
            text-align: center;
            position: relative;
        }

        /* Top red accent line */
        .login-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #D32F2F;
        }

        /* Edition date bar */
        .edition-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: 'Inter', sans-serif;
            font-size: 9px;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #888;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid #E0E0E0;
        }

        .header-icon {
            display: flex;
            justify-content: center;
            margin-bottom: 8px;
        }

        .header-icon i {
            font-size: 32px;
            color: #D32F2F;
            filter: drop-shadow(0 2px 4px rgba(211,47,47,0.2));
            animation: pressRotate 4s ease-in-out infinite;
        }

        @keyframes pressRotate {
            0%, 100% { transform: rotate(0deg) scale(1); }
            25% { transform: rotate(-3deg) scale(1.02); }
            75% { transform: rotate(3deg) scale(1.02); }
        }

        .masthead-title {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 900;
            color: #000000;
            letter-spacing: 2px;
            text-transform: uppercase;
            line-height: 1.1;
            margin-bottom: 4px;
            position: relative;
            display: inline-block;
        }

        /* Decorative newspaper separator */
        .news-separator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin: 12px 0 8px;
        }

        .news-separator .sep-line {
            flex: 1;
            max-width: 80px;
            height: 1px;
            background: #000000;
            position: relative;
        }

        .news-separator .sep-line::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            right: 0;
            height: 1px;
            background: #000000;
        }

        .news-separator i {
            color: #D32F2F;
            font-size: 8px;
            animation: sparkle 2s ease-in-out infinite;
        }

        .news-separator i:nth-child(3) {
            font-size: 10px;
            animation-delay: 0.3s;
        }

        @keyframes sparkle {
            0%, 100% { opacity: 0.4; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.3); }
        }

        .brand-tagline {
            display: block;
            font-family: 'Libre Baskerville', serif;
            font-size: 13px;
            font-style: italic;
            color: #555;
            margin-top: 6px;
            letter-spacing: 0.5px;
        }

        /* ===== BODY ===== */
        .login-body {
            padding: 28px 32px 32px;
            position: relative;
        }

        /* Subtle column lines */
        .login-body::before {
            content: '';
            position: absolute;
            top: 28px;
            bottom: 32px;
            left: 31px;
            width: 1px;
            background: linear-gradient(to bottom, transparent, rgba(211,47,47,0.08), transparent);
            pointer-events: none;
        }

        /* ===== FORM GROUPS ===== */
        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            appearance: none;
            border-radius: 0;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
        .form-control:focus {
            outline: none;
        }

        .input-group-animated {
            margin-bottom: 20px;
            opacity: 0;
            transform: translateX(-20px);
            animation: slideInField 0.5s ease forwards;
        }

        .input-group-animated:nth-child(1) { animation-delay: 0.2s; }
        .input-group-animated:nth-child(2) { animation-delay: 0.35s; }
        .input-group-animated:nth-child(3) { animation-delay: 0.5s; }
        .input-group-animated:nth-child(4) { animation-delay: 0.65s; }

        @keyframes slideInField {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .login-label {
            display: block;
            font-family: 'Inter', sans-serif;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #000000;
            margin-bottom: 6px;
        }

        .login-label i {
            color: #D32F2F;
            font-size: 12px;
            margin-right: 2px;
        }

        .input-icon-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon-wrap > i:first-child {
            position: absolute;
            left: 14px;
            color: #999;
            font-size: 15px;
            z-index: 2;
            transition: color 0.3s ease;
        }

        .login-input {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 2px solid #E0E0E0;
            border-radius: 0;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            color: #000000;
            background: #FAFAFA;
            transition: all 0.3s ease;
            position: relative;
        }

        .login-input::placeholder {
            color: #BDBDBD;
            font-style: italic;
            font-size: 13px;
        }

        .login-input:focus {
            border-color: #D32F2F;
            background: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(211,47,47,0.08), 0 2px 8px rgba(0,0,0,0.04);
        }

        .login-input:focus + .password-toggle,
        .input-icon-wrap:focus-within > i:first-child {
            color: #D32F2F;
        }

        /* Focus state icon color */
        .login-input:focus ~ .input-icon-wrap > i:first-child {
            color: #D32F2F;
        }

        .input-icon-wrap:focus-within > i:first-child {
            color: #D32F2F;
        }

        /* ===== PASSWORD TOGGLE ===== */
        .password-toggle {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            padding: 4px;
            font-size: 16px;
            transition: color 0.3s ease;
            z-index: 2;
        }

        .password-toggle:hover {
            color: #D32F2F;
        }

        /* ===== VALIDATION ===== */
        .is-invalid {
            border-color: #D32F2F !important;
            background-image: none;
        }

        .invalid-feedback {
            display: block;
            font-size: 11px;
            color: #D32F2F;
            margin-top: 4px;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
        }

        .invalid-feedback i {
            margin-right: 3px;
        }

        /* ===== DIVIDER ===== */
        .divider {
            display: flex;
            align-items: center;
            margin: 24px 0 4px;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, #000000, transparent);
        }

        .divider span {
            padding: 0 14px;
            font-family: 'Libre Baskerville', serif;
            font-size: 10px;
            font-style: italic;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 2px;
            white-space: nowrap;
        }

        .divider span i {
            color: #D32F2F;
            vertical-align: middle;
        }

        /* ===== BUTTON ===== */
        .btn {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .login-btn {
            width: 100%;
            padding: 13px;
            background: #D32F2F;
            color: #FFFFFF;
            border: 2px solid #D32F2F;
            border-radius: 0;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .login-btn::before {
            content: '';
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
            transition: left 0.6s ease;
        }

        .login-btn:hover {
            background: #000000;
            border-color: #000000;
            color: #FFFFFF;
            box-shadow: 0 6px 20px rgba(0,0,0,0.25);
            transform: translateY(-1px);
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:active {
            transform: translateY(0) scale(0.98);
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .login-btn i {
            margin-right: 8px;
            font-size: 15px;
        }

        /* ===== PRESS STAMP ANIMATION ON BUTTON ===== */
        @keyframes pressStamp {
            0% { transform: scale(1); }
            50% { transform: scale(0.96); }
            100% { transform: scale(1); }
        }

        .login-btn:active {
            animation: pressStamp 0.2s ease;
        }

        /* ===== LINKS ===== */
        .login-link {
            color: #D32F2F;
            text-decoration: none;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .login-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 1px;
            background: #D32F2F;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .login-link:hover {
            color: #000000;
        }

        .login-link:hover::after {
            width: 100%;
            background: #000000;
        }

        .login-link i {
            margin-right: 4px;
            font-size: 13px;
        }

        /* ===== UTILITY CLASSES ===== */
        .mt-3 { margin-top: 1rem; }
        .d-flex { display: flex; }
        .flex-column { flex-direction: column; }
        .gap-3 { gap: 1rem; }
        .text-center { text-align: center; }

        /* ===== FOOTER WATERMARK ===== */
        .card-footer-stamp {
            text-align: center;
            padding: 14px 30px;
            border-top: 1px solid #E0E0E0;
            background: #FAFAFA;
            position: relative;
        }

        .card-footer-stamp::before {
            content: '';
            position: absolute;
            top: -1px;
            left: 30px;
            right: 30px;
            height: 1px;
            background: #E0E0E0;
        }

        .footer-text {
            font-family: 'Inter', sans-serif;
            font-size: 9px;
            color: #BDBDBD;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .footer-text i {
            color: #D32F2F;
            font-size: 8px;
            margin: 0 4px;
            animation: heartbeat 1.5s ease infinite;
        }

        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            15% { transform: scale(1.15); }
            30% { transform: scale(1); }
            45% { transform: scale(1.1); }
        }

        /* ===== INK SPLASH DECORATION ===== */
        .ink-corner {
            position: absolute;
            width: 60px;
            height: 60px;
            opacity: 0.03;
            pointer-events: none;
        }

        .ink-corner.top-left {
            top: -5px;
            left: -5px;
            border-top: 3px solid #000;
            border-left: 3px solid #000;
        }

        .ink-corner.bottom-right {
            bottom: -5px;
            right: -5px;
            border-bottom: 3px solid #000;
            border-right: 3px solid #000;
        }

        /* ===== TYPEWRITER CURSOR BLINK ===== */
        .typewriter-cursor {
            display: inline-block;
            width: 2px;
            height: 14px;
            background: #D32F2F;
            margin-left: 3px;
            vertical-align: text-bottom;
            animation: cursorBlink 0.8s step-end infinite;
        }

        @keyframes cursorBlink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        /* ===== PRINTING PRESS LOADING DOTS ===== */
        .press-dots {
            display: flex;
            justify-content: center;
            gap: 4px;
            margin-top: 4px;
        }

        .press-dots span {
            width: 4px;
            height: 4px;
            background: #D32F2F;
            border-radius: 50%;
            animation: pressDot 1.4s ease-in-out infinite;
        }

        .press-dots span:nth-child(2) { animation-delay: 0.2s; }
        .press-dots span:nth-child(3) { animation-delay: 0.4s; }

        @keyframes pressDot {
            0%, 80%, 100% { transform: scale(0.6); opacity: 0.3; }
            40% { transform: scale(1.2); opacity: 1; }
        }

        /* ===== SCROLL/PAPER EDGE ===== */
        .paper-edge-top,
        .paper-edge-bottom {
            height: 6px;
            background: repeating-linear-gradient(
                90deg,
                transparent,
                transparent 8px,
                rgba(0,0,0,0.04) 8px,
                rgba(0,0,0,0.04) 9px
            );
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 520px) {
            .login-wrapper {
                max-width: 100%;
            }

            .login-header {
                padding: 24px 20px 16px;
            }

            .masthead-title {
                font-size: 26px;
            }

            .login-body {
                padding: 24px 20px 28px;
            }

            .edition-bar {
                font-size: 8px;
            }
        }

        /* ===== PAGE LOAD OVERLAY (Newspaper Print Effect) ===== */
        .print-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: #FFFFFF;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            animation: printFade 1.5s ease 1s forwards;
        }

        .print-overlay i {
            font-size: 40px;
            color: #D32F2F;
            animation: pressRotate 1s ease-in-out infinite;
        }

        .print-overlay p {
            font-family: 'Playfair Display', serif;
            font-size: 14px;
            color: #000;
            margin-top: 12px;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        @keyframes printFade {
            0% { opacity: 1; visibility: visible; }
            80% { opacity: 0; }
            100% { opacity: 0; visibility: hidden; pointer-events: none; }
        }

        /* ===== EXTRA HOVER MICRO-INTERACTIONS ===== */
        .login-card:hover {
            box-shadow:
                0 1px 0 0 #000000,
                0 -1px 0 0 #000000,
                1px 0 0 0 #000000,
                -1px 0 0 0 #000000,
                0 25px 70px rgba(0,0,0,0.1),
                0 10px 30px rgba(0,0,0,0.08);
            transition: box-shadow 0.4s ease;
        }

        /* ===== HEADLINE STYLE DECORATION ===== */
        .headline-deco {
            font-family: 'Playfair Display', serif;
            font-size: 9px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #D32F2F;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 700;
            position: relative;
            padding: 0 10px;
        }

        .headline-deco::before,
        .headline-deco::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 30%;
            height: 1px;
            background: #E0E0E0;
        }

        .headline-deco::before { left: 0; }
        .headline-deco::after { right: 0; }

        .headline-deco i {
            font-size: 7px;
            margin: 0 3px;
            vertical-align: middle;
        }
    </style>

        <!-- JavaScript -->
    <script>
        // Toggle Password Visibility
        function togglePassword(fieldId, btn) {
            const input = document.getElementById(fieldId);
            const icon = btn.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        }

        // Set Current Date in Edition Bar
        (function() {
            const now = new Date();
            const options = { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' };
            const dateStr = now.toLocaleDateString('en-US', options);
            const el = document.getElementById('currentDate');
            if (el) el.textContent = dateStr;
        })();

        // Add focus ripple effect on inputs
        document.querySelectorAll('.login-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.closest('.input-group-animated').style.transform = 'translateX(4px)';
                this.closest('.input-group-animated').style.transition = 'transform 0.3s ease';
            });

            input.addEventListener('blur', function() {
                this.closest('.input-group-animated').style.transform = 'translateX(0)';
            });
        });

        // Remove print overlay after animation
        setTimeout(() => {
            const overlay = document.querySelector('.print-overlay');
            if (overlay) overlay.remove();
        }, 2600);
    </script>