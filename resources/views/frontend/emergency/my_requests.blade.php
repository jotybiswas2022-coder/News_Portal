@extends('frontend.app')

@section('skeleton')
    <div style="padding-top:72px;display:flex;align-items:flex-start;justify-content:center;padding:72px 20px 40px;min-height:60vh;">
        <div style="max-width:780px;width:100%;">
            <div style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.05);border-radius:24px;overflow:hidden;">
                <div style="padding:28px 32px;border-bottom:1px solid rgba(255,255,255,0.04);">
                    <div class="sk-block" style="width:200px;height:22px;margin:0 auto;"></div>
                </div>
                <div style="padding:24px 32px;">
                    @for($i=0;$i<3;$i++)
                    <div style="padding:16px 20px;border:1px solid rgba(255,255,255,0.04);border-radius:14px;margin-bottom:14px;">
                        <div class="sk-block" style="width:60%;height:18px;margin-bottom:10px;"></div>
                        <div class="sk-block" style="width:40%;height:14px;margin-bottom:8px;"></div>
                        <div class="sk-block" style="width:30%;height:14px;"></div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <div class="req-particles">
        <div class="particle" style="--x: 8%; --y: 15%; --size: 5px; --delay: 0s;"></div>
        <div class="particle" style="--x: 35%; --y: 55%; --size: 4px; --delay: 1.5s;"></div>
        <div class="particle" style="--x: 65%; --y: 30%; --size: 6px; --delay: 0.7s;"></div>
        <div class="particle" style="--x: 88%; --y: 70%; --size: 3px; --delay: 2s;"></div>
        <div class="particle" style="--x: 20%; --y: 80%; --size: 4px; --delay: 1s;"></div>
        <div class="particle" style="--x: 75%; --y: 88%; --size: 5px; --delay: 0.3s;"></div>
    </div>
    <div class="req-glow"></div>

    <section class="req-section">
        <div class="container">
            @if(session('success'))
                <div class="alert-custom" style="max-width:780px;margin:0 auto 24px;padding:14px 20px;background:linear-gradient(135deg,#dcfce7,#bbf7d0);border-left:4px solid #22c55e;border-radius:12px;color:#15803d;font-weight:600;font-size:14px;display:flex;align-items:center;gap:10px;animation:slideDown 0.4s cubic-bezier(0.4,0,0.2,1);position:relative;z-index:1;">
                    <i class="bi bi-check-circle-fill" style="font-size:18px;flex-shrink:0;"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="req-card" data-aos="fade-up">
                {{-- Header --}}
                <div class="req-card-header">
                    <div class="req-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div>
                        <h2>আমার অনুরোধসমূহ</h2>
                        <p>আপনার জরুরি রক্তের অনুরোধের তালিকা</p>
                    </div>
                    <a href="{{ url('/emergency-request') }}" class="req-new-btn">
                        <i class="bi bi-plus-lg"></i> নতুন অনুরোধ
                    </a>
                </div>

                {{-- Body --}}
                <div class="req-card-body">
                    @if($requests->isEmpty())
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <h4>কোনো অনুরোধ নেই</h4>
                            <p>আপনি এখনো কোনো জরুরি রক্তের অনুরোধ করেননি।</p>
                            <a href="{{ url('/emergency-request') }}" class="empty-btn">
                                <i class="bi bi-plus-circle"></i> প্রথম অনুরোধ করুন
                            </a>
                        </div>
                    @else
                        @foreach($requests as $req)
                            <div class="req-item">
                                <div class="req-item-left">
                                    @php
                                        $statusColors = ['pending'=>'#f59e0b','matched'=>'#3b82f6','fulfilled'=>'#22c55e','cancelled'=>'#6b7280'];
                                        $statusLabels = ['pending'=>'অপেক্ষমাণ','matched'=>'ডোনার ম্যাচ','fulfilled'=>'পূরণ হয়েছে','cancelled'=>'বাতিল'];
                                        $urgencyIcons = ['critical'=>'bi-exclamation-triangle-fill','urgent'=>'bi-clock-fill','normal'=>'bi-calendar-check'];
                                        $urgencyLabels = ['critical'=>'ক্রিটিক্যাল','urgent'=>'জরুরি','normal'=>'সাধারণ'];
                                    @endphp
                                    <div class="req-blood-badge">{{ $req->blood_group }}</div>
                                    <div class="req-info">
                                        <h4>{{ $req->patient_name }}</h4>
                                        <div class="req-meta">
                                            <span><i class="bi bi-geo-alt"></i> {{ $req->location }}</span>
                                            @if($req->hospital)<span><i class="bi bi-building"></i> {{ $req->hospital }}</span>@endif
                                        </div>
                                        <div class="req-meta">
                                            <span><i class="{{ $urgencyIcons[$req->urgency] }}"></i> {{ $urgencyLabels[$req->urgency] }}</span>
                                            <span><i class="bi bi-telephone"></i> {{ $req->contact_phone }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="req-item-right">
                                    <span class="req-status" style="background:{{ $statusColors[$req->status] }}15;color:{{ $statusColors[$req->status] }};border:1px solid {{ $statusColors[$req->status] }}30;">
                                        <i class="bi bi-circle-fill" style="font-size:7px;"></i> {{ $statusLabels[$req->status] }}
                                    </span>
                                    <span class="req-date">{{ \Carbon\Carbon::parse($req->created_at)->timezone('Asia/Dhaka')->format('d M Y, h:i A') }}</span>
                                    @if($req->matched_donors_count > 0)
                                        <span class="req-matched-badge"><i class="bi bi-people"></i> {{ $req->matched_donors_count }} জন ডোনার</span>
                                    @endif
                                    @if($req->status === 'pending' || $req->status === 'matched')
                                        <form action="{{ url('/emergency-request/cancel/'.$req->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('আপনি কি এই অনুরোধটি বাতিল করতে চান?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="req-cancel-link" style="background:none;border:none;cursor:pointer;font-family:inherit;font-size:11px;color:#f87171;display:flex;align-items:center;gap:4px;padding:0;">
                                                <i class="bi bi-x-circle"></i> বাতিল
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        {{-- Pagination --}}
                        <div style="margin-top:24px;">
                            {{ $requests->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800&display=swap');
        :root { --primary:#dc2626;--primary-light:#ef4444;--dark:#1a1a2e;--dark-2:#16213e;--dark-3:#0f3460;--radius:12px;--radius-lg:20px; }
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Inter','Noto Sans Bengali',sans-serif;background:linear-gradient(135deg,var(--dark),var(--dark-2),var(--dark-3));min-height:100vh;padding-top:72px}
        .req-particles{position:fixed;inset:0;overflow:hidden;pointer-events:none;z-index:0}
        .req-particles .particle{position:absolute;width:var(--size);height:var(--size);left:var(--x);top:var(--y);background:rgba(239,68,68,0.3);border-radius:50%;animation:float-particle 7s ease-in-out infinite;animation-delay:var(--delay)}
        @keyframes float-particle{0%,100%{transform:translate(0,0)scale(1);opacity:.3}25%{transform:translate(30px,-20px)scale(1.2);opacity:.6}50%{transform:translate(-20px,30px)scale(.8);opacity:.15}75%{transform:translate(20px,20px)scale(1.1);opacity:.45}}
        .req-glow{position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);width:600px;height:600px;background:radial-gradient(circle,rgba(220,38,38,0.08) 0%,transparent 70%);border-radius:50%;pointer-events:none;z-index:0;animation:glow-pulse 4s ease-in-out infinite}
        @keyframes glow-pulse{0%,100%{transform:translate(-50%,-50%)scale(1);opacity:.6}50%{transform:translate(-50%,-50%)scale(1.15);opacity:1}}
        @keyframes cardFadeIn{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:translateY(0)}}
        @keyframes slideDown{from{opacity:0;transform:translateY(-20px)scale(.95)}to{opacity:1;transform:translateY(0)scale(1)}}
        .req-section{padding:40px 0 60px;position:relative;z-index:1}
        .req-section .container{max-width:780px;margin:0 auto;padding:0 20px;width:100%}
        .req-card{background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:24px;overflow:hidden;backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);box-shadow:0 20px 60px rgba(0,0,0,0.3);animation:cardFadeIn .6s cubic-bezier(.4,0,.2,1)}
        .req-card-header{background:linear-gradient(135deg,rgba(220,38,38,0.12),rgba(185,28,28,0.06));padding:24px 28px;display:flex;align-items:center;gap:16px;border-bottom:1px solid rgba(255,255,255,0.06);flex-wrap:wrap}
        .req-icon{width:48px;height:48px;background:rgba(220,38,38,0.15);border:1px solid rgba(220,38,38,0.25);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:22px;color:#ef4444;flex-shrink:0}
        .req-card-header h2{font-size:18px;font-weight:800;color:#fff;margin:0}
        .req-card-header p{font-size:12px;color:rgba(255,255,255,0.4);margin:2px 0 0}
        .req-new-btn{margin-left:auto;padding:9px 18px;background:linear-gradient(135deg,#dc2626,#ef4444);color:#fff;border-radius:10px;font-size:13px;font-weight:700;text-decoration:none;display:inline-flex;align-items:center;gap:6px;transition:all .3s;box-shadow:0 3px 12px rgba(220,38,38,0.3)}
        .req-new-btn:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(220,38,38,0.4);color:#fff}
        .req-card-body{padding:24px 28px}
        .empty-state{text-align:center;padding:50px 20px}
        .empty-state i{font-size:48px;color:rgba(255,255,255,0.12);display:block;margin-bottom:14px}
        .empty-state h4{font-size:18px;font-weight:700;color:rgba(255,255,255,0.5);margin-bottom:6px}
        .empty-state p{font-size:13px;color:rgba(255,255,255,0.3);margin-bottom:20px}
        .empty-btn{padding:10px 22px;background:linear-gradient(135deg,#dc2626,#ef4444);color:#fff;border-radius:10px;font-size:13px;font-weight:700;text-decoration:none;display:inline-flex;align-items:center;gap:6px;transition:all .3s}
        .req-item{display:flex;justify-content:space-between;align-items:flex-start;gap:16px;padding:18px 20px;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);border-radius:16px;margin-bottom:14px;transition:all .3s;flex-wrap:wrap}
        .req-item:hover{background:rgba(255,255,255,0.05);border-color:rgba(220,38,38,0.15)}
        .req-item-left{display:flex;align-items:flex-start;gap:14px;flex:1;min-width:200px}
        .req-blood-badge{width:48px;height:48px;border-radius:50%;background:linear-gradient(135deg,#dc2626,#ef4444);display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:800;color:#fff;flex-shrink:0;box-shadow:0 3px 12px rgba(220,38,38,0.3)}
        .req-info h4{font-size:15px;font-weight:700;color:#f5f5f5;margin-bottom:4px}
        .req-meta{display:flex;gap:12px;flex-wrap:wrap;margin-top:4px}
        .req-meta span{font-size:12px;color:rgba(255,255,255,0.45);display:flex;align-items:center;gap:4px}
        .req-meta span i{font-size:11px;color:rgba(239,68,68,0.6)}
        .req-item-right{display:flex;flex-direction:column;align-items:flex-end;gap:6px;flex-shrink:0}
        .req-status{display:inline-flex;align-items:center;gap:5px;padding:4px 12px;border-radius:50px;font-size:11px;font-weight:700}
        .req-date{font-size:11px;color:rgba(255,255,255,0.3)}
        .req-matched-badge{font-size:11px;color:#60a5fa;display:flex;align-items:center;gap:4px}
        .req-cancel-link{font-size:11px;color:#f87171;text-decoration:none;display:flex;align-items:center;gap:4px;transition:all .2s}
        .req-cancel-link:hover{color:#ef4444}
        @media(max-width:767.98px){body{padding-top:60px}.req-card-header{padding:18px 20px}.req-card-body{padding:18px 20px}.req-item{padding:14px 16px}}
        @media(max-width:480px){body{padding-top:56px}.req-section .container{padding:0 14px}.req-card-header{flex-direction:column;text-align:center}.req-new-btn{margin-left:0;width:100%;justify-content:center}}
        .light-mode body{background:linear-gradient(135deg,#f8f9fa,#fff,#fef2f2)}
        .light-mode .req-card{background:rgba(255,255,255,0.9);border-color:rgba(0,0,0,0.08);box-shadow:0 20px 60px rgba(0,0,0,0.08)}
        .light-mode .req-card-header{border-bottom-color:rgba(0,0,0,0.06)}
        .light-mode .req-card-header h2{color:#1f2937}
        .light-mode .req-card-header p{color:rgba(0,0,0,0.4)}
        .light-mode .req-item{background:rgba(0,0,0,0.02);border-color:rgba(0,0,0,0.06)}
        .light-mode .req-item:hover{background:rgba(0,0,0,0.04);border-color:rgba(220,38,38,0.1)}
        .light-mode .req-info h4{color:#1f2937}
        .light-mode .req-meta span{color:rgba(0,0,0,0.45)}
        .light-mode .req-date{color:rgba(0,0,0,0.3)}
        .light-mode .empty-state h4{color:rgba(0,0,0,0.5)}
        .light-mode .empty-state p{color:rgba(0,0,0,0.3)}
        .light-mode .empty-state i{color:rgba(0,0,0,0.12)}
    </style>

@endsection
