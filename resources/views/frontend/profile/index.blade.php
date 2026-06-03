@extends('frontend.app')

@section('skeleton')
    {{-- ===== PROFILE SKELETON ===== --}}
    <div style="padding-top:72px;display:flex;align-items:flex-start;justify-content:center;padding:72px 20px 40px;min-height:60vh;">
        <div style="max-width:560px;width:100%;">
            {{-- Card Skeleton --}}
            <div style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.05);border-radius:24px;overflow:hidden;">
                {{-- Header --}}
                <div style="padding:36px 32px 28px;text-align:center;border-bottom:1px solid rgba(255,255,255,0.04);">
                    <div style="position:relative;display:inline-block;margin-bottom:16px;">
                        <div class="sk-circle" style="width:88px;height:88px;"></div>
                    </div>
                    <div class="sk-block" style="width:180px;height:24px;margin:0 auto 10px;"></div>
                    <div class="sk-block" style="width:100px;height:28px;margin:0 auto;border-radius:50px;"></div>
                </div>
                {{-- Body --}}
                <div style="padding:28px 32px;">
                    <div class="sk-block" style="width:120px;height:14px;margin-bottom:18px;"></div>
                    @for($i=0;$i<4;$i++)
                    <div style="display:flex;align-items:center;gap:16px;padding:14px 18px;background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.04);border-radius:12px;margin-bottom:12px;">
                        <div class="sk-block" style="width:44px;height:44px;border-radius:12px;flex-shrink:0;"></div>
                        <div style="flex:1;">
                            <div class="sk-block" style="width:80px;height:11px;margin-bottom:6px;"></div>
                            <div class="sk-block" style="width:140px;height:16px;"></div>
                        </div>
                    </div>
                    @endfor
                    {{-- Status --}}
                    <div style="margin-top:20px;padding:16px 18px;border:1px solid rgba(255,255,255,0.04);border-radius:12px;">
                        <div class="sk-block" style="width:100%;height:8px;border-radius:50px;"></div>
                    </div>
                </div>
                {{-- Actions --}}
                <div style="padding:0 32px 32px;">
                    <div class="sk-block" style="width:100%;height:48px;border-radius:12px;margin-bottom:10px;"></div>
                    <div class="sk-block" style="width:100%;height:44px;border-radius:12px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <!-- ========== ANIMATED BACKGROUND PARTICLES ========== -->
    <div class="profile-particles">
        <div class="particle" style="--x: 8%; --y: 15%; --size: 6px; --delay: 0s;"></div>
        <div class="particle" style="--x: 30%; --y: 55%; --size: 4px; --delay: 1.4s;"></div>
        <div class="particle" style="--x: 50%; --y: 25%; --size: 7px; --delay: 0.7s;"></div>
        <div class="particle" style="--x: 72%; --y: 65%; --size: 4px; --delay: 2.1s;"></div>
        <div class="particle" style="--x: 88%; --y: 12%; --size: 5px; --delay: 0.4s;"></div>
        <div class="particle" style="--x: 15%; --y: 80%; --size: 3px; --delay: 1.9s;"></div>
        <div class="particle" style="--x: 42%; --y: 88%; --size: 5px; --delay: 0.9s;"></div>
        <div class="particle" style="--x: 65%; --y: 40%; --size: 3px; --delay: 2.5s;"></div>
        <div class="particle" style="--x: 92%; --y: 78%; --size: 5px; --delay: 1.1s;"></div>
        <div class="particle" style="--x: 22%; --y: 35%; --size: 4px; --delay: 0.3s;"></div>
    </div>

    <!-- ========== DECORATIVE GLOW ========== -->
    <div class="profile-glow"></div>

    <!-- ========== SUCCESS ALERT ========== -->
    @if (session('success'))
        <div class="alert-custom" id="successAlert">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif

    <!-- ========== PROFILE SECTION ========== -->
    <section class="profile-section">
        <div class="container">
            <div class="profile-card">

                <!-- Card Header -->
                <div class="profile-header">
                    <div class="avatar-wrapper">
                        <div class="avatar-circle">
                            {{ strtoupper(substr($profile->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="avatar-ring"></div>
                    </div>
                    <div class="header-info">
                        <h2>{{ $profile->name ?? 'Not Set' }}</h2>
                        <span class="blood-label">
                            <i class="bi bi-droplet-fill"></i>
                            {{ $profile->blood ?? 'Not Set' }}
                        </span>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="profile-body">

                    <div class="section-label">
                        <i class="bi bi-info-circle-fill"></i> প্রোফাইল তথ্য
                    </div>

                    <div class="info-grid">
                        <!-- Mobile -->
                        <div class="info-item">
                            <div class="info-icon phone-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div class="info-content">
                                <span class="info-label">মোবাইল নম্বর</span>
                                <span class="info-value">{{ $profile->number ?? 'সেট করা হয়নি' }}</span>
                            </div>
                        </div>

                        <!-- Blood -->
                        <div class="info-item">
                            <div class="info-icon blood-icon-bg">
                                <i class="bi bi-droplet-half"></i>
                            </div>
                            <div class="info-content">
                                <span class="info-label">রক্তের গ্রুপ</span>
                                <span class="info-value blood-value">{{ $profile->blood ?? '--' }}</span>
                            </div>
                        </div>

                        <!-- Division -->
                        <div class="info-item">
                            <div class="info-icon div-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div class="info-content">
                                <span class="info-label">বিভাগ</span>
                                <span class="info-value">{{ $profile->division ?? 'সেট করা হয়নি' }}</span>
                            </div>
                        </div>

                        <!-- Last Donated -->
                        <div class="info-item">
                            <div class="info-icon cal-icon">
                                <i class="bi bi-calendar-check-fill"></i>
                            </div>
                            <div class="info-content">
                                <span class="info-label">সর্বশেষ রক্তদান</span>
                                <span class="info-value">
                                    @if($profile->last_donated)
                                        {{ \Carbon\Carbon::parse($profile->last_donated)->timezone('Asia/Dhaka')->format('d M Y') }}
                                    @else
                                        <span class="text-muted">এখনো দান করেননি</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Donation Status -->
                    @if($profile->last_donated)
                    <div class="donation-status">
                        <div class="status-bar">
                            @php
                                $nextDate = $profile->nextDonationDate();
                                $today = now()->startOfDay();
                                $diffDays = $today->diffInDays($nextDate, false);
                                $totalDays = 90;
                                $elapsed = 90 - max(0, $diffDays);
                                $percent = min(100, max(0, ($elapsed / $totalDays) * 100));
                            @endphp
                            <div class="status-bar-fill" style="width: {{ $percent }}%;"></div>
                            <div class="status-bar-label">
                                @if($diffDays <= 0)
                                    <i class="bi bi-check-circle-fill"></i> আপনি এখন রক্ত দিতে পারবেন!
                                @else
                                    পরবর্তী দানের জন্য আর {{ $diffDays }} দিন বাকি
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                </div>

                <!-- Card Actions -->
                <div class="profile-actions">
                    <a href="{{ url('/profile/edit') }}" class="btn-edit">
                        <i class="bi bi-pencil-square"></i>
                        প্রোফাইল এডিট করুন
                    </a>
                    <a href="{{ url('/') }}" class="btn-back">
                        <i class="bi bi-house-fill"></i>
                        হোম পেজ
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- ========== FOOTER ========== -->
    <footer class="profile-footer">
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
                        <a href="{{ url('/') }}">হোম</a>
                        <a href="{{ url('/profile') }}">আমার প্রোফাইল</a>
                        <a href="{{ url('/profile/edit') }}">প্রোফাইল এডিট</a>
                        <a href="{{ url('/donor_list') }}">ডোনার তালিকা</a>
                    </div>
                    <div class="footer-links-col">
                        <h6>সেবাসমূহ</h6>
                        <a href="{{ url('/donor_list/A+') }}">A+ ডোনার</a>
                        <a href="{{ url('/donor_list/B+') }}">B+ ডোনার</a>
                        <a href="{{ url('/donor_list/O+') }}">O+ ডোনার</a>
                        <a href="{{ url('/donor_list/AB+') }}">AB+ ডোনার</a>
                    </div>
                </div>

                <div class="footer-social">
                    <h6>ফলো করুন</h6>
                    <div class="social-icons">
                        <a href="#" class="social-icon facebook" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon twitter" title="Twitter"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-icon whatsapp" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                        <a href="#" class="social-icon youtube" title="YouTube"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; ২০২৫ ব্লাড ব্যাংক। সর্বস্বত্ব সংরক্ষিত।</p>
                <p class="footer-made-with">Developed by <span class="dev-name">Joty Biswas</span></p>
            </div>
        </div>
    </footer>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800&display=swap');

        :root {
            --primary: #dc2626;
            --primary-light: #ef4444;
            --primary-dark: #b91c1c;
            --dark: #1a1a2e;
            --dark-2: #16213e;
            --dark-3: #0f3460;
            --text: #374151;
            --text-light: #6b7280;
            --white: #ffffff;
            --radius: 12px;
            --radius-lg: 20px;
            --shadow: 0 4px 20px rgba(0,0,0,0.06);
            --shadow-hover: 0 20px 50px rgba(220, 38, 38, 0.15);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', 'Noto Sans Bengali', sans-serif;
            background: linear-gradient(135deg, var(--dark) 0%, var(--dark-2) 50%, var(--dark-3) 100%);
            min-height: 100vh;
            padding-top: 72px;
        }

        /* ===== ANIMATED BACKGROUND PARTICLES ===== */
        .profile-particles {
            position: fixed;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
        }

        .profile-particles .particle {
            position: absolute;
            width: var(--size);
            height: var(--size);
            left: var(--x);
            top: var(--y);
            background: rgba(239, 68, 68, 0.35);
            border-radius: 50%;
            animation: float-particle 7s ease-in-out infinite;
            animation-delay: var(--delay);
        }

        @keyframes float-particle {
            0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.35; }
            25% { transform: translate(35px, -25px) scale(1.25); opacity: 0.7; }
            50% { transform: translate(-25px, 35px) scale(0.75); opacity: 0.2; }
            75% { transform: translate(25px, 25px) scale(1.15); opacity: 0.55; }
        }

        /* ===== DECORATIVE GLOW ===== */
        .profile-glow {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(220, 38, 38, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
            animation: glow-pulse 4s ease-in-out infinite;
        }

        @keyframes glow-pulse {
            0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.6; }
            50% { transform: translate(-50%, -50%) scale(1.15); opacity: 1; }
        }

        .alert-custom {
            max-width: 560px;
            margin: 24px auto 0;
            padding: 14px 20px;
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
            border-left: 4px solid #22c55e;
            border-radius: var(--radius);
            color: #15803d;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 1;
        }

        .alert-custom i { font-size: 18px; flex-shrink: 0; }

        .alert-close {
            margin-left: auto;
            background: none;
            border: none;
            color: #15803d;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.2s;
            padding: 2px 6px;
            font-size: 14px;
        }

        .alert-close:hover { opacity: 1; }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .profile-section {
            padding: 40px 0 10px;
            min-height: 60vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            position: relative;
            z-index: 1;
        }

        .profile-section .container {
            max-width: 560px;
            margin: 0 auto;
            padding: 0 20px;
            width: 100%;
        }

        .profile-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            overflow: hidden;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.3), 0 0 40px rgba(220, 38, 38, 0.06);
            animation: cardFadeIn 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes cardFadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .profile-header {
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.15), rgba(185, 28, 28, 0.08));
            padding: 36px 32px 28px;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(220, 38, 38, 0.08), transparent 70%);
            border-radius: 50%;
        }

        .profile-header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(239, 68, 68, 0.06), transparent 70%);
            border-radius: 50%;
        }

        .avatar-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 16px;
        }

        .avatar-circle {
            width: 88px; height: 88px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            font-weight: 800;
            color: #fff;
            position: relative;
            z-index: 1;
            box-shadow: 0 4px 20px rgba(220, 38, 38, 0.4);
            letter-spacing: 0;
        }

        .avatar-ring {
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            border: 2.5px solid rgba(239, 68, 68, 0.3);
            animation: ringPulse 3s ease-in-out infinite;
        }

        @keyframes ringPulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.08); opacity: 0.2; }
        }

        .header-info h2 {
            font-size: 22px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 6px;
            letter-spacing: -0.3px;
        }

        .blood-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(220, 38, 38, 0.2);
            border: 1px solid rgba(220, 38, 38, 0.4);
            color: #fca5a5;
            padding: 5px 16px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 700;
        }

        .blood-label i { font-size: 12px; }

        .profile-body { padding: 28px 32px; }

        .section-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 700;
            color: rgba(255,255,255,0.35);
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 18px;
        }

        .section-label i { font-size: 14px; }

        .info-grid {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 14px 18px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: var(--radius);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .info-item:hover {
            background: rgba(255, 255, 255, 0.07);
            border-color: rgba(220, 38, 38, 0.2);
            transform: translateX(4px);
        }

        .info-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .phone-icon { background: rgba(34, 197, 94, 0.15); color: #22c55e; }
        .blood-icon-bg { background: rgba(239, 68, 68, 0.15); color: var(--primary-light); }
        .div-icon { background: rgba(59, 130, 246, 0.15); color: #3b82f6; }
        .cal-icon { background: rgba(234, 179, 8, 0.15); color: #eab308; }

        .info-content {
            display: flex;
            flex-direction: column;
            gap: 2px;
            min-width: 0;
        }

        .info-label {
            font-size: 11px;
            font-weight: 600;
            color: rgba(255,255,255,0.35);
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .info-value {
            font-size: 15px;
            font-weight: 600;
            color: #f5f5f5;
            word-break: break-word;
        }

        .blood-value {
            font-size: 20px; font-weight: 800;
            color: var(--primary-light);
        }

        .text-muted { color: rgba(255,255,255,0.3); }

        .donation-status {
            margin-top: 20px;
            padding: 16px 18px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: var(--radius);
        }

        .status-bar {
            position: relative;
            height: 8px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 999px;
            overflow: visible;
        }

        .status-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            border-radius: 999px;
            transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
            min-width: 4px;
        }

        .status-bar-label {
            position: absolute;
            top: 16px; left: 0; right: 0;
            text-align: center;
            font-size: 13px;
            font-weight: 600;
            color: rgba(255,255,255,0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .status-bar-label i { color: #22c55e; font-size: 14px; }

        .profile-actions {
            padding: 0 32px 32px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn-edit {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 24px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: #fff;
            text-decoration: none;
            border-radius: var(--radius);
            font-size: 15px;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 20px rgba(220, 38, 38, 0.35);
            border: none;
            cursor: pointer;
            font-family: inherit;
        }

        .btn-edit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(220, 38, 38, 0.45);
            color: #fff;
        }

        .btn-back {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            border-radius: var(--radius);
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: inherit;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        /* ===== FOOTER ===== */
        .profile-footer {
            position: relative;
            z-index: 1;
            background: linear-gradient(180deg, rgba(26, 26, 46, 0.95), var(--dark-2));
            color: white;
            padding: 48px 0 0;
            margin-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .profile-footer .container {
            max-width: 560px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .profile-footer .footer-content {
            display: flex;
            flex-direction: column;
            gap: 28px;
            padding-bottom: 32px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .profile-footer .footer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile-footer .logo-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; flex-shrink: 0;
        }

        .profile-footer .brand-name {
            display: block; font-size: 17px; font-weight: 800; margin-bottom: 1px;
        }

        .profile-footer .brand-tagline {
            display: block; font-size: 12px; color: rgba(255,255,255,0.4);
        }

        .profile-footer .footer-links {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .profile-footer .footer-links-col h6,
        .profile-footer .footer-social h6 {
            font-size: 11px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 1.2px; color: rgba(255,255,255,0.3); margin-bottom: 12px;
        }

        .profile-footer .footer-links-col a {
            display: block;
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            padding: 3px 0;
            transition: all 0.3s;
        }

        .profile-footer .footer-links-col a:hover { color: var(--primary-light); padding-left: 4px; }

        .profile-footer .social-icons {
            display: flex;
            gap: 8px;
        }

        .profile-footer .social-icon {
            width: 36px; height: 36px;
            background: rgba(255,255,255,0.06);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 15px;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .profile-footer .social-icon:hover { transform: translateY(-3px); }
        .profile-footer .social-icon.facebook:hover { background: #1877f2; }
        .profile-footer .social-icon.twitter:hover { background: #1da1f2; }
        .profile-footer .social-icon.whatsapp:hover { background: #25d366; }
        .profile-footer .social-icon.youtube:hover { background: #ff0000; }

        .profile-footer .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            flex-wrap: wrap;
            gap: 8px;
        }

        .profile-footer .footer-bottom p {
            font-size: 12px;
            color: rgba(255,255,255,0.3);
        }

        .profile-footer .dev-name {
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-light), #f97316);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 991.98px) {
            body { padding-top: 64px; }
            .profile-section { padding: 28px 0 10px; min-height: 50vh; }
        }

        @media (max-width: 767.98px) {
            body { padding-top: 60px; }
            .profile-section { padding: 20px 0 10px; min-height: 40vh; }
            .profile-header { padding: 28px 24px 22px; }
            .profile-body { padding: 22px 24px; }
            .avatar-circle { width: 72px; height: 72px; font-size: 28px; }
            .header-info h2 { font-size: 18px; }
            .info-item { padding: 12px 14px; }
            .info-icon { width: 38px; height: 38px; font-size: 15px; }
            .info-value { font-size: 14px; }
            .blood-value { font-size: 17px; }
            .profile-actions { padding: 0 24px 24px; }
            .btn-edit { padding: 12px 20px; font-size: 14px; }
            .status-bar-label { font-size: 12px; }
            .profile-footer { padding: 36px 0 0; margin-top: 28px; }
            .profile-footer .footer-links { gap: 16px; }
        }

        @media (max-width: 480px) {
            body { padding-top: 56px; }
            .profile-section .container { padding: 0 14px; }
            .profile-card { border-radius: 18px; }
            .profile-header { padding: 22px 18px 18px; }
            .profile-body { padding: 18px 18px; }
            .avatar-circle { width: 64px; height: 64px; font-size: 24px; }
            .header-info h2 { font-size: 16px; }
            .blood-label { font-size: 11px; padding: 4px 12px; }
            .info-grid { gap: 10px; }
            .info-item { padding: 10px 12px; gap: 12px; }
            .info-icon { width: 34px; height: 34px; font-size: 13px; border-radius: 10px; }
            .info-value { font-size: 13px; }
            .blood-value { font-size: 15px; }
            .profile-actions { padding: 0 18px 18px; gap: 8px; }
            .btn-edit { padding: 11px 18px; font-size: 13px; }
            .btn-back { padding: 10px 18px; font-size: 13px; }
            .donation-status { padding: 12px 14px; }
            .status-bar-label { font-size: 11px; }
            .section-label { font-size: 10px; margin-bottom: 14px; }
            .profile-footer { padding: 28px 0 0; margin-top: 20px; }
            .profile-footer .footer-content { gap: 20px; padding-bottom: 24px; }
            .profile-footer .footer-links { grid-template-columns: 1fr 1fr; gap: 12px; }
            .profile-footer .footer-links-col a { font-size: 12px; }
            .profile-footer .brand-name { font-size: 15px; }
            .profile-footer .logo-icon { width: 34px; height: 34px; font-size: 15px; }
            .profile-footer .social-icon { width: 32px; height: 32px; font-size: 13px; }
            .profile-footer .footer-bottom { flex-direction: column; text-align: center; gap: 4px; }
            .profile-footer .footer-bottom p { font-size: 11px; }
        }

        @media (max-width: 360px) {
            body { padding-top: 52px; }
            .avatar-circle { width: 54px; height: 54px; font-size: 20px; }
            .header-info h2 { font-size: 14px; }
            .blood-label { font-size: 10px; padding: 3px 10px; }
            .info-icon { width: 30px; height: 30px; font-size: 11px; }
            .info-value { font-size: 12px; }
            .blood-value { font-size: 13px; }
            .profile-footer .footer-links { grid-template-columns: 1fr; gap: 16px; text-align: center; }
            .profile-footer .social-icons { justify-content: center; }
        }

        /* ===== LIGHT MODE OVERRIDES ===== */
        .light-mode body {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #fef2f2 100%);
        }

        .light-mode .profile-card {
            background: rgba(255, 255, 255, 0.9);
            border-color: rgba(0, 0, 0, 0.08);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
        }

        .light-mode .profile-header {
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.06), rgba(185, 28, 28, 0.03));
            border-bottom-color: rgba(0, 0, 0, 0.06);
        }

        .light-mode .header-info h2 {
            color: #1f2937;
        }

        .light-mode .blood-label {
            background: rgba(220, 38, 38, 0.1);
            border-color: rgba(220, 38, 38, 0.25);
            color: #dc2626;
        }

        .light-mode .section-label {
            color: rgba(0, 0, 0, 0.35);
        }

        .light-mode .info-item {
            background: rgba(0, 0, 0, 0.03);
            border-color: rgba(0, 0, 0, 0.06);
        }

        .light-mode .info-item:hover {
            background: rgba(0, 0, 0, 0.05);
            border-color: rgba(220, 38, 38, 0.15);
        }

        .light-mode .info-label {
            color: rgba(0, 0, 0, 0.4);
        }

        .light-mode .info-value {
            color: #1f2937;
        }

        .light-mode .text-muted {
            color: rgba(0, 0, 0, 0.35);
        }

        .light-mode .donation-status {
            background: rgba(0, 0, 0, 0.02);
            border-color: rgba(0, 0, 0, 0.06);
        }

        .light-mode .status-bar {
            background: rgba(0, 0, 0, 0.06);
        }

        .light-mode .status-bar-label {
            color: rgba(0, 0, 0, 0.5);
        }

        .light-mode .btn-back {
            background: rgba(0, 0, 0, 0.04);
            border-color: rgba(0, 0, 0, 0.1);
            color: rgba(0, 0, 0, 0.5);
        }

        .light-mode .btn-back:hover {
            background: rgba(0, 0, 0, 0.08);
            color: #1f2937;
        }

        .light-mode .profile-footer {
            background: linear-gradient(180deg, #f8f9fa, #e5e7eb);
            border-top-color: rgba(0, 0, 0, 0.06);
        }

        .light-mode .profile-footer .brand-name {
            color: #1f2937;
        }

        .light-mode .profile-footer .brand-tagline {
            color: rgba(0, 0, 0, 0.4);
        }

        .light-mode .profile-footer .footer-links-col h6,
        .light-mode .profile-footer .footer-social h6 {
            color: rgba(0, 0, 0, 0.4);
        }

        .light-mode .profile-footer .footer-links-col a {
            color: rgba(0, 0, 0, 0.55);
        }

        .light-mode .profile-footer .footer-links-col a:hover {
            color: #dc2626;
        }

        .light-mode .profile-footer .social-icon {
            background: rgba(0, 0, 0, 0.06);
            color: rgba(0, 0, 0, 0.5);
        }

        .light-mode .profile-footer .footer-bottom p {
            color: rgba(0, 0, 0, 0.3);
        }

        .light-mode .profile-glow {
            opacity: 0.4;
        }

        .light-mode .profile-particles .particle {
            background: rgba(220, 38, 38, 0.25);
        }
    </style>

@endsection