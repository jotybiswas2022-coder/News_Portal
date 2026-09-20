<!-- Edit Customer Modal -->
<div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-gradient-primary text-white rounded-top-4 px-4 py-3">
                <h5 class="modal-title fw-semibold" id="editModalLabel{{ $user->id }}">
                    <i class="bi bi-pencil-square me-2"></i> Edit Customer
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ url('admin/customers/update/'.$user->id) }}" method="POST" autocomplete="off">
                @csrf
                <div class="modal-body px-4 py-4">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-person me-1 text-secondary"></i>
                            Full Name <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-envelope me-1 text-secondary"></i>
                            Email Address <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-lock me-1 text-secondary"></i>
                            Password
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="Enter new password if you want to change">
                            <small class="text-muted d-block mt-1">Leave blank if you don't want to change the password</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-lock-fill me-1 text-secondary"></i>
                            Confirm Password
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm new password">
                        </div>
                    </div>

                </div>

                <div class="modal-footer border-0 px-4 pb-4 flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary { background: linear-gradient(45deg, #4f46e5, #6366f1); }

.form-control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 0.15rem rgba(99,102,241,0.2);
}

.btn { transition: 0.2s; }
.btn-primary:hover { background: #4f46e5; border-color: #4f46e5; }
.btn-outline-secondary:hover { background: #e9ecef; }

/* Modal Responsive */
@media (max-width: 575px) {
    .modal-dialog { max-width: 95%; margin: 1rem auto; }
    .modal-body { padding: 1.25rem; }
    .modal-header, .modal-footer { padding: 1rem 1.25rem; }
    .modal-footer { flex-direction: column; }
    .modal-footer .btn { width: 100%; }
}
</style>