@extends('backend.app')

@section('content')

<div class="container-fluid py-4">

    {{-- Dashboard Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="p-4 rounded-4 shadow-lg" style="background: linear-gradient(135deg, #6a11cb, #2575fc); color: #fff;">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div class="fw-bold fs-4 d-flex align-items-center">
                        <i class="bi bi-speedometer2 me-2 fs-3"></i>
                        Welcome to Admin Dashboard
                    </div>
                    <div class="mt-2 mt-md-0 fw-semibold">
                        Hello, <strong>{{ auth()->user()->name }}</strong>! Here's a quick overview.
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Summary Cards --}}
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card card-hover p-3 shadow-sm rounded-4 text-center">
                <i class="bi bi-people fs-1 text-primary"></i>
                <h3 class="mt-2">{{ $accountsCount }}</h3>
                <p class="mb-0 fw-semibold">Total Accounts</p>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card card-hover p-3 shadow-sm rounded-4 text-center">
                <i class="bi bi-envelope fs-1 text-success"></i>
                <h3 class="mt-2">{{ $contactsCount }}</h3>
                <p class="mb-0 fw-semibold">Total Messages</p>
            </div>
        </div>
    </div>

    {{-- Recent Contacts --}}
    <div class="row">
        <div class="col-12">
            <div class="card rounded-4 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-chat-dots me-2"></i> Recent Messages
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($contacts->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 mb-2"></i>
                            <div>No messages found</div>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $index => $contact)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary py-1 px-2" data-bs-toggle="modal" data-bs-target="#messageModal{{ $contact->id }}">
                                                    View
                                                </button>

                                                <!-- Message Modal -->
                                                <div class="modal fade" id="messageModal{{ $contact->id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $contact->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content rounded-4 shadow-lg">
                                                            <div class="modal-header bg-primary text-white rounded-top-4">
                                                                <h5 class="modal-title fw-semibold" id="messageModalLabel{{ $contact->id }}">
                                                                    Message from {{ $contact->name }}
                                                                </h5>
                                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body px-4 py-3">
                                                                <p>{{ $contact->message }}</p>
                                                            </div>
                                                            <div class="modal-footer border-0 px-4 pb-4">
                                                                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                                                                    Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
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
        </div>
    </div>

</div>

{{-- Custom Styles --}}
<style>
.card-hover {
    transition: transform 0.3s, box-shadow 0.3s;
    cursor: pointer;
}
.card-hover:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 12px 24px rgba(0,0,0,0.2);
}
.card h3 {
    margin-top: 10px;
}
.table-hover tbody tr:hover {
    background: rgba(13,110,253,.05);
}
.modal-content {
    border: none;
}
</style>

@endsection