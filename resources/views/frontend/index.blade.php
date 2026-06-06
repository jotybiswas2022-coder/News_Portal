@extends('frontend.app')

@section('content')
<style>
    /* ===== INDEX PAGE - DARK PORTFOLIO THEME ===== */
    :root {
        --bg-primary: #0a0f1e;
        --bg-secondary: #0f172a;
        --bg-card: rgba(17, 28, 46, 0.8);
        --bg-nav: rgba(10, 15, 30, 0.88);
        --accent: #3b82f6;
        --accent-light: #60a5fa;
        --accent-dark: #2563eb;
        --accent-gradient: linear-gradient(135deg, #3b82f6, #8b5cf6);
        --accent-gradient-2: linear-gradient(135deg, #3b82f6, #60a5fa, #a78bfa, #3b82f6);
        --text-primary: #e2e8f0;
        --text-secondary: #94a3b8;
        --text-muted: #64748b;
        --border-color: rgba(59, 130, 246, 0.12);
        --border-hover: rgba(59, 130, 246, 0.3);
        --shadow-sm: 0 4px 20px rgba(0, 0, 0, 0.3);
        --shadow-md: 0 10px 40px rgba(0, 0, 0, 0.4);
        --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.5);
        --shadow-accent: 0 10px 40px rgba(59, 130, 246, 0.3);
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 20px;
        --radius-xl: 24px;
        --transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        --font: 'Inter', sans-serif;
    }

    /* Light Theme page-specific overrides */
    .light-theme .project-card {
        background: linear-gradient(145deg, #ffffff, #f8fafc);
    }
    .light-theme .skill-card,
    .light-theme .timeline-card,
    .light-theme .contact-form,
    .light-theme .contact-item,
    .light-theme .testimonial-card {
        background: rgba(255, 255, 255, 0.85);
    }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    html { scroll-behavior: smooth; }
    body {
        font-family: var(--font);
        background: var(--bg-primary);
        color: var(--text-primary);
        overflow-x: hidden;
        line-height: 1.6;
    }
    ::selection { background: rgba(59, 130, 246, 0.3); color: #fff; }
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: var(--bg-primary); }
    ::-webkit-scrollbar-thumb { background: rgba(59, 130, 246, 0.3); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: rgba(59, 130, 246, 0.5); }

    /* Particles */
    #particles-canvas {
        position: fixed; top: 0; left: 0;
        width: 100%; height: 100%;
        z-index: 0; pointer-events: none;
    }

    /* Custom Cursor */
    .cursor-dot {
        width: 8px; height: 8px; background: var(--accent);
        border-radius: 50%; position: fixed;
        pointer-events: none; z-index: 9999;
        transform: translate(-50%, -50%);
        transition: width 0.2s, height 0.2s, background 0.2s;
    }
    .cursor-dot.active { width: 12px; height: 12px; background: var(--accent-light); }
    .cursor-ring {
        width: 36px; height: 36px;
        border: 2px solid rgba(59, 130, 246, 0.35);
        border-radius: 50%; position: fixed;
        pointer-events: none; z-index: 9998;
        transform: translate(-50%, -50%);
        transition: all 0.15s ease-out, width 0.3s, border-color 0.3s, background 0.3s;
    }
    .cursor-ring.active {
        width: 50px; height: 50px;
        border-color: rgba(59, 130, 246, 0.7);
        background: rgba(59, 130, 246, 0.05);
    }
    @media (max-width: 768px) { .cursor-dot, .cursor-ring { display: none; } }

    /* Hero */
    .hero {
        min-height: 100vh; display: flex; align-items: center;
        justify-content: center; text-align: center;
        position: relative; z-index: 1; padding: 6rem 2rem 2rem;
    }
    .hero-content { max-width: 850px; }
    .hero::before {
        content: ''; position: absolute;
        width: 700px; height: 700px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.12), transparent 70%);
        border-radius: 50%; top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        animation: pulseOrb 5s ease-in-out infinite;
    }
    @keyframes pulseOrb {
        0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.4; }
        50% { transform: translate(-50%, -50%) scale(1.15); opacity: 0.8; }
    }
    .hero-badge {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.4rem 1.2rem;
        background: rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.25);
        border-radius: 50px; font-size: 0.82rem;
        color: var(--accent-light); margin-bottom: 1.5rem;
        animation: fadeInDown 0.8s ease forwards; opacity: 0;
    }
    .hero h1 {
        font-size: clamp(2.8rem, 7vw, 5.5rem); font-weight: 900;
        line-height: 1.05; margin-bottom: 1rem;
        animation: fadeInUp 1s ease forwards; opacity: 0;
        animation-delay: 0.2s; letter-spacing: -1.5px;
    }
    .hero h1 .gradient-text {
        background: var(--accent-gradient-2);
        background-size: 300% 300%;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: gradientShift 4s ease infinite;
    }
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .typing-wrapper {
        display: inline-flex; align-items: center; gap: 3px;
        color: var(--accent-light); font-size: 1.15rem;
        margin-bottom: 1.5rem; font-weight: 500;
        animation: fadeInUp 1s ease forwards; opacity: 0; animation-delay: 0.3s;
    }
    .typing-cursor {
        width: 2px; height: 1.3em;
        background: var(--accent); animation: blink 0.8s step-end infinite;
    }
    @keyframes blink { 50% { opacity: 0; } }
    .hero p {
        font-size: 1.15rem; color: var(--text-secondary);
        max-width: 640px; margin: 0 auto 2.5rem;
        animation: fadeInUp 1s ease forwards; opacity: 0;
        animation-delay: 0.4s; line-height: 1.8;
    }
    .hero-buttons {
        display: flex; gap: 1rem; justify-content: center;
        flex-wrap: wrap;
        animation: fadeInUp 1s ease forwards; opacity: 0; animation-delay: 0.6s;
    }
    .btn-primary-custom {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.85rem 2.2rem;
        background: var(--accent-gradient); color: #fff;
        border: none; border-radius: var(--radius-md);
        font-size: 0.95rem; font-weight: 600;
        cursor: pointer; transition: var(--transition);
        position: relative; overflow: hidden;
    }
    .btn-primary-custom::before {
        content: ''; position: absolute; top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        transition: left 0.6s ease;
    }
    .btn-primary-custom:hover::before { left: 100%; }
    .btn-primary-custom:hover {
        transform: translateY(-3px); box-shadow: var(--shadow-accent);
    }
    .btn-outline-custom {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.85rem 2.2rem; background: transparent;
        color: var(--accent-light); border: 2px solid rgba(59, 130, 246, 0.35);
        border-radius: var(--radius-md); font-size: 0.95rem; font-weight: 600;
        cursor: pointer; transition: var(--transition);
    }
    .btn-outline-custom:hover {
        background: rgba(59, 130, 246, 0.08);
        border-color: var(--accent); transform: translateY(-3px);
    }
    .scroll-indicator {
        position: absolute; bottom: 2rem; left: 50%;
        transform: translateX(-50%); animation: bounce 2s ease infinite;
    }
    .scroll-indicator .mouse {
        width: 24px; height: 38px;
        border: 2px solid rgba(59, 130, 246, 0.4);
        border-radius: 12px; display: flex;
        justify-content: center; padding-top: 7px;
    }
    .scroll-indicator .wheel {
        width: 3px; height: 9px; background: var(--accent);
        border-radius: 3px; animation: scrollWheel 1.5s ease infinite;
    }
    @keyframes scrollWheel {
        0% { opacity: 1; transform: translateY(0); }
        100% { opacity: 0; transform: translateY(12px); }
    }
    @keyframes bounce {
        0%, 100% { transform: translateX(-50%) translateY(0); }
        50% { transform: translateX(-50%) translateY(-8px); }
    }

    /* Sections */
    section { position: relative; z-index: 1; }
    .section-padding { padding: 7rem 2rem; }
    .container { max-width: 1200px; margin: 0 auto; }
    .section-title { text-align: center; margin-bottom: 4rem; }
    .section-title h2 {
        font-size: 2.5rem; font-weight: 800;
        margin-bottom: 0.8rem; letter-spacing: -1px;
    }
    .section-title .line {
        width: 60px; height: 4px;
        background: var(--accent-gradient);
        margin: 0 auto 1.2rem; border-radius: 2px;
    }
    .section-title p { color: var(--text-secondary); font-size: 1.05rem; }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .reveal { opacity: 0; transform: translateY(60px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
    .reveal.active { opacity: 1; transform: translateY(0); }
    .reveal-delay-1 { transition-delay: 0.1s; }
    .reveal-delay-2 { transition-delay: 0.2s; }
    .reveal-delay-3 { transition-delay: 0.3s; }
    .reveal-delay-4 { transition-delay: 0.4s; }

    /* About */
    .about-section { background: linear-gradient(180deg, var(--bg-secondary) 0%, var(--bg-primary) 100%); }
    .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; }
    .about-image { position: relative; display: flex; justify-content: center; align-items: center; }
    .about-image .img-wrapper {
        width: 320px; height: 320px; border-radius: 32px; overflow: hidden;
        border: 3px solid rgba(59, 130, 246, 0.25); position: relative;
        background: linear-gradient(135deg, #1e293b, #0f172a);
        display: flex; align-items: center; justify-content: center;
        animation: float 6s ease-in-out infinite;
        box-shadow: 0 20px 60px rgba(59, 130, 246, 0.1);
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        33% { transform: translateY(-10px); }
        66% { transform: translateY(5px); }
    }
    .about-image .glow-ring {
        position: absolute; width: 340px; height: 340px;
        border-radius: 32px; border: 2px solid rgba(59, 130, 246, 0.15);
        animation: rotateRing 8s linear infinite;
    }
    @keyframes rotateRing {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .about-text h3 { font-size: 1.75rem; font-weight: 700; margin-bottom: 1rem; line-height: 1.3; }
    .about-text p { color: var(--text-secondary); line-height: 1.8; margin-bottom: 1rem; }
    .about-stats { display: flex; gap: 1.5rem; margin-top: 2rem; }
    .stat-item {
        flex: 1; text-align: center; padding: 1.2rem 1rem;
        background: rgba(59, 130, 246, 0.04);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md); transition: var(--transition);
    }
    .stat-item:hover {
        transform: translateY(-5px);
        border-color: rgba(59, 130, 246, 0.35);
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.08);
    }
    .stat-item .number { font-size: 2rem; font-weight: 800; color: var(--accent); }
    .stat-item .label { font-size: 0.82rem; color: var(--text-muted); margin-top: 0.3rem; }

    /* Services */
    .services-section { background: linear-gradient(180deg, #080d1a 0%, var(--bg-secondary) 100%); }
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 2rem;
    }
    .service-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 2.5rem 2rem;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }
    .service-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: var(--accent-gradient);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .service-card:hover::before { transform: scaleX(1); }
    .service-card:hover {
        transform: translateY(-10px) scale(1.02);
        border-color: var(--accent);
        box-shadow: 0 20px 60px rgba(59, 130, 246, 0.15);
    }
    .service-card .service-icon {
        width: 70px; height: 70px;
        background: rgba(59, 130, 246, 0.08);
        border: 1px solid rgba(59, 130, 246, 0.2);
        border-radius: 20px;
        display: flex; align-items: center; justify-content: center;
        font-size: 2rem; color: var(--accent);
        margin: 0 auto 1.2rem;
        transition: all 0.4s ease;
    }
    .service-card:hover .service-icon {
        background: var(--accent-gradient);
        color: #fff;
        border-color: transparent;
        transform: scale(1.1) rotate(-5deg);
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
    }
    .service-card h3 {
        font-size: 1.15rem;
        font-weight: 700;
        margin-bottom: 0.6rem;
    }
    .service-card p {
        color: var(--text-secondary);
        font-size: 0.88rem;
        line-height: 1.7;
        margin-bottom: 0;
    }
    .light-theme .service-card {
        background: rgba(255, 255, 255, 0.85);
    }

    /* Timeline */
    .timeline-section { background: linear-gradient(180deg, var(--bg-primary) 0%, #080d1a 100%); }
    .timeline { position: relative; max-width: 900px; margin: 0 auto; padding: 1rem 0; }
    .timeline-line {
        position: absolute; left: 50%; top: 0; bottom: 0; width: 2px;
        background: linear-gradient(180deg, transparent, rgba(59,130,246,0.3), rgba(59,130,246,0.5), rgba(59,130,246,0.3), transparent);
        transform: translateX(-50%);
    }
    .timeline-item { position: relative; width: 50%; padding: 1.5rem 2.5rem; }
    .timeline-item.left { left: 0; text-align: right; padding-right: 3rem; }
    .timeline-item.right { left: 50%; text-align: left; padding-left: 3rem; }
    .timeline-dot {
        position: absolute; width: 46px; height: 46px;
        background: var(--accent-gradient); border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 1.1rem; z-index: 2;
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
        border: 3px solid var(--bg-primary);
    }
    .timeline-item.left .timeline-dot { right: -23px; top: 1.8rem; }
    .timeline-item.right .timeline-dot { left: -23px; top: 1.8rem; }
    .timeline-card {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: var(--radius-lg); padding: 1.5rem;
        transition: var(--transition); position: relative; backdrop-filter: blur(10px);
    }
    .timeline-card:hover {
        border-color: var(--border-hover); transform: translateY(-5px);
        box-shadow: var(--shadow-md);
    }
    .timeline-date {
        display: inline-flex; align-items: center; gap: 0.3rem;
        font-size: 0.78rem; color: var(--accent-light); font-weight: 600;
        background: rgba(59, 130, 246, 0.08);
        padding: 0.25rem 0.9rem; border-radius: 20px; margin-bottom: 0.6rem;
    }
    .current-badge {
        display: inline-block; font-size: 0.6rem; font-weight: 700;
        background: #10b981; color: #fff;
        padding: 0.2rem 0.6rem; border-radius: 20px;
        margin-left: 0.5rem; text-transform: uppercase; letter-spacing: 0.5px;
    }
    .timeline-card h3 { font-size: 1.15rem; font-weight: 700; margin-bottom: 0.25rem; }
    .timeline-company { font-size: 0.88rem; color: var(--text-secondary); margin-bottom: 0.8rem; display: flex; flex-wrap: wrap; align-items: center; gap: 0.5rem; }
    .timeline-item.left .timeline-company { justify-content: flex-end; }
    .timeline-location { font-size: 0.82rem; color: var(--text-muted); }
    .timeline-card p { color: var(--text-secondary); font-size: 0.88rem; line-height: 1.7; margin-bottom: 0; }
    .timeline-item.left .timeline-card p { text-align: right; }
    @media (max-width: 768px) {
        .timeline-line { left: 28px; }
        .timeline-item { width: 100%; padding: 1rem 0 1rem 4rem !important; text-align: left !important; }
        .timeline-item.left { left: 0; padding-right: 0; }
        .timeline-item.right { left: 0; }
        .timeline-item .timeline-dot { left: 6px !important; right: auto !important; width: 38px; height: 38px; font-size: 0.9rem; top: 1.5rem; }
        .timeline-item.left .timeline-company { justify-content: flex-start; }
        .timeline-item.left .timeline-card p { text-align: left; }
    }

    /* Skills */
    .skills-section { background: linear-gradient(180deg, #080d1a 0%, var(--bg-secondary) 100%); }
    .skills-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1.5rem; }
    .skill-card {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: var(--radius-md); padding: 2rem 1.2rem;
        text-align: center; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        cursor: default; backdrop-filter: blur(10px);
    }
    .skill-card:hover {
        transform: translateY(-8px) scale(1.03); border-color: var(--accent);
        background: rgba(59, 130, 246, 0.06);
        box-shadow: 0 20px 60px rgba(59, 130, 246, 0.1);
    }
    .skill-card .icon { font-size: 2.5rem; margin-bottom: 0.8rem; display: block; transition: var(--transition); }
    .skill-card:hover .icon { transform: scale(1.2); }
    .skill-card .name { font-weight: 600; font-size: 0.9rem; }
    .skill-card .percentage-label { display: block; font-size: 0.75rem; color: var(--accent-light); font-weight: 600; margin-top: 0.3rem; }
    .skill-card .bar-wrapper { margin-top: 0.8rem; background: rgba(59, 130, 246, 0.08); border-radius: 10px; height: 4px; overflow: hidden; }
    .skill-card .bar-fill { height: 100%; background: var(--accent-gradient); border-radius: 10px; width: 0; transition: width 1.5s cubic-bezier(0.16, 1, 0.3, 1); }

    /* Filter Tabs */
    .filter-tabs {
        display: flex; flex-wrap: wrap; gap: 0.6rem;
        justify-content: center; margin-bottom: 2.5rem;
    }
    .filter-btn {
        padding: 0.5rem 1.2rem;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 50px;
        color: var(--text-secondary);
        font-size: 0.82rem; font-weight: 500;
        cursor: pointer; transition: var(--transition);
        font-family: var(--font);
    }
    .filter-btn:hover {
        border-color: var(--accent);
        color: var(--accent-light);
    }
    .filter-btn.active {
        background: var(--accent-gradient);
        border-color: transparent;
        color: #fff;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }
    .filter-btn.active:hover {
        color: #fff;
    }

    /* Projects */
    .projects-section { background: linear-gradient(180deg, var(--bg-secondary) 0%, var(--bg-primary) 100%); }
    .projects-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(360px, 1fr)); gap: 2rem; }
    .project-card {
        background: linear-gradient(145deg, rgba(30, 41, 59, 0.5), rgba(22, 32, 50, 0.5));
        border: 1px solid var(--border-color); border-radius: var(--radius-lg);
        overflow: hidden; transition: var(--transition); position: relative; backdrop-filter: blur(10px);
    }
    .project-card:hover {
        transform: translateY(-8px); border-color: var(--border-hover);
        box-shadow: var(--shadow-lg), 0 0 40px rgba(59, 130, 246, 0.08);
    }
    .project-card .card-image { height: 210px; position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center; }
    .project-card .card-image .project-icon { font-size: 4rem; opacity: 0.5; transition: var(--transition); }
    .project-card:hover .card-image .project-icon { transform: scale(1.3); opacity: 1; }
    .project-card .card-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
    .project-card:hover .card-image img { transform: scale(1.08); }
    .project-card .card-image::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 70px; background: linear-gradient(transparent, rgba(30, 41, 59, 0.95)); }
    .project-card .card-body { padding: 1.8rem; }
    .project-card .card-body h3 { font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem; }
    .project-card .card-body p { color: var(--text-secondary); font-size: 0.92rem; line-height: 1.7; margin-bottom: 1.2rem; }
    .project-card .tags { display: flex; flex-wrap: wrap; gap: 0.4rem; margin-bottom: 1.2rem; }
    .project-card .tag { padding: 0.25rem 0.8rem; background: rgba(59, 130, 246, 0.08); border: 1px solid rgba(59, 130, 246, 0.18); border-radius: 20px; font-size: 0.73rem; color: var(--accent-light); font-weight: 500; }
    .project-card .card-link { display: inline-flex; align-items: center; gap: 0.4rem; color: var(--accent); font-weight: 600; font-size: 0.88rem; transition: gap 0.3s ease; }
    .project-card .card-link:hover { gap: 0.8rem; }

    /* Testimonials */
    .testimonials-section { background: linear-gradient(180deg, var(--bg-primary) 0%, #080d1a 100%); }
    .testimonial-carousel { max-width: 750px; margin: 0 auto; position: relative; overflow: hidden; }
    .testimonial-track { display: flex; transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1); }
    .testimonial-card {
        min-width: 100%; padding: 2.5rem 2rem;
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: var(--radius-xl); text-align: center;
        position: relative; transition: var(--transition);
        margin: 0 0.25rem; backdrop-filter: blur(10px);
    }
    .testimonial-card:hover { border-color: var(--border-hover); box-shadow: var(--shadow-md); }
    .quote-icon { font-size: 3rem; color: rgba(59, 130, 246, 0.15); margin-bottom: 0.5rem; }
    .testimonial-stars { color: #f59e0b; margin-bottom: 1.2rem; font-size: 1.05rem; display: flex; justify-content: center; gap: 3px; }
    .testimonial-stars .bi-star { opacity: 0.3; }
    .testimonial-text { color: #cbd5e1; font-size: 1.02rem; line-height: 1.8; margin-bottom: 1.8rem; font-style: italic; }
    .testimonial-author { display: flex; align-items: center; justify-content: center; gap: 1rem; }
    .author-avatar img { width: 55px; height: 55px; border-radius: 50%; object-fit: cover; border: 2px solid rgba(59, 130, 246, 0.25); }
    .avatar-fallback { width: 55px; height: 55px; border-radius: 50%; background: var(--accent-gradient); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.3rem; color: #fff; border: 2px solid rgba(59, 130, 246, 0.25); }
    .author-name { font-weight: 700; color: var(--text-primary); font-size: 1rem; }
    .author-designation { font-size: 0.78rem; color: var(--text-muted); margin-top: 2px; }
    .carousel-controls { display: flex; align-items: center; justify-content: center; gap: 1.5rem; margin-top: 2rem; }
    .carousel-btn {
        width: 44px; height: 44px; border-radius: 50%;
        border: 1px solid rgba(59, 130, 246, 0.25);
        background: rgba(30, 41, 59, 0.4); color: var(--text-secondary);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: var(--transition); font-size: 1.1rem;
    }
    .carousel-btn:hover { background: var(--accent); border-color: var(--accent); color: #fff; transform: scale(1.05); }
    .carousel-dots { display: flex; gap: 8px; }
    .carousel-dots .dot { width: 10px; height: 10px; border-radius: 50%; background: rgba(59, 130, 246, 0.2); cursor: pointer; transition: var(--transition); }
    .carousel-dots .dot.active { background: var(--accent); width: 28px; border-radius: 5px; }

    /* Contact */
    .contact-section { background: linear-gradient(180deg, #080d1a 0%, var(--bg-secondary) 100%); }
    .contact-grid { display: grid; grid-template-columns: 1fr 1.2fr; gap: 4rem; align-items: start; }
    .contact-info h3 { font-size: 1.6rem; font-weight: 700; margin-bottom: 1rem; }
    .contact-info p { color: var(--text-secondary); line-height: 1.8; margin-bottom: 2rem; }
    .contact-item {
        display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;
        padding: 1rem; background: var(--bg-card);
        border-radius: var(--radius-md); border: 1px solid var(--border-color);
        transition: var(--transition);
    }
    .contact-item:hover { border-color: rgba(59, 130, 246, 0.35); transform: translateX(8px); }
    .contact-item .icon-box { width: 45px; height: 45px; background: rgba(59, 130, 246, 0.08); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0; color: var(--accent); }
    .contact-item .text .label { font-size: 0.78rem; color: var(--text-muted); }
    .contact-item .text .value { font-weight: 600; margin-top: 0.15rem; font-size: 0.92rem; }
    .contact-form {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: var(--radius-xl); padding: 2.5rem; backdrop-filter: blur(10px);
    }
    .form-group { margin-bottom: 1.5rem; }
    .form-group label { display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.5rem; color: #cbd5e1; }
    .form-group input, .form-group textarea {
        width: 100%; padding: 0.9rem 1.2rem;
        background: rgba(10, 15, 30, 0.7); border: 1px solid var(--border-color);
        border-radius: var(--radius-md); color: var(--text-primary);
        font-family: var(--font); font-size: 0.92rem;
        transition: var(--transition); outline: none;
    }
    .form-group input:focus, .form-group textarea:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
    .form-group textarea { resize: vertical; min-height: 120px; }
    .btn-submit {
        width: 100%; padding: 1rem;
        background: var(--accent-gradient); color: #fff;
        border: none; border-radius: var(--radius-md);
        font-size: 0.95rem; font-weight: 700; cursor: pointer;
        transition: var(--transition); position: relative; overflow: hidden;
        font-family: var(--font);
    }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: var(--shadow-accent); }
    .btn-submit::after {
        content: ''; position: absolute; top: 50%; left: 50%;
        width: 0; height: 0; background: rgba(255,255,255,0.15);
        border-radius: 50%; transition: all 0.5s ease;
        transform: translate(-50%, -50%);
    }
    .btn-submit:active::after { width: 400px; height: 400px; }

    /* Map */
    .map-wrapper { margin-top: 3rem; }
    .map-container {
        max-width: 900px; margin: 0 auto; border-radius: var(--radius-lg);
        overflow: hidden; border: 1px solid var(--border-color);
        box-shadow: var(--shadow-sm); transition: var(--transition);
    }
    .map-container:hover { border-color: var(--border-hover); box-shadow: var(--shadow-md); }
    .map-container iframe { display: block; filter: invert(0.9) hue-rotate(180deg) saturate(0.5); }

    /* Footer */
    .footer { background: #080b14; border-top: 1px solid var(--border-color); padding: 3rem 2rem; text-align: center; position: relative; z-index: 1; }
    .footer-links { display: flex; justify-content: center; gap: 2rem; margin-bottom: 1.2rem; flex-wrap: wrap; }
    .footer-links a { color: var(--text-muted); transition: var(--transition); font-size: 0.88rem; font-weight: 500; text-decoration: none; }
    .footer-links a:hover { color: var(--accent); }
    .footer p { color: #394358; font-size: 0.84rem; }

    /* WhatsApp */
    .whatsapp-float {
        position: fixed; bottom: 2rem; left: 2rem;
        width: 56px; height: 56px;
        background: linear-gradient(135deg, #25D366, #128C7E);
        border-radius: 50%; display: flex; align-items: center;
        justify-content: center; color: #fff; font-size: 1.6rem;
        z-index: 9999; box-shadow: 0 6px 25px rgba(37, 211, 102, 0.35);
        transition: var(--transition); text-decoration: none;
        animation: pulseWhatsApp 2.5s ease-in-out infinite;
    }
    .whatsapp-float:hover { transform: scale(1.1); box-shadow: 0 10px 35px rgba(37, 211, 102, 0.5); color: #fff; }
    .whatsapp-tooltip {
        position: absolute; left: 66px; top: 50%; transform: translateY(-50%);
        background: #1e293b; color: var(--text-primary);
        padding: 0.4rem 0.9rem; border-radius: var(--radius-sm);
        font-size: 0.78rem; white-space: nowrap; font-weight: 500;
        opacity: 0; pointer-events: none; transition: var(--transition);
        border: 1px solid var(--border-color);
    }
    .whatsapp-float:hover .whatsapp-tooltip { opacity: 1; }
    @keyframes pulseWhatsApp {
        0%, 100% { box-shadow: 0 6px 25px rgba(37, 211, 102, 0.35); }
        50% { box-shadow: 0 6px 40px rgba(37, 211, 102, 0.6); }
    }

    /* Scroll Progress Bar */
    .scroll-progress {
        position: fixed; top: 0; left: 0;
        height: 3px; z-index: 10001;
        background: linear-gradient(90deg, #3b82f6, #8b5cf6, #ec4899);
        background-size: 200% 100%;
        animation: progressGlow 2s ease infinite;
        width: 0%;
        transition: width 0.1s ease-out;
        box-shadow: 0 0 10px rgba(59, 130, 246, 0.4);
    }
    @keyframes progressGlow {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Back to Top */
    .back-to-top {
        position: fixed; bottom: 2rem; right: 2rem;
        width: 50px; height: 50px;
        background: var(--accent-gradient); border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem; cursor: pointer; z-index: 100;
        opacity: 0; transform: translateY(20px);
        transition: var(--transition); border: none; color: #fff;
        box-shadow: 0 5px 20px rgba(59, 130, 246, 0.3);
    }
    .back-to-top.visible { opacity: 1; transform: translateY(0); }
    .back-to-top:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(59, 130, 246, 0.45); }

    /* Toast */
    .toast {
        position: fixed; bottom: 2rem; left: 50%;
        transform: translateX(-50%) translateY(100px);
        background: var(--accent-gradient); color: #fff;
        padding: 1rem 2rem; border-radius: var(--radius-md);
        font-weight: 600; z-index: 10000;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: var(--shadow-accent);
        display: flex; align-items: center; gap: 0.5rem;
    }
    .toast.show { transform: translateX(-50%) translateY(0); }

    /* Shared Utilities */
    .empty-state { text-align: center; padding: 4rem 2rem; }
    .empty-state i { font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem; display: block; }
    .empty-state p { color: var(--text-muted); }
    .magnetic { transition: transform 0.3s ease; }

    /* Responsive */
    @media (max-width: 968px) {
        .about-grid, .contact-grid { grid-template-columns: 1fr; gap: 2.5rem; }
        .about-image { order: -1; }
        .projects-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 768px) {
        .about-stats { flex-wrap: wrap; }
        .about-stats .stat-item { flex: 1; min-width: 100px; }
        .about-image .img-wrapper { width: 240px; height: 240px; }
        .about-image .glow-ring { width: 260px; height: 260px; }
    }
    @media (max-width: 480px) {
        .section-padding { padding: 4rem 1.2rem; }
        .skills-grid { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
        .section-title h2 { font-size: 1.8rem; }
        .skill-card { padding: 1.5rem 0.8rem; }
        .whatsapp-tooltip { display: none; }
        .map-container iframe { height: 250px; }
        .projects-grid { grid-template-columns: 1fr; }
        .contact-form { padding: 1.5rem; }
    }
</style>
    <!-- Custom Cursor -->
    <div class="cursor-dot" id="cursorDot"></div>
    <div class="cursor-ring" id="cursorRing"></div>

    <!-- Particles Canvas -->
    <canvas id="particles-canvas"></canvas>

    <!-- Hero Section -->
    <section class="hero" id="hero">
        <div class="hero-content">
            <div class="hero-badge"><i class="bi bi-briefcase-fill"></i> {{ __('messages.hero_badge') }}</div>
            <h1>{{ __('messages.hero_greeting') }} <span class="gradient-text">{{ $account->name }}</span></h1>
            <div class="typing-wrapper">
                <span id="typingText"></span>
                <span class="typing-cursor"></span>
            </div>
            <p>{{ __('messages.hero_tagline') }}</p>
            <div class="hero-buttons">
                <a href="#projects" class="btn-primary-custom magnetic">
                    <i class="bi bi-rocket-fill"></i> {{ __('messages.see_my_work') }}
                </a>
                <a href="#contact" class="btn-outline-custom magnetic">
                    <i class="bi bi-chat-dots-fill"></i> {{ __('messages.contact_me') }}
                </a>
            </div>
        </div>
        <div class="scroll-indicator">
            <div class="mouse">
                <div class="wheel"></div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section section-padding" id="about">
        <div class="container">
            <div class="section-title reveal">
                <div class="line"></div>
                <h2>{{ __('messages.about_title') }}</h2>
                <p>{{ __('messages.about_subtitle') }}</p>
            </div>
            <div class="about-grid">
                <div class="about-image reveal reveal-delay-1">
                    <div class="glow-ring"></div>
                    <div class="img-wrapper">
                        <img src="{{ config('app.storage_url') }}{{ $account->image }}" alt="{{ $account->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 32px;">
                    </div>
                </div>
                <div class="about-text reveal reveal-delay-2">
                    <h3>{{ __('messages.about_heading') }}</h3>
                    <p>{{ __('messages.about_desc_1') }}</p>
                    <p>{{ __('messages.about_desc_2') }}</p>
                    <div class="about-stats">
                        <div class="stat-item">
                            <div class="number" data-count="50">0</div>
                            <div class="label">{{ __('messages.stat_projects') }}</div>
                        </div>
                        <div class="stat-item">
                            <div class="number" data-count="30">0</div>
                            <div class="label">{{ __('messages.stat_clients') }}</div>
                        </div>
                        <div class="stat-item">
                            <div class="number" data-count="3">0</div>
                            <div class="label">{{ __('messages.stat_years') }}</div>
                        </div>
                    </div>

                    <!-- Download CV Button -->
                    @if(isset($account) && $account->cv)
                        <div class="mt-4">
                            <a href="{{ config('app.storage_url') }}{{ $account->cv }}" 
                               download
                               class="btn-primary-custom magnetic"
                               style="display: inline-flex; align-items: center; gap: 0.5rem;">
                                <i class="bi bi-file-earmark-pdf-fill"></i> {{ __('messages.download_cv') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section section-padding" id="services">
        <div class="container">
            <div class="section-title reveal">
                <div class="line"></div>
                <h2>{{ __('messages.services_title') }}</h2>
                <p>{{ __('messages.services_subtitle') }}</p>
            </div>

            @if($services->isNotEmpty())
                <div class="services-grid">
                    @foreach($services as $index => $service)
                        @php $delay = ($index % 4) + 1; @endphp
                        <div class="service-card reveal reveal-delay-{{ $delay }}">
                            <div class="service-icon">
                                <i class="bi {{ $service->icon ?: 'bi-star' }}"></i>
                            </div>
                            <h3>{{ $service->title }}</h3>
                            @if($service->short_description)
                                <p>{{ $service->short_description }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state reveal">
                    <i class="bi bi-gear"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_services') }}</p>
                    <p>{{ __('messages.no_services_desc') }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Experience Timeline Section -->
    <section class="timeline-section section-padding" id="experience">
        <div class="container">
            <div class="section-title reveal">
                <div class="line"></div>
                <h2>{{ __('messages.experience_title') }}</h2>
                <p>{{ __('messages.experience_subtitle') }}</p>
            </div>

            @if($experiences->isNotEmpty())
                <div class="timeline reveal">
                    <div class="timeline-line"></div>

                    @foreach($experiences as $index => $exp)
                        <div class="timeline-item {{ $index % 2 == 0 ? 'left' : 'right' }}">
                            <div class="timeline-dot">
                                <i class="bi bi-briefcase-fill"></i>
                            </div>
                            <div class="timeline-card">
                                <div class="timeline-date">
                                    <i class="bi bi-calendar3 me-1"></i>{{ $exp->duration }}
                                </div>
                                @if($exp->is_current)
                                    <span class="current-badge">{{ __('messages.current') }}</span>
                                @endif
                                <h3>{{ $exp->position }}</h3>
                                <div class="timeline-company">
                                    <i class="bi bi-building me-1"></i>{{ $exp->company }}
                                    @if($exp->location)
                                        <span class="timeline-location ms-3">
                                            <i class="bi bi-geo-alt me-1"></i>{{ $exp->location }}
                                        </span>
                                    @endif
                                </div>
                                @if($exp->description)
                                    <p>{{ $exp->description }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state reveal">
                    <i class="bi bi-briefcase"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_experience') }}</p>
                    <p>{{ __('messages.no_experience_desc') }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Skills Section -->
    <section class="skills-section section-padding" id="skills">
        <div class="container">
            <div class="section-title reveal">
                <div class="line"></div>
                <h2>{{ __('messages.skills_title') }}</h2>
                <p>{{ __('messages.skills_subtitle') }}</p>
            </div>
            <div class="skills-grid">
                @forelse($skills as $index => $skill)
                    @php $delay = ($index % 4) + 1; @endphp
                    <div class="skill-card reveal reveal-delay-{{ $delay }}" data-skill="{{ $skill->percentage }}">
                        <span class="icon"><i class="bi {{ $skill->icon ?: 'bi-star' }}"></i></span>
                        <span class="name">{{ $skill->name }}</span>
                        <span class="percentage-label">{{ $skill->percentage }}%</span>
                        <div class="bar-wrapper"><div class="bar-fill" data-width="{{ $skill->percentage }}%"></div></div>
                    </div>
                @empty
                    <div class="empty-state" style="grid-column: 1 / -1;">
                        <i class="bi bi-lightning-charge"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_skills') }}</p>
                    <p>{{ __('messages.no_skills_desc') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section class="projects-section section-padding" id="projects">
        <div class="container">
            <div class="section-title reveal">
                <div class="line"></div>
                <h2>{{ __('messages.projects_title') }}</h2>
                <p>{{ __('messages.projects_subtitle') }}</p>
            </div>
            <!-- Filter Buttons -->
            <div class="filter-tabs reveal">
                <button class="filter-btn active" data-filter="all">{{ __('messages.all') }}</button>
                @php
                    $allTechs = [];
                    foreach($projects as $p) {
                        foreach($p->getTechStackArray() as $t) {
                            $slug = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $t));
                            $allTechs[$slug] = $t;
                        }
                    }
                @endphp
                @foreach($allTechs as $slug => $label)
                    <button class="filter-btn" data-filter="{{ $slug }}">{{ $label }}</button>
                @endforeach
            </div>

            <div class="projects-grid">
                @forelse($projects as $index => $project)
                    @php
                        $techSlugs = [];
                        foreach($project->getTechStackArray() as $t) {
                            $techSlugs[] = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $t));
                        }
                        $gradients = [
                            'linear-gradient(135deg, #1e3a5f, #1a1a3e)',
                            'linear-gradient(135deg, #1e4040, #1a2e3e)',
                            'linear-gradient(135deg, #2e1e5f, #1a1a3e)',
                            'linear-gradient(135deg, #3a1e3e, #1a1a3e)',
                            'linear-gradient(135deg, #1e2a4f, #1a1a3e)',
                            'linear-gradient(135deg, #2e3a1e, #1a2a1e)',
                        ];
                        $icons = [
                            'bi bi-cart-fill',
                            'bi bi-palette-fill',
                            'bi bi-card-checklist',
                            'bi bi-phone-fill',
                            'bi bi-globe',
                            'bi bi-cpu-fill',
                        ];
                        $delay = ($index % 4) + 1;
                    @endphp
                    <div class="project-card reveal reveal-delay-{{ $delay }}" data-tech="{{ implode(' ', $techSlugs) }}">
                        <div class="card-image" style="background: {{ $gradients[$index % count($gradients)] }};">
                            @if($project->image)
                                <img src="{{ config('app.storage_url') }}{{ $project->image }}"
                                     alt="{{ $project->title }} screenshot"
                                     style="width: 100%; height: 100%; object-fit: cover; opacity: 0.8;">
                            @else
                                <span class="project-icon"><i class="{{ $icons[$index % count($icons)] }}"></i></span>
                            @endif
                        </div>
                        <div class="card-body">
                            <h3>{{ $project->title }}</h3>
                            <p>{{ $project->description ?? 'No description available.' }}</p>
                            <div class="tags">
                                @foreach($project->getTechStackArray() as $tech)
                                    <span class="tag">{{ $tech }}</span>
                                @endforeach
                            </div>
                            <div class="project-links d-flex gap-3">
                                @if($project->live_link)
                                    <a href="{{ $project->live_link }}" target="_blank" class="card-link">
                                        <i class="bi bi-box-arrow-up-right"></i> {{ __('messages.live_demo') }} →
                                    </a>
                                @endif
                                @if($project->github_link)
                                    <a href="{{ $project->github_link }}" target="_blank" class="card-link" style="color: #94a3b8;">
                                        <i class="bi bi-github"></i> {{ __('messages.source') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state" style="grid-column: 1 / -1;">
                        <i class="bi bi-folder-plus"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_projects') }}</p>
                    <p>{{ __('messages.no_projects_desc') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section section-padding" id="testimonials">
        <div class="container">                            <div class="section-title reveal">
                <div class="line"></div>
                <h2>{{ __('messages.testimonials_title') }}</h2>
                <p>{{ __('messages.testimonials_subtitle') }}</p>
            </div>

            @if($testimonials->isNotEmpty())
                <div class="testimonial-carousel reveal">
                    <div class="testimonial-track" id="testimonialTrack">
                        @foreach($testimonials as $testimonial)
                            <div class="testimonial-card">
                                <div class="quote-icon"><i class="bi bi-quote"></i></div>
                                <div class="testimonial-stars">
                                    @foreach($testimonial->stars as $filled)
                                        <i class="bi {{ $filled ? 'bi-star-fill' : 'bi-star' }}"></i>
                                    @endforeach
                                </div>
                                <p class="testimonial-text">"{{ $testimonial->message }}"</p>
                                <div class="testimonial-author">
                                    <div class="author-avatar">
                                        @if($testimonial->avatar)
                                            <img src="{{ config('app.storage_url') }}{{ $testimonial->avatar }}"
                                                 alt="{{ $testimonial->name }}">
                                        @else
                                            <div class="avatar-fallback">
                                                {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="author-info">
                                        <div class="author-name">{{ $testimonial->name }}</div>
                                        <div class="author-designation">{{ $testimonial->designation_display }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="carousel-controls">
                        <button class="carousel-btn carousel-prev" id="testPrev" aria-label="Previous">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <div class="carousel-dots" id="testDots"></div>
                        <button class="carousel-btn carousel-next" id="testNext" aria-label="Next">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>
            @else
                <div class="empty-state reveal">
                    <i class="bi bi-chat-quote"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_testimonials') }}</p>
                    <p>{{ __('messages.no_testimonials_desc') }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section section-padding" id="contact">
        <div class="container">
            <div class="section-title reveal">
                <div class="line"></div>
                <h2>{{ __('messages.contact_title') }}</h2>
                <p>{{ __('messages.contact_subtitle') }}</p>
            </div>
            <div class="contact-grid">
                <div class="contact-info reveal reveal-delay-1">
                    <h3>{{ __('messages.contact_heading') }}</h3>
                    <p>{{ __('messages.contact_desc') }}</p>

                    <div class="contact-item">
                        <div class="icon-box"><i class="bi bi-envelope-fill"></i></div>
                        <div class="text">
                            <div class="label">{{ __('messages.email_label') }}</div>
                            <div class="value">{{ $account->email ?? 'joty@example.com' }}</div>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="icon-box"><i class="bi bi-phone-fill"></i></div>
                        <div class="text">
                            <div class="label">{{ __('messages.phone_label') }}</div>
                            <div class="value">{{ $account->phone ?? '+880 1XXX-XXXXXX' }}</div>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="icon-box"><i class="bi bi-geo-alt-fill"></i></div>
                        <div class="text">
                            <div class="label">{{ __('messages.location_label') }}</div>
                            <div class="value">Bangladesh</div>
                        </div>
                    </div>
                </div>

                <div class="contact-form reveal reveal-delay-2">
                    <form action="{{ url('/contactus') }}" method="POST" id="contactForm">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('messages.your_name') }}</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('messages.name_placeholder') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('messages.your_email') }}</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="{{ __('messages.email_placeholder') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="message">{{ __('messages.your_message') }}</label>
                            <textarea id="message" name="message" class="form-control" placeholder="{{ __('messages.message_placeholder') }}" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn-submit magnetic">
                            <i class="bi bi-rocket-fill"></i> {{ __('messages.send_message') }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Google Map -->
            <div class="map-wrapper reveal reveal-delay-1">
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3749427.7985686358!2d88.0190403004489!3d23.684993584973406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30ada8e30e97f93d%3A0x8e70e7e2225e28a2!2sBangladesh!5e0!3m2!1sen!2sbd!4v1!4m2!3m1!1s0x30ada8e30e97f93d%3A0x8e70e7e2225e28a2"
                        width="100%" height="350" style="border:0; border-radius: 16px;"
                        allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Location Map">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section section-padding" id="faq">
        <div class="container">
            <div class="section-title reveal">
                <div class="line"></div>
                <h2>{{ __('messages.faq_title') }}</h2>
                <p>{{ __('messages.faq_subtitle') }}</p>
            </div>

            @if($faqs->isNotEmpty())
                <div class="faq-list reveal" style="max-width: 800px; margin: 0 auto;">
                    @foreach($faqs as $index => $faq)
                        <div class="faq-item" style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-md); margin-bottom: 1rem; overflow: hidden; transition: var(--transition);">
                            <button class="faq-question" 
                                    onclick="toggleFaq(this)"
                                    style="width: 100%; padding: 1.2rem 1.5rem; background: none; border: none; color: var(--text-primary); font-size: 0.98rem; font-weight: 600; text-align: left; cursor: pointer; display: flex; justify-content: space-between; align-items: center; gap: 1rem; font-family: var(--font); transition: var(--transition);">
                                <span>{{ $faq->question }}</span>
                                <i class="bi bi-chevron-down" style="font-size: 0.8rem; color: var(--accent); transition: transform 0.3s ease; flex-shrink: 0;"></i>
                            </button>
                            <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: max-height 0.4s cubic-bezier(0.16, 1, 0.3, 1), padding 0.4s ease; padding: 0 1.5rem;">
                                <p style="color: var(--text-secondary); font-size: 0.9rem; line-height: 1.8; padding-bottom: 1.2rem; margin: 0;">{{ $faq->answer }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <script>
                function toggleFaq(btn) {
                    var item = btn.parentElement;
                    var answer = item.querySelector('.faq-answer');
                    var icon = btn.querySelector('i');
                    var isOpen = answer.style.maxHeight && answer.style.maxHeight !== '0px';
                    
                    // Close all
                    document.querySelectorAll('.faq-item').forEach(function(el) {
                        el.querySelector('.faq-answer').style.maxHeight = '0';
                        el.querySelector('.faq-answer').style.padding = '0 1.5rem';
                        el.querySelector('i').style.transform = 'rotate(0deg)';
                        el.querySelector('.faq-question').style.color = 'var(--text-primary)';
                    });
                    
                    if (!isOpen) {
                        answer.style.maxHeight = answer.scrollHeight + 'px';
                        answer.style.padding = '0 1.5rem 0';
                        icon.style.transform = 'rotate(180deg)';
                        btn.style.color = 'var(--accent)';
                    }
                }
                </script>
            @else
                <div class="empty-state reveal">
                    <i class="bi bi-question-circle"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_faqs') }}</p>
                    <p>{{ __('messages.no_faqs_desc') }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-links">
            <a href="#about">About</a>
            <a href="#skills">Skills</a>
            <a href="#projects">Projects</a>
            <a href="#contact">Contact</a>
        </div>
        <p>© {{ date('Y') }} {{ $account->name }}. {{ __('messages.copyright') }} 
            <i class="bi bi-heart-fill" style="color: #ef4444;"></i> 
            {{ __('messages.and_lots_of') }} 
            <i class="bi bi-cup-fill" style="color: #f59e0b;"></i>
        </p>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $account->phone ?? '8801XXXXXXXXX') }}"
       target="_blank" rel="noopener noreferrer"
       class="whatsapp-float" id="whatsappFloat" aria-label="{{ __('messages.chat_whatsapp') }}">
        <i class="bi bi-whatsapp"></i>
        <span class="whatsapp-tooltip">{{ __('messages.chat_whatsapp') }}</span>
    </a>

    <!-- Back to Top -->
    <button class="back-to-top" id="backToTop" aria-label="{{ __('messages.back_to_top') }}">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- Scroll Progress Bar -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- Toast -->
    <div class="toast" id="toast">
        <i class="bi bi-check-circle-fill"></i> {{ __('messages.msg_sent') }}
    </div>

<script>
// ===== PARTICLES SYSTEM =====
(function() {
    const canvas = document.getElementById('particles-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let particles = [];
    let mouse = { x: 0, y: 0 };

    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);

    class Particle {
        constructor() { this.reset(); }
        reset() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.size = Math.random() * 2 + 0.5;
            this.speedX = (Math.random() - 0.5) * 0.4;
            this.speedY = (Math.random() - 0.5) * 0.4;
            this.opacity = Math.random() * 0.4 + 0.1;
        }
        update() {
            this.x += this.speedX;
            this.y += this.speedY;
            const dx = mouse.x - this.x;
            const dy = mouse.y - this.y;
            const dist = Math.sqrt(dx * dx + dy * dy);
            if (dist < 120) { this.x -= dx * 0.008; this.y -= dy * 0.008; }
            if (this.x < 0 || this.x > canvas.width || this.y < 0 || this.y > canvas.height) this.reset();
        }
        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fillStyle = 'rgba(59, 130, 246, ' + this.opacity + ')';
            ctx.fill();
        }
    }

    function initParticles() {
        particles = [];
        var count = Math.min(80, Math.floor((canvas.width * canvas.height) / 15000));
        for (var i = 0; i < count; i++) particles.push(new Particle());
    }
    initParticles();

    function connectParticles() {
        for (var i = 0; i < particles.length; i++) {
            for (var j = i + 1; j < particles.length; j++) {
                var dx = particles[i].x - particles[j].x;
                var dy = particles[i].y - particles[j].y;
                var dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < 150) {
                    ctx.beginPath();
                    ctx.strokeStyle = 'rgba(59, 130, 246, ' + (0.06 * (1 - dist / 150)) + ')';
                    ctx.lineWidth = 0.5;
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.stroke();
                }
            }
        }
    }

    function animateParticles() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (var i = 0; i < particles.length; i++) { particles[i].update(); particles[i].draw(); }
        connectParticles();
        requestAnimationFrame(animateParticles);
    }
    animateParticles();

    document.addEventListener('mousemove', function(e) { mouse.x = e.clientX; mouse.y = e.clientY; });
})();

// ===== CUSTOM CURSOR =====
(function() {
    var dot = document.getElementById('cursorDot');
    var ring = document.getElementById('cursorRing');
    if (!dot || !ring) return;
    document.addEventListener('mousemove', function(e) {
        dot.style.left = e.clientX + 'px';
        dot.style.top = e.clientY + 'px';
        ring.style.left = e.clientX + 'px';
        ring.style.top = e.clientY + 'px';
    });
    document.querySelectorAll('a, button, .magnetic, .project-card, .skill-card').forEach(function(el) {
        el.addEventListener('mouseenter', function() { ring.classList.add('active'); dot.classList.add('active'); });
        el.addEventListener('mouseleave', function() { ring.classList.remove('active'); dot.classList.remove('active'); });
    });
})();

// ===== TYPING EFFECT =====
(function() {
    var el = document.getElementById('typingText');
    if (!el) return;
    var texts = [
        'Full Stack Web Developer',
        'Laravel Specialist',
        'UI/UX Designer',
        'Problem Solver',
        'Freelancer'
    ];
    var textIndex = 0, charIndex = 0, isDeleting = false;
    function typeEffect() {
        var currentText = texts[textIndex];
        if (!isDeleting) {
            el.textContent = currentText.substring(0, charIndex + 1);
            charIndex++;
            if (charIndex === currentText.length) { isDeleting = true; setTimeout(typeEffect, 2000); return; }
        } else {
            el.textContent = currentText.substring(0, charIndex - 1);
            charIndex--;
            if (charIndex === 0) { isDeleting = false; textIndex = (textIndex + 1) % texts.length; }
        }
        setTimeout(typeEffect, isDeleting ? 40 : 80);
    }
    typeEffect();
})();

// ===== NAVBAR SCROLL =====
(function() {
    var navbar = document.getElementById('navbar');
    var backToTop = document.getElementById('backToTop');
    if (!navbar) return;
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) navbar.classList.add('scrolled');
        else navbar.classList.remove('scrolled');
        if (backToTop) {
            if (window.scrollY > 400) backToTop.classList.add('visible');
            else backToTop.classList.remove('visible');
        }
    });
})();

// ===== MOBILE MENU =====
(function() {
    var hamburger = document.getElementById('hamburger');
    var navLinks = document.getElementById('navLinks');
    if (!hamburger || !navLinks) return;
    hamburger.addEventListener('click', function() {
        hamburger.classList.toggle('active');
        navLinks.classList.toggle('open');
    });
    navLinks.querySelectorAll('a').forEach(function(link) {
        link.addEventListener('click', function() {
            hamburger.classList.remove('active');
            navLinks.classList.remove('open');
        });
    });
})();

// ===== SCROLL REVEAL =====
(function() {
    var elements = document.querySelectorAll('.reveal');
    function checkReveal() {
        for (var i = 0; i < elements.length; i++) {
            var top = elements[i].getBoundingClientRect().top;
            if (top < window.innerHeight - 80) elements[i].classList.add('active');
        }
    }
    window.addEventListener('scroll', checkReveal);
    window.addEventListener('load', checkReveal);
    window.addEventListener('resize', checkReveal);
})();

// ===== COUNTER ANIMATION =====
(function() {
    function animateCounters() {
        document.querySelectorAll('.stat-item .number').forEach(function(el) {
            var target = parseInt(el.getAttribute('data-count'));
            var rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight && !el.dataset.animated) {
                el.dataset.animated = 'true';
                var count = 0;
                var step = Math.ceil(target / 60);
                var interval = setInterval(function() {
                    count += step;
                    if (count >= target) { count = target; clearInterval(interval); }
                    el.textContent = count + '+';
                }, 30);
            }
        });
    }
    window.addEventListener('scroll', animateCounters);
    window.addEventListener('load', animateCounters);
})();

// ===== SKILL BAR ANIMATION =====
(function() {
    function animateSkillBars() {
        document.querySelectorAll('.bar-fill').forEach(function(bar) {
            var rect = bar.getBoundingClientRect();
            if (rect.top < window.innerHeight && !bar.dataset.animated) {
                bar.dataset.animated = 'true';
                setTimeout(function() { bar.style.width = bar.getAttribute('data-width'); }, 300);
            }
        });
    }
    window.addEventListener('scroll', animateSkillBars);
    window.addEventListener('load', animateSkillBars);
})();

// ===== PROJECT CARD TILT =====
(function() {
    document.querySelectorAll('.project-card').forEach(function(card) {
        card.addEventListener('mousemove', function(e) {
            var rect = card.getBoundingClientRect();
            var x = e.clientX - rect.left;
            var y = e.clientY - rect.top;
            var rotateX = (y - rect.height/2) / 20;
            var rotateY = (rect.width/2 - x) / 20;
            card.style.transform = 'perspective(1000px) rotateX(' + rotateX + 'deg) rotateY(' + rotateY + 'deg) translateY(-8px)';
        });
        card.addEventListener('mouseleave', function() {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
        });
    });
})();

// ===== SMOOTH ANCHOR SCROLL =====
(function() {
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                var pos = target.getBoundingClientRect().top + window.scrollY - 80;
                window.scrollTo({ top: pos, behavior: 'smooth' });
            }
        });
    });
})();

// ===== MAGNETIC BUTTON EFFECT =====
(function() {
    document.querySelectorAll('.magnetic').forEach(function(btn) {
        btn.addEventListener('mousemove', function(e) {
            var rect = btn.getBoundingClientRect();
            var x = e.clientX - rect.left - rect.width/2;
            var y = e.clientY - rect.top - rect.height/2;
            btn.style.transform = 'translate(' + (x*0.2) + 'px, ' + (y*0.2) + 'px)';
        });
        btn.addEventListener('mouseleave', function() { btn.style.transform = 'translate(0, 0)'; });
    });
})();

// ===== TESTIMONIAL CAROUSEL =====
(function() {
    var track = document.getElementById('testimonialTrack');
    var dotsContainer = document.getElementById('testDots');
    var prevBtn = document.getElementById('testPrev');
    var nextBtn = document.getElementById('testNext');
    if (!track) return;
    var cards = track.querySelectorAll('.testimonial-card');
    var total = cards.length;
    if (total <= 1) return;
    var currentIndex = 0;
    var autoInterval;

    for (var i = 0; i < total; i++) {
        var dot = document.createElement('span');
        dot.className = 'dot' + (i === 0 ? ' active' : '');
        (function(idx) { dot.addEventListener('click', function() { goToSlide(idx); }); })(i);
        dotsContainer.appendChild(dot);
    }

    function goToSlide(index) {
        currentIndex = index;
        track.style.transform = 'translateX(-' + (index * 100) + '%)';
        dotsContainer.querySelectorAll('.dot').forEach(function(d, i) { d.classList.toggle('active', i === index); });
    }
    function startAutoPlay() { autoInterval = setInterval(function() { goToSlide(currentIndex === total - 1 ? 0 : currentIndex + 1); }, 5000); }
    function stopAutoPlay() { clearInterval(autoInterval); }

    prevBtn.addEventListener('click', function() { stopAutoPlay(); goToSlide(currentIndex === 0 ? total - 1 : currentIndex - 1); startAutoPlay(); });
    nextBtn.addEventListener('click', function() { stopAutoPlay(); goToSlide(currentIndex === total - 1 ? 0 : currentIndex + 1); startAutoPlay(); });

    var carousel = document.querySelector('.testimonial-carousel');
    carousel.addEventListener('mouseenter', stopAutoPlay);
    carousel.addEventListener('mouseleave', startAutoPlay);
    startAutoPlay();
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') prevBtn.click();
        if (e.key === 'ArrowRight') nextBtn.click();
    });
})();

// ===== CONTACT FORM AJAX =====
(function() {
    var form = document.getElementById('contactForm');
    if (!form) return;
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(form);
        var btn = form.querySelector('.btn-submit');
        var origText = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Sending...';
        btn.disabled = true;

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(async function(response) {
            if (!response.ok) { var err = await response.json(); throw err; }
            return response.text();
        })
        .then(function() {
            var toast = document.getElementById('toast');
            if (toast) { toast.classList.add('show'); setTimeout(function() { toast.classList.remove('show'); }, 3000); }
            form.reset();
        })
        .catch(function(error) { console.error('Error:', error); alert('Message send failed!'); })
        .finally(function() { btn.innerHTML = origText; btn.disabled = false; });
    });
})();

// ===== SCROLL PROGRESS BAR =====
(function() {
    var bar = document.getElementById('scrollProgress');
    if (!bar) return;
    window.addEventListener('scroll', function() {
        var scrollTop = window.scrollY;
        var docHeight = document.documentElement.scrollHeight - window.innerHeight;
        var progress = (scrollTop / docHeight) * 100;
        bar.style.width = progress + '%';
    });
})();

// ===== PROJECT FILTER TABS =====
(function() {
    var filterBtns = document.querySelectorAll('.filter-btn');
    var projectCards = document.querySelectorAll('.project-card');
    if (!filterBtns.length || !projectCards.length) return;

    filterBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            filterBtns.forEach(function(b) { b.classList.remove('active'); });
            this.classList.add('active');
            var filter = this.getAttribute('data-filter');

            projectCards.forEach(function(card) {
                if (filter === 'all') {
                    card.style.display = '';
                    card.style.opacity = '1';
                } else {
                    var techs = (card.getAttribute('data-tech') || '').toLowerCase().split(' ');
                    if (techs.indexOf(filter) > -1) {
                        card.style.display = '';
                        card.style.opacity = '1';
                    } else {
                        card.style.display = 'none';
                    }
                }
                // Re-trigger reveal animation
                card.classList.remove('active');
                setTimeout(function() { card.classList.add('active'); }, 50);
            });
        });
    });
})();

</script>
@endsection
