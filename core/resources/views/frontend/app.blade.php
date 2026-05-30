<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-KOKx7/j+fNU1R1H9lKDz9EwT5PpFKF4P4FQn8vHCEa8l/HzIhM+fq0Iu6iX2QzYeb6gi3W4Z2Zob/nkZfgF+pQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    @include('frontend.partials.menu')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// ===================== GLOBAL SWEETALERT2 DEFAULTS (Dark theme with brand blue) =====================
Swal.setDefaults({
    background: '#05050f',
    color: '#EAEAEA',
    confirmButtonColor: '#005fe7',
    cancelButtonColor: '#64748b',
    iconColor: '#005fe7',
    buttonsStyling: true,
    reverseButtons: true,
    customClass: {
        popup: 'swal-front-popup',
        confirmButton: 'swal-front-confirm',
        cancelButton: 'swal-front-cancel'
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<style>
/* ── GLOBAL: remove underlines from all links ── */
a { text-decoration: none !important; }

/* ===== SWEETALERT2 THEME OVERRIDES (Dark with brand blue) ===== */
.swal-front-popup {
    background: #05050f !important;
    border: 1px solid rgba(255,255,255,0.06) !important;
    border-radius: 16px !important;
    box-shadow: 0 8px 32px rgba(0,0,0,0.6) !important;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
}
.swal-front-popup .swal2-title {
    color: #ffffff !important;
    font-weight: 700 !important;
}
.swal-front-popup .swal2-html-container {
    color: #a0aec0 !important;
}
.swal-front-confirm {
    background: linear-gradient(135deg, #005fe7, #2255ff) !important;
    border: none !important;
    border-radius: 10px !important;
    font-weight: 600 !important;
    padding: 10px 24px !important;
    box-shadow: 0 4px 15px rgba(34,85,255,0.3) !important;
    transition: all 0.3s ease !important;
}
.swal-front-confirm:hover {
    box-shadow: 0 6px 25px rgba(34,85,255,0.5) !important;
    transform: translateY(-1px) !important;
}
.swal-front-cancel {
    background: rgba(255,255,255,0.04) !important;
    color: #94a3b8 !important;
    border: 1px solid rgba(255,255,255,0.08) !important;
    border-radius: 10px !important;
    font-weight: 500 !important;
    padding: 10px 24px !important;
    transition: all 0.3s ease !important;
}
.swal-front-cancel:hover {
    background: rgba(255,255,255,0.08) !important;
    border-color: rgba(255,255,255,0.12) !important;
}
.swal2-toast.swal-front-popup {
    background: #05050f !important;
    border: 1px solid rgba(0,95,231,0.2) !important;
    box-shadow: 0 8px 32px rgba(0,0,0,0.5) !important;
}
.swal2-toast .swal2-timer-progress-bar {
    background: linear-gradient(90deg, #005fe7, #ff2d78) !important;
}
.swal2-icon {
    border-color: rgba(0,95,231,0.2) !important;
}
</style>

</body>
</html>
