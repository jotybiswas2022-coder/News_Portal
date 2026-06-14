@extends('frontend.forex.layouts.app')

@section('title', 'SMART BINARY ZONE — Premium Expert Advisors')

@section('content')
<style>
/* ===== SMART BINARY ZONE — HOME STYLES ===== */

/* ── KEYFRAMES ── */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes neonPulse {
    0%, 100% { box-shadow: 0 0 10px #2255ff, 0 0 20px rgba(34,85,255,0.4); }
    50%       { box-shadow: 0 0 20px #ff1177, 0 0 40px rgba(255,17,119,0.6); }
}
@keyframes orbDrift {
    0%, 100% { transform: translate(0, 0) scale(1); }
    50%       { transform: translate(20px, -25px) scale(1.05); }
}
@keyframes orbDriftLeft {
    0%, 100% { transform: translate(0, 0) scale(1); }
    50%       { transform: translate(-20px, -20px) scale(1.08); }
}
@keyframes marquee {
    from { transform: translateX(0); }
    to   { transform: translateX(-50%); }
}
@keyframes barGrow {
    0% { height: 0% !important; }
    100% { height: var(--target-height); }
}
@keyframes pulseDot {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.4; }
}
@keyframes scaleIn {
    from { opacity: 0; transform: scale(0.95) translateY(10px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
}
@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
@keyframes bgBreath {
    0%, 100% { opacity: 0.3; }
    50% { opacity: 0.4; }
}
@keyframes gridPulse {
    0%, 100% { opacity: 0.25; }
    50% { opacity: 0.4; }
}
@keyframes shimmerFast {
    from { background-position: 0% center; }
    to   { background-position: 300% center; }
}
@keyframes floatDown {
    0%, 100% { transform: translateY(0); opacity: 0.4; }
    50% { transform: translateY(8px); opacity: 0.6; }
}

/* ── HERO ── */
.sbz-hero {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding-top: 5rem;
}

/* ── GLOW ORBS ── */
.sbz-orb-left {
    position: absolute;
    width: 600px; height: 600px;
    top: -100px; left: -200px;
    background: radial-gradient(circle, #2255ff 0%, #005fe7 40%, transparent 70%);
    filter: blur(140px);
    opacity: 0.35;
    border-radius: 50%;
    pointer-events: none;
    z-index: 0;
    animation: orbDriftLeft 9s ease-in-out infinite;
}
.sbz-orb-right {
    position: absolute;
    width: 600px; height: 600px;
    top: -100px; right: -200px;
    background: radial-gradient(circle, #ff2d78 0%, #ff1177 50%, transparent 70%);
    filter: blur(140px);
    opacity: 0.35;
    border-radius: 50%;
    pointer-events: none;
    z-index: 0;
    animation: orbDrift 11s ease-in-out infinite reverse;
}
.sbz-orb-bottom {
    position: absolute;
    width: 500px; height: 500px;
    bottom: -150px; left: 50%;
    transform: translateX(-50%);
    background: radial-gradient(circle, #005fe7 0%, #2255ff 40%, transparent 70%);
    filter: blur(120px);
    opacity: 0.2;
    border-radius: 50%;
    pointer-events: none;
    z-index: 0;
    animation: orbDriftLeft 13s ease-in-out infinite;
}

/* ── GRID OVERLAY ── */
.sbz-grid {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(0,95,231,0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,95,231,0.03) 1px, transparent 1px);
    background-size: 64px 64px;
    pointer-events: none;
    z-index: 1;
    animation: gridPulse 6s ease-in-out infinite;
}

/* ── HERO CONTENT ── */
.sbz-hero-content {
    position: relative;
    z-index: 10;
    max-width: 64rem;
    margin: 0 auto;
    padding: 0 1rem;
    text-align: center;
}

/* ── NEON TEXT ── */
/* ── HERO WORD STYLES (no glow) ── */
.text-hero-white {
    color: #ffffff;
    font-weight: 900;
    text-transform: uppercase;
}
.text-hero-blue-gradient {
    background: linear-gradient(180deg, #6b9fff 0%, #005fe7 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 900;
    text-transform: uppercase;
}
.text-hero-pink-gradient {
    background: linear-gradient(180deg, #ff7aad 0%, #ff2d78 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 900;
    text-transform: uppercase;
}
.text-hero-gradient {
    background: linear-gradient(90deg, #005fe7, #ff2d78);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 600;
    letter-spacing: 0.15em;
    text-transform: uppercase;
}

/* ── GLASS CARD ── */
.sbz-glass {
    background: rgba(255, 255, 255, 0.04);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(7, 66, 184, 0.15);
    border-radius: 16px;
    box-shadow:
        0 8px 32px rgba(0, 0, 0, 0.6),
        inset 0 1px 0 rgba(255, 255, 255, 0.06);
    transition: all 0.3s ease;
}
.sbz-glass:hover {
    border-color: rgba(7, 66, 184, 0.4);
    box-shadow:
        0 0 25px rgba(34, 85, 255, 0.15),
        0 0 50px rgba(255, 17, 119, 0.1);
    transform: translateY(-5px);
}

/* ── SBZ BADGE ── */
.sbz-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1.25rem;
    background: rgba(7, 66, 184, 0.06);
    border: 1px solid rgba(7, 66, 184, 0.2);
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #005fe7;
    margin-bottom: 1.5rem;
    backdrop-filter: blur(12px);
}
.sbz-badge-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #005fe7;
    animation: pulseDot 2s ease-in-out infinite;
}

/* ── STATS ── */
.sbz-stat-divider {
    width: 1px;
    height: 3rem;
    background: linear-gradient(180deg, rgba(0,95,231,0.3), transparent);
}

/* ── REVEAL ── */
.reveal {
    opacity: 0;
    transform: translateY(36px);
    transition: all 0.7s ease;
}
.reveal.visible {
    opacity: 1;
    transform: translateY(0);
}

/* ── Marquee ── */
.sbz-marquee-track {
    display: flex;
    width: max-content;
    animation: marquee 30s linear infinite;
}
.sbz-marquee-track:hover {
    animation-play-state: paused;
}

/* ── Perf Bars ── */
.sbz-perf-bar {
    animation: barGrow 1.2s ease forwards;
}

/* ── Scroll Indicator ── */
.sbz-scroll-indicator {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    opacity: 0.4;
    animation: floatDown 3s ease-in-out infinite;
    pointer-events: none;
}

/* ── Particle Canvas ── */
#particleCanvas {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 2;
    opacity: 0.5;
}

/* ── Responsive ── */
@media (max-width: 640px) {
    .sbz-hero-title {
        font-size: clamp(2.5rem, 12vw, 4rem) !important;
    }
    .sbz-orb-left { width: 400px; height: 400px; top: -50px; left: -150px; }
    .sbz-orb-right { width: 400px; height: 400px; top: -50px; right: -150px; }
}

/* ── SECTION HEIGHTS ── */
.sbz-section { padding-top: 6rem; padding-bottom: 6rem; }
@media (min-width: 768px) { .sbz-section { padding-top: 8rem; padding-bottom: 8rem; } }

/* ── OVERRIDE GLOBAL LAYOUT CLASSES WITH HOME COLORS ── */
/* Buttons — blue (#005fe7) → pink (#ff2d78) gradient instead of cyan */
.sbz-hero .btn-primary,
.sbz-section .btn-primary,
.sbz-glass .btn-primary {
    background: linear-gradient(90deg, #005fe7, #ff2d78) !important;
    box-shadow: 0 0 20px rgba(0,95,231,0.4), 0 0 40px rgba(255,45,120,0.3) !important;
}
.sbz-hero .btn-primary:hover,
.sbz-section .btn-primary:hover,
.sbz-glass .btn-primary:hover {
    box-shadow: 0 0 30px rgba(0,95,231,0.7), 0 0 60px rgba(255,45,120,0.5) !important;
}
.sbz-hero .btn-outline,
.sbz-section .btn-outline,
.sbz-glass .btn-outline {
    border-color: #005fe7 !important;
    color: #005fe7 !important;
    box-shadow: 0 0 12px rgba(0,95,231,0.25) !important;
}
.sbz-hero .btn-outline:hover,
.sbz-section .btn-outline:hover,
.sbz-glass .btn-outline:hover {
    background: rgba(0,95,231,0.1) !important;
    box-shadow: 0 0 25px rgba(0,95,231,0.5) !important;
}

/* Gradient text on section titles — blue → pink */
.sbz-section .gradient-text {
    background: linear-gradient(90deg, #005fe7, #ff2d78) !important;
    -webkit-background-clip: text !important;
    -webkit-text-fill-color: transparent !important;
    background-clip: text !important;
}

/* Badges */
.sbz-badge {
    color: #005fe7 !important;
    border-color: rgba(0,95,231,0.2) !important;
    background: rgba(0,95,231,0.06) !important;
}
.sbz-badge-dot {
    background: #005fe7 !important;
}

/* Glass cards on home page */
.sbz-hero .card,
.sbz-section .card {
    border-color: rgba(0,95,231,0.15) !important;
}
.sbz-hero .card:hover,
.sbz-section .card:hover {
    border-color: rgba(0,95,231,0.4) !important;
    box-shadow: 0 0 25px rgba(34,85,255,0.15), 0 0 50px rgba(255,17,119,0.1) !important;
}
</style>

<!-- ==================== HERO ==================== -->
<div class="sbz-hero">
    <!-- Glow Orbs -->
    <div class="sbz-orb-left"></div>
    <div class="sbz-orb-right"></div>
    <div class="sbz-orb-bottom"></div>

    <!-- Grid Background -->
    <div class="sbz-grid"></div>

    <!-- Noise Overlay -->
    <div style="position:absolute;inset:0;opacity:0.015;pointer-events:none;z-index:3;background-image:url(&quot;data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E&quot;);"></div>

    <!-- Particle Canvas -->
    <canvas id="particleCanvas"></canvas>

    <div class="sbz-hero-content">
        <!-- Badge -->
        <div class="sbz-badge" style="animation:fadeUp 0.7s ease 0.1s both">
            <span class="sbz-badge-dot"></span>
            Trusted by 1M+ Traders Worldwide
        </div>

        <!-- Hero Heading — NEON TEXT -->
        <h1 style="
            font-size: clamp(3rem, 7vw, 6rem);
            font-weight: 900;
            line-height: 1.05;
            color: #ffffff;
            margin: 0 0 0.75rem 0;
            text-transform: uppercase;
            animation: fadeUp 0.7s ease 0.1s both;
        ">
            <span class="text-hero-white">SMART</span><br>
            <span class="text-hero-blue-gradient">BINARY</span><br>
            <span class="text-hero-pink-gradient">ZONE</span>
        </h1>

        <!-- Gradient Subheading -->
        <p class="text-hero-gradient" style="
            font-size: clamp(0.875rem, 1.5vw, 1.125rem);
            margin: 0.5rem 0 1.5rem 0;
            animation: fadeUp 0.7s ease 0.3s both;
        ">
            Smarter Trades, Better Life
        </p>

        <!-- Description -->
        <p style="
            font-size: 1.05rem;
            line-height: 1.75;
            color: var(--text-gray);
            max-width: 48rem;
            margin: 0 auto 2rem;
            animation: fadeUp 0.7s ease 0.3s both;
        ">
            Institutional-grade Expert Advisors powered by AI-driven algorithms —
            delivering consistent returns with <span style="color:#005fe7;font-weight:600">99.9% backtest precision</span>.
        </p>

        <!-- CTA Buttons -->
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:1rem;animation:fadeUp 0.7s ease 0.5s both">
            <a href="{{ route('forex.products') }}" class="btn-primary" style="display:inline-flex;align-items:center;gap:0.5rem;text-decoration:none">
                <span style="position:relative;z-index:10">Explore EAs</span>
                <svg style="width:1.25rem;height:1.25rem;transition:transform 0.3s" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="#features" class="btn-outline" style="display:inline-flex;align-items:center;gap:0.5rem;text-decoration:none">
                <span style="position:relative;z-index:10">View Features</span>
            </a>
        </div>

        <!-- Stats -->
        <div style="display:flex;flex-wrap:wrap;justify-content:center;align-items:center;gap:1.5rem;margin-top:3rem;animation:fadeUp 0.7s ease 0.5s both">
            <div style="cursor:default;text-align:center">
                <div style="font-size:clamp(1.5rem,2.5vw,1.875rem);font-weight:700;color:var(--text-white);font-family:'JetBrains Mono',monospace">
                    <span class="count-up" data-target="1" data-suffix="M+">0</span><span>M+</span>
                </div>
                <div style="color:var(--text-dim);font-size:0.75rem;margin-top:0.25rem">Active Traders</div>
            </div>
            <div class="sbz-stat-divider"></div>
            <div style="cursor:default;text-align:center">
                <div style="font-size:clamp(1.5rem,2.5vw,1.875rem);font-weight:700;color:var(--text-white);font-family:'JetBrains Mono',monospace">
                    <span class="count-up" data-target="99.9" data-suffix="%">0</span><span>%</span>
                </div>
                <div style="color:var(--text-dim);font-size:0.75rem;margin-top:0.25rem">Avg. Accuracy</div>
            </div>
            <div class="sbz-stat-divider"></div>
            <div style="cursor:default;text-align:center">
                <div style="font-size:clamp(1.5rem,2.5vw,1.875rem);font-weight:700;color:var(--text-white);font-family:'JetBrains Mono',monospace">
                    <span class="count-up" data-target="4.9" data-suffix="★">0</span><span>★</span>
                </div>
                <div style="color:var(--text-dim);font-size:0.75rem;margin-top:0.25rem">Avg. Rating</div>
            </div>
        </div>
    </div>

    <!-- Scroll indicator -->
    <div class="sbz-scroll-indicator">
        <svg style="width:1rem;height:1rem;color:var(--text-gray)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
    </div>
</div>

<!-- ==================== TRUSTED BY ==================== -->
<section style="padding:2.5rem 0;border-top:1px solid rgba(0,95,231,0.08);border-bottom:1px solid rgba(0,95,231,0.08);position:relative;overflow:hidden">
    <div style="max-width:80rem;margin:0 auto;padding:0 1rem;position:relative;z-index:10">
        <p style="text-align:center;color:var(--text-dim);font-size:0.75rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:1.5rem;font-family:'Rajdhani',sans-serif">Trusted by Traders Worldwide</p>
        <div style="position:relative;overflow:hidden">
            <div class="sbz-marquee-track" style="display:flex;gap:4rem;opacity:0.3;transition:opacity 0.5s;width:max-content" onmouseover="this.style.opacity='0.5'" onmouseout="this.style.opacity='0.3'">
                @foreach(['IC Markets', 'Pepperstone', 'FXTM', 'XM', 'Exness', 'FP Markets', 'IC Markets', 'Pepperstone', 'FXTM', 'XM', 'Exness', 'FP Markets'] as $broker)
                <span style="color:var(--text-white);font-size:0.875rem;font-weight:600;letter-spacing:0.05em;white-space:nowrap;font-family:'Rajdhani',sans-serif">{{ $broker }}</span>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- ==================== TRUST METRICS ==================== -->
@php
    $tmColors = ['#005fe7', '#ff2d78', '#2255ff'];
    $tmIcons = [
        '<svg style="width:1.5rem;height:1.5rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>',
        '<svg style="width:1.5rem;height:1.5rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
        '<svg style="width:1.5rem;height:1.5rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
    ];
@endphp
<section class="sbz-section" style="position:relative;overflow:hidden">
    <div style="max-width:80rem;margin:0 auto;padding:0 1rem;position:relative;z-index:10">
        <div style="text-align:center;margin-bottom:3.5rem">
            <div class="sbz-badge">Why SBZ</div>
            <h2 class="section-title" style="font-family:'Rajdhani',sans-serif">Built for <span class="gradient-text">Peak Performance</span></h2>
            <p class="section-subtitle">Discover what makes our Expert Advisors the preferred choice for serious traders worldwide</p>
        </div>
        <div style="display:grid;gap:1rem;grid-template-columns:1fr">
            <style>
                @media (min-width:768px){.tm-grid-sbz{grid-template-columns:repeat(3,1fr)!important}}
            </style>
            <div class="tm-grid-sbz" style="display:grid;gap:1rem;grid-template-columns:1fr">
            @foreach($trustMetrics as $i => $tm)
            @php $color = $tmColors[$i % count($tmColors)]; @endphp
            <div class="reveal" style="transition-delay:{{ $i * 0.1 }}s">
                <div class="sbz-glass" style="padding:1.75rem 1.5rem;position:relative;overflow:hidden;cursor:default;height:100%;display:flex;flex-direction:column">
                    <!-- Blue top accent -->
                    <div style="position:absolute;top:0;left:1.5rem;right:1.5rem;height:2px;background:linear-gradient(90deg,{{ $color }},transparent);border-radius:0 0 2px 2px;opacity:0.8"></div>

                    <!-- Icon row -->
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem">
                        <div style="width:3rem;height:3rem;border-radius:14px;background:{{ $color }}15;border:1px solid {{ $color }}25;display:flex;align-items:center;justify-content:center;color:{{ $color }};transition:all 0.4s;flex-shrink:0">
                            {!! $tmIcons[$i % count($tmIcons)] !!}
                        </div>
                        <span style="font-family:'JetBrains Mono',monospace;font-size:0.7rem;color:{{ $color }};font-weight:600;padding:0.2rem 0.65rem;border-radius:9999px;background:{{ $color }}0c;border:1px solid {{ $color }}14;white-space:nowrap">0{{ $i + 1 }}</span>
                    </div>

                    <h3 style="color:var(--text-white);font-weight:700;font-size:1.05rem;margin:0 0 0.4rem 0;line-height:1.35">{{ $tm['title'] }}</h3>
                    <p style="color:{{ $color }};font-weight:500;font-size:0.85rem;margin:0 0 0.5rem 0;line-height:1.5">{{ $tm['text'] }}</p>
                    <p style="color:var(--text-dim);font-size:0.75rem;margin:0;line-height:1.5;flex:1">{{ $tm['sub'] }}</p>

                    <div style="margin-top:1rem;padding-top:0.75rem;border-top:1px solid rgba(0,95,231,0.08);display:flex;align-items:center;justify-content:space-between">
                        <span style="color:var(--text-dim);font-size:0.65rem;font-weight:500;letter-spacing:0.05em;text-transform:uppercase">Trust Metric</span>
                        <span style="display:flex;gap:0.25rem">
                            @for($d = 0; $d < 3; $d++)
                            <span style="width:0.375rem;height:0.375rem;border-radius:50%;background:{{ $d <= $i ? $color : 'rgba(0,95,231,0.08)' }};transition:background 0.3s"></span>
                            @endfor
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
            </div>
        </div>
    </div>
</section>

<!-- ==================== FEATURES ==================== -->
<section id="features" class="sbz-section" style="position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background-image:radial-gradient(rgba(0,95,231,0.03) 1px,transparent 1px);background-size:24px 24px;opacity:0.04;pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding:0 1rem">
        <div style="text-align:center;margin-bottom:3.5rem">
            <div class="sbz-badge">Features</div>
            <h2 class="section-title" style="font-family:'Rajdhani',sans-serif">Everything You <span class="gradient-text">Need to Succeed</span></h2>
            <p class="section-subtitle">Cutting-edge technology meets intuitive design for the ultimate trading experience</p>
        </div>
        <div style="display:grid;gap:1rem;grid-template-columns:1fr">
            <style>
                @media (min-width:640px){.feat-grid-sbz{grid-template-columns:repeat(2,1fr)!important}}
                @media (min-width:1024px){.feat-grid-sbz{grid-template-columns:repeat(3,1fr)!important}}
            </style>
            <div class="feat-grid-sbz" style="display:grid;gap:1rem;grid-template-columns:1fr">
            @php $gradColors = ['#005fe7','#ff2d78','#2255ff','#005fe7','#ff2d78','#2255ff']; @endphp
            @foreach($features as $i => $feat)
            @php $accent = $gradColors[$i % count($gradColors)]; @endphp
            <div class="reveal" style="transition-delay:{{ $i * 0.06 }}s">
                <div class="sbz-glass" style="padding:1.75rem;position:relative;overflow:hidden;height:100%;display:flex;flex-direction:column">
                    <!-- Blue top accent -->
                    <div style="position:absolute;top:0;left:1.5rem;right:1.5rem;height:2px;background:linear-gradient(90deg,{{ $accent }},transparent);border-radius:0 0 2px 2px;opacity:0.8"></div>

                    <!-- Icon -->
                    <div style="width:3rem;height:3rem;border-radius:14px;background:{{ $accent }}15;border:1px solid {{ $accent }}25;display:flex;align-items:center;justify-content:center;color:{{ $accent }};transition:all 0.4s;margin-bottom:1rem;flex-shrink:0">
                        @if($feat['icon'] === 'sliders')
                        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                        @elseif($feat['icon'] === 'trending-up')
                        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        @elseif($feat['icon'] === 'cpu')
                        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                        @elseif($feat['icon'] === 'eye')
                        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        @elseif($feat['icon'] === 'headphones')
                        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        @else
                        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/></svg>
                        @endif
                    </div>

                    <h3 style="color:var(--text-white);font-weight:600;font-size:1rem;margin-bottom:0.375rem">{{ $feat['title'] }}</h3>
                    <p style="color:var(--text-gray);font-size:0.875rem;line-height:1.625;flex:1">{{ $feat['desc'] }}</p>
                </div>
            </div>
            @endforeach
            </div>
        </div>
    </div>
</section>

<!-- ==================== PERFORMANCE ==================== -->
<section class="sbz-section" style="position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background:linear-gradient(180deg,transparent,rgba(0,95,231,0.02),transparent);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:64rem;margin:0 auto;padding:0 1rem;text-align:center">
        <div class="sbz-badge">Live Performance</div>
        <h2 class="section-title" style="font-family:'Rajdhani',sans-serif">Verified <span class="gradient-text">Track Records</span></h2>
        <p class="section-subtitle" style="margin-bottom:2.5rem">99.9% backtest precision — real accounts, real results, full transparency</p>

        <div style="display:grid;gap:1rem;grid-template-columns:1fr;margin-bottom:2.5rem">
            <style>
                @media (min-width:768px){.perf-grid-sbz{grid-template-columns:repeat(3,1fr)!important}}
            </style>
            <div class="perf-grid-sbz" style="display:grid;gap:1rem;grid-template-columns:1fr">
            <div class="reveal">
                <div class="sbz-glass" style="padding:1.5rem;position:relative;overflow:hidden;height:100%">
                    <div style="position:absolute;top:0;left:1.5rem;right:1.5rem;height:2px;background:linear-gradient(90deg,#005fe7,transparent);border-radius:0 0 2px 2px;opacity:0.8"></div>
                    <div style="position:relative;z-index:2">
                        <div style="font-size:1.5rem;font-weight:700;color:#005fe7;margin-bottom:0.25rem;font-family:'JetBrains Mono',monospace">
                            <span class="counter-number" data-target="284" data-prefix="+" data-suffix="%">0</span>
                        </div>
                        <p style="color:var(--text-gray);font-size:0.875rem">Avg. Annual Return</p>
                        <div style="margin-top:0.75rem;height:0.375rem;background:rgba(0,95,231,0.06);border-radius:9999px;overflow:hidden">
                            <div class="sbz-perf-bar" style="height:0%;background:linear-gradient(90deg,#005fe7,#ff2d78);border-radius:9999px;--target-height:85%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="reveal" style="transition-delay:0.1s">
                <div class="sbz-glass" style="padding:1.5rem;position:relative;overflow:hidden;height:100%">
                    <div style="position:absolute;top:0;left:1.5rem;right:1.5rem;height:2px;background:linear-gradient(90deg,#ff2d78,transparent);border-radius:0 0 2px 2px;opacity:0.8"></div>
                    <div style="position:relative;z-index:2">
                        <div style="font-size:1.5rem;font-weight:700;color:#ff2d78;margin-bottom:0.25rem;font-family:'JetBrains Mono',monospace">
                            <span class="counter-number" data-target="12.4" data-suffix="%">0</span>
                        </div>
                        <p style="color:var(--text-gray);font-size:0.875rem">Max Drawdown</p>
                        <div style="margin-top:0.75rem;height:0.375rem;background:rgba(255,45,120,0.06);border-radius:9999px;overflow:hidden">
                            <div class="sbz-perf-bar" style="height:0%;background:linear-gradient(90deg,#ff2d78,#2255ff);border-radius:9999px;--target-height:35%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="reveal" style="transition-delay:0.2s">
                <div class="sbz-glass" style="padding:1.5rem;position:relative;overflow:hidden;height:100%">
                    <div style="position:absolute;top:0;left:1.5rem;right:1.5rem;height:2px;background:linear-gradient(90deg,#2255ff,transparent);border-radius:0 0 2px 2px;opacity:0.8"></div>
                    <div style="position:relative;z-index:2">
                        <div style="font-size:1.5rem;font-weight:700;color:#2255ff;margin-bottom:0.25rem;font-family:'JetBrains Mono',monospace">
                            <span class="counter-number" data-target="3.2">0</span>
                        </div>
                        <p style="color:var(--text-gray);font-size:0.875rem">Profit Factor</p>
                        <div style="margin-top:0.75rem;height:0.375rem;background:rgba(34,85,255,0.06);border-radius:9999px;overflow:hidden">
                            <div class="sbz-perf-bar" style="height:0%;background:linear-gradient(90deg,#2255ff,#005fe7);border-radius:9999px;--target-height:65%"></div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="reveal">
            <div class="sbz-glass" style="padding:1.5rem;position:relative;overflow:hidden">
                <div style="position:absolute;top:0;left:1.5rem;right:1.5rem;height:2px;background:linear-gradient(90deg,#005fe7,#ff2d78);border-radius:0 0 2px 2px;opacity:0.8"></div>
                <div style="position:relative;z-index:2">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem">
                        <span style="color:var(--text-gray);font-size:0.875rem;font-weight:500">Account Growth (Last 12 Months)</span>
                        <span style="color:#005fe7;font-size:0.875rem;font-weight:600;display:flex;align-items:center;gap:0.25rem">
                            <svg style="width:0.875rem;height:0.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                            +184.2%
                        </span>
                    </div>
                    <div style="display:flex;align-items:flex-end;gap:0.375rem;height:7rem">
                        <style>@media (min-width:640px){.chart-h-sbz{height:8rem}}</style>
                        @php $heights = [20, 35, 28, 45, 38, 55, 48, 62, 58, 72, 68, 85]; @endphp
                        @foreach($heights as $h => $height)
                        <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:0.25rem">
                            <div style="width:100%;background:rgba(0,95,231,0.04);border-radius:0.125rem;overflow:hidden;height:100%">
                                <div class="sbz-perf-bar" style="width:100%;background:{{ $h % 2 == 0 ? '#005fe7' : '#ff2d78' }};border-radius:0.125rem;--target-height:{{ $height }}%;height:0%;animation-delay:{{ 0.08 * $h }}s"></div>
                            </div>
                            <span style="font-size:0.625rem;color:var(--text-dim);font-family:'JetBrains Mono',monospace">M{{ $h + 1 }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== REVIEWS ==================== -->
<section class="sbz-section" style="position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background:linear-gradient(180deg,transparent,rgba(255,45,120,0.02),transparent);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:56rem;margin:0 auto;padding:0 1rem">
        <div style="text-align:center;margin-bottom:3.5rem">
            <div class="sbz-badge">Testimonials</div>
            <h2 class="section-title" style="font-family:'Rajdhani',sans-serif">What Our <span class="gradient-text">Clients Say</span></h2>
            <p class="section-subtitle">Join thousands of satisfied traders who trust SMART BINARY ZONE</p>
        </div>
        <div class="reveal" style="position:relative">
            <div id="reviewTrack" class="review-track" style="touch-action:pan-y">
                @foreach($reviews as $review)
                <div class="review-card">
                    <div class="sbz-glass" style="padding:1.5rem;position:relative;overflow:hidden;height:100%">
                        <div style="position:absolute;top:0;left:1.5rem;right:1.5rem;height:2px;background:linear-gradient(90deg,#005fe7,#ff2d78);border-radius:0 0 2px 2px;opacity:0.6"></div>
                        <div style="position:relative;z-index:2">
                            <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:0.75rem">
                                <div style="width:2.5rem;height:2.5rem;border-radius:50%;background:linear-gradient(90deg,#005fe7,#ff2d78);display:flex;align-items:center;justify-content:center;color:#05050f;font-weight:700;font-size:0.875rem;flex-shrink:0">{{ substr($review['reviewer'], 0, 1) }}</div>
                                <div style="flex:1;min-width:0">
                                    <div style="color:var(--text-white);font-weight:500;font-size:0.875rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $review['reviewer'] }}</div>
                                    <div style="display:flex;align-items:center;gap:0.375rem">
                                        <div style="display:flex">
                                            @for($r = 0; $r < $review['rating']; $r++)
                                            <svg class="star" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            @endfor
                                        </div>
                                        @if($review['verified'])
                                        <svg style="width:0.75rem;height:0.75rem;color:#005fe7" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <p style="color:var(--text-gray);font-size:0.875rem;line-height:1.625;margin-bottom:0.75rem">"{{ $review['text'] }}"</p>
                            <a href="{{ $review['sourceUrl'] }}" style="color:var(--text-dim);font-size:0.75rem;transition:color 0.3s;display:inline-flex;align-items:center;gap:0.25rem;text-decoration:none" onmouseover="this.style.color='var(--text-white)';this.style.textDecoration='underline'" onmouseout="this.style.color='var(--text-dim)';this.style.textDecoration='none'">from {{ $review['source'] }}<svg style="width:0.75rem;height:0.75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div style="display:flex;align-items:center;justify-content:center;gap:1rem;margin-top:1.5rem">
                <button type="button" id="reviewPrev" class="carousel-btn" aria-label="Previous review">
                    <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <div id="reviewDots" style="display:flex;gap:0.5rem">
                    @foreach($reviews as $i => $review)
                    <button type="button" style="width:0.5rem;height:0.5rem;border-radius:50%;transition:all 0.3s;cursor:pointer;border:none;background:{{ $i === 0 ? '#005fe7' : 'rgba(0,95,231,0.2)' }};width:{{ $i === 0 ? '1.25rem' : '0.5rem' }}" data-index="{{ $i }}" aria-label="Go to review {{ $i + 1 }}" onmouseover="this.style.background='{{ $i === 0 ? '#005fe7' : 'rgba(0,95,231,0.4)' }}'" onmouseout="this.style.background='{{ $i === 0 ? '#005fe7' : 'rgba(0,95,231,0.2)' }}'"></button>
                    @endforeach
                </div>
                <button type="button" id="reviewNext" class="carousel-btn" aria-label="Next review">
                    <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- ==================== FAQ ==================== -->
<section class="sbz-section" style="position:relative;overflow:hidden">
    <div style="max-width:80rem;margin:0 auto;padding:0 1rem">
        <div style="text-align:center;margin-bottom:3.5rem">
            <div class="sbz-badge">FAQ</div>
            <h2 class="section-title" style="font-family:'Rajdhani',sans-serif">Frequently Asked <span class="gradient-text">Questions</span></h2>
            <p class="section-subtitle">Everything you need to know about our Expert Advisors</p>
        </div>
        <div style="display:grid;grid-template-columns:1fr;gap:1.25rem" class="faq-card-grid-sbz">
            <style>
                @media (min-width:640px){.faq-card-grid-sbz{grid-template-columns:repeat(2,1fr)!important}}
                @media (min-width:1024px){.faq-card-grid-sbz{grid-template-columns:repeat(3,1fr)!important}}
            </style>
            @php
            $faqColors = ['#005fe7','#ff2d78','#2255ff','#005fe7','#ff2d78','#2255ff','#005fe7','#ff2d78','#2255ff','#005fe7','#ff2d78','#2255ff'];
            $faqIcons = [
                '<svg style="width:1.125rem;height:1.125rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                '<svg style="width:1.125rem;height:1.125rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>',
                '<svg style="width:1.125rem;height:1.125rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
                '<svg style="width:1.125rem;height:1.125rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                '<svg style="width:1.125rem;height:1.125rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>',
                '<svg style="width:1.125rem;height:1.125rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>',
            ];
            @endphp
            @foreach($faq as $i => $item)
            @php
                $accent = $faqColors[$i % count($faqColors)];
                $icon = $faqIcons[$i % count($faqIcons)];
                $answerPreview = Str::limit($item['a'], 100);
            @endphp
            <div class="faq-card reveal sbz-glass" style="padding:1.5rem;transition:all 0.4s cubic-bezier(0.4,0,0.2,1);position:relative;overflow:hidden;cursor:default">
                <div style="position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,{{ $accent }},transparent);border-radius:16px 16px 0 0"></div>
                <div style="width:2.25rem;height:2.25rem;border-radius:10px;background:{{ $accent }}15;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-bottom:0.875rem;border:1px solid {{ $accent }}25">
                    {!! $icon !!}
                </div>
                <h3 style="color:var(--text-white);font-weight:600;font-size:0.95rem;margin-bottom:0.625rem;line-height:1.4">{{ $item['q'] }}</h3>
                <p style="color:var(--text-gray);font-size:0.825rem;line-height:1.6;margin-bottom:0">{{ $answerPreview }}</p>
                <div style="margin-top:0.875rem;padding-top:0.75rem;border-top:1px solid rgba(0,95,231,0.08)">
                    <button onclick="toggleFaqAnswer(this)" style="color:{{ $accent }};font-size:0.8rem;cursor:pointer;display:inline-flex;align-items:center;gap:0.375rem;background:none;border:none;padding:0;font-weight:500;transition:all 0.3s;font-family:'Inter',sans-serif" onmouseover="this.style.gap='0.625rem'" onmouseout="this.style.gap='0.375rem'">
                        <span>Read Answer</span>
                        <svg style="width:0.75rem;height:0.75rem;transition:transform 0.3s" class="faq-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
                <div class="faq-answer-full" style="display:none;margin-top:0.75rem;padding-top:0.75rem;border-top:1px solid rgba(0,95,231,0.08);color:var(--text-gray);font-size:0.85rem;line-height:1.7">
                    {{ $item['a'] }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ==================== CTA ==================== -->
<section class="sbz-section" style="padding-top:0">
    <div style="max-width:56rem;margin:0 auto;padding:0 1rem;text-align:center">
        <div class="sbz-glass" style="padding:3.5rem 2rem;position:relative;overflow:hidden">
            <div style="position:absolute;inset:-8rem;background:radial-gradient(circle at center,rgba(0,95,231,0.06),rgba(255,45,120,0.03),transparent 70%);filter:blur(100px);pointer-events:none"></div>
            <div style="position:relative;z-index:10">
                <h2 style="font-size:clamp(2rem,4vw,2.5rem);font-weight:800;color:var(--text-white);letter-spacing:-0.02em;margin-bottom:1rem;font-family:'Rajdhani',sans-serif">Ready to Dominate the Markets?</h2>
                <p style="color:var(--text-gray);font-size:1.125rem;margin-bottom:2rem;max-width:36rem;margin-left:auto;margin-right:auto">
                    Join over <span style="color:#005fe7;font-weight:600">1 million</span> traders who've elevated their trading with SMART BINARY ZONE. Start your journey today.
                </p>
                <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:1rem">
                    <a href="{{ route('forex.products') }}" class="btn-primary" style="display:inline-flex;align-items:center;gap:0.5rem;text-decoration:none">
                        <span style="position:relative;z-index:10">Get Started Now</span>
                        <svg style="width:1.25rem;height:1.25rem;transition:transform 0.3s" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="{{ route('forex.contact-us') }}" class="btn-outline" style="display:inline-flex;align-items:center;gap:0.5rem;text-decoration:none">Talk to Us</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== QUICK CHECKOUT MODAL ==================== -->
<div id="quickCheckoutOverlay" style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(5,5,15,0.85);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);align-items:center;justify-content:center;padding:1rem;overflow-y:auto" onclick="if(event.target===this)closeQuickCheckout()">
    <div style="width:100%;max-width:28rem;background:rgba(5,5,15,0.95);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);border:1px solid rgba(0,95,231,0.15);border-radius:16px;overflow:hidden;box-shadow:0 32px 80px rgba(0,0,0,0.6);animation:scaleIn 0.25s ease" onclick="event.stopPropagation()">
        <!-- Header -->
        <div style="display:flex;align-items:center;justify-content:space-between;padding:1.25rem 1.5rem;border-bottom:1px solid rgba(0,95,231,0.08)">
            <div style="display:flex;align-items:center;gap:0.625rem">
                <svg style="width:1.25rem;height:1.25rem;color:#005fe7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <h3 style="color:var(--text-white);font-weight:600;font-size:1.125rem;margin:0;font-family:'Inter',sans-serif">Quick Checkout</h3>
            </div>
            <button onclick="closeQuickCheckout()" style="width:2rem;height:2rem;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,0.04);border:1px solid rgba(0,95,231,0.15);border-radius:0.5rem;color:var(--text-dim);cursor:pointer;transition:all 0.2s;font-size:1rem" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='var(--text-white)'" onmouseout="this.style.background='rgba(255,255,255,0.04)';this.style.color='var(--text-dim)'">&times;</button>
        </div>

        <!-- Body -->
        <div style="padding:1.5rem">
            <div id="quickBundleInfo" style="margin-bottom:1.25rem;padding:1rem;background:rgba(0,95,231,0.04);border:1px solid rgba(0,95,231,0.1);border-radius:12px">
                <p id="quickBundleName" style="color:var(--text-white);font-weight:600;font-size:1rem;margin:0 0 0.25rem 0"></p>
                <p id="quickBundleDesc" style="color:var(--text-gray);font-size:0.8125rem;margin:0 0 0.5rem 0"></p>
                <div style="display:flex;align-items:center;gap:0.5rem">
                    <span style="color:#005fe7;font-weight:700;font-size:1.25rem;font-family:'JetBrains Mono',monospace" id="quickBundlePrice"></span>
                    <span style="color:var(--text-dim);font-size:0.75rem">One-Time Payment</span>
                </div>
            </div>
            <div style="display:flex;flex-direction:column;gap:0.75rem">
                <div>
                    <label for="quickName" style="display:block;color:var(--text-dim);font-size:0.75rem;font-weight:500;margin-bottom:0.375rem">Full Name <span style="color:#005fe7">*</span></label>
                    <input type="text" id="quickName" placeholder="Your full name" autocomplete="name"
                        style="width:100%;background:rgba(5,5,15,0.8);border:1px solid rgba(0,95,231,0.15);border-radius:10px;padding:0.75rem 0.875rem;font-size:0.875rem;color:var(--text-white);transition:all 0.3s;box-sizing:border-box;outline:none;font-family:'Inter',sans-serif"
                        onfocus="this.style.borderColor='rgba(0,95,231,0.5)';this.style.boxShadow='0 0 0 3px rgba(0,95,231,0.12)'"
                        onblur="this.style.borderColor='rgba(0,95,231,0.15)';this.style.boxShadow='none'">
                </div>
                <div>
                    <label for="quickEmail" style="display:block;color:var(--text-dim);font-size:0.75rem;font-weight:500;margin-bottom:0.375rem">Email Address <span style="color:#005fe7">*</span></label>
                    <input type="email" id="quickEmail" placeholder="your@email.com" autocomplete="email"
                        style="width:100%;background:rgba(5,5,15,0.8);border:1px solid rgba(0,95,231,0.15);border-radius:10px;padding:0.75rem 0.875rem;font-size:0.875rem;color:var(--text-white);transition:all 0.3s;box-sizing:border-box;outline:none;font-family:'Inter',sans-serif"
                        onfocus="this.style.borderColor='rgba(0,95,231,0.5)';this.style.boxShadow='0 0 0 3px rgba(0,95,231,0.12)'"
                        onblur="this.style.borderColor='rgba(0,95,231,0.15)';this.style.boxShadow='none'">
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div style="padding:1rem 1.5rem;border-top:1px solid rgba(0,95,231,0.08);display:flex;justify-content:flex-end;gap:0.75rem">
            <button onclick="closeQuickCheckout()" style="padding:0.75rem 1.5rem;font-size:0.875rem;font-weight:500;background:rgba(255,255,255,0.04);border:1px solid rgba(0,95,231,0.15);border-radius:10px;color:var(--text-gray);cursor:pointer;transition:all 0.2s;font-family:'Inter',sans-serif"
                onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='var(--text-white)'"
                onmouseout="this.style.background='rgba(255,255,255,0.04)';this.style.color='var(--text-gray)'">Cancel</button>
            <button onclick="submitQuickOrder()" id="quickOrderBtn" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.75rem 1.75rem;font-size:0.875rem;font-weight:600;background:linear-gradient(90deg,#005fe7,#ff2d78);border:none;border-radius:9999px;color:#fff;cursor:pointer;transition:all 0.3s;font-family:'Inter',sans-serif"
                onmouseover="this.style.boxShadow='0 8px 25px rgba(0,95,231,0.3)';this.style.transform='translateY(-1px)'"
                onmouseout="this.style.boxShadow='none';this.style.transform=''">
                <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Place Order
            </button>
        </div>
    </div>
</div>

<!-- ==================== JAVASCRIPT ==================== -->
<script>
// ==================== PARTICLE SYSTEM ====================
(function initParticles() {
    var canvas = document.getElementById('particleCanvas');
    if (!canvas) return;
    var ctx = canvas.getContext('2d');
    var particles = [];
    var w, h, animId = null, running = true;
    var mouse = { x: -1000, y: -1000 };

    function resize() {
        w = canvas.offsetWidth;
        h = canvas.offsetHeight;
        canvas.width = w * 2;
        canvas.height = h * 2;
        canvas.style.width = w + 'px';
        canvas.style.height = h + 'px';
        ctx.scale(2, 2);
        var newCount = Math.min(80, Math.floor((w * h) / 15000));
        while (particles.length < newCount) particles.push(createParticle());
        if (particles.length > newCount) particles.length = newCount;
    }

    function createParticle() {
        var colors = ['rgba(0,95,231,', 'rgba(255,45,120,', 'rgba(34,85,255,', 'rgba(0,95,231,', 'rgba(255,45,120,', 'rgba(0,95,231,'];
        return {
            x: Math.random() * (w || 1000),
            y: Math.random() * (h || 1000),
            size: Math.random() * 2 + 0.5,
            speedX: (Math.random() - 0.5) * 0.3,
            speedY: (Math.random() - 0.5) * 0.15 - 0.1,
            color: colors[Math.floor(Math.random() * colors.length)],
            alpha: Math.random() * 0.4 + 0.1,
            pulseSpeed: Math.random() * 0.02 + 0.005,
            pulsePhase: Math.random() * Math.PI * 2,
            life: Math.random() * 200 + 100
        };
    }

    resize();

    function drawParticles() {
        ctx.clearRect(0, 0, w, h);
        for (var i = 0; i < particles.length; i++) {
            for (var j = i + 1; j < particles.length; j++) {
                var dx = particles[i].x - particles[j].x;
                var dy = particles[i].y - particles[j].y;
                var dist = dx * dx + dy * dy;
                if (dist < 14400) {
                    var alpha = (1 - Math.sqrt(dist) / 120) * 0.08;
                    ctx.beginPath();
                    ctx.strokeStyle = 'rgba(0,95,231,' + alpha + ')';
                    ctx.lineWidth = 0.5;
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.stroke();
                }
            }
        }
        var now = Date.now();
        for (var i = 0; i < particles.length; i++) {
            var p = particles[i];
            var pulseAlpha = p.alpha * (0.5 + 0.5 * Math.sin(now * p.pulseSpeed + p.pulsePhase));
            var gradient = ctx.createRadialGradient(p.x, p.y, 0, p.x, p.y, p.size * 4);
            gradient.addColorStop(0, p.color + pulseAlpha + ')');
            gradient.addColorStop(1, p.color + '0)');
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.size * 4, 0, Math.PI * 2);
            ctx.fillStyle = gradient;
            ctx.fill();
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.size * 0.8, 0, Math.PI * 2);
            ctx.fillStyle = p.color + Math.min(pulseAlpha + 0.2, 0.9) + ')';
            ctx.fill();
        }
    }

    function updateParticles() {
        for (var i = 0; i < particles.length; i++) {
            var p = particles[i];
            p.x += p.speedX;
            p.y += p.speedY;
            var dx = p.x - mouse.x;
            var dy = p.y - mouse.y;
            var distSq = dx * dx + dy * dy;
            if (distSq < 22500 && distSq > 0) {
                var dist = Math.sqrt(distSq);
                var force = (150 - dist) / 150 * 0.5;
                p.x += (dx / dist) * force;
                p.y += (dy / dist) * force;
            }
            if (p.x < -20) p.x = w + 20;
            if (p.x > w + 20) p.x = -20;
            if (p.y < -20) { p.y = h + 20; resetParticle(p); }
            if (p.y > h + 20) { p.y = -20; }
        }
    }

    function resetParticle(p) {
        p.x = Math.random() * w;
        p.y = -10;
        p.speedX = (Math.random() - 0.5) * 0.3;
        p.speedY = (Math.random() - 0.5) * 0.15 - 0.05;
        p.size = Math.random() * 2 + 0.5;
        p.alpha = Math.random() * 0.4 + 0.1;
    }

    function animateParticles() {
        if (!running) { animId = null; return; }
        updateParticles();
        drawParticles();
        animId = requestAnimationFrame(animateParticles);
    }

    document.addEventListener('mousemove', function(e) {
        var rect = canvas.getBoundingClientRect();
        mouse.x = e.clientX - rect.left;
        mouse.y = e.clientY - rect.top;
    }, { passive: true });

    var resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(resize, 200);
    }, { passive: true });

    if (window.IntersectionObserver) {
        var obs = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                running = entry.isIntersecting;
                if (running && !animId) {
                    animateParticles();
                }
            });
        }, { threshold: 0 });
        obs.observe(canvas);
    }

    animateParticles();
})();

// ==================== QUICK CHECKOUT ====================
let quickBundleData = null;

window.openQuickCheckout = function(bundle) {
    quickBundleData = bundle;
    document.getElementById('quickBundleName').textContent = bundle.name || 'Bundle';
    const products = (bundle.products || []).join(' + ');
    document.getElementById('quickBundleDesc').textContent = products || (bundle.name || '');
    const price = parseFloat(bundle.price) || 0;
    document.getElementById('quickBundlePrice').textContent = '$' + price.toFixed(2);
    document.getElementById('quickName').value = @json(Auth::user()?->name ?? '');
    document.getElementById('quickEmail').value = @json(Auth::user()?->email ?? '');
    document.getElementById('quickOrderBtn').disabled = false;
    document.getElementById('quickOrderBtn').innerHTML = '<svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Place Order';
    document.getElementById('quickCheckoutOverlay').style.display = 'flex';
    document.body.style.overflow = 'hidden';
    @auth
    var emailField = document.getElementById('quickEmail');
    if (emailField && emailField.value) { emailField.style.opacity = '0.6'; emailField.title = 'Signed in as ' + emailField.value; }
    var nameField = document.getElementById('quickName');
    if (nameField && nameField.value) { nameField.style.opacity = '0.6'; }
    @endauth
    setTimeout(function() {
        var firstField = document.getElementById('quickName');
        if (firstField && !firstField.value) firstField.focus();
        else { var emailF = document.getElementById('quickEmail'); if (emailF && !emailF.value) emailF.focus(); }
    }, 300);
};

window.closeQuickCheckout = function() {
    document.getElementById('quickCheckoutOverlay').style.display = 'none';
    document.body.style.overflow = '';
    quickBundleData = null;
};

window.submitQuickOrder = function() {
    if (!quickBundleData) { showToast('No item selected.', 'error'); return; }
    const name = document.getElementById('quickName').value.trim();
    const email = document.getElementById('quickEmail').value.trim();
    if (!name) { showToast('Please enter your name.', 'error'); document.getElementById('quickName').focus(); return; }
    if (!email) { showToast('Please enter your email address.', 'error'); document.getElementById('quickEmail').focus(); return; }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { showToast('Please enter a valid email address.', 'error'); document.getElementById('quickEmail').focus(); return; }

    const btn = document.getElementById('quickOrderBtn');
    btn.disabled = true;
    btn.innerHTML = '<svg style="width:1rem;height:1rem;animation:spin 0.8s linear infinite" fill="none" viewBox="0 0 24 24"><circle style="opacity:0.25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path style="opacity:0.75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Processing...';

    const items = [{ id: 'bundle-' + quickBundleData.id, name: quickBundleData.name || 'Bundle', price: parseFloat(quickBundleData.price) || 0, qty: 1 }];
    const total = items.reduce(function(s, i) { return s + (i.price * i.qty); }, 0);

    fetch('{{ route('order.place') }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 'Accept': 'application/json' },
        body: JSON.stringify({ items: JSON.stringify(items), total: total, name: name, email: email })
    })
    .then(function(response) {
        if (response.redirected) { window.location.href = response.url; return; }
        if (!response.ok) {
            return response.json().then(function(err) {
                var msg = 'Order failed';
                if (err.errors) { var first = Object.values(err.errors)[0]; if (first && first.length) msg = first[0]; }
                else if (err.message) { msg = err.message; }
                throw new Error(msg);
            }).catch(function(e) {
                if (e instanceof TypeError && e.message.includes('JSON')) { throw new Error('Order failed. Please try again.'); }
                throw e;
            });
        }
        return response.json();
    })
    .then(function(data) {
        if (data && data.redirect) { window.location.href = data.redirect; }
    })
    .catch(function(error) {
        showToast(error.message || 'Failed to place order. Please try again.', 'error');
        btn.disabled = false;
        btn.innerHTML = '<svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Place Order';
    });
};
</script>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    // ==================== COUNT-UP ANIMATION ====================
    (function initCountUps() {
        const counters = document.querySelectorAll('.count-up');
        if (!counters.length) return;
        const counterObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var el = entry.target;
                    var target = parseFloat(el.dataset.target);
                    var suffix = el.dataset.suffix || '';
                    var duration = 2000;
                    var startTime = performance.now();
                    var isDecimal = target % 1 !== 0;
                    function update(now) {
                        var elapsed = now - startTime;
                        var progress = Math.min(elapsed / duration, 1);
                        var eased = 1 - Math.pow(1 - progress, 3);
                        var current = eased * target;
                        el.textContent = isDecimal ? current.toFixed(1) : Math.floor(current);
                        if (progress < 1) { requestAnimationFrame(update); }
                        else { el.textContent = isDecimal ? target.toFixed(1) : Math.floor(target); }
                    }
                    requestAnimationFrame(update);
                    counterObserver.unobserve(el);
                }
            });
        }, { threshold: 0.5 });
        counters.forEach(function(c) { counterObserver.observe(c); });
    })();

    // ==================== COUNTER NUMBERS (Performance) ====================
    (function initCounters() {
        const counters = document.querySelectorAll('.counter-number');
        if (!counters.length) return;
        const counterObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var el = entry.target;
                    var target = parseFloat(el.dataset.target);
                    var prefix = el.dataset.prefix || '';
                    var suffix = el.dataset.suffix || '';
                    var duration = 1800;
                    var startTime = performance.now();
                    var isDecimal = target % 1 !== 0;
                    function update(now) {
                        var elapsed = now - startTime;
                        var progress = Math.min(elapsed / duration, 1);
                        var eased = 1 - Math.pow(1 - progress, 3);
                        var current = eased * target;
                        el.textContent = prefix + (isDecimal ? current.toFixed(1) : Math.floor(current)) + suffix;
                        if (progress < 1) { requestAnimationFrame(update); }
                        else { el.textContent = prefix + (isDecimal ? target.toFixed(1) : Math.floor(target)) + suffix; }
                    }
                    requestAnimationFrame(update);
                    counterObserver.unobserve(el);
                }
            });
        }, { threshold: 0.5 });
        counters.forEach(function(c) { counterObserver.observe(c); });
    })();

    // ==================== REVIEW CAROUSEL ====================
    var track = document.getElementById('reviewTrack');
    var dots = document.querySelectorAll('#reviewDots button');
    var prevBtn = document.getElementById('reviewPrev');
    var nextBtn = document.getElementById('reviewNext');
    var current = 0;
    var total = {{ count($reviews) }};
    var autoSlide;

    function goTo(index) {
        current = Math.max(0, Math.min(index, total - 1));
        if (track) track.style.transform = 'translateX(-' + (current * 100) + '%)';
        dots.forEach(function(d, i) {
            d.style.background = i === current ? '#005fe7' : 'rgba(0,95,231,0.2)';
            d.style.width = i === current ? '1.25rem' : '0.5rem';
        });
    }
    function nextReview() { goTo((current + 1) % total); }
    function prevReview() { goTo((current - 1 + total) % total); }
    function resetAuto() { clearInterval(autoSlide); autoSlide = setInterval(nextReview, 5000); }

    if (prevBtn) prevBtn.addEventListener('click', function() { prevReview(); resetAuto(); });
    if (nextBtn) nextBtn.addEventListener('click', function() { nextReview(); resetAuto(); });
    dots.forEach(function(d) { d.addEventListener('click', function() { goTo(parseInt(this.dataset.index)); resetAuto(); }); });
    resetAuto();

    // Touch swipe
    if (track) {
        var startX, isDragging = false, translateX = 0;
        track.addEventListener('touchstart', function(e) {
            isDragging = true; startX = e.touches[0].clientX;
            translateX = -current * track.offsetWidth;
            track.style.transition = 'none';
            clearInterval(autoSlide);
        }, { passive: true });
        track.addEventListener('touchmove', function(e) {
            if (!isDragging) return;
            var diff = e.touches[0].clientX - startX;
            track.style.transform = 'translateX(' + (translateX + diff) + 'px)';
        }, { passive: true });
        track.addEventListener('touchend', function(e) {
            if (!isDragging) return;
            isDragging = false;
            track.style.transition = 'transform 0.4s ease';
            var diff = e.changedTouches[0].clientX - startX;
            if (Math.abs(diff) > 50) { diff < 0 ? nextReview() : prevReview(); }
            else { goTo(current); }
            resetAuto();
        }, { passive: true });
    }

    // ==================== FAQ TOGGLE ====================
    window.toggleFaqAnswer = function(btn) {
        var card = btn.closest('.faq-card');
        if (!card) return;
        var fullAnswer = card.querySelector('.faq-answer-full');
        var arrow = btn.querySelector('.faq-arrow');
        var textSpan = btn.querySelector('span');
        if (!fullAnswer) return;
        var isVisible = fullAnswer.style.display === 'block';
        var allAnswers = document.querySelectorAll('.faq-answer-full');
        var allArrows = document.querySelectorAll('.faq-arrow');
        allAnswers.forEach(function(a) { if (a !== fullAnswer) a.style.display = 'none'; });
        allArrows.forEach(function(a) { if (a !== arrow) a.style.transform = 'rotate(0deg)'; });
        if (isVisible) {
            fullAnswer.style.display = 'none';
            if (arrow) arrow.style.transform = 'rotate(0deg)';
            if (textSpan) textSpan.textContent = 'Read Answer';
        } else {
            fullAnswer.style.display = 'block';
            if (arrow) arrow.style.transform = 'rotate(90deg)';
            if (textSpan) textSpan.textContent = 'Hide Answer';
            setTimeout(function() {
                var rect = card.getBoundingClientRect();
                if (rect.top < 80) { window.scrollBy({ top: rect.top - 100, behavior: 'smooth' }); }
            }, 100);
        }
    };
});
</script>
@endpush
