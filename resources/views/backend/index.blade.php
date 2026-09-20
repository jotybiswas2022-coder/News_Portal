@extends('backend.app')

@section('content')

@php
    use App\Models\Setting;
    use App\Models\Order;
    use App\Models\Product;
    use App\Models\User;

    $settings = Setting::first();
    $delivery = $settings?->delivery_charge ?? 0;
    $taxPercent = $settings?->tax_percentage ?? 0;
    $currency = $settings?->currency ?? '৳';

    // Stats
    $totalUsers = User::count();
    $totalOrders = Order::count();
    $totalProducts = Product::count();
    $pendingOrders = Order::where('status', 'pending')->count();
    $deliveredOrders = Order::where('status', 'delivered')->count();

    // Revenue calculation
    $totalRevenue = 0;
    $totalProfit = 0;
    $deliveredOrdersList = Order::where('status', 'delivered')->with('orderdetails')->get();
    foreach ($deliveredOrdersList as $order) {
        foreach ($order->orderdetails as $item) {
            $product = \App\Models\Product::find($item->product_id);
            $discount = $product->discount ?? 0;
            $buyPrice = buyprice($item->product_id);
            $sellprice = $item->product_price * (100 - $discount) / 100;
            $totalRevenue += $sellprice;
            $totalProfit += ($sellprice - $buyPrice);
        }
    }

    // Recent orders
    $recentOrders = Order::latest()->take(5)->get();

    // Low stock products
    $lowStockProducts = Product::where('stock', '>', 0)->where('stock', '<=', 10)->take(5)->get();

    // Out of stock
    $outOfStockCount = Product::where('stock', 0)->count();
@endphp

<div class="container-fluid" style="height: calc(100vh - 80px); overflow-y: auto; padding-bottom: 20px;">

    {{-- Dashboard Header --}}
    <div class="row m-3 mb-4">
        <div class="col-12">
            <div class="p-4 rounded-4 shadow-lg d-flex align-items-center justify-content-between flex-wrap" style="background: linear-gradient(135deg, #4f46e5, #6366f1); color: #fff;">
                <div class="fw-bold fs-4 d-flex align-items-center mb-2 mb-md-0">
                    <i class="bi bi-speedometer2 me-2 fs-3"></i>
                    <a href="/admin" class="text-white text-decoration-none">Admin Dashboard</a>
                </div>
                <div class="fw-semibold">
                    Hello, <strong>{{ auth()->user()->name }}</strong>! Here's an overview of your Shop.
                </div>
            </div>
        </div>
    </div>

    {{-- Main Stats Cards --}}
    <div class="row mx-3 mb-4 g-3">
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(135deg, #4f46e5, #6366f1);">
                <div class="card-body text-white text-center py-4">
                    <div class="small mb-1" style="color: rgba(255,255,255,0.8);">Total Users</div>
                    <h3 class="fw-bold mb-2">{{ number_format($totalUsers) }}</h3>
                    <i class="bi bi-people fs-1 opacity-75"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(135deg, #059669, #10b981);">
                <div class="card-body text-white text-center py-4">
                    <div class="small mb-1" style="color: rgba(255,255,255,0.8);">Total Orders</div>
                    <h3 class="fw-bold mb-2">{{ number_format($totalOrders) }}</h3>
                    <i class="bi bi-cart-check fs-1 opacity-75"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(135deg, #f59e0b, #fbbf24);">
                <div class="card-body text-white text-center py-4">
                    <div class="small mb-1" style="color: rgba(255,255,255,0.8);">Products</div>
                    <h3 class="fw-bold mb-2">{{ number_format($totalProducts) }}</h3>
                    <i class="bi bi-box-seam fs-1 opacity-75"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(135deg, #dc2626, #ef4444);">
                <div class="card-body text-white text-center py-4">
                    <div class="small mb-1" style="color: rgba(255,255,255,0.8);">Total Revenue</div>
                    <h3 class="fw-bold mb-2">{{ number_format($totalRevenue, 2) }} {{ $currency }}</h3>
                    <i class="bi bi-currency-dollar fs-1 opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Secondary Stats Cards --}}
    <div class="row mx-3 mb-4 g-3">
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-light">
                <div class="card-body text-center py-4">
                    <div class="text-muted small mb-1">Total Profit</div>
                    <h4 class="fw-bold text-success mb-0">{{ number_format($totalProfit, 2) }} {{ $currency }}</h4>
                    <i class="bi bi-graph-up-arrow fs-2 text-success opacity-75"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-light">
                <div class="card-body text-center py-4">
                    <div class="text-muted small mb-1">Pending Orders</div>
                    <h4 class="fw-bold text-warning mb-0">{{ number_format($pendingOrders) }}</h4>
                    <i class="bi bi-clock fs-2 text-warning opacity-75"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-light">
                <div class="card-body text-center py-4">
                    <div class="text-muted small mb-1">Delivered Orders</div>
                    <h4 class="fw-bold text-primary mb-0">{{ number_format($deliveredOrders) }}</h4>
                    <i class="bi bi-truck fs-2 text-primary opacity-75"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-light">
                <div class="card-body text-center py-4">
                    <div class="text-muted small mb-1">Low Stock Items</div>
                    <h4 class="fw-bold text-danger mb-0">{{ $lowStockProducts->count() }} <small class="text-muted">({{ $outOfStockCount }} out of stock)</small></h4>
                    <i class="bi bi-exclamation-triangle fs-2 text-danger opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Orders & Low Stock --}}
    <div class="row mx-3 g-3">
        {{-- Recent Orders --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 rounded-top-4 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-semibold"><i class="bi bi-clock-history me-2 text-primary"></i> Recent Orders</h6>
                    <a href="/admin/orders" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    @if($recentOrders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width:50px;">#</th>
                                        <th>Customer</th>
                                        <th style="width:120px;">Total</th>
                                        <th style="width:100px;">Status</th>
                                        <th style="width:120px;">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                        @php
                                            $status = strtolower(trim($order->status));
                                            $badgeClass = match($status) {
                                                'approved' => 'bg-success',
                                                'pending' => 'bg-warning text-dark',
                                                'canceled','cancelled' => 'bg-danger',
                                                'delivered' => 'bg-primary',
                                                default => 'bg-secondary',
                                            };
                                        @endphp
                                        <tr>
                                            <td class="fw-medium">{{ $order->id }}</td>
                                            <td class="text-truncate" style="max-width: 150px;">{{ $order->firstname }} {{ $order->lastname }}</td>
                                            <td class="fw-bold">{{ number_format($order->total_price, 2) }} {{ $currency }}</td>
                                            <td><span class="badge {{ $badgeClass }} px-2 py-1">{{ ucfirst($status) }}</span></td>
                                            <td class="text-muted small">{{ $order->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-cart-x fs-1 d-block mb-2"></i>
                            No orders yet
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Low Stock Products --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 rounded-top-4 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-semibold"><i class="bi bi-exclamation-triangle me-2 text-warning"></i> Low Stock Alert</h6>
                    <a href="/admin/product" class="btn btn-sm btn-outline-warning">View All</a>
                </div>
                <div class="card-body p-0">
                    @if($lowStockProducts->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width:40px;">#</th>
                                        <th>Product</th>
                                        <th style="width:80px;">Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lowStockProducts as $product)
                                        <tr>
                                            <td class="fw-medium">{{ $loop->iteration }}</td>
                                            <td class="text-truncate" style="max-width: 150px;">{{ $product->name }}</td>
                                            <td>
                                                <span class="badge {{ $product->stock == 0 ? 'bg-danger' : 'bg-warning text-dark' }} px-2 py-1">
                                                    {{ $product->stock }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-check-circle fs-1 d-block mb-2 text-success"></i>
                            All products well stocked
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

<style>
.card.shadow-sm { transition: box-shadow 0.2s, transform 0.2s; }
.card.shadow-sm:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.12) !important; transform: translateY(-2px); }

.table-hover tbody tr:hover { background-color: rgba(13, 110, 253, 0.03); transition: background 0.15s; }

.badge { font-size: 0.75rem; font-weight: 500; }

/* Responsive */
@media (max-width: 1199px) {
    .table td, .table th { padding: 0.5rem 0.4rem; }
}

@media (max-width: 991px) {
    .row.mx-3 { margin: 0.5rem !important; }
    .col-lg-7, .col-lg-5 { width: 100%; }
}

@media (max-width: 767px) {
    .card-body { padding: 1rem; }
    .card-header { padding: 1rem; }
    h2, .fs-4 { font-size: 1.4rem; }
    h3 { font-size: 1.5rem; }
    h4 { font-size: 1.25rem; }
}

@media (max-width: 575px) {
    .container-fluid { padding: 0.75rem; }
    .row.mx-3 { margin: 0.25rem !important; }
    .col-md-3.col-6 { width: 50%; }
}
</style>

@endsection