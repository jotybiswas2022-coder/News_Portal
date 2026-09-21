@php
    $navPrefix = request()->is('/') ? '' : url('/');

    /* The homepage already loads the settings row; every other page lets the
       footer fetch it so contact details stay in one place. */
    $footerContact     = $contact ?? \App\Models\Setting::first();
    $footerInstagram   = $footerContact?->contact_instagram ?: 'eshas_rokomaris2';
    $footerInstagramUrl = 'https://instagram.com/' . ltrim($footerInstagram, '@');
    $footerFacebookUrl  = $footerContact?->contact_facebook ?: 'https://facebook.com/';
@endphp

<footer class="site-footer">
    <div class="brand-container">
        <div class="footer__grid">

            <div class="footer__brand-col">
                <a class="footer__brand" href="{{ url('/') }}">
                    <span class="brand__mark" aria-hidden="true">ER</span>
                    <span class="brand__name">Esha's Rokomaris 2</span>
                </a>
                <p class="footer__about">
                    Effortless fashion, thoughtfully selected for your everyday style.
                </p>

                <ul class="footer__socials" aria-label="Follow Esha's Rokomaris 2">
                    <li>
                        <a href="{{ $footerInstagramUrl }}" target="_blank" rel="noopener" aria-label="Instagram">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $footerFacebookUrl }}" target="_blank" rel="noopener" aria-label="Facebook">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path d="M14 8h3a1 1 0 0 1 1 1v2a6 6 0 0 1-6 6h-2a6 6 0 0 1-6-6V9a1 1 0 0 1 1-1h3"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="footer__title">Explore</h4>
                <ul class="footer__list">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ $navPrefix }}#products">Shop</a></li>
                    <li><a href="{{ $navPrefix }}#about">About</a></li>
                    <li><a href="{{ url('/search') }}">All Products</a></li>
                </ul>
            </div>

            <div>
                <h4 class="footer__title">Get in touch</h4>
                <ul class="footer__list footer__list--contact">
                    @if($footerContact?->contact_phone)
                        <li>
                            <a href="tel:{{ preg_replace('/\s+/', '', $footerContact->contact_phone) }}">
                                {{ $footerContact->contact_phone }}
                            </a>
                        </li>
                    @endif
                    @if($footerContact?->contact_email)
                        <li>
                            <a href="mailto:{{ $footerContact->contact_email }}">
                                {{ $footerContact->contact_email }}
                            </a>
                        </li>
                    @endif
                    <li><a href="{{ $footerInstagramUrl }}" target="_blank" rel="noopener">{{ '@' . ltrim($footerInstagram, '@') }}</a></li>
                    <li><a href="{{ $navPrefix }}#contact">Send us a message</a></li>
                </ul>
            </div>

        </div>

        <div class="footer__bottom">
            <p>&copy; {{ date('Y') }} Esha's Rokomaris 2. All rights reserved.</p>
            <p>Made with care <span class="dot">&middot;</span> Bangladesh</p>
        </div>
    </div>
</footer>
