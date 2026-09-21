@extends('frontend.app')

@section('title', "ESHA'S ROKOMARIS 2 — Women's Fashion Boutique")
@section('meta_description', 'Discover thoughtfully selected women\'s fashion pieces designed to bring effortless style into your everyday wardrobe.')

@section('content')

@php
    use App\Models\Slider;
    use App\Models\Setting;
    use Illuminate\Support\Str;

    $slider  = Slider::latest()->first();
    $contact = Setting::first();

    /* -----------------------------------------------------------------------
       Placeholder imagery — only used when real product/slider images are not
       available yet. Upload real images from the admin panel and every section
       keeps working untouched.
       ----------------------------------------------------------------------- */
    $heroFallback = 'https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1100&q=80';

    /* Collection cards are built straight from the products stored in the
       backend, so anything added in the admin panel shows up here. */
    $cardProducts = collect($products ?? []);
    $cards        = $cardProducts->map(fn ($product) => product_card($product));

    /* Hero imagery comes from the backend "Manage Sliders" page:
       slider1 is the wide/desktop shot, slider2 the portrait/mobile shot.
       Both images rotate in the hero section every 5 seconds.
       The placeholder only fills the gap until something is uploaded. */
    $slider1Url = $slider && $slider->slider1 ? config('app.storage_url') . $slider->slider1 : null;
    $slider2Url = $slider && $slider->slider2 ? config('app.storage_url') . $slider->slider2 : null;

    /* Which frame shape the hero should use, based on what has been uploaded.
       "both"     → the wide desktop shot and the portrait mobile shot each get
                    their own shape on the matching screen.
       "only one" → that single image is reused everywhere, so the frame takes
                    the shape it was uploaded in. */
    $frameDevice = !$slider1Url && !$slider2Url
        ? 'fallback'
        : (!$slider1Url ? 'mobile-only' : (!$slider2Url ? 'desktop-only' : 'both'));

    /* Imagery used by the "Our Promise" band and the category tiles: the newest
       real product shot when there is one, otherwise the editorial placeholder. */
    $promiseImage = $cardProducts->first()?->image
        ? config('app.storage_url') . $cardProducts->first()->image
        : $heroFallback;

    $instagramHandle = $contact?->contact_instagram ?: 'eshas_rokomaris2';
    $instagramUrl    = 'https://instagram.com/' . ltrim($instagramHandle, '@');
@endphp

{{-- ==================================================== ANNOUNCEMENT BAR --}}
<div class="announce" role="region" aria-label="Store highlights">
    <div class="brand-container">
        <div class="announce__inner">
            <p class="announce__item">Handpicked pieces</p>
            <p class="announce__item">Nationwide delivery</p>
            <p class="announce__item">Personal styling help</p>
        </div>
    </div>
</div>

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

                <ul class="hero__proof reveal">
                    <li>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m4 12 5 5L20 6"/></svg>
                        Handpicked pieces
                    </li>
                    <li>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m4 12 5 5L20 6"/></svg>
                        Nationwide delivery
                    </li>
                    <li>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m4 12 5 5L20 6"/></svg>
                        Styling help
                    </li>
                </ul>
            </div>

            <div class="hero__media">
                <figure class="hero__frame hero__frame--{{ $frameDevice }}">
                    <div class="hero__slides" id="heroSlides">
                        {{-- slider1 — desktop / tablet (wide) --}}
                        @if($slider1Url)
                            <div class="hero__slide hero__slide--desktop" data-device="desktop">
                                <img src="{{ $slider1Url }}"
                                     alt="Editorial fashion photograph from the Esha's Rokomaris 2 collection"
                                     width="1600" height="1000" loading="lazy" decoding="async">
                            </div>
                        @endif
                        {{-- slider2 — mobile (portrait) --}}
                        @if($slider2Url)
                            <div class="hero__slide hero__slide--mobile" data-device="mobile">
                                <img src="{{ $slider2Url }}"
                                     alt="Editorial fashion photograph from the Esha's Rokomaris 2 collection"
                                     width="1000" height="1333" loading="lazy" decoding="async">
                            </div>
                        @endif
                        @if(!$slider1Url && !$slider2Url)
                            <div class="hero__slide hero__slide--fallback">
                                <img src="{{ $heroFallback }}"
                                     alt="Editorial fashion photograph from the Esha's Rokomaris 2 collection"
                                     width="1100" height="1375" loading="lazy" decoding="async">
                            </div>
                        @endif
                    </div>
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

{{-- =========================================================== PROMISE --}}
<section class="promise" id="about">
    <div class="brand-container">
        <div class="promise__inner">

            <div class="promise__media reveal">
                <img src="{{ $promiseImage }}"
                     alt="A piece from the Esha's Rokomaris 2 collection"
                     loading="lazy" decoding="async">
            </div>

            <div class="promise__body">
                <span class="eyebrow reveal">Our Promise</span>

                <h2 class="promise__title reveal">
                    Soft, wearable pieces for real everyday moments
                </h2>

                <p class="promise__text reveal">
                    A small studio curating soft, wearable pieces for real everyday moments —
                    handpicked fabrics, honest pricing and a fit you can rely on.
                </p>

                <ul class="promise__list">
                    <li class="promise__item reveal">
                        <span class="promise__icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8Z"/></svg>
                        </span>
                        <div>
                            <h3>Handpicked pieces</h3>
                            <p>Every style is chosen in small batches, so the fabric, finish and fit are checked before it reaches you.</p>
                        </div>
                    </li>

                    <li class="promise__item reveal">
                        <span class="promise__icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7h11v10H3z"/><path d="M14 10h4l3 3v4h-7z"/><circle cx="7" cy="18" r="1.6"/><circle cx="17" cy="18" r="1.6"/></svg>
                        </span>
                        <div>
                            <h3>Nationwide delivery</h3>
                            <p>We deliver across Bangladesh, with everything packed with care and tracked from our studio to your door.</p>
                        </div>
                    </li>

                    <li class="promise__item reveal">
                        <span class="promise__icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-9-9"/><path d="M21 3v6h-6"/><path d="M12 7v5l3 2"/></svg>
                        </span>
                        <div>
                            <h3>Personal styling help</h3>
                            <p>Unsure about sizing or styling? Message us and we will happily help you find the right piece.</p>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</section>

{{-- ======================================================== CATEGORIES --}}
@if($categories->isNotEmpty())
<section class="cats" id="categories">
    <div class="brand-container">

        <div class="section-head cats__head reveal">
            <span class="eyebrow">Browse</span>
            <h2>Shop by Category</h2>
            <p>Find your next favourite piece by the mood you are dressing for.</p>
            <span class="deco-line" aria-hidden="true"></span>
        </div>

        <div class="cat-grid">
            @foreach($categories as $category)
                @php
                    /* The preview image set on the admin category page wins;
                       otherwise fall back to the category's newest product photo,
                       then to the shared editorial placeholder. */
                    $newestProduct = $category->products->first();
                    $categoryCover = $category->image
                        ? config('app.storage_url') . $category->image
                        : ($newestProduct?->image
                            ? config('app.storage_url') . $newestProduct->image
                            : $heroFallback);
                @endphp
                <a class="cat-card reveal" href="{{ url('/search?category=' . $category->id) }}">
                    <span class="cat-card__media">
                        <img src="{{ $categoryCover }}"
                             alt="{{ $category->name }}"
                             loading="lazy" decoding="async">
                    </span>
                    <span class="cat-card__overlay" aria-hidden="true"></span>
                    <span class="cat-card__body">
                        <span class="cat-card__name">{{ $category->name }}</span>
                        <span class="cat-card__count">
                            {{ $category->products_count }} {{ Str::plural('piece', $category->products_count) }}
                        </span>
                    </span>
                </a>
            @endforeach
        </div>

    </div>
</section>
@endif

{{-- ======================================================== PRODUCTS --}}
<section class="section section--white" id="products">
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
                <a class="link-arrow" href="{{ $instagramUrl }}" target="_blank" rel="noopener">
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
                <a class="btn btn--ghost" href="{{ url('/search') }}">
                    View All Products
                    <svg width="18" height="10" viewBox="0 0 18 10" fill="none" stroke="currentColor" stroke-width="1.4" aria-hidden="true">
                        <path d="M0 5h16M12 1l4 4-4 4"/>
                    </svg>
                </a>
            </div>
        @endif

    </div>
</section>

{{-- =========================================================== FOLLOW --}}
<section class="follow">
    <div class="brand-container">
        <div class="follow__inner">
            <span class="follow__icon reveal" aria-hidden="true">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="3" y="3" width="18" height="18" rx="5"/>
                    <circle cx="12" cy="12" r="4"/>
                    <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/>
                </svg>
            </span>

            <h2 class="follow__title reveal">Follow Along</h2>

            <p class="follow__text reveal">
                New drops, styling notes and behind-the-scenes moments — shared first on Instagram.
            </p>

            <div class="follow__actions reveal">
                <a class="btn follow__btn" href="{{ $instagramUrl }}" target="_blank" rel="noopener">
                    {{ '@' . ltrim($instagramHandle, '@') }}
                </a>
            </div>
        </div>
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
                    @if($contact?->contact_instagram)
                        <li class="contact-item reveal">
                            <span class="contact-item__icon" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" aria-hidden="true">
                                    <rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/>
                                </svg>
                            </span>
                            <span>
                                <span class="contact-item__label">Instagram</span>
                                <a class="contact-item__value" href="{{ $instagramUrl }}" target="_blank" rel="noopener">{{ $contact->contact_instagram }}</a>
                            </span>
                        </li>
                    @endif

                    @if($contact?->contact_facebook)
                        <li class="contact-item reveal">
                            <span class="contact-item__icon" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" aria-hidden="true">
                                    <path d="M14 8h3a1 1 0 0 1 1 1v2a6 6 0 0 1-6 6h-2a6 6 0 0 1-6-6V9a1 1 0 0 1 1-1h3"/>
                                </svg>
                            </span>
                            <span>
                                <span class="contact-item__label">Facebook</span>
                                <a class="contact-item__value" href="{{ $contact->contact_facebook }}" target="_blank" rel="noopener">Eshas rokomaris 2</a>
                            </span>
                        </li>
                    @endif

                    @if($contact?->contact_phone)
                        <li class="contact-item reveal">
                            <span class="contact-item__icon" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" aria-hidden="true">
                                    <path d="M6 3h3l2 5-2 1a12 12 0 0 0 6 6l1-2 5 2v3a2 2 0 0 1-2 2A16 16 0 0 1 4 5a2 2 0 0 1 2-2Z"/>
                                </svg>
                            </span>
                            <span>
                                <span class="contact-item__label">Phone</span>
                                <a class="contact-item__value" href="tel:{{ preg_replace('/\s+/', '', $contact->contact_phone) }}">{{ $contact->contact_phone }}</a>
                            </span>
                        </li>
                    @endif

                    @if($contact?->contact_email)
                        <li class="contact-item reveal">
                            <span class="contact-item__icon" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" aria-hidden="true">
                                    <rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>
                                </svg>
                            </span>
                            <span>
                                <span class="contact-item__label">Email</span>
                                <a class="contact-item__value" href="mailto:{{ $contact->contact_email }}">{{ $contact->contact_email }}</a>
                            </span>
                        </li>
                    @endif
                </ul>
            </div>

            <form class="contact-form reveal" action="{{ url('/contactus') }}" method="POST" data-contact-form>
                @csrf

                <h3 class="contact-form__title">Send us a Message</h3>
                <p class="contact-form__sub">Fill in the form and we'll get back to you shortly.</p>

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

@section('scripts')
<script>
    /*
     * Hero slider rotation.
     *
     * The admin "Manage Sliders" page stores two images — slider1 for
     * desktop/tablet and slider2 for mobile. Both are printed in the markup and
     * CSS hides the one that does not belong to the current screen, so here we
     * only rotate through the slides that are actually being shown. Rotation is
     * restarted whenever the visitor crosses the mobile breakpoint, and disabled
     * entirely for visitors who prefer reduced motion.
     */
    (function () {
        var frame = document.getElementById('heroSlides');
        if (!frame) return;

        var mobileQuery = window.matchMedia('(max-width: 767px)');
        var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        var allSlides = Array.prototype.slice.call(frame.querySelectorAll('.hero__slide'));
        if (!allSlides.length) return;

        var timer = null;
        var index = 0;

        function slidesForDevice() {
            var device = mobileQuery.matches ? 'mobile' : 'desktop';
            var matching = allSlides.filter(function (slide) {
                var forDevice = slide.getAttribute('data-device');
                return !forDevice || forDevice === device;
            });

            /* Prefer the image made for this device; if it was never uploaded,
               fall back to whichever one the admin did provide. */
            var specific = matching.filter(function (slide) {
                return slide.getAttribute('data-device');
            });

            return specific.length ? specific : matching;
        }

        function start() {
            window.clearInterval(timer);
            index = 0;

            allSlides.forEach(function (slide) { slide.classList.remove('active'); });

            var slides = slidesForDevice();
            if (!slides.length) return;

            slides[0].classList.add('active');

            if (slides.length > 1 && !reduceMotion) {
                timer = window.setInterval(function () {
                    slides[index].classList.remove('active');
                    index = (index + 1) % slides.length;
                    slides[index].classList.add('active');
                }, 5000);
            }
        }

        start();

        if (mobileQuery.addEventListener) mobileQuery.addEventListener('change', start);
        else if (mobileQuery.addListener) mobileQuery.addListener(start);
    })();
</script>
@endsection
