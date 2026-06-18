@extends('backend.app')

@section('content')

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show ad-alert ad-alert-success" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color: #1e293b;">
            <i class="bi bi-envelope me-2" style="color: #6366f1;"></i>Contact Messages
        </h4>
        <p class="text-muted mb-0" style="font-size: 13px;">
            <i class="bi bi-house-door me-1"></i> Dashboard / <span class="fw-medium" style="color: #6366f1;">Contacts</span>
            <span class="badge ms-2" style="background: rgba(99,102,241,0.1); color: #6366f1; font-size: 11px; font-weight: 600;">
                <i class="bi bi-chat-dots me-1"></i> {{ $contacts->count() }} Messages
            </span>
        </p>
    </div>
    <div>
        <span class="badge px-3 py-2" style="background: linear-gradient(135deg, #6366f1, #8b5cf6); font-size: 12px; font-weight: 500;">
            <i class="bi bi-inbox me-1"></i> Inquiries
        </span>
    </div>
</div>

<div class="ad-panel">
    <div class="ad-panel-header">
        <h5><i class="bi bi-chat-dots me-2" style="color: #6366f1;"></i>All Messages</h5>
    </div>
    <div class="ad-panel-body p-0">
        <div class="ad-table-responsive">
            <table class="ad-table">
                <thead>
                    <tr>
                        <th style="width:50px;">#</th>
                        <th style="width:160px;">Name</th>
                        <th style="width:200px;">Email</th>
                        <th>Message</th>
                        <th style="width:120px;">Date</th>
                        <th style="width:80px;">Time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contacts as $contact)
                    <tr>
                        <td class="text-muted fw-bold">{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="ad-contact-avatar">{{ strtoupper(substr($contact->name, 0, 1)) }}</div>
                                <span class="fw-medium" style="color: #1e293b;">{{ $contact->name }}</span>
                            </div>
                        </td>
                        <td>
                            <a href="mailto:{{ $contact->email }}" class="ad-contact-email" style="color: #6366f1;">{{ $contact->email }}</a>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span class="ad-msg-preview">{{ \Illuminate\Support\Str::limit($contact->message, 60) }}</span>
                                <button class="ad-action-btn ad-action-view" data-bs-toggle="modal" data-bs-target="#messageModal{{ $contact->id }}" title="View full message">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </td>
                        <td>
                            <div class="ad-date-stack">
                                <span class="ad-date-day">{{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('d M Y') }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="ad-time-badge">{{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('h:i A') }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="ad-empty-state">
                                <i class="bi bi-inbox"></i>
                                <h6>No Messages Yet</h6>
                                <p class="text-muted">Customer inquiries will appear here once submitted</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Message Modals -->
@foreach($contacts as $contact)
<div class="modal fade" id="messageModal{{ $contact->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content ad-modal-content">
            <div class="ad-modal-header" style="background: linear-gradient(135deg,#6366f1,#8b5cf6); color: #fff;">
                <h5 class="ad-modal-title" style="color: #fff;">
                    <i class="bi bi-chat-dots me-2"></i> Message from {{ $contact->name }}
                </h5>
                <button class="ad-modal-close ad-modal-close-white" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="ad-modal-body">
                <div class="ad-message-meta mb-3">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <div class="d-flex align-items-center gap-2">
                            <div class="ad-contact-avatar ad-avatar-lg">{{ strtoupper(substr($contact->name, 0, 1)) }}</div>
                            <div>
                                <div class="fw-bold" style="color: #1e293b;">{{ $contact->name }}</div>
                                <a href="mailto:{{ $contact->email }}" style="color: #6366f1; font-size: 12px;">{{ $contact->email }}</a>
                            </div>
                        </div>
                        <div class="ms-auto text-muted small">
                            <i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('d M Y h:i A') }}
                        </div>
                    </div>
                </div>
                <hr style="border-color: #f1f5f9;">
                <div class="ad-message-body">
                    <p style="color: #334155; line-height: 1.7; font-size: 14px; white-space: pre-wrap;">{{ $contact->message }}</p>
                </div>
            </div>
            <div class="ad-modal-footer">
                <button type="button" class="ad-btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle me-1"></i> Close</button>
                <a href="mailto:{{ $contact->email }}" class="ad-btn-primary" style="text-decoration: none;">
                    <i class="bi bi-reply me-1"></i> Reply
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
.ad-alert { border-radius: 12px; border: none; padding: 14px 18px; font-size: 13px; font-weight: 500; margin-bottom: 20px; }
.ad-alert-success { background: rgba(16,185,129,0.08); color: #10b981; }
.ad-panel { background: rgba(255,255,255,0.88); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-radius: 14px; border: 1px solid rgba(233,238,243,0.8); overflow: hidden; transition: box-shadow 0.3s; }
.ad-panel:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.04); background: rgba(255,255,255,0.95); }
.ad-panel-header { padding: 16px 20px; border-bottom: 1px solid #f1f5f9; }
.ad-panel-header h5 { font-size: 14px; font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; }
.ad-panel-body { padding: 0; }
.ad-table-responsive { overflow-x: auto; }
.ad-table { width: 100%; border-collapse: collapse; }
.ad-table th { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: #94a3b8; padding: 12px 16px; border-bottom: 1px solid #f1f5f9; text-align: left; white-space: nowrap; background: #fafbfc; }
.ad-table td { padding: 12px 16px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; font-size: 13px; color: #334155; }
.ad-table tbody tr { transition: background 0.2s; }
.ad-table tbody tr:hover { background: rgba(99,102,241,0.02); }
.ad-table tbody tr:last-child td { border-bottom: none; }
.ad-contact-avatar { width: 32px; height: 32px; border-radius: 8px; background: linear-gradient(135deg,#6366f1,#8b5cf6); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; flex-shrink: 0; }
.ad-avatar-lg { width: 44px; height: 44px; font-size: 16px; border-radius: 10px; }
.ad-contact-email { font-size: 12px; text-decoration: none; }
.ad-contact-email:hover { text-decoration: underline; }
.ad-msg-preview { font-size: 12px; color: #64748b; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }
.ad-action-btn { width: 32px; height: 32px; border-radius: 8px; border: none; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; font-size: 13px; transition: all 0.2s; flex-shrink: 0; }
.ad-action-view { background: rgba(99,102,241,0.08); color: #6366f1; }
.ad-action-view:hover { background: rgba(99,102,241,0.15); transform: translateY(-1px); }
.ad-date-stack { display: flex; flex-direction: column; gap: 2px; }
.ad-date-day { font-size: 11px; font-weight: 600; color: #475569; }
.ad-time-badge { display: inline-block; padding: 2px 8px; font-size: 10px; font-weight: 600; background: #f1f5f9; color: #64748b; border-radius: 4px; }
.ad-empty-state { text-align: center; padding: 30px; }
.ad-empty-state i { font-size: 40px; color: #cbd5e1; display: block; margin-bottom: 12px; }
.ad-empty-state h6 { font-size: 15px; font-weight: 700; color: #1e293b; margin-bottom: 4px; }
.ad-empty-state p { font-size: 12px; }
.ad-modal-content { border: none; border-radius: 20px; box-shadow: 0 25px 80px rgba(0,0,0,0.15); overflow: hidden; background: rgba(255,255,255,0.7); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); }
.ad-modal-header { display: flex; justify-content: space-between; align-items: center; padding: 18px 28px; }
.ad-modal-title { font-size: 15px; font-weight: 700; margin: 0; }
.ad-modal-close { width: 36px; height: 36px; border-radius: 10px; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 13px; }
.ad-modal-close-white { background: rgba(255,255,255,0.2); color: #fff; }
.ad-modal-close-white:hover { background: rgba(255,255,255,0.35); transform: rotate(90deg); }
.ad-modal-body { padding: 24px 28px; }
.ad-message-body p { margin: 0; }
.ad-modal-footer { display: flex; justify-content: flex-end; gap: 10px; padding: 18px 28px; border-top: 1px solid rgba(241,245,249,0.5); }
.ad-btn-secondary { padding: 9px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; border: 1px solid rgba(233,238,243,0.5); cursor: pointer; transition: all 0.2s; background: rgba(255,255,255,0.5); backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px); color: #64748b; display: inline-flex; align-items: center; gap: 6px; }
.ad-btn-secondary:hover { background: rgba(248,250,252,0.8); border-color: #cbd5e1; }
.ad-btn-primary { padding: 9px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; gap: 6px; background: linear-gradient(135deg,#6366f1,#8b5cf6); color: #fff; box-shadow: 0 4px 12px rgba(99,102,241,0.2); }
.ad-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(99,102,241,0.3); }
@media (max-width: 768px) { .ad-table th, .ad-table td { white-space: nowrap; font-size: 12px; padding: 10px 12px; } }
</style>

@endsection