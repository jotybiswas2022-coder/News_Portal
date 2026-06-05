@extends('frontend.forex.layouts.app')

@section('title', 'Privacy Policy — SMART BINARY ZONE')

@section('content')
<section style="padding-top:6rem;padding-bottom:3rem">
    <div style="max-width:56rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <style>
            @media (min-width:640px){.legal-privacy-px{padding-left:1.5rem;padding-right:1.5rem}}
            @media (min-width:1024px){.legal-privacy-px{padding-left:2rem;padding-right:2rem}}
        </style>
        <h1 style="font-size:1.875rem;font-weight:700;color:#EAEAEA;margin-bottom:0.5rem;font-family:'Bebas Neue','Oswald',sans-serif;animation:fadeInUp 0.6s ease">
            Privacy Policy
        </h1>
        <p style="color:#6b7280;font-size:0.875rem;margin-bottom:2rem;animation:fadeInUp 0.6s ease 0.1s both">Last Updated: January 1, 2026</p>

        <div style="display:flex;flex-direction:column;gap:2rem;color:#9ca3af;font-size:0.875rem;line-height:1.7">
            <section class="reveal">
                <h2 style="font-size:1.25rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.75rem">Information We Collect</h2>
                <p>We collect information you provide directly to us, such as your name, email address, and payment information when you make a purchase or create an account. We also automatically collect certain information about your device and browsing behavior.</p>
            </section>
            <section class="reveal stagger-1">
                <h2 style="font-size:1.25rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.75rem">How We Use Your Information</h2>
                <p>We use the information we collect to process your orders, provide customer support, improve our products and services, and send you updates about your purchases. We do not sell your personal information to third parties.</p>
            </section>
            <section class="reveal stagger-2">
                <h2 style="font-size:1.25rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.75rem">Data Security</h2>
                <p>We implement appropriate security measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction. All payment transactions are processed through secure, PCI-compliant payment gateways.</p>
            </section>
            <section class="reveal stagger-3">
                <h2 style="font-size:1.25rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.75rem">Cookies</h2>
                <p>We use cookies and similar tracking technologies to enhance your browsing experience, analyze site traffic, and understand where our visitors come from. You can control cookie settings through your browser preferences.</p>
            </section>
            <section class="reveal stagger-4">
                <h2 style="font-size:1.25rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.75rem">Your Rights</h2>
                <p>You have the right to access, update, or delete your personal information at any time. You may also opt out of receiving marketing communications from us. Contact us to exercise any of these rights.</p>
            </section>
            <section class="reveal stagger-5">
                <h2 style="font-size:1.25rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.75rem">Contact Us</h2>
                <p>If you have any questions about this Privacy Policy, please contact us through our <a href="{{ route('forex.contact-us') }}" style="color:#00AEEF;text-decoration:none;position:relative" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Contact page</a>.</p>
            </section>
        </div>
    </div>
</section>
@endsection
