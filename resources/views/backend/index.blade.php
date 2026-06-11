@extends('backend.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

.dsb-body {
    font-family: 'Inter', sans-serif;
    position: relative;
}
.dsb-body::before {
    content: '';
    position: fixed;
    top: -50%; left: -50%;
    width: 200%; height: 200%;
    background: radial-gradient(ellipse at 20% 50%, rgba(99,102,241,0.03) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(139,92,246,0.03) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 80%, rgba(59,130,246,0.02) 0%, transparent 50%);
    pointer-events: none;
    z-index: 0;
}

/* ─── Header Hero ─── */
.dsb-header {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 40%, #334155 100%);
    border-radius: 20px;
    padding: 2rem 2.2rem;
    position: relative;
    overflow: hidden;
    isolation: isolate;
}
.dsb-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 600px 400px at 0% 100%, rgba(99,102,241,0.15), transparent),
                radial-gradient(ellipse 400px 400px at 100% 0%, rgba(139,92,246,0.1), transparent);
    z-index: -1;
}
.dsb-header::after {
    content: '';
    position: absolute;
    top: -60px; right: -60px;
    width: 200px; height: 200px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(99,102,241,0.08), transparent 70%);
    z-index: -1;
}
.dsb-header-grid {
    position: absolute;
    inset: 0;
    background-image: linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                      linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
    background-size: 40px 40px;
    z-index: -1;
    opacity: 0.5;
}

/* ─── Stat Cards ─── */
.dsb-stat {
    background: #fff;
    border: none;
    border-radius: 16px;
    padding: 1.25rem 1.4rem;
    position: relative;
    overflow: hidden;
    height: 100%;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    box-shadow: 0 1px 2px rgba(0,0,0,0.04), 0 1px 4px rgba(0,0,0,0.04);
}
.dsb-stat:hover {
    transform: translateY(-6px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0,0,0,0.08), 0 6px 12px rgba(99,102,241,0.06);
}
.dsb-stat-glow {
    position: absolute;
    top: -30px; right: -30px;
    width: 100px; height: 100px;
    border-radius: 50%;
    opacity: 0.06;
    transition: all 0.6s ease;
    pointer-events: none;
}
.dsb-stat:hover .dsb-stat-glow {
    transform: scale(2.5);
    opacity: 0.1;
}
.dsb-stat-icon {
    width: 46px; height: 46px;
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.25rem;
    flex-shrink: 0;
    transition: all 0.4s ease;
    position: relative;
}
.dsb-stat:hover .dsb-stat-icon {
    transform: scale(1.1) rotate(-5deg);
    box-shadow: 0 8px 24px rgba(0,0,0,0.1);
}
.dsb-stat-num {
    font-size: 1.7rem;
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.5px;
}
.dsb-stat-label {
    color: #94a3b8;
    font-size: 0.78rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}
.dsb-stat-sub {
    font-size: 0.7rem;
    font-weight: 600;
    margin-top: 3px;
    display: inline-flex;
    align-items: center;
    gap: 3px;
}

/* ─── Content Cards ─── */
.dsb-card {
    background: #fff;
    border: none;
    border-radius: 16px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.04), 0 1px 4px rgba(0,0,0,0.04);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    height: 100%;
    overflow: hidden;
}
.dsb-card:hover {
    box-shadow: 0 12px 32px rgba(0,0,0,0.06), 0 4px 8px rgba(0,0,0,0.04);
    transform: translateY(-3px);
}
.dsb-card-hd {
    padding: 1.1rem 1.4rem;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-weight: 700;
    font-size: 0.88rem;
    letter-spacing: -0.2px;
}
.dsb-card-hd i:first-child {
    font-size: 1.1rem;
    margin-right: 0.6rem;
}
.dsb-card-bd {
    padding: 0;
}

/* ─── Recent Items List ─── */
.dsb-item {
    display: flex;
    align-items: center;
    gap: 0.85rem;
    padding: 0.75rem 1.4rem;
    border-bottom: 1px solid #f8fafc;
    transition: all 0.25s ease;
    text-decoration: none;
    color: inherit;
    position: relative;
}
.dsb-item:last-child { border-bottom: none; }
.dsb-item::before {
    content: '';
    position: absolute;
    left: 0; top: 4px; bottom: 4px;
    width: 3px;
    border-radius: 0 3px 3px 0;
    opacity: 0;
    transition: opacity 0.25s;
}
.dsb-item:hover {
    background: rgba(99,102,241,0.03);
    padding-left: 1.7rem;
}
.dsb-item:hover::before { opacity: 1; }
.dsb-item-av {
    width: 38px; height: 38px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.95rem;
    font-weight: 700;
    flex-shrink: 0;
    transition: all 0.3s;
}
.dsb-item:hover .dsb-item-av {
    transform: scale(1.08);
}
.dsb-item-info { flex: 1; min-width: 0; }
.dsb-item-title {
    font-weight: 600;
    font-size: 0.84rem;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    display: block;
}
.dsb-item-meta {
    font-size: 0.72rem;
    color: #94a3b8;
    margin-top: 1px;
}
.dsb-item-meta i { margin-right: 3px; }
.dsb-badge {
    font-size: 0.65rem;
    padding: 0.15rem 0.65rem;
    border-radius: 20px;
    font-weight: 600;
    flex-shrink: 0;
    white-space: nowrap;
}

/* ─── Quick Actions ─── */
.dsb-qa-wrap {
    overflow-x: auto;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch;
    padding-bottom: 4px;
}
.dsb-qa-wrap::-webkit-scrollbar { height: 3px; }
.dsb-qa-wrap::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 3px; }
.dsb-qa {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.4rem 0.75rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    text-decoration: none;
    color: #475569;
    font-weight: 600;
    font-size: 0.72rem;
    transition: all 0.25s ease;
    white-space: nowrap;
}
.dsb-qa:hover {
    background: #fff;
    border-color: #6366f1;
    color: #6366f1;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(99,102,241,0.1);
}
.dsb-qa i { font-size: 0.78rem; }

/* ─── Animations ─── */
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-6px); }
}
@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.dsb-fade { animation: fadeUp 0.5s ease forwards; opacity: 0; }
.dsb-fade:nth-child(2) { animation-delay: 0.05s; }
.dsb-fade:nth-child(3) { animation-delay: 0.1s; }
.dsb-fade:nth-child(4) { animation-delay: 0.15s; }
.dsb-fade:nth-child(5) { animation-delay: 0.2s; }
.dsb-fade:nth-child(6) { animation-delay: 0.25s; }
.dsb-fade:nth-child(7) { animation-delay: 0.3s; }
.dsb-fade:nth-child(8) { animation-delay: 0.35s; }
.dsb-fade:nth-child(9) { animation-delay: 0.4s; }

/* ─── Responsive ─── */
@media (max-width: 768px) {
    .dsb-header { padding: 1.5rem; }
    .dsb-stat { padding: 1rem; }
    .dsb-stat-num { font-size: 1.3rem; }
    .dsb-stat-icon { width: 38px; height: 38px; font-size: 1rem; }
    .dsb-item { padding: 0.6rem 1rem; }
}
</style>

<div class="dsb-body container-fluid py-3">

    {{-- ─── HEADER ─── --}}
    <div class="dsb-header mb-4 dsb-fade">
        <div class="dsb-header-grid"></div>
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <div class="d-flex align-items-center gap-3 mb-1">
                    <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;font-size:1.4rem;color:#fff;box-shadow:0 8px 24px rgba(99,102,241,0.3);">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0" style="color:#fff;letter-spacing:-0.3px;">Dashboard</h4>
                        <p class="mb-0" style="color:rgba(255,255,255,0.6);font-size:0.82rem;">
                            Welcome back, <strong style="color:#a5b4fc;">{{ auth()->user()->name }}</strong>
                            @if($account)
                                <span style="color:rgba(255,255,255,0.35);"> &middot; {{ $account->name }}</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span style="display:inline-flex;align-items:center;gap:0.4rem;padding:0.4rem 1rem;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.08);border-radius:50px;color:rgba(255,255,255,0.7);font-weight:500;font-size:0.78rem;">
                    <i class="bi bi-calendar3"></i> {{ now()->format('M d, Y') }}
                </span>
            </div>
        </div>
        {{-- Mini stats row inside header --}}
        <div class="row g-2 mt-3 pt-3" style="border-top:1px solid rgba(255,255,255,0.06);">
            <div class="col-4 col-md-2">
                <div style="font-size:0.65rem;color:rgba(255,255,255,0.4);text-transform:uppercase;letter-spacing:0.5px;">Projects</div>
                <div style="font-size:1.2rem;font-weight:700;color:#fff;">{{ $activeProjects }}/{{ $projectsCount }}</div>
            </div>
            <div class="col-4 col-md-2">
                <div style="font-size:0.65rem;color:rgba(255,255,255,0.4);text-transform:uppercase;letter-spacing:0.5px;">Posts</div>
                <div style="font-size:1.2rem;font-weight:700;color:#fff;">{{ $publishedPosts }}/{{ $postsCount }}</div>
            </div>
            <div class="col-4 col-md-2">
                <div style="font-size:0.65rem;color:rgba(255,255,255,0.4);text-transform:uppercase;letter-spacing:0.5px;">Messages</div>
                <div style="font-size:1.2rem;font-weight:700;color:#fff;">{{ $contactsCount }}</div>
            </div>
            <div class="col-4 col-md-2">
                <div style="font-size:0.65rem;color:rgba(255,255,255,0.4);text-transform:uppercase;letter-spacing:0.5px;">Users</div>
                <div style="font-size:1.2rem;font-weight:700;color:#fff;">{{ $usersCount }}</div>
            </div>
            <div class="col-4 col-md-2">
                <div style="font-size:0.65rem;color:rgba(255,255,255,0.4);text-transform:uppercase;letter-spacing:0.5px;">Skills</div>
                <div style="font-size:1.2rem;font-weight:700;color:#fff;">{{ $activeSkills }}/{{ $skillsCount }}</div>
            </div>
            <div class="col-4 col-md-2">
                <div style="font-size:0.65rem;color:rgba(255,255,255,0.4);text-transform:uppercase;letter-spacing:0.5px;">FAQs</div>
                <div style="font-size:1.2rem;font-weight:700;color:#fff;">{{ $activeFaqs }}/{{ $faqsCount }}</div>
            </div>
        </div>
    </div>

    {{-- ─── STAT CARDS ─── --}}
    <div class="row g-3 mb-4">
        @php
            $stats = [
                ['count' => $projectsCount, 'active' => $activeProjects, 'label' => 'Projects', 'icon' => 'bi-folder2-open', 'color' => '#6366f1', 'bg' => 'rgba(99,102,241,0.08)'],
                ['count' => $servicesCount, 'active' => $activeServices, 'label' => 'Services', 'icon' => 'bi-gear', 'color' => '#10b981', 'bg' => 'rgba(16,185,129,0.08)'],
                ['count' => $experiencesCount, 'active' => $activeExperiences, 'label' => 'Experiences', 'icon' => 'bi-briefcase', 'color' => '#f59e0b', 'bg' => 'rgba(245,158,11,0.08)'],
                ['count' => $skillsCount, 'active' => $activeSkills, 'label' => 'Skills', 'icon' => 'bi-lightning-charge', 'color' => '#8b5cf6', 'bg' => 'rgba(139,92,246,0.08)'],
                ['count' => $testimonialsCount, 'active' => $activeTestimonials, 'label' => 'Testimonials', 'icon' => 'bi-chat-quote', 'color' => '#ec4899', 'bg' => 'rgba(236,72,153,0.08)'],
            ];
        @endphp
        @foreach($stats as $s)
        <div class="col-6 col-md-4 col-lg col-xl dsb-fade">
            <div class="dsb-stat">
                <div class="dsb-stat-glow" style="background:radial-gradient(circle, {{ $s['color'] }}, transparent);"></div>
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="dsb-stat-icon" style="background:{{ $s['bg'] }}; color:{{ $s['color'] }};">
                        <i class="bi {{ $s['icon'] }}"></i>
                    </div>
                    <div>
                        <div class="dsb-stat-num">{{ $s['count'] }}</div>
                        <div class="dsb-stat-label">{{ $s['label'] }}</div>
                        <div class="dsb-stat-sub" style="color:{{ $s['color'] }};"><i class="bi bi-check-circle-fill"></i> {{ $s['active'] }} active</div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ─── STAT CARDS ROW 2 ─── --}}
    <div class="row g-3 mb-4">
        @php
            $stats2 = [
                ['count' => $postsCount, 'sub' => "$publishedPosts published", 'label' => 'Blog Posts', 'icon' => 'bi-pencil-square', 'color' => '#3b82f6', 'bg' => 'rgba(59,130,246,0.08)'],
                ['count' => $faqsCount, 'sub' => "$activeFaqs active", 'label' => 'FAQs', 'icon' => 'bi-question-circle', 'color' => '#f97316', 'bg' => 'rgba(249,115,22,0.08)'],
                ['count' => $contactsCount, 'sub' => 'all inbox', 'label' => 'Messages', 'icon' => 'bi-envelope', 'color' => '#ef4444', 'bg' => 'rgba(239,68,68,0.08)'],
                ['count' => $usersCount, 'sub' => 'registered', 'label' => 'Users', 'icon' => 'bi-people', 'color' => '#0ea5e9', 'bg' => 'rgba(14,165,233,0.08)'],
            ];
        @endphp
        @foreach($stats2 as $s)
        <div class="col-6 col-md-3 dsb-fade">
            <div class="dsb-stat">
                <div class="dsb-stat-glow" style="background:radial-gradient(circle, {{ $s['color'] }}, transparent);"></div>
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="dsb-stat-icon" style="background:{{ $s['bg'] }}; color:{{ $s['color'] }};">
                        <i class="bi {{ $s['icon'] }}"></i>
                    </div>
                    <div>
                        <div class="dsb-stat-num">{{ $s['count'] }}</div>
                        <div class="dsb-stat-label">{{ $s['label'] }}</div>
                        <div class="dsb-stat-sub" style="color:{{ $s['color'] }};"><i class="bi bi-check-circle-fill"></i> {{ $s['sub'] }}</div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ─── RECENT ITEMS GRID ─── --}}
    <div class="row g-4">

        {{-- Recent Projects --}}
        <div class="col-lg-6 dsb-fade">
            <div class="dsb-card">
                <div class="dsb-card-hd">
                    <span><i class="bi bi-folder2-open" style="color:#6366f1;"></i> Recent Projects</span>
                    <a href="{{ url('/admin/projects') }}" class="btn btn-sm" style="border-radius:50px;border:1px solid #e2e8f0;color:#64748b;font-weight:600;font-size:0.75rem;padding:0.3rem 0.9rem;background:transparent;">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="dsb-card-bd">
                    @forelse($recentProjects as $p)
                        <a href="{{ url('/admin/projects/edit/' . $p->id) }}" class="dsb-item" style="--accent:#6366f1;">
                            <span class="dsb-item-av" style="background:rgba(99,102,241,0.08); color:#6366f1;">
                                <i class="bi bi-folder2"></i>
                            </span>
                            <span class="dsb-item-info">
                                <span class="dsb-item-title">{{ $p->title }}</span>
                                <span class="dsb-item-meta">
                                    @if($p->category)<span><i class="bi bi-tag"></i>{{ $p->category }} &middot; </span>@endif
                                    <span><i class="bi bi-clock"></i>{{ $p->created_at->diffForHumans() }}</span>
                                </span>
                            </span>
                            <span class="dsb-badge {{ $p->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $p->is_active ? 'Active' : 'Draft' }}</span>
                        </a>
                    @empty
                        <div class="text-center py-4 text-muted small"><i class="bi bi-folder2-open fs-2 d-block mb-2"></i>No projects yet</div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Recent Posts --}}
        <div class="col-lg-6 dsb-fade">
            <div class="dsb-card">
                <div class="dsb-card-hd">
                    <span><i class="bi bi-pencil-square" style="color:#3b82f6;"></i> Recent Blog Posts</span>
                    <a href="{{ url('/admin/blog') }}" class="btn btn-sm" style="border-radius:50px;border:1px solid #e2e8f0;color:#64748b;font-weight:600;font-size:0.75rem;padding:0.3rem 0.9rem;background:transparent;">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="dsb-card-bd">
                    @forelse($recentPosts as $p)
                        <a href="{{ url('/admin/blog/edit/' . $p->id) }}" class="dsb-item" style="--accent:#3b82f6;">
                            <span class="dsb-item-av" style="background:rgba(59,130,246,0.08); color:#3b82f6;">
                                <i class="bi bi-file-text"></i>
                            </span>
                            <span class="dsb-item-info">
                                <span class="dsb-item-title">{{ $p->title }}</span>
                                <span class="dsb-item-meta">
                                    @if($p->category)<span><i class="bi bi-folder"></i>{{ $p->category }} &middot; </span>@endif
                                    <span><i class="bi bi-clock"></i>{{ $p->created_at->diffForHumans() }}</span>
                                </span>
                            </span>
                            <span class="dsb-badge {{ $p->is_published ? 'text-bg-success' : 'text-bg-warning' }}">{{ $p->is_published ? 'Published' : 'Draft' }}</span>
                        </a>
                    @empty
                        <div class="text-center py-4 text-muted small"><i class="bi bi-pencil-square fs-2 d-block mb-2"></i>No posts yet</div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Recent Services --}}
        <div class="col-lg-6 dsb-fade">
            <div class="dsb-card">
                <div class="dsb-card-hd">
                    <span><i class="bi bi-gear" style="color:#10b981;"></i> Recent Services</span>
                    <a href="{{ url('/admin/services') }}" class="btn btn-sm" style="border-radius:50px;border:1px solid #e2e8f0;color:#64748b;font-weight:600;font-size:0.75rem;padding:0.3rem 0.9rem;background:transparent;">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="dsb-card-bd">
                    @forelse($recentServices as $s)
                        <a href="{{ url('/admin/services/edit/' . $s->id) }}" class="dsb-item" style="--accent:#10b981;">
                            <span class="dsb-item-av" style="background:rgba(16,185,129,0.08); color:#10b981;">
                                <i class="bi bi-gear"></i>
                            </span>
                            <span class="dsb-item-info">
                                <span class="dsb-item-title">{{ $s->title }}</span>
                                <span class="dsb-item-meta">
                                    <span><i class="bi bi-clock"></i>{{ $s->created_at->diffForHumans() }}</span>
                                </span>
                            </span>
                            <span class="dsb-badge {{ $s->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $s->is_active ? 'Active' : 'Inactive' }}</span>
                        </a>
                    @empty
                        <div class="text-center py-4 text-muted small"><i class="bi bi-gear fs-2 d-block mb-2"></i>No services yet</div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Recent Messages --}}
        <div class="col-lg-6 dsb-fade">
            <div class="dsb-card">
                <div class="dsb-card-hd">
                    <span><i class="bi bi-chat-dots" style="color:#ef4444;"></i> Recent Messages</span>
                    <a href="{{ url('/admin/contact') }}" class="btn btn-sm" style="border-radius:50px;border:1px solid #e2e8f0;color:#64748b;font-weight:600;font-size:0.75rem;padding:0.3rem 0.9rem;background:transparent;">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="dsb-card-bd">
                    @forelse($recentMessages as $m)
                        <button type="button" class="dsb-item" onclick="openMessageModal(this)" data-msg-name="{{ htmlspecialchars($m->name) }}" data-msg-email="{{ htmlspecialchars($m->email) }}" data-msg-content="{{ htmlspecialchars($m->message) }}" style="cursor:pointer;width:100%;border:none;background:transparent;text-align:left;font-family:inherit;color:inherit;--accent:#ef4444;">
                            <span class="dsb-item-av" style="background:rgba(239,68,68,0.08); color:#ef4444;">
                                {{ strtoupper(substr($m->name, 0, 1)) }}
                            </span>
                            <span class="dsb-item-info">
                                <span class="dsb-item-title">{{ $m->name }}</span>
                                <span class="dsb-item-meta">
                                    <span><i class="bi bi-envelope"></i>{{ $m->email }} &middot; </span>
                                    <span><i class="bi bi-clock"></i>{{ $m->created_at->diffForHumans() }}</span>
                                </span>
                            </span>
                            <span class="dsb-badge text-bg-primary" style="font-size:0.65rem;"><i class="bi bi-eye"></i></span>
                        </button>
                    @empty
                        <div class="text-center py-4 text-muted small"><i class="bi bi-inbox fs-2 d-block mb-2"></i>No messages yet</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- ─── MESSAGE MODAL ─── --}}
    <div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow" style="border-radius:16px;overflow:hidden;">
                <div class="modal-header" style="background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;padding:1.2rem 1.5rem;">
                    <h5 class="modal-title fw-semibold"><i class="bi bi-person-circle me-2"></i><span id="msgName"></span></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-4 py-4">
                    <div class="mb-3 pb-3 border-bottom d-flex align-items-center gap-2">
                        <span style="display:inline-flex;align-items:center;gap:0.4rem;padding:0.25rem 0.8rem;background:rgba(99,102,241,0.06);border-radius:8px;color:#6366f1;font-weight:500;font-size:0.82rem;">
                            <i class="bi bi-envelope-fill"></i> <span id="msgEmail"></span>
                        </span>
                    </div>
                    <div>
                        <small class="text-muted fw-semibold d-block mb-2" style="font-size:0.72rem;text-transform:uppercase;letter-spacing:0.5px;">Message</small>
                        <p class="mb-0 lh-base" id="msgContent" style="white-space:pre-wrap;color:#334155;font-size:0.92rem;"></p>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" style="background:#f1f5f9;color:#64748b;border:none;font-weight:600;" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ─── QUICK ACTIONS ─── --}}
    <div class="row mt-4 dsb-fade">
        <div class="col-12">
            <div class="dsb-card">
                <div class="dsb-card-hd">
                    <span><i class="bi bi-lightning-charge" style="color:#f59e0b;"></i> Quick Actions</span>
                </div>
                <div class="p-3 dsb-qa-wrap">
                    <div class="d-flex flex-nowrap gap-2">
                        <a href="{{ url('/admin/projects/create') }}" class="dsb-qa"><i class="bi bi-plus-circle" style="color:#6366f1;"></i> Project</a>
                        <a href="{{ url('/admin/services/create') }}" class="dsb-qa"><i class="bi bi-plus-circle" style="color:#10b981;"></i> Service</a>
                        <a href="{{ url('/admin/experiences/create') }}" class="dsb-qa"><i class="bi bi-plus-circle" style="color:#f59e0b;"></i> Experience</a>
                        <a href="{{ url('/admin/skills/create') }}" class="dsb-qa"><i class="bi bi-plus-circle" style="color:#8b5cf6;"></i> Skill</a>
                        <a href="{{ url('/admin/testimonials/create') }}" class="dsb-qa"><i class="bi bi-plus-circle" style="color:#ec4899;"></i> Testimonial</a>
                        <a href="{{ url('/admin/blog/create') }}" class="dsb-qa"><i class="bi bi-plus-circle" style="color:#3b82f6;"></i> Blog Post</a>
                        <a href="{{ url('/admin/faqs/create') }}" class="dsb-qa"><i class="bi bi-plus-circle" style="color:#f97316;"></i> FAQ</a>
                        <a href="{{ url('/admin/account/edit') }}" class="dsb-qa"><i class="bi bi-pencil" style="color:#0ea5e9;"></i> Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
function openMessageModal(btn) {
    document.getElementById('msgName').textContent = btn.getAttribute('data-msg-name');
    document.getElementById('msgEmail').textContent = btn.getAttribute('data-msg-email');
    document.getElementById('msgContent').textContent = btn.getAttribute('data-msg-content');
    var el = document.getElementById('messageModal');
    if (el) {
        var modal = bootstrap.Modal.getOrCreateInstance(el);
        modal.show();
    }
}
</script>
@endsection