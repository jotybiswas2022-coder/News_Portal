@extends('backend.app')

@section('title', 'Blood Requests')

@section('content')

<div class="container-fluid py-3 py-md-4">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:12px;margin-bottom:12px;">
                <div>
                    <h4 style="margin:0;font-weight:800;font-size:1.5rem;background:linear-gradient(135deg,#e35e6f,#dc3545);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                        <i class="bi bi-exclamation-triangle-fill me-2" style="-webkit-text-fill-color:#e35e6f;"></i>Blood Requests
                    </h4>
                    <p style="margin:4px 0 0;font-size:0.85rem;color:#6c757d;">
                        <i class="bi bi-calendar3 me-1"></i> {{ now()->timezone('Asia/Dhaka')->format('l, d F Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="row g-3 mb-4">
        @php
            $statCards = [
                ['icon' => 'clock', 'count' => $pendingCount, 'label' => 'Pending', 'color' => '#f59e0b'],
                ['icon' => 'people', 'count' => $matchedCount, 'label' => 'Matched', 'color' => '#3b82f6'],
                ['icon' => 'check-circle', 'count' => $fulfilledCount, 'label' => 'Fulfilled', 'color' => '#22c55e'],
                ['icon' => 'inbox', 'count' => $totalCount, 'label' => 'Total', 'color' => '#667eea'],
            ];
        @endphp
        @foreach($statCards as $card)
        <div class="col-6 col-md-3">
            <div style="position:relative;padding:18px 20px;border-radius:16px;height:100%;background:linear-gradient(135deg,{{ $card['color'] }},{{ $card['color'] }}dd);box-shadow:0 6px 24px {{ $card['color'] }}33;transition:all 0.3s;overflow:hidden;"
                 onmouseover="this.style.transform='translateY(-4px) scale(1.02)';this.style.boxShadow='0 12px 40px {{ $card['color'] }}55'"
                 onmouseout="this.style.transform='';this.style.boxShadow='0 6px 24px {{ $card['color'] }}33'">
                <div style="position:absolute;top:-25px;right:-25px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,0.08);pointer-events:none;"></div>
                <div style="display:flex;align-items:center;gap:12px;">
                    <div style="width:44px;height:44px;border-radius:12px;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;backdrop-filter:blur(4px);flex-shrink:0;">
                        <i class="bi bi-{{ $card['icon'] }}" style="font-size:1.3rem;color:#fff;"></i>
                    </div>
                    <div>
                        <h3 style="margin:0;font-weight:800;font-size:1.6rem;color:#fff;line-height:1.2;">{{ $card['count'] }}</h3>
                        <p style="margin:0;font-size:0.78rem;font-weight:600;color:rgba(255,255,255,0.75);">{{ $card['label'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Requests Table --}}
    <div class="row">
        <div class="col-12">
            <div style="background:#fff;border-radius:20px;box-shadow:0 4px 24px rgba(0,0,0,0.06);overflow:hidden;border:1px solid rgba(0,0,0,0.04);">
                <div style="padding:16px 22px;border-bottom:1px solid #f0f0f5;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
                    <h6 style="margin:0;font-weight:700;font-size:0.95rem;color:#333;">
                        <i class="bi bi-list-ul me-2" style="color:#e35e6f;"></i>All Blood Requests
                    </h6>
                    <div style="display:flex;gap:8px;flex-wrap:wrap;">
                        <span style="padding:4px 10px;border-radius:50px;font-size:0.72rem;background:#fef3c7;color:#92400e;font-weight:600;">
                            <i class="bi bi-circle-fill me-1" style="font-size:6px;color:#f59e0b;"></i>Pending
                        </span>
                        <span style="padding:4px 10px;border-radius:50px;font-size:0.72rem;background:#dbeafe;color:#1e40af;font-weight:600;">
                            <i class="bi bi-circle-fill me-1" style="font-size:6px;color:#3b82f6;"></i>Matched
                        </span>
                        <span style="padding:4px 10px;border-radius:50px;font-size:0.72rem;background:#dcfce7;color:#166534;font-weight:600;">
                            <i class="bi bi-circle-fill me-1" style="font-size:6px;color:#22c55e;"></i>Fulfilled
                        </span>
                        <span style="padding:4px 10px;border-radius:50px;font-size:0.72rem;background:#f3f4f6;color:#6b7280;font-weight:600;">
                            <i class="bi bi-circle-fill me-1" style="font-size:6px;color:#6b7280;"></i>Cancelled
                        </span>
                    </div>
                </div>
                <div class="table-responsive" style="padding:0;">
                    <table class="table table-hover align-middle mb-0" style="font-size:0.85rem;">
                        <thead>
                            <tr style="background:#f8f9fe;border-bottom:2px solid #eef1ff;">
                                <th style="padding:14px 18px;font-weight:700;color:#444;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.5px;">#</th>
                                <th style="padding:14px 18px;font-weight:700;color:#444;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.5px;">Patient</th>
                                <th style="padding:14px 18px;font-weight:700;color:#444;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.5px;">Blood</th>
                                <th style="padding:14px 18px;font-weight:700;color:#444;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.5px;">Location</th>
                                <th style="padding:14px 18px;font-weight:700;color:#444;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.5px;">Urgency</th>
                                <th style="padding:14px 18px;font-weight:700;color:#444;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.5px;">Status</th>
                                <th style="padding:14px 18px;font-weight:700;color:#444;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.5px;">Date</th>
                                <th style="padding:14px 18px;font-weight:700;color:#444;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.5px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests as $req)
                            @php
                                $urgencyColors = ['critical'=>'#dc3545','urgent'=>'#f59e0b','normal'=>'#3b82f6'];
                                $statusColors = ['pending'=>'#f59e0b','matched'=>'#3b82f6','fulfilled'=>'#22c55e','cancelled'=>'#6b7280'];
                                $statusLabels = ['pending'=>'Pending','matched'=>'Matched','fulfilled'=>'Fulfilled','cancelled'=>'Cancelled'];
                            @endphp
                            <tr style="transition:background 0.2s;{{ $req->status === 'pending' ? 'background:#fefce8;' : '' }}"
                                onmouseover="this.style.background='#f8f9ff'" onmouseout="this.style.background='{{ $req->status === 'pending' ? '#fefce8' : 'transparent' }}'">
                                <td style="padding:12px 18px;font-weight:600;color:#999;">{{ $loop->iteration }}</td>
                                <td style="padding:12px 18px;">
                                    <div style="font-weight:600;color:#333;">{{ $req->patient_name }}</div>
                                    <small style="color:#999;font-size:0.75rem;">
                                        <i class="bi bi-telephone me-1"></i>{{ $req->contact_phone }}
                                        @if($req->user)<br><i class="bi bi-person me-1"></i>{{ $req->user->email }}@endif
                                    </small>
                                </td>
                                <td style="padding:12px 18px;">
                                    <span style="display:inline-flex;align-items:center;justify-content:center;width:42px;height:42px;border-radius:50%;background:linear-gradient(135deg,#dc3545,#e35e6f);color:#fff;font-weight:800;font-size:0.85rem;box-shadow:0 3px 10px rgba(220,53,69,0.25);">
                                        {{ $req->blood_group }}
                                    </span>
                                </td>
                                <td style="padding:12px 18px;">
                                    <div style="font-weight:500;color:#555;">{{ $req->location }}</div>
                                    @if($req->hospital)
                                    <small style="color:#999;font-size:0.75rem;"><i class="bi bi-building me-1"></i>{{ $req->hospital }}</small>
                                    @endif
                                </td>
                                <td style="padding:12px 18px;">
                                    <span style="padding:3px 10px;border-radius:50px;font-size:0.72rem;font-weight:600;background:{{ $urgencyColors[$req->urgency] }}15;color:{{ $urgencyColors[$req->urgency] }};border:1px solid {{ $urgencyColors[$req->urgency] }}30;">
                                        {{ ucfirst($req->urgency) }}
                                    </span>
                                </td>
                                <td style="padding:12px 18px;">
                                    <span style="padding:4px 12px;border-radius:50px;font-size:0.72rem;font-weight:700;background:{{ $statusColors[$req->status] }}15;color:{{ $statusColors[$req->status] }};border:1px solid {{ $statusColors[$req->status] }}30;display:inline-flex;align-items:center;gap:5px;">
                                        <i class="bi bi-circle-fill" style="font-size:6px;"></i> {{ $statusLabels[$req->status] }}
                                    </span>
                                    @if($req->matched_donors_count > 0)
                                    <div style="margin-top:4px;font-size:0.7rem;color:#3b82f6;">
                                        <i class="bi bi-people"></i> {{ $req->matched_donors_count }} match
                                    </div>
                                    @endif
                                </td>
                                <td style="padding:12px 18px;color:#999;font-size:0.78rem;white-space:nowrap;">
                                    {{ \Carbon\Carbon::parse($req->created_at)->timezone('Asia/Dhaka')->format('d M Y') }}
                                    <br><small>{{ \Carbon\Carbon::parse($req->created_at)->diffForHumans() }}</small>
                                </td>
                                <td style="padding:12px 18px;">
                                    <div style="display:flex;gap:4px;flex-wrap:nowrap;">
                                        <a href="{{ url('/admin/blood-requests/'.$req->id) }}" class="btn btn-sm" style="border-radius:8px;background:#667eea15;color:#667eea;border:1px solid #667eea30;font-size:0.72rem;font-weight:600;padding:4px 10px;"
                                           onmouseover="this.style.background='#667eea';this.style.color='#fff'" onmouseout="this.style.background='#667eea15';this.style.color='#667eea'">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        @if($req->status !== 'fulfilled' && $req->status !== 'cancelled')
                                        <form action="{{ url('/admin/blood-requests/fulfilled/'.$req->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm" style="border-radius:8px;background:#22c55e15;color:#22c55e;border:1px solid #22c55e30;font-size:0.72rem;font-weight:600;padding:4px 10px;"
                                                    onclick="return confirm('Mark this request as fulfilled?')"
                                                    onmouseover="this.style.background='#22c55e';this.style.color='#fff'" onmouseout="this.style.background='#22c55e15';this.style.color='#22c55e'">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        </form>
                                        @endif
                                        <form action="{{ url('/admin/blood-requests/delete/'.$req->id) }}" method="POST" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm" style="border-radius:8px;background:#dc354515;color:#dc3545;border:1px solid #dc354530;font-size:0.72rem;font-weight:600;padding:4px 10px;"
                                                    onclick="return confirm('Delete this request?')"
                                                    onmouseover="this.style.background='#dc3545';this.style.color='#fff'" onmouseout="this.style.background='#dc354515';this.style.color='#dc3545'">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5" style="color:#999;">
                                    <i class="bi bi-inbox" style="font-size:2.5rem;display:block;margin-bottom:8px;"></i>
                                    <span style="font-weight:500;">No blood requests yet</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($requests->hasPages())
                <div style="padding:12px 22px;border-top:1px solid #f0f0f5;">
                    {{ $requests->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
