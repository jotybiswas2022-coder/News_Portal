@extends('frontend.forex.layouts.app')

@section('title', 'SMART BINARY ZONE — Premium Expert Advisors')

@section('content')
<style>
/* ===== NEW HOME PAGE — MODERN CYAN/PURPLE LAYOUT ===== */
/* Uses existing brand colors adapted to this design */

*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}

:root{
  --cyan:#005fe7;
  --purple:#ff2d78;
  --green:#22c55e;
  --red:#ef4444;
  --blue:#2255ff;
  --muted:#8892b0;
  --border:rgba(255,255,255,0.07);
  --border-glow:rgba(0,95,231,0.25);
}

/* ===================== TOP BAR ===================== */
.topbar{background:#060a18;border-bottom:1px solid var(--border);padding:8px 40px;display:flex;justify-content:space-between;align-items:center;font-size:12px;color:var(--muted)}
.topbar-left{display:flex;align-items:center;gap:6px;color:#22c55e}
.topbar-left svg{color:#22c55e}
.topbar-right{display:flex;align-items:center;gap:24px}
.topbar-right a{color:var(--muted);text-decoration:none;display:flex;align-items:center;gap:5px;font-size:12px;transition:color .2s}
.topbar-right a:hover{color:var(--cyan)}
.btn-register{background:var(--cyan);color:#fff;border:none;padding:6px 18px;border-radius:5px;font-size:12px;font-weight:700;cursor:pointer;transition:opacity .2s;text-decoration:none}
.btn-register:hover{opacity:.85}
.cart-icon{display:flex;align-items:center;gap:4px;color:var(--muted);text-decoration:none;font-size:12px;transition:color .2s}
.cart-icon:hover{color:var(--cyan)}

/* ===================== HERO ===================== */
.hero{
  min-height:80vh;
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:48px;
  padding:60px 40px 60px;
  position:relative;
  overflow:hidden;
  background: radial-gradient(ellipse 80% 60% at 15% 50%, rgba(0,95,231,0.12) 0%, transparent 60%),
              radial-gradient(ellipse 60% 80% at 85% 30%, rgba(255,45,120,0.10) 0%, transparent 60%),
              var(--bg-primary);
}
.hero::before{
  content:'';position:absolute;inset:0;
  background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='60'%3E%3Ccircle cx='1' cy='1' r='1' fill='rgba(255,255,255,0.03)'/%3E%3C/svg%3E");
  pointer-events:none;
}

.hero-left{display:flex;flex-direction:column;justify-content:center;gap:24px;z-index:2;position:relative}

.hero-badge{
  display:inline-flex;align-items:center;gap:8px;
  border:1px solid rgba(0,95,231,0.3);
  background:rgba(0,95,231,0.05);
  color:var(--cyan);
  font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;
  padding:7px 16px;border-radius:50px;width:fit-content;
  animation:fadeUp 0.6s ease 0.1s both, badge-float 3s ease-in-out infinite 0.7s;
}
@keyframes badge-float{0%,100%{transform:translateY(0)}50%{transform:translateY(-3px)}}
.badge-dot{width:6px;height:6px;border-radius:50%;background:var(--cyan);animation:pulse-dot 1.8s ease-in-out infinite}
@keyframes pulse-dot{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.5;transform:scale(.7)}}

.hero-title{
  font-size:56px;font-weight:900;line-height:1.08;letter-spacing:-1px;
}
.hero-title .cyan{color:var(--cyan)}
.hero-title .purple{color:var(--purple)}
.hero-title .white{color:#fff}

.hero-sub{font-size:15px;color:#94a3b8;line-height:1.65;max-width:420px}

.hero-features{display:flex;gap:28px;flex-wrap:wrap;margin-top:4px}
.hfeat{display:flex;align-items:center;gap:10px}
.hfeat-icon{
  width:38px;height:38px;border-radius:50%;
  background:rgba(255,255,255,0.05);
  border:1px solid rgba(255,255,255,0.1);
  display:flex;align-items:center;justify-content:center;
  color:var(--cyan);flex-shrink:0;
}
.hfeat-label{font-size:12px;font-weight:700;color:#fff}
.hfeat-sub{font-size:10px;color:var(--muted)}

.hero-btns{display:flex;gap:14px;align-items:center;flex-wrap:wrap}
.btn-cyan{
  background:linear-gradient(135deg,var(--cyan),var(--purple));
  color:#fff;border:none;padding:14px 28px;border-radius:7px;
  font-size:13px;font-weight:700;letter-spacing:.5px;cursor:pointer;
  display:inline-flex;align-items:center;gap:8px;text-decoration:none;
  box-shadow:0 0 20px rgba(0,95,231,0.35);
  transition:all .2s;
  animation:fadeUp 0.6s ease 0.5s both, btn-pulse 3s ease-in-out infinite 0.8s;
}
@keyframes btn-pulse{0%,100%{box-shadow:0 0 20px rgba(0,95,231,0.35)}50%{box-shadow:0 0 30px rgba(0,95,231,0.5),0 0 60px rgba(0,95,231,0.15)}}
.btn-cyan:hover{box-shadow:0 0 30px rgba(0,95,231,0.55);transform:translateY(-1px);animation:none}
.btn-cyan-outline{
  background:transparent;color:#fff;
  border:1.5px solid rgba(255,45,120,0.5);
  padding:13px 28px;border-radius:7px;
  font-size:13px;font-weight:700;letter-spacing:.5px;cursor:pointer;
  display:inline-flex;align-items:center;gap:8px;text-decoration:none;
  transition:all .25s;
}
.btn-cyan-outline:hover{border-color:var(--purple);background:rgba(255,45,120,0.08);transform:translateY(-1px);box-shadow:0 4px 20px rgba(255,45,120,0.15)}

/* HERO RIGHT - banner / chart panel */
.hero-right{position:relative;display:flex;align-items:center;justify-content:center;z-index:2}

.hero-banner-wrap{
  width:100%;
  border-radius:16px;
  overflow:hidden;
  border:1px solid rgba(0,95,231,0.2);
  box-shadow:0 0 40px rgba(0,95,231,0.08), 0 0 80px rgba(255,45,120,0.06);
  position:relative;
}
.hero-banner-wrap::after{
  content:'';position:absolute;inset:0;
  border-radius:16px;
  padding:3px;
  background:conic-gradient(from 0deg,#005fe7,#ff2d78,#2255ff,#ff00aa,#005fe7);
  -webkit-mask:linear-gradient(#fff 0 0) content-box,linear-gradient(#fff 0 0);
  -webkit-mask-composite:xor;
  mask-composite:exclude;
  pointer-events:none;z-index:2;
}
.hero-banner-img{
  width:100%;height:auto;display:block;
  max-height:450px;object-fit:cover;
}

.chart-frame{
  width:100%;
  border:1px solid rgba(0,95,231,0.2);
  border-radius:16px;
  background:rgba(8,12,26,0.9);
  overflow:hidden;
  box-shadow:0 0 40px rgba(0,95,231,0.08), 0 0 80px rgba(255,45,120,0.06);
  position:relative;
  animation:chart-glow 3s ease-in-out infinite alternate;
}
@keyframes chart-glow{0%{box-shadow:0 0 40px rgba(0,95,231,0.08), 0 0 80px rgba(255,45,120,0.06)}100%{box-shadow:0 0 50px rgba(0,95,231,0.14), 0 0 90px rgba(255,45,120,0.10)}}
.chart-frame::before{
  content:'';position:absolute;top:0;left:0;right:0;height:2px;
  background:linear-gradient(90deg,transparent,var(--cyan),var(--purple),transparent);
}
.chart-frame::after{
  content:'';position:absolute;inset:0;
  border-radius:16px;
  padding:3px;
  background:conic-gradient(from 0deg,#005fe7,#ff2d78,#2255ff,#ff00aa,#005fe7);
  -webkit-mask:linear-gradient(#fff 0 0) content-box,linear-gradient(#fff 0 0);
  -webkit-mask-composite:xor;
  mask-composite:exclude;
  pointer-events:none;z-index:2;
}

.chart-topbar{
  display:flex;justify-content:space-between;align-items:center;
  padding:12px 16px;border-bottom:1px solid var(--border);
}
.chart-pair{font-size:13px;font-weight:700;color:#fff;display:flex;gap:12px;align-items:center}
.chart-pair span{color:var(--muted);font-weight:500}
.chart-price{font-size:14px;font-weight:800;display:flex;align-items:center;gap:10px}
.price-up{color:var(--cyan)}
.price-change{color:#22c55e;font-size:12px;font-weight:700}

.chart-svg-wrap{padding:0;position:relative;background:#060d1a}

/* ===================== PLATFORM BAR ===================== */
.platform-bar{
  background:#080c1a;
  border-top:1px solid var(--border);
  border-bottom:1px solid var(--border);
  padding:0 40px;
  display:flex;
  align-items:stretch;
}
.plat-item{
  display:flex;align-items:center;gap:16px;
  padding:22px 32px;
  border-right:1px solid var(--border);
  flex:1;
  transition:all .3s;
}
.plat-item:hover{background:rgba(255,255,255,0.02);transform:translateY(-2px)}
.plat-item:last-child{border-right:none}
.plat-icon-wrap{
  width:52px;height:52px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;
  transition:all .3s;
}
.plat-item:hover .plat-icon-wrap{transform:scale(1.12)}
.plat-item:hover .plat-icon-wrap svg{animation:icon-bounce .5s ease}
@keyframes icon-bounce{0%,100%{transform:translateY(0)}40%{transform:translateY(-4px)}60%{transform:translateY(-2px)}}
.plat-icon-wrap.cyan-glow{background:rgba(0,95,231,0.1);box-shadow:0 0 20px rgba(0,95,231,0.15)}
.plat-icon-wrap.green-glow{background:rgba(34,197,94,0.1);box-shadow:0 0 20px rgba(34,197,94,0.15)}
.plat-icon-wrap.purple-glow{background:rgba(255,45,120,0.1);box-shadow:0 0 20px rgba(255,45,120,0.15)}
.plat-icon-wrap.pink-glow{background:rgba(236,72,153,0.1);box-shadow:0 0 20px rgba(236,72,153,0.15)}
.plat-title{font-size:14px;font-weight:700;color:#fff;transition:color .3s}
.plat-item:hover .plat-title{color:var(--cyan)}
.plat-sub{font-size:11px;color:var(--muted);margin-top:2px}

/* ===================== PRODUCTS ===================== */
.products-section{padding:70px 40px;background:var(--bg-primary)}
.section-title{text-align:center;font-size:34px;font-weight:800;color:#fff;margin-bottom:40px;position:relative;display:flex;align-items:center;justify-content:center;gap:16px}
.section-title::before,.section-title::after{content:'';flex:1;height:1px;background:linear-gradient(90deg,transparent,rgba(0,95,231,0.3))}
.section-title::after{background:linear-gradient(90deg,rgba(0,95,231,0.3),transparent)}
.section-title span{position:relative}
.section-title span::after{content:'';position:absolute;bottom:-4px;left:50%;transform:translateX(-50%);width:40%;height:2px;background:linear-gradient(90deg,transparent,var(--cyan),transparent);border-radius:2px;opacity:0;transition:opacity .5s}
.section-title:hover span::after{opacity:1}

.products-carousel{
  position:relative;
  overflow:hidden;
  padding:0 4px;
}
.products-carousel::before,.products-carousel::after{
  content:'';position:absolute;top:0;bottom:0;width:60px;z-index:3;
  pointer-events:none;
  transition:opacity .4s;
}
.products-carousel::before{
  left:0;
  background:linear-gradient(90deg,var(--bg-primary,#080c1a) 0%,transparent 100%);
}
.products-carousel::after{
  right:0;
  background:linear-gradient(270deg,var(--bg-primary,#080c1a) 0%,transparent 100%);
}
.products-carousel.at-start::before{opacity:0}
.products-carousel.at-end::after{opacity:0}
.products-grid{
  display:flex;
  flex-wrap:nowrap;
  gap:18px;
  transition:transform .5s cubic-bezier(.25,.46,.45,.94);
  will-change:transform;
}

.prod-card{
  min-width:calc(20% - 14.4px);
  max-width:calc(20% - 14.4px);
  flex-shrink:0;
  background:linear-gradient(170deg,rgba(255,255,255,0.04),rgba(255,255,255,0.01));
  border:1px solid rgba(255,255,255,0.08);
  border-radius:16px;
  overflow:hidden;
  transition:all .35s cubic-bezier(.16,1,.3,1);
  position:relative;
  backdrop-filter:blur(12px);
}
.prod-card--featured{
  z-index:2;
  border-color:rgba(0,95,231,0.3);
  box-shadow:0 0 0 1px rgba(0,95,231,0.12), 0 12px 40px rgba(0,95,231,0.12);
  background:linear-gradient(170deg,rgba(255,255,255,0.07),rgba(0,95,231,0.03));
}
.prod-card--featured::after{opacity:1}
.prod-card--featured .prod-chart-area{height:280px}
.prod-card--featured .prod-chart-area::before{
  opacity:1;
  background:radial-gradient(circle at 30% 40%,rgba(0,95,231,0.14) 0%,transparent 60%),
              radial-gradient(circle at 70% 60%,rgba(255,45,120,0.10) 0%,transparent 50%);
}
.prod-card--featured .prod-name{font-size:22px}
.prod-card--featured .prod-price{font-size:28px}
.prod-card--featured .prod-info{background:linear-gradient(0deg,rgba(5,5,15,1),rgba(5,5,15,0.88));padding:24px 24px 26px}
.prod-card--featured .prod-footer{padding-top:16px}
.prod-card--featured .btn-view-detail{
  background:linear-gradient(135deg,var(--cyan),var(--purple));
  border-color:transparent;
  font-size:13px;
  padding:14px 16px;
}
.prod-card--featured:hover{transform:translateY(-6px);box-shadow:0 20px 60px rgba(0,95,231,0.18),0 0 0 1px rgba(0,95,231,0.12)}

/* ===== CAROUSEL ARROWS ===== */
.carousel-btn{
  position:absolute;
  top:50%;
  transform:translateY(-50%);
  z-index:10;
  width:44px;height:44px;
  border-radius:50%;
  border:1px solid rgba(255,255,255,0.1);
  background:rgba(8,12,26,0.85);
  backdrop-filter:blur(12px);
  -webkit-backdrop-filter:blur(12px);
  color:#fff;
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;
  transition:all .25s cubic-bezier(.16,1,.3,1);
  box-shadow:0 4px 20px rgba(0,0,0,0.3);
}
.carousel-btn:hover{
  border-color:var(--cyan);
  background:rgba(0,95,231,0.15);
  box-shadow:0 4px 25px rgba(0,95,231,0.25),0 0 0 4px rgba(0,95,231,0.08);
  transform:translateY(-50%) scale(1.08);
}
.carousel-btn:active{transform:translateY(-50%) scale(.95)}
.carousel-btn-prev{left:-20px}
.carousel-btn-next{right:-20px}
.carousel-btn svg{width:18px;height:18px;transition:transform .2s}
.carousel-btn-prev:hover svg{transform:translateX(-2px)}
.carousel-btn-next:hover svg{transform:translateX(2px)}
.carousel-btn:disabled{opacity:0.25;cursor:default;pointer-events:none}
@media(max-width:768px){
  .carousel-btn{width:36px;height:36px;left:-16px}
  .carousel-btn-next{left:auto;right:-16px}
  .carousel-btn svg{width:14px;height:14px}
}

.prod-card::before{
  content:'';position:absolute;inset:0;
  background:linear-gradient(180deg,transparent 50%,rgba(0,0,0,0.4) 100%);
  pointer-events:none;z-index:1;
}
.prod-card::after{
  content:'';position:absolute;top:0;left:0;right:0;height:2px;
  background:linear-gradient(90deg,transparent,var(--cyan),var(--purple),transparent);
  opacity:0;transition:opacity .35s;
}
.prod-card:hover::after{opacity:1}
.prod-card:hover{
  border-color:rgba(0,95,231,0.35);
  transform:translateY(-6px) scale(1.01);
  box-shadow:0 20px 60px rgba(0,95,231,0.12),0 0 0 1px rgba(0,95,231,0.08);
}

.prod-chart-area{
  height:240px;
  overflow:hidden;
  position:relative;
  display:flex;
  align-items:center;
  justify-content:center;
  background:linear-gradient(135deg,#0a0f2e,#050d18);
}
.prod-chart-area::before{
  content:'';position:absolute;inset:0;
  background:radial-gradient(circle at 30% 40%,rgba(0,95,231,0.08) 0%,transparent 60%),
              radial-gradient(circle at 70% 60%,rgba(255,45,120,0.06) 0%,transparent 50%);
  pointer-events:none;z-index:1;
}
.prod-chart-area::after{
  content:'';position:absolute;inset:0;
  background:linear-gradient(0deg,rgba(5,5,15,0.9) 0%,transparent 50%);
  pointer-events:none;z-index:1;
}
.prod-chart-area img{
  width:100%;height:100%;object-fit:cover;
  transition:transform .6s cubic-bezier(.16,1,.3,1);
}
.prod-card:hover .prod-chart-area img{transform:scale(1.08)}

.prod-info{
  padding:20px 20px 22px;
  position:relative;
  z-index:2;
  background:linear-gradient(0deg,rgba(5,5,15,0.96),rgba(5,5,15,0.82));
  margin-top:-12px;
  border-radius:14px 14px 0 0;
}
.prod-name{
  font-size:18px;
  font-weight:800;
  color:#fff;
  margin-bottom:4px;
  letter-spacing:-0.3px;
  display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden;
}
.prod-compat{
  font-size:12px;
  color:var(--muted);
  margin-bottom:12px;
  display:flex;
  align-items:center;
  gap:6px;
}
.prod-compat::before{
  content:'';
  width:5px;height:5px;
  border-radius:50%;
  background:var(--cyan);
  flex-shrink:0;
}
.prod-footer{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:14px;
  padding-top:14px;
  border-top:1px solid rgba(255,255,255,0.06);
}
.prod-price{
  font-size:24px;
  font-weight:900;
  background:linear-gradient(135deg,#22c55e,#10b981);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
  letter-spacing:-0.5px;
}
.prod-from{font-size:11px;color:var(--muted)}
.prod-actions{display:flex;gap:10px;align-items:center}
.btn-view-detail{
  flex:1;
  background:linear-gradient(135deg,rgba(0,95,231,0.12),rgba(255,45,120,0.08));
  border:1px solid rgba(0,95,231,0.2);
  color:#fff;
  font-size:12px;
  font-weight:700;
  padding:11px 14px;
  border-radius:8px;
  cursor:pointer;
  transition:all .3s;
  text-decoration:none;
  text-align:center;
  letter-spacing:0.3px;
}
.btn-view-detail:hover{
  background:linear-gradient(135deg,var(--cyan),var(--purple));
  border-color:transparent;
  color:#fff;
  box-shadow:0 4px 24px rgba(0,95,231,0.3);
  transform:translateY(-2px);
}
.btn-cart{
  width:40px;height:40px;
  border:1px solid rgba(255,255,255,0.1);
  background:rgba(255,255,255,0.04);
  border-radius:8px;
  cursor:pointer;color:#fff;
  display:flex;align-items:center;
  justify-content:center;
  transition:all .3s;flex-shrink:0;text-decoration:none;
}
.btn-cart:hover{
  border-color:var(--cyan);
  color:var(--cyan);
  background:rgba(0,95,231,0.1);
  box-shadow:0 0 24px rgba(0,95,231,0.2);
  transform:scale(1.08);
}

.view-all-wrap{text-align:center;margin-top:30px}
.btn-view-all{
  background:transparent;border:1.5px solid rgba(0,95,231,0.3);
  color:var(--cyan);padding:13px 36px;border-radius:7px;
  font-size:13px;font-weight:700;cursor:pointer;
  display:inline-flex;align-items:center;gap:8px;text-decoration:none;
  transition:all .2s;
}
.btn-view-all:hover{background:rgba(0,95,231,0.06);border-color:var(--cyan)}

/* ===================== STATS BAR ===================== */
.stats-bar{
  background:linear-gradient(135deg,#06091a,#0a0f22);
  border:1px solid var(--border);
  margin:0 40px 48px;
  border-radius:14px;
  display:flex;
  overflow:hidden;
}
.stat-item{
  flex:1;padding:20px 20px;
  display:flex;align-items:center;gap:14px;
  border-right:1px solid var(--border);
  transition:all .35s;
  cursor:default;
}
.stat-item:hover{background:rgba(255,255,255,0.02);transform:translateY(-2px)}
.stat-item:last-child{border-right:none}
.stat-icon-wrap{
  width:42px;height:42px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;flex-shrink:0;
  transition:all .35s;
}
.stat-item:hover .stat-icon-wrap{transform:scale(1.1) rotate(6deg)}
.stat-icon-wrap.cyan-ring{border:2px solid rgba(0,95,231,0.4);background:rgba(0,95,231,0.08);color:var(--cyan)}
.stat-icon-wrap.green-ring{border:2px solid rgba(34,197,94,0.4);background:rgba(34,197,94,0.08);color:#22c55e}
.stat-icon-wrap.purple-ring{border:2px solid rgba(255,45,120,0.4);background:rgba(255,45,120,0.08);color:var(--purple)}
.stat-icon-wrap.pink-ring{border:2px solid rgba(236,72,153,0.4);background:rgba(236,72,153,0.08);color:#ec4899}
.stat-num{font-size:22px;font-weight:700;color:#fff;transition:all .35s}
.stat-item:hover .stat-num{text-shadow:0 0 20px rgba(0,95,231,0.2)}
.stat-label{font-size:11px;color:var(--muted);margin-top:2px;transition:color .35s}
.stat-item:hover .stat-label{color:rgba(234,234,234,0.5)}

/* ===================== BROKER LOGOS ===================== */
.broker-section{padding:48px 40px 56px;background:var(--bg-primary);border-top:1px solid var(--border);position:relative;overflow:hidden}
.broker-section::before{
  content:'';position:absolute;inset:0;
  background:radial-gradient(ellipse 80% 60% at 30% 50%,rgba(0,95,231,0.04) 0%,transparent 60%);
  pointer-events:none;
}
.broker-header{text-align:center;margin-bottom:36px;position:relative;z-index:2}
.broker-badge{
  display:inline-flex;align-items:center;gap:6px;
  background:rgba(0,95,231,0.06);border:1px solid rgba(0,95,231,0.15);
  padding:5px 14px;border-radius:50px;
  font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;
  color:var(--cyan);margin-bottom:10px;
}
.broker-badge-dot{width:5px;height:5px;border-radius:50%;background:var(--cyan);animation:pulse-dot 1.8s ease-in-out infinite}
.broker-title{font-size:22px;font-weight:800;color:#fff;letter-spacing:-0.3px}
.broker-title span{background:linear-gradient(135deg,var(--cyan),var(--purple));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.broker-sub{font-size:13px;color:var(--muted);margin-top:6px}

.broker-grid{
  display:flex;
  flex-wrap:wrap;
  justify-content:center;
  gap:14px;
  position:relative;
  z-index:2;
  max-width:1000px;
  margin:0 auto;
}
.broker-item{
  display:flex;
  flex-direction:column;
  align-items:center;
  justify-content:center;
  gap:10px;
  min-width:calc(20% - 11.2px);
  max-width:calc(20% - 11.2px);
  padding:22px 12px 18px;
  background:rgba(255,255,255,0.02);
  border:1px solid rgba(255,255,255,0.06);
  border-radius:12px;
  transition:all .35s cubic-bezier(.16,1,.3,1);
  cursor:default;
  position:relative;
  overflow:hidden;
}
.broker-item::before{
  content:'';position:absolute;top:0;left:50%;transform:translateX(-50%);
  width:0;height:2px;
  background:linear-gradient(90deg,var(--cyan),var(--purple));
  border-radius:0 0 2px 2px;
  transition:width .35s cubic-bezier(.16,1,.3,1);
}
.broker-item:hover::before{width:70%}
.broker-item:hover{
  border-color:rgba(0,95,231,0.2);
  background:rgba(255,255,255,0.04);
  transform:translateY(-3px);
  box-shadow:0 8px 30px rgba(0,95,231,0.08),0 0 0 1px rgba(0,95,231,0.05);
}
.broker-logo-wrap{
  width:80px;height:40px;
  display:flex;
  align-items:center;
  justify-content:center;
  transition:all .4s cubic-bezier(.16,1,.3,1);
}
.broker-item:hover .broker-logo-wrap{transform:scale(1.06)}
.broker-logo-wrap svg{max-width:100%;max-height:100%}
.broker-name{font-size:9.5px;font-weight:600;color:var(--muted);letter-spacing:.8px;text-transform:uppercase;text-align:center;transition:color .3s}
.broker-item:hover .broker-name{color:rgba(234,234,234,0.6)}
.broker-mt5{
  font-size:8px;font-weight:700;color:var(--cyan);
  letter-spacing:1px;text-transform:uppercase;
  padding:2px 8px;border-radius:4px;
  background:rgba(0,95,231,0.08);
  opacity:0;
  transform:translateY(4px);
  transition:all .35s cubic-bezier(.16,1,.3,1);
}
.broker-item:hover .broker-mt5{opacity:1;transform:translateY(0)}

@media(max-width:992px){
  .broker-item{min-width:calc(25% - 10.5px);max-width:calc(25% - 10.5px)}
}
@media(max-width:768px){
  .broker-section{padding:36px 16px 44px}
  .broker-item{min-width:calc(33.333% - 9.3px);max-width:calc(33.333% - 9.3px)}
  .broker-logo-wrap{width:64px;height:32px}
  .broker-title{font-size:18px}
}
@media(max-width:480px){
  .broker-item{min-width:calc(50% - 7px);max-width:calc(50% - 7px)}
}

/* ===================== SCROLL ARROWS ===================== */
/* ===================== RESPONSIVE ===================== */
@media(max-width:1200px){
  .prod-card{min-width:calc(25% - 13.5px);max-width:calc(25% - 13.5px)}
}
@media(max-width:992px){
  .prod-card{min-width:calc(33.333% - 12px);max-width:calc(33.333% - 12px)}
}
@media(max-width:768px){
  .prod-card{min-width:calc(50% - 9px);max-width:calc(50% - 9px)}
  .prod-chart-area{height:200px}
  .prod-card--featured .prod-chart-area{height:220px}
  .prod-card--featured .prod-name{font-size:20px}
  .prod-card--featured .prod-price{font-size:24px}
}
@media(max-width:600px){
  .hero-title{font-size:32px}
  .hero-features{gap:14px}
  .topbar{padding:8px 16px;flex-wrap:wrap;gap:8px}
  .topbar-right{gap:12px;flex-wrap:wrap}
  .stats-bar{margin:0 16px 32px}
  .products-section{padding:40px 16px}
  .prod-card{min-width:calc(100% - 0px);max-width:calc(100% - 0px)}
  .prod-chart-area{height:180px}
  .prod-card--featured .prod-chart-area{height:200px}
  .platform-bar{padding:0 16px;overflow-x:auto}
  .hero{padding:80px 16px 40px}
}
</style>

<!-- ======= TOP BAR ======= -->
<div class="topbar">
  <div class="topbar-left">
    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L4 6v6c0 5.5 3.4 10.7 8 12 4.6-1.3 8-6.5 8-12V6l-8-4z"/></svg>
    Trusted by 10,000+ Traders Worldwide
  </div>
  <div class="topbar-right">
    <a href="mailto:support@smartbinaryzone.com">
      <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
      support@smartbinaryzone.com
    </a>
    @guest
    <a href="{{ route('login') }}">
      <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v2h20v-2c0-3.3-6.7-5-10-5z"/></svg>
      Login
    </a>
    <a href="{{ route('register') }}" class="btn-register">Register</a>
    @else
    <span style="color:var(--muted);font-size:12px;display:flex;align-items:center;gap:5px">
      <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v2h20v-2c0-3.3-6.7-5-10-5z"/></svg>
      {{ Auth::user()->name }}
    </span>
    @endguest
    <a href="{{ route('forex.cart') }}" class="cart-icon">
      <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2zM7.2 14.8l.03-.12.97-1.68H16c.75 0 1.41-.41 1.75-1.03l3.86-7.01L20 4.5h-.01L19 3H4.21L3.27.45 2.18 0H0v2h1.73l3.48 7.35L3.96 12c-.14.27-.21.57-.21.89C3.75 14 4.75 15 6 15h14v-2H6.42c-.14 0-.25-.11-.25-.25l.03-.12z"/></svg>
      <span id="topCartCount">0</span>
    </a>
  </div>
</div>

<!-- ======= HERO ======= -->
<section class="hero">
  <div class="hero-left">
    <span class="hero-badge">
      <span class="badge-dot"></span>
      Professional Trading Indicators
    </span>

    <h1 class="hero-title" style="animation:fadeUp 0.6s ease 0.2s both">
      <span class="cyan">Smarter</span> <span class="white">Indicators.</span><br>
      <span class="purple">Better</span> <span class="white">Binary Trades.</span>
    </h1>

    <p class="hero-sub" style="animation:fadeUp 0.6s ease 0.3s both">Powerful MT4, MT5 &amp; Binary Trading Indicators designed to increase accuracy and boost your profits.</p>

    <div class="hero-features" style="animation:fadeUp 0.6s ease 0.4s both">
      <div class="hfeat">
        <div class="hfeat-icon">
          <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/></svg>
        </div>
        <div>
          <div class="hfeat-label">High Accuracy</div>
          <div class="hfeat-sub">Precision Signals</div>
        </div>
      </div>
      <div class="hfeat">
        <div class="hfeat-icon">
          <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M7 2v11h3v9l7-12h-4l4-8z"/></svg>
        </div>
        <div>
          <div class="hfeat-label">Easy To Use</div>
          <div class="hfeat-sub">Plug &amp; Play</div>
        </div>
      </div>
      <div class="hfeat">
        <div class="hfeat-icon">
          <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L4 6v6c0 5.5 3.4 10.7 8 12 4.6-1.3 8-6.5 8-12V6l-8-4z"/></svg>
        </div>
        <div>
          <div class="hfeat-label">Lifetime Access</div>
          <div class="hfeat-sub">One-time Payment</div>
        </div>
      </div>
      <div class="hfeat">
        <div class="hfeat-icon">
          <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>
        </div>
        <div>
          <div class="hfeat-label">Premium Support</div>
          <div class="hfeat-sub">We're Here To Help</div>
        </div>
      </div>
    </div>

    <div class="hero-btns" style="animation:fadeUp 0.6s ease 0.5s both">
      <a href="{{ route('forex.products') }}" class="btn-cyan">
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2zM7.2 14.8l.03-.12.97-1.68H16c.75 0 1.41-.41 1.75-1.03l3.86-7.01L20 4.5h-.01L19 3H4.21L3.27.45 2.18 0H0v2h1.73l3.48 7.35L3.96 12c-.14.27-.21.57-.21.89C3.75 14 4.75 15 6 15h14v-2H6.42c-.14 0-.25-.11-.25-.25l.03-.12z"/></svg>
        Browse Indicators
      </a>
      <a href="https://t.me/smartbinaryzone" target="_blank" rel="noopener noreferrer" class="btn-cyan-outline">
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M11.944 0A12 12 0 000 12a12 12 0 0012 12 12 12 0 0012-12A12 12 0 0012 0a12 12 0 00-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 01.171.325c.016.127-.007.352-.047.483l-2.29 9.777c-.14.587-.503.719-.772.748-.27.028-.562-.082-.784-.248l-3.343-2.426-.608.594c-.154.15-.27.252-.468.258l.17-2.797 5.26-4.854c.104-.096.035-.168-.078-.112l-6.565 3.848-2.704-.874c-.574-.184-.582-.568.004-.726l10.846-4.079s.408-.137.625-.142z"/></svg>
        Join Telegram
      </a>
    </div>
  </div>

  <!-- HERO RIGHT - Banner Image OR Chart Panel -->
  <div class="hero-right" style="animation:fadeUp 0.6s ease 0.3s both">
    @if($heroBanner)
    <div class="hero-banner-wrap">
      <img src="{{ config('app.storage_url') }}{{ $heroBanner }}" alt="Hero Banner" class="hero-banner-img">
    </div>
    @else
    <div class="chart-frame">
      <div class="chart-topbar">
        <div class="chart-pair">
          XAUUSD <span>· M15</span>
        </div>
        <div class="chart-price">
          <span class="price-up">2,388.72</span>
          <span class="price-change">+28.42%</span>
        </div>
      </div>
      <div class="chart-svg-wrap">
        <svg width="100%" height="200" viewBox="0 0 460 200" preserveAspectRatio="xMidYMid meet" style="display:block;">
          <!-- Grid lines -->
          <line x1="0" y1="20" x2="460" y2="20" stroke="rgba(255,255,255,0.04)" stroke-width="1"/>
          <line x1="0" y1="56" x2="460" y2="56" stroke="rgba(255,255,255,0.04)" stroke-width="1"/>
          <line x1="0" y1="92" x2="460" y2="92" stroke="rgba(255,255,255,0.04)" stroke-width="1"/>
          <line x1="0" y1="128" x2="460" y2="128" stroke="rgba(255,255,255,0.04)" stroke-width="1"/>
          <line x1="0" y1="164" x2="460" y2="164" stroke="rgba(255,255,255,0.04)" stroke-width="1"/>
          <!-- Green trend line -->
          <polyline points="20,170 60,155 100,140 130,145 160,120 190,108 210,120 240,95 270,78 300,85 330,62 360,50 380,55 410,38 440,30" fill="none" stroke="#22c55e" stroke-width="2" opacity="0.7"/>
          <!-- Bear candles -->
          <line x1="35" y1="148" x2="35" y2="170" stroke="#ef4444" stroke-width="1.5"/>
          <rect x="30" y="152" width="10" height="14" fill="#ef4444"/>
          <line x1="85" y1="125" x2="85" y2="148" stroke="#ef4444" stroke-width="1.5"/>
          <rect x="80" y="128" width="10" height="14" fill="#ef4444"/>
          <line x1="145" y1="135" x2="145" y2="152" stroke="#ef4444" stroke-width="1.5"/>
          <rect x="140" y="138" width="10" height="10" fill="#ef4444"/>
          <line x1="215" y1="110" x2="215" y2="130" stroke="#ef4444" stroke-width="1.5"/>
          <rect x="210" y="114" width="10" height="12" fill="#ef4444"/>
          <!-- Bull candles (cyan) -->
          <line x1="60" y1="135" x2="60" y2="158" stroke="#005fe7" stroke-width="1.5"/>
          <rect x="55" y="138" width="10" height="14" fill="#005fe7"/>
          <line x1="110" y1="115" x2="110" y2="140" stroke="#005fe7" stroke-width="1.5"/>
          <rect x="105" y="118" width="10" height="16" fill="#005fe7"/>
          <line x1="175" y1="100" x2="175" y2="125" stroke="#005fe7" stroke-width="1.5"/>
          <rect x="170" y="103" width="10" height="16" fill="#005fe7"/>
          <line x1="250" y1="72" x2="250" y2="100" stroke="#005fe7" stroke-width="1.5"/>
          <rect x="245" y="75" width="10" height="18" fill="#005fe7"/>
          <line x1="285" y1="55" x2="285" y2="82" stroke="#005fe7" stroke-width="1.5"/>
          <rect x="280" y="58" width="10" height="18" fill="#005fe7"/>
          <line x1="340" y1="38" x2="340" y2="68" stroke="#005fe7" stroke-width="1.5"/>
          <rect x="335" y="42" width="10" height="20" fill="#005fe7"/>
          <!-- Pink candle -->
          <line x1="375" y1="42" x2="375" y2="65" stroke="#ff2d78" stroke-width="1.5"/>
          <rect x="370" y="45" width="10" height="16" fill="#ff2d78"/>
          <line x1="420" y1="30" x2="420" y2="55" stroke="#005fe7" stroke-width="1.5"/>
          <rect x="415" y="33" width="10" height="16" fill="#005fe7"/>
          <!-- Current price tag -->
          <rect x="370" y="28" width="70" height="20" rx="4" fill="#005fe7"/>
          <text x="405" y="42" fill="#000" font-size="11" font-weight="800" text-anchor="middle">2388.72</text>
        </svg>
      </div>
    </div>
    @endif
  </div>
</section>

<!-- ======= PLATFORM BAR ======= -->
<div class="platform-bar">
  <div class="plat-item">
    <div class="plat-icon-wrap" style="width:auto;height:48px;padding:0 10px;border-radius:8px;background:rgba(0,95,231,0.08);">
      <img src="{{ url('/assets/frontend/img/mt4-brokers.png') }}" alt="MT4 Brokers" style="height:36px;width:auto;object-fit:contain;filter:brightness(1.1)">
    </div>
    <div>
      <div class="plat-title">MT4 Support</div>
      <div class="plat-sub">All MT4 Brokers</div>
    </div>
  </div>
  <div class="plat-item">
    <div class="plat-icon-wrap" style="width:auto;height:48px;padding:0 10px;border-radius:8px;background:rgba(34,197,94,0.08);">
      <img src="{{ url('/assets/frontend/img/mt5-brokers.png') }}" alt="MT5 Brokers" style="height:36px;width:auto;object-fit:contain;filter:brightness(1.1)">
    </div>
    <div>
      <div class="plat-title">MT5 Support</div>
      <div class="plat-sub">All MT5 Brokers</div>
    </div>
  </div>
  <div class="plat-item">
    <div class="plat-icon-wrap purple-glow">
      <svg width="28" height="28" fill="#ff2d78" viewBox="0 0 24 24"><path d="M7 2v11h3v9l7-12h-4l4-8z"/></svg>
    </div>
    <div>
      <div class="plat-title">Binary Options</div>
      <div class="plat-sub">All Popular Platforms</div>
    </div>
  </div>
  <div class="plat-item">
    <div class="plat-icon-wrap pink-glow">
      <svg width="28" height="28" fill="#ec4899" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>
    </div>
    <div>
      <div class="plat-title">24/7 Support</div>
      <div class="plat-sub">Quick &amp; Professional</div>
    </div>
  </div>
</div>

<!-- ======= TRUSTED MT5 BROKERS ======= -->
<section class="broker-section">
  <div class="broker-header">
    <div class="broker-badge">
      <span class="broker-badge-dot"></span>
      Verified Compatibility
    </div>
    <div class="broker-title">Trusted by <span>Top MT5 Brokers</span></div>
    <div class="broker-sub">Our Expert Advisors are verified and optimized for all major MT5 brokers worldwide</div>
  </div>

  <div class="broker-grid">
    <div class="broker-single-image" style="width:100%;display:flex;flex-wrap:wrap;justify-content:center;gap:24px;padding:14px 0">
      <div style="display:flex;flex-direction:column;align-items:center;gap:8px">
        <img src="{{ url('/assets/frontend/img/mt4-brokers.png') }}" alt="All MT4 Brokers" style="max-width:100%;height:auto;max-height:70px;object-fit:contain;opacity:0.85;transition:opacity 0.4s;filter:brightness(1.05)" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.85'">
        <span style="font-size:10px;font-weight:700;color:var(--cyan);letter-spacing:1px;text-transform:uppercase;padding:2px 10px;border-radius:4px;background:rgba(0,95,231,0.08)">MT4 Brokers</span>
      </div>
      <div style="display:flex;flex-direction:column;align-items:center;gap:8px">
        <img src="{{ url('/assets/frontend/img/mt5-brokers.png') }}" alt="All MT5 Brokers" style="max-width:100%;height:auto;max-height:70px;object-fit:contain;opacity:0.85;transition:opacity 0.4s;filter:brightness(1.05)" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.85'">
        <span style="font-size:10px;font-weight:700;color:var(--cyan);letter-spacing:1px;text-transform:uppercase;padding:2px 10px;border-radius:4px;background:rgba(0,95,231,0.08)">MT5 Brokers</span>
      </div>
    </div>
  </div>
</section>

<!-- ======= PRODUCTS ======= -->
<section class="products-section">
  <div class="section-title"><span>Popular Indicators</span></div>

  @if($dbProducts->count() > 0)
  <div style="position:relative" id="productsSection">
    <button class="carousel-btn carousel-btn-prev" id="carouselPrev" onclick="carouselMove(-1)" aria-label="Previous products">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M15 19l-7-7 7-7"/></svg>
    </button>

    <div class="products-carousel" id="productsCarousel">
    <div class="products-grid" id="productsGrid">
      @foreach($dbProducts as $p)
      @php
        $firstPlan = $p->plans ? (collect($p->plans)->firstWhere('price', '>', 0) ?? collect($p->plans)->first()) : null;
        $price = $firstPlan['price'] ?? 0;
        $initials = collect(explode(' ', $p->name))->map(fn($w) => substr($w,0,1))->take(2)->implode('');
        $colors = ['#005fe7','#ff2d78','#22c55e','#f59e0b','#a855f7','#3b82f6','#ec4899','#10b981'];
        $bgColor = $colors[crc32($p->id ?? 0) % count($colors)];
      @endphp
      <div class="prod-card" data-index="{{ $loop->index }}">
        <!-- Badge with gradient price tag -->
        <div style="position:absolute;top:14px;right:14px;z-index:3;background:linear-gradient(135deg,var(--cyan),var(--purple));color:#fff;font-size:11px;font-weight:800;padding:5px 14px;border-radius:50px;letter-spacing:0.5px;box-shadow:0 4px 15px rgba(0,95,231,0.3)">{{ formatPrice($price, 0) }}</div>
        
        <div class="prod-chart-area">
          @if($p->image)
          <img src="{{ config('app.storage_url') }}{{ $p->image }}" alt="{{ $p->name }}">
          @else
          <div style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,{{ $bgColor }},rgba(255,255,255,0.1));display:flex;align-items:center;justify-content:center;font-size:28px;font-weight:900;color:#fff;opacity:0.9;border:2px solid rgba(255,255,255,0.1);box-shadow:0 8px 30px rgba(0,0,0,0.3)">{{ $initials }}</div>
          @endif
        <!-- Decorative chart lines -->
        <div style="position:absolute;bottom:20px;left:14px;right:14px;z-index:2;display:flex;flex-direction:column;gap:5px;opacity:0.12;pointer-events:none">
          <svg width="100%" height="30" viewBox="0 0 200 30" preserveAspectRatio="none">
            <polyline points="0,20 30,15 55,22 80,8 110,14 140,4 170,10 200,6" fill="none" stroke="var(--cyan)" stroke-width="1.5"/>
          </svg>
          <svg width="100%" height="20" viewBox="0 0 200 20" preserveAspectRatio="none">
            <polyline points="0,15 25,10 50,14 75,5 100,8 130,3 160,7 200,4" fill="none" stroke="var(--purple)" stroke-width="1"/>
          </svg>
        </div>
        <!-- Decorative dots -->
        <div style="position:absolute;bottom:10px;left:14px;z-index:2;display:flex;gap:4px">
          <span style="width:5px;height:5px;border-radius:50%;background:var(--cyan);opacity:0.6"></span>
          <span style="width:5px;height:5px;border-radius:50%;background:var(--purple);opacity:0.4"></span>
          <span style="width:5px;height:5px;border-radius:50%;background:#22c55e;opacity:0.3"></span>
        </div>
        </div>
        <div class="prod-info">
          <div class="prod-name">{{ $p->name }}</div>
          <div class="prod-compat">{{ $p->tagline ?? $p->indicator ?? 'Premium Product' }}</div>
          <div class="prod-footer">
            <span class="prod-from">Starting from</span>
            <span class="prod-price">{{ formatPrice($price, 0) }}</span>
          </div>
          <div class="prod-actions">
            <a href="{{ route('forex.product-detail', $p->slug) }}" class="btn-view-detail">View Details</a>
            <button class="btn-cart" onclick="addToCart({id:'{{ $p->slug }}',name:'{{ str_replace("'", "\'", $p->name) }}',price:{{ $price }}})" title="Add to cart">
              <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM7.2 14.8l.03-.12.97-1.68H16c.75 0 1.41-.41 1.75-1.03l3.86-7L20 4h-1L19 3H4.21l-.94-2.55L2.18 0H0v2h1.73l3.48 7.35L3.96 12c-.14.27-.21.57-.21.89C3.75 14 4.75 15 6 15h14v-2H6.42c-.14 0-.25-.11-.25-.25z"/></svg>
            </button>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

    <button class="carousel-btn carousel-btn-next" id="carouselNext" onclick="carouselMove(1)" aria-label="Next products">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M9 5l7 7-7 7"/></svg>
    </button>
  </div>
  @else
  <div style="text-align:center;padding:60px 40px;color:var(--muted);font-size:15px">
    <div style="font-size:40px;margin-bottom:12px;opacity:0.3">📦</div>
    No products available yet. Check back soon!
  </div>
  @endif

  <div class="view-all-wrap">
    <a href="{{ route('forex.products') }}" class="btn-view-all">View All Indicators &nbsp;›</a>
  </div>
</section>

<!-- ======= STATS BAR ======= -->
<div class="stats-bar">
  <div class="stat-item">
    <div class="stat-icon-wrap cyan-ring">
      <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
    </div>
    <div>
      <div class="stat-num">1000+</div>
      <div class="stat-label">Happy Customers</div>
    </div>
  </div>
  <div class="stat-item">
    <div class="stat-icon-wrap green-ring">
      <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2zM7.2 14.8l.03-.12.97-1.68H16c.75 0 1.41-.41 1.75-1.03l3.86-7.01L20 4.5h-.01L19 3H4.21L3.27.45 2.18 0H0v2h1.73l3.48 7.35L3.96 12c-.14.27-.21.57-.21.89C3.75 14 4.75 15 6 15h14v-2H6.42c-.14 0-.25-.11-.25-.25l.03-.12z"/></svg>
    </div>
    <div>
      <div class="stat-num">{{ $dbProducts->count() }}</div>
      <div class="stat-label">Premium Products</div>
    </div>
  </div>
  <div class="stat-item">
    <div class="stat-icon-wrap purple-ring">
      <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M3.5 18.49l6-6.01 4 4L22 6.92l-1.41-1.41-7.09 7.97-4-4L2 16.99l1.5 1.5z"/></svg>
    </div>
    <div>
      <div class="stat-num">85%-95%</div>
      <div class="stat-label">Accuracy</div>
    </div>
  </div>
  <div class="stat-item">
    <div class="stat-icon-wrap pink-ring">
      <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67V7z"/></svg>
    </div>
    <div>
      <div class="stat-num">24/7</div>
      <div class="stat-label">Customer Support</div>
    </div>
  </div>
</div>

<script>
// Update cart count from localStorage
function updateTopCartCount() {
  var el = document.getElementById('topCartCount');
  if (!el) return;
  try {
    var cart = JSON.parse(localStorage.getItem('forex_cart') || '[]');
    var count = cart.reduce(function(s,i){ return s + (i.qty || 1); }, 0);
    el.textContent = count;
  } catch(e) {
    el.textContent = '0';
  }
}
updateTopCartCount();
// Listen for storage changes
window.addEventListener('storage', updateTopCartCount);
// Also update periodically
setInterval(updateTopCartCount, 2000);

// ===== CAROUSEL — shift by 1 card at a time =====
var carouselState = {
  currentIndex: 0,
  totalCards: {{ $dbProducts->count() }},
  visibleCards: 5
};

function getVisibleCards() {
  var w = window.innerWidth;
  if (w < 600) return 1;
  if (w < 768) return 2;
  if (w < 992) return 3;
  if (w < 1200) return 4;
  return 5;
}

function carouselMove(direction) {
  var grid = document.getElementById('productsGrid');
  if (!grid) return;
  var cards = grid.querySelectorAll('.prod-card');
  if (!cards.length) return;

  var visible = getVisibleCards();
  var maxIndex = Math.max(0, cards.length - visible);
  var newIndex = carouselState.currentIndex + direction;
  newIndex = Math.max(0, Math.min(newIndex, maxIndex));
  carouselState.currentIndex = newIndex;

  // Calculate translate: sum of (card width + gap) for each shifted card
  var firstCard = cards[0];
  var cardWidth = firstCard.offsetWidth;
  var gap = 18; // matches CSS gap
  var translateX = -(newIndex * (cardWidth + gap));
  grid.style.transform = 'translateX(' + translateX + 'px)';

  // Update disabled state on buttons
  var prevBtn = document.getElementById('carouselPrev');
  var nextBtn = document.getElementById('carouselNext');
  if (prevBtn) prevBtn.disabled = (newIndex === 0);
  if (nextBtn) nextBtn.disabled = (newIndex >= maxIndex);

  // Update edge fade classes
  var carousel = document.getElementById('productsCarousel');
  if (carousel) {
    carousel.classList.toggle('at-start', newIndex === 0);
    carousel.classList.toggle('at-end', newIndex >= maxIndex);
  }

  // Update featured card (3rd visible = newIndex + 2, but cap to total)
  cards.forEach(function(c) { c.classList.remove('prod-card--featured'); });
  var featuredIdx = Math.min(newIndex + Math.floor(visible / 2), cards.length - 1);
  if (cards[featuredIdx]) cards[featuredIdx].classList.add('prod-card--featured');
}

// Initialize carousel on load and resize
function initCarousel() {
  carouselState.currentIndex = 0;
  carouselMove(0);
}
window.addEventListener('load', initCarousel);
window.addEventListener('resize', function() {
  // Recalculate on resize - keep index within bounds
  var grid = document.getElementById('productsGrid');
  if (!grid) return;
  var cards = grid.querySelectorAll('.prod-card');
  if (!cards.length) return;
  var visible = getVisibleCards();
  var maxIndex = Math.max(0, cards.length - visible);
  if (carouselState.currentIndex > maxIndex) {
    carouselState.currentIndex = maxIndex;
  }
  carouselMove(0);
});
</script>
@endsection
