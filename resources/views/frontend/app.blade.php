<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-KOKx7/j+fNU1R1H9lKDz9EwT5PpFKF4P4FQn8vHCEa8l/HzIhM+fq0Iu6iX2QzYeb6gi3W4Z2Zob/nkZfgF+pQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* ===== THEME SYSTEM ===== */
        :root {
            --theme-primary: #dc2626;
            --theme-primary-light: #ef4444;
            --theme-primary-dark: #b91c1c;
            --theme-bg: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            --theme-bg-card: rgba(255, 255, 255, 0.04);
            --theme-bg-card-solid: #ffffff;
            --theme-text: #374151;
            --theme-text-light: #6b7280;
            --theme-text-white: #ffffff;
            --theme-text-primary: #f5f5f5;
            --theme-border: rgba(255, 255, 255, 0.08);
            --theme-border-light: rgba(255, 255, 255, 0.06);
            --theme-border-input: rgba(255, 255, 255, 0.1);
            --theme-text-muted: rgba(255, 255, 255, 0.35);
            --theme-text-label: rgba(255, 255, 255, 0.7);
            --theme-nav-bg: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            --theme-nav-scrolled: rgba(26, 26, 46, 0.92);
            --theme-footer-bg: #1a1a2e;
            --theme-footer-bg-2: #16213e;
            --theme-btn-secondary-bg: rgba(255, 255, 255, 0.06);
            --theme-btn-secondary-border: rgba(255, 255, 255, 0.1);
            --theme-btn-secondary-text: rgba(255, 255, 255, 0.6);
            --theme-input-bg: rgba(255, 255, 255, 0.06);
            --theme-input-border: rgba(255, 255, 255, 0.1);
            --theme-input-text: #f5f5f5;
            --theme-input-placeholder: rgba(255, 255, 255, 0.2);
            --theme-input-icon: rgba(255, 255, 255, 0.25);
            --theme-card-shadow: 0 20px 60px rgba(0,0,0,0.3);
            --theme-hero-bg: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            --theme-skeleton-overlay: linear-gradient(135deg, #1a1a2e, #16213e, #0f3460);
            --theme-skeleton-shine: rgba(255,255,255,0.04);
            --theme-skeleton-shine-2: rgba(255,255,255,0.08);
        }

        .light-mode {
            --theme-bg: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #f0f0f5 100%);
            --theme-bg-card: rgba(255, 255, 255, 0.85);
            --theme-bg-card-solid: #ffffff;
            --theme-text: #1f2937;
            --theme-text-light: #6b7280;
            --theme-text-white: #1f2937;
            --theme-text-primary: #1f2937;
            --theme-border: rgba(0, 0, 0, 0.08);
            --theme-border-light: rgba(0, 0, 0, 0.05);
            --theme-border-input: rgba(0, 0, 0, 0.1);
            --theme-text-muted: rgba(0, 0, 0, 0.45);
            --theme-text-label: rgba(0, 0, 0, 0.6);
            --theme-nav-bg: linear-gradient(135deg, #ffffff 0%, #f8f9fa 50%, #f0f0f5 100%);
            --theme-nav-scrolled: rgba(255, 255, 255, 0.92);
            --theme-footer-bg: #1f2937;
            --theme-footer-bg-2: #111827;
            --theme-btn-secondary-bg: rgba(0, 0, 0, 0.04);
            --theme-btn-secondary-border: rgba(0, 0, 0, 0.1);
            --theme-btn-secondary-text: rgba(0, 0, 0, 0.5);
            --theme-input-bg: rgba(0, 0, 0, 0.03);
            --theme-input-border: rgba(0, 0, 0, 0.1);
            --theme-input-text: #1f2937;
            --theme-input-placeholder: rgba(0, 0, 0, 0.3);
            --theme-input-icon: rgba(0, 0, 0, 0.3);
            --theme-card-shadow: 0 20px 60px rgba(0,0,0,0.08);
            --theme-hero-bg: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #fef2f2 100%);
            --theme-skeleton-overlay: linear-gradient(135deg, #f8f9fa, #ffffff, #f0f0f5);
            --theme-skeleton-shine: rgba(0,0,0,0.04);
            --theme-skeleton-shine-2: rgba(0,0,0,0.08);
        }

        /* Smooth theme transition */
        body, .dark-navbar, .donor-hero, .profile-section, .edit-section,
        .profile-card, .edit-card, .footer, .profile-footer, .edit-footer,
        .blood-groups, .features, .why-donate, .contact-section, .filter-section,
        .donor-section, .filter-card, .donor-card, .contact-form-wrapper,
        .contact-info-card, .emergency-card, .blood-card, .feature-card,
        .info-item, .donation-status, .status-bar, .navbar-collapse,
        .alert-custom, .reset-info-badge, .form-group input, .form-group select,
        .form-group textarea, .input-group-custom input, .input-group-custom select,
        .search-wrap input, .select-wrap select, .btn-cancel, .btn-reset,
        .btn-back, .profile-footer, .edit-footer, .confirm-modal {
            transition: background 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                        background-color 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                        border-color 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                        color 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                        box-shadow 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ===== LOADING SKELETON BASE ===== */
        [data-skeleton] {
            background: linear-gradient(90deg, 
                var(--theme-skeleton-shine) 25%, 
                var(--theme-skeleton-shine-2) 50%, 
                var(--theme-skeleton-shine) 75%
            );
            background-size: 200% 100%;
            animation: skeleton-shimmer 1.5s ease-in-out infinite;
            border-radius: 6px;
            color: transparent !important;
            user-select: none;
            pointer-events: none;
        }

        @keyframes skeleton-shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        #skeleton-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: var(--theme-skeleton-overlay);
            overflow-y: auto;
            transition: opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #skeleton-overlay.skeleton-hidden {
            opacity: 0;
            pointer-events: none;
        }

        /* ===== SKELETON BLOCK TYPES ===== */
        .sk-circle {
            display: block;
            border-radius: 50%;
            background: linear-gradient(90deg, 
                var(--theme-skeleton-shine) 25%, 
                var(--theme-skeleton-shine-2) 50%, 
                var(--theme-skeleton-shine) 75%
            );
            background-size: 200% 100%;
            animation: skeleton-shimmer 1.5s ease-in-out infinite;
        }

        .sk-block {
            background: linear-gradient(90deg, 
                var(--theme-skeleton-shine) 25%, 
                var(--theme-skeleton-shine-2) 50%, 
                var(--theme-skeleton-shine) 75%
            );
            background-size: 200% 100%;
            animation: skeleton-shimmer 1.5s ease-in-out infinite;
            border-radius: 6px;
        }

        .sk-line {
            height: 14px;
            border-radius: 4px;
            background: linear-gradient(90deg, 
                var(--theme-skeleton-shine) 25%, 
                var(--theme-skeleton-shine-2) 50%, 
                var(--theme-skeleton-shine) 75%
            );
            background-size: 200% 100%;
            animation: skeleton-shimmer 1.5s ease-in-out infinite;
        }
    </style>
</head>
<body>

    {{-- ===== LOADING SKELETON OVERLAY ===== --}}
    <div id="skeleton-overlay">
        @hasSection('skeleton')
            @yield('skeleton')
        @else
            {{-- Default skeleton: simple centered pulse --}}
            <div style="display:flex;align-items:center;justify-content:center;min-height:100vh;padding-top:72px;">
                <div style="text-align:center;">
                    <div style="width:60px;height:60px;margin:0 auto 20px;border:3px solid rgba(239,68,68,0.15);border-top-color:#ef4444;border-radius:50%;animation:sk-spin 0.8s linear infinite;"></div>
                    <div style="width:140px;height:12px;border-radius:6px;margin:0 auto;background:rgba(255,255,255,0.06);"></div>
                </div>
            </div>
            <style>
                @keyframes sk-spin { to { transform: rotate(360deg); } }
            </style>
        @endif
    </div>

    @include('frontend.partials.menu')
    @yield('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// ===== THEME TOGGLE SYSTEM =====
(function() {
    var themeToggle = document.getElementById('themeToggle');
    var html = document.documentElement;
    var STORAGE_KEY = 'bloodbank_theme';

    function getPreferredTheme() {
        var stored = localStorage.getItem(STORAGE_KEY);
        if (stored) return stored;
        return window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
    }

    function applyTheme(theme) {
        if (theme === 'light') {
            html.classList.add('light-mode');
        } else {
            html.classList.remove('light-mode');
        }
        localStorage.setItem(STORAGE_KEY, theme);
        if (themeToggle) {
            themeToggle.innerHTML = theme === 'light'
                ? '<i class="bi bi-moon-stars-fill"></i>'
                : '<i class="bi bi-sun-fill"></i>';
            themeToggle.setAttribute('data-theme', theme);
        }
    }

    // Apply saved theme on load
    applyTheme(getPreferredTheme());

    // Listen for system preference changes
    if (window.matchMedia) {
        window.matchMedia('(prefers-color-scheme: light)').addEventListener('change', function(e) {
            if (!localStorage.getItem(STORAGE_KEY)) {
                applyTheme(e.matches ? 'light' : 'dark');
            }
        });
    }

    // Toggle click handler
    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            var current = html.classList.contains('light-mode') ? 'dark' : 'light';
            applyTheme(current);
        });
    }
})();

// ===== HIDE SKELETON ON PAGE LOAD =====
(function() {
    var overlay = document.getElementById('skeleton-overlay');
    if (!overlay) return;

    function hideSkeleton() {
        overlay.classList.add('skeleton-hidden');
        setTimeout(function() {
            overlay.style.display = 'none';
        }, 500);
    }

    if (document.readyState === 'complete') {
        hideSkeleton();
    } else {
        window.addEventListener('load', hideSkeleton);
        // Fallback: hide after 2 seconds max
        setTimeout(hideSkeleton, 2000);
    }
})();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>