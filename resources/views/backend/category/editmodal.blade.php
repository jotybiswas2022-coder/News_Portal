<div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ad-modal-content">
            <div class="ad-modal-header">
                <h5 class="ad-modal-title"><i class="bi bi-pencil-square me-2"></i>Edit Category</h5>
                <button class="ad-modal-close" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
            </div>
            <form action="{{ url('admin/category/update/'.$category->id) }}" method="POST">
                @csrf
                <div class="ad-modal-body">
                    <label class="ad-form-label">Category Name <span class="text-danger">*</span></label>
                    <div class="ad-input-group">
                        <span class="ad-input-icon"><i class="bi bi-tag"></i></span>
                        <input type="text" class="ad-form-input ad-input-with-icon" name="name" value="{{ $category->name }}" required>
                    </div>
                </div>
                <div class="ad-modal-footer">
                    <button type="button" class="ad-btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle me-1"></i> Cancel</button>
                    <button type="submit" class="ad-btn-primary"><i class="bi bi-check-lg me-1"></i> Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>