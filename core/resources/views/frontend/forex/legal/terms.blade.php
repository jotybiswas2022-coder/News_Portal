@extends('frontend.forex.layouts.app')

@section('title', 'Terms of Services — SMART BINARY ZONE')

@section('content')
<section style="padding-top:6rem;padding-bottom:3rem">
    <div style="max-width:64rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <style>
            @media (min-width:640px){.legal-terms-px{padding-left:1.5rem;padding-right:1.5rem}}
            @media (min-width:1024px){.legal-terms-px{padding-left:2rem;padding-right:2rem}}
            .toc-link{color:#9ca3af;text-decoration:none;transition:color 0.2s;display:block;padding-top:0.1875rem;padding-bottom:0.1875rem;font-size:0.875rem}
            .toc-link:hover{color:#00AEEF}
        </style>
        <h1 style="font-size:1.875rem;font-weight:700;color:#EAEAEA;margin-bottom:0.5rem;font-family:'Bebas Neue','Oswald',sans-serif;animation:fadeInUp 0.6s ease">
            Terms of Services
        </h1>
        <p style="color:#6b7280;font-size:0.875rem;margin-bottom:2rem;animation:fadeInUp 0.6s ease 0.1s both">Last Updated: January 1, 2026</p>

        <div style="display:grid;grid-template-columns:1fr;gap:2rem">
            @media (min-width:1024px){.legal-terms-grid{grid-template-columns:1fr 3fr}}

            <!-- TOC -->
            <div class="legal-terms-toc" style="display:none">
                <div style="position:sticky;top:6rem;background:rgba(13,13,13,0.7);backdrop-filter:blur(12px);border:1px solid #2a2a2a;border-radius:0.75rem;padding:1rem">
                    <h4 style="color:#EAEAEA;font-weight:600;font-size:0.875rem;margin-bottom:0.75rem;text-transform:uppercase;letter-spacing:0.05em">Contents</h4>
                    <nav id="legalToc" style="display:flex;flex-direction:column;gap:0.375rem">
                        <a href="#section-1" class="toc-link">1. Introduction</a>
                        <a href="#section-2" class="toc-link">2. Use of Services</a>
                        <a href="#section-3" class="toc-link">3. Payment Terms</a>
                        <a href="#section-4" class="toc-link">4. Intellectual Property</a>
                        <a href="#section-5" class="toc-link">5. Limitation of Liability</a>
                        <a href="#section-6" class="toc-link">6. Governing Law</a>
                    </nav>
                </div>
            </div>
            <style>
                @media (min-width:1024px){.legal-terms-toc{display:block !important}}
            </style>

            <div style="display:flex;flex-direction:column;gap:2.5rem;color:#9ca3af;font-size:0.875rem;line-height:1.7">
                <section id="section-1" class="reveal">
                    <h2 style="font-size:1.25rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.75rem">1. Introduction</h2>
                    <p>These Terms of Services govern your use of the SMART BINARY ZONE website and the purchase and use of our Expert Advisors. By accessing our website and purchasing our products, you agree to be bound by these terms.</p>
                    <p style="margin-top:0.5rem">Please read these terms carefully before using our services. If you do not agree with any part of these terms, you should not use our website or purchase our products.</p>
                </section>
                <section id="section-2" class="reveal stagger-1">
                    <h2 style="font-size:1.25rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.75rem">2. Use of Services</h2>
                    <p>You agree to use our services only for lawful purposes and in accordance with these Terms. You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account.</p>
                    <p style="margin-top:0.5rem">You may not use our products for any illegal or unauthorized purpose. You must not, in the use of our services, violate any laws in your jurisdiction.</p>
                </section>
                <section id="section-3" class="reveal stagger-2">
                    <h2 style="font-size:1.25rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.75rem">3. Payment Terms</h2>
                    <p>All prices are listed in US Dollars and are one-time payments unless otherwise stated. Payments are processed securely through our payment partners. Upon successful payment, you will receive access to your purchased products.</p>
                    <p style="margin-top:0.5rem">All sales are final. We do not offer refunds on digital products due to the nature of the goods. If you experience technical issues, our support team will assist you in resolving them.</p>
                </section>
                <section id="section-4" class="reveal stagger-3">
                    <h2 style="font-size:1.25rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.75rem">4. Intellectual Property</h2>
                    <p>All Expert Advisors, source codes, and related materials provided by SMART BINARY ZONE are protected by copyright and intellectual property laws. You are granted a license to use the products for personal trading purposes only.</p>
                    <p style="margin-top:0.5rem">You may not distribute, resell, or share your licensed products with third parties without explicit written permission from SMART BINARY ZONE.</p>
                </section>
                <section id="section-5" class="reveal stagger-4">
                    <h2 style="font-size:1.25rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.75rem">5. Limitation of Liability</h2>
                    <p>SMART BINARY ZONE provides trading tools and software as-is. We do not guarantee profitability or specific trading results. Trading Forex and other financial instruments carries significant risk.</p>
                    <p style="margin-top:0.5rem">We shall not be liable for any direct, indirect, incidental, special, or consequential damages resulting from the use or inability to use our products.</p>
                </section>
                <section id="section-6" class="reveal stagger-5">
                    <h2 style="font-size:1.25rem;font-family:'Bebas Neue','Oswald',sans-serif;font-weight:700;color:#EAEAEA;margin-bottom:0.75rem">6. Governing Law</h2>
                    <p>These Terms shall be governed by and construed in accordance with the laws of the jurisdiction in which SMART BINARY ZONE operates, without regard to its conflict of law provisions.</p>
                    <p style="margin-top:0.5rem">Any disputes arising from these terms shall be resolved through arbitration in accordance with the rules of the relevant arbitration association.</p>
                </section>
            </div>
        </div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tocLinks = document.querySelectorAll('#legalToc a');
    const sections = document.querySelectorAll('section[id^="section-"]');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                tocLinks.forEach(l => l.style.color = '');
                const link = document.querySelector('#legalToc a[href="#' + entry.target.id + '"]');
                if (link) link.style.color = '#00AEEF';
            }
        });
    }, { threshold: 0.3 });
    sections.forEach(s => observer.observe(s));
});
</script>
@endsection
