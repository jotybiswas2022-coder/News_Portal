@extends('backend.app')

@section('content')

@php
    use App\Models\Product;
@endphp

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid" style="height: calc(100vh - 80px); overflow-y: auto; padding-bottom: 20px;">

    <div class="row m-3 align-items-center mb-3">
        <div class="col-md-6">
            <h2 class="fw-bold mb-1">
                <i class="bi bi-currency-dollar me-2 text-primary"></i> Profit & Loss
            </h2>
            <small class="text-muted">View product sales and profits over time</small>
        </div>
        <div class="col-md-6 text-end">
            <span class="badge bg-primary-subtle text-primary-emphasis px-3 py-2">
                <i class="bi bi-database me-1"></i> {{ $orders->sum(fn($o) => $o->orderdetails->count()) }} Sells
            </span>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="mx-3 mb-3">
        <form method="GET" action="{{ url()->current() }}" class="row g-2 align-items-end">
            <div class="col-md-4 col-12">
                <label for="start_date" class="form-label fw-semibold">
                    <i class="bi bi-calendar me-1 text-secondary"></i> Start Date
                </label>
                <input type="date" id="start_date" name="start_date" class="form-control form-control-sm" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4 col-12">
                <label for="end_date" class="form-label fw-semibold">
                    <i class="bi bi-calendar-check me-1 text-secondary"></i> End Date
                </label>
                <input type="date" id="end_date" name="end_date" class="form-control form-control-sm" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-4 col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm w-100 w-md-auto">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
                <a href="{{ url()->current() }}" class="btn btn-outline-secondary btn-sm w-100 w-md-auto">
                    <i class="bi bi-x-circle me-1"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Summary Cards -->
    <div class="row mx-3 mb-3 g-3">
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm h-100 text-center">
                <div class="card-body py-3">
                    <div class="text-muted small mb-1">Total Revenue</div>
                    <div class="fw-bold text-primary fs-5">
                        {{ number_format($totalRevenue, 2) }} {{ $currency }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm h-100 text-center">
                <div class="card-body py-3">
                    <div class="text-muted small mb-1">Total Cost</div>
                    <div class="fw-bold text-warning fs-5">
                        {{ number_format($totalCost, 2) }} {{ $currency }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm h-100 text-center">
                <div class="card-body py-3">
                    <div class="text-muted small mb-1">Total Profit</div>
                    <div class="fw-bold text-success fs-5">
                        {{ number_format($totalProfit, 2) }} {{ $currency }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm h-100 text-center">
                <div class="card-body py-3">
                    <div class="text-muted small mb-1">Total Orders</div>
                    <div class="fw-bold text-dark fs-5">{{ $totalOrders }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mx-3 shadow-sm border-0 rounded-4">
        <div class="card-body p-2 p-md-3">

            <div class="table-responsive rounded-3">
                <table class="table table-hover table-bordered align-middle mb-0" id="profitTable">
                    <thead class="table-light sticky-top">
                        <tr>
                            <th style="width:45px;">#</th>
                            <th class="text-start" style="min-width:200px;">Product</th>
                            <th class="text-end" style="width:120px;">Buy Price</th>
                            <th class="text-end" style="width:120px;">Sell Price</th>
                            <th class="text-end" style="width:120px;">Profit</th>
                            <th style="width:140px;">Sell Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $ser = 1;
                        @endphp
                        @forelse ($orders as $order)
                            @foreach ($order->orderdetails as $item)
                                @php
                                    $sellDate = $item->created_at->toDateString();
                                    $startDate = request('start_date');
                                    $endDate = request('end_date');

                                    if (($startDate && $sellDate < $startDate) || ($endDate && $sellDate > $endDate)) continue;

                                    $product = Product::find($item->product_id);
                                    $discount = $product->discount ?? 0;
                                    $buyPrice = buyprice($item->product_id);
                                    $sellprice = $item->product_price * (100 - $discount) / 100;
                                    $profit = $sellprice - $buyPrice;
                                @endphp

                                <tr>
                                    <td class="fw-medium">{{ $ser++ }}</td>
                                    <td class="text-start fw-semibold">{{ $item->product_name }}</td>
                                    <td class="text-end">{{ number_format($buyPrice, 2) }} {{ $currency }}</td>
                                    <td class="text-end">{{ number_format($sellprice, 2) }} {{ $currency }}</td>
                                    <td class="text-end fw-bold {{ $profit >= 0 ? 'text-success' : 'text-danger' }}">
                                        {{ number_format($profit, 2) }} {{ $currency }}
                                    </td>
                                    <td class="text-muted small">
                                        {{ \Carbon\Carbon::parse($item->created_at)->timezone('Asia/Dhaka')->format('d M, Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    No Data Found
                                    <br><small>Sales and profit data will appear here once available.</small>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                    <tfoot class="table-light text-center">
                        <tr class="fw-bold">
                            <td colspan="2"></td>
                            <td class="text-end">{{ number_format($totalCost, 2) }} {{ $currency }}</td>
                            <td class="text-end">{{ number_format($totalRevenue, 2) }} {{ $currency }}</td>
                            <td class="text-end text-success">{{ number_format($totalProfit, 2) }} {{ $currency }}</td>
                            <td class="text-muted small">Total</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>

</div>

<style>
.table-hover tbody tr:hover {
    background-color: rgba(13, 110, 253, 0.03);
    transition: background 0.15s;
}

.card-body {
    border-radius: 14px;
}

.badge {
    font-size: 0.78rem;
    font-weight: 500;
}

.form-control:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 0.15rem rgba(79,70,229,0.15);
}

.table th {
    font-weight: 600;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    color: #6c757d;
    border-bottom: 2px solid #e9ecef;
}

.table td {
    font-size: 0.88rem;
    vertical-align: middle;
}

/* Summary Cards */
.card.shadow-sm {
    border-radius: 12px;
    border: 1px solid #e9ecef;
}
.card.shadow-sm:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
    transition: box-shadow 0.2s;
}

/* Responsive */
@media (max-width: 1199px) {
    .table td, .table th { padding: 0.5rem 0.4rem; }
    .badge { padding: 0.35em 0.6em; }
}

@media (max-width: 991px) {
    .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    #profitTable { min-width: 700px; }
    .row.m-3 { margin: 1rem !important; }
    .col-md-4.col-12 { width: 100%; }
}

@media (max-width: 767px) {
    .card-body { padding: 1rem; }
    h2 { font-size: 1.4rem; }
    .table th, .table td { font-size: 0.8rem; padding: 0.4rem 0.3rem; }
    .badge { font-size: 0.7rem; padding: 0.3em 0.5em; }
    .card-body.py-3 { padding: 0.75rem !important; }
}

@media (max-width: 575px) {
    .container-fluid { padding-left: 0.75rem; padding-right: 0.75rem; }
    .card.mx-3 { margin: 0.5rem !important; }
    .table th, .table td { font-size: 0.75rem; padding: 0.3rem 0.25rem; }
    .form-control-sm { font-size: 0.82rem; }
    .col-md-3.col-6 { width: 50%; }
}
</style>

@endsection