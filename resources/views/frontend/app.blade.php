<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', "ESHA'S ROKOMARIS 2 — Women's Fashion Boutique")</title>
    <meta name="description" content="@yield('meta_description', 'Effortless fashion, thoughtfully selected for your everyday style.')">

    {{-- Typography: editorial serif headings + highly readable UI sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    {{-- Store / account pages still rely on Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    {{-- ESHA'S ROKOMARIS 2 brand theme (files live in the project's public/ directory) --}}
    <link rel="stylesheet" href="{{ rtrim(config('app.public_url'), '/') }}/frontend/css/brand.css?v=15">

    @yield('styles')
</head>
<body class="@yield('body_class')">
    @include('frontend.partials.menu')

    <main id="main">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="{{ rtrim(config('app.public_url'), '/') }}/frontend/js/brand.js?v=3"></script>

    @yield('scripts')
</body>
</html>
