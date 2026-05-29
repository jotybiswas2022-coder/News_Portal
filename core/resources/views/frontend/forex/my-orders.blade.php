@extends('frontend.forex.layouts.app')

@section('title', 'My Orders — SMART BINARY ZONE')

@section('content')
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.showToast('{{ session('success') }}', 'success');
    });
</script>
@endif
<style>
.my-orders-page{min-height:100vh;padding-top:7rem;padding-bottom:4rem;position:relative;overflow:hidden}
.my-orders-inner{max-width:56rem;margin:0 auto;padding:0 1rem;position:relative;z-index:10}
@media (min-width:640px){.my-orders-inner{padding:0 1.5rem}}
@media (min-width:1024px){.my-orders-inner{padding:0 2rem}}

/* Header */
.orders-header{text-align:center;margin-bottom:2rem}
.orders-header-icon{width:3.5rem;height:3.5rem;margin:0 auto 1rem;border-radius:1rem;background:rgba(0,95,231,0.08);border:1px solid rgba(0,95,231,0.12);display:flex;align-items:center;justify-content:center;color:#005fe7;transition:all 0.3s ease}
.orders-header-icon:hover{box-shadow:0 0 30px rgba(34,85,255,0.15);transform:translateY(-2px)}
.orders-header-icon svg{width:1.5rem;height:1.5rem}
.orders-header h1{font-family:'Bebas Neue','Oswald',sans-serif;font-size:clamp(2rem,5vw,3rem);color:#EAEAEA;margin-bottom:0.5rem;letter-spacing:0.02em}
.orders-header p{color:rgba(234,234,234,0.4);font-size:0.9375rem;max-width:28rem;margin:0 auto;line-height:1.6}

/* Stats Bar */
.orders-stats{display:flex;align-items:center;justify-content:center;gap:1.5rem;margin-bottom:2rem;padding:1rem 1.5rem;background:rgba(5,5,15,0.3);border:1px solid rgba(255,255,255,0.04);border-radius:1rem;flex-wrap:wrap}
.orders-stat-item{text-align:center}
.orders-stat-value{font-family:'JetBrains Mono',monospace;font-size:1.125rem;font-weight:700;color:#EAEAEA}
.orders-stat-label{font-size:0.6875rem;color:rgba(234,234,234,0.35);text-transform:uppercase;letter-spacing:0.08em;margin-top:0.125rem}
.orders-stat-divider{width:1px;height:2rem;background:rgba(255,255,255,0.06)}
.orders-stat-dot{display:inline-block;width:6px;height:6px;border-radius:50%;margin-right:0.375rem;vertical-align:middle}
.orders-stat-dot.pending{background:#f59e0b}
.orders-stat-dot.processing{background:#005fe7}
.orders-stat-dot.completed{background:#005fe7}
.orders-stat-dot.cancelled{background:#ef4444}

/* Orders List */
.my-orders-list{display:flex;flex-direction:column;gap:0.625rem}
.my-orders-card{display:flex;align-items:center;gap:1rem;padding:1rem 1.25rem;text-decoration:none;background:rgba(5,5,15,0.35);border:1px solid rgba(255,255,255,0.06);border-radius:0.875rem;backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);position:relative;overflow:hidden;transition:all 0.35s cubic-bezier(0.4,0,0.2,1)}
.my-orders-card::before{content:'';position:absolute;inset:-1px;border-radius:inherit;background:linear-gradient(135deg,rgba(255,255,255,0.04),transparent 50%,rgba(255,255,255,0.02));pointer-events:none;z-index:-1}
.my-orders-card:hover{border-color:rgba(34,85,255,0.18);background:rgba(5,5,15,0.6);box-shadow:0 8px 32px -8px rgba(0,0,0,0.3)}
.my-orders-card-left{display:flex;align-items:center;gap:0.875rem;flex:1;min-width:0}
.my-orders-card-icon{width:2.5rem;height:2.5rem;border-radius:0.75rem;background:rgba(0,95,231,0.06);border:1px solid rgba(0,95,231,0.1);display:flex;align-items:center;justify-content:center;color:rgba(0,95,231,0.6);flex-shrink:0;transition:all 0.3s ease}
.my-orders-card:hover .my-orders-card-icon{background:rgba(0,95,231,0.1);border-color:rgba(0,95,231,0.2);color:#005fe7}
.my-orders-card-icon svg{width:1.125rem;height:1.125rem}
.my-orders-card-info{min-width:0;flex:1}
.my-orders-card-number{font-family:'JetBrains Mono',monospace;font-size:0.8125rem;font-weight:600;color:#005fe7;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.my-orders-card-date{font-size:0.6875rem;color:rgba(234,234,234,0.3);margin-top:0.125rem}
.my-orders-card-right{display:flex;align-items:center;gap:1rem;flex-shrink:0}
.my-orders-card-items{font-size:0.75rem;color:rgba(234,234,234,0.4);white-space:nowrap}
.my-orders-card-total{font-family:'JetBrains Mono',monospace;font-size:0.9375rem;font-weight:600;color:#EAEAEA;white-space:nowrap}
.my-orders-card-arrow{color:rgba(234,234,234,0.12);transition:all 0.35s ease;width:1.125rem;height:1.125rem;flex-shrink:0}
.my-orders-card:hover .my-orders-card-arrow{color:#005fe7;transform:translateX(4px)}

/* Status Badge */
.orders-status-badge{display:inline-flex;align-items:center;gap:0.3125rem;padding:0.25rem 0.625rem;border-radius:9999px;font-size:0.625rem;font-weight:600;text-transform:uppercase;letter-spacing:0.04em;white-space:nowrap;flex-shrink:0}
.orders-status-badge .dot{width:0.3125rem;height:0.3125rem;border-radius:50%;animation:pulse-dot 2s ease-in-out infinite}
@keyframes pulse-dot{0%,100%{opacity:1}50%{opacity:0.4}}

/* Pagination */
.my-orders-nav{display:flex;align-items:center;justify-content:center;gap:0.375rem;margin-top:2.5rem;flex-wrap:wrap}
.my-orders-nav-link{display:inline-flex;align-items:center;justify-content:center;gap:0.375rem;min-width:2.25rem;height:2.25rem;padding:0 0.75rem;border-radius:0.625rem;font-size:0.8125rem;font-weight:500;color:rgba(234,234,234,0.4);text-decoration:none;background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.06);transition:all 0.25s ease}
.my-orders-nav-link:hover:not(.disabled):not(.active){color:#EAEAEA;background:rgba(0,95,231,0.06);border-color:rgba(0,95,231,0.15)}
.my-orders-nav-link.active{color:#fff;background:rgba(0,95,231,0.12);border-color:rgba(0,95,231,0.25);pointer-events:none}
.my-orders-nav-link.disabled{opacity:0.15;pointer-events:none;cursor:default}
.my-orders-nav-link svg{width:0.8125rem;height:0.8125rem;flex-shrink:0;transition:transform 0.25s ease}
.my-orders-nav-link:hover:not(.disabled):not(.active) svg:first-child{transform:translateX(-2px)}
.my-orders-nav-link:hover:not(.disabled):not(.active) svg:last-child{transform:translateX(2px)}
.my-orders-nav-info{color:rgba(234,234,234,0.2);font-size:0.75rem;padding:0 0.25rem}
.my-orders-nav-dots{color:rgba(234,234,234,0.2);font-size:0.8125rem;padding:0 0.125rem;letter-spacing:0.05em}

/* Empty State */
.my-orders-empty{padding:5rem 1rem;text-align:center}
.my-orders-empty-icon{width:4.5rem;height:4.5rem;margin:0 auto 1.25rem;border-radius:1.125rem;background:rgba(5,5,15,0.4);border:1px solid rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:center;transition:all 0.3s ease}
.my-orders-empty-icon:hover{border-color:rgba(34,85,255,0.2);box-shadow:0 0 30px rgba(34,85,255,0.08)}
.my-orders-empty-icon svg{width:1.75rem;height:1.75rem;color:rgba(234,234,234,0.12)}
.my-orders-empty-title{color:#EAEAEA;font-weight:600;font-size:1.25rem;margin-bottom:0.5rem}
.my-orders-empty-desc{color:rgba(234,234,234,0.35);font-size:0.875rem;max-width:24rem;margin:0 auto 1.5rem;line-height:1.7}
.my-orders-empty-btn{display:inline-flex;align-items:center;gap:0.5rem;padding:0.75rem 1.75rem;background:linear-gradient(135deg,#005fe7,#2255ff);color:white;font-weight:600;font-size:0.875rem;border-radius:0.75rem;text-decoration:none;transition:all 0.3s ease}
.my-orders-empty-btn:hover{transform:translateY(-2px);box-shadow:0 8px 30px rgba(34,85,255,0.25)}

/* Sort Toggle */
.orders-sort{display:flex;align-items:center;justify-content:center;gap:0.5rem;margin-bottom:1.5rem}
.orders-sort-btn{display:inline-flex;align-items:center;justify-content:center;gap:0.5rem;padding:0.5rem 1.25rem;border-radius:0.75rem;font-size:0.8125rem;font-weight:500;color:rgba(234,234,234,0.4);text-decoration:none;background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.06);transition:all 0.25s ease;cursor:pointer}
.orders-sort-btn:hover{color:#EAEAEA;background:rgba(0,95,231,0.06);border-color:rgba(0,95,231,0.15)}
.orders-sort-btn.active{color:#fff;background:rgba(0,95,231,0.12);border-color:rgba(0,95,231,0.25)}
.orders-sort-btn svg{width:0.875rem;height:0.875rem;flex-shrink:0}
.orders-sort-divider{width:1px;height:1.25rem;background:rgba(255,255,255,0.06)}

/* Loading shimmer */
@keyframes shimmer{0%{background-position:-200% 0}100%{background-position:200% 0}}
</style>

<section class="my-orders-page">
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="grid-bg" style="position:absolute;inset:0;opacity:0.3;pointer-events:none"></div>

    <div class="my-orders-inner">
        <!-- Page Header -->
        <div class="orders-header reveal">
            <div class="orders-header-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
            </div>
            <h1>My Orders</h1>
            <p>Track and manage all your Expert Advisor purchases in one place.</p>
        </div>

        @if($orders->count() > 0)
            @php
                $currentSort = $sort ?? 'newest';
                $totalOrders = $orders->total();
                $pendingCount = 0;
                $processingCount = 0;
                $completedCount = 0;
                foreach ($orders as $o) {
                    if ($o->status === 'pending' || $o->status === 'pending_payment' || $o->status === 'payment_submitted') $pendingCount++;
                    elseif ($o->status === 'processing') $processingCount++;
                    elseif ($o->status === 'completed') $completedCount++;
                }
            @endphp

            <!-- Sort Toggle: Newest / Oldest side by side -->
            <div class="orders-sort reveal" style="transition-delay:0.05s">
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" class="orders-sort-btn {{ $currentSort === 'newest' ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/></svg>
                    Newest First
                </a>
                <span class="orders-sort-divider"></span>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}" class="orders-sort-btn {{ $currentSort === 'oldest' ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m4-4l4 4m0 0l-4 4"/></svg>
                    Oldest First
                </a>
            </div>

            <!-- Stats Bar -->
            <div class="orders-stats reveal" style="transition-delay:0.075s">
                <div class="orders-stat-item">
                    <div class="orders-stat-value">{{ $totalOrders }}</div>
                    <div class="orders-stat-label">Total Orders</div>
                </div>
                <div class="orders-stat-divider"></div>
                <div class="orders-stat-item">
                    <div class="orders-stat-value"><span class="orders-stat-dot pending"></span>{{ $pendingCount }}</div>
                    <div class="orders-stat-label">Pending</div>
                </div>
                <div class="orders-stat-divider"></div>
                <div class="orders-stat-item">
                    <div class="orders-stat-value"><span class="orders-stat-dot processing"></span>{{ $processingCount }}</div>
                    <div class="orders-stat-label">Processing</div>
                </div>
                <div class="orders-stat-divider"></div>
                <div class="orders-stat-item">
                    <div class="orders-stat-value"><span class="orders-stat-dot completed"></span>{{ $completedCount }}</div>
                    <div class="orders-stat-label">Completed</div>
                </div>
            </div>

            <!-- Orders List -->
            <div class="my-orders-list reveal" style="transition-delay:0.1s">
                @foreach($orders as $order)
                <a href="{{ route('order.success', ['order' => $order->order_number]) }}" class="my-orders-card reveal" style="transition-delay:{{ $loop->index * 0.025 }}s">
                    <div class="my-orders-card-left">
                        <div class="my-orders-card-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <div class="my-orders-card-info">
                            <span class="my-orders-card-number">{{ $order->order_number }}</span>
                            <span class="my-orders-card-date">{{ $order->created_at->format('M d, Y — h:i A') }}</span>
                        </div>
                    </div>
                    <div class="my-orders-card-right">
                        @php
                            $statusColors = [
                                'pending'           => ['bg' => 'rgba(245,158,11,0.1)', 'border' => 'rgba(245,158,11,0.15)', 'dot' => '#f59e0b', 'label' => 'Pending'],
                                'pending_payment'   => ['bg' => 'rgba(245,158,11,0.1)', 'border' => 'rgba(245,158,11,0.15)', 'dot' => '#f59e0b', 'label' => 'Pending Payment'],
                                'payment_submitted' => ['bg' => 'rgba(245,158,11,0.1)', 'border' => 'rgba(245,158,11,0.15)', 'dot' => '#f59e0b', 'label' => 'Payment Submitted'],
                                'processing'        => ['bg' => 'rgba(0,95,231,0.1)',  'border' => 'rgba(0,95,231,0.15)',  'dot' => '#005fe7', 'label' => 'Processing'],
                                'completed'         => ['bg' => 'rgba(0,95,231,0.1)',  'border' => 'rgba(0,95,231,0.15)',  'dot' => '#005fe7', 'label' => 'Completed'],
                                'cancelled'         => ['bg' => 'rgba(239,68,68,0.1)',  'border' => 'rgba(239,68,68,0.15)',  'dot' => '#ef4444', 'label' => 'Cancelled'],
                            ];
                            $sc = $statusColors[$order->status] ?? $statusColors['pending'];
                            $itemCount = count($order->items ?? []);
                        @endphp
                        <span class="orders-status-badge" style="background:{{ $sc['bg'] }};border:1px solid {{ $sc['border'] }};color:{{ $sc['dot'] }}">
                            <span class="dot" style="background:{{ $sc['dot'] }}"></span>
                            {{ $sc['label'] }}
                        </span>
                        <span class="my-orders-card-items">{{ $itemCount }} item{{ $itemCount !== 1 ? 's' : '' }}</span>
                        <span class="my-orders-card-total">${{ number_format($order->total, 2) }}</span>
                        <svg class="my-orders-card-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- Pagination with page numbers -->
            <div class="my-orders-nav reveal" style="transition-delay:0.15s">
                @php
                    $currentPage = $orders->currentPage();
                    $lastPage = $orders->lastPage();
                    $startPage = max(1, $currentPage - 2);
                    $endPage = min($lastPage, $currentPage + 2);
                    $paginator = $orders;
                @endphp

                {{-- Previous --}}
                @if($paginator->onFirstPage())
                    <span class="my-orders-nav-link disabled">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="my-orders-nav-link">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </a>
                @endif

                {{-- First page + dots --}}
                @if($startPage > 1)
                    <a href="{{ $paginator->url(1) }}" class="my-orders-nav-link">1</a>
                    @if($startPage > 2)
                        <span class="my-orders-nav-dots">…</span>
                    @endif
                @endif

                {{-- Page numbers --}}
                @for($i = $startPage; $i <= $endPage; $i++)
                    @if($i == $currentPage)
                        <span class="my-orders-nav-link active">{{ $i }}</span>
                    @else
                        <a href="{{ $paginator->url($i) }}" class="my-orders-nav-link">{{ $i }}</a>
                    @endif
                @endfor

                {{-- Last page + dots --}}
                @if($endPage < $lastPage)
                    @if($endPage < $lastPage - 1)
                        <span class="my-orders-nav-dots">…</span>
                    @endif
                    <a href="{{ $paginator->url($lastPage) }}" class="my-orders-nav-link">{{ $lastPage }}</a>
                @endif

                {{-- Next --}}
                @if($currentPage >= $lastPage)
                    <span class="my-orders-nav-link disabled">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                @else
                    <a href="{{ $paginator->nextPageUrl() }}" class="my-orders-nav-link">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                @endif
            </div>
        @else
            <!-- Empty State -->
            <div class="my-orders-empty reveal">
                <div class="my-orders-empty-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <h2 class="my-orders-empty-title">No Orders Yet</h2>
                <p class="my-orders-empty-desc">You haven't purchased any Expert Advisors yet. Explore our collection and start your trading journey today.</p>
                <a href="{{ route('forex.products') }}" class="my-orders-empty-btn">
                    Browse Products
                    <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        @endif
    </div>
</section>
@endsection
