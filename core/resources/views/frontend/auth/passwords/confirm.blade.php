<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#05050f">
    <meta name="color-scheme" content="dark">
    <title>Confirm Password — SMART BINARY ZONE</title>
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
        <i class="bi bi-shield-check" style="color:#005fe7;font-size:16px;"></i>
        <span>256-bit encrypted</span>
    </div>

    {{-- Centered Card --}}
    <div class="de-wrapper de-wrapper-center">

        <div class="de-card-full">
            <div class="de-card">

                {{-- Card Header --}}
                <div class="de-card-hd">
                    <div class="de-card-ico">
                        <i class="bi bi-shield-fill-check"></i>
                    </div>
                    <h2 class="de-card-title">Confirm Password</h2>
                    <p class="de-card-sub">Please confirm your password before continuing.</p>
                </div>

                {{-- Card Body --}}
                <div class="de-card-body">

                    <form method="POST" action="{{ route('password.confirm') }}" id="deForm" autocomplete="off">
                        @csrf

                        {{-- Password --}}
                        <div class="de-fg">
                            <label class="de-label" for="password">Password</label>
                            <div class="de-iw">
                                <i class="bi bi-lock-fill de-ico"></i>
                                <input id="password" type="password"
                                       class="de-input @error('password') de-err @enderror"
                                       name="password"
                                       placeholder="Enter your password"
                                       required autocomplete="current-password" autofocus>
                                <button type="button" class="de-pw-tog" id="dePwTog" tabindex="-1">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                                <div class="de-glow"></div>
                            </div>
                            @error('password')
                                <span class="de-err-txt">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <button type="submit" class="de-btn" id="deBtn">
                            <span class="de-btn-txt">Confirm Password</span>
                            <span class="de-btn-ldr" id="deBtnLdr"><i class="bi bi-check-lg"></i></span>
                            <div class="de-btn-shine"></div>
                        </button>

                        {{-- Forgot Password Link --}}
                        @if (Route::has('password.request'))
                            <div class="de-login-row" style="margin-top:16px;">
                                <a href="{{ route('password.request') }}" class="de-login-link" style="font-weight:500;">
                                    Forgot Your Password?
                                </a>
                            </div>
                        @endif
                    </form>
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
// ===================== SWEETALERT2 DEFAULTS (Dark auth teal theme) =====================
Swal.setDefaults({
    background: '#05050f',
    color: '#EAEAEA',
    confirmButtonColor: '#005fe7',
    cancelButtonColor: '#64748b',
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

    // Particles
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

    // Password Toggle
    const pwToggle = document.getElementById('dePwTog');
    const pwInput = document.getElementById('password');
    if (pwToggle && pwInput) {
        pwToggle.addEventListener('click', function() {
            const t = pwInput.getAttribute('type') === 'password' ? 'text' : 'password';
            pwInput.setAttribute('type', t);
            this.querySelector('i').className = t === 'password' ? 'bi bi-eye-slash' : 'bi bi-eye';
        });
    }

    // Entrance animations
    setTimeout(function() {
        const card = document.querySelector('.de-card');
        if (card) card.classList.add('de-card-vis');
    }, 100);

    // Input focus effects
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

    // Submit button
    const form = document.getElementById('deForm');
    const btn = document.getElementById('deBtn');
    const btnLdr = document.getElementById('deBtnLdr');
    const btnTxt = btn ? btn.querySelector('.de-btn-txt') : null;
    if (form && btn) {
        form.addEventListener('submit', function() {
            btn.disabled = true;
            btn.style.pointerEvents = 'none';
            if (btnTxt) btnTxt.textContent = 'Confirming...';
            btnLdr.innerHTML = '<div class="de-spin"></div>';
            setTimeout(function() {
                if (btn.disabled) {
                    btn.disabled = false;
                    btn.style.pointerEvents = '';
                    if (btnTxt) btnTxt.textContent = 'Confirm Password';
                    btnLdr.innerHTML = '<i class="bi bi-check-lg"></i>';
                }
            }, 10000);
        });
    }

    // Mouse glow
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
/* ===== DARKEAS AUTH STYLES ===== */
* { margin:0; padding:0; box-sizing:border-box; }

.de-page {
    --brand: #005fe7;
    --brand-light: #2255ff;
    --brand-dark: #005fe7;
    --accent: #ff2d78;
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
    background: radial-gradient(circle, rgba(34,85,255,0.1), transparent 70%);
    top: -180px; left: -120px;
    animation: de-o1 14s ease-in-out infinite;
}
.de-orb-2 {
    width: 450px; height: 450px;
    background: radial-gradient(circle, rgba(255,45,120,0.06), transparent 70%);
    bottom: -120px; right: -80px;
    animation: de-o2 16s ease-in-out infinite;
}
.de-orb-3 {
    width: 350px; height: 350px;
    background: radial-gradient(circle, rgba(34,85,255,0.07), transparent 70%);
    top: 40%; left: 50%;
    animation: de-o3 18s ease-in-out infinite;
}
.de-orb-4 {
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(34,85,255,0.04), transparent 70%);
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
.de-wrapper-center { max-width:520px; }

/* ===== CARD ===== */
.de-card-full { width:100%; display:flex; align-items:center; justify-content:center; }
.de-card {
    --mx:50%; --my:50%;
    width:100%;
    background:var(--card-bg);
    backdrop-filter:blur(24px) saturate(180%);
    -webkit-backdrop-filter:blur(24px) saturate(180%);
    border:1px solid var(--card-border); border-radius:24px;
    padding:40px 36px; position:relative; overflow:hidden;
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
    box-shadow:0 20px 60px rgba(0,0,0,0.4);
    transform:translateY(-2px);
}

.de-card-hd { text-align:center; margin-bottom:28px; position:relative; z-index:1; }
.de-card-ico {
    width:52px; height:52px; display:flex; align-items:center; justify-content:center;
    background:linear-gradient(135deg,rgba(34,85,255,0.15),rgba(34,85,255,0.05));
    border:1px solid rgba(34,85,255,0.15); border-radius:14px;
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

/* Login Row */
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
@media (max-width: 576px) {
    .de-card { padding:28px 20px; border-radius:18px; }
    .de-card-title { font-size:1.4rem; }
    .de-card-ico { width:44px; height:44px; font-size:1.2rem; border-radius:12px; }
}

/* ===== SCROLLBAR ===== */
::-webkit-scrollbar { width:6px; }
::-webkit-scrollbar-track { background:var(--bg); }
::-webkit-scrollbar-thumb { background:rgba(255,255,255,0.08); border-radius:3px; }
::-webkit-scrollbar-thumb:hover { background:rgba(255,255,255,0.12); }

/* ===== SWEETALERT2 OVERRIDES (Dark auth teal) ===== */
.swal-auth2-popup {
    background: #0D0D0D !important;
    border: 1px solid rgba(34,85,255,0.15) !important;
    border-radius: 20px !important;
    box-shadow: 0 20px 60px rgba(0,0,0,0.6) !important;
    font-family: var(--font) !important;
}
.swal-auth2-popup .swal2-title { color: #EAEAEA !important; font-weight: 700 !important; }
.swal-auth2-popup .swal2-html-container { color: rgba(234,234,234,0.5) !important; }
.swal-auth2-confirm {
    background: linear-gradient(135deg, #005fe7, #2255ff) !important;
    border: none !important;
    border-radius: 10px !important;
    font-weight: 600 !important;
    padding: 10px 24px !important;
    box-shadow: 0 4px 15px rgba(34,85,255,0.3) !important;
    transition: all 0.3s ease !important;
}
.swal-auth2-confirm:hover {
    box-shadow: 0 6px 25px rgba(34,85,255,0.5) !important;
    transform: translateY(-1px) !important;
}
.swal-auth2-cancel {
    background: rgba(255,255,255,0.04) !important;
    color: rgba(234,234,234,0.5) !important;
    border: 1px solid rgba(255,255,255,0.08) !important;
    border-radius: 10px !important;
    font-weight: 500 !important;
    padding: 10px 24px !important;
    transition: all 0.3s ease !important;
}
.swal-auth2-cancel:hover {
    background: rgba(255,255,255,0.08) !important;
    border-color: rgba(255,255,255,0.12) !important;
}
.swal2-toast.swal-auth2-popup {
    background: #0D0D0D !important;
    border: 1px solid rgba(34,85,255,0.2) !important;
    box-shadow: 0 8px 32px rgba(0,0,0,0.5) !important;
}
.swal2-toast .swal2-timer-progress-bar {
    background: linear-gradient(90deg, #005fe7, #2255ff) !important;
    height: 3px !important;
}
.swal2-icon { border-color: rgba(34,85,255,0.2) !important; }
</style>
</body>
</html>
