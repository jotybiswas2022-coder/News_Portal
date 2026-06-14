@extends('backend.app')

@section('title', 'Source Codes — Admin')

@section('content')

@if (session('success'))
    <input type="hidden" id="sessionSuccess" value="{{ session('success') }}">
@endif

<div class="sc-page">

    {{-- Header --}}
    <div class="sc-header">
        <div class="sc-header-inner">
            <div>
                <h4 class="sc-header-title">Source Codes</h4>
                <p class="sc-header-sub">Manage source code products available for purchase</p>
            </div>
            <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap">
                <div class="sc-header-badge">
                    <i class="bi bi-code-slash me-1"></i>
                    {{ $sourceCodes->total() }} Source Codes
                </div>
                <a href="{{ route('admin.source-codes.create') }}" class="sc-btn-add">
                    <i class="bi bi-plus-lg"></i>
                    Add Source Code
                </a>
            </div>
        </div>
    </div>

    {{-- Stats Bar (accurate counts via direct queries) --}}
    @php
        $scTotal   = \App\Models\SourceCode::count();
        $scActive  = \App\Models\SourceCode::where('available', true)->count();
        $scHidden  = \App\Models\SourceCode::where('available', false)->count();
        $scLangs   = \App\Models\SourceCode::whereNotNull('language')->distinct()->count('language');
        $scCats    = \App\Models\SourceCode::whereNotNull('category')->distinct()->count('category');
    @endphp
    <div class="sc-stats-bar">
        <div class="sc-stat-item">
            <span class="sc-stat-num">{{ $scTotal }}</span>
            <span class="sc-stat-label">Total</span>
        </div>
        <div class="sc-stat-item">
            <span class="sc-stat-num">{{ $scActive }}</span>
            <span class="sc-stat-label">Active</span>
        </div>
        <div class="sc-stat-item">
            <span class="sc-stat-num">{{ $scHidden }}</span>
            <span class="sc-stat-label">Hidden</span>
        </div>
        <div class="sc-stat-item">
            <span class="sc-stat-num">{{ $scLangs }}</span>
            <span class="sc-stat-label">Languages</span>
        </div>
        <div class="sc-stat-item">
            <span class="sc-stat-num">{{ $scCats }}</span>
            <span class="sc-stat-label">Categories</span>
        </div>
    </div>

    {{-- Card with Table --}}
    <div class="sc-card-wrap">
        <div class="sc-card">
            <div class="table-scroll-wrap">
                <table class="sc-table">
                    <thead>
                        <tr>
                            <th style="width:56px;">Image</th>
                            <th class="text-start"><i class="bi bi-tag me-1"></i> Name</th>
                            <th><i class="bi bi-link me-1"></i> Slug</th>
                            <th><i class="bi bi-currency-dollar me-1"></i> Price</th>
                            <th><i class="bi bi-code me-1"></i> Language</th>
                            <th><i class="bi bi-grid me-1"></i> Category</th>
                            <th><i class="bi bi-toggle-on me-1"></i> Status</th>
                            <th style="width:105px;"><i class="bi bi-calendar me-1"></i> Created</th>
                            <th style="width:92px;"><i class="bi bi-gear me-1"></i> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sourceCodes as $sc)
                            <tr>
                                <td>
                                    @if($sc->image)
                                        <img src="{{ config('app.storage_url') }}{{ $sc->image }}" alt="{{ $sc->name }}"
                                            style="width:40px;height:40px;border-radius:8px;object-fit:cover;border:1px solid var(--scborder)">
                                    @else
                                        <div style="width:40px;height:40px;border-radius:8px;background:linear-gradient(135deg,rgba(96,165,250,0.12),rgba(96,165,250,0.04));display:flex;align-items:center;justify-content:center;color:var(--scprimary);font-size:16px;border:1px solid var(--scborder)">
                                            <i class="bi bi-file-earmark-code"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-start">
                                    <div class="sc-name">{{ $sc->name }}</div>
                                    @if($sc->tagline)
                                        <div class="sc-tagline">{{ Str::limit($sc->tagline, 55) }}</div>
                                    @endif
                                </td>
                                <td><span class="sc-slug-badge">{{ $sc->slug }}</span></td>
                                <td>
                                    <span class="sc-price">${{ number_format($sc->price, 2) }}</span>
                                    @if($sc->old_price)
                                        <span class="sc-old-price">${{ number_format($sc->old_price, 2) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($sc->language)
                                        <span class="sc-lang-badge">{{ $sc->language }}</span>
                                    @else
                                        <span style="color:var(--scsub)">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($sc->category)
                                        <span class="sc-cat-badge">{{ $sc->category }}</span>
                                    @else
                                        <span style="color:var(--scsub)">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($sc->available)
                                        <span class="sc-status sc-status-active">Active</span>
                                    @else
                                        <span class="sc-status sc-status-hidden">Hidden</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="date-badge">{{ $sc->created_at->format('d M Y') }}</span>
                                </td>
                                <td>
                                    <div class="sc-actions">
                                        <a href="{{ route('admin.source-codes.edit', $sc->id) }}" class="sc-action-btn sc-edit-btn" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.source-codes.destroy', $sc->id) }}"
                                              class="delete-source-form"
                                              data-name="{{ $sc->name }}">
                                            @csrf @method('DELETE')
                                            <button type="button" class="sc-action-btn sc-delete-btn delete-btn-trigger" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="empty-row">
                                    <div class="empty-state">
                                        <i class="bi bi-file-earmark-code empty-icon"></i>
                                        <div class="empty-title">No Source Codes Found</div>
                                        <div class="empty-sub">Create your first source code product to get started.</div>
                                        <a href="{{ route('admin.source-codes.create') }}" class="sc-btn-add" style="margin-top:16px;display:inline-flex">
                                            <i class="bi bi-plus-lg"></i>
                                            Add Your First Source Code
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($sourceCodes->hasPages())
            <div class="sc-pagination-wrap">
                <div class="sc-pagination-info">
                    Showing {{ $sourceCodes->firstItem() }}–{{ $sourceCodes->lastItem() }} of {{ $sourceCodes->total() }} source codes
                </div>
                <div class="sc-pagination-links">
                    {{ $sourceCodes->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
:root {
    --scbg: #0f172a;
    --scrd: rgba(255,255,255,0.04);
    --sctext: #f1f5f9;
    --scmuted: #94a3b8;
    --scsub: #64748b;
    --scborder: rgba(255,255,255,0.08);
    --scprimary: #60A5FA;
    --scprimary-dim: rgba(96,165,250,0.12);
    --schover: rgba(255,255,255,0.06);
    --scthead-bg: rgba(255,255,255,0.05);
    --scgreen: #10b981;
    --scred: #ef4444;
}

.sc-page {
    padding: 24px 28px;
    height: 100%;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

/* ── Header ── */
.sc-header {
    background: var(--scrd);
    border: 1px solid var(--scborder);
    border-radius: 14px;
    padding: 18px 22px;
    backdrop-filter: blur(8px);
    margin-bottom: 12px;
}
.sc-header-inner {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
}
.sc-header-title {
    font-size: 18px;
    font-weight: 700;
    color: var(--sctext);
    margin: 0 0 2px 0;
}
.sc-header-sub {
    font-size: 13px;
    color: var(--scmuted);
    margin: 0;
}
.sc-header-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--scprimary-dim);
    color: var(--scprimary);
    padding: 8px 16px;
    border-radius: 24px;
    font-size: 13px;
    font-weight: 600;
    border: 1px solid rgba(96,165,250,0.2);
}
.sc-btn-add {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 18px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    background: linear-gradient(135deg, #2563EB, #1E40AF);
    color: #fff;
    border: none;
    text-decoration: none;
    transition: all 0.2s ease;
    cursor: pointer;
}
.sc-btn-add:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(37,99,235,0.3);
    color: #fff;
}

/* ── Stats Bar ── */
.sc-stats-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 14px;
    background: var(--scrd);
    border: 1px solid var(--scborder);
    border-radius: 12px;
    padding: 14px 20px;
    backdrop-filter: blur(8px);
}
.sc-stat-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 6px 16px 6px 12px;
    background: rgba(255,255,255,0.03);
    border: 1px solid var(--scborder);
    border-radius: 8px;
}
.sc-stat-num {
    font-size: 16px;
    font-weight: 700;
    color: var(--sctext);
    font-family: 'JetBrains Mono', monospace;
}
.sc-stat-label {
    font-size: 12px;
    color: var(--scsub);
    font-weight: 500;
}

/* ── Card ── */
.sc-card-wrap {
    border-radius: 14px;
    border: 1px solid var(--scborder);
    background: var(--scrd);
    overflow: hidden;
    backdrop-filter: blur(8px);
}
.table-scroll-wrap { overflow-x: auto; }
.sc-table { width: 100%; border-collapse: collapse; font-size: 14px; }
.sc-table thead { background: var(--scthead-bg); position: sticky; top: 0; z-index: 5; }
.sc-table th {
    padding: 14px 14px;
    text-align: center;
    font-weight: 600;
    font-size: 12px;
    color: var(--scmuted);
    text-transform: uppercase;
    letter-spacing: 0.4px;
    border-bottom: 1px solid var(--scborder);
}
.sc-table th i { color: var(--scprimary); font-size: 13px; }
.sc-table td {
    padding: 14px 14px;
    text-align: center;
    color: var(--sctext);
    border-bottom: 1px solid var(--scborder);
    vertical-align: middle;
}
.sc-table tbody tr { transition: background 0.15s ease; }
.sc-table tbody tr:hover { background: var(--schover); }
.sc-table tbody tr:last-child td { border-bottom: none; }

.sc-name {
    font-size: 14px;
    font-weight: 600;
    color: var(--sctext);
}
.sc-tagline {
    font-size: 11px;
    color: var(--scsub);
    margin-top: 2px;
    max-width: 180px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.sc-slug-badge {
    font-family: 'JetBrains Mono', 'SF Mono', monospace;
    font-size: 11px;
    color: var(--scprimary);
    background: rgba(96,165,250,0.08);
    padding: 3px 8px;
    border-radius: 4px;
    display: inline-block;
}

.sc-price {
    font-family: 'JetBrains Mono', monospace;
    font-weight: 700;
    font-size: 14px;
    color: var(--scgreen);
}
.sc-old-price {
    font-family: 'JetBrains Mono', monospace;
    font-size: 11px;
    color: var(--scsub);
    text-decoration: line-through;
    display: block;
    margin-top: 1px;
}

.sc-lang-badge {
    font-size: 11px;
    padding: 3px 10px;
    border-radius: 6px;
    background: rgba(250,204,21,0.1);
    color: #facc15;
    border: 1px solid rgba(250,204,21,0.2);
    display: inline-block;
    font-weight: 500;
}
.sc-cat-badge {
    font-size: 11px;
    padding: 3px 10px;
    border-radius: 6px;
    background: rgba(96,165,250,0.1);
    color: var(--scprimary);
    border: 1px solid rgba(96,165,250,0.2);
    display: inline-block;
    font-weight: 500;
}

/* ── Status ── */
.sc-status {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 12px;
    border-radius: 20px;
}
.sc-status::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
}
.sc-status-active {
    background: rgba(16,185,129,0.1);
    color: var(--scgreen);
}
.sc-status-active::before { background: var(--scgreen); }
.sc-status-hidden {
    background: rgba(239,68,68,0.1);
    color: var(--scred);
}
.sc-status-hidden::before { background: var(--scred); }

.date-badge {
    display: inline-block;
    background: rgba(255,255,255,0.06);
    color: var(--scmuted);
    border: 1px solid var(--scborder);
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
}

/* ── Actions ── */
.sc-actions { display: flex; align-items: center; gap: 6px; justify-content: center; }
.sc-action-btn {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    transition: all 0.2s;
    font-size: 13px;
    cursor: pointer;
    border: none;
    padding: 0;
    text-decoration: none;
}
.sc-edit-btn {
    background: var(--scprimary-dim);
    border: 1px solid rgba(96,165,250,0.15);
    color: var(--scprimary);
}
.sc-edit-btn:hover { background: rgba(96,165,250,0.2); color: #93c5fd; transform: translateY(-1px); }
.sc-delete-btn {
    background: rgba(239,68,68,0.1);
    border: 1px solid rgba(239,68,68,0.2);
    color: var(--scred);
}
.sc-delete-btn:hover { background: rgba(239,68,68,0.2); transform: translateY(-1px); }

/* ── Pagination ── */
.sc-pagination-wrap {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    padding: 14px 20px;
    border-top: 1px solid var(--scborder);
}
.sc-pagination-info { font-size: 13px; color: var(--scmuted); }
.sc-pagination-links nav > ul {
    display: flex;
    gap: 4px;
    list-style: none;
    margin: 0;
    padding: 0;
}
.sc-pagination-links nav > ul li span,
.sc-pagination-links nav > ul li a {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 500;
    background: rgba(255,255,255,0.04);
    border: 1px solid var(--scborder);
    color: var(--scmuted);
    text-decoration: none;
    transition: all 0.2s;
}
.sc-pagination-links nav > ul li.active span {
    background: var(--scprimary-dim);
    border-color: rgba(96,165,250,0.3);
    color: var(--scprimary);
}
.sc-pagination-links nav > ul li a:hover { background: var(--schover); color: var(--sctext); }
.sc-pagination-links nav > ul li.disabled span { opacity: 0.4; cursor: default; }

/* ── Empty State ── */
.empty-row { text-align: center; padding: 60px 20px !important; }
.empty-state { display: flex; flex-direction: column; align-items: center; gap: 8px; }
.empty-icon { font-size: 40px; color: var(--scsub); margin-bottom: 8px; display: block; }
.empty-title { font-weight: 600; font-size: 16px; color: var(--scmuted); }
.empty-sub { font-size: 13px; color: var(--scsub); }

/* ── Responsive ── */
@media (max-width: 992px) {
    .sc-page { padding: 20px 22px; }
    .sc-table td, .sc-table th { padding: 12px 12px; font-size: 13px; }
    .sc-stats-bar { gap: 6px; padding: 12px 16px; }
    .sc-stat-item { padding: 4px 12px 4px 10px; }
    .sc-stat-num { font-size: 14px; }
}
@media (max-width: 768px) {
    .sc-page { padding: 16px; }
    .sc-table td, .sc-table th { padding: 10px 10px; font-size: 13px; }
    .sc-header { padding: 14px 16px; }
    .sc-header-title { font-size: 16px; }
    .sc-stats-bar { display: none; }
    .sc-table th:nth-child(3), .sc-table td:nth-child(3) { display: none; }
    .sc-tagline { display: none; }
}
@media (max-width: 480px) {
    .sc-page { padding: 10px; }
    .sc-table td, .sc-table th { padding: 8px 5px; font-size: 11px; }
    .sc-header { padding: 12px 14px; border-radius: 12px; }
    .sc-header-inner { flex-direction: column; align-items: flex-start; gap: 8px; }
    .sc-header-title { font-size: 15px; }
    .sc-header-sub { font-size: 12px; }
    .sc-header-badge { font-size: 11px; padding: 5px 10px; }
    .sc-btn-add { font-size: 12px; padding: 6px 14px; }
    .sc-stats-bar { display: none; }
    .sc-name { font-size: 12px; }
    .sc-tagline { display: none; }
    .sc-table th:nth-child(3), .sc-table td:nth-child(3) { display: none; }
    .sc-table th:nth-child(6), .sc-table td:nth-child(6) { display: none; }
    .sc-slug-badge { font-size: 9px; padding: 2px 5px; }
    .sc-price { font-size: 12px; }
    .sc-old-price { font-size: 9px; }
    .sc-lang-badge, .sc-cat-badge { font-size: 9px; padding: 2px 7px; }
    .sc-action-btn { width: 28px; height: 28px; font-size: 11px; }
    .sc-pagination-wrap { flex-direction: column; align-items: center; gap: 8px; padding: 10px 14px; }
    .sc-pagination-info { font-size: 11px; }
    .date-badge { font-size: 10px; padding: 3px 8px; }
}
@media (max-width: 380px) {
    .sc-page { padding: 8px; }
    .sc-table td, .sc-table th { padding: 6px 4px; }
    .sc-table th:nth-child(8), .sc-table td:nth-child(8) { display: none; }
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
            var name = form.getAttribute('data-name') || 'this item';

            Swal.fire({
                title: 'Delete "' + name + '"?',
                text: 'This action cannot be undone.',
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
