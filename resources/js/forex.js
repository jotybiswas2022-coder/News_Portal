// ==================== CART SYSTEM ====================
window.getCart = function() {
    try { return JSON.parse(localStorage.getItem('forex_cart') || '[]'); }
    catch(e) { return []; }
};
window.saveCart = function(cart) {
    localStorage.setItem('forex_cart', JSON.stringify(cart));
};
window.clearCart = function() {
    localStorage.removeItem('forex_cart');
};
window.updateCartButtons = function() {
    const cart = window.getCart();
    document.querySelectorAll('[data-cart-id]').forEach(function(btn) {
        const itemId = btn.getAttribute('data-cart-id');
        const isInCart = cart.some(function(item) {
            return String(item.id) === String(itemId);
        });
        if (isInCart) {
            btn.disabled = true;
            btn.innerHTML = '<svg style="width:1rem;height:1rem;display:inline;margin-right:0.25rem;vertical-align:middle" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> Added To Cart';
            btn.style.opacity = '0.5';
            btn.style.cursor = 'not-allowed';
        }
    });
};

window.addToCart = function(item) {
    // Normalize price to number (json_encode may output string)
    item.price = parseFloat(item.price) || 0;
    const cart = window.getCart();
    const existing = cart.findIndex(i => i.id === item.id);
    if (existing >= 0) {
        cart[existing].qty = (cart[existing].qty || 1) + 1;
    } else {
        cart.push({ ...item, qty: 1 });
    }
    window.saveCart(cart);
    window.updateCartBadge();
    window.updateCartButtons();
    window.showToast(`${item.name} added to cart!`, 'success');
    // Redirect to cart page after a brief moment
    setTimeout(function() {
        window.location.href = window.routeCart || '/cart';
    }, 600);
};
window.removeFromCart = function(index) {
    const cart = window.getCart();
    cart.splice(index, 1);
    window.saveCart(cart);
    window.updateCartBadge();
    window.updateCartButtons();
    if (typeof renderCart === 'function') renderCart();
};
window.updateCartBadge = function() {
    const badge = document.getElementById('cartBadge');
    if (!badge) return;
    const cart = window.getCart();
    const count = cart.reduce((s, i) => s + (i.qty || 1), 0);
    if (count > 0) {
        badge.classList.remove('hidden');
        badge.textContent = count > 99 ? '99+' : count;
    } else {
        badge.classList.add('hidden');
    }
};

// ==================== TOAST SYSTEM (premium animations) ====================
window.showToast = function(message, type = 'info') {
    const container = document.getElementById('toastContainer');
    if (!container) return;
    var colorMap = { success: '#22c55e', error: '#ef4444', info: '#3b82f6', warning: '#f59e0b' };
    var progMap = { success: 'linear-gradient(90deg, #22c55e, #16a34a)', error: 'linear-gradient(90deg, #ef4444, #dc2626)', info: 'linear-gradient(90deg, #3b82f6, #2563eb)', warning: 'linear-gradient(90deg, #f59e0b, #d97706)' };
    var clr = colorMap[type] || colorMap.info;

    const toast = document.createElement('div');
    toast.style.cssText = `
        display: flex; align-items: center; gap: 12px;
        padding: 14px 20px;
        background: #1a1a1a;
        backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.08);
        border-left: 3px solid ${clr};
        border-radius: 12px;
        color: #ffffff; font-size: 14px; font-weight: 500;
        box-shadow: 0 8px 32px rgba(0,0,0,0.5), 0 0 20px rgba(59,130,246,0.15);
        min-width: 280px; max-width: 400px;
        position: relative; overflow: hidden;
        transform: translateX(120%) scale(0.92);
        opacity: 0;
        transition: all 0s;
    `;

    var iconSvg = '';
    if (type === 'success') {
        iconSvg = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>';
    } else if (type === 'error') {
        iconSvg = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>';
    } else {
        iconSvg = '<circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/>';
    }

    toast.innerHTML = '<div class="toast-icon-wrap" style="flex-shrink:0;display:flex;align-items:center;position:relative"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="' + clr + '" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">' + iconSvg + '</svg></div>' +
        '<span style="flex:1;color:#e5e5e5">' + message + '</span>' +
        '<div style="position:absolute;bottom:0;left:0;width:100%;height:3px;border-radius:0 0 12px 12px;overflow:hidden;background:rgba(255,255,255,0.05)">' +
          '<div class="toast-progress" style="height:100%;width:100%;background:' + (progMap[type] || progMap.info) + ';border-radius:0 0 12px 12px;transition:width 3.5s linear"></div>' +
        '</div>' +
        '<div class="toast-shimmer" style="position:absolute;top:0;left:-100%;width:60%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.06),transparent);transform:skewX(-20deg);pointer-events:none"></div>';

    container.appendChild(toast);

    // Entry animation
    requestAnimationFrame(function() {
        toast.style.transition = 'all 0.55s cubic-bezier(0.34, 1.56, 0.64, 1)';
        toast.style.transform = 'translateX(0) scale(1)';
        toast.style.opacity = '1';

        var shimmer = toast.querySelector('.toast-shimmer');
        if (shimmer) {
            shimmer.style.transition = 'left 0.8s ease 0.2s';
            shimmer.style.left = '180%';
        }

        var iconWrap = toast.querySelector('.toast-icon-wrap');
        if (iconWrap) {
            iconWrap.style.transition = 'transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) 0.2s';
            iconWrap.style.transform = 'scale(1.2)';
            setTimeout(function() {
                iconWrap.style.transition = 'transform 0.3s ease';
                iconWrap.style.transform = 'scale(1)';
            }, 600);
        }
    });

    // Progress bar
    setTimeout(function() {
        var prog = toast.querySelector('.toast-progress');
        if (prog) prog.style.width = '0%';
    }, 100);

    // Hover pause
    toast.addEventListener('mouseenter', function() {
        var prog = toast.querySelector('.toast-progress');
        if (prog) {
            prog.style.transition = 'none';
            prog.style.width = window.getComputedStyle(prog).width;
        }
        toast.style.transition = 'all 0.3s ease';
        toast.style.transform = 'translateX(0) scale(1.02)';
        toast.style.boxShadow = '0 12px 40px rgba(0,0,0,0.6), 0 0 30px rgba(59,130,246,0.25)';
    });

    toast.addEventListener('mouseleave', function() {
        var prog = toast.querySelector('.toast-progress');
        if (prog) {
            var curWidth = prog.style.width;
            var pct = parseFloat(curWidth) / toast.offsetWidth;
            if (!pct || pct < 0) pct = 1;
            if (pct > 1) pct = 1;
            prog.style.transition = 'width ' + (pct * 3500) + 'ms linear';
            prog.style.width = '0%';
        }
        toast.style.transform = 'translateX(0) scale(1)';
        toast.style.boxShadow = '0 8px 32px rgba(0,0,0,0.5), 0 0 20px rgba(59,130,246,0.15)';
    });

    // Auto dismiss
    setTimeout(function() {
        if (toast.parentNode) {
            toast.style.transition = 'all 0.4s cubic-bezier(0.55, 0, 1, 0.3)';
            toast.style.transform = 'translateX(120%) scale(0.85)';
            toast.style.opacity = '0';
            setTimeout(function() { if (toast.parentNode) toast.remove(); }, 420);
        }
    }, 3600);
};

// ==================== NAVBAR SCROLL ====================
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('mainNavbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.style.borderBottomColor = '#2a2a2a';
                navbar.style.backgroundColor = 'rgba(10, 10, 10, 0.95)';
            } else {
                navbar.style.borderBottomColor = 'transparent';
                navbar.style.backgroundColor = 'rgba(10, 10, 10, 0.8)';
            }
        });
    }

    // Mobile Drawer
    const menuBtn = document.getElementById('mobileMenuBtn');
    const drawer = document.getElementById('mobileDrawer');
    const overlay = document.getElementById('drawerOverlay');
    const hamburger = document.getElementById('hamburgerIcon');
    const closeIcon = document.getElementById('closeIcon');

    if (menuBtn && drawer) {
        function openDrawer() {
            drawer.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            if (hamburger) hamburger.classList.add('hidden');
            if (closeIcon) closeIcon.classList.remove('hidden');
        }
        function closeDrawer() {
            drawer.classList.add('hidden');
            document.body.style.overflow = '';
            if (hamburger) hamburger.classList.remove('hidden');
            if (closeIcon) closeIcon.classList.add('hidden');
        }
        menuBtn.addEventListener('click', openDrawer);
        if (overlay) overlay.addEventListener('click', closeDrawer);
        drawer.querySelectorAll('a').forEach(a => a.addEventListener('click', closeDrawer));
    }

    // Cookie Banner
    const cookieBanner = document.getElementById('cookieBanner');
    const cookieAccept = document.getElementById('cookieAccept');
    if (cookieBanner && !localStorage.getItem('cookie_consent')) {
        cookieBanner.classList.remove('hidden');
    }
    if (cookieAccept) {
        cookieAccept.addEventListener('click', () => {
            localStorage.setItem('cookie_consent', 'true');
            cookieBanner.classList.add('hidden');
        });
    }

    // Risk Disclaimer Toggle
    const riskToggle = document.getElementById('riskDisclaimerToggle');
    const riskContent = document.getElementById('riskDisclaimerContent');
    const riskChevron = document.getElementById('disclaimerChevron');
    if (riskToggle && riskContent) {
        riskToggle.addEventListener('click', () => {
            riskContent.classList.toggle('hidden');
            if (riskChevron) riskChevron.style.transform = riskContent.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
        });
    }

    // Initialize cart badge and button states
    window.updateCartBadge();
    window.updateCartButtons();
});
