@if ($errors->any())
<div class="alert alert-danger mb-2">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- EDIT POST MODAL -->
<div class="modal fade" id="editModal{{ $post->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <div class="modal-header bg-gradient-primary text-white rounded-top-4">
                <h5 class="modal-title fw-semibold">
                    <i class="bi bi-pencil-square me-2"></i> Edit Post
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form id="editForm{{ $post->id }}" action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Title -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Post Title</label>
                            <input type="text" class="form-control" name="title" value="{{ $post->title }}" required>
                        </div>

                        <!-- Category -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Details -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">Post Details</label>
                            <textarea class="form-control editor" name="details" rows="4">{{ $post->details }}</textarea>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- File -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Post File</label>
                            <input type="file" class="form-control" id="editFile{{ $post->id }}" name="file" accept="image/*,video/mp4">

                            @if($post->file)
                            <div class="mt-2">
                                <small class="text-muted">Current File</small><br>

                                @php
                                    $ext = strtolower(pathinfo($post->file, PATHINFO_EXTENSION));
                                    $videoExtensions = ['mp4'];
                                    $imageExtensions = ['jpg','jpeg','png','gif','webp'];
                                    $isImage = in_array($ext, $imageExtensions);
                                    $isVideo = in_array($ext, $videoExtensions);
                                @endphp

                                @if($isImage)
                                    <a href="#" class="media-preview" data-bs-toggle="modal" data-bs-target="#mediaModal" data-type="image" data-src="{{ config('app.storage_url') }}{{ $post->file }}">
                                        <img src="{{ config('app.storage_url') }}{{ $post->file }}" class="img-thumbnail" style="width:50px;height:50px;object-fit:cover;">
                                    </a>
                                @elseif($isVideo)
                                    <a href="#" class="media-preview" data-bs-toggle="modal" data-bs-target="#mediaModal" data-type="video" data-src="{{ config('app.storage_url') }}{{ $post->file }}">
                                        <video class="img-thumbnail" style="width:50px;height:50px;object-fit:cover;" src="{{ config('app.storage_url') }}{{ $post->file }}" muted></video>
                                    </a>
                                @else
                                    <span class="text-muted">Unsupported File</span>
                                @endif
                            </div>
                            @endif

                            <div class="mt-2">
                                <img id="editPreview{{ $post->id }}" class="img-fluid rounded shadow-sm d-none" style="max-height:120px;">
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="col-12">
                            <div class="progress d-none" id="progressBox{{ $post->id }}">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" id="progressBar{{ $post->id }}" style="width:0%">0%</div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill" id="submitBtn{{ $post->id }}">
                        <i class="bi bi-save me-1"></i> Save Changes
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- MEDIA MODAL -->
<div class="modal fade" id="mediaModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <div class="modal-header">
                <h5 class="modal-title">Media Preview</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <img id="mediaImage" class="img-fluid d-none" style="max-height:500px;">
                <video id="mediaVideo" class="img-fluid d-none" controls style="max-height:500px;">
                    <source id="mediaVideoSource">
                </video>
            </div>

        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', function(){

    // File Preview
    const fileInput = document.getElementById('editFile{{ $post->id }}');
    const preview = document.getElementById('editPreview{{ $post->id }}');
    fileInput.addEventListener('change', function(e){
        const file = e.target.files[0];
        if(file && file.type.startsWith('image/')){
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
        } else {
            preview.classList.add('d-none');
        }
    });

    // Form Submit with Ajax
    const form = document.getElementById('editForm{{ $post->id }}');
    const submitBtn = document.getElementById('submitBtn{{ $post->id }}');
    const progressBox = document.getElementById('progressBox{{ $post->id }}');
    const progressBar = document.getElementById('progressBar{{ $post->id }}');

    form.addEventListener('submit', function(e){
        e.preventDefault();

        // TinyMCE/Editor sync
        if(typeof tinymce !== 'undefined'){
            tinymce.triggerSave();
        }

        const formData = new FormData(form);
        const xhr = new XMLHttpRequest();
        xhr.open('POST', form.action, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

        submitBtn.disabled = true;
        progressBox.classList.remove('d-none');

        xhr.upload.onprogress = function(e){
            if(e.lengthComputable){
                let percent = Math.round((e.loaded / e.total) * 100);
                progressBar.style.width = percent + '%';
                progressBar.innerHTML = percent + '%';
            }
        };

        xhr.onload = function(){
            submitBtn.disabled = false;
            progressBox.classList.add('d-none');

            if(xhr.status === 200){
                location.reload();
            } else {
                alert("Update failed!");
            }
        };

        xhr.send(formData);
    });

    // Media Preview Modal
    document.querySelectorAll('.media-preview').forEach(el=>{
        el.addEventListener('click',function(){
            const type = el.dataset.type;
            const src = el.dataset.src;

            const img = document.getElementById('mediaImage');
            const video = document.getElementById('mediaVideo');
            const videoSrc = document.getElementById('mediaVideoSource');

            img.classList.add('d-none');
            video.classList.add('d-none');

            if(type === 'image'){
                img.src = src;
                img.classList.remove('d-none');
            }
            if(type === 'video'){
                videoSrc.src = src;
                video.load();
                video.classList.remove('d-none');
            }
        });
    });
});
</script>

<style>
.bg-gradient-primary{
    background: linear-gradient(45deg,#4f46e5,#6366f1);
}
.progress{
    height:20px;
    margin-top:10px;
}
.active-thumb{
    border: 2px solid #4f46e5;
}
</style>