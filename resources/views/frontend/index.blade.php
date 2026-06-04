@extends('frontend.app')

@section('content')

<!-- Custom Cursor -->
    <div class="cursor-dot" id="cursorDot"></div>
    <div class="cursor-ring" id="cursorRing"></div>

    <!-- Particles Canvas -->
    <canvas id="particles-canvas"></canvas>

    <!-- Hero Section -->
        <section class="hero" id="hero">
        <div class="hero-content">
            <div class="hero-badge"><i class="bi bi-briefcase-fill"></i> Available for Freelance Work</div>
                <h1>Hi, I'm <span class="gradient-text">{{ $account->name }}</span></h1>
            <div class="typing-wrapper">
                <span id="typingText"></span>
                <span class="typing-cursor"></span>
            </div>
            <p>I build responsive and dynamic web applications using Laravel, PHP, JavaScript, and modern web technologies. Passionate about coding and designing user-friendly interfaces.</p>
            <div class="hero-buttons">
                <a href="#projects" class="btn-primary-custom magnetic">
                    <i class="bi bi-rocket-fill"></i> See My Work
                </a>
                <a href="#contact" class="btn-outline-custom magnetic">
                    <i class="bi bi-chat-dots-fill"></i> Contact Me
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
            <h2>About Me</h2>
            <p>Get to know me better</p>
        </div>
        <div class="about-grid">
            <div class="about-image reveal reveal-delay-1">
                <div class="glow-ring"></div>
                <div class="img-wrapper">
                    <img src="{{ config('app.storage_url') }}{{ $account->image }}" alt="{{ $account->name }}" style="width: 100%; height: auto; border-radius: 60%;">
                </div>
            </div>
            <div class="about-text reveal reveal-delay-2">
                <h3>Full Stack Web Developer & Designer</h3>
                <p>Hi, I'm <strong style="color: #3b82f6;">{{ $account->name }}</strong>. I specialize in building responsive and dynamic web applications using cutting-edge technologies. With a keen eye for design and a passion for clean code, I create digital experiences that users love.</p>
                <p>My toolkit includes Laravel, PHP, JavaScript, React, and modern CSS frameworks. I believe in writing maintainable code and creating intuitive user interfaces that drive results.</p>
                <div class="about-stats">
                    <div class="stat-item">
                        <div class="number" data-count="50">0</div>
                        <div class="label">Projects</div>
                    </div>
                    <div class="stat-item">
                        <div class="number" data-count="30">0</div>
                        <div class="label">Clients</div>
                    </div>
                    <div class="stat-item">
                        <div class="number" data-count="3">0</div>
                        <div class="label">Years Exp</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Skills Section -->
   <section class="skills-section section-padding" id="skills">
    <div class="container">
        <div class="section-title reveal">
            <div class="line"></div>
            <h2>My Skills</h2>
            <p>Technologies I work with</p>
        </div>
        <div class="skills-grid">
            <div class="skill-card reveal reveal-delay-1" data-skill="95">
                <span class="icon"><i class="bi bi-globe2"></i></span>
                <span class="name">HTML/CSS</span>
                <div class="bar-wrapper"><div class="bar-fill" data-width="95%"></div></div>
            </div>
            <div class="skill-card reveal reveal-delay-1" data-skill="90">
                <span class="icon"><i class="bi bi-lightning-fill"></i></span>
                <span class="name">JavaScript</span>
                <div class="bar-wrapper"><div class="bar-fill" data-width="90%"></div></div>
            </div>
            <div class="skill-card reveal reveal-delay-2" data-skill="92">
                <span class="icon"><i class="bi bi-fire"></i></span>
                <span class="name">Laravel</span>
                <div class="bar-wrapper"><div class="bar-fill" data-width="92%"></div></div>
            </div>
            <div class="skill-card reveal reveal-delay-2" data-skill="88">
                <span class="icon"><i class="bi bi-code-slash"></i></span>
                <span class="name">PHP</span>
                <div class="bar-wrapper"><div class="bar-fill" data-width="88%"></div></div>
            </div>
            <div class="skill-card reveal reveal-delay-3" data-skill="85">
                <span class="icon"><i class="bi bi-recycle"></i></span>
                <span class="name">React</span>
                <div class="bar-wrapper"><div class="bar-fill" data-width="85%"></div></div>
            </div>
            <div class="skill-card reveal reveal-delay-3" data-skill="80">
                <span class="icon"><i class="bi bi-server"></i></span>
                <span class="name">MySQL</span>
                <div class="bar-wrapper"><div class="bar-fill" data-width="80%"></div></div>
            </div>
            <div class="skill-card reveal reveal-delay-4" data-skill="82">
                <span class="icon"><i class="bi bi-palette-fill"></i></span>
                <span class="name">Bootstrap</span>
                <div class="bar-wrapper"><div class="bar-fill" data-width="82%"></div></div>
            </div>
        </div>
    </div>
</section>

    <!-- Projects Section -->
    <section class="projects-section section-padding" id="projects">
    <div class="container">
        <div class="section-title reveal">
            <div class="line"></div>
            <h2>My Projects</h2>
            <p>Some of my recent work</p>
        </div>
        <div class="projects-grid">
            @forelse($projects as $index => $project)
                @php
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
                <div class="project-card reveal reveal-delay-{{ $delay }}">
                    <div class="card-image" style="background: {{ $gradients[$index % count($gradients)] }};">
                        @if($project->image)
                            <img src="{{ config('app.storage_url') }}{{ $project->image }}"
                                 alt="{{ $project->title }} screenshot"
                                 style="width: 100%; height: 100%; object-fit: cover; opacity: 0.8;">
                            <div style="position:absolute; bottom:0; left:0; right:0; height:60px; background:linear-gradient(transparent, #1e293b);"></div>
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
                                    <i class="bi bi-box-arrow-up-right"></i> Live Demo →
                                </a>
                            @endif
                            @if($project->github_link)
                                <a href="{{ $project->github_link }}" target="_blank" class="card-link" style="color: #94a3b8;">
                                    <i class="bi bi-github"></i> Source
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5" style="grid-column: 1 / -1;">
                    <i class="bi bi-folder-plus fs-1 text-muted mb-3 d-block"></i>
                    <p class="text-muted">No projects to display yet. Check back soon!</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

    <!-- Testimonials Section -->
    <section class="testimonials-section section-padding" id="testimonials">
    <div class="container">
        <div class="section-title reveal">
            <div class="line"></div>
            <h2>What Clients Say</h2>
            <p>Testimonials from people I've worked with</p>
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

                <!-- Controls -->
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
            <div class="text-center py-4 reveal">
                <i class="bi bi-chat-quote fs-1 text-muted mb-3 d-block"></i>
                <p class="text-muted">Testimonials coming soon!</p>
            </div>
        @endif
    </div>
</section>

    <!-- Contact Section -->
    <section class="contact-section section-padding" id="contact">
    <div class="container">
        <div class="section-title reveal">
            <div class="line"></div>
            <h2>Contact Me</h2>
            <p>Feel free to reach out for projects or collaborations</p>
        </div>
        <div class="contact-grid">
            <div class="contact-info reveal reveal-delay-1">
                <h3>Let's work together!</h3>
                <p>I'm always open to discussing new projects, creative ideas, or opportunities to be part of your vision. Let's build something amazing together.</p>

                <div class="contact-item">
                    <div class="icon-box"><i class="bi bi-envelope-fill"></i></div>
                    <div class="text">
                        <div class="label">Email</div>
                        <div class="value">joty@example.com</div>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="icon-box"><i class="bi bi-phone-fill"></i></div>
                    <div class="text">
                        <div class="label">Phone</div>
                        <div class="value">+880 1XXX-XXXXXX</div>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="icon-box"><i class="bi bi-geo-alt-fill"></i></div>
                    <div class="text">
                        <div class="label">Location</div>
                        <div class="value">Bangladesh</div>
                    </div>
                </div>
            </div>

            <div class="contact-form reveal reveal-delay-2">
                <form action="{{ url('/contactus') }}" method="POST" id="contactForm">
                    @csrf

                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text"
                            id="name"
                            name="name"
                            class="form-control"
                            placeholder="Enter your name"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            placeholder="Enter your email"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message"
                                name="message"
                                class="form-control"
                                placeholder="Write your message..."
                                rows="4"
                                required></textarea>
                    </div>

                    <button type="submit" class="btn-submit magnetic">
                        <i class="bi bi-rocket-fill"></i> Send Message
                    </button>
                </form>
            </div>
        </div>
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
    <p>© 2025 Joty Biswas. Made with 
        <i class="bi bi-heart-fill text-danger"></i> 
        and lots of 
        <i class="bi bi-cup-fill"></i>
    </p>
</footer>

<!-- Back to Top -->
<button class="back-to-top" id="backToTop" onclick="window.scrollTo({top:0})">
    <i class="bi bi-arrow-up"></i>
</button>

<!-- Toast -->
<div class="toast" id="toast">
    <i class="bi bi-check-circle-fill text-success"></i> Message sent successfully!
</div>


<style>
        /* ===== RESET & BASE ===== */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            background: #0f172a;
            color: #e2e8f0;
            overflow-x: hidden;
        }
        a { text-decoration: none; color: inherit; }

        /* ===== ANIMATED BACKGROUND PARTICLES ===== */
        #particles-canvas {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: 0;
            pointer-events: none;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(59, 130, 246, 0.1);
            transition: all 0.3s ease;
        }
        .navbar.scrolled {
            padding: 0.6rem 2rem;
            background: rgba(15, 23, 42, 0.95);
            border-bottom: 1px solid rgba(59, 130, 246, 0.3);
        }
        .nav-logo {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #3b82f6, #60a5fa, #93c5fd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .nav-links { display: flex; gap: 2rem; list-style: none; }
        .nav-links a {
            color: #94a3b8;
            font-weight: 500;
            font-size: 0.9rem;
            transition: color 0.3s ease;
            position: relative;
        }
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px; left: 0;
            width: 0; height: 2px;
            background: #3b82f6;
            transition: width 0.3s ease;
        }
        .nav-links a:hover { color: #3b82f6; }
        .nav-links a:hover::after { width: 100%; }

        .hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; z-index: 1001; }
        .hamburger span { width: 25px; height: 2px; background: #e2e8f0; transition: all 0.3s ease; }

        /* ===== HERO SECTION ===== */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            z-index: 1;
            padding: 2rem;
        }
        .hero-content { max-width: 800px; }

        /* Glowing orb behind hero */
        .hero::before {
            content: '';
            position: absolute;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.15), transparent 70%);
            border-radius: 50%;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            animation: pulseOrb 4s ease-in-out infinite;
        }
        @keyframes pulseOrb {
            0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.5; }
            50% { transform: translate(-50%, -50%) scale(1.2); opacity: 1; }
        }

        .hero-badge {
            display: inline-block;
            padding: 0.4rem 1.2rem;
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.3);
            border-radius: 50px;
            font-size: 0.85rem;
            color: #60a5fa;
            margin-bottom: 1.5rem;
            animation: fadeInDown 0.8s ease forwards;
            opacity: 0;
        }

        .hero h1 {
            font-size: clamp(2.5rem, 6vw, 5rem);
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 1rem;
            animation: fadeInUp 1s ease forwards;
            opacity: 0;
            animation-delay: 0.2s;
        }
        .hero h1 .gradient-text {
            background: linear-gradient(135deg, #3b82f6, #60a5fa, #a78bfa, #3b82f6);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientShift 4s ease infinite;
        }
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .hero p {
            font-size: 1.2rem;
            color: #94a3b8;
            max-width: 600px;
            margin: 0 auto 2rem;
            animation: fadeInUp 1s ease forwards;
            opacity: 0;
            animation-delay: 0.4s;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 1s ease forwards;
            opacity: 0;
            animation-delay: 0.6s;
        }

        /* Typing effect */
        .typing-wrapper {
            display: inline-flex;
            align-items: center;
            gap: 2px;
            color: #60a5fa;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            animation: fadeInUp 1s ease forwards;
            opacity: 0;
            animation-delay: 0.3s;
        }
        .typing-cursor {
            width: 2px; height: 1.3em;
            background: #3b82f6;
            animation: blink 0.8s step-end infinite;
        }
        @keyframes blink { 50% { opacity: 0; } }

        /* Scroll indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
        }
        .scroll-indicator .mouse {
            width: 26px; height: 40px;
            border: 2px solid rgba(59, 130, 246, 0.5);
            border-radius: 15px;
            display: flex;
            justify-content: center;
            padding-top: 8px;
        }
        .scroll-indicator .wheel {
            width: 3px; height: 8px;
            background: #3b82f6;
            border-radius: 3px;
            animation: scrollWheel 1.5s infinite;
        }
        @keyframes scrollWheel {
            0% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(10px); }
        }
        @keyframes bounce {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50% { transform: translateX(-50%) translateY(-10px); }
        }

        /* ===== BUTTONS ===== */
        .btn-primary-custom {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.8rem 2rem;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .btn-primary-custom::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }
        .btn-primary-custom:hover::before { left: 100%; }
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 40px rgba(59, 130, 246, 0.4);
        }

        .btn-outline-custom {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.8rem 2rem;
            background: transparent;
            color: #3b82f6;
            border: 2px solid rgba(59, 130, 246, 0.5);
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-outline-custom:hover {
            background: rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
            transform: translateY(-3px);
        }

        /* ===== SECTIONS COMMON ===== */
        section { position: relative; z-index: 1; }
        .section-padding { padding: 6rem 2rem; }
        .container { max-width: 1200px; margin: 0 auto; }
        .section-title {
            text-align: center;
            margin-bottom: 4rem;
        }
        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }
        .section-title .line {
            width: 60px; height: 4px;
            background: linear-gradient(90deg, #3b82f6, #60a5fa);
            margin: 0 auto 1rem;
            border-radius: 2px;
        }
        .section-title p { color: #94a3b8; font-size: 1.1rem; }

        /* ===== ABOUT SECTION ===== */
        .about-section { background: #0f172a; }
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }
        .about-image {
            position: relative;
            display: flex;
            justify-content: center;
        }
        .about-image .img-wrapper {
            width: 300px; height: 300px;
            border-radius: 30px;
            overflow: hidden;
            border: 3px solid rgba(59, 130, 246, 0.3);
            position: relative;
            background: linear-gradient(135deg, #1e293b, #0f172a);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8rem;
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            33% { transform: translateY(-10px) rotate(1deg); }
            66% { transform: translateY(5px) rotate(-1deg); }
        }
        .about-image .glow-ring {
            position: absolute;
            width: 320px; height: 320px;
            border-radius: 30px;
            border: 2px solid rgba(59, 130, 246, 0.2);
            animation: rotateRing 8s linear infinite;
        }
        @keyframes rotateRing {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .about-text h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .about-text p {
            color: #94a3b8;
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }
        .about-stats {
            display: flex;
            gap: 2rem;
            margin-top: 2rem;
        }
        .stat-item {
            text-align: center;
            padding: 1rem 1.5rem;
            background: rgba(59, 130, 246, 0.05);
            border: 1px solid rgba(59, 130, 246, 0.1);
            border-radius: 16px;
            transition: all 0.3s ease;
        }
        .stat-item:hover {
            transform: translateY(-5px);
            border-color: rgba(59, 130, 246, 0.4);
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.1);
        }
        .stat-item .number {
            font-size: 2rem;
            font-weight: 800;
            color: #3b82f6;
        }
        .stat-item .label {
            font-size: 0.85rem;
            color: #64748b;
            margin-top: 0.3rem;
        }

        /* ===== SKILLS ===== */
        .skills-section {
            background: linear-gradient(180deg, #0f172a 0%, #0c1322 100%);
        }
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 1.5rem;
        }
        .skill-card {
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(59, 130, 246, 0.1);
            border-radius: 16px;
            padding: 2rem 1rem;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: default;
        }
        .skill-card:hover {
            transform: translateY(-10px) scale(1.05);
            border-color: #3b82f6;
            background: rgba(59, 130, 246, 0.08);
            box-shadow: 0 20px 60px rgba(59, 130, 246, 0.15);
        }
        .skill-card .icon {
            font-size: 2.5rem;
            margin-bottom: 0.8rem;
            display: block;
        }
        .skill-card .name {
            font-weight: 600;
            font-size: 0.9rem;
        }
        .skill-card .bar-wrapper {
            margin-top: 0.8rem;
            background: rgba(59, 130, 246, 0.1);
            border-radius: 10px;
            height: 4px;
            overflow: hidden;
        }
        .skill-card .bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #3b82f6, #60a5fa);
            border-radius: 10px;
            width: 0;
            transition: width 1.5s ease;
        }

        /* ===== PROJECTS ===== */
        .projects-section { background: #0f172a; }
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }
        .project-card {
            background: linear-gradient(145deg, #1e293b, #162032);
            border: 1px solid rgba(59, 130, 246, 0.1);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s ease;
            position: relative;
        }
        .project-card:hover {
            transform: translateY(-10px);
            border-color: rgba(59, 130, 246, 0.4);
            box-shadow: 0 25px 60px rgba(59, 130, 246, 0.15);
        }
        .project-card .card-image {
            height: 200px;
            background: linear-gradient(135deg, #1e3a5f, #0f172a);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .project-card .card-image .project-icon {
            font-size: 4rem;
            opacity: 0.6;
            transition: all 0.4s ease;
        }
        .project-card:hover .card-image .project-icon {
            transform: scale(1.2);
            opacity: 1;
        }
        .project-card .card-image::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 60px;
            background: linear-gradient(transparent, #1e293b);
        }
        .project-card .card-body { padding: 1.5rem; }
        .project-card .card-body h3 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .project-card .card-body p {
            color: #94a3b8;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1.2rem;
        }
        .project-card .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.2rem;
        }
        .project-card .tag {
            padding: 0.25rem 0.8rem;
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 20px;
            font-size: 0.75rem;
            color: #60a5fa;
        }
        .project-card .card-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: #3b82f6;
            font-weight: 600;
            font-size: 0.9rem;
            transition: gap 0.3s ease;
        }
        .project-card .card-link:hover { gap: 0.8rem; }

        /* ===== TESTIMONIALS ===== */
        .testimonials-section {
            background: linear-gradient(180deg, #0f172a 0%, #0c1322 100%);
        }
        .testimonial-carousel {
            max-width: 750px;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
        }
        .testimonial-track {
            display: flex;
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .testimonial-card {
            min-width: 100%;
            padding: 2.5rem 2rem;
            background: rgba(30, 41, 59, 0.4);
            border: 1px solid rgba(59, 130, 246, 0.1);
            border-radius: 24px;
            text-align: center;
            position: relative;
            transition: all 0.3s ease;
            margin: 0 0.5rem;
        }
        .testimonial-card:hover {
            border-color: rgba(59, 130, 246, 0.3);
            box-shadow: 0 20px 60px rgba(59, 130, 246, 0.08);
        }
        .quote-icon {
            font-size: 3rem;
            color: rgba(59, 130, 246, 0.2);
            margin-bottom: 0.5rem;
            line-height: 1;
        }
        .testimonial-stars {
            color: #f59e0b;
            margin-bottom: 1.2rem;
            font-size: 1.1rem;
            display: flex;
            justify-content: center;
            gap: 3px;
        }
        .testimonial-stars .bi-star {
            opacity: 0.3;
        }
        .testimonial-text {
            color: #cbd5e1;
            font-size: 1.05rem;
            line-height: 1.8;
            margin-bottom: 1.8rem;
            font-style: italic;
        }
        .testimonial-author {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }
        .author-avatar img {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(59, 130, 246, 0.3);
        }
        .avatar-fallback {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.3rem;
            color: #fff;
            border: 2px solid rgba(59, 130, 246, 0.3);
        }
        .author-name {
            font-weight: 700;
            color: #e2e8f0;
            font-size: 1rem;
        }
        .author-designation {
            font-size: 0.8rem;
            color: #64748b;
            margin-top: 2px;
        }

        .carousel-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 2rem;
        }
        .carousel-btn {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: 1px solid rgba(59, 130, 246, 0.3);
            background: rgba(30, 41, 59, 0.5);
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }
        .carousel-btn:hover {
            background: #3b82f6;
            border-color: #3b82f6;
            color: #fff;
            transform: scale(1.05);
        }
        .carousel-dots {
            display: flex;
            gap: 8px;
        }
        .carousel-dots .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.2);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .carousel-dots .dot.active {
            background: #3b82f6;
            width: 28px;
            border-radius: 5px;
        }

        /* ===== CONTACT ===== */
        .contact-section {
            background: linear-gradient(180deg, #0c1322, #0f172a);
        }
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 4rem;
            align-items: start;
        }
        .contact-info h3 {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .contact-info p {
            color: #94a3b8;
            line-height: 1.8;
            margin-bottom: 2rem;
        }
        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: rgba(30, 41, 59, 0.5);
            border-radius: 12px;
            border: 1px solid rgba(59, 130, 246, 0.1);
            transition: all 0.3s ease;
        }
        .contact-item:hover {
            border-color: rgba(59, 130, 246, 0.4);
            transform: translateX(10px);
        }
        .contact-item .icon-box {
            width: 45px; height: 45px;
            background: rgba(59, 130, 246, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        .contact-item .text .label { font-size: 0.8rem; color: #64748b; }
        .contact-item .text .value { font-weight: 600; margin-top: 0.2rem; }

        .contact-form {
            background: rgba(30, 41, 59, 0.3);
            border: 1px solid rgba(59, 130, 246, 0.1);
            border-radius: 20px;
            padding: 2.5rem;
        }
        .form-group { margin-bottom: 1.5rem; }
        .form-group label {
            display: block;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            color: #cbd5e1;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.9rem 1.2rem;
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(59, 130, 246, 0.15);
            border-radius: 12px;
            color: #e2e8f0;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            outline: none;
        }
        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .form-group textarea { resize: vertical; min-height: 120px; }

        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 40px rgba(59, 130, 246, 0.4);
        }
        .btn-submit::after {
            content: '';
            position: absolute;
            top: 50%; left: 50%;
            width: 0; height: 0;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            transition: all 0.5s ease;
            transform: translate(-50%, -50%);
        }
        .btn-submit:active::after {
            width: 400px; height: 400px;
        }

        /* ===== FOOTER ===== */
        .footer {
            background: #0a0f1e;
            border-top: 1px solid rgba(59, 130, 246, 0.1);
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }
        .footer-links a {
            color: #64748b;
            transition: color 0.3s ease;
            font-size: 0.9rem;
        }
        .footer-links a:hover { color: #3b82f6; }
        .footer p { color: #475569; font-size: 0.85rem; }
        .footer .heart { color: #3b82f6; }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .reveal {
            opacity: 0;
            transform: translateY(60px);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }
        .reveal-delay-4 { transition-delay: 0.4s; }

        /* ===== CUSTOM CURSOR ===== */
        .cursor-dot {
            width: 8px; height: 8px;
            background: #3b82f6;
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 9999;
            transition: transform 0.1s ease;
        }
        .cursor-ring {
            width: 35px; height: 35px;
            border: 2px solid rgba(59, 130, 246, 0.4);
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 9998;
            transition: all 0.15s ease-out;
        }

        /* ===== BACK TO TOP ===== */
        .back-to-top {
            position: fixed;
            bottom: 2rem; right: 2rem;
            width: 50px; height: 50px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            cursor: pointer;
            z-index: 100;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
            border: none;
            color: #fff;
            box-shadow: 0 5px 20px rgba(59, 130, 246, 0.3);
        }
        .back-to-top.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .back-to-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.5);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 968px) {
            .about-grid, .contact-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            .about-image { order: -1; }
            .projects-grid {
                grid-template-columns: 1fr;
            }
        }
        @media (max-width: 768px) {
            .nav-links {
                display: none;
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                background: rgba(15, 23, 42, 0.98);
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 2rem;
            }
            .nav-links.open { display: flex; }
            .nav-links a { font-size: 1.3rem; }
            .hamburger { display: flex; }
            .about-stats { flex-wrap: wrap; justify-content: center; }
            .cursor-dot, .cursor-ring { display: none; }
        }
        @media (max-width: 480px) {
            .skills-grid { grid-template-columns: repeat(2, 1fr); }
            .section-title h2 { font-size: 2rem; }
        }

        /* ===== TOAST ===== */
        .toast {
            position: fixed;
            bottom: 2rem; left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
            padding: 1rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            z-index: 10000;
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 10px 40px rgba(59, 130, 246, 0.3);
        }
        .toast.show {
            transform: translateX(-50%) translateY(0);
        }

        /* Magnetic effect for buttons */
        .magnetic { transition: transform 0.3s ease; }
    </style>

    <script>
        // ===== PARTICLES SYSTEM =====
        const canvas = document.getElementById('particles-canvas');
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
            constructor() {
                this.reset();
            }
            reset() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 2 + 0.5;
                this.speedX = (Math.random() - 0.5) * 0.5;
                this.speedY = (Math.random() - 0.5) * 0.5;
                this.opacity = Math.random() * 0.5 + 0.1;
            }
            update() {
                this.x += this.speedX;
                this.y += this.speedY;

                // Mouse interaction
                const dx = mouse.x - this.x;
                const dy = mouse.y - this.y;
                const dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < 120) {
                    this.x -= dx * 0.01;
                    this.y -= dy * 0.01;
                }

                if (this.x < 0 || this.x > canvas.width || this.y < 0 || this.y > canvas.height) {
                    this.reset();
                }
            }
            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(59, 130, 246, ${this.opacity})`;
                ctx.fill();
            }
        }

        function initParticles() {
            particles = [];
            const count = Math.min(80, Math.floor((canvas.width * canvas.height) / 15000));
            for (let i = 0; i < count; i++) {
                particles.push(new Particle());
            }
        }
        initParticles();

        function connectParticles() {
            for (let i = 0; i < particles.length; i++) {
                for (let j = i + 1; j < particles.length; j++) {
                    const dx = particles[i].x - particles[j].x;
                    const dy = particles[i].y - particles[j].y;
                    const dist = Math.sqrt(dx * dx + dy * dy);
                    if (dist < 150) {
                        ctx.beginPath();
                        ctx.strokeStyle = `rgba(59, 130, 246, ${0.08 * (1 - dist / 150)})`;
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
            particles.forEach(p => { p.update(); p.draw(); });
            connectParticles();
            requestAnimationFrame(animateParticles);
        }
        animateParticles();

        document.addEventListener('mousemove', e => {
            mouse.x = e.clientX;
            mouse.y = e.clientY;
        });

        // ===== CUSTOM CURSOR =====
        const cursorDot = document.getElementById('cursorDot');
        const cursorRing = document.getElementById('cursorRing');

        document.addEventListener('mousemove', e => {
            cursorDot.style.left = e.clientX - 4 + 'px';
            cursorDot.style.top = e.clientY - 4 + 'px';
            cursorRing.style.left = e.clientX - 17.5 + 'px';
            cursorRing.style.top = e.clientY - 17.5 + 'px';
        });

        document.querySelectorAll('a, button, .magnetic').forEach(el => {
            el.addEventListener('mouseenter', () => {
                cursorRing.style.transform = 'scale(1.5)';
                cursorRing.style.borderColor = 'rgba(59, 130, 246, 0.8)';
            });
            el.addEventListener('mouseleave', () => {
                cursorRing.style.transform = 'scale(1)';
                cursorRing.style.borderColor = 'rgba(59, 130, 246, 0.4)';
            });
        });

        // ===== TYPING EFFECT =====
        const typingTexts = [
            'Full Stack Web Developer',
            'Laravel Specialist',
            'UI/UX Designer',
            'Problem Solver',
            'Freelancer'
        ];
        let textIndex = 0, charIndex = 0, isDeleting = false;
        const typingEl = document.getElementById('typingText');

        function typeEffect() {
            const currentText = typingTexts[textIndex];
            if (!isDeleting) {
                typingEl.textContent = currentText.substring(0, charIndex + 1);
                charIndex++;
                if (charIndex === currentText.length) {
                    isDeleting = true;
                    setTimeout(typeEffect, 2000);
                    return;
                }
            } else {
                typingEl.textContent = currentText.substring(0, charIndex - 1);
                charIndex--;
                if (charIndex === 0) {
                    isDeleting = false;
                    textIndex = (textIndex + 1) % typingTexts.length;
                }
            }
            setTimeout(typeEffect, isDeleting ? 40 : 80);
        }
        typeEffect();

        // ===== NAVBAR SCROLL =====
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            const backToTop = document.getElementById('backToTop');

            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            if (window.scrollY > 400) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });

        // ===== HAMBURGER MENU =====
        function toggleMenu() {
            document.getElementById('navLinks').classList.toggle('open');
        }
        function closeMenu() {
            document.getElementById('navLinks').classList.remove('open');
        }

        // ===== SCROLL REVEAL =====
        const revealElements = document.querySelectorAll('.reveal');

        function checkReveal() {
            revealElements.forEach(el => {
                const top = el.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                if (top < windowHeight - 80) {
                    el.classList.add('active');
                }
            });
        }
        window.addEventListener('scroll', checkReveal);
        window.addEventListener('load', checkReveal);

        // ===== FORM SUBMIT (AJAX) =====
        document.getElementById('contactForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(async response => {
                if (!response.ok) {
                    const errorData = await response.json();
                    throw errorData;
                }
                return response.text();
            })
            .then(() => {
                //  success toast
                const toast = document.getElementById('toast');
                if (toast) {
                    toast.classList.add('show');
                    setTimeout(() => toast.classList.remove('show'), 3000);
                }

                //  form reset
                form.reset();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Message send failed!');
            });
        });

        // ===== COUNTER ANIMATION =====
        function animateCounters() {
            document.querySelectorAll('.stat-item .number').forEach(el => {
                const target = parseInt(el.getAttribute('data-count'));
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight && !el.dataset.animated) {
                    el.dataset.animated = 'true';
                    let count = 0;
                    const step = Math.ceil(target / 60);
                    const interval = setInterval(() => {
                        count += step;
                        if (count >= target) {
                            count = target;
                            clearInterval(interval);
                        }
                        el.textContent = count + '+';
                    }, 30);
                }
            });
        }
        window.addEventListener('scroll', animateCounters);

        // ===== SKILL BAR ANIMATION =====
        function animateSkillBars() {
            document.querySelectorAll('.bar-fill').forEach(bar => {
                const rect = bar.getBoundingClientRect();
                if (rect.top < window.innerHeight && !bar.dataset.animated) {
                    bar.dataset.animated = 'true';
                    setTimeout(() => {
                        bar.style.width = bar.getAttribute('data-width');
                    }, 300);
                }
            });
        }
        window.addEventListener('scroll', animateSkillBars);

        // ===== TILT EFFECT ON CARDS =====
        document.querySelectorAll('.project-card').forEach(card => {
            card.addEventListener('mousemove', e => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                const rotateX = (y - centerY) / 20;
                const rotateY = (centerX - x) / 20;
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-10px)`;
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
            });
        });

        // ===== SMOOTH ANCHOR SCROLL =====
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offset = 80;
                    const pos = target.getBoundingClientRect().top + window.scrollY - offset;
                    window.scrollTo({ top: pos, behavior: 'smooth' });
                }
            });
        });

        // ===== MAGNETIC BUTTON EFFECT =====
        document.querySelectorAll('.magnetic').forEach(btn => {
            btn.addEventListener('mousemove', e => {
                const rect = btn.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                btn.style.transform = `translate(${x * 0.2}px, ${y * 0.2}px)`;
            });
            btn.addEventListener('mouseleave', () => {
                btn.style.transform = 'translate(0, 0)';
            });
        });

        // ===== TESTIMONIAL CAROUSEL =====
        (function() {
            const track = document.getElementById('testimonialTrack');
            const dotsContainer = document.getElementById('testDots');
            const prevBtn = document.getElementById('testPrev');
            const nextBtn = document.getElementById('testNext');

            if (!track) return;

            const cards = track.querySelectorAll('.testimonial-card');
            const total = cards.length;
            if (total <= 1) return;

            let currentIndex = 0;

            // Create dots
            for (let i = 0; i < total; i++) {
                const dot = document.createElement('span');
                dot.className = 'dot' + (i === 0 ? ' active' : '');
                dot.addEventListener('click', () => goToSlide(i));
                dotsContainer.appendChild(dot);
            }

            function goToSlide(index) {
                currentIndex = index;
                track.style.transform = `translateX(-${index * 100}%)`;

                // Update dots
                dotsContainer.querySelectorAll('.dot').forEach((d, i) => {
                    d.classList.toggle('active', i === index);
                });
            }

            prevBtn.addEventListener('click', () => {
                goToSlide(currentIndex === 0 ? total - 1 : currentIndex - 1);
            });

            nextBtn.addEventListener('click', () => {
                goToSlide(currentIndex === total - 1 ? 0 : currentIndex + 1);
            });

            // Auto-advance every 5 seconds
            let autoInterval = setInterval(() => {
                goToSlide(currentIndex === total - 1 ? 0 : currentIndex + 1);
            }, 5000);

            // Pause on hover
            const carousel = document.querySelector('.testimonial-carousel');
            carousel.addEventListener('mouseenter', () => clearInterval(autoInterval));
            carousel.addEventListener('mouseleave', () => {
                autoInterval = setInterval(() => {
                    goToSlide(currentIndex === total - 1 ? 0 : currentIndex + 1);
                }, 5000);
            });

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') prevBtn.click();
                if (e.key === 'ArrowRight') nextBtn.click();
            });
        })();
    </script>
@endsection