@extends('frontend.forex.layouts.app')

@section('title', 'My Partnership — SMART BINARY ZONE')

@section('content')
<style>
/* ===== MY PARTNERSHIP PAGE STYLES ===== */
.mp-hero{position:relative;min-height:40vh;display:flex;align-items:center;padding-top:6rem;padding-bottom:3rem;overflow:hidden}
.mp-inner{position:relative;z-index:10;max-width:80rem;margin:0 auto;padding-left:1rem;padding-right:1rem;width:100%}
.mp-timeline{position:relative;padding-left:1.5rem}
.mp-timeline::before{content:'';position:absolute;left:0.5rem;top:0.25rem;bottom:0.25rem;width:2px;background:rgba(255,255,255,0.06)}
.mp-timeline-dot{position:absolute;left:0.125rem;width:0.875rem;height:0.875rem;border-radius:50%;border:2px solid #2a2a2a;background:#05050f}
.mp-timeline-dot.active{border-color:#00c8ff;background:#00c8ff;box-shadow:0 0 12px rgba(0,200,255,0.3)}
.mp-timeline-dot.rejected{border-color:#ef4444;background:#ef4444;box-shadow:0 0 12px rgba(239,68,68,0.3)}

/* ===== GLASS STATUS BADGES ===== */
.mp-glass-status{position:relative;display:inline-flex;align-items:center;gap:0.375rem;padding:0.25rem 0.75rem;border-radius:9999px;font-size:0.75rem;font-weight:600;overflow:hidden}
.mp-glass-status::before{content:'';position:absolute;inset:0;border-radius:inherit;padding:1px;background:linear-gradient(135deg,transparent 30%,rgba(255,255,255,0.06) 70%,transparent);-webkit-mask:linear-gradient(#fff 0 0) content-box,linear-gradient(#fff 0 0);-webkit-mask-composite:xor;mask-composite:exclude;pointer-events:none}
.mp-glass-pending{background:rgba(245,158,11,0.08);color:#f59e0b;backdrop-filter:blur(4px)}
.mp-glass-approved{background:rgba(0,200,255,0.08);color:#00c8ff;backdrop-filter:blur(4px)}
.mp-glass-rejected{background:rgba(239,68,68,0.08);color:#ef4444;backdrop-filter:blur(4px)}
.mp-glass-id{display:inline-flex;align-items:center;gap:0.375rem;padding:0.25rem 0.625rem;border-radius:0.5rem;font-size:0.75rem;font-family:'JetBrains Mono',monospace;color:rgba(234,234,234,0.15);background:rgba(255,255,255,0.02);backdrop-filter:blur(4px);border:1px solid rgba(255,255,255,0.04);transition:all 0.3s}
.mp-glass-id:hover{color:rgba(0,200,255,0.5);border-color:rgba(0,200,255,0.1)}

/* ===== PAGINATION ===== */
.mp-pagination ul.pagination{display:flex;align-items:center;gap:0.375rem;list-style:none;padding:0;margin:0;justify-content:center}
.mp-pagination .page-item{display:inline-flex;margin:0}
.mp-pagination .page-link{display:inline-flex;align-items:center;justify-content:center;min-width:2.375rem;height:2.375rem;padding:0.375rem 0.75rem;background:rgba(5,5,15,0.6);border:1px solid rgba(255,255,255,0.06);border-radius:0.625rem;color:rgba(234,234,234,0.5);font-size:0.8125rem;font-weight:500;text-decoration:none;transition:all 0.25s cubic-bezier(0.4,0,0.2,1)}
.mp-pagination .page-link:hover{background:rgba(255,255,255,0.04);border-color:rgba(0,200,255,0.2);color:#EAEAEA;transform:translateY(-1px)}
.mp-pagination .page-item.active .page-link{background:linear-gradient(135deg,#00c8ff,#0099ff);border-color:transparent;color:#fff;font-weight:600;box-shadow:0 4px 16px rgba(0,200,255,0.25)}
.mp-pagination .page-item.disabled .page-link{opacity:0.25;cursor:default;pointer-events:none}
.mp-pagination-count{text-align:center;color:rgba(234,234,234,0.3);font-size:0.8125rem;margin-top:0.75rem}
</style>

<!-- ==================== HERO ==================== -->
<section class="mp-hero">
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="grid-bg" style="position:absolute;inset:0;opacity:0.4;pointer-events:none"></div>
    <div class="mp-inner">
        <div style="text-align:center" class="reveal">
            <div class="badge"><span class="badge-dot"></span> My Partnership</div>
            <h1 style="font-family:'Bebas Neue','Oswald',sans-serif;font-size:clamp(2rem,5vw,3.5rem);font-weight:700;color:#EAEAEA;margin-bottom:0.75rem;line-height:1.1">
                Partnership <span class="gradient-text">Applications</span>
            </h1>
            <p style="color:rgba(234,234,234,0.5);font-size:1.05rem;max-width:36rem;margin:0 auto">Track the status of your submitted partnership applications</p>
        </div>
    </div>
</section>

<!-- ==================== APPLICATIONS LIST ==================== -->
<section style="padding-bottom:6rem;position:relative;overflow:hidden">
    <div class="orb orb-brand" style="position:absolute;bottom:0;right:0;transform:translate(33%,33%);opacity:0.03;width:500px;height:500px;border-radius:50%;background:rgba(0,200,255,0.15);filter:blur(100px);pointer-events:none"></div>
    <div style="max-width:64rem;margin:0 auto;padding:0 1rem;position:relative;z-index:10">
        <style>@media (min-width:640px){.mp-px{padding:0 1.5rem}}@media (min-width:1024px){.mp-px{padding:0 2rem}}</style>

        <!-- Results Count Bar (always visible, even when no results) -->
        <div class="glass-card reveal" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:0.75rem;margin-bottom:1.5rem;padding:0.75rem 1rem">
            <span style="color:rgba(234,234,234,0.5);font-size:0.875rem">
                @if($applications->count() > 0)
                    Showing <strong style="color:#00c8ff;font-weight:600">{{ $applications->firstItem() }}</strong>
                    to <strong style="color:#00c8ff;font-weight:600">{{ $applications->lastItem() }}</strong>
                    of <strong style="color:#EAEAEA;font-weight:600">{{ $applications->total() }}</strong> Applications
                @else
                    <strong style="color:#EAEAEA;font-weight:600">0</strong> Applications
                @endif
            </span>
            <div style="display:flex;align-items:center;gap:0.5rem">
                <span style="color:rgba(234,234,234,0.3);font-size:0.75rem">Filter:</span>
                <select style="background:rgba(5,5,15,0.7);border:1px solid rgba(255,255,255,0.08);border-radius:0.5rem;padding:0.375rem 0.75rem;color:rgba(234,234,234,0.7);font-size:0.8125rem;cursor:pointer;outline:none;transition:all 0.25s;backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px)" onchange="window.location.href='{{ route('forex.my-partnership') }}?status='+this.value" onmouseover="this.style.borderColor='rgba(0,200,255,0.2)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.08)'">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
        </div>

        @if($applications->count() > 0)
        <div style="display:flex;flex-direction:column;gap:1rem">
            @foreach($applications as $app)
            <div class="glass-card tilt-card reveal" style="padding:0;overflow:hidden;transition:all 0.4s cubic-bezier(0.4,0,0.2,1);transition-delay:{{ ($loop->index % 10) * 0.05 }}s"
                 onmouseover="this.style.boxShadow='0 12px 40px -8px rgba(0,0,0,0.4), 0 0 0 1px rgba(0,200,255,0.12)'"
                 onmouseout="this.style.boxShadow='none'">
                <div class="tilt-card-inner" style="padding:1.5rem">
                    <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:1rem">
                        <div>
                            <div style="display:flex;align-items:center;gap:0.75rem;flex-wrap:wrap">
                                <h3 style="color:#EAEAEA;font-weight:600;font-size:1.125rem;margin:0">{{ $app->name }}</h3>
                                @php
                                    $statusClass = match($app->status) {
                                        'approved' => 'mp-glass-approved',
                                        'rejected' => 'mp-glass-rejected',
                                        default => 'mp-glass-pending'
                                    };
                                    $statusIcon = match($app->status) {
                                        'approved' => '✓',
                                        'rejected' => '✕',
                                        default => '⋯'
                                    };
                                @endphp
                                <span class="mp-glass-status {{ $statusClass }}">
                                    <span>{{ $statusIcon }}</span>
                                    {{ ucfirst($app->status) }}
                                </span>
                            </div>
                            <p style="color:rgba(234,234,234,0.4);font-size:0.8125rem;margin-top:0.375rem;margin-bottom:0">
                                Submitted {{ $app->created_at->format('M d, Y \\a\\t h:i A') }}
                            </p>
                        </div>
                        <span class="mp-glass-id">#{{ $app->id }}</span>
                    </div>

                    @if($app->website)
                    <div style="margin-bottom:0.75rem">
                        <span style="color:rgba(234,234,234,0.3);font-size:0.75rem;font-weight:500;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:0.25rem">Website</span>
                        <a href="{{ $app->website }}" target="_blank" rel="noopener" style="color:#00c8ff;font-size:0.875rem;text-decoration:none;transition:color 0.2s" onmouseover="this.style.color='#00c8ff'" onmouseout="this.style.color='#00c8ff'">{{ $app->website }}</a>
                    </div>
                    @endif

                    @if($app->message)
                    <div style="margin-bottom:1rem">
                        <span style="color:rgba(234,234,234,0.3);font-size:0.75rem;font-weight:500;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:0.25rem">Message</span>
                        <p style="color:rgba(234,234,234,0.6);font-size:0.875rem;line-height:1.625;margin:0;max-width:36rem">{{ $app->message }}</p>
                    </div>
                    @endif

                    <!-- Timeline -->
                    <div style="margin-top:1.25rem;padding-top:1rem;border-top:1px solid rgba(255,255,255,0.04)">
                        <span style="color:rgba(234,234,234,0.3);font-size:0.6875rem;font-weight:500;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:0.75rem">Status Timeline</span>
                        <div class="mp-timeline">
                            @php
                                $currentStatus = $app->status;
                            @endphp
                            @foreach(['submitted', 'under review', $currentStatus === 'approved' ? 'approved' : ($currentStatus === 'rejected' ? 'rejected' : 'decision')] as $i => $step)
                            @php
                                $isActive = $i === 0 || ($i === 1 && $currentStatus !== 'pending') || ($i === 2 && $currentStatus !== 'pending');
                                $isCurrent = ($i === 0 && $currentStatus === 'pending') || ($i === 1 && $currentStatus !== 'pending') || ($i === 2 && ($currentStatus === 'approved' || $currentStatus === 'rejected'));
                            @endphp
                            <div style="position:relative;padding:0 0 1rem 1.25rem;opacity:{{ $isActive ? '1' : '0.25' }}">
                                <div class="mp-timeline-dot {{ $isCurrent ? ($currentStatus === 'rejected' && $i === 2 ? 'rejected' : 'active') : '' }}" style="position:absolute;left:0;top:0.25rem"></div>
                                <p style="color:{{ $isCurrent ? '#EAEAEA' : 'rgba(234,234,234,0.4)' }};font-weight:{{ $isCurrent ? '600' : '400' }};font-size:0.875rem;text-transform:capitalize;margin:0 0 0.125rem">{{ str_replace('-', ' ', $step) }}</p>
                                <p style="color:rgba(234,234,234,0.25);font-size:0.75rem;margin:0">
                                    @if($i === 0)
                                        {{ $app->created_at->format('M d, Y') }}
                                    @elseif($isActive)
                                        {{ $app->updated_at->format('M d, Y') }}
                                    @else
                                        Pending
                                    @endif
                                </p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tilt-card-glow"></div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($applications->hasPages())
        <div style="margin-top:2.5rem" class="mp-pagination reveal">
            {{ $applications->links() }}
            <div class="mp-pagination-count">
                Page {{ $applications->currentPage() }} of {{ $applications->lastPage() }}
            </div>
        </div>
        @endif

        @else
        <!-- Empty State -->
        <div style="text-align:center;padding:4rem 2rem" class="reveal">
            <div class="glass-card" style="width:5rem;height:5rem;margin:0 auto 1.5rem;border-radius:1rem;display:flex;align-items:center;justify-content:center;background:rgba(5,5,15,0.5);padding:0">
                <svg style="width:2.5rem;height:2.5rem;color:rgba(234,234,234,0.15)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h3 style="color:#EAEAEA;font-weight:600;font-size:1.25rem;margin-bottom:0.5rem">No Applications Yet</h3>
            <p style="color:rgba(234,234,234,0.4);font-size:0.875rem;margin-bottom:1.5rem;max-width:24rem;margin-left:auto;margin-right:auto;line-height:1.6">You haven't submitted any partnership applications yet. Apply now to start earning commissions on every referral!</p>
            <div style="display:flex;flex-wrap:wrap;gap:0.75rem;justify-content:center">
                <a href="{{ route('forex.partnership') }}" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.75rem 1.75rem;background:linear-gradient(135deg,#00c8ff,#0099ff);color:white;font-weight:600;font-size:0.875rem;border-radius:0.75rem;transition:all 0.3s;text-decoration:none" onmouseover="this.style.boxShadow='0 8px 30px rgba(0,200,255,0.25)';this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none';this.style.transform=''">
                    <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    Apply for Partnership
                </a>
                <a href="{{ route('forex.products') }}" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.75rem 1.75rem;border:1px solid rgba(0,200,255,0.2);background:rgba(0,200,255,0.04);color:rgba(234,234,234,0.8);font-weight:500;font-size:0.875rem;border-radius:0.75rem;transition:all 0.3s;text-decoration:none" onmouseover="this.style.borderColor='#00c8ff';this.style.background='rgba(0,200,255,0.08)';this.style.boxShadow='0 0 20px rgba(0,200,255,0.1)'" onmouseout="this.style.borderColor='rgba(0,200,255,0.2)';this.style.background='rgba(0,200,255,0.04)';this.style.boxShadow='none'">
                    Browse Expert Advisors
                </a>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
