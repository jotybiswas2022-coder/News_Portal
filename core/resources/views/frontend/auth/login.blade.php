<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#05050f">
    <meta name="color-scheme" content="dark">
    <title>Sign In — SMART BINARY ZONE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;1,9..40,400&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>

<div class="de-login-page">

    {{-- Background Orbs --}}
    <div class="de-orb de-orb-1"></div>
    <div class="de-orb de-orb-2"></div>
    <div class="de-orb de-orb-3"></div>
    <div class="de-orb de-orb-4"></div>

    {{-- Grid Overlay --}}
    <div class="de-grid-overlay"></div>

    {{-- Floating Particles --}}
    <div class="de-particles" id="deParticles"></div>

    {{-- Decorative Bubbles --}}
    <div class="de-bubble de-bubble-1">
        <div class="de-bubble-inner">
            <span class="de-bubble-dot" style="--clr:#005fe7;"></span>
            <span class="de-bubble-dot" style="--clr:#ff2d78;"></span>
            <span class="de-bubble-dot" style="--clr:#2255ff;"></span>
        </div>
    </div>
    <div class="de-bubble de-bubble-2">
        <div class="de-bubble-avatar"></div>
        <div class="de-bubble-lines">
            <span class="de-bubble-line"></span>
            <span class="de-bubble-line" style="width:60%;"></span>
        </div>
    </div>
    <div class="de-bubble de-bubble-3">
        <i class="bi bi-shield-check" style="color:#005fe7;font-size:16px;"></i>
        <span>256-bit encrypted</span>
    </div>

    {{-- Main Content --}}
    <div class="de-wrapper">

        {{-- Left: Brand Section --}}
        <div class="de-brand-section">
            <div class="de-brand-content">
                <div class="de-brand-badge">Welcome Back</div>

                <a href="/" class="de-brand-logo">
                    <div class="de-brand-icon-wrap">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                        </svg>
                    </div>
                    <span class="de-brand-name">
                        <span style="color:#ffffff">SMART</span>
                        <span style="background:linear-gradient(180deg,#6b9fff,#005fe7);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;"> BINARY</span>
                        <span style="background:linear-gradient(180deg,#ff7aad,#ff2d78);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;"> ZONE</span>
                    </span>
                </a>

                <p class="de-brand-tagline">Institutional-grade trading.</p>

                {{-- Stats --}}
                <div class="de-brand-stats">
                    <div class="de-stat-item">
                        <span class="de-stat-num" id="statUsers">0</span>
                        <span class="de-stat-label">Active Traders</span>
                    </div>
                    <div class="de-stat-divider"></div>
                    <div class="de-stat-item">
                        <span class="de-stat-num" id="statAccuracy">0</span>
                        <span class="de-stat-label">Avg. Accuracy</span>
                    </div>
                    <div class="de-stat-divider"></div>
                    <div class="de-stat-item">
                        <span class="de-stat-num" id="statRating">0</span>
                        <span class="de-stat-label">Avg. Rating</span>
                    </div>
                </div>

                {{-- Feature List --}}
                <div class="de-feature-list">
                    <div class="de-feature-item">
                        <i class="bi bi-graph-up-arrow"></i>
                        <span>AI-powered trading algorithms</span>
                    </div>
                    <div class="de-feature-item">
                        <i class="bi bi-shield-check"></i>
                        <span>99.9% backtest precision</span>
                    </div>
                    <div class="de-feature-item">
                        <i class="bi bi-globe2"></i>
                        <span>Trusted by 1M+ traders</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Login Card --}}
        <div class="de-card-wrapper">
            <div class="de-card">

                {{-- Card Header --}}
                <div class="de-card-header">
                    <div class="de-card-icon">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <h2 class="de-card-title">Sign In</h2>
                    <p class="de-card-subtitle">Welcome back! Enter your credentials to continue.</p>
                </div>

                {{-- Card Body --}}
                <div class="de-card-body">
                    <form method="POST" action="{{ route('login') }}" id="deLoginForm" autocomplete="off">
                        @csrf

                        {{-- Validation Errors --}}
                        @if ($errors->any())
                            <input type="hidden" id="deValidationErrors" value='{{ json_encode($errors->all()) }}'>
                        @endif

                        @if (session('success'))
                            <input type="hidden" id="deSessionSuccess" value="{{ session('success') }}">
                        @endif

                        {{-- Email --}}
                        <div class="de-input-group">
                            <label class="de-input-label" for="email">Email</label>
                            <div class="de-input-wrap">
                                <i class="bi bi-envelope-fill de-input-icon"></i>
                                <input id="email" type="email"
                                       class="de-input @error('email') de-input-error @enderror"
                                       name="email"
                                       value="{{ old('email') }}"
                                       placeholder="you@example.com"
                                       required autocomplete="off" autofocus>
                                <div class="de-input-glow"></div>
                            </div>
                            @error('email')
                                <span class="de-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="de-input-group">
                            <label class="de-input-label" for="password">Password</label>
                            <div class="de-input-wrap">
                                <i class="bi bi-lock-fill de-input-icon"></i>
                                <input id="password" type="password"
                                       class="de-input @error('password') de-input-error @enderror"
                                       name="password"
                                       placeholder="••••••••"
                                       required autocomplete="current-password">
                                <button type="button" class="de-pw-toggle" id="dePwToggle" tabindex="-1">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                                <div class="de-input-glow"></div>
                            </div>
                            @error('password')
                                <span class="de-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Options --}}
                        <div class="de-options-row">
                            <label class="de-checkbox">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class="de-checkbox-mark">
                                    <i class="bi bi-check"></i>
                                </span>
                                <span class="de-checkbox-label">Remember me</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="de-forgot-link">
                                    Forgot password?
                                </a>
                            @endif
                        </div>

                        {{-- Submit --}}
                        <button type="submit" class="de-submit-btn" id="deSubmitBtn">
                            <span class="de-btn-text">Sign In</span>
                            <span class="de-btn-loader" id="deBtnLoader">
                                <i class="bi bi-arrow-right"></i>
                            </span>
                            <div class="de-btn-shine"></div>
                        </button>
                    </form>

                    {{-- Social Login --}}
                    <div class="de-divider"><span>Or continue with</span></div>

                    <div class="de-social-row">
                        <button type="button" class="de-social-btn de-social-google" onclick="Swal.fire({icon:'info',title:'Coming Soon',text:'Google login coming soon!',background:'#05050f',color:'#EAEAEA',confirmButtonColor:'#005fe7'})">
                            <svg viewBox="0 0 24 24" width="20" height="20">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                            Google
                        </button>
                        <button type="button" class="de-social-btn de-social-github" onclick="Swal.fire({icon:'info',title:'Coming Soon',text:'GitHub login coming soon!',background:'#05050f',color:'#EAEAEA',confirmButtonColor:'#005fe7'})">
                            <i class="bi bi-github"></i>
                            GitHub
                        </button>
                    </div>

                    {{-- Sign Up Link --}}
                    <div class="de-signup-row">
                        <span>Don't have an account?</span>
                        <a href="{{ route('register') }}" class="de-signup-link">
                            Create account
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                {{-- Card Footer --}}
                <div class="de-card-footer">
                    <i class="bi bi-shield-lock-fill"></i>
                    <span>Protected with 256-bit encryption.</span>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// ===================== SWEETALERT2 DEFAULTS (Dark auth blue theme) =====================
Swal.setDefaults({
    background: '#05050f',
    color: '#EAEAEA',
    confirmButtonColor: '#005fe7',
    cancelButtonColor: '#4a5568',
    iconColor: '#005fe7',
    buttonsStyling: true,
    reverseButtons: true,
    customClass: {
        popup: 'swal-auth-popup',
        confirmButton: 'swal-auth-confirm',
        cancelButton: 'swal-auth-cancel'
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    // ===================== PARTICLES =====================
    const particlesContainer = document.getElementById('deParticles');
    if (particlesContainer) {
        for (let i = 0; i < 35; i++) {
            const particle = document.createElement('div');
            particle.className = 'de-particle';
            const size = Math.random() * 4 + 2;
            particle.style.cssText = `
                width:${size}px;height:${size}px;
                left:${Math.random() * 100}%;
                animation-duration:${Math.random() * 15 + 10}s;
                animation-delay:${Math.random() * 5}s;
                bottom:-10px;
                opacity:${Math.random() * 0.5 + 0.2};
            `;
            particlesContainer.appendChild(particle);
        }
    }

    // ===================== PASSWORD TOGGLE =====================
    const pwToggle = document.getElementById('dePwToggle');
    const pwInput = document.getElementById('password');
    if (pwToggle && pwInput) {
        pwToggle.addEventListener('click', function() {
            const type = pwInput.getAttribute('type') === 'password' ? 'text' : 'password';
            pwInput.setAttribute('type', type);
            this.querySelector('i').className = type === 'password' ? 'bi bi-eye-slash' : 'bi bi-eye';
        });
    }

    // ===================== COUNTER ANIMATION =====================
    function animateCounters() {
        const counters = [
            { el: document.getElementById('statUsers'), target: 1, suffix: 'M+' },
            { el: document.getElementById('statAccuracy'), target: 99.9, suffix: '%' },
            { el: document.getElementById('statRating'), target: 4.9, suffix: '★' },
        ];

        counters.forEach(function(c) {
            const el = c.el;
            const target = c.target;
            const suffix = c.suffix;
            if (!el) return;
            const duration = 1500;
            const startTime = performance.now();
            const isDecimal = target % 1 !== 0;

            function update(now) {
                const elapsed = now - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                const current = eased * target;
                el.textContent = (isDecimal ? current.toFixed(1) : Math.floor(current)) + suffix;
                if (progress < 1) {
                    requestAnimationFrame(update);
                } else {
                    el.textContent = (isDecimal ? target.toFixed(1) : Math.floor(target)) + suffix;
                }
            }
            requestAnimationFrame(update);
        });
    }

    // Start counters with IntersectionObserver
    const brandSection = document.querySelector('.de-brand-content');
    if (brandSection) {
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.disconnect();
                }
            });
        }, { threshold: 0.3 });
        observer.observe(brandSection);
    }

    // ===================== ENTRANCE ANIMATIONS =====================
    setTimeout(function() {
        const card = document.querySelector('.de-card');
        if (card) card.classList.add('de-card-visible');
    }, 100);

    setTimeout(function() {
        const brand = document.querySelector('.de-brand-content');
        if (brand) brand.classList.add('de-brand-visible');
    }, 300);

    // ===================== INPUT FOCUS EFFECTS =====================
    document.querySelectorAll('.de-input-wrap').forEach(function(wrap) {
        const input = wrap.querySelector('.de-input');
        const icon = wrap.querySelector('.de-input-icon');
        if (input && icon) {
            input.addEventListener('focus', function() {
                wrap.classList.add('de-input-focused');
                icon.style.color = '#005fe7';
                icon.style.transform = 'translateY(-50%) scale(1.15)';
            });
            input.addEventListener('blur', function() {
                wrap.classList.remove('de-input-focused');
                icon.style.color = '#64748b';
                icon.style.transform = 'translateY(-50%) scale(1)';
            });
        }
    });

    // ===================== SUBMIT BUTTON LOADER =====================
    const loginForm = document.getElementById('deLoginForm');
    const submitBtn = document.getElementById('deSubmitBtn');
    const btnLoader = document.getElementById('deBtnLoader');
    const btnText = submitBtn ? submitBtn.querySelector('.de-btn-text') : null;

    if (loginForm && submitBtn) {
        loginForm.addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitBtn.style.pointerEvents = 'none';
            if (btnText) btnText.textContent = 'Signing in...';
            btnLoader.innerHTML = '<div class="de-spinner"></div>';

            setTimeout(function() {
                if (submitBtn.disabled) {
                    submitBtn.disabled = false;
                    submitBtn.style.pointerEvents = '';
                    if (btnText) btnText.textContent = 'Sign In';
                    btnLoader.innerHTML = '<i class="bi bi-arrow-right"></i>';
                }
            }, 10000);
        });
    }

    // ===================== SWEETALERT2 TOASTS =====================
    const validationErrors = document.getElementById('deValidationErrors');
    if (validationErrors) {
        try {
            const errors = JSON.parse(validationErrors.value);
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: Array.isArray(errors) ? errors.join('\n') : validationErrors.value,
                background: '#05050f',
                color: '#EAEAEA',
                confirmButtonColor:'#005fe7',
                confirmButtonText: 'Try Again',
                iconColor: '#ef4444',
            });
        } catch(e) {}
    }

    const sessionSuccess = document.getElementById('deSessionSuccess');
    if (sessionSuccess) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: sessionSuccess.value,
            background: '#05050f',
            color: '#EAEAEA',
            confirmButtonColor: '#005fe7',
            timer: 3000,
            timerProgressBar: true,
            iconColor: '#22c55e',
        });
    }

    // ===================== KEYBOARD: ENTER TO SUBMIT =====================
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            const active = document.activeElement;
            if (active && (active.id === 'email' || active.id === 'password')) {
                e.preventDefault();
                if (loginForm) loginForm.requestSubmit();
            }
        }
    });

    // ===================== MOUSE GLOW ON CARD =====================
    const card = document.querySelector('.de-card');
    if (card) {
        card.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            this.style.setProperty('--mx', ((e.clientX - rect.left) / rect.width * 100) + '%');
            this.style.setProperty('--my', ((e.clientY - rect.top) / rect.height * 100) + '%');
        });
    }
});
</script>

<style>
/* ===== DARKEAS AUTH STYLES ===== */
* { margin:0; padding:0; box-sizing:border-box; }

.de-login-page {
    --brand: #005fe7;
    --brand-light: #2255ff;
    --brand-dark: #005fe7;
    --accent: #ff2d78;
    --accent-glow: #ff1177;
    --blue-edge: #2255ff;
    --pink-edge: #ff1177;
    --bg: #05050f;
    --card-bg: rgba(5,5,15,0.6);
    --card-border: rgba(255,255,255,0.06);
    --text: #EAEAEA;
    --text-muted: rgba(234,234,234,0.5);
    --input-bg: rgba(5,5,15,0.8);
    --input-border: rgba(255,255,255,0.08);
    --input-focus: rgba(0,95,231,0.15);
    --font: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif;
    --font-heading: 'Bebas Neue', 'Oswald', sans-serif;

    font-family: var(--font);
    background: var(--bg);
    color: var(--text);
    min-height: 100vh;
    min-height: 100dvh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

/* ===== ORBS ===== */
.de-orb {
    position: fixed;
    border-radius: 50%;
    filter: blur(100px);
    pointer-events: none;
    z-index: 0;
}
.de-orb-1 {
    width: 550px; height: 550px;
    background: radial-gradient(circle, rgba(34,85,255,0.15), transparent 70%);
    top: -200px; left: -150px;
    animation: de-orb-1 14s ease-in-out infinite;
}
.de-orb-2 {
    width: 450px; height: 450px;
    background: radial-gradient(circle, rgba(255,45,120,0.1), transparent 70%);
    bottom: -150px; right: -100px;
    animation: de-orb-2 16s ease-in-out infinite;
}
.de-orb-3 {
    width: 350px; height: 350px;
    background: radial-gradient(circle, rgba(34,85,255,0.12), transparent 70%);
    top: 50%; right: 40%;
    animation: de-orb-3 18s ease-in-out infinite;
}
.de-orb-4 {
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(255,17,119,0.08), transparent 70%);
    bottom: 20%; left: 30%;
    animation: de-orb-1 22s ease-in-out infinite reverse;
}
@keyframes de-orb-1 { 0%,100% { transform:translate(0,0) scale(1); } 50% { transform:translate(70px,50px) scale(1.12); } }
@keyframes de-orb-2 { 0%,100% { transform:translate(0,0) scale(1); } 50% { transform:translate(-50px,-70px) scale(1.08); } }
@keyframes de-orb-3 { 0%,100% { transform:translate(0,0) scale(1); } 50% { transform:translate(30px,-40px) scale(1.15); } }

/* ===== GRID ===== */
.de-grid-overlay {
    position: fixed;
    inset: 0;
    background-image:
        linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
    background-size: 64px 64px;
    pointer-events: none;
    z-index: 1;
    mask-image: radial-gradient(ellipse at 50% 50%, black 30%, transparent 70%);
    -webkit-mask-image: radial-gradient(ellipse at 50% 50%, black 30%, transparent 70%);
}

/* ===== PARTICLES ===== */
.de-particles { position:fixed; inset:0; overflow:hidden; pointer-events:none; z-index:1; }
.de-particle {
    position:absolute;
    background:linear-gradient(135deg,var(--brand),var(--accent));
    border-radius:50%;
    animation:de-rise linear infinite;
}
@keyframes de-rise {
    0% { transform:translateY(0) rotate(0deg); opacity:0; }
    10% { opacity:0.4; }
    90% { opacity:0.15; }
    100% { transform:translateY(-100vh) rotate(360deg); opacity:0; }
}

/* ===== BUBBLES ===== */
.de-bubble {
    position:fixed; z-index:2; pointer-events:none;
    background:rgba(255,255,255,0.03);
    backdrop-filter:blur(12px); -webkit-backdrop-filter:blur(12px);
    border:1px solid rgba(255,255,255,0.06);
    border-radius:14px; padding:10px 14px;
    display:flex; align-items:center; gap:8px;
    animation:de-bf 7s ease-in-out infinite;
}
.de-bubble-1 { top:18%; left:6%; animation-delay:0s; }
.de-bubble-2 { bottom:25%; left:8%; animation-delay:2.5s; animation-duration:8s; }
.de-bubble-3 { top:45%; right:5%; animation-delay:5s; font-size:13px; color:var(--text-muted); font-weight:500; }
@keyframes de-bf { 0%,100% { transform:translateY(0); } 50% { transform:translateY(-10px); } }
.de-bubble-inner { display:flex; gap:5px; }
.de-bubble-dot { width:7px; height:7px; border-radius:50%; background:var(--clr); animation:de-bdp 2s ease-in-out infinite; }
.de-bubble-dot:nth-child(2) { animation-delay:0.3s; }
.de-bubble-dot:nth-child(3) { animation-delay:0.6s; }
@keyframes de-bdp { 0%,100% { transform:scale(1); opacity:0.5; } 50% { transform:scale(1.3); opacity:1; } }
.de-bubble-avatar {
    width:26px; height:26px; border-radius:50%;
    background:linear-gradient(135deg,var(--brand),var(--accent));
    flex-shrink:0;
}
.de-bubble-lines { display:flex; flex-direction:column; gap:4px; }
.de-bubble-line { width:75px; height:5px; border-radius:3px; background:rgba(255,255,255,0.08); }

/* ===== WRAPPER ===== */
.de-wrapper {
    position:relative; z-index:10;
    display:flex; align-items:center; justify-content:center;
    gap:60px; width:100%; max-width:1100px;
    padding:40px 24px; min-height:100vh; min-height:100dvh;
}

/* ===== BRAND SECTION ===== */
.de-brand-section { flex:1; max-width:420px; display:flex; align-items:center; justify-content:center; }
.de-brand-content {
    opacity:0; transform:translateX(-30px);
    transition:all 0.8s cubic-bezier(.16,1,.3,1);
}
.de-brand-content.de-brand-visible { opacity:1; transform:translateX(0); }

.de-brand-badge {
    display:inline-flex; align-items:center; gap:6px;
    padding:5px 12px;
    background:rgba(0,95,231,0.1);
    border:1px solid rgba(0,95,231,0.15);
    border-radius:999px;
    font-size:0.78rem; font-weight:600; color:var(--brand-light);
    margin-bottom:20px; letter-spacing:0.3px;
}
.de-brand-badge::before {
    content:''; width:5px; height:5px; border-radius:50%;
    background:var(--accent);
    animation:de-pulse 2s ease-in-out infinite;
}
@keyframes de-pulse { 0%,100% { box-shadow:0 0 0 0 rgba(255,45,120,0.6); } 50% { box-shadow:0 0 0 5px rgba(255,45,120,0); } }

.de-brand-logo {
    display:flex; align-items:center; gap:10px;
    text-decoration:none; margin-bottom:12px;
}
.de-brand-icon-wrap {
    width:44px; height:44px; display:flex; align-items:center; justify-content:center;
    background:linear-gradient(135deg,var(--brand),var(--brand-dark));
    border-radius:12px; color:#fff;
    box-shadow:0 6px 20px rgba(34,85,255,0.3);
}
.de-brand-icon-wrap svg { width:22px; height:22px; }
.de-brand-name {
    font-family:var(--font-heading);
    font-size:2rem; font-weight:700;
    letter-spacing:-0.5px;
}
.de-brand-tagline {
    font-size:1.05rem; color:var(--text-muted); margin-bottom:28px; line-height:1.6;
}

/* Stats */
.de-brand-stats {
    display:flex; align-items:center; gap:20px;
    margin-bottom:28px;
    padding:18px 20px;
    background:rgba(255,255,255,0.03);
    border:1px solid rgba(255,255,255,0.06);
    border-radius:14px;
}
.de-stat-item { text-align:center; flex:1; }
.de-stat-num {
    display:block;
    font-family:'JetBrains Mono',monospace;
    font-size:1.5rem; font-weight:700;
    background:linear-gradient(135deg,var(--brand-light),var(--brand));
    -webkit-background-clip:text; -webkit-text-fill-color:transparent;
    background-clip:text; line-height:1.2;
}
.de-stat-label {
    font-size:0.72rem; color:var(--text-muted);
    font-weight:500; text-transform:uppercase;
    letter-spacing:0.5px; margin-top:4px;
}
.de-stat-divider {
    width:1px; height:3rem;
    background:linear-gradient(180deg,rgba(34,85,255,0.3),transparent);
}

/* Feature List */
.de-feature-list { display:flex; flex-direction:column; gap:12px; }
.de-feature-item {
    display:flex; align-items:center; gap:12px;
    font-size:0.9rem; color:var(--text-muted);
    transition:all 0.3s ease; cursor:default;
}
.de-feature-item:hover { color:var(--text); transform:translateX(4px); }
.de-feature-item i {
    font-size:1.1rem; color:var(--brand);
    width:24px; text-align:center;
}

/* ===== CARD ===== */
.de-card-wrapper { flex:1; max-width:420px; display:flex; align-items:center; justify-content:center; }
.de-card {
    --mx:50%; --my:50%;
    width:100%;
    background:var(--card-bg);
    backdrop-filter:blur(24px) saturate(180%);
    -webkit-backdrop-filter:blur(24px) saturate(180%);
    border:1px solid var(--card-border);
    border-radius:24px;
    padding:36px 32px;
    position:relative; overflow:hidden;
    transition:all 0.6s cubic-bezier(.16,1,.3,1);
    opacity:0; transform:translateY(30px) scale(0.97);
}
.de-card.de-card-visible { opacity:1; transform:translateY(0) scale(1); }
.de-card::before {
    content:''; position:absolute;
    top:var(--my); left:var(--mx);
    transform:translate(-50%,-50%);
    width:350px; height:350px;
    background:radial-gradient(circle,rgba(34,85,255,0.06),transparent 70%);
    border-radius:50%; pointer-events:none; z-index:0;
    transition:all 0.3s ease;
}
.de-card:hover {
    border-color:rgba(34,85,255,0.12);
    box-shadow:0 20px 60px rgba(0,0,0,0.4), 0 0 30px rgba(34,85,255,0.06), 0 0 60px rgba(255,17,119,0.03);
    transform:translateY(-2px);
}

/* Header */
.de-card-header { text-align:center; margin-bottom:28px; position:relative; z-index:1; }
.de-card-icon {
    width:52px; height:52px; display:flex; align-items:center; justify-content:center;
    background:linear-gradient(135deg,rgba(0,95,231,0.15),rgba(0,95,231,0.05));
    border:1px solid rgba(0,95,231,0.15); border-radius:14px;
    margin:0 auto 14px; font-size:1.4rem; color:var(--brand-light);
    animation:de-ico-pulse 3s ease-in-out infinite;
}
@keyframes de-ico-pulse { 0%,100% { transform:scale(1); } 50% { transform:scale(1.05); } }
.de-card-title {
    font-family:var(--font-heading);
    font-size:1.8rem; font-weight:700;
    color:var(--text); margin-bottom:6px; letter-spacing:-0.3px;
}
.de-card-subtitle { font-size:0.88rem; color:var(--text-muted); }

/* Body */
.de-card-body { position:relative; z-index:1; }

/* ===== INPUTS ===== */
.de-input-group { margin-bottom:18px; }
.de-input-label {
    display:block; font-size:0.82rem; font-weight:600;
    color:var(--text); margin-bottom:7px; letter-spacing:0.2px;
}
.de-input-wrap { position:relative; border-radius:12px; overflow:hidden; }
.de-input-icon {
    position:absolute; left:14px; top:50%;
    transform:translateY(-50%); color:#64748b;
    z-index:2; font-size:1rem;
    transition:all 0.3s cubic-bezier(.16,1,.3,1);
}
.de-input {
    width:100%; padding:13px 42px 13px 44px;
    background:var(--input-bg);
    border:1.5px solid var(--input-border);
    border-radius:12px;
    font-family:var(--font); font-size:0.92rem;
    color:var(--text); outline:none;
    transition:all 0.3s cubic-bezier(.16,1,.3,1);
    position:relative; z-index:1;
}
.de-input::placeholder { color:#475569; }
.de-input:focus {
    border-color:var(--brand);
    box-shadow:0 0 0 4px var(--input-focus);
}
.de-input-error { border-color:#ef4444 !important; }
.de-input-glow {
    position:absolute; inset:0; border-radius:12px;
    background:radial-gradient(circle at var(--mx,50%) var(--my,50%),rgba(34,85,255,0.08),transparent 60%);
    pointer-events:none; opacity:0; transition:opacity 0.3s ease; z-index:0;
}
.de-input-focused .de-input-glow { opacity:1; }
.de-error-text { display:block; color:#ef4444; font-size:0.78rem; margin-top:5px; font-weight:500; }

/* Password Toggle */
.de-pw-toggle {
    position:absolute; right:10px; top:50%; transform:translateY(-50%);
    background:none; border:none; color:#64748b; font-size:1.05rem;
    cursor:pointer; padding:4px; z-index:2;
    transition:all 0.3s ease; border-radius:6px;
}
.de-pw-toggle:hover { color:var(--text); background:rgba(255,255,255,0.05); }

/* Options Row */
.de-options-row {
    display:flex; align-items:center; justify-content:space-between;
    margin-bottom:22px;
}
.de-checkbox {
    display:inline-flex; align-items:center; gap:8px;
    cursor:pointer; user-select:none;
}
.de-checkbox input { display:none; }
.de-checkbox-mark {
    width:18px; height:18px;
    border:2px solid rgba(255,255,255,0.15);
    border-radius:5px;
    display:flex; align-items:center; justify-content:center;
    transition:all 0.3s ease; flex-shrink:0;
}
.de-checkbox-mark i { font-size:11px; color:#fff; opacity:0; transform:scale(0); transition:all 0.2s ease; }
.de-checkbox input:checked + .de-checkbox-mark { background:var(--brand); border-color:var(--brand); }
.de-checkbox input:checked + .de-checkbox-mark i { opacity:1; transform:scale(1); }
.de-checkbox-label { font-size:0.82rem; color:var(--text-muted); font-weight:500; }
.de-forgot-link {
    font-size:0.82rem; font-weight:600;
    color:var(--brand); text-decoration:none; transition:all 0.3s ease;
}
.de-forgot-link:hover { color:var(--brand-light); text-decoration:underline; }

/* Submit Button */
.de-submit-btn {
    width:100%; padding:14px 20px;
    background:linear-gradient(135deg,var(--brand),var(--brand-dark));
    border:none; border-radius:12px;
    font-family:var(--font); font-size:0.95rem; font-weight:700;
    color:#fff; cursor:pointer;
    display:flex; align-items:center; justify-content:center; gap:8px;
    position:relative; overflow:hidden;
    transition:all 0.4s cubic-bezier(.16,1,.3,1);
    box-shadow:0 4px 16px rgba(34,85,255,0.3);
}
.de-submit-btn:hover { transform:translateY(-2px); box-shadow:0 8px 28px rgba(34,85,255,0.4); }
.de-submit-btn:active { transform:translateY(0); }
.de-submit-btn:disabled { opacity:0.7; cursor:not-allowed; transform:none; }
.de-btn-shine {
    position:absolute; top:0; left:-100%;
    width:60%; height:100%;
    background:linear-gradient(90deg,transparent,rgba(255,255,255,0.15),transparent);
    transform:skewX(-20deg); transition:left 0.8s ease;
}
.de-submit-btn:hover .de-btn-shine { left:150%; }
.de-btn-loader { font-size:1.05rem; display:flex; align-items:center; }
.de-submit-btn:hover .de-btn-loader i { animation:de-ba 1s ease infinite; }
@keyframes de-ba { 0%,100% { transform:translateX(0); } 50% { transform:translateX(4px); } }
.de-spinner {
    width:16px; height:16px;
    border:2.5px solid rgba(255,255,255,0.3);
    border-top-color:#fff; border-radius:50%;
    animation:de-sp 0.7s linear infinite;
}
@keyframes de-sp { to { transform:rotate(360deg); } }

/* Divider */
.de-divider { display:flex; align-items:center; margin:22px 0; }
.de-divider::before, .de-divider::after { content:''; flex:1; height:1px; background:rgba(255,255,255,0.06); }
.de-divider span { padding:0 14px; font-size:0.78rem; color:var(--text-muted); font-weight:500; }

/* Social */
.de-social-row { display:flex; gap:10px; margin-bottom:22px; }
.de-social-btn {
    flex:1; display:flex; align-items:center; justify-content:center; gap:7px;
    padding:11px 14px; background:rgba(255,255,255,0.04);
    border:1px solid rgba(255,255,255,0.08); border-radius:12px;
    font-family:var(--font); font-size:0.82rem; font-weight:600;
    color:var(--text-muted); cursor:pointer;
    transition:all 0.3s ease;
}
.de-social-btn:hover { background:rgba(255,255,255,0.08); border-color:rgba(255,255,255,0.12); color:var(--text); transform:translateY(-1px); }

/* Signup Row */
.de-signup-row { text-align:center; font-size:0.88rem; color:var(--text-muted); display:flex; align-items:center; justify-content:center; gap:5px; flex-wrap:wrap; }
.de-signup-link { display:inline-flex; align-items:center; gap:4px; font-weight:700; color:var(--brand); text-decoration:none; transition:all 0.3s ease; }
.de-signup-link:hover { color:var(--brand-light); gap:7px; }
.de-signup-link i { font-size:0.82rem; transition:transform 0.3s ease; }
.de-signup-link:hover i { transform:translateX(3px); }

/* Card Footer */
.de-card-footer {
    display:flex; align-items:center; justify-content:center; gap:7px;
    margin-top:22px; padding-top:18px;
    border-top:1px solid rgba(255,255,255,0.05);
    position:relative; z-index:1;
}
.de-card-footer i { font-size:0.82rem; color:var(--brand); }
.de-card-footer span { font-size:0.75rem; color:var(--text-muted); }

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .de-wrapper { gap:40px; }
    .de-brand-section { max-width:340px; }
    .de-card-wrapper { max-width:380px; }
    .de-bubble { display:none; }
}
@media (max-width: 860px) {
    .de-wrapper { flex-direction:column; gap:32px; padding:24px 16px; min-height:auto; }
    .de-brand-section { max-width:100%; width:100%; }
    .de-brand-content { text-align:center; }
    .de-brand-logo { justify-content:center; }
    .de-feature-list { flex-direction:row; flex-wrap:wrap; justify-content:center; }
    .de-brand-stats { padding:14px; max-width:340px; margin-left:auto; margin-right:auto; }
    .de-stat-num { font-size:1.3rem; }
    .de-card-wrapper { max-width:100%; width:100%; }
    .de-card { padding:28px 22px; }
    .de-card-title { font-size:1.5rem; }
    .de-brand-tagline { margin-bottom:24px; }
    .de-brand-stats { margin-bottom:24px; }
}
@media (max-width: 480px) {
    .de-card { padding:22px 16px; border-radius:20px; }
    .de-social-row { flex-direction:column; }
    .de-options-row { flex-direction:column; gap:12px; align-items:flex-start; }
    .de-brand-name { font-size:1.5rem; }
    .de-brand-icon-wrap { width:38px; height:38px; border-radius:10px; }
    .de-brand-icon-wrap svg { width:18px; height:18px; }
    .de-card-icon { width:44px; height:44px; font-size:1.2rem; border-radius:12px; }
    .de-card-title { font-size:1.4rem; }
}

/* ===== SCROLLBAR ===== */
::-webkit-scrollbar { width:6px; }
::-webkit-scrollbar-track { background:var(--bg); }
::-webkit-scrollbar-thumb { background:rgba(255,255,255,0.08); border-radius:3px; }
::-webkit-scrollbar-thumb:hover { background:rgba(255,255,255,0.12); }

/* ===== SWEETALERT2 OVERRIDES (Dark auth blue) ===== */
.swal-auth-popup {
    background: #05050f !important;
    border: 1px solid rgba(0,95,231,0.15) !important;
    border-radius: 20px !important;
    box-shadow: 0 20px 60px rgba(0,0,0,0.6) !important;
    font-family: var(--font) !important;
}
.swal-auth-popup .swal2-title { color: #EAEAEA !important; font-weight: 700 !important; }
.swal-auth-popup .swal2-html-container { color: rgba(234,234,234,0.5) !important; }
.swal-auth-confirm {
    background: linear-gradient(135deg, #005fe7, #2255ff) !important;
    border: none !important;
    border-radius: 10px !important;
    font-weight: 600 !important;
    padding: 10px 24px !important;
    box-shadow: 0 4px 15px rgba(34,85,255,0.3) !important;
    transition: all 0.3s ease !important;
}
.swal-auth-confirm:hover {
    box-shadow: 0 6px 25px rgba(34,85,255,0.5) !important;
    transform: translateY(-1px) !important;
}
.swal-auth-cancel {
    background: rgba(255,255,255,0.04) !important;
    color: rgba(234,234,234,0.5) !important;
    border: 1px solid rgba(255,255,255,0.08) !important;
    border-radius: 10px !important;
    font-weight: 500 !important;
    padding: 10px 24px !important;
    transition: all 0.3s ease !important;
}
.swal-auth-cancel:hover {
    background: rgba(255,255,255,0.08) !important;
    border-color: rgba(255,255,255,0.12) !important;
}
.swal2-toast.swal-auth-popup {
    background: #05050f !important;
    border: 1px solid rgba(0,95,231,0.2) !important;
    box-shadow: 0 8px 32px rgba(0,0,0,0.5) !important;
}
.swal2-toast .swal2-timer-progress-bar {
    background: linear-gradient(90deg, #005fe7, #ff2d78) !important;
    height: 3px !important;
}
.swal2-icon { border-color: rgba(0,95,231,0.2) !important; }
</style>
</body>
</html>
