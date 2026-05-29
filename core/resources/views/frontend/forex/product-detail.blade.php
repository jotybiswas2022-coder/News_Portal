@extends('frontend.forex.layouts.app')

@section('title', $product->name . ' — ' . ($product->tagline ?? 'Expert Advisor'))

@section('content')
<style>
@media (min-width:640px){.pd-px{padding-left:1.5rem;padding-right:1.5rem}}
@media (min-width:1024px){.pd-px{padding-left:2rem;padding-right:2rem}}
@media (min-width:640px){.pd-text-lg{font-size:1.125rem}}
.pd-bg-grid{background-image:linear-gradient(rgba(255,255,255,0.02) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.02) 1px,transparent 1px);background-size:48px 48px}
.pd-faq-item{border-radius:0.75rem;overflow:hidden;transition:all 0.3s}
.pd-faq-item:hover{border-color:rgba(34,85,255,0.5)}
.pd-faq-toggle{width:100%;display:flex;align-items:center;justify-content:space-between;padding:1rem 1.25rem;text-align:left;cursor:pointer;background:none;border:none;color:#EAEAEA;font-weight:500;font-size:0.875rem}
@media (min-width:640px){.pd-faq-toggle{padding:1.25rem;font-size:1rem}}
.pd-faq-chevron{width:1.25rem;height:1.25rem;color:#9ca3af;flex-shrink:0;transition:transform 0.3s}
.pd-faq-content{max-height:0;overflow:hidden;transition:max-height 0.3s}
.pd-faq-inner{padding:0 1.25rem 1rem;color:#9ca3af;font-size:0.875rem;line-height:1.625;border-top:1px solid #2a2a2a;padding-top:1rem}
@media (min-width:640px){.pd-faq-inner{padding:0 1.25rem 1.25rem}}
</style>

@php
    $features = $product->features ?? [];
    $plans = $product->plans ?? [];
    $heroTagline = $product->hero_tagline ?? $product->tagline;
    $heroDescription = $product->hero_description ?? $product->description;
@endphp

<!-- HERO -->
<section style="position:relative;min-height:70vh;display:flex;align-items:center;padding-top:6rem;padding-bottom:3rem;overflow:hidden">
    <div class="pd-bg-grid" style="position:absolute;inset:0;opacity:0.03;pointer-events:none"></div>
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding-left:1rem;padding-right:1rem;width:100%">
        <div style="display:grid;grid-template-columns:1fr;gap:3rem;align-items:center">
            <style>@media (min-width:1024px){.pd-hero{grid-template-columns:repeat(2,1fr)}}</style>
            <div>
                {{-- Badge row --}}
                <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:1.25rem;animation:fadeInUp 0.6s ease">
                    @if($product->indicator)
                    <span style="display:inline-flex;align-items:center;gap:6px;padding:4px 12px;background:rgba(0,95,231,0.1);border:1px solid rgba(0,95,231,0.2);border-radius:50px;font-size:12px;font-weight:600;color:#005fe7">
                        <svg style="width:12px;height:12px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $product->indicator }}
                    </span>
                    @endif
                    @if($product->reviews)
                    <span style="display:inline-flex;align-items:center;gap:4px;padding:4px 10px;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:50px;font-size:11px;color:rgba(234,234,234,0.5);font-weight:500">
                        <svg style="width:12px;height:12px;color:#f59e0b" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        {{ $product->reviews }} Reviews
                    </span>
                    @endif
                    @if($product->live_signal_years)
                    <span style="display:inline-flex;align-items:center;gap:4px;padding:4px 10px;background:rgba(0,95,231,0.06);border:1px solid rgba(0,95,231,0.1);border-radius:50px;font-size:11px;color:#005fe7;font-weight:600">{{ $product->live_signal_years }} Yrs Live Signal</span>
                    @endif
                </div>

                <h1 style="font-size:2.5rem;font-weight:700;font-family:'Bebas Neue','Oswald',sans-serif;line-height:1.1;margin-bottom:0.75rem;animation:fadeInUp 0.6s ease 0.1s both">
                    <span style="color:#EAEAEA">{{ $product->name }}</span><br>
                    <span style="background:linear-gradient(135deg,#005fe7,#ff2d78);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">{{ $product->tagline ?? 'Expert Advisor' }}</span>
                </h1>

                <p style="color:rgba(234,234,234,0.6);font-size:1.05rem;line-height:1.625;margin-bottom:1.5rem;max-width:36rem;animation:fadeInUp 0.6s ease 0.2s both">{{ $heroTagline }}</p>

                {{-- Description card (if hero_description differs from tagline) --}}
                @if($heroDescription !== ($product->tagline ?? ''))
                <div class="glass-card" style="padding:1rem 1.25rem;margin-bottom:1.5rem;animation:fadeInUp 0.6s ease 0.25s both;max-width:36rem;border-left:3px solid rgba(0,95,231,0.4)">
                    <p style="color:rgba(234,234,234,0.55);font-size:0.875rem;line-height:1.625;margin:0">{{ $heroDescription }}</p>
                </div>
                @endif

                {{-- CTA --}}
                @if(count($plans) > 0)
                <div style="display:flex;align-items:center;gap:1rem;flex-wrap:wrap;animation:fadeInUp 0.6s ease 0.3s both">
                    <a href="#pd-pricing" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.875rem 2rem;background:linear-gradient(135deg,#005fe7,#2255ff);color:white;font-weight:600;font-size:1rem;border-radius:0.75rem;transition:all 0.3s;text-decoration:none" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 30px rgba(34,85,255,0.25)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                        Get {{ $product->name }} Now
                        <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
@if(count($features) > 0)
@php $featImgFields = ['feature_image_1', 'feature_image_2', 'feature_image_3']; @endphp
@foreach($features as $i => $feature)
@php $featImg = $product->{$featImgFields[$i] ?? null} ?? null; @endphp
<section style="padding-top:4rem;padding-bottom:4rem;background:{{ $i % 2 === 0 ? 'transparent' : '#05050f' }}">
    <div style="max-width:80rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <div style="display:grid;grid-template-columns:1fr;gap:3rem;align-items:center">
            <style>@media (min-width:1024px){.pd-feat{{ $i }}{grid-template-columns:repeat(2,1fr)}}</style>
            <div style="order:{{ $i % 2 === 0 ? '0' : '2' }}" class="reveal">
                @if(isset($feature['tagline']))<span style="color:#005fe7;font-size:0.875rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:0.5rem;display:block">{{ $feature['tagline'] }}</span>@endif
                @if(isset($feature['title']))<h2 style="font-size:1.875rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:1rem">{{ $feature['title'] }}</h2>@endif
                @if(isset($feature['text']))<p style="color:#9ca3af;line-height:1.625">{{ $feature['text'] }}</p>@endif
            </div>
            @if($featImg)
            @php $featAccent = '#005fe7'; @endphp
            <div style="order:{{ $i % 2 === 0 ? '0' : '1' }}" class="reveal">
                <div class="glass-card" style="padding:0;overflow:hidden;aspect-ratio:auto;min-height:300px;position:relative;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)"
                     onmouseover="this.style.borderColor='{{ $featAccent }}33';this.style.boxShadow='0 8px 32px rgba(0,0,0,0.3)'"
                     onmouseout="this.style.borderColor='rgba(255,255,255,0.06)';this.style.boxShadow='none'">
                    {{-- Top accent line --}}
                    <div style="position:absolute;top:0;left:1.5rem;right:1.5rem;height:2px;background:linear-gradient(90deg,{{ $featAccent }},{{ $featAccent }}44,transparent);border-radius:0 0 2px 2px;opacity:0.6;z-index:3"></div>
                    {{-- Glow orb --}}
                    <div style="position:absolute;top:-3rem;right:-3rem;width:10rem;height:10rem;background:radial-gradient(circle,{{ $featAccent }}08,transparent 70%);pointer-events:none;border-radius:50%;transition:opacity 0.5s;opacity:0;z-index:3" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'"></div>
                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;overflow:hidden">
                        <img src="{{ config('app.storage_url') }}{{ $featImg }}" alt="{{ $feature['title'] ?? 'Feature ' . ($i + 1) }}"
                             style="width:100%;height:100%;object-fit:cover;transition:transform 0.6s ease"
                             onmouseover="this.style.transform='scale(1.04)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endforeach
@endif

<!-- PRICING -->
@if(count($plans) > 0)
<section id="pd-pricing" style="padding-top:5rem;padding-bottom:5rem;position:relative;overflow:hidden">
    <div class="orb orb-brand" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);opacity:0.06;width:500px;height:500px;border-radius:50%;background:rgba(34,85,255,0.15);filter:blur(100px);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:72rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <h2 style="font-size:1.875rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;text-align:center;color:#EAEAEA;margin-bottom:0.5rem" class="reveal">{{ $product->name }} Expert Advisor</h2>
        <p style="color:#9ca3af;text-align:center;margin-bottom:2.5rem" class="reveal stagger-1">
            @if($product->reviews)Over {{ $product->reviews }} positive reviews @endif
            @if($product->live_signal_years)and {{ $product->live_signal_years }} Years of Live Signal @endif
        </p>

        {{-- Pricing Grid — same responsive pattern as trust meter section --}}
        <div class="pd-pricing-grid" style="display:grid;gap:1.5rem">
            <style>
                .pd-pricing-grid{grid-template-columns:1fr}
                @media (min-width:640px){.pd-pricing-grid{grid-template-columns:repeat(2,1fr)}}
                @media (min-width:1024px){.pd-pricing-grid{grid-template-columns:repeat(3,1fr)}}
            </style>
            @foreach($plans as $plan)
            @php $accent = '#005fe7'; $isPopular = isset($plan['popular']) && $plan['popular']; @endphp
            <div class="reveal" style="transition-delay:{{ $loop->index * 0.08 }}s">
                <div class="glass-card" style="
                    padding:0;
                    position:relative;
                    overflow:hidden;
                    transition:all 0.4s cubic-bezier(0.4,0,0.2,1);
                    cursor:default;
                    height:100%;
                    display:flex;
                    flex-direction:column;
                    {{ $isPopular ? 'border-color:'.$accent.';box-shadow:0 0 40px rgba(34,85,255,0.15)' : '' }}
                "
                onmouseover="this.style.borderColor='{{ $accent }}44';this.style.transform='translateY(-6px)';this.style.boxShadow='0 16px 48px -8px rgba(0,0,0,0.4), 0 0 0 1px {{ $accent }}22'"
                onmouseout="this.style.borderColor='{{ $isPopular ? $accent : 'rgba(255,255,255,0.06)' }}';this.style.transform='translateY(0)';this.style.boxShadow='{{ $isPopular ? '0 0 40px rgba(34,85,255,0.15)' : 'none' }}'">

                    {{-- Top accent line --}}
                    <div style="
                        position:absolute;top:0;left:1.5rem;right:1.5rem;height:2px;
                        background:linear-gradient(90deg,{{ $accent }},{{ $accent }}44,transparent);
                        border-radius:0 0 2px 2px;
                        opacity:0.6;
                    "></div>

                    {{-- Glow orb --}}
                    <div style="
                        position:absolute;top:-4rem;right:-4rem;width:10rem;height:10rem;
                        background:radial-gradient(circle,{{ $accent }}08,transparent 70%);
                        pointer-events:none;border-radius:50%;
                        transition:opacity 0.5s;
                        opacity:0;
                    " class="pd-pricing-glow" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'"></div>

                    {{-- Inner content --}}
                    <div style="padding:2rem 1.75rem;flex:1;display:flex;flex-direction:column">

                        {{-- Popular badge --}}
                        @if($isPopular)
                        <div style="text-align:center;margin-bottom:1rem">
                            <span style="
                                display:inline-flex;align-items:center;gap:0.375rem;
                                background:linear-gradient(135deg,{{ $accent }},#2255ff);
                                color:white;font-size:0.7rem;font-weight:700;
                                padding:0.25rem 0.875rem;
                                border-radius:9999px;white-space:nowrap;
                                letter-spacing:0.02em;
                            ">
                                <svg style="width:0.75rem;height:0.75rem" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                Most Popular
                            </span>
                        </div>
                        @endif

                        {{-- Plan name + icon row --}}
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.75rem">
                            <h3 style="
                                color:#EAEAEA;
                                font-weight:700;
                                font-size:1.15rem;
                                margin:0;
                                transition:color 0.3s;
                            " onmouseover="this.style.color='{{ $accent }}'" onmouseout="this.style.color='#EAEAEA'">{{ $plan['name'] ?? 'Plan' }}</h3>
                            @if($isPopular)
                            <span style="
                                width:2rem;height:2rem;border-radius:50%;
                                background:{{ $accent }}12;
                                display:flex;align-items:center;justify-content:center;
                                color:{{ $accent }};font-size:0.8rem;flex-shrink:0;
                            "><i class="bi bi-star-fill"></i></span>
                            @endif
                        </div>

                        {{-- Price --}}
                        <div style="margin-bottom:1.25rem;padding-bottom:1rem;border-bottom:1px solid rgba(255,255,255,0.05)">
                            @if(!empty($plan['old_price']) && $plan['old_price'] > 0)
                            <span style="font-size:1rem;color:rgba(234,234,234,0.3);text-decoration:line-through;margin-right:0.5rem;font-weight:500">${{ number_format($plan['old_price'], 2) }}</span>
                            @endif
                            <span style="font-size:2.25rem;font-weight:800;color:#EAEAEA;font-family:'JetBrains Mono',monospace">${{ number_format($plan['price'] ?? 0, 2) }}</span>
                            <span style="color:rgba(234,234,234,0.35);font-size:0.8rem;margin-left:0.5rem;font-weight:500">One Time</span>
                        </div>

                        {{-- Features — Single column for readability, no word breaks --}}
                        <ul style="
                            display:flex;flex-direction:column;gap:0.625rem;
                            margin:0 0 1.5rem 0;padding:0;list-style:none;
                            flex:1;
                        ">
                            @foreach($plan['features'] ?? [] as $feature)
                            <li style="
                                display:flex;align-items:flex-start;gap:0.625rem;
                                font-size:0.85rem;color:rgba(234,234,234,0.65);
                                line-height:1.5;
                                word-break:normal;overflow-wrap:break-word;
                            ">
                                <svg style="
                                    width:1rem;height:1rem;color:#005fe7;
                                    margin-top:0.2rem;flex-shrink:0;min-width:1rem;
                                " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span style="display:inline">{{ $feature }}</span>
                            </li>
                            @endforeach
                        </ul>

                        {{-- Download link info --}}
                        <div style="
                            text-align:center;
                            margin:0 0 1.25rem;
                            padding:0.625rem 0.875rem;
                            background:rgba(0,95,231,0.06);
                            border:1px solid rgba(0,95,231,0.1);
                            border-radius:0.625rem;
                            font-size:0.8rem;
                            color:rgba(234,234,234,0.55);
                            line-height:1.5;
                        ">
                            <svg style="width:0.875rem;height:0.875rem;color:#005fe7;margin-right:6px;vertical-align:middle;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            You will get the Download link in the
                            <a href="{{ route('forex.my-orders') }}" style="color:#005fe7;text-decoration:underline;font-weight:500">My-Order Page</a>
                        </div>

                        {{-- Add to Cart button --}}
                        <button
                            onclick="addToCart({{ json_encode(['name' => $product->name.' '.($plan['name'] ?? ''), 'price' => $plan['price'] ?? 0, 'id' => $product->slug.'-'.($plan['id'] ?? $loop->index)]) }})"
                            data-cart-id="{{ $product->slug }}-{{ $plan['id'] ?? $loop->index }}"
                            style="
                                width:100%;text-align:center;font-weight:600;
                                padding:0.8rem 1rem;border-radius:0.75rem;
                                transition:all 0.3s;cursor:pointer;
                                background:{{ $isPopular ? 'linear-gradient(135deg,'.$accent.',#2255ff)' : 'rgba(255,255,255,0.04)' }};
                                color:{{ $isPopular ? 'white' : $accent }};
                                border:{{ $isPopular ? 'none' : '1px solid rgba(0,95,231,0.15)' }};
                                font-size:0.875rem;font-family:inherit;
                                display:inline-flex;align-items:center;justify-content:center;gap:0.5rem;
                            "
                            onmouseover="this.style.boxShadow='0 8px 30px rgba(34,85,255,0.25)';this.style.transform='translateY(-2px)';this.style.background='{{ $isPopular ? 'linear-gradient(135deg,'.$accent.',#2255ff)' : 'rgba(0,95,231,0.1)' }}'"
                            onmouseout="this.style.boxShadow='none';this.style.transform='';this.style.background='{{ $isPopular ? 'linear-gradient(135deg,'.$accent.',#2255ff)' : 'rgba(255,255,255,0.04)' }}'">
                            <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- FAQ -->
<section style="padding-top:5rem;padding-bottom:5rem;background:#05050f;position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,0.03) 1px,transparent 1px);background-size:24px 24px;opacity:0.2;pointer-events:none"></div>
    <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);opacity:0.05;width:400px;height:400px;border-radius:50%;background:rgba(34,85,255,0.12);filter:blur(100px);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:48rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <div style="text-align:center;margin-bottom:2.5rem">
            <div class="badge" style="margin-bottom:0.75rem"><span class="badge-dot"></span> Got Questions?</div>
            <h2 style="font-size:1.875rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.5rem" class="reveal">Frequently Asked Questions</h2>
            <p style="color:rgba(234,234,234,0.45);font-size:0.95rem;max-width:32rem;margin:0 auto" class="reveal stagger-1">Everything you need to know about {{ $product->name }}.</p>
        </div>
        <div style="display:flex;flex-direction:column;gap:0.75rem">
            @foreach($faq as $i => $item)
            <div class="glass-card pd-faq-item reveal" style="padding:0;overflow:hidden;position:relative;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)" onmouseover="this.style.borderColor='rgba(34,85,255,0.4)'" onmouseout="this.style.borderColor='#2a2a2a'">
                <button class="pd-faq-toggle" onclick="toggleFaq{{ str_replace('-', '', $slug) }}(this)">
                    <span style="padding-right:1rem">{{ $item['q'] }}</span>
                    <svg class="pd-faq-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div class="pd-faq-content">
                    <div class="pd-faq-inner">{{ $item['a'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.pd-faq-toggle').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const content = this.nextElementSibling;
            const chevron = this.querySelector('.pd-faq-chevron');
            const isOpen = content.style.maxHeight && content.style.maxHeight !== '0px';
            if (isOpen) {
                content.style.maxHeight = '0px';
                chevron.style.transform = 'rotate(0deg)';
                this.closest('.pd-faq-item').style.borderColor = '#2a2a2a';
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
                chevron.style.transform = 'rotate(180deg)';
                this.closest('.pd-faq-item').style.borderColor = 'rgba(34,85,255,0.5)';
            }
        });
    });
});
</script>

<!-- CTA -->
<section style="padding-top:5rem;padding-bottom:5rem;background:#05050f;position:relative;overflow:hidden">
    <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);opacity:0.06;width:500px;height:500px;border-radius:50%;background:rgba(34,85,255,0.15);filter:blur(100px);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:56rem;margin:0 auto;padding-left:1rem;padding-right:1rem;text-align:center">
        <h2 style="font-size:2rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.75rem" class="reveal">Let's Get Started</h2>
        <p style="color:rgba(234,234,234,0.5);font-size:1.05rem;margin-bottom:2rem;max-width:36rem;margin-left:auto;margin-right:auto" class="reveal stagger-1">Start trading with {{ $product->name }} and experience the difference.</p>
        <div class="reveal stagger-2" style="display:flex;flex-wrap:wrap;justify-content:center;gap:1rem">
            <a href="#pd-pricing" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.875rem 2rem;background:linear-gradient(135deg,#005fe7,#2255ff);color:white;font-weight:600;font-size:1rem;border-radius:0.75rem;transition:all 0.3s;text-decoration:none" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 30px rgba(34,85,255,0.25)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                Get Started Now
                <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="{{ route('forex.products') }}" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.875rem 2rem;background:rgba(255,255,255,0.04);color:rgba(234,234,234,0.6);font-weight:500;font-size:1rem;border-radius:0.75rem;transition:all 0.3s;text-decoration:none;border:1px solid rgba(255,255,255,0.08)" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.color='#EAEAEA'" onmouseout="this.style.background='rgba(255,255,255,0.04)';this.style.color='rgba(234,234,234,0.6)'">
                Browse All EAs
                <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>
@endsection
