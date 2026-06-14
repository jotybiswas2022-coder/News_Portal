<div id="toastContainer" style="position: fixed; top: 80px; right: 16px; z-index: 9999; display: flex; flex-direction: column; gap: 12px; pointer-events: none;"></div>

<script>
// Toast system — upgraded with premium animations
function showToast(message, type = 'success') {
    const container = document.getElementById('toastContainer');
    if (!container) return;

    const colors = {
        success: { bg: 'rgba(0,95,231,0.1)', border: 'rgba(34,85,255,0.25)', icon: '#005fe7', glow: 'rgba(34,85,255,0.2)', prog: 'linear-gradient(90deg, #005fe7, #2255ff)' },
        error: { bg: 'rgba(255,45,120,0.1)', border: 'rgba(255,17,119,0.25)', icon: '#ff2d78', glow: 'rgba(255,17,119,0.2)', prog: 'linear-gradient(90deg, #ff2d78, #ff00aa)' },
        info: { bg: 'rgba(0,95,231,0.1)', border: 'rgba(34,85,255,0.25)', icon: '#005fe7', glow: 'rgba(34,85,255,0.2)', prog: 'linear-gradient(90deg, #005fe7, #2255ff)' }
    };
    const c = colors[type] || colors.success;

    const toast = document.createElement('div');
    toast.style.cssText = `
        pointer-events: auto;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 20px;
        background: #090914;
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid ${c.border};
        border-left: 3px solid ${c.icon};
        border-radius: 12px;
        color: #ffffff;
        font-size: 14px;
        font-weight: 500;
        box-shadow: 0 8px 32px rgba(0,0,0,0.5), 0 0 20px ${c.glow};
        min-width: 280px;
        max-width: 400px;
        position: relative;
        overflow: hidden;
        transform: translateX(120%) scale(0.92);
        opacity: 0;
        transition: all 0s;
    `;

    const icons = {
        success: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="' + c.icon + '" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
        error: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="' + c.icon + '" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>',
        info: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="' + c.icon + '" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>'
    };

    var iconHtml = icons[type] || icons.success;
    toast.innerHTML = '<div style="flex-shrink:0;display:flex;align-items:center;position:relative;" class="toast-icon-wrap">' + iconHtml + '</div>' +
        '<span style="flex:1">' + message + '</span>' +
        '<div style="position:absolute;bottom:0;left:0;width:100%;height:3px;border-radius:0 0 12px 12px;overflow:hidden;background:rgba(255,255,255,0.05)">' +
          '<div class="toast-progress" style="height:100%;width:100%;background:' + c.prog + ';border-radius:0 0 12px 12px;transition:width 3.5s linear"></div>' +
        '</div>' +
        '<div class="toast-shimmer" style="position:absolute;top:0;left:-100%;width:60%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.06),transparent);transform:skewX(-20deg);pointer-events:none"></div>';

    container.appendChild(toast);

    // ---- ENTRY ANIMATION ----
    requestAnimationFrame(function() {
        toast.style.transition = 'all 0.55s cubic-bezier(0.34, 1.56, 0.64, 1)';
        toast.style.transform = 'translateX(0) scale(1)';
        toast.style.opacity = '1';

        // Shimmer sweep
        var shimmer = toast.querySelector('.toast-shimmer');
        if (shimmer) {
            shimmer.style.transition = 'left 0.8s ease 0.2s';
            shimmer.style.left = '180%';
        }

        // Pulse the icon
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

    // ---- PROGRESS BAR (start after entry settles) ----
    setTimeout(function() {
        var prog = toast.querySelector('.toast-progress');
        if (prog) prog.style.width = '0%';
    }, 100);

    // ---- HOVER PAUSE ----
    toast.addEventListener('mouseenter', function() {
        var prog = toast.querySelector('.toast-progress');
        if (prog) {
            prog.style.transition = 'none';
            prog.style.width = window.getComputedStyle(prog).width;
        }
        toast.style.transition = 'all 0.3s ease';
        toast.style.transform = 'translateX(0) scale(1.02)';
        toast.style.boxShadow = '0 12px 40px rgba(0,0,0,0.6), 0 0 30px ' + c.glow;
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
        toast.style.boxShadow = '0 8px 32px rgba(0,0,0,0.5), 0 0 20px ' + c.glow;
    });

    // ---- AUTO DISMISS ----
    setTimeout(function() {
        if (toast.parentNode) {
            toast.style.transition = 'all 0.4s cubic-bezier(0.55, 0, 1, 0.3)';
            toast.style.transform = 'translateX(120%) scale(0.85)';
            toast.style.opacity = '0';
            setTimeout(function() { if (toast.parentNode) toast.remove(); }, 420);
        }
    }, 3600);
}

// Make showToast globally available
window.showToast = showToast;
</script>
