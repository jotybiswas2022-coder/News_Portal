<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin Panel')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-4.0.0.js" integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://junait.com/tiny_pro.js"></script>

    <style>
        :root {
            --ad-primary: #6366f1;
            --ad-primary-dark: #4f46e5;
            --ad-accent: #8b5cf6;
            --ad-sidebar-w: 264px;
            --ad-topbar-h: 64px;
            --ad-border: #e9eef3;
            --ad-bg: #f3f5fb;
        }

        html, body { overflow-x: hidden; }
        body {
            background: var(--ad-bg);
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif;
            color: #334155;
        }
        a { text-decoration: none; }
        .modal-backdrop {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            background: rgba(0, 0, 0, 0.3);
        }

        /* ===== Topbar ===== */
        .ad-topbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: var(--ad-topbar-h);
            z-index: 1050;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--ad-border);
            box-shadow: 0 1px 12px rgba(15, 23, 42, 0.06);
        }
        .ad-topbar-left { display: flex; align-items: center; gap: 12px; }
        .ad-menu-toggle {
            width: 40px; height: 40px;
            border: 1px solid var(--ad-border);
            border-radius: 10px;
            background: #fff;
            color: #334155;
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 20px;
            transition: all 0.2s;
        }
        .ad-menu-toggle:hover { color: var(--ad-primary); border-color: #c7d2fe; background: #eef2ff; }
        .ad-brand { display: flex; align-items: center; gap: 10px; }
        .ad-brand-icon {
            width: 38px; height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--ad-primary), var(--ad-accent));
            color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }
        .ad-brand-text { font-weight: 800; font-size: 18px; color: #1e293b; letter-spacing: -0.3px; line-height: 1; }
        .ad-brand-text span { color: var(--ad-primary); }
        .ad-brand-text small {
            display: block;
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 1.6px;
            text-transform: uppercase;
            color: #94a3b8;
            margin-top: 3px;
        }
        .ad-topbar-right { display: flex; align-items: center; gap: 10px; }
        .ad-top-link {
            display: inline-flex; align-items: center; gap: 7px;
            color: #64748b; font-size: 13px; font-weight: 600;
            padding: 8px 14px; border-radius: 9px;
            transition: all 0.2s;
        }
        .ad-top-link:hover { background: #f1f5f9; color: var(--ad-primary); }
        .ad-topbar-user {
            display: flex; align-items: center; gap: 10px;
            padding-left: 14px; border-left: 1px solid var(--ad-border);
        }
        .ad-user-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--ad-primary), var(--ad-accent));
            color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 14px;
            flex-shrink: 0;
        }
        .ad-user-meta { display: flex; flex-direction: column; line-height: 1.2; }
        .ad-user-name { font-size: 13px; font-weight: 700; color: #1e293b; }
        .ad-user-role { font-size: 10px; text-transform: uppercase; letter-spacing: 0.8px; color: #94a3b8; }
        .ad-logout-btn {
            width: 38px; height: 38px;
            border: 1px solid var(--ad-border);
            border-radius: 10px;
            background: #fff;
            color: #ef4444;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 16px;
            transition: all 0.2s;
        }
        .ad-logout-btn:hover { background: #fef2f2; border-color: #fecaca; transform: translateY(-1px); }

        /* ===== Sidebar ===== */
        .ad-sidebar {
            position: fixed;
            top: var(--ad-topbar-h);
            left: 0; bottom: 0;
            width: var(--ad-sidebar-w);
            z-index: 1040;
            background: linear-gradient(180deg, #101728 0%, #1b1b45 160%);
            display: flex; flex-direction: column;
            transition: transform 0.3s ease;
            box-shadow: 6px 0 24px rgba(15, 23, 42, 0.1);
        }
        .ad-sidebar-head {
            display: flex; align-items: center; gap: 8px;
            padding: 16px 20px;
            border-bottom: 1px solid rgba(148, 163, 184, 0.14);
        }
        .ad-sidebar-logo { display: flex; align-items: center; gap: 10px; }
        .ad-sidebar-logo-icon {
            width: 34px; height: 34px;
            border-radius: 9px;
            background: linear-gradient(135deg, var(--ad-primary), var(--ad-accent));
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; color: #fff;
            box-shadow: 0 4px 14px rgba(99, 102, 241, 0.4);
        }
        .ad-sidebar-logo strong { display: block; font-size: 15px; color: #f8fafc; line-height: 1.1; }
        .ad-sidebar-logo small { font-size: 10px; text-transform: uppercase; letter-spacing: 1.5px; color: #94a3b8; }
        .ad-sidebar-close {
            display: none;
            margin-left: auto;
            width: 32px; height: 32px;
            border: none; border-radius: 8px;
            background: rgba(255, 255, 255, 0.08);
            color: #e2e8f0;
            cursor: pointer;
            align-items: center; justify-content: center;
            transition: all 0.2s;
        }
        .ad-sidebar-close:hover { background: rgba(239, 68, 68, 0.15); color: #fca5a5; }
        .ad-sidebar-nav { flex: 1; overflow-y: auto; padding: 14px 12px 20px; scrollbar-width: thin; scrollbar-color: rgba(99,102,241,.3) transparent; }
        .ad-sidebar-nav::-webkit-scrollbar { width: 4px; }
        .ad-sidebar-nav::-webkit-scrollbar-thumb { background: rgba(99, 102, 241, 0.3); border-radius: 4px; }
        .ad-nav-label {
            font-size: 10px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 1.6px;
            color: #64748b;
            margin: 16px 12px 6px;
        }
        .ad-sidebar-menu { list-style: none; margin: 0; padding: 0; }
        .ad-sidebar-menu li { margin-bottom: 4px; }
        .ad-sidebar-menu a {
            display: flex; align-items: center; gap: 12px;
            padding: 11px 14px;
            border-radius: 10px;
            color: #cbd5e1;
            font-size: 14px; font-weight: 500;
            transition: all 0.2s;
            position: relative;
        }
        .ad-sidebar-menu a i { font-size: 17px; width: 22px; text-align: center; flex-shrink: 0; }
        .ad-sidebar-menu a:hover { background: rgba(99, 102, 241, 0.12); color: #fff; transform: translateX(2px); }
        .ad-sidebar-menu a.active {
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.28), rgba(139, 92, 246, 0.16));
            color: #fff;
            font-weight: 600;
            box-shadow: inset 3px 0 0 var(--ad-primary), 0 4px 16px rgba(99, 102, 241, 0.18);
        }
        .ad-sidebar-foot {
            padding: 14px 18px;
            border-top: 1px solid rgba(148, 163, 184, 0.14);
        }
        .ad-sidebar-foot a {
            display: flex; align-items: center; gap: 10px;
            color: #94a3b8; font-size: 13px; font-weight: 500;
            padding: 9px 10px; border-radius: 8px;
            transition: all 0.2s;
        }
        .ad-sidebar-foot a:hover { color: #fff; background: rgba(99, 102, 241, 0.12); }

        /* ===== Main content ===== */
        .ad-main {
            margin-left: var(--ad-sidebar-w);
            padding-top: var(--ad-topbar-h);
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }
        .ad-main-inner { padding: 26px 28px; }

        /* ===== Backdrop (mobile) ===== */
        .ad-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(3px);
            -webkit-backdrop-filter: blur(3px);
            z-index: 1045;
            opacity: 0; visibility: hidden;
            transition: all 0.3s;
        }
        .ad-backdrop.show { opacity: 1; visibility: visible; }

        @media (max-width: 991.98px) {
            .ad-menu-toggle { display: flex; }
            .ad-sidebar-close { display: flex; }
            .ad-topbar-user { display: none; }
            .ad-topbar-right .ad-top-link span { display: none; }
            .ad-topbar { padding: 0 14px; }
            .ad-sidebar { top: 0; transform: translateX(-100%); box-shadow: none; }
            body.ad-menu-open .ad-sidebar { transform: translateX(0); box-shadow: 6px 0 30px rgba(15, 23, 42, 0.35); }
            .ad-main { margin-left: 0; }
            .ad-main-inner { padding: 18px 16px; }
        }

        @media (max-width: 575.98px) {
            .ad-brand-text { font-size: 16px; }
            .ad-brand-text small { font-size: 8px; }
        }
    </style>
</head>
<body>
    @include('backend.partials.sidebar')

    <main class="ad-main">
        <div class="ad-main-inner">
            @yield('content')
        </div>
    </main>

    <div class="ad-backdrop" id="adMenuBackdrop"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('adMenuToggle');
            const closeBtn = document.getElementById('adSidebarClose');
            const backdrop = document.getElementById('adMenuBackdrop');

            function openMenu() {
                document.body.classList.add('ad-menu-open');
                backdrop.classList.add('show');
            }
            function closeMenu() {
                document.body.classList.remove('ad-menu-open');
                backdrop.classList.remove('show');
            }

            if (toggle) toggle.addEventListener('click', openMenu);
            if (closeBtn) closeBtn.addEventListener('click', closeMenu);
            if (backdrop) backdrop.addEventListener('click', closeMenu);
            document.querySelectorAll('.ad-sidebar-menu a').forEach(function (a) {
                a.addEventListener('click', function () {
                    if (window.innerWidth < 992) closeMenu();
                });
            });
        });
    </script>

    @yield('scripts')
</body>
</html>