@php
use Illuminate\Support\Str;
@endphp

<!-- Top Bar -->
<nav class="navbar navbar-expand-lg navbar-top py-2">
    <div class="container-fluid">
        <!-- Mobile Menu Toggle -->
        <button class="btn d-md-none p-1 me-2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-label="Toggle sidebar">
            <i class="bi bi-list fs-4" style="color: #64748b;"></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center fw-bold fs-5" href="/admin" style="color: #1e293b;">
            <i class="bi bi-speedometer2 me-2 fs-3" style="color: #6366f1;"></i>
            <span class="d-none d-sm-inline">{{ config('app.name', 'Admin') }}</span>
            <span class="d-sm-none">Admin</span>
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTopNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Top Nav Links -->
        <div class="collapse navbar-collapse" id="navbarTopNav">
            <ul class="navbar-nav ms-auto gap-1 align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active-link' : '' }}" href="/">
                        <i class="bi bi-house-door me-1"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Str::startsWith(request()->path(), 'admin') ? 'active-link' : '' }}" href="/admin">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-danger fw-semibold">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Sidebar + Content -->
<div class="row m-0" style="min-height: calc(100vh - 57px);">
    <!-- Sidebar -->
    <div class="col-md-3 col-lg-2 p-0 d-none d-md-block" id="sidebarCollapse">
    <div class="sidebar">
        <div class="sidebar-header d-none d-md-block">
            <a href="/admin" class="brand">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>{{ __('messages.admin') }} Panel</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ url('/admin') }}"
                   class="{{ request()->is('admin') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/account') }}"
                   class="{{ request()->is('admin/account') ? 'active' : '' }}">
                    <i class="bi bi-person-circle"></i>
                    <span>Account</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/projects') }}"
                   class="{{ request()->is('admin/projects*') ? 'active' : '' }}">
                    <i class="bi bi-folder2-open"></i>
                    <span>Projects</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/services') }}"
                   class="{{ request()->is('admin/services*') ? 'active' : '' }}">
                    <i class="bi bi-gear"></i>
                    <span>Services</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/experiences') }}"
                   class="{{ request()->is('admin/experiences*') ? 'active' : '' }}">
                    <i class="bi bi-briefcase"></i>
                    <span>Experiences</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/skills') }}"
                   class="{{ request()->is('admin/skills*') ? 'active' : '' }}">
                    <i class="bi bi-lightning-charge"></i>
                    <span>Skills</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/testimonials') }}"
                   class="{{ request()->is('admin/testimonials*') ? 'active' : '' }}">
                    <i class="bi bi-chat-quote"></i>
                    <span>Testimonials</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/blog') }}"
                   class="{{ request()->is('admin/blog*') ? 'active' : '' }}">
                    <i class="bi bi-pencil-square"></i>
                    <span>Blog</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/faq') }}"
                   class="{{ request()->is('admin/faq*') ? 'active' : '' }}">
                    <i class="bi bi-question-circle"></i>
                    <span>FAQs</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/contact') }}"
                   class="{{ request()->is('admin/contact') ? 'active' : '' }}">
                    <i class="bi bi-envelope-paper"></i>
                    <span>Messages</span>
                </a>
            </li>
        </ul>
    </div>
</div>

    <!-- Content -->
    <div class="col-md-9 col-lg-10 p-0 main-content" id="adminContent">