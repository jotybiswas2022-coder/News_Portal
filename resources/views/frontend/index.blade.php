@extends('frontend.app')

@section('title', "ESHA'S ROKOMARIS 2 — Women's Fashion Boutique")
@section('meta_description', 'Discover thoughtfully selected women\'s fashion pieces designed to bring effortless style into your everyday wardrobe.')

@section('content')

@php
    use App\Models\Slider;

    $slider = Slider::latest()->first();

    /* -----------------------------------------------------------------------
       Placeholder imagery — only used when real product/slider images are not
       available yet. Replace the URLs (or upload real images) and the layout
       keeps working untouched.
       ----------------------------------------------------------------------- */
    $placeholders = [
        'hero' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1100&q=80',
    ];

    /* Collection cards are built straight from the products stored in the
       backend, so anything added in the admin panel shows up here. */
    $cards = collect($products ?? [])->map(fn ($product) => product_card($product));

    /* Hero imagery comes from the backend "Manage Sliders" page:
       slider1 is the wide/desktop shot, slider2 the portrait/mobile shot.
       Either one alone is enough — the placeholder only fills the gap until
       something is uploaded. */
    $heroDesktop = $slider && $slider->slider1 ? config('app.storage_url') . $slider->slider1 : null;
    $heroMobile  = $slider && $slider->slider2 ? config('app.storage_url') . $slider->slider2 : null;
    $heroDesktop = $heroDesktop ?: ($heroMobile ?: $placeholders['hero']);
@endphp

@if(session('success'))
    <div class="brand-container">
        <p class="notice" role="status">{{ session('success') }}</p>
    </div>
@endif

{{-- ============================================================ HERO --}}
<section class="hero" id="hero">
    <span class="hero__blob hero__blob--rose" aria-hidden="true"></span>
    <span class="hero__blob hero__blob--sage" aria-hidden="true"></span>
    <span class="hero__blob hero__blob--gold" aria-hidden="true"></span>

    <div class="brand-container">
        <div class="hero__inner">

            <div class="hero__content">
                <span class="eyebrow reveal">Esha's Rokomaris 2</span>

                <h1 class="hero__title reveal">Find Your <em>Perfect</em> Match</h1>

                <p class="hero__text reveal">
                    Discover thoughtfully selected fashion pieces designed to bring
                    effortless style into your everyday wardrobe.
                </p>

                <div class="hero__actions reveal">
                    <a class="btn" href="#products">Shop Collection</a>
                    <a class="btn btn--ghost" href="#about">Explore More</a>
                </div>
            </div>

            <div class="hero__media">
                <figure class="hero__frame">
                    <picture>
                        @if($heroMobile && $heroMobile !== $heroDesktop)
                            <source media="(max-width: 900px)" srcset="{{ $heroMobile }}">
                        @endif
                        <img src="{{ $heroDesktop }}"
                             alt="Editorial fashion photograph from the Esha's Rokomaris 2 collection"
                             width="1100" height="1375">
                    </picture>
                </figure>

                <div class="hero__tag">
                    <span class="hero__tag-label">New Season</span>
                    <span class="hero__tag-value">Soft pastel edit</span>
                </div>
            </div>

        </div>
    </div>

    <div class="hero__scroll" aria-hidden="true">
        <span>Scroll</span>
        <span class="hero__scroll-line"></span>
    </div>
</section>

{{-- =========================================================== ABOUT --}}
<section class="about-band" id="about">
    <div class="brand-container">
        <p class="eyebrow reveal">Our Promise</p>
        <p class="about-band__text reveal">
            A small studio curating soft, wearable pieces for real everyday moments —
            handpicked fabrics, honest pricing and a fit you can rely on.
        </p>
        <ul class="about-band__points reveal">
            <li>Handpicked pieces</li>
            <li>Nationwide delivery</li>
            <li>Personal styling help</li>
        </ul>
    </div>
</section>

{{-- ======================================================== PRODUCTS --}}
<section class="section section--ivory" id="products">
    <div class="brand-container">

        <div class="section-head products__head reveal">
            <span class="eyebrow">The Edit</span>
            <h2>Featured Collection</h2>
            <p>Pieces selected to make everyday style feel effortless.</p>
            <span class="deco-line" aria-hidden="true"></span>
        </div>

        @if($cards->isEmpty())
            <div class="collection-empty reveal">
                <p class="collection-empty__title">The new collection is on its way.</p>
                <p class="collection-empty__text">
                    Follow us on Instagram to be the first to see the next drop.
                </p>
                <a class="link-arrow" href="https://instagram.com/eshas_rokomaris2" target="_blank" rel="noopener">
                    Follow Along
                    <svg width="18" height="10" viewBox="0 0 18 10" fill="none" stroke="currentColor" stroke-width="1.4" aria-hidden="true">
                        <path d="M0 5h16M12 1l4 4-4 4"/>
                    </svg>
                </a>
            </div>
        @else
            <div class="product-grid">
                @foreach($cards as $card)
                    @include('frontend.partials.product-card', ['card' => $card])
                @endforeach
            </div>

            <div class="products__foot reveal">
                <a class="link-arrow" href="{{ url('/search') }}">
                    View All Products
                    <svg width="18" height="10" viewBox="0 0 18 10" fill="none" stroke="currentColor" stroke-width="1.4" aria-hidden="true">
                        <path d="M0 5h16M12 1l4 4-4 4"/>
                    </svg>
                </a>
            </div>
        @endif

    </div>
</section>

{{-- ========================================================= CONTACT --}}
<section class="section section--blush" id="contact">
    <div class="brand-container">
        <div class="contact__inner">

            <div class="contact__head">
                <span class="eyebrow reveal">Say Hello</span>
                <h2 class="reveal">Let's Connect</h2>
                <p class="reveal">
                    Have a question about our collection, sizing, or an order?
                    We'd love to hear from you.
                </p>

                <ul class="contact-list">
                    <li class="contact-item reveal">
                        <span class="contact-item__icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" aria-hidden="true">
                                <rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/>
                            </svg>
                        </span>
                        <span>
                            <span class="contact-item__label">Instagram</span>
                            <a class="contact-item__value" href="https://instagram.com/eshas_rokomaris2" target="_blank" rel="noopener">@eshas_rokomaris2</a>
                        </span>
                    </li>

                    <li class="contact-item reveal">
                        <span class="contact-item__icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" aria-hidden="true">
                                <path d="M14 8h3a1 1 0 0 1 1 1v2a6 6 0 0 1-6 6h-2a6 6 0 0 1-6-6V9a1 1 0 0 1 1-1h3"/>
                            </svg>
                        </span>
                        <span>
                            <span class="contact-item__label">Facebook</span>
                            <a class="contact-item__value" href="https://facebook.com/" target="_blank" rel="noopener">Eshas rokomaris 2</a>
                        </span>
                    </li>

                    <li class="contact-item reveal">
                        <span class="contact-item__icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" aria-hidden="true">
                                <path d="M6 3h3l2 5-2 1a12 12 0 0 0 6 6l1-2 5 2v3a2 2 0 0 1-2 2A16 16 0 0 1 4 5a2 2 0 0 1 2-2Z"/>
                            </svg>
                        </span>
                        <span>
                            <span class="contact-item__label">Phone</span>
                            <a class="contact-item__value" href="tel:+8801000000000">+880 1XXXXXXXXX</a>
                        </span>
                    </li>

                    <li class="contact-item reveal">
                        <span class="contact-item__icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" aria-hidden="true">
                                <rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>
                            </svg>
                        </span>
                        <span>
                            <span class="contact-item__label">Email</span>
                            <a class="contact-item__value" href="mailto:hello@example.com">hello@example.com</a>
                        </span>
                    </li>
                </ul>
            </div>

            <form class="contact-form reveal" action="{{ url('/contactus') }}" method="POST" data-contact-form>
                @csrf

                <div class="form-row">
                    <div class="form-field">
                        <label for="contact-name">Name <span class="req">*</span></label>
                        <input class="form-control" type="text" id="contact-name" name="name"
                               placeholder="Your full name" required>
                    </div>

                    <div class="form-field">
                        <label for="contact-email">Email <span class="req">*</span></label>
                        <input class="form-control" type="email" id="contact-email" name="email"
                               placeholder="you@example.com" required>
                    </div>
                </div>

                <div class="form-field">
                    <label for="contact-message">Message <span class="req">*</span></label>
                    <textarea class="form-control" id="contact-message" name="message"
                              placeholder="Tell us how we can help…" required></textarea>
                </div>

                <button class="btn" type="submit" data-submit-label="Send Message">Send Message</button>

                <p class="form-note">We usually reply within one working day.</p>
            </form>

        </div>
    </div>
</section>

@include('frontend.partials.footer')

@endsection
