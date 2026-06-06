<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Portfolio') }} | {{ __('messages.home') }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Page Loading Animation -->
    <style>
        /* Light Theme - works on ALL pages */
        html.light-theme {
            --bg-primary: #f8fafc;
            --bg-secondary: #f1f5f9;
            --bg-card: rgba(255, 255, 255, 0.9);
            --bg-nav: rgba(248, 250, 252, 0.92);
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-muted: #94a3b8;
            --border-color: rgba(59, 130, 246, 0.15);
            --border-hover: rgba(59, 130, 246, 0.35);
            --shadow-sm: 0 4px 20px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 10px 40px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.12);
            --shadow-accent: 0 10px 40px rgba(59, 130, 246, 0.2);
        }
        .light-theme .footer { background: #e2e8f0; }
        .light-theme .map-container iframe { filter: none; }

        /* ===== LOADING OVERLAY ===== */
        .page-loader {
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: var(--bg-primary, #0a0f1e);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 1.5rem;
            transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.6s ease;
        }
        .page-loader.hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }
        .loader-ring {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            border: 4px solid rgba(59, 130, 246, 0.1);
            border-top-color: #3b82f6;
            border-bottom-color: #8b5cf6;
            animation: loaderSpin 1s cubic-bezier(0.16, 1, 0.3, 1) infinite;
        }
        @keyframes loaderSpin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .loader-text {
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-muted, #64748b);
            letter-spacing: 1px;
            animation: loaderPulse 1.5s ease-in-out infinite;
        }
        @keyframes loaderPulse {
            0%, 100% { opacity: 0.4; }
            50% { opacity: 1; }
        }
        .loader-logo {
            font-size: 1.6rem;
            font-weight: 900;
            background: linear-gradient(135deg, #3b82f6, #60a5fa, #a78bfa, #3b82f6);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: loaderGradient 3s ease infinite;
            letter-spacing: -1px;
        }
        @keyframes loaderGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        /* Fade-in animation for page content */
        .page-content {
            animation: pageFadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }
        @keyframes pageFadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <script>
        // Apply saved theme immediately on ALL pages
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.add('light-theme');
        }
    </script>
    <!-- Loading Overlay -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-logo">{{ config('app.name', 'Portfolio') }}</div>
        <div class="loader-ring"></div>
        <div class="loader-text">{{ __('messages.loading') }}</div>
    </div>

    @include('frontend.partials.menu')
    
    <!-- Page Content Wrapper -->
    <div class="page-content" id="pageContent">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script>
    // ===== PAGE LOADING ANIMATION =====
    (function() {
        var loader = document.getElementById('pageLoader');
        var content = document.getElementById('pageContent');
        if (!loader) return;

        window.addEventListener('load', function() {
            setTimeout(function() {
                loader.classList.add('hidden');
                if (content) content.style.animation = 'none';
            }, 500);
        });

        // Fallback: hide after 3s max
        setTimeout(function() {
            if (!loader.classList.contains('hidden')) {
                loader.classList.add('hidden');
                if (content) content.style.animation = 'none';
            }
        }, 3000);
    })();

    // ===== THEME TOGGLE (global - works on ALL pages) =====
    (function() {
        var toggle = document.getElementById('themeToggle');
        if (!toggle) return;

        // Set initial icon based on saved theme
        var saved = localStorage.getItem('theme');
        if (saved === 'light') {
            toggle.innerHTML = '<i class="bi bi-moon-fill"></i>';
        }

        toggle.addEventListener('click', function() {
            document.documentElement.classList.toggle('light-theme');
            var isLight = document.documentElement.classList.contains('light-theme');
            localStorage.setItem('theme', isLight ? 'light' : 'dark');
            this.innerHTML = isLight ? '<i class="bi bi-moon-fill"></i>' : '<i class="bi bi-sun-fill"></i>';
        });
    })();
    </script>
</body>
</html>
