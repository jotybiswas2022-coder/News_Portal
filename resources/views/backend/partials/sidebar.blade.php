@php
use Illuminate\Support\Str;
@endphp

<!-- ===== Topbar ===== -->
<nav class="ad-topbar">
    <div class="ad-topbar-left">
        <button class="ad-menu-toggle" id="adMenuToggle" aria-label="Toggle navigation">
            <i class="bi bi-list"></i>
        </button>
        <a class="ad-brand" href="/admin">
            <span class="ad-brand-icon"><i class="bi bi-newspaper"></i></span>
            <span class="ad-brand-text">News<span>Portal</span><small>Admin Panel</small></span>
        </a>
    </div>

    <div class="ad-topbar-right">
        <a class="ad-top-link" href="/" target="_blank">
            <i class="bi bi-globe2"></i><span>View Site</span>
        </a>

        <div class="ad-topbar-user">
            <span class="ad-user-avatar">{{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 1)) }}</span>
            <div class="ad-user-meta">
                <span class="ad-user-name">{{ auth()->user()?->name ?? 'Administrator' }}</span>
                <span class="ad-user-role">Administrator</span>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button class="ad-logout-btn" type="submit" title="Logout">
                <i class="bi bi-box-arrow-right"></i>
            </button>
        </form>
    </div>
</nav>

<!-- ===== Sidebar ===== -->
<aside class="ad-sidebar" id="adSidebar">
    <div class="ad-sidebar-head">
        <div class="ad-sidebar-logo">
            <span class="ad-sidebar-logo-icon"><i class="bi bi-newspaper"></i></span>
            <div>
                <strong>Dashboard</strong>
                <small>Navigation</small>
            </div>
        </div>
        <button class="ad-sidebar-close" id="adSidebarClose" aria-label="Close menu">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <nav class="ad-sidebar-nav">
        <p class="ad-nav-label">Main</p>
        <ul class="ad-sidebar-menu">
            <li>
                <a href="/admin" class="{{ request()->is('admin', 'admin/') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <p class="ad-nav-label">Content</p>
        <ul class="ad-sidebar-menu">
            <li>
                <a href="/admin/sliders" class="{{ request()->is('admin/sliders', 'admin/sliders*') ? 'active' : '' }}">
                    <i class="bi bi-images"></i>
                    <span>Sliders</span>
                </a>
            </li>
            <li>
                <a href="/admin/posts" class="{{ request()->is('admin/posts', 'admin/posts*') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i>
                    <span>Posts</span>
                </a>
            </li>
            <li>
                <a href="/admin/category" class="{{ request()->is('admin/category', 'admin/category*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li>
                <a href="/admin/contacts" class="{{ request()->is('admin/contacts', 'admin/contacts*') ? 'active' : '' }}">
                    <i class="bi bi-envelope"></i>
                    <span>Contacts</span>
                </a>
            </li>
        </ul>

        <p class="ad-nav-label">System</p>
        <ul class="ad-sidebar-menu">
            <li>
                <a href="/admin/settings" class="{{ request()->is('admin/settings', 'admin/settings*') ? 'active' : '' }}">
                    <i class="bi bi-gear"></i>
                    <span>General Settings</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="ad-sidebar-foot">
        <a href="/" target="_blank">
            <i class="bi bi-globe2"></i> View Website
        </a>
    </div>
</aside>