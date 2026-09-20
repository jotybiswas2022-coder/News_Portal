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
                <i class="bi bi-people me-2 text-primary"></i> Customer List
            </h2>
            <small class="text-muted">Manage all customers efficiently</small>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ url('admin/customers/create') }}" class="btn btn-primary rounded-pill px-4">
                <i class="bi bi-plus-circle me-1"></i> Create Account
            </a>
        </div>
    </div>

    <div class="card mx-3 shadow-sm border-0 rounded-4">
        <div class="card-body p-2 p-md-3">

            <div class="mb-3">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                    <input type="text" id="userSearch" class="form-control" placeholder="Search by name, email, or record time...">
                </div>
            </div>

            <div class="table-responsive rounded-3">
                <table class="table table-hover table-bordered align-middle text-center mb-0" id="userTable">
                    <thead class="table-light sticky-top">
                        <tr>
                            <th style="width:45px;">#</th>
                            <th class="text-start" style="min-width:200px;">Customer</th>
                            <th style="min-width:180px;">Email</th>
                            <th style="min-width:150px;">Record Time</th>
                            <th style="width:120px;">Role</th>
                            <th style="width:150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="fw-medium">{{ $loop->iteration }}</td>
                                <td class="text-start fw-semibold">{{ $user->name }}</td>
                                <td class="text-truncate" style="max-width: 200px;">{{ $user->email }}</td>
                                <td class="text-muted small">{{ $user->created_at->format('d M, Y H:i') }}</td>
                                <td>
                                    @if($user->is_admin == 0)
                                        <span class="badge bg-primary-subtle text-primary-emphasis px-3 py-2">User</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning-emphasis px-3 py-2">
                                            <i class="bi bi-shield-lock me-1"></i> Admin
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap justify-content-center gap-2">
                                        <a href="{{ url('admin/customers/make-admin/'.$user->id) }}"
                                           class="btn btn-sm btn-success rounded-pill px-3"
                                           onclick="return confirmAction(this, 'Make this user an Admin?', 'This user will get admin privileges!')"
                                           title="Make Admin">
                                            <i class="bi bi-shield-lock me-1"></i> Admin
                                        </a>
                                        @if($user->is_admin == 1)
                                            <a href="{{ url('admin/customers/make-user/'.$user->id) }}"
                                               class="btn btn-sm btn-warning rounded-pill px-3"
                                               onclick="return confirmAction(this, 'Revert Admin to User?', 'This user will lose admin privileges!')"
                                               title="Make User">
                                                <i class="bi bi-person me-1"></i> User
                                            </a>
                                        @endif

                                        <button class="btn btn-sm btn-primary rounded-pill px-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $user->id }}"
                                                title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        @include('backend.customer.editmodal', ['user' => $user])

                                        <button class="btn btn-sm btn-danger rounded-pill px-3"
                                                onclick="deleteUser({{ $user->id }})"
                                                title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    <i class="bi bi-people fs-1 d-block mb-2"></i>
                                    No customers found
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

.input-group-text {
    border-color: #dee2e6;
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

/* Responsive */
@media (max-width: 1199px) {
    .table td, .table th { padding: 0.5rem 0.4rem; }
    .badge { padding: 0.35em 0.6em; }
}

@media (max-width: 991px) {
    .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    #userTable { min-width: 750px; }
    .d-flex.flex-wrap.justify-content-center { gap: 4px; }
    .row.m-3 { margin: 1rem !important; }
}

@media (max-width: 767px) {
    .card-body { padding: 1rem; }
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
    .input-group-sm .form-control { font-size: 0.82rem; }
}
</style>

<script>
function confirmAction(el, title, text) {
    const href = el.href;
    Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: el.classList.contains('btn-success') ? '#198754' : '#ffc107',
        cancelButtonColor: '#6c757d',
        confirmButtonText: el.classList.contains('btn-success') ? 'Yes, make admin' : 'Yes, make user',
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-' + (el.classList.contains('btn-success') ? 'success' : 'warning') + ' rounded-pill px-4',
            cancelButton: 'btn btn-secondary rounded-pill px-4'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = href;
        }
    });
    return false;
}

function deleteUser(id) {
    Swal.fire({
        title: 'Delete Customer?',
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
            window.location.href = '/admin/customers/delete/' + id;
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('userSearch');
    const rows = document.querySelectorAll('#userTable tbody tr');

    searchInput.addEventListener('input', function () {
        const filter = searchInput.value.toLowerCase();

        rows.forEach(row => {
            if (row.cells.length < 2) return;
            const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            const time = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
            row.style.display = (name.includes(filter) || email.includes(filter) || time.includes(filter)) ? '' : 'none';
        });
    });
});
</script>

@endsection