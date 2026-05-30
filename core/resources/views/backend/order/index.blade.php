@extends('backend.app')

@section('title', 'Orders — Admin')

@section('content')

@if (session('success'))
    <input type="hidden" id="sessionSuccess" value="{{ session('success') }}">
@endif

<div class="order-page">

    {{-- Header --}}
    <div class="order-header">
        <div class="order-header-inner">
            <div>
                <h4 class="order-header-title">Orders</h4>
                <p class="order-header-sub">{{ $orders->total() }} total orders</p>
            </div>
            <div class="order-header-badge">
                <i class="bi bi-bag-check me-1"></i>
                {{ $orders->count() }} on this page
            </div>
        </div>
    </div>

    {{-- Card --}}
    <div class="order-card-wrap">
        <div class="order-card">
            @if($orders->count() > 0)
            <div class="table-scroll-wrap">
                <table class="order-table">
                    <thead>
                        <tr>
                            <th style="width:140px;"><i class="bi bi-hash me-1"></i> Order #</th>
                            <th class="text-start"><i class="bi bi-person me-1"></i> Customer</th>
                            <th><i class="bi bi-box me-1"></i> Items</th>
                            <th><i class="bi bi-currency-dollar me-1"></i> Total</th>
                            <th><i class="bi bi-activity me-1"></i> Status</th>
                            <th><i class="bi bi-calendar-event me-1"></i> Date</th>
                            <th style="width:90px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    <span class="order-number">#{{ $order->order_number }}</span>
                                </td>
                                <td class="text-start">
                                    <div class="customer-info-cell">
                                        <div class="customer-avatar">
                                            {{ strtoupper(substr($order->customer_name ?? 'G', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="customer-name">{{ $order->customer_name ?? 'Guest' }}</div>
                                            @if($order->customer_email)
                                                <div class="customer-email">{{ $order->customer_email }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="items-count">{{ count($order->items) }} item(s)</div>
                                    <div class="items-preview">
                                        @foreach(array_slice($order->items, 0, 2) as $item)
                                            {{ $item['name'] ?? 'Item' }}@if(!$loop->last)@if(count($order->items) > 2 && $loop->iteration == 2), …@else, @endif @endif
                                        @endforeach
                                    </div>
                                </td>
                                <td class="order-amount">${{ number_format($order->total, 2) }}</td>
                                <td>
                                    <span class="status-badge status-{{ $order->status }}">
                                        <span class="status-dot"></span>
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="date-badge">{{ $order->created_at->format('d M Y') }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-view-order">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="order-pagination-wrap">
                {{ $orders->links('vendor.pagination.simple-buttons') }}
            </div>
            @else
            <div class="order-empty">
                <div class="order-empty-icon"><i class="bi bi-bag-x"></i></div>
                <div class="order-empty-title">No Orders Yet</div>
                <div class="order-empty-sub">Orders will appear here once customers start purchasing.</div>
            </div>
            @endif
        </div>
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
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
});
</script>
@endsection

<style>
:root {
    --obg: #0f172a;
    --ord: rgba(255,255,255,0.04);
    --otext: #f1f5f9;
    --omuted: #94a3b8;
    --osub: #64748b;
    --oborder: rgba(255,255,255,0.08);
    --oprimary: #60A5FA;
    --oprimary-dim: rgba(96,165,250,0.12);
    --ohover: rgba(255,255,255,0.06);
    --othead-bg: rgba(255,255,255,0.05);
    --ostatus-pending: #f59e0b;
    --ostatus-processing: #60A5FA;
    --ostatus-completed: #10b981;
    --ostatus-cancelled: #ef4444;
}
.order-page { padding: 24px 28px; height: 100%; font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; }
.order-header {
    background: var(--ord); border: 1px solid var(--oborder); border-radius: 14px;
    padding: 18px 22px; backdrop-filter: blur(8px); margin-bottom: 20px;
}
.order-header-inner {
    display: flex; flex-wrap: wrap; justify-content: space-between;
    align-items: center; gap: 10px;
}
.order-header-title { font-size: 18px; font-weight: 700; color: var(--otext); margin: 0 0 2px 0; }
.order-header-sub { font-size: 13px; color: var(--omuted); margin: 0; }
.order-header-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: var(--oprimary-dim); color: var(--oprimary);
    padding: 8px 16px; border-radius: 24px; font-size: 13px;
    font-weight: 600; border: 1px solid rgba(96,165,250,0.2);
}
.order-card-wrap {
    border-radius: 14px; border: 1px solid var(--oborder);
    background: var(--ord); overflow: hidden; backdrop-filter: blur(8px);
}
.table-scroll-wrap { overflow-x: auto; }
.order-table { width: 100%; border-collapse: collapse; font-size: 14px; }
.order-table thead {
    background: var(--othead-bg); position: sticky; top: 0; z-index: 5;
}
.order-table th {
    padding: 14px 16px; text-align: center; font-weight: 600;
    font-size: 13px; color: var(--omuted); text-transform: uppercase;
    letter-spacing: 0.4px; border-bottom: 1px solid var(--oborder);
}
.order-table th i { color: var(--oprimary); }
.order-table td {
    padding: 14px 16px; text-align: center; color: var(--otext);
    border-bottom: 1px solid var(--oborder); vertical-align: middle;
}
.order-table tbody tr { transition: background 0.18s ease; }
.order-table tbody tr:hover { background: var(--ohover); }
.order-table tbody tr:last-child td { border-bottom: none; }
.order-number {
    font-family: 'JetBrains Mono', 'SF Mono', monospace;
    color: var(--oprimary); font-weight: 600; font-size: 12px;
    background: rgba(96,165,250,0.08);
    padding: 4px 10px; border-radius: 6px; display: inline-block;
    letter-spacing: -0.2px;
}
.customer-info-cell {
    display: flex; align-items: center; gap: 10px;
}
.customer-avatar {
    width: 34px; height: 34px; border-radius: 50%;
    background: linear-gradient(135deg, #2563EB, #1E40AF);
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 700; color: #fff; flex-shrink: 0;
}
.customer-name { font-size: 14px; font-weight: 600; color: var(--otext); }
.customer-email { font-size: 12px; color: var(--omuted); margin-top: 1px; }
.items-count { font-size: 13px; font-weight: 500; color: var(--otext); }
.items-preview { font-size: 11px; color: var(--osub); margin-top: 2px; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.order-amount { font-weight: 700; color: var(--otext); font-family: 'JetBrains Mono', 'SF Mono', monospace; font-size: 14px; }
.status-badge {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 4px 14px; border-radius: 999px;
    font-size: 12px; font-weight: 600;
}
.status-dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }
.status-pending { background: rgba(245,158,11,0.1); color: var(--ostatus-pending); border: 1px solid rgba(245,158,11,0.15); }
.status-processing { background: rgba(96,165,250,0.1); color: var(--ostatus-processing); border: 1px solid rgba(96,165,250,0.15); }
.status-completed { background: rgba(16,185,129,0.1); color: var(--ostatus-completed); border: 1px solid rgba(16,185,129,0.15); }
.status-cancelled { background: rgba(239,68,68,0.1); color: var(--ostatus-cancelled); border: 1px solid rgba(239,68,68,0.15); }
.date-badge {
    display: inline-block; background: rgba(255,255,255,0.06);
    color: var(--omuted); border: 1px solid var(--oborder);
    padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500;
    white-space: nowrap;
}
.btn-view-order {
    display: inline-flex; align-items: center; justify-content: center;
    width: 34px; height: 34px;
    background: var(--oprimary-dim); color: var(--oprimary);
    border: 1px solid rgba(96,165,250,0.15);
    border-radius: 8px; font-size: 15px;
    text-decoration: none; transition: all 0.2s ease;
}
.btn-view-order:hover {
    background: rgba(96,165,250,0.2);
    border-color: rgba(96,165,250,0.3);
    color: #93c5fd;
    transform: translateY(-1px);
}
.order-pagination-wrap {
    padding: 14px 16px; border-top: 1px solid var(--oborder);
    display: flex; justify-content: flex-end;
}
.simple-pagination {
    display: flex; gap: 8px;
}
.simple-prev, .simple-next {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 18px;
    background: rgba(96,165,250,0.08);
    border: 1px solid rgba(96,165,250,0.15);
    border-radius: 8px;
    font-size: 13px; font-weight: 600; color: var(--oprimary);
    text-decoration: none;
    transition: all 0.2s ease;
    cursor: pointer;
}
.simple-prev:hover, .simple-next:hover {
    background: rgba(96,165,250,0.15);
    border-color: rgba(96,165,250,0.3);
    transform: translateY(-1px);
}
.simple-disabled {
    opacity: 0.35; cursor: not-allowed; pointer-events: none;
}
.simple-prev i, .simple-next i { font-size: 11px; }
.order-empty {
    text-align: center; padding: 60px 20px;
}
.order-empty-icon { font-size: 40px; color: var(--osub); margin-bottom: 12px; display: block; }
.order-empty-title { font-weight: 600; font-size: 16px; color: var(--omuted); margin-bottom: 6px; }
.order-empty-sub { font-size: 13px; color: var(--osub); }

@media (max-width: 992px) {
    .order-page { padding: 20px 22px; }
    .order-table td, .order-table th { padding: 12px 14px; font-size: 13px; }
}
@media (max-width: 768px) {
    .order-page { padding: 16px; }
    .order-table td, .order-table th { padding: 10px 12px; font-size: 13px; }
    .order-header { padding: 14px 16px; }
    .order-header-title { font-size: 16px; }
    .order-table th:nth-child(3), .order-table td:nth-child(3) { display: none; } /* hide items */
    .customer-email { display: none; }
}
@media (max-width: 480px) {
    .order-page { padding: 10px; }
    .order-table td, .order-table th { padding: 8px 6px; font-size: 11px; }
    .order-header-inner { flex-direction: column; align-items: flex-start; gap: 8px; }
    .order-header { padding: 12px 14px; border-radius: 12px; }
    .order-header-title { font-size: 15px; }
    .order-header-sub { font-size: 12px; }
    .order-header-badge { font-size: 11px; padding: 5px 10px; }
    .order-table th:nth-child(6), .order-table td:nth-child(6) { display: none; } /* hide date */
    .items-preview { display: none; }
    .customer-email { display: none; }
    .customer-avatar { width: 28px; height: 28px; font-size: 11px; }
    .customer-name { font-size: 12px; }
    .order-number { font-size: 10px; padding: 3px 7px; }
    .order-amount { font-size: 12px; }
    .status-badge { padding: 3px 10px; font-size: 10px; gap: 4px; }
    .status-dot { width: 4px; height: 4px; }
    .btn-view-order { width: 28px; height: 28px; font-size: 12px; }
    .order-pagination-wrap { padding: 10px 12px; flex-direction: column; align-items: center; gap: 8px; }
}
@media (max-width: 380px) {
    .order-page { padding: 8px; }
    .order-table th:nth-child(4), .order-table td:nth-child(4) { display: none; } /* hide total */
    .order-table td, .order-table th { padding: 6px 4px; }
}
</style>
@endsection
