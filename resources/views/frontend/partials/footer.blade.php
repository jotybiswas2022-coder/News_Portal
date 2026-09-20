@php
    $navPrefix = request()->is('/') ? '' : url('/');
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
            </div>

            <div>
                <h4 class="footer__title">Explore</h4>
                <ul class="footer__list">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ $navPrefix }}#products">Shop</a></li>
                    <li><a href="{{ $navPrefix }}#about">About</a></li>
                    <li><a href="{{ $navPrefix }}#contact">Contact</a></li>
                </ul>
            </div>

            <div>
                <h4 class="footer__title">Follow</h4>
                <ul class="footer__list">
                    <li>
                        <a href="https://instagram.com/eshas_rokomaris2" target="_blank" rel="noopener">Instagram</a>
                    </li>
                    <li>
                        <a href="https://facebook.com/" target="_blank" rel="noopener">Facebook</a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="footer__bottom">
            <p>&copy; {{ date('Y') }} Esha's Rokomaris 2. All rights reserved.</p>
            <p>Made with care <span class="dot">&middot;</span> Bangladesh</p>
        </div>
    </div>
</footer>
