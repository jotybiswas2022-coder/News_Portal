@extends('backend.app')

@section('title', 'Blood Request Details')

@section('content')

<div class="container-fluid py-3 py-md-4">
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ url('/admin/blood-requests') }}" style="display:inline-flex;align-items:center;gap:6px;padding:8px 18px;border-radius:50px;background:#f0f1fe;color:#667eea;text-decoration:none;font-size:0.85rem;font-weight:600;transition:all 0.2s;"
               onmouseover="this.style.background='#667eea';this.style.color='#fff'" onmouseout="this.style.background='#f0f1fe';this.style.color='#667eea'">
                <i class="bi bi-arrow-left"></i> Back to Requests
            </a>
        </div>
    </div>

    <div class="row g-3">
        {{-- Request Details --}}
        <div class="col-12 col-lg-7">
            <div style="background:#fff;border-radius:20px;box-shadow:0 4px 24px rgba(0,0,0,0.06);overflow:hidden;border:1px solid rgba(0,0,0,0.04);">
                <div style="padding:18px 22px;border-bottom:1px solid #f0f0f5;display:flex;align-items:center;gap:12px;background:linear-gradient(135deg,#fef2f2,#fff5f5);">
                    <span style="width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,#dc3545,#e35e6f);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:1rem;box-shadow:0 3px 10px rgba(220,53,69,0.25);">
                        {{ $bloodRequest->blood_group }}
                    </span>
                    <div>
                        <h6 style="margin:0;font-weight:700;font-size:1rem;color:#333;">{{ $bloodRequest->patient_name }}</h6>
                        <small style="color:#999;font-size:0.78rem;">
                            Requested by {{ $bloodRequest->user->name ?? 'Unknown' }} &middot; {{ \Carbon\Carbon::parse($bloodRequest->created_at)->timezone('Asia/Dhaka')->format('d M Y, h:i A') }}
                        </small>
                    </div>
                    @php
                        $statusColors = ['pending'=>'#f59e0b','matched'=>'#3b82f6','fulfilled'=>'#22c55e','cancelled'=>'#6b7280'];
                        $statusLabels = ['pending'=>'Pending','matched'=>'Matched','fulfilled'=>'Fulfilled','cancelled'=>'Cancelled'];
                    @endphp
                    <span style="margin-left:auto;padding:5px 14px;border-radius:50px;font-size:0.78rem;font-weight:700;background:{{ $statusColors[$bloodRequest->status] }}15;color:{{ $statusColors[$bloodRequest->status] }};border:1px solid {{ $statusColors[$bloodRequest->status] }}30;display:inline-flex;align-items:center;gap:5px;">
                        <i class="bi bi-circle-fill" style="font-size:7px;"></i> {{ $statusLabels[$bloodRequest->status] }}
                    </span>
                </div>
                <div style="padding:22px;">
                    @php
                        $urgencyLabels = ['critical'=>'Critical','urgent'=>'Urgent','normal'=>'Normal'];
                        $urgencyColors = ['critical'=>'#dc3545','urgent'=>'#f59e0b','normal'=>'#3b82f6'];
                    @endphp
                    <div class="row g-3">
                        <div class="col-6">
                            <div style="padding:14px 16px;background:#f8f9fe;border-radius:12px;">
                                <small style="color:#999;font-size:0.7rem;text-transform:uppercase;letter-spacing:0.5px;font-weight:600;">Blood Group</small>
                                <p style="margin:4px 0 0;font-weight:800;font-size:1.2rem;color:#dc3545;">{{ $bloodRequest->blood_group }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="padding:14px 16px;background:#f8f9fe;border-radius:12px;">
                                <small style="color:#999;font-size:0.7rem;text-transform:uppercase;letter-spacing:0.5px;font-weight:600;">Urgency</small>
                                <p style="margin:4px 0 0;font-weight:700;font-size:0.9rem;color:{{ $urgencyColors[$bloodRequest->urgency] }};">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $urgencyLabels[$bloodRequest->urgency] }}
                                </p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="padding:14px 16px;background:#f8f9fe;border-radius:12px;">
                                <small style="color:#999;font-size:0.7rem;text-transform:uppercase;letter-spacing:0.5px;font-weight:600;">Location</small>
                                <p style="margin:4px 0 0;font-weight:600;font-size:0.85rem;color:#444;">
                                    <i class="bi bi-geo-alt me-1" style="color:#e35e6f;"></i> {{ $bloodRequest->location }}
                                </p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="padding:14px 16px;background:#f8f9fe;border-radius:12px;">
                                <small style="color:#999;font-size:0.7rem;text-transform:uppercase;letter-spacing:0.5px;font-weight:600;">Contact</small>
                                <p style="margin:4px 0 0;font-weight:600;font-size:0.85rem;color:#444;">
                                    <i class="bi bi-telephone me-1" style="color:#22c55e;"></i> {{ $bloodRequest->contact_phone }}
                                </p>
                            </div>
                        </div>
                        @if($bloodRequest->hospital)
                        <div class="col-12">
                            <div style="padding:14px 16px;background:#f8f9fe;border-radius:12px;">
                                <small style="color:#999;font-size:0.7rem;text-transform:uppercase;letter-spacing:0.5px;font-weight:600;">Hospital</small>
                                <p style="margin:4px 0 0;font-weight:600;font-size:0.85rem;color:#444;">
                                    <i class="bi bi-building me-1" style="color:#667eea;"></i> {{ $bloodRequest->hospital }}
                                </p>
                            </div>
                        </div>
                        @endif
                        @if($bloodRequest->message)
                        <div class="col-12">
                            <div style="padding:14px 16px;background:#f8f9fe;border-radius:12px;">
                                <small style="color:#999;font-size:0.7rem;text-transform:uppercase;letter-spacing:0.5px;font-weight:600;">Message</small>
                                <p style="margin:4px 0 0;font-size:0.85rem;color:#555;line-height:1.5;">{{ $bloodRequest->message }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div style="margin-top:18px;display:flex;gap:8px;flex-wrap:wrap;">
                        @if($bloodRequest->status !== 'fulfilled' && $bloodRequest->status !== 'cancelled')
                        <form action="{{ url('/admin/blood-requests/fulfilled/'.$bloodRequest->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success" style="border-radius:10px;font-weight:600;font-size:0.85rem;padding:8px 20px;"
                                    onclick="return confirm('Mark this request as fulfilled?')">
                                <i class="bi bi-check-lg me-1"></i> Mark as Fulfilled
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Matching Donors --}}
        <div class="col-12 col-lg-5">
            <div style="background:#fff;border-radius:20px;box-shadow:0 4px 24px rgba(0,0,0,0.06);overflow:hidden;border:1px solid rgba(0,0,0,0.04);height:100%;">
                <div style="padding:16px 22px;border-bottom:1px solid #f0f0f5;display:flex;align-items:center;justify-content:space-between;">
                    <h6 style="margin:0;font-weight:700;font-size:0.9rem;color:#333;">
                        <i class="bi bi-people me-2" style="color:#3b82f6;"></i> Matching Donors ({{ $matchingDonors->count() }})
                    </h6>
                </div>
                <div style="padding:8px 18px;">
                    @if($matchingDonors->isEmpty())
                        <div style="text-align:center;padding:30px 0;color:#999;">
                            <i class="bi bi-person-plus" style="font-size:2rem;display:block;margin-bottom:8px;"></i>
                            <span style="font-weight:500;font-size:0.85rem;">No matching donors found</span>
                        </div>
                    @else
                        @foreach($matchingDonors as $donor)
                            <div style="display:flex;align-items:center;gap:12px;padding:10px 0;{{ !$loop->last ? 'border-bottom:1px solid #f0f0f5;' : '' }}">
                                <div style="width:38px;height:38px;border-radius:50%;background:linear-gradient(135deg,#dc3545,#e35e6f);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:0.75rem;flex-shrink:0;box-shadow:0 3px 8px rgba(220,53,69,0.2);">
                                    {{ $donor->blood }}
                                </div>
                                <div style="flex:1;min-width:0;">
                                    <h6 style="margin:0;font-weight:600;font-size:0.85rem;color:#333;">{{ $donor->name }}</h6>
                                    <small style="color:#999;font-size:0.75rem;">
                                        <i class="bi bi-telephone me-1"></i>{{ $donor->number ?? 'N/A' }} &middot; {{ $donor->division ?? 'N/A' }}
                                    </small>
                                </div>
                                <a href="tel:{{ $donor->number }}" style="width:32px;height:32px;border-radius:8px;background:#22c55e15;color:#22c55e;display:flex;align-items:center;justify-content:center;text-decoration:none;transition:all 0.2s;flex-shrink:0;"
                                   onmouseover="this.style.background='#22c55e';this.style.color='#fff'" onmouseout="this.style.background='#22c55e15';this.style.color='#22c55e'">
                                    <i class="bi bi-telephone-fill" style="font-size:0.8rem;"></i>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
