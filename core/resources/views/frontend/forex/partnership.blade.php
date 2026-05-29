@extends('frontend.forex.layouts.app')

@section('title', 'Partnership — SMART BINARY ZONE')

@section('content')
<!-- ==================== HERO ==================== -->
<section style="position:relative;min-height:55vh;display:flex;align-items:center;padding-top:6rem;padding-bottom:3rem;overflow:hidden">
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="grid-bg" style="position:absolute;inset:0;opacity:0.4;pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <div style="display:grid;grid-template-columns:1fr;gap:3rem;align-items:center">
            <style>@media (min-width:1024px){.part-hero{grid-template-columns:repeat(2,1fr)}}</style>
            <div>
                <div class="badge animate-fade-in-up"><span class="badge-dot"></span> Become Our Partner</div>
                <h1 style="font-family:'Bebas Neue','Oswald',sans-serif;font-size:3rem;font-weight:700;color:#EAEAEA;margin-bottom:1.5rem;animation:fadeInUp 0.6s ease 0.1s both;line-height:1.1">
                    Partnership <span class="gradient-text">Program</span>
                </h1>
                <p style="color:rgba(234,234,234,0.6);font-size:1.125rem;line-height:1.625;animation:fadeInUp 0.6s ease 0.2s both">
                    Join our partnership program and earn commissions by referring traders to our Expert Advisors. We offer competitive rates and full support.
                </p>
                <div style="display:flex;flex-wrap:wrap;gap:1rem;margin-top:2rem;animation:fadeInUp 0.6s ease 0.3s both">
                    <a href="#apply" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.875rem 2rem;background:linear-gradient(135deg,#005fe7,#2255ff);color:white;font-weight:600;font-size:1rem;border-radius:0.75rem;transition:all 0.3s" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 30px rgba(34,85,255,0.25)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                        Apply Now
                        <svg style="width:1rem;height:1rem;transition:transform 0.3s" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="#benefits" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.875rem 2rem;border:1px solid rgba(34,85,255,0.25);background:rgba(0,95,231,0.04);color:#EAEAEA;font-weight:600;font-size:1rem;border-radius:0.75rem;transition:all 0.3s" onmouseover="this.style.borderColor='#005fe7';this.style.background='rgba(0,95,231,0.08)';this.style.boxShadow='0 0 20px rgba(34,85,255,0.12)'" onmouseout="this.style.borderColor='rgba(34,85,255,0.25)';this.style.background='rgba(0,95,231,0.04)';this.style.boxShadow='none'">See Benefits</a>
                </div>
            </div>
            <div style="display:none;animation:fadeInUp 0.6s ease 0.3s both">
                <style>@media (min-width:1024px){.part-hero-visual{display:flex}}</style>
                <div class="glass-card" style="padding:3rem;aspect-ratio:1;display:flex;align-items:center;justify-content:center;transition:all 0.4s cubic-bezier(0.4,0,0.2,1);cursor:default" onmouseover="this.style.transform='scale(1.02)';this.style.boxShadow='0 0 0 1px rgba(34,85,255,0.15)'" onmouseout="this.style.transform='scale(1)';this.style.boxShadow='none'">
                    <svg style="width:7rem;height:7rem;color:rgba(234,234,234,0.1);transition:all 0.5s" fill="none" stroke="currentColor" viewBox="0 0 24 24" onmouseover="this.style.color='rgba(34,85,255,0.2)'" onmouseout="this.style.color='rgba(234,234,234,0.1)'"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== BENEFITS ==================== -->
<section id="benefits" style="padding-top:6rem;padding-bottom:6rem;position:relative;overflow:hidden">
    <div class="orb orb-brand" style="position:absolute;top:0;right:0;transform:translate(33%,-33%);opacity:0.04;width:500px;height:500px;border-radius:50%;background:rgba(34,85,255,0.15);filter:blur(100px);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:80rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <style>
            @media (min-width:640px){.part-px{padding-left:1.5rem;padding-right:1.5rem}}
            @media (min-width:1024px){.part-px{padding-left:2rem;padding-right:2rem}}
            .part-bene-grid{grid-template-columns:1fr}
            @media (min-width:640px){.part-bene-grid{grid-template-columns:repeat(2,1fr)}}
            @media (min-width:1024px){.part-bene-grid{grid-template-columns:repeat(4,1fr)}}
        </style>
        <div style="text-align:center;margin-bottom:3rem" class="reveal">
            <div class="badge"><span class="badge-dot"></span> Why Partner With Us</div>
            <h2 style="font-family:'Bebas Neue','Oswald',sans-serif;font-size:clamp(2rem,5vw,3.5rem);font-weight:700;line-height:1.1;color:#EAEAEA;margin-bottom:1rem">Partnership <span class="gradient-text">Benefits</span></h2>
            <p style="font-size:clamp(0.95rem,1.2vw,1.1rem);color:rgba(234,234,234,0.5);max-width:36rem;margin:0 auto;line-height:1.6">Everything you need to succeed as our partner</p>
        </div>

        <div style="display:grid;gap:1.25rem" class="part-bene-grid">
            <div class="glass-card tilt-card group reveal text-center" style="padding:2rem 1.5rem;cursor:default;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)"
                 onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 16px 48px -8px rgba(0,0,0,0.4), 0 0 0 1px rgba(34,85,255,0.15)'"
                 onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                <div class="tilt-card-inner">
                    <div style="width:3.5rem;height:3.5rem;margin:0 auto 1rem;border-radius:0.875rem;background:linear-gradient(135deg,rgba(34,85,255,0.15),rgba(0,95,231,0.05));border:1px solid rgba(0,95,231,0.1);display:flex;align-items:center;justify-content:center;transition:all 0.3s" onmouseover="this.style.transform='scale(1.1)';this.style.background='linear-gradient(135deg,rgba(34,85,255,0.25),rgba(0,95,231,0.1))'" onmouseout="this.style.transform='scale(1)';this.style.background='linear-gradient(135deg,rgba(34,85,255,0.15),rgba(0,95,231,0.05))'">
                        <svg style="width:1.75rem;height:1.75rem;color:#005fe7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 style="color:#EAEAEA;font-weight:600;margin-bottom:0.5rem;transition:color 0.3s" onmouseover="this.style.color='#005fe7'" onmouseout="this.style.color='#EAEAEA'">High Commission</h3>
                    <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;line-height:1.625">Earn up to 30% commission on every sale you refer. No caps, no limits.</p>
                </div>
                <div class="tilt-card-glow"></div>
            </div>
            <div class="glass-card tilt-card group reveal text-center" style="padding:2rem 1.5rem;cursor:default;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)"
                 onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 16px 48px -8px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,45,120,0.15)'"
                 onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                <div class="tilt-card-inner">
                    <div style="width:3.5rem;height:3.5rem;margin:0 auto 1rem;border-radius:0.875rem;background:linear-gradient(135deg,rgba(255,45,120,0.15),rgba(255,45,120,0.05));border:1px solid rgba(255,45,120,0.1);display:flex;align-items:center;justify-content:center;transition:all 0.3s" onmouseover="this.style.transform='scale(1.1)';this.style.background='linear-gradient(135deg,rgba(255,45,120,0.25),rgba(255,45,120,0.1))'" onmouseout="this.style.transform='scale(1)';this.style.background='linear-gradient(135deg,rgba(255,45,120,0.15),rgba(255,45,120,0.05))'">
                        <svg style="width:1.75rem;height:1.75rem;color:#ff2d78" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 style="color:#EAEAEA;font-weight:600;margin-bottom:0.5rem;transition:color 0.3s" onmouseover="this.style.color='#ff2d78'" onmouseout="this.style.color='#EAEAEA'">Dedicated Support</h3>
                    <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;line-height:1.625">Get priority support from our dedicated partnership team.</p>
                </div>
                <div class="tilt-card-glow"></div>
            </div>
            <div class="glass-card tilt-card group reveal text-center" style="padding:2rem 1.5rem;cursor:default;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)"
                 onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 16px 48px -8px rgba(0,0,0,0.4), 0 0 0 1px rgba(34,85,255,0.15)'"
                 onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                <div class="tilt-card-inner">
                    <div style="width:3.5rem;height:3.5rem;margin:0 auto 1rem;border-radius:0.875rem;background:linear-gradient(135deg,rgba(34,85,255,0.15),rgba(34,85,255,0.05));border:1px solid rgba(34,85,255,0.1);display:flex;align-items:center;justify-content:center;transition:all 0.3s" onmouseover="this.style.transform='scale(1.1)';this.style.background='linear-gradient(135deg,rgba(34,85,255,0.25),rgba(34,85,255,0.1))'" onmouseout="this.style.transform='scale(1)';this.style.background='linear-gradient(135deg,rgba(34,85,255,0.15),rgba(34,85,255,0.05))'">
                        <svg style="width:1.75rem;height:1.75rem;color:#2255ff" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h3 style="color:#EAEAEA;font-weight:600;margin-bottom:0.5rem;transition:color 0.3s" onmouseover="this.style.color='#2255ff'" onmouseout="this.style.color='#EAEAEA'">Marketing Materials</h3>
                    <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;line-height:1.625">Access to banners, landing pages, and promotional content.</p>
                </div>
                <div class="tilt-card-glow"></div>
            </div>
            <div class="glass-card tilt-card group reveal text-center" style="padding:2rem 1.5rem;cursor:default;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)"
                 onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 16px 48px -8px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,17,119,0.15)'"
                 onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                <div class="tilt-card-inner">
                    <div style="width:3.5rem;height:3.5rem;margin:0 auto 1rem;border-radius:0.875rem;background:linear-gradient(135deg,rgba(255,17,119,0.15),rgba(255,17,119,0.05));border:1px solid rgba(255,17,119,0.1);display:flex;align-items:center;justify-content:center;transition:all 0.3s" onmouseover="this.style.transform='scale(1.1)';this.style.background='linear-gradient(135deg,rgba(255,17,119,0.25),rgba(255,17,119,0.1))'" onmouseout="this.style.transform='scale(1)';this.style.background='linear-gradient(135deg,rgba(255,17,119,0.15),rgba(255,17,119,0.05))'">
                        <svg style="width:1.75rem;height:1.75rem;color:#ff1177" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 style="color:#EAEAEA;font-weight:600;margin-bottom:0.5rem;transition:color 0.3s" onmouseover="this.style.color='#ff1177'" onmouseout="this.style.color='#EAEAEA'">Real-time Tracking</h3>
                    <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;line-height:1.625">Dashboard with real-time sales and commission tracking.</p>
                </div>
                <div class="tilt-card-glow"></div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== HOW IT WORKS ==================== -->
<section style="padding-top:6rem;padding-bottom:6rem;background:#05050f;position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,0.03) 1px,transparent 1px);background-size:24px 24px;opacity:0.03;pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:64rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <div style="text-align:center;margin-bottom:3rem" class="reveal">
            <div class="badge"><span class="badge-dot"></span> Simple Process</div>
            <h2 style="font-family:'Bebas Neue','Oswald',sans-serif;font-size:clamp(2rem,5vw,3.5rem);font-weight:700;line-height:1.1;color:#EAEAEA;margin-bottom:0">How It <span class="gradient-text">Works</span></h2>
        </div>

        <div style="display:grid;grid-template-columns:1fr;gap:2rem;margin-bottom:3.5rem">
            <style>@media (min-width:768px){.part-steps{grid-template-columns:repeat(3,1fr)}}</style>
            <div class="glass-card tilt-card group reveal stagger-1" style="text-align:center;padding:2rem 1.5rem;cursor:default;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)"
                 onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 16px 48px -8px rgba(0,0,0,0.4), 0 0 0 1px rgba(34,85,255,0.15)'"
                 onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                <div class="tilt-card-inner">
                    <div style="width:4rem;height:4rem;margin:0 auto 1rem;border-radius:50%;background:linear-gradient(135deg,#005fe7,#2255ff);display:flex;align-items:center;justify-content:center;color:white;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;font-size:1.5rem;box-shadow:0 0 20px rgba(34,85,255,0.3);position:relative;transition:all 0.3s" onmouseover="this.style.transform='scale(1.1)';this.style.boxShadow='0 0 30px rgba(34,85,255,0.5)'" onmouseout="this.style.transform='scale(1)';this.style.boxShadow='0 0 20px rgba(34,85,255,0.3)'">
                        1
                    </div>
                    <h3 style="color:#EAEAEA;font-weight:600;margin-bottom:0.5rem;transition:color 0.3s" onmouseover="this.style.color='#005fe7'" onmouseout="this.style.color='#EAEAEA'">Apply</h3>
                    <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;line-height:1.625">Submit your application with your details and we'll review it promptly.</p>
                </div>
                <div class="tilt-card-glow"></div>
            </div>
            <div class="glass-card tilt-card group reveal stagger-2" style="text-align:center;padding:2rem 1.5rem;cursor:default;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)"
                 onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 16px 48px -8px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,45,120,0.15)'"
                 onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                <div class="tilt-card-inner">
                    <div style="width:4rem;height:4rem;margin:0 auto 1rem;border-radius:50%;background:linear-gradient(135deg,#ff2d78,#ff1177);display:flex;align-items:center;justify-content:center;color:white;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;font-size:1.5rem;box-shadow:0 0 20px rgba(255,45,120,0.3);position:relative;transition:all 0.3s" onmouseover="this.style.transform='scale(1.1)';this.style.boxShadow='0 0 30px rgba(255,45,120,0.5)'" onmouseout="this.style.transform='scale(1)';this.style.boxShadow='0 0 20px rgba(255,45,120,0.3)'">
                        2
                    </div>
                    <h3 style="color:#EAEAEA;font-weight:600;margin-bottom:0.5rem;transition:color 0.3s" onmouseover="this.style.color='#ff2d78'" onmouseout="this.style.color='#EAEAEA'">Get Approved</h3>
                    <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;line-height:1.625">Our team reviews and approves your application within 24-48 hours.</p>
                </div>
                <div class="tilt-card-glow"></div>
            </div>
            <div class="glass-card tilt-card group reveal stagger-3" style="text-align:center;padding:2rem 1.5rem;cursor:default;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)"
                 onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 16px 48px -8px rgba(0,0,0,0.4), 0 0 0 1px rgba(34,85,255,0.15)'"
                 onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                <div class="tilt-card-inner">
                    <div style="width:4rem;height:4rem;margin:0 auto 1rem;border-radius:50%;background:linear-gradient(135deg,#2255ff,#2255ff);display:flex;align-items:center;justify-content:center;color:white;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;font-size:1.5rem;box-shadow:0 0 20px rgba(34,85,255,0.3);position:relative;transition:all 0.3s" onmouseover="this.style.transform='scale(1.1)';this.style.boxShadow='0 0 30px rgba(34,85,255,0.5)'" onmouseout="this.style.transform='scale(1)';this.style.boxShadow='0 0 20px rgba(34,85,255,0.3)'">
                        3
                    </div>
                    <h3 style="color:#EAEAEA;font-weight:600;margin-bottom:0.5rem;transition:color 0.3s" onmouseover="this.style.color='#2255ff'" onmouseout="this.style.color='#EAEAEA'">Earn</h3>
                    <p style="color:rgba(234,234,234,0.5);font-size:0.875rem;line-height:1.625">Start earning commissions on every referral. Get paid monthly.</p>
                </div>
                <div class="tilt-card-glow"></div>
            </div>
        </div>

        <!-- Commission Table -->
        <div class="reveal">
            <h3 style="font-size:1.5rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;text-align:center;color:#EAEAEA;margin-bottom:1.5rem">Commission Structure</h3>
            <div class="glass-card" style="overflow:hidden;padding:0;border-radius:1rem">
                <div style="overflow-x:auto;-webkit-overflow-scrolling:touch">
                    <table style="width:100%;border-collapse:collapse">
                        <thead>
                            <tr style="border-bottom:1px solid rgba(0,95,231,0.08);background:#05050f">
                                <th style="text-align:left;color:rgba(234,234,234,0.4);font-weight:500;padding-top:1rem;padding-bottom:1rem;padding-left:1.25rem;padding-right:1.25rem;font-size:0.875rem;text-transform:uppercase;letter-spacing:0.05em">Tier</th>
                                <th style="text-align:left;color:rgba(234,234,234,0.4);font-weight:500;padding-top:1rem;padding-bottom:1rem;padding-left:1.25rem;padding-right:1.25rem;font-size:0.875rem;text-transform:uppercase;letter-spacing:0.05em">Sales Volume</th>
                                <th style="text-align:left;color:rgba(234,234,234,0.4);font-weight:500;padding-top:1rem;padding-bottom:1rem;padding-left:1.25rem;padding-right:1.25rem;font-size:0.875rem;text-transform:uppercase;letter-spacing:0.05em">Commission</th>
                                <th style="text-align:left;color:rgba(234,234,234,0.4);font-weight:500;padding-top:1rem;padding-bottom:1rem;padding-left:1.25rem;padding-right:1.25rem;font-size:0.875rem;text-transform:uppercase;letter-spacing:0.05em">Bonus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom:1px solid rgba(0,95,231,0.08);transition:background 0.2s" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                                <td style="padding-top:1rem;padding-bottom:1rem;padding-left:1.25rem;padding-right:1.25rem"><span style="color:#EAEAEA;font-weight:600;display:flex;align-items:center;gap:0.5rem"><span style="width:0.625rem;height:0.625rem;border-radius:50%;background:#f59e0b;display:inline-block"></span>Bronze</span></td>
                                <td style="padding-top:1rem;padding-bottom:1rem;padding-left:1.25rem;padding-right:1.25rem;color:rgba(234,234,234,0.7)">0-10 sales</td>
                                <td style="padding-top:1rem;padding-bottom:1rem;padding-left:1.25rem;padding-right:1.25rem;color:#005fe7;font-weight:600;font-size:1.125rem">20%</td>
                                <td style="padding-top:1rem;padding-bottom:1rem;padding-left:1.25rem;padding-right:1.25rem;color:rgba(234,234,234,0.4);font-size:0.875rem">—</td>
                            </tr>
                            <tr style="border-bottom:1px solid rgba(0,95,231,0.08);transition:background 0.2s" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                                <td style="padding-top:1rem;padding-bottom:1rem;padding-left:1.25rem;padding-right:1.25rem"><span style="color:#EAEAEA;font-weight:600;display:flex;align-items:center;gap:0.5rem"><span style="width:0.625rem;height:0.625rem;border-radius:50%;background:#d1d5db;display:inline-block"></span>Silver</span></td>
                                <td style="padding-top:1rem;padding-bottom:1rem;padding-left:1.25rem;padding-right:1.25rem;color:rgba(234,234,234,0.7)">11-50 sales</td>
                                <td style="padding-top:1rem;padding-bottom:1rem;padding-left:1.25rem;padding-right:1.25rem;color:#005fe7;font-weight:600;font-size:1.125rem">25%</td>
                                <td style="padding-top:1rem;padding-bottom:1rem;padding-left:1.25rem;padding-right:1.25rem;color:#2255ff;font-size:0.875rem;font-weight:500">$100 Welcome</td>
                            </tr>
                            <tr style="transition:background 0.2s" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                                <td style="padding-top:1rem;padding-bottom:1rem;padding-left:1.25rem;padding-right:1.25rem"><span style="color:#EAEAEA;font-weight:600;display:flex;align-items:center;gap:0.5rem"><span style="width:0.625rem;height:0.625rem;border-radius:50%;background:#FFD700;display:inline-block"></span>Gold</span></td>
                                <td style="padding-top:1rem;padding-bottom:1rem;padding-left:1.25rem;padding-right:1.25rem;color:rgba(234,234,234,0.7)">51+ sales</td>
                                <td style="padding-top:1rem;padding-bottom:1rem;padding-left:1.25rem;padding-right:1.25rem;color:#ff2d78;font-weight:600;font-size:1.125rem">30%</td>
                                <td style="padding-top:1rem;padding-bottom:1rem;padding-left:1.25rem;padding-right:1.25rem;color:#ff2d78;font-size:0.875rem;font-weight:500">$500 Bonus</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== APPLY FORM ==================== -->
<section id="apply" style="padding-top:6rem;padding-bottom:6rem;position:relative;overflow:hidden">
    <div class="orb orb-profit" style="position:absolute;bottom:0;left:0;transform:translate(33%,33%);opacity:0.03;width:500px;height:500px;border-radius:50%;background:rgba(34,85,255,0.15);filter:blur(100px);pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:48rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <div style="text-align:center;margin-bottom:2.5rem" class="reveal">
            <div class="badge"><span class="badge-dot"></span> Get Started</div>
            <h2 style="font-family:'Bebas Neue','Oswald',sans-serif;font-size:clamp(2rem,5vw,3.5rem);font-weight:700;line-height:1.1;color:#EAEAEA;margin-bottom:1rem">Apply <span class="gradient-text">Now</span></h2>
            <p style="font-size:clamp(0.95rem,1.2vw,1.1rem);color:rgba(234,234,234,0.5);max-width:36rem;margin:0 auto;line-height:1.6">Fill out the form and our partnership team will get back to you within 24 hours</p>
        </div>

        <div class="glass-card reveal" style="padding:1.5rem;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)"
             onmouseover="this.style.boxShadow='0 20px 60px -12px rgba(0,0,0,0.5), 0 0 0 1px rgba(34,85,255,0.12)'"
             onmouseout="this.style.boxShadow='none'">
            <style>@media (min-width:640px){.part-form-p{padding:2rem}}
            .part-input{width:100%;background:rgba(5,5,15,0.8);border:1px solid rgba(255,255,255,0.08);border-radius:0.75rem;padding:0.875rem 1rem;font-size:0.875rem;color:#EAEAEA;transition:all 0.3s;box-sizing:border-box}
            .part-input:focus{border-color:#005fe7;box-shadow:0 0 0 3px rgba(34,85,255,0.15);outline:none}
            .part-label{display:block;color:rgba(234,234,234,0.6);font-size:0.75rem;font-weight:500;margin-bottom:0.375rem;text-transform:uppercase;letter-spacing:0.05em}
            </style>
            <form id="partnerForm" style="display:flex;flex-direction:column;gap:1.25rem" onsubmit="return handlePartnerSubmit(event)">
                <div style="display:grid;grid-template-columns:1fr;gap:1.25rem">
                    <style>@media (min-width:640px){.part-form-grid{grid-template-columns:repeat(2,1fr)}}</style>
                    <div>
                        <label class="part-label">Full Name <span style="color:#005fe7">*</span></label>
                        <input type="text" name="name" required class="part-input" placeholder="Your full name">
                    </div>
                    <div>
                        <label class="part-label">Email Address <span style="color:#005fe7">*</span></label>
                        <input type="email" name="email" required class="part-input" placeholder="your@email.com">
                    </div>
                </div>
                <div>
                    <label class="part-label">Website / Social</label>
                    <input type="text" name="website" class="part-input" placeholder="https://yourwebsite.com or social handle">
                </div>
                <div>
                    <label class="part-label">Message</label>
                    <textarea name="message" rows="4" class="part-input" style="resize:none" placeholder="Tell us about yourself and your audience..."></textarea>
                </div>
                <button type="submit" style="width:100%;display:inline-flex;align-items:center;justify-content:center;gap:0.5rem;padding:0.875rem 2rem;background:linear-gradient(135deg,#005fe7,#2255ff);color:white;font-weight:600;font-size:1rem;border-radius:0.75rem;transition:all 0.3s;cursor:pointer;border:none" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 30px rgba(34,85,255,0.25)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                    <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Submit Application
                </button>
            </form>
        </div>
    </div>
</section>

<script>
function handlePartnerSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const btn = form.querySelector('button[type="submit"]');
    const originalHtml = btn.innerHTML;
    
    btn.disabled = true;
    btn.innerHTML = '<svg style="width:1rem;height:1rem;animation:spin 1s linear infinite" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Submitting...';

    const formData = new FormData(form);

    fetch('{{ route('forex.partner-submit') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
            'Accept': 'application/json',
        },
        body: formData,
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            form.reset();
        } else {
            showToast(data.message || 'Something went wrong.', 'error');
        }
    })
    .catch(() => {
        showToast('Network error. Please try again.', 'error');
    })
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = originalHtml;
    });

    return false;
}
</script>
@endsection
