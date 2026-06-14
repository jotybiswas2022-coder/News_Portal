@extends('backend.app')

@section('title', 'Order #' . $order->order_number . ' — Admin')

@section('content')

@if (session('success'))
    <input type="hidden" id="sessionSuccess" value="{{ session('success') }}">
@endif

<div class="order-show">

    {{-- ─── Back Link ─── --}}
    <a href="{{ route('admin.orders.index') }}" class="os-back">
        <i class="bi bi-arrow-left"></i>
        <span>Back to Orders</span>
    </a>

    {{-- ─── Header ─── --}}
    <div class="os-header">
        <div class="os-header-bg"></div>
        <div class="os-header-content">
            <div class="os-header-left">
                <div class="os-header-icon">
                    <i class="bi bi-receipt"></i>
                </div>
                <div>
                    <h1 class="os-header-title">Order <span class="os-header-num">#{{ $order->order_number }}</span></h1>
                    <div class="os-header-meta">
                        <span><i class="bi bi-calendar3"></i> {{ $order->created_at->format('F d, Y \\a\\t h:i A') }}</span>
                        @if($order->updated_at && $order->updated_at->ne($order->created_at))
                            <span class="os-header-meta-sep">·</span>
                            <span><i class="bi bi-arrow-repeat"></i> Updated {{ $order->updated_at->diffForHumans() }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="os-header-right">
                {{-- Status Update Form --}}
                <form method="POST" action="{{ route('admin.orders.status', $order->id) }}" class="os-status-form" id="orderStatusForm">
                    @csrf
                    <div class="os-status-select-wrap">
                        <i class="bi bi-pencil-square os-status-icon"></i>
                        <select name="status" class="os-status-select" id="orderStatusSelect">
                            @foreach($statuses as $s)
                                <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <span class="os-badge os-badge-{{ $order->status }}">
                    <span class="os-badge-dot"></span>
                    {{ ucfirst($order->status) }}
                </span>
                <button type="button" class="os-btn-icon" onclick="window.print()" title="Print Order">
                    <i class="bi bi-printer"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- ─── Status Progress ─── --}}
    @php
        $flow = ['pending', 'processing', 'completed'];
        $currentIdx = array_search($order->status, $flow);
    @endphp
    @if($currentIdx !== false)
    <div class="os-progress">
        @foreach($flow as $i => $step)
            <div class="os-progress-step {{ $i <= $currentIdx ? 'os-progress-done' : '' }} {{ $i == $currentIdx ? 'os-progress-active' : '' }}">
                <div class="os-progress-icon">
                    @if($i < $currentIdx)
                        <i class="bi bi-check-lg"></i>
                    @elseif($i == $currentIdx)
                        <i class="bi bi-{{ $step === 'completed' ? 'check-circle' : ($step === 'processing' ? 'gear' : 'clock') }}"></i>
                    @else
                        <i class="bi bi-{{ $step === 'completed' ? 'check-circle' : ($step === 'processing' ? 'gear' : 'clock') }}"></i>
                    @endif
                </div>
                <div class="os-progress-text">{{ ucfirst($step) }}</div>
                @if(!$loop->last)
                    <div class="os-progress-line {{ $i < $currentIdx ? 'os-progress-line-done' : '' }}"></div>
                @endif
            </div>
        @endforeach
        @if($order->status === 'cancelled')
            <div class="os-progress-step os-progress-cancelled">
                <div class="os-progress-icon">
                    <i class="bi bi-x-lg"></i>
                </div>
                <div class="os-progress-text">Cancelled</div>
            </div>
        @endif
    </div>
    @elseif($order->status === 'cancelled')
    <div class="os-progress">
        <div class="os-progress-step os-progress-done">
            <div class="os-progress-icon"><i class="bi bi-check-lg"></i></div>
            <div class="os-progress-text">Pending</div>
            <div class="os-progress-line"></div>
        </div>
        <div class="os-progress-step os-progress-cancelled">
            <div class="os-progress-icon"><i class="bi bi-x-lg"></i></div>
            <div class="os-progress-text">Cancelled</div>
        </div>
    </div>
    @endif

    {{-- ─── 3-Column Detail Grid ─── --}}
    <div class="os-grid">

        {{-- Customer Information --}}
        <div class="os-card">
            <div class="os-card-head">
                <i class="bi bi-person-circle os-card-head-icon"></i>
                <span>Customer Information</span>
            </div>
            <div class="os-card-body">
                <div class="os-field">
                    <span class="os-field-label">Name</span>
                    <span class="os-field-value">{{ $order->customer_name ?? 'Guest' }}</span>
                </div>
                <div class="os-field-divider"></div>
                <div class="os-field">
                    <span class="os-field-label">Email</span>
                    <span class="os-field-value">
                        @if($order->customer_email)
                            <a href="mailto:{{ $order->customer_email }}" class="os-link">{{ $order->customer_email }}</a>
                        @else
                            <span class="os-na">N/A</span>
                        @endif
                    </span>
                </div>
                @if($order->phone)
                <div class="os-field-divider"></div>
                <div class="os-field">
                    <span class="os-field-label">Phone</span>
                    <span class="os-field-value">{{ $order->phone }}</span>
                </div>
                @endif
                @if($order->trading_account)
                <div class="os-field-divider"></div>
                <div class="os-field">
                    <span class="os-field-label">Trading Account</span>
                    <span class="os-field-value os-mono">{{ $order->trading_account }}</span>
                </div>
                @endif
                @if($order->user_id)
                <div class="os-field-divider"></div>
                <div class="os-field">
                    <span class="os-field-label">User ID</span>
                    <span class="os-field-value os-mono" style="color:var(--os-muted)">#{{ $order->user_id }}</span>
                </div>
                @endif
                @if($order->notes)
                <div class="os-field-divider"></div>
                <div class="os-field">
                    <span class="os-field-label">Notes</span>
                    <span class="os-field-value">{{ $order->notes }}</span>
                </div>
                @endif
            </div>
        </div>

        {{-- Payment Information --}}
        <div class="os-card">
            <div class="os-card-head">
                <i class="bi bi-credit-card os-card-head-icon"></i>
                <span>Payment Information</span>
            </div>
            <div class="os-card-body">
                @php
                    $methodNames = [
                        'binance_pay' => 'Binance Pay',
                        'usdt_trc20'  => 'Tether USDT (TRC20)',
                        'usdc_bep20'  => 'USDC (BEP20)',
                        'bitcoin'     => 'Bitcoin (BTC)',
                        'ethereum'    => 'Ethereum (ERC20)',
                        'toncoin'     => 'TonCoin (TON)',
                        'usdt_bep20'  => 'Tether USDT (BEP20)',
                        'pending_payment' => 'Pending Payment',
                    ];
                @endphp
                @if($order->payment_method || $order->transaction_id || $order->payment_screenshot)
                    <div class="os-field">
                        <span class="os-field-label">Method</span>
                        <span class="os-field-value">
                            <span class="os-payment-badge">
                                <i class="bi bi-{{ $order->payment_method === 'binance_pay' ? 'currency-bitcoin' : ($order->payment_method === 'pending_payment' ? 'hourglass' : 'wallet2') }}"></i>
                                {{ $methodNames[$order->payment_method] ?? ucfirst(str_replace('_', ' ', $order->payment_method ?? 'N/A')) }}
                            </span>
                        </span>
                    </div>
                    @if($order->transaction_id)
                    <div class="os-field-divider"></div>
                    <div class="os-field">
                        <span class="os-field-label">Transaction ID</span>
                        <span class="os-field-value os-txid">{{ $order->transaction_id }}</span>
                    </div>
                    @endif
                    <div class="os-field-divider"></div>
                    <div class="os-field">
                        <span class="os-field-label">Status</span>
                        <span class="os-field-value">
                            <span class="os-badge-sm os-badge-{{ $order->status }}">
                                <span class="os-badge-dot"></span>
                                {{ ucfirst($order->status) }}
                            </span>
                        </span>
                    </div>
                @else
                    <div class="os-empty-state">
                        <i class="bi bi-hourglass-split os-empty-icon"></i>
                        <span class="os-empty-text">Awaiting payment details</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- Order Summary --}}
        <div class="os-card">
            <div class="os-card-head">
                <i class="bi bi-calculator os-card-head-icon"></i>
                <span>Order Summary</span>
            </div>
            <div class="os-card-body">
                <div class="os-summary">
                    <div class="os-summary-row">
                        <span class="os-summary-label">Subtotal</span>
                        <span class="os-summary-value">${{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="os-summary-row">
                        <span class="os-summary-label">Items</span>
                        <span class="os-summary-value">{{ count($order->items) }}</span>
                    </div>
                    <div class="os-summary-divider"></div>
                    <div class="os-summary-row os-summary-total">
                        <span class="os-summary-total-label">Total</span>
                        <span class="os-summary-total-value">${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ─── Payment Screenshot ─── --}}
    @if($order->payment_screenshot)
    <div class="os-card os-card-media">
        <div class="os-card-head">
            <i class="bi bi-image os-card-head-icon"></i>
            <span>Payment Screenshot</span>
        </div>
        <div class="os-screenshot-wrap">
            <a href="{{ config('app.storage_url') }}{{ $order->payment_screenshot }}" target="_blank" rel="noopener" class="os-screenshot-link">
                <img src="{{ config('app.storage_url') }}{{ $order->payment_screenshot }}" alt="Payment Screenshot" class="os-screenshot-img" loading="lazy">
                <div class="os-screenshot-overlay">
                    <i class="bi bi-arrows-fullscreen"></i>
                    <span>View Full Size</span>
                </div>
            </a>
        </div>
    </div>
    @endif

    {{-- ─── Order Items ─── --}}
    <div class="os-card">
        <div class="os-card-head">
            <i class="bi bi-box-seam os-card-head-icon"></i>
            <span>Items ({{ count($order->items) }})</span>
        </div>
        <div class="os-items-wrap">
            <div class="os-items-header">
                <span class="os-items-h-item">Item</span>
                <span class="os-items-h-qty">Qty</span>
                <span class="os-items-h-price">Price</span>
                <span class="os-items-h-total">Total</span>
            </div>
            <div class="os-items-body">
                @foreach($order->items as $item)
                    <div class="os-item-row">
                        <div class="os-item-info">
                            <div class="os-item-name">{{ $item['name'] ?? 'Item' }}</div>
                            @if(!empty($item['description']))
                                <div class="os-item-desc">{{ $item['description'] }}</div>
                            @endif
                        </div>
                        <div class="os-item-qty">{{ $item['qty'] ?? 1 }}</div>
                        <div class="os-item-price">${{ number_format($item['price'] ?? 0, 2) }}</div>
                        <div class="os-item-total">${{ number_format(($item['price'] ?? 0) * ($item['qty'] ?? 1), 2) }}</div>
                    </div>
                @endforeach
            </div>
            <div class="os-items-footer">
                <span class="os-items-footer-label">Grand Total</span>
                <span class="os-items-footer-value">${{ number_format($order->total, 2) }}</span>
            </div>
        </div>
    </div>

</div>

<style>
/* ─── Base ─── */
.order-show {
    --os-bg: #0f172a;
    --os-card: rgba(255,255,255,0.03);
    --os-card-hover: rgba(255,255,255,0.05);
    --os-text: #f1f5f9;
    --os-muted: #94a3b8;
    --os-sub: #64748b;
    --os-border: rgba(255,255,255,0.07);
    --os-border-hover: rgba(255,255,255,0.12);
    --os-primary: #60A5FA;
    --os-primary-dim: rgba(96,165,250,0.1);
    --os-primary-glow: rgba(96,165,250,0.15);
    --os-warn: #f59e0b;
    --os-warn-dim: rgba(245,158,11,0.1);
    --os-success: #10b981;
    --os-success-dim: rgba(16,185,129,0.1);
    --os-danger: #ef4444;
    --os-danger-dim: rgba(239,68,68,0.1);
    --os-radius: 14px;
    --os-radius-sm: 10px;
    --os-shadow: 0 4px 24px rgba(0,0,0,0.2);
    --os-transition: 0.25s cubic-bezier(0.4, 0, 0.2, 1);

    padding: 28px 32px;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    color: var(--os-text);
    min-height: 100%;
}

/* ─── Back Link ─── */
.os-back {
    display: inline-flex; align-items: center; gap: 8px;
    color: var(--os-muted); font-size: 13px; font-weight: 500;
    text-decoration: none; margin-bottom: 22px;
    padding: 8px 16px; border-radius: var(--os-radius-sm);
    background: var(--os-card); border: 1px solid var(--os-border);
    transition: all var(--os-transition);
}
.os-back:hover {
    color: var(--os-text);
    background: var(--os-card-hover);
    border-color: var(--os-border-hover);
    gap: 12px;
    transform: translateX(-2px);
}
.os-back i { font-size: 14px; }

/* ─── Header ─── */
.os-header {
    position: relative;
    background: var(--os-card);
    border: 1px solid var(--os-border);
    border-radius: var(--os-radius);
    overflow: hidden;
    margin-bottom: 22px;
    backdrop-filter: blur(12px);
}
.os-header-bg {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(96,165,250,0.06) 0%, transparent 50%, rgba(96,165,250,0.02) 100%);
    pointer-events: none;
}
.os-header-content {
    position: relative;
    display: flex; flex-wrap: wrap;
    justify-content: space-between; align-items: center;
    padding: 20px 24px; gap: 16px;
}
.os-header-left { display: flex; align-items: center; gap: 16px; }
.os-header-icon {
    width: 50px; height: 50px;
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, rgba(96,165,250,0.18), rgba(96,165,250,0.04));
    border: 1px solid rgba(96,165,250,0.15);
    border-radius: 14px;
    font-size: 22px; color: var(--os-primary);
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(96,165,250,0.1);
}
.os-header-title { font-size: 20px; font-weight: 700; margin: 0 0 4px 0; line-height: 1.2; }
.os-header-num { color: var(--os-primary); }
.os-header-meta {
    display: flex; align-items: center; gap: 6px;
    font-size: 13px; color: var(--os-muted); margin: 0;
}
.os-header-meta i { font-size: 12px; margin-right: 3px; }
.os-header-meta-sep { color: var(--os-sub); }
.os-header-right {
    display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
}

/* ─── Status Badge ─── */
.os-badge {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 7px 18px; border-radius: 999px;
    font-size: 13px; font-weight: 600;
    transition: all var(--os-transition);
    white-space: nowrap;
}
.os-badge-dot {
    width: 7px; height: 7px; border-radius: 50%;
    background: currentColor;
}
.os-badge-pending .os-badge-dot,
.os-badge-processing .os-badge-dot {
    animation: os-pulse 2s ease-in-out infinite;
}
.os-badge-completed .os-badge-dot,
.os-badge-cancelled .os-badge-dot {
    animation: none;
    opacity: 1;
}
@keyframes os-pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(0.85); }
}
.os-badge-pending {
    background: var(--os-warn-dim); color: var(--os-warn);
    border: 1px solid rgba(245,158,11,0.2);
}
.os-badge-processing {
    background: var(--os-primary-dim); color: var(--os-primary);
    border: 1px solid rgba(96,165,250,0.2);
}
.os-badge-completed {
    background: var(--os-success-dim); color: var(--os-success);
    border: 1px solid rgba(16,185,129,0.2);
}
.os-badge-cancelled {
    background: var(--os-danger-dim); color: var(--os-danger);
    border: 1px solid rgba(239,68,68,0.2);
}

/* ─── Status Select ─── */
.os-status-form { margin: 0; }
.os-status-select-wrap {
    position: relative; display: inline-flex; align-items: center;
}
.os-status-icon {
    position: absolute; left: 12px; z-index: 2;
    color: var(--os-muted); font-size: 13px; pointer-events: none;
}
.os-status-select {
    padding: 8px 36px 8px 38px;
    border-radius: var(--os-radius-sm); font-size: 13px; font-weight: 600;
    background: var(--os-card);
    border: 1px solid var(--os-border); color: var(--os-text);
    cursor: pointer; transition: all var(--os-transition);
    font-family: inherit;
    min-width: 150px;
    appearance: none; -webkit-appearance: none; -moz-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 10px center;
}
.os-status-select:hover { border-color: var(--os-primary); }
.os-status-select:focus {
    outline: none; border-color: var(--os-primary);
    box-shadow: 0 0 0 3px var(--os-primary-glow);
}
.os-status-select option { background: #1e293b; color: var(--os-text); }

/* ─── Action Icon Button ─── */
.os-btn-icon {
    display: inline-flex; align-items: center; justify-content: center;
    width: 38px; height: 38px;
    background: var(--os-card); color: var(--os-muted);
    border: 1px solid var(--os-border);
    border-radius: var(--os-radius-sm); font-size: 16px;
    cursor: pointer; transition: all var(--os-transition);
}
.os-btn-icon:hover {
    background: var(--os-card-hover);
    border-color: var(--os-border-hover);
    color: var(--os-primary);
    transform: translateY(-1px);
}

/* ─── Status Progress ─── */
.os-progress {
    display: flex; align-items: center; gap: 0;
    background: var(--os-card);
    border: 1px solid var(--os-border);
    border-radius: var(--os-radius);
    padding: 18px 28px;
    margin-bottom: 22px;
    backdrop-filter: blur(8px);
}
.os-progress-step {
    display: flex; align-items: center; gap: 10px;
    position: relative; flex: 1;
}
.os-progress-icon {
    width: 36px; height: 36px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; flex-shrink: 0;
    background: var(--os-card); border: 2px solid var(--os-border);
    color: var(--os-sub);
    transition: all var(--os-transition);
}
.os-progress-text {
    font-size: 13px; font-weight: 600; color: var(--os-sub);
    white-space: nowrap; transition: color var(--os-transition);
    margin-right: 20px;
}
.os-progress-line {
    flex: 1; height: 2px;
    background: var(--os-border);
    margin: 0 4px;
    transition: background var(--os-transition);
    min-width: 20px;
    border-radius: 2px;
}
/* Done step */
.os-progress-done .os-progress-icon {
    background: var(--os-success-dim);
    border-color: var(--os-success);
    color: var(--os-success);
    box-shadow: 0 0 12px rgba(16,185,129,0.2);
}
.os-progress-done .os-progress-text { color: var(--os-success); }
.os-progress-line-done { background: var(--os-success); }
/* Active step */
.os-progress-active .os-progress-icon {
    background: var(--os-primary-dim);
    border-color: var(--os-primary);
    color: var(--os-primary);
    box-shadow: 0 0 14px var(--os-primary-glow);
    animation: os-breathe 2s ease-in-out infinite;
}
.os-progress-active .os-progress-text { color: var(--os-primary); }
@keyframes os-breathe {
    0%, 100% { box-shadow: 0 0 10px var(--os-primary-glow); }
    50% { box-shadow: 0 0 22px var(--os-primary-glow); }
}
/* Cancelled step */
.os-progress-cancelled .os-progress-icon {
    background: var(--os-danger-dim);
    border-color: var(--os-danger);
    color: var(--os-danger);
    box-shadow: 0 0 12px rgba(239,68,68,0.2);
}
.os-progress-cancelled .os-progress-text { color: var(--os-danger); }

/* ─── 3-Column Grid ─── */
.os-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 20px;
    margin-bottom: 22px;
}

/* ─── Cards ─── */
.os-card {
    background: var(--os-card);
    border: 1px solid var(--os-border);
    border-radius: var(--os-radius);
    overflow: hidden;
    backdrop-filter: blur(8px);
    transition: all var(--os-transition);
}
.os-card:hover {
    border-color: var(--os-border-hover);
    box-shadow: var(--os-shadow);
}
.os-card-head {
    display: flex; align-items: center; gap: 9px;
    padding: 14px 20px;
    background: linear-gradient(135deg, rgba(96,165,250,0.07), rgba(96,165,250,0.01));
    border-bottom: 1px solid var(--os-border);
    font-size: 12px; font-weight: 700; color: var(--os-primary);
    text-transform: uppercase; letter-spacing: 0.5px;
}
.os-card-head-icon { font-size: 15px; }
.os-card-body { padding: 16px 20px; }

/* ─── Fields ─── */
.os-field {
    display: flex; justify-content: space-between; align-items: center;
    padding: 7px 0;
    gap: 12px;
}
.os-field-label { font-size: 13px; color: var(--os-muted); flex-shrink: 0; }
.os-field-value { font-size: 14px; font-weight: 600; color: var(--os-text); text-align: right; word-break: break-word; max-width: 55%; }
.os-field-divider { height: 1px; background: var(--os-border); margin: 3px 0; }
.os-link { color: var(--os-primary); text-decoration: none; transition: color var(--os-transition); }
.os-link:hover { color: #93c5fd; text-decoration: underline; }
.os-na { color: var(--os-sub); font-weight: 400; font-style: italic; }
.os-mono { font-family: 'JetBrains Mono', 'SF Mono', monospace; font-size: 13px; }
.os-txid {
    font-family: 'JetBrains Mono', 'SF Mono', monospace;
    font-size: 12px; word-break: break-all;
    max-width: 200px; color: var(--os-muted);
    background: rgba(255,255,255,0.04);
    padding: 4px 8px; border-radius: 6px;
    border: 1px solid var(--os-border);
}

/* ─── Payment Badge ─── */
.os-payment-badge {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 4px 12px; border-radius: 20px;
    font-size: 13px; font-weight: 600;
    background: var(--os-primary-dim);
    color: var(--os-primary);
    border: 1px solid rgba(96,165,250,0.15);
}
.os-payment-badge i { font-size: 14px; }

/* ─── Small Badge ─── */
.os-badge-sm {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 3px 12px; border-radius: 999px;
    font-size: 12px; font-weight: 600;
}
.os-badge-sm .os-badge-dot {
    width: 5px; height: 5px; animation: none;
}

/* ─── Empty State ─── */
.os-empty-state {
    text-align: center; padding: 18px 0;
}
.os-empty-icon { font-size: 28px; color: var(--os-sub); display: block; margin-bottom: 8px; }
.os-empty-text { font-size: 13px; color: var(--os-sub); }

/* ─── Order Summary ─── */
.os-summary { display: flex; flex-direction: column; gap: 2px; }
.os-summary-row {
    display: flex; justify-content: space-between; align-items: center;
    padding: 6px 0;
}
.os-summary-label { font-size: 13px; color: var(--os-muted); }
.os-summary-value { font-size: 14px; font-weight: 600; color: var(--os-text); }
.os-summary-divider { height: 1px; background: var(--os-border); margin: 10px 0 6px; }
.os-summary-total { padding: 8px 0 4px; }
.os-summary-total-label { font-size: 15px; font-weight: 700; color: var(--os-text); }
.os-summary-total-value {
    font-size: 22px; font-weight: 800;
    color: var(--os-primary);
    font-family: 'JetBrains Mono', 'SF Mono', monospace;
}

/* ─── Media Card (Screenshot) ─── */
.os-card-media .os-card-body { padding: 0; }
.os-screenshot-wrap {
    padding: 16px; text-align: center;
}
.os-screenshot-link {
    display: inline-block; position: relative; border-radius: 10px;
    overflow: hidden; line-height: 0;
    border: 1px solid var(--os-border);
    transition: all var(--os-transition);
}
.os-screenshot-link:hover {
    border-color: var(--os-primary);
    box-shadow: 0 0 20px rgba(96,165,250,0.12);
}
.os-screenshot-img {
    max-width: 100%; max-height: 400px;
    transition: all var(--os-transition);
}
.os-screenshot-link:hover .os-screenshot-img {
    transform: scale(1.02);
}
.os-screenshot-overlay {
    position: absolute; inset: 0;
    display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 6px;
    background: rgba(15,23,42,0.7);
    color: #fff; font-size: 13px; font-weight: 600;
    opacity: 0; transition: opacity var(--os-transition);
    backdrop-filter: blur(4px);
}
.os-screenshot-overlay i { font-size: 28px; }
.os-screenshot-link:hover .os-screenshot-overlay { opacity: 1; }

/* ─── Order Items ─── */
.os-items-wrap { }
.os-items-header {
    display: grid;
    grid-template-columns: 1fr 60px 100px 100px;
    padding: 12px 20px;
    background: rgba(255,255,255,0.03);
    border-bottom: 1px solid var(--os-border);
    font-size: 11px; font-weight: 700; color: var(--os-muted);
    text-transform: uppercase; letter-spacing: 0.5px;
}
.os-items-h-item { text-align: left; }
.os-items-h-qty, .os-items-h-price, .os-items-h-total { text-align: right; }
.os-items-body { }
.os-item-row {
    display: grid;
    grid-template-columns: 1fr 60px 100px 100px;
    padding: 14px 20px;
    align-items: center;
    border-bottom: 1px solid var(--os-border);
    transition: background var(--os-transition);
}
.os-item-row:last-child { border-bottom: none; }
.os-item-row:hover { background: rgba(255,255,255,0.02); }
.os-item-info { text-align: left; }
.os-item-name { font-size: 14px; font-weight: 600; color: var(--os-text); }
.os-item-desc { font-size: 12px; color: var(--os-sub); margin-top: 2px; }
.os-item-qty {
    text-align: right; font-size: 14px; font-weight: 600;
    color: var(--os-muted);
}
.os-item-price {
    text-align: right; font-size: 13px; font-weight: 600;
    color: var(--os-primary);
    font-family: 'JetBrains Mono', 'SF Mono', monospace;
}
.os-item-total {
    text-align: right; font-size: 14px; font-weight: 700;
    color: var(--os-text);
    font-family: 'JetBrains Mono', 'SF Mono', monospace;
}
.os-items-footer {
    display: flex; justify-content: space-between; align-items: center;
    padding: 14px 20px;
    border-top: 1px solid var(--os-border);
    background: linear-gradient(135deg, rgba(96,165,250,0.06), rgba(96,165,250,0.01));
}
.os-items-footer-label { font-size: 15px; font-weight: 700; color: var(--os-text); }
.os-items-footer-value {
    font-size: 22px; font-weight: 800;
    color: var(--os-primary);
    font-family: 'JetBrains Mono', 'SF Mono', monospace;
}

/* ─── Print Styles ─── */
@media print {
    .order-show { padding: 0; }
    .os-back, .os-status-form, .os-btn-icon,
    .sidebar, .top-navbar, nav, aside { display: none !important; }
    .os-header { border: 1px solid #ddd; page-break-inside: avoid; }
    .os-card { border: 1px solid #ddd; break-inside: avoid; }
    .os-progress { border: 1px solid #ddd; }
    body { background: #fff !important; color: #000 !important; }
}

/* ─── Responsive ─── */
@media (max-width: 1200px) {
    .os-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 992px) {
    .order-show { padding: 22px 24px; }
    .os-header-content { padding: 16px 20px; }
    .os-grid { grid-template-columns: 1fr 1fr; gap: 16px; }
    .os-progress { padding: 14px 18px; }
    .os-items-header, .os-item-row { grid-template-columns: 1fr 50px 80px 80px; }
}
@media (max-width: 768px) {
    .order-show { padding: 16px; }
    .os-header-content { flex-direction: column; align-items: flex-start; }
    .os-header-right { width: 100%; }
    .os-header-right .os-badge { margin-left: auto; }
    .os-grid { grid-template-columns: 1fr; gap: 14px; }
    .os-progress { flex-wrap: wrap; gap: 8px; padding: 14px; }
    .os-progress-step { flex: none; }
    .os-progress-line { display: none; }
    .os-items-header, .os-item-row { grid-template-columns: 1fr 45px 70px 70px; }
    .os-items-header { font-size: 10px; padding: 10px 14px; }
    .os-item-row { padding: 12px 14px; }
    .os-item-name { font-size: 13px; }
    .os-items-footer { padding: 12px 14px; }
    .os-items-footer-value { font-size: 18px; }
    .os-summary-total-value { font-size: 18px; }
    .os-header-title { font-size: 17px; }
}
@media (max-width: 500px) {
    .order-show { padding: 10px; }
    .os-header { border-radius: 12px; }
    .os-header-content { padding: 12px 14px; }
    .os-header-left { gap: 10px; flex-wrap: wrap; }
    .os-header-icon { width: 36px; height: 36px; font-size: 16px; border-radius: 12px; }
    .os-header-title { font-size: 14px; }
    .os-header-meta { font-size: 11px; flex-wrap: wrap; }
    .os-header-right { gap: 8px; }
    .os-card-head { padding: 10px 14px; font-size: 11px; }
    .os-card-body { padding: 10px 14px; }
    .os-status-select { min-width: 90px; font-size: 11px; padding: 5px 24px 5px 28px; }
    .os-badge { padding: 5px 12px; font-size: 11px; gap: 5px; }
    .os-badge-dot { width: 5px; height: 5px; }
    .os-btn-icon { width: 32px; height: 32px; font-size: 14px; }
    .os-back { font-size: 11px; padding: 6px 12px; margin-bottom: 14px; }
    .os-progress { padding: 12px 14px; gap: 4px; flex-wrap: wrap; }
    .os-progress-step { gap: 6px; }
    .os-progress-icon { width: 28px; height: 28px; font-size: 12px; }
    .os-progress-text { font-size: 11px; margin-right: 10px; }
    .os-items-header { display: none; }
    .os-item-row {
        grid-template-columns: 1fr 1fr;
        gap: 4px;
        padding: 10px 14px;
    }
    .os-item-info { grid-column: 1 / -1; }
    .os-item-name { font-size: 13px; }
    .os-item-desc { font-size: 11px; }
    .os-item-qty, .os-item-price, .os-item-total {
        font-size: 11px;
    }
    .os-item-price { text-align: left; }
    .os-item-total { text-align: right; }
    .os-summary-total-value { font-size: 16px; }
    .os-items-footer { padding: 10px 14px; }
    .os-items-footer-value { font-size: 16px; }
    .os-field { padding: 5px 0; gap: 8px; }
    .os-field-label { font-size: 12px; }
    .os-field-value { max-width: 55%; font-size: 12px; }
    .os-txid { font-size: 11px; max-width: 120px; }
    .os-screenshot-wrap { padding: 12px; }
    .os-screenshot-img { max-height: 250px; }
}
@media (max-width: 380px) {
    .order-show { padding: 6px; }
    .os-header-content { padding: 10px 12px; }
    .os-header-right { flex-direction: column; align-items: flex-start; width: 100%; }
    .os-header-right .os-badge { margin-left: 0; }
    .os-grid { gap: 10px; }
    .os-field { flex-direction: column; align-items: flex-start; gap: 2px; }
    .os-field-value { max-width: 100%; text-align: left; }
    .os-item-row { padding: 8px 12px; }
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Show success toast
    var sessionSuccess = document.getElementById('sessionSuccess');
    if (sessionSuccess) {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: sessionSuccess.value,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            background: '#1e293b',
            color: '#f1f5f9',
            iconColor: '#60A5FA',
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
    }

    // Confirm status change with SweetAlert
    var statusSelect = document.getElementById('orderStatusSelect');
    var statusForm = document.getElementById('orderStatusForm');
    if (statusSelect && statusForm) {
        statusSelect.addEventListener('change', function() {
            var newStatus = this.options[this.selectedIndex].text;

            Swal.fire({
                title: 'Change status?',
                html: `Update order to <strong>${newStatus}</strong>?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, update',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                focusCancel: true,
                background: '#1e293b',
                color: '#f1f5f9',
                iconColor: '#60A5FA',
                confirmButtonColor: '#2563EB',
                cancelButtonColor: '#64748b',
            }).then((result) => {
                if (result.isConfirmed) {
                    statusForm.submit();
                } else {
                    // Reset select to previous value
                    var prevValue = this.getAttribute('data-prev') || this.querySelector('option[selected]')?.value || '';
                    this.value = prevValue;
                }
            });

            // Store current value before change for rollback
            this.setAttribute('data-prev', this.getAttribute('data-current-val') || this.value);
        });

        // Store initial value
        statusSelect.setAttribute('data-current-val', statusSelect.value);
    }
});
</script>

@endsection
