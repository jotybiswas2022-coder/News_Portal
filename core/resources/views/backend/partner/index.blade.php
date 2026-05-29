@extends('backend.app')

@section('title', 'Partnership Applications — Admin')

@section('content')

@if (session('success'))
    <input type="hidden" id="sessionSuccess" value="{{ session('success') }}">
@endif

<div class="partner-page">

    {{-- Header --}}
    <div class="partner-header">
        <div class="partner-header-inner">
            <div>
                <h4 class="partner-header-title">Partnership Applications</h4>
                <p class="partner-header-sub">Review and manage partnership program applications</p>
            </div>
            <div class="partner-header-badge">
                <i class="bi bi-people-fill me-1"></i>
                {{ $partners->total() }} Applications
            </div>
        </div>
    </div>

    {{-- Stats Row --}}
    <div class="partner-stats">
        <div class="partner-stat-card">
            <span class="partner-stat-icon" style="background:rgba(245,158,11,0.1);color:#f59e0b">
                <i class="bi bi-clock"></i>
            </span>
            <div>
                <div class="partner-stat-num">{{ $partners->where('status', 'pending')->count() }}</div>
                <div class="partner-stat-label">Pending</div>
            </div>
        </div>
        <div class="partner-stat-card">
            <span class="partner-stat-icon" style="background:rgba(16,185,129,0.1);color:#10b981">
                <i class="bi bi-check-circle"></i>
            </span>
            <div>
                <div class="partner-stat-num">{{ $partners->where('status', 'approved')->count() }}</div>
                <div class="partner-stat-label">Approved</div>
            </div>
        </div>
        <div class="partner-stat-card">
            <span class="partner-stat-icon" style="background:rgba(239,68,68,0.1);color:#ef4444">
                <i class="bi bi-x-circle"></i>
            </span>
            <div>
                <div class="partner-stat-num">{{ $partners->where('status', 'rejected')->count() }}</div>
                <div class="partner-stat-label">Rejected</div>
            </div>
        </div>
    </div>

    {{-- Card with Table --}}
    <div class="partner-card-wrap">
        <div class="partner-card">
            <div class="table-scroll-wrap">
                <table class="partner-table">
                    <thead>
                        <tr>
                            <th style="width:50px;">#</th>
                            <th class="text-start"><i class="bi bi-person me-1"></i> Name</th>
                            <th><i class="bi bi-envelope me-1"></i> Email</th>
                            <th class="text-start"><i class="bi bi-globe me-1"></i> Website</th>
                            <th class="text-start"><i class="bi bi-chat-dots me-1"></i> Message</th>
                            <th><i class="bi bi-flag me-1"></i> Status</th>
                            <th style="width:110px;"><i class="bi bi-calendar me-1"></i> Date</th>
                            <th style="width:100px;"><i class="bi bi-gear me-1"></i> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($partners as $partner)
                            <tr>
                                <td class="idx">{{ $loop->iteration }}</td>
                                <td class="text-start fw-semibold">{{ $partner->name }}</td>
                                <td><span class="partner-email">{{ $partner->email }}</span></td>
                                <td class="text-start">
                                    @if($partner->website)
                                        <a href="{{ $partner->website }}" target="_blank" class="partner-website-link">
                                            <i class="bi bi-box-arrow-up-right me-1"></i> Visit
                                        </a>
                                    @else
                                        <span style="color:var(--psub)">—</span>
                                    @endif
                                </td>
                                <td class="text-start">
                                    @if($partner->message)
                                        <button class="btn-view-msg" data-bs-toggle="modal" data-bs-target="#msgModal{{ $partner->id }}">
                                            <i class="bi bi-eye me-1"></i> View
                                        </button>
                                    @else
                                        <span style="color:var(--psub)">—</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'pending' => ['bg' => 'rgba(245,158,11,0.1)', 'border' => 'rgba(245,158,11,0.2)', 'text' => '#f59e0b'],
                                            'approved' => ['bg' => 'rgba(16,185,129,0.1)', 'border' => 'rgba(16,185,129,0.2)', 'text' => '#10b981'],
                                            'rejected' => ['bg' => 'rgba(239,68,68,0.1)', 'border' => 'rgba(239,68,68,0.2)', 'text' => '#ef4444'],
                                        ];
                                        $sc = $statusColors[$partner->status] ?? $statusColors['pending'];
                                    @endphp
                                    <span class="partner-status-badge" style="background:{{ $sc['bg'] }};border-color:{{ $sc['border'] }};color:{{ $sc['text'] }}">
                                        <span class="partner-status-dot" style="background:{{ $sc['text'] }}"></span>
                                        {{ ucfirst($partner->status) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="date-badge">{{ \Carbon\Carbon::parse($partner->created_at)->timezone('Asia/Dhaka')->format('d M Y') }}</span>
                                    <span class="time-badge" style="display:block;margin-top:2px">{{ \Carbon\Carbon::parse($partner->created_at)->timezone('Asia/Dhaka')->format('h:i A') }}</span>
                                </td>
                                <td>
                                    <div class="partner-actions">
                                        {{-- Status Dropdown --}}
                                        <form method="POST" action="{{ route('admin.partners.status', $partner->id) }}" class="partner-status-form">
                                            @csrf
                                            <select name="status" class="partner-status-select" onchange="this.form.submit()" style="background:{{ $sc['bg'] }};border-color:{{ $sc['border'] }};color:{{ $sc['text'] }}">
                                                @foreach(['pending', 'approved', 'rejected'] as $s)
                                                    <option value="{{ $s }}" {{ $partner->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                                                @endforeach
                                            </select>
                                        </form>
                                        {{-- Delete --}}
                                        <form method="POST" action="{{ route('admin.partners.destroy', $partner->id) }}"
                                              class="delete-partner-form"
                                              data-name="{{ $partner->name }} ({{ $partner->email }})">
                                            @csrf @method('DELETE')
                                            <button type="button" class="partner-delete-btn delete-btn-trigger" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="empty-row">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox empty-icon"></i>
                                        <div class="empty-title">No Applications Found</div>
                                        <div class="empty-sub">Partnership applications will appear here once submitted.</div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($partners->hasPages())
            <div class="partner-pagination-wrap">
                <div class="partner-pagination-info">
                    Showing {{ $partners->firstItem() }}–{{ $partners->lastItem() }} of {{ $partners->total() }} applications
                </div>
                <div class="partner-pagination-links">
                    {{ $partners->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Message Modals --}}
    @forelse ($partners as $partner)
        @if($partner->message)
        <div class="modal fade" id="msgModal{{ $partner->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content partner-modal-content">
                    <div class="partner-modal-header">
                        <h5 class="partner-modal-title">
                            <i class="bi bi-chat-quote me-2"></i> Message from {{ $partner->name }}
                        </h5>
                        <button type="button" class="partner-modal-close" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
                    </div>
                    <div class="partner-modal-body">
                        <p>{{ $partner->message }}</p>
                    </div>
                    <div class="partner-modal-footer">
                        <button type="button" class="btn-partner-close" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @empty
    @endforelse
</div>

<style>
:root {
    --pbg: #0f172a;
    --prd: rgba(255,255,255,0.04);
    --ptext: #f1f5f9;
    --pmuted: #94a3b8;
    --psub: #64748b;
    --pborder: rgba(255,255,255,0.08);
    --pprimary: #60A5FA;
    --pprimary-dim: rgba(96,165,250,0.12);
    --phover: rgba(255,255,255,0.06);
    --pthead-bg: rgba(255,255,255,0.05);
}
.partner-page { padding: 24px 28px; height: 100%; }
.partner-header {
    background: var(--prd); border: 1px solid var(--pborder); border-radius: 14px;
    padding: 18px 22px; backdrop-filter: blur(8px); margin-bottom: 16px;
}
.partner-header-inner {
    display: flex; flex-wrap: wrap; justify-content: space-between;
    align-items: center; gap: 10px;
}
.partner-header-title { font-size: 18px; font-weight: 700; color: var(--ptext); margin: 0 0 2px 0; }
.partner-header-sub { font-size: 13px; color: var(--pmuted); margin: 0; }
.partner-header-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: var(--pprimary-dim); color: var(--pprimary);
    padding: 8px 16px; border-radius: 24px; font-size: 13px;
    font-weight: 600; border: 1px solid rgba(96,165,250,0.2);
}

/* Stats */
.partner-stats {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;
    margin-bottom: 16px;
}
.partner-stat-card {
    background: var(--prd); border: 1px solid var(--pborder);
    border-radius: 12px; padding: 14px 18px;
    display: flex; align-items: center; gap: 14px;
    backdrop-filter: blur(8px);
}
.partner-stat-icon {
    width: 40px; height: 40px; display: flex; align-items: center;
    justify-content: center; border-radius: 10px; font-size: 18px;
    flex-shrink: 0;
}
.partner-stat-num { font-size: 22px; font-weight: 700; color: var(--ptext); line-height: 1; }
.partner-stat-label { font-size: 12px; color: var(--pmuted); margin-top: 2px; }

.partner-card-wrap {
    border-radius: 14px; border: 1px solid var(--pborder);
    background: var(--prd); overflow: hidden; backdrop-filter: blur(8px);
}
.table-scroll-wrap { overflow-x: auto; }
.partner-table { width: 100%; border-collapse: collapse; font-size: 14px; }
.partner-table thead {
    background: var(--pthead-bg); position: sticky; top: 0; z-index: 5;
}
.partner-table th {
    padding: 14px 16px; text-align: center; font-weight: 600;
    font-size: 13px; color: var(--pmuted); text-transform: uppercase;
    letter-spacing: 0.4px; border-bottom: 1px solid var(--pborder);
}
.partner-table th i { color: var(--pprimary); }
.partner-table td {
    padding: 14px 16px; text-align: center; color: var(--ptext);
    border-bottom: 1px solid var(--pborder); vertical-align: middle;
}
.partner-table tbody tr { transition: background 0.18s ease; }
.partner-table tbody tr:hover { background: var(--phover); }
.partner-table tbody tr:last-child td { border-bottom: none; }
.idx { color: var(--psub) !important; font-weight: 600; }
.partner-email { color: var(--pmuted); font-size: 13px; }

.partner-website-link {
    color: var(--pprimary); font-size: 13px; text-decoration: none;
    display: inline-flex; align-items: center; gap: 2px; transition: color 0.2s;
}
.partner-website-link:hover { color: #93c5fd; text-decoration: underline; }

.btn-view-msg {
    background: transparent; border: 1px solid var(--pborder);
    color: var(--pprimary); padding: 6px 14px; border-radius: 8px;
    font-size: 13px; font-weight: 500; cursor: pointer; transition: all 0.2s ease;
}
.btn-view-msg:hover { background: var(--pprimary-dim); border-color: rgba(96,165,250,0.3); }

.partner-status-badge {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;
    border: 1px solid;
}
.partner-status-dot { width: 6px; height: 6px; border-radius: 50%; }

.date-badge, .time-badge {
    display: inline-block; background: rgba(255,255,255,0.06);
    color: var(--pmuted); border: 1px solid var(--pborder);
    padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500;
}

/* Actions */
.partner-actions {
    display: flex; align-items: center; gap: 6px; justify-content: center;
}
.partner-status-form { margin: 0; }
.partner-status-select {
    padding: 5px 28px 5px 10px;
    border-radius: 8px; font-size: 12px; font-weight: 600;
    background: rgba(245,158,11,0.1); border: 1px solid rgba(245,158,11,0.2);
    color: #f59e0b; cursor: pointer; transition: all 0.2s ease;
    font-family: inherit;
    appearance: none; -webkit-appearance: none; -moz-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 8px center;
    min-width: 90px;
}
.partner-status-select:hover { filter: brightness(1.2); }
.partner-status-select:focus { outline: none; }
.partner-status-select option { background: #1e293b; color: var(--ptext); }

.partner-delete-btn {
    width: 30px; height: 30px; display: flex; align-items: center;
    justify-content: center; background: rgba(239,68,68,0.1);
    border: 1px solid rgba(239,68,68,0.2); border-radius: 6px;
    color: #ef4444; cursor: pointer; transition: all 0.2s;
    font-size: 13px; padding: 0;
}
.partner-delete-btn:hover { background: rgba(239,68,68,0.2); }

/* Pagination */
.partner-pagination-wrap {
    display: flex; flex-wrap: wrap; justify-content: space-between;
    align-items: center; gap: 12px;
    padding: 14px 20px; border-top: 1px solid var(--pborder);
}
.partner-pagination-info { font-size: 13px; color: var(--pmuted); }
.partner-pagination-links nav > ul {
    display: flex; gap: 4px; list-style: none; margin: 0; padding: 0;
}
.partner-pagination-links nav > ul li span, .partner-pagination-links nav > ul li a {
    display: flex; align-items: center; justify-content: center;
    padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;
    background: rgba(255,255,255,0.04); border: 1px solid var(--pborder);
    color: var(--pmuted); text-decoration: none; transition: all 0.2s;
}
.partner-pagination-links nav > ul li.active span {
    background: var(--pprimary-dim); border-color: rgba(96,165,250,0.3);
    color: var(--pprimary);
}
.partner-pagination-links nav > ul li a:hover {
    background: var(--phover); color: var(--ptext);
}
.partner-pagination-links nav > ul li.disabled span {
    opacity: 0.4; cursor: default;
}

/* Modal */
.partner-modal-content {
    background: #1e293b; border: 1px solid rgba(255,255,255,0.1);
    border-radius: 16px; box-shadow: 0 25px 60px rgba(0,0,0,0.5); overflow: hidden;
}
.partner-modal-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 18px 24px;
    background: linear-gradient(135deg, rgba(96,165,250,0.15), rgba(96,165,250,0.05));
    border-bottom: 1px solid var(--pborder);
}
.partner-modal-title { font-size: 17px; font-weight: 600; color: var(--ptext); margin: 0; }
.partner-modal-title i { color: var(--pprimary); }
.partner-modal-close {
    background: none; border: none; color: var(--pmuted); font-size: 14px;
    cursor: pointer; padding: 6px; border-radius: 6px; transition: all 0.2s;
    width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;
}
.partner-modal-close:hover { background: rgba(255,255,255,0.1); color: var(--ptext); }
.partner-modal-body {
    padding: 24px; color: var(--ptext); font-size: 15px; line-height: 1.7;
}
.partner-modal-body p { margin: 0; color: #e2e8f0; }
.partner-modal-footer {
    padding: 14px 24px; border-top: 1px solid var(--pborder);
    display: flex; justify-content: flex-end;
}
.btn-partner-close {
    background: rgba(255,255,255,0.08); border: 1px solid var(--pborder);
    color: var(--pmuted); padding: 8px 24px; border-radius: 8px;
    font-size: 14px; font-weight: 500; cursor: pointer; transition: all 0.2s;
}
.btn-partner-close:hover { background: rgba(255,255,255,0.14); color: var(--ptext); }

.empty-row { text-align: center; padding: 60px 20px !important; }
.empty-state { display: flex; flex-direction: column; align-items: center; gap: 8px; }
.empty-icon { font-size: 40px; color: var(--psub); margin-bottom: 8px; display: block; }
.empty-title { font-weight: 600; font-size: 16px; color: var(--pmuted); }
.empty-sub { font-size: 13px; color: var(--psub); }

@media (max-width: 992px) {
    .partner-page { padding: 20px 22px; }
    .partner-table td, .partner-table th { padding: 12px 14px; font-size: 13px; }
    .partner-stats { grid-template-columns: repeat(3, 1fr); gap: 10px; }
}
@media (max-width: 768px) {
    .partner-page { padding: 16px; }
    .partner-table td, .partner-table th { padding: 10px 12px; font-size: 13px; }
    .partner-header { padding: 14px 16px; }
    .partner-header-title { font-size: 16px; }
    .partner-stats { grid-template-columns: 1fr; gap: 8px; }
    .partner-stat-card { padding: 12px 14px; }
    .partner-table th:nth-child(4), .partner-table td:nth-child(4) { display: none; } /* hide website */
    .partner-table th:nth-child(7), .partner-table td:nth-child(7) { display: none; } /* hide date */
    .partner-modal-body { padding: 18px; }
    .btn-view-msg { padding: 5px 10px; font-size: 12px; }
}
@media (max-width: 480px) {
    .partner-page { padding: 12px; }
    .partner-table td, .partner-table th { padding: 8px 8px; font-size: 12px; }
    .partner-header-inner { flex-direction: column; align-items: flex-start; gap: 8px; }
    .partner-header-badge { font-size: 12px; padding: 6px 12px; }
    .partner-actions { flex-direction: column; gap: 4px; }
    .partner-status-select { min-width: 80px; font-size: 11px; padding: 4px 22px 4px 8px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var sessionSuccess = document.getElementById('sessionSuccess');
    if (sessionSuccess) {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: sessionSuccess.value,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            background: '#1e293b',
            color: '#f1f5f9',
            iconColor: '#60A5FA',
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
    }

    // SweetAlert delete confirmation
    document.querySelectorAll('.delete-btn-trigger').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            var form = this.closest('form');
            var name = form.getAttribute('data-name') || 'this application';

            Swal.fire({
                title: 'Delete Application?',
                text: 'This will permanently remove the application from ' + name + '.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                background: '#1e293b',
                color: '#f1f5f9',
                iconColor: '#ef4444',
                reverseButtons: true,
                focusCancel: true,
                customClass: {
                    popup: 'swal-back-popup',
                    cancelButton: 'swal-back-cancel'
                }
            }).then(function(result) {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>

@endsection
