@php
use Illuminate\Support\Str;
@endphp

<style>
.topbar-link:hover { color:#fff !important; background:rgba(255,255,255,0.08) !important; }
.topbar-link.active-link { color:#fff !important; background:rgba(99,102,241,0.2) !important; }
.sidebar-toggle-btn:hover { color:#fff !important; }
</style>
<nav class="navbar navbar-expand-lg py-0" style="height:auto; min-height:57px; background:linear-gradient(180deg,#0f172a,#1e293b); border-bottom:1px solid rgba(255,255,255,0.06); box-shadow:0 2px 12px rgba(0,0,0,0.15); color:#fff; position:sticky; top:0; z-index:1050;">
    <div class="container-fluid px-3">
        {{-- Mobile Sidebar Toggle --}}
        <button class="btn d-md-none p-1 me-2 sidebar-toggle-btn" type="button" aria-label="Toggle sidebar" onclick="document.getElementById('sidebarCollapse').classList.toggle('open'); document.getElementById('sidebarOverlay').classList.toggle('active');" style="color:rgba(255,255,255,0.7); border:none; background:transparent;">
            <i class="bi bi-list fs-4"></i>
        </button>

        {{-- Brand --}}
        <a class="navbar-brand d-flex align-items-center fw-bold fs-5 py-0" href="/admin" style="color:#fff;">
            <i class="bi bi-speedometer2 me-2 fs-3" style="background:linear-gradient(135deg,#818cf8,#a78bfa); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;"></i>
            <span class="d-none d-sm-inline">{{ config('app.name', 'Admin') }}</span>
            <span class="d-sm-none">Admin</span>
        </a>

        {{-- Toggler --}}
        <button class="navbar-toggler border-0 py-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTopNav" style="color:rgba(255,255,255,0.7);">
            <span class="navbar-toggler-icon" style="filter:brightness(0) invert(1);"></span>
        </button>

        {{-- Top Nav Links --}}
        <div class="collapse navbar-collapse" id="navbarTopNav">
            <ul class="navbar-nav ms-auto gap-1 align-items-center">
                <li class="nav-item">
                    <a class="nav-link topbar-link {{ request()->is('/') ? 'active-link' : '' }}" href="/" style="color:rgba(255,255,255,0.7); font-size:0.85rem; font-weight:500; padding:0.4rem 0.85rem; border-radius:8px; transition:all 0.2s;">
                        <i class="bi bi-house-door me-1"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link topbar-link {{ Str::startsWith(request()->path(), 'admin') ? 'active-link' : '' }}" href="/admin" style="color:rgba(255,255,255,0.7); font-size:0.85rem; font-weight:500; padding:0.4rem 0.85rem; border-radius:8px; transition:all 0.2s;">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link fw-semibold topbar-link" style="color:rgba(255,255,255,0.7); font-size:0.85rem; text-decoration:none; font-weight:500; padding:0.4rem 0.85rem; border-radius:8px; transition:all 0.2s; border:none; background:transparent;">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
