@extends('frontend.forex.layouts.app')

@section('title', 'Cookie Policy — SMART BINARY ZONE')

@section('content')
<section style="padding-top:6rem;padding-bottom:3rem">
    <div style="max-width:56rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <style>
            @media (min-width:640px){.legal-cookies-px{padding-left:1.5rem;padding-right:1.5rem}}
            @media (min-width:1024px){.legal-cookies-px{padding-left:2rem;padding-right:2rem}}
            @media (min-width:640px){.legal-cookies-text-sm{font-size:0.875rem}}
        </style>
        <h1 style="font-size:1.875rem;font-weight:700;color:#EAEAEA;margin-bottom:0.5rem;font-family:'Bebas Neue','Oswald',sans-serif;animation:fadeInUp 0.6s ease">
            Cookie Policy
        </h1>
        <p style="color:#6b7280;font-size:0.875rem;margin-bottom:2rem;animation:fadeInUp 0.6s ease 0.1s both">Last Updated: January 1, 2026</p>

        <div style="display:flex;flex-direction:column;gap:2rem;color:#9ca3af;font-size:0.875rem;line-height:1.7">
            <section class="reveal">
                <h2 style="font-size:1.25rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.75rem">What Are Cookies</h2>
                <p>Cookies are small text files that are stored on your device when you visit a website. They help websites remember your preferences and improve your browsing experience. Cookies are widely used by online services to function efficiently.</p>
            </section>
            <section class="reveal stagger-1">
                <h2 style="font-size:1.25rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.75rem">How We Use Cookies</h2>
                <p>We use cookies for the following purposes:</p>
                <ul style="list-style-type:disc;padding-left:1.25rem;margin-top:0.5rem;display:flex;flex-direction:column;gap:0.25rem">
                    <li><strong style="color:#EAEAEA">Essential Cookies:</strong> Required for the website to function properly, including maintaining your cart and account login.</li>
                    <li><strong style="color:#EAEAEA">Analytics Cookies:</strong> Help us understand how visitors interact with our website, allowing us to improve our services.</li>
                    <li><strong style="color:#EAEAEA">Preference Cookies:</strong> Remember your settings and preferences for future visits.</li>
                </ul>
            </section>
            <section class="reveal stagger-2">
                <h2 style="font-size:1.25rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.75rem">Types of Cookies We Use</h2>
                <div style="overflow-x:auto;-webkit-overflow-scrolling:touch">
                    <table style="width:100%;font-size:0.875rem;border-collapse:collapse">
                        <thead>
                            <tr style="border-bottom:1px solid #2a2a2a">
                                <th style="text-align:left;color:#d1d5db;font-weight:500;padding-top:0.5rem;padding-bottom:0.5rem;padding-right:1rem">Cookie</th>
                                <th style="text-align:left;color:#d1d5db;font-weight:500;padding-top:0.5rem;padding-bottom:0.5rem;padding-right:1rem">Type</th>
                                <th style="text-align:left;color:#d1d5db;font-weight:500;padding-top:0.5rem;padding-bottom:0.5rem">Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom:1px solid #2a2a2a;transition:background 0.2s" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                                <td style="padding-top:0.5rem;padding-bottom:0.5rem;padding-right:1rem">cart_items</td>
                                <td style="padding-top:0.5rem;padding-bottom:0.5rem;padding-right:1rem">Essential</td>
                                <td style="padding-top:0.5rem;padding-bottom:0.5rem">Session / 30 days</td>
                            </tr>
                            <tr style="border-bottom:1px solid #2a2a2a;transition:background 0.2s" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                                <td style="padding-top:0.5rem;padding-bottom:0.5rem;padding-right:1rem">cookie_consent</td>
                                <td style="padding-top:0.5rem;padding-bottom:0.5rem;padding-right:1rem">Essential</td>
                                <td style="padding-top:0.5rem;padding-bottom:0.5rem">365 days</td>
                            </tr>
                            <tr style="transition:background 0.2s" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                                <td style="padding-top:0.5rem;padding-bottom:0.5rem;padding-right:1rem">_ga, _gid</td>
                                <td style="padding-top:0.5rem;padding-bottom:0.5rem;padding-right:1rem">Analytics</td>
                                <td style="padding-top:0.5rem;padding-bottom:0.5rem">Session / 24 months</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="reveal stagger-3">
                <h2 style="font-size:1.25rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.75rem">Managing Cookies</h2>
                <p>You can control and manage cookies through your browser settings. Most browsers allow you to block or delete cookies. However, please note that blocking essential cookies may affect the functionality of our website.</p>
                <p style="margin-top:0.5rem">To learn more about managing cookies, visit <a href="#" style="color:#00AEEF;text-decoration:none;position:relative" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">aboutcookies.org</a>.</p>
            </section>
            <section class="reveal stagger-4">
                <h2 style="font-size:1.25rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.75rem">Changes to This Policy</h2>
                <p>We may update this Cookie Policy from time to time. We will notify you of any changes by posting the new policy on this page. We encourage you to review this policy periodically.</p>
            </section>
            <section class="reveal stagger-5">
                <h2 style="font-size:1.25rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.75rem">Contact</h2>
                <p>If you have any questions about our use of cookies, please <a href="{{ route('forex.contact-us') }}" style="color:#00AEEF;text-decoration:none;position:relative" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">contact us</a>.</p>
            </section>
        </div>
    </div>
</section>
@endsection
