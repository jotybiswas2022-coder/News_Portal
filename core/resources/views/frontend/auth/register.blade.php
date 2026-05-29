<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#05050f">
    <meta name="color-scheme" content="dark">
    <title>Create Account — SMART BINARY ZONE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;1,9..40,400&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>

<div class="de-page">

    {{-- Background Orbs --}}
    <div class="de-orb de-orb-1"></div>
    <div class="de-orb de-orb-2"></div>
    <div class="de-orb de-orb-3"></div>
    <div class="de-orb de-orb-4"></div>

    {{-- Grid Overlay --}}
    <div class="de-grid"></div>

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
            <span class="de-bubble-line" style="width:55%;"></span>
        </div>
    </div>
    <div class="de-bubble de-bubble-3">
        <i class="bi bi-lightning-fill" style="color:#ff2d78;font-size:16px;"></i>
        <span>Lightning fast & secure</span>
    </div>

    {{-- Main Layout --}}
    <div class="de-wrapper">

        {{-- Left: Brand Section --}}
        <div class="de-brand">
            <div class="de-brand-inner">
                <div class="de-badge">Join SMART BINARY ZONE</div>

                <a href="/" class="de-logo">
                    <div class="de-logo-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                        </svg>
                    </div>
                    <span class="de-logo-text">
                        <span style="color:#ffffff">SMART</span>
                        <span style="background:linear-gradient(180deg,#6b9fff,#005fe7);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;"> BINARY</span>
                        <span style="background:linear-gradient(180deg,#ff7aad,#ff2d78);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;"> ZONE</span>
                    </span>
                </a>

                <p class="de-tagline">Start trading smarter.</p>

                {{-- Benefits --}}
                <div class="de-benefits">
                    <div class="de-benefit">
                        <div class="de-benefit-icon"><i class="bi bi-graph-up-arrow"></i></div>
                        <div class="de-benefit-info">
                            <span class="de-benefit-title">AI-Powered</span>
                            <span class="de-benefit-desc">Advanced trading algorithms</span>
                        </div>
                    </div>
                    <div class="de-benefit">
                        <div class="de-benefit-icon"><i class="bi bi-shield-check"></i></div>
                        <div class="de-benefit-info">
                            <span class="de-benefit-title">99.9% Precision</span>
                            <span class="de-benefit-desc">Backtest-verified accuracy</span>
                        </div>
                    </div>
                    <div class="de-benefit">
                        <div class="de-benefit-icon"><i class="bi bi-people-fill"></i></div>
                        <div class="de-benefit-info">
                            <span class="de-benefit-title">1M+ Traders</span>
                            <span class="de-benefit-desc">Trusted worldwide community</span>
                        </div>
                    </div>
                </div>

                {{-- Social Proof --}}
                <div class="de-social-proof">
                    <div class="de-sp-avatars">
                        <div class="de-sp-av" style="background:#005fe7;">M</div>
                        <div class="de-sp-av" style="background:#ff2d78;margin-left:-12px;">K</div>
                        <div class="de-sp-av" style="background:#2255ff;margin-left:-12px;">J</div>
                    </div>
                    <div class="de-sp-text">
                        <span>Join <strong>1M+</strong> traders already earning with SMART BINARY ZONE!</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Register Card --}}
        <div class="de-card-wrap">
            <div class="de-card">

                {{-- Card Header --}}
                <div class="de-card-hd">
                    <div class="de-card-ico">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <h2 class="de-card-title">Create Account</h2>
                    <p class="de-card-sub">Fill in your details to get started.</p>
                </div>

                {{-- Card Body --}}
                <div class="de-card-body">
                    <form method="POST" action="{{ route('register') }}" id="deForm" autocomplete="off" novalidate>
                        @csrf

                        {{-- Validation Errors --}}
                        @if ($errors->any())
                            <input type="hidden" id="deErrors" value='{{ json_encode($errors->all()) }}'>
                        @endif

                        @if (session('success'))
                            <input type="hidden" id="deSuccess" value="{{ session('success') }}">
                        @endif

                        {{-- Name --}}
                        <div class="de-fg">
                            <label class="de-label" for="deName">Full Name</label>
                            <div class="de-iw">
                                <i class="bi bi-person-fill de-ico"></i>
                                <input id="deName" type="text"
                                       class="de-input @error('name') de-err @enderror"
                                       name="name" value="{{ old('name') }}"
                                       placeholder="John Doe"
                                       required autocomplete="off" autofocus>
                                <div class="de-glow"></div>
                            </div>
                            @error('name')<span class="de-err-txt">{{ $message }}</span>@enderror
                        </div>

                        {{-- Email --}}
                        <div class="de-fg">
                            <label class="de-label" for="deEmail">Email</label>
                            <div class="de-iw">
                                <i class="bi bi-envelope-fill de-ico"></i>
                                <input id="deEmail" type="email"
                                       class="de-input @error('email') de-err @enderror"
                                       name="email" value="{{ old('email') }}"
                                       placeholder="you@example.com"
                                       required autocomplete="off">
                                <div class="de-glow"></div>
                            </div>
                            @error('email')<span class="de-err-txt">{{ $message }}</span>@enderror
                        </div>

                        {{-- Password --}}
                        <div class="de-fg">
                            <label class="de-label" for="dePass">Password</label>
                            <div class="de-iw">
                                <i class="bi bi-lock-fill de-ico"></i>
                                <input id="dePass" type="password"
                                       class="de-input @error('password') de-err @enderror"
                                       name="password"
                                       placeholder="Create a strong password"
                                       required autocomplete="off">
                                <button type="button" class="de-pw-tog" id="dePwTog1" tabindex="-1">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                                <div class="de-glow"></div>
                            </div>
                            @error('password')<span class="de-err-txt">{{ $message }}</span>@enderror

                            {{-- Password Strength --}}
                            <div class="de-ps">
                                <div class="de-ps-dots" id="dePsDots">
                                    <span class="de-ps-d"></span>
                                    <span class="de-ps-d"></span>
                                    <span class="de-ps-d"></span>
                                    <span class="de-ps-d"></span>
                                    <span class="de-ps-d"></span>
                                </div>
                                <span class="de-ps-txt" id="dePsTxt">
                                    <i class="bi bi-info-circle"></i> Use 8+ chars, uppercase, number & symbol
                                </span>
                            </div>
                        </div>

                        {{-- Confirm Password --}}
                        <div class="de-fg">
                            <label class="de-label" for="dePassConfirm">Confirm Password</label>
                            <div class="de-iw">
                                <i class="bi bi-shield-check de-ico"></i>
                                <input id="dePassConfirm" type="password"
                                       class="de-input"
                                       name="password_confirmation"
                                       placeholder="Repeat your password"
                                       required autocomplete="off">
                                <button type="button" class="de-pw-tog" id="dePwTog2" tabindex="-1">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                                <div class="de-glow"></div>
                            </div>

                            {{-- Match Indicator --}}
                            <div class="de-match" id="deMatch">
                                <div class="de-match-ico"><i class="bi bi-check-circle-fill"></i></div>
                                <span class="de-match-txt">Passwords match</span>
                            </div>
                        </div>

                        {{-- Terms --}}
                        <div class="de-terms">
                            <label class="de-cb">
                                <input type="checkbox" name="terms" id="deTerms" required>
                                <span class="de-cb-mark"><i class="bi bi-check"></i></span>
                                <span class="de-cb-label">
                                    I agree to the <a href="#" class="de-link-inline">Terms of Service</a> & <a href="#" class="de-link-inline">Privacy Policy</a>
                                </span>
                            </label>
                        </div>

                        {{-- Submit --}}
                        <button type="submit" class="de-btn" id="deBtn">
                            <span class="de-btn-txt">Create Account</span>
                            <span class="de-btn-ldr" id="deBtnLdr"><i class="bi bi-arrow-right"></i></span>
                            <div class="de-btn-shine"></div>
                        </button>
                    </form>

                    {{-- Divider --}}
                    <div class="de-div"><span>Or sign up with</span></div>

                    {{-- Social --}}
                    <div class="de-social">
                        <button type="button" class="de-soc de-soc-g" onclick="Swal.fire({icon:'info',title:'Coming Soon',text:'Google signup coming soon!',background:'#05050f',color:'#EAEAEA',confirmButtonColor:'#005fe7'})">
                            <svg viewBox="0 0 24 24" width="18" height="18">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                            Google
                        </button>
                        <button type="button" class="de-soc de-soc-gh" onclick="Swal.fire({icon:'info',title:'Coming Soon',text:'GitHub signup coming soon!',background:'#05050f',color:'#EAEAEA',confirmButtonColor:'#005fe7'})">
                            <i class="bi bi-github"></i>
                            GitHub
                        </button>
                    </div>

                    {{-- Login Link --}}
                    <div class="de-login-row">
                        <span>Already have an account?</span>
                        <a href="{{ route('login') }}" class="de-login-link">
                            Sign in <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                {{-- Card Footer --}}
                <div class="de-card-ft">
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
    const pc = document.getElementById('deParticles');
    if (pc) {
        for (let i = 0; i < 30; i++) {
            const p = document.createElement('div');
            p.className = 'de-particle';
            const s = Math.random() * 4 + 2;
            p.style.cssText = `
                width:${s}px;height:${s}px;
                left:${Math.random() * 100}%;
                animation-duration:${Math.random() * 15 + 12}s;
                animation-delay:${Math.random() * 6}s;
                bottom:-10px;
                opacity:${Math.random() * 0.4 + 0.15};
            `;
            pc.appendChild(p);
        }
    }

    // ===================== PASSWORD TOGGLE =====================
    function setupPwTog(btnId, inputId) {
        const btn = document.getElementById(btnId);
        const inp = document.getElementById(inputId);
        if (btn && inp) {
            btn.addEventListener('click', function() {
                const t = inp.getAttribute('type') === 'password' ? 'text' : 'password';
                inp.setAttribute('type', t);
                this.querySelector('i').className = t === 'password' ? 'bi bi-eye-slash' : 'bi bi-eye';
            });
        }
    }
    setupPwTog('dePwTog1', 'dePass');
    setupPwTog('dePwTog2', 'dePassConfirm');

    // ===================== PASSWORD STRENGTH =====================
    const passInput = document.getElementById('dePass');
    const confirmInput = document.getElementById('dePassConfirm');
    const psDots = document.getElementById('dePsDots');
    const psTxt = document.getElementById('dePsTxt');
    const matchEl = document.getElementById('deMatch');

    function calcStrength(pw) {
        let score = 0;
        if (pw.length >= 8) score++;
        if (pw.length >= 12) score++;
        if (/[A-Z]/.test(pw)) score++;
        if (/[0-9]/.test(pw)) score++;
        if (/[^A-Za-z0-9]/.test(pw)) score++;

        let cls = 'de-weak', txt = 'Weak — try adding more characters';
        if (score >= 4) { cls = 'de-strong'; txt = 'Strong password!'; }
        else if (score >= 2) { cls = 'de-medium'; txt = 'Getting better, add a symbol or number'; }

        return { score, cls, txt };
    }

    function updateStrength() {
        const pw = passInput.value;
        const dots = psDots.querySelectorAll('.de-ps-d');

        if (pw.length === 0) {
            dots.forEach(function(d) { d.className = 'de-ps-d'; });
            psTxt.innerHTML = '<i class="bi bi-info-circle"></i> Use 8+ chars, uppercase, number & symbol';
            psTxt.className = 'de-ps-txt';
            checkMatch();
            return;
        }

        const { score, cls, txt } = calcStrength(pw);

        dots.forEach(function(d, i) {
            d.className = 'de-ps-d';
            if (i < score) d.classList.add(cls);
        });

        psTxt.innerHTML = `<i class="bi ${score >= 4 ? 'bi-check-circle-fill' : 'bi-info-circle'}"></i> ${txt}`;
        psTxt.className = 'de-ps-txt ' + cls;
        checkMatch();
    }

    function checkMatch() {
        if (!confirmInput.value) { matchEl.classList.remove('de-match-show'); return; }
        matchEl.classList.add('de-match-show');
        if (passInput.value === confirmInput.value && passInput.value) {
            matchEl.classList.add('de-match-ok');
            matchEl.querySelector('.de-match-txt').textContent = '✓ Passwords match';
            matchEl.querySelector('.de-match-ico i').className = 'bi bi-check-circle-fill';
        } else {
            matchEl.classList.remove('de-match-ok');
            matchEl.querySelector('.de-match-txt').textContent = 'Passwords do not match';
            matchEl.querySelector('.de-match-ico i').className = 'bi bi-exclamation-circle-fill';
        }
    }

    passInput.addEventListener('input', updateStrength);
    confirmInput.addEventListener('input', checkMatch);

    // ===================== ENTRANCE ANIMATIONS =====================
    setTimeout(function() {
        const card = document.querySelector('.de-card');
        if (card) card.classList.add('de-card-vis');
    }, 100);
    setTimeout(function() {
        const brand = document.querySelector('.de-brand-inner');
        if (brand) brand.classList.add('de-brand-vis');
    }, 300);

    // ===================== INPUT FOCUS =====================
    document.querySelectorAll('.de-iw').forEach(function(w) {
        const inp = w.querySelector('.de-input');
        const ico = w.querySelector('.de-ico');
        if (inp && ico) {
            inp.addEventListener('focus', function() {
                w.classList.add('de-iw-focus');
                ico.style.color = '#005fe7';
                ico.style.transform = 'translateY(-50%) scale(1.15)';
            });
            inp.addEventListener('blur', function() {
                w.classList.remove('de-iw-focus');
                ico.style.color = '#64748b';
                ico.style.transform = 'translateY(-50%) scale(1)';
            });
        }
    });

    // ===================== SUBMIT =====================
    const form = document.getElementById('deForm');
    const btn = document.getElementById('deBtn');
    const btnLdr = document.getElementById('deBtnLdr');
    const btnTxt = btn ? btn.querySelector('.de-btn-txt') : null;

    if (form && btn) {
        form.addEventListener('submit', function(e) {
            // Client-side password match check
            if (passInput.value !== confirmInput.value) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Passwords Don\'t Match',
                    text: 'Please make sure your passwords match before submitting.',
                    background: '#05050f',
                    color: '#EAEAEA',
                    confirmButtonColor: '#005fe7',
                    confirmButtonText: 'Fix it',
                    iconColor: '#ef4444',
                });
                return;
            }

            // Client-side strength check
            if (passInput.value.length > 0 && calcStrength(passInput.value).score < 1) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Weak Password',
                    text: 'Please use at least 8 characters for a stronger password.',
                    background: '#05050f',
                    color: '#EAEAEA',
                    confirmButtonColor: '#005fe7',
                    confirmButtonText: 'OK',
                    iconColor: '#f59e0b',
                });
                return;
            }

            // Terms checkbox check
            const termsCheck = document.getElementById('deTerms');
            if (termsCheck && !termsCheck.checked) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Terms & Conditions',
                    text: 'Please agree to the Terms of Service and Privacy Policy to continue.',
                    background: '#05050f',
                    color: '#EAEAEA',
                    confirmButtonColor: '#005fe7',
                    confirmButtonText: 'I agree',
                    iconColor: '#f59e0b',
                });
                return;
            }

            // Loading state
            btn.disabled = true;
            btn.style.pointerEvents = 'none';
            if (btnTxt) btnTxt.textContent = 'Creating account...';
            btnLdr.innerHTML = '<div class="de-spin"></div>';

            setTimeout(function() {
                if (btn.disabled) {
                    btn.disabled = false;
                    btn.style.pointerEvents = '';
                    if (btnTxt) btnTxt.textContent = 'Create Account';
                    btnLdr.innerHTML = '<i class="bi bi-arrow-right"></i>';
                }
            }, 10000);
        });
    }

    // ===================== SWEETALERT2 =====================
    const errInput = document.getElementById('deErrors');
    if (errInput) {
        try {
            const errs = JSON.parse(errInput.value);
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: Array.isArray(errs) ? errs.join('\n') : errInput.value,
                background: '#05050f',
                color: '#EAEAEA',
                confirmButtonColor: '#005fe7',
                confirmButtonText: 'Try Again',
                iconColor: '#ef4444',
            });
        } catch(e) {}
    }

    const sucInput = document.getElementById('deSuccess');
    if (sucInput) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: sucInput.value,
            background: '#05050f',
            color: '#EAEAEA',
            confirmButtonColor: '#005fe7',
            timer: 3000,
            timerProgressBar: true,
            iconColor: '#22c55e',
        });
    }

    // ===================== KEYBOARD =====================
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            const a = document.activeElement;
            if (a && (a.id === 'deName' || a.id === 'deEmail' || a.id === 'dePass' || a.id === 'dePassConfirm')) {
                e.preventDefault();
                if (form) form.requestSubmit();
            }
        }
    });

    // ===================== MOUSE GLOW =====================
    const c = document.querySelector('.de-card');
    if (c) {
        c.addEventListener('mousemove', function(e) {
            const r = this.getBoundingClientRect();
            this.style.setProperty('--mx', ((e.clientX - r.left) / r.width * 100) + '%');
            this.style.setProperty('--my', ((e.clientY - r.top) / r.height * 100) + '%');
        });
    }
});
</script>

<style>
/* ===== DARKEAS AUTH STYLES (Register) ===== */
* { margin:0; padding:0; box-sizing:border-box; }

.de-page {
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
    position: fixed; border-radius: 50%; filter: blur(100px); pointer-events: none; z-index: 0;
}
.de-orb-1 {
    width: 550px; height: 550px;
    background: radial-gradient(circle, rgba(34,85,255,0.15), transparent 70%);
    top: -180px; left: -120px;
    animation: de-o1 14s ease-in-out infinite;
}
.de-orb-2 {
    width: 450px; height: 450px;
    background: radial-gradient(circle, rgba(255,45,120,0.1), transparent 70%);
    bottom: -120px; right: -80px;
    animation: de-o2 16s ease-in-out infinite;
}
.de-orb-3 {
    width: 350px; height: 350px;
    background: radial-gradient(circle, rgba(34,85,255,0.12), transparent 70%);
    top: 40%; left: 50%;
    animation: de-o3 18s ease-in-out infinite;
}
.de-orb-4 {
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(255,17,119,0.08), transparent 70%);
    bottom: 15%; left: 20%;
    animation: de-o1 22s ease-in-out infinite reverse;
}
@keyframes de-o1 { 0%,100% { transform:translate(0,0) scale(1); } 50% { transform:translate(70px,50px) scale(1.12); } }
@keyframes de-o2 { 0%,100% { transform:translate(0,0) scale(1); } 50% { transform:translate(-50px,-70px) scale(1.08); } }
@keyframes de-o3 { 0%,100% { transform:translate(0,0) scale(1); } 50% { transform:translate(30px,-40px) scale(1.15); } }

/* ===== GRID ===== */
.de-grid {
    position: fixed; inset: 0;
    background-image:
        linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
    background-size: 64px 64px;
    pointer-events: none; z-index: 1;
    mask-image: radial-gradient(ellipse at 50% 50%, black 25%, transparent 70%);
    -webkit-mask-image: radial-gradient(ellipse at 50% 50%, black 25%, transparent 70%);
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
.de-bubble-avatar { width:26px; height:26px; border-radius:50%; background:linear-gradient(135deg,var(--brand),var(--accent)); flex-shrink:0; }
.de-bubble-lines { display:flex; flex-direction:column; gap:4px; }
.de-bubble-line { width:75px; height:5px; border-radius:3px; background:rgba(255,255,255,0.08); }

/* ===== WRAPPER ===== */
.de-wrapper {
    position:relative; z-index:10;
    display:flex; align-items:center; justify-content:center;
    gap:50px; width:100%; max-width:1100px;
    padding:32px 20px; min-height:100vh; min-height:100dvh;
}

/* ===== BRAND ===== */
.de-brand { flex:1; max-width:420px; display:flex; align-items:center; justify-content:center; }
.de-brand-inner {
    opacity:0; transform:translateX(-30px);
    transition:all 0.8s cubic-bezier(.16,1,.3,1);
}
.de-brand-inner.de-brand-vis { opacity:1; transform:translateX(0); }

.de-badge {
    display:inline-flex; align-items:center; gap:6px;
    padding:5px 12px; background:rgba(0,95,231,0.1);
    border:1px solid rgba(0,95,231,0.15); border-radius:999px;
    font-size:0.78rem; font-weight:600; color:var(--brand-light);
    margin-bottom:20px; letter-spacing:0.3px;
}
.de-badge::before {
    content:''; width:5px; height:5px; border-radius:50%;
    background:var(--accent);
    animation:de-pulse 2s ease-in-out infinite;
}
@keyframes de-pulse { 0%,100% { box-shadow:0 0 0 0 rgba(255,45,120,0.6); } 50% { box-shadow:0 0 0 5px rgba(255,45,120,0); } }

.de-logo {
    display:flex; align-items:center; gap:10px;
    text-decoration:none; margin-bottom:12px;
}
.de-logo-icon {
    width:44px; height:44px; display:flex; align-items:center; justify-content:center;
    background:linear-gradient(135deg,var(--brand),var(--brand-dark));
    border-radius:12px; color:#fff;
    box-shadow:0 6px 20px rgba(34,85,255,0.3);
}
.de-logo-icon svg { width:22px; height:22px; }
.de-logo-text {
    font-family:var(--font-heading);
    font-size:2rem; font-weight:700;
    letter-spacing:-0.5px;
}
.de-tagline {
    font-size:1.05rem; color:var(--text-muted); margin-bottom:28px; line-height:1.6;
}

/* Benefits */
.de-benefits { display:flex; flex-direction:column; gap:14px; margin-bottom:28px; }
.de-benefit {
    display:flex; align-items:center; gap:14px;
    padding:12px 16px;
    background:rgba(255,255,255,0.03);
    border:1px solid rgba(255,255,255,0.05);
    border-radius:12px; transition:all 0.3s ease; cursor:default;
}
.de-benefit:hover {
    background:rgba(255,255,255,0.06);
    transform:translateX(4px);
}
.de-benefit-icon {
    width:38px; height:38px; display:flex; align-items:center; justify-content:center;
    background:linear-gradient(135deg,rgba(0,95,231,0.15),rgba(0,95,231,0.05));
    border-radius:10px; font-size:1.15rem; color:var(--brand-light); flex-shrink:0;
}
.de-benefit-info { display:flex; flex-direction:column; gap:2px; }
.de-benefit-title { font-size:0.85rem; font-weight:600; color:var(--text); }
.de-benefit-desc { font-size:0.78rem; color:var(--text-muted); }

/* Social Proof */
.de-social-proof {
    display:flex; align-items:center; gap:12px;
    padding:14px 16px; background:rgba(255,255,255,0.03);
    border:1px solid rgba(255,255,255,0.05); border-radius:12px;
}
.de-sp-avatars { display:flex; flex-shrink:0; }
.de-sp-av {
    width:32px; height:32px; border-radius:50%;
    display:flex; align-items:center; justify-content:center;
    font-size:0.75rem; font-weight:700; color:#fff;
    border:2px solid var(--bg);
}
.de-sp-text { font-size:0.82rem; color:var(--text-muted); line-height:1.4; }
.de-sp-text strong { color:var(--brand); }

/* ===== CARD ===== */
.de-card-wrap { flex:1; max-width:440px; display:flex; align-items:center; justify-content:center; }
.de-card {
    --mx:50%; --my:50%;
    width:100%;
    background:var(--card-bg);
    backdrop-filter:blur(24px) saturate(180%);
    -webkit-backdrop-filter:blur(24px) saturate(180%);
    border:1px solid var(--card-border); border-radius:24px;
    padding:36px 32px; position:relative; overflow:hidden;
    transition:all 0.6s cubic-bezier(.16,1,.3,1);
    opacity:0; transform:translateY(30px) scale(0.97);
}
.de-card.de-card-vis { opacity:1; transform:translateY(0) scale(1); }
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
.de-card-hd { text-align:center; margin-bottom:28px; position:relative; z-index:1; }
.de-card-ico {
    width:52px; height:52px; display:flex; align-items:center; justify-content:center;
    background:linear-gradient(135deg,rgba(0,95,231,0.15),rgba(0,95,231,0.05));
    border:1px solid rgba(0,95,231,0.15); border-radius:14px;
    margin:0 auto 14px; font-size:1.4rem; color:var(--brand-light);
    animation:de-ico-pulse 3s ease-in-out infinite;
}
@keyframes de-ico-pulse { 0%,100% { transform:scale(1); } 50% { transform:scale(1.05); } }
.de-card-title {
    font-family:var(--font-heading);
    font-size:1.6rem; font-weight:700;
    color:var(--text); margin-bottom:6px; letter-spacing:-0.3px;
}
.de-card-sub { font-size:0.88rem; color:var(--text-muted); }

/* Body */
.de-card-body { position:relative; z-index:1; }

/* ===== FORM ===== */
.de-fg { margin-bottom:18px; }
.de-label {
    display:block; font-size:0.82rem; font-weight:600;
    color:var(--text); margin-bottom:7px; letter-spacing:0.2px;
}
.de-iw { position:relative; border-radius:12px; overflow:hidden; }
.de-ico {
    position:absolute; left:14px; top:50%;
    transform:translateY(-50%); color:#64748b;
    z-index:2; font-size:1rem;
    transition:all 0.3s cubic-bezier(.16,1,.3,1);
}
.de-input {
    width:100%; padding:13px 42px 13px 44px;
    background:var(--input-bg); border:1.5px solid var(--input-border);
    border-radius:12px; font-family:var(--font); font-size:0.92rem;
    color:var(--text); outline:none;
    transition:all 0.3s cubic-bezier(.16,1,.3,1);
    position:relative; z-index:1;
}
.de-input::placeholder { color:#475569; }
.de-input:focus { border-color:var(--brand); box-shadow:0 0 0 4px var(--input-focus); }
.de-err { border-color:#ef4444 !important; }
.de-glow {
    position:absolute; inset:0; border-radius:12px;
    background:radial-gradient(circle at var(--mx,50%) var(--my,50%),rgba(34,85,255,0.08),transparent 60%);
    pointer-events:none; opacity:0; transition:opacity 0.3s ease; z-index:0;
}
.de-iw-focus .de-glow { opacity:1; }
.de-err-txt { display:block; color:#ef4444; font-size:0.78rem; margin-top:5px; font-weight:500; }

/* Password Toggle */
.de-pw-tog {
    position:absolute; right:10px; top:50%; transform:translateY(-50%);
    background:none; border:none; color:#64748b; font-size:1.05rem;
    cursor:pointer; padding:4px; z-index:2;
    transition:all 0.3s ease; border-radius:6px;
}
.de-pw-tog:hover { color:var(--text); background:rgba(255,255,255,0.05); }

/* Password Strength */
.de-ps {
    margin-top:10px; padding:10px 12px;
    background:rgba(255,255,255,0.03);
    border-radius:8px; border:1px solid rgba(255,255,255,0.04);
}
.de-ps-dots { display:flex; gap:5px; margin-bottom:7px; }
.de-ps-d {
    flex:1; height:4px; background:rgba(255,255,255,0.08);
    border-radius:2px; transition:all 0.3s ease;
}
.de-ps-d.de-weak { background:#ef4444; }
.de-ps-d.de-medium { background:#f59e0b; }
.de-ps-d.de-strong { background:#10b981; }
.de-ps-txt { font-size:0.75rem; display:flex; align-items:center; gap:5px; }
.de-ps-txt.de-weak { color:#ef4444; }
.de-ps-txt.de-medium { color:#f59e0b; }
.de-ps-txt.de-strong { color:#10b981; }

/* Password Match */
.de-match {
    margin-top:8px; padding:8px 12px;
    border-radius:8px; font-size:0.8rem;
    background:rgba(239,68,68,0.1); color:#ef4444;
    border-left:3px solid #ef4444;
    display:none; align-items:center; gap:7px;
}
.de-match.de-match-show { display:flex; animation:de-ms 0.3s ease-out; }
.de-match.de-match-ok { background:rgba(16,185,129,0.1); color:#10b981; border-left-color:#10b981; }
.de-match-ico { display:flex; font-size:0.95rem; }
@keyframes de-ms { from { opacity:0; transform:translateY(-8px); } to { opacity:1; transform:translateY(0); } }

/* Terms */
.de-terms { margin-bottom:20px; }
.de-cb {
    display:inline-flex; align-items:center; gap:8px; cursor:pointer; user-select:none;
}
.de-cb input { display:none; }
.de-cb-mark {
    width:18px; height:18px; border:2px solid rgba(255,255,255,0.15);
    border-radius:5px; display:flex; align-items:center; justify-content:center;
    transition:all 0.3s ease; flex-shrink:0;
}
.de-cb-mark i { font-size:11px; color:#fff; opacity:0; transform:scale(0); transition:all 0.2s ease; }
.de-cb input:checked + .de-cb-mark { background:var(--brand); border-color:var(--brand); }
.de-cb input:checked + .de-cb-mark i { opacity:1; transform:scale(1); }
.de-cb-label { font-size:0.82rem; color:var(--text-muted); font-weight:500; }
.de-link-inline { color:var(--brand); text-decoration:none; font-weight:600; transition:color 0.3s; }
.de-link-inline:hover { color:var(--brand-light); text-decoration:underline; }

/* Submit Button */
.de-btn {
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
.de-btn:hover { transform:translateY(-2px); box-shadow:0 8px 28px rgba(34,85,255,0.4); }
.de-btn:active { transform:translateY(0); }
.de-btn:disabled { opacity:0.7; cursor:not-allowed; transform:none; }
.de-btn-shine {
    position:absolute; top:0; left:-100%;
    width:60%; height:100%;
    background:linear-gradient(90deg,transparent,rgba(255,255,255,0.15),transparent);
    transform:skewX(-20deg); transition:left 0.8s ease;
}
.de-btn:hover .de-btn-shine { left:150%; }
.de-btn-ldr { font-size:1.05rem; display:flex; align-items:center; }
.de-btn:hover .de-btn-ldr i { animation:de-ba 1s ease infinite; }
@keyframes de-ba { 0%,100% { transform:translateX(0); } 50% { transform:translateX(4px); } }
.de-spin {
    width:16px; height:16px;
    border:2.5px solid rgba(255,255,255,0.3);
    border-top-color:#fff; border-radius:50%;
    animation:de-sp 0.7s linear infinite;
}
@keyframes de-sp { to { transform:rotate(360deg); } }

/* Divider */
.de-div { display:flex; align-items:center; margin:22px 0; }
.de-div::before, .de-div::after { content:''; flex:1; height:1px; background:rgba(255,255,255,0.06); }
.de-div span { padding:0 14px; font-size:0.78rem; color:var(--text-muted); font-weight:500; }

/* Social */
.de-social { display:flex; gap:10px; margin-bottom:22px; }
.de-soc {
    flex:1; display:flex; align-items:center; justify-content:center; gap:7px;
    padding:11px 14px; background:rgba(255,255,255,0.04);
    border:1px solid rgba(255,255,255,0.08); border-radius:12px;
    font-family:var(--font); font-size:0.82rem; font-weight:600;
    color:var(--text-muted); cursor:pointer;
    transition:all 0.3s ease;
}
.de-soc:hover { background:rgba(255,255,255,0.08); border-color:rgba(255,255,255,0.12); color:var(--text); transform:translateY(-1px); }

/* Login Link */
.de-login-row { text-align:center; font-size:0.88rem; color:var(--text-muted); display:flex; align-items:center; justify-content:center; gap:5px; flex-wrap:wrap; }
.de-login-link { display:inline-flex; align-items:center; gap:4px; font-weight:700; color:var(--brand); text-decoration:none; transition:all 0.3s ease; }
.de-login-link:hover { color:var(--brand-light); gap:7px; }
.de-login-link i { font-size:0.82rem; transition:transform 0.3s ease; }
.de-login-link:hover i { transform:translateX(3px); }

/* Card Footer */
.de-card-ft {
    display:flex; align-items:center; justify-content:center; gap:7px;
    margin-top:22px; padding-top:18px; border-top:1px solid rgba(255,255,255,0.05);
    position:relative; z-index:1;
}
.de-card-ft i { font-size:0.82rem; color:var(--brand); }
.de-card-ft span { font-size:0.75rem; color:var(--text-muted); }

/* ===== RESPONSIVE ===== */
@media (max-width: 968px) {
    .de-wrapper { gap:36px; }
    .de-brand { max-width:340px; }
    .de-card-wrap { max-width:400px; }
    .de-bubble { display:none; }
}
@media (max-width: 820px) {
    .de-wrapper { flex-direction:column; gap:28px; padding:20px 16px; min-height:auto; }
    .de-brand { max-width:100%; width:100%; }
    .de-brand-inner { text-align:center; }
    .de-logo { justify-content:center; }
    .de-benefits { max-width:400px; margin-left:auto; margin-right:auto; }
    .de-social-proof { justify-content:center; max-width:400px; margin:0 auto; }
    .de-card-wrap { max-width:100%; width:100%; max-width:460px; }
    .de-card { padding:28px 22px; }
    .de-card-title { font-size:1.4rem; }
}
@media (max-width: 480px) {
    .de-card { padding:22px 16px; border-radius:18px; }
    .de-social { flex-direction:column; }
    .de-logo-text { font-size:1.5rem; }
    .de-logo-icon { width:38px; height:38px; border-radius:10px; }
    .de-logo-icon svg { width:18px; height:18px; }
    .de-card-ico { width:44px; height:44px; font-size:1.2rem; border-radius:12px; }
    .de-card-title { font-size:1.3rem; }
    .de-brand-inner { text-align:center; }
    .de-badge { margin-left:auto; margin-right:auto; }
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
