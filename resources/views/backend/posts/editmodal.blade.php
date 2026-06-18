<!-- EDIT POST MODAL -->
<div class="modal fade" id="editModal{{ $post->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content ad-modal-content">

            <div class="ad-modal-header" style="background: linear-gradient(135deg,#6366f1,#8b5cf6); color: #fff;">
                <h5 class="ad-modal-title" style="color: #fff;"><i class="bi bi-pencil-square me-2"></i> Edit Post</h5>
                <button class="ad-modal-close ad-modal-close-white" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
            </div>

            <form id="editForm{{ $post->id }}" action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="ad-modal-body">
                    @if ($errors->any())
                    <div class="ad-alert ad-alert-danger mb-3">
                        <ul class="mb-0 ps-3" style="font-size: 12px;">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="ad-form-label">Post Title</label>
                            <input type="text" class="ad-form-input" name="title" value="{{ $post->title }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="ad-form-label">Category</label>
                            <select name="category_id" class="ad-form-input" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="ad-form-label">Post Details</label>
                            <textarea class="ad-form-input ad-form-textarea editor" name="details" rows="4">{{ $post->details }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="ad-form-label">Status</label>
                            <select name="status" class="ad-form-input" required>
                                <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="ad-form-label">Post File</label>
                            <input type="file" class="ad-form-input" id="editFile{{ $post->id }}" name="file" accept="image/*,video/mp4">
                            @if($post->file)
                            <div class="mt-2">
                                <small class="text-muted">Current File:</small>
                                @php
                                    $ext = strtolower(pathinfo($post->file, PATHINFO_EXTENSION));
                                    $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                                    $isVideo = in_array($ext, ['mp4']);
                                @endphp
                                @if($isImage)
                                <button type="button" class="media-preview d-inline-block mt-1 p-0 border-0 bg-transparent" data-type="image" data-src="{{ config('app.storage_url') }}{{ $post->file }}" data-bs-toggle="modal" data-bs-target="#mediaModal">
                                    <div class="ad-file-thumb"><img src="{{ config('app.storage_url') }}{{ $post->file }}" alt=""></div>
                                </button>
                                @elseif($isVideo)
                                <button type="button" class="media-preview d-inline-block mt-1 p-0 border-0 bg-transparent" data-type="video" data-src="{{ config('app.storage_url') }}{{ $post->file }}" data-bs-toggle="modal" data-bs-target="#mediaModal">
                                    <div class="ad-file-thumb ad-video-thumb">
                                        <video src="{{ config('app.storage_url') }}{{ $post->file }}" muted></video>
                                        <span class="ad-play-badge"><i class="bi bi-play-fill"></i></span>
                                    </div>
                                </button>
                                @endif
                            </div>
                            @endif
                            <img id="editPreview{{ $post->id }}" class="ad-edit-preview d-none" alt="">
                        </div>
                        <div class="col-12">
                            <div class="progress d-none ad-progress" id="progressBox{{ $post->id }}">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" id="progressBar{{ $post->id }}" style="width:0%">0%</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ad-modal-footer">
                    <button type="button" class="ad-btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="ad-btn-primary" id="submitBtn{{ $post->id }}">
                        <i class="bi bi-check-lg me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const fileInput = document.getElementById('editFile{{ $post->id }}');
    const preview = document.getElementById('editPreview{{ $post->id }}');
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('d-none');
            } else {
                preview.classList.add('d-none');
            }
        });
    }

    const form = document.getElementById('editForm{{ $post->id }}');
    const submitBtn = document.getElementById('submitBtn{{ $post->id }}');
    const progressBox = document.getElementById('progressBox{{ $post->id }}');
    const progressBar = document.getElementById('progressBar{{ $post->id }}');

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (typeof tinymce !== 'undefined') { tinymce.triggerSave(); }
            const formData = new FormData(form);
            const xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            submitBtn.disabled = true;
            progressBox.classList.remove('d-none');
            xhr.upload.onprogress = function(e) {
                if (e.lengthComputable) {
                    const percent = Math.round((e.loaded / e.total) * 100);
                    progressBar.style.width = percent + '%';
                    progressBar.innerHTML = percent + '%';
                }
            };
            xhr.onload = function() {
                submitBtn.disabled = false;
                progressBox.classList.add('d-none');
                if (xhr.status === 200) { location.reload(); }
                else { alert('Update failed!'); }
            };
            xhr.send(formData);
        });
    }

});
</script>

<style>
.ad-modal-content { border: none; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.12); overflow: hidden; background: rgba(255,255,255,0.92); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); }
.ad-modal-close-white {
    background: rgba(255,255,255,0.15);
    color: #fff;
}
.ad-modal-close-white:hover {
    background: rgba(255,255,255,0.25);
    color: #fff;
}
.ad-form-label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: #475569;
    margin-bottom: 4px;
}
.ad-form-input {
    width: 100%;
    padding: 9px 12px;
    border: 1px solid rgba(233,238,243,0.7);
    border-radius: 8px;
    font-size: 13px;
    color: #334155;
    background: rgba(255,255,255,0.7);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    outline: none;
    transition: border-color 0.3s, box-shadow 0.3s;
    font-family: inherit;
}
.ad-form-input:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.06);
    background: rgba(255,255,255,0.95);
}
.ad-form-textarea {
    min-height: 100px;
    resize: vertical;
}
.ad-edit-preview {
    max-height: 100px;
    border-radius: 8px;
    border: 1px solid #e9eef3;
    margin-top: 8px;
}
.ad-progress {
    height: 8px;
    border-radius: 4px;
    background: #f1f5f9;
}
.ad-progress .progress-bar {
    background: linear-gradient(90deg, #6366f1, #8b5cf6);
    border-radius: 4px;
    font-size: 0;
}
.ad-modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 8px;
    padding: 16px 20px;
    border-top: 1px solid #f1f5f9;
}
.ad-btn-secondary {
    padding: 9px 20px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    border: 1px solid rgba(233,238,243,0.5);
    cursor: pointer;
    transition: all 0.2s;
    background: rgba(255,255,255,0.5);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    color: #64748b;
}
.ad-btn-secondary:hover {
    background: rgba(248,250,252,0.8);
    border-color: #cbd5e1;
}
</style>