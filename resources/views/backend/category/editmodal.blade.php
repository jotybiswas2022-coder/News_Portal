<div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ad-modal-content">
            <div class="ad-modal-header" style="background: linear-gradient(135deg,#6366f1,#8b5cf6); color: #fff;">
                <h5 class="ad-modal-title" style="color: #fff;"><i class="bi bi-pencil-square me-2"></i>Edit Category</h5>
                <button class="ad-modal-close ad-modal-close-white" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
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

<style>
.ad-modal-content { border: none; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.12); overflow: hidden; background: rgba(255,255,255,0.85); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); }
.ad-modal-header { display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; }
.ad-modal-title { font-size: 14px; font-weight: 700; margin: 0; }
.ad-modal-close { width: 32px; height: 32px; border-radius: 8px; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 12px; }
.ad-modal-close-white { background: rgba(255,255,255,0.15); color: #fff; }
.ad-modal-close-white:hover { background: rgba(255,255,255,0.25); }
.ad-modal-body { padding: 20px; }
.ad-form-label { display: block; font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 6px; }
.ad-form-input { width: 100%; padding: 10px 12px; border: 1px solid rgba(233,238,243,0.5); border-radius: 8px; font-size: 13px; color: #334155; outline: none; transition: border-color 0.3s; font-family: inherit; background: rgba(255,255,255,0.5); backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px); }
.ad-form-input:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,0.06); background: rgba(255,255,255,0.85); }
.ad-input-group { position: relative; }
.ad-input-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 14px; pointer-events: none; }
.ad-input-with-icon { padding-left: 36px; }
.ad-modal-footer { display: flex; justify-content: flex-end; gap: 8px; padding: 16px 20px; border-top: 1px solid #f1f5f9; }
.ad-btn-secondary { padding: 9px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; border: 1px solid rgba(233,238,243,0.5); cursor: pointer; transition: all 0.2s; background: rgba(255,255,255,0.5); backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px); color: #64748b; }
.ad-btn-secondary:hover { background: rgba(248,250,252,0.8); border-color: #cbd5e1; }
.ad-btn-primary { padding: 9px 24px; border-radius: 8px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; gap: 6px; background: linear-gradient(135deg,#6366f1,#8b5cf6); color: #fff; box-shadow: 0 4px 12px rgba(99,102,241,0.2); }
.ad-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(99,102,241,0.3); }
</style>