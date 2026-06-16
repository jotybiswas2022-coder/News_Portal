@php
use App\Models\Setting;
$settings = Setting::first();
$email = $settings?->email ?? '';
$phone = $settings?->phone ?? '';
$location = $settings?->location ?? '';
@endphp

<!-- ===== NEWS PORTAL DARK — FOOTER & CONTACT ===== -->

<!-- Floating news particles -->
<div class="np-foot-particles" id="footParticles"></div>

<section class="np-contact-section" id="contactSection">

    <div class="np-contact-container">

        <div class="np-contact-header">
            <h2>Get In <span>Touch</span></h2>
            <p>We value your feedback, questions, and news tips</p>
        </div>

        <div class="np-contact-grid">

            <div class="np-contact-form-card">

                <div class="np-success-overlay" id="successOverlay">
                    <div class="np-success-icon">
                        <i class="bi bi-check-lg"></i>
                    </div>
                    <h4>Message Sent!</h4>
                    <p>Thank you for contacting News Portal. We will respond as soon as possible.</p>
                </div>

                <form action="{{ route('contact.send') }}" method="POST" id="contactForm">
                    @csrf

                    <div class="np-form-group">
                        <label><i class="bi bi-person"></i> Your Name</label>
                        <div class="np-input-wrap">
                            <input type="text" name="name" class="np-form-input" placeholder="John Doe" required>
                            <i class="bi bi-person np-form-icon"></i>
                            <div class="np-form-line"></div>
                        </div>
                    </div>

                    <div class="np-form-group">
                        <label><i class="bi bi-envelope"></i> Email Address</label>
                        <div class="np-input-wrap">
                            <input type="email" name="email" class="np-form-input" placeholder="your@email.com" required>
                            <i class="bi bi-envelope np-form-icon"></i>
                            <div class="np-form-line"></div>
                        </div>
                    </div>

                    <div class="np-form-group">
                        <label><i class="bi bi-chat-dots"></i> Message</label>
                        <div class="np-input-wrap">
                            <textarea name="message" class="np-form-input np-form-textarea" placeholder="Share your question, feedback, or news tip..." required></textarea>
                            <i class="bi bi-chat-text np-form-icon np-form-icon-ta"></i>
                            <div class="np-form-line"></div>
                        </div>
                    </div>

                    <button type="submit" id="submitBtn" class="np-submit-btn">
                        <i class="bi bi-send"></i>
                        <span>Send Message</span>
                    </button>
                </form>
            </div>

            <div class="np-contact-info">
                <div class="np-info-box">
                    <div class="np-info-icon"><i class="bi bi-geo-alt-fill"></i></div>
                    <div class="np-info-text">
                        <h6>Office Location</h6>
                        <p>{{ $location }}</p>
                    </div>
                </div>
                <div class="np-info-box">
                    <div class="np-info-icon"><i class="bi bi-telephone-fill"></i></div>
                    <div class="np-info-text">
                        <h6>Phone</h6>
                        <p>{{ $phone }}</p>
                    </div>
                </div>
                <div class="np-info-box">
                    <div class="np-info-icon"><i class="bi bi-envelope-fill"></i></div>
                    <div class="np-info-text">
                        <h6>Email</h6>
                        <p>{{ $email }}</p>
                    </div>
                </div>
                <div class="np-info-box">
                    <div class="np-info-icon"><i class="bi bi-clock-fill"></i></div>
                    <div class="np-info-text">
                        <h6>Newsroom Hours</h6>
                        <p>24/7 — News never sleeps</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<footer class="np-footer">
    <div class="np-footer-inner">
        <div class="np-footer-logo">
            <i class="bi bi-newspaper"></i> News <span>Portal</span>
        </div>
        <p class="np-footer-text">&copy; {{ date('Y') }} News Portal. All Rights Reserved. Trusted Journalism Since 2025.</p>
    </div>
</footer>

<script>
    function createParticles() {
        const container = document.getElementById('footParticles');
        if (!container) return;
        const icons = ['bi-newspaper', 'bi-journal-text', 'bi-megaphone', 'bi-broadcast', 'bi-pencil-square', 'bi-camera', 'bi-mic', 'bi-globe2'];
        for (let i = 0; i < 12; i++) {
            const p = document.createElement('i');
            p.className = `bi ${icons[i % icons.length]} np-foot-particle`;
            p.style.left = Math.random() * 100 + '%';
            p.style.fontSize = (Math.random() * 16 + 12) + 'px';
            p.style.animationDuration = (Math.random() * 15 + 12) + 's';
            p.style.animationDelay = (Math.random() * 10) + 's';
            p.style.opacity = Math.random() * 0.06 + 0.02;
            container.appendChild(p);
        }
    }
    createParticles();

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add('np-fade-visible'), i * 120);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.np-fade-in').forEach(el => observer.observe(el));

    const form = document.getElementById('contactForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const btn = document.getElementById('submitBtn');
            btn.classList.add('np-btn-loading');
            btn.innerHTML = '<i class="bi bi-send"></i> <span>Sending...</span>';
            setTimeout(() => {
                btn.classList.remove('np-btn-loading');
                btn.innerHTML = '<i class="bi bi-send"></i> <span>Send Message</span>';
                document.getElementById('successOverlay').classList.add('np-show');
                this.reset();
                setTimeout(() => document.getElementById('successOverlay').classList.remove('np-show'), 4000);
            }, 2000);
        });
    }

    document.querySelectorAll('.np-form-input').forEach(inp => {
        inp.addEventListener('focus', () => inp.closest('.np-input-wrap').classList.add('np-focused'));
        inp.addEventListener('blur', () => inp.closest('.np-input-wrap').classList.remove('np-focused'));
    });
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap');

    :root {
        --np-dark-1: #0a0a0f;
        --np-dark-2: #111118;
        --np-dark-3: #1a1a24;
        --np-dark-4: #242430;
        --np-red: #D32F2F;
        --np-red-dark: #B71C1C;
        --np-white: #FFFFFF;
        --np-text: #d0d0d8;
        --np-text-dim: #8888a0;
        --np-text-muted: #555568;
        --np-border: rgba(255,255,255,0.06);
        --font-headline: 'Playfair Display', Georgia, serif;
        --font-ui: 'Inter', Arial, sans-serif;
    }

    .np-foot-particles {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        pointer-events: none;
        z-index: 0;
        overflow: hidden;
    }

    .np-foot-particle {
        position: absolute;
        color: rgba(211, 47, 47, 0.06);
        animation: npFootFloat linear infinite;
        pointer-events: none;
    }

    @keyframes npFootFloat {
        0% { transform: translateY(110vh) rotate(0deg); opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { transform: translateY(-10vh) rotate(360deg); opacity: 0; }
    }

    .np-contact-section {
        position: relative;
        min-height: 100vh;
        padding: 80px 20px 40px;
        background: var(--np-dark-1);
        overflow: hidden;
    }

    .np-contact-section::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent, var(--np-red), transparent);
        animation: npContactGlow 3s ease-in-out infinite;
    }

    @keyframes npContactGlow {
        0%, 100% { opacity: 0.4; }
        50% { opacity: 1; }
    }

    .np-contact-container {
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    .np-contact-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .np-contact-header h2 {
        font-family: var(--font-headline);
        font-size: 36px;
        font-weight: 900;
        color: var(--np-white);
        letter-spacing: -0.5px;
        margin-bottom: 8px;
    }

    .np-contact-header h2 span {
        color: var(--np-red);
        text-shadow: 0 0 20px rgba(211,47,47,0.2);
    }

    .np-contact-header p {
        font-size: 14px;
        color: var(--np-text-dim);
        letter-spacing: 1px;
    }

    .np-contact-header::after {
        content: '';
        display: block;
        width: 50px;
        height: 2px;
        background: var(--np-red);
        margin: 16px auto 0;
        animation: npContactLine 2s ease-in-out infinite;
    }

    @keyframes npContactLine {
        0%, 100% { width: 50px; opacity: 0.5; }
        50% { width: 80px; opacity: 1; }
    }

    .np-contact-grid {
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 40px;
        align-items: start;
    }

    @media (max-width: 900px) {
        .np-contact-grid { grid-template-columns: 1fr; gap: 30px; }
    }

    .np-contact-form-card {
        background: rgba(18, 18, 30, 0.85);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid var(--np-border);
        padding: 36px 32px;
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
    }

    .np-contact-form-card:hover {
        border-color: rgba(211, 47, 47, 0.08);
    }

    .np-contact-form-card::before {
        content: 'CONTACT';
        position: absolute;
        top: 14px;
        right: 18px;
        font-family: var(--font-ui);
        font-size: 9px;
        color: var(--np-red);
        letter-spacing: 3px;
        opacity: 0.3;
        border: 1px solid rgba(211,47,47,0.1);
        padding: 2px 10px;
    }

    .np-success-overlay {
        position: absolute;
        inset: 0;
        background: rgba(10, 10, 15, 0.97);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        z-index: 20;
        opacity: 0;
        visibility: hidden;
        transition: all 0.5s ease;
        backdrop-filter: blur(8px);
    }

    .np-success-overlay.np-show {
        opacity: 1;
        visibility: visible;
    }

    .np-success-icon {
        width: 72px;
        height: 72px;
        background: var(--np-red);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: var(--np-white);
        margin-bottom: 16px;
        box-shadow: 0 0 30px rgba(211,47,47,0.3);
        animation: npSuccessBounce 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    @keyframes npSuccessBounce {
        0% { transform: scale(0) rotate(-180deg); }
        60% { transform: scale(1.2) rotate(10deg); }
        100% { transform: scale(1) rotate(0deg); }
    }

    .np-success-overlay h4 {
        font-family: var(--font-headline);
        font-size: 22px;
        font-weight: 700;
        color: var(--np-white);
        margin-bottom: 8px;
    }

    .np-success-overlay p {
        color: var(--np-text-dim);
        font-size: 13px;
        text-align: center;
        max-width: 300px;
        line-height: 1.6;
    }

    .np-form-group {
        margin-bottom: 20px;
    }

    .np-form-group label {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        font-weight: 600;
        color: var(--np-text-dim);
        text-transform: uppercase;
        letter-spacing: 1.2px;
        margin-bottom: 6px;
    }

    .np-form-group label i { color: var(--np-red); font-size: 12px; opacity: 0.7; }

    .np-input-wrap { position: relative; }

    .np-form-input {
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

    .np-form-textarea {
        min-height: 110px;
        resize: vertical;
        line-height: 1.6;
    }

    .np-form-input::placeholder {
        color: var(--np-text-muted);
        font-size: 13px;
    }

    .np-form-input:focus {
        background: rgba(255,255,255,0.05);
        border-color: rgba(211, 47, 47, 0.3);
        box-shadow: 0 0 0 3px rgba(211, 47, 47, 0.04), 0 0 20px rgba(211, 47, 47, 0.02);
    }

    .np-form-icon {
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

    .np-form-icon-ta {
        top: 18px;
        transform: none;
    }

    .np-input-wrap.np-focused .np-form-icon {
        color: var(--np-red);
        transform: translateY(-50%) scale(1.1);
    }

    .np-input-wrap.np-focused .np-form-icon-ta {
        transform: scale(1.1);
    }

    .np-form-line {
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

    .np-input-wrap.np-focused .np-form-line {
        width: 90%;
        opacity: 0.5;
    }

    .np-submit-btn {
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
        box-shadow: 0 4px 15px rgba(211, 47, 47, 0.2), 0 0 40px rgba(211, 47, 47, 0.03);
        margin-top: 8px;
    }

    .np-submit-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.08), transparent);
        transition: left 0.6s ease;
    }

    .np-submit-btn:hover {
        background: linear-gradient(135deg, var(--np-red-dark), var(--np-red));
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(211, 47, 47, 0.35), 0 0 60px rgba(211, 47, 47, 0.05);
    }

    .np-submit-btn:hover::before { left: 100%; }

    .np-submit-btn:active { transform: translateY(0); }

    .np-submit-btn i { transition: transform 0.3s; }
    .np-submit-btn:hover i { transform: translateX(4px); }

    .np-btn-loading { pointer-events: none; opacity: 0.8; }

    .np-contact-info {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .np-info-box {
        background: rgba(18, 18, 30, 0.85);
        backdrop-filter: blur(24px);
        border: 1px solid var(--np-border);
        padding: 24px 22px;
        display: flex;
        align-items: center;
        gap: 18px;
        transition: all 0.4s ease;
    }

    .np-info-box:hover {
        border-color: rgba(211, 47, 47, 0.08);
        transform: translateX(6px);
    }

    .np-info-icon {
        width: 52px;
        height: 52px;
        min-width: 52px;
        background: rgba(211, 47, 47, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: var(--np-red);
        transition: all 0.3s;
    }

    .np-info-box:hover .np-info-icon {
        background: var(--np-red);
        color: var(--np-white);
        transform: scale(1.08);
        box-shadow: 0 0 20px rgba(211,47,47,0.2);
    }

    .np-info-text h6 {
        font-family: var(--font-headline);
        font-size: 15px;
        font-weight: 700;
        color: var(--np-white);
        margin-bottom: 2px;
    }

    .np-info-text p {
        font-size: 13px;
        color: var(--np-text-dim);
        line-height: 1.5;
        word-break: break-word;
        margin: 0;
    }

    .np-fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.6s ease;
    }

    .np-fade-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .np-footer {
        background: rgba(10, 10, 15, 0.95);
        border-top: 1px solid var(--np-border);
        padding: 30px 20px;
        text-align: center;
        position: relative;
    }

    .np-footer::before {
        content: '';
        position: absolute;
        top: -1px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 2px;
        background: var(--np-red);
        opacity: 0.5;
    }

    .np-footer-inner {
        max-width: 600px;
        margin: 0 auto;
    }

    .np-footer-logo {
        font-family: var(--font-headline);
        font-size: 20px;
        font-weight: 900;
        color: var(--np-white);
        margin-bottom: 8px;
    }

    .np-footer-logo i { color: var(--np-red); margin-right: 6px; }
    .np-footer-logo span { color: var(--np-red); }

    .np-footer-text {
        font-size: 11px;
        color: var(--np-text-muted);
        letter-spacing: 0.5px;
        margin: 0;
    }

    @media (max-width: 768px) {
        .np-contact-section { padding: 50px 16px 30px; }
        .np-contact-form-card { padding: 28px 20px; }
        .np-contact-header h2 { font-size: 28px; }
        .np-info-box { padding: 20px 18px; }
        .np-info-icon { width: 44px; height: 44px; min-width: 44px; font-size: 17px; }
    }

    @media (max-width: 480px) {
        .np-contact-form-card { padding: 24px 16px; }
        .np-submit-btn { padding: 14px 20px; font-size: 13px; }
    }
</style>
