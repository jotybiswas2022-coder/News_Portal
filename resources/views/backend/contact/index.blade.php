@extends('backend.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid" style="height: calc(100vh - 80px); overflow-y: auto; padding-bottom: 20px;">

    <div class="row m-3 align-items-center mb-3">
        <div class="col-md-6">
            <h2 class="fw-bold mb-1">
                <i class="bi bi-chat-dots me-2 text-primary"></i> Contact Messages
            </h2>
            <small class="text-muted">Manage customer inquiries from one place</small>
        </div>
        <div class="col-md-6 text-end">
            <span class="badge bg-primary-subtle text-primary-emphasis px-3 py-2">
                <i class="bi bi-database me-1"></i> {{ $contacts->count() }} Messages
            </span>
        </div>
    </div>

    <div class="card mx-3 shadow-sm border-0 rounded-4">
        <div class="card-body p-2 p-md-3">

            <div class="table-responsive rounded-3">
                <table class="table table-hover table-bordered align-middle mb-0" id="contactTable">
                    <thead class="table-light sticky-top">
                        <tr>
                            <th style="width:45px;">#</th>
                            <th class="text-start" style="min-width:180px;">Name</th>
                            <th style="min-width:200px;">Email</th>
                            <th style="min-width:250px;">Message</th>
                            <th style="width:140px;">Date & Time</th>
                            <th style="width:100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contacts as $contact)
                            <tr>
                                <td class="fw-medium">{{ $loop->iteration }}</td>

                                <td class="text-start fw-semibold">{{ $contact->name }}</td>

                                <td>
                                    <a href="mailto:{{ $contact->email }}" class="text-decoration-none text-muted small">
                                        {{ $contact->email }}
                                    </a>
                                </td>

                                <td class="text-start">
                                    <button class="btn btn-sm btn-outline-primary rounded-pill px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#messageModal{{ $contact->id }}"
                                            title="View Message">
                                        <i class="bi bi-eye me-1"></i> View
                                    </button>

                                    <!-- Message Modal -->
                                    <div class="modal fade" id="messageModal{{ $contact->id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $contact->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content border-0 shadow-lg rounded-4">
                                                <div class="modal-header bg-gradient-primary text-white rounded-top-4 px-4 py-3">
                                                    <h5 class="modal-title fw-semibold" id="messageModalLabel{{ $contact->id }}">
                                                        <i class="bi bi-chat-dots me-2"></i> Message from {{ $contact->name }}
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body px-4 py-4">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold text-muted small">Email</label>
                                                        <div class="text-dark">{{ $contact->email }}</div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold text-muted small">Date & Time</label>
                                                        <div class="text-dark">
                                                            {{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('d M Y, h:i A') }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <p class="mb-0" style="white-space: pre-wrap;">{{ $contact->message }}</p>
                                                </div>
                                                <div class="modal-footer border-0 px-4 pb-4 flex-wrap gap-2">
                                                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                                                        <i class="bi bi-x-circle me-1"></i> Close
                                                    </button>
                                                    <a href="mailto:{{ $contact->email }}" class="btn btn-primary rounded-pill px-4">
                                                        <i class="bi bi-reply me-1"></i> Reply
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-muted small">
                                    {{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('d M Y, h:i A') }}
                                </td>

                                <td>
                                    <div class="d-flex flex-wrap justify-content-center gap-2">
                                        <a href="mailto:{{ $contact->email }}" class="btn btn-sm btn-primary rounded-pill px-3" title="Reply">
                                            <i class="bi bi-reply"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                onclick="deleteContact({{ $contact->id }})"
                                                title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    <div class="fw-semibold">No Messages Found</div>
                                    <small class="text-muted">Customer messages will appear here once submitted.</small>
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
function deleteContact(id) {
    Swal.fire({
        title: 'Delete Message?',
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
            window.location.href = '/admin/contacts/delete/' + id;
        }
    });
}
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

.bg-gradient-primary { background: linear-gradient(45deg, #4f46e5, #6366f1); }

/* Responsive */
@media (max-width: 1199px) {
    .table td, .table th { padding: 0.5rem 0.4rem; }
    .badge { padding: 0.35em 0.6em; }
}

@media (max-width: 991px) {
    .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    #contactTable { min-width: 800px; }
    .d-flex.flex-wrap.justify-content-center { gap: 4px; }
    .row.m-3 { margin: 1rem !important; }
}

@media (max-width: 767px) {
    .card-body { padding: 1rem; }
    h2 { font-size: 1.4rem; }
    .table th, .table td { font-size: 0.8rem; padding: 0.4rem 0.3rem; }
    .btn-sm { padding: 0.25rem 0.5rem; font-size: 0.75rem; }
    .badge { font-size: 0.7rem; padding: 0.3em 0.5em; }
}

@media (max-width: 575px) {
    .container-fluid { padding-left: 0.75rem; padding-right: 0.75rem; }
    .card.mx-3 { margin: 0.5rem !important; }
    .table th, .table td { font-size: 0.75rem; padding: 0.3rem 0.25rem; }
    .input-group-sm .form-control { font-size: 0.82rem; }
}
</style>

@endsection