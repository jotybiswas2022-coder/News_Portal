@extends('frontend.forex.layouts.app')

@section('title', 'Expert Advisors — SMART BINARY ZONE')

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
        <div class="badge animate-fade-in-up" style="margin-bottom:1.5rem"><span class="badge-dot"></span> Premium Trading Tools</div>
        <h1 style="font-family:'Bebas Neue','Oswald',sans-serif;font-size:clamp(2.5rem,6vw,4rem);font-weight:700;color:#EAEAEA;margin-bottom:1rem;animation:fadeInUp 0.6s ease 0.1s both;line-height:1.1">
            Expert <span class="gradient-text">Advisors</span>
        </h1>
        <p style="color:rgba(234,234,234,0.6);font-size:clamp(0.95rem,1.2vw,1.125rem);max-width:36rem;margin:0 auto 2rem;animation:fadeInUp 0.6s ease 0.2s both;line-height:1.6">
            Discover our collection of professional-grade Expert Advisors — built for performance, backed by data.
        </p>
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:1rem;animation:fadeInUp 0.6s ease 0.3s both">
            <div style="display:flex;align-items:center;gap:0.5rem;padding:0.5rem 1.25rem;background:rgba(0,95,231,0.04);border:1px solid rgba(0,95,231,0.1);border-radius:9999px;font-size:0.8125rem;color:rgba(234,234,234,0.5);transition:all 0.3s">
                <svg style="width:1rem;height:1rem;color:#005fe7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span><strong style="color:#EAEAEA;font-weight:600">{{ $products->total() }}</strong> Products Available</span>
            </div>
            <a href="#products-grid" style="display:inline-flex;align-items:center;gap:0.375rem;padding:0.5rem 1.25rem;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);border-radius:9999px;font-size:0.8125rem;color:rgba(234,234,234,0.5);transition:all 0.3s" 
               onmouseover="this.style.borderColor='rgba(34,85,255,0.2)';this.style.color='#EAEAEA'" 
               onmouseout="this.style.borderColor='rgba(255,255,255,0.06)';this.style.color='rgba(234,234,234,0.5)'">
                Browse All
                <svg style="width:0.875rem;height:0.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- ==================== PRODUCTS GRID ==================== -->
<section id="products-grid" style="padding-top:1rem;padding-bottom:6rem;position:relative;overflow:hidden">
    <div class="orb orb-brand" style="position:absolute;top:0;left:0;transform:translate(-50%,-50%);opacity:0.04;width:500px;height:500px;border-radius:50%;background:rgba(34,85,255,0.15);filter:blur(100px);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <style>
            .prod-grid{display:grid;grid-template-columns:1fr;gap:1.5rem}
            @media (min-width:640px){.prod-grid{grid-template-columns:repeat(2,1fr)}}
            @media (min-width:1024px){.prod-grid{grid-template-columns:repeat(3,1fr)}}
            .prod-card-img{width:100%;height:220px;object-fit:cover;background:#1a1a1a;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden}
            .prod-card-price{font-size:1.375rem;font-weight:700;background:linear-gradient(135deg,#005fe7,#ff2d78);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
            .prod-card-badge{display:inline-flex;align-items:center;gap:4px;padding:4px 12px;border-radius:9999px;font-size:11px;font-weight:600;letter-spacing:0.05em;text-transform:uppercase;backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px)}
            .prod-meta-item{display:inline-flex;align-items:center;gap:4px;font-size:12px;color:rgba(234,234,234,0.4);padding:3px 8px;border-radius:6px;background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.04);transition:all 0.3s}
            .prod-meta-item:hover{background:rgba(0,95,231,0.04);border-color:rgba(0,95,231,0.1);color:rgba(234,234,234,0.6)}
            /* Pagination styling */
            .prod-pagination nav {display:flex;justify-content:center}
            .prod-pagination .pagination {display:flex;gap:0.375rem;list-style:none;padding:0;margin:0;flex-wrap:wrap;justify-content:center}
            .prod-pagination .page-item {margin:0}
            .prod-pagination .page-link {display:flex;align-items:center;justify-content:center;min-width:2.25rem;height:2.25rem;padding:0 0.625rem;border-radius:0.625rem;background:rgba(5,5,15,0.6);border:1px solid rgba(255,255,255,0.06);color:rgba(234,234,234,0.5);font-size:0.8125rem;font-weight:500;transition:all 0.3s;text-decoration:none}
            .prod-pagination .page-link:hover {border-color:rgba(34,85,255,0.2);color:#EAEAEA;background:rgba(0,95,231,0.06)}
            .prod-pagination .page-item.active .page-link {background:linear-gradient(135deg,#005fe7,#2255ff);border-color:#005fe7;color:white;box-shadow:0 4px 15px rgba(34,85,255,0.2)}
            .prod-pagination .page-item.disabled .page-link {opacity:0.3;cursor:default;pointer-events:none}
        </style>

        @if($products->count() > 0)
        <!-- Results count & sort bar -->
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:2rem;padding:0.75rem 1rem;background:rgba(5,5,15,0.2);border:1px solid rgba(255,255,255,0.04);border-radius:0.75rem">
            <span style="color:rgba(234,234,234,0.4);font-size:0.8125rem">
                Showing <strong style="color:rgba(234,234,234,0.6);font-weight:600">{{ $products->firstItem() }}-{{ $products->lastItem() }}</strong> of <strong style="color:rgba(234,234,234,0.6);font-weight:600">{{ $products->total() }}</strong> Expert Advisors
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

        <div class="prod-grid">
            @foreach($products as $product)
            @php
                $plans = $product->plans ?? [];
                $minPrice = collect($plans)->min('price');
                $colors = [['from'=>'#005fe7','to'=>'#2255ff'],['from'=>'#ff2d78','to'=>'#ff00aa'],['from'=>'#A855F7','to'=>'#7C3AED'],['from'=>'#F59E0B','to'=>'#D97706'],['from'=>'#EF4444','to'=>'#DC2626']];
                $c = $colors[$loop->index % count($colors)];
            @endphp
            <div style="text-decoration:none;color:inherit;display:block;transition-delay:{{ $loop->index * 0.06 }}s" class="reveal prod-card-link" onclick="var t=event.target; while(t){if(t.classList&&t.classList.contains('prod-atc-btn'))return; t=t.parentNode} window.location.href='{{ route('forex.product-detail', $product->slug) }}'">
                <div class="glass-card" style="height:100%;display:flex;flex-direction:column;overflow:hidden;cursor:pointer;position:relative;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)"
                     onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 20px 60px -12px rgba(0,0,0,0.5), 0 0 0 1px {{ $c['from'] }}22'"
                     onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                    {{-- Top accent line --}}
                    <div style="position:absolute;top:0;left:1.5rem;right:1.5rem;height:2px;background:linear-gradient(90deg,{{ $c['from'] }},{{ $c['from'] }}22,transparent);border-radius:0 0 2px 2px;opacity:0.6"></div>
                    {{-- Glow orb --}}
                    <div style="position:absolute;top:-3rem;right:-3rem;width:10rem;height:10rem;background:radial-gradient(circle,{{ $c['from'] }}08,transparent 70%);pointer-events:none;border-radius:50%;transition:opacity 0.5s;opacity:0;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'"></div>
                    <div style="height:100%;display:flex;flex-direction:column;flex:1;position:relative;z-index:2">
                        <!-- Image -->
                        <div class="prod-card-img" style="flex-shrink:0">
                            <div style="position:absolute;inset:0;background:linear-gradient(180deg,transparent 50%,rgba(5,5,15,0.8) 100%);z-index:2;pointer-events:none"></div>
                            @if($product->image)
                            <img src="{{ config('app.storage_url') }}{{ $product->image }}" alt="{{ $product->name }}" style="width:100%;height:100%;object-fit:cover;transition:transform 0.6s ease;will-change:transform;outline:1px solid transparent" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                            @else
                            <div style="background:linear-gradient(135deg, {{ $c['from'] }}15, {{ $c['to'] }}08);width:100%;height:100%;display:flex;align-items:center;justify-content:center">
                                <svg style="width:3.5rem;height:3.5rem;color:{{ $c['from'] }}40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            @endif
                            @if($product->indicator)
                            <span class="prod-card-badge" style="position:absolute;top:12px;left:12px;z-index:3;background:rgba(0,0,0,0.5);color:{{ $c['from'] }};border:1px solid {{ $c['from'] }}30">{{ $product->indicator }}</span>
                            @endif
                            @if($minPrice)
                            <span class="prod-card-price" style="position:absolute;bottom:12px;right:12px;z-index:3;background:rgba(5,5,15,0.6);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);padding:2px 10px;border-radius:8px;border:1px solid rgba(255,255,255,0.06);font-size:1rem">${{ number_format($minPrice, 0) }}+</span>
                            @endif
                        </div>
                        <!-- Body -->
                        <div style="padding:1.25rem;display:flex;flex-direction:column;flex:1">
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px">
                                <h3 style="color:#EAEAEA;font-weight:600;font-size:1.125rem;margin:0;transition:color 0.3s" 
                                    onmouseover="this.style.color='{{ $c['from'] }}'" 
                                    onmouseout="this.style.color='#EAEAEA'">{{ $product->name }}</h3>
                                <span style="width:2rem;height:2rem;border-radius:0.5rem;background:{{ $c['from'] }}10;border:1px solid {{ $c['from'] }}18;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all 0.3s"
                                      onmouseover="this.style.background='{{ $c['from'] }}20';this.style.transform='rotate(45deg)'"
                                      onmouseout="this.style.background='{{ $c['from'] }}10';this.style.transform='rotate(0deg)'">
                                    <svg style="width:0.875rem;height:0.875rem;color:{{ $c['from'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </span>
                            </div>
                            <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;margin:0 0 12px 0;line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">{{ $product->tagline ?? $product->description }}</p>
                            <!-- Meta + Add to Cart -->
                            <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;padding-top:12px;margin-top:auto;border-top:1px solid rgba(255,255,255,0.06)">
                                @if($product->pairs && count($product->pairs) > 0)
                                <span class="prod-meta-item">
                                    <svg style="width:12px;height:12px;color:{{ $c['from'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                                    {{ $product->pairs[0] }}{{ isset($product->pairs[1]) ? ', ' . $product->pairs[1] : '' }}
                                </span>
                                @endif
                                @if($product->reviews)
                                <span class="prod-meta-item">
                                    <svg style="width:12px;height:12px;color:#f59e0b;" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    {{ $product->reviews }}
                                </span>
                                @endif
                                @if($product->live_signal_years)                                    <span class="prod-meta-item">
                                    <svg style="width:12px;height:12px;color:#ff2d78" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    {{ $product->live_signal_years }}yr
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
        <div class="prod-pagination" style="margin-top:3rem;display:flex;justify-content:center;align-items:center;flex-direction:column;gap:0.75rem">
            {{ $products->links('pagination::bootstrap-5') }}
            <span style="color:rgba(234,234,234,0.2);font-size:0.75rem">Page {{ $products->currentPage() }} of {{ $products->lastPage() }}</span>
        </div>
        @endif
        @else
        <!-- Empty State -->
        <div style="text-align:center;padding:5rem 0;max-width:32rem;margin:0 auto">
            <div style="width:5.5rem;height:5.5rem;margin:0 auto 1.5rem;border-radius:1rem;background:rgba(0,95,231,0.04);border:1px solid rgba(0,95,231,0.08);display:flex;align-items:center;justify-content:center;backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px)">
                <svg style="width:2.5rem;height:2.5rem;color:#005fe7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <h3 style="color:#EAEAEA;font-size:1.375rem;font-weight:600;margin:0 0 0.5rem 0;font-family:'Bebas Neue','Oswald',sans-serif">Coming Soon</h3>
            <p style="color:rgba(234,234,234,0.4);font-size:0.875rem;line-height:1.6;margin:0 0 1.5rem 0">Our Expert Advisors are being carefully prepared. Check back soon for premium trading solutions that deliver real results.</p>
            <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:0.75rem">
                <a href="{{ route('forex.free-eas') }}" style="display:inline-flex;align-items:center;gap:0.375rem;padding:0.625rem 1.25rem;background:linear-gradient(135deg,#005fe7,#2255ff);color:white;font-weight:600;font-size:0.8125rem;border-radius:0.625rem;transition:all 0.3s;text-decoration:none"
                   onmouseover="this.style.boxShadow='0 8px 25px rgba(34,85,255,0.2)';this.style.transform='translateY(-2px)'"
                   onmouseout="this.style.boxShadow='none';this.style.transform='none'">
                    Try Free EAs
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
@endsection
