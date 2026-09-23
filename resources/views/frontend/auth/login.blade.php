<!-- ===== NEWS PORTAL DARK — LOGIN PAGE ===== -->
<!-- All CSS is inline for standalone deployment -->

<div class="np-dark-wrap">

    <!-- ===== ANIMATED BACKGROUND LAYERS ===== -->

    <!-- Layer 1: Dark gradient base -->
    <div class="np-dark-bg"></div>

    <!-- Layer 2: Moving gradient orbs -->
    <div class="np-orb np-orb-1"></div>
    <div class="np-orb np-orb-2"></div>
    <div class="np-orb np-orb-3"></div>

    <!-- Layer 3: Floating newspaper particles -->
    <div class="np-float-particle" style="top:12%;left:6%;width:32px;height:40px;animation-delay:0s;opacity:0.06;"></div>
    <div class="np-float-particle" style="top:65%;right:4%;width:28px;height:36px;animation-delay:2s;opacity:0.05;"></div>
    <div class="np-float-particle" style="top:75%;left:8%;width:24px;height:30px;animation-delay:4s;opacity:0.04;"></div>
    <div class="np-float-particle" style="top:20%;right:10%;width:30px;height:38px;animation-delay:6s;opacity:0.05;"></div>
    <div class="np-float-particle" style="top:45%;left:2%;width:20px;height:26px;animation-delay:8s;opacity:0.04;"></div>
    <div class="np-float-particle" style="top:55%;right:15%;width:26px;height:34px;animation-delay:3s;opacity:0.05;"></div>

    <!-- Layer 4: Twinkling stars -->
    <div class="np-star" style="top:8%;left:12%;width:3px;height:3px;animation-delay:0s;"></div>
    <div class="np-star" style="top:30%;left:85%;width:2px;height:2px;animation-delay:1.2s;"></div>
    <div class="np-star" style="top:60%;left:5%;width:4px;height:4px;animation-delay:2.5s;"></div>
    <div class="np-star" style="top:80%;left:92%;width:2px;height:2px;animation-delay:3.8s;"></div>
    <div class="np-star" style="top:15%;left:50%;width:3px;height:3px;animation-delay:5s;"></div>
    <div class="np-star" style="top:70%;left:45%;width:2px;height:2px;animation-delay:1.8s;"></div>
    <div class="np-star" style="top:40%;left:20%;width:3px;height:3px;animation-delay:3s;"></div>
    <div class="np-star" style="top:85%;left:65%;width:2px;height:2px;animation-delay:4.5s;"></div>

    <!-- ===== BREAKING NEWS TICKER (Dark) ===== -->
    <div class="np-dark-ticker">
        <div class="np-dark-ticker-label">
            <i class="bi bi-megaphone"></i>
            <span>LIVE</span>
        </div>
        <div class="np-dark-ticker-track-wrap">
            <div class="np-dark-ticker-track">
                <span>Breaking: Global markets see historic rally as tech sector surges</span>
                <span>Weather Alert: Severe storm warning issued for coastal regions</span>
                <span>Technology: AI breakthrough promises to revolutionize healthcare</span>
                <span>Politics: World leaders gather for landmark climate summit</span>
                <span>Breaking: Global markets see historic rally as tech sector surges</span>
                <span>Weather Alert: Severe storm warning issued for coastal regions</span>
                <span>Technology: AI breakthrough promises to revolutionize healthcare</span>
                <span>Politics: World leaders gather for landmark climate summit</span>
            </div>
        </div>
    </div>

    <!-- ===== LOGIN CARD ===== -->
    <div class="np-dark-center">

        <div class="np-dark-card">

            <!-- Animated top glow bar -->
            <div class="np-dark-top-glow"></div>

            <!-- ===== HEADER ===== -->
            <div class="np-dark-head">

                <!-- Online badge -->
                <div class="np-dark-badge">
                    <span class="np-dark-badge-dot"></span>
                    Online Edition
                </div>

                <!-- Icon with ring animation -->
                <div class="np-dark-icon-ring">
                    <div class="np-dark-icon">
                        <i class="bi bi-newspaper"></i>
                    </div>
                </div>

                <!-- Title -->
                <h1 class="np-dark-title">
                    News <span>Portal</span>
                </h1>

                <!-- Subtitle with typing effect container -->
                <p class="np-dark-sub" id="npTypingSub">Delivering Truth. Every Day.</p>

                <!-- Decorative divider -->
                <div class="np-dark-divider">
                    <span class="np-dark-d-line"></span>
                    <i class="bi bi-diamond-fill"></i>
                    <span class="np-dark-d-line"></span>
                </div>

                <!-- Live status bar -->
                <div class="np-dark-status">
                    <span class="np-dark-status-dot"></span>
                    <span class="np-dark-status-text">System Online</span>
                    <span class="np-dark-status-sep">|</span>
                    <span><i class="bi bi-calendar3"></i> <span id="npLiveDate"></span></span>
                </div>

            </div>

            <!-- ===== BODY ===== -->
            <div class="np-dark-body">

                <!-- Section title -->
                <div class="np-dark-section-title">
                    <i class="bi bi-shield-check"></i>
                    <span>Subscriber Access</span>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- EMAIL -->
                    <div class="np-dark-field" style="--f-delay:0.15s;">
                        <label for="email" class="np-dark-label">
                            <i class="bi bi-envelope"></i> {{ __('Email Address') }}
                        </label>
                        <div class="np-dark-input-group">
                            <input id="email"
                                   type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   class="np-dark-input @error('email') np-dark-input-err @enderror"
                                   placeholder="you@example.com"
                                   required
                                   autocomplete="email"
                                   autofocus>
                            <i class="bi bi-envelope np-dark-input-icon"></i>
                            <div class="np-dark-input-line"></div>
                        </div>
                        @error('email')
                        <span class="np-dark-err">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <!-- PASSWORD -->
                    <div class="np-dark-field" style="--f-delay:0.3s;">
                        <label for="password" class="np-dark-label">
                            <i class="bi bi-shield-lock"></i> {{ __('Password') }}
                        </label>
                        <div class="np-dark-input-group">
                            <input id="password"
                                   type="password"
                                   name="password"
                                   class="np-dark-input @error('password') np-dark-input-err @enderror"
                                   placeholder="••••••••"
                                   required
                                   autocomplete="current-password">
                            <i class="bi bi-lock np-dark-input-icon"></i>
                            <button type="button" class="np-dark-pw-toggle" id="npPwToggle" tabindex="-1">
                                <i class="bi bi-eye" id="npPwIcon"></i>
                            </button>
                            <div class="np-dark-input-line"></div>
                        </div>
                        @error('password')
                        <span class="np-dark-err">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <!-- REMEMBER + FORGOT -->
                    <div class="np-dark-row" style="--f-delay:0.45s;">
                        <label class="np-dark-check">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="np-dark-check-box">
                                <i class="bi bi-check"></i>
                            </span>
                            <span>{{ __('Remember Me') }}</span>
                        </label>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="np-dark-forgot">
                            <i class="bi bi-key"></i> Forgot?
                        </a>
                        @endif
                    </div>

                    <!-- SUBMIT BUTTON -->
                    <button type="submit" class="np-dark-btn" id="npLoginBtn" style="--f-delay:0.6s;">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span>Sign In</span>
                        <i class="bi bi-arrow-repeat np-dark-spin"></i>
                    </button>

                </form>

                <!-- OR DIVIDER -->
                <div class="np-dark-or" style="--f-delay:0.75s;">
                    <span class="np-dark-or-line"></span>
                    <span class="np-dark-or-text">
                        <i class="bi bi-diamond-fill"></i> New Reader? <i class="bi bi-diamond-fill"></i>
                    </span>
                    <span class="np-dark-or-line"></span>
                </div>

                <!-- REGISTER -->
                <div class="np-dark-register" style="--f-delay:0.85s;">
                    <p class="np-dark-reg-text">Don't have an account yet?</p>
                    <a href="{{ route('register') }}" class="np-dark-reg-btn">
                        <i class="bi bi-person-plus"></i> Create Account
                    </a>
                </div>

            </div>

            <!-- ===== FOOTER ===== -->
            <div class="np-dark-foot">
                <span>
                    <i class="bi bi-newspaper"></i>
                    News Portal &copy; {{ date('Y') }} &mdash; All Rights Reserved
                </span>
            </div>

        </div>
    </div>

    <!-- ===== LIVE NEWS FEED OVERLAY (Scrolling headlines) ===== -->
    <div class="np-live-feed" aria-hidden="true">
        <div class="np-feed-track">
            <span>🔴 LIVE: World leaders arrive for climate summit • </span>
            <span>📰 Tech stocks hit all-time high • </span>
            <span>🌍 Major earthquake hits Pacific region • </span>
            <span>⚽ Sports: Underdog team wins championship • </span>
            <span>🔴 LIVE: World leaders arrive for climate summit • </span>
            <span>📰 Tech stocks hit all-time high • </span>
            <span>🌍 Major earthquake hits Pacific region • </span>
            <span>⚽ Sports: Underdog team wins championship • </span>
        </div>
    </div>

</div>

<!-- ===== BOOTSTRAP ICONS ===== -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<!-- ===== SCRIPTS ===== -->
<script>
    // Live date
    document.addEventListener('DOMContentLoaded', () => {
        const d = document.getElementById('npLiveDate');
        if (d) {
            d.textContent = new Date().toLocaleDateString('en-US', {
                weekday: 'short', year: 'numeric', month: 'short', day: 'numeric'
            });
        }
    });

    // Password toggle
    const pwT = document.getElementById('npPwToggle');
    const pwI = document.getElementById('npPwIcon');
    const pwIn = document.getElementById('password');
    if (pwT && pwI && pwIn) {
        pwT.addEventListener('click', () => {
            const isPw = pwIn.type === 'password';
            pwIn.type = isPw ? 'text' : 'password';
            pwI.classList.toggle('bi-eye');
            pwI.classList.toggle('bi-eye-slash');
        });
    }

    // Submit loading state
    const loginBtn = document.getElementById('npLoginBtn');
    if (loginBtn) {
        loginBtn.closest('form').addEventListener('submit', () => {
            loginBtn.classList.add('np-dark-loading');
            loginBtn.disabled = true;
        });
        // Ripple effect
        loginBtn.addEventListener('click', function(e) {
            const r = this.getBoundingClientRect();
            const ripple = document.createElement('span');
            ripple.className = 'np-dark-ripple';
            const s = Math.max(r.width, r.height);
            ripple.style.width = ripple.style.height = s + 'px';
            ripple.style.left = (e.clientX - r.left - s / 2) + 'px';
            ripple.style.top = (e.clientY - r.top - s / 2) + 'px';
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 700);
        });
    }

    // Input focus glow
    document.querySelectorAll('.np-dark-input').forEach(inp => {
        inp.addEventListener('focus', () => inp.closest('.np-dark-input-group').classList.add('focused'));
        inp.addEventListener('blur', () => inp.closest('.np-dark-input-group').classList.remove('focused'));
    });

    // Typing effect for subtitle
    (function typeEffect() {
        const el = document.getElementById('npTypingSub');
        if (!el) return;
        const words = ['Delivering Truth. Every Day.', 'Your Trusted News Source.', 'Breaking News. In-Depth Stories.', 'Stay Informed. Stay Ahead.'];
        let wordIdx = 0, charIdx = 0, isDeleting = false;
        function tick() {
            const current = words[wordIdx];
            if (!isDeleting) {
                el.textContent = current.substring(0, charIdx + 1);
                charIdx++;
                if (charIdx === current.length) {
                    setTimeout(() => { isDeleting = true; tick(); }, 2000);
                    return;
                }
                setTimeout(tick, 60 + Math.random() * 40);
            } else {
                el.textContent = current.substring(0, charIdx - 1);
                charIdx--;
                if (charIdx === 0) {
                    isDeleting = false;
                    wordIdx = (wordIdx + 1) % words.length;
                    setTimeout(tick, 400);
                    return;
                }
                setTimeout(tick, 30 + Math.random() * 20);
            }
        }
        setTimeout(tick, 1500);
    })();
</script>

<!-- ===== INLINE CSS ===== -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap');

    :root {
        --np-dark-1: #0a0a0f;
        --np-dark-2: #111118;
        --np-dark-3: #1a1a24;
        --np-dark-4: #242430;
        --np-red: #D32F2F;
        --np-red-glow: rgba(211, 47, 47, 0.3);
        --np-red-soft: rgba(211, 47, 47, 0.08);
        --np-red-dark: #B71C1C;
        --np-white: #FFFFFF;
        --np-text: #d0d0d8;
        --np-text-dim: #8888a0;
        --np-text-muted: #555568;
        --np-border: rgba(255,255,255,0.06);
        --font-headline: 'Playfair Display', Georgia, serif;
        --font-ui: 'Inter', Arial, sans-serif;
    }

    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: var(--font-ui);
        color: var(--np-text);
        background: var(--np-dark-1);
        min-height: 100vh;
        overflow-x: hidden;
        overflow-y: auto;
    }

    /* ===== DARK WRAPPER ===== */
    .np-dark-wrap {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        background: var(--np-dark-1);
        padding: 75px 16px 20px;
        overflow: hidden;
    }

    /* ===== ANIMATED BACKGROUND ===== */
    .np-dark-bg {
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse at 20% 50%, rgba(211,47,47,0.04) 0%, transparent 60%),
            radial-gradient(ellipse at 80% 50%, rgba(211,47,47,0.02) 0%, transparent 60%),
            radial-gradient(ellipse at 50% 20%, rgba(255,255,255,0.01) 0%, transparent 50%),
            linear-gradient(180deg, #0a0a0f 0%, #0f0f18 40%, #12121e 60%, #0a0a0f 100%);
        z-index: 0;
        animation: npDarkBgShift 20s ease-in-out infinite alternate;
    }

    @keyframes npDarkBgShift {
        0% { filter: brightness(1); }
        50% { filter: brightness(1.08); }
        100% { filter: brightness(0.95); }
    }

    /* Animated grid overlay */
    .np-dark-bg::after {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(255,255,255,0.012) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.012) 1px, transparent 1px);
        background-size: 80px 80px;
        animation: npGridShift 30s linear infinite;
        pointer-events: none;
    }

    @keyframes npGridShift {
        0% { transform: translate(0, 0); }
        100% { transform: translate(80px, 80px); }
    }

    /* ===== FLOATING ORBS ===== */
    .np-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        pointer-events: none;
        z-index: 0;
    }

    .np-orb-1 {
        width: 400px;
        height: 400px;
        background: rgba(211, 47, 47, 0.04);
        top: -100px;
        left: -100px;
        animation: npOrbFloat1 15s ease-in-out infinite;
    }

    .np-orb-2 {
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.02);
        bottom: -80px;
        right: -80px;
        animation: npOrbFloat2 18s ease-in-out infinite reverse;
    }

    .np-orb-3 {
        width: 200px;
        height: 200px;
        background: rgba(211, 47, 47, 0.03);
        top: 50%;
        left: 60%;
        animation: npOrbFloat3 12s ease-in-out infinite;
    }

    @keyframes npOrbFloat1 {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(60px, 40px) scale(1.1); }
        66% { transform: translate(-30px, 60px) scale(0.9); }
    }

    @keyframes npOrbFloat2 {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(-50px, -40px) scale(1.15); }
    }

    @keyframes npOrbFloat3 {
        0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.3; }
        50% { transform: translate(40px, -30px) scale(1.2); opacity: 0.5; }
    }

    /* ===== FLOATING NEWSPAPER PARTICLES ===== */
    .np-float-particle {
        position: absolute;
        background: var(--np-white);
        border: 1px solid rgba(255,255,255,0.04);
        z-index: 0;
        pointer-events: none;
        animation: npFloatParticle 18s ease-in-out infinite;
    }

    .np-float-particle::before {
        content: '';
        position: absolute;
        top: 4px;
        left: 4px;
        right: 4px;
        height: 2px;
        background: var(--np-red);
        opacity: 0.3;
    }

    .np-float-particle::after {
        content: '';
        position: absolute;
        top: 10px;
        left: 4px;
        right: 4px;
        bottom: 4px;
        background: repeating-linear-gradient(0deg, rgba(255,255,255,0.05), rgba(255,255,255,0.05) 1px, transparent 1px, transparent 3px);
    }

    @keyframes npFloatParticle {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        25% { transform: translateY(-30px) rotate(5deg); }
        50% { transform: translateY(-15px) rotate(-3deg); }
        75% { transform: translateY(-40px) rotate(8deg); }
    }

    /* ===== TWINKLING STARS ===== */
    .np-star {
        position: absolute;
        border-radius: 50%;
        background: var(--np-white);
        pointer-events: none;
        z-index: 0;
        animation: npTwinkle 3s ease-in-out infinite;
    }

    @keyframes npTwinkle {
        0%, 100% { opacity: 0.1; transform: scale(1); }
        50% { opacity: 0.6; transform: scale(1.5); box-shadow: 0 0 4px rgba(255,255,255,0.1); }
    }

    /* ===== LIVE NEWS FEED OVERLAY ===== */
    .np-live-feed {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        height: 32px;
        background: rgba(211, 47, 47, 0.12);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border-top: 1px solid rgba(211, 47, 47, 0.15);
        overflow: hidden;
        z-index: 50;
        display: flex;
        align-items: center;
    }

    .np-feed-track {
        display: flex;
        white-space: nowrap;
        animation: npFeedScroll 50s linear infinite;
        font-size: 11px;
        font-weight: 500;
        color: rgba(255,255,255,0.5);
        letter-spacing: 0.5px;
    }

    .np-feed-track span {
        padding: 0 20px;
        display: inline-flex;
        align-items: center;
    }

    @keyframes npFeedScroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* ===== DARK TICKER ===== */
    .np-dark-ticker {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 40px;
        background: rgba(10, 10, 15, 0.92);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-bottom: 1px solid var(--np-border);
        display: flex;
        align-items: center;
        z-index: 100;
        overflow: hidden;
    }

    .np-dark-ticker-label {
        background: var(--np-red);
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
    }

    .np-dark-ticker-label i {
        font-size: 12px;
        animation: npMegaphone 1s ease-in-out infinite;
    }

    @keyframes npMegaphone {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(-10deg); }
        75% { transform: rotate(10deg); }
    }

    .np-dark-ticker-label span {
        animation: npTickerPulse 1.5s step-end infinite;
    }

    @keyframes npTickerPulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.4; }
    }

    .np-dark-ticker-track-wrap {
        flex: 1;
        overflow: hidden;
        height: 100%;
        display: flex;
        align-items: center;
    }

    .np-dark-ticker-track {
        display: flex;
        white-space: nowrap;
        animation: npDarkTickerMove 40s linear infinite;
        font-size: 12px;
        font-weight: 400;
        color: rgba(255,255,255,0.55);
    }

    .np-dark-ticker-track span {
        padding: 0 28px;
        display: inline-flex;
        align-items: center;
    }

    .np-dark-ticker-track span::before {
        content: '◆';
        font-size: 6px;
        color: var(--np-red);
        margin-right: 10px;
        opacity: 0.6;
    }

    @keyframes npDarkTickerMove {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* ===== CARD CENTER ===== */
    .np-dark-center {
        position: relative;
        z-index: 10;
        width: 100%;
        max-width: 420px;
        animation: npDarkCardEntry 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    @keyframes npDarkCardEntry {
        from { opacity: 0; transform: translateY(50px) scale(0.95); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* ===== DARK CARD ===== */
    .np-dark-card {
        background: rgba(18, 18, 30, 0.85);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid var(--np-border);
        position: relative;
        overflow: visible;
        box-shadow:
            0 0 0 1px rgba(211, 47, 47, 0.03),
            0 4px 24px rgba(0,0,0,0.3),
            0 12px 60px rgba(0,0,0,0.2),
            0 0 80px rgba(211, 47, 47, 0.02);
        transition: all 0.5s ease;
    }

    .np-dark-card:hover {
        border-color: rgba(211, 47, 47, 0.08);
        box-shadow:
            0 0 0 1px rgba(211, 47, 47, 0.06),
            0 8px 40px rgba(0,0,0,0.4),
            0 20px 80px rgba(0,0,0,0.3),
            0 0 100px rgba(211, 47, 47, 0.03);
    }

    /* Animated top glow bar */
    .np-dark-top-glow {
        position: absolute;
        top: -1px;
        left: 10%;
        right: 10%;
        height: 3px;
        background: linear-gradient(90deg, transparent, var(--np-red), transparent);
        z-index: 10;
        animation: npGlowBar 3s ease-in-out infinite;
        border-radius: 0 0 2px 2px;
    }

    @keyframes npGlowBar {
        0%, 100% { opacity: 0.4; box-shadow: 0 0 8px rgba(211,47,47,0.2); left: 10%; right: 10%; }
        50% { opacity: 1; box-shadow: 0 0 20px rgba(211,47,47,0.4); left: 5%; right: 5%; }
    }

    /* ===== HEADER ===== */
    .np-dark-head {
        text-align: center;
        padding: 40px 28px 20px;
        border-bottom: 1px solid var(--np-border);
        position: relative;
    }

    .np-dark-head::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--np-red), transparent);
        opacity: 0.4;
    }

    .np-dark-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(211, 47, 47, 0.1);
        color: var(--np-red);
        padding: 4px 14px;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 16px;
        border: 1px solid rgba(211, 47, 47, 0.15);
    }

    .np-dark-badge-dot {
        width: 5px;
        height: 5px;
        background: var(--np-red);
        border-radius: 50%;
        animation: npBadgePulse 1.5s ease-in-out infinite;
    }

    @keyframes npBadgePulse {
        0%, 100% { opacity: 1; transform: scale(1); box-shadow: 0 0 0 0 rgba(211,47,47,0.4); }
        50% { opacity: 0.5; transform: scale(1.4); box-shadow: 0 0 0 5px rgba(211,47,47,0); }
    }

    .np-dark-icon-ring {
        width: 68px;
        height: 68px;
        margin: 0 auto 14px;
        border: 1px solid rgba(211, 47, 47, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        animation: npRingPulse 3s ease-in-out infinite;
        position: relative;
    }

    .np-dark-icon-ring::before {
        content: '';
        position: absolute;
        inset: -2px;
        border: 1px solid rgba(211, 47, 47, 0.05);
        animation: npRingRotate 6s linear infinite;
    }

    @keyframes npRingRotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @keyframes npRingPulse {
        0%, 100% { box-shadow: 0 0 0 0 rgba(211, 47, 47, 0.05); }
        50% { box-shadow: 0 0 20px 4px rgba(211, 47, 47, 0.08); }
    }

    .np-dark-icon {
        width: 52px;
        height: 52px;
        background: rgba(211, 47, 47, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: var(--np-red);
        transition: all 0.5s ease;
    }

    .np-dark-icon i {
        filter: drop-shadow(0 0 6px rgba(211, 47, 47, 0.3));
        animation: npIconGlow 3s ease-in-out infinite;
    }

    @keyframes npIconGlow {
        0%, 100% { filter: drop-shadow(0 0 6px rgba(211, 47, 47, 0.3)); }
        50% { filter: drop-shadow(0 0 15px rgba(211, 47, 47, 0.5)); }
    }

    .np-dark-card:hover .np-dark-icon {
        background: rgba(211, 47, 47, 0.15);
        transform: rotate(-5deg) scale(1.05);
    }

    .np-dark-title {
        font-family: var(--font-headline);
        font-size: 32px;
        font-weight: 900;
        color: var(--np-white);
        letter-spacing: -0.5px;
        line-height: 1.1;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }

    .np-dark-title span {
        color: var(--np-red);
        text-shadow: 0 0 20px rgba(211, 47, 47, 0.2);
    }

    .np-dark-sub {
        font-size: 11px;
        color: var(--np-text-dim);
        letter-spacing: 4px;
        text-transform: uppercase;
        margin-top: 4px;
        font-weight: 300;
        min-height: 18px;
    }

    .np-dark-sub::after {
        content: '|';
        color: var(--np-red);
        animation: npCursorBlink 0.8s step-end infinite;
        margin-left: 3px;
    }

    @keyframes npCursorBlink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0; }
    }

    .np-dark-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin: 12px 0;
    }

    .np-dark-d-line {
        width: 40px;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.08), transparent);
    }

    .np-dark-divider i {
        font-size: 6px;
        color: var(--np-red);
        opacity: 0.6;
    }

    .np-dark-status {
        font-size: 10px;
        color: var(--np-text-dim);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .np-dark-status i {
        color: var(--np-red);
        margin-right: 2px;
        font-size: 9px;
    }

    .np-dark-status-dot {
        width: 4px;
        height: 4px;
        background: #00c853;
        border-radius: 50%;
        animation: npStatusPulse 1.5s ease-in-out infinite;
        box-shadow: 0 0 6px rgba(0,200,83,0.4);
    }

    @keyframes npStatusPulse {
        0%, 100% { opacity: 1; transform: scale(1); box-shadow: 0 0 4px rgba(0,200,83,0.4); }
        50% { opacity: 0.5; transform: scale(1.5); box-shadow: 0 0 8px rgba(0,200,83,0.2); }
    }

    .np-dark-status-text {
        color: rgba(0,200,83,0.8);
        font-weight: 500;
    }

    .np-dark-status-sep {
        color: rgba(255,255,255,0.08);
    }

    /* ===== BODY ===== */
    .np-dark-body {
        padding: 24px 28px 28px;
    }

    .np-dark-section-title {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 600;
        color: var(--np-text-dim);
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 22px;
    }

    .np-dark-section-title i {
        color: var(--np-red);
        font-size: 14px;
    }

    .np-dark-section-title::before,
    .np-dark-section-title::after {
        content: '';
        flex: 1;
        max-width: 30px;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.06), transparent);
    }

    /* ===== FIELDS ===== */
    .np-dark-field {
        margin-bottom: 18px;
        opacity: 0;
        transform: translateX(-15px);
        animation: npDarkFieldIn 0.6s ease-out var(--f-delay, 0s) forwards;
    }

    @keyframes npDarkFieldIn {
        to { opacity: 1; transform: translateX(0); }
    }

    .np-dark-label {
        font-size: 11px;
        font-weight: 600;
        color: var(--np-text-dim);
        text-transform: uppercase;
        letter-spacing: 1.2px;
        display: flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 6px;
    }

    .np-dark-label i {
        color: var(--np-red);
        font-size: 12px;
        opacity: 0.7;
    }

    .np-dark-input-group {
        position: relative;
    }

    .np-dark-input {
        width: 100%;
        padding: 13px 44px 13px 16px;
        font-family: var(--font-ui);
        font-size: 14px;
        color: var(--np-text);
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.07);
        outline: none;
        transition: all 0.35s ease;
        position: relative;
        z-index: 2;
    }

    .np-dark-input::placeholder {
        color: var(--np-text-muted);
        font-size: 13px;
    }

    .np-dark-input:focus {
        background: rgba(255,255,255,0.05);
        border-color: rgba(211, 47, 47, 0.3);
        box-shadow:
            0 0 0 3px rgba(211, 47, 47, 0.04),
            0 0 20px rgba(211, 47, 47, 0.02);
    }

    .np-dark-input-err {
        border-color: rgba(211, 47, 47, 0.4) !important;
    }

    .np-dark-input-icon {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--np-text-muted);
        font-size: 15px;
        transition: color 0.3s ease, transform 0.3s ease;
        pointer-events: none;
        z-index: 3;
    }

    .np-dark-input-group.focused .np-dark-input-icon {
        color: var(--np-red);
        transform: translateY(-50%) scale(1.1);
    }

    .np-dark-input-line {
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--np-red), transparent);
        transition: width 0.4s ease;
        z-index: 3;
        opacity: 0;
    }

    .np-dark-input-group.focused .np-dark-input-line {
        width: 90%;
        opacity: 0.5;
    }

    /* ===== PASSWORD TOGGLE ===== */
    .np-dark-pw-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: var(--np-text-muted);
        font-size: 15px;
        padding: 4px;
        transition: color 0.3s;
        z-index: 4;
    }

    .np-dark-pw-toggle:hover {
        color: var(--np-red);
    }

    /* ===== ERROR ===== */
    .np-dark-err {
        font-size: 12px;
        color: var(--np-red);
        margin-top: 4px;
        display: block;
        font-weight: 400;
    }

    .np-dark-err i {
        margin-right: 3px;
        font-size: 11px;
    }

    /* ===== ROW ===== */
    .np-dark-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 16px 0 20px;
        opacity: 0;
        animation: npDarkFieldIn 0.6s ease-out var(--f-delay, 0s) forwards;
    }

    .np-dark-check {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        font-size: 13px;
        color: var(--np-text-dim);
        user-select: none;
    }

    .np-dark-check input {
        display: none;
    }

    .np-dark-check-box {
        width: 18px;
        height: 18px;
        border: 1.5px solid rgba(255,255,255,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.3s ease;
        background: rgba(255,255,255,0.02);
    }

    .np-dark-check-box i {
        font-size: 10px;
        color: var(--np-white);
        opacity: 0;
        transform: scale(0);
        transition: all 0.3s ease;
    }

    .np-dark-check input:checked + .np-dark-check-box {
        background: var(--np-red);
        border-color: var(--np-red);
        box-shadow: 0 0 10px rgba(211,47,47,0.2);
    }

    .np-dark-check input:checked + .np-dark-check-box i {
        opacity: 1;
        transform: scale(1);
    }

    .np-dark-forgot {
        font-size: 12px;
        color: var(--np-text-muted);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 3px;
        transition: color 0.3s;
    }

    .np-dark-forgot:hover {
        color: var(--np-red);
    }

    .np-dark-forgot i {
        font-size: 11px;
    }

    /* ===== SUBMIT BUTTON ===== */
    .np-dark-btn {
        width: 100%;
        padding: 15px 24px;
        font-family: var(--font-ui);
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--np-white);
        background: linear-gradient(135deg, var(--np-red), var(--np-red-dark));
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
        opacity: 0;
        animation: npDarkFieldIn 0.6s ease-out var(--f-delay, 0s) forwards;
        box-shadow:
            0 4px 15px rgba(211, 47, 47, 0.2),
            0 0 40px rgba(211, 47, 47, 0.03);
    }

    .np-dark-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.08), transparent);
        transition: left 0.6s ease;
    }

    .np-dark-btn:hover {
        background: linear-gradient(135deg, var(--np-red-dark), var(--np-red));
        transform: translateY(-2px);
        box-shadow:
            0 8px 25px rgba(211, 47, 47, 0.35),
            0 0 60px rgba(211, 47, 47, 0.05);
    }

    .np-dark-btn:hover::before {
        left: 100%;
    }

    .np-dark-btn:active {
        transform: translateY(0);
    }

    .np-dark-btn .np-dark-spin {
        display: none;
        animation: npBtnSpin 1s linear infinite;
    }

    .np-dark-btn.np-dark-loading .np-dark-spin {
        display: inline-block;
    }

    .np-dark-btn.np-dark-loading span {
        display: none;
    }

    @keyframes npBtnSpin {
        to { transform: rotate(360deg); }
    }

    /* Ripple */
    .np-dark-ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,0.15);
        transform: scale(0);
        animation: npRippleAnim 0.7s ease-out;
        pointer-events: none;
        z-index: 5;
    }

    @keyframes npRippleAnim {
        to { transform: scale(4); opacity: 0; }
    }

    /* ===== OR DIVIDER ===== */
    .np-dark-or {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 24px 0;
        opacity: 0;
        animation: npDarkFadeIn 0.6s ease-out var(--f-delay, 0s) forwards;
    }

    @keyframes npDarkFadeIn {
        to { opacity: 1; }
    }

    .np-dark-or-line {
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.06), transparent);
    }

    .np-dark-or-text {
        font-size: 11px;
        font-weight: 500;
        color: var(--np-text-muted);
        letter-spacing: 2px;
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .np-dark-or-text i {
        font-size: 5px;
        color: var(--np-red);
        opacity: 0.4;
    }

    /* ===== REGISTER ===== */
    .np-dark-register {
        text-align: center;
        opacity: 0;
        animation: npDarkFadeIn 0.6s ease-out var(--f-delay, 0s) forwards;
    }

    .np-dark-reg-text {
        font-size: 13px;
        color: var(--np-text-muted);
        margin-bottom: 10px;
    }

    .np-dark-reg-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 11px 30px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: var(--np-text);
        background: transparent;
        border: 1px solid rgba(255,255,255,0.1);
        text-decoration: none;
        transition: all 0.35s ease;
    }

    .np-dark-reg-btn:hover {
        border-color: var(--np-red);
        color: var(--np-white);
        background: rgba(211, 47, 47, 0.05);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(211,47,47,0.1);
    }

    .np-dark-reg-btn i {
        font-size: 14px;
    }

    /* ===== FOOTER ===== */
    .np-dark-foot {
        text-align: center;
        padding: 12px 24px;
        border-top: 1px solid var(--np-border);
        background: rgba(0,0,0,0.15);
    }

    .np-dark-foot span {
        font-size: 10px;
        color: var(--np-text-muted);
        letter-spacing: 0.5px;
    }

    .np-dark-foot i {
        color: var(--np-red);
        font-size: 9px;
        margin-right: 3px;
        opacity: 0.6;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 576px) {
        .np-dark-wrap { padding: 60px 10px 16px; }
        .np-dark-head { padding: 30px 20px 16px; }
        .np-dark-body { padding: 20px 20px 24px; }
        .np-dark-title { font-size: 26px; }
        .np-dark-icon-ring { width: 56px; height: 56px; }
        .np-dark-icon { width: 44px; height: 44px; font-size: 20px; }
        .np-dark-ticker { height: 34px; }
        .np-dark-ticker-label { font-size: 9px; padding: 0 10px; }
        .np-dark-ticker-track { font-size: 11px; }
        .np-dark-ticker-track span { padding: 0 16px; }
        .np-live-feed { height: 26px; }
        .np-feed-track { font-size: 10px; }
        .np-float-particle, .np-orb { display: none; }
        .np-dark-row { flex-direction: column; align-items: flex-start; gap: 10px; }
    }

    @media (max-width: 380px) {
        .np-dark-head { padding: 24px 16px 14px; }
        .np-dark-body { padding: 16px 16px 20px; }
        .np-dark-title { font-size: 22px; }
        .np-dark-sub { font-size: 10px; letter-spacing: 2px; }
        .np-dark-btn { padding: 13px 20px; font-size: 13px; }
    }
</style>
