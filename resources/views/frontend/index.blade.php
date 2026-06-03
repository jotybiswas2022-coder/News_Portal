@extends('frontend.app')

@section('skeleton')
    {{-- ===== HOMEPAGE SKELETON ===== --}}
    <div style="padding-top:72px;">
        {{-- Hero Skeleton --}}
        <div style="background:rgba(255,255,255,0.02);padding:80px 20px;min-height:90vh;display:flex;align-items:center;">
            <div style="max-width:1200px;margin:0 auto;width:100%;">
                <div style="margin-bottom:28px;">
                    <div class="sk-block" style="width:180px;height:32px;border-radius:50px;"></div>
                </div>
                <div class="sk-block" style="width:70%;height:48px;margin-bottom:16px;"></div>
                <div class="sk-block" style="width:55%;height:48px;margin-bottom:24px;"></div>
                <div class="sk-block" style="width:45%;height:20px;margin-bottom:16px;"></div>
                <div class="sk-block" style="width:35%;height:20px;margin-bottom:36px;"></div>
                <div style="display:flex;gap:16px;flex-wrap:wrap;">
                    <div class="sk-block" style="width:180px;height:52px;border-radius:12px;"></div>
                    <div class="sk-block" style="width:200px;height:52px;border-radius:12px;"></div>
                </div>
                <div style="display:flex;gap:40px;margin-top:48px;padding-top:28px;border-top:1px solid rgba(255,255,255,0.05);">
                    <div><div class="sk-block" style="width:80px;height:36px;margin-bottom:6px;"></div><div class="sk-block" style="width:100px;height:14px;"></div></div>
                    <div><div class="sk-block" style="width:60px;height:36px;margin-bottom:6px;"></div><div class="sk-block" style="width:90px;height:14px;"></div></div>
                    <div><div class="sk-block" style="width:70px;height:36px;margin-bottom:6px;"></div><div class="sk-block" style="width:80px;height:14px;"></div></div>
                </div>
            </div>
        </div>

        {{-- Blood Groups Skeleton --}}
        <div style="padding:80px 20px;background:linear-gradient(180deg,#fff,#fef2f2);">
            <div style="max-width:1200px;margin:0 auto;">
                <div style="text-align:center;margin-bottom:50px;">
                    <div class="sk-block" style="width:140px;height:28px;margin:0 auto 18px;border-radius:50px;"></div>
                    <div class="sk-block" style="width:300px;height:36px;margin:0 auto 14px;"></div>
                    <div class="sk-block" style="width:400px;height:18px;margin:0 auto;"></div>
                </div>
                <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:24px;">
                    @for($i=0;$i<8;$i++)
                    <div style="padding:32px 20px 28px;text-align:center;background:#fff;border-radius:20px;box-shadow:0 4px 20px rgba(0,0,0,0.04);">
                        <div class="sk-circle" style="width:72px;height:72px;margin:0 auto 14px;"></div>
                        <div class="sk-block" style="width:50px;height:24px;margin:0 auto 4px;"></div>
                        <div class="sk-block" style="width:80px;height:12px;margin:0 auto 6px;"></div>
                        <div class="sk-block" style="width:100px;height:14px;margin:0 auto 18px;"></div>
                        <div class="sk-block" style="width:120px;height:36px;margin:0 auto;border-radius:10px;"></div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <!-- ========== HERO SECTION ========== -->
    <section class="hero" id="home">
        <!-- Animated background particles -->
        <div class="hero-particles">
            <div class="particle" style="--x: 10%; --y: 20%; --size: 6px; --delay: 0s;"></div>
            <div class="particle" style="--x: 25%; --y: 60%; --size: 4px; --delay: 1.2s;"></div>
            <div class="particle" style="--x: 40%; --y: 30%; --size: 8px; --delay: 0.6s;"></div>
            <div class="particle" style="--x: 55%; --y: 70%; --size: 5px; --delay: 2s;"></div>
            <div class="particle" style="--x: 70%; --y: 15%; --size: 7px; --delay: 0.3s;"></div>
            <div class="particle" style="--x: 85%; --y: 50%; --size: 4px; --delay: 1.8s;"></div>
            <div class="particle" style="--x: 15%; --y: 85%; --size: 5px; --delay: 0.9s;"></div>
            <div class="particle" style="--x: 60%; --y: 90%; --size: 6px; --delay: 1.5s;"></div>
            <div class="particle" style="--x: 90%; --y: 35%; --size: 3px; --delay: 2.5s;"></div>
            <div class="particle" style="--x: 35%; --y: 10%; --size: 4px; --delay: 0.4s;"></div>
        </div>

        <div class="container">
            <div class="hero-content animate-in">
                <div class="hero-badge">
                    <div class="pulse-dot"></div>
                    <span class="badge-text">জরুরি রক্তদান সেবা</span>
                </div>

                <h1>
                    একটি রক্তের ফোঁটা<br>
                    <span class="highlight">একটি জীবন বাঁচাতে পারে</span>
                </h1>
                <p>
                    আমরা রক্তদাতা ও রোগীদের মধ্যে সেতুবন্ধন তৈরি করি। জরুরি মুহূর্তে <br class="hide-mobile">
                    সঠিক রক্তের গ্রুপ খুঁজে পেতে আমাদের সাথে যুক্ত হোন।
                </p>
                <div class="hero-buttons">
                    <a href="#blood-groups" class="btn-primary-custom">
                        <i class="bi bi-search"></i> ডোনার খুঁজুন
                    </a>
                    <a href="#contact" class="btn-secondary-custom">
                        <i class="bi bi-telephone-fill"></i> জরুরি যোগাযোগ
                    </a>
                </div>

                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number" data-target="{{ $donorsCount }}">0</span>
                        <span class="stat-label">নিবন্ধিত ডোনার</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" data-target="8" data-display="৮">০</span>
                        <span class="stat-label">ব্লাড গ্রুপ</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" data-target="24" data-display="২৪/৭">০</span>
                        <span class="stat-label">জরুরি সেবা</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== SUCCESS ALERT ========== -->
    <div class="alert-success" id="successAlert">
        <i class="bi bi-check-circle-fill"></i> আপনার বার্তা সফলভাবে পাঠানো হয়েছে!
    </div>

    <!-- ========== BLOOD GROUPS ========== -->
    <section class="blood-groups" id="blood-groups">
        <div class="container">
            <div class="section-header fade-in">
                <div class="section-subtitle">
                    <i class="bi bi-droplet-fill"></i> রক্তের গ্রুপ
                </div>
                <h2 class="section-title">উপলব্ধ রক্তের গ্রুপসমূহ</h2>
                <p class="section-desc">আপনার প্রয়োজনীয় রক্তের গ্রুপ নির্বাচন করে ডোনারদের তালিকা দেখুন</p>
            </div>

            @php
                $allGroups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
            @endphp

            <div class="blood-grid">
                @foreach($allGroups as $group)
                    @php $count = $bloodGroupCounts[$group] ?? 0; @endphp
                    <div class="blood-card fade-in">
                        <div class="blood-icon">
                            <span class="group-text">{{ $group }}</span>
                        </div>
                        <h3>{{ $group }}</h3>
                        <p class="label">ব্লাড গ্রুপ</p>
                        <p class="donor-count"><span>{{ $count }}</span> জন ডোনার</p>
                        <a href="{{ url('/donor_list/'.$group) }}" class="view-donors-btn">
                            ডোনার দেখুন <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ========== HOW IT WORKS ========== -->
    <section class="features" id="how-it-works">
        <div class="container">
            <div class="section-header fade-in">
                <div class="section-subtitle">
                    <i class="bi bi-gear-fill"></i> প্রক্রিয়া
                </div>
                <h2 class="section-title">কিভাবে কাজ করে</h2>
                <p class="section-desc">মাত্র তিনটি সহজ ধাপে আপনি রক্তদাতা খুঁজে পেতে পারেন</p>
            </div>

            <div class="features-grid">
                <div class="feature-card fade-in">
                    <div class="feature-step">১</div>
                    <div class="feature-icon red">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <h4>রেজিস্ট্রেশন করুন</h4>
                    <p>আপনার রক্তের গ্রুপ ও যোগাযোগের তথ্য দিয়ে নিবন্ধন করুন। এটি সম্পূর্ণ বিনামূল্যে।</p>
                </div>

                <div class="feature-card fade-in">
                    <div class="feature-step">২</div>
                    <div class="feature-icon blue">
                        <i class="bi bi-search-heart-fill"></i>
                    </div>
                    <h4>ডোনার খুঁজুন</h4>
                    <p>আপনার প্রয়োজনীয় ব্লাড গ্রুপ নির্বাচন করুন এবং নিকটস্থ ডোনারদের তালিকা দেখুন।</p>
                </div>

                <div class="feature-card fade-in">
                    <div class="feature-step">৩</div>
                    <div class="feature-icon green">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <h4>যোগাযোগ করুন</h4>
                    <p>সরাসরি ডোনারের সাথে যোগাযোগ করে রক্ত সংগ্রহ করুন এবং একটি জীবন বাঁচান।</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== WHY DONATE ========== -->
    <section class="why-donate">
        <div class="container">
            <div class="why-content fade-in">
                <div class="why-icon">
                    <i class="bi bi-heart-pulse-fill"></i>
                </div>
                <h2>কেন রক্ত দান করবেন?</h2>
                <p>প্রতি বছর লাখ লাখ মানুষের রক্তের প্রয়োজন হয়। একটি রক্তদান তিনটি জীবন বাঁচাতে পারে।<br>
                আপনার এক ফোঁটা রক্ত কারো জন্য হতে পারে নতুন জীবনের আশীর্বাদ।</p>
                <a href="#contact" class="btn-primary-custom">
                    <i class="bi bi-hand-index-thumb-fill"></i> এখনই যুক্ত হোন
                </a>
            </div>
        </div>
    </section>

    <!-- ========== CONTACT SECTION ========== -->
    <section class="contact-section" id="contact">
        <div class="container">
            <div class="section-header fade-in">
                <div class="section-subtitle">
                    <i class="bi bi-envelope-fill"></i> যোগাযোগ
                </div>
                <h2 class="section-title">আমাদের সাথে যোগাযোগ করুন</h2>
                <p class="section-desc">যেকোনো প্রশ্ন বা জরুরি প্রয়োজনে আমাদের জানান। আমরা ২৪/৭ সেবা দিতে প্রস্তুত।</p>
            </div>

            <div class="contact-grid">
                <!-- Contact Form -->
                <div class="contact-form-wrapper fade-in">
                    <form id="contactForm" action="{{ url('/contactus') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">
                                <i class="bi bi-person"></i> আপনার নাম
                            </label>
                            <input type="text" id="name" name="name" placeholder="আপনার পূর্ণ নাম লিখুন" required>
                        </div>

                        <div class="form-group">
                            <label for="email">
                                <i class="bi bi-envelope"></i> আপনার ইমেইল
                            </label>
                            <input type="email" id="email" name="email" placeholder="example@email.com" required>
                        </div>

                        <div class="form-group">
                            <label for="message">
                                <i class="bi bi-chat-dots"></i> বার্তা
                            </label>
                            <textarea id="message" name="message" rows="5" placeholder="আপনার বার্তা এখানে লিখুন..." required></textarea>
                        </div>

                        <button type="submit" class="submit-btn" id="contactSubmitBtn">
                            <i class="bi bi-send-fill"></i> বার্তা পাঠান
                            <span class="btn-shimmer"></span>
                        </button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="contact-info fade-in">
                    <div class="emergency-card">
                        <div class="emergency-icon">
                            <i class="fas fa-ambulance"></i>
                        </div>
                        <div class="emergency-badge">২৪/৭ জরুরি সেবা</div>
                        <h4>জরুরি হটলাইন</h4>
                        <p>২৪ ঘন্টা জরুরি রক্তের জন্য কল করুন</p>
                        <div class="phone">{{ $account->phone }}</div>
                        <a href="tel:{{ $account->phone }}" class="emergency-call-btn">
                            <i class="bi bi-telephone-fill"></i> এখনই কল করুন
                        </a>
                    </div>

                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div>
                            <h5>ইমেইল</h5>
                            <p>{{ $account->email }}</p>
                        </div>
                    </div>

                    <div class="contact-info-card">
                        <div class="contact-icon globe">
                            <i class="bi bi-globe2"></i>
                        </div>
                        <div>
                            <h5>ওয়েবসাইট</h5>
                            <p>{{ $account->website }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== FOOTER ========== -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="logo-icon">
                        <i class="bi bi-droplet-fill"></i>
                    </div>
                    <div>
                        <span class="brand-name">ব্লাড ব্যাংক</span>
                        <span class="brand-tagline">জীবন বাঁচানোর লক্ষ্যে</span>
                    </div>
                </div>

                <div class="footer-links">
                    <div class="footer-links-col">
                        <h6>কুইক লিংক</h6>
                        <a href="#home">হোম</a>
                        <a href="#blood-groups">রক্তের গ্রুপ</a>
                        <a href="#how-it-works">প্রক্রিয়া</a>
                        <a href="#contact">যোগাযোগ</a>
                    </div>
                    <div class="footer-links-col">
                        <h6>সেবাসমূহ</h6>
                        <a href="/donor_list">ডোনার তালিকা</a>
                        <a href="/login">লগইন</a>
                        <a href="/register">রেজিস্ট্রেশন</a>
                    </div>
                </div>

                <div class="footer-social">
                    <h6>ফলো করুন</h6>
                    <div class="social-icons">
                        <a href="#" class="social-icon facebook" title="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="social-icon twitter" title="Twitter">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                        <a href="#" class="social-icon whatsapp" title="WhatsApp">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                        <a href="#" class="social-icon youtube" title="YouTube">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; ২০২৫ ব্লাড ব্যাংক। সর্বস্বত্ব সংরক্ষিত।</p>
                <p class="footer-made-with">Developed by <span style="font-weight:800;background:linear-gradient(135deg,var(--primary-light),#f97316);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Joty Biswas</span></p>
            </div>
        </div>
    </footer>

    <!-- ========== SCRIPTS ========== -->
    <script>
        function animateCounter(el) {
            const target = parseInt(el.dataset.target);
            if (isNaN(target)) return;
            const duration = 2000;
            const step = Math.max(1, Math.floor(target / 40));
            let current = 0;
            const increment = setInterval(() => {
                current += step;
                if (current >= target) {
                    el.textContent = el.dataset.display || el.dataset.target;
                    clearInterval(increment);
                } else {
                    el.textContent = current;
                }
            }, duration / 40);
        }

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('.stat-number').forEach(el => counterObserver.observe(el));

        const fadeObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, index * 100);
                    fadeObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

        document.querySelectorAll('.fade-in').forEach(el => fadeObserver.observe(el));

        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const submitBtn = document.getElementById('contactSubmitBtn');
            const formData = new FormData(form);
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> পাঠানো হচ্ছে...';

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    form.reset();
                    document.getElementById('successAlert').classList.add('show');
                    setTimeout(() => {
                        document.getElementById('successAlert').classList.remove('show');
                    }, 4000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="bi bi-send-fill"></i> বার্তা পাঠান<span class="btn-shimmer"></span>';
            });
        });

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                const target = document.querySelector(targetId);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });

                    const navbar = document.getElementById('navbarTopNav');
                    if (navbar && navbar.classList.contains('show')) {
                        const toggler = document.querySelector('.navbar-toggler');
                        if (toggler) toggler.click();
                    }
                }
            });
        });
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800;900&display=swap');

        :root {
            --primary: #dc2626;
            --primary-light: #ef4444;
            --primary-dark: #b91c1c;
            --dark: #1a1a2e;
            --dark-2: #16213e;
            --dark-3: #0f3460;
            --text: #374151;
            --text-light: #6b7280;
            --bg: #f8f9fa;
            --white: #ffffff;
            --radius: 12px;
            --radius-lg: 20px;
            --shadow: 0 4px 20px rgba(0,0,0,0.06);
            --shadow-hover: 0 20px 50px rgba(220, 38, 38, 0.15);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', 'Noto Sans Bengali', sans-serif;
            color: var(--text);
            background: var(--dark);
            overflow-x: hidden;
            padding-top: 72px;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 72px;
        }

        .hero {
            background: linear-gradient(135deg, var(--dark) 0%, var(--dark-2) 50%, var(--dark-3) 100%);
            color: white;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
            min-height: 90vh;
            display: flex;
            align-items: center;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -10%;
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, rgba(220, 38, 38, 0.12) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -20%;
            left: -5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(239, 68, 68, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-particles {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: var(--size);
            height: var(--size);
            left: var(--x);
            top: var(--y);
            background: rgba(239, 68, 68, 0.4);
            border-radius: 50%;
            animation: float-particle 6s ease-in-out infinite;
            animation-delay: var(--delay);
        }

        @keyframes float-particle {
            0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.4; }
            25% { transform: translate(30px, -20px) scale(1.2); opacity: 0.8; }
            50% { transform: translate(-20px, 30px) scale(0.8); opacity: 0.3; }
            75% { transform: translate(20px, 20px) scale(1.1); opacity: 0.6; }
        }

        .hero .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            gap: 60px;
            position: relative;
            z-index: 1;
            width: 100%;
        }

        .hero-content { flex: 1; }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(220, 38, 38, 0.15);
            border: 1px solid rgba(220, 38, 38, 0.3);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            color: #fca5a5;
            margin-bottom: 28px;
            backdrop-filter: blur(10px);
        }

        .pulse-dot {
            width: 8px; height: 8px;
            background: var(--primary-light);
            border-radius: 50%;
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); box-shadow: 0 0 0 0 rgba(239,68,68,0.4); }
            50% { opacity: 0.6; transform: scale(1.3); box-shadow: 0 0 0 8px rgba(239,68,68,0); }
        }

        .hero h1 {
            font-size: 48px;
            font-weight: 900;
            line-height: 1.15;
            margin-bottom: 20px;
            letter-spacing: -0.5px;
        }

        .hero h1 .highlight {
            background: linear-gradient(135deg, var(--primary-light), #f97316);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            font-size: 17px;
            color: rgba(255,255,255,0.65);
            line-height: 1.8;
            margin-bottom: 32px;
            max-width: 540px;
        }

        .hero-buttons { display: flex; gap: 16px; flex-wrap: wrap; }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border: none;
            padding: 15px 34px;
            border-radius: var(--radius);
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 20px rgba(220, 38, 38, 0.35);
            position: relative;
            overflow: hidden;
        }

        .btn-primary-custom::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent 20%, rgba(255,255,255,0.1) 100%);
            transition: transform 0.5s;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 35px rgba(220, 38, 38, 0.45);
        }

        .btn-secondary-custom {
            background: rgba(255,255,255,0.08);
            border: 2px solid rgba(255,255,255,0.25);
            color: white;
            padding: 15px 34px;
            border-radius: var(--radius);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(5px);
        }

        .btn-secondary-custom:hover {
            background: rgba(255,255,255,0.15);
            border-color: rgba(255,255,255,0.45);
            transform: translateY(-3px);
        }

        .hero-stats {
            display: flex;
            gap: 40px;
            margin-top: 48px;
            padding-top: 28px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .stat-item { text-align: left; }

        .stat-number {
            display: block;
            font-size: 36px;
            font-weight: 900;
            color: var(--primary-light);
            line-height: 1.1;
        }

        .stat-label {
            display: block;
            font-size: 13px;
            color: rgba(255,255,255,0.45);
            font-weight: 500;
            margin-top: 4px;
        }

        .alert-success {
            max-width: 1200px;
            margin: 20px auto;
            padding: 18px 28px;
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
            border-left: 5px solid #22c55e;
            border-radius: var(--radius);
            color: #15803d;
            font-weight: 600;
            text-align: center;
            display: none;
            font-size: 15px;
            gap: 10px;
            align-items: center;
            justify-content: center;
        }

        .alert-success.show {
            display: flex;
            animation: slideDown 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .section-header { text-align: center; margin-bottom: 50px; }

        .section-subtitle {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fef2f2;
            color: var(--primary);
            padding: 7px 20px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 18px;
        }

        .section-title {
            font-size: 36px;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 14px;
            letter-spacing: -0.3px;
        }

        .section-desc {
            font-size: 16px;
            color: var(--text-light);
            max-width: 520px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .blood-groups {
            padding: 80px 0;
            background: linear-gradient(180deg, var(--white) 0%, #fef2f2 100%);
        }

        .blood-groups .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        .blood-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .blood-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 32px 20px 28px;
            text-align: center;
            box-shadow: var(--shadow);
            border: 2px solid transparent;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .blood-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            transform: scaleX(0);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: left;
        }

        .blood-card:hover::before { transform: scaleX(1); }

        .blood-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(220, 38, 38, 0.1);
        }

        .blood-icon {
            width: 72px;
            height: 72px;
            margin: 0 auto 14px;
            background: linear-gradient(135deg, #fef2f2, #fee2e2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .blood-card:hover .blood-icon {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            transform: scale(1.1) rotate(-5deg);
        }

        .blood-icon .group-text {
            font-size: 26px;
            font-weight: 800;
            color: var(--primary);
            transition: color 0.35s;
        }

        .blood-card:hover .blood-icon .group-text { color: white; }

        .blood-card h3 { font-size: 24px; font-weight: 800; color: var(--primary); margin-bottom: 2px; }
        .blood-card .label {
            font-size: 12px;
            color: #9ca3af;
            font-weight: 500;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .blood-card .donor-count {
            font-size: 14px;
            color: var(--text-light);
            font-weight: 600;
            margin-bottom: 18px;
        }

        .blood-card .donor-count span { color: var(--primary); font-weight: 800; }

        .view-donors-btn {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border: none;
            padding: 11px 22px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .view-donors-btn:hover {
            box-shadow: 0 4px 18px rgba(220, 38, 38, 0.4);
            transform: translateY(-2px);
        }

        .features { padding: 80px 0; background: var(--white); }
        .features .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .feature-card {
            padding: 40px 30px;
            border-radius: var(--radius-lg);
            background: linear-gradient(135deg, #fafafa, var(--white));
            border: 1px solid #f3f4f6;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 50px rgba(0,0,0,0.08);
            border-color: rgba(220, 38, 38, 0.1);
        }

        .feature-step {
            position: absolute;
            top: 16px;
            right: 20px;
            font-size: 48px;
            font-weight: 900;
            color: rgba(220, 38, 38, 0.06);
            line-height: 1;
        }

        .feature-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            margin: 0 auto 20px;
            transition: all 0.35s;
        }

        .feature-card:hover .feature-icon { transform: scale(1.1) rotate(-5deg); }

        .feature-icon.red { background: #fef2f2; color: var(--primary); }
        .feature-icon.blue { background: #eff6ff; color: #2563eb; }
        .feature-icon.green { background: #f0fdf4; color: #16a34a; }

        .feature-card h4 { font-size: 20px; font-weight: 700; color: var(--dark); margin-bottom: 12px; }
        .feature-card p { font-size: 15px; color: var(--text-light); line-height: 1.7; }

        .why-donate {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--dark), var(--dark-2), var(--dark-3));
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .why-donate::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 50% 50%, rgba(220,38,38,0.1) 0%, transparent 60%);
        }

        .why-donate .container { max-width: 800px; margin: 0 auto; padding: 0 20px; position: relative; z-index: 1; }
        .why-content { color: white; }

        .why-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 24px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: white;
            box-shadow: 0 10px 40px rgba(220, 38, 38, 0.3);
            animation: heartbeat 2s infinite;
        }

        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            10% { transform: scale(1.15); }
            20% { transform: scale(1); }
            30% { transform: scale(1.1); }
            40% { transform: scale(1); }
        }

        .why-content h2 { font-size: 36px; font-weight: 800; margin-bottom: 16px; }
        .why-content p { font-size: 17px; color: rgba(255,255,255,0.7); line-height: 1.8; margin-bottom: 32px; }

        .contact-section { padding: 80px 0; background: linear-gradient(180deg, #f8f9fa 0%, var(--white) 100%); }
        .contact-section .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        .contact-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 40px;
            align-items: start;
        }

        .contact-form-wrapper {
            background: white;
            padding: 40px 36px;
            border-radius: 24px;
            box-shadow: var(--shadow);
            border: 1px solid #f3f4f6;
        }

        .form-group { margin-bottom: 22px; }

        .form-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 8px;
        }

        .form-group label i { color: var(--primary); }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e5e7eb;
            border-radius: var(--radius);
            font-size: 15px;
            font-family: inherit;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #fafafa;
            outline: none;
            color: var(--text);
        }

        .form-group input:focus, .form-group textarea:focus {
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.08);
        }

        .form-group textarea { resize: vertical; min-height: 130px; }

        .submit-btn {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border: none;
            width: 100%;
            padding: 16px;
            border-radius: var(--radius);
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(220, 38, 38, 0.35);
        }

        .submit-btn:disabled { opacity: 0.7; cursor: not-allowed; transform: none !important; }

        .btn-shimmer {
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer { 0% { left: -100%; } 100% { left: 200%; } }

        .contact-info { display: flex; flex-direction: column; gap: 20px; }

        .emergency-card {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            padding: 32px 28px;
            border-radius: var(--radius-lg);
            color: white;
            text-align: center;
            box-shadow: 0 8px 35px rgba(220, 38, 38, 0.3);
            position: relative;
            overflow: hidden;
        }

        .emergency-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 60%);
        }

        .emergency-icon { font-size: 42px; margin-bottom: 12px; }

        .emergency-badge {
            display: inline-block;
            background: rgba(255,255,255,0.15);
            padding: 4px 14px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 14px;
        }

        .emergency-card h4 { font-size: 20px; font-weight: 800; margin-bottom: 6px; }
        .emergency-card p { font-size: 14px; opacity: 0.85; margin-bottom: 16px; }
        .emergency-card .phone { font-size: 26px; font-weight: 900; letter-spacing: 1px; margin-bottom: 16px; }

        .emergency-call-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.2);
            color: white;
            padding: 12px 28px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            transition: all 0.3s;
        }

        .emergency-call-btn:hover { background: rgba(255,255,255,0.3); transform: translateY(-2px); }

        .contact-info-card {
            background: white;
            padding: 24px;
            border-radius: 16px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: flex-start;
            gap: 16px;
            border: 1px solid #f3f4f6;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .contact-info-card:hover { transform: translateX(6px); box-shadow: 0 8px 30px rgba(0,0,0,0.08); }

        .contact-icon {
            width: 50px; height: 50px;
            background: linear-gradient(135deg, #fef2f2, #fee2e2);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; color: var(--primary); flex-shrink: 0;
        }

        .contact-icon.globe { background: linear-gradient(135deg, #eff6ff, #dbeafe); color: #2563eb; }
        .contact-info-card h5 { font-size: 15px; font-weight: 700; color: var(--dark); margin-bottom: 4px; }
        .contact-info-card p { font-size: 14px; color: var(--text-light); line-height: 1.5; word-break: break-all; }

        .footer { background: var(--dark); color: white; padding: 60px 0 0; }
        .footer .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        .footer-content {
            display: grid;
            grid-template-columns: 1.5fr 1.5fr 1fr;
            gap: 40px;
            padding-bottom: 40px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .footer-brand { display: flex; align-items: flex-start; gap: 14px; }

        .footer-brand .logo-icon {
            width: 48px; height: 48px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; flex-shrink: 0;
        }

        .brand-name { display: block; font-size: 20px; font-weight: 800; margin-bottom: 2px; }
        .brand-tagline { display: block; font-size: 13px; color: rgba(255,255,255,0.4); }

        .footer-links { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }

        .footer-links-col h6, .footer-social h6 {
            font-size: 13px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 1px; color: rgba(255,255,255,0.4); margin-bottom: 16px;
        }

        .footer-links-col a {
            display: block;
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            padding: 4px 0;
            transition: all 0.3s;
        }

        .footer-links-col a:hover { color: var(--primary-light); padding-left: 4px; }

        .social-icons { display: flex; gap: 10px; }

        .social-icon {
            width: 42px; height: 42px;
            background: rgba(255,255,255,0.08);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 18px;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .social-icon:hover { transform: translateY(-3px); }
        .social-icon.facebook:hover { background: #1877f2; }
        .social-icon.twitter:hover { background: #1da1f2; }
        .social-icon.whatsapp:hover { background: #25d366; }
        .social-icon.youtube:hover { background: #ff0000; }

        .footer-bottom { display: flex; justify-content: space-between; align-items: center; padding: 24px 0; flex-wrap: wrap; gap: 8px; }
        .footer-bottom p { font-size: 13px; color: rgba(255,255,255,0.35); }
        .footer-made-with .heart { color: var(--primary-light); display: inline-block; animation: heartbeat 1.5s infinite; }

        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .fade-in.visible { opacity: 1; transform: translateY(0); }

        @media (max-width: 991.98px) {
            body { padding-top: 64px; }
            html { scroll-padding-top: 64px; }
            .hero { min-height: auto; padding: 60px 0; }
            .hero h1 { font-size: 36px; }
            .hero .container { flex-direction: column; text-align: center; gap: 30px; }
            .hero-content { order: 2; }
            .hero p { margin: 0 auto 28px; }
            .hero-buttons { justify-content: center; }
            .hero-stats { justify-content: center; }
            .stat-item { text-align: center; }
            .hide-mobile { display: none; }
            .blood-grid { grid-template-columns: repeat(3, 1fr); gap: 20px; }
            .section-title { font-size: 30px; }
            .features-grid { gap: 24px; }
            .contact-grid { grid-template-columns: 1fr; gap: 30px; }
            .footer-content { grid-template-columns: 1fr 1fr; gap: 30px; }
        }

        @media (max-width: 767.98px) {
            body { padding-top: 60px; }
            html { scroll-padding-top: 60px; }
            .hero { padding: 40px 0; }
            .hero h1 { font-size: 28px; }
            .hero p { font-size: 15px; }
            .hero-badge { font-size: 11px; padding: 6px 14px; }
            .hero-buttons { flex-direction: column; align-items: stretch; }
            .hero-buttons a { text-align: center; justify-content: center; padding: 13px 24px; font-size: 15px; }
            .hero-stats { gap: 24px; margin-top: 32px; padding-top: 20px; }
            .stat-number { font-size: 28px; }
            .blood-groups { padding: 50px 0; }
            .features { padding: 50px 0; }
            .why-donate { padding: 50px 0; }
            .contact-section { padding: 50px 0; }
            .section-header { margin-bottom: 30px; }
            .section-title { font-size: 24px; }
            .section-desc { font-size: 14px; }
            .blood-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
            .blood-card { padding: 24px 14px 20px; }
            .blood-icon { width: 56px; height: 56px; }
            .blood-icon .group-text { font-size: 20px; }
            .blood-card h3 { font-size: 20px; }
            .blood-card .donor-count { font-size: 13px; }
            .view-donors-btn { padding: 9px 16px; font-size: 12px; }
            .features-grid { grid-template-columns: 1fr; gap: 20px; }
            .feature-card { padding: 30px 24px; }
            .why-content h2 { font-size: 26px; }
            .why-content p { font-size: 15px; }
            .why-icon { width: 64px; height: 64px; font-size: 28px; }
            .contact-form-wrapper { padding: 28px 20px; border-radius: 18px; }
            .form-group input, .form-group textarea { padding: 12px 16px; font-size: 14px; }
            .submit-btn { padding: 14px; font-size: 15px; }
            .emergency-card { padding: 24px 20px; }
            .emergency-card .phone { font-size: 22px; }
            .emergency-call-btn { padding: 10px 20px; font-size: 14px; }
            .contact-info-card { padding: 20px; }
            .footer { padding: 40px 0 0; }
            .footer-content { grid-template-columns: 1fr; gap: 24px; text-align: center; }
            .footer-brand { flex-direction: column; align-items: center; }
            .footer-links { gap: 20px; }
            .social-icons { justify-content: center; }
            .footer-bottom { flex-direction: column; text-align: center; }
        }

        @media (max-width: 480px) {
            body { padding-top: 56px; }
            html { scroll-padding-top: 56px; }
            .hero { padding: 30px 0; }
            .hero h1 { font-size: 24px; }
            .hero-stats { gap: 16px; }
            .stat-number { font-size: 22px; }
            .stat-label { font-size: 11px; }
            .blood-grid { gap: 10px; }
            .blood-card { padding: 18px 10px 16px; border-radius: 14px; }
            .blood-icon { width: 48px; height: 48px; margin-bottom: 10px; }
            .blood-icon .group-text { font-size: 17px; }
            .blood-card h3 { font-size: 17px; }
            .blood-card .donor-count { font-size: 12px; }
            .view-donors-btn { padding: 8px 14px; font-size: 11px; }
            .section-title { font-size: 22px; }
            .why-content h2 { font-size: 22px; }
            .contact-form-wrapper { padding: 20px 14px; border-radius: 14px; }
            .form-group label { font-size: 13px; }
            .form-group input, .form-group textarea { padding: 11px 14px; font-size: 13px; }
            .submit-btn { font-size: 14px; padding: 12px; }
            .emergency-card .phone { font-size: 18px; }
            .footer-bottom p { font-size: 12px; }
        }

        @media (max-width: 360px) {
            .blood-grid { grid-template-columns: 1fr 1fr; gap: 8px; }
            .blood-card { padding: 14px 8px 12px; }
            .blood-icon { width: 40px; height: 40px; }
            .blood-icon .group-text { font-size: 14px; }
            .blood-card h3 { font-size: 15px; }
            .view-donors-btn { font-size: 10px; padding: 6px 10px; }
            .hero h1 { font-size: 20px; }
        }

        /* ===== LIGHT MODE OVERRIDES ===== */
        .light-mode body {
            background: var(--theme-bg);
        }

        .light-mode .hero {
            background: var(--theme-hero-bg);
        }

        .light-mode .hero::before,
        .light-mode .hero::after {
            opacity: 0.4;
        }

        .light-mode .hero h1 {
            color: #1f2937;
        }

        .light-mode .hero h1 .highlight {
            -webkit-text-fill-color: transparent;
        }

        .light-mode .hero p {
            color: rgba(0, 0, 0, 0.5);
        }

        .light-mode .hero-badge {
            background: rgba(220, 38, 38, 0.08);
            border-color: rgba(220, 38, 38, 0.2);
            color: #dc2626;
        }

        .light-mode .hero-stats {
            border-top-color: rgba(0, 0, 0, 0.06);
        }

        .light-mode .stat-label {
            color: rgba(0, 0, 0, 0.4);
        }

        .light-mode .btn-secondary-custom {
            background: rgba(0, 0, 0, 0.04);
            border-color: rgba(0, 0, 0, 0.15);
            color: #374151;
        }

        .light-mode .btn-secondary-custom:hover {
            background: rgba(0, 0, 0, 0.08);
            border-color: rgba(0, 0, 0, 0.25);
        }

        .light-mode .section-header .section-subtitle {
            background: #fef2f2;
            color: #dc2626;
        }

        .light-mode .section-title {
            color: #1f2937;
        }

        .light-mode .section-desc {
            color: #6b7280;
        }

        .light-mode .blood-groups {
            background: linear-gradient(180deg, #ffffff 0%, #fef2f2 100%);
        }

        .light-mode .blood-card {
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        .light-mode .blood-card:hover {
            box-shadow: 0 20px 50px rgba(220, 38, 38, 0.12);
        }

        .light-mode .blood-card h3 {
            color: #dc2626;
        }

        .light-mode .blood-card .donor-count {
            color: #6b7280;
        }

        .light-mode .features {
            background: #ffffff;
        }

        .light-mode .feature-card {
            background: linear-gradient(135deg, #fafafa, #ffffff);
            border-color: #f3f4f6;
        }

        .light-mode .feature-card h4 {
            color: #1f2937;
        }

        .light-mode .feature-card p {
            color: #6b7280;
        }

        .light-mode .why-donate {
            background: linear-gradient(135deg, #1f2937, #111827, #1a1a2e);
        }

        .light-mode .why-content h2 {
            color: #fff;
        }

        .light-mode .why-content p {
            color: rgba(255, 255, 255, 0.7);
        }

        .light-mode .contact-section {
            background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
        }

        .light-mode .contact-form-wrapper {
            background: #ffffff;
            border-color: #f3f4f6;
        }

        .light-mode .form-group label {
            color: #374151;
        }

        .light-mode .form-group input,
        .light-mode .form-group textarea {
            background: #fafafa;
            border-color: #e5e7eb;
            color: #374151;
        }

        .light-mode .form-group input:focus,
        .light-mode .form-group textarea:focus {
            border-color: #dc2626;
            background: #ffffff;
        }

        .light-mode .contact-info-card {
            background: #ffffff;
            border-color: #f3f4f6;
        }

        .light-mode .contact-info-card h5 {
            color: #1f2937;
        }

        .light-mode .contact-info-card p {
            color: #6b7280;
        }

        .light-mode .footer {
            background: var(--theme-footer-bg);
        }

        .light-mode .footer h6 {
            color: rgba(255, 255, 255, 0.4);
        }

        .light-mode .footer-links-col a {
            color: rgba(255, 255, 255, 0.65);
        }

        .light-mode .footer-bottom p {
            color: rgba(255, 255, 255, 0.35);
        }

        .light-mode .particle {
            background: rgba(220, 38, 38, 0.3);
        }
    </style>

@endsection