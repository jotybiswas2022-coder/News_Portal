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

    <!-- Global Theme Styles -->
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
    </style>
</head>
<body>
    <script>
        // Apply saved theme immediately on ALL pages
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.add('light-theme');
        }
    </script>
    @include('frontend.partials.menu')
    @yield('content')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script>
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
