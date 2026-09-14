<?php
// DISPATCH Feedback Hub — view all documentation feedback
// Reads from data/feedback.json via the feedback API

// Security headers
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('X-XSS-Protection: 1; mode=block');
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src https://fonts.gstatic.com; img-src 'self' data:; connect-src 'self';");

$site = 'DISPATCH';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="favicon.svg?v=2">
    <link rel="shortcut icon" href="favicon.svg?v=2">
    <title><?php echo $site; ?> Feedback Hub</title>
    <script>
        (function(){try{var t=localStorage.getItem('dispatch-theme');if(t==='light'){document.documentElement.classList.add('light');}else{document.documentElement.classList.remove('light');}}catch(e){}})();
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/dispatch-ui.css">
    <link rel="stylesheet" href="css/dispatch.css?v=1">
    <link rel="stylesheet" href="css/loaders.css?v=4">
    <style>
        :root {
            --bg: #0b0f19;
            --bg-2: #121929;
            --surface: rgba(17, 24, 45, 0.72);
            --surface-solid: #11182d;
            --surface-2: #182240;
            --border: rgba(255,255,255,0.08);
            --border-strong: rgba(255,255,255,0.14);
            --text: #f3f4f6;
            --text-muted: #9aa3b2;
            --text-dim: #6b7280;
            --accent: #10b981;
            --accent-2: #34d399;
            --accent-soft: rgba(16, 185, 129, 0.14);
            --danger: #f87171;
            --warn: #f59e0b;
            --warn-soft: rgba(245, 158, 11, 0.12);
            --info: #3b82f6;
            --radius: 20px;
            --shadow: 0 24px 50px -20px rgba(0,0,0,0.45);
        }
        html.light {
            --bg: #f8fafc;
            --bg-2: #ffffff;
            --surface: rgba(255,255,255,0.82);
            --surface-solid: #ffffff;
            --surface-2: #f1f5f9;
            --border: rgba(0,0,0,0.08);
            --border-strong: rgba(0,0,0,0.14);
            --text: #0f172a;
            --text-muted: #475569;
            --text-dim: #64748b;
            --accent-soft: rgba(16, 185, 129, 0.12);
        }
        /* Theme button — matches video_docs.php */
        .theme-btn {
            width: 40px; height: 40px;
            display: grid; place-items: center;
            border: 1px solid var(--border-strong);
            background: color-mix(in srgb, var(--accent) 10%, transparent);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            color: var(--accent);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.18s ease;
        }
        .theme-btn:hover {
            background: linear-gradient(135deg, color-mix(in srgb, var(--accent) 22%, transparent), color-mix(in srgb, var(--accent) 18%, transparent));
            border-color: var(--border-strong);
            box-shadow: 0 0 16px color-mix(in srgb, var(--accent) 45%, transparent);
            transform: translateY(-2px) scale(1.05);
            color: #fff;
        }
        .theme-btn svg { width: 18px; height: 18px; }
        .theme-btn[title] { position: relative; }
        .theme-btn[title]::after {
            content: attr(title);
            position: absolute; top: calc(100% + 8px); left: 50%;
            transform: translateX(-50%) translateY(-6px);
            padding: 0.35rem 0.65rem;
            background: var(--surface-solid); color: var(--text);
            border: 1px solid var(--border); border-radius: 6px;
            font-size: 0.7rem; font-weight: 600; white-space: nowrap;
            opacity: 0; pointer-events: none;
            transition: all 0.18s ease; z-index: 300;
        }
        .theme-btn[title]:hover::after { opacity: 1; transform: translateX(-50%) translateY(0); }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Poppins', sans-serif;
            background:
                radial-gradient(ellipse at 10% 10%, color-mix(in srgb, var(--accent-2) 25%, transparent), transparent 50%),
                radial-gradient(ellipse at 90% 20%, color-mix(in srgb, var(--accent) 18%, transparent), transparent 50%),
                radial-gradient(ellipse at 50% 100%, color-mix(in srgb, var(--accent) 15%, transparent), transparent 45%),
                linear-gradient(160deg, var(--bg) 0%, var(--bg-2) 55%, var(--bg) 100%);
            background-attachment: fixed;
            color: var(--text);
            min-height: 100vh;
            -webkit-tap-highlight-color: transparent;
        }
        a, button { -webkit-tap-highlight-color: transparent; touch-action: manipulation; }
        html.light body {
            background:
                radial-gradient(ellipse at 10% 10%, color-mix(in srgb, var(--accent-2) 18%, transparent), transparent 50%),
                radial-gradient(ellipse at 90% 20%, color-mix(in srgb, var(--accent) 12%, transparent), transparent 50%),
                radial-gradient(ellipse at 50% 100%, color-mix(in srgb, var(--accent) 10%, transparent), transparent 45%),
                linear-gradient(160deg, #f8fafc 0%, #ffffff 55%, #f1f5f9 100%);
        }
        .page { max-width: 900px; margin: 0 auto; padding: 1.5rem; padding-top: 5rem; }

        /* ===== Topbar — matches video_docs.php ===== */
        .topbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 200;
            display: flex; align-items: center; gap: 1rem;
            padding: 0.85rem 2rem;
            background: color-mix(in srgb, var(--surface-solid) 72%, transparent);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid color-mix(in srgb, var(--border) 60%, transparent);
        }
        .brand { display: flex; align-items: center; gap: 0.75rem; }
        .brand a { display: flex; align-items: center; gap: 0.75rem; color: var(--text); text-decoration: none; }
        .brand-icon {
            width: 42px; height: 42px; border-radius: 12px;
            display: grid; place-items: center; color: #fff;
            border: 1px solid color-mix(in srgb, var(--accent) 60%, transparent);
            background: linear-gradient(135deg, var(--accent), color-mix(in srgb, var(--accent) 70%, #0ea371));
            box-shadow: 0 6px 18px -8px color-mix(in srgb, var(--accent) 70%, transparent),
                        inset 0 1px 0 rgba(255,255,255,0.18);
            transition: transform 0.18s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.18s ease, filter 0.18s ease;
        }
        .brand a:hover .brand-icon {
            transform: translateY(-2px) scale(1.05); filter: brightness(1.06);
            box-shadow: 0 10px 24px -8px color-mix(in srgb, var(--accent) 80%, transparent),
                        inset 0 1px 0 rgba(255,255,255,0.22);
        }
        .brand-icon:active { transform: translateY(0) scale(0.98); }
        .brand-icon svg { width: 20px; height: 20px; }
        .brand-text { display: flex; flex-direction: column; line-height: 1.15; }
        .brand-text h1 { font-size: 1.15rem; font-weight: 800; letter-spacing: -0.01em; line-height: 1.1; }
        .brand-text p { font-size: 0.72rem; color: var(--text-dim); font-weight: 500; }
        .topbar-actions { margin-left: auto; display: flex; align-items: center; gap: 0.6rem; }
        .back-home-btn {
            display: grid; place-items: center;
            width: 38px; height: 38px;
            border: 1px solid color-mix(in srgb, #ef4444 40%, transparent);
            border-radius: 50%;
            background: color-mix(in srgb, #ef4444 8%, transparent);
            color: #ef4444; text-decoration: none; font-family: inherit;
            transition: border-color 0.25s ease, color 0.25s ease, background 0.25s ease, box-shadow 0.25s ease, transform 0.25s ease;
        }
        .back-home-btn svg { width: 18px; height: 18px; flex-shrink: 0; transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); }
        .back-home-btn:hover {
            border-color: #ef4444; background: color-mix(in srgb, #ef4444 15%, transparent); color: #ef4444;
            box-shadow: 0 0 14px -4px color-mix(in srgb, #ef4444 50%, transparent); transform: rotate(90deg);
        }
        .back-home-btn:active { transform: scale(0.92); }
        .theme-btn.shortcut-btn {
            color: var(--accent);
            border-color: color-mix(in srgb, var(--accent) 35%, transparent);
            background: color-mix(in srgb, var(--accent) 10%, transparent);
        }
        .theme-btn.shortcut-btn:hover {
            background: linear-gradient(135deg, color-mix(in srgb, var(--accent) 22%, transparent), color-mix(in srgb, var(--accent) 18%, transparent));
            border-color: color-mix(in srgb, var(--accent) 70%, transparent);
            box-shadow: 0 0 16px color-mix(in srgb, var(--accent) 45%, transparent);
            transform: translateY(-2px) scale(1.05); color: #fff;
        }

        /* ===== Section header ===== */
        .fb-section-head {
            display: flex; align-items: center; justify-content: space-between;
            gap: 1rem; flex-wrap: wrap; margin-bottom: 1.5rem;
        }
        .fb-section-title {
            display: flex; align-items: center; gap: 0.6rem;
            font-size: 1.3rem; font-weight: 800; letter-spacing: -0.02em;
        }
        .fb-section-title-icon {
            width: 36px; height: 36px; border-radius: 10px;
            display: grid; place-items: center;
            background: var(--accent-soft); color: var(--accent);
            flex-shrink: 0;
        }
        .fb-section-title-icon svg { width: 20px; height: 20px; }
        .fb-section-sub { font-size: 0.85rem; color: var(--text-muted); margin-top: 0.2rem; font-weight: 400; }

        /* ===== Summary strip ===== */
        .fb-summary {
            display: flex; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap;
        }
        .fb-pill {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.6rem 1.1rem;
            background: var(--surface); border: 1px solid var(--border);
            border-radius: 999px; backdrop-filter: blur(12px);
            font-size: 0.82rem; font-weight: 600; color: var(--text-muted);
            transition: border-color 0.2s ease;
        }
        .fb-pill:hover { border-color: var(--border-strong); }
        .fb-pill-num {
            font-size: 0.85rem; font-weight: 800; color: var(--text);
            font-variant-numeric: tabular-nums;
        }
        .fb-pill-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
        .fb-pill-dot.up { background: var(--accent); box-shadow: 0 0 8px color-mix(in srgb, var(--accent) 50%, transparent); }
        .fb-pill-dot.down { background: var(--warn); box-shadow: 0 0 8px color-mix(in srgb, var(--warn) 50%, transparent); }
        .fb-pill-dot.total { background: var(--accent-2); box-shadow: 0 0 8px color-mix(in srgb, var(--accent-2) 50%, transparent); }

        /* ===== Controls ===== */
        .fb-controls {
            display: flex; align-items: center; gap: 0.6rem; flex-wrap: wrap;
            margin-bottom: 1.25rem;
        }
        .fb-search {
            flex: 1; min-width: 200px;
            display: flex; align-items: center; gap: 0.55rem;
            background: var(--surface); border: 1px solid var(--border);
            border-radius: 12px; padding: 0.6rem 0.85rem;
            backdrop-filter: blur(12px);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .fb-search:focus-within {
            border-color: color-mix(in srgb, var(--accent) 50%, transparent);
            box-shadow: 0 0 0 3px var(--accent-soft);
        }
        .fb-search svg { width: 18px; height: 18px; color: var(--text-dim); flex-shrink: 0; }
        .fb-search input {
            flex: 1; border: none; outline: none;
            background: transparent; color: var(--text);
            font-family: inherit; font-size: 0.88rem;
        }
        .fb-search input::placeholder { color: var(--text-dim); }
        .fb-chips { display: flex; gap: 0.35rem; flex-wrap: wrap; }
        .fb-chip {
            font-family: inherit; padding: 0.5rem 0.9rem; border-radius: 999px;
            border: 1px solid var(--border); background: var(--surface-2);
            color: var(--text-muted); font-size: 0.78rem; font-weight: 600;
            cursor: pointer; transition: all 0.18s ease;
            display: inline-flex; align-items: center; gap: 0.35rem;
        }
        .fb-chip:hover { color: var(--text); transform: translateY(-1px); }
        .fb-chip.active {
            background: var(--accent); color: #fff; border-color: var(--accent);
            box-shadow: 0 2px 10px color-mix(in srgb, var(--accent) 30%, transparent);
        }
        .fb-chip.active.warn {
            background: var(--warn); border-color: var(--warn);
            box-shadow: 0 2px 10px color-mix(in srgb, var(--warn) 30%, transparent);
        }
        .fb-chip-count {
            font-size: 0.68rem; font-weight: 700;
            background: rgba(255,255,255,0.18);
            padding: 0.1rem 0.4rem; border-radius: 999px; min-width: 18px; text-align: center;
        }
        .fb-chip:not(.active) .fb-chip-count { background: var(--surface-2); color: var(--text-dim); }

        /* ===== Feedback list ===== */
        .fb-list { display: flex; flex-direction: column; gap: 0.65rem; }
        .fb-item {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: 16px; padding: 1.1rem 1.25rem;
            display: flex; gap: 0.85rem;
            backdrop-filter: blur(12px);
            transition: border-color 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
            animation: fbIn 0.35s cubic-bezier(0.4, 0, 0.2, 1) both;
            position: relative; overflow: hidden;
        }
        @keyframes fbIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .fb-item:hover { border-color: var(--border-strong); transform: translateY(-2px); box-shadow: var(--shadow); }
        .fb-item::before {
            content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px;
            background: var(--item-color, var(--accent));
        }
        .fb-item.up { --item-color: var(--accent); }
        .fb-item.down { --item-color: var(--warn); }
        .fb-vote {
            width: 40px; height: 40px; border-radius: 10px;
            display: grid; place-items: center; flex-shrink: 0;
            background: color-mix(in srgb, var(--item-color, var(--accent)) 12%, transparent);
            color: var(--item-color, var(--accent));
        }
        .fb-vote svg { width: 20px; height: 20px; }
        .fb-body { flex: 1; min-width: 0; }
        .fb-top { display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 0.3rem; }
        .fb-doc { font-size: 0.85rem; font-weight: 700; color: var(--text); }
        .fb-tag {
            font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;
            padding: 0.12rem 0.45rem; border-radius: 5px;
        }
        .fb-item.up .fb-tag { background: var(--accent-soft); color: var(--accent); }
        .fb-item.down .fb-tag { background: var(--warn-soft); color: var(--warn); }
        .fb-time { font-size: 0.73rem; color: var(--text-dim); margin-left: auto; }
        .fb-msg {
            font-size: 0.85rem; line-height: 1.55; color: var(--text-muted);
            white-space: pre-wrap; word-break: break-word;
            padding: 0.55rem 0.75rem; margin-top: 0.35rem;
            background: var(--surface-2); border-radius: 8px;
            border: 1px solid var(--border);
        }
        .fb-msg.empty { font-style: italic; color: var(--text-dim); background: transparent; border: 1px dashed var(--border); }
        .fb-meta { display: flex; align-items: center; gap: 0.5rem; margin-top: 0.5rem; font-size: 0.7rem; color: var(--text-dim); flex-wrap: wrap; }
        .fb-meta span { display: inline-flex; align-items: center; gap: 0.25rem; }
        .fb-meta svg { width: 12px; height: 12px; }

        /* ===== Empty / loading ===== */
        .fb-empty { text-align: center; padding: 3.5rem 2rem; color: var(--text-dim); }
        .fb-empty-icon {
            width: 72px; height: 72px; margin: 0 auto 1rem;
            border-radius: 50%; background: var(--surface-2);
            display: grid; place-items: center;
        }
        .fb-empty-icon svg { width: 32px; height: 32px; opacity: 0.4; }
        .fb-empty h3 { font-size: 1.05rem; font-weight: 700; color: var(--text-muted); margin-bottom: 0.25rem; }
        .fb-empty p { font-size: 0.82rem; }
        .fb-loading { text-align: center; padding: 2.5rem; color: var(--text-dim); font-size: 0.88rem; }
        .fb-loading::after {
            content: ''; display: inline-block; width: 16px; height: 16px;
            border: 2px solid var(--border-strong); border-top-color: var(--accent);
            border-radius: 50%; margin-left: 0.5rem;
            animation: spin 0.6s linear infinite; vertical-align: middle;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ===== Background canvas ===== */
        .bg-canvas { position: fixed; inset: 0; z-index: 0; pointer-events: none; overflow: hidden; }
        .bg-canvas svg { position: absolute; width: 100%; height: 100%; top: 0; left: 0; }

        /* ===== Responsive ===== */
        @media (max-width: 768px) {
            .page { padding: 1rem; padding-top: 5rem; }
            .topbar { padding: 0.85rem 1rem; }
            .brand-text h1 { font-size: 1rem; }
            .brand-text p { display: none; }
            .fb-section-title { font-size: 1.1rem; }
            .fb-controls { flex-direction: column; align-items: stretch; }
            .fb-chips { justify-content: center; }
            .fb-item { padding: 0.9rem; gap: 0.65rem; }
            .fb-vote { width: 34px; height: 34px; }
            .fb-vote svg { width: 17px; height: 17px; }
            .fb-time { margin-left: 0; width: 100%; }
        }
        @media (max-width: 400px) {
            .fb-summary { gap: 0.5rem; }
            .fb-pill { padding: 0.5rem 0.85rem; font-size: 0.78rem; }
        }
    </style>
    <link rel="preconnect" href="https://cdn.tailwindcss.com">
    <link rel="dns-prefetch" href="https://cdn.tailwindcss.com">
    <script src="https://cdn.tailwindcss.com" defer></script>
    <script src="js/tailwind-config.js" defer></script>
</head>
<body>
    <!-- ACD_TMS Curved Vector Background -->
    <div class="bg-canvas">
        <svg viewBox="0 0 1200 800" preserveAspectRatio="xMidYMid slice" id="bg-svg-dark" style="display: none;">
            <path d="M -72 696 C 168 576, 384 640, 600 536 C 816 432, 888 352, 1056 448 C 1200 536, 1224 624, 1320 552 L 1320 816 L -72 816 Z" fill="rgba(16,185,129,0.06)"/>
            <path d="M 744 -56 C 960 56, 1080 192, 1056 352 C 1032 520, 960 552, 1164 624 L 1320 568 L 1320 -56 Z" fill="rgba(16,185,129,0.07)"/>
            <path d="M -48 0 C 72 72, 204 32, 312 144 C 408 240, 384 376, 264 408 C 48 480, -48 424, -48 352 Z" fill="rgba(16,185,129,0.05)"/>
            <path d="M 84 728 C 276 624, 480 680, 636 568 C 816 440, 864 408, 1032 480" fill="none" stroke="rgba(16,185,129,0.12)" stroke-width="1.4"/>
            <path d="M -36 496 C 144 424, 312 480, 480 392 C 672 248, 792 280, 840 288" fill="none" stroke="rgba(16,185,129,0.08)" stroke-width="1"/>
            <circle cx="696" cy="160" r="78" fill="rgba(16,185,129,0.05)"/>
            <circle cx="132" cy="608" r="50" fill="rgba(16,185,129,0.05)"/>
            <circle cx="468" cy="728" r="34" fill="rgba(16,185,129,0.05)"/>
        </svg>
        <svg viewBox="0 0 1200 800" preserveAspectRatio="xMidYMid slice" id="bg-svg-light" style="display: none;">
            <path d="M -72 696 C 168 576, 384 640, 600 536 C 816 432, 888 352, 1056 448 C 1200 536, 1224 624, 1320 552 L 1320 816 L -72 816 Z" fill="rgba(16,185,129,0.08)"/>
            <path d="M 744 -56 C 960 56, 1080 192, 1056 352 C 1032 520, 960 552, 1164 624 L 1320 568 L 1320 -56 Z" fill="rgba(14,163,113,0.08)"/>
            <path d="M -48 0 C 72 72, 204 32, 312 144 C 408 240, 384 376, 264 408 C 48 480, -48 424, -48 352 Z" fill="rgba(16,185,129,0.06)"/>
            <path d="M 84 728 C 276 624, 480 680, 636 568 C 816 440, 864 408, 1032 480" fill="none" stroke="rgba(16,185,129,0.12)" stroke-width="1.4"/>
            <path d="M -36 496 C 144 424, 312 480, 480 392 C 672 248, 792 280, 840 288" fill="none" stroke="rgba(16,185,129,0.08)" stroke-width="1"/>
            <circle cx="696" cy="160" r="78" fill="rgba(16,185,129,0.05)"/>
            <circle cx="132" cy="608" r="50" fill="rgba(16,185,129,0.05)"/>
            <circle cx="468" cy="728" r="34" fill="rgba(16,185,129,0.05)"/>
        </svg>
    </div>

    <!-- Loading Screen -->
    <div class="loader-screen loader-screen--home" id="loader-screen">
        <div class="loader-visual">
            <div class="loader-speed"></div>
            <div class="loader-truck">
                <div class="loader-wheel loader-wheel--1"></div>
                <div class="loader-wheel loader-wheel--2"></div>
                <div class="loader-wheel loader-wheel--3"></div>
            </div>
        </div>
        <div class="loader-text">DISPATCH</div>
        <div class="loader-bar"><div class="loader-bar-fill"></div></div>
    </div>

    <div class="page">
        <!-- Topbar -->
        <div class="topbar">
            <div class="brand">
                <a href="index.php">
                    <span class="brand-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </span>
                    <span class="brand-text"><h1>DISPATCH</h1><p>Feedback</p></span>
                </a>
            </div>
            <div class="topbar-actions">
                <a href="video_docs.php" class="theme-btn shortcut-btn" title="Video Docs" style="text-decoration:none;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </a>
                <a href="tutorials.php" class="theme-btn shortcut-btn" title="Video Tutorials" style="text-decoration:none;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </a>
                <button class="theme-btn" id="theme-btn" onclick="toggleTheme()" title="Toggle theme">
                    <svg class="moon-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.8A9 9 0 1111.2 3 7 7 0 0021 12.8z"/></svg>
                    <svg class="sun-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="display:none;"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
                </button>
                <button class="theme-btn" onclick="toggleSettings()" title="Settings" aria-label="Open settings">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </button>
                <a href="index.php" class="back-home-btn">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 18L18 6M6 6l12 12"/></svg>
                </a>
            </div>
        </div>

        <!-- Section header -->
        <div class="fb-section-head">
            <div>
                <div class="fb-section-title">
                    <span class="fb-section-title-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12l2 2 4-4M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/></svg>
                    </span>
                    Documentation Feedback
                </div>
                <div class="fb-section-sub">What users are saying about the DISPATCH docs</div>
            </div>
        </div>

        <!-- Summary pills -->
        <div class="fb-summary" id="summary">
            <div class="fb-pill"><span class="fb-pill-dot total"></span> <span class="fb-pill-num" id="num-total">0</span> Total</div>
            <div class="fb-pill"><span class="fb-pill-dot up"></span> <span class="fb-pill-num" id="num-up">0</span> Helpful</div>
            <div class="fb-pill"><span class="fb-pill-dot down"></span> <span class="fb-pill-num" id="num-down">0</span> Needs Work</div>
        </div>

        <!-- Controls -->
        <div class="fb-controls">
            <div class="fb-search">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                <input type="text" id="search" placeholder="Search feedback..." aria-label="Search feedback">
            </div>
            <div class="fb-chips">
                <button class="fb-chip active" data-filter="all">All <span class="fb-chip-count" id="count-all">0</span></button>
                <button class="fb-chip" data-filter="up">Helpful <span class="fb-chip-count" id="count-up">0</span></button>
                <button class="fb-chip" data-filter="down">Needs Work <span class="fb-chip-count" id="count-down">0</span></button>
            </div>
        </div>

        <!-- Feedback list -->
        <div class="fb-list" id="list">
            <div class="fb-loading">Loading feedback</div>
        </div>
    </div>

    <script>
        (function() {
            'use strict';
            var API = 'api/feedback.php';
            var allFeedback = [];
            var currentFilter = 'all';
            var searchQuery = '';

            function escapeHtml(str) {
                if (typeof str !== 'string') return '';
                return str.replace(/&/g, '\x26amp;').replace(/</g, '\x26lt;').replace(/>/g, '\x26gt;').replace(/"/g, '\x26quot;').replace(/'/g, '&#039;');
            }

            function timeAgo(ts) {
                var s = Math.floor(Date.now() / 1000 - ts);
                if (s < 60) return 'Just now';
                if (s < 3600) return Math.floor(s / 60) + 'm ago';
                if (s < 86400) return Math.floor(s / 3600) + 'h ago';
                if (s < 604800) return Math.floor(s / 86400) + 'd ago';
                if (s < 2592000) return Math.floor(s / 604800) + 'w ago';
                return Math.floor(s / 2592000) + 'mo ago';
            }

            function loadFeedback() {
                fetch(API)
                    .then(function(r) { return r.json(); })
                    .then(function(data) {
                        if (!data.ok) throw new Error(data.error || 'Failed');
                        allFeedback = data.feedback || [];
                        renderSummary();
                        renderList();
                    })
                    .catch(function(err) {
                        document.getElementById('list').innerHTML =
                            '<div class="fb-empty"><div class="fb-empty-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/></svg></div><h3>Failed to load</h3><p>' + escapeHtml(err.message) + '</p></div>';
                    });
            }

            function renderSummary() {
                var total = allFeedback.length;
                var up = 0, down = 0;
                allFeedback.forEach(function(f) {
                    if (f.vote === 'up') up++;
                    if (f.vote === 'down') down++;
                });
                document.getElementById('num-total').textContent = total;
                document.getElementById('num-up').textContent = up;
                document.getElementById('num-down').textContent = down;
                document.getElementById('count-all').textContent = total;
                document.getElementById('count-up').textContent = up;
                document.getElementById('count-down').textContent = down;
            }

            function renderList() {
                var filtered = allFeedback.filter(function(f) {
                    if (currentFilter === 'up' && f.vote !== 'up') return false;
                    if (currentFilter === 'down' && f.vote !== 'down') return false;
                    if (searchQuery) {
                        var q = searchQuery.toLowerCase();
                        var haystack = ((f.doc_title || '') + ' ' + (f.message || '') + ' ' + (f.doc_id || '')).toLowerCase();
                        if (haystack.indexOf(q) === -1) return false;
                    }
                    return true;
                });

                var listEl = document.getElementById('list');
                if (filtered.length === 0) {
                    listEl.innerHTML =
                        '<div class="fb-empty"><div class="fb-empty-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg></div><h3>No feedback found</h3><p>' + (searchQuery ? 'Try a different search' : 'Nothing here yet') + '</p></div>';
                    return;
                }

                listEl.innerHTML = filtered.map(function(f, idx) {
                    var isUp = f.vote === 'up';
                    var hasMsg = f.message && f.message.trim();
                    var voteSvg = isUp
                        ? '<path stroke-linecap="round" stroke-linejoin="round" d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3"/>'
                        : '<path stroke-linecap="round" stroke-linejoin="round" d="M10 15v4a3 3 0 003 3l4-9V2H5.72a2 2 0 00-2 1.7l-1.38 9a2 2 0 002 2.3zM17 2h3a2 2 0 012 2v7a2 2 0 01-2 2h-3"/>';
                    return '<div class="fb-item ' + f.vote + '" style="animation-delay:' + Math.min(idx * 0.04, 0.4) + 's">' +
                        '<div class="fb-vote"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">' + voteSvg + '</svg></div>' +
                        '<div class="fb-body">' +
                            '<div class="fb-top">' +
                                '<span class="fb-doc">' + escapeHtml(f.doc_title || 'Untitled') + '</span>' +
                                '<span class="fb-tag">' + (isUp ? 'Helpful' : 'Needs Work') + '</span>' +
                                '<span class="fb-time">' + escapeHtml(timeAgo(f.timestamp || 0)) + '</span>' +
                            '</div>' +
                            '<div class="fb-msg' + (hasMsg ? '' : ' empty') + '">' + (hasMsg ? escapeHtml(f.message) : (isUp ? 'Marked as helpful' : 'No notes provided')) + '</div>' +
                            '<div class="fb-meta">' +
                                '<span><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>' + escapeHtml(f.name || 'Anonymous') + '</span>' +
                            '</div>' +
                        '</div>' +
                    '</div>';
                }).join('');
            }

            // ===== Events =====
            document.getElementById('search').addEventListener('input', function() {
                searchQuery = this.value.trim();
                renderList();
            });

            document.querySelectorAll('.fb-chip').forEach(function(chip) {
                chip.addEventListener('click', function() {
                    document.querySelectorAll('.fb-chip').forEach(function(c) {
                        c.classList.remove('active', 'warn');
                    });
                    chip.classList.add('active');
                    if (chip.dataset.filter === 'down') chip.classList.add('warn');
                    currentFilter = chip.dataset.filter;
                    renderList();
                });
            });

            // Auto-refresh every 30s
            setInterval(loadFeedback, 30000);
            loadFeedback();
        })();

        // Hide loader on load
        window.addEventListener('load', function() {
            var loader = document.getElementById('loader-screen');
            if (loader) { setTimeout(function() { loader.classList.add('hidden'); }, 500); }
        });
    </script>
    <script>window.DISPATCH_THEME_CLASS='light';</script>
    <script src="js/dispatch.js?v=2"></script>
</body>
</html>
