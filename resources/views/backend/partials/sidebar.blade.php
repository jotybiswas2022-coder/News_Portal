@php
use Illuminate\Support\Str;

$menuItems = [
    ['url' => '/admin/account', 'icon' => 'person-circle', 'label' => 'Account', 'color' => '#667eea'],
    ['url' => '/admin/donor_list', 'icon' => 'people-fill', 'label' => 'Donor List', 'color' => '#e35e6f'],
    ['url' => '/admin/blood-requests', 'icon' => 'exclamation-triangle-fill', 'label' => 'Blood Requests', 'color' => '#dc2626'],
    ['url' => '/admin/contact', 'icon' => 'envelope-fill', 'label' => 'Contact', 'color' => '#4facfe'],
];

$isActive = function($path) {
    return request()->is(trim($path, '/'));
};
@endphp

{{-- Top Navbar --}}
<nav style="background:#fff;border-bottom:1px solid rgba(0,0,0,0.05);padding:8px 16px;box-shadow:0 2px 16px rgba(0,0,0,0.04);position:sticky;top:0;z-index:1020;">
    <div style="display:flex;align-items:center;justify-content:space-between;max-width:100%;">
        <div style="display:flex;align-items:center;gap:10px;">
            <button onclick="toggleSidebar()" style="background:none;border:none;font-size:1.5rem;color:#444;cursor:pointer;padding:4px;" class="d-md-none">
                <i class="bi bi-list"></i>
            </button>
            <a href="/admin" style="display:flex;align-items:center;gap:8px;text-decoration:none;">
                <span style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#667eea,#764ba2);display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-speedometer2" style="color:#fff;font-size:1.1rem;"></i>
                </span>
                <span style="font-weight:700;font-size:1rem;color:#333;">Admin<span style="color:#667eea;">Panel</span></span>
            </a>
        </div>

        <div style="display:flex;align-items:center;gap:6px;" id="navbarTopNav">
            <a href="/"
               style="padding:6px 14px;border-radius:50px;font-size:0.82rem;font-weight:500;text-decoration:none;transition:all 0.2s;{{ request()->is('/') ? 'background:rgba(102,126,234,0.1);color:#667eea;' : 'color:#666;' }}"
               onmouseover="this.style.background='rgba(102,126,234,0.08)';this.style.color='#667eea'"
               onmouseout="this.style.background='{{ request()->is('/') ? 'rgba(102,126,234,0.1)' : 'transparent' }}';this.style.color='{{ request()->is('/') ? '#667eea' : '#666' }}'">
                <i class="bi bi-house-door me-1"></i> Home
            </a>
            @auth
                @if(auth()->user()->is_admin == 1)
                    <a href="/admin"
                       style="padding:6px 14px;border-radius:50px;font-size:0.82rem;font-weight:500;text-decoration:none;transition:all 0.2s;{{ Str::startsWith(request()->path(), 'admin') && !request()->is('admin/account') && !request()->is('admin/donor_list') && !request()->is('admin/contact') ? 'background:rgba(102,126,234,0.1);color:#667eea;' : 'color:#666;' }}"
                       onmouseover="this.style.background='rgba(102,126,234,0.08)';this.style.color='#667eea'"
                       onmouseout="this.style.background='{{ Str::startsWith(request()->path(), 'admin') && !request()->is('admin/account') && !request()->is('admin/donor_list') && !request()->is('admin/contact') ? 'rgba(102,126,234,0.1)' : 'transparent' }}';this.style.color='{{ Str::startsWith(request()->path(), 'admin') && !request()->is('admin/account') && !request()->is('admin/donor_list') && !request()->is('admin/contact') ? '#667eea' : '#666' }}'">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </a>
                @endif
                <form action="{{ route('logout') }}" method="POST" style="display:inline;margin:0;">
                    @csrf
                    <button type="submit"
                            style="padding:6px 14px;border-radius:50px;font-size:0.82rem;font-weight:600;border:none;background:rgba(220,53,69,0.06);color:#dc3545;cursor:pointer;transition:all 0.2s;"
                            onmouseover="this.style.background='#dc3545';this.style.color='#fff'"
                            onmouseout="this.style.background='rgba(220,53,69,0.06)';this.style.color='#dc3545'">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </button>
                </form>
            @else
                <a href="/login"
                   style="padding:6px 14px;border-radius:50px;font-size:0.82rem;font-weight:500;text-decoration:none;transition:all 0.2s;{{ request()->is('login') ? 'background:rgba(102,126,234,0.1);color:#667eea;' : 'color:#666;' }}"
                   onmouseover="this.style.background='rgba(102,126,234,0.08)';this.style.color='#667eea'"
                   onmouseout="this.style.background='{{ request()->is('login') ? 'rgba(102,126,234,0.1)' : 'transparent' }}';this.style.color='{{ request()->is('login') ? '#667eea' : '#666' }}'">
                    <i class="bi bi-person-circle me-1"></i> Login
                </a>
                <a href="/register"
                   style="padding:6px 16px;border-radius:50px;font-size:0.82rem;font-weight:600;text-decoration:none;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;transition:all 0.3s;box-shadow:0 3px 10px rgba(102,126,234,0.2);"
                   onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 5px 16px rgba(102,126,234,0.3)'"
                   onmouseout="this.style.transform='';this.style.boxShadow='0 3px 10px rgba(102,126,234,0.2)'">
                    <i class="bi bi-person-plus me-1"></i> Signup
                </a>
            @endauth
        </div>
    </div>
</nav>

{{-- Sidebar + Content wrapper --}}
<div style="display:flex;min-height:calc(100vh - 57px);">

    {{-- Mobile Offcanvas --}}
    <div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="sidebarOffcanvas" style="--bs-offcanvas-width:260px;">
        <div style="padding:16px 18px;border-bottom:1px solid #f0f0f5;display:flex;align-items:center;justify-content:space-between;">
            <span style="font-weight:700;font-size:1rem;color:#333;display:flex;align-items:center;gap:8px;">
                <span style="width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,#667eea,#764ba2);display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-speedometer2" style="color:#fff;font-size:0.9rem;"></i>
                </span>
                Admin Panel
            </span>
            <button type="button" style="background:none;border:none;font-size:1.3rem;color:#999;cursor:pointer;padding:0;line-height:1;" data-bs-dismiss="offcanvas">&times;</button>
        </div>
        <div style="padding:8px 0;">
            @foreach($menuItems as $item)
            @php
                $active = $isActive($item['url']);
                $r = hexdec(substr($item['color'],1,2));
                $g = hexdec(substr($item['color'],3,2));
                $b = hexdec(substr($item['color'],5,2));
            @endphp
            <a href="{{ $item['url'] }}"
               style="display:flex;align-items:center;gap:12px;padding:12px 20px;font-size:0.9rem;font-weight:500;text-decoration:none;transition:all 0.2s;border-left:3px solid transparent;{{ $active ? 'background:rgba('.$r.','.$g.','.$b.',0.08);color:'.$item['color'].';border-left-color:'.$item['color'].';' : 'color:#555;' }}"
               onmouseover="this.style.background='rgba(102,126,234,0.06)';this.style.color='#667eea';this.style.borderLeftColor='#667eea'"
               onmouseout="this.style.background='{{ $active ? 'rgba('.$r.','.$g.','.$b.',0.08)' : 'transparent' }}';this.style.color='{{ $active ? $item['color'] : '#555' }}';this.style.borderLeftColor='{{ $active ? $item['color'] : 'transparent' }}'">
                <span style="width:34px;height:34px;border-radius:10px;display:flex;align-items:center;justify-content:center;{{ $active ? 'background:'.$item['color'].';color:#fff;' : 'background:#f0f1fe;color:'.$item['color'].';' }}">
                    <i class="bi bi-{{ $item['icon'] }}" style="font-size:0.85rem;"></i>
                </span>
                <span>{{ $item['label'] }}</span>
            </a>
            @endforeach
        </div>
        <div style="padding:12px 20px;border-top:1px solid #f0f0f5;margin-top:auto;">
            <small style="color:#bbb;font-size:0.75rem;">Blood Bank Admin v1.0</small>
        </div>
    </div>

    {{-- Desktop Sidebar --}}
    <div class="d-none d-md-block" style="width:230px;flex-shrink:0;background:#fff;border-right:1px solid rgba(0,0,0,0.06);padding:16px 0;">
        <div style="display:flex;flex-direction:column;gap:4px;padding:0 10px;">
            @foreach($menuItems as $item)
            @php
                $active = $isActive($item['url']);
                $r = hexdec(substr($item['color'],1,2));
                $g = hexdec(substr($item['color'],3,2));
                $b = hexdec(substr($item['color'],5,2));
            @endphp
            <a href="{{ $item['url'] }}"
               style="display:flex;align-items:center;gap:12px;padding:10px 14px;font-size:0.85rem;font-weight:{{ $active ? '600' : '500' }};text-decoration:none;border-radius:12px;transition:all 0.2s;{{ $active ? 'background:rgba('.$r.','.$g.','.$b.',0.08);color:'.$item['color'].';' : 'color:#555;' }}"
               onmouseover="this.style.background='rgba(102,126,234,0.06)';this.style.color='#667eea'"
               onmouseout="this.style.background='{{ $active ? 'rgba('.$r.','.$g.','.$b.',0.08)' : 'transparent' }}';this.style.color='{{ $active ? $item['color'] : '#555' }}'">
                <span style="width:32px;height:32px;border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0;{{ $active ? 'background:'.$item['color'].';color:#fff;' : 'background:#f0f1fe;color:'.$item['color'].';' }}">
                    <i class="bi bi-{{ $item['icon'] }}" style="font-size:0.85rem;"></i>
                </span>
                <span>{{ $item['label'] }}</span>
            </a>
            @endforeach
        </div>
    </div>

    {{-- Mobile toggle script --}}
    <script>
    function toggleSidebar() {
        var el = document.getElementById('sidebarOffcanvas');
        if (el) {
            var offcanvas = new bootstrap.Offcanvas(el);
            offcanvas.toggle();
        }
    }
    </script>

    {{-- Content Area --}}
    <div style="flex-grow:1;overflow-x:auto;width:100%;background:#f8f9fe;min-height:calc(100vh - 57px);padding:16px 20px;display:flex;flex-direction:column;" id="mainContent">