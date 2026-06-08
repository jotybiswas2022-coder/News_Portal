<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Laravel')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-4.0.0.js" integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://junait.com/tiny_pro.js"></script>

    <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
</head>
<body>

    {{-- Top Navigation Bar --}}
    @include('backend.partials.topbar')

    {{-- Sidebar Overlay (mobile) --}}
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="document.getElementById('sidebarCollapse').classList.remove('open'); this.classList.remove('active');"></div>

    {{-- Admin Layout: Sidebar + Content --}}
    <div class="admin-layout" style="display:flex; min-height:calc(100vh - 57px);">

        {{-- Sidebar --}}
        @include('backend.partials.sidebar')

        {{-- Main Content --}}
        <main class="admin-main" style="flex:1; min-width:0; background:#f1f5f9; padding:1.5rem 2rem; overflow-y:auto;">
            @yield('content')
        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('backend/js/custom.js') }}"></script>

    @yield('scripts')
</body>

</html>
