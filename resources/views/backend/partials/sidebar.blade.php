<!-- Sidebar -->
<aside class="sidebar" id="sidebarCollapse" style="width:260px; min-width:260px; background:linear-gradient(180deg,#0f172a,#1e293b); flex-shrink:0;">
    <!-- Close button for mobile -->
    <div class="sidebar-close d-md-none">
        <button type="button" class="btn-close btn-close-white" aria-label="Close sidebar" onclick="document.getElementById('sidebarCollapse').classList.remove('open'); document.getElementById('sidebarOverlay').classList.remove('active');"></button>
    </div>

    <div class="sidebar-header" style="padding:1.2rem 1.5rem; border-bottom:1px solid rgba(255,255,255,0.08); margin-bottom:0.5rem; flex-shrink:0;">
        <a href="/admin" class="brand" style="display:flex; align-items:center; gap:0.75rem; color:#fff; text-decoration:none; font-size:1.2rem; font-weight:800; letter-spacing:-0.3px;">
            <i class="bi bi-grid-1x2-fill" style="font-size:1.6rem; color:#6366f1;"></i>
            <span style="background:linear-gradient(135deg,#fff 60%,#94a3b8); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">{{ __('messages.admin') }} Panel</span>
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
            <a href="{{ url('/admin/faqs') }}"
               class="{{ request()->is('admin/faqs*') ? 'active' : '' }}">
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
</aside>
