@php
use App\Models\Setting;

$settings = Setting::first();
$email = $settings?->email ?? '';
$phone = $settings?->phone ?? '';
$location = $settings?->location ?? '';
@endphp

<!-- ===== FLOATING NEWS PARTICLES ===== -->
<div class="news-particles" id="newsParticles"></div>

<!-- ===== CONTACT SECTION ===== -->
<section id="contactSection" class="contact-section">

    <!-- News watermark -->
    <div class="news-deco">
        <i class="bi bi-newspaper"></i>
    </div>

    <!-- Decorative elements -->
    <div class="news-deco-shape news-deco-1"></div>
    <div class="news-deco-shape news-deco-2"></div>

    <div class="contact-container">

        <div class="section-header fade-in-up">
            <h2>Contact News Portal</h2>
            <p><span class="glow-dot"></span> We value your feedback, questions, and news tips</p>
        </div>

        <div class="contact-grid">

            <!-- FORM CARD -->
            <div class="contact-form-card fade-in-up" style="position: relative;">

                <!-- Ink splash effect -->
                <div class="ink-splash" id="inkSplash"></div>

                <!-- Success Overlay -->
                <div class="success-overlay" id="successOverlay">
                    <div class="success-icon">
                        <i class="bi bi-check-lg"></i>
                    </div>
                    <h4>Message Sent Successfully!</h4>
                    <p>Thank you for contacting News Portal. Our team will respond as soon as possible.</p>
                </div>

                <form action="{{ route('contact.send') }}" method="POST" id="contactForm">
                    @csrf

                    <div class="form-group">
                        <label><i class="bi bi-person me-1"></i> Your Name</label>
                        <div class="input-wrapper">
                            <input type="text" name="name" class="form-input" placeholder="John Doe" required>
                            <i class="bi bi-person input-icon"></i>
                        </div>
                        <div class="focus-bar"></div>
                    </div>

                    <div class="form-group">
                        <label><i class="bi bi-envelope me-1"></i> Email Address</label>
                        <div class="input-wrapper">
                            <input type="email" name="email" class="form-input" placeholder="your@email.com" required>
                            <i class="bi bi-envelope input-icon"></i>
                        </div>
                        <div class="focus-bar"></div>
                    </div>

                    <div class="form-group">
                        <label><i class="bi bi-chat-dots me-1"></i> Message</label>
                        <div class="input-wrapper">
                            <textarea name="message" class="form-input" placeholder="Share your question, feedback, or news tip..." required></textarea>
                            <i class="bi bi-chat-text input-icon"></i>
                        </div>
                        <div class="focus-bar"></div>
                    </div>

                    <button type="submit" id="submitBtn" class="submit-btn">
                        <i class="bi bi-send"></i>
                        <span>Send Message</span>
                    </button>
                </form>
            </div>

            <!-- INFO CARD -->
            <div class="contact-info-card fade-in-up">
                <div class="info-box">
                    <div class="info-box-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <div class="info-text">
                        <h6>Office Location</h6>
                        <p>{{ $location }}</p>
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-box-icon">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <div class="info-text">
                        <h6>Phone</h6>
                        <p>{{ $phone }}</p>
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-box-icon">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <div class="info-text">
                        <h6>Email</h6>
                        <p>{{ $email }}</p>
                    </div>
                </div>

                <!-- Extra: Working Hours -->
                <div class="info-box">
                    <div class="info-box-icon">
                        <i class="bi bi-clock-fill"></i>
                    </div>
                    <div class="info-text">
                        <h6>Newsroom Hours</h6>
                        <p>24/7 — News never sleeps</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

    <!-- ===== JAVASCRIPT ===== -->
    <script>
        // ===== DATE & TIME =====
        function updateDateTime() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('currentDate').textContent = now.toLocaleDateString('en-US', options);
            document.getElementById('currentTime').textContent = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        }
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // ===== FLOATING NEWS PARTICLES =====
        function createParticles() {
            const container = document.getElementById('newsParticles');
            const icons = ['bi-newspaper', 'bi-journal-text', 'bi-megaphone', 'bi-broadcast', 'bi-pencil-square', 'bi-camera', 'bi-mic', 'bi-globe2', 'bi-bookmark-star', 'bi-chat-quote'];

            for (let i = 0; i < 15; i++) {
                const particle = document.createElement('i');
                const icon = icons[Math.floor(Math.random() * icons.length)];
                particle.className = `bi ${icon} particle`;
                particle.style.left = Math.random() * 100 + '%';
                particle.style.fontSize = (Math.random() * 20 + 14) + 'px';
                particle.style.animationDuration = (Math.random() * 15 + 12) + 's';
                particle.style.animationDelay = (Math.random() * 10) + 's';
                particle.style.opacity = Math.random() * 0.08 + 0.02;
                container.appendChild(particle);
            }
        }
        createParticles();

        // ===== INTERSECTION OBSERVER FOR FADE-IN =====
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, index * 150);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

        document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));

        // ===== FORM SUBMISSION =====
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('submitBtn');
            btn.classList.add('loading');
            btn.innerHTML = '<i class="bi bi-send"></i> <span>Sending...</span>';

            setTimeout(() => {
                btn.classList.remove('loading');
                btn.innerHTML = '<i class="bi bi-send"></i> <span>Send Message</span>';
                document.getElementById('successOverlay').classList.add('show');
                this.reset();

                setTimeout(() => {
                    document.getElementById('successOverlay').classList.remove('show');
                }, 4000);
            }, 2000);
        });

        // ===== INK SPLASH FOLLOW MOUSE =====
        const formCard = document.querySelector('.contact-form-card');
        const inkSplash = document.getElementById('inkSplash');

        formCard.addEventListener('mousemove', (e) => {
            const rect = formCard.getBoundingClientRect();
            const x = e.clientX - rect.left - 100;
            const y = e.clientY - rect.top - 100;
            inkSplash.style.left = x + 'px';
            inkSplash.style.top = y + 'px';
        });

        // ===== SMOOTH SCROLL FOR INPUTS (MOBILE) =====
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', () => {
                setTimeout(() => {
                    input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 300);
            });
        });

        // ===== INPUT CHARACTER COUNTER FOR TEXTAREA =====
        const textarea = document.querySelector('textarea.form-input');
        textarea.addEventListener('input', function() {
            const maxLen = 1000;
            if (this.value.length > maxLen) {
                this.value = this.value.substring(0, maxLen);
            }
        });

        // ===== PARALLAX EFFECT ON WATERMARK =====
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const deco = document.querySelector('.news-deco');
            if (deco) {
                deco.style.transform = `translate(-50%, calc(-50% + ${scrolled * 0.1}px))`;
            }
        });
    </script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600;700&family=Special+Elite&display=swap" rel="stylesheet">

    <style>
        /* ===== CSS RESET & BASE ===== */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --black: #000000;
            --red-primary: #D32F2F;
            --red-bright: #E53935;
            --red-dark: #B71C1C;
            --red-light: #FFEBEE;
            --white: #FFFFFF;
            --gray-50: #FAFAFA;
            --gray-100: #F5F5F5;
            --gray-200: #EEEEEE;
            --gray-300: #E0E0E0;
            --gray-600: #757575;
            --gray-700: #616161;
            --gray-800: #424242;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.08);
            --shadow-md: 0 4px 20px rgba(0,0,0,0.12);
            --shadow-lg: 0 8px 40px rgba(0,0,0,0.16);
            --shadow-xl: 0 16px 60px rgba(0,0,0,0.2);
            --shadow-red: 0 4px 20px rgba(211,47,47,0.3);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--white);
            color: var(--black);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* ===== NEWSPAPER FLOATING PARTICLES ===== */
        .news-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            color: rgba(211, 47, 47, 0.07);
            animation: floatParticle linear infinite;
            pointer-events: none;
            will-change: transform;
        }

        @keyframes floatParticle {
            0% {
                transform: translateY(110vh) rotate(0deg) scale(1);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-10vh) rotate(360deg) scale(0.5);
                opacity: 0;
            }
        }

        /* ===== CONTACT SECTION ===== */
        .contact-section {
            position: relative;
            min-height: 100vh;
            padding: 80px 20px;
            background: var(--white);
            overflow: hidden;
        }

        /* Newspaper texture overlay */
        .contact-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
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

        /* Top red accent bar with animation */
        .contact-section::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--red-primary), var(--red-bright), var(--red-primary));
            background-size: 200% 100%;
            animation: redBarShimmer 3s ease-in-out infinite;
            z-index: 10;
        }

        @keyframes redBarShimmer {
            0%, 100% { background-position: 0% 0%; }
            50% { background-position: 100% 0%; }
        }

        /* News watermark */
        .news-deco {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 28vw;
            color: rgba(0, 0, 0, 0.015);
            pointer-events: none;
            z-index: 0;
            animation: watermarkPulse 8s ease-in-out infinite;
        }

        @keyframes watermarkPulse {
            0%, 100% { opacity: 0.4; transform: translate(-50%, -50%) scale(1); }
            50% { opacity: 0.7; transform: translate(-50%, -50%) scale(1.03); }
        }

        /* Decorative shapes */
        .news-deco-shape {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .news-deco-1 {
            width: 400px;
            height: 400px;
            top: -100px;
            right: -100px;
            background: radial-gradient(circle, rgba(211,47,47,0.04) 0%, transparent 70%);
            animation: decoFloat1 12s ease-in-out infinite;
        }

        .news-deco-2 {
            width: 300px;
            height: 300px;
            bottom: -50px;
            left: -80px;
            background: radial-gradient(circle, rgba(211,47,47,0.03) 0%, transparent 70%);
            animation: decoFloat2 10s ease-in-out infinite;
        }

        @keyframes decoFloat1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(-30px, 20px) scale(1.1); }
            66% { transform: translate(15px, -15px) scale(0.95); }
        }

        @keyframes decoFloat2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(25px, -20px) scale(1.08); }
        }

        /* ===== CONTAINER ===== */
        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        /* ===== SECTION HEADER ===== */
        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 5vw, 3.2rem);
            font-weight: 900;
            color: var(--black);
            letter-spacing: -0.5px;
            margin-bottom: 8px;
            position: relative;
            display: inline-block;
        }

        .section-header h2::before {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: var(--red-primary);
            border-radius: 2px;
            animation: headerLineExpand 1.5s ease-out forwards;
        }

        @keyframes headerLineExpand {
            0% { width: 0; }
            100% { width: 60px; }
        }

        .section-header h2::after {
            content: 'CONTACT';
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            font-family: 'Special Elite', cursive;
            font-size: 0.35em;
            font-weight: 400;
            color: var(--red-primary);
            letter-spacing: 8px;
            text-transform: uppercase;
            opacity: 0.7;
            white-space: nowrap;
        }

        .section-header p {
            font-size: 1.05rem;
            color: var(--gray-600);
            margin-top: 20px;
            font-weight: 400;
            letter-spacing: 0.2px;
        }

        /* Breaking News Style Badge */
        .section-header::before {
            content: '';
            display: block;
            width: 50px;
            height: 3px;
            background: var(--red-primary);
            margin: 0 auto 30px;
            animation: breakingPulse 2s ease-in-out infinite;
        }

        @keyframes breakingPulse {
            0%, 100% { opacity: 1; width: 50px; }
            50% { opacity: 0.5; width: 80px; }
        }

        /* ===== CONTACT GRID ===== */
        .contact-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 40px;
            align-items: start;
        }

        @media (max-width: 900px) {
            .contact-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }

        /* ===== FORM CARD ===== */
        .contact-form-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 16px;
            padding: 40px 36px;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            box-shadow: var(--shadow-sm);
        }

        .contact-form-card:hover {
            box-shadow: var(--shadow-lg);
            border-color: rgba(211, 47, 47, 0.15);
            transform: translateY(-4px);
        }

        /* Newspaper column separator on left */
        .contact-form-card::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            width: 4px;
            height: 0;
            background: linear-gradient(180deg, var(--red-primary), var(--red-bright));
            border-radius: 0 4px 4px 0;
            animation: cardLineGrow 0.8s 0.3s ease-out forwards;
        }

        @keyframes cardLineGrow {
            0% { height: 0; }
            100% { height: calc(100% - 40px); }
        }

        /* Newspaper Edition Tag */
        .contact-form-card::after {
            content: 'WRITE TO US';
            position: absolute;
            top: 16px;
            right: 20px;
            font-family: 'Special Elite', cursive;
            font-size: 0.65rem;
            color: var(--red-primary);
            letter-spacing: 3px;
            text-transform: uppercase;
            opacity: 0.5;
            border: 1px solid rgba(211,47,47,0.2);
            padding: 3px 10px;
            border-radius: 3px;
        }

        /* ===== SUCCESS OVERLAY ===== */
        .success-overlay {
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.97);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 20;
            opacity: 0;
            visibility: hidden;
            transition: all 0.5s ease;
            backdrop-filter: blur(6px);
            border-radius: 16px;
        }

        .success-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--red-primary), var(--red-bright));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 2rem;
            margin-bottom: 20px;
            box-shadow: var(--shadow-red);
            animation: successBounce 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        @keyframes successBounce {
            0% { transform: scale(0) rotate(-180deg); }
            60% { transform: scale(1.2) rotate(10deg); }
            100% { transform: scale(1) rotate(0deg); }
        }

        .success-overlay h4 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--black);
            margin-bottom: 8px;
        }

        .success-overlay p {
            color: var(--gray-600);
            font-size: 0.95rem;
            text-align: center;
            max-width: 320px;
            line-height: 1.6;
        }

        /* ===== FORM ELEMENTS ===== */
        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-group label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--black);
            margin-bottom: 8px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-family: 'Inter', sans-serif;
            transition: color 0.3s ease;
        }

        .form-group label i {
            color: var(--red-primary);
            font-size: 0.85rem;
        }

        .input-wrapper {
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 14px 18px;
            padding-right: 44px;
            border: 2px solid var(--gray-200);
            border-radius: 10px;
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            color: var(--black);
            background: var(--gray-50);
            transition: all 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            outline: none;
            resize: vertical;
        }

        textarea.form-input {
            min-height: 130px;
            line-height: 1.6;
        }

        .form-input::placeholder {
            color: var(--gray-600);
            opacity: 0.6;
            font-style: italic;
        }

        .form-input:focus {
            border-color: var(--red-primary);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(211, 47, 47, 0.08);
        }

        .form-input:focus + .input-icon {
            color: var(--red-primary);
            transform: translateY(-50%) scale(1.15);
        }

        .input-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-300);
            font-size: 1.1rem;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        textarea.form-input ~ .input-icon {
            top: 20px;
            transform: none;
        }

        textarea.form-input:focus ~ .input-icon {
            transform: scale(1.15);
        }

        /* Focus bar animation */
        .focus-bar {
            position: relative;
            width: 100%;
            height: 2px;
            margin-top: -2px;
            border-radius: 0 0 10px 10px;
            overflow: hidden;
        }

        .focus-bar::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--red-primary), var(--red-bright));
            transition: all 0.4s ease;
            transform: translateX(-50%);
        }

        .form-group:focus-within .focus-bar::after {
            width: 100%;
        }

        .form-group:focus-within label {
            color: var(--red-primary);
        }

        /* ===== SUBMIT BUTTON ===== */
        .submit-btn {
            width: 100%;
            padding: 16px 32px;
            background: linear-gradient(135deg, var(--red-primary), var(--red-bright));
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            box-shadow: 0 4px 15px rgba(211, 47, 47, 0.3);
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-top: 8px;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transition: left 0.6s ease;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, var(--red-dark), var(--red-primary));
            box-shadow: 0 6px 25px rgba(211, 47, 47, 0.45);
            transform: translateY(-2px);
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(211, 47, 47, 0.3);
        }

        .submit-btn i {
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .submit-btn:hover i {
            transform: translateX(4px) rotate(-15deg);
        }

        /* Button loading state */
        .submit-btn.loading {
            pointer-events: none;
            opacity: 0.85;
        }

        .submit-btn.loading i {
            animation: sendPulse 1s ease-in-out infinite;
        }

        @keyframes sendPulse {
            0%, 100% { transform: translateX(0); opacity: 1; }
            50% { transform: translateX(8px); opacity: 0.3; }
        }

        /* ===== INFO CARD ===== */
        .contact-info-card {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .info-box {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 14px;
            padding: 28px 24px;
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .info-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, rgba(211,47,47,0.03), transparent);
            transition: width 0.5s ease;
        }

        .info-box:hover::before {
            width: 100%;
        }

        .info-box:hover {
            border-color: rgba(211, 47, 47, 0.2);
            box-shadow: var(--shadow-md);
            transform: translateX(6px);
        }

        /* Newspaper dot separator */
        .info-box::after {
            content: '|||';
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.7rem;
            letter-spacing: 2px;
            color: var(--gray-200);
            font-weight: 700;
            transition: color 0.3s ease;
        }

        .info-box:hover::after {
            color: rgba(211, 47, 47, 0.2);
        }

        .info-box-icon {
            width: 56px;
            height: 56px;
            min-width: 56px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--red-primary), var(--red-bright));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1.3rem;
            box-shadow: 0 4px 12px rgba(211, 47, 47, 0.25);
            transition: all 0.4s ease;
            position: relative;
            z-index: 1;
        }

        .info-box:hover .info-box-icon {
            transform: scale(1.08) rotate(-5deg);
            box-shadow: 0 6px 18px rgba(211, 47, 47, 0.35);
        }

        .info-text {
            position: relative;
            z-index: 1;
        }

        .info-text h6 {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--black);
            margin-bottom: 4px;
            letter-spacing: 0.3px;
        }

        .info-text p {
            font-size: 0.9rem;
            color: var(--gray-600);
            line-height: 1.5;
            word-break: break-word;
        }

        /* ===== NEWS TICKER ANIMATION ON INFO CARDS ===== */
        .info-box:nth-child(1) { animation: slideInRight 0.6s 0.2s ease-out both; }
        .info-box:nth-child(2) { animation: slideInRight 0.6s 0.4s ease-out both; }
        .info-box:nth-child(3) { animation: slideInRight 0.6s 0.6s ease-out both; }

        @keyframes slideInRight {
            0% {
                opacity: 0;
                transform: translateX(40px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* ===== NEWSPAPER EDITION DIVIDER ===== */
        .contact-info-card::before {
            content: '';
            display: none;
        }

        /* ===== FADE IN UP ANIMATION ===== */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ===== TYPEWRITER CURSOR for header ===== */
        @keyframes blink {
            0%, 50% { border-color: var(--red-primary); }
            51%, 100% { border-color: transparent; }
        }

        /* ===== PRINT/PRESS STAMP EFFECT ===== */
        .contact-form-card .stamp-effect {
            position: absolute;
            bottom: 20px;
            right: 20px;
            width: 70px;
            height: 70px;
            border: 3px solid rgba(211,47,47,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Special Elite', cursive;
            font-size: 0.55rem;
            color: rgba(211,47,47,0.15);
            text-transform: uppercase;
            letter-spacing: 1px;
            transform: rotate(-15deg);
            pointer-events: none;
        }

        /* ===== BREAKING NEWS BANNER ===== */
        .breaking-news-bar {
            background: var(--black);
            color: var(--white);
            padding: 10px 0;
            overflow: hidden;
            position: relative;
            z-index: 5;
        }

        .breaking-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--red-primary);
            color: var(--white);
            padding: 4px 14px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            z-index: 3;
            font-family: 'Inter', sans-serif;
        }

        .breaking-label i {
            animation: breakingFlash 1s ease-in-out infinite;
        }

        @keyframes breakingFlash {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        .ticker-wrap {
            overflow: hidden;
            padding-left: 180px;
        }

        .ticker-content {
            display: inline-block;
            white-space: nowrap;
            animation: tickerScroll 25s linear infinite;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        .ticker-content span {
            margin-right: 60px;
            position: relative;
        }

        .ticker-content span::after {
            content: '|';
            margin-left: 60px;
            color: var(--red-primary);
            font-weight: 700;
        }

        @keyframes tickerScroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* ===== NEWSPAPER HEADER BAR ===== */
        .newspaper-header {
            background: var(--white);
            border-bottom: 3px solid var(--black);
            padding: 20px 0;
            text-align: center;
            position: relative;
        }

        .newspaper-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--red-primary);
        }

        .newspaper-header::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 100%;
            height: 1px;
            background: var(--black);
        }

        .newspaper-logo {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 900;
            color: var(--black);
            letter-spacing: -1px;
            line-height: 1;
        }

        .newspaper-logo span {
            color: var(--red-primary);
        }

        .newspaper-tagline {
            font-family: 'Special Elite', cursive;
            font-size: 0.8rem;
            color: var(--gray-600);
            letter-spacing: 4px;
            text-transform: uppercase;
            margin-top: 6px;
        }

        .newspaper-date {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 10px auto 0;
            padding: 8px 20px 0;
            border-top: 1px solid var(--gray-200);
            font-size: 0.75rem;
            color: var(--gray-600);
            font-family: 'Inter', sans-serif;
        }

        .newspaper-date span {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .newspaper-date span i {
            color: var(--red-primary);
        }

        /* ===== FOOTER ===== */
        .news-footer {
            background: var(--black);
            color: var(--gray-300);
            padding: 40px 20px 20px;
            text-align: center;
            position: relative;
        }

        .news-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--red-primary), var(--red-bright), var(--red-primary));
        }

        .footer-logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 10px;
        }

        .footer-logo span {
            color: var(--red-primary);
        }

        .footer-text {
            font-size: 0.8rem;
            color: var(--gray-600);
            margin-top: 8px;
        }

        .footer-social {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin: 20px 0;
        }

        .footer-social a {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid var(--gray-700);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-300);
            text-decoration: none;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .footer-social a:hover {
            background: var(--red-primary);
            border-color: var(--red-primary);
            color: var(--white);
            transform: translateY(-3px);
        }

        .footer-divider {
            width: 60px;
            height: 2px;
            background: var(--red-primary);
            margin: 20px auto;
            opacity: 0.5;
        }

        /* ===== INPUT HOVER RIPPLE ===== */
        .form-input:hover {
            border-color: var(--gray-300);
            background: var(--white);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .contact-section {
                padding: 50px 16px;
            }

            .contact-form-card {
                padding: 28px 20px;
            }

            .contact-form-card::after {
                display: none;
            }

            .section-header {
                margin-bottom: 40px;
            }

            .info-box {
                padding: 20px 18px;
            }

            .info-box-icon {
                width: 48px;
                height: 48px;
                min-width: 48px;
                font-size: 1.1rem;
                border-radius: 12px;
            }

            .ticker-wrap {
                padding-left: 140px;
            }

            .breaking-label {
                font-size: 0.65rem;
                padding: 4px 10px;
            }

            .newspaper-date {
                flex-direction: column;
                gap: 4px;
            }
        }

        @media (max-width: 480px) {
            .contact-form-card {
                padding: 24px 16px;
            }

            .submit-btn {
                padding: 14px 24px;
                font-size: 0.9rem;
            }
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--gray-100);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--gray-300);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--red-primary);
        }

        /* ===== GLOWING DOT ANIMATION ===== */
        .glow-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--red-primary);
            margin-right: 6px;
            animation: glowPulse 1.5s ease-in-out infinite;
            vertical-align: middle;
        }

        @keyframes glowPulse {
            0%, 100% { box-shadow: 0 0 4px rgba(211,47,47,0.4); opacity: 1; }
            50% { box-shadow: 0 0 12px rgba(211,47,47,0.8); opacity: 0.7; }
        }

        /* ===== INK SPLASH ON HOVER ===== */
        .contact-form-card .ink-splash {
            position: absolute;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(211,47,47,0.03) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.5s ease;
            z-index: 0;
        }

        .contact-form-card:hover .ink-splash {
            opacity: 1;
        }
    </style>