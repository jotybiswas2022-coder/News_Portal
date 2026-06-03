@extends('backend.app')

@section('content')
@php
$bloodColors = [
    'A+' => '#dc3545', 'A-' => '#e35e6f',
    'B+' => '#0d6efd', 'B-' => '#5a9bf5',
    'AB+'=> '#6f42c1', 'AB-'=> '#9b72cf',
    'O+' => '#198754', 'O-' => '#4caf7d',
];
$divBg = ['Dhaka'=>'#667eea','Chattogram'=>'#f093fb','Khulna'=>'#4facfe','Rajshahi'=>'#43e97b','Barishal'=>'#fa709a','Sylhet'=>'#a18cd1','Rangpur'=>'#f6d365','Mymensingh'=>'#f5b042'];
@endphp

<div class="container-fluid py-3 py-md-4">

    {{-- Header --}}
    <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;margin-bottom:20px;gap:12px;">
        <div>
            <h4 style="margin:0;font-weight:800;font-size:1.5rem;background:linear-gradient(135deg,#e35e6f,#dc3545);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                <i class="bi bi-people-fill me-2" style="-webkit-text-fill-color:#e35e6f;"></i>Donor List
            </h4>
            <div style="margin-top:6px;display:inline-flex;align-items:center;gap:6px;background:linear-gradient(135deg, rgba(220,53,69,0.08), rgba(227,94,111,0.05));padding:6px 16px;border-radius:50px;border:1px solid rgba(220,53,69,0.12);">
                <i class="bi bi-droplet" style="color:#dc3545;font-size:0.8rem;"></i>
                <span style="color:#dc3545;font-weight:600;font-size:0.8rem;">{{ $donorsCount }} donors registered</span>
            </div>
        </div>
        <div style="display:flex;gap:8px;flex-wrap:wrap;">
            <a href="/admin/donor_list/export/pdf" style="display:inline-flex;align-items:center;gap:6px;padding:10px 18px;border-radius:50px;background:linear-gradient(135deg,#22c55e,#16a34a);color:#fff;text-decoration:none;font-weight:600;font-size:0.82rem;box-shadow:0 4px 16px rgba(34,197,94,0.3);transition:all 0.3s ease;"
               onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 24px rgba(34,197,94,0.4)'"
               onmouseout="this.style.transform='';this.style.boxShadow='0 4px 16px rgba(34,197,94,0.3)'"
               title="Export as PDF">
                <i class="bi bi-filetype-pdf"></i> PDF
            </a>
            <a href="/admin/donor_list/export/csv" style="display:inline-flex;align-items:center;gap:6px;padding:10px 18px;border-radius:50px;background:linear-gradient(135deg,#4facfe,#667eea);color:#fff;text-decoration:none;font-weight:600;font-size:0.82rem;box-shadow:0 4px 16px rgba(79,172,254,0.3);transition:all 0.3s ease;"
               onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 24px rgba(79,172,254,0.4)'"
               onmouseout="this.style.transform='';this.style.boxShadow='0 4px 16px rgba(79,172,254,0.3)'"
               title="Export as Excel (CSV)">
                <i class="bi bi-file-earmark-spreadsheet"></i> Excel
            </a>
            <a href="/admin/donor_list/create/" style="display:inline-flex;align-items:center;gap:6px;padding:10px 24px;border-radius:50px;background:linear-gradient(135deg,#e35e6f,#dc3545);color:#fff;text-decoration:none;font-weight:600;font-size:0.85rem;box-shadow:0 4px 16px rgba(220,53,69,0.3);transition:all 0.3s ease;"
               onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 24px rgba(220,53,69,0.4)'"
               onmouseout="this.style.transform='';this.style.boxShadow='0 4px 16px rgba(220,53,69,0.3)'">
                <i class="bi bi-plus-circle"></i> Add New Donor
            </a>
        </div>
    </div>

    {{-- Search with AJAX autocomplete --}}
    <div style="background:#fff;border-radius:20px;box-shadow:0 4px 24px rgba(0,0,0,0.06);margin-bottom:20px;border:1px solid rgba(0,0,0,0.04);padding:18px 22px;">
        <form id="searchForm" action="{{ url('admin/donor_list') }}" method="GET">
            <div style="display:flex;flex-wrap:wrap;gap:10px;align-items:flex-end;">
                <div style="flex:1 1 200px;min-width:150px;position:relative;">
                    <label style="display:block;font-size:0.78rem;font-weight:600;color:#666;margin-bottom:4px;">
                        <i class="bi bi-search me-1" style="color:#667eea;"></i>Search by Name
                    </label>
                    <input type="text" name="search_name" id="searchName" autocomplete="off"
                           placeholder="Type to search live..." value="{{ request('search_name') }}"
                           style="width:100%;padding:9px 14px;border-radius:12px;border:1.5px solid #e8e8f0;font-size:0.85rem;outline:none;transition:all 0.3s;background:#fafafe;box-sizing:border-box;"
                           onfocus="this.style.borderColor='#667eea';this.style.boxShadow='0 0 0 3px rgba(102,126,234,0.1)'"
                           onblur="this.style.borderColor='#e8e8f0';this.style.boxShadow='none'">
                    {{-- Autocomplete dropdown --}}
                    <div id="autocompleteDropdown"
                         style="display:none;position:absolute;top:100%;left:0;right:0;z-index:1000;background:#fff;border-radius:14px;border:1.5px solid #e8e8f0;box-shadow:0 12px 48px rgba(0,0,0,0.12);margin-top:4px;overflow:hidden;max-height:380px;overflow-y:auto;"></div>
                </div>
                <div style="flex:1 1 160px;min-width:140px;">
                    <label style="display:block;font-size:0.78rem;font-weight:600;color:#666;margin-bottom:4px;">
                        <i class="bi bi-geo-alt me-1" style="color:#f093fb;"></i>Division
                    </label>
                    <select name="search_division" id="searchDivision"
                            style="width:100%;padding:9px 14px;border-radius:12px;border:1.5px solid #e8e8f0;font-size:0.85rem;outline:none;transition:all 0.3s;background:#fafafe;cursor:pointer;"
                            onfocus="this.style.borderColor='#f093fb';this.style.boxShadow='0 0 0 3px rgba(240,147,251,0.1)'"
                            onblur="this.style.borderColor='#e8e8f0';this.style.boxShadow='none'">
                        <option value="">All Divisions</option>
                        @foreach(['Dhaka','Chattogram','Khulna','Rajshahi','Barishal','Sylhet','Rangpur','Mymensingh'] as $division)
                            <option value="{{ $division }}" {{ request('search_division') == $division ? 'selected' : '' }}>{{ $division }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" id="searchSubmitBtn"
                            style="padding:9px 18px;border-radius:12px;border:none;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;font-size:0.85rem;cursor:pointer;transition:all 0.3s;box-shadow:0 4px 12px rgba(102,126,234,0.25);"
                            onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 6px 20px rgba(102,126,234,0.35)'"
                            onmouseout="this.style.transform='';this.style.boxShadow='0 4px 12px rgba(102,126,234,0.25)'">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
                <div>
                    <a href="{{ url('admin/donor_list') }}"
                       style="display:inline-block;padding:9px 18px;border-radius:12px;border:1.5px solid #e8e8f0;background:#fff;color:#888;font-size:0.85rem;text-decoration:none;transition:all 0.3s;"
                       onmouseover="this.style.borderColor='#ccc';this.style.color='#555'"
                       onmouseout="this.style.borderColor='#e8e8f0';this.style.color='#888'">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                </div>
                <div id="searchIndicator" style="display:none;align-items:center;gap:6px;padding:0 4px;">
                    <span style="width:16px;height:16px;border:2px solid #667eea;border-top-color:transparent;border-radius:50%;animation:ajaxSpin 0.6s linear infinite;display:inline-block;"></span>
                    <span style="font-size:0.78rem;color:#999;">Searching...</span>
                </div>
            </div>
        </form>
    </div>

    {{-- Donor Rows (flex-based, responsive) --}}
    <div id="donorTableWrap" style="background:#fff;border-radius:20px;box-shadow:0 4px 24px rgba(0,0,0,0.06);overflow:auto;border:1px solid rgba(0,0,0,0.04);">
        {{-- Header --}}
        <div style="display:flex;align-items:center;padding:12px 22px;background:linear-gradient(135deg,#f8f9ff,#f0f1fe);border-bottom:1px solid #f0f0f5;gap:10px;min-width:700px;">
            <div style="width:36px;flex-shrink:0;font-size:0.78rem;font-weight:600;color:#888;text-align:center;">#</div>
            <div style="flex:2;font-size:0.78rem;font-weight:600;color:#888;">Donor</div>
            <div style="flex:1.3;font-size:0.78rem;font-weight:600;color:#888;">Phone</div>
            <div style="flex:0.7;font-size:0.78rem;font-weight:600;color:#888;text-align:center;">Blood</div>
            <div style="flex:1;font-size:0.78rem;font-weight:600;color:#888;">Division</div>
            <div style="flex:1;font-size:0.78rem;font-weight:600;color:#888;">Last Donation</div>
            <div style="width:80px;flex-shrink:0;text-align:right;font-size:0.78rem;font-weight:600;color:#888;">Action</div>
        </div>

        @forelse($donors as $index => $donor)
        @php $bgColor = $bloodColors[$donor->blood] ?? '#dc3545'; @endphp
        <div style="display:flex;align-items:center;padding:10px 22px;border-bottom:1px solid #f0f0f5;gap:10px;min-width:700px;transition:background 0.15s;"
             onmouseover="this.style.background='rgba(220,53,69,0.02)'"
             onmouseout="this.style.background='transparent'">

            <div style="width:36px;flex-shrink:0;font-size:0.82rem;color:#bbb;font-weight:500;text-align:center;">{{ $index + 1 }}</div>

            <div style="flex:2;overflow:hidden;">
                <span style="font-weight:600;font-size:0.88rem;color:#222;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $donor->name ?? 'N/A' }}</span>
            </div>

            <div style="flex:1.3;overflow:hidden;">
                <span style="font-size:0.82rem;color:#888;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $donor->number ?? 'N/A' }}</span>
            </div>

            <div style="flex:0.7;text-align:center;flex-shrink:0;">
                <span style="display:inline-flex;align-items:center;gap:4px;padding:3px 12px;border-radius:50px;font-size:0.78rem;font-weight:700;color:#fff;background:{{ $bgColor }};box-shadow:0 3px 10px {{ $bgColor }}44;">
                    <i class="bi bi-droplet" style="font-size:0.65rem;"></i>{{ $donor->blood ?? 'N/A' }}
                </span>
            </div>

            <div style="flex:1;overflow:hidden;">
                @php $dColor = $divBg[$donor->division] ?? '#667eea'; @endphp
                <span style="font-size:0.82rem;color:#666;display:flex;align-items:center;gap:5px;">
                    <span style="width:6px;height:6px;border-radius:2px;background:{{ $dColor }};display:inline-block;flex-shrink:0;"></span>
                    <span style="display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $donor->division ?? 'N/A' }}</span>
                </span>
            </div>

            <div style="flex:1;overflow:hidden;">
                <span style="font-size:0.82rem;color:#999;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ optional($donor->last_donated)->format('d M Y') ?? 'N/A' }}</span>
            </div>

            <div style="width:80px;flex-shrink:0;display:flex;gap:4px;justify-content:flex-end;">
                <button data-bs-toggle="modal" data-bs-target="#editModal{{ $donor->id }}"
                        style="width:34px;height:34px;border-radius:10px;border:none;background:#f0f1fe;color:#667eea;cursor:pointer;transition:all 0.2s;display:flex;align-items:center;justify-content:center;font-size:0.85rem;"
                        onmouseover="this.style.background='#667eea';this.style.color='#fff'"
                        onmouseout="this.style.background='#f0f1fe';this.style.color='#667eea'"
                        title="Edit">
                    <i class="bi bi-pencil"></i>
                </button>
                <form action="{{ url('admin/donor_list/delete/'.$donor->id) }}" method="POST" class="d-inline delete-form" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="delete-btn"
                            style="width:34px;height:34px;border-radius:10px;border:none;background:#fef0f0;color:#dc3545;cursor:pointer;transition:all 0.2s;display:inline-flex;align-items:center;justify-content:center;font-size:0.85rem;"
                            onmouseover="this.style.background='#dc3545';this.style.color='#fff'"
                            onmouseout="this.style.background='#fef0f0';this.style.color='#dc3545'"
                            title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>

        {{-- Edit Modal --}}
        <div class="modal fade" id="editModal{{ $donor->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="background:#fff;border-radius:20px;border:none;box-shadow:0 24px 80px rgba(0,0,0,0.25);overflow:hidden;">
                    <form action="{{ url('admin/donor_list/update/'.$donor->id) }}" method="POST">
                        @csrf
                        <div style="background:linear-gradient(135deg,#e35e6f,#dc3545);padding:16px 22px;display:flex;align-items:center;justify-content:space-between;">
                            <h5 style="margin:0;color:#fff;font-weight:600;font-size:0.95rem;">
                                <i class="bi bi-pencil-square me-2"></i>Edit Donor
                            </h5>
                            <button type="button" style="background:none;border:none;color:#fff;font-size:1.5rem;cursor:pointer;opacity:0.85;line-height:1;padding:0;display:flex;" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x-lg" style="font-size:0.9rem;"></i>
                            </button>
                        </div>
                        <div style="padding:20px 22px;">
                            <div style="margin-bottom:16px;">
                                <label style="display:block;font-size:0.78rem;font-weight:600;color:#555;margin-bottom:5px;">
                                    <i class="bi bi-person me-1" style="color:#667eea;"></i> Name
                                </label>
                                <input type="text" name="name" value="{{ $donor->name }}" required
                                       style="width:100%;padding:10px 14px;border-radius:12px;border:1.5px solid #e8e8f0;font-size:0.85rem;outline:none;transition:all 0.3s;background:#fafafe;"
                                       onfocus="this.style.borderColor='#667eea';this.style.boxShadow='0 0 0 3px rgba(102,126,234,0.12)'"
                                       onblur="this.style.borderColor='#e8e8f0';this.style.boxShadow='none'">
                            </div>
                            <div style="margin-bottom:16px;">
                                <label style="display:block;font-size:0.78rem;font-weight:600;color:#555;margin-bottom:5px;">
                                    <i class="bi bi-phone me-1" style="color:#f093fb;"></i> Phone
                                </label>
                                <input type="text" name="number" value="{{ $donor->number }}" required
                                       style="width:100%;padding:10px 14px;border-radius:12px;border:1.5px solid #e8e8f0;font-size:0.85rem;outline:none;transition:all 0.3s;background:#fafafe;"
                                       onfocus="this.style.borderColor='#f093fb';this.style.boxShadow='0 0 0 3px rgba(240,147,251,0.12)'"
                                       onblur="this.style.borderColor='#e8e8f0';this.style.boxShadow='none'">
                            </div>
                            <div style="display:flex;gap:12px;margin-bottom:16px;flex-wrap:wrap;">
                                <div style="flex:1;min-width:120px;">
                                    <label style="display:block;font-size:0.78rem;font-weight:600;color:#555;margin-bottom:5px;">
                                        <i class="bi bi-droplet me-1" style="color:#dc3545;"></i> Blood Group
                                    </label>
                                    <select name="blood" required
                                            style="width:100%;padding:10px 14px;border-radius:12px;border:1.5px solid #e8e8f0;font-size:0.85rem;outline:none;transition:all 0.3s;background:#fafafe;"
                                            onfocus="this.style.borderColor='#dc3545';this.style.boxShadow='0 0 0 3px rgba(220,53,69,0.12)'"
                                            onblur="this.style.borderColor='#e8e8f0';this.style.boxShadow='none'">
                                        @foreach(['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $group)
                                            <option value="{{ $group }}" {{ $donor->blood == $group ? 'selected' : '' }}>{{ $group }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="flex:1;min-width:120px;">
                                    <label style="display:block;font-size:0.78rem;font-weight:600;color:#555;margin-bottom:5px;">
                                        <i class="bi bi-geo-alt me-1" style="color:#4facfe;"></i> Division
                                    </label>
                                    <select name="division" required
                                            style="width:100%;padding:10px 14px;border-radius:12px;border:1.5px solid #e8e8f0;font-size:0.85rem;outline:none;transition:all 0.3s;background:#fafafe;"
                                            onfocus="this.style.borderColor='#4facfe';this.style.boxShadow='0 0 0 3px rgba(79,172,254,0.12)'"
                                            onblur="this.style.borderColor='#e8e8f0';this.style.boxShadow='none'">
                                        @foreach(['Dhaka','Chattogram','Khulna','Rajshahi','Barishal','Sylhet','Rangpur','Mymensingh'] as $div)
                                            <option value="{{ $div }}" {{ $donor->division == $div ? 'selected' : '' }}>{{ $div }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label style="display:block;font-size:0.78rem;font-weight:600;color:#555;margin-bottom:5px;">
                                    <i class="bi bi-calendar me-1" style="color:#43e97b;"></i> Last Donation Date
                                </label>
                                <input type="date" name="last_donated" value="{{ optional($donor->last_donated)->format('Y-m-d') }}"
                                       style="width:100%;padding:10px 14px;border-radius:12px;border:1.5px solid #e8e8f0;font-size:0.85rem;outline:none;transition:all 0.3s;background:#fafafe;"
                                       onfocus="this.style.borderColor='#43e97b';this.style.boxShadow='0 0 0 3px rgba(67,233,123,0.12)'"
                                       onblur="this.style.borderColor='#e8e8f0';this.style.boxShadow='none'">
                            </div>
                        </div>
                        <div style="padding:0 22px 20px;display:flex;gap:10px;justify-content:flex-end;">
                            <button type="button" style="padding:9px 24px;border-radius:50px;border:1.5px solid #e8e8f0;background:#fff;color:#888;font-size:0.85rem;font-weight:500;cursor:pointer;transition:all 0.2s;" data-bs-dismiss="modal"
                                    onmouseover="this.style.borderColor='#ccc';this.style.color='#555'"
                                    onmouseout="this.style.borderColor='#e8e8f0';this.style.color='#888'">Cancel</button>
                            <button type="submit"
                                    style="padding:9px 24px;border-radius:50px;border:none;background:linear-gradient(135deg,#e35e6f,#dc3545);color:#fff;font-size:0.85rem;font-weight:600;cursor:pointer;transition:all 0.3s;box-shadow:0 4px 14px rgba(220,53,69,0.3);display:inline-flex;align-items:center;gap:6px;"
                                    onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 6px 20px rgba(220,53,69,0.4)'"
                                    onmouseout="this.style.transform='';this.style.boxShadow='0 4px 14px rgba(220,53,69,0.3)'">
                                <i class="bi bi-check-lg"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @empty
        <div style="text-align:center;padding:60px 22px;">
            <i class="bi bi-person-plus" style="font-size:3rem;color:#ddd;display:block;margin-bottom:10px;"></i>
            <span style="font-weight:600;font-size:1rem;color:#999;display:block;">No donors found</span>
            <p style="margin:6px 0 0;font-size:0.85rem;color:#bbb;">Try adjusting your search or add a new donor.</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if ($donors->hasPages())
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-top:16px;padding:0 4px;">
        <div style="font-size:0.8rem;color:#999;">
            Showing <span style="font-weight:600;color:#555;">{{ $donors->firstItem() }}</span> to <span style="font-weight:600;color:#555;">{{ $donors->lastItem() }}</span> of <span style="font-weight:600;color:#555;">{{ $donors->total() }}</span> donors
        </div>
        <div style="display:flex;align-items:center;gap:6px;">
            {{-- Previous --}}
            @if ($donors->onFirstPage())
                <span style="padding:7px 16px;border-radius:10px;border:1px solid #e8e8f0;font-size:0.82rem;color:#ccc;background:#fafafe;cursor:not-allowed;display:inline-flex;align-items:center;gap:5px;">
                    <i class="bi bi-chevron-left" style="font-size:0.7rem;"></i> Previous
                </span>
            @else
                <a href="{{ $donors->previousPageUrl() }}"
                   style="padding:7px 16px;border-radius:10px;border:1px solid #e8e8f0;font-size:0.82rem;color:#666;background:#fff;text-decoration:none;transition:all 0.2s;display:inline-flex;align-items:center;gap:5px;"
                   onmouseover="this.style.borderColor='#667eea';this.style.color='#667eea'"
                   onmouseout="this.style.borderColor='#e8e8f0';this.style.color='#666'">
                    <i class="bi bi-chevron-left" style="font-size:0.7rem;"></i> Previous
                </a>
            @endif

            {{-- Page Numbers --}}
            @foreach ($donors->getUrlRange(max(1, $donors->currentPage() - 2), min($donors->lastPage(), $donors->currentPage() + 2)) as $page => $url)
                @if ($page == $donors->currentPage())
                    <span style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;font-size:0.82rem;font-weight:600;display:flex;align-items:center;justify-content:center;box-shadow:0 3px 10px rgba(102,126,234,0.2);">{{ $page }}</span>
                @else
                    <a href="{{ $url }}"
                       style="width:36px;height:36px;border-radius:10px;border:1px solid #e8e8f0;color:#666;font-size:0.82rem;text-decoration:none;display:flex;align-items:center;justify-content:center;transition:all 0.2s;background:#fff;"
                       onmouseover="this.style.borderColor='#667eea';this.style.color='#667eea'"
                       onmouseout="this.style.borderColor='#e8e8f0';this.style.color='#666'">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Next --}}
            @if ($donors->hasMorePages())
                <a href="{{ $donors->nextPageUrl() }}"
                   style="padding:7px 16px;border-radius:10px;border:1px solid #e8e8f0;font-size:0.82rem;color:#666;background:#fff;text-decoration:none;transition:all 0.2s;display:inline-flex;align-items:center;gap:5px;"
                   onmouseover="this.style.borderColor='#667eea';this.style.color='#667eea'"
                   onmouseout="this.style.borderColor='#e8e8f0';this.style.color='#666'">
                    Next <i class="bi bi-chevron-right" style="font-size:0.7rem;"></i>
                </a>
            @else
                <span style="padding:7px 16px;border-radius:10px;border:1px solid #e8e8f0;font-size:0.82rem;color:#ccc;background:#fafafe;cursor:not-allowed;display:inline-flex;align-items:center;gap:5px;">
                    Next <i class="bi bi-chevron-right" style="font-size:0.7rem;"></i>
                </span>
            @endif
        </div>
    </div>
    @endif

</div>

{{-- Scripts --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Top Scrollbar for donor table
    var tw = document.getElementById('donorTableWrap');
    if (tw) {
        var ts = document.createElement('div');
        ts.style.cssText = 'overflow-x:auto;overflow-y:hidden;height:10px;visibility:visible;margin-bottom:1px;';
        ts.innerHTML = '<div style="height:1px"></div>';
        tw.parentNode.insertBefore(ts, tw);
        var ti = ts.firstChild;
        function sw() { ti.style.width = tw.scrollWidth + 'px'; }
        sw();
        ts.addEventListener('scroll', function () { tw.scrollLeft = ts.scrollLeft; });
        tw.addEventListener('scroll', function () { ts.scrollLeft = tw.scrollLeft; });
        window.addEventListener('resize', sw);
        if (window.ResizeObserver) { new ResizeObserver(sw).observe(tw); }
    }

    // ===== AJAX LIVE SEARCH WITH AUTOCOMPLETE =====
    var searchInput = document.getElementById('searchName');
    var searchDivision = document.getElementById('searchDivision');
    var searchForm = document.getElementById('searchForm');
    var dropdown = document.getElementById('autocompleteDropdown');
    var indicator = document.getElementById('searchIndicator');
    var submitBtn = document.getElementById('searchSubmitBtn');
    var debounceTimer = null;
    var searchUrl = '{{ url('admin/donor_list/search/ajax') }}';

    function fetchSuggestions(query, division) {
        if (query.length < 1 && !division) {
            dropdown.style.display = 'none';
            return;
        }

        indicator.style.display = 'flex';

        var params = new URLSearchParams();
        if (query.length > 0) params.set('q', query);
        if (division) params.set('division', division);

        fetch(searchUrl + '?' + params.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(function (res) { return res.json(); })
        .then(function (data) {
            indicator.style.display = 'none';
            renderDropdown(data.donors, query);
        })
        .catch(function () {
            indicator.style.display = 'none';
        });
    }

    function renderDropdown(donors, query) {
        if (!donors || donors.length === 0) {
            dropdown.style.display = 'none';
            return;
        }

        var html = '';
        var bloodColors = {
            'A+': '#dc3545', 'A-': '#e35e6f',
            'B+': '#0d6efd', 'B-': '#5a9bf5',
            'AB+': '#6f42c1', 'AB-': '#9b72cf',
            'O+': '#198754', 'O-': '#4caf7d'
        };
        var divColors = {
            'Dhaka':'#667eea','Chattogram':'#f093fb','Khulna':'#4facfe',
            'Rajshahi':'#43e97b','Barishal':'#fa709a','Sylhet':'#a18cd1',
            'Rangpur':'#f6d365','Mymensingh':'#f5b042'
        };

        donors.forEach(function (d, i) {
            var bg = bloodColors[d.blood] || '#dc3545';
            var dv = divColors[d.division] || '#667eea';
            var statusHtml = d.eligible
                ? '<span style="color:#16a34a;font-weight:600;font-size:0.72rem;">\u2713 Eligible</span>'
                : '<span style="color:#dc2626;font-size:0.72rem;">\u2717 ' + d.status + '</span>';

            // Highlight matching text
            var nameHtml = d.name;
            if (query && query.length > 0) {
                var re = new RegExp('(' + query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + ')', 'gi');
                nameHtml = d.name.replace(re, '<strong style="color:#667eea;">$1</strong>');
            }

            html += '<div class="ac-item" data-name="' + d.name.replace(/"/g, '&quot;') + '" style="display:flex;align-items:center;gap:10px;padding:10px 16px;cursor:pointer;border-bottom:' + (i < donors.length - 1 ? '1px solid #f0f0f5' : 'none') + ';transition:background 0.15s;"'
                + ' onmouseover="this.style.background=\'#f8f9ff\'" onmouseout="this.style.background=\'transparent\'">'
                + '<div style="width:34px;height:34px;border-radius:10px;background:' + bg + ';color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.8rem;flex-shrink:0;">' + d.avatar + '</div>'
                + '<div style="flex:1;min-width:0;">'
                + '<div style="font-weight:600;font-size:0.85rem;color:#222;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">' + nameHtml + '</div>'
                + '<div style="display:flex;align-items:center;gap:8px;margin-top:2px;">'
                + '<span style="display:inline-flex;align-items:center;gap:3px;padding:1px 8px;border-radius:50px;font-size:0.68rem;font-weight:700;color:#fff;background:' + bg + ';"><i class="bi bi-droplet" style="font-size:0.55rem;"></i>' + d.blood + '</span>'
                + '<span style="font-size:0.72rem;color:#888;display:flex;align-items:center;gap:3px;"><span style="width:5px;height:5px;border-radius:2px;background:' + dv + ';display:inline-block;"></span>' + d.division + '</span>'
                + '<span style="font-size:0.72rem;color:#999;">' + (d.last_donated || 'N/A') + '</span>'
                + '</div></div>'
                + '<div style="text-align:right;flex-shrink:0;">' + statusHtml + '</div>'
                + '</div>';
        });

        dropdown.innerHTML = html;
        dropdown.style.display = 'block';

        // Click handler for autocomplete items
        dropdown.querySelectorAll('.ac-item').forEach(function (item) {
            item.addEventListener('click', function (e) {
                var name = this.getAttribute('data-name');
                searchInput.value = name;
                dropdown.style.display = 'none';
                // Submit the form
                searchForm.submit();
            });
        });
    }

    // Debounced input handler
    searchInput.addEventListener('input', function () {
        clearTimeout(debounceTimer);
        var val = this.value.trim();
        if (val.length === 0) {
            dropdown.style.display = 'none';
            return;
        }
        debounceTimer = setTimeout(function () {
            fetchSuggestions(val, searchDivision.value);
        }, 300);
    });

    // Division change also triggers autocomplete if there's a search term
    searchDivision.addEventListener('change', function () {
        var val = searchInput.value.trim();
        if (val.length > 0) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function () {
                fetchSuggestions(val, searchDivision.value);
            }, 200);
        }
    });

    // Close dropdown on click outside
    document.addEventListener('click', function (e) {
        if (!e.target.closest('#searchName') && !e.target.closest('#autocompleteDropdown')) {
            dropdown.style.display = 'none';
        }
    });

    // Close dropdown on Escape
    searchInput.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            dropdown.style.display = 'none';
        }
    });

    // ===== DELETE BUTTONS =====
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const form = this.closest('.delete-form');
            Swal.fire({
                title: 'Are you sure?',
                text: 'This donor will be deleted permanently!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: '<i class="bi bi-trash me-1"></i> Yes, delete it!',
                cancelButtonText: 'Cancel',
                buttonsStyling: true
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });

    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false
    });
    @endif
});
</script>

{{-- Top scrollbar custom styling --}}
<style>
#donorTableWrap + div::-webkit-scrollbar { height: 10px; background: #f1f1f1; border-radius: 5px; }
#donorTableWrap + div::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 5px; }
#donorTableWrap + div::-webkit-scrollbar-thumb:hover { background: #a0a0a0; }
#donorTableWrap + div { scrollbar-width: auto; scrollbar-color: #c1c1c1 #f1f1f1; }
@media (max-width: 575.98px) {
    #donorTableWrap + div { display: none; }
}

@keyframes ajaxSpin { to { transform: rotate(360deg); } }

/* Autocomplete scrollbar */
#autocompleteDropdown::-webkit-scrollbar { width: 6px; }
#autocompleteDropdown::-webkit-scrollbar-track { background: transparent; }
#autocompleteDropdown::-webkit-scrollbar-thumb { background: #ddd; border-radius: 3px; }
#autocompleteDropdown::-webkit-scrollbar-thumb:hover { background: #bbb; }
</style>
@endsection