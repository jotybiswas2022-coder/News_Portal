@extends('backend.app')

@section('content')

@php
    use App\Models\Setting;
    $settings = Setting::first();
    $currency = $settings?->currency ?? '৳';
@endphp

<div class="container-fluid" style="height: calc(100vh - 80px); overflow-y: auto; padding-bottom: 20px;">

    <div class="row m-3 align-items-center mb-3">
        <div class="col-md-6">
            <h2 class="fw-bold mb-1">
                <i class="bi bi-cart-check me-2 text-primary"></i> Order List
            </h2>
            <small class="text-muted">Manage all orders efficiently</small>
        </div>
        <div class="col-md-6 text-end">
            <div class="input-group input-group-sm" style="max-width: 300px;">
                <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                <input type="text" id="orderSearch" class="form-control" placeholder="Search orders...">
            </div>
        </div>
    </div>

    <div class="card mx-3 shadow-sm border-0 rounded-4">
        <div class="card-body p-2 p-md-3">

            <div class="table-responsive rounded-3">
                <table class="table table-hover table-bordered align-middle text-center mb-0" id="orderTable">
                    <thead class="table-light sticky-top">
                        <tr>
                            <th style="width:50px;">#</th>
                            <th class="text-start" style="min-width:180px;">Customer</th>
                            <th style="min-width:130px;">Phone</th>
                            <th style="min-width:250px;">Products</th>
                            <th style="min-width:120px;">Total</th>
                            <th style="min-width:150px;">Payment</th>
                            <th style="min-width:120px;">Status</th>
                            <th style="min-width:150px;">Record Time</th>
                            <th style="width:180px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)

                            @php
                                $status = strtolower(trim($order->status));
                                $badgeClass = match($status) {
                                    'approved' => 'bg-success',
                                    'pending' => 'bg-warning text-dark',
                                    'canceled','cancelled' => 'bg-danger',
                                    'delivered' => 'bg-primary',
                                    default => 'bg-secondary',
                                };

                                $method = strtolower(trim($order->payment_method ?? ''));
                                $methodClass = match($method) {
                                    'cod' => 'bg-primary',
                                    'bkash' => 'bg-success',
                                    'nagad' => 'bg-warning text-dark',
                                    default => 'bg-secondary',
                                };
                                $methodText = match($method) {
                                    'cod' => 'Cash on Delivery',
                                    'bkash' => 'Bkash',
                                    'nagad' => 'Nagad',
                                    default => 'Unknown',
                                };

                                $payStatus = strtolower(trim($order->payment_status ?? 'unpaid'));
                                $payStatusClass = match($payStatus) {
                                    'paid' => 'bg-success',
                                    'submitted' => 'bg-info text-dark',
                                    default => 'bg-secondary',
                                };
                                $payStatusText = match($payStatus) {
                                    'paid' => 'Paid',
                                    'submitted' => 'Submitted',
                                    default => 'Unpaid',
                                };
                            @endphp

                            <tr id="order-{{ $order->id }}">
                                <td class="fw-medium">{{ $loop->iteration }}</td>

                                <td class="text-start">
                                    <div class="fw-semibold">{{ $order->firstname }} {{ $order->lastname }}</div>
                                    <small class="text-muted d-none d-md-block">{{ $order->address ?? '-' }}</small>
                                </td>

                                <td>
                                    <a href="tel:{{ $order->phone }}" class="text-decoration-none fw-medium">
                                        {{ $order->phone }}
                                    </a>
                                </td>

                                <td class="text-start">
                                    <ul class="product-list mb-0 ps-0 small">
                                        @foreach ($order->orderdetails as $item)
                                            <li class="d-flex justify-content-between border-bottom py-1">
                                                <span class="product-name text-truncate me-2" style="max-width: 70%;">{{ $item->product_name }}</span>
                                                <span class="product-qty text-muted fw-medium">× {{ $item->product_quantity }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>

                                <td class="fw-bold text-success">{{ number_format($order->total_price,2) }} {{ $currency }}</td>

                                <td class="text-start">
                                    <div class="d-flex flex-wrap gap-1 mb-1">
                                        <span class="badge {{ $methodClass }} px-2 py-1">{{ $methodText }}</span>
                                    </div>
                                    <span class="badge {{ $payStatusClass }} payment-status-badge px-2 py-1">
                                        {{ $payStatusText }}
                                    </span>

                                    @if($order->sender_number || $order->transaction_id || $order->payment_screenshot)
                                        <div class="payment-proof mt-2 small text-start" style="max-height: 120px; overflow-y: auto;">
                                            @if($order->advance_method)
                                                <div class="d-flex justify-content-between py-1 border-bottom">
                                                    <span class="text-muted">Advance:</span>
                                                    <span>{{ ucfirst($order->advance_method) }} ({{ number_format($order->delivery_charge,2) }} {{ $currency }})</span>
                                                </div>
                                            @endif
                                            @if($order->sender_number)
                                                <div class="d-flex justify-content-between py-1 border-bottom">
                                                    <span class="text-muted">Sender:</span>
                                                    <span>{{ $order->sender_number }}</span>
                                                </div>
                                            @endif
                                            @if($order->transaction_id)
                                                <div class="d-flex justify-content-between py-1 border-bottom">
                                                    <span class="text-muted">Txn:</span>
                                                    <span class="text-truncate" style="max-width: 150px;">{{ $order->transaction_id }}</span>
                                                </div>
                                            @endif
                                            @if($order->payment_screenshot)
                                                <div class="py-1">
                                                    <a href="{{ config('app.storage_url') . $order->payment_screenshot }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary px-2 py-1">
                                                        <i class="bi bi-image me-1"></i> View Proof
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <span class="badge {{ $badgeClass }} px-3 py-2">{{ ucfirst($status) }}</span>
                                </td>

                                <td class="text-muted small">{{ $order->created_at->format('d M, Y H:i') }}</td>

                                <td>
                                    <div class="d-flex flex-wrap justify-content-center gap-2">
                                        @if($order->payment_status !== 'paid')
                                            <button class="btn btn-sm btn-warning text-dark rounded-pill px-3 btn-mark-paid"
                                                    data-id="{{ $order->id }}"
                                                    title="Mark as Paid">
                                                <i class="bi bi-cash-coin me-1"></i> Paid
                                            </button>
                                        @endif

                                        @if($status === 'pending')
                                            <button class="btn btn-sm btn-primary rounded-pill px-3 btn-approve"
                                                    data-id="{{ $order->id }}"
                                                    title="Approve">
                                                <i class="bi bi-check-circle me-1"></i> Approve
                                            </button>

                                            <button class="btn btn-sm btn-danger rounded-pill px-3 btn-cancel"
                                                    data-id="{{ $order->id }}"
                                                    title="Cancel">
                                                <i class="bi bi-x-circle me-1"></i> Cancel
                                            </button>

                                        @elseif($status === 'approved')
                                            <button class="btn btn-sm btn-success rounded-pill px-3 btn-delivered"
                                                    data-id="{{ $order->id }}"
                                                    title="Mark Delivered">
                                                <i class="bi bi-truck me-1"></i> Delivered
                                            </button>
                                        @else
                                            <span class="text-muted small">No actions</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-5">
                                    <i class="bi bi-cart-x fs-1 d-block mb-2"></i>
                                    No orders found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
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

.btn-sm {
    padding: 0.35rem 0.75rem;
    font-size: 0.82rem;
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

.product-list li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.25rem 0;
}

.payment-proof {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 8px;
    font-size: 0.75rem;
}

.payment-proof .text-muted {
    font-size: 0.7rem;
}

/* Responsive */
@media (max-width: 1199px) {
    .table td, .table th { padding: 0.5rem 0.4rem; }
    .badge { padding: 0.35em 0.6em; }
}

@media (max-width: 991px) {
    .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    #orderTable { min-width: 1000px; }
    .d-flex.flex-wrap.justify-content-center { flex-direction: row; gap: 4px; }
    .row.m-3 { margin: 1rem !important; }
}

@media (max-width: 767px) {
    .card-body { padding: 1rem; }
    h2 { font-size: 1.4rem; }
    .table th, .table td { font-size: 0.8rem; padding: 0.4rem 0.3rem; }
    .btn-sm { padding: 0.25rem 0.5rem; font-size: 0.75rem; }
    .badge { font-size: 0.7rem; padding: 0.3em 0.5em; }
    .product-name { max-width: 60% !important; }
    .payment-proof { padding: 6px; font-size: 0.7rem; }
}

@media (max-width: 575px) {
    .container-fluid { padding-left: 0.75rem; padding-right: 0.75rem; }
    .card.mx-3 { margin: 0.5rem !important; }
    .table th, .table td { font-size: 0.75rem; padding: 0.3rem 0.25rem; }
    .input-group-sm .form-control { font-size: 0.82rem; }
}
</style>

<script>
function updateStatus(row, text, colorClass) {
    let badge = row.find('.status .badge');
    badge.attr('class', 'badge ' + colorClass);
    badge.text(text);
}

function removeActions(row) {
    row.find('.action-cell').html('<span class="text-muted">No actions</span>');
}

$(function(){
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    });

    // SEARCH
    $('#orderSearch').on('input', function() {
        const filter = $(this).val().toLowerCase();
        $('#orderTable tbody tr').each(function() {
            if ($(this).find('td').length < 2) return;
            const text = $(this).text().toLowerCase();
            $(this).toggle(text.includes(filter));
        });
    });

    // APPROVE
    $(document).on('click', '.btn-approve', function() {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Approve this order?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            confirmButtonText: 'Yes, approve',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-success rounded-pill px-4',
                cancelButton: 'btn btn-secondary rounded-pill px-4'
            }
        }).then((result) => {
            if (!result.isConfirmed) return;
            $.post('/admin/orders/approve/' + id)
                .done(function() {
                    const row = $('#order-' + id);
                    updateStatus(row, 'Approved', 'bg-success');
                    row.find('.action-cell').html(
                        `<button class="btn btn-sm btn-success rounded-pill px-3 btn-delivered" data-id="${id}" title="Mark Delivered">
                            <i class="bi bi-truck me-1"></i> Delivered
                        </button>`
                    );
                    Swal.fire('Approved!', '', 'success');
                })
                .fail(function(xhr) {
                    Swal.fire('Error!', xhr.responseJSON?.error || 'Something went wrong', 'error');
                });
        });
    });

    // CANCEL
    $(document).on('click', '.btn-cancel', function() {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Cancel this order?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, cancel',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-danger rounded-pill px-4',
                cancelButton: 'btn btn-secondary rounded-pill px-4'
            }
        }).then((result) => {
            if (!result.isConfirmed) return;
            $.post('/admin/orders/cancel/' + id)
                .done(function() {
                    const row = $('#order-' + id);
                    updateStatus(row, 'Canceled', 'bg-danger');
                    removeActions(row);
                    Swal.fire('Canceled!', '', 'success');
                })
                .fail(function(xhr) {
                    Swal.fire('Error!', xhr.responseJSON?.error || 'Something went wrong', 'error');
                });
        });
    });

    // DELIVERED
    $(document).on('click', '.btn-delivered', function() {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Mark as delivered?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            confirmButtonText: 'Yes, delivered',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-success rounded-pill px-4',
                cancelButton: 'btn btn-secondary rounded-pill px-4'
            }
        }).then((result) => {
            if (!result.isConfirmed) return;
            $.post('/admin/orders/delivered/' + id)
                .done(function() {
                    const row = $('#order-' + id);
                    updateStatus(row, 'Delivered', 'bg-primary');
                    removeActions(row);
                    Swal.fire('Order Delivered!', '', 'success');
                })
                .fail(function(xhr) {
                    Swal.fire('Error!', xhr.responseJSON?.error || 'Something went wrong', 'error');
                });
        });
    });

    // MARK PAID
    $(document).on('click', '.btn-mark-paid', function() {
        const id = $(this).data('id');
        const btn = $(this);
        Swal.fire({
            title: 'Mark payment as paid?',
            text: 'This confirms the customer has paid.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            confirmButtonText: 'Yes, mark paid',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-success rounded-pill px-4',
                cancelButton: 'btn btn-secondary rounded-pill px-4'
            }
        }).then((result) => {
            if (!result.isConfirmed) return;
            $.post('/admin/orders/mark-paid/' + id)
                .done(function() {
                    const row = $('#order-' + id);
                    row.find('.payment-status-badge').attr('class', 'badge bg-success payment-status-badge px-2 py-1').text('Paid');
                    btn.remove();
                    Swal.fire('Payment Paid!', '', 'success');
                })
                .fail(function(xhr) {
                    Swal.fire('Error!', xhr.responseJSON?.error || 'Something went wrong', 'error');
                });
        });
    });
});
</script>

@endsection