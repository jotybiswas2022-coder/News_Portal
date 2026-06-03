<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<style>
    /* ===== REGISTER SKELETON ===== */
    #register-skeleton {
        position: fixed; inset: 0; z-index: 99999;
        background: linear-gradient(135deg,#0f0f1a,#1a0a0a,#0d0d1a);
        display: flex; align-items: center; justify-content: center;
        transition: opacity 0.5s cubic-bezier(0.4,0,0.2,1);
        font-family: 'Inter', 'Noto Sans Bengali', sans-serif;
    }
    #register-skeleton.sk-hidden { opacity: 0; pointer-events: none; }
    @keyframes sk-reg-shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
    .sk-r-block {
        background: linear-gradient(90deg, rgba(255,255,255,0.04) 25%, rgba(255,255,255,0.08) 50%, rgba(255,255,255,0.04) 75%);
        background-size: 200% 100%;
        animation: sk-reg-shimmer 1.5s ease-in-out infinite;
        border-radius: 6px;
    }
    .sk-r-circle {
        border-radius: 50%;
        background: linear-gradient(90deg, rgba(255,255,255,0.04) 25%, rgba(255,255,255,0.08) 50%, rgba(255,255,255,0.04) 75%);
        background-size: 200% 100%;
        animation: sk-reg-shimmer 1.5s ease-in-out infinite;
    }
</style>

{{-- ===== REGISTER SKELETON OVERLAY ===== --}}
<div id="register-skeleton">
    <div style="width:100%;max-width:480px;text-align:center;">
        {{-- Brand --}}
        <div style="margin-bottom:24px;">
            <div class="sk-r-block" style="width:56px;height:56px;border-radius:16px;margin:0 auto 12px;"></div>
            <div class="sk-r-block" style="width:140px;height:22px;margin:0 auto 8px;"></div>
            <div class="sk-r-block" style="width:180px;height:12px;margin:0 auto;"></div>
        </div>
        {{-- Card --}}
        <div style="background:rgba(255,255,255,0.02);border-radius:20px;overflow:hidden;border:1px solid rgba(255,255,255,0.04);">
            <div style="padding:28px 32px 20px;border-bottom:1px solid rgba(255,255,255,0.04);">
                <div class="sk-r-block" style="width:200px;height:20px;margin:0 auto;"></div>
            </div>
            <div style="padding:26px 32px;">
                <div class="sk-r-block" style="width:100%;height:42px;border-radius:10px;margin-bottom:20px;"></div>
                <div style="display:flex;align-items:center;gap:12px;margin:20px 0;">
                    <div class="sk-r-block" style="flex:1;height:1px;"></div>
                    <div class="sk-r-block" style="width:130px;height:12px;"></div>
                    <div class="sk-r-block" style="flex:1;height:1px;"></div>
                </div>
                <div style="margin-bottom:16px;">
                    <div class="sk-r-block" style="width:60px;height:12px;margin-bottom:10px;"></div>
                    <div class="sk-r-block" style="width:100%;height:44px;border-radius:10px;"></div>
                </div>
                <div style="margin-bottom:16px;">
                    <div class="sk-r-block" style="width:80px;height:12px;margin-bottom:10px;"></div>
                    <div class="sk-r-block" style="width:100%;height:44px;border-radius:10px;"></div>
                </div>
                <div style="margin-bottom:16px;">
                    <div class="sk-r-block" style="width:60px;height:12px;margin-bottom:10px;"></div>
                    <div class="sk-r-block" style="width:100%;height:44px;border-radius:10px;"></div>
                </div>
                <div style="margin-bottom:18px;">
                    <div class="sk-r-block" style="width:100px;height:12px;margin-bottom:10px;"></div>
                    <div class="sk-r-block" style="width:100%;height:44px;border-radius:10px;"></div>
                </div>
                <div class="sk-r-block" style="width:100%;height:44px;border-radius:10px;"></div>
            </div>
        </div>
    </div>
</div>

<script>
(function(){
    var sk = document.getElementById('register-skeleton');
    function hide(){ if(sk){ sk.classList.add('sk-hidden'); setTimeout(function(){ sk.style.display='none'; },500); } }
    if(document.readyState==='complete') hide(); else { window.addEventListener('load',hide); setTimeout(hide,2000); }
})();
</script>

<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#0f0f1a 0%,#1a0a0a 50%,#0d0d1a 100%);position:relative;overflow:hidden;padding:24px 16px;font-family:'Inter','Noto Sans Bengali',sans-serif;">

    {{-- ====== ANIMATED BACKGROUND LAYER ====== --}}
    <div style="position:absolute;inset:0;overflow:hidden;pointer-events:none;">

        {{-- Orbs --}}
        <div style="position:absolute;top:-200px;left:50%;transform:translateX(-50%);width:600px;height:600px;border-radius:50%;background:radial-gradient(circle,rgba(220,38,38,0.2) 0%,transparent 70%);animation:orbPulse 4s ease-in-out infinite;"></div>
        <div style="position:absolute;bottom:-150px;left:-100px;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(102,126,234,0.1) 0%,transparent 70%);animation:orbPulse2 6s ease-in-out infinite;"></div>
        <div style="position:absolute;top:15%;right:8%;width:220px;height:220px;border-radius:50%;background:radial-gradient(circle,rgba(239,68,68,0.08) 0%,transparent 70%);animation:orbPulse3 8s ease-in-out infinite;"></div>

        {{-- Grid --}}
        <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.03) 1px,transparent 1px);background-size:48px 48px;"></div>

        {{-- Floating blood drops --}}
        <div class="float-drop" style="left:6%;  animation-duration:10s; animation-delay:0s;   bottom:-30px;">🩸</div>
        <div class="float-drop" style="left:20%; animation-duration:11s; animation-delay:2.5s; bottom:-30px;">🩸</div>
        <div class="float-drop" style="left:38%; animation-duration:8s;  animation-delay:4s;   bottom:-30px;">🩸</div>
        <div class="float-drop" style="left:55%; animation-duration:12s; animation-delay:1s;   bottom:-30px;">🩸</div>
        <div class="float-drop" style="left:72%; animation-duration:9s;  animation-delay:3s;   bottom:-30px;">🩸</div>
        <div class="float-drop" style="left:85%; animation-duration:11s; animation-delay:5s;   bottom:-30px;">🩸</div>
        <div class="float-drop" style="left:95%; animation-duration:13s; animation-delay:2s;   bottom:-30px;">🩸</div>

        {{-- Floating plus signs --}}
        <span class="float-plus" style="left:12%; animation-duration:13s; animation-delay:1.5s; bottom:-20px;">+</span>
        <span class="float-plus" style="left:30%; animation-duration:15s; animation-delay:3s;   bottom:-20px;">✚</span>
        <span class="float-plus" style="left:48%; animation-duration:10s; animation-delay:.8s;  bottom:-20px;">+</span>
        <span class="float-plus" style="left:65%; animation-duration:12s; animation-delay:2.2s; bottom:-20px;">✚</span>
        <span class="float-plus" style="left:80%; animation-duration:14s; animation-delay:4s;   bottom:-20px;">+</span>
        <span class="float-plus" style="left:92%; animation-duration:11s; animation-delay:1s;   bottom:-20px;">✚</span>
    </div>

    {{-- ====== MAIN CARD ====== --}}
    <div style="width:100%;max-width:480px;position:relative;z-index:1;animation:cardIn 0.7s cubic-bezier(0.22,1,0.36,1) both;">

        {{-- Brand --}}
        <div style="text-align:center;margin-bottom:24px;">
            <div style="width:56px;height:56px;margin:0 auto 12px;background:linear-gradient(135deg,#dc2626,#ef4444);border-radius:16px;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 30px rgba(220,38,38,0.3);transition:transform 0.3s;"
                 onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <i class="bi bi-droplet-fill" style="font-size:26px;color:#fff;"></i>
            </div>
            <div style="font-size:22px;font-weight:800;color:#fff;letter-spacing:0.3px;">ব্লাড ব্যাংক</div>
            <div style="font-size:11px;color:rgba(255,255,255,0.4);letter-spacing:2px;text-transform:uppercase;margin-top:4px;">রক্তদান · জীবন বাঁচান</div>
        </div>

        {{-- Register Card --}}
        <div style="background:rgba(255,255,255,0.04);backdrop-filter:blur(24px);-webkit-backdrop-filter:blur(24px);border-radius:20px;border:1px solid rgba(255,255,255,0.08);overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,0.5),0 0 0 1px rgba(255,255,255,0.05);">

            {{-- Header --}}
            <div style="padding:28px 32px 20px;text-align:center;border-bottom:1px solid rgba(255,255,255,0.06);">
                <div style="display:flex;align-items:center;justify-content:center;gap:8px;margin-bottom:2px;">
                    <span style="width:36px;height:36px;border-radius:10px;background:rgba(220,38,38,0.15);display:flex;align-items:center;justify-content:center;transition:transform 0.3s;"
                          onmouseover="this.style.transform='rotate(-10deg)'" onmouseout="this.style.transform='rotate(0)'">
                        <i class="bi bi-person-plus-fill" style="font-size:15px;color:#ef4444;"></i>
                    </span>
                    <span style="font-size:17px;font-weight:700;color:#fff;">নতুন অ্যাকাউন্ট তৈরি করুন</span>
                </div>
                <p style="font-size:12.5px;color:rgba(255,255,255,0.35);margin:6px 0 0;">রক্তদান যাত্রা শুরু করতে নিবন্ধন করুন</p>
            </div>

            {{-- Body --}}
            <div style="padding:26px 32px 22px;">

                {{-- ====== GOOGLE SIGN-IN ====== --}}
                <a href="{{ route('auth.google') }}"
                   style="width:100%;padding:11px 16px;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.1);border-radius:10px;display:flex;align-items:center;justify-content:center;gap:10px;color:rgba(255,255,255,0.85);text-decoration:none;font-size:13.5px;font-weight:600;transition:all 0.25s;font-family:inherit;cursor:pointer;"
                   onmouseover="this.style.background='rgba(255,255,255,0.1)';this.style.borderColor='rgba(255,255,255,0.18)'"
                   onmouseout="this.style.background='rgba(255,255,255,0.06)';this.style.borderColor='rgba(255,255,255,0.1)'">
                    <svg style="width:20px;height:20px;flex-shrink:0;" viewBox="0 0 48 48">
                        <path fill="#FFC107" d="M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4 12.955 4 4 12.955 4 24s8.955 20 20 20 20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z"/>
                        <path fill="#FF3D00" d="m6.306 14.691 6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4 16.318 4 9.656 8.337 6.306 14.691z"/>
                        <path fill="#4CAF50" d="M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238A11.91 11.91 0 0 1 24 36c-5.202 0-9.619-3.317-11.283-7.946l-6.522 5.025C9.505 39.556 16.227 44 24 44z"/>
                        <path fill="#1976D2" d="M43.611 20.083H42V20H24v8h11.303a12.04 12.04 0 0 1-4.087 5.571l.003-.002 6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917z"/>
                    </svg>
                    Google দিয়ে নিবন্ধন করুন
                </a>

                {{-- Divider --}}
                <div style="display:flex;align-items:center;gap:12px;margin:20px 0;">
                    <span style="flex:1;height:1px;background:rgba(255,255,255,0.06);"></span>
                    <span style="font-size:11px;color:rgba(255,255,255,0.2);font-weight:600;letter-spacing:1px;text-transform:uppercase;white-space:nowrap;">ইমেইল দিয়ে নিবন্ধন</span>
                    <span style="flex:1;height:1px;background:rgba(255,255,255,0.06);"></span>
                </div>

                {{-- ====== REGISTER FORM ====== --}}
                <form method="POST" action="{{ route('register') }}" autocomplete="off">
                    @csrf

                    {{-- Name --}}
                    <div style="margin-bottom:16px;">
                        <label for="name" style="display:block;font-size:11.5px;font-weight:600;color:rgba(255,255,255,0.5);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:7px;">
                            <span style="display:inline-block;width:5px;height:5px;background:#ef4444;border-radius:50%;margin-right:6px;vertical-align:middle;"></span>পূর্ণ নাম
                        </label>
                        <div style="position:relative;">
                            <i class="bi bi-person-fill" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);font-size:14px;color:rgba(255,255,255,0.25);transition:color 0.3s;z-index:2;"></i>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="আপনার পূর্ণ নাম" required autofocus autocomplete="name"
                                   style="width:100%;padding:12px 16px 12px 42px;background:rgba(255,255,255,0.05);border:1.5px solid rgba(255,255,255,0.08);border-radius:10px;color:#fff;font-size:14px;font-family:inherit;outline:none;transition:all 0.3s;box-sizing:border-box;"
                                   onfocus="this.style.borderColor='rgba(239,68,68,0.5)';this.style.background='rgba(239,68,68,0.06)';this.style.boxShadow='0 0 0 3px rgba(239,68,68,0.08)';this.previousElementSibling.style.color='#ef4444'"
                                   onblur="this.style.borderColor='rgba(255,255,255,0.08)';this.style.background='rgba(255,255,255,0.05)';this.style.boxShadow='none';this.previousElementSibling.style.color='rgba(255,255,255,0.25)'">
                        </div>
                        @error('name')
                            <span style="display:block;margin-top:5px;font-size:12px;color:#f87171;"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div style="margin-bottom:16px;">
                        <label for="email" style="display:block;font-size:11.5px;font-weight:600;color:rgba(255,255,255,0.5);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:7px;">
                            <span style="display:inline-block;width:5px;height:5px;background:#ef4444;border-radius:50%;margin-right:6px;vertical-align:middle;"></span>ইমেইল ঠিকানা
                        </label>
                        <div style="position:relative;">
                            <i class="bi bi-envelope-fill" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);font-size:14px;color:rgba(255,255,255,0.25);transition:color 0.3s;z-index:2;"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autocomplete="email"
                                   style="width:100%;padding:12px 16px 12px 42px;background:rgba(255,255,255,0.05);border:1.5px solid rgba(255,255,255,0.08);border-radius:10px;color:#fff;font-size:14px;font-family:inherit;outline:none;transition:all 0.3s;box-sizing:border-box;"
                                   onfocus="this.style.borderColor='rgba(239,68,68,0.5)';this.style.background='rgba(239,68,68,0.06)';this.style.boxShadow='0 0 0 3px rgba(239,68,68,0.08)';this.previousElementSibling.style.color='#ef4444'"
                                   onblur="this.style.borderColor='rgba(255,255,255,0.08)';this.style.background='rgba(255,255,255,0.05)';this.style.boxShadow='none';this.previousElementSibling.style.color='rgba(255,255,255,0.25)'">
                        </div>
                        @error('email')
                            <span style="display:block;margin-top:5px;font-size:12px;color:#f87171;"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div style="margin-bottom:16px;">
                        <label for="password" style="display:block;font-size:11.5px;font-weight:600;color:rgba(255,255,255,0.5);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:7px;">
                            <span style="display:inline-block;width:5px;height:5px;background:#ef4444;border-radius:50%;margin-right:6px;vertical-align:middle;"></span>পাসওয়ার্ড
                        </label>
                        <div style="position:relative;">
                            <i class="bi bi-key-fill" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);font-size:14px;color:rgba(255,255,255,0.25);transition:color 0.3s;z-index:2;"></i>
                            <input id="password" type="password" name="password" placeholder="•••••••• (ন্যূনতম ৮ অক্ষর)" required autocomplete="new-password"
                                   style="width:100%;padding:12px 42px 12px 42px;background:rgba(255,255,255,0.05);border:1.5px solid rgba(255,255,255,0.08);border-radius:10px;color:#fff;font-size:14px;font-family:inherit;outline:none;transition:all 0.3s;box-sizing:border-box;"
                                   onfocus="this.style.borderColor='rgba(239,68,68,0.5)';this.style.background='rgba(239,68,68,0.06)';this.style.boxShadow='0 0 0 3px rgba(239,68,68,0.08)';this.previousElementSibling.style.color='#ef4444'"
                                   onblur="this.style.borderColor='rgba(255,255,255,0.08)';this.style.background='rgba(255,255,255,0.05)';this.style.boxShadow='none';this.previousElementSibling.style.color='rgba(255,255,255,0.25)'">
                            {{-- Password toggle --}}
                            <span onclick="togglePassword()"
                                  style="position:absolute;right:12px;top:50%;transform:translateY(-50%);color:rgba(255,255,255,0.25);cursor:pointer;font-size:15px;z-index:2;transition:color 0.25s;display:flex;align-items:center;"
                                  onmouseover="this.style.color='rgba(255,255,255,0.6)'"
                                  onmouseout="this.style.color='rgba(255,255,255,0.25)'">
                                <i class="bi bi-eye-slash" id="toggleIcon1"></i>
                            </span>
                        </div>
                        @error('password')
                            <span style="display:block;margin-top:5px;font-size:12px;color:#f87171;"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div style="margin-bottom:18px;">
                        <label for="password-confirm" style="display:block;font-size:11.5px;font-weight:600;color:rgba(255,255,255,0.5);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:7px;">
                            <span style="display:inline-block;width:5px;height:5px;background:#ef4444;border-radius:50%;margin-right:6px;vertical-align:middle;"></span>পাসওয়ার্ড নিশ্চিত করুন
                        </label>
                        <div style="position:relative;">
                            <i class="bi bi-shield-lock-fill" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);font-size:14px;color:rgba(255,255,255,0.25);transition:color 0.3s;z-index:2;"></i>
                            <input id="password-confirm" type="password" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password"
                                   style="width:100%;padding:12px 42px 12px 42px;background:rgba(255,255,255,0.05);border:1.5px solid rgba(255,255,255,0.08);border-radius:10px;color:#fff;font-size:14px;font-family:inherit;outline:none;transition:all 0.3s;box-sizing:border-box;"
                                   onfocus="this.style.borderColor='rgba(239,68,68,0.5)';this.style.background='rgba(239,68,68,0.06)';this.style.boxShadow='0 0 0 3px rgba(239,68,68,0.08)';this.previousElementSibling.style.color='#ef4444'"
                                   onblur="this.style.borderColor='rgba(255,255,255,0.08)';this.style.background='rgba(255,255,255,0.05)';this.style.boxShadow='none';this.previousElementSibling.style.color='rgba(255,255,255,0.25)'">
                            {{-- Confirm password toggle --}}
                            <span onclick="togglePasswordConfirm()"
                                  style="position:absolute;right:12px;top:50%;transform:translateY(-50%);color:rgba(255,255,255,0.25);cursor:pointer;font-size:15px;z-index:2;transition:color 0.25s;display:flex;align-items:center;"
                                  onmouseover="this.style.color='rgba(255,255,255,0.6)'"
                                  onmouseout="this.style.color='rgba(255,255,255,0.25)'">
                                <i class="bi bi-eye-slash" id="toggleIcon2"></i>
                            </span>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" id="registerBtn"
                            style="width:100%;padding:13px;background:linear-gradient(135deg,#dc2626,#ef4444);color:#fff;font-size:15px;font-weight:700;font-family:inherit;border:none;border-radius:10px;cursor:pointer;letter-spacing:0.3px;transition:all 0.3s cubic-bezier(0.4,0,0.2,1);box-shadow:0 4px 20px rgba(220,38,38,0.35);position:relative;overflow:hidden;display:flex;align-items:center;justify-content:center;gap:8px;"
                            onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 30px rgba(220,38,38,0.5)'"
                            onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 20px rgba(220,38,38,0.35)'">
                        <span class="btn-text"><i class="bi bi-person-check-fill"></i> নিবন্ধন করুন</span>
                        <span class="btn-loader" style="display:none;width:20px;height:20px;border:2px solid rgba(255,255,255,0.3);border-top-color:#fff;border-radius:50%;animation:spin 0.7s linear infinite;"></span>
                    </button>

                </form>

                {{-- Divider --}}
                <div style="display:flex;align-items:center;gap:12px;margin:20px 0 16px;">
                    <span style="flex:1;height:1px;background:rgba(255,255,255,0.06);"></span>
                    <span style="font-size:11px;color:rgba(255,255,255,0.2);font-weight:600;letter-spacing:1px;text-transform:uppercase;white-space:nowrap;">অথবা</span>
                    <span style="flex:1;height:1px;background:rgba(255,255,255,0.06);"></span>
                </div>

                {{-- Login --}}
                <div style="text-align:center;">
                    <span style="font-size:13px;color:rgba(255,255,255,0.4);">ইতিমধ্যে অ্যাকাউন্ট আছে?</span>
                    <a href="{{ route('login') }}"
                       style="display:inline-block;margin-left:6px;padding:9px 22px;border:1.5px solid rgba(239,68,68,0.3);border-radius:8px;color:#ef4444;text-decoration:none;font-size:13px;font-weight:600;transition:all 0.25s;"
                       onmouseover="this.style.background='rgba(239,68,68,0.12)';this.style.borderColor='#ef4444'"
                       onmouseout="this.style.background='transparent';this.style.borderColor='rgba(239,68,68,0.3)'">
                        <i class="bi bi-box-arrow-in-left"></i> লগইন করুন
                    </a>
                </div>

            </div>

            {{-- Bottom strip --}}
            <div style="padding:10px 32px;background:rgba(220,38,38,0.04);border-top:1px solid rgba(255,255,255,0.04);display:flex;align-items:center;justify-content:center;gap:6px;">
                <i class="bi bi-shield-check" style="font-size:11px;color:rgba(255,255,255,0.18);"></i>
                <span style="font-size:10.5px;color:rgba(255,255,255,0.18);">আপনার তথ্য সম্পূর্ণ সুরক্ষিত</span>
            </div>

        </div>

        {{-- Page footer --}}
        <div style="text-align:center;margin-top:22px;font-size:11.5px;color:rgba(255,255,255,0.12);">
            Developed by <span style="font-weight:700;background:linear-gradient(135deg,#ef4444,#f97316);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Joty Biswas</span> &copy; {{ date('Y') }}
        </div>

    </div>

</div>

<script>
// ── Password Toggle ──
function togglePassword() {
    var pw = document.getElementById('password');
    var icon = document.getElementById('toggleIcon1');
    if (pw.type === 'password') {
        pw.type = 'text';
        icon.className = 'bi bi-eye';
    } else {
        pw.type = 'password';
        icon.className = 'bi bi-eye-slash';
    }
}

function togglePasswordConfirm() {
    var pw = document.getElementById('password-confirm');
    var icon = document.getElementById('toggleIcon2');
    if (pw.type === 'password') {
        pw.type = 'text';
        icon.className = 'bi bi-eye';
    } else {
        pw.type = 'password';
        icon.className = 'bi bi-eye-slash';
    }
}

// ── Submit Loading State ──
document.addEventListener('DOMContentLoaded', function() {
    var form = document.querySelector('form');
    var btn = document.getElementById('registerBtn');
    if (form && btn) {
        form.addEventListener('submit', function() {
            btn.querySelector('.btn-text').style.display = 'none';
            btn.querySelector('.btn-loader').style.display = 'inline-block';
            btn.style.pointerEvents = 'none';
            btn.style.opacity = '0.85';
        });
    }
});
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Noto+Sans+Bengali:wght@400;500;600;700;800&display=swap');

@keyframes orbPulse {
    0%, 100% { transform: translateX(-50%) scale(1); opacity: 0.7; }
    50% { transform: translateX(-50%) scale(1.12); opacity: 1; }
}
@keyframes orbPulse2 {
    0%, 100% { transform: scale(1); opacity: 0.5; }
    50% { transform: scale(1.1); opacity: 0.8; }
}
@keyframes orbPulse3 {
    0%, 100% { transform: scale(1); opacity: 0.3; }
    50% { transform: scale(1.25); opacity: 0.6; }
}
@keyframes cardIn {
    from { opacity: 0; transform: translateY(30px) scale(0.97); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}
@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Floating blood drops */
.float-drop {
    position: absolute;
    font-size: 20px;
    opacity: 0;
    animation: floatDrop linear infinite;
    pointer-events: none;
    user-select: none;
    filter: drop-shadow(0 0 6px rgba(220,38,38,0.3));
}
@keyframes floatDrop {
    0%   { transform: translateY(0) rotate(0deg) scale(0.6); opacity: 0; }
    10%  { opacity: 0.35; transform: translateX(10px) rotate(15deg) scale(0.8); }
    50%  { opacity: 0.2; transform: translateX(-15px) rotate(45deg) scale(1); }
    90%  { opacity: 0.3; transform: translateX(8px) rotate(75deg) scale(0.7); }
    100% { transform: translateY(-105vh) rotate(90deg) scale(0.4); opacity: 0; }
}

/* Floating plus signs */
.float-plus {
    position: absolute;
    color: rgba(255,120,120,0.2);
    font-size: 22px;
    font-weight: 900;
    animation: floatPlus linear infinite;
    pointer-events: none;
    user-select: none;
}
@keyframes floatPlus {
    0%   { transform: translateY(0) rotate(0deg);   opacity: 0; }
    15%  { opacity: 0.45; }
    85%  { opacity: 0.15; }
    100% { transform: translateY(-110vh) rotate(180deg); opacity: 0; }
}

* { box-sizing: border-box; }
body { margin: 0; }

/* ===== LIGHT MODE ===== */
.light-mode div[style*="background:linear-gradient(135deg,#0f0f1a"] {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #fef2f2 100%) !important;
}

.light-mode div[style*="font-size:22px;font-weight:800;color:#fff"] {
    color: #1f2937 !important;
}

.light-mode div[style*="color:rgba(255,255,255,0.12)"] {
    color: rgba(0, 0, 0, 0.3) !important;
}

.light-mode div[style*="background:rgba(255,255,255,0.04);backdrop-filter:blur(24px)"] {
    background: rgba(255, 255, 255, 0.85) !important;
    border-color: rgba(0, 0, 0, 0.08) !important;
}

.light-mode div[style*="padding:28px 32px 20px;text-align:center;border-bottom:1px solid rgba(255,255,255,0.06)"] {
    border-bottom-color: rgba(0, 0, 0, 0.06) !important;
}

.light-mode span[style*="font-size:17px;font-weight:700;color:#fff"] {
    color: #1f2937 !important;
}

.light-mode p[style*="font-size:12.5px;color:rgba(255,255,255,0.35)"] {
    color: rgba(0, 0, 0, 0.4) !important;
}

.light-mode a[style*="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.1)"] {
    background: rgba(0, 0, 0, 0.04) !important;
    border-color: rgba(0, 0, 0, 0.1) !important;
    color: rgba(0, 0, 0, 0.7) !important;
}

.light-mode span[style*="flex:1;height:1px;background:rgba(255,255,255,0.06)"] {
    background: rgba(0, 0, 0, 0.08) !important;
}

.light-mode span[style*="font-size:11px;color:rgba(255,255,255,0.2)"] {
    color: rgba(0, 0, 0, 0.3) !important;
}

.light-mode label[style*="color:rgba(255,255,255,0.5)"] {
    color: rgba(0, 0, 0, 0.5) !important;
}

.light-mode input[style*="background:rgba(255,255,255,0.05);border:1.5px solid rgba(255,255,255,0.08)"] {
    background: rgba(0, 0, 0, 0.03) !important;
    border-color: rgba(0, 0, 0, 0.1) !important;
    color: #1f2937 !important;
}

.light-mode i[style*="color:rgba(255,255,255,0.25);transition:color 0.3s;z-index:2"] {
    color: rgba(0, 0, 0, 0.3) !important;
}

.light-mode span[style*="position:absolute;right:12px;top:50%;transform:translateY(-50%);color:rgba(255,255,255,0.25);cursor:pointer;font-size:15px;z-index:2"] {
    color: rgba(0, 0, 0, 0.3) !important;
}

.light-mode div[style*="padding:10px 32px;background:rgba(220,38,38,0.04);border-top:1px solid rgba(255,255,255,0.04)"] {
    background: rgba(220, 38, 38, 0.03) !important;
    border-top-color: rgba(0, 0, 0, 0.04) !important;
}

.light-mode i[style*="font-size:11px;color:rgba(255,255,255,0.18)"] {
    color: rgba(0, 0, 0, 0.2) !important;
}

.light-mode span[style*="font-size:10.5px;color:rgba(255,255,255,0.18)"] {
    color: rgba(0, 0, 0, 0.2) !important;
}

.light-mode .float-drop {
    opacity: 0.15 !important;
}

.light-mode .float-plus {
    color: rgba(220, 38, 38, 0.12) !important;
}

@media (max-width: 480px) {
    div[style*="padding:28px 32px"] { padding-left: 20px !important; padding-right: 20px !important; }
    div[style*="padding:26px 32px"] { padding-left: 20px !important; padding-right: 20px !important; }
    div[style*="padding:28px 32px 20px"] { padding-left: 20px !important; padding-right: 20px !important; }
    div[style*="padding:10px 32px"] { padding-left: 20px !important; padding-right: 20px !important; }
}
</style>
