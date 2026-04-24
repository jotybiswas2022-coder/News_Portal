@extends('backend.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid" style="height: calc(100vh - 80px); overflow-y: auto; padding: 20px 0;">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-gear-fill me-2"></i> Settings
                    </h4>
                </div>

                <div class="card-body">

                    <form action="{{ url('admin/settings') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" id="email" class="form-select" value="{{ $settings?->email ?? '' }}" placeholder="Enter email">
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="form-label fw-semibold">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-select" value="{{ $settings?->phone ?? '' }}" placeholder="Enter phone number">
                        </div>

                        <div class="mb-4">
                            <label for="location" class="form-label fw-semibold">Location</label>
                            <input type="text" name="location" id="location" class="form-select" value="{{ $settings?->location ?? '' }}" placeholder="Enter location">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-dark px-4">
                                <i class="bi bi-save me-1"></i> Save Settings
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

<style>
.card {
    border-radius: 14px;
    overflow: hidden;
    transition: all .3s ease;
}

.card:hover {
    box-shadow: 0 12px 35px rgba(0,0,0,.15);
    transform: translateY(-2px);
}

.card-header {
    padding: 18px 24px;
    letter-spacing: .5px;
}

.form-label {
    font-size: 15px;
    color: #333;
}

.form-select {
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 15px;
    border: 1px solid #ddd;
    transition: all .3s ease;
}

.form-select:focus {
    border-color: #000;
    box-shadow: 0 0 0 .15rem rgba(0,0,0,.15);
}

.btn-dark {
    border-radius: 30px;
    padding: 10px 26px;
    font-weight: 600;
    transition: all .3s ease;
}

.btn-dark:hover {
    background-color: #111;
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(0,0,0,.25);
}

.alert {
    border-radius: 12px;
    font-size: 14px;
}
</style>

@endsection