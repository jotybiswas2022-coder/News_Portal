@extends('backend.app')

@section('content')
<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-11">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="fw-bold mb-0"><i class="bi bi-person-circle me-2" style="color:#6366f1;"></i>Account Profile</h4>
                <a href="{{ url('/admin/account/edit') }}" class="btn btn-admin btn-admin-primary px-4">
                    <i class="bi bi-pencil-square me-1"></i> Edit
                </a>
            </div>

            {{-- Profile Card --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <div class="row align-items-center g-4">
                        <div class="col-md-auto text-center">
                            @if(isset($account) && $account->image)
                                <img src="{{ config('app.storage_url') }}{{ $account->image }}"
                                     alt="{{ $account->name ?? 'User' }}"
                                     class="rounded-circle shadow-sm"
                                     style="width:120px; height:120px; object-fit:cover;">
                            @else
                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm"
                                     style="width:120px; height:120px; background:linear-gradient(135deg,#6366f1,#8b5cf6); color:#fff; font-size:3rem; font-weight:700;">
                                    {{ isset($account->name) ? strtoupper(substr($account->name, 0, 1)) : 'U' }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md">
                            <h3 class="fw-bold mb-2">{{ $account->name ?? 'Not set' }}</h3>
                            <div class="d-flex flex-column gap-1">
                                @if(isset($account) && $account->email)
                                    <span class="text-muted"><i class="bi bi-envelope me-2" style="color:#6366f1;"></i>{{ $account->email }}</span>
                                @endif
                                @if(isset($account) && $account->phone)
                                    <span class="text-muted"><i class="bi bi-whatsapp me-2" style="color:#25D366;"></i>{{ $account->phone }}</span>
                                @endif
                            </div>
                            <div class="mt-3 d-flex flex-wrap gap-2">
                                @if(isset($account) && $account->cv)
                                    <a href="{{ config('app.storage_url') }}{{ $account->cv }}" target="_blank"
                                       class="btn btn-sm btn-outline-danger rounded-3 px-3">
                                        <i class="bi bi-file-earmark-pdf me-1"></i> View CV
                                    </a>
                                @else
                                    <span class="btn btn-sm btn-outline-secondary rounded-3 px-3 disabled opacity-50">
                                        <i class="bi bi-file-earmark me-1"></i> No CV
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Social Links --}}
            @if(isset($account) && ($account->github || $account->linkedin || $account->facebook || $account->twitter || $account->youtube))
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-bottom-0 pb-0 pt-3 px-4">
                    <h6 class="fw-bold mb-0"><i class="bi bi-share me-2" style="color:#6366f1;"></i>Social Links</h6>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="d-flex flex-wrap gap-2">
                        @if($account->github)
                            <a href="{{ $account->github }}" target="_blank"
                               class="btn btn-light border rounded-3 px-3 d-inline-flex align-items-center gap-2">
                                <i class="bi bi-github"></i> GitHub
                            </a>
                        @endif
                        @if($account->linkedin)
                            <a href="{{ $account->linkedin }}" target="_blank"
                               class="btn btn-light border rounded-3 px-3 d-inline-flex align-items-center gap-2">
                                <i class="bi bi-linkedin text-primary"></i> LinkedIn
                            </a>
                        @endif
                        @if($account->facebook)
                            <a href="{{ $account->facebook }}" target="_blank"
                               class="btn btn-light border rounded-3 px-3 d-inline-flex align-items-center gap-2">
                                <i class="bi bi-facebook" style="color:#1877f2;"></i> Facebook
                            </a>
                        @endif
                        @if($account->twitter)
                            <a href="{{ $account->twitter }}" target="_blank"
                               class="btn btn-light border rounded-3 px-3 d-inline-flex align-items-center gap-2">
                                <i class="bi bi-twitter-x"></i> Twitter
                            </a>
                        @endif
                        @if($account->youtube)
                            <a href="{{ $account->youtube }}" target="_blank"
                               class="btn btn-light border rounded-3 px-3 d-inline-flex align-items-center gap-2">
                                <i class="bi bi-youtube text-danger"></i> YouTube
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
