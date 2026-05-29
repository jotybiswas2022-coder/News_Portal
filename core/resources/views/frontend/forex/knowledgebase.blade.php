@extends('frontend.forex.layouts.app')

@section('title', 'Knowledge Base — SMART BINARY ZONE')

@section('content')
<style>
/* ===== KNOWLEDGE BASE STYLES ===== */
.kb-px{padding-left:1rem;padding-right:1rem}
@media (min-width:640px){.kb-px{padding-left:1.5rem;padding-right:1.5rem}}
@media (min-width:1024px){.kb-px{padding-left:2rem;padding-right:2rem}}

/* Category Buttons */
.cat-btn{width:100%;text-align:left;padding:0.5rem 0.75rem;border-radius:0.5rem;font-size:0.875rem;transition:all 0.2s;cursor:pointer;display:flex;align-items:center;gap:0.5rem;background:transparent;border:none;color:rgba(234,234,234,0.6)}
.cat-btn:hover{color:#EAEAEA;background:rgba(255,255,255,0.04)}
.cat-btn.active{color:#005fe7;background:rgba(0,95,231,0.05)}

/* Search Input */
.kb-search-input{width:100%;background:rgba(5,5,15,0.6);border:1px solid rgba(255,255,255,0.08);border-radius:0.75rem;padding:0.875rem 1rem 0.875rem 2.75rem;font-size:0.9375rem;color:#EAEAEA;transition:all 0.3s;box-sizing:border-box}
.kb-search-input:focus{border-color:#005fe7;box-shadow:0 0 0 3px rgba(34,85,255,0.15);outline:none}
.kb-search-input::placeholder{color:rgba(234,234,234,0.3)}

/* Article Cards */
.kb-article{transition:all 0.4s cubic-bezier(0.4,0,0.2,1);cursor:default}
.kb-article:hover{transform:translateY(-4px)}

/* Read More Button */
.kb-read-btn{font-size:0.8rem;cursor:pointer;display:inline-flex;align-items:center;gap:0.375rem;background:none;border:none;padding:0;font-weight:500;transition:all 0.3s}
.kb-read-btn:hover{gap:0.625rem}
</style>

<!-- ==================== HERO ==================== -->
<section style="position:relative;min-height:45vh;display:flex;align-items:center;padding-top:6rem;padding-bottom:3rem;overflow:hidden">
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="grid-bg" style="position:absolute;inset:0;opacity:0.4;pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:56rem;margin:0 auto;padding-left:1rem;padding-right:1rem;width:100%;text-align:center">
        <div class="badge animate-fade-in-up" style="animation:fadeInUp 0.6s ease 0s both"><span class="badge-dot"></span> Learning Center</div>
        <h1 style="font-family:'Bebas Neue','Oswald',sans-serif;font-size:clamp(2rem,5vw,3.5rem);font-weight:700;color:#EAEAEA;margin-bottom:0.75rem;animation:fadeInUp 0.6s ease 0.1s both;line-height:1.1">
            Knowledge <span class="gradient-text">Base</span>
        </h1>
        <p style="color:rgba(234,234,234,0.5);font-size:1.05rem;margin-bottom:2rem;animation:fadeInUp 0.6s ease 0.2s both;line-height:1.6;max-width:32rem;margin-left:auto;margin-right:auto">
            Find answers, guides, and tutorials for your Expert Advisors
        </p>

        <!-- Search Bar -->
        <div style="max-width:36rem;margin:0 auto;animation:fadeInUp 0.6s ease 0.3s both" class="reveal">
            <div class="glass-card" style="padding:0.5rem;display:flex;align-items:center;gap:0.5rem;border-radius:0.875rem;transition:all 0.3s"
                 onmouseover="this.style.boxShadow='0 8px 32px rgba(0,0,0,0.3), 0 0 0 1px rgba(34,85,255,0.1)'"
                 onmouseout="this.style.boxShadow='none'">
                <div style="flex:1;position:relative">
                    <svg style="position:absolute;left:0.875rem;top:50%;transform:translateY(-50%);width:1rem;height:1rem;color:rgba(234,234,234,0.3);pointer-events:none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" id="kbSearch" class="kb-search-input" placeholder="Search articles, topics, keywords..." oninput="filterArticles()" style="padding-left:2.75rem">
                </div>
                <button onclick="document.getElementById('kbSearch').focus()" style="display:flex;align-items:center;gap:0.375rem;padding:0.625rem 1.25rem;background:linear-gradient(135deg,#005fe7,#2255ff);color:white;font-weight:600;font-size:0.8125rem;border-radius:0.625rem;border:none;cursor:pointer;transition:all 0.3s;white-space:nowrap"
                        onmouseover="this.style.boxShadow='0 4px 16px rgba(34,85,255,0.3)';this.style.transform='translateY(-1px)'"
                        onmouseout="this.style.boxShadow='none';this.style.transform=''">
                    <svg style="width:0.875rem;height:0.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Search
                </button>
            </div>
        </div>
    </div>
</section>

<!-- ==================== CONTENT ==================== -->
<section style="padding-top:2rem;padding-bottom:6rem;position:relative;overflow:hidden">
    <div class="orb orb-brand" style="position:absolute;top:50%;right:0;transform:translate(50%,-50%);opacity:0.03;width:500px;height:500px;border-radius:50%;background:rgba(34,85,255,0.15);filter:blur(100px);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto" class="kb-px">
        <div style="display:grid;grid-template-columns:1fr;gap:2rem">
            <style>
                @media (min-width:1024px){.kb-main-grid{grid-template-columns:1fr 3fr}}
                @media (min-width:768px){.kb-card-grid{grid-template-columns:repeat(2,1fr)!important}}
                @media (min-width:1024px){.kb-card-grid{grid-template-columns:repeat(3,1fr)!important}}
            </style>

            <!-- Categories Sidebar -->
            <div>
                <div class="glass-card reveal" style="padding:1.25rem;position:sticky;top:7rem;transition:all 0.3s">
                    <h3 style="color:#EAEAEA;font-weight:600;font-size:0.875rem;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:1rem;display:flex;align-items:center;gap:0.5rem">
                        <svg style="width:1rem;height:1rem;color:#005fe7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                        Categories
                    </h3>
                    <div style="display:flex;flex-direction:column;gap:0.25rem" id="categoryList">
                        <button onclick="filterByCategory('all')" class="cat-btn active" data-cat="all" style="color:#005fe7;background:rgba(0,95,231,0.05)">
                            <svg style="width:0.875rem;height:0.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0l-4-4m4 4l-4 4"/></svg>
                            All Categories
                        </button>
                        @foreach($categories as $cat)
                        <button onclick="filterByCategory('{{ $cat }}')" class="cat-btn" data-cat="{{ $cat }}">
                            <span style="width:0.375rem;height:0.375rem;border-radius:50%;background:rgba(0,95,231,0.5);display:inline-block"></span>
                            {{ $cat }}
                        </button>
                        @endforeach
                    </div>

                    <!-- Results Count -->
                    <div style="margin-top:1rem;padding-top:1rem;border-top:1px solid rgba(255,255,255,0.04)">
                        <p id="kbResultCount" style="color:rgba(234,234,234,0.3);font-size:0.75rem;margin:0;text-align:center">
                            {{ count($articles) }} articles
                        </p>
                    </div>
                </div>
            </div>

            <!-- Articles -->
            <div>
                <div id="kbArticles" style="display:grid;grid-template-columns:1fr;gap:1.25rem" class="kb-card-grid">
                    @foreach($articles as $i => $article)
                    @php
                        $icons = ['book-open','shield-check','download','help-circle','sliders','globe','server','key','trending-up','settings','layout','layers'];
                        $icon = $icons[$i % count($icons)];
                        $colors = ['#005fe7','#ff2d78','#2255ff','#ff1177','#005fe7','#ff2d78','#2255ff','#ff1177','#005fe7','#ff2d78','#2255ff','#ff1177'];
                        $accent = $colors[$i % count($colors)];
                        $contentPreview = Str::limit($article['content'], 120);
                    @endphp
                    <div class="kb-article glass-card" style="padding:0;overflow:hidden;transition-delay:{{ ($i % 12) * 0.04 }}s"
                         data-category="{{ $article['category'] }}"
                         data-title="{{ strtolower($article['title']) }}"
                         data-content="{{ strtolower($article['content']) }}"
                         onmouseover="this.style.boxShadow='0 16px 48px -8px rgba(0,0,0,0.4), 0 0 0 1px {{ $accent }}22'"
                         onmouseout="this.style.boxShadow='none'">
                        <!-- Accent top bar -->
                        <div style="height:3px;background:linear-gradient(90deg,{{ $accent }},{{ $accent }}44,transparent)"></div>

                        <div style="padding:1.5rem">
                            <!-- Icon + Category row -->
                            <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1rem">
                                <div style="width:2.25rem;height:2.25rem;border-radius:0.625rem;background:{{ $accent }}12;display:flex;align-items:center;justify-content:center;flex-shrink:0;border:1px solid {{ $accent }}22;transition:all 0.3s"
                                     onmouseover="this.style.background='{{ $accent }}22';this.style.borderColor='{{ $accent }}44'"
                                     onmouseout="this.style.background='{{ $accent }}12';this.style.borderColor='{{ $accent }}22'">
                                    @if($icon == 'book-open')
                                    <svg style="width:1.125rem;height:1.125rem;color:{{ $accent }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    @elseif($icon == 'shield-check')
                                    <svg style="width:1.125rem;height:1.125rem;color:{{ $accent }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    @elseif($icon == 'download')
                                    <svg style="width:1.125rem;height:1.125rem;color:{{ $accent }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    @elseif($icon == 'help-circle')
                                    <svg style="width:1.125rem;height:1.125rem;color:{{ $accent }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    @elseif($icon == 'sliders')
                                    <svg style="width:1.125rem;height:1.125rem;color:{{ $accent }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                                    @elseif($icon == 'globe')
                                    <svg style="width:1.125rem;height:1.125rem;color:{{ $accent }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    @elseif($icon == 'server')
                                    <svg style="width:1.125rem;height:1.125rem;color:{{ $accent }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/></svg>
                                    @elseif($icon == 'key')
                                    <svg style="width:1.125rem;height:1.125rem;color:{{ $accent }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                    @elseif($icon == 'trending-up')
                                    <svg style="width:1.125rem;height:1.125rem;color:{{ $accent }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                                    @elseif($icon == 'settings')
                                    <svg style="width:1.125rem;height:1.125rem;color:{{ $accent }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    @elseif($icon == 'layout')
                                    <svg style="width:1.125rem;height:1.125rem;color:{{ $accent }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/></svg>
                                    @elseif($icon == 'layers')
                                    <svg style="width:1.125rem;height:1.125rem;color:{{ $accent }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0l-4-4m4 4l-4 4"/></svg>
                                    @endif
                                </div>
                                <span style="padding:0.25rem 0.625rem;background:{{ $accent }}10;color:{{ $accent }};font-size:0.7rem;font-weight:500;border-radius:9999px;border:1px solid {{ $accent }}20;text-transform:uppercase;letter-spacing:0.03em">{{ $article['category'] }}</span>
                                <span style="margin-left:auto;color:rgba(234,234,234,0.2);font-size:0.7rem;display:flex;align-items:center;gap:0.25rem;white-space:nowrap">
                                    <svg style="width:0.7rem;height:0.7rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ rand(3, 15) }} min
                                </span>
                            </div>

                            <h3 style="color:#EAEAEA;font-weight:600;font-size:1.05rem;margin-bottom:0.5rem;line-height:1.35;transition:color 0.3s" onmouseover="this.style.color='{{ $accent }}'" onmouseout="this.style.color='#EAEAEA'">{{ $article['title'] }}</h3>
                            <p style="color:rgba(234,234,234,0.5);font-size:0.825rem;line-height:1.6;margin-bottom:0">{{ $contentPreview }}</p>

                            <div style="margin-top:1rem;padding-top:0.75rem;border-top:1px solid rgba(255,255,255,0.04);display:flex;align-items:center;justify-content:space-between">
                                <button onclick="toggleArticle(this)" class="kb-read-btn" style="color:{{ $accent }}" data-expanded="false"
                                        onmouseover="this.style.color='{{ $accent }}';this.querySelector('.arrow-icon').style.transform='translateX(4px)'"
                                        onmouseout="this.querySelector('.arrow-icon').style.transform='translateX(0)'">
                                    <span>Read More</span>
                                    <svg style="width:0.75rem;height:0.75rem;transition:transform 0.3s" class="arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </button>
                                <span style="color:rgba(234,234,234,0.2);font-size:0.7rem">{{ $article['date'] }}</span>
                            </div>

                            <div class="article-full" style="display:none;margin-top:1rem;padding-top:1rem;border-top:1px solid rgba(255,255,255,0.06);color:rgba(234,234,234,0.6);font-size:0.85rem;line-height:1.7">
                                {{ $article['content'] }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- No results -->
                <div id="kbNoResults" style="display:none;text-align:center;padding-top:4rem;padding-bottom:4rem">
                    <div class="glass-card" style="width:5rem;height:5rem;margin:0 auto 1.25rem;border-radius:1rem;display:flex;align-items:center;justify-content:center;padding:0">
                        <svg style="width:2.25rem;height:2.25rem;color:rgba(234,234,234,0.15)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <h3 style="color:#EAEAEA;font-weight:600;font-size:1.125rem;margin-bottom:0.5rem">No Articles Found</h3>
                    <p style="color:rgba(234,234,234,0.4);font-size:0.875rem;margin-bottom:1.5rem;max-width:24rem;margin-left:auto;margin-right:auto;line-height:1.6">We couldn't find any articles matching your search. Try a different keyword or browse all categories.</p>
                    <button onclick="resetFilters()" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.625rem 1.5rem;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);color:rgba(234,234,234,0.7);font-weight:500;font-size:0.8125rem;border-radius:0.625rem;cursor:pointer;transition:all 0.3s"
                            onmouseover="this.style.borderColor='rgba(34,85,255,0.2)';this.style.background='rgba(34,85,255,0.04)'"
                            onmouseout="this.style.borderColor='rgba(255,255,255,0.08)';this.style.background='rgba(255,255,255,0.04)'">
                        <svg style="width:0.875rem;height:0.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Reset Filters
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
let activeCategory = 'all';

function filterArticles() {
    const query = (document.getElementById('kbSearch').value || '').toLowerCase();
    const articles = document.querySelectorAll('.kb-article');
    let visible = 0;
    articles.forEach(a => {
        const title = a.dataset.title || '';
        const content = a.dataset.content || '';
        const cat = a.dataset.category;
        const match = (title.includes(query) || content.includes(query)) && (activeCategory === 'all' || cat === activeCategory);
        a.style.display = match ? 'block' : 'none';
        if (match) visible++;
    });
    document.getElementById('kbNoResults').style.display = visible > 0 ? 'none' : 'block';
    const countEl = document.getElementById('kbResultCount');
    if (countEl) {
        const total = document.querySelectorAll('.kb-article').length;
        if (activeCategory !== 'all' || query) {
            countEl.textContent = visible + ' of ' + total + ' articles';
        } else {
            countEl.textContent = total + ' articles';
        }
    }
}

function filterByCategory(cat) {
    activeCategory = cat;
    document.querySelectorAll('.cat-btn').forEach(b => {
        const isActive = b.dataset.cat === cat;
        b.style.color = isActive ? '#005fe7' : 'rgba(234,234,234,0.6)';
        b.style.background = isActive ? 'rgba(0,95,231,0.05)' : 'transparent';
    });
    filterArticles();
}

function toggleArticle(btn) {
    const article = btn.closest('.kb-article');
    const content = article.querySelector('.article-full');
    const isHidden = content.style.display === 'none' || content.style.display === '';
    content.style.display = isHidden ? 'block' : 'none';
    btn.innerHTML = isHidden
        ? 'Show Less <svg style="width:0.75rem;height:0.75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>'
        : 'Read More <svg style="width:0.75rem;height:0.75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>';
    if (isHidden) {
        article.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
}

function resetFilters() {
    document.getElementById('kbSearch').value = '';
    filterByCategory('all');
}
</script>
@endsection
