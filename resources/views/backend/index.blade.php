@extends('backend.app')

@section('content')

<style>
.stat-card {
    background: #fff;
    border: none;
    border-radius: 12px;
    padding: 1.25rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
    overflow: hidden;
    height: 100%;
}
.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.1);
}
.stat-card .stat-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}
.stat-card .stat-number {
    font-size: 1.6rem;
    font-weight: 800;
    line-height: 1.2;
    letter-spacing: -0.5px;
}
.stat-card .stat-label {
    color: #64748b;
    font-size: 0.8rem;
    font-weight: 500;
}
.stat-card .stat-sub {
    font-size: 0.72rem;
    font-weight: 500;
    margin-top: 2px;
}
.card-modern {
    background: #fff;
    border: none;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    height: 100%;
}
.card-modern:hover {
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transform: translateY(-2px);
}
.card-modern .card-header {
    background: transparent;
    border-bottom: 1px solid #e2e8f0;
    padding: 1rem 1.25rem;
    font-weight: 600;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.card-modern .card-body {
    padding: 0;
}
.recent-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.7rem 1.25rem;
    border-bottom: 1px solid #f1f5f9;
    transition: background 0.2s;
    text-decoration: none;
    color: inherit;
}
.recent-item:last-child {
    border-bottom: none;
}
.recent-item:hover {
    background: rgba(99,102,241,0.03);
}
.recent-item .av {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    font-weight: 700;
    flex-shrink: 0;
}
.recent-item .info {
    flex: 1;
    min-width: 0;
}
.recent-item .info .title {
    font-weight: 600;
    font-size: 0.85rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.recent-item .info .meta {
    font-size: 0.75rem;
    color: #94a3b8;
}
.recent-item .badge-status {
    font-size: 0.68rem;
    padding: 0.15rem 0.6rem;
    border-radius: 20px;
    font-weight: 600;
    flex-shrink: 0;
}
.quick-action {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.6rem 0.9rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    text-decoration: none;
    color: #1e293b;
    font-weight: 500;
    font-size: 0.85rem;
    transition: all 0.2s;
}
.quick-action:hover {
    background: rgba(99,102,241,0.08);
    border-color: #6366f1;
    color: #6366f1;
    transform: translateY(-1px);
}
</style>

<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="mb-4">
        <div class="p-4 rounded-4 shadow" style="background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%); color: #fff;">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h3 class="fw-bold mb-1 d-flex align-items-center gap-2">
                        <i class="bi bi-speedometer2" style="color: #6366f1;"></i>
                        Dashboard
                    </h3>
                    <p class="mb-0 opacity-75 small">
                        Welcome back, <strong>{{ auth()->user()->name }}</strong>
                        @if($account)
                            &mdash; <span class="opacity-50">{{ $account->name }}</span>
                        @endif
                    </p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(99,102,241,0.2); color: #a5b4fc; font-weight:500;">
                        <i class="bi bi-calendar3 me-1"></i> {{ now()->format('M d, Y') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Row 1: Content Entities --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-4 col-lg-3 col-xl">
            <div class="stat-card">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="stat-icon" style="background: rgba(99,102,241,0.1); color: #6366f1;">
                        <i class="bi bi-folder2-open"></i>
                    </div>
                    <div>
                        <div class="stat-number">{{ $projectsCount }}</div>
                        <div class="stat-label">Projects</div>
                        <div class="stat-sub text-success"><i class="bi bi-check-circle-fill me-1"></i>{{ $activeProjects }} active</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl">
            <div class="stat-card">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="stat-icon" style="background: rgba(16,185,129,0.1); color: #10b981;">
                        <i class="bi bi-gear"></i>
                    </div>
                    <div>
                        <div class="stat-number">{{ $servicesCount }}</div>
                        <div class="stat-label">Services</div>
                        <div class="stat-sub text-success"><i class="bi bi-check-circle-fill me-1"></i>{{ $activeServices }} active</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl">
            <div class="stat-card">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="stat-icon" style="background: rgba(245,158,11,0.1); color: #f59e0b;">
                        <i class="bi bi-briefcase"></i>
                    </div>
                    <div>
                        <div class="stat-number">{{ $experiencesCount }}</div>
                        <div class="stat-label">Experiences</div>
                        <div class="stat-sub text-success"><i class="bi bi-check-circle-fill me-1"></i>{{ $activeExperiences }} active</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl">
            <div class="stat-card">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="stat-icon" style="background: rgba(139,92,246,0.1); color: #8b5cf6;">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <div>
                        <div class="stat-number">{{ $skillsCount }}</div>
                        <div class="stat-label">Skills</div>
                        <div class="stat-sub text-success"><i class="bi bi-check-circle-fill me-1"></i>{{ $activeSkills }} active</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl">
            <div class="stat-card">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="stat-icon" style="background: rgba(236,72,153,0.1); color: #ec4899;">
                        <i class="bi bi-chat-quote"></i>
                    </div>
                    <div>
                        <div class="stat-number">{{ $testimonialsCount }}</div>
                        <div class="stat-label">Testimonials</div>
                        <div class="stat-sub text-success"><i class="bi bi-check-circle-fill me-1"></i>{{ $activeTestimonials }} active</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Row 2: Content & Users --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-4 col-lg-3">
            <div class="stat-card">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="stat-icon" style="background: rgba(59,130,246,0.1); color: #3b82f6;">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <div>
                        <div class="stat-number">{{ $postsCount }}</div>
                        <div class="stat-label">Blog Posts</div>
                        <div class="stat-sub text-success"><i class="bi bi-check-circle-fill me-1"></i>{{ $publishedPosts }} published</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
            <div class="stat-card">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="stat-icon" style="background: rgba(249,115,22,0.1); color: #f97316;">
                        <i class="bi bi-question-circle"></i>
                    </div>
                    <div>
                        <div class="stat-number">{{ $faqsCount }}</div>
                        <div class="stat-label">FAQs</div>
                        <div class="stat-sub text-success"><i class="bi bi-check-circle-fill me-1"></i>{{ $activeFaqs }} active</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
            <div class="stat-card">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="stat-icon" style="background: rgba(239,68,68,0.1); color: #ef4444;">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <div>
                        <div class="stat-number">{{ $contactsCount }}</div>
                        <div class="stat-label">Messages</div>
                        <div class="stat-sub text-muted"><i class="bi bi-inbox me-1"></i>all inbox</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
            <div class="stat-card">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="stat-icon" style="background: rgba(14,165,233,0.1); color: #0ea5e9;">
                        <i class="bi bi-people"></i>
                    </div>
                    <div>
                        <div class="stat-number">{{ $usersCount }}</div>
                        <div class="stat-label">Users</div>
                        <div class="stat-sub text-muted"><i class="bi bi-person me-1"></i>registered</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Items Grid --}}
    <div class="row g-4">

        {{-- Recent Projects --}}
        <div class="col-lg-6">
            <div class="card-modern">
                <div class="card-header">
                    <span><i class="bi bi-folder2-open me-2" style="color:#6366f1;"></i> Recent Projects</span>
                    <a href="{{ url('/admin/projects') }}" class="btn btn-sm btn-admin btn-admin-outline rounded-pill px-3" style="font-size:0.78rem;">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body">
                    @forelse($recentProjects as $p)
                        <a href="{{ url('/admin/projects/edit/' . $p->id) }}" class="recent-item">
                            <span class="av" style="background:rgba(99,102,241,0.1); color:#6366f1;">
                                <i class="bi bi-folder2"></i>
                            </span>
                            <div class="info">
                                <div class="title">{{ $p->title }}</div>
                                <div class="meta">
                                    @if($p->category)
                                        <span class="me-2"><i class="bi bi-tag me-1"></i>{{ $p->category }}</span>
                                    @endif
                                    <span><i class="bi bi-clock me-1"></i>{{ $p->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <span class="badge-status {{ $p->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">
                                {{ $p->is_active ? 'Active' : 'Draft' }}
                            </span>
                        </a>
                    @empty
                        <div class="text-center py-4 text-muted small">
                            <i class="bi bi-folder2-open fs-2 d-block mb-2"></i>
                            No projects yet
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Recent Posts --}}
        <div class="col-lg-6">
            <div class="card-modern">
                <div class="card-header">
                    <span><i class="bi bi-pencil-square me-2" style="color:#3b82f6;"></i> Recent Blog Posts</span>
                    <a href="{{ url('/admin/blog') }}" class="btn btn-sm btn-admin btn-admin-outline rounded-pill px-3" style="font-size:0.78rem;">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body">
                    @forelse($recentPosts as $p)
                        <a href="{{ url('/admin/blog/edit/' . $p->id) }}" class="recent-item">
                            <span class="av" style="background:rgba(59,130,246,0.1); color:#3b82f6;">
                                <i class="bi bi-file-text"></i>
                            </span>
                            <div class="info">
                                <div class="title">{{ $p->title }}</div>
                                <div class="meta">
                                    @if($p->category)
                                        <span class="me-2"><i class="bi bi-folder me-1"></i>{{ $p->category }}</span>
                                    @endif
                                    <span><i class="bi bi-clock me-1"></i>{{ $p->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <span class="badge-status {{ $p->is_published ? 'text-bg-success' : 'text-bg-warning' }}">
                                {{ $p->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </a>
                    @empty
                        <div class="text-center py-4 text-muted small">
                            <i class="bi bi-pencil-square fs-2 d-block mb-2"></i>
                            No posts yet
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Recent Services --}}
        <div class="col-lg-6">
            <div class="card-modern">
                <div class="card-header">
                    <span><i class="bi bi-gear me-2" style="color:#10b981;"></i> Recent Services</span>
                    <a href="{{ url('/admin/services') }}" class="btn btn-sm btn-admin btn-admin-outline rounded-pill px-3" style="font-size:0.78rem;">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body">
                    @forelse($recentServices as $s)
                        <a href="{{ url('/admin/services/edit/' . $s->id) }}" class="recent-item">
                            <span class="av" style="background:rgba(16,185,129,0.1); color:#10b981;">
                                <i class="bi bi-gear"></i>
                            </span>
                            <div class="info">
                                <div class="title">{{ $s->title }}</div>
                                <div class="meta">
                                    <span><i class="bi bi-clock me-1"></i>{{ $s->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <span class="badge-status {{ $s->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">
                                {{ $s->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </a>
                    @empty
                        <div class="text-center py-4 text-muted small">
                            <i class="bi bi-gear fs-2 d-block mb-2"></i>
                            No services yet
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Recent Messages --}}
        <div class="col-lg-6">
            <div class="card-modern">
                <div class="card-header">
                    <span><i class="bi bi-chat-dots me-2" style="color:#ef4444;"></i> Recent Messages</span>
                    <a href="{{ url('/admin/contact') }}" class="btn btn-sm btn-admin btn-admin-outline rounded-pill px-3" style="font-size:0.78rem;">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body">
                    @forelse($recentMessages as $m)
                        <button type="button" class="recent-item" onclick="openMessageModal(this)" data-msg-name="{{ htmlspecialchars($m->name) }}" data-msg-email="{{ htmlspecialchars($m->email) }}" data-msg-content="{{ htmlspecialchars($m->message) }}" style="cursor:pointer; width:100%; border:none; background:transparent; text-align:left; font-family:inherit; display:flex; align-items:center; gap:0.75rem; padding:0.7rem 1.25rem; border-bottom:1px solid #f1f5f9; transition:background 0.2s; color:inherit; text-decoration:none;">
                            <span class="av" style="background:rgba(239,68,68,0.1); color:#ef4444;">
                                {{ strtoupper(substr($m->name, 0, 1)) }}
                            </span>
                            <span class="info" style="flex:1; min-width:0;">
                                <span class="title" style="font-weight:600; font-size:0.85rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; display:block;">{{ $m->name }}</span>
                                <span class="meta" style="font-size:0.75rem; color:#94a3b8;">
                                    <span class="me-2"><i class="bi bi-envelope me-1"></i>{{ $m->email }}</span>
                                    <span><i class="bi bi-clock me-1"></i>{{ $m->created_at->diffForHumans() }}</span>
                                </span>
                            </span>
                            <span class="badge-status text-bg-primary" style="font-size:0.68rem; padding:0.15rem 0.6rem; border-radius:20px; font-weight:600; flex-shrink:0;">
                                <i class="bi bi-eye"></i>
                            </span>
                        </button>
                    @empty
                        <div class="text-center py-4 text-muted small">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            No messages yet
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Single Message Modal --}}
    <div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow">
                <div class="modal-header" style="background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff; border-radius: 12px 12px 0 0;">
                    <h5 class="modal-title fw-semibold" id="msgModalTitle">
                        <i class="bi bi-person-circle me-2"></i> <span id="msgName"></span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-4 py-4">
                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-muted d-block mb-1">Email</small>
                        <span class="fw-medium" id="msgEmail"></span>
                    </div>
                    <div>
                        <small class="text-muted d-block mb-1">Message</small>
                        <p class="mb-0 lh-base" id="msgContent" style="white-space:pre-wrap"></p>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card-modern">
                <div class="card-header">
                    <span><i class="bi bi-lightning-charge me-2" style="color:#f59e0b;"></i> Quick Actions</span>
                </div>
                <div class="card-body p-3">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ url('/admin/projects/create') }}" class="quick-action">
                            <i class="bi bi-plus-circle" style="color:#6366f1;"></i> New Project
                        </a>
                        <a href="{{ url('/admin/services/create') }}" class="quick-action">
                            <i class="bi bi-plus-circle" style="color:#10b981;"></i> New Service
                        </a>
                        <a href="{{ url('/admin/experiences/create') }}" class="quick-action">
                            <i class="bi bi-plus-circle" style="color:#f59e0b;"></i> New Experience
                        </a>
                        <a href="{{ url('/admin/skills/create') }}" class="quick-action">
                            <i class="bi bi-plus-circle" style="color:#8b5cf6;"></i> New Skill
                        </a>
                        <a href="{{ url('/admin/testimonials/create') }}" class="quick-action">
                            <i class="bi bi-plus-circle" style="color:#ec4899;"></i> New Testimonial
                        </a>
                        <a href="{{ url('/admin/blog/create') }}" class="quick-action">
                            <i class="bi bi-plus-circle" style="color:#3b82f6;"></i> New Blog Post
                        </a>
                        <a href="{{ url('/admin/faqs/create') }}" class="quick-action">
                            <i class="bi bi-plus-circle" style="color:#f97316;"></i> New FAQ
                        </a>
                        <a href="{{ url('/admin/account/edit') }}" class="quick-action">
                            <i class="bi bi-pencil" style="color:#0ea5e9;"></i> Edit Account
                        </a>
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

