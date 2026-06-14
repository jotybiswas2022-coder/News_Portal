@extends('backend.app')

@section('content')

<style>
/* ===== DASHBOARD PAGE (scoped) ===== */
.db-page {
    --clr-primary: #2563EB;
    --clr-light: #60A5FA;
    --clr-dark: #1E40AF;
    --clr-accent-green: #00FF9F;
    --clr-accent-purple: #A855F7;
    --clr-accent-amber: #F59E0B;
    --clr-accent-rose: #F43F5E;
    --clr-bg: #0f172a;
    --clr-card: rgba(255,255,255,0.04);
    --clr-border: rgba(255,255,255,0.06);
    --clr-text: #f1f5f9;
    --clr-muted: #94a3b8;
    --clr-hover: rgba(37,99,235,0.08);
    --font: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;

    font-family: var(--font);
    color: var(--clr-text);
    -webkit-font-smoothing: antialiased;
    position: relative;
    background: var(--clr-bg);
    min-height: calc(100vh - 80px);
    padding: 28px 24px;
}

/* ===== ORBS ===== */
.db-orb {
    position: fixed; border-radius: 50%; filter: blur(80px); pointer-events: none; z-index: 0;
}
.db-orb-1 {
    width: 500px; height: 500px;
    background: radial-gradient(circle, rgba(37,99,235,0.1), transparent 70%);
    top: -200px; right: -100px;
    animation: dbo1 14s ease-in-out infinite;
}
.db-orb-2 {
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(96,165,250,0.07), transparent 70%);
    bottom: -150px; left: -80px;
    animation: dbo2 16s ease-in-out infinite;
}
.db-orb-3 {
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(30,64,175,0.08), transparent 70%);
    top: 30%; left: 60%;
    animation: dbo3 18s ease-in-out infinite;
}
.db-orb-4 {
    width: 250px; height: 250px;
    background: radial-gradient(circle, rgba(37,99,235,0.05), transparent 70%);
    bottom: 20%; right: 30%;
    animation: dbo1 22s ease-in-out infinite reverse;
}
@keyframes dbo1 { 0%,100% { transform:translate(0,0) scale(1); } 50% { transform:translate(60px,40px) scale(1.1); } }
@keyframes dbo2 { 0%,100% { transform:translate(0,0) scale(1); } 50% { transform:translate(-40px,-60px) scale(1.08); } }
@keyframes dbo3 { 0%,100% { transform:translate(0,0) scale(1); } 50% { transform:translate(25px,-35px) scale(1.12); } }

/* ===== PARTICLES ===== */
.db-particles { position:fixed; inset:0; overflow:hidden; pointer-events:none; z-index:1; }
.db-p {
    position:absolute;
    background:linear-gradient(135deg,var(--clr-primary),var(--clr-light));
    border-radius:50%;
    animation:dbr linear infinite;
}
@keyframes dbr {
    0% { transform:translateY(0) rotate(0deg); opacity:0; }
    10% { opacity:0.35; }
    90% { opacity:0.1; }
    100% { transform:translateY(-100vh) rotate(360deg); opacity:0; }
}

/* ===== ANIMATIONS ===== */
@keyframes fadeUp {
    from { opacity:0; transform:translateY(24px); }
    to { opacity:1; transform:translateY(0); }
}
@keyframes fadeIn {
    from { opacity:0; }
    to { opacity:1; }
}
@keyframes slideUp {
    from { opacity:0; transform:translateY(16px); }
    to { opacity:1; transform:translateY(0); }
}
@keyframes countUp {
    0% { opacity:0; transform:translateY(12px); }
    100% { opacity:1; transform:translateY(0); }
}

/* ===== HEADER (Hero Card) ===== */
.db-header {
    position:relative; z-index:5;
    background:linear-gradient(135deg, rgba(37,99,235,0.08), rgba(30,64,175,0.04));
    border:1px solid rgba(37,99,235,0.1);
    border-radius:20px; padding:28px 32px; margin-bottom:24px;
    overflow:hidden;
    animation:fadeUp 0.8s cubic-bezier(.16,1,.3,1) forwards;
}
.db-header-bg {
    position:absolute; inset:0;
    background:
        radial-gradient(ellipse at 20% 50%, rgba(37,99,235,0.1), transparent 60%),
        radial-gradient(ellipse at 80% 20%, rgba(96,165,250,0.06), transparent 50%);
    pointer-events:none;
}
.db-header-glow {
    position:absolute; bottom:0; left:0; right:0; height:1px;
    background:linear-gradient(90deg,transparent,rgba(37,99,235,0.2),transparent);
}
.db-header-content {
    position:relative; z-index:1;
    display:flex; align-items:center; justify-content:space-between; gap:24px; flex-wrap:wrap;
}
.db-header-left { display:flex; align-items:center; gap:20px; }

/* ── Admin Logo ── */
.db-admin-logo { position:relative; flex-shrink:0; }
.db-admin-logo-img {
    width:64px; height:64px; border-radius:50%; object-fit:cover;
    border:2px solid rgba(37,99,235,0.3);
    box-shadow:0 4px 16px rgba(37,99,235,0.2);
    transition:all 0.3s ease;
}
.db-admin-logo-img:hover {
    border-color:rgba(96,165,250,0.6);
    box-shadow:0 6px 24px rgba(37,99,235,0.3);
    transform:scale(1.05);
}
.db-admin-logo-fallback {
    width:64px; height:64px; border-radius:50%;
    background:linear-gradient(135deg,var(--clr-primary),var(--clr-dark));
    display:flex; align-items:center; justify-content:center;
    font-size:1.5rem; font-weight:700; color:#fff;
    border:2px solid rgba(37,99,235,0.3);
    box-shadow:0 4px 16px rgba(37,99,235,0.2);
    transition:all 0.3s ease;
}
.db-admin-logo-fallback:hover {
    transform:scale(1.05);
    border-color:rgba(96,165,250,0.6);
}
.db-admin-logo-dot {
    position:absolute; bottom:2px; right:2px;
    width:14px; height:14px; background:#22c55e;
    border:2.5px solid var(--clr-bg); border-radius:50%;
    animation:dbPulse 2s ease-in-out infinite;
}

.db-greeting {
    display:inline-flex; align-items:center; gap:7px;
    font-size:0.8rem; font-weight:600; color:var(--clr-light);
    margin-bottom:8px; letter-spacing:0.3px;
}
.db-greeting-dot {
    width:6px; height:6px; border-radius:50%; background:#22c55e;
    animation:dbPulse 2s ease-in-out infinite;
}
@keyframes dbPulse { 0%,100% { box-shadow:0 0 0 0 rgba(34,197,94,0.5); } 50% { box-shadow:0 0 0 5px rgba(34,197,94,0); } }
.db-header-title {
    font-size:1.6rem; font-weight:800; color:var(--clr-text);
    margin-bottom:4px; letter-spacing:-0.3px;
}
.db-header-name {
    background:linear-gradient(135deg,var(--clr-light),var(--clr-primary));
    -webkit-background-clip:text; -webkit-text-fill-color:transparent;
    background-clip:text;
}
.db-header-sub { font-size:0.88rem; color:var(--clr-muted); }
.db-header-right { display:flex; gap:16px; }
.db-header-stat {
    text-align:center; padding:10px 20px;
    background:rgba(255,255,255,0.03);
    border:1px solid rgba(255,255,255,0.05);
    border-radius:12px; min-width:90px;
}
.db-header-stat-num {
    display:block; font-size:1.3rem; font-weight:800; color:var(--clr-light);
    line-height:1.2;
}
.db-header-stat-label {
    display:block; font-size:0.7rem; color:var(--clr-muted); font-weight:500;
    text-transform:uppercase; letter-spacing:0.5px;
}

/* ===== STAT CARDS GRID ===== */
.db-stats {
    display:grid; grid-template-columns:repeat(5,1fr); gap:14px;
    margin-bottom:24px; position:relative; z-index:5;
}
.db-stat-card {
    position:relative; overflow:hidden;
    background:var(--clr-card); backdrop-filter:blur(16px) saturate(180%);
    -webkit-backdrop-filter:blur(16px) saturate(180%);
    border:1px solid var(--clr-border);
    border-radius:16px; padding:20px 18px;
    transition:all 0.4s cubic-bezier(.16,1,.3,1); cursor:default;
}
.db-stat-card:hover {
    transform:translateY(-4px);
    border-color:var(--accent);
    box-shadow:0 12px 40px rgba(0,0,0,0.2);
}
/* Top accent line */
.db-stat-card::before {
    content:''; position:absolute; top:0; left:0; right:0; height:3px;
    background:var(--accent);
    border-radius:3px 3px 0 0;
    opacity:0.8;
}
/* Glow orb on hover */
.db-stat-card::after {
    content:''; position:absolute; top:-3rem; right:-3rem;
    width:8rem; height:8rem;
    background:var(--accent);
    border-radius:50%; filter:blur(50px);
    opacity:0; transition:opacity 0.5s cubic-bezier(.4,0,.2,1);
    pointer-events:none;
}
.db-stat-card:hover::after { opacity:0.15; }

.db-stat-inner { position:relative; z-index:2; }
.db-stat-top {
    display:flex; align-items:center; justify-content:space-between;
    margin-bottom:12px;
}
.db-stat-icon {
    width:44px; height:44px; display:flex; align-items:center; justify-content:center;
    background:var(--accent-bg);
    border-radius:12px; font-size:1.2rem; color:var(--accent); flex-shrink:0;
    transition:transform 0.3s ease;
}
.db-stat-card:hover .db-stat-icon { transform:scale(1.1); }
.db-stat-badge {
    font-size:0.65rem; font-weight:700; text-transform:uppercase;
    letter-spacing:0.4px; padding:3px 10px; border-radius:20px;
    color:var(--accent); background:var(--accent-bg);
    border:1px solid var(--accent-border);
}
.db-stat-value {
    display:block; font-size:1.75rem; font-weight:800; color:var(--clr-text);
    line-height:1.15; letter-spacing:-0.5px; margin-bottom:2px;
}
.db-stat-value.pulse { animation:countUp 0.6s cubic-bezier(.16,1,.3,1) forwards; }
.db-stat-label {
    display:block; font-size:0.78rem; color:var(--clr-muted); font-weight:500;
}

/* ===== SECTION CONTAINER (for messages, orders, quick actions) ===== */
.db-section {
    position:relative; z-index:5;
    background:var(--clr-card); backdrop-filter:blur(16px) saturate(180%);
    -webkit-backdrop-filter:blur(16px) saturate(180%);
    border:1px solid var(--clr-border);
    border-radius:20px; overflow:hidden;
    transition:all 0.4s cubic-bezier(.16,1,.3,1);
    margin-bottom:20px;
}
.db-section:hover { border-color:rgba(37,99,235,0.1); }

.db-section-header {
    display:flex; align-items:center; justify-content:space-between;
    padding:22px 24px; gap:16px;
    border-bottom:1px solid rgba(255,255,255,0.04);
}
.db-section-header-left { display:flex; align-items:center; gap:14px; }
.db-section-icon {
    width:42px; height:42px; display:flex; align-items:center; justify-content:center;
    background:rgba(37,99,235,0.1);
    border:1px solid rgba(37,99,235,0.12);
    border-radius:10px; font-size:1.15rem; color:var(--clr-light); flex-shrink:0;
}
.db-section-title { font-size:1.05rem; font-weight:700; color:var(--clr-text); margin:0; }
.db-section-sub { font-size:0.78rem; color:var(--clr-muted); margin:2px 0 0; }
.db-section-link {
    display:inline-flex; align-items:center; gap:5px;
    font-size:0.82rem; font-weight:600; color:var(--clr-primary);
    text-decoration:none; transition:all 0.3s ease;
    padding:6px 14px; border-radius:8px;
    background:rgba(37,99,235,0.06); white-space:nowrap;
}
.db-section-link:hover { color:var(--clr-light); gap:8px; background:rgba(37,99,235,0.1); }
.db-section-link i { transition:transform 0.3s ease; }
.db-section-link:hover i { transform:translateX(3px); }

/* ===== EMPTY STATE ===== */
.db-empty {
    text-align:center; padding:50px 20px;
    animation:fadeIn 0.5s ease;
}
.db-empty-icon {
    width:60px; height:60px; display:flex; align-items:center; justify-content:center;
    margin:0 auto 12px;
    background:rgba(255,255,255,0.03);
    border:1px solid rgba(255,255,255,0.05);
    border-radius:16px; font-size:1.6rem; color:rgba(255,255,255,0.08);
}
.db-empty-title { font-size:1rem; font-weight:700; color:var(--clr-text); margin-bottom:4px; }
.db-empty-desc { font-size:0.82rem; color:var(--clr-muted); max-width:320px; margin:0 auto; }

/* ===== TABLE ===== */
.db-table-wrap { overflow-x:auto; }
.db-table { width:100%; border-collapse:collapse; font-size:0.85rem; }
.db-th {
    text-align:left; padding:14px 18px; font-weight:600; font-size:0.75rem;
    color:var(--clr-muted); text-transform:uppercase; letter-spacing:0.5px;
    background:rgba(255,255,255,0.02);
    border-bottom:1px solid rgba(255,255,255,0.04);
    white-space:nowrap;
}
.db-tr { transition:background 0.3s ease; }
.db-tr:hover { background:var(--clr-hover); }
.db-td {
    padding:14px 18px; color:var(--clr-text); vertical-align:middle;
    border-bottom:1px solid rgba(255,255,255,0.03);
}
.db-td-name { display:flex; align-items:center; gap:10px; }
.db-avatar {
    width:34px; height:34px; border-radius:50%;
    background:linear-gradient(135deg,var(--clr-primary),var(--clr-dark));
    display:flex; align-items:center; justify-content:center;
    font-size:0.75rem; font-weight:700; color:#fff; flex-shrink:0;
}
.db-email-link { color:var(--clr-primary); text-decoration:none; font-weight:500; transition:color 0.3s; }
.db-email-link:hover { color:var(--clr-light); text-decoration:underline; }

.db-view-btn {
    display:inline-flex; align-items:center; gap:5px;
    padding:5px 13px; font-size:0.78rem; font-weight:600;
    background:rgba(37,99,235,0.08);
    border:1px solid rgba(37,99,235,0.12);
    border-radius:8px; color:var(--clr-light);
    cursor:pointer; transition:all 0.3s ease; font-family:var(--font);
}
.db-view-btn:hover { background:rgba(37,99,235,0.15); transform:translateY(-1px); }

.db-action-btn {
    width:34px; height:34px; display:flex; align-items:center; justify-content:center;
    background:rgba(255,255,255,0.04);
    border:1px solid rgba(255,255,255,0.06);
    border-radius:8px; color:var(--clr-muted);
    cursor:pointer; transition:all 0.3s ease; font-size:0.9rem; text-decoration:none;
}
.db-action-btn:hover { background:var(--clr-hover); color:var(--clr-light); }

/* Status badge */
.db-status {
    display:inline-flex; align-items:center; gap:5px;
    padding:3px 12px; border-radius:20px;
    font-size:0.72rem; font-weight:700; text-transform:capitalize;
}
.db-status-pending { background:rgba(245,158,11,0.1); color:#F59E0B; border:1px solid rgba(245,158,11,0.15); }
.db-status-processing { background:rgba(37,99,235,0.1); color:#60A5FA; border:1px solid rgba(37,99,235,0.15); }
.db-status-completed { background:rgba(16,185,129,0.1); color:#10b981; border:1px solid rgba(16,185,129,0.15); }
.db-status-cancelled { background:rgba(239,68,68,0.1); color:#f87171; border:1px solid rgba(239,68,68,0.15); }

/* ===== TWO-COLUMN GRID ===== */
.db-grid-2 {
    display:grid; grid-template-columns:1fr 1fr; gap:20px;
    position:relative; z-index:5; margin-bottom:20px;
}

/* ===== QUICK ACTIONS ===== */
.db-actions {
    display:grid; grid-template-columns:1fr 1fr; gap:12px; padding:20px 24px;
}
.db-action-item {
    display:flex; align-items:center; gap:14px;
    padding:16px 18px;
    background:rgba(255,255,255,0.02);
    border:1px solid rgba(255,255,255,0.05);
    border-radius:12px;
    text-decoration:none; color:var(--clr-text);
    transition:all 0.3s cubic-bezier(.16,1,.3,1);
}
.db-action-item:hover {
    background:rgba(37,99,235,0.06);
    border-color:rgba(37,99,235,0.15);
    transform:translateY(-2px);
    box-shadow:0 8px 24px rgba(0,0,0,0.15);
}
.db-action-icon {
    width:40px; height:40px; display:flex; align-items:center; justify-content:center;
    border-radius:10px; font-size:1.1rem; flex-shrink:0;
}
.db-action-info { flex:1; }
.db-action-title { font-size:0.88rem; font-weight:600; color:var(--clr-text); margin-bottom:1px; }
.db-action-desc { font-size:0.75rem; color:var(--clr-muted); }
.db-action-arrow { color:var(--clr-muted); font-size:0.85rem; transition:transform 0.3s ease; }
.db-action-item:hover .db-action-arrow { transform:translateX(3px); color:var(--clr-light); }

/* ===== MODAL ===== */
.db-modal-content {
    background:#1e293b;
    border:1px solid rgba(255,255,255,0.06);
    border-radius:20px; overflow:hidden; box-shadow:0 24px 80px rgba(0,0,0,0.5);
}
.db-modal-header {
    display:flex; align-items:center; gap:14px;
    padding:20px 24px;
    border-bottom:1px solid rgba(255,255,255,0.04);
}
.db-modal-avatar {
    width:44px; height:44px; border-radius:50%;
    display:flex; align-items:center; justify-content:center;
    font-size:1rem; font-weight:700; color:#fff;
}
.db-modal-info { flex:1; }
.db-modal-name { font-size:1rem; font-weight:700; color:var(--clr-text); margin:0; }
.db-modal-email { font-size:0.8rem; color:var(--clr-muted); }
.db-modal-close {
    width:32px; height:32px; display:flex; align-items:center; justify-content:center;
    background:rgba(255,255,255,0.04); border:none; border-radius:8px;
    color:var(--clr-muted); cursor:pointer; transition:all 0.3s ease; font-size:0.8rem;
}
.db-modal-close:hover { background:rgba(255,255,255,0.08); color:var(--clr-text); }
.db-modal-body { padding:24px; }
.db-modal-meta {
    display:flex; gap:20px; margin-bottom:14px; font-size:0.8rem; color:var(--clr-muted);
}
.db-modal-meta i { margin-right:5px; color:var(--clr-primary); }
.db-modal-divider { height:1px; background:rgba(255,255,255,0.04); margin-bottom:16px; }
.db-modal-text { font-size:0.92rem; line-height:1.7; color:var(--clr-text); margin:0; }
.db-modal-footer {
    display:flex; justify-content:flex-end; gap:10px;
    padding:16px 24px;
    border-top:1px solid rgba(255,255,255,0.04);
}
.db-btn-secondary {
    padding:9px 20px; font-size:0.82rem; font-weight:600;
    background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.06);
    border-radius:10px; color:var(--clr-muted); cursor:pointer;
    font-family:var(--font); transition:all 0.3s ease; text-decoration:none;
}
.db-btn-secondary:hover { background:rgba(255,255,255,0.08); color:var(--clr-text); }
.db-btn-primary {
    display:inline-flex; align-items:center; gap:6px;
    padding:9px 20px; font-size:0.82rem; font-weight:600;
    background:linear-gradient(135deg,var(--clr-primary),var(--clr-dark));
    border:none; border-radius:10px; color:#fff; cursor:pointer;
    text-decoration:none; font-family:var(--font);
    transition:all 0.3s ease; box-shadow:0 4px 12px rgba(37,99,235,0.25);
}
.db-btn-primary:hover { transform:translateY(-1px); box-shadow:0 6px 20px rgba(37,99,235,0.35); }

/* ===== RESPONSIVE ===== */
@media (max-width: 1200px) {
    .db-stats { grid-template-columns:repeat(3,1fr); }
    .db-grid-2 { grid-template-columns:1fr; }
}
@media (max-width: 992px) {
    .db-page { padding:20px 16px; }
    .db-stats { grid-template-columns:repeat(2,1fr); }
    .db-header-content { flex-direction:column; align-items:flex-start; }
    .db-header-right { width:100%; justify-content:space-around; }
    .db-header-stat { min-width:0; flex:1; }
    .db-actions { grid-template-columns:1fr; }
}
@media (max-width: 640px) {
    .db-page { padding:16px 12px; }
    .db-header { padding:20px 18px; border-radius:16px; }
    .db-admin-logo-img, .db-admin-logo-fallback { width:48px; height:48px; font-size:1.2rem; }
    .db-header-title { font-size:1.25rem; }
    .db-header-left { gap:14px; }
    .db-header-right { gap:8px; flex-wrap:wrap; }
    .db-header-stat { padding:8px 12px; flex:1; min-width:60px; }
    .db-header-stat-num { font-size:1.1rem; }
    .db-stats { grid-template-columns:1fr; gap:12px; }
    .db-section-header { flex-direction:column; align-items:flex-start; }
    .db-section-header-left { gap:10px; }
    .db-section { border-radius:14px; }
    .db-section-header { padding:16px 18px; }
    .db-stat-card { padding:16px 18px; }
    .db-stat-value { font-size:1.5rem; }
    .db-actions { padding:16px 18px; }
    .db-actions { grid-template-columns:1fr; }
    .db-action-item { padding:14px 16px; }
}
@media (max-width: 480px) {
    .db-page { padding:12px 10px; }
    .db-header { padding:16px 14px; border-radius:14px; }
    .db-header-content { gap:16px; }
    .db-header-left { flex-direction:column; align-items:flex-start; gap:12px; }
    .db-admin-logo-img, .db-admin-logo-fallback { width:44px; height:44px; font-size:1.1rem; }
    .db-header-title { font-size:1.1rem; }
    .db-header-sub { font-size:0.8rem; }
    .db-header-right { width:100%; }
    .db-greeting { font-size:0.72rem; }
    .db-stat-card { padding:14px 16px; border-radius:14px; }
    .db-stat-value { font-size:1.35rem; }
    .db-stat-icon { width:38px; height:38px; font-size:1rem; }
    .db-section { border-radius:12px; margin-bottom:14px; }
    .db-section-header { padding:14px 16px; }
    .db-section-title { font-size:0.95rem; }
    .db-section-sub { font-size:0.72rem; }
    .db-section-link { font-size:0.75rem; padding:5px 10px; }
    .db-th { padding:10px 12px; font-size:0.7rem; }
    .db-td { padding:10px 12px; font-size:0.8rem; }
    .db-avatar { width:28px; height:28px; font-size:0.65rem; }
    .db-action-item { padding:12px 14px; border-radius:10px; }
    .db-action-icon { width:34px; height:34px; font-size:0.95rem; }
    .db-action-title { font-size:0.82rem; }
    .db-action-desc { font-size:0.7rem; }
}
</style>

<div class="db-page">

    {{-- BG Orbs --}}
    <div class="db-orb db-orb-1"></div>
    <div class="db-orb db-orb-2"></div>
    <div class="db-orb db-orb-3"></div>
    <div class="db-orb db-orb-4"></div>

    {{-- Particles --}}
    <div class="db-particles" id="dbParticles"></div>

    {{-- ===================== HEADER ===================== --}}
    <div class="db-header">
        <div class="db-header-bg"></div>
        <div class="db-header-glow"></div>
        <div class="db-header-content">
            <div class="db-header-left">
                <div class="db-admin-logo">
                    @php
                        $admin = Auth::user();
                        $adminInitial = $admin ? strtoupper(substr($admin->name ?? 'A', 0, 1)) : 'A';
                    @endphp
                    <div class="db-admin-logo-fallback">{{ $adminInitial }}</div>
                    <div class="db-admin-logo-dot"></div>
                </div>
                <div>
                    <div class="db-greeting">
                        <span class="db-greeting-dot"></span>
                        @php
                            $hour = now()->format('H');
                            $greeting = 'Good Evening';
                            if ((int)$hour < 12) $greeting = 'Good Morning';
                            elseif ((int)$hour < 17) $greeting = 'Good Afternoon';
                        @endphp
                        {{ $greeting }}, Admin
                    </div>
                    <h1 class="db-header-title">
                        Welcome back, <span class="db-header-name">{{ $admin->name ?? 'Admin' }}</span>
                    </h1>
                    <p class="db-header-sub">
                        Here's what's happening with your site today.
                    </p>
                </div>
            </div>
            <div class="db-header-right">
                <div class="db-header-stat">
                    <span class="db-header-stat-num">{{ $totalOrders }}</span>
                    <span class="db-header-stat-label">Total Orders</span>
                </div>
                <div class="db-header-stat">
                    <span class="db-header-stat-num" style="color:var(--clr-accent-green)">{{ $pendingOrders }}</span>
                    <span class="db-header-stat-label">Pending</span>
                </div>
                <div class="db-header-stat">
                    <span class="db-header-stat-num" style="color:var(--clr-accent-purple)">{{ $totalContacts }}</span>
                    <span class="db-header-stat-label">Messages</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== STAT CARDS ===================== --}}
    <div class="db-stats">

        {{-- Contacts --}}
        <div class="db-stat-card" style="--accent:#60A5FA;--accent-bg:rgba(96,165,250,0.1);--accent-border:rgba(96,165,250,0.15);">
            <div class="db-stat-inner">
                <div class="db-stat-top">
                    <div class="db-stat-icon"><i class="bi bi-envelope-fill"></i></div>
                    <span class="db-stat-badge">Inbox</span>
                </div>
                <span class="db-stat-value">{{ $totalContacts }}</span>
                <span class="db-stat-label">Contact Messages</span>
            </div>
        </div>

        {{-- Orders --}}
        <div class="db-stat-card" style="--accent:#00FF9F;--accent-bg:rgba(0,255,159,0.08);--accent-border:rgba(0,255,159,0.12);">
            <div class="db-stat-inner">
                <div class="db-stat-top">
                    <div class="db-stat-icon" style="color:var(--clr-accent-green)"><i class="bi bi-bag-fill"></i></div>
                    <span class="db-stat-badge" style="color:var(--clr-accent-green);background:rgba(0,255,159,0.08);border-color:rgba(0,255,159,0.12);">{{ $pendingOrders }} pending</span>
                </div>
                <span class="db-stat-value">{{ $totalOrders }}</span>
                <span class="db-stat-label">Total Orders</span>
            </div>
        </div>

        {{-- Products --}}
        <div class="db-stat-card" style="--accent:#A855F7;--accent-bg:rgba(168,85,247,0.1);--accent-border:rgba(168,85,247,0.15);">
            <div class="db-stat-inner">
                <div class="db-stat-top">
                    <div class="db-stat-icon" style="color:var(--clr-accent-purple)"><i class="bi bi-box-seam-fill"></i></div>
                    <span class="db-stat-badge" style="color:var(--clr-accent-purple);background:rgba(168,85,247,0.08);border-color:rgba(168,85,247,0.12);">Products</span>
                </div>
                <span class="db-stat-value">{{ $totalProducts }}</span>
                <span class="db-stat-label">Products</span>
            </div>
        </div>

        {{-- Source Codes --}}
        <div class="db-stat-card" style="--accent:#F59E0B;--accent-bg:rgba(245,158,11,0.1);--accent-border:rgba(245,158,11,0.15);">
            <div class="db-stat-inner">
                <div class="db-stat-top">
                    <div class="db-stat-icon" style="color:var(--clr-accent-amber)"><i class="bi bi-code-slash"></i></div>
                    <span class="db-stat-badge" style="color:var(--clr-accent-amber);background:rgba(245,158,11,0.08);border-color:rgba(245,158,11,0.12);">Code</span>
                </div>
                <span class="db-stat-value">{{ $totalSourceCodes }}</span>
                <span class="db-stat-label">Source Codes</span>
            </div>
        </div>

        {{-- Partners --}}
        <div class="db-stat-card" style="--accent:#F43F5E;--accent-bg:rgba(244,63,94,0.1);--accent-border:rgba(244,63,94,0.15);">
            <div class="db-stat-inner">
                <div class="db-stat-top">
                    <div class="db-stat-icon" style="color:var(--clr-accent-rose)"><i class="bi bi-people-fill"></i></div>
                    <span class="db-stat-badge" style="color:var(--clr-accent-rose);background:rgba(244,63,94,0.08);border-color:rgba(244,63,94,0.12);">Partners</span>
                </div>
                <span class="db-stat-value">{{ $totalPartners }}</span>
                <span class="db-stat-label">Partnerships</span>
            </div>
        </div>

    </div>

    {{-- ===================== TWO-COLUMN GRID ===================== --}}
    <div class="db-grid-2">

        {{-- === RECENT MESSAGES === --}}
        <div class="db-section">
            <div class="db-section-header">
                <div class="db-section-header-left">
                    <div class="db-section-icon"><i class="bi bi-chat-dots"></i></div>
                    <div>
                        <h2 class="db-section-title">Recent Messages</h2>
                        <p class="db-section-sub">Latest inquiries from the contact form.</p>
                    </div>
                </div>
                <a href="{{ route('admin.contact') }}" class="db-section-link">
                    View all <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            @if($contacts->isEmpty())
                <div class="db-empty">
                    <div class="db-empty-icon"><i class="bi bi-inbox"></i></div>
                    <h3 class="db-empty-title">No messages yet</h3>
                    <p class="db-empty-desc">Messages from the contact form will appear here.</p>
                </div>
            @else
                <div class="db-table-wrap">
                    <table class="db-table">
                        <thead>
                            <tr>
                                <th class="db-th">Name</th>
                                <th class="db-th">Email</th>
                                <th class="db-th">Message</th>
                                <th class="db-th">Date</th>
                                <th class="db-th" style="text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                                <tr class="db-tr">
                                    <td class="db-td">
                                        <div class="db-td-name">
                                            <div class="db-avatar">
                                                {{ strtoupper(substr($contact->name, 0, 1)) }}
                                            </div>
                                            <span>{{ $contact->name }}</span>
                                        </div>
                                    </td>
                                    <td class="db-td">
                                        <a href="mailto:{{ $contact->email }}" class="db-email-link">{{ $contact->email }}</a>
                                    </td>
                                    <td class="db-td">
                                        <button class="db-view-btn" data-modal-target="msgModal{{ $contact->id }}">
                                            <i class="bi bi-eye"></i> View
                                        </button>
                                    </td>
                                    <td class="db-td" style="white-space:nowrap;color:var(--clr-muted);font-size:0.8rem;">
                                        {{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('d M Y, h:i A') }}
                                    </td>
                                    <td class="db-td" style="text-align:center">
                                        <button class="db-action-btn" data-modal-target="msgModal{{ $contact->id }}" title="View message">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach                    </tbody>
                </table>
            </div>
            @endif
        </div>

        {{-- === RECENT ORDERS === --}}
        <div class="db-section">
            <div class="db-section-header">
                <div class="db-section-header-left">
                    <div class="db-section-icon" style="background:rgba(0,255,159,0.08);border-color:rgba(0,255,159,0.1);color:var(--clr-accent-green)"><i class="bi bi-bag-fill"></i></div>
                    <div>
                        <h2 class="db-section-title">Recent Orders</h2>
                        <p class="db-section-sub">Latest orders from customers.</p>
                    </div>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="db-section-link">
                    View all <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            @if($recentOrders->isEmpty())
                <div class="db-empty">
                    <div class="db-empty-icon"><i class="bi bi-cart-x"></i></div>
                    <h3 class="db-empty-title">No orders yet</h3>
                    <p class="db-empty-desc">Customer orders will appear here once they start coming in.</p>
                </div>
            @else
                <div class="db-table-wrap">
                    <table class="db-table">
                        <thead>
                            <tr>
                                <th class="db-th">Order #</th>
                                <th class="db-th">Customer</th>
                                <th class="db-th">Total</th>
                                <th class="db-th">Status</th>
                                <th class="db-th" style="text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                                <tr class="db-tr">
                                    <td class="db-td" style="font-weight:600;font-family:'JetBrains Mono',monospace;font-size:0.8rem;">
                                        {{ $order->order_number ?? '#' . $order->id }}
                                    </td>
                                    <td class="db-td">
                                        <div class="db-td-name">
                                            @php
                                                $initial = strtoupper(substr($order->customer_name ?? 'U', 0, 1));
                                            @endphp
                                            <div class="db-avatar" style="background:linear-gradient(135deg,#0EA5E9,#0284C7);width:30px;height:30px;font-size:0.65rem;">
                                                {{ $initial }}
                                            </div>
                                            <div>
                                                <span style="font-weight:500">{{ $order->customer_name ?? 'Unknown' }}</span>
                                                @if($order->customer_email)
                                                    <br><span style="font-size:0.72rem;color:var(--clr-muted)">{{ $order->customer_email }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="db-td" style="font-weight:700;font-family:'JetBrains Mono',monospace;">
                                        ${{ number_format((float)$order->total, 2) }}
                                    </td>
                                    <td class="db-td">
                                        <span class="db-status db-status-{{ $order->status ?? 'pending' }}">
                                            @if(($order->status ?? 'pending') == 'pending')
                                                <i class="bi bi-clock-history"></i>
                                            @elseif($order->status == 'processing')
                                                <i class="bi bi-arrow-repeat"></i>
                                            @elseif($order->status == 'completed')
                                                <i class="bi bi-check-circle"></i>
                                            @elseif($order->status == 'cancelled')
                                                <i class="bi bi-x-circle"></i>
                                            @endif
                                            {{ $order->status ?? 'pending' }}
                                        </span>
                                    </td>
                                    <td class="db-td" style="text-align:center">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="db-action-btn" title="View order">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>

    {{-- Modals (placed outside .db-section to avoid overflow:hidden clipping of Bootstrap modal backdrop) --}}
    @if(!$contacts->isEmpty())
        @foreach($contacts as $contact)
            <div class="modal fade" id="msgModal{{ $contact->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content db-modal-content">
                        <div class="db-modal-header">
                            <div class="db-modal-avatar" style="background:linear-gradient(135deg,#2563EB,#1E40AF);">
                                {{ strtoupper(substr($contact->name, 0, 1)) }}
                            </div>
                            <div class="db-modal-info">
                                <h5 class="db-modal-name">{{ $contact->name }}</h5>
                                <span class="db-modal-email">{{ $contact->email }}</span>
                            </div>
                            <button type="button" class="db-modal-close" data-bs-dismiss="modal">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                        <div class="db-modal-body">
                            <div class="db-modal-meta">
                                <span><i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('d M Y') }}</span>
                                <span><i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('h:i A') }}</span>
                            </div>
                            <div class="db-modal-divider"></div>
                            <p class="db-modal-text">{{ $contact->message }}</p>
                        </div>
                        <div class="db-modal-footer">
                            <button type="button" class="db-btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    {{-- ===================== QUICK ACTIONS ===================== --}}
    <div class="db-section">
        <div class="db-section-header">
            <div class="db-section-header-left">
                <div class="db-section-icon" style="background:rgba(168,85,247,0.08);border-color:rgba(168,85,247,0.1);color:var(--clr-accent-purple)"><i class="bi bi-lightning-fill"></i></div>
                <div>
                    <h2 class="db-section-title">Quick Actions</h2>
                    <p class="db-section-sub">Manage your site content in a few clicks.</p>
                </div>
            </div>
        </div>
        <div class="db-actions">
            <a href="{{ route('admin.products.index') }}" class="db-action-item">
                <div class="db-action-icon" style="background:rgba(96,165,250,0.1);color:#60A5FA;"><i class="bi bi-box-seam-fill"></i></div>
                <div class="db-action-info">
                    <div class="db-action-title">Manage Products</div>
                    <div class="db-action-desc">Add, edit or remove products</div>
                </div>
                <i class="bi bi-chevron-right db-action-arrow"></i>
            </a>
            <a href="{{ route('admin.source-codes.index') }}" class="db-action-item">
                <div class="db-action-icon" style="background:rgba(245,158,11,0.1);color:#F59E0B;"><i class="bi bi-code-slash"></i></div>
                <div class="db-action-info">
                    <div class="db-action-title">Manage Source Codes</div>
                    <div class="db-action-desc">Add, edit or remove source codes</div>
                </div>
                <i class="bi bi-chevron-right db-action-arrow"></i>
            </a>
            <a href="{{ route('admin.orders.index') }}" class="db-action-item">
                <div class="db-action-icon" style="background:rgba(0,255,159,0.08);color:#00FF9F;"><i class="bi bi-bag-fill"></i></div>
                <div class="db-action-info">
                    <div class="db-action-title">View Orders</div>
                    <div class="db-action-desc">Track and manage customer orders</div>
                </div>
                <i class="bi bi-chevron-right db-action-arrow"></i>
            </a>
            <a href="{{ route('admin.partners.index') }}" class="db-action-item">
                <div class="db-action-icon" style="background:rgba(244,63,94,0.1);color:#F43F5E;"><i class="bi bi-people-fill"></i></div>
                <div class="db-action-info">
                    <div class="db-action-title">Manage Partners</div>
                    <div class="db-action-desc">Review and manage partnership requests</div>
                </div>
                <i class="bi bi-chevron-right db-action-arrow"></i>
            </a>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== PARTICLES =====
    const pc = document.getElementById('dbParticles');
    if (pc) {
        for (let i = 0; i < 25; i++) {
            const p = document.createElement('div');
            p.className = 'db-p';
            const s = Math.random() * 3 + 2;
            p.style.cssText = `
                width:${s}px;height:${s}px;
                left:${Math.random() * 100}%;
                animation-duration:${Math.random() * 14 + 10}s;
                animation-delay:${Math.random() * 5}s;
                bottom:-10px;
                opacity:${Math.random() * 0.35 + 0.1};
            `;
            pc.appendChild(p);
        }
    }

    // ===== STAGGER ANIMATIONS =====
    const statCards = document.querySelectorAll('.db-stat-card');
    statCards.forEach((el, i) => {
        el.style.animation = `fadeUp 0.6s cubic-bezier(.16,1,.3,1) ${0.2 + i * 0.08}s forwards`;
        el.style.opacity = '0';
    });

    const sections = document.querySelectorAll('.db-section');
    sections.forEach((el, i) => {
        el.style.animation = `slideUp 0.6s cubic-bezier(.16,1,.3,1) ${0.5 + i * 0.12}s forwards`;
        el.style.opacity = '0';
    });

    // ===== MODAL INITIALIZATION =====
    document.querySelectorAll('[data-modal-target]').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var modalId = this.getAttribute('data-modal-target');
            var modalEl = document.getElementById(modalId);
            if (modalEl) {
                if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    var modal = bootstrap.Modal.getInstance(modalEl);
                    if (!modal) {
                        modal = new bootstrap.Modal(modalEl, {
                            backdrop: true,
                            keyboard: true
                        });
                    }
                    modal.show();
                } else {
                    modalEl.classList.add('show');
                    modalEl.style.display = 'block';
                }
            }
        });
    });

    document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var modalEl = this.closest('.modal');
            if (modalEl) {
                if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    var modal = bootstrap.Modal.getInstance(modalEl);
                    if (modal) modal.hide();
                } else {
                    modalEl.classList.remove('show');
                    modalEl.style.display = 'none';
                }
            }
        });
    });
});
</script>

@endsection
