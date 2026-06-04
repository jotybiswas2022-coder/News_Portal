@extends('backend.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mx-3 mt-3 shadow-sm" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid" style="padding: 20px 0;">

    <!-- Header -->
    <div class="testimonial-header mx-3 mt-3 mb-3">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1">
                    <i class="bi bi-chat-quote me-2 text-primary"></i>Testimonials
                </h4>
                <p class="text-muted small mb-0">Manage client reviews & testimonials</p>
            </div>

            <div class="mt-2 mt-md-0 d-flex gap-2">
                <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                    <i class="bi bi-database me-1"></i>
                    {{ $testimonials->count() }} Testimonials
                </span>
                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                    <i class="bi bi-plus-lg me-1"></i> Add Testimonial
                </a>
            </div>
        </div>
    </div>

    <!-- Testimonial Cards -->
    <div class="mx-3">
        @if($testimonials->isEmpty())
            <div class="text-center py-5">
                <div class="empty-state">
                    <i class="bi bi-chat-quote fs-1 text-muted mb-3 d-block"></i>
                    <div class="fw-semibold mb-2">No Testimonials Found</div>
                    <p class="text-muted small">Start by adding your first client testimonial!</p>
                    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-plus-lg me-1"></i> Add Testimonial
                    </a>
                </div>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 testimonial-table">
                    <thead>
                        <tr>
                            <th style="width:50px;">#</th>
                            <th style="width:60px;">Avatar</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Rating</th>
                            <th>Message</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th style="width:120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testimonials as $testimonial)
                            <tr>
                                <td class="fw-semibold text-muted">{{ $loop->iteration }}</td>

                                <td>
                                    @if($testimonial->avatar)
                                        <img src="{{ config('app.storage_url') }}{{ $testimonial->avatar }}"
                                             alt="{{ $testimonial->name }}"
                                             class="rounded-circle"
                                             style="width: 45px; height: 45px; object-fit: cover;">
                                    @else
                                        <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                                             style="width: 45px; height: 45px; font-size: 1.2rem;">
                                            {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>

                                <td class="fw-semibold">{{ $testimonial->name }}</td>

                                <td class="text-muted small">{{ $testimonial->designation_display ?: '—' }}</td>

                                <td>
                                    <div class="stars" style="color: #f59e0b; white-space: nowrap;">
                                        @foreach($testimonial->stars as $filled)
                                            <i class="bi {{ $filled ? 'bi-star-fill' : 'bi-star' }}" style="font-size: 0.8rem;"></i>
                                        @endforeach
                                    </div>
                                </td>

                                <td style="max-width: 250px;">
                                    <button class="btn btn-sm btn-outline-secondary py-1 px-2"
                                            data-bs-toggle="modal"
                                            data-bs-target="#messageModal{{ $testimonial->id }}">
                                        <i class="bi bi-eye"></i> View
                                    </button>

                                    <!-- Message Modal -->
                                    <div class="modal fade" id="messageModal{{ $testimonial->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow-lg rounded-4">
                                                <div class="modal-header bg-primary text-white rounded-top-4">
                                                    <h5 class="modal-title fw-semibold">
                                                        <i class="bi bi-chat-quote me-2"></i>
                                                        {{ $testimonial->name }}'s Review
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body px-4 py-3">
                                                    <p class="mb-0" style="font-style: italic; line-height: 1.7;">{{ $testimonial->message }}</p>
                                                </div>
                                                <div class="modal-footer border-0 px-4 pb-4">
                                                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark">{{ $testimonial->sort_order }}</span>
                                </td>

                                <td>
                                    <a href="{{ route('admin.testimonials.toggleStatus', $testimonial->id) }}"
                                       class="badge text-decoration-none {{ $testimonial->is_active ? 'bg-success' : 'bg-secondary' }}"
                                       onclick="return confirm('Toggle status for \'{{ $testimonial->name }}\'?')">
                                        {{ $testimonial->is_active ? 'Active' : 'Inactive' }}
                                    </a>
                                </td>

                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}"
                                           class="btn btn-sm btn-outline-primary py-1 px-2">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete testimonial from {{ $testimonial->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger py-1 px-2">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>

<style>
.testimonial-header{
    background:#fff;
    border-radius:14px;
    padding:18px 20px;
    box-shadow:0 2px 10px rgba(0,0,0,.04);
}

.testimonial-table thead{
    background:#f8fafc;
    position:sticky;
    top:0;
    z-index:5;
}

.table-hover tbody tr:hover{
    background:rgba(13,110,253,.06);
    transition:.18s ease;
}

.alert{
    border-radius:12px;
    font-size:14px;
}

@media (max-width: 768px) {
    .table-responsive {
        overflow-x: auto;
    }
}
</style>

@endsection
