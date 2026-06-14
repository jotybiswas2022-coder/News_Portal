@extends('frontend.forex.layouts.app')

@section('title', $sourceCode->name . ' Source Code — SMART BINARY ZONE')

@section('content')
<style>
.scd-bg-grid{background-image:linear-gradient(rgba(255,255,255,0.02) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.02) 1px,transparent 1px);background-size:48px 48px}
.scd-badge{display:inline-flex;align-items:center;gap:6px;padding:4px 12px;background:rgba(168,85,247,0.1);border:1px solid rgba(168,85,247,0.2);border-radius:50px;font-size:12px;font-weight:600;color:#A855F7}

/* ─── Responsive grid helpers ─── */
.scd-specs-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:1rem}
@media (min-width:640px){.scd-specs-grid{grid-template-columns:repeat(4,1fr)}}

.scd-feat-grid{display:grid;grid-template-columns:1fr;gap:1rem}
@media (min-width:640px){.scd-feat-grid{grid-template-columns:repeat(2,1fr)}}
@media (min-width:1024px){.scd-feat-grid{grid-template-columns:repeat(3,1fr)}}

/* ─── Code preview scrollbar ─── */
.scd-code-scroll::-webkit-scrollbar{width:6px;height:6px}
.scd-code-scroll::-webkit-scrollbar-track{background:transparent}
.scd-code-scroll::-webkit-scrollbar-thumb{background:rgba(168,85,247,0.2);border-radius:10px}
.scd-code-scroll::-webkit-scrollbar-thumb:hover{background:rgba(168,85,247,0.35)}
</style>

@php
    $features = $sourceCode->features ?? [];
    $accent = '#A855F7';
    $accent2 = '#00FF9F';
    $gradient = 'linear-gradient(135deg,'.$accent.','.$accent2.')';
@endphp

<!-- ==================== HERO ==================== -->
<section style="position:relative;min-height:70vh;display:flex;align-items:center;padding-top:6rem;padding-bottom:3rem;overflow:hidden">
    <div class="scd-bg-grid" style="position:absolute;inset:0;opacity:0.03;pointer-events:none"></div>
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding:0 1rem;width:100%">
        <div style="display:grid;grid-template-columns:1fr;gap:3rem;align-items:center">
            <style>@media (min-width:1024px){.scd-hero{grid-template-columns:1fr 1fr}}</style>
            <div>
                {{-- Badge row --}}
                <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:1.25rem;animation:fadeInUp 0.6s ease">
                    @if($sourceCode->language)
                    <span class="scd-badge">
                        <svg style="width:12px;height:12px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                        {{ strtoupper($sourceCode->language) }}
                    </span>
                    @endif
                    @if($sourceCode->category)
                    <span style="display:inline-flex;align-items:center;gap:4px;padding:4px 10px;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:50px;font-size:11px;color:rgba(234,234,234,0.5);font-weight:500">{{ $sourceCode->category }}</span>
                    @endif
                    @if($sourceCode->version)
                    <span style="display:inline-flex;align-items:center;gap:4px;padding:4px 10px;background:rgba(0,255,159,0.06);border:1px solid rgba(0,255,159,0.1);border-radius:50px;font-size:11px;color:#00FF9F;font-weight:600">v{{ $sourceCode->version }}</span>
                    @endif
                </div>

                {{-- Heading --}}
                <h1 style="font-size:2.5rem;font-weight:700;font-family:'Bebas Neue','Oswald',sans-serif;line-height:1.1;margin-bottom:0.75rem;animation:fadeInUp 0.6s ease 0.1s both">
                    <span style="color:#EAEAEA">{{ $sourceCode->name }}</span><br>
                    <span style="background:{{ $gradient }};-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">Source Code</span>
                </h1>

                {{-- Tagline --}}
                <p style="color:rgba(234,234,234,0.6);font-size:1.05rem;line-height:1.625;margin-bottom:1.5rem;max-width:36rem;animation:fadeInUp 0.6s ease 0.2s both">{{ $sourceCode->tagline ?? $sourceCode->description }}</p>

                {{-- Description card (if different from tagline) --}}
                @if($sourceCode->description !== ($sourceCode->tagline ?? ''))
                <div class="glass-card" style="padding:1rem 1.25rem;margin-bottom:1.5rem;animation:fadeInUp 0.6s ease 0.25s both;max-width:36rem;border-left:3px solid {{ $accent }}66">
                    <p style="color:rgba(234,234,234,0.55);font-size:0.875rem;line-height:1.625;margin:0">{{ $sourceCode->description }}</p>
                </div>
                @endif

                {{-- Price + CTA --}}
                <div style="display:flex;align-items:center;gap:1.25rem;flex-wrap:wrap;animation:fadeInUp 0.6s ease 0.3s both">
                    <div style="display:flex;align-items:baseline;gap:10px">
                        <span style="font-size:2.5rem;font-weight:800;background:{{ $gradient }};-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;font-family:'JetBrains Mono',monospace;white-space:nowrap">{{ formatPrice($sourceCode->price) }}</span>
                        @if($sourceCode->old_price)
                        <span style="color:rgba(234,234,234,0.2);font-size:1.125rem;text-decoration:line-through">{{ formatPrice($sourceCode->old_price) }}</span>
                        <span style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.15);color:#ef4444;font-size:0.7rem;font-weight:700;padding:2px 8px;border-radius:50px">
                            {{ round((1 - $sourceCode->price / $sourceCode->old_price) * 100) }}% OFF
                        </span>
                        @endif
                    </div>
                    <a href="#scd-order" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.875rem 2rem;background:{{ $gradient }};color:white;font-weight:600;font-size:1rem;border-radius:0.75rem;transition:all 0.3s;text-decoration:none" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 30px rgba(168,85,247,0.25)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                        Purchase Now
                        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== TECH SPECS ==================== -->
@if($sourceCode->platform || $sourceCode->language || $sourceCode->version || $sourceCode->category)
<section style="padding-top:3rem;padding-bottom:3rem;background:#0A0A0A">
    <div style="max-width:80rem;margin:0 auto;padding:0 1rem">
        <div class="scd-specs-grid">
            @php
                $specs = [];
                if($sourceCode->language) $specs[] = ['icon' => 'code', 'label' => 'Language', 'value' => $sourceCode->language];
                if($sourceCode->platform) $specs[] = ['icon' => 'device-desktop', 'label' => 'Platform', 'value' => $sourceCode->platform];
                if($sourceCode->version) $specs[] = ['icon' => 'tag', 'label' => 'Version', 'value' => 'v'.$sourceCode->version];
                if($sourceCode->category) $specs[] = ['icon' => 'folder', 'label' => 'Category', 'value' => $sourceCode->category];
            @endphp
            @foreach($specs as $s => $spec)
            <div class="reveal" style="transition-delay:{{ $s * 0.08 }}s">
                <div class="glass-card" style="
                    padding:1.5rem 1.25rem;text-align:center;
                    position:relative;overflow:hidden;
                    transition:all 0.4s cubic-bezier(0.4,0,0.2,1);
                    cursor:default;
                "
                onmouseover="this.style.borderColor='{{ $accent }}33';this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 32px -8px rgba(0,0,0,0.3)'"
                onmouseout="this.style.borderColor='rgba(255,255,255,0.06)';this.style.transform='translateY(0)';this.style.boxShadow='none'">
                    {{-- Icon --}}
                    <div style="
                        width:2.75rem;height:2.75rem;border-radius:0.75rem;
                        background:{{ $accent }}10;
                        border:1px solid {{ $accent }}18;
                        display:flex;align-items:center;justify-content:center;
                        color:{{ $accent }};margin:0 auto 0.75rem;
                        transition:all 0.3s;
                    " onmouseover="this.style.transform='scale(1.1)';this.style.background='{{ $accent }}18'" onmouseout="this.style.transform='scale(1)';this.style.background='{{ $accent }}10'">
                        @if($spec['icon'] === 'code')
                        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                        @elseif($spec['icon'] === 'device-desktop')
                        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        @elseif($spec['icon'] === 'tag')
                        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        @else
                        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                        @endif
                    </div>
                    <p style="color:rgba(234,234,234,0.35);font-size:0.7rem;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;margin:0 0 6px 0">{{ $spec['label'] }}</p>
                    <p style="color:#EAEAEA;font-weight:700;font-size:1.05rem;margin:0">{{ $spec['value'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ==================== FEATURES ==================== -->
@if(count($features) > 0)
<section id="scd-features" style="padding-top:5rem;padding-bottom:5rem;position:relative;overflow:hidden">
    <div style="position:absolute;top:50%;right:0;transform:translateY(-50%);opacity:0.05;width:400px;height:400px;border-radius:50%;background:{{ $accent }}22;filter:blur(100px);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:72rem;margin:0 auto;padding:0 1rem">
        <div style="text-align:center;margin-bottom:2.5rem">
            <h2 style="font-size:1.875rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.5rem" class="reveal">What's Included</h2>
            <p style="color:rgba(234,234,234,0.45);font-size:0.95rem;max-width:32rem;margin:0 auto" class="reveal stagger-1">Everything you need to get started with {{ $sourceCode->name }} source code.</p>
        </div>

        <div class="scd-feat-grid">
            @php
                $featAccents = ['#A855F7', '#00FF9F', '#0EA5E9', '#F59E0B', '#EC4899', '#10B981'];
            @endphp
            @foreach($features as $j => $feature)
            @php $fa = $featAccents[$j % count($featAccents)]; @endphp
            <div class="reveal" style="transition-delay:{{ $j * 0.05 }}s">
                <div class="glass-card" style="
                    padding:1.25rem 1.5rem;
                    position:relative;overflow:hidden;
                    transition:all 0.4s cubic-bezier(0.4,0,0.2,1);
                    cursor:default;height:100%;
                    display:flex;align-items:flex-start;gap:1rem;
                "
                onmouseover="this.style.borderColor='{{ $fa }}33';this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,0.25)'"
                onmouseout="this.style.borderColor='rgba(255,255,255,0.06)';this.style.transform='translateY(0)';this.style.boxShadow='none'">

                    {{-- Checkmark icon --}}
                    <div style="
                        width:1.75rem;height:1.75rem;border-radius:50%;
                        background:{{ $fa }}12;
                        border:1px solid {{ $fa }}20;
                        display:flex;align-items:center;justify-content:center;
                        flex-shrink:0;margin-top:2px;
                        transition:all 0.3s;
                    " onmouseover="this.style.transform='scale(1.15)';this.style.background='{{ $fa }}22'" onmouseout="this.style.transform='scale(1)';this.style.background='{{ $fa }}12'">
                        <svg style="width:0.75rem;height:0.75rem;color:{{ $fa }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </div>

                    {{-- Text --}}
                    <p style="color:rgba(234,234,234,0.6);font-size:0.9375rem;margin:0;line-height:1.6;flex:1">{{ $feature }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ==================== PRICING / ORDER ==================== -->
<section id="scd-order" style="padding-top:5rem;padding-bottom:5rem;background:#0A0A0A;position:relative;overflow:hidden">
    <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);opacity:0.06;width:500px;height:500px;border-radius:50%;background:{{ $accent }}22;filter:blur(100px);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:36rem;margin:0 auto;padding:0 1rem;text-align:center">

        {{-- Section heading --}}
        <h2 style="font-size:1.875rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.5rem" class="reveal">Get {{ $sourceCode->name }}</h2>
        <p style="color:rgba(234,234,234,0.45);margin-bottom:2rem" class="reveal stagger-1">One-time payment — lifetime access — full source code included.</p>

        {{-- Premium pricing card (trust meter style) --}}
        <div class="reveal stagger-2">
            <div class="glass-card" style="
                padding:0;position:relative;overflow:hidden;
                transition:all 0.4s cubic-bezier(0.4,0,0.2,1);
                cursor:default;
            "
            onmouseover="this.style.borderColor='{{ $accent }}44';this.style.transform='translateY(-6px)';this.style.boxShadow='0 20px 56px -8px rgba(0,0,0,0.4), 0 0 0 1px {{ $accent }}22'"
            onmouseout="this.style.borderColor='rgba(255,255,255,0.06)';this.style.transform='translateY(0)';this.style.boxShadow='none'">

                {{-- Top accent line --}}
                <div style="
                    position:absolute;top:0;left:1.5rem;right:1.5rem;height:2px;
                    background:linear-gradient(90deg,{{ $accent }},{{ $accent }}44,transparent);
                    border-radius:0 0 2px 2px;opacity:0.6;
                "></div>

                {{-- Glow orb --}}
                <div style="
                    position:absolute;top:-4rem;right:-4rem;width:12rem;height:12rem;
                    background:radial-gradient(circle,{{ $accent }}08,transparent 70%);
                    pointer-events:none;border-radius:50%;
                    transition:opacity 0.5s;opacity:0;
                " onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'"></div>

                <div style="padding:2.5rem 2rem;position:relative;z-index:2">

                    {{-- Discount badge --}}
                    @if($sourceCode->old_price && $sourceCode->old_price > $sourceCode->price)
                    <div style="margin-bottom:1.25rem">
                        <span style="
                            display:inline-flex;align-items:center;gap:0.375rem;
                            background:rgba(239,68,68,0.1);
                            border:1px solid rgba(239,68,68,0.15);
                            color:#ef4444;
                            font-size:0.7rem;font-weight:700;
                            padding:0.25rem 0.875rem;border-radius:9999px;
                        ">
                            <svg style="width:0.625rem;height:0.625rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            SAVE {{ round((1 - $sourceCode->price / $sourceCode->old_price) * 100) }}%
                        </span>
                    </div>
                    @endif

                    {{-- Product name --}}
                    <p style="color:rgba(234,234,234,0.35);font-size:0.8rem;font-weight:500;text-transform:uppercase;letter-spacing:0.5px;margin:0 0 0.5rem 0">{{ $sourceCode->name }}</p>

                    {{-- Price display --}}
                    <div style="margin-bottom:1.5rem">
                        <div style="display:flex;align-items:center;justify-content:center;gap:12px">
                            <span style="font-size:3.5rem;font-weight:800;color:#EAEAEA;font-family:'JetBrains Mono',monospace;line-height:1;white-space:nowrap">{{ formatPrice($sourceCode->price) }}</span>
                            @if($sourceCode->old_price)
                            <span style="color:rgba(234,234,234,0.15);font-size:1.25rem;text-decoration:line-through;font-weight:500">{{ formatPrice($sourceCode->old_price) }}</span>
                            @endif
                        </div>
                        <p style="color:rgba(234,234,234,0.25);font-size:0.8125rem;margin:6px 0 0 0">One-Time Payment · Lifetime Access</p>
                    </div>

                    {{-- Features list (top 4) --}}
                    @if(count($features) > 0)
                    <div style="text-align:left;margin-bottom:2rem;padding:1rem 1.25rem;background:rgba(255,255,255,0.02);border-radius:0.75rem;border:1px solid rgba(255,255,255,0.04)">
                        <p style="color:rgba(234,234,234,0.25);font-size:0.65rem;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;margin:0 0 0.75rem 0">Includes</p>
                        <div style="display:flex;flex-direction:column;gap:0.625rem">
                            @foreach(array_slice($features, 0, 4) as $f)
                            <div style="display:flex;align-items:center;gap:0.625rem;font-size:0.85rem;color:rgba(234,234,234,0.55);line-height:1.4">
                                <svg style="width:0.875rem;height:0.875rem;color:{{ $accent2 }};flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                {{ $f }}
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Download link info --}}
                    <div style="
                        text-align:center;
                        margin:0 0 1.25rem;
                        padding:0.625rem 0.875rem;
                        background:rgba(168,85,247,0.06);
                        border:1px solid rgba(168,85,247,0.1);
                        border-radius:0.625rem;
                        font-size:0.8rem;
                        color:rgba(234,234,234,0.55);
                        line-height:1.5;
                    ">
                        <svg style="width:0.875rem;height:0.875rem;color:#A855F7;margin-right:6px;vertical-align:middle;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        You will get the Download link in the
                        <a href="{{ route('forex.my-orders') }}" style="color:#A855F7;text-decoration:underline;font-weight:500">My-Order Page</a>
                    </div>

                    {{-- Add to Cart button --}}
                    <button
                        onclick="addToCart({name:'{{ $sourceCode->name }} Source Code', price:{{ $sourceCode->price }}, id:'src-{{ $sourceCode->slug }}'})"
                        data-cart-id="src-{{ $sourceCode->slug }}"
                        style="
                            display:inline-flex;align-items:center;justify-content:center;gap:0.5rem;
                            width:100%;padding:1rem 1.5rem;
                            background:{{ $gradient }};
                            color:white;font-weight:700;font-size:1rem;
                            border-radius:0.75rem;border:none;
                            cursor:pointer;transition:all 0.3s;
                            font-family:'DM Sans',sans-serif;
                        "
                        onmouseover="this.style.boxShadow='0 8px 30px rgba(168,85,247,0.3)';this.style.transform='translateY(-2px)'"
                        onmouseout="this.style.boxShadow='none';this.style.transform=''">
                        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>

        {{-- Trust indicators --}}
        <div style="display:flex;align-items:center;justify-content:center;gap:1.5rem;margin-top:1.5rem;flex-wrap:wrap;animation:fadeInUp 0.6s ease 0.4s both">
            <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:rgba(234,234,234,0.3)">
                <svg style="width:14px;height:14px;color:{{ $accent2 }};flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Lifetime Access
            </div>
            <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:rgba(234,234,234,0.3)">
                <svg style="width:14px;height:14px;color:{{ $accent2 }};flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Free Updates
            </div>
            <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:rgba(234,234,234,0.3)">
                <svg style="width:14px;height:14px;color:{{ $accent2 }};flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                24/7 Support
            </div>
        </div>
    </div>
</section>

<!-- ==================== CODE PREVIEW ==================== -->
@if($sourceCode->code)
<section style="padding-top:5rem;padding-bottom:5rem;position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,0.03) 1px,transparent 1px);background-size:24px 24px;opacity:0.05;pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:64rem;margin:0 auto;padding:0 1rem">
        <div style="text-align:center;margin-bottom:2rem">
            <h2 style="font-size:1.875rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.5rem" class="reveal">Code Preview</h2>
            <p style="color:rgba(234,234,234,0.45);font-size:0.95rem" class="reveal stagger-1">A glimpse of the {{ $sourceCode->language ?? 'source' }} code you'll receive.</p>
        </div>

        <div class="reveal stagger-2">
            <div class="glass-card" style="
                padding:0;overflow:hidden;
                transition:all 0.3s;
            "
            onmouseover="this.style.borderColor='{{ $accent }}33';this.style.boxShadow='0 8px 32px rgba(0,0,0,0.3)'"
            onmouseout="this.style.borderColor='rgba(255,255,255,0.06)';this.style.boxShadow='none'">

                {{-- Window controls bar --}}
                <div style="
                    padding:14px 20px;
                    border-bottom:1px solid rgba(255,255,255,0.06);
                    display:flex;align-items:center;justify-content:space-between;
                    background:rgba(0,0,0,0.15);
                ">
                    <div style="display:flex;align-items:center;gap:10px">
                        <div style="display:flex;gap:6px">
                            <span style="width:10px;height:10px;border-radius:50%;background:#ef4444;transition:transform 0.2s" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"></span>
                            <span style="width:10px;height:10px;border-radius:50%;background:#f59e0b;transition:transform 0.2s" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"></span>
                            <span style="width:10px;height:10px;border-radius:50%;background:{{ $accent2 }};transition:transform 0.2s" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"></span>
                        </div>
                        <span style="color:rgba(234,234,234,0.25);font-size:12px;font-weight:500;margin-left:4px;font-family:'JetBrains Mono',monospace">{{ $sourceCode->name }}.{{ $sourceCode->language ?? 'txt' }}</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:8px">
                        <span style="
                            display:inline-flex;align-items:center;gap:4px;
                            padding:3px 10px;border-radius:20px;
                            background:{{ $accent }}0c;
                            color:{{ $accent }};font-size:11px;font-weight:600;
                        ">
                            <svg style="width:12px;height:12px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                            {{ $sourceCode->language ?? 'Code' }}
                        </span>
                    </div>
                </div>

                {{-- Code content --}}
                <pre class="scd-code-scroll" style="
                    padding:24px;margin:0;overflow-x:auto;
                    font-family:'JetBrains Mono','Fira Code',monospace;
                    font-size:13px;line-height:1.7;
                    color:rgba(234,234,234,0.6);
                    max-height:400px;overflow-y:auto;
                    background:rgba(0,0,0,0.1);
                "><code>{{ $sourceCode->code }}</code></pre>
            </div>
        </div>
    </div>
</section>
@endif

<!-- ==================== CTA ==================== -->
<section style="padding-top:5rem;padding-bottom:5rem;background:#0A0A0A;position:relative;overflow:hidden">
    <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);opacity:0.06;width:500px;height:500px;border-radius:50%;background:{{ $accent }}22;filter:blur(100px);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:56rem;margin:0 auto;padding:0 1rem;text-align:center">
        <h2 style="font-size:2rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.75rem" class="reveal">Ready to Get the Source Code?</h2>
        <p style="color:rgba(234,234,234,0.5);font-size:1.05rem;margin-bottom:2rem;max-width:36rem;margin-left:auto;margin-right:auto" class="reveal stagger-1">Get {{ $sourceCode->name }} source code and start building today.</p>
        <div class="reveal stagger-2" style="display:flex;flex-wrap:wrap;justify-content:center;gap:1rem">
            <a href="#scd-order" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.875rem 2rem;background:{{ $gradient }};color:white;font-weight:600;font-size:1rem;border-radius:0.75rem;transition:all 0.3s;text-decoration:none" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 30px rgba(168,85,247,0.25)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                Purchase Now
                <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="{{ route('forex.source-codes') }}" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.875rem 2rem;background:rgba(255,255,255,0.04);color:rgba(234,234,234,0.6);font-weight:500;font-size:1rem;border-radius:0.75rem;transition:all 0.3s;text-decoration:none;border:1px solid rgba(255,255,255,0.08)" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#EAEAEA'" onmouseout="this.style.background='rgba(255,255,255,0.04)';this.style.color='rgba(234,234,234,0.6)'">
                Browse All
                <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>
@endsection
