@extends('frontend.app')

@section('skeleton')
    {{-- ===== PROFILE EDIT SKELETON ===== --}}
    <div style="padding-top:72px;display:flex;align-items:flex-start;justify-content:center;padding:72px 20px 40px;min-height:60vh;">
        <div style="max-width:640px;width:100%;">
            <div style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.05);border-radius:24px;overflow:hidden;">
                {{-- Header --}}
                <div style="padding:28px 32px;display:flex;align-items:center;gap:18px;border-bottom:1px solid rgba(255,255,255,0.04);">
                    <div class="sk-block" style="width:54px;height:54px;border-radius:16px;flex-shrink:0;"></div>
                    <div>
                        <div class="sk-block" style="width:160px;height:20px;margin-bottom:6px;"></div>
                        <div class="sk-block" style="width:120px;height:14px;"></div>
                    </div>
                </div>
                {{-- Form --}}
                <div style="padding:28px 32px;">
                    @for($i=0;$i<3;$i++)
                    <div style="margin-bottom:22px;">
                        <div class="sk-block" style="width:100px;height:13px;margin-bottom:10px;"></div>
                        <div class="sk-block" style="width:100%;height:44px;border-radius:12px;"></div>
                    </div>
                    @endfor
                    <div style="display:flex;align-items:center;gap:12px;margin:6px 0 24px;">
                        <div class="sk-block" style="flex:1;height:1px;"></div>
                        <div class="sk-block" style="width:100px;height:12px;"></div>
                        <div class="sk-block" style="flex:1;height:1px;"></div>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:0 20px;">
                        <div style="margin-bottom:22px;">
                            <div class="sk-block" style="width:90px;height:13px;margin-bottom:10px;"></div>
                            <div class="sk-block" style="width:100%;height:44px;border-radius:12px;"></div>
                        </div>
                        <div style="margin-bottom:22px;">
                            <div class="sk-block" style="width:60px;height:13px;margin-bottom:10px;"></div>
                            <div class="sk-block" style="width:100%;height:44px;border-radius:12px;"></div>
                        </div>
                        <div style="margin-bottom:22px;">
                            <div class="sk-block" style="width:100px;height:13px;margin-bottom:10px;"></div>
                            <div class="sk-block" style="width:100%;height:44px;border-radius:12px;"></div>
                        </div>
                    </div>
                    <div class="sk-block" style="width:100%;height:42px;border-radius:12px;margin-bottom:12px;"></div>
                    <div style="display:flex;gap:10px;">
                        <div class="sk-block" style="flex:1;height:44px;border-radius:12px;"></div>
                        <div class="sk-block" style="flex:1;height:44px;border-radius:12px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <!-- ========== ANIMATED BACKGROUND PARTICLES ========== -->
    <div class="edit-particles">
        <div class="particle" style="--x: 5%; --y: 10%; --size: 5px; --delay: 0s;"></div>
        <div class="particle" style="--x: 28%; --y: 50%; --size: 4px; --delay: 1.3s;"></div>
        <div class="particle" style="--x: 48%; --y: 22%; --size: 6px; --delay: 0.6s;"></div>
        <div class="particle" style="--x: 75%; --y: 60%; --size: 3px; --delay: 2s;"></div>
        <div class="particle" style="--x: 90%; --y: 8%; --size: 5px; --delay: 0.4s;"></div>
        <div class="particle" style="--x: 12%; --y: 78%; --size: 4px; --delay: 1.8s;"></div>
        <div class="particle" style="--x: 45%; --y: 85%; --size: 5px; --delay: 0.8s;"></div>
        <div class="particle" style="--x: 68%; --y: 38%; --size: 3px; --delay: 2.4s;"></div>
        <div class="particle" style="--x: 88%; --y: 82%; --size: 4px; --delay: 1s;"></div>
        <div class="particle" style="--x: 20%; --y: 42%; --size: 5px; --delay: 0.2s;"></div>
    </div>

    <!-- ========== DECORATIVE GLOW ========== -->
    <div class="edit-glow"></div>

    <!-- ========== SUCCESS ALERT ========== -->
    @if (session('success'))
        <div class="alert-custom" id="successAlertSession">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif

    <div class="alert-custom" id="successAlert" style="display:none;">
        <i class="bi bi-check-circle-fill"></i>
        <span>আপনার প্রোফাইল সফলভাবে আপডেট হয়েছে!</span>
        <button type="button" class="alert-close" onclick="this.style.display='none'">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <!-- ========== EDIT PROFILE SECTION ========== -->
    <section class="edit-section">
        <div class="container">
            <div class="edit-card">

                <!-- Card Header -->
                <div class="edit-header">
                    <div class="edit-header-icon">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <div>
                        <h2>প্রোফাইল এডিট করুন</h2>
                        <p class="edit-header-sub">আপনার প্রোফাইল তথ্য পরিবর্তন করুন</p>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="edit-body">
                    <form id="profileForm" action="{{ url('/profile/update') }}" method="POST" enctype="multipart/form-data" novalidate onsubmit="return submitProfileForm()">
                        @csrf

                        <!-- Name -->
                        <div class="form-group">
                            <label for="name">নাম (Name) <span class="required">*</span></label>
                            <div class="input-group-custom">
                                <input type="text" id="name" name="name"
                                    value="{{ $profile->name ?? '' }}"
                                    placeholder="আপনার পূর্ণ নাম লিখুন" required>
                                <span class="input-icon-custom"><i class="bi bi-person-fill"></i></span>
                            </div>
                        </div>

                        <!-- Blood Group -->
                        <div class="form-group">
                            <label>রক্তের গ্রুপ (Blood Group) <span class="required">*</span></label>
                            <div class="blood-chips" id="bloodChips">
                                @php $groups = ['A+','A-','B+','B-','O+','O-','AB+','AB-']; @endphp
                                @foreach($groups as $group)
                                    <button type="button"
                                        class="blood-chip {{ ($profile->blood ?? '') == $group ? 'selected' : '' }}"
                                        onclick="selectBlood('{{ $group }}', this)">
                                        <i class="bi bi-droplet-fill"></i> {{ $group }}
                                    </button>
                                @endforeach
                            </div>
                            <div class="input-group-custom">
                                <select id="blood" name="blood" required onchange="syncChips(this.value)">
                                    <option value="">রক্তের গ্রুপ নির্বাচন করুন</option>
                                    @foreach($groups as $group)
                                        <option value="{{ $group }}" {{ ($profile->blood ?? '') == $group ? 'selected' : '' }}>
                                            {{ $group }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="input-icon-custom"><i class="bi bi-droplet-half"></i></span>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="form-divider">
                            <div class="divider-line"></div>
                            <span class="divider-text"><i class="bi bi-phone-fill"></i> যোগাযোগ তথ্য</span>
                            <div class="divider-line"></div>
                        </div>

                        <div class="form-row">
                            <!-- Mobile -->
                            <div class="form-group">
                                <label for="number">মোবাইল নম্বর <span class="required">*</span></label>
                                <div class="input-group-custom">
                                    <input type="tel" id="number" name="number"
                                        value="{{ $profile->number ?? '' }}"
                                        placeholder="01XXXXXXXXX" maxlength="15" required>
                                    <span class="input-icon-custom"><i class="bi bi-telephone-fill"></i></span>
                                </div>
                            </div>

                            <!-- Division -->
                            <div class="form-group">
                                <label for="division">বিভাগ <span class="required">*</span></label>
                                <div class="input-group-custom">
                                    <select id="division" name="division" required>
                                        <option value="">বিভাগ নির্বাচন করুন</option>
                                        @foreach(['Dhaka','Chattogram','Khulna','Rajshahi','Barishal','Sylhet','Rangpur','Mymensingh'] as $div)
                                            <option value="{{ $div }}" {{ ($profile->division ?? '') == $div ? 'selected' : '' }}>
                                                {{ $div }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="input-icon-custom"><i class="bi bi-geo-alt-fill"></i></span>
                                </div>
                            </div>

                            <!-- Last Donated -->
                            <div class="form-group">
                                <label for="last_donated">সর্বশেষ রক্তদান <span class="optional">(ঐচ্ছিক)</span></label>
                                <div class="input-group-custom">
                                    <input type="date" id="last_donated" name="last_donated"
                                        value="{{ isset($profile->last_donated) ? \Carbon\Carbon::parse($profile->last_donated)->format('Y-m-d') : '' }}">
                                    <span class="input-icon-custom"><i class="bi bi-calendar-check-fill"></i></span>
                                </div>
                            </div>
                        </div>

                        <!-- Info Note -->
                        <div class="info-note">
                            <i class="bi bi-info-circle-fill"></i>
                            <span>রক্তদানের পর কমপক্ষে <strong>৯০ দিন</strong> অপেক্ষা করতে হবে। সর্বশেষ দানের তারিখ সঠিকভাবে পূরণ করুন।</span>
                        </div>

                        <!-- Buttons -->
                        <button type="submit" class="btn-submit" id="submitBtn">
                            <i class="bi bi-check-lg"></i>
                            আপডেট করুন
                        </button>

                        <div class="btn-row">
                            <a href="{{ url('/profile') }}" class="btn-cancel">
                                <i class="bi bi-arrow-left"></i>
                                প্রোফাইলে ফিরুন
                            </a>
                            <button type="button" class="btn-reset" onclick="resetForm()">
                                <i class="bi bi-arrow-counterclockwise"></i>
                                রিসেট
                            </button>
                        </div>

                        <!-- Reset info badge -->
                        <div class="reset-info-badge">
                            <i class="bi bi-clock-history"></i>
                            <span>রিসেট বাটন সর্বশেষ <strong>সেভ করা তথ্য</strong>-এ ফিরিয়ে নিয়ে যাবে</span>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <!-- ========== FOOTER ========== -->
    <footer class="edit-footer">
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
                        <a href="{{ url('/') }}">হোম</a>
                        <a href="{{ url('/profile') }}">আমার প্রোফাইল</a>
                        <a href="{{ url('/profile/edit') }}">প্রোফাইল এডিট</a>
                        <a href="{{ url('/donor_list') }}">ডোনার তালিকা</a>
                    </div>
                    <div class="footer-links-col">
                        <h6>সেবাসমূহ</h6>
                        <a href="{{ url('/donor_list/A+') }}">A+ ডোনার</a>
                        <a href="{{ url('/donor_list/B+') }}">B+ ডোনার</a>
                        <a href="{{ url('/donor_list/O+') }}">O+ ডোনার</a>
                        <a href="{{ url('/donor_list/AB+') }}">AB+ ডোনার</a>
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
                <p class="footer-made-with">Developed by <span class="dev-name">Joty Biswas</span></p>
            </div>
        </div>
    </footer>

    <!-- ========== RESET CONFIRMATION MODAL ========== -->
    <div class="confirm-overlay" id="confirmOverlay" onclick="cancelReset()">
        <div class="confirm-modal" onclick="event.stopPropagation()">
            <div class="confirm-icon-wrap">
                <i class="bi bi-arrow-repeat"></i>
            </div>
            <h4 class="confirm-title">ফর্ম রিসেট করবেন?</h4>
            <p class="confirm-desc">
                সমস্ত ক্ষেত্র তাদের <strong>সর্বশেষ সেভ করা মান</strong>-এ ফিরে যাবে।
                <br>আপনি এখনও পর্যন্ত করা যেকোনো পরিবর্তন হারিয়ে যাবে।
            </p>
            <div class="confirm-actions">
                <button type="button" class="confirm-btn cancel" onclick="cancelReset()">বাতিল</button>
                <button type="button" class="confirm-btn confirm" onclick="confirmReset()">
                    <i class="bi bi-check-lg"></i> হ্যাঁ, রিসেট করুন
                </button>
            </div>
        </div>
    </div>

    <!-- ========== RESET TOAST ========== -->
    <div class="reset-toast" id="resetToast">
        <i class="toast-icon bi bi-check-circle-fill"></i>
        <span class="toast-text">ফর্ম রিসেট করা হয়েছে</span>
    </div>

    <script>
    // ========== ORIGINAL PROFILE SNAPSHOT (reset point) ==========
    const ORIGINAL_PROFILE = {
        name: {{ Js::from($profile->name ?? '') }},
        blood: {{ Js::from($profile->blood ?? '') }},
        number: {{ Js::from($profile->number ?? '') }},
        division: {{ Js::from($profile->division ?? '') }},
        last_donated: {{ Js::from(isset($profile->last_donated) ? \Carbon\Carbon::parse($profile->last_donated)->format('Y-m-d') : '') }}
    };

    function selectBlood(value, chipEl) {
        document.getElementById('blood').value = value;
        document.querySelectorAll('.blood-chip').forEach(c => c.classList.remove('selected'));
        chipEl.classList.add('selected');
    }

    function syncChips(value) {
        document.querySelectorAll('.blood-chip').forEach(chip => {
            chip.classList.remove('selected');
            if (chip.textContent.trim().includes(value)) {
                chip.classList.add('selected');
            }
        });
    }

    function restoreOriginalValues() {
        const form = document.getElementById('profileForm');
        if (!form) return;

        // Restore text/input fields
        form.querySelector('[name="name"]').value = ORIGINAL_PROFILE.name;
        form.querySelector('[name="number"]').value = ORIGINAL_PROFILE.number;
        form.querySelector('[name="division"]').value = ORIGINAL_PROFILE.division;
        form.querySelector('[name="last_donated"]').value = ORIGINAL_PROFILE.last_donated;

        // Restore blood group (both select and chips)
        const bloodSelect = form.querySelector('[name="blood"]');
        bloodSelect.value = ORIGINAL_PROFILE.blood;

        // Sync blood chips to match the original blood value
        document.querySelectorAll('.blood-chip').forEach(chip => {
            chip.classList.remove('selected');
            if (ORIGINAL_PROFILE.blood && chip.textContent.trim().includes(ORIGINAL_PROFILE.blood)) {
                chip.classList.add('selected');
            }
        });
    }

    function resetForm() {
        const form = document.getElementById('profileForm');
        if (!form) return;

        // Check if current values already match the original (nothing to reset)
        const currentBlood = form.querySelector('[name="blood"]').value;
        const currentName = form.querySelector('[name="name"]').value;
        const currentNumber = form.querySelector('[name="number"]').value;
        const currentDivision = form.querySelector('[name="division"]').value;
        const currentLastDonated = form.querySelector('[name="last_donated"]').value;

        const isSame = currentName === ORIGINAL_PROFILE.name
            && currentBlood === ORIGINAL_PROFILE.blood
            && currentNumber === ORIGINAL_PROFILE.number
            && currentDivision === ORIGINAL_PROFILE.division
            && currentLastDonated === ORIGINAL_PROFILE.last_donated;

        if (isSame) {
            showResetToast('ফর্মে কোনো পরিবর্তন হয়নি।', 'info');
            return;
        }

        // Show confirmation dialog
        const overlay = document.getElementById('confirmOverlay');
        overlay.classList.add('show');
    }

    function confirmReset() {
        document.getElementById('confirmOverlay').classList.remove('show');
        restoreOriginalValues();
        showResetToast('ফর্ম রিসেট করা হয়েছে', 'success');
    }

    function cancelReset() {
        document.getElementById('confirmOverlay').classList.remove('show');
    }

    function showResetToast(message, type) {
        const toast = document.getElementById('resetToast');
        const icon = toast.querySelector('.toast-icon');
        const text = toast.querySelector('.toast-text');

        text.textContent = message;

        if (type === 'success') {
            icon.className = 'toast-icon bi bi-check-circle-fill';
            toast.style.background = 'linear-gradient(135deg, rgba(34,197,94,0.15), rgba(34,197,94,0.05))';
            toast.style.borderLeftColor = '#22c55e';
            icon.style.color = '#22c55e';
        } else {
            icon.className = 'toast-icon bi bi-info-circle-fill';
            toast.style.background = 'linear-gradient(135deg, rgba(59,130,246,0.15), rgba(59,130,246,0.05))';
            toast.style.borderLeftColor = '#3b82f6';
            icon.style.color = '#3b82f6';
        }

        toast.classList.add('show');

        clearTimeout(toast._hideTimer);
        toast._hideTimer = setTimeout(() => {
            toast.classList.remove('show');
        }, 2500);
    }

    // Update snapshot after successful save
    function updateResetSnapshot() {
        const form = document.getElementById('profileForm');
        ORIGINAL_PROFILE.name = form.querySelector('[name="name"]').value;
        ORIGINAL_PROFILE.blood = form.querySelector('[name="blood"]').value;
        ORIGINAL_PROFILE.number = form.querySelector('[name="number"]').value;
        ORIGINAL_PROFILE.division = form.querySelector('[name="division"]').value;
        ORIGINAL_PROFILE.last_donated = form.querySelector('[name="last_donated"]').value;
    }

    function submitProfileForm() {
        const form = document.getElementById('profileForm');
        const submitBtn = document.getElementById('submitBtn');
        if (!form) return false;
        
        // Basic HTML5 validation check
        if (!form.checkValidity()) {
            form.reportValidity();
            return false;
        }

        const formData = new FormData(form);
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner"></span> আপডেট হচ্ছে...';

        fetch(form.getAttribute('action'), {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the reset snapshot with newly saved values
                updateResetSnapshot(data);

                const alert = document.getElementById('successAlert');
                alert.querySelector('span').textContent = data.message || 'আপনার প্রোফাইল সফলভাবে আপডেট হয়েছে!';
                alert.style.display = 'flex';
                alert.style.background = '';
                alert.style.borderLeftColor = '';
                alert.style.color = '';
                alert.scrollIntoView({ behavior: 'smooth', block: 'center' });
                setTimeout(() => { alert.style.display = 'none'; }, 4000);
            } else if (data.errors) {
                const errors = Object.values(data.errors).flat().join('<br>');
                const alert = document.getElementById('successAlert');
                alert.querySelector('span').textContent = errors;
                alert.style.display = 'flex';
                alert.style.background = 'linear-gradient(135deg, #fef2f2, #fecaca)';
                alert.style.borderLeftColor = '#ef4444';
                alert.style.color = '#b91c1c';
                alert.scrollIntoView({ behavior: 'smooth', block: 'center' });
                setTimeout(() => { 
                    alert.style.display = 'none'; 
                    alert.style.background = '';
                    alert.style.borderLeftColor = '';
                    alert.style.color = '';
                }, 5000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const alert = document.getElementById('successAlert');
            alert.querySelector('span').textContent = 'একটি ত্রুটি হয়েছে। দয়া করে পুনরায় চেষ্টা করুন।';
            alert.style.display = 'flex';
            alert.style.background = 'linear-gradient(135deg, #fef2f2, #fecaca)';
            alert.style.borderLeftColor = '#ef4444';
            alert.style.color = '#b91c1c';
            setTimeout(() => {
                alert.style.display = 'none';
                alert.style.background = '';
                alert.style.borderLeftColor = '';
                alert.style.color = '';
            }, 5000);
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="bi bi-check-lg"></i> আপডেট করুন';
        });
        
        return false; // prevents native form submission
    }

    // Max date for last donated
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('last_donated');
        if (dateInput) {
            dateInput.max = new Date().toISOString().split('T')[0];
        }
    });
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
            background: linear-gradient(135deg, var(--dark) 0%, var(--dark-2) 50%, var(--dark-3) 100%);
            min-height: 100vh;
            padding-top: 72px;
        }

        /* ===== ANIMATED BACKGROUND PARTICLES ===== */
        .edit-particles {
            position: fixed;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
        }

        .edit-particles .particle {
            position: absolute;
            width: var(--size);
            height: var(--size);
            left: var(--x);
            top: var(--y);
            background: rgba(239, 68, 68, 0.35);
            border-radius: 50%;
            animation: float-particle 7s ease-in-out infinite;
            animation-delay: var(--delay);
        }

        @keyframes float-particle {
            0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.35; }
            25% { transform: translate(35px, -25px) scale(1.25); opacity: 0.7; }
            50% { transform: translate(-25px, 35px) scale(0.75); opacity: 0.2; }
            75% { transform: translate(25px, 25px) scale(1.15); opacity: 0.55; }
        }

        /* ===== DECORATIVE GLOW ===== */
        .edit-glow {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, rgba(220, 38, 38, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
            animation: glow-pulse 4s ease-in-out infinite;
        }

        @keyframes glow-pulse {
            0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.6; }
            50% { transform: translate(-50%, -50%) scale(1.15); opacity: 1; }
        }

        .alert-custom {
            max-width: 640px;
            margin: 24px auto 0;
            padding: 14px 20px;
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
            border-left: 4px solid #22c55e;
            border-radius: var(--radius);
            color: #15803d;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 1;
        }

        .alert-custom i { font-size: 18px; flex-shrink: 0; }

        .alert-close {
            margin-left: auto;
            background: none;
            border: none;
            color: #15803d;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.2s;
            padding: 2px 6px;
            font-size: 14px;
        }

        .alert-close:hover { opacity: 1; }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .edit-section {
            padding: 40px 0 10px;
            min-height: 60vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            position: relative;
            z-index: 1;
        }

        .edit-section .container {
            max-width: 640px;
            margin: 0 auto;
            padding: 0 20px;
            width: 100%;
        }

        .edit-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            overflow: hidden;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.3), 0 0 40px rgba(220, 38, 38, 0.06);
            animation: cardFadeIn 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes cardFadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .edit-header {
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.15), rgba(185, 28, 28, 0.08));
            padding: 28px 32px;
            display: flex;
            align-items: center;
            gap: 18px;
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .edit-header::before {
            content: '';
            position: absolute;
            top: -40%; right: -20%;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(220, 38, 38, 0.08), transparent 70%);
            border-radius: 50%;
        }

        .edit-header-icon {
            width: 54px; height: 54px;
            background: rgba(220, 38, 38, 0.2);
            border: 1px solid rgba(220, 38, 38, 0.3);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--primary-light);
            flex-shrink: 0;
            position: relative;
            z-index: 1;
        }

        .edit-header h2 {
            font-size: 20px;
            font-weight: 800;
            color: #fff;
            margin: 0;
            line-height: 1.2;
            position: relative;
            z-index: 1;
        }

        .edit-header-sub {
            font-size: 13px;
            color: rgba(255,255,255,0.5);
            margin-top: 3px;
            position: relative;
            z-index: 1;
        }

        .edit-body {
            padding: 28px 32px 32px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: rgba(255,255,255,0.7);
            margin-bottom: 8px;
        }

        .required { color: var(--primary-light); }
        .optional { color: rgba(255,255,255,0.3); font-weight: 400; }

        .input-group-custom {
            position: relative;
        }

        .input-group-custom input,
        .input-group-custom select {
            width: 100%;
            padding: 12px 16px 12px 44px;
            background: rgba(255, 255, 255, 0.06);
            border: 1.5px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--radius);
            font-family: 'Inter', 'Noto Sans Bengali', sans-serif;
            font-size: 14px;
            color: #f5f5f5;
            outline: none;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            appearance: none;
            -webkit-appearance: none;
        }

        .input-group-custom select {
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='rgba(255,255,255,0.4)' d='M6 8L0 0h12z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 40px;
        }

        .input-group-custom input::placeholder {
            color: rgba(255,255,255,0.2);
        }

        .input-group-custom input:focus,
        .input-group-custom select:focus {
            border-color: var(--primary);
            background: rgba(220, 38, 38, 0.06);
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        .input-group-custom input:hover,
        .input-group-custom select:hover {
            border-color: rgba(255, 255, 255, 0.2);
        }

        .input-group-custom select option {
            background: #1a1a2e;
            color: #f5f5f5;
        }

        .input-icon-custom {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.25);
            font-size: 16px;
            pointer-events: none;
        }

        .blood-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 12px;
        }

        .blood-chip {
            padding: 7px 16px;
            border-radius: 999px;
            border: 1.5px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255,255,255,0.6);
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.22s ease;
            display: flex;
            align-items: center;
            gap: 5px;
            font-family: inherit;
        }

        .blood-chip:hover {
            border-color: var(--primary-light);
            color: var(--primary-light);
            background: rgba(220, 38, 38, 0.1);
            transform: translateY(-1px);
        }

        .blood-chip.selected {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-color: transparent;
            color: white;
            box-shadow: 0 3px 12px rgba(220, 38, 38, 0.3);
        }

        .blood-chip i { font-size: 10px; }

        .form-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 6px 0 24px;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.08);
        }

        .divider-text {
            font-size: 11px;
            color: rgba(255,255,255,0.35);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .divider-text i { font-size: 13px; }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0 20px;
        }

        .info-note {
            background: rgba(59, 130, 246, 0.08);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-left: 3px solid #3b82f6;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 12px;
            color: rgba(255,255,255,0.55);
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 24px;
        }

        .info-note i { color: #60a5fa; margin-top: 1px; flex-shrink: 0; font-size: 14px; }

        .btn-submit {
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            font-family: inherit;
            font-size: 15px;
            font-weight: 700;
            border: none;
            border-radius: var(--radius);
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 20px rgba(220, 38, 38, 0.35);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(220, 38, 38, 0.45);
        }

        .btn-submit:disabled { opacity: 0.6; cursor: not-allowed; transform: none !important; }

        .btn-row {
            display: flex;
            gap: 10px;
            margin-top: 12px;
        }

        .btn-cancel, .btn-reset {
            flex: 1;
            padding: 11px 18px;
            border-radius: var(--radius);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: inherit;
        }

        .btn-cancel {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255,255,255,0.6);
            text-decoration: none;
        }

        .btn-cancel:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .btn-reset {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: rgba(255,255,255,0.45);
        }

        .btn-reset:hover {
            background: rgba(255, 255, 255, 0.08);
            color: rgba(255,255,255,0.7);
        }

        .spinner {
            width: 18px; height: 18px;
            border: 2.5px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        /* ========== RESET INFO BADGE ========== */
        .reset-info-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 14px;
            padding: 10px 14px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            font-size: 11px;
            color: rgba(255,255,255,0.3);
            line-height: 1.4;
        }

        .reset-info-badge i {
            font-size: 14px;
            color: rgba(255,255,255,0.2);
            flex-shrink: 0;
        }

        .reset-info-badge strong { color: rgba(255,255,255,0.5); }

        /* ========== CONFIRMATION MODAL ========== */
        .confirm-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .confirm-overlay.show {
            opacity: 1;
            pointer-events: all;
        }

        .confirm-modal {
            background: #1e1e36;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 32px 28px 24px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            box-shadow: 0 30px 80px rgba(0,0,0,0.5);
            animation: modalIn 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.92) translateY(20px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }

        .confirm-icon-wrap {
            width: 64px;
            height: 64px;
            margin: 0 auto 16px;
            background: rgba(220, 38, 38, 0.12);
            border: 1px solid rgba(220, 38, 38, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: var(--primary-light);
        }

        .confirm-title {
            font-size: 18px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 8px;
        }

        .confirm-desc {
            font-size: 13px;
            color: rgba(255,255,255,0.5);
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .confirm-desc strong { color: rgba(255,255,255,0.65); }

        .confirm-actions {
            display: flex;
            gap: 10px;
        }

        .confirm-btn {
            flex: 1;
            padding: 11px 16px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
            font-family: inherit;
            border: none;
        }

        .confirm-btn.cancel {
            background: rgba(255, 255, 255, 0.06);
            color: rgba(255,255,255,0.5);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .confirm-btn.cancel:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .confirm-btn.confirm {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            box-shadow: 0 4px 16px rgba(220, 38, 38, 0.3);
        }

        .confirm-btn.confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 24px rgba(220, 38, 38, 0.4);
        }

        /* ========== RESET TOAST ========== */
        .reset-toast {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%) translateY(20px);
            padding: 14px 24px;
            border-radius: 14px;
            border-left: 4px solid #22c55e;
            background: rgba(20, 20, 40, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.08);
            box-shadow: 0 10px 40px rgba(0,0,0,0.4);
            z-index: 10000;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 600;
            color: #f5f5f5;
            opacity: 0;
            pointer-events: none;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reset-toast.show {
            opacity: 1;
            pointer-events: all;
            transform: translateX(-50%) translateY(0);
        }

        .toast-icon { font-size: 18px; }
        .toast-text { flex: 1; }

        @media (max-width: 480px) {
            .reset-toast {
                bottom: 20px;
                left: 20px;
                right: 20px;
                transform: translateX(0) translateY(20px);
                padding: 12px 18px;
                font-size: 13px;
            }
            .reset-toast.show {
                transform: translateX(0) translateY(0);
            }
            .confirm-modal {
                padding: 24px 20px 20px;
            }
            .confirm-icon-wrap {
                width: 52px; height: 52px;
                font-size: 22px;
            }
            .confirm-title { font-size: 16px; }
            .confirm-desc { font-size: 12px; }
            .confirm-btn { font-size: 13px; padding: 10px 14px; }
        }

        /* ===== FOOTER ===== */
        .edit-footer {
            position: relative;
            z-index: 1;
            background: linear-gradient(180deg, rgba(26, 26, 46, 0.95), var(--dark-2));
            color: white;
            padding: 48px 0 0;
            margin-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .edit-footer .container {
            max-width: 640px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .edit-footer .footer-content {
            display: flex;
            flex-direction: column;
            gap: 28px;
            padding-bottom: 32px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .edit-footer .footer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .edit-footer .logo-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; flex-shrink: 0;
        }

        .edit-footer .brand-name {
            display: block; font-size: 17px; font-weight: 800; margin-bottom: 1px;
        }

        .edit-footer .brand-tagline {
            display: block; font-size: 12px; color: rgba(255,255,255,0.4);
        }

        .edit-footer .footer-links {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .edit-footer .footer-links-col h6,
        .edit-footer .footer-social h6 {
            font-size: 11px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 1.2px; color: rgba(255,255,255,0.3); margin-bottom: 12px;
        }

        .edit-footer .footer-links-col a {
            display: block;
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            padding: 3px 0;
            transition: all 0.3s;
        }

        .edit-footer .footer-links-col a:hover { color: var(--primary-light); padding-left: 4px; }

        .edit-footer .social-icons {
            display: flex;
            gap: 8px;
        }

        .edit-footer .social-icon {
            width: 36px; height: 36px;
            background: rgba(255,255,255,0.06);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 15px;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .edit-footer .social-icon:hover { transform: translateY(-3px); }
        .edit-footer .social-icon.facebook:hover { background: #1877f2; }
        .edit-footer .social-icon.twitter:hover { background: #1da1f2; }
        .edit-footer .social-icon.whatsapp:hover { background: #25d366; }
        .edit-footer .social-icon.youtube:hover { background: #ff0000; }

        .edit-footer .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            flex-wrap: wrap;
            gap: 8px;
        }

        .edit-footer .footer-bottom p {
            font-size: 12px;
            color: rgba(255,255,255,0.3);
        }

        .edit-footer .dev-name {
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-light), #f97316);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        @media (max-width: 991.98px) {
            body { padding-top: 64px; }
            .edit-section { padding: 28px 0 10px; min-height: 50vh; }
        }

        @media (max-width: 767.98px) {
            body { padding-top: 60px; }
            .edit-section { padding: 20px 0 10px; min-height: 40vh; }
            .edit-header { padding: 22px 24px; }
            .edit-body { padding: 22px 24px; }
            .edit-header h2 { font-size: 17px; }
            .form-row { grid-template-columns: 1fr; gap: 0; }
            .btn-row { flex-direction: column; }
            .edit-footer { padding: 36px 0 0; margin-top: 28px; }
            .edit-footer .footer-links { gap: 16px; }
        }

        @media (max-width: 480px) {
            body { padding-top: 56px; }
            .edit-section .container { padding: 0 14px; }
            .edit-card { border-radius: 18px; }
            .edit-header { padding: 18px 18px; gap: 14px; }
            .edit-body { padding: 18px 18px; }
            .edit-header-icon { width: 44px; height: 44px; font-size: 20px; border-radius: 12px; }
            .edit-header h2 { font-size: 15px; }
            .edit-header-sub { font-size: 12px; }
            .form-group { margin-bottom: 16px; }
            .form-group label { font-size: 12px; }
            .input-group-custom input,
            .input-group-custom select { padding: 10px 14px 10px 38px; font-size: 13px; }
            .input-icon-custom { left: 12px; font-size: 14px; }
            .blood-chip { padding: 5px 12px; font-size: 12px; }
            .form-divider { margin: 2px 0 18px; }
            .info-note { font-size: 11px; padding: 10px 14px; }
            .btn-submit { padding: 12px 18px; font-size: 14px; }
            .btn-cancel, .btn-reset { padding: 10px 14px; font-size: 13px; }
            .edit-footer { padding: 28px 0 0; margin-top: 20px; }
            .edit-footer .footer-content { gap: 20px; padding-bottom: 24px; }
            .edit-footer .footer-links { grid-template-columns: 1fr 1fr; gap: 12px; }
            .edit-footer .footer-links-col a { font-size: 12px; }
            .edit-footer .brand-name { font-size: 15px; }
            .edit-footer .logo-icon { width: 34px; height: 34px; font-size: 15px; }
            .edit-footer .social-icon { width: 32px; height: 32px; font-size: 13px; }
            .edit-footer .footer-bottom { flex-direction: column; text-align: center; gap: 4px; }
            .edit-footer .footer-bottom p { font-size: 11px; }
        }

        @media (max-width: 360px) {
            body { padding-top: 52px; }
            .edit-header-icon { width: 38px; height: 38px; font-size: 17px; }
            .edit-header h2 { font-size: 13px; }
            .blood-chips { gap: 5px; }
            .blood-chip { padding: 4px 10px; font-size: 11px; }
            .edit-footer .footer-links { grid-template-columns: 1fr; gap: 16px; text-align: center; }
            .edit-footer .social-icons { justify-content: center; }
        }

        /* ===== LIGHT MODE OVERRIDES ===== */
        .light-mode body {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #fef2f2 100%);
        }

        .light-mode .edit-card {
            background: rgba(255, 255, 255, 0.9);
            border-color: rgba(0, 0, 0, 0.08);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
        }

        .light-mode .edit-header {
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.06), rgba(185, 28, 28, 0.03));
            border-bottom-color: rgba(0, 0, 0, 0.06);
        }

        .light-mode .edit-header h2 {
            color: #1f2937;
        }

        .light-mode .edit-header-sub {
            color: rgba(0, 0, 0, 0.5);
        }

        .light-mode .form-group label {
            color: rgba(0, 0, 0, 0.6);
        }

        .light-mode .input-group-custom input,
        .light-mode .input-group-custom select {
            background: rgba(0, 0, 0, 0.03);
            border-color: rgba(0, 0, 0, 0.1);
            color: #1f2937;
        }

        .light-mode .input-group-custom input::placeholder {
            color: rgba(0, 0, 0, 0.3);
        }

        .light-mode .input-group-custom input:focus,
        .light-mode .input-group-custom select:focus {
            border-color: #dc2626;
            background: rgba(220, 38, 38, 0.03);
        }

        .light-mode .input-group-custom input:hover,
        .light-mode .input-group-custom select:hover {
            border-color: rgba(0, 0, 0, 0.2);
        }

        .light-mode .input-group-custom select option {
            background: #ffffff;
            color: #1f2937;
        }

        .light-mode .input-icon-custom {
            color: rgba(0, 0, 0, 0.3);
        }

        .light-mode .blood-chip {
            border-color: rgba(0, 0, 0, 0.12);
            background: rgba(0, 0, 0, 0.04);
            color: rgba(0, 0, 0, 0.5);
        }

        .light-mode .blood-chip:hover {
            border-color: #dc2626;
            color: #dc2626;
            background: rgba(220, 38, 38, 0.06);
        }

        .light-mode .divider-line {
            background: rgba(0, 0, 0, 0.08);
        }

        .light-mode .divider-text {
            color: rgba(0, 0, 0, 0.35);
        }

        .light-mode .info-note {
            background: rgba(59, 130, 246, 0.05);
            border-color: rgba(59, 130, 246, 0.15);
            color: rgba(0, 0, 0, 0.5);
        }

        .light-mode .btn-cancel {
            background: rgba(0, 0, 0, 0.04);
            border-color: rgba(0, 0, 0, 0.1);
            color: rgba(0, 0, 0, 0.5);
        }

        .light-mode .btn-cancel:hover {
            background: rgba(0, 0, 0, 0.08);
            color: #1f2937;
        }

        .light-mode .btn-reset {
            background: rgba(0, 0, 0, 0.03);
            border-color: rgba(0, 0, 0, 0.08);
            color: rgba(0, 0, 0, 0.4);
        }

        .light-mode .btn-reset:hover {
            background: rgba(0, 0, 0, 0.06);
            color: rgba(0, 0, 0, 0.6);
        }

        .light-mode .reset-info-badge {
            background: rgba(0, 0, 0, 0.03);
            border-color: rgba(0, 0, 0, 0.06);
            color: rgba(0, 0, 0, 0.35);
        }

        .light-mode .reset-info-badge i {
            color: rgba(0, 0, 0, 0.25);
        }

        .light-mode .reset-info-badge strong {
            color: rgba(0, 0, 0, 0.5);
        }

        .light-mode .confirm-modal {
            background: #ffffff;
            border-color: rgba(0, 0, 0, 0.08);
        }

        .light-mode .confirm-title {
            color: #1f2937;
        }

        .light-mode .confirm-desc {
            color: rgba(0, 0, 0, 0.5);
        }

        .light-mode .confirm-desc strong {
            color: rgba(0, 0, 0, 0.65);
        }

        .light-mode .confirm-btn.cancel {
            background: rgba(0, 0, 0, 0.04);
            color: rgba(0, 0, 0, 0.5);
            border-color: rgba(0, 0, 0, 0.08);
        }

        .light-mode .confirm-btn.cancel:hover {
            background: rgba(0, 0, 0, 0.08);
            color: #1f2937;
        }

        .light-mode .edit-footer {
            background: linear-gradient(180deg, #f8f9fa, #e5e7eb);
            border-top-color: rgba(0, 0, 0, 0.06);
        }

        .light-mode .edit-footer .brand-name {
            color: #1f2937;
        }

        .light-mode .edit-footer .brand-tagline {
            color: rgba(0, 0, 0, 0.4);
        }

        .light-mode .edit-footer .footer-links-col h6,
        .light-mode .edit-footer .footer-social h6 {
            color: rgba(0, 0, 0, 0.4);
        }

        .light-mode .edit-footer .footer-links-col a {
            color: rgba(0, 0, 0, 0.55);
        }

        .light-mode .edit-footer .footer-links-col a:hover {
            color: #dc2626;
        }

        .light-mode .edit-footer .social-icon {
            background: rgba(0, 0, 0, 0.06);
            color: rgba(0, 0, 0, 0.5);
        }

        .light-mode .edit-footer .footer-bottom p {
            color: rgba(0, 0, 0, 0.3);
        }

        .light-mode .edit-glow {
            opacity: 0.4;
        }

        .light-mode .edit-particles .particle {
            background: rgba(220, 38, 38, 0.25);
        }

        .light-mode .alert-custom {
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        }

        .light-mode .alert-close {
            color: #15803d;
        }
    </style>

@endsection