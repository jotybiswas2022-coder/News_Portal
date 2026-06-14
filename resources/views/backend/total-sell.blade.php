@extends('backend.app')

@section('title', 'Total Sell — Admin')

@section('content')

<div class="ts-page">

    {{-- Header --}}
    <div class="ts-header">
        <div class="ts-header-inner">
            <div>
                <h4 class="ts-header-title">Total Sell</h4>
                <p class="ts-header-sub">{{ $totalItems }} item(s) sold in selected period</p>
            </div>
        </div>
    </div>

    {{-- Date Filter --}}
    <div class="ts-filter">
        <form method="GET" action="{{ route('admin.total-sell') }}" class="ts-filter-form">
            <div class="ts-filter-group">
                <label class="ts-filter-label">From</label>
                <input type="date" name="from" class="ts-filter-input" value="{{ $from }}">
            </div>
            <div class="ts-filter-group">
                <label class="ts-filter-label">To</label>
                <input type="date" name="to" class="ts-filter-input" value="{{ $to }}">
            </div>
            <button type="submit" class="ts-filter-btn">
                <i class="bi bi-funnel"></i> Filter
            </button>
        </form>
    </div>

    {{-- Summary Cards --}}
    <div class="ts-summary">
        <div class="ts-summary-card ts-summary-items">
            <div class="ts-summary-icon">
                <i class="bi bi-box-seam"></i>
            </div>
            <div>
                <span class="ts-summary-label">Total Items Sold</span>
                <span class="ts-summary-value">{{ $totalItems }}</span>
            </div>
        </div>
        <div class="ts-summary-card ts-summary-selling">
            <div class="ts-summary-icon">
                <i class="bi bi-currency-dollar"></i>
            </div>
            <div>
                <span class="ts-summary-label">Total Selling Price</span>
                <span class="ts-summary-value">${{ number_format($totalSelling, 2) }}</span>
            </div>
        </div>
        <div class="ts-summary-card ts-summary-avg">
            <div class="ts-summary-icon">
                <i class="bi bi-graph-up"></i>
            </div>
            <div>
                <span class="ts-summary-label">Avg Price / Item</span>
                <span class="ts-summary-value">${{ number_format($avgPrice, 2) }}</span>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="ts-card">
        @if(count($rows) > 0)
        <div class="table-scroll-wrap">
            <table class="ts-table">
                <thead>
                    <tr>
                        <th><i class="bi bi-calendar-event me-1"></i> Date</th>
                        <th><i class="bi bi-hash me-1"></i> Order #</th>
                        <th class="text-start"><i class="bi bi-box me-1"></i> Item</th>
                        <th><i class="bi bi-tag me-1"></i> Type</th>
                        <th><i class="bi bi-currency-dollar me-1"></i> Selling Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $row)
                        <tr>
                            <td><span class="ts-date">{{ $row['date'] }}</span></td>
                            <td><span class="ts-order-num">#{{ $row['order_number'] }}</span></td>
                            <td class="text-start">{{ $row['item_name'] }}</td>
                            <td>
                                @if($row['type'] === 'Product')
                                    <span class="ts-badge ts-badge-product">Product</span>
                                @elseif($row['type'] === 'Source Code')
                                    <span class="ts-badge ts-badge-source">Source Code</span>
                                @else
                                    <span class="ts-badge ts-badge-na">N/A</span>
                                @endif
                            </td>
                            <td class="ts-price">${{ number_format($row['selling_price'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <div class="ts-empty">
                <i class="bi bi-inbox"></i>
                <p>No completed orders found in this date range.</p>
            </div>
        @endif
    </div>
</div>

<style>
/* ─── Page ─── */
.ts-page {
    padding: 24px 28px; height: 100%;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    color: #f1f5f9;
}

/* ─── Header ─── */
.ts-header {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 14px;
    padding: 18px 22px;
    backdrop-filter: blur(8px);
    margin-bottom: 20px;
}
.ts-header-inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
}
.ts-header-title {
    font-size: 18px; font-weight: 700; margin: 0 0 2px 0;
}
.ts-header-sub {
    font-size: 13px; color: #94a3b8; margin: 0;
}

/* ─── Filter ─── */
.ts-filter {
    margin-bottom: 20px;
}
.ts-filter-form {
    display: flex;
    align-items: flex-end;
    gap: 12px;
    flex-wrap: wrap;
}
.ts-filter-group {
    display: flex;
    flex-direction: column;
    gap: 4px;
}
.ts-filter-label {
    font-size: 11px;
    font-weight: 600;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}
.ts-filter-input {
    padding: 8px 12px;
    font-size: 13px;
    background: rgba(10,10,10,0.6);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 8px;
    color: #f1f5f9;
    outline: none;
    transition: all 0.2s;
    font-family: inherit;
}
.ts-filter-input:focus {
    border-color: #60A5FA;
    box-shadow: 0 0 0 3px rgba(96,165,250,0.12);
}
.ts-filter-input::-webkit-calendar-picker-indicator {
    filter: invert(0.7);
    cursor: pointer;
}
.ts-filter-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 20px;
    font-size: 13px;
    font-weight: 600;
    background: linear-gradient(135deg, #2563EB, #1E40AF);
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s;
    font-family: inherit;
    height: 37px;
}
.ts-filter-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(37,99,235,0.3);
}

/* ─── Summary Cards ─── */
.ts-summary {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 20px;
}
.ts-summary-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 12px;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    gap: 14px;
}
.ts-summary-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}
.ts-summary-items .ts-summary-icon {
    background: rgba(251,191,36,0.12);
    color: #F59E0B;
    border: 1px solid rgba(251,191,36,0.15);
}
.ts-summary-selling .ts-summary-icon {
    background: rgba(96,165,250,0.12);
    color: #60A5FA;
    border: 1px solid rgba(96,165,250,0.15);
}
.ts-summary-avg .ts-summary-icon {
    background: rgba(16,185,129,0.12);
    color: #10B981;
    border: 1px solid rgba(16,185,129,0.15);
}
.ts-summary-label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    margin-bottom: 2px;
}
.ts-summary-value {
    display: block;
    font-size: 20px;
    font-weight: 700;
}
.ts-summary-items .ts-summary-value { color: #F59E0B; }
.ts-summary-selling .ts-summary-value { color: #60A5FA; }
.ts-summary-avg .ts-summary-value { color: #10B981; }

/* ─── Table Card ─── */
.ts-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 14px;
    overflow: hidden;
    backdrop-filter: blur(8px);
}
.ts-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}
.ts-table thead th {
    padding: 12px 16px;
    text-align: center;
    font-size: 11px;
    font-weight: 600;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    background: rgba(10,10,10,0.3);
    border-bottom: 1px solid rgba(255,255,255,0.06);
}
.ts-table thead th.text-start { text-align: left; }
.ts-table tbody td {
    padding: 12px 16px;
    text-align: center;
    border-bottom: 1px solid rgba(255,255,255,0.04);
    vertical-align: middle;
}
.ts-table tbody td.text-start { text-align: left; }
.ts-table tbody tr:hover {
    background: rgba(255,255,255,0.02);
}
.ts-table tbody tr:last-child td {
    border-bottom: none;
}
.ts-date {
    color: #94a3b8;
    font-size: 12px;
    white-space: nowrap;
}
.ts-order-num {
    color: #60A5FA;
    font-weight: 600;
    font-size: 12px;
    white-space: nowrap;
}
.ts-price {
    font-weight: 600;
    color: #f1f5f9;
}

/* ─── Badges ─── */
.ts-badge {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
}
.ts-badge-product {
    background: rgba(16,185,129,0.1);
    color: #10B981;
    border: 1px solid rgba(16,185,129,0.15);
}
.ts-badge-source {
    background: rgba(96,165,250,0.1);
    color: #60A5FA;
    border: 1px solid rgba(96,165,250,0.15);
}
.ts-badge-na {
    background: rgba(148,163,184,0.08);
    color: #64748b;
    border: 1px solid rgba(148,163,184,0.12);
}

/* ─── Empty state ─── */
.ts-empty {
    text-align: center;
    padding: 48px 20px;
    color: #64748b;
}
.ts-empty i {
    font-size: 32px;
    margin-bottom: 12px;
    display: block;
    opacity: 0.4;
}
.ts-empty p {
    font-size: 14px;
    margin: 0;
}

/* ─── Responsive ─── */
@media (max-width: 768px) {
    .ts-page { padding: 20px 22px; }
    .ts-summary { grid-template-columns: 1fr; }
    .ts-filter-form { flex-direction: column; align-items: stretch; }
    .ts-filter-btn { height: auto; justify-content: center; }
}
@media (max-width: 480px) {
    .ts-page { padding: 16px; }
    .ts-header { padding: 14px 16px; }
    .ts-summary-card { padding: 14px 16px; }
    .ts-summary-value { font-size: 17px; }
}
</style>

@endsection
