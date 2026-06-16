<!-- ===== NEWS PORTAL DARK — NAVBAR ===== -->
<nav class="np-navbar">
    <div class="np-nav-inner">
        <a class="np-nav-brand" href="{{ url('/') }}">
            <i class="bi bi-newspaper"></i>
            <span>News <span class="np-brand-red">Portal</span></span>
        </a>

        <button class="np-nav-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#npNav" aria-controls="npNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="np-toggler-bar"></span>
            <span class="np-toggler-bar"></span>
            <span class="np-toggler-bar"></span>
        </button>

        <div class="np-nav-collapse" id="npNav">
            <ul class="np-nav-links">
                <li class="np-nav-item">
                    <a class="np-nav-link {{ request()->is('/') ? 'np-active' : '' }}" href="{{ url('/') }}">
                        <i class="bi bi-house-door"></i> Home
                    </a>
                </li>

                @auth
                    @if(auth()->user()->is_admin == 1)
                    <li class="np-nav-item">
                        <a class="np-nav-link {{ request()->is('admin') ? 'np-active' : '' }}" href="{{ url('/admin') }}">
                            <i class="bi bi-speedometer2"></i> Admin Panel
                        </a>
                    </li>
                    @endif
                    <li class="np-nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="np-nav-link np-nav-logout">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="np-nav-item">
                        <a class="np-nav-link {{ request()->is('login') ? 'np-active' : '' }}" href="{{ url('/login') }}">
                            <i class="bi bi-person-circle"></i> Login
                        </a>
                    </li>
                    <li class="np-nav-item">
                        <a class="np-nav-link np-nav-register" href="{{ url('/register') }}">
                            <i class="bi bi-person-plus"></i> Register
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap');

    :root {
        --np-dark-1: #0a0a0f;
        --np-dark-2: #111118;
        --np-dark-3: #1a1a24;
        --np-dark-4: #242430;
        --np-red: #D32F2F;
        --np-red-dark: #B71C1C;
        --np-white: #FFFFFF;
        --np-text: #d0d0d8;
        --np-text-dim: #8888a0;
        --np-text-muted: #555568;
        --np-border: rgba(255,255,255,0.06);
        --font-headline: 'Playfair Display', Georgia, serif;
        --font-ui: 'Inter', Arial, sans-serif;
    }

    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: var(--font-ui);
        color: var(--np-text);
        background: var(--np-dark-1);
        min-height: 100vh;
        overflow-x: hidden;
        padding-top: 56px;
    }

    .np-navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1050;
        background: rgba(10, 10, 15, 0.95);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-bottom: 1px solid var(--np-border);
        height: 56px;
    }

    .np-nav-inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 100%;
    }

    .np-nav-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        font-family: var(--font-headline);
        font-size: 22px;
        font-weight: 900;
        color: var(--np-white);
        text-decoration: none;
        letter-spacing: -0.5px;
        transition: color 0.3s;
    }

    .np-nav-brand:hover {
        color: var(--np-white);
    }

    .np-nav-brand i {
        font-size: 22px;
        color: var(--np-red);
        filter: drop-shadow(0 0 6px rgba(211,47,47,0.3));
    }

    .np-brand-red {
        color: var(--np-red);
        text-shadow: 0 0 20px rgba(211,47,47,0.2);
    }

    .np-nav-toggler {
        display: none;
        background: none;
        border: 1px solid rgba(255,255,255,0.1);
        padding: 6px 10px;
        cursor: pointer;
        flex-direction: column;
        gap: 4px;
    }

    .np-toggler-bar {
        width: 22px;
        height: 2px;
        background: var(--np-text);
        transition: all 0.3s;
    }

    .np-nav-collapse {
        display: flex;
    }

    .np-nav-links {
        display: flex;
        align-items: center;
        gap: 4px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .np-nav-item {
        margin: 0;
    }

    .np-nav-link {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        font-size: 13px;
        font-weight: 500;
        color: var(--np-text-dim);
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        position: relative;
        background: none;
        border: none;
        cursor: pointer;
        font-family: var(--font-ui);
    }

    .np-nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 2px;
        background: var(--np-red);
        transition: width 0.3s ease;
        border-radius: 1px;
    }

    .np-nav-link:hover {
        color: var(--np-white);
    }

    .np-nav-link:hover::after {
        width: 60%;
    }

    .np-nav-link i {
        font-size: 15px;
        transition: transform 0.3s;
    }

    .np-nav-link:hover i {
        transform: translateY(-1px);
    }

    .np-active {
        color: var(--np-white) !important;
    }

    .np-active::after {
        width: 60% !important;
    }

    .np-nav-logout:hover {
        color: var(--np-red) !important;
    }

    .np-nav-logout:hover::after {
        background: var(--np-red);
    }

    .np-nav-register {
        background: rgba(211, 47, 47, 0.1) !important;
        border: 1px solid rgba(211, 47, 47, 0.15) !important;
        color: var(--np-red) !important;
        padding: 8px 20px !important;
        transition: all 0.3s ease !important;
    }

    .np-nav-register:hover {
        background: var(--np-red) !important;
        color: var(--np-white) !important;
        border-color: var(--np-red) !important;
        box-shadow: 0 4px 15px rgba(211,47,47,0.3);
    }

    .np-nav-register::after {
        display: none !important;
    }

    @media (max-width: 768px) {
        .np-nav-toggler {
            display: flex;
        }

        .np-nav-collapse {
            display: none;
            position: absolute;
            top: 56px;
            left: 0;
            right: 0;
            background: rgba(10, 10, 15, 0.98);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--np-border);
            padding: 12px 20px;
        }

        .np-nav-collapse.show {
            display: block;
        }

        .np-nav-links {
            flex-direction: column;
            gap: 2px;
        }

        .np-nav-link {
            padding: 12px 16px;
            width: 100%;
        }

        .np-nav-register {
            text-align: center;
            justify-content: center;
            margin-top: 4px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggler = document.querySelector('.np-nav-toggler');
        const collapse = document.querySelector('.np-nav-collapse');
        if (toggler && collapse) {
            toggler.addEventListener('click', () => {
                collapse.classList.toggle('show');
            });
        }
    });
</script>
