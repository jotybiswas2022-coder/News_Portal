@extends('frontend.forex.layouts.app')

@section('title', 'Source Codes — SMART BINARY ZONE')

@section('content')
<style>
.scd-bg-grid{background-image:linear-gradient(rgba(255,255,255,0.02) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.02) 1px,transparent 1px);background-size:48px 48px}
</style>
<!-- ==================== HERO ==================== -->
<section style="position:relative;min-height:45vh;display:flex;align-items:center;padding-top:6rem;padding-bottom:3rem;overflow:hidden">
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="scd-bg-grid" style="position:absolute;inset:0;opacity:0.03;pointer-events:none"></div>
    <div style="position:absolute;inset:0;background:linear-gradient(180deg,transparent 40%,rgba(0,95,231,0.02) 100%);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding-left:1rem;padding-right:1rem;text-align:center;width:100%">
        <div class="badge animate-fade-in-up" style="margin-bottom:1.5rem"><span class="badge-dot"></span> Developer Resources</div>
        <h1 style="font-family:'Bebas Neue','Oswald',sans-serif;font-size:clamp(2.5rem,6vw,4rem);font-weight:700;color:#EAEAEA;margin-bottom:1rem;animation:fadeInUp 0.6s ease 0.1s both;line-height:1.1">
            Source <span class="gradient-text">Codes</span>
        </h1>
        <p style="color:rgba(234,234,234,0.6);font-size:clamp(0.95rem,1.2vw,1.125rem);max-width:36rem;margin:0 auto 2rem;animation:fadeInUp 0.6s ease 0.2s both;line-height:1.6">
            Get access to the complete source code of our Expert Advisors — study, customize, and innovate.
        </p>
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:1rem;animation:fadeInUp 0.6s ease 0.3s both">
            <div style="display:flex;align-items:center;gap:0.5rem;padding:0.5rem 1.25rem;background:rgba(0,95,231,0.04);border:1px solid rgba(0,95,231,0.1);border-radius:9999px;font-size:0.8125rem;color:rgba(234,234,234,0.5);transition:all 0.3s">
                <svg style="width:1rem;height:1rem;color:#005fe7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                <span><strong style="color:#EAEAEA;font-weight:600">{{ $sourceCodes->total() }}</strong> Source Codes Available</span>
            </div>
            <a href="#src-grid" style="display:inline-flex;align-items:center;gap:0.375rem;padding:0.5rem 1.25rem;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);border-radius:9999px;font-size:0.8125rem;color:rgba(234,234,234,0.5);transition:all 0.3s" 
               onmouseover="this.style.borderColor='rgba(34,85,255,0.2)';this.style.color='#EAEAEA'" 
               onmouseout="this.style.borderColor='rgba(255,255,255,0.06)';this.style.color='rgba(234,234,234,0.5)'">
                Browse All
                <svg style="width:0.875rem;height:0.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- ==================== SOURCE CODES GRID ==================== -->
<section id="src-grid" style="padding-top:1rem;padding-bottom:6rem;position:relative;overflow:hidden">
    <div class="orb orb-brand" style="position:absolute;top:0;left:0;transform:translate(-50%,-50%);opacity:0.04;width:500px;height:500px;border-radius:50%;background:rgba(0,95,231,0.15);filter:blur(100px);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <style>
            .src-grid{display:grid;grid-template-columns:1fr;gap:1.25rem}
            @media (min-width:768px){.src-grid{grid-template-columns:repeat(2,1fr)}}
            @media (min-width:1024px){.src-grid{grid-template-columns:repeat(3,1fr)}}
            .src-meta-item{display:inline-flex;align-items:center;gap:4px;font-size:12px;color:rgba(234,234,234,0.4);padding:3px 8px;border-radius:6px;background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.04);transition:all 0.3s}
            .src-meta-item:hover{background:rgba(0,95,231,0.04);border-color:rgba(0,95,231,0.1);color:rgba(234,234,234,0.6)}
            /* Pagination styling */
            .src-pagination nav {display:flex;justify-content:center}
            .src-pagination .pagination {display:flex;gap:0.375rem;list-style:none;padding:0;margin:0;flex-wrap:wrap;justify-content:center}
            .src-pagination .page-item {margin:0}
            .src-pagination .page-link {display:flex;align-items:center;justify-content:center;min-width:2.25rem;height:2.25rem;padding:0 0.625rem;border-radius:0.625rem;background:rgba(5,5,15,0.6);border:1px solid rgba(255,255,255,0.06);color:rgba(234,234,234,0.5);font-size:0.8125rem;font-weight:500;transition:all 0.3s;text-decoration:none}
            .src-pagination .page-link:hover {border-color:rgba(34,85,255,0.2);color:#EAEAEA;background:rgba(0,95,231,0.06)}
            .src-pagination .page-item.active .page-link {background:linear-gradient(135deg,#005fe7,#2255ff);border-color:#005fe7;color:white;box-shadow:0 4px 15px rgba(34,85,255,0.2)}
            .src-pagination .page-item.disabled .page-link {opacity:0.3;cursor:default;pointer-events:none}
        </style>

        @if($sourceCodes->count() > 0)
        <!-- Results count bar -->
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:2rem;padding:0.75rem 1rem;background:rgba(5,5,15,0.2);border:1px solid rgba(255,255,255,0.04);border-radius:0.75rem">
            <span style="color:rgba(234,234,234,0.4);font-size:0.8125rem">
                Showing <strong style="color:rgba(234,234,234,0.6);font-weight:600">{{ $sourceCodes->firstItem() }}-{{ $sourceCodes->lastItem() }}</strong> of <strong style="color:rgba(234,234,234,0.6);font-weight:600">{{ $sourceCodes->total() }}</strong> Source Codes
            </span>
            <div style="display:flex;align-items:center;gap:0.5rem">
                <span style="color:rgba(234,234,234,0.3);font-size:0.75rem">Sort by:</span>
                <span style="display:inline-flex;align-items:center;gap:0.375rem;padding:0.375rem 0.75rem;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);border-radius:0.5rem;font-size:0.75rem;color:rgba(234,234,234,0.5);cursor:pointer;transition:all 0.3s"
                      onmouseover="this.style.borderColor='rgba(34,85,255,0.2)';this.style.color='#EAEAEA'"
                      onmouseout="this.style.borderColor='rgba(255,255,255,0.06)';this.style.color='rgba(234,234,234,0.5)'">
                    Latest
                    <svg style="width:0.75rem;height:0.75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </span>
            </div>
        </div>

        <div class="src-grid">
            @foreach($sourceCodes as $i => $sc)
            <div style="text-decoration:none;color:inherit;display:block;transition-delay:{{ $i * 0.06 }}s" class="reveal" onclick="var t=event.target; while(t){if(t.classList&&t.classList.contains('src-atc-btn'))return; t=t.parentNode} window.location.href='{{ route('forex.source-code-detail', $sc->slug) }}'">
                <div class="glass-card" style="height:100%;display:flex;flex-direction:column;overflow:hidden;cursor:pointer;position:relative;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)"
                     onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 20px 60px -12px rgba(0,0,0,0.5), 0 0 0 1px rgba(34,85,255,0.22)'"
                     onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                    {{-- Top accent line --}}
                    <div style="position:absolute;top:0;left:1.5rem;right:1.5rem;height:2px;background:linear-gradient(90deg,#005fe7,rgba(34,85,255,0.2),transparent);border-radius:0 0 2px 2px;opacity:0.5"></div>
                    {{-- Glow orb --}}
                    <div style="position:absolute;top:-3rem;right:-3rem;width:10rem;height:10rem;background:radial-gradient(circle,rgba(0,95,231,0.05),transparent 70%);pointer-events:none;border-radius:50%;transition:opacity 0.5s;opacity:0;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'"></div>
                    <div style="height:100%;display:flex;flex-direction:column;flex:1;padding:1.5rem;position:relative;z-index:2">
                        <!-- Icon / Image -->
                        <div style="width:3.5rem;height:3.5rem;border-radius:0.875rem;display:flex;align-items:center;justify-content:center;margin-bottom:1rem;transition:all 0.3s;background:linear-gradient(135deg, rgba(0,95,231,0.15), rgba(0,95,231,0.05));overflow:hidden;border:1px solid rgba(0,95,231,0.12)"
                             onmouseover="this.style.transform='scale(1.08)';this.style.background='linear-gradient(135deg, rgba(34,85,255,0.25), rgba(0,95,231,0.1))'"
                             onmouseout="this.style.transform='scale(1)';this.style.background='linear-gradient(135deg, rgba(0,95,231,0.15), rgba(0,95,231,0.05))'">
                            @if($sc->image)
                            <img src="{{ config('app.storage_url') }}{{ $sc->image }}" alt="{{ $sc->name }}" style="width:100%;height:100%;object-fit:cover;transition:transform 0.5s ease" onmouseover="this.style.transform='scale(1.12)'" onmouseout="this.style.transform='scale(1)'">
                            @else
                            <svg style="width:1.75rem;height:1.75rem;color:#005fe7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                            @endif
                        </div>

                        <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:6px">
                            <h3 style="color:#EAEAEA;font-weight:600;font-size:1.125rem;margin:0;transition:color 0.3s" onmouseover="this.style.color='#005fe7'" onmouseout="this.style.color='#EAEAEA'">{{ $sc->name }}</h3>
                            @if($sc->language)
                            <span style="padding:3px 10px;background:rgba(0,95,231,0.1);border:1px solid rgba(0,95,231,0.15);border-radius:50px;font-size:10px;font-weight:600;color:#005fe7;letter-spacing:0.02em">{{ strtoupper($sc->language) }}</span>
                            @endif
                            @if($sc->category)
                            <span style="padding:3px 10px;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:50px;font-size:10px;color:rgba(234,234,234,0.4)">{{ $sc->category }}</span>
                            @endif
                        </div>

                        <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;margin-bottom:1.25rem;line-height:1.625;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">{{ $sc->tagline ?? $sc->description }}</p>

                        <!-- Features / Details -->
                        <div style="display:flex;flex-direction:column;gap:0.5rem;margin-bottom:1.25rem">
                            @if($sc->platform)
                            <div class="src-meta-item" style="display:flex;align-items:center;gap:0.5rem;font-size:0.75rem;color:rgba(234,234,234,0.45);padding:4px 10px;">
                                <svg style="width:0.75rem;height:0.75rem;color:#005fe7;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                Platform: {{ $sc->platform }}
                            </div>
                            @endif
                            @if($sc->version)
                            <div class="src-meta-item" style="display:flex;align-items:center;gap:0.5rem;font-size:0.75rem;color:rgba(234,234,234,0.45);padding:4px 10px;">
                                <svg style="width:0.75rem;height:0.75rem;color:#005fe7;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                Version: {{ $sc->version }}
                            </div>
                            @endif
                            @if($sc->features && count($sc->features) > 0)
                            <div class="src-meta-item" style="display:flex;align-items:center;gap:0.5rem;font-size:0.75rem;color:rgba(234,234,234,0.45);padding:4px 10px;">
                                <svg style="width:0.75rem;height:0.75rem;color:#005fe7;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                {{ count($sc->features) }} Key Features
                            </div>
                            @endif
                        </div>

                        <div style="display:flex;align-items:center;justify-content:space-between;padding-top:1rem;margin-top:auto;border-top:1px solid rgba(255,255,255,0.06)">
                            <div style="display:flex;align-items:center;gap:8px">
                                <span style="background:linear-gradient(135deg,#005fe7,#ff2d78);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;font-weight:700;font-size:1.25rem">${{ number_format($sc->price, 0) }}</span>
                                @if($sc->old_price)
                                <span style="color:rgba(234,234,234,0.25);font-size:0.8125rem;text-decoration:line-through">${{ number_format($sc->old_price, 0) }}</span>
                                @endif
                            </div>
                            <div style="display:flex;align-items:center;gap:0.5rem">
                                <button class="src-atc-btn" onclick="event.stopPropagation();addToCart({name:'{{ $sc->name }} Source Code', price:{{ $sc->price }}, id:'src-{{ $sc->slug }}'})" style="display:inline-flex;align-items:center;gap:0.375rem;padding:0.5rem 0.875rem;background:linear-gradient(135deg,#005fe7,#2255ff);color:white;font-weight:600;font-size:0.75rem;border-radius:0.625rem;transition:all 0.3s;cursor:pointer;border:none;font-family:'DM Sans',sans-serif"
                                      onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 4px 15px rgba(34,85,255,0.25)'"
                                      onmouseout="this.style.transform='';this.style.boxShadow=''">
                                    <svg style="width:0.875rem;height:0.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                                    Add to Cart
                                </button>
                                <a href="{{ route('forex.source-code-detail', $sc->slug) }}" style="display:inline-flex;align-items:center;gap:3px;padding:6px 10px;background:rgba(0,95,231,0.08);border:1px solid rgba(0,95,231,0.15);color:#005fe7;border-radius:8px;font-size:11px;font-weight:500;transition:all 0.3s;text-decoration:none"
                                   onmouseover="this.style.background='rgba(0,95,231,0.18)';this.style.borderColor='#005fe7'"
                                   onmouseout="this.style.background='rgba(0,95,231,0.08)';this.style.borderColor='rgba(0,95,231,0.15)'"
                                   onclick="event.stopPropagation()">
                                    Details
                                    <svg style="width:12px;height:12px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($sourceCodes->hasPages())
        <div class="src-pagination" style="margin-top:3rem;display:flex;justify-content:center;align-items:center;flex-direction:column;gap:0.75rem">
            {{ $sourceCodes->links('pagination::bootstrap-5') }}
            <span style="color:rgba(234,234,234,0.2);font-size:0.75rem">Page {{ $sourceCodes->currentPage() }} of {{ $sourceCodes->lastPage() }}</span>
        </div>
        @endif
        @else
        <!-- Empty State -->
        <div style="text-align:center;padding:5rem 0;max-width:32rem;margin:0 auto">
            <div style="width:5.5rem;height:5.5rem;margin:0 auto 1.5rem;border-radius:1rem;background:rgba(0,95,231,0.04);border:1px solid rgba(0,95,231,0.08);display:flex;align-items:center;justify-content:center;backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px)">
                <svg style="width:2.5rem;height:2.5rem;color:#005fe7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
            </div>
            <h3 style="color:#EAEAEA;font-size:1.375rem;font-weight:600;margin:0 0 0.5rem 0;font-family:'Bebas Neue','Oswald',sans-serif">Coming Soon</h3>
            <p style="color:rgba(234,234,234,0.4);font-size:0.875rem;line-height:1.6;margin:0 0 1.5rem 0">Source code packages are being carefully prepared. Check back soon for developer resources to study, customize, and innovate.</p>
            <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:0.75rem">
                <a href="{{ route('forex.products') }}" style="display:inline-flex;align-items:center;gap:0.375rem;padding:0.625rem 1.25rem;background:linear-gradient(135deg,#005fe7,#2255ff);color:white;font-weight:600;font-size:0.8125rem;border-radius:0.625rem;transition:all 0.3s;text-decoration:none"
                   onmouseover="this.style.boxShadow='0 8px 25px rgba(34,85,255,0.2)';this.style.transform='translateY(-2px)'"
                   onmouseout="this.style.boxShadow='none';this.style.transform='none'">
                    Browse EAs
                    <svg style="width:0.875rem;height:0.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="{{ route('forex.contact-us') }}" style="display:inline-flex;align-items:center;gap:0.375rem;padding:0.625rem 1.25rem;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.08);color:rgba(234,234,234,0.6);font-weight:500;font-size:0.8125rem;border-radius:0.625rem;transition:all 0.3s;text-decoration:none"
                   onmouseover="this.style.borderColor='rgba(34,85,255,0.2)';this.style.color='#EAEAEA'"
                   onmouseout="this.style.borderColor='rgba(255,255,255,0.08)';this.style.color='rgba(234,234,234,0.6)'">
                    Contact Us
                </a>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- ==================== WHY BUY ==================== -->
<section style="padding-top:6rem;padding-bottom:6rem;background:#05050f;position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,0.03) 1px,transparent 1px);background-size:24px 24px;opacity:0.03;pointer-events:none"></div>
    <div style="position:absolute;inset:0;background:linear-gradient(180deg,transparent,rgba(0,95,231,0.015) 50%,transparent);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <div style="text-align:center;margin-bottom:3.5rem" class="reveal">
            <div class="badge"><span class="badge-dot"></span> Why Buy Source Codes</div>
            <h2 style="font-family:'Bebas Neue','Oswald',sans-serif;font-size:clamp(2rem,5vw,3.5rem);font-weight:700;line-height:1.1;color:#EAEAEA;margin-bottom:0">Unlock the <span class="gradient-text">Full Potential</span></h2>
            <p style="font-size:clamp(0.95rem,1.2vw,1.1rem);color:rgba(234,234,234,0.5);max-width:36rem;margin:0 auto;line-height:1.6;margin-top:1rem">Three powerful reasons to get the source code</p>
        </div>

        <div style="display:grid;grid-template-columns:1fr;gap:1.5rem" class="src-why-grid">
            <style>@media (min-width:768px){.src-why-grid{grid-template-columns:repeat(3,1fr)}}</style>
            <div class="glass-card reveal" style="padding:2rem 1.5rem;text-align:center;cursor:default;position:relative;overflow:hidden;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)"
                 onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 16px 48px -8px rgba(0,0,0,0.4), 0 0 0 1px rgba(34,85,255,0.15)'"
                 onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                    {{-- Top accent line --}}
                    <div style="position:absolute;top:0;left:1.5rem;right:1.5rem;height:2px;background:linear-gradient(90deg,#005fe7,rgba(0,95,231,0.2),transparent);border-radius:0 0 2px 2px;opacity:0.5"></div>
                    {{-- Glow orb --}}
                    <div style="position:absolute;top:-3rem;right:-3rem;width:10rem;height:10rem;background:radial-gradient(circle,rgba(0,95,231,0.06),transparent 70%);pointer-events:none;border-radius:50%;transition:opacity 0.5s;opacity:0;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'"></div>
                    <div style="position:relative;z-index:2">
                    <div style="width:4rem;height:4rem;margin:0 auto 1.25rem;border-radius:1rem;background:linear-gradient(135deg,rgba(34,85,255,0.15),rgba(0,95,231,0.05));display:flex;align-items:center;justify-content:center;transition:transform 0.3s;border:1px solid rgba(0,95,231,0.1)" onmouseover="this.style.transform='scale(1.1)';this.style.background='linear-gradient(135deg,rgba(34,85,255,0.25),rgba(0,95,231,0.1))'" onmouseout="this.style.transform='scale(1)';this.style.background='linear-gradient(135deg,rgba(34,85,255,0.15),rgba(0,95,231,0.05))'">
                        <svg style="width:2rem;height:2rem;color:#005fe7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253\"/></svg>
                    </div>
                    <h3 style="color:#EAEAEA;font-weight:600;font-size:1.125rem;margin-bottom:0.5rem;transition:color 0.3s" onmouseover="this.style.color='#005fe7'" onmouseout="this.style.color='#EAEAEA'">Learn</h3>
                    <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;line-height:1.625">Study the code to understand advanced MQL4/MQL5 programming techniques used by professional developers.</p>
                </div>
            </div>
            <div class="glass-card reveal" style="padding:2rem 1.5rem;text-align:center;cursor:default;position:relative;overflow:hidden;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)"
                 onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 16px 48px -8px rgba(0,0,0,0.4), 0 0 0 1px rgba(34,85,255,0.15)'"
                 onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                    {{-- Top accent line --}}
                    <div style="position:absolute;top:0;left:1.5rem;right:1.5rem;height:2px;background:linear-gradient(90deg,#005fe7,rgba(0,95,231,0.2),transparent);border-radius:0 0 2px 2px;opacity:0.5"></div>
                    {{-- Glow orb --}}
                    <div style="position:absolute;top:-3rem;right:-3rem;width:10rem;height:10rem;background:radial-gradient(circle,rgba(0,95,231,0.06),transparent 70%);pointer-events:none;border-radius:50%;transition:opacity 0.5s;opacity:0;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'"></div>
                    <div style="position:relative;z-index:2">
                    <div style="width:4rem;height:4rem;margin:0 auto 1.25rem;border-radius:1rem;background:linear-gradient(135deg,rgba(34,85,255,0.15),rgba(0,95,231,0.05));display:flex;align-items:center;justify-content:center;transition:transform 0.3s;border:1px solid rgba(0,95,231,0.1)" onmouseover="this.style.transform='scale(1.1)';this.style.background='linear-gradient(135deg,rgba(34,85,255,0.25),rgba(0,95,231,0.1))'" onmouseout="this.style.transform='scale(1)';this.style.background='linear-gradient(135deg,rgba(34,85,255,0.15),rgba(0,95,231,0.05))'">
                        <svg style="width:2rem;height:2rem;color:#005fe7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <h3 style="color:#EAEAEA;font-weight:600;font-size:1.125rem;margin-bottom:0.5rem;transition:color 0.3s" onmouseover="this.style.color='#005fe7'" onmouseout="this.style.color='#EAEAEA'">Customize</h3>
                    <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;line-height:1.625">Modify and adapt the code to fit your specific trading strategies and requirements.</p>
                </div>
            </div>
            <div class="glass-card reveal" style="padding:2rem 1.5rem;text-align:center;cursor:default;position:relative;overflow:hidden;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)"
                 onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 16px 48px -8px rgba(0,0,0,0.4), 0 0 0 1px rgba(34,85,255,0.15)'"
                 onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                    {{-- Top accent line --}}
                    <div style="position:absolute;top:0;left:1.5rem;right:1.5rem;height:2px;background:linear-gradient(90deg,#005fe7,rgba(0,95,231,0.2),transparent);border-radius:0 0 2px 2px;opacity:0.5"></div>
                    {{-- Glow orb --}}
                    <div style="position:absolute;top:-3rem;right:-3rem;width:10rem;height:10rem;background:radial-gradient(circle,rgba(0,95,231,0.06),transparent 70%);pointer-events:none;border-radius:50%;transition:opacity 0.5s;opacity:0;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'"></div>
                    <div style="position:relative;z-index:2">
                    <div style="width:4rem;height:4rem;margin:0 auto 1.25rem;border-radius:1rem;background:linear-gradient(135deg,rgba(34,85,255,0.15),rgba(0,95,231,0.05));display:flex;align-items:center;justify-content:center;transition:transform 0.3s;border:1px solid rgba(0,95,231,0.1)" onmouseover="this.style.transform='scale(1.1)';this.style.background='linear-gradient(135deg,rgba(34,85,255,0.25),rgba(0,95,231,0.1))'" onmouseout="this.style.transform='scale(1)';this.style.background='linear-gradient(135deg,rgba(34,85,255,0.15),rgba(0,95,231,0.05))'">
                        <svg style="width:2rem;height:2rem;color:#005fe7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z\"/></svg>
                    </div>
                    <h3 style="color:#EAEAEA;font-weight:600;font-size:1.125rem;margin-bottom:0.5rem;transition:color 0.3s" onmouseover="this.style.color='#005fe7'" onmouseout="this.style.color='#EAEAEA'">Resell</h3>
                    <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;line-height:1.625">Purchase a reseller license and sell modified versions under your own brand.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
