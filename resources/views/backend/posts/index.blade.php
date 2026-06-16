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
                Post List
                <span style="font-size:15px;" class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                    <i class="bi bi-journal-text"></i>
                    {{ $posts->count() }} Posts
                </span>
            </h2>
            <small class="text-muted">Manage all your posts efficiently</small>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ url('admin/posts/create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Add New Post
            </a>
        </div>
    </div>

    <div class="card mx-3 shadow-sm border-0 rounded-3">
        <div class="card-body p-2">

            <div class="mb-3">
                <input type="text" id="postSearch" class="form-control" placeholder="Search posts by title or category...">
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-hover table-bordered align-middle text-center mb-0">

                    <thead class="table-light">
                        <tr>
                            <th style="width:50px;">#</th>
                            <th style="width:300px;">Title</th>
                            <th style="width:120px;">Category</th>
                            <th style="width:100px;">File</th>
                            <th style="width:120px;">Status</th>
                            <th style="width:200px;">Actions</th>
                            <th style="width:200px;">Date & Time</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($posts as $post)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-medium text-center">{{ $post->title }}</td>
                            <td>{{ $post->PostCategory->name ?? 'No Category' }}</td>

                            <td>
                                @if($post->file)

                                    @php
                                        $ext = strtolower(pathinfo($post->file, PATHINFO_EXTENSION));
                                        $videoExtensions = ['mp4','webm','ogg','asf','avi','flv','mkv'];
                                        $imageExtensions = ['jpg','jpeg','png','gif','webp'];

                                        $isImage = in_array($ext, $imageExtensions);
                                        $isVideo = in_array($ext, $videoExtensions);
                                    @endphp

                                    @if($isImage)

                                        <a href="#" 
                                           class="media-preview"
                                           data-bs-toggle="modal"
                                           data-bs-target="#mediaModal"
                                           data-type="image"
                                           data-src="{{ config('app.storage_url') }}{{ $post->file }}">

                                            <img src="{{ config('app.storage_url') }}{{ $post->file }}"
                                                 class="img-thumbnail"
                                                 style="width:50px;height:50px;object-fit:cover;">
                                        </a>

                                    @elseif($isVideo)

                                        <a href="#"
                                           class="media-preview"
                                           data-bs-toggle="modal"
                                           data-bs-target="#mediaModal"
                                           data-type="video"
                                           data-src="{{ config('app.storage_url') }}{{ $post->file }}">

                                            <video class="img-thumbnail"
                                                   style="width:50px;height:50px;object-fit:cover;"
                                                   src="{{ config('app.storage_url') }}{{ $post->file }}"
                                                   muted>
                                            </video>
                                        </a>

                                    @else
                                        <span class="text-muted">Unsupported File</span>
                                    @endif

                                @else
                                    <span class="text-muted">No Image/Video</span>
                                @endif
                            </td>

                            <td>
                                @if($post->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>

                            <td>
                                <button class="btn btn-sm btn-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $post->id }}">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>

                                <button class="btn btn-sm btn-danger"
                                        onclick="confirmation({{ $post->id }})">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </td>
                            <td>
                                <span class="badge date-badge bg-success">
                                        {{ \Carbon\Carbon::parse($post->created_at)->timezone('Asia/Dhaka')->format('d M Y') }}
                                    </span>
                                    <br>
                                    <span class="badge time-badge bg-primary">
                                        {{ \Carbon\Carbon::parse($post->created_at)->timezone('Asia/Dhaka')->format('h:i A') }}
                                    </span>
                            </td>
                        </tr>

                        @include('backend.posts.editmodal')

                        @empty
                        <tr>
                            <td colspan="7" class="text-muted">No posts found</td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

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

                <iframe id="mediaIframe"
                        class="d-none"
                        style="width:100%;height:500px;border:0;">
                </iframe>

            </div>

        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    // ================= MEDIA MODAL =================
    const mediaModal = document.getElementById('mediaModal');
    const mediaImage = document.getElementById('mediaImage');
    const mediaVideo = document.getElementById('mediaVideo');
    const mediaVideoSource = document.getElementById('mediaVideoSource');
    const mediaIframe = document.getElementById('mediaIframe');

    document.querySelectorAll('.media-preview').forEach(el => {
        el.addEventListener('click', function () {
            const type = el.dataset.type;
            const src = el.dataset.src;
            const ext = src.split('.').pop().toLowerCase();

            mediaImage.classList.add('d-none');
            mediaVideo.classList.add('d-none');
            mediaIframe.classList.add('d-none');
            mediaVideo.pause();

            if (type === 'image') {
                mediaImage.src = src;
                mediaImage.classList.remove('d-none');
            } else if (type === 'video') {
                if (ext === 'asf') {
                    mediaIframe.src = src;
                    mediaIframe.classList.remove('d-none');
                } else {
                    mediaVideoSource.src = src;
                    mediaVideo.load();
                    mediaVideo.classList.remove('d-none');
                }
            }
        });
    });

    mediaModal.addEventListener('hidden.bs.modal', function () {
        mediaVideo.pause();
        mediaImage.src = '';
        mediaVideoSource.src = '';
        mediaIframe.src = '';
    });

    // ================= DELETE CONFIRMATION =================
    window.confirmation = function (id) {
        Swal.fire({
            title: 'Delete Post',
            text: 'Are you sure you want to delete this post?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/admin/posts/delete/' + id;
            }
        });
    }

    // ================= LIVE SEARCH =================
    const postSearch = document.getElementById('postSearch');
    const tableRows = document.querySelectorAll('table tbody tr');

    postSearch.addEventListener('keyup', function () {
        const query = this.value.toLowerCase().trim();

        tableRows.forEach(row => {
            const title = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
            const category = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase() || '';

            if (title.includes(query) || category.includes(query)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        // যদি কোনো রো না থাকে
        const visibleRows = Array.from(tableRows).filter(r => r.style.display !== 'none');
        if (visibleRows.length === 0) {
            if (!document.getElementById('noPostsRow')) {
                const tbody = document.querySelector('table tbody');
                const noRow = document.createElement('tr');
                noRow.id = 'noPostsRow';
                noRow.innerHTML = '<td colspan="7" class="text-muted text-center">No posts found</td>';
                tbody.appendChild(noRow);
            }
        } else {
            const noRow = document.getElementById('noPostsRow');
            if (noRow) noRow.remove();
        }
    });

});
</script>


<style>

.table-hover tbody tr:hover{
    background-color:rgba(13,110,253,0.05);
    transition:.2s;
}

.card-body{
    border-radius:12px;
}

.btn-sm i{
    margin-right:4px;
}

.alert{
    border-radius:12px;
    font-size:14px;
}

.fw-medium{
    font-weight:500;
}

@media (max-width:992px){

    .table-responsive{
        overflow-x:auto;
    }

    table th,table td{
        white-space:nowrap;
        font-size:13px;
    }

}

@media (max-width:576px){

    table th,table td{
        font-size:12px;
        padding:0.35rem;
    }

    .btn-sm{
        font-size:12px;
        padding:4px 6px;
    }

}

</style>

@endsection