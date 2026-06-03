@extends('frontend.app')

@section('skeleton')
    <div style="padding-top:72px;display:flex;align-items:flex-start;justify-content:center;padding:72px 20px 40px;min-height:60vh;">
        <div style="max-width:680px;width:100%;">
            <div style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.05);border-radius:24px;overflow:hidden;">
                <div style="padding:28px 32px;display:flex;align-items:center;gap:18px;border-bottom:1px solid rgba(255,255,255,0.04);">
                    <div class="sk-block" style="width:54px;height:54px;border-radius:16px;flex-shrink:0;"></div>
                    <div>
                        <div class="sk-block" style="width:200px;height:20px;margin-bottom:6px;"></div>
                        <div class="sk-block" style="width:140px;height:14px;"></div>
                    </div>
                </div>
                <div style="padding:28px 32px;">
                    @for($i=0;$i<5;$i++)
                    <div style="margin-bottom:20px;">
                        <div class="sk-block" style="width:100px;height:13px;margin-bottom:10px;"></div>
                        <div class="sk-block" style="width:100%;height:44px;border-radius:12px;"></div>
                    </div>
                    @endfor
                    <div class="sk-block" style="width:100%;height:48px;border-radius:12px;margin-top:10px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <div class="emergency-particles">
        <div class="particle" style="--x: 5%; --y: 10%; --size: 6px; --delay: 0s;"></div>
        <div class="particle" style="--x: 30%; --y: 50%; --size: 4px; --delay: 1.3s;"></div>
        <div class="particle" style="--x: 55%; --y: 25%; --size: 7px; --delay: 0.6s;"></div>
        <div class="particle" style="--x: 78%; --y: 65%; --size: 4px; --delay: 2s;"></div>
        <div class="particle" style="--x: 92%; --y: 15%; --size: 5px; --delay: 0.4s;"></div>
        <div class="particle" style="--x: 15%; --y: 80%; --size: 3px; --delay: 1.8s;"></div>
        <div class="particle" style="--x: 45%; --y: 88%; --size: 5px; --delay: 0.8s;"></div>
        <div class="particle" style="--x: 68%; --y: 40%; --size: 3px; --delay: 2.4s;"></div>
    </div>
    <div class="emergency-glow"></div>

    <section class="emergency-section" style="padding:40px 0 10px;min-height:60vh;display:flex;align-items:flex-start;justify-content:center;position:relative;z-index:1;">
        <div class="container" style="max-width:680px;margin:0 auto;padding:0 20px;width:100%;">

            {{-- Success Alert --}}
            @if(session('success'))
            <div class="alert-custom" style="max-width:680px;margin:0 auto 24px;padding:14px 20px;background:linear-gradient(135deg,#dcfce7,#bbf7d0);border-left:4px solid #22c55e;border-radius:12px;color:#15803d;font-weight:600;font-size:14px;display:flex;align-items:center;gap:10px;animation:slideDown 0.4s cubic-bezier(0.4,0,0.2,1);position:relative;z-index:1;">
                    <i class="bi bi-check-circle-fill" style="font-size:18px;flex-shrink:0;"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="emergency-card-main" style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:24px;overflow:hidden;backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);box-shadow:0 20px 60px rgba(0,0,0,0.3);animation:cardFadeIn 0.6s cubic-bezier(0.4,0,0.2,1);" data-aos="fade-up">

                {{-- Header --}}
                <div style="background:linear-gradient(135deg,rgba(220,38,38,0.2),rgba(185,28,28,0.1));padding:28px 32px;display:flex;align-items:center;gap:18px;position:relative;overflow:hidden;border-bottom:1px solid rgba(255,255,255,0.06);">
                    <div style="position:absolute;top:-40%;right:-20%;width:300px;height:300px;background:radial-gradient(circle,rgba(220,38,38,0.1),transparent 70%);border-radius:50%;pointer-events:none;"></div>
                    <div style="width:56px;height:56px;background:rgba(220,38,38,0.2);border:1.5px solid rgba(220,38,38,0.3);border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:26px;color:#ef4444;flex-shrink:0;position:relative;z-index:1;animation:emergency-icon-pulse 2s infinite;">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <div style="position:relative;z-index:1;">
                        <h2 style="font-size:20px;font-weight:800;color:#fff;margin:0;line-height:1.2;">জরুরি রক্তের অনুরোধ</h2>
                        <p style="font-size:13px;color:rgba(255,255,255,0.5);margin-top:3px;">নিচের ফর্ম পূরণ করে দ্রুত ডোনার খুঁজুন</p>
                    </div>
                </div>

                {{-- Body --}}
                <div style="padding:28px 32px 32px;">
                    <form id="emergencyRequestForm" action="{{ url('/emergency-request/submit') }}" method="POST" novalidate>
                        @csrf

                        {{-- Patient Name --}}
                        <div class="form-group" style="margin-bottom:20px;">
                            <label style="display:block;font-size:13px;font-weight:600;color:rgba(255,255,255,0.7);margin-bottom:8px;">
                                রোগীর নাম <span style="color:#ef4444;">*</span>
                            </label>
                            <div class="input-group-custom">
                                <input type="text" name="patient_name" placeholder="রোগীর পূর্ণ নাম লিখুন" required
                                       style="width:100%;padding:12px 16px 12px 44px;background:rgba(255,255,255,0.06);border:1.5px solid rgba(255,255,255,0.1);border-radius:12px;font-family:'Inter','Noto Sans Bengali',sans-serif;font-size:14px;color:#f5f5f5;outline:none;transition:all 0.25s;box-sizing:border-box;">
                                <span style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:rgba(255,255,255,0.25);font-size:16px;pointer-events:none;">
                                    <i class="bi bi-person-fill"></i>
                                </span>
                            </div>
                        </div>

                        {{-- Blood Group --}}
                        <div class="form-group" style="margin-bottom:20px;">
                            <label style="display:block;font-size:13px;font-weight:600;color:rgba(255,255,255,0.7);margin-bottom:8px;">
                                প্রয়োজনীয় রক্তের গ্রুপ <span style="color:#ef4444;">*</span>
                            </label>
                            <div class="blood-chips" id="bloodChips" style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:12px;">
                                @php $groups = ['A+','A-','B+','B-','O+','O-','AB+','AB-']; @endphp
                                @foreach($groups as $group)
                                <button type="button" class="blood-chip" onclick="selectBlood('{{ $group }}', this)"
                                        style="padding:7px 16px;border-radius:999px;border:1.5px solid rgba(255,255,255,0.12);background:rgba(255,255,255,0.05);color:rgba(255,255,255,0.6);font-size:13px;font-weight:700;cursor:pointer;transition:all 0.22s ease;display:flex;align-items:center;gap:5px;font-family:inherit;">
                                    <i class="bi bi-droplet-fill" style="font-size:10px;"></i> {{ $group }}
                                </button>
                                @endforeach
                            </div>
                            <div class="input-group-custom" style="position:relative;">
                                <select name="blood_group" id="bloodGroup" required onchange="syncBloodChips(this.value)"
                                        style="width:100%;padding:12px 16px 12px 44px;background:rgba(255,255,255,0.06);border:1.5px solid rgba(255,255,255,0.1);border-radius:12px;font-family:'Inter','Noto Sans Bengali',sans-serif;font-size:14px;color:#f5f5f5;outline:none;transition:all 0.25s;appearance:none;-webkit-appearance:none;cursor:pointer;padding-right:40px;box-sizing:border-box;">
                                    <option value="">রক্তের গ্রুপ নির্বাচন করুন</option>
                                    @foreach($groups as $group)
                                    <option value="{{ $group }}">{{ $group }}</option>
                                    @endforeach
                                </select>
                                <span style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:rgba(255,255,255,0.25);font-size:16px;pointer-events:none;">
                                    <i class="bi bi-droplet-half"></i>
                                </span>
                            </div>
                        </div>

                        {{-- Urgency --}}
                        <div class="form-group" style="margin-bottom:20px;">
                            <label style="display:block;font-size:13px;font-weight:600;color:rgba(255,255,255,0.7);margin-bottom:8px;">
                                জরুরিতার মাত্রা <span style="color:#ef4444;">*</span>
                            </label>
                            <div class="urgency-chips" style="display:flex;gap:10px;flex-wrap:wrap;">
                                <button type="button" class="urgency-chip selected" data-value="critical" onclick="selectUrgency('critical', this)"
                                        style="flex:1;padding:10px 14px;border-radius:12px;border:2px solid #dc2626;background:rgba(220,38,38,0.15);color:#fca5a5;font-size:13px;font-weight:700;cursor:pointer;transition:all 0.22s ease;font-family:inherit;text-align:center;min-width:100px;">
                                    <i class="bi bi-exclamation-triangle-fill"></i><br>
                                    <span style="font-size:11px;">ক্রিটিক্যাল</span>
                                </button>
                                <button type="button" class="urgency-chip" data-value="urgent" onclick="selectUrgency('urgent', this)"
                                        style="flex:1;padding:10px 14px;border-radius:12px;border:2px solid rgba(255,255,255,0.12);background:rgba(255,255,255,0.05);color:rgba(255,255,255,0.6);font-size:13px;font-weight:700;cursor:pointer;transition:all 0.22s ease;font-family:inherit;text-align:center;min-width:100px;">
                                    <i class="bi bi-clock-fill"></i><br>
                                    <span style="font-size:11px;">জরুরি</span>
                                </button>
                                <button type="button" class="urgency-chip" data-value="normal" onclick="selectUrgency('normal', this)"
                                        style="flex:1;padding:10px 14px;border-radius:12px;border:2px solid rgba(255,255,255,0.12);background:rgba(255,255,255,0.05);color:rgba(255,255,255,0.6);font-size:13px;font-weight:700;cursor:pointer;transition:all 0.22s ease;font-family:inherit;text-align:center;min-width:100px;">
                                    <i class="bi bi-calendar-check"></i><br>
                                    <span style="font-size:11px;">সাধারণ</span>
                                </button>
                            </div>
                            <input type="hidden" name="urgency" id="urgencyInput" value="critical">
                        </div>

                        {{-- Divider --}}
                        <div class="form-divider" style="display:flex;align-items:center;gap:12px;margin:6px 0 24px;">
                            <span style="flex:1;height:1px;background:rgba(255,255,255,0.08);"></span>
                            <span style="font-size:11px;color:rgba(255,255,255,0.35);font-weight:600;text-transform:uppercase;letter-spacing:1px;white-space:nowrap;display:flex;align-items:center;gap:6px;">
                                <i class="bi bi-info-circle-fill" style="font-size:13px;"></i> যোগাযোগ তথ্য
                            </span>
                            <span style="flex:1;height:1px;background:rgba(255,255,255,0.08);"></span>
                        </div>

                        {{-- Hospital --}}
                        <div class="form-group" style="margin-bottom:20px;">
                            <label style="display:block;font-size:13px;font-weight:600;color:rgba(255,255,255,0.7);margin-bottom:8px;">
                                হাসপাতালের নাম <span style="color:rgba(255,255,255,0.3);font-weight:400;">(ঐচ্ছিক)</span>
                            </label>
                            <div class="input-group-custom" style="position:relative;">
                                <input type="text" name="hospital" placeholder="যেখানে রক্তের প্রয়োজন (ঐচ্ছিক)"
                                       style="width:100%;padding:12px 16px 12px 44px;background:rgba(255,255,255,0.06);border:1.5px solid rgba(255,255,255,0.1);border-radius:12px;font-family:'Inter','Noto Sans Bengali',sans-serif;font-size:14px;color:#f5f5f5;outline:none;transition:all 0.25s;box-sizing:border-box;">
                                <span style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:rgba(255,255,255,0.25);font-size:16px;pointer-events:none;">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>
                        </div>

                        {{-- Location --}}
                        <div class="form-group" style="margin-bottom:20px;">
                            <label style="display:block;font-size:13px;font-weight:600;color:rgba(255,255,255,0.7);margin-bottom:8px;">
                                ঠিকানা / অবস্থান <span style="color:#ef4444;">*</span>
                            </label>
                            <div class="input-group-custom" style="position:relative;">
                                <input type="text" name="location" placeholder="যেখানে রক্তের প্রয়োজন (জেলা, বিভাগ, ঠিকানা)" required
                                       style="width:100%;padding:12px 16px 12px 44px;background:rgba(255,255,255,0.06);border:1.5px solid rgba(255,255,255,0.1);border-radius:12px;font-family:'Inter','Noto Sans Bengali',sans-serif;font-size:14px;color:#f5f5f5;outline:none;transition:all 0.25s;box-sizing:border-box;">
                                <span style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:rgba(255,255,255,0.25);font-size:16px;pointer-events:none;">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </span>
                            </div>
                        </div>

                        {{-- Contact Phone --}}
                        <div class="form-group" style="margin-bottom:20px;">
                            <label style="display:block;font-size:13px;font-weight:600;color:rgba(255,255,255,0.7);margin-bottom:8px;">
                                যোগাযোগের নম্বর <span style="color:#ef4444;">*</span>
                            </label>
                            <div class="input-group-custom" style="position:relative;">
                                <input type="tel" name="contact_phone" placeholder="01XXXXXXXXX" maxlength="15" required
                                       style="width:100%;padding:12px 16px 12px 44px;background:rgba(255,255,255,0.06);border:1.5px solid rgba(255,255,255,0.1);border-radius:12px;font-family:'Inter','Noto Sans Bengali',sans-serif;font-size:14px;color:#f5f5f5;outline:none;transition:all 0.25s;box-sizing:border-box;">
                                <span style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:rgba(255,255,255,0.25);font-size:16px;pointer-events:none;">
                                    <i class="bi bi-telephone-fill"></i>
                                </span>
                            </div>
                        </div>

                        {{-- Message --}}
                        <div class="form-group" style="margin-bottom:22px;">
                            <label style="display:block;font-size:13px;font-weight:600;color:rgba(255,255,255,0.7);margin-bottom:8px;">
                                বিস্তারিত বার্তা <span style="color:rgba(255,255,255,0.3);font-weight:400;">(ঐচ্ছিক)</span>
                            </label>
                            <div class="input-group-custom" style="position:relative;">
                                <textarea name="message" rows="3" placeholder="অতিরিক্ত তথ্য থাকলে লিখুন..." 
                                          style="width:100%;padding:12px 16px 12px 44px;background:rgba(255,255,255,0.06);border:1.5px solid rgba(255,255,255,0.1);border-radius:12px;font-family:'Inter','Noto Sans Bengali',sans-serif;font-size:14px;color:#f5f5f5;outline:none;transition:all 0.25s;resize:vertical;min-height:80px;box-sizing:border-box;"></textarea>
                                <span style="position:absolute;left:14px;top:16px;color:rgba(255,255,255,0.25);font-size:16px;pointer-events:none;">
                                    <i class="bi bi-chat-dots"></i>
                                </span>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <button type="submit" id="submitBtn"
                                style="width:100%;padding:15px 24px;background:linear-gradient(135deg,#dc2626,#ef4444);color:#fff;font-family:inherit;font-size:16px;font-weight:700;border:none;border-radius:12px;cursor:pointer;transition:all 0.3s cubic-bezier(0.4,0,0.2,1);display:flex;align-items:center;justify-content:center;gap:10px;box-shadow:0 4px 20px rgba(220,38,38,0.35);position:relative;overflow:hidden;">
                            <i class="bi bi-send-fill"></i>
                            <span class="btn-text">জরুরি অনুরোধ পাঠান</span>
                            <span class="btn-loader" style="display:none;width:20px;height:20px;border:2.5px solid rgba(255,255,255,0.3);border-top-color:#fff;border-radius:50%;animation:spin 0.7s linear infinite;"></span>
                        </button>

                        {{-- Info --}}
                        <div style="display:flex;align-items:center;gap:8px;margin-top:14px;padding:10px 14px;border-radius:10px;background:rgba(59,130,246,0.08);border:1px solid rgba(59,130,246,0.15);font-size:11px;color:rgba(255,255,255,0.5);line-height:1.4;">
                            <i class="bi bi-shield-check" style="font-size:14px;color:#60a5fa;flex-shrink:0;"></i>
                            <span>আপনার অনুরোধটি একই ব্লাড গ্রুপের ডোনারদের ইমেইল নোটিফিকেশন পাঠানো হবে। জরুরি প্রয়োজনে সরাসরি <strong style="color:rgba(255,255,255,0.6);">হটলাইনে</strong> কল করুন।</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800&display=swap');

        :root {
            --primary: #dc2626; --primary-light: #ef4444; --primary-dark: #b91c1c;
            --dark: #1a1a2e; --dark-2: #16213e; --dark-3: #0f3460;
            --text: #374151; --text-light: #6b7280; --white: #ffffff;
            --radius: 12px; --radius-lg: 20px;
            --shadow: 0 4px 20px rgba(0,0,0,0.06);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', 'Noto Sans Bengali', sans-serif; background: linear-gradient(135deg, var(--dark) 0%, var(--dark-2) 50%, var(--dark-3) 100%); min-height: 100vh; padding-top: 72px; }
        html { scroll-behavior: smooth; scroll-padding-top: 72px; }

        .emergency-particles { position: fixed; inset: 0; overflow: hidden; pointer-events: none; z-index: 0; }
        .emergency-particles .particle { position: absolute; width: var(--size); height: var(--size); left: var(--x); top: var(--y); background: rgba(239,68,68,0.35); border-radius: 50%; animation: float-particle 7s ease-in-out infinite; animation-delay: var(--delay); }
        @keyframes float-particle { 0%,100%{transform:translate(0,0) scale(1);opacity:.35} 25%{transform:translate(35px,-25px) scale(1.25);opacity:.7} 50%{transform:translate(-25px,35px) scale(.75);opacity:.2} 75%{transform:translate(25px,25px) scale(1.15);opacity:.55} }
        .emergency-glow { position: fixed; top: 50%; left: 50%; transform: translate(-50%,-50%); width: 700px; height: 700px; background: radial-gradient(circle,rgba(220,38,38,0.1) 0%,transparent 70%); border-radius: 50%; pointer-events: none; z-index: 0; animation: glow-pulse 4s ease-in-out infinite; }
        @keyframes glow-pulse { 0%,100%{transform:translate(-50%,-50%) scale(1);opacity:.6} 50%{transform:translate(-50%,-50%) scale(1.15);opacity:1} }
        @keyframes emergency-icon-pulse { 0%,100%{transform:scale(1);opacity:.8} 50%{transform:scale(1.1);opacity:1} }
        @keyframes spin { to{transform:rotate(360deg)} }
        @keyframes slideDown { from{opacity:0;transform:translateY(-20px) scale(.95)} to{opacity:1;transform:translateY(0) scale(1)} }
        @keyframes cardFadeIn { from{opacity:0;transform:translateY(30px)} to{opacity:1;transform:translateY(0)} }

        .input-group-custom { position: relative; }
        .input-group-custom input:focus, .input-group-custom select:focus, .input-group-custom textarea:focus { border-color: #dc2626 !important; background: rgba(220,38,38,0.06) !important; box-shadow: 0 0 0 3px rgba(220,38,38,0.1) !important; }
        .input-group-custom input:hover, .input-group-custom select:hover, .input-group-custom textarea:hover { border-color: rgba(255,255,255,0.2) !important; }
        .input-group-custom input::placeholder, .input-group-custom textarea::placeholder { color: rgba(255,255,255,0.2); }
        .input-group-custom select option { background: #1a1a2e; color: #f5f5f5; }
        .input-group-custom select { background-image: url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='rgba(255,255,255,0.4)' d='M6 8L0 0h12z'/%3E%3C/svg%3E\"); background-repeat: no-repeat; background-position: right 14px center; }

        .blood-chip.selected { background: linear-gradient(135deg, #dc2626, #ef4444) !important; border-color: transparent !important; color: white !important; box-shadow: 0 3px 12px rgba(220,38,38,0.3); }
        .urgency-chip.selected { border-color: #dc2626 !important; background: rgba(220,38,38,0.15) !important; color: #fca5a5 !important; }
        .urgency-chip:hover { border-color: rgba(239,68,68,0.3) !important; }

        @media (max-width: 767.98px) { body { padding-top: 60px; } .emergency-section { padding: 20px 0 10px; } }
        @media (max-width: 480px) { body { padding-top: 56px; } .emergency-section .container { padding: 0 14px; } }

        .light-mode body { background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #fef2f2 100%); }
        .light-mode .emergency-card-main { background: rgba(255,255,255,0.9); border-color: rgba(0,0,0,0.08); box-shadow: 0 20px 60px rgba(0,0,0,0.08); }
        .light-mode .emergency-card-main h2 { color: #1f2937; }
        .light-mode .emergency-card-main p { color: rgba(0,0,0,0.5); }
        .light-mode .emergency-card-main label { color: rgba(0,0,0,0.6); }
        .light-mode .input-group-custom input, .light-mode .input-group-custom select, .light-mode .input-group-custom textarea { background: rgba(0,0,0,0.03); border-color: rgba(0,0,0,0.1); color: #1f2937; }
        .light-mode .input-group-custom input::placeholder, .light-mode .input-group-custom textarea::placeholder { color: rgba(0,0,0,0.3); }
        .light-mode .input-group-custom select option { background: #ffffff; color: #1f2937; }
        .light-mode .input-group-custom span i { color: rgba(0,0,0,0.3); }
        .light-mode .blood-chip { border-color: rgba(0,0,0,0.12); background: rgba(0,0,0,0.04); color: rgba(0,0,0,0.5); }
        .light-mode .urgency-chip { border-color: rgba(0,0,0,0.12); background: rgba(0,0,0,0.04); color: rgba(0,0,0,0.5); }
        .light-mode .urgency-chip.selected { border-color: #dc2626 !important; background: rgba(220,38,38,0.1) !important; color: #dc2626 !important; }
        .light-mode .form-divider span:first-child, .light-mode .form-divider span:last-child { background: rgba(0,0,0,0.08) !important; }
        .light-mode .form-divider span:nth-child(2) { color: rgba(0,0,0,0.35); }
        .light-mode div[style*=\"background:rgba(59,130,246,0.08)\"] { background: rgba(59,130,246,0.05) !important; border-color: rgba(59,130,246,0.15) !important; color: rgba(0,0,0,0.5) !important; }
    </style>

    <script>
    function selectBlood(value, chipEl) {
        document.getElementById('bloodGroup').value = value;
        document.querySelectorAll('.blood-chip').forEach(c => c.classList.remove('selected'));
        chipEl.classList.add('selected');
    }
    function syncBloodChips(value) {
        document.querySelectorAll('.blood-chip').forEach(chip => {
            chip.classList.remove('selected');
            if (chip.textContent.trim().includes(value)) chip.classList.add('selected');
        });
    }
    function selectUrgency(value, chipEl) {
        document.getElementById('urgencyInput').value = value;
        document.querySelectorAll('.urgency-chip').forEach(c => c.classList.remove('selected'));
        chipEl.classList.add('selected');
    }

    document.getElementById('emergencyRequestForm').addEventListener('submit', function(e) {
        var btn = document.getElementById('submitBtn');
        btn.querySelector('.btn-text').style.display = 'none';
        btn.querySelector('.btn-loader').style.display = 'inline-block';
        btn.style.pointerEvents = 'none';
        btn.style.opacity = '0.85';
    });
    </script>

@endsection
