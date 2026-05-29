@extends('frontend.forex.layouts.app')

@section('title', 'Order Details — SMART BINARY ZONE')

@section('content')
<style>
/* ===== ORDER DETAILS PAGE — REDESIGNED ===== */
.order-page{min-height:100vh;padding-top:7rem;padding-bottom:4rem;position:relative;overflow:hidden}
.order-inner{max-width:64rem;margin:0 auto;padding:0 1rem;position:relative;z-index:10}
@media (min-width:640px){.order-inner{padding:0 1.5rem}}
@media (min-width:1024px){.order-inner{padding:0 2rem}}

/* Back Link */
.order-back{display:inline-flex;align-items:center;gap:0.5rem;color:rgba(234,234,234,0.4);text-decoration:none;font-size:0.875rem;margin-bottom:1.5rem;transition:all 0.2s;padding:0.5rem 0.875rem;border-radius:0.5rem;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06)}
.order-back:hover{color:#005fe7;background:rgba(0,95,231,0.06);border-color:rgba(0,95,231,0.15);gap:0.625rem}

/* Success Banner */
.order-success-banner{position:relative;overflow:hidden;padding:2rem;margin-bottom:2rem;text-align:center;border:1px solid rgba(0,95,231,0.12);background:linear-gradient(135deg,rgba(0,95,231,0.04),rgba(0,95,231,0.02))}
.order-success-glow{position:absolute;top:-50%;left:-50%;width:200%;height:200%;background:radial-gradient(circle,rgba(34,85,255,0.04) 0%,transparent 60%);pointer-events:none;animation:orderPulse 4s ease-in-out infinite}
@keyframes orderPulse{0%,100%{opacity:0.5;transform:scale(1)}50%{opacity:1;transform:scale(1.1)}}
.order-success-icon{width:3.5rem;height:3.5rem;margin:0 auto 1rem;border-radius:50%;background:linear-gradient(135deg,rgba(0,95,231,0.2),rgba(0,95,231,0.05));display:flex;align-items:center;justify-content:center;position:relative}
.order-success-icon-inner{position:absolute;inset:0;border-radius:50%;background:rgba(0,95,231,0.05);animation:ping 2s cubic-bezier(0,0,0.2,1) infinite}
.order-success-icon svg{width:1.5rem;height:1.5rem;color:#005fe7;position:relative;z-index:1}

/* ===== HERO HEADER ===== */
.order-hero{position:relative;padding:2rem 1.75rem;margin-bottom:1.5rem;overflow:hidden;background:linear-gradient(135deg,rgba(5,5,15,0.5),rgba(5,5,15,0.3));border:1px solid rgba(255,255,255,0.06);border-radius:1.25rem}
@media (min-width:640px){.order-hero{padding:2.5rem 2.25rem}}
.order-hero-glow{position:absolute;top:-30%;right:-20%;width:300px;height:300px;border-radius:50%;background:radial-gradient(circle,rgba(34,85,255,0.06),transparent 70%);pointer-events:none}
.order-hero-top{display:flex;flex-wrap:wrap;justify-content:space-between;align-items:flex-start;gap:1rem;margin-bottom:1.25rem;padding-bottom:1.25rem;border-bottom:1px solid rgba(255,255,255,0.06)}
.order-hero-number{display:flex;flex-direction:column;gap:0.125rem}
.order-hero-number span:first-child{color:#005fe7;font-family:monospace;font-size:1.25rem;font-weight:700;letter-spacing:-0.02em}
.order-hero-number span:last-child{color:rgba(234,234,234,0.3);font-size:0.75rem;letter-spacing:0.05em;text-transform:uppercase}
.order-hero-meta{display:grid;grid-template-columns:1fr 1fr;gap:1rem;max-width:32rem}
@media (max-width:480px){.order-hero-meta{grid-template-columns:1fr}}
.order-hero-meta-item{display:flex;flex-direction:column;gap:0.25rem}
.order-hero-meta-label{color:rgba(234,234,234,0.3);font-size:0.7rem;text-transform:uppercase;letter-spacing:0.06em;font-weight:500}
.order-hero-meta-value{color:#EAEAEA;font-size:0.9375rem;font-weight:500}

/* ===== TWO-COLUMN LAYOUT ===== */
.order-grid{display:grid;grid-template-columns:1fr;gap:1.25rem;align-items:start}
@media (min-width:768px){.order-grid{grid-template-columns:1fr 20rem}}

/* Left Column */
.order-left{display:flex;flex-direction:column;gap:1.25rem}

/* Right Column (Sidebar) */
.order-right{display:flex;flex-direction:column;gap:1.25rem}
@media (min-width:768px){.order-right{position:sticky;top:6rem}}

/* ===== SECTION CARD ===== */
.order-card{position:relative;background:rgba(5,5,15,0.35);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border:1px solid rgba(255,255,255,0.06);border-radius:1.25rem;overflow:hidden;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)}
.order-card::before{content:'';position:absolute;inset:-1px;border-radius:inherit;background:linear-gradient(135deg,rgba(255,255,255,0.04),transparent 50%,rgba(255,255,255,0.02));pointer-events:none;z-index:-1}
.order-card-header{display:flex;align-items:center;gap:0.625rem;padding:1rem 1.25rem;background:linear-gradient(135deg,rgba(0,95,231,0.04),transparent);border-bottom:1px solid rgba(255,255,255,0.06);color:#005fe7;font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:0.06em}
.order-card-header svg{width:1rem;height:1rem;color:currentColor;flex-shrink:0}
.order-card-body{padding:1.25rem}

/* ===== ITEMS ===== */
.order-item{display:flex;align-items:center;gap:0.875rem;padding:0.875rem 0;transition:all 0.3s}
.order-item+.order-item{border-top:1px solid rgba(255,255,255,0.04)}
.order-item:last-child{padding-bottom:0}
.order-item-icon{width:2.25rem;height:2.25rem;border-radius:0.625rem;background:linear-gradient(135deg,rgba(0,95,231,0.08),rgba(0,95,231,0.03));display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:transform 0.3s ease}
.order-item:hover .order-item-icon{transform:scale(1.05)}
.order-item-icon svg{width:1.125rem;height:1.125rem;color:#005fe7}
.order-item-info{flex:1;min-width:0}
.order-item-name{color:#EAEAEA;font-weight:500;font-size:0.9rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.order-item-qty{color:rgba(234,234,234,0.3);font-size:0.75rem;margin-top:0.125rem}
.order-item-price{color:#EAEAEA;font-weight:600;font-family:monospace;font-size:0.875rem;flex-shrink:0}

/* ===== PRICING ===== */
.order-pricing-row{display:flex;align-items:center;justify-content:space-between;padding:0.5rem 0}
.order-pricing-row+.order-pricing-row{border-top:1px solid rgba(255,255,255,0.04)}
.order-pricing-label{color:rgba(234,234,234,0.4);font-size:0.875rem}
.order-pricing-value{color:rgba(234,234,234,0.7);font-family:monospace;font-size:0.875rem}
.order-pricing-total{padding-top:0.75rem!important;margin-top:0.25rem;border-top:1px solid rgba(255,255,255,0.1)!important}
.order-pricing-total .order-pricing-label{color:#EAEAEA;font-weight:600;font-size:1rem}
.order-pricing-total .order-pricing-value{color:#005fe7;font-weight:700;font-size:1.25rem}

/* ===== CUSTOMER / PAYMENT META CARDS ===== */
.order-meta-grid{display:grid;grid-template-columns:1fr;gap:0.75rem}
.order-meta-block{display:flex;align-items:center;gap:0.75rem;padding:0.875rem 1rem;background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.04);border-radius:0.75rem;transition:all 0.3s}
.order-meta-block:hover{border-color:rgba(0,95,231,0.1);background:rgba(0,95,231,0.03)}
.order-meta-block-icon{width:2rem;height:2rem;border-radius:0.5rem;background:linear-gradient(135deg,rgba(0,95,231,0.08),rgba(0,95,231,0.03));display:flex;align-items:center;justify-content:center;flex-shrink:0}
.order-meta-block-icon svg{width:1rem;height:1rem;color:#005fe7}
.order-meta-block-content{flex:1;min-width:0}
.order-meta-block-label{color:rgba(234,234,234,0.3);font-size:0.65rem;text-transform:uppercase;letter-spacing:0.05em;font-weight:500}
.order-meta-block-value{color:#EAEAEA;font-size:0.8125rem;font-weight:500;word-break:break-all;margin-top:0.0625rem}
.order-meta-block .initials{width:1.5rem;height:1.5rem;border-radius:50%;background:linear-gradient(135deg,#005fe7,#2255ff);display:flex;align-items:center;justify-content:center;font-size:0.6875rem;font-weight:700;color:#05050f;flex-shrink:0}

/* ===== DOWNLOAD SECTION — HIGHLIGHTED ===== */
.order-download-highlight{position:relative;overflow:visible!important;border:1px solid rgba(34,85,255,0.2)!important;background:linear-gradient(135deg,rgba(0,95,231,0.08),rgba(5,5,15,0.4))!important}
.order-download-highlight::before{content:'';position:absolute;inset:-1px;border-radius:inherit;background:linear-gradient(135deg,#005fe7,rgba(0,95,231,0.1),#005fe7);background-size:200% 200%;animation:downloadBorderGlow 3s ease-in-out infinite;z-index:-1;pointer-events:none}
@keyframes downloadBorderGlow{0%,100%{background-position:0% 50%}50%{background-position:100% 50%}}
.order-download-pending-pulse{animation:downloadPulse 2s ease-in-out infinite}
@keyframes downloadPulse{0%,100%{box-shadow:0 0 0 0 rgba(245,158,11,0.15)}50%{box-shadow:0 0 0 8px rgba(245,158,11,0.05)}}
.order-download-btn{display:flex;align-items:center;gap:1rem;padding:1rem 1.25rem;background:linear-gradient(135deg,rgba(0,95,231,0.1),rgba(0,95,231,0.04));border:1px solid rgba(34,85,255,0.2);border-radius:0.875rem;text-decoration:none;transition:all 0.3s cubic-bezier(0.4,0,0.2,1);position:relative;overflow:hidden}
.order-download-btn::before{content:'';position:absolute;inset:0;background:linear-gradient(90deg,transparent,rgba(34,85,255,0.05),transparent);transform:translateX(-100%);transition:transform 0.6s}
.order-download-btn:hover::before{transform:translateX(100%)}
.order-download-btn:hover{border-color:rgba(34,85,255,0.4);background:linear-gradient(135deg,rgba(0,95,231,0.15),rgba(0,95,231,0.07));transform:translateY(-1px);box-shadow:0 4px 20px rgba(34,85,255,0.1)}
.order-download-btn-icon{width:2.5rem;height:2.5rem;border-radius:0.75rem;background:linear-gradient(135deg,rgba(0,95,231,0.15),rgba(0,95,231,0.05));display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:transform 0.3s}
.order-download-btn:hover .order-download-btn-icon{transform:scale(1.1) rotate(-5deg)}
.order-download-btn-icon svg{width:1.25rem;height:1.25rem;color:#005fe7}
.order-download-btn-info{flex:1;min-width:0}
.order-download-btn-name{color:#EAEAEA;font-weight:600;font-size:0.9375rem}
.order-download-btn-sub{color:rgba(234,234,234,0.35);font-size:0.7rem;margin-top:0.125rem}
.order-download-btn-arrow{width:1.25rem;height:1.25rem;color:rgba(234,234,234,0.25);flex-shrink:0;transition:all 0.3s}
.order-download-btn:hover .order-download-btn-arrow{color:#005fe7;transform:translateX(3px)}
.order-download-header{display:flex;align-items:center;gap:0.75rem;padding:1.125rem 1.25rem;background:linear-gradient(135deg,rgba(0,95,231,0.08),transparent);border-bottom:1px solid rgba(0,95,231,0.1);color:#EAEAEA;font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:0.06em}
.order-download-header svg{width:1.125rem;height:1.125rem;color:#005fe7;flex-shrink:0}
.order-download-header-badge{display:inline-flex;align-items:center;gap:0.25rem;margin-left:auto;padding:0.2rem 0.625rem;border-radius:9999px;font-size:0.6rem;font-weight:600;text-transform:none;letter-spacing:0}
.order-download-header-badge.ready{background:rgba(0,95,231,0.15);color:#005fe7;border:1px solid rgba(0,95,231,0.2)}
.order-download-header-badge.pending{background:rgba(245,158,11,0.12);color:#f59e0b;border:1px solid rgba(245,158,11,0.2)}

/* ===== SCREENSHOT ===== */
.order-screenshot{margin-top:0.25rem}
.order-screenshot img{width:100%;max-height:280px;object-fit:contain;border-radius:0.75rem;border:1px solid rgba(255,255,255,0.06);cursor:zoom-in;transition:all 0.3s}
.order-screenshot img:hover{opacity:0.85;border-color:rgba(34,85,255,0.2);box-shadow:0 4px 24px rgba(34,85,255,0.08)}
.order-screenshot-label{color:rgba(234,234,234,0.2);font-size:0.6875rem;text-align:center;margin-top:0.5rem}

/* ===== TIMELINE ===== */
.order-timeline{padding:0!important}
.order-timeline-steps{display:flex;align-items:flex-start;gap:0;position:relative;padding:0.5rem 0}
.order-timeline-step{flex:1;text-align:center;position:relative}
.order-timeline-dot{width:0.875rem;height:0.875rem;border-radius:50%;margin:0 auto 0.375rem;position:relative;z-index:1;transition:all 0.3s}
.order-timeline-dot.active{background:#005fe7;box-shadow:0 0 10px rgba(34,85,255,0.25)}
.order-timeline-dot.current{background:#005fe7;box-shadow:0 0 10px rgba(34,85,255,0.25)}
.order-timeline-dot.pending{background:#2a2a2a;border:2px solid rgba(255,255,255,0.06)}
.order-timeline-line{position:absolute;top:0.4375rem;left:calc(50% + 0.5rem);right:calc(-50% + 0.5rem);height:2px;background:#2a2a2a;z-index:0}
.order-timeline-line.active{background:linear-gradient(90deg,#005fe7,#005fe7)}
.order-timeline-label{color:rgba(234,234,234,0.3);font-size:0.65rem;font-weight:500;white-space:nowrap;letter-spacing:0.02em}
.order-timeline-label.active{color:#005fe7}
.order-timeline-label.current{color:#005fe7}
@media (max-width:480px){.order-timeline-label{font-size:0.6rem}}

/* ===== CANCELLED BANNER ===== */
.order-cancelled-banner{text-align:center;padding:0.75rem 1rem;background:rgba(239,68,68,0.06);border:1px solid rgba(239,68,68,0.1);border-radius:0.75rem;color:#ef4444;font-size:0.8125rem;display:flex;align-items:center;justify-content:center;gap:0.5rem;backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);transition:border-color 0.2s}
.order-cancelled-banner:hover{border-color:rgba(239,68,68,0.25)}
.order-cancelled-banner svg{width:1rem;height:1rem;flex-shrink:0}

/* ===== NAVIGATION ===== */
.order-nav{display:flex;align-items:center;justify-content:space-between;gap:0.75rem;margin-top:1.5rem}
.order-nav-link{display:inline-flex;align-items:center;gap:0.5rem;padding:0.75rem 1.25rem;border-radius:0.75rem;font-size:0.875rem;font-weight:500;color:rgba(234,234,234,0.5);text-decoration:none;background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.06);transition:all 0.3s cubic-bezier(0.4,0,0.2,1);flex:1;max-width:16rem}
.order-nav-link:hover{color:#EAEAEA;background:rgba(0,95,231,0.06);border-color:rgba(0,95,231,0.15)}
.order-nav-link.disabled{opacity:0.2;pointer-events:none;cursor:default}
.order-nav-link svg{width:1rem;height:1rem;flex-shrink:0;transition:transform 0.3s ease}
.order-nav-link:hover svg:first-child{transform:translateX(-2px)}
.order-nav-link:hover svg:last-child{transform:translateX(2px)}
.order-nav-label{display:flex;flex-direction:column;gap:0.125rem}
.order-nav-sub{color:rgba(234,234,234,0.2);font-size:0.65rem;text-transform:uppercase;letter-spacing:0.04em}
.order-nav-mid{display:flex;align-items:center;gap:0.5rem}
.order-nav-dots{display:flex;gap:0.375rem}
.order-nav-dot{width:0.375rem;height:0.375rem;border-radius:50%;background:rgba(255,255,255,0.15);transition:all 0.3s}
.order-nav-dot.active{background:#005fe7;box-shadow:0 0 6px rgba(34,85,255,0.3)}

/* ===== NO ORDER ===== */
.order-empty{text-align:center;padding:4rem 1rem}
.order-empty-icon{width:4rem;height:4rem;margin:0 auto 1.25rem;border-radius:1rem;display:flex;align-items:center;justify-content:center;padding:0}
.order-empty-icon svg{width:1.5rem;height:1.5rem;color:rgba(234,234,234,0.15)}
.order-empty-title{color:#EAEAEA;font-weight:600;font-size:1.125rem;margin-bottom:0.5rem}
.order-empty-desc{color:rgba(234,234,234,0.4);font-size:0.875rem;max-width:24rem;margin:0 auto 1.5rem;line-height:1.6}
</style>

<section class="order-page">
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="grid-bg" style="position:absolute;inset:0;opacity:0.3;pointer-events:none"></div>

    <div class="order-inner">
        @if($order)
            <!-- Back link -->
            <a href="{{ route('forex.my-orders') }}" class="order-back reveal">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to My Orders
            </a>

            @php
                $statusColors = [
                    'pending' => ['bg' => 'rgba(245,158,11,0.04)', 'border' => 'rgba(245,158,11,0.2)', 'dot' => '#f59e0b', 'text' => '#f59e0b'],
                    'processing' => ['bg' => 'rgba(0,95,231,0.04)', 'border' => 'rgba(0,95,231,0.2)', 'dot' => '#005fe7', 'text' => '#005fe7'],
                    'completed' => ['bg' => 'rgba(0,95,231,0.04)', 'border' => 'rgba(0,95,231,0.15)', 'dot' => '#005fe7', 'text' => '#005fe7'],
                    'cancelled' => ['bg' => 'rgba(239,68,68,0.04)', 'border' => 'rgba(239,68,68,0.2)', 'dot' => '#ef4444', 'text' => '#ef4444'],
                ];
                $sc = $statusColors[$order->status] ?? $statusColors['pending'];

                $methodNames = [
                    'binance_pay' => 'Binance Pay ID',
                    'usdt_trc20' => 'Tether USDT (TRC20)',
                    'usdc_bep20' => 'USDC (BEP20)',
                    'bitcoin' => 'Bitcoin (BTC)',
                    'ethereum' => 'Ethereum (ERC20)',
                    'toncoin' => 'TonCoin (TON)',
                    'usdt_bep20' => 'Tether USDT (BEP20)',
                ];
            @endphp

            <!-- Success Banner -->
            @if(session('success'))
            <div class="order-card order-success-banner reveal" style="transition-delay:0.03s">
                <div class="order-success-glow"></div>
                <div class="order-success-icon">
                    <div class="order-success-icon-inner"></div>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                </div>
                <h2 style="color:#EAEAEA;font-weight:700;font-size:1.25rem;margin-bottom:0.375rem;position:relative;z-index:1">Order Placed Successfully!</h2>
                <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;margin:0;position:relative;z-index:1">{{ session('success') }}</p>
            </div>
            @endif

            <!-- Hero Header -->
            <div class="order-hero reveal" style="transition-delay:0.06s">
                <div class="order-hero-glow"></div>
                <div class="order-hero-top">
                    <div class="order-hero-number">
                        <span>{{ $order->order_number }}</span>
                        <span>Order #</span>
                    </div>
                    <span style="display:inline-flex;align-items:center;gap:0.375rem;padding:0.375rem 1rem;border-radius:9999px;font-size:0.75rem;font-weight:600;background:{{ $sc['bg'] }};border:1px solid {{ $sc['border'] }};color:{{ $sc['text'] }};backdrop-filter:blur(4px);-webkit-backdrop-filter:blur(4px);flex-shrink:0">
                        <span style="width:0.4375rem;height:0.4375rem;border-radius:50%;background:{{ $sc['dot'] }}"></span>
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                <div class="order-hero-meta">
                    <div class="order-hero-meta-item">
                        <span class="order-hero-meta-label">Order Date</span>
                        <span class="order-hero-meta-value">{{ $order->created_at->format('F d, Y') }}</span>
                    </div>
                    <div class="order-hero-meta-item">
                        <span class="order-hero-meta-label">Payment Status</span>
                        <span class="order-hero-meta-value" style="color:#005fe7;display:flex;align-items:center;gap:0.375rem">
                            <svg style="width:0.875rem;height:0.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            @if($order->status === 'pending') Awaiting Confirmation
                            @elseif($order->status === 'cancelled') Cancelled
                            @else Completed
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Main Grid -->
            <div class="order-grid">

                <!-- LEFT COLUMN -->
                <div class="order-left">

                    <!-- Purchased Items + Pricing -->
                    <div class="order-card reveal" style="transition-delay:0.1s">
                        <div class="order-card-header">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            Items ({{ count($order->items ?? []) }})
                        </div>
                        <div class="order-card-body">
                            <div class="order-items">
                                @foreach($order->items as $item)
                                <div class="order-item">
                                    <div class="order-item-icon">
                                        @php $itemName = strtolower($item['name'] ?? ''); @endphp
                                        @if(str_contains($itemName, 'bundle') || str_contains($itemName, 'starter') || str_contains($itemName, 'premium') || str_contains($itemName, 'advanced'))
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                        @elseif(str_contains($itemName, 'dark'))
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        @else
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                        @endif
                                    </div>
                                    <div class="order-item-info">
                                        <div class="order-item-name">{{ $item['name'] ?? 'Item' }}</div>
                                        <div class="order-item-qty">Qty: {{ $item['qty'] ?? 1 }}</div>
                                    </div>
                                    <span class="order-item-price">${{ number_format(($item['price'] ?? 0) * ($item['qty'] ?? 1), 2) }}</span>
                                </div>
                                @endforeach
                            </div>

                            <!-- Pricing -->
                            <div style="margin-top:1.25rem;padding-top:1.25rem;border-top:1px solid rgba(255,255,255,0.06)">
                                <div class="order-pricing-row">
                                    <span class="order-pricing-label">Subtotal</span>
                                    <span class="order-pricing-value">${{ number_format($order->subtotal, 2) }}</span>
                                </div>
                                <div class="order-pricing-row">
                                    <span class="order-pricing-label" style="display:flex;align-items:center;gap:0.375rem">
                                        <svg style="width:0.875rem;height:0.875rem;color:#005fe7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        One-Time Payment
                                    </span>
                                    <span class="order-pricing-value" style="color:#005fe7">Lifetime Access</span>
                                </div>
                                <div class="order-pricing-row order-pricing-total">
                                    <span class="order-pricing-label">Total Paid</span>
                                    <span class="order-pricing-value">${{ number_format($order->total, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Download Section — Highlighted -->
                    <div class="order-card order-download-highlight reveal" style="transition-delay:0.13s">
                        <div class="order-download-header">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Download Your Files
                            @if(in_array($order->status, ['completed', 'processing']) && count($downloadLinks) > 0)
                                <span class="order-download-header-badge ready">
                                    <svg style="width:0.625rem;height:0.625rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    Ready
                                </span>
                            @elseif($order->status !== 'cancelled')
                                <span class="order-download-header-badge pending">
                                    <svg style="width:0.625rem;height:0.625rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Pending
                                </span>
                            @endif
                        </div>
                        <div class="order-card-body">
                            @if(in_array($order->status, ['completed', 'processing']) && count($downloadLinks) > 0)
                                <div style="display:flex;flex-direction:column;gap:0.875rem">
                                    @foreach($downloadLinks as $dl)
                                    <a href="{{ $dl['link'] }}" target="_blank" rel="noopener" class="order-download-btn">
                                        <div class="order-download-btn-icon">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                        </div>
                                        <div class="order-download-btn-info">
                                            <div class="order-download-btn-name">{{ $dl['name'] }}</div>
                                            <div class="order-download-btn-sub">Click to Download</div>
                                        </div>
                                        <svg class="order-download-btn-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                    @endforeach
                                </div>
                            @elseif($order->status === 'cancelled')
                                <div style="text-align:center;padding:0.75rem 0;color:rgba(234,234,234,0.3);font-size:0.875rem">
                                    <svg style="width:1.25rem;height:1.25rem;color:#ef4444;margin:0 auto 0.5rem;display:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                                    Order was cancelled
                                </div>
                            @elseif(in_array($order->status, ['completed', 'processing']))
                                <div style="text-align:center;padding:0.75rem 0">
                                    <div style="width:2.75rem;height:2.75rem;border-radius:50%;background:rgba(0,95,231,0.06);border:1px solid rgba(0,95,231,0.12);display:flex;align-items:center;justify-content:center;margin:0 auto 0.75rem">
                                        <svg style="width:1.25rem;height:1.25rem;color:#005fe7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;margin:0;line-height:1.6">No download links available yet. Please contact support.</p>
                                </div>
                            @else
                                <div style="text-align:center;padding:0.75rem 0" class="order-download-pending-pulse">
                                    <div style="width:3rem;height:3rem;border-radius:50%;background:rgba(245,158,11,0.1);border:1px solid rgba(245,158,11,0.2);display:flex;align-items:center;justify-content:center;margin:0 auto 0.75rem">
                                        <svg style="width:1.375rem;height:1.375rem;color:#f59e0b" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <p style="color:#f59e0b;font-size:1rem;font-weight:600;margin:0 0 0.375rem;line-height:1.4">
                                        You will get the download link here after the Approval
                                    </p>
                                    <p style="color:rgba(234,234,234,0.3);font-size:0.8rem;margin:0;line-height:1.5">
                                        Your order is being processed. Once approved, your download links will appear here automatically.
                                    </p>
                                </div>
                            @endif

                            <!-- ===== TELEGRAM SUPPORT NOTICE ===== -->
                            <div style="margin-top:1.25rem;padding-top:1.25rem;border-top:1px solid rgba(255,255,255,0.06);text-align:center">
                                <p style="color:#EAEAEA;font-size:0.875rem;line-height:1.6;margin:0;font-weight:500">
                                    Can't download? Send us a message on
                                    <a href="https://t.me/SmartBinarySupport" target="_blank" rel="noopener" style="color:#005fe7;text-decoration:none;font-weight:600;transition:color 0.2s" onmouseover="this.style.color='#2255ff'" onmouseout="this.style.color='#005fe7'">
                                        Telegram Support
                                        <svg style="width:0.75rem;height:0.75rem;display:inline;vertical-align:middle;margin-left:0.125rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a> for help
                                </p>
                            </div>

                        </div>
                    </div>

                    <!-- Payment Screenshot (full width) -->
                    @if($order->payment_screenshot)
                    <div class="order-card reveal" style="transition-delay:0.15s">
                        <div class="order-card-header">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Payment Screenshot
                        </div>
                        <div class="order-card-body">
                            <div class="order-screenshot">
                                <a href="{{ config('app.storage_url') }}{{ $order->payment_screenshot }}" target="_blank" rel="noopener">
                                    <img src="{{ config('app.storage_url') }}{{ $order->payment_screenshot }}" alt="Payment Screenshot">
                                </a>
                                <div class="order-screenshot-label">Click to view full size</div>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>

                <!-- RIGHT COLUMN (Sidebar) -->
                <div class="order-right">

                    <!-- Customer Details -->
                    <div class="order-card reveal" style="transition-delay:0.12s">
                        <div class="order-card-header">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Customer
                        </div>
                        <div class="order-card-body">
                            <div class="order-meta-grid">
                                @if($order->customer_name)
                                <div class="order-meta-block">
                                    <span class="initials">{{ substr($order->customer_name, 0, 1) }}</span>
                                    <div class="order-meta-block-content">
                                        <div class="order-meta-block-label">Full Name</div>
                                        <div class="order-meta-block-value">{{ $order->customer_name }}</div>
                                    </div>
                                </div>
                                @endif
                                @if($order->customer_email)
                                <div class="order-meta-block">
                                    <div class="order-meta-block-icon">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    </div>
                                    <div class="order-meta-block-content">
                                        <div class="order-meta-block-label">Email Address</div>
                                        <div class="order-meta-block-value">{{ $order->customer_email }}</div>
                                    </div>
                                </div>
                                @endif
                                @if($order->notes)
                                <div class="order-meta-block" style="grid-column:1/-1">
                                    <div class="order-meta-block-icon" style="background:rgba(245,158,11,0.08);color:#f59e0b">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                                    </div>
                                    <div class="order-meta-block-content">
                                        <div class="order-meta-block-label">Notes</div>
                                        <div class="order-meta-block-value">{{ $order->notes }}</div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Payment Details -->
                    @if($order->payment_method || $order->transaction_id)
                    <div class="order-card reveal" style="transition-delay:0.16s">
                        <div class="order-card-header">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            Payment Details
                        </div>
                        <div class="order-card-body">
                            <div class="order-meta-grid">
                                @if($order->payment_method && $order->payment_method !== 'pending_payment')
                                <div class="order-meta-block">
                                    <div class="order-meta-block-icon">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                    </div>
                                    <div class="order-meta-block-content">
                                        <div class="order-meta-block-label">Payment Method</div>
                                        <div class="order-meta-block-value">{{ $methodNames[$order->payment_method] ?? ucfirst(str_replace('_', ' ', $order->payment_method)) }}</div>
                                    </div>
                                </div>
                                @endif
                                @if($order->transaction_id)
                                <div class="order-meta-block" style="grid-column:1/-1">
                                    <div class="order-meta-block-icon">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <div class="order-meta-block-content">
                                        <div class="order-meta-block-label">Transaction ID / Hash</div>
                                        <div class="order-meta-block-value" style="font-family:monospace;font-size:0.75rem;word-break:break-all">{{ $order->transaction_id }}</div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Order Timeline -->
                    @php
                        $timelineSteps = [
                            ['key' => 'placed', 'label' => 'Placed'],
                            ['key' => 'processing', 'label' => 'Processing'],
                            ['key' => 'completed', 'label' => 'Completed'],
                        ];
                        $currentStatus = $order->status;
                        $statusOrder = ['pending' => 0, 'processing' => 1, 'completed' => 2, 'cancelled' => -1];
                        $stepIndex = $statusOrder[$currentStatus] ?? 0;
                    @endphp
                    <div class="order-card reveal order-timeline" style="transition-delay:0.2s">
                        <div class="order-card-header">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Timeline
                        </div>
                        <div class="order-card-body">
                            <div class="order-timeline-steps">
                            @foreach($timelineSteps as $i => $step)
                            <div class="order-timeline-step">
                                @php
                                    $isActive = $i <= $stepIndex;
                                    $isCurrent = $i === $stepIndex;
                                @endphp
                                @if($currentStatus === 'cancelled')
                                    @php $isActive = $i === 0; $isCurrent = false; @endphp
                                @endif
                                <div class="order-timeline-dot {{ $isActive ? ($isCurrent ? 'current' : 'active') : 'pending' }}"></div>
                                <div class="order-timeline-label {{ $isActive ? ($isCurrent ? 'current' : 'active') : '' }}">{{ $step['label'] }}</div>
                                @if(!$loop->last)
                                <div class="order-timeline-line {{ $stepIndex > $i && $currentStatus !== 'cancelled' ? 'active' : '' }}"></div>
                                @endif
                            </div>
                            @endforeach
                            </div>
                            @if($currentStatus === 'cancelled')
                            <div class="order-cancelled-banner" style="margin-top:1rem">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                                This order has been cancelled
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            <!-- Previous / Next Navigation -->
            <div class="order-nav reveal" style="transition-delay:0.25s">
                <a href="{{ $prevOrder ? route('order.success', $prevOrder) : '#' }}" class="order-nav-link {{ !$prevOrder ? 'disabled' : '' }}" style="text-align:left">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    <div class="order-nav-label">
                        <span class="order-nav-sub">Previous</span>
                        <span style="font-size:0.8125rem;color:rgba(234,234,234,0.6)">Newer Order</span>
                    </div>
                </a>

                <div class="order-nav-mid">
                    <div class="order-nav-dots">
                        <span class="order-nav-dot {{ !$prevOrder ? 'active' : '' }}"></span>
                        <span class="order-nav-dot active"></span>
                        <span class="order-nav-dot {{ !$nextOrder ? 'active' : '' }}"></span>
                    </div>
                </div>

                <a href="{{ $nextOrder ? route('order.success', $nextOrder) : '#' }}" class="order-nav-link {{ !$nextOrder ? 'disabled' : '' }}" style="text-align:right">
                    <div class="order-nav-label">
                        <span class="order-nav-sub">Next</span>
                        <span style="font-size:0.8125rem;color:rgba(234,234,234,0.6)">Older Order</span>
                    </div>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

        @else
            <!-- No Order Fallback -->
            <div class="order-empty reveal">
                <div class="glass-card order-empty-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h2 class="order-empty-title">Order Not Found</h2>
                <p class="order-empty-desc">The order you're looking for could not be found. It may have been removed or the link may be invalid.</p>
                <a href="{{ route('forex.home') }}#pricing" class="btn-primary" style="display:inline-flex;align-items:center;gap:0.5rem;text-decoration:none">
                    Browse Expert Advisors
                    <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        @endif
    </div>
</section>
@endsection