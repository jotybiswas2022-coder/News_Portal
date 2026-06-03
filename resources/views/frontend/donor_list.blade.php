@extends('frontend.app')

@section('skeleton')
    {{-- ===== DONOR LIST SKELETON ===== --}}
    <div style="padding-top:72px;">
        {{-- Hero Skeleton --}}
        <div style="background:rgba(255,255,255,0.02);padding:60px 20px;">
            <div style="max-width:1200px;margin:0 auto;">
                <div style="margin-bottom:24px;">
                    <div class="sk-block" style="width:160px;height:30px;border-radius:50px;"></div>
                </div>
                <div class="sk-block" style="width:50%;height:42px;margin-bottom:12px;"></div>
                <div class="sk-block" style="width:35%;height:42px;margin-bottom:20px;"></div>
                <div class="sk-block" style="width:40%;height:18px;"></div>
                <div style="display:flex;gap:40px;margin-top:36px;padding-top:24px;border-top:1px solid rgba(255,255,255,0.05);">
                    <div><div class="sk-block" style="width:70px;height:32px;margin-bottom:6px;"></div><div class="sk-block" style="width:90px;height:14px;"></div></div>
                    <div><div class="sk-block" style="width:50px;height:32px;margin-bottom:6px;"></div><div class="sk-block" style="width:80px;height:14px;"></div></div>
                    <div><div class="sk-block" style="width:60px;height:32px;margin-bottom:6px;"></div><div class="sk-block" style="width:70px;height:14px;"></div></div>
                </div>
            </div>
        </div>

        {{-- Filter & Table Skeleton --}}
        <div style="padding:32px 20px 0;background:linear-gradient(180deg,#f8f9fa,#fff);">
            <div style="max-width:1200px;margin:0 auto;">
                {{-- Filter Card --}}
                <div style="padding:24px 28px;background:#fff;border-radius:20px;border:1px solid #f3f4f6;margin-bottom:28px;">
                    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:18px;">
                        <div style="display:flex;align-items:center;gap:8px;">
                            <div class="sk-block" style="width:20px;height:20px;border-radius:4px;"></div>
                            <div class="sk-block" style="width:60px;height:18px;"></div>
                        </div>
                        <div style="display:flex;gap:12px;">
                            <div class="sk-block" style="width:220px;height:40px;border-radius:10px;"></div>
                            <div class="sk-block" style="width:160px;height:40px;border-radius:10px;"></div>
                        </div>
                    </div>
                    <div style="display:flex;gap:8px;flex-wrap:wrap;">
                        @for($i=0;$i<9;$i++)
                        <div class="sk-block" style="width:{{ 50 + $i * 8 }}px;height:34px;border-radius:50px;"></div>
                        @endfor
                    </div>
                </div>

                {{-- Table Card --}}
                <div style="background:#fff;border-radius:20px;overflow:hidden;border:1px solid #f3f4f6;">
                    <div style="padding:18px 28px;background:rgba(220,38,38,0.15);display:flex;align-items:center;justify-content:space-between;">
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div class="sk-block" style="width:20px;height:20px;border-radius:4px;"></div>
                            <div class="sk-block" style="width:160px;height:18px;"></div>
                        </div>
                        <div class="sk-block" style="width:100px;height:28px;border-radius:50px;"></div>
                    </div>
                    <div style="padding:0 28px;">
                        @for($i=0;$i<5;$i++)
                        <div style="display:flex;align-items:center;gap:16px;padding:16px 0;{{ $i < 4 ? 'border-bottom:1px solid #f3f4f6;' : '' }}">
                            <div class="sk-block" style="width:30px;height:16px;"></div>
                            <div style="display:flex;align-items:center;gap:12px;flex:2;">
                                <div class="sk-circle" style="width:38px;height:38px;flex-shrink:0;"></div>
                                <div class="sk-block" style="width:120px;height:16px;"></div>
                            </div>
                            <div style="flex:1.5;"><div class="sk-block" style="width:100px;height:16px;"></div></div>
                            <div style="flex:1;"><div class="sk-block" style="width:60px;height:24px;border-radius:50px;"></div></div>
                            <div style="flex:1;"><div class="sk-block" style="width:80px;height:16px;"></div></div>
                            <div style="flex:1.5;"><div class="sk-block" style="width:110px;height:24px;border-radius:50px;"></div></div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <!-- ========== HERO SECTION ========== -->
    <section class="donor-hero">
        <div class="hero-particles">
            <div class="particle" style="--x: 15%; --y: 30%; --size: 5px; --delay: 0s;"></div>
            <div class="particle" style="--x: 50%; --y: 60%; --size: 4px; --delay: 1.5s;"></div>
            <div class="particle" style="--x: 80%; --y: 20%; --size: 6px; --delay: 0.8s;"></div>
            <div class="particle" style="--x: 30%; --y: 80%; --size: 3px; --delay: 2.2s;"></div>
            <div class="particle" style="--x: 70%; --y: 50%; --size: 5px; --delay: 0.4s;"></div>
            <div class="particle" style="--x: 90%; --y: 70%; --size: 4px; --delay: 1.1s;"></div>
            <div class="particle" style="--x: 10%; --y: 45%; --size: 3px; --delay: 1.8s;"></div>
            <div class="particle" style="--x: 60%; --y: 85%; --size: 5px; --delay: 0.6s;"></div>
        </div>

        <div class="container">
            <div class="hero-content animate-in">
                <div class="hero-badge">
                    <div class="pulse-dot"></div>
                    <span class="badge-text">রক্তদাতা তালিকা</span>
                </div>
                <h1>
                    রক্তদাতা খুঁজুন<br>
                    <span class="highlight">জীবন বাঁচান</span>
                </h1>
                <p>জীবন বাঁচান, রক্ত দিন। আমাদের নিবন্ধিত রক্তদাতাদের সাথে যোগাযোগ করুন।</p>

                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">{{ $sortedDonors->count() }}</span>
                        <span class="stat-label">মোট ডোনার</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">৮</span>
                        <span class="stat-label">ব্লাড গ্রুপ</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">২৪/৭</span>
                        <span class="stat-label">জরুরি সেবা</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== FILTER SECTION ========== -->
    <section class="filter-section">
        <div class="container">
            <div class="filter-card">
                <div class="filter-header">
                    <div class="filter-label">
                        <i class="bi bi-funnel-fill"></i> ফিল্টার
                    </div>
                    <div class="filter-header-right">
                        <div class="search-wrap">
                            <i class="bi bi-search"></i>
                            <input type="text" id="searchInput" placeholder="নাম বা মোবাইল দিয়ে খুঁজুন..." onkeyup="searchDonors(this.value)">
                        </div>
                        <div class="select-wrap">
                            <i class="bi bi-geo-alt-fill"></i>
                            <select onchange="filterDivision(this.value)">
                                <option value="all">সব বিভাগ</option>
                                <option value="Dhaka">ঢাকা</option>
                                <option value="Chattogram">চট্টগ্রাম</option>
                                <option value="Khulna">খুলনা</option>
                                <option value="Rajshahi">রাজশাহী</option>
                                <option value="Barishal">বরিশাল</option>
                                <option value="Sylhet">সিলেট</option>
                                <option value="Rangpur">রংপুর</option>
                                <option value="Mymensingh">ময়মনসিংহ</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="filter-chips-wrap">
                    <div class="filter-chips">
                        <a href="/donor_list" class="filter-chip {{ !$bloodGroup ? 'active' : '' }}">সব</a>
                        <a href="/donor_list/A%2B" class="filter-chip {{ $bloodGroup === 'A+' ? 'active' : '' }}">A+</a>
                        <a href="/donor_list/A%2D" class="filter-chip {{ $bloodGroup === 'A-' ? 'active' : '' }}">A−</a>
                        <a href="/donor_list/B%2B" class="filter-chip {{ $bloodGroup === 'B+' ? 'active' : '' }}">B+</a>
                        <a href="/donor_list/B%2D" class="filter-chip {{ $bloodGroup === 'B-' ? 'active' : '' }}">B−</a>
                        <a href="/donor_list/O%2B" class="filter-chip {{ $bloodGroup === 'O+' ? 'active' : '' }}">O+</a>
                        <a href="/donor_list/O%2D" class="filter-chip {{ $bloodGroup === 'O-' ? 'active' : '' }}">O−</a>
                        <a href="/donor_list/AB%2B" class="filter-chip {{ $bloodGroup === 'AB+' ? 'active' : '' }}">AB+</a>
                        <a href="/donor_list/AB%2D" class="filter-chip {{ $bloodGroup === 'AB-' ? 'active' : '' }}">AB−</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== DONOR TABLE ========== -->
    <section class="donor-section">
        <div class="container">
            <div class="donor-card">
                <div class="donor-card-header">
                    <h3>
                        <i class="bi bi-people-fill"></i>
                        <span id="header-title">@if($bloodGroup) {{ $bloodGroup }} ব্লাড গ্রুপের ডোনার @else সব ডোনার @endif</span>
                    </h3>
                    <span class="donor-count-badge" id="donor-count">মোট: {{ $sortedDonors->count() }} জন</span>
                </div>

                <div class="table-scroll-top" id="tableScrollTop"></div>
                <div class="table-wrapper" id="tableWrapper">
                    <table class="donor-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>নাম</th>
                                <th>মোবাইল</th>
                                <th>রক্তের গ্রুপ</th>
                                <th>বিভাগ</th>
                                <th>পরবর্তী রক্তদান</th>
                            </tr>
                        </thead>
                        <tbody id="donor-tbody">
                            @php $ser = 1; @endphp
                            @forelse($sortedDonors as $donor)
                            <tr data-blood="{{ $donor->blood }}" data-name="{{ $donor->name }}" data-mobile="{{ $donor->number }}">
                                <td class="serial">{{ $ser++ }}</td>
                                <td>
                                    <div class="donor-name-cell">
                                        <div class="donor-avatar">{{ mb_substr($donor->name, 0, 1) }}</div>
                                        <span>{{ $donor->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <a href="tel:{{ $donor->number }}" class="phone-link">
                                        <i class="bi bi-telephone-fill"></i>
                                        {{ $donor->number }}
                                    </a>
                                </td>
                                <td>
                                    <span class="blood-badge blood-{{ strtolower(str_replace(['+','-'], ['pos','neg'], $donor->blood)) }}">
                                        {{ $donor->blood }}
                                    </span>
                                </td>
                                <td>
                                    <span class="division-text">
                                        <i class="bi bi-geo-alt-fill"></i> {{ $donor->division }}
                                    </span>
                                </td>
                                <td>
                                    @if($donor->last_donated)
                                        @php
                                            $nextDate = \Carbon\Carbon::parse($donor->nextDonationDate());
                                            $today = now()->startOfDay();
                                            $diffDays = $today->diffInDays($nextDate, false);
                                        @endphp
                                        <span class="eligible-badge
                                            @if($diffDays <= 0) eligible-now
                                            @elseif($diffDays === 0) eligible-today
                                            @elseif($diffDays === 1) eligible-soon
                                            @else eligible-waiting @endif">
                                            @if($diffDays <= 0)
                                                <i class="bi bi-check-circle-fill"></i> এখনই দিতে পারবেন
                                            @else
                                                {{ $nextDate->format('d M Y') }}
                                                (আর {{ $diffDays }} দিন)
                                            @endif
                                        </span>
                                    @else
                                        <span class="eligible-badge eligible-now">
                                            <i class="bi bi-check-circle-fill"></i> এখনই দিতে পারবেন
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr id="empty-row">
                                <td colspan="6" class="empty-state">
                                    <div class="empty-content">
                                        <i class="bi bi-people"></i>
                                        <h4>কোনো ডোনার পাওয়া যায়নি</h4>
                                        <p>এই ফিল্টারে কোনো রক্তদাতা নেই। অনুগ্রহ করে ভিন্ন গ্রুপ বা বিভাগ নির্বাচন করুন।</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== FOOTER ========== -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="logo-icon">
                        <i class="bi bi-droplet-fill"></i>
                    </div>
                    <div>
                        <span class="brand-name">ব্লাড ব্যাংক</span>
                        <span class="brand-tagline">জীবন বাঁচানোর লক্ষ্যে</span>
                    </div>
                </div>

                <div class="footer-links">
                    <div class="footer-links-col">
                        <h6>কুইক লিংক</h6>
                        <a href="/">হোম</a>
                        <a href="/donor_list">ডোনার তালিকা</a>
                        <a href="/login">লগইন</a>
                        <a href="/register">রেজিস্ট্রেশন</a>
                    </div>
                    <div class="footer-links-col">
                        <h6>সেবাসমূহ</h6>
                        <a href="/donor_list/A+">A+ ডোনার</a>
                        <a href="/donor_list/B+">B+ ডোনার</a>
                        <a href="/donor_list/O+">O+ ডোনার</a>
                        <a href="/donor_list/AB+">AB+ ডোনার</a>
                    </div>
                </div>

                <div class="footer-social">
                    <h6>ফলো করুন</h6>
                    <div class="social-icons">
                        <a href="#" class="social-icon facebook" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon twitter" title="Twitter"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-icon whatsapp" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                        <a href="#" class="social-icon youtube" title="YouTube"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; ২০২৫ ব্লাড ব্যাংক। সর্বস্বত্ব সংরক্ষিত।</p>
                <p class="footer-made-with">হৃদয় দিয়ে তৈরি <span class="heart">❤️</span></p>
            </div>
        </div>
    </footer>

    <!-- ========== SCRIPTS ========== -->
    <script>
    // Sync top scrollbar with table wrapper
    document.addEventListener('DOMContentLoaded', function() {
        const tableWrapper = document.getElementById('tableWrapper');
        const scrollTop = document.getElementById('tableScrollTop');

        if (tableWrapper && scrollTop) {
            // Set top scrollbar width to match table content
            function syncScrollbars() {
                const table = tableWrapper.querySelector('table');
                if (table) {
                    scrollTop.style.width = tableWrapper.clientWidth + 'px';
                    scrollTop.innerHTML = '<div style="width:' + table.scrollWidth + 'px;height:1px;"></div>';
                }
            }

            syncScrollbars();
            window.addEventListener('resize', syncScrollbars);

            // Sync top -> bottom
            scrollTop.addEventListener('scroll', function() {
                tableWrapper.scrollLeft = this.scrollLeft;
            });

            // Sync bottom -> top
            tableWrapper.addEventListener('scroll', function() {
                scrollTop.scrollLeft = this.scrollLeft;
            });

            // Re-sync after filter changes
            const origApply = window.applyFilter;
            window.applyFilter = function() {
                origApply();
                setTimeout(syncScrollbars, 50);
            };
        }
    });

    let currentDivision = 'all';
    let currentSearch = '';

    function filterDivision(val) {
        currentDivision = val;
        applyFilter();
    }

    function searchDonors(val) {
        currentSearch = val.trim().toLowerCase();
        applyFilter();
    }

    function applyFilter() {
        const rows = document.querySelectorAll('#donor-tbody tr[data-blood]');
        let visible = 0;
        rows.forEach(row => {
            const blood = row.getAttribute('data-blood');
            const name = row.getAttribute('data-name').toLowerCase();
            const mobile = row.getAttribute('data-mobile').toLowerCase();
            const divisionEl = row.querySelector('.division-text');
            const division = divisionEl ? divisionEl.textContent.trim() : '';

            const divisionMatch = currentDivision === 'all' || division.includes(currentDivision);
            const searchMatch = !currentSearch || name.includes(currentSearch) || mobile.includes(currentSearch);

            if (divisionMatch && searchMatch) {
                row.style.display = '';
                visible++;
            } else {
                row.style.display = 'none';
            }
        });

        let serial = 1;
        rows.forEach(row => {
            if (row.style.display !== 'none') {
                const td = row.querySelector('td.serial');
                if (td) td.textContent = serial++;
            }
        });

        document.getElementById('donor-count').textContent = 'মোট: ' + visible + ' জন';

        let emptyRow = document.getElementById('empty-row');
        if (visible === 0) {
            if (!emptyRow) {
                emptyRow = document.createElement('tr');
                emptyRow.id = 'empty-row';
                emptyRow.innerHTML = '<td colspan="6" class="empty-state"><div class="empty-content"><i class="bi bi-people"></i><h4>কোনো ডোনার পাওয়া যায়নি</h4><p>এই ফিল্টারে কোনো রক্তদাতা নেই। অনুগ্রহ করে ভিন্ন গ্রুপ বা বিভাগ নির্বাচন করুন।</p></div></td>';
                document.getElementById('donor-tbody').appendChild(emptyRow);
            }
            emptyRow.style.display = '';
        } else {
            if (emptyRow) emptyRow.style.display = 'none';
        }
    }
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800&display=swap');

        :root {
            --primary: #dc2626;
            --primary-light: #ef4444;
            --primary-dark: #b91c1c;
            --dark: #1a1a2e;
            --dark-2: #16213e;
            --dark-3: #0f3460;
            --text: #374151;
            --text-light: #6b7280;
            --white: #ffffff;
            --radius: 12px;
            --radius-lg: 20px;
            --shadow: 0 4px 20px rgba(0,0,0,0.06);
            --shadow-hover: 0 20px 50px rgba(220, 38, 38, 0.15);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', 'Noto Sans Bengali', sans-serif;
            color: var(--text);
            background: var(--dark);
            overflow-x: hidden;
            padding-top: 72px;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 72px;
        }

        /* ===== HERO SECTION ===== */
        .donor-hero {
            background: linear-gradient(135deg, var(--dark) 0%, var(--dark-2) 50%, var(--dark-3) 100%);
            color: white;
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }

        .donor-hero::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(220, 38, 38, 0.12) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-particles {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: var(--size);
            height: var(--size);
            left: var(--x);
            top: var(--y);
            background: rgba(239, 68, 68, 0.4);
            border-radius: 50%;
            animation: float-particle 6s ease-in-out infinite;
            animation-delay: var(--delay);
        }

        @keyframes float-particle {
            0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.4; }
            25% { transform: translate(30px, -20px) scale(1.2); opacity: 0.8; }
            50% { transform: translate(-20px, 30px) scale(0.8); opacity: 0.3; }
            75% { transform: translate(20px, 20px) scale(1.1); opacity: 0.6; }
        }

        .donor-hero .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }

        .hero-content { max-width: 700px; }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(220, 38, 38, 0.15);
            border: 1px solid rgba(220, 38, 38, 0.3);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            color: #fca5a5;
            margin-bottom: 24px;
            backdrop-filter: blur(10px);
        }

        .pulse-dot {
            width: 8px; height: 8px;
            background: var(--primary-light);
            border-radius: 50%;
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); box-shadow: 0 0 0 0 rgba(239,68,68,0.4); }
            50% { opacity: 0.6; transform: scale(1.3); box-shadow: 0 0 0 8px rgba(239,68,68,0); }
        }

        .hero-content h1 {
            font-size: 40px;
            font-weight: 900;
            line-height: 1.15;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }

        .hero-content h1 .highlight {
            background: linear-gradient(135deg, var(--primary-light), #f97316);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-content p {
            font-size: 16px;
            color: rgba(255,255,255,0.65);
            line-height: 1.8;
            margin-bottom: 0;
            max-width: 540px;
        }

        .hero-stats {
            display: flex;
            gap: 40px;
            margin-top: 36px;
            padding-top: 24px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .hero-stats .stat-item { text-align: left; }

        .hero-stats .stat-number {
            display: block;
            font-size: 32px;
            font-weight: 900;
            color: var(--primary-light);
            line-height: 1.1;
        }

        .hero-stats .stat-label {
            display: block;
            font-size: 13px;
            color: rgba(255,255,255,0.45);
            font-weight: 500;
            margin-top: 4px;
        }

        /* ===== FILTER SECTION ===== */
        .filter-section {
            background: linear-gradient(180deg, #f8f9fa 0%, var(--white) 100%);
            padding: 32px 0 0;
        }

        .filter-section .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        .filter-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            padding: 24px 28px;
            border: 1px solid #f3f4f6;
            transition: box-shadow 0.3s;
        }

        .filter-card:hover { box-shadow: 0 8px 32px rgba(0,0,0,0.08); }

        .filter-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 18px;
        }

        .filter-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
        }

        .filter-label i { color: var(--primary); }

        .filter-header-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .search-wrap {
            position: relative;
        }

        .search-wrap i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 14px;
        }

        .search-wrap input {
            padding: 10px 16px 10px 40px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
            color: var(--text);
            background: #fafafa;
            outline: none;
            min-width: 220px;
            transition: all 0.3s ease;
        }

        .search-wrap input:focus {
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.08);
        }

        .search-wrap input::placeholder { color: #9ca3af; }

        .select-wrap {
            position: relative;
        }

        .select-wrap i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 14px;
            pointer-events: none;
            z-index: 1;
        }

        .select-wrap select {
            padding: 10px 16px 10px 40px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
            color: var(--text);
            background: #fafafa url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236b7280' d='M6 8L1 3h10z'/%3E%3C/svg%3E") no-repeat right 12px center;
            outline: none;
            min-width: 160px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .select-wrap select:focus {
            border-color: var(--primary);
            background-color: white;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.08);
        }

        .filter-chips-wrap {
            padding-top: 4px;
        }

        .filter-chips {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .filter-chip {
            padding: 7px 18px;
            border-radius: 999px;
            border: 2px solid #e5e7eb;
            background: #fafafa;
            color: var(--text-light);
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s ease;
            user-select: none;
            font-family: inherit;
            text-decoration: none;
        }

        .filter-chip:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: #fef2f2;
            transform: translateY(-1px);
        }

        .filter-chip.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border-color: transparent;
            box-shadow: 0 3px 12px rgba(220, 38, 38, 0.3);
            transform: translateY(-1px);
        }

        /* ===== DONOR SECTION ===== */
        .donor-section {
            background: linear-gradient(180deg, var(--white) 0%, #f8f9fa 100%);
            padding: 28px 0 60px;
            min-height: 50vh;
        }

        .donor-section .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        .donor-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            overflow: hidden;
            border: 1px solid #f3f4f6;
            transition: box-shadow 0.3s;
        }

        .donor-card:hover { box-shadow: 0 8px 32px rgba(0,0,0,0.08); }

        .donor-card-header {
            background: linear-gradient(90deg, var(--primary-dark) 0%, var(--primary) 100%);
            padding: 18px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .donor-card-header h3 {
            color: white;
            font-size: 17px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .donor-card-header h3 i { font-size: 20px; }

        .donor-count-badge {
            background: rgba(255,255,255,0.15);
            color: white;
            font-size: 13px;
            font-weight: 600;
            padding: 6px 18px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,0.25);
        }

        /* ===== TABLE ===== */
        .table-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-scroll-top {
            overflow-x: auto;
            overflow-y: hidden;
            height: 10px;
            background: transparent;
            cursor: grab;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .donor-card:hover .table-scroll-top {
            opacity: 1;
        }

        .table-scroll-top::-webkit-scrollbar {
            height: 8px;
        }

        .table-scroll-top::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .table-scroll-top::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        .table-scroll-top::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }

        .table-wrapper::-webkit-scrollbar {
            height: 8px;
        }

        .table-wrapper::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .table-wrapper::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        .table-wrapper::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }

        .donor-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .donor-table thead tr {
            background: #fef2f2;
            border-bottom: 2px solid #fee2e2;
        }

        .donor-table thead th {
            padding: 14px 18px;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            color: var(--primary-dark);
            text-transform: uppercase;
            letter-spacing: 0.7px;
            white-space: nowrap;
            position: sticky;
            top: 0;
            background: #fef2f2;
            z-index: 2;
        }

        .donor-table tbody tr {
            border-bottom: 1px solid #f3f4f6;
            transition: background 0.2s ease;
        }

        .donor-table tbody tr:hover { background: #fef2f2; }
        .donor-table tbody tr:last-child { border-bottom: none; }

        .donor-table tbody td {
            padding: 14px 18px;
            color: var(--text);
            vertical-align: middle;
        }

        .donor-table tbody td.serial {
            font-weight: 700;
            color: var(--text-light);
            font-size: 13px;
            width: 50px;
        }

        .donor-name-cell {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            color: var(--dark);
        }

        .donor-avatar {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: 800;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(220, 38, 38, 0.2);
        }

        .phone-link {
            color: var(--text);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .phone-link:hover { color: var(--primary); }
        .phone-link i { color: #16a34a; font-size: 13px; }

        .division-text {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--text-light);
            font-size: 13px;
        }

        .division-text i {
            color: var(--primary);
            font-size: 12px;
        }

        /* ===== BLOOD BADGES ===== */
        .blood-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 14px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 0.4px;
            min-width: 50px;
        }

        .blood-apos  { background: #fee2e2; color: #b91c1c; border: 1.5px solid #fca5a5; }
        .blood-aneg  { background: #fce7f3; color: #9d174d; border: 1.5px solid #f9a8d4; }
        .blood-bpos  { background: #ffedd5; color: #9a3412; border: 1.5px solid #fdba74; }
        .blood-bneg  { background: #fef9c3; color: #854d0e; border: 1.5px solid #fde047; }
        .blood-abpos { background: #dbeafe; color: #1e40af; border: 1.5px solid #93c5fd; }
        .blood-abneg { background: #ede9fe; color: #5b21b6; border: 1.5px solid #c4b5fd; }
        .blood-opos  { background: #dcfce7; color: #14532d; border: 1.5px solid #86efac; }
        .blood-oneg  { background: #e0f2fe; color: #0c4a6e; border: 1.5px solid #7dd3fc; }

        /* ===== ELIGIBLE BADGES ===== */
        .eligible-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .eligible-now {
            background: #dcfce7;
            color: #16a34a;
            border: 1.5px solid #86efac;
        }

        .eligible-today {
            background: #dbeafe;
            color: #2563eb;
            border: 1.5px solid #93c5fd;
        }

        .eligible-soon {
            background: #fef9c3;
            color: #ca8a04;
            border: 1.5px solid #fde047;
        }

        .eligible-waiting {
            background: #ffedd5;
            color: #ea580c;
            border: 1.5px solid #fdba74;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state { padding: 60px 20px !important; }

        .empty-content {
            text-align: center;
            padding: 20px;
        }

        .empty-content i {
            font-size: 52px;
            color: #d1d5db;
            display: block;
            margin-bottom: 16px;
        }

        .empty-content h4 {
            font-size: 20px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 8px;
        }

        .empty-content p {
            font-size: 14px;
            color: var(--text-light);
            max-width: 360px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* ===== FOOTER ===== */
        .footer {
            background: var(--dark);
            color: white;
            padding: 60px 0 0;
        }

        .footer .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        .footer-content {
            display: grid;
            grid-template-columns: 1.5fr 1.5fr 1fr;
            gap: 40px;
            padding-bottom: 40px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .footer-brand { display: flex; align-items: flex-start; gap: 14px; }

        .footer-brand .logo-icon {
            width: 48px; height: 48px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; flex-shrink: 0;
        }

        .brand-name { display: block; font-size: 20px; font-weight: 800; margin-bottom: 2px; }
        .brand-tagline { display: block; font-size: 13px; color: rgba(255,255,255,0.4); }

        .footer-links { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }

        .footer-links-col h6, .footer-social h6 {
            font-size: 13px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 1px; color: rgba(255,255,255,0.4); margin-bottom: 16px;
        }

        .footer-links-col a {
            display: block;
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            padding: 4px 0;
            transition: all 0.3s;
        }

        .footer-links-col a:hover { color: var(--primary-light); padding-left: 4px; }

        .social-icons { display: flex; gap: 10px; }

        .social-icon {
            width: 42px; height: 42px;
            background: rgba(255,255,255,0.08);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 18px;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .social-icon:hover { transform: translateY(-3px); }
        .social-icon.facebook:hover { background: #1877f2; }
        .social-icon.twitter:hover { background: #1da1f2; }
        .social-icon.whatsapp:hover { background: #25d366; }
        .social-icon.youtube:hover { background: #ff0000; }

        .footer-bottom { display: flex; justify-content: space-between; align-items: center; padding: 24px 0; flex-wrap: wrap; gap: 8px; }
        .footer-bottom p { font-size: 13px; color: rgba(255,255,255,0.35); }
        .footer-made-with .heart { color: var(--primary-light); display: inline-block; animation: heartbeat 1.5s infinite; }

        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            10% { transform: scale(1.15); }
            20% { transform: scale(1); }
            30% { transform: scale(1.1); }
            40% { transform: scale(1); }
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 991.98px) {
            body { padding-top: 64px; }
            html { scroll-padding-top: 64px; }
            .hero-content h1 { font-size: 32px; }
            .hero-stats { gap: 28px; }
            .hero-stats .stat-number { font-size: 26px; }
            .filter-header { flex-direction: column; align-items: flex-start; }
            .filter-header-right { width: 100%; }
            .search-wrap input { min-width: 0; width: 100%; }
            .select-wrap select { min-width: 0; width: 100%; }
            .filter-header-right { flex-direction: column; }
            .search-wrap, .select-wrap { width: 100%; }
            .search-wrap input, .select-wrap select { width: 100%; }
            .footer-content { grid-template-columns: 1fr 1fr; gap: 30px; }
        }

        @media (max-width: 767.98px) {
            body { padding-top: 60px; }
            html { scroll-padding-top: 60px; }
            .donor-hero { padding: 40px 0; }
            .hero-content h1 { font-size: 26px; }
            .hero-content p { font-size: 14px; }
            .hero-badge { font-size: 11px; padding: 6px 14px; }
            .hero-stats { gap: 20px; margin-top: 24px; padding-top: 18px; }
            .hero-stats .stat-number { font-size: 22px; }
            .hero-stats .stat-label { font-size: 11px; }
            .filter-card { padding: 18px 16px; }
            .filter-chip { padding: 6px 14px; font-size: 13px; }
            .donor-card-header { padding: 14px 18px; }
            .donor-card-header h3 { font-size: 15px; }
            .donor-count-badge { font-size: 11px; padding: 4px 12px; }
            .donor-table thead th,
            .donor-table tbody td { padding: 11px 12px; }
            .donor-table { font-size: 13px; }
            .donor-avatar { width: 32px; height: 32px; font-size: 13px; }
            .blood-badge { font-size: 12px; padding: 3px 10px; }
            .eligible-badge { font-size: 11px; padding: 4px 10px; }
            .footer { padding: 40px 0 0; }
            .footer-content { grid-template-columns: 1fr; gap: 24px; text-align: center; }
            .footer-brand { flex-direction: column; align-items: center; }
            .footer-links { gap: 20px; }
            .social-icons { justify-content: center; }
            .footer-bottom { flex-direction: column; text-align: center; }
            .empty-content i { font-size: 40px; }
            .empty-content h4 { font-size: 17px; }
            .empty-content p { font-size: 13px; }
        }

        @media (max-width: 480px) {
            body { padding-top: 56px; }
            html { scroll-padding-top: 56px; }
            .donor-hero { padding: 28px 0; }
            .hero-content h1 { font-size: 22px; }
            .hero-content p { font-size: 13px; margin-bottom: 0; }
            .hero-stats .stat-number { font-size: 18px; }
            .hero-stats { gap: 14px; margin-top: 20px; padding-top: 16px; flex-wrap: wrap; }
            .hero-stats .stat-item { flex: 1; min-width: 60px; }
            .hero-stats .stat-label { font-size: 10px; }
            .hero-badge { font-size: 10px; padding: 5px 12px; margin-bottom: 16px; }
            .filter-card { padding: 14px 12px; border-radius: 14px; }
            .filter-label { font-size: 13px; }
            .filter-chips { gap: 6px; flex-wrap: nowrap; overflow-x: auto; padding-bottom: 6px; -webkit-overflow-scrolling: touch; }
            .filter-chips::-webkit-scrollbar { height: 3px; }
            .filter-chips::-webkit-scrollbar-thumb { background: #ddd; border-radius: 2px; }
            .filter-chip { padding: 5px 11px; font-size: 12px; flex-shrink: 0; }
            .search-wrap input, .select-wrap select { padding: 8px 12px 8px 34px; font-size: 13px; }
            .donor-card { border-radius: 14px; }
            .donor-card-header { padding: 12px 14px; flex-direction: column; align-items: flex-start; gap: 8px; }
            .donor-card-header h3 { font-size: 13px; }
            .donor-count-badge { font-size: 10px; padding: 3px 10px; }
            .donor-table thead th,
            .donor-table tbody td { padding: 9px 8px; }
            .donor-table { font-size: 12px; }
            .donor-table thead th { font-size: 10px; letter-spacing: 0.4px; padding: 10px 8px; }
            .donor-avatar { width: 28px; height: 28px; font-size: 11px; }
            .donor-name-cell { gap: 8px; }
            .blood-badge { font-size: 11px; padding: 2px 8px; min-width: 40px; }
            .eligible-badge { font-size: 10px; padding: 3px 8px; gap: 4px; }
            .phone-link { font-size: 12px; gap: 4px; }
            .phone-link i { font-size: 10px; }
            .division-text { font-size: 11px; }
            .footer { padding: 32px 0 0; }
            .footer-bottom p { font-size: 12px; }
            .empty-content i { font-size: 34px; }
            .empty-content h4 { font-size: 15px; }
            .empty-content p { font-size: 12px; }
        }

        @media (max-width: 360px) {
            body { padding-top: 52px; }
            html { scroll-padding-top: 52px; }
            .donor-hero { padding: 20px 0; }
            .hero-content h1 { font-size: 18px; }
            .hero-stats .stat-number { font-size: 15px; }
            .hero-stats { gap: 8px; }
            .hero-stats .stat-label { font-size: 9px; }
            .filter-card { padding: 10px 8px; border-radius: 10px; }
            .filter-label { font-size: 11px; }
            .filter-chip { padding: 4px 9px; font-size: 11px; }
            .search-wrap input, .select-wrap select { padding: 6px 8px 6px 30px; font-size: 12px; border-radius: 8px; }
            .search-wrap i, .select-wrap i { font-size: 12px; left: 10px; }
            .donor-card { border-radius: 10px; }
            .donor-card-header { padding: 10px 10px; }
            .donor-card-header h3 { font-size: 12px; gap: 6px; }
            .donor-count-badge { font-size: 9px; padding: 2px 8px; }
            .donor-table thead th,
            .donor-table tbody td { padding: 7px 5px; }
            .donor-table { font-size: 11px; }
            .donor-table thead th { font-size: 9px; letter-spacing: 0.3px; padding: 8px 5px; }
            .donor-table tbody td.serial { width: 28px; font-size: 10px; }
            .filter-chip { padding: 4px 8px; font-size: 10px; }
            .donor-avatar { width: 22px; height: 22px; font-size: 9px; }
            .donor-name-cell { gap: 6px; }
            .blood-badge { font-size: 9px; padding: 2px 6px; min-width: 32px; }
            .eligible-badge { font-size: 9px; padding: 2px 6px; }
            .division-text { font-size: 10px; }
            .phone-link { font-size: 10px; }
        }

        /* ===== LIGHT MODE OVERRIDES ===== */
        .light-mode body {
            background: var(--theme-bg);
        }

        .light-mode .donor-hero {
            background: var(--theme-hero-bg);
        }

        .light-mode .donor-hero::before {
            opacity: 0.35;
        }

        .light-mode .hero-content h1 {
            color: #1f2937;
        }

        .light-mode .hero-content h1 .highlight {
            -webkit-text-fill-color: transparent;
        }

        .light-mode .hero-content p {
            color: rgba(0, 0, 0, 0.5);
        }

        .light-mode .hero-badge {
            background: rgba(220, 38, 38, 0.08);
            border-color: rgba(220, 38, 38, 0.2);
            color: #dc2626;
        }

        .light-mode .hero-stats {
            border-top-color: rgba(0, 0, 0, 0.06);
        }

        .light-mode .hero-stats .stat-label {
            color: rgba(0, 0, 0, 0.4);
        }

        .light-mode .filter-section {
            background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
        }

        .light-mode .filter-card {
            background: #ffffff;
            border-color: #f3f4f6;
        }

        .light-mode .filter-label {
            color: #374151;
        }

        .light-mode .search-wrap input,
        .light-mode .select-wrap select {
            background: #fafafa;
            border-color: #e5e7eb;
            color: #374151;
        }

        .light-mode .search-wrap input:focus,
        .light-mode .select-wrap select:focus {
            border-color: #dc2626;
            background: #ffffff;
        }

        .light-mode .filter-chip {
            background: #fafafa;
            border-color: #e5e7eb;
            color: #6b7280;
        }

        .light-mode .filter-chip:hover {
            border-color: #dc2626;
            color: #dc2626;
            background: #fef2f2;
        }

        .light-mode .donor-section {
            background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
        }

        .light-mode .donor-card {
            background: #ffffff;
            border-color: #f3f4f6;
        }

        .light-mode .donor-table thead tr {
            background: #fef2f2;
            border-bottom-color: #fee2e2;
        }

        .light-mode .donor-table thead th {
            color: #b91c1c;
            background: #fef2f2;
        }

        .light-mode .donor-table tbody tr {
            border-bottom-color: #f3f4f6;
        }

        .light-mode .donor-table tbody tr:hover {
            background: #fef2f2;
        }

        .light-mode .donor-table tbody td {
            color: #374151;
        }

        .light-mode .donor-table tbody td.serial {
            color: #6b7280;
        }

        .light-mode .donor-name-cell {
            color: #1f2937;
        }

        .light-mode .phone-link {
            color: #374151;
        }

        .light-mode .division-text {
            color: #6b7280;
        }

        .light-mode .empty-content h4 {
            color: #374151;
        }

        .light-mode .empty-content p {
            color: #6b7280;
        }

        .light-mode .empty-content i {
            color: #d1d5db;
        }

        .light-mode .footer {
            background: var(--theme-footer-bg);
        }

        .light-mode .particle {
            background: rgba(220, 38, 38, 0.3);
        }
    </style>

@endsection