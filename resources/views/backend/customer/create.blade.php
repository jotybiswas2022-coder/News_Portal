@extends('backend.app')

@section('content')

<div class="container-fluid" style="height: calc(100vh - 80px); overflow-y: auto; padding-bottom: 20px;">

    <div class="row px-3 pt-3 pb-2 align-items-center">
        <div class="col-md-8">
            <h3 class="fw-bold mb-1">
                <i class="bi bi-person-plus me-2 text-primary"></i> Create User Account
            </h3>
            <small class="text-muted">Fill in the details to create a new user</small>
        </div>
        <div class="col-md-4 text-md-end mt-2 mt-md-0">
            <a href="{{ url('admin/customers') }}" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left"></i> Go Back
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm mx-3 mt-3 customer-card">
        <div class="card-body p-4 p-md-5">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ url('admin/customers/store') }}" method="POST" autocomplete="off">
                @csrf

                <div class="row g-3">

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-person me-1 text-secondary"></i>
                            Full Name <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" name="name" placeholder="Enter user name" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-envelope me-1 text-secondary"></i>
                            Email Address <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" name="email" placeholder="Enter user email" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-lock me-1 text-secondary"></i>
                            Password <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-lock-fill me-1 text-secondary"></i>
                            Confirm Password <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <button type="submit" class="btn btn-success rounded-pill px-5 w-100 w-md-auto">
                            <i class="bi bi-check-circle me-1"></i> Create Account
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>

<style>
.customer-card { border-radius: 16px; }

.form-control:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 0.15rem rgba(79,70,229,0.15);
}

.btn-success { background: #10b981; border: none; transition: 0.2s; }
.btn-success:hover { background: #059669; transform: translateY(-1px); }

.input-group-text { background: #f8f9fa; border-color: #dee2e6; }

.alert { border-radius: 12px; }

/* Responsive */
@media (max-width: 991px) { .card-body { padding: 1.5rem; } }
@media (max-width: 575px) {
    .btn-success { width: 100%; }
    .container-fluid { padding: 0.75rem; }
    .card.mx-3 { margin: 0.5rem !important; }
}
</style>

@endsection