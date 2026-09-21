/* ==========================================================================
   ESHA'S ROKOMARIS 2 — homepage interactions
   Kept intentionally small: sticky header, mobile drawer, search panel,
   smooth in-page scrolling and subtle scroll reveals.
   ========================================================================== */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        initStickyHeader();
        initMobileMenu();
        initSearchPanel();
        initSmoothScroll();
        initReveal();
        initContactForm();
        initMobileBuyBar();
    });

    /* Navbar gains a shadow once the page has scrolled. */
    function initStickyHeader() {
        var header = document.querySelector('[data-header]');
        if (!header) return;

        var toggle = function () {
            header.classList.toggle('is-scrolled', window.scrollY > 8);
        };

        toggle();
        window.addEventListener('scroll', toggle, { passive: true });
    }

    /* Mobile hamburger drawer. */
    function initMobileMenu() {
        var toggle = document.querySelector('[data-nav-toggle]');
        var drawer = document.querySelector('[data-nav-drawer]');
        if (!toggle || !drawer) return;

        toggle.addEventListener('click', function () {
            var open = drawer.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        });

        drawer.addEventListener('click', function (event) {
            if (event.target.closest('a')) {
                drawer.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    /* Collapsible search panel in the header. */
    function initSearchPanel() {
        var toggle = document.querySelector('[data-search-toggle]');
        var panel = document.querySelector('[data-search-panel]');
        if (!toggle || !panel) return;

        toggle.addEventListener('click', function () {
            var open = panel.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            if (open) {
                var input = panel.querySelector('input');
                if (input) input.focus();
            }
        });
    }

    /* Smooth anchor scrolling that respects the sticky header height. */
    function initSmoothScroll() {
        var header = document.querySelector('[data-header]');

        document.querySelectorAll('a[href^="#"]').forEach(function (link) {
            link.addEventListener('click', function (event) {
                var id = link.getAttribute('href');
                if (!id || id === '#') return;

                var target = document.querySelector(id);
                if (!target) return;

                event.preventDefault();
                var offset = (header ? header.offsetHeight : 0) + 12;
                var top = target.getBoundingClientRect().top + window.pageYOffset - offset;

                window.scrollTo({
                    top: top,
                    behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth'
                });
            });
        });
    }

    /*
     * Product pages on phones: surface a sticky Add to Bag bar once the visitor
     * has scrolled past the main action, and step aside near the footer so it
     * never covers the end of the page.
     */
    function initMobileBuyBar() {
        var bar = document.querySelector('[data-buy-bar]');
        var anchor = document.querySelector('[data-buy-anchor]');
        if (!bar || !anchor) return;

        var narrowQuery = window.matchMedia('(max-width: 767px)');

        var update = function () {
            if (!narrowQuery.matches) {
                bar.classList.remove('is-visible');
                return;
            }

            var scrolledPast = anchor.getBoundingClientRect().bottom < 0;
            var nearBottom = window.innerHeight + window.scrollY >= document.documentElement.scrollHeight - 90;

            bar.classList.toggle('is-visible', scrolledPast && !nearBottom);
        };

        update();
        window.addEventListener('scroll', update, { passive: true });
        window.addEventListener('resize', update);
    }

    /* Give light feedback while the contact form is submitting. */
    function initContactForm() {
        var form = document.querySelector('[data-contact-form]');
        if (!form) return;

        form.addEventListener('submit', function () {
            var button = form.querySelector('button[type="submit"]');
            if (!button) return;

            button.disabled = true;
            button.textContent = 'Sending…';
        });
    }

    /* Reveal elements as they enter the viewport. */
    function initReveal() {
        var items = document.querySelectorAll('.reveal');
        if (!items.length) return;

        if (!('IntersectionObserver' in window)) {
            items.forEach(function (item) { item.classList.add('is-visible'); });
            return;
        }

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        items.forEach(function (item) { observer.observe(item); });
    }
})();
