<nav id="mainNavbar" style="position: fixed; top: 0; left: 0; right: 0; z-index: 50; transition: all 0.5s ease; background: rgba(5,5,15,0.8); backdrop-filter: blur(20px) saturate(1.4); -webkit-backdrop-filter: blur(20px) saturate(1.4); border-bottom: 1px solid rgba(34,85,255,0.15); box-shadow: 0 0 15px rgba(34,85,255,0.08), 0 0 30px rgba(255,17,119,0.05), inset 0 1px 0 rgba(255,255,255,0.04);">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 16px;">
        <div style="display: flex; align-items: center; justify-content: space-between; height: 64px;">
            <!-- Logo -->                <a href="{{ route('forex.home') }}" style="display: flex; align-items: center; gap: 10px; text-decoration: none;" class="logo-group">
                <div style="position: relative; display: flex; align-items: center;">
                    <span style="font-size: 24px; font-weight: 800; letter-spacing: 1px;">
                        <span style="color: #ffffff;">SMART</span>
                        <span style="background: linear-gradient(180deg, #6b9fff, #005fe7); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"> BINARY</span>
                        <span style="background: linear-gradient(180deg, #ff7aad, #ff2d78); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"> ZONE</span>
                    </span>
                    <span style="font-size: 18px; margin-left: 2px; background: var(--brand-rainbow); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; display: inline-block;" class="logo-diamond">◈</span>
                </div>
            </a>

            <!-- Desktop Nav -->
            <div style="display: none; align-items: center; gap: 4px;" class="desktop-nav">
                @php $currentRoute = request()->route()?->getName(); @endphp
                <a href="{{ route('forex.home') }}" style="padding: 8px 16px; font-size: 14px; font-weight: 500; color: {{ $currentRoute === 'forex.home' ? '#ffffff' : 'var(--text-secondary)' }}; text-decoration: none; border-radius: 8px; transition: all 0.3s ease; position: relative; display: inline-block;{{ $currentRoute === 'forex.home' ? 'background: rgba(255,255,255,0.04);' : '' }}"
                onmouseover="this.style.color='#ffffff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='{{ $currentRoute === 'forex.home' ? '#ffffff' : 'var(--text-secondary)' }}';this.style.background='{{ $currentRoute === 'forex.home' ? 'rgba(255,255,255,0.04)' : 'transparent' }}'">
                    Home
                    <span style="position: absolute; bottom: 0; left: 16px; right: 16px; height: 2px; background: var(--brand-rainbow); transform: scaleX({{ $currentRoute === 'forex.home' ? '1' : '0' }}); transition: transform 0.3s ease; transform-origin: left;" class="nav-underline"></span>
                </a>
                 <a href="{{ route('forex.products') }}" style="padding: 8px 16px; font-size: 14px; font-weight: 500; color: {{ $currentRoute === 'forex.products' ? '#ffffff' : 'var(--text-secondary)' }}; text-decoration: none; border-radius: 8px; transition: all 0.3s ease; position: relative; display: inline-block;{{ $currentRoute === 'forex.products' ? 'background: rgba(255,255,255,0.04);' : '' }}"
                onmouseover="this.style.color='#ffffff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='{{ $currentRoute === 'forex.products' ? '#ffffff' : 'var(--text-secondary)' }}';this.style.background='{{ $currentRoute === 'forex.products' ? 'rgba(255,255,255,0.04)' : 'transparent' }}'">
                    Products
                    <span style="position: absolute; bottom: 0; left: 16px; right: 16px; height: 2px; background: var(--brand-rainbow); transform: scaleX({{ $currentRoute === 'forex.products' ? '1' : '0' }}); transition: transform 0.3s ease; transform-origin: left;" class="nav-underline"></span>
                </a>
                 <a href="{{ route('forex.source-codes') }}" style="padding: 8px 16px; font-size: 14px; font-weight: 500; color: {{ $currentRoute === 'forex.source-codes' ? '#ffffff' : 'var(--text-secondary)' }}; text-decoration: none; border-radius: 8px; transition: all 0.3s ease; position: relative; display: inline-block;{{ $currentRoute === 'forex.source-codes' ? 'background: rgba(255,255,255,0.04);' : '' }}"
                onmouseover="this.style.color='#ffffff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='{{ $currentRoute === 'forex.source-codes' ? '#ffffff' : 'var(--text-secondary)' }}';this.style.background='{{ $currentRoute === 'forex.source-codes' ? 'rgba(255,255,255,0.04)' : 'transparent' }}'">
                    Source Codes
                    <span style="position: absolute; bottom: 0; left: 16px; right: 16px; height: 2px; background: var(--brand-rainbow); transform: scaleX({{ $currentRoute === 'forex.source-codes' ? '1' : '0' }}); transition: transform 0.3s ease; transform-origin: left;" class="nav-underline"></span>
                </a>
                <a href="{{ route('forex.partnership') }}" style="padding: 8px 16px; font-size: 14px; font-weight: 500; color: {{ $currentRoute === 'forex.partnership' ? '#ffffff' : 'var(--text-secondary)' }}; text-decoration: none; border-radius: 8px; transition: all 0.3s ease; position: relative; display: inline-block;{{ $currentRoute === 'forex.partnership' ? 'background: rgba(255,255,255,0.04);' : '' }}"
                onmouseover="this.style.color='#ffffff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='{{ $currentRoute === 'forex.partnership' ? '#ffffff' : 'var(--text-secondary)' }}';this.style.background='{{ $currentRoute === 'forex.partnership' ? 'rgba(255,255,255,0.04)' : 'transparent' }}'">
                    Partnership
                    <span style="position: absolute; bottom: 0; left: 16px; right: 16px; height: 2px; background: var(--brand-rainbow); transform: scaleX({{ $currentRoute === 'forex.partnership' ? '1' : '0' }}); transition: transform 0.3s ease; transform-origin: left;" class="nav-underline"></span>
                </a>
                <a href="{{ route('forex.knowledgebase') }}" style="padding: 8px 16px; font-size: 14px; font-weight: 500; color: {{ $currentRoute === 'forex.knowledgebase' ? '#ffffff' : 'var(--text-secondary)' }}; text-decoration: none; border-radius: 8px; transition: all 0.3s ease; position: relative; display: inline-block;{{ $currentRoute === 'forex.knowledgebase' ? 'background: rgba(255,255,255,0.04);' : '' }}"
                onmouseover="this.style.color='#ffffff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='{{ $currentRoute === 'forex.knowledgebase' ? '#ffffff' : 'var(--text-secondary)' }}';this.style.background='{{ $currentRoute === 'forex.knowledgebase' ? 'rgba(255,255,255,0.04)' : 'transparent' }}'">
                    Knowledge Base
                    <span style="position: absolute; bottom: 0; left: 16px; right: 16px; height: 2px; background: var(--brand-rainbow); transform: scaleX({{ $currentRoute === 'forex.knowledgebase' ? '1' : '0' }}); transition: transform 0.3s ease; transform-origin: left;" class="nav-underline"></span>
                </a>
                <a href="{{ route('forex.contact-us') }}" style="padding: 8px 16px; font-size: 14px; font-weight: 500; color: {{ $currentRoute === 'forex.contact-us' ? '#ffffff' : 'var(--text-secondary)' }}; text-decoration: none; border-radius: 8px; transition: all 0.3s ease; position: relative; display: inline-block;{{ $currentRoute === 'forex.contact-us' ? 'background: rgba(255,255,255,0.04);' : '' }}"
                onmouseover="this.style.color='#ffffff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='{{ $currentRoute === 'forex.contact-us' ? '#ffffff' : 'var(--text-secondary)' }}';this.style.background='{{ $currentRoute === 'forex.contact-us' ? 'rgba(255,255,255,0.04)' : 'transparent' }}'">
                    Contact
                    <span style="position: absolute; bottom: 0; left: 16px; right: 16px; height: 2px; background: var(--brand-rainbow); transform: scaleX({{ $currentRoute === 'forex.contact-us' ? '1' : '0' }}); transition: transform 0.3s ease; transform-origin: left;" class="nav-underline"></span>
                </a>
            </div>

            <!-- Right side -->
            <div style="display: flex; align-items: center; gap: 12px;">
                
                <!-- Store Drawer Trigger -->
                <button id="storeDrawerBtn" style="display: none; color: #9ca3af; background: transparent; border: none; cursor: pointer; transition: all 0.3s ease; width: 40px; height: 40px; border-radius: 8px; align-items: center; justify-content: center;" class="store-desktop-btn"
                onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#9ca3af';this.style.background='transparent'">
                    <svg style="width: 20px; height: 20px; transition: transform 0.3s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                </button>

                <!-- Cart -->
                <a href="{{ route('forex.cart') }}" style="position: relative; color: #9ca3af; text-decoration: none; transition: all 0.3s ease; width: 40px; height: 40px; border-radius: 8px; display: flex; align-items: center; justify-content: center;"
                onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#9ca3af';this.style.background='transparent'">
                    <svg style="width: 20px; height: 20px; transition: transform 0.3s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                    <span id="cartBadge" style="position: absolute; top: -2px; right: -2px; background: linear-gradient(135deg, #005fe7, #ff2d78); color: #fff; font-size: 10px; font-weight: 800; border-radius: 50%; min-width: 18px; height: 18px; display: none; align-items: center; justify-content: center; padding: 0 4px; box-shadow: 0 0 8px rgba(34,85,255,0.4);">0</span>
                </a>

                <!-- Notifications -->
                @auth
                <div style="position: relative;" class="notif-desktop">
                    <button id="notifBellBtn" style="position: relative; color: #9ca3af; background: transparent; border: none; cursor: pointer; transition: all 0.3s ease; width: 40px; height: 40px; border-radius: 8px; display: flex; align-items: center; justify-content: center;"
                    onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#9ca3af';this.style.background='transparent'">
                        <svg style="width: 20px; height: 20px; transition: transform 0.3s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        @if($unreadNotificationCount > 0)
                        <span id="notifBadge" style="position: absolute; top: -2px; right: -2px; background: #ef4444; color: #fff; font-size: 10px; font-weight: 800; border-radius: 50%; min-width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; padding: 0 4px; box-shadow: 0 0 8px rgba(239,68,68,0.5);">{{ $unreadNotificationCount > 99 ? '99+' : $unreadNotificationCount }}</span>
                        @endif
                    </button>
                    <!-- Notification Dropdown -->
                    <div id="notifDropdown" class="glass-card" style="position: absolute; top: 100%; right: 0; margin-top: 8px; width: 360px; border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,0.5); opacity: 0; visibility: hidden; transition: all 0.2s ease; overflow: hidden; z-index: 200;">
                        <div style="padding: 16px 20px; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; justify-content: space-between;">
                            <h4 style="color: #fff; font-size: 14px; font-weight: 600; margin: 0;">Notifications</h4>
                            @if($unreadNotificationCount > 0)
                            <span style="color: rgba(234,234,234,0.4); font-size: 11px;">{{ $unreadNotificationCount }} new</span>
                            @endif
                        </div>
                        <div style="max-height: 320px; overflow-y: auto;">
                            @forelse($unreadNotifications as $notif)
                            <a href="{{ route('notification.read', $notif->id) }}" style="display: flex; align-items: flex-start; gap: 12px; padding: 14px 20px; text-decoration: none; transition: all 0.2s ease; border-bottom: 1px solid rgba(255,255,255,0.03);"
                            onmouseover="this.style.background='rgba(255,255,255,0.03)'" onmouseout="this.style.background='transparent'">
                                <div style="width: 32px; height: 32px; border-radius: 50%; flex-shrink: 0; display: flex; align-items: center; justify-content: center; {{ $notif->type === 'order_approved' ? 'background: rgba(16,185,129,0.12); color: #10b981;' : 'background: rgba(239,68,68,0.12); color: #ef4444;' }}">
                                    @if($notif->type === 'order_approved')
                                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    @else
                                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    @endif
                                </div>
                                <div style="flex: 1; min-width: 0;">
                                    <p style="color: #EAEAEA; font-size: 13px; font-weight: 500; margin: 0;">{{ $notif->title }}</p>
                                    <p style="color: rgba(234,234,234,0.5); font-size: 12px; margin: 2px 0 0 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $notif->message }}</p>
                                    <p style="color: rgba(234,234,234,0.25); font-size: 10px; margin: 4px 0 0 0;">{{ $notif->created_at->diffForHumans() }}</p>
                                </div>
                            </a>
                            @empty
                            <div style="padding: 32px 20px; text-align: center;">
                                <svg style="width: 32px; height: 32px; color: rgba(234,234,234,0.15); margin: 0 auto 12px; display: block;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                <p style="color: rgba(234,234,234,0.3); font-size: 13px; margin: 0;">No new notifications</p>
                                <p style="color: rgba(234,234,234,0.2); font-size: 11px; margin: 4px 0 0 0;">You're all caught up!</p>
                            </div>
                            @endforelse
                        </div>
                        @if($unreadNotificationCount > 0)
                        <a href="#" onclick="event.preventDefault();document.getElementById('markAllNotifReadForm').submit();" style="display: block; text-align: center; padding: 8px 20px; border-bottom: 1px solid rgba(255,255,255,0.06); color: rgba(234,234,234,0.5); font-size: 11px; font-weight: 400; text-decoration: none; transition: all 0.2s ease;"
                        onmouseover="this.style.color='#005fe7'" onmouseout="this.style.color='rgba(234,234,234,0.5)'">Mark all as read</a>
                        <form id="markAllNotifReadForm" action="{{ route('notification.read-all') }}" method="POST" style="display:none;">@csrf</form>
                        @endif
                        <a href="{{ route('forex.my-orders') }}" style="display: block; text-align: center; padding: 12px 20px; border-top: 1px solid rgba(255,255,255,0.06); color: #005fe7; font-size: 13px; font-weight: 500; text-decoration: none; transition: all 0.2s ease;"
                        onmouseover="this.style.background='rgba(0,95,231,0.08)'" onmouseout="this.style.background='transparent'">View All Orders →</a>
                    </div>
                </div>
                @endauth

                <!-- Language -->
                <div style="position: relative; display: none;" class="lang-desktop">
                    <button style="width: 40px; height: 40px; border-radius: 8px; background: transparent; border: none; color: #9ca3af; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; gap: 3px; position: relative; font-family: inherit;"
                    onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#9ca3af';this.style.background='transparent'">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                        EN
                    </button>
                </div>

                <!-- Auth -->
                @guest
                <a href="{{ route('login') }}" style="display: none; font-size: 14px; font-weight: 500; color: #9ca3af; text-decoration: none; padding: 8px 12px; border-radius: 8px; transition: all 0.3s ease;"
                onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#9ca3af';this.style.background='transparent'" class="login-desktop">Login</a>
                <a href="{{ route('register') }}" style="display: none; font-size: 14px; font-weight: 700; color: #fff; background: linear-gradient(90deg, #005fe7, #ff2d78); text-decoration: none; padding: 8px 20px; border-radius: 9999px; transition: all 0.3s ease; box-shadow: 0 0 15px rgba(34,85,255,0.3), 0 0 30px rgba(255,45,120,0.2); position: relative; overflow: hidden;"
                onmouseover="this.style.boxShadow='0 0 25px rgba(34,85,255,0.5), 0 0 50px rgba(255,45,120,0.4)';this.style.transform='translateY(-1px)'" onmouseout="this.style.boxShadow='0 0 15px rgba(34,85,255,0.3), 0 0 30px rgba(255,45,120,0.2)';this.style.transform=''" class="signup-desktop">
                    <span style="position: relative; z-index: 1;">Sign Up</span>
                </a>
                @else
                <div style="display: none; align-items: center; gap: 12px;" class="auth-desktop">
                    <div style="position: relative;" class="profile-group">
                        <button style="display: flex; align-items: center; gap: 8px; font-size: 14px; color: #9ca3af; background: transparent; border: none; border-radius: 8px; cursor: pointer; padding: 8px 12px; transition: all 0.3s ease; font-family: inherit;"
                        onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#9ca3af';this.style.background='transparent'">
                            <div style="width: 24px; height: 24px; border-radius: 50%; background: linear-gradient(135deg, #005fe7, #ff2d78); display: flex; align-items: center; justify-content: center; color: #05050f; font-size: 12px; font-weight: 800;">{{ substr(Auth::user()->name, 0, 1) }}</div>
                            <span>{{ Auth::user()->name }}</span>
                            <svg style="width: 12px; height: 12px; color: #6b7280; transition: transform 0.3s ease;" class="profile-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="glass-card profile-dropdown" style="position: absolute; top: 100%; right: 0; margin-top: 8px; width: 200px; border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,0.5); opacity: 0; visibility: hidden; transition: all 0.2s ease; padding: 8px 0; overflow: hidden;">
                            @if(Auth::user()->is_admin)
                            <a href="/admin" style="display: flex; align-items: center; gap: 12px; padding: 10px 16px; font-size: 14px; color: #d1d5db; text-decoration: none; transition: all 0.2s ease;"
                            onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                                <svg style="width: 16px; height: 16px; color: #005fe7;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Dashboard
                            </a>
                            @endif
                            <a href="{{ route('forex.my-orders') }}" style="display: flex; align-items: center; gap: 12px; padding: 10px 16px; font-size: 14px; color: #d1d5db; text-decoration: none; transition: all 0.2s ease;"
                            onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                                <svg style="width: 16px; height: 16px; color: #005fe7;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                My Orders
                            </a>
                            <a href="{{ route('forex.my-partnership') }}" style="display: flex; align-items: center; gap: 12px; padding: 10px 16px; font-size: 14px; color: #d1d5db; text-decoration: none; transition: all 0.2s ease;"
                            onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                                <svg style="width: 16px; height: 16px; color: #F59E0B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                My Partnership
                            </a>
                            <a href="{{ route('forex.profile') }}" style="display: flex; align-items: center; gap: 12px; padding: 10px 16px; font-size: 14px; color: #d1d5db; text-decoration: none; transition: all 0.2s ease;"
                            onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                                <svg style="width: 16px; height: 16px; color: #005fe7;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Profile
                            </a>
                            <div style="border-top: 1px solid #2a2a2a; margin: 4px 16px;"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" style="display: flex; align-items: center; gap: 12px; width: 100%; padding: 10px 16px; font-size: 14px; color: #d1d5db; background: transparent; border: none; cursor: pointer; transition: all 0.2s ease; font-family: inherit; text-align: left;"
                                onmouseover="this.style.color='#ef4444';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endguest

                <!-- Mobile hamburger -->
                <button id="mobileMenuBtn" style="width: 40px; height: 40px; border-radius: 8px; background: transparent; border: none; color: #9ca3af; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center;"
                onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#9ca3af';this.style.background='transparent'" class="mobile-menu-btn">
                    <svg id="hamburgerIcon" style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg id="closeIcon" style="width: 20px; height: 20px; display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    </div>

</nav>

<!-- Mobile Drawer (moved outside nav to prevent fixed-position cropping) -->
<div id="mobileDrawer" style="position: fixed; inset: 0; z-index: 100; display: none;" class="mobile-drawer">
    <div id="drawerOverlay" style="position: absolute; inset: 0; background: rgba(0,0,0,0.6); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);"></div>
    <div class="glass-card" style="position: absolute; right: 0; top: 0; bottom: 0; width: 320px; max-width: 85vw; padding: 24px; overflow-y: auto; box-shadow: -10px 0 40px rgba(0,0,0,0.5); border:none; border-radius:0;">
        <!-- Mobile logo -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 32px; padding-top: 16px;">
            <a href="{{ route('forex.home') }}" style="font-size: 20px; font-weight: 800; letter-spacing: 1px; text-decoration: none;">
                <span>
                    <span style="color: #ffffff;">SMART</span>
                    <span style="background: linear-gradient(180deg, #6b9fff, #005fe7); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"> BINARY</span>
                    <span style="background: linear-gradient(180deg, #ff7aad, #ff2d78); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"> ZONE</span>
                </span>
                <span style="color: #005fe7;">◈</span>
            </a>
            <button id="drawerCloseBtn" style="width: 32px; height: 32px; border-radius: 8px; background: transparent; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #9ca3af; transition: all 0.2s ease;"
            onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#9ca3af';this.style.background='transparent'">
                <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <div style="display: flex; flex-direction: column; gap: 4px;">
            <a href="{{ route('forex.home') }}" style="display: flex; align-items: center; justify-content: space-between; font-size: 16px; font-weight: 500; color: #fff; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease;"
            onmouseover="this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.background='transparent'">
                <span>Home</span>
                <svg style="width: 16px; height: 16px; color: #4b5563; transition: color 0.2s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>

            <a href="{{ route('forex.products') }}" style="display: flex; align-items: center; justify-content: space-between; font-size: 16px; font-weight: 500; color: #fff; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease;"
            onmouseover="this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.background='transparent'">
                <span>Products</span>
                <svg style="width: 16px; height: 16px; color: #4b5563; transition: color 0.2s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            <a href="{{ route('forex.source-codes') }}" style="display: flex; align-items: center; justify-content: space-between; font-size: 16px; font-weight: 500; color: #fff; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease;"
            onmouseover="this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.background='transparent'">
                <span>Source Codes</span>
                <svg style="width: 16px; height: 16px; color: #4b5563; transition: color 0.2s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>

            <a href="{{ route('forex.partnership') }}" style="display: flex; align-items: center; justify-content: space-between; font-size: 16px; font-weight: 500; color: #fff; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease;"
            onmouseover="this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.background='transparent'">
                <span>Partnership</span>
                <svg style="width: 16px; height: 16px; color: #4b5563; transition: color 0.2s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            <a href="{{ route('forex.contact-us') }}" style="display: flex; align-items: center; justify-content: space-between; font-size: 16px; font-weight: 500; color: #fff; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease;"
            onmouseover="this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.background='transparent'">
                <span>Contact</span>
                <svg style="width: 16px; height: 16px; color: #4b5563; transition: color 0.2s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            <a href="{{ route('forex.knowledgebase') }}" style="display: flex; align-items: center; justify-content: space-between; font-size: 16px; font-weight: 500; color: #fff; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease;"
            onmouseover="this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.background='transparent'">
                <span>Knowledge Base</span>
                <svg style="width: 16px; height: 16px; color: #4b5563; transition: color 0.2s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>

            <div style="height: 1px; background: rgba(255,255,255,0.06); margin: 4px 0;"></div>

            <a href="{{ route('forex.cart') }}" style="display: flex; align-items: center; justify-content: space-between; font-size: 16px; font-weight: 500; color: #fff; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease;"
            onmouseover="this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.background='transparent'">
                <span>Cart</span>
                <span id="mobileCartBadge" style="display: none; padding: 2px 8px; background: #005fe7; color: #fff; font-size: 10px; font-weight: 800; border-radius: 50px;">0</span>
            </a>

            @guest
            <div style="margin-top: 16px; padding: 0 16px; display: flex; flex-direction: column; gap: 8px;">
                <a href="{{ route('login') }}" style="display: block; width: 100%; text-align: center; font-size: 14px; font-weight: 500; color: #9ca3af; text-decoration: none; padding: 12px; border-radius: 12px; border: 1px solid #2a2a2a; transition: all 0.2s ease; box-sizing: border-box;"
                onmouseover="this.style.color='#fff';this.style.borderColor='rgba(34,85,255,0.3)'" onmouseout="this.style.color='#9ca3af';this.style.borderColor='#2a2a2a'">Login</a>
                <a href="{{ route('register') }}" style="display: block; width: 100%; text-align: center; font-size: 14px; font-weight: 700; color: #fff; background: linear-gradient(90deg, #005fe7, #ff2d78); text-decoration: none; padding: 12px; border-radius: 9999px; box-shadow: 0 0 15px rgba(34,85,255,0.3), 0 0 30px rgba(255,45,120,0.2); transition: all 0.3s ease; box-sizing: border-box;"
                onmouseover="this.style.boxShadow='0 0 25px rgba(34,85,255,0.5), 0 0 50px rgba(255,45,120,0.4)'" onmouseout="this.style.boxShadow='0 0 15px rgba(34,85,255,0.3), 0 0 30px rgba(255,45,120,0.2)'">Sign Up</a>
            </div>
            @else
            <div style="margin-top: 16px; padding: 0 16px; padding-top: 16px; border-top: 1px solid #2a2a2a; display: flex; flex-direction: column; gap: 8px;">
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 12px; background: rgba(255,255,255,0.03);">
                    <div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #005fe7, #ff2d78); display: flex; align-items: center; justify-content: center; color: #05050f; font-size: 14px; font-weight: 800;">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <span style="color: #fff; font-size: 14px; font-weight: 500;">{{ Auth::user()->name }}</span>
                </div>
                <!-- Notifications (mobile) -->
                <a href="{{ route('forex.my-orders') }}" style="display: flex; align-items: center; gap: 12px; width: 100%; font-size: 14px; color: #d1d5db; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease; box-sizing: border-box;"
                onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                    <div style="position: relative;">
                        <svg style="width: 16px; height: 16px; color: #ef4444;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        @if($unreadNotificationCount > 0)
                        <span style="position: absolute; top: -6px; right: -6px; width: 16px; height: 16px; background: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 8px; font-weight: 800;">{{ $unreadNotificationCount > 9 ? '9+' : $unreadNotificationCount }}</span>
                        @endif
                    </div>
                    Notifications
                </a>

                @if(Auth::user()->is_admin)
                <a href="/admin" style="display: flex; align-items: center; gap: 12px; width: 100%; font-size: 14px; color: #d1d5db; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease; box-sizing: border-box;"
                onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                    <svg style="width: 16px; height: 16px; color: #005fe7;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Dashboard
                </a>
                @endif
                <a href="{{ route('forex.my-orders') }}" style="display: flex; align-items: center; gap: 12px; width: 100%; font-size: 14px; color: #d1d5db; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease; box-sizing: border-box;"
                onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                    <svg style="width: 16px; height: 16px; color: #005fe7;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    My Orders
                </a>
                <a href="{{ route('forex.my-partnership') }}" style="display: flex; align-items: center; gap: 12px; width: 100%; font-size: 14px; color: #d1d5db; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease; box-sizing: border-box;"
                onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                    <svg style="width: 16px; height: 16px; color: #F59E0B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    My Partnership
                </a>
                <a href="{{ route('forex.profile') }}" style="display: flex; align-items: center; gap: 12px; width: 100%; font-size: 14px; color: #d1d5db; text-decoration: none; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease; box-sizing: border-box;"
                onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                    <svg style="width: 16px; height: 16px; color: #005fe7;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
                    @csrf
                    <button type="submit" style="display: flex; align-items: center; gap: 12px; width: 100%; font-size: 14px; color: #d1d5db; background: transparent; border: none; cursor: pointer; padding: 12px 16px; border-radius: 12px; transition: all 0.2s ease; font-family: inherit; text-align: left; box-sizing: border-box;"
                    onmouseover="this.style.color='#ef4444';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#d1d5db';this.style.background='transparent'">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Logout
                    </button>
                </form>
            </div>
            @endguest
        </div>
    </div>
</div>

<!-- ==================== STORE DRAWER ==================== -->
<div id="storeDrawer" style="position: fixed; inset: 0; z-index: 110; display: none;" class="store-drawer">
        <div id="storeDrawerOverlay" style="position: absolute; inset: 0; background: rgba(0,0,0,0.65); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);"></div>
        <div class="glass-card" style="position: absolute; right: 0; top: 0; bottom: 0; width: 420px; max-width: 90vw; padding: 0; overflow-y: auto; box-shadow: -10px 0 60px rgba(0,0,0,0.6); display: flex; flex-direction: column; border:none; border-radius:0;">
            <!-- Header -->
            <div style="padding: 20px 24px; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; justify-content: space-between; flex-shrink: 0;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="width: 36px; height: 36px; border-radius: 10px; background: rgba(0,95,231,0.15); display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 18px; height: 18px; color: #005fe7;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                    <div>
                        <h3 style="color: #fff; font-size: 16px; font-weight: 600; margin: 0; font-family: 'DM Sans', sans-serif;">Store</h3>
                        <p style="color: rgba(234,234,234,0.35); font-size: 12px; margin: 2px 0 0 0;">Browse our products & source codes</p>
                    </div>
                </div>
                <button id="storeDrawerCloseBtn" style="width: 32px; height: 32px; border-radius: 8px; background: transparent; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #9ca3af; transition: all 0.2s ease;"
                onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.color='#9ca3af';this.style.background='transparent'">
                    <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div style="padding: 20px 24px; flex: 1; overflow-y: auto;">
                <!-- Products Section -->
                <div style="margin-bottom: 28px;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <svg style="width: 16px; height: 16px; color: #005fe7;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span style="color: #EAEAEA; font-size: 13px; font-weight: 600; letter-spacing: 0.5px; text-transform: uppercase;">Expert Advisors</span>
                        </div>
                        <a href="{{ route('forex.products') }}" style="color: #005fe7; font-size: 12px; font-weight: 500; text-decoration: none; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">View All →</a>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 6px;">
                        @forelse($storeProducts as $p)
                        <a href="{{ route('forex.product-detail', $p->slug) }}" style="display: flex; align-items: center; gap: 12px; padding: 10px 12px; border-radius: 10px; text-decoration: none; transition: all 0.2s ease; border: 1px solid rgba(255,255,255,0.04);"
                        onmouseover="this.style.background='rgba(0,95,231,0.1)';this.style.borderColor='rgba(34,85,255,0.2)'" onmouseout="this.style.background='';this.style.borderColor='rgba(255,255,255,0.04)'">
                            <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(0,95,231,0.1); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                @if($p->image)
                                <img src="{{ config('app.storage_url') }}{{ $p->image }}" alt="{{ $p->name }}" style="width: 28px; height: 28px; border-radius: 6px; object-fit: cover;">
                                @else
                                <svg style="width: 18px; height: 18px; color: #005fe7;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                @endif
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <p style="color: #EAEAEA; font-size: 14px; font-weight: 500; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $p->name }}</p>
                                <p style="color: rgba(234,234,234,0.4); font-size: 12px; margin: 1px 0 0 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $p->tagline ?? $p->indicator }}</p>
                            </div>
                            @php $minPrice = collect($p->plans)->min('price'); @endphp
                            @if($minPrice)
                            <span style="color: #005fe7; font-size: 13px; font-weight: 700; white-space: nowrap;">${{ number_format($minPrice, 0) }}</span>
                            @endif
                        </a>
                        @empty
                        <p style="color: rgba(234,234,234,0.3); font-size: 13px; text-align: center; padding: 20px 0;">No products available yet.</p>
                        @endforelse
                    </div>
                </div>

                <div style="height: 1px; background: rgba(255,255,255,0.06); margin: 0 0 28px 0;"></div>

                <!-- Source Codes Section -->
                <div>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <svg style="width: 16px; height: 16px; color: #A855F7;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                            <span style="color: #EAEAEA; font-size: 13px; font-weight: 600; letter-spacing: 0.5px; text-transform: uppercase;">Source Codes</span>
                        </div>
                        <a href="{{ route('forex.source-codes') }}" style="color: #A855F7; font-size: 12px; font-weight: 500; text-decoration: none; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">View All →</a>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 6px;">
                        @forelse($storeSourceCodes as $sc)
                        <a href="{{ route('forex.source-code-detail', $sc->slug) }}" style="display: flex; align-items: center; gap: 12px; padding: 10px 12px; border-radius: 10px; text-decoration: none; transition: all 0.2s ease; border: 1px solid rgba(255,255,255,0.04);"
                        onmouseover="this.style.background='rgba(168,85,247,0.08)';this.style.borderColor='rgba(168,85,247,0.2)'" onmouseout="this.style.background='';this.style.borderColor='rgba(255,255,255,0.04)'">
                            <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(168,85,247,0.08); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                @if($sc->image)
                                <img src="{{ config('app.storage_url') }}{{ $sc->image }}" alt="{{ $sc->name }}" style="width: 28px; height: 28px; border-radius: 6px; object-fit: cover;">
                                @else
                                <svg style="width: 18px; height: 18px; color: #A855F7;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                                @endif
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <p style="color: #EAEAEA; font-size: 14px; font-weight: 500; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $sc->name }}</p>
                                <p style="color: rgba(234,234,234,0.4); font-size: 12px; margin: 1px 0 0 0;">{{ $sc->language ?? $sc->category ?? 'Source Code' }}</p>
                            </div>
                            @if($sc->price)
                            <span style="color: #005fe7; font-size: 13px; font-weight: 700; white-space: nowrap;">${{ number_format($sc->price, 0) }}</span>
                            @endif
                        </a>
                        @empty
                        <p style="color: rgba(234,234,234,0.3); font-size: 13px; text-align: center; padding: 20px 0;">No source codes available yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Footer CTA -->
            <div style="padding: 16px 24px; border-top: 1px solid rgba(255,255,255,0.06); flex-shrink: 0; display: flex; flex-direction: column; gap: 8px;">
                <a href="{{ route('forex.products') }}" style="display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; padding: 12px; background: linear-gradient(135deg, #2255ff, #005fe7); color: #fff; font-weight: 600; font-size: 14px; border-radius: 10px; text-decoration: none; transition: all 0.3s; box-sizing: border-box;" onmouseover="this.style.boxShadow='0 6px 25px rgba(34,85,255,0.25)';this.style.transform='translateY(-1px)'" onmouseout="this.style.boxShadow='none';this.style.transform=''">
                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Browse All Products
                </a>
                <a href="{{ route('forex.source-codes') }}" style="display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; padding: 11px; background: transparent; color: rgba(234,234,234,0.6); font-weight: 500; font-size: 14px; border-radius: 10px; border: 1px solid rgba(168,85,247,0.2); text-decoration: none; transition: all 0.3s; box-sizing: border-box;" onmouseover="this.style.borderColor='rgba(168,85,247,0.4)';this.style.color='#EAEAEA';this.style.background='rgba(168,85,247,0.04)'" onmouseout="this.style.borderColor='rgba(168,85,247,0.2)';this.style.color='rgba(234,234,234,0.6)';this.style.background='transparent'">
                    <svg style="width: 16px; height: 16px; color: #A855F7;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                    Browse All Source Codes
                </a>
            </div>
    </div>
</div>

<style>
@media (min-width: 1024px) {
    .desktop-nav { display: flex !important; }
    .mobile-menu-btn { display: none !important; }
    .lang-desktop { display: inline-block !important; }
    .store-desktop-btn { display: inline-flex !important; }
}
@media (min-width: 640px) {
    .login-desktop { display: inline-flex !important; }
    .signup-desktop { display: inline-flex !important; }
    .auth-desktop { display: flex !important; }
    .lang-desktop { display: inline-block !important; }
}

/* Dropdown hover */
.ea-dropdown-group:hover .ea-dropdown-menu {
    opacity: 1 !important;
    visibility: visible !important;
}
.ea-dropdown-group:hover .dropdown-chevron {
    transform: rotate(180deg) !important;
    color: #005fe7 !important;
}

/* Profile dropdown hover */
.profile-group:hover .profile-dropdown {
    opacity: 1 !important;
    visibility: visible !important;
}
.profile-group:hover .profile-chevron {
    transform: rotate(180deg) !important;
}

/* Nav link underline on hover */
.nav-underline {
    position: absolute;
    bottom: 0;
    left: 16px;
    right: 16px;
    height: 2px;
    background: #005fe7;
    transform: scaleX(0);
    transition: transform 0.3s ease;
    transform-origin: left;
}
a:hover > .nav-underline {
    transform: scaleX(1) !important;
}

/* Logo hover */
/* Notification bell responsive */
@media (max-width: 639px) {
    .notif-desktop { display: none !important; }
}

/* Notification badge pulse animation */
@keyframes notifPulse {
    0%, 100% { box-shadow: 0 0 8px rgba(239,68,68,0.5); }
    50% { box-shadow: 0 0 16px rgba(239,68,68,0.8), 0 0 24px rgba(239,68,68,0.3); }
}
#notifBadge {
    animation: notifPulse 2s ease-in-out infinite;
}

.logo-group:hover .logo-diamond {
    animation: float 1.5s ease-in-out infinite !important;
    filter: brightness(1.3) !important;
}
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-3px); }
}

/* Cart hover effect */
a[href*="cart"]:hover svg {
    transform: scale(1.1) !important;
}

/* Scrollbar for mobile drawer */
.mobile-drawer div[style*="overflow-y"]::-webkit-scrollbar {
    width: 4px;
}
.mobile-drawer div[style*="overflow-y"]::-webkit-scrollbar-track {
    background: transparent;
}
.mobile-drawer div[style*="overflow-y"]::-webkit-scrollbar-thumb {
    background: #2a2a2a;
    border-radius: 2px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuBtn = document.getElementById('mobileMenuBtn');
    const drawer = document.getElementById('mobileDrawer');
    const overlay = document.getElementById('drawerOverlay');
    const closeBtn = document.getElementById('drawerCloseBtn');
    const hamburger = document.getElementById('hamburgerIcon');
    const closeIcon = document.getElementById('closeIcon');

    if (menuBtn && drawer) {
        function openDrawer() {
            drawer.style.display = 'block';
            document.body.style.overflow = 'hidden';
            if (hamburger) hamburger.style.display = 'none';
            if (closeIcon) closeIcon.style.display = 'block';
        }
        function closeDrawer() {
            drawer.style.display = 'none';
            document.body.style.overflow = '';
            if (hamburger) hamburger.style.display = 'block';
            if (closeIcon) closeIcon.style.display = 'none';
        }
        menuBtn.addEventListener('click', openDrawer);
        if (overlay) overlay.addEventListener('click', closeDrawer);
        if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
        drawer.querySelectorAll('a').forEach(function(a) { a.addEventListener('click', closeDrawer); });

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeDrawer();
        });
    }

    // Update mobile cart badge
    function updateMobileBadge() {
        const badge = document.getElementById('cartBadge');
        const mobileBadge = document.getElementById('mobileCartBadge');
        if (!mobileBadge || !badge) return;
        const count = badge.textContent;
        if (count && count !== '0') {
            mobileBadge.style.display = 'inline-block';
            mobileBadge.textContent = count;
        } else {
            mobileBadge.style.display = 'none';
        }
    }
    
    // Watch for cart badge updates
    const observer = new MutationObserver(updateMobileBadge);
    const cartBadge = document.getElementById('cartBadge');
    if (cartBadge) {
        observer.observe(cartBadge, { childList: true, characterData: true, subtree: true });
    }
    updateMobileBadge();

    // ==================== NOTIFICATION BELL ====================
    const notifBtn = document.getElementById('notifBellBtn');
    const notifDropdown = document.getElementById('notifDropdown');

    if (notifBtn && notifDropdown) {
        function toggleNotif(e) {
            e.stopPropagation();
            const isOpen = notifDropdown.style.visibility === 'visible';
            if (isOpen) {
                notifDropdown.style.opacity = '0';
                notifDropdown.style.visibility = 'hidden';
            } else {
                notifDropdown.style.opacity = '1';
                notifDropdown.style.visibility = 'visible';
            }
        }
        notifBtn.addEventListener('click', toggleNotif);

        // Close on Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && notifDropdown.style.visibility === 'visible') {
                notifDropdown.style.opacity = '0';
                notifDropdown.style.visibility = 'hidden';
            }
        });

        // Close when clicking outside
        document.addEventListener('click', function(e) {
            const notifGroup = notifBtn.closest('.notif-desktop');
            if (notifGroup && !notifGroup.contains(e.target)) {
                notifDropdown.style.opacity = '0';
                notifDropdown.style.visibility = 'hidden';
            }
        });
    }

    // Cart icon hover
    const cartLinks = document.querySelectorAll('a[href*="cart"]');
    cartLinks.forEach(function(link) {
        link.addEventListener('mouseenter', function() {
            const svg = this.querySelector('svg');
            if (svg) svg.style.transform = 'scale(1.1)';
        });
        link.addEventListener('mouseleave', function() {
            const svg = this.querySelector('svg');
            if (svg) svg.style.transform = 'scale(1)';
        });
    });

    // ==================== STORE DRAWER ====================
    const storeBtn = document.getElementById('storeDrawerBtn');
    const storeDrawer = document.getElementById('storeDrawer');
    const storeOverlay = document.getElementById('storeDrawerOverlay');
    const storeCloseBtn = document.getElementById('storeDrawerCloseBtn');

    if (storeBtn && storeDrawer) {
        function openStoreDrawer() {
            storeDrawer.style.display = 'block';
            document.body.style.overflow = 'hidden';
            // Animate in
            const panel = storeDrawer.querySelector('div[style*="position: absolute; right"]');
            if (panel) {
                panel.style.transform = 'translateX(100%)';
                panel.style.transition = 'transform 0.3s ease';
                requestAnimationFrame(function() {
                    panel.style.transform = 'translateX(0)';
                });
            }
        }
        function closeStoreDrawer() {
            const panel = storeDrawer.querySelector('div[style*="position: absolute; right"]');
            if (panel) {
                panel.style.transform = 'translateX(100%)';
                setTimeout(function() {
                    storeDrawer.style.display = 'none';
                    document.body.style.overflow = '';
                }, 250);
            } else {
                storeDrawer.style.display = 'none';
                document.body.style.overflow = '';
            }
        }
        storeBtn.addEventListener('click', openStoreDrawer);
        if (storeOverlay) storeOverlay.addEventListener('click', closeStoreDrawer);
        if (storeCloseBtn) storeCloseBtn.addEventListener('click', closeStoreDrawer);

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && storeDrawer.style.display === 'block') {
                closeStoreDrawer();
            }
        });
    }
});
</script>
