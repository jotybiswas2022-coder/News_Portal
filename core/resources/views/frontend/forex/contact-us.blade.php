@extends('frontend.forex.layouts.app')

@section('title', 'Contact Us — SMART BINARY ZONE')

@section('content')
<!-- ==================== HERO ==================== -->
<section style="position:relative;min-height:45vh;display:flex;align-items:center;padding-top:6rem;padding-bottom:3rem;overflow:hidden">
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="grid-bg" style="position:absolute;inset:0;opacity:0.4;pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding-left:1rem;padding-right:1rem;text-align:center">
        <div class="badge animate-fade-in-up"><span class="badge-dot"></span> Get in Touch</div>
        <h1 style="font-family:'Bebas Neue','Oswald',sans-serif;font-size:clamp(2rem,5vw,3.5rem);font-weight:700;color:#EAEAEA;margin-bottom:0.75rem;animation:fadeInUp 0.6s ease 0.1s both;line-height:1.1">
            Let's <span class="gradient-text">Connect</span>
        </h1>
        <p style="color:rgba(234,234,234,0.5);font-size:1.05rem;max-width:36rem;margin:0 auto;animation:fadeInUp 0.6s ease 0.2s both;line-height:1.6">
            Have a question or need support? We're here to help you every step of the way.
        </p>
    </div>
</section>

<!-- ==================== CONTACT ==================== -->
<section style="padding-top:2rem;padding-bottom:6rem;position:relative;overflow:hidden">
    <div class="orb orb-brand" style="position:absolute;top:50%;right:0;transform:translate(50%,-50%);opacity:0.04;width:500px;height:500px;border-radius:50%;background:rgba(34,85,255,0.15);filter:blur(100px);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:72rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <style>
            @media (min-width:1024px){.cont-grid{grid-template-columns:2fr 3fr}}
            .contact-icon-box{width:2.75rem;height:2.75rem;border-radius:0.75rem;background:rgba(0,95,231,0.1);color:#005fe7;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all 0.3s}
            .glass-card:hover .contact-icon-box{transform:scale(1.1)}
            .contact-input{width:100%;background:rgba(5,5,15,0.8);border:1px solid rgba(255,255,255,0.08);border-radius:0.75rem;padding:0.875rem 1rem;font-size:0.875rem;color:#EAEAEA;transition:all 0.3s;box-sizing:border-box}
            .contact-input:focus{border-color:#005fe7;box-shadow:0 0 0 3px rgba(34,85,255,0.15);outline:none}
            .contact-label{display:block;color:rgba(234,234,234,0.6);font-size:0.75rem;font-weight:500;margin-bottom:0.375rem;text-transform:uppercase;letter-spacing:0.05em}
        </style>
        <div style="display:grid;grid-template-columns:1fr;gap:2rem" class="cont-grid">

            <!-- Left - Contact Info -->
            <div style="display:flex;flex-direction:column;gap:1.25rem">
                <div class="reveal">
                    <h2 style="font-size:1.5rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.5rem">Contact Information</h2>
                    <p style="color:rgba(234,234,234,0.5);font-size:0.875rem">Reach out through any of these channels</p>
                </div>

                <div class="glass-card tilt-card group reveal stagger-1" style="padding:1rem 1.5rem;cursor:default;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)"
                     onmouseover="this.style.boxShadow='0 12px 40px -8px rgba(0,0,0,0.4), 0 0 0 1px rgba(34,85,255,0.12)'"
                     onmouseout="this.style.boxShadow='none'">
                    <div class="tilt-card-inner">
                        <div style="display:flex;align-items:center;gap:1rem">
                            <div class="contact-icon-box">
                                <svg style="width:1.25rem;height:1.25rem" viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 0A12 12 0 000 12a12 12 0 0012 12 12 12 0 0012-12A12 12 0 0012 0a12 12 0 00-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 01.171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
                            </div>
                            <div>
                                <p style="color:#EAEAEA;font-weight:500">Telegram Support Channel</p>
                                <a href="https://t.me/SmartBinarySupport" style="color:rgba(234,234,234,0.5);font-size:0.875rem;text-decoration:none;transition:color 0.3s" onmouseover="this.style.color='#005fe7'" onmouseout="this.style.color='rgba(234,234,234,0.5)'">@darktradingchannel</a>
                            </div>
                        </div>
                    </div>
                    <div class="tilt-card-glow"></div>
                </div>

                <!-- Response time badge -->
                <div class="glass-card reveal stagger-4" style="padding:1.5rem;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)"
                     onmouseover="this.style.boxShadow='0 0 0 1px rgba(34,85,255,0.15)'"
                     onmouseout="this.style.boxShadow='none'">
                    <div style="display:flex;align-items:center;gap:0.75rem">
                        <div style="width:2.5rem;height:2.5rem;border-radius:50%;background:rgba(0,95,231,0.1);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                            <svg style="width:1.25rem;height:1.25rem;color:#005fe7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p style="color:#EAEAEA;font-size:0.875rem;font-weight:500">Typical Response Time</p>
                            <p style="color:#005fe7;font-size:0.75rem">&lt; 2 hours during business hours</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right - Contact Form -->
            <div>
                <div class="glass-card reveal stagger-2" style="padding:1.5rem;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)"
                     onmouseover="this.style.boxShadow='0 20px 60px -12px rgba(0,0,0,0.5), 0 0 0 1px rgba(34,85,255,0.12)'"
                     onmouseout="this.style.boxShadow='none'">
                    <style>@media (min-width:640px){.cont-form-p{padding:2rem}}</style>
                    <h2 style="font-size:1.5rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.25rem">Send a Message</h2>
                    <p style="color:rgba(234,234,234,0.4);font-size:0.875rem;margin-bottom:1.5rem">Fill out the form and we'll get back to you</p>

                    <form id="contactForm" action="{{ route('forex.contact-submit') }}" method="POST" style="display:flex;flex-direction:column;gap:1.25rem" onsubmit="return handleContactSubmit(event)">
                        @csrf
                        <div style="display:grid;grid-template-columns:1fr;gap:1.25rem" class="cont-form-grid">
                            <div class="cont-input-group">
                                <label class="contact-label">Full Name <span style="color:#005fe7">*</span></label>
                                <div class="cont-input-wrap">
                                    <svg class="cont-input-icon" style="left:0.875rem" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    <input type="text" id="contactName" required class="contact-input has-icon" placeholder="Your name" autocomplete="name">
                                </div>
                            </div>
                            <div class="cont-input-group">
                                <label class="contact-label">Email Address <span style="color:#005fe7">*</span></label>
                                <div class="cont-input-wrap">
                                    <svg class="cont-input-icon" style="left:0.875rem" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                    <input type="email" id="contactEmail" required class="contact-input has-icon" placeholder="your@email.com" autocomplete="email">
                                </div>
                            </div>
                        </div>
                        <div class="cont-input-group">
                            <label class="contact-label">Message <span style="color:#005fe7">*</span></label>
                            <div class="cont-input-wrap">
                                <svg class="cont-input-icon" style="left:0.875rem;top:0.875rem" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                                <textarea id="contactMessage" required rows="5" class="contact-input has-icon" style="resize:none;padding-left:2.5rem" placeholder="Tell us how we can help..."></textarea>
                            </div>
                            <div id="charCount" style="text-align:right;font-size:0.7rem;color:rgba(234,234,234,0.25);margin-top:0.375rem;padding-right:0.25rem">0 / 5000</div>
                        </div>
                        <button type="submit" id="contactSubmit" style="width:100%;display:inline-flex;align-items:center;justify-content:center;gap:0.5rem;padding:0.875rem 2rem;background:linear-gradient(135deg,#005fe7,#2255ff);color:white;font-weight:600;font-size:1rem;border-radius:0.75rem;transition:all 0.3s;cursor:pointer;border:none;position:relative;overflow:hidden" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 30px rgba(34,85,255,0.25)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                            <span style="position:relative;z-index:1;display:flex;align-items:center;gap:0.5rem">
                                <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                Send Message
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== SUPPORT HOURS ==================== -->
<section style="padding-bottom:6rem;position:relative;overflow:hidden">
    <div style="max-width:72rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <div style="text-align:center;margin-bottom:2.5rem" class="reveal">
            <div class="badge"><span class="badge-dot"></span>Availability</div>
            <h2 style="font-family:'Bebas Neue','Oswald',sans-serif;font-size:clamp(2rem,5vw,3.5rem);font-weight:700;line-height:1.1;color:#EAEAEA;margin-bottom:0">Support <span class="gradient-text">Hours</span></h2>
        </div>
        <div style="display:grid;grid-template-columns:1fr;gap:1rem;max-width:48rem;margin:0 auto" class="cont-hours">
            <div class="glass-card tilt-card group reveal stagger-1" style="padding:1.5rem;text-align:center;cursor:default;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)"
                 onmouseover="this.style.boxShadow='0 12px 40px -8px rgba(0,0,0,0.4), 0 0 0 1px rgba(34,85,255,0.12)'"
                 onmouseout="this.style.boxShadow='none'">
                <div class="tilt-card-inner">
                    <div style="width:3rem;height:3rem;margin:0 auto 0.75rem;border-radius:0.75rem;background:linear-gradient(135deg,rgba(34,85,255,0.15),rgba(0,95,231,0.05));border:1px solid rgba(0,95,231,0.1);display:flex;align-items:center;justify-content:center;transition:all 0.3s" onmouseover="this.style.transform='scale(1.1)';this.style.background='linear-gradient(135deg,rgba(34,85,255,0.25),rgba(0,95,231,0.1))'" onmouseout="this.style.transform='scale(1)';this.style.background='linear-gradient(135deg,rgba(34,85,255,0.15),rgba(0,95,231,0.05))'">
                        <svg style="width:1.5rem;height:1.5rem;color:#005fe7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                    </div>
                    <h3 style="color:#EAEAEA;font-weight:600;font-size:0.875rem;margin-bottom:0.25rem;transition:color 0.3s" onmouseover="this.style.color='#005fe7'" onmouseout="this.style.color='#EAEAEA'">Weekdays</h3>
                    <p style="color:rgba(234,234,234,0.4);font-size:0.75rem;margin-bottom:0.25rem">Mon - Fri</p>
                    <p style="color:#005fe7;font-size:0.875rem;font-weight:500">9:00 AM - 6:00 PM</p>
                </div>
                <div class="tilt-card-glow"></div>
            </div>
            <div class="glass-card tilt-card group reveal stagger-2" style="padding:1.5rem;text-align:center;cursor:default;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)"
                 onmouseover="this.style.boxShadow='0 12px 40px -8px rgba(0,0,0,0.4), 0 0 0 1px rgba(34,85,255,0.12)'"
                 onmouseout="this.style.boxShadow='none'">
                <div class="tilt-card-inner">
                    <div style="width:3rem;height:3rem;margin:0 auto 0.75rem;border-radius:0.75rem;background:linear-gradient(135deg,rgba(34,85,255,0.15),rgba(34,85,255,0.05));border:1px solid rgba(34,85,255,0.1);display:flex;align-items:center;justify-content:center;transition:all 0.3s" onmouseover="this.style.transform='scale(1.1)';this.style.background='linear-gradient(135deg,rgba(34,85,255,0.25),rgba(34,85,255,0.1))'" onmouseout="this.style.transform='scale(1)';this.style.background='linear-gradient(135deg,rgba(34,85,255,0.15),rgba(34,85,255,0.05))'">
                        <svg style="width:1.5rem;height:1.5rem;color:#2255ff" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 style="color:#EAEAEA;font-weight:600;font-size:0.875rem;margin-bottom:0.25rem;transition:color 0.3s" onmouseover="this.style.color='#2255ff'" onmouseout="this.style.color='#EAEAEA'">Weekends</h3>
                    <p style="color:rgba(234,234,234,0.4);font-size:0.75rem;margin-bottom:0.25rem">Sat - Sun</p>
                    <p style="color:#2255ff;font-size:0.875rem;font-weight:500">10:00 AM - 4:00 PM</p>
                </div>
                <div class="tilt-card-glow"></div>
            </div>
            <div class="glass-card tilt-card group reveal stagger-3" style="padding:1.5rem;text-align:center;cursor:default;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)"
                 onmouseover="this.style.boxShadow='0 12px 40px -8px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,45,120,0.12)'"
                 onmouseout="this.style.boxShadow='none'">
                <div class="tilt-card-inner">
                    <div style="width:3rem;height:3rem;margin:0 auto 0.75rem;border-radius:0.75rem;background:linear-gradient(135deg,rgba(255,45,120,0.15),rgba(255,45,120,0.05));border:1px solid rgba(255,45,120,0.1);display:flex;align-items:center;justify-content:center;transition:all 0.3s" onmouseover="this.style.transform='scale(1.1)';this.style.background='linear-gradient(135deg,rgba(255,45,120,0.25),rgba(255,45,120,0.1))'" onmouseout="this.style.transform='scale(1)';this.style.background='linear-gradient(135deg,rgba(255,45,120,0.15),rgba(255,45,120,0.05))'">
                        <svg style="width:1.5rem;height:1.5rem;color:#ff2d78" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 style="color:#EAEAEA;font-weight:600;font-size:0.875rem;margin-bottom:0.25rem;transition:color 0.3s" onmouseover="this.style.color='#ff2d78'" onmouseout="this.style.color='#EAEAEA'">Emergency</h3>
                    <p style="color:rgba(234,234,234,0.4);font-size:0.75rem;margin-bottom:0.25rem">24/7 Support</p>
                    <p style="color:#ff2d78;font-size:0.875rem;font-weight:500">Priority Channel</p>
                </div>
                <div class="tilt-card-glow"></div>
            </div>
        </div>
    </div>
</section>

<style>
/* ── Contact Input Icons ── */
.cont-input-group { position:relative; }
.cont-input-wrap { position:relative; }
.cont-input-icon {
    position:absolute; top:50%; transform:translateY(-50%);
    color:rgba(255,255,255,0.2); pointer-events:none; z-index:2;
    transition:color 0.3s ease;
}
.cont-input-wrap:focus-within .cont-input-icon {
    color:#005fe7;
}
.contact-input.has-icon {
    padding-left:2.5rem;
}

/* ── Shimmer Submit Button ── */
#contactSubmit::before {
    content:'';
    position:absolute; top:-50%; left:-50%; width:200%; height:200%;
    background:linear-gradient(45deg,transparent,rgba(255,255,255,0.03),transparent);
    transform:translateX(-100%) rotate(45deg);
    transition:transform 0.6s ease;
}
#contactSubmit:hover::before {
    transform:translateX(100%) rotate(45deg);
}

/* ── Spinner Animation ── */
@keyframes spin { from { transform:rotate(0deg) } to { transform:rotate(360deg) } }

/* ── Focus glow ring ── */
.cont-input-wrap:focus-within .contact-input {
    border-color:#005fe7;
    box-shadow:0 0 0 3px rgba(34,85,255,0.15), 0 0 20px rgba(0,95,231,0.05);
}

/* ── Responsive Grid ── */
@media (min-width:640px) {
    .cont-form-grid { grid-template-columns:repeat(2,1fr) }
    .cont-form-p { padding:2rem }
}
@media (min-width:640px) {
    .cont-hours { grid-template-columns:repeat(3,1fr) }
}
</style>

<script>
function handleContactSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const btn = document.getElementById('contactSubmit');
    btn.disabled = true;
    btn.innerHTML = '<span style="display:flex;align-items:center;gap:0.5rem;position:relative;z-index:1"><svg style="width:1rem;height:1rem;animation:spin 1s linear infinite" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10" stroke-width="3" stroke="rgba(255,255,255,0.3)" fill="none"/><path d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" fill="currentColor"/></svg> Sending...</span>';

    fetch('{{ route('forex.contact-submit') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        body: JSON.stringify({
            name: document.getElementById('contactName').value.trim(),
            email: document.getElementById('contactEmail').value.trim(),
            subject: (document.getElementById('contactSubject')?.value || '').trim(),
            message: document.getElementById('contactMessage').value.trim()
        })
    })
    .then(function(res) {
        if (!res.ok) {
            return res.json().then(function(err) {
                var msg = 'Something went wrong.';
                if (err.errors) {
                    var first = Object.values(err.errors)[0];
                    if (first && first.length) msg = first[0];
                } else if (err.message) {
                    msg = err.message;
                }
                throw new Error(msg);
            });
        }
        return res.json();
    })
    .then(function(data) {
        showToast(data.message || 'Message sent successfully!', 'success');
        form.reset();
        document.getElementById('charCount').textContent = '0 / 5000';
    })
    .catch(function(err) {
        showToast(err.message || 'Network error. Please try again.', 'error');
    })
    .finally(function() {
        btn.disabled = false;
        btn.innerHTML = '<span style="display:flex;align-items:center;gap:0.5rem;position:relative;z-index:1"><svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg> Send Message</span>';
    });
    return false;
}

/* ── Live character count ── */
document.addEventListener('DOMContentLoaded', function() {
    var msgField = document.getElementById('contactMessage');
    var charCount = document.getElementById('charCount');
    if (msgField && charCount) {
        msgField.addEventListener('input', function() {
            var len = this.value.length;
            var max = 5000;
            charCount.textContent = len + ' / ' + max;
            charCount.style.color = len > max ? '#ef4444' : 'rgba(234,234,234,0.25)';
        });
    }

    /* ── Field focus effects for contact-input-wrap ── */
    document.querySelectorAll('.contact-input').forEach(function(input) {
        input.addEventListener('focus', function() {
            var wrap = this.closest('.cont-input-wrap');
            if (wrap) {
                wrap.style.transform = 'scale(1.01)';
            }
        });
        input.addEventListener('blur', function() {
            var wrap = this.closest('.cont-input-wrap');
            if (wrap) {
                wrap.style.transform = 'scale(1)';
            }
        });
    });
});
</script>
@endsection
