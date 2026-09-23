@extends('backend.app')

@section('content')

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show ad-alert ad-alert-success" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show ad-alert ad-alert-danger" role="alert">
    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="ad-page-header">
    <div class="ad-page-header-main">
        <h4 class="ad-page-title">
            <i class="bi bi-envelope"></i> Contact Messages
        </h4>
        <p class="ad-page-sub">
            <i class="bi bi-house-door"></i> Dashboard / <span class="fw-medium">Contacts</span>
            <span class="ad-page-sep">·</span>
            <span class="ad-page-count">{{ $contacts->count() }} messages</span>
        </p>
    </div>
    <span class="ad-header-badge">
        <i class="bi bi-inbox"></i> Inquiries
    </span>
</div>

<div class="ad-panel">
    <div class="ad-panel-header">
        <div class="d-flex align-items-center gap-2">
            <span class="ad-panel-icon"><i class="bi bi-chat-dots"></i></span>
            <div>
                <h5 class="mb-0">All Messages</h5>
                <small class="text-muted" style="font-size: 12px;">Messages submitted through the contact form</small>
            </div>
        </div>
    </div>
    <div class="ad-panel-body p-0">
        <div class="ad-table-responsive">
            <table class="ad-table ad-contacts-table">
                <thead>
                    <tr>
                        <th style="width:52px;">#</th>
                        <th style="width:170px;">Name</th>
                        <th style="width:210px;">Email</th>
                        <th>Message</th>
                        <th style="width:140px;">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contacts as $contact)
                    <tr>
                        <td data-label="#" class="ad-td-index"><span class="ad-index-badge">{{ $loop->iteration }}</span></td>
                        <td data-label="Name">
                            <div class="d-flex align-items-center gap-2">
                                <div class="ad-contact-avatar">{{ strtoupper(substr($contact->name, 0, 1)) }}</div>
                                <span class="fw-medium ad-contact-name">{{ $contact->name }}</span>
                            </div>
                        </td>
                        <td data-label="Email">
                            <a href="mailto:{{ $contact->email }}" class="ad-contact-email">{{ $contact->email }}</a>
                        </td>
                        <td data-label="Message">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <span class="ad-msg-preview">{{ \Illuminate\Support\Str::limit($contact->message, 60) }}</span>
                                <button class="ad-action-btn ad-action-view" data-bs-toggle="modal" data-bs-target="#messageModal{{ $contact->id }}" title="View full message">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </td>
                        <td data-label="Date">
                            <span class="ad-date-day">{{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('d M Y') }}</span>
                            <span class="ad-time-badge ms-1">{{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('h:i A') }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="ad-empty-state">
                                <span class="ad-empty-icon"><i class="bi bi-inbox"></i></span>
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
            <div class="ad-modal-header">
                <h5 class="ad-modal-title">
                    <i class="bi bi-chat-dots me-2"></i> Message from {{ $contact->name }}
                </h5>
                <button class="ad-modal-close" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="ad-modal-body">
                <div class="ad-message-meta">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <div class="d-flex align-items-center gap-2">
                            <div class="ad-contact-avatar ad-avatar-lg">{{ strtoupper(substr($contact->name, 0, 1)) }}</div>
                            <div>
                                <div class="fw-bold ad-modal-name">{{ $contact->name }}</div>
                                <a href="mailto:{{ $contact->email }}" class="ad-contact-email">{{ $contact->email }}</a>
                            </div>
                        </div>
                        <div class="ms-auto text-muted small ad-modal-date">
                            <i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('d M Y h:i A') }}
                        </div>
                    </div>
                </div>
                <hr style="border-color: #f1f5f9;">
                <div class="ad-message-body">
                    <p class="ad-message-text">{{ $contact->message }}</p>
                </div>
            </div>
            <div class="ad-modal-footer">
                <button type="button" class="ad-btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle me-1"></i> Close</button>
                <a href="mailto:{{ $contact->email }}" class="ad-btn-primary">
                    <i class="bi bi-reply me-1"></i> Reply
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
    .ad-alert { border-radius: 12px; border: none; padding: 13px 18px; font-size: 13px; font-weight: 500; margin-bottom: 18px; }
    .ad-alert-success { background: rgba(16,185,129,0.08); color: #10b981; }
    .ad-alert-danger { background: rgba(239,68,68,0.08); color: #ef4444; }

    .ad-page-header { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 22px; }
    .ad-page-header-main { min-width: 0; }
    .ad-page-title { font-weight: 800; color: #1e293b; margin-bottom: 4px; font-size: 22px; }
    .ad-page-title i { color: #6366f1; margin-right: 10px; }
    .ad-page-sub { color: #94a3b8; font-size: 13px; margin: 0; display: flex; align-items: center; flex-wrap: wrap; gap: 6px; }
    .ad-page-sub i { font-size: 12px; color: #a8b4c8; }
    .ad-page-sub .fw-medium { color: #6366f1; }
    .ad-page-sep { color: #dbe2eb; }
    .ad-page-count { color: #475569; font-weight: 600; }
    .ad-header-badge { display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 10px; font-size: 12px; font-weight: 700; color: #6366f1; background: rgba(99,102,241,0.10); }

    .ad-panel { background: #fff; border: 1px solid var(--ad-border); border-radius: 16px; overflow: hidden; box-shadow: 0 2px 14px rgba(15,23,42,0.05); }
    .ad-panel-header { padding: 16px 20px; border-bottom: 1px solid #eef2f7; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; }
    .ad-panel-header h5 { font-size: 15px; font-weight: 700; color: #1e293b; }
    .ad-panel-icon { width: 38px; height: 38px; border-radius: 11px; display: flex; align-items: center; justify-content: center; background: rgba(99,102,241,0.10); color: #6366f1; font-size: 17px; flex-shrink: 0; }

    .ad-table-responsive { overflow-x: auto; }
    .ad-table { width: 100%; border-collapse: collapse; }
    .ad-table th { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: #94a3b8; padding: 13px 16px; border-bottom: 1px solid #eef2f7; text-align: left; white-space: nowrap; background: #fafbfc; }
    .ad-table td { padding: 12px 16px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; font-size: 13px; color: #334155; }
    .ad-table tbody tr { transition: background 0.15s; }
    .ad-table tbody tr:hover { background: #fafbff; }
    .ad-table tbody tr:last-child td { border-bottom: none; }

    .ad-index-badge { width: 26px; height: 26px; border-radius: 8px; background: #f1f5f9; color: #64748b; display: inline-flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; }
    .ad-contact-avatar { width: 34px; height: 34px; border-radius: 9px; background: linear-gradient(135deg,#6366f1,#8b5cf6); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; flex-shrink: 0; }
    .ad-avatar-lg { width: 46px; height: 46px; font-size: 17px; border-radius: 12px; }
    .ad-contact-name { color: #1e293b; }
    .ad-contact-email { font-size: 12.5px; color: #6366f1; text-decoration: none; }
    .ad-contact-email:hover { text-decoration: underline; }
    .ad-msg-preview { font-size: 12.5px; color: #64748b; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }
    .ad-action-btn { width: 34px; height: 34px; border-radius: 9px; border: none; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; font-size: 14px; transition: all 0.2s; flex-shrink: 0; }
    .ad-action-view { background: rgba(99,102,241,0.08); color: #6366f1; }
    .ad-action-view:hover { background: #6366f1; color: #fff; transform: translateY(-2px); }
    .ad-date-day { font-size: 11px; font-weight: 600; color: #475569; white-space: nowrap; }
    .ad-time-badge { display: inline-block; padding: 2px 8px; font-size: 10px; font-weight: 600; background: #f1f5f9; color: #64748b; border-radius: 5px; white-space: nowrap; }

    .ad-empty-state { text-align: center; padding: 26px; }
    .ad-empty-icon { width: 52px; height: 52px; border-radius: 14px; background: #f1f5f9; display: inline-flex; align-items: center; justify-content: center; font-size: 24px; color: #94a3b8; margin-bottom: 12px; }
    .ad-empty-state h6 { font-size: 15px; font-weight: 700; color: #1e293b; margin-bottom: 4px; }
    .ad-empty-state p { font-size: 12px; }

    /* Modal */
    .ad-modal-content { border: none; border-radius: 18px; box-shadow: 0 25px 80px rgba(0,0,0,0.18); overflow: hidden; background: #fff; border: 1px solid var(--ad-border); }
    .ad-modal-header { display: flex; justify-content: space-between; align-items: center; padding: 17px 24px; background: linear-gradient(135deg,#6366f1,#8b5cf6); }
    .ad-modal-title { font-size: 15px; font-weight: 700; color: #fff; margin: 0; }
    .ad-modal-close { width: 34px; height: 34px; border-radius: 10px; border: none; background: rgba(255,255,255,0.2); color: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s; font-size: 12px; }
    .ad-modal-close:hover { background: rgba(255,255,255,0.35); transform: rotate(90deg); }
    .ad-modal-body { padding: 24px; }
    .ad-message-meta { display: flex; flex-direction: column; }
    .ad-modal-name { color: #1e293b; }
    .ad-modal-date { font-size: 12px; }
    .ad-message-body p { margin: 0; }
    .ad-message-text { color: #334155; line-height: 1.7; font-size: 14px; white-space: pre-wrap; }
    .ad-modal-footer { display: flex; justify-content: flex-end; gap: 10px; padding: 16px 24px; border-top: 1px solid #f1f5f9; background: #fafbfc; }
    .ad-btn-secondary { padding: 9px 20px; border-radius: 9px; font-size: 13px; font-weight: 600; border: 1px solid var(--ad-border); cursor: pointer; transition: all 0.2s; background: #fff; color: #64748b; display: inline-flex; align-items: center; gap: 6px; }
    .ad-btn-secondary:hover { background: #f1f5f9; border-color: #cbd5e1; }
    .ad-btn-primary { display: inline-flex; align-items: center; gap: 6px; padding: 10px 22px; border-radius: 10px; font-size: 13px; font-weight: 600; background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff; border: none; cursor: pointer; box-shadow: 0 4px 12px rgba(99,102,241,0.25); transition: all 0.25s; text-decoration: none; }
    .ad-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(99,102,241,0.35); color: #fff; }

    /* ===== Mobile: table -> stacked cards ===== */
    @media (max-width: 767.98px) {
        .ad-table-responsive { overflow-x: visible; }
        .ad-page-header-main { flex: 1 1 100%; }

        .ad-contacts-table thead { display: none; }
        .ad-contacts-table, .ad-contacts-table tbody, .ad-contacts-table tr, .ad-contacts-table td { display: block; width: 100%; }
        .ad-contacts-table tbody tr {
            background: #fff; border: 1px solid #e6ebf2; border-radius: 14px;
            margin: 0 8px 12px; overflow: hidden;
            box-shadow: 0 2px 8px rgba(15,23,42,0.04);
        }
        .ad-contacts-table tbody tr:hover { background: #fff; }
        .ad-contacts-table tbody tr:last-child { margin-bottom: 8px; }
        .ad-contacts-table td {
            display: flex; align-items: center; justify-content: space-between; gap: 14px;
            padding: 10px 16px; border-bottom: 1px solid #f1f5f9; font-size: 13px;
        }
        .ad-contacts-table td::before {
            content: attr(data-label);
            font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px;
            color: #94a3b8; flex-shrink: 0;
        }
        .ad-contacts-table td[data-label="#"] { display: none; }
        .ad-contacts-table td[data-label="Name"] { justify-content: flex-start; padding: 14px 16px 10px; }
        .ad-contacts-table td[data-label="Name"]::before { display: none; }
        .ad-contacts-table td[data-label="Message"] { border-bottom: none; padding-bottom: 14px; }
        .ad-contact-name { max-width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    }

    @media (max-width: 575.98px) {
        .ad-page-title { font-size: 19px; }
        .ad-header-badge { width: 100%; justify-content: center; }
        .ad-panel-header { padding: 14px 16px; }
        .ad-contacts-table tbody tr { margin: 0 4px 10px; }
        .ad-contacts-table td { padding: 9px 14px; }
        .ad-modal-footer { flex-direction: column; }
        .ad-modal-footer .ad-btn-secondary, .ad-modal-footer .ad-btn-primary { width: 100%; justify-content: center; }
        .ad-modal-body { padding: 18px 16px; }
        .ad-modal-header { padding: 14px 16px; }
    }
</style>

@endsection