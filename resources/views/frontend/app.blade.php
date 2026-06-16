<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'News Portal') | News Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="np-page-loader" id="pageLoader">
        <div class="np-loader-spinner"></div>
    </div>
    @include('frontend.partials.menu')
    @yield('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>
    window.addEventListener('load', function() {
        var loader = document.getElementById('pageLoader');
        if (loader) { loader.classList.add('np-loader-hidden'); }
    });
</script>
<style>
    .np-page-loader {
        position: fixed; inset: 0; z-index: 99999;
        background: var(--np-dark-1, #0a0a0f);
        display: flex; align-items: center; justify-content: center;
        transition: opacity 0.5s ease, visibility 0.5s ease;
    }
    .np-page-loader.np-loader-hidden { opacity: 0; visibility: hidden; pointer-events: none; }
    .np-loader-spinner {
        width: 36px; height: 36px;
        border: 3px solid rgba(255,255,255,0.1);
        border-top-color: #D32F2F;
        border-radius: 50%;
        animation: npSpin 0.8s linear infinite;
    }
    @keyframes npSpin { to { transform: rotate(360deg); } }
</style>
</body>
</html>
