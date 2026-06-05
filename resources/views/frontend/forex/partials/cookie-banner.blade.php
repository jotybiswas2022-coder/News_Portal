<div id="cookieBanner" style="position: fixed; bottom: 0; left: 0; right: 0; z-index: 50; padding: 16px; display: none;">
    <div style="max-width: 1280px; margin: 0 auto; background: rgba(20, 20, 25, 0.92); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(42, 42, 42, 0.8); border-radius: 16px; padding: 16px 20px; display: flex; flex-direction: column; align-items: center; gap: 12px; box-shadow: 0 20px 60px rgba(0,0,0,0.4);">
        <div style="display: flex; align-items: flex-start; gap: 12px; width: 100%;">
            <svg style="width: 20px; height: 20px; color: #00AEEF; flex-shrink: 0; margin-top: 2px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            <p style="color: rgba(234, 234, 234, 0.6); font-size: 14px; line-height: 1.5; margin: 0;">We use cookies to enhance your experience. By continuing, you agree to our use of cookies.</p>
        </div>
        <div style="display: flex; justify-content: flex-end; width: 100%;">
            <button id="cookieAccept" style="flex-shrink: 0; background: linear-gradient(135deg, #00AEEF, #0095CC); color: #fff; border: none; padding: 10px 24px; border-radius: 12px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0,174,239,0.2);"
            onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 6px 25px rgba(0,174,239,0.35)'"
            onmouseout="this.style.transform='';this.style.boxShadow='0 4px 15px rgba(0,174,239,0.2)'">
                Accept All
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const banner = document.getElementById('cookieBanner');
    const acceptBtn = document.getElementById('cookieAccept');
    if (banner && !localStorage.getItem('cookies_accepted')) {
        banner.style.display = 'block';
    }
    if (acceptBtn) {
        acceptBtn.addEventListener('click', function() {
            localStorage.setItem('cookies_accepted', 'true');
            banner.style.display = 'none';
        });
    }
});
</script>
