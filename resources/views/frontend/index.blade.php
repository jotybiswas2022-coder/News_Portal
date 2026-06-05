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
                        <img src="{{ config('app.storage_url') }}{{ $account->image }}" alt="{{ $account->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 32px;">
                    </div>
                </div>
                <div class="about-text reveal reveal-delay-2">
                    <h3>Full Stack Web Developer & Designer</h3>
                    <p>Hi, I'm <strong style="color: var(--accent);">{{ $account->name }}</strong>. I specialize in building responsive and dynamic web applications using cutting-edge technologies. With a keen eye for design and a passion for clean code, I create digital experiences that users love.</p>
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

    <!-- Experience Timeline Section -->
    <section class="timeline-section section-padding" id="experience">
        <div class="container">
            <div class="section-title reveal">
                <div class="line"></div>
                <h2>Work Experience</h2>
                <p>My professional journey</p>
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
                                    <span class="current-badge">Current</span>
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
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">No Experience Yet</p>
                    <p>Experience details coming soon!</p>
                </div>
            @endif
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
                        <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">No Skills Added Yet</p>
                        <p>Skills data coming soon!</p>
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
                    <div class="empty-state" style="grid-column: 1 / -1;">
                        <i class="bi bi-folder-plus"></i>
                        <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">No Projects Yet</p>
                        <p>No projects to display yet. Check back soon!</p>
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
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">No Testimonials Yet</p>
                    <p>Testimonials coming soon!</p>
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
                            <div class="value">{{ $account->email ?? 'joty@example.com' }}</div>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="icon-box"><i class="bi bi-phone-fill"></i></div>
                        <div class="text">
                            <div class="label">Phone</div>
                            <div class="value">{{ $account->phone ?? '+880 1XXX-XXXXXX' }}</div>
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
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Your Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Your Message</label>
                            <textarea id="message" name="message" class="form-control" placeholder="Write your message..." rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn-submit magnetic">
                            <i class="bi bi-rocket-fill"></i> Send Message
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

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-links">
            <a href="#about">About</a>
            <a href="#skills">Skills</a>
            <a href="#projects">Projects</a>
            <a href="#contact">Contact</a>
        </div>
        <p>© {{ date('Y') }} {{ $account->name }}. Made with 
            <i class="bi bi-heart-fill" style="color: #ef4444;"></i> 
            and lots of 
            <i class="bi bi-cup-fill" style="color: #f59e0b;"></i>
        </p>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $account->phone ?? '8801XXXXXXXXX') }}"
       target="_blank" rel="noopener noreferrer"
       class="whatsapp-float" id="whatsappFloat" aria-label="Chat on WhatsApp">
        <i class="bi bi-whatsapp"></i>
        <span class="whatsapp-tooltip">Chat on WhatsApp</span>
    </a>

    <!-- Back to Top -->
    <button class="back-to-top" id="backToTop" onclick="window.scrollTo({top:0, behavior:'smooth'})" aria-label="Back to top">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- Toast -->
    <div class="toast" id="toast">
        <i class="bi bi-check-circle-fill"></i> Message sent successfully!
    </div>
@endsection
