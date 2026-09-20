@extends('backend.app')

@section('content')

@php
    use App\Models\Setting;

    $settings = Setting::first();

    $delivery = $settings?->delivery_charge ?? 0;
    $taxPercent = $settings?->tax_percentage ?? 0;
    $currency = $settings?->currency ?? '৳';
@endphp

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid" style="height: calc(100vh - 80px); overflow-y: auto; padding-bottom: 20px;">

    <div class="row m-3 align-items-center mb-3">
        <div class="col-md-6">
            <h2 class="fw-bold mb-1">Product List</h2>
            <small class="text-muted">Manage all your products efficiently</small>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ url('admin/product/create') }}" class="btn btn-primary rounded-pill px-4">
                <i class="bi bi-plus-circle me-1"></i> Add New Product
            </a>
        </div>
    </div>

    <div class="card mx-3 shadow-sm border-0 rounded-4">
        <div class="card-body p-2 p-md-3">

            <div class="row g-3 mb-3">
                <div class="col-md-6 col-lg-4">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                        <input type="text" id="productSearch" class="form-control" placeholder="Search products...">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <select id="categoryFilter" class="form-select form-select-sm">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 col-lg-4 d-flex gap-2 justify-content-md-end">
                    <select id="stockFilter" class="form-select form-select-sm w-auto">
                        <option value="">Stock Status</option>
                        <option value="in_stock">In Stock</option>
                        <option value="low_stock">Low Stock</option>
                        <option value="out_of_stock">Out of Stock</option>
                    </select>
                    <span id="productCount" class="align-self-center text-muted small"></span>
                </div>
            </div>

            <div class="table-responsive rounded-3">
                <table class="table table-hover table-bordered align-middle text-center mb-0" id="productTable">
                    <thead class="table-light sticky-top">
                        <tr>
                            <th style="width:50px;">#</th>
                            <th class="text-start" style="min-width:200px;">Product</th>
                            <th style="min-width:150px;">Category</th>
                            <th style="min-width:120px;">Pricing</th>
                            <th style="min-width:100px;">Discount</th>
                            <th style="min-width:100px;">Stock</th>
                            <th style="width:80px;">Image</th>
                            <th style="width:180px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr data-category="{{ $product->category_id }}" data-stock="{{ $product->stock }}">
                                <td class="fw-medium">{{ $loop->iteration }}</td>
                                <td class="text-start">
                                    <div class="d-flex align-items-center gap-3">
                                        @if($product->image)
                                            <img src="{{ config('app.storage_url') }}{{ $product->image }}"
                                                 alt="{{ $product->name }}"
                                                 class="rounded shadow-sm"
                                                 style="width:45px; height:45px; object-fit:cover;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                 style="width:45px; height:45px;">
                                                <i class="bi bi-box-seam text-muted"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <h6 class="mb-0 fw-semibold">{{ $product->name }}</h6>
                                            @if($product->details)
                                                <small class="text-muted d-none d-md-block">{{ Str::limit($product->details, 40) }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary-emphasis px-3 py-2 fw-medium">
                                        {{ $product->ProductCategory->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="text-start">
                                    <div>
                                        <span class="text-decoration-line-through text-muted small">{{ number_format($product->base_price, 2) }} {{ $currency }}</span>
                                        <div class="fw-bold text-success">{{ number_format($product->price, 2) }} {{ $currency }}</div>
                                    </div>
                                </td>
                                <td>
                                    @if($product->discount > 0)
                                        <span class="badge bg-danger-subtle text-danger-emphasis px-3 py-2 fw-bold">{{ $product->discount }}%</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->stock > 10)
                                        <span class="badge bg-success-subtle text-success-emphasis px-3 py-2">{{ $product->stock }} In Stock</span>
                                    @elseif($product->stock > 0)
                                        <span class="badge bg-warning-subtle text-warning-emphasis px-3 py-2">{{ $product->stock }} Low</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger-emphasis px-3 py-2">Out of Stock</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->image)
                                        <img src="{{ config('app.storage_url') }}{{ $product->image }}"
                                             alt="{{ $product->name }}"
                                             class="img-thumbnail rounded shadow-sm"
                                             style="width:55px; height:55px; object-fit:cover;"
                                             data-bs-toggle="modal" data-bs-target="#imageModal{{ $product->id }}"
                                             style="cursor:zoom-in;">
                                    @else
                                        <span class="text-muted small">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap justify-content-center gap-2">
                                        <button class="btn btn-sm btn-primary rounded-pill px-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $product->id }}"
                                                title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <button class="btn btn-sm btn-danger rounded-pill px-3"
                                                onclick="confirmation({{ $product->id }})"
                                                title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            @include('backend.product.editmodal')

                            <!-- Image Preview Modal -->
                            <div class="modal fade" id="imageModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                    <div class="modal-content border-0">
                                        <div class="modal-header border-0">
                                            <h6 class="modal-title">{{ $product->name }}</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center p-4">
                                            <img src="{{ config('app.storage_url') }}{{ $product->image }}"
                                                 alt="{{ $product->name }}"
                                                 class="img-fluid rounded shadow">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5">
                                    <i class="bi bi-box-seam fs-1 d-block mb-2"></i>
                                    No products found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<script>
function confirmation(id) {
    Swal.fire({
        title: 'Delete Product?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it',
        cancelButtonText: 'Cancel',
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-danger rounded-pill px-4',
            cancelButton: 'btn btn-secondary rounded-pill px-4'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/admin/product/delete/' + id;
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('productSearch');
    const categoryFilter = document.getElementById('categoryFilter');
    const stockFilter = document.getElementById('stockFilter');
    const rows = document.querySelectorAll('#productTable tbody tr');
    const countEl = document.getElementById('productCount');

    function filterRows() {
        const search = searchInput.value.toLowerCase();
        const category = categoryFilter.value;
        const stock = stockFilter.value;
        let visible = 0;

        rows.forEach(row => {
            if (row.cells.length < 2) return;

            const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const rowCategory = row.dataset.category;
            const rowStock = parseInt(row.dataset.stock) || 0;

            const matchSearch = name.includes(search);
            const matchCategory = !category || rowCategory == category;
            let matchStock = true;
            if (stock === 'in_stock') matchStock = rowStock > 10;
            else if (stock === 'low_stock') matchStock = rowStock > 0 && rowStock <= 10;
            else if (stock === 'out_of_stock') matchStock = rowStock === 0;

            const show = matchSearch && matchCategory && matchStock;
            row.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        countEl.textContent = `${visible} product${visible !== 1 ? 's' : ''} found`;
    }

    searchInput.addEventListener('input', filterRows);
    categoryFilter.addEventListener('change', filterRows);
    stockFilter.addEventListener('change', filterRows);
    filterRows();
});
</script>

<style>
.table-hover tbody tr:hover {
    background-color: rgba(13, 110, 253, 0.03);
    transition: background 0.15s;
}

.card-body {
    border-radius: 14px;
}

.btn-sm {
    padding: 0.35rem 0.75rem;
    font-size: 0.82rem;
}

.badge {
    font-size: 0.78rem;
    font-weight: 500;
}

.input-group-text {
    border-color: #dee2e6;
}

.form-control:focus,
.form-select:focus {
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

/* Responsive */
@media (max-width: 1199px) {
    .table td, .table th { padding: 0.5rem 0.4rem; }
    .badge { padding: 0.35em 0.6em; }
}

@media (max-width: 991px) {
    .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    #productTable { min-width: 800px; }
    .d-flex.flex-wrap.justify-content-center { flex-direction: row; gap: 4px; }
    .row.g-3 > [class*='col-'] { width: 100%; }
    .d-flex.gap-2.justify-content-md-end { justify-content: flex-start !important; flex-wrap: wrap; }
}

@media (max-width: 767px) {
    .card-body { padding: 1rem; }
    .row.m-3 { margin: 1rem !important; }
    h2 { font-size: 1.4rem; }
    .btn-primary { width: 100%; margin-top: 0.5rem; }
    .table th, .table td { font-size: 0.8rem; padding: 0.4rem 0.3rem; }
    .btn-sm { padding: 0.25rem 0.5rem; font-size: 0.75rem; }
    .badge { font-size: 0.7rem; padding: 0.3em 0.5em; }
}

@media (max-width: 575px) {
    .container-fluid { padding-left: 0.75rem; padding-right: 0.75rem; }
    .card.mx-3 { margin: 0.5rem !important; }
    .table th, .table td { font-size: 0.75rem; padding: 0.3rem 0.25rem; }
    .input-group-sm .form-control,
    .form-select-sm { font-size: 0.82rem; }
}
</style>

@endsection