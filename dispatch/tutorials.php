<?php
// Dispatch Video Tutorial Library — standalone page
// Displays all dispatch tutorial videos in a clean grid layout

// Security headers
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('X-XSS-Protection: 1; mode=block');
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src https://fonts.gstatic.com; media-src 'self'; img-src 'self' data:; connect-src 'self';");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="favicon.svg?v=2">
    <link rel="shortcut icon" href="favicon.svg?v=2">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <title>DISPATCH · Video Tutorial Library</title>
    <script>
        // Apply saved theme BEFORE body renders to prevent loading screen flash
        (function(){try{var t=localStorage.getItem('dispatch-theme');if(t==='light'){document.documentElement.classList.add('light');}else{document.documentElement.classList.remove('light');}}catch(e){}})();
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/tutorials-animations.css">
    <link rel="stylesheet" href="css/dispatch-ui.css">
    <link rel="stylesheet" href="css/loaders.css?v=4">
    <link rel="stylesheet" href="css/tour-guide.css?v=1">
    <style>
        :root {
            --bg: #0b0f19;
            --bg-2: #121929;
            --surface: rgba(17, 24, 45, 0.72);
            --surface-solid: #11182d;
            --surface-2: #182240;
            --border: rgba(255,255,255,0.08);
            --border-strong: rgba(255,255,255,0.14);
            --text: #e8eef7;
            --text-muted: #8ea0b8;
            --text-dim: #5f7189;
            --accent: #10b981;
            --accent-soft: rgba(16, 185, 129, 0.14);
            --accent-2: #38bdf8;
            --danger: #f43f5e;
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
            --text-muted: #55627a;
            --text-dim: #8a96ab;
            --accent: #0ea371;
            --accent-soft: rgba(14, 163, 113, 0.12);
            --shadow: 0 20px 40px -24px rgba(15, 23, 42, 0.22);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body.reduce-motion { scroll-behavior: auto; }
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text);
            background:
                radial-gradient(ellipse at 10% 10%, color-mix(in srgb, var(--accent-2) 25%, transparent), transparent 50%),
                radial-gradient(ellipse at 90% 20%, color-mix(in srgb, var(--accent) 18%, transparent), transparent 50%),
                radial-gradient(ellipse at 50% 100%, color-mix(in srgb, var(--accent) 15%, transparent), transparent 45%),
                linear-gradient(160deg, var(--bg) 0%, var(--bg-2) 55%, var(--bg) 100%);
            background-attachment: fixed;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }
        html.light body {
            background:
                radial-gradient(ellipse at 10% 10%, color-mix(in srgb, var(--accent-2) 18%, transparent), transparent 50%),
                radial-gradient(ellipse at 90% 20%, color-mix(in srgb, var(--accent) 12%, transparent), transparent 50%),
                radial-gradient(ellipse at 50% 100%, color-mix(in srgb, var(--accent) 10%, transparent), transparent 45%),
                linear-gradient(160deg, #f8fafc 0%, #ffffff 55%, #f1f5f9 100%);
        }

        /* ===== Header (YouTube-style top bar) ===== */
        .header {
            position: fixed; top: 0; left: 0; right: 0; z-index: 200;
            display: flex; align-items: center; gap: 1rem;
            padding: 0 1rem;
            height: 56px;
            background: color-mix(in srgb, var(--surface-solid) 85%, transparent);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid var(--border);
        }
        .header-left { display: flex; align-items: center; gap: 0.75rem; }
        .sidebar-toggle {
            display: flex; align-items: center; justify-content: center;
            width: 40px; height: 40px;
            border: none; border-radius: 50%;
            background: transparent;
            color: var(--text);
            cursor: pointer;
            transition: background 0.15s ease;
        }
        .sidebar-toggle:hover { background: var(--surface-2); }
        .sidebar-toggle svg { width: 22px; height: 22px; }
        .brand { display: flex; align-items: center; gap: 0.5rem; cursor: pointer; text-decoration: none; }
        .brand:hover .brand-mark { transform: rotate(-6deg) scale(1.08); }
        .brand-mark {
            width: 32px; height: 32px;
            border-radius: 10px;
            display: grid; place-items: center;
            background: linear-gradient(135deg, var(--accent), #059669);
            color: #fff;
            transition: transform 0.2s ease;
        }
        .brand-mark svg { width: 18px; height: 18px; }
        .brand-text { display: flex; flex-direction: column; line-height: 1.1; }
        .brand-text h1 { font-size: 1.05rem; font-weight: 800; letter-spacing: -0.01em; color: var(--text); }
        .brand-text p { font-size: 0.65rem; color: var(--text-dim); font-weight: 500; }

        /* Center search — YouTube style */
        .header-search {
            flex: 1; max-width: 560px;
            display: flex; align-items: center;
            margin: 0 auto;
        }
        .header-search-input-wrap {
            flex: 1;
            display: flex; align-items: center;
            height: 40px;
            border: 1px solid var(--border-strong);
            border-radius: 40px 0 0 40px;
            background: color-mix(in srgb, var(--surface-solid) 60%, transparent);
            padding-left: 1rem;
            transition: border-color 0.18s ease;
        }
        .header-search-input-wrap:focus-within {
            border-color: var(--border-strong);
            background: var(--surface-solid);
        }
        .header-search-icon {
            width: 18px; height: 18px;
            color: var(--text-dim);
            flex-shrink: 0;
            margin-right: 0.5rem;
            transition: color 0.18s ease;
        }
        .header-search input {
            flex: 1;
            border: none; background: transparent; outline: none;
            color: var(--text);
            font-size: 0.9rem;
            font-family: inherit;
            height: 100%;
        }
        .header-search input::placeholder { color: var(--text-dim); }
        .header-search-btn {
            width: 56px; height: 40px;
            border: 1px solid var(--border-strong);
            border-left: none;
            border-radius: 0 40px 40px 0;
            background: color-mix(in srgb, var(--surface-2) 80%, transparent);
            color: var(--text-muted);
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: background 0.15s ease, color 0.15s ease;
        }
        .header-search-btn:hover { background: var(--surface-2); color: var(--text); }
        .header-search-btn svg { width: 20px; height: 20px; }

        .header-actions { display: flex; align-items: center; gap: 0.6rem; flex-shrink: 0; }
        .icon-btn {
            display: flex; align-items: center; justify-content: center;
            width: 40px; height: 40px;
            border: 1px solid color-mix(in srgb, var(--border) 50%, transparent);
            border-radius: 12px;
            background: transparent;
            color: var(--text);
            cursor: pointer;
            transition: all 0.18s ease;
        }
        .icon-btn:hover { background: var(--surface-2); border-color: var(--border-strong); transform: translateY(-2px); }
        .icon-btn:active { transform: translateY(0) scale(0.96); }
        .icon-btn svg { width: 18px; height: 18px; }
        .icon-btn[title] { position: relative; }
        .icon-btn[title]::after {
            content: attr(title);
            position: absolute;
            top: calc(100% + 8px);
            left: 50%;
            transform: translateX(-50%) translateY(-6px);
            padding: 0.35rem 0.65rem;
            background: var(--surface-solid);
            color: var(--text);
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 600;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: all 0.18s ease;
            z-index: 10;
        }
        .icon-btn[title]:hover::after {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
        .icon-btn.video-docs-btn,
        .icon-btn.docs-btn,
        .icon-btn.theme-btn,
        .icon-btn.settings-btn-top,
        .icon-btn.tour-btn {
            color: var(--accent);
            border-color: var(--border-strong);
            background: color-mix(in srgb, var(--accent) 10%, transparent);
        }
        .icon-btn.video-docs-btn:hover,
        .icon-btn.docs-btn:hover,
        .icon-btn.theme-btn:hover,
        .icon-btn.settings-btn-top:hover,
        .icon-btn.tour-btn:hover {
            background: linear-gradient(135deg, color-mix(in srgb, var(--accent) 22%, transparent), color-mix(in srgb, var(--accent) 18%, transparent));
            border-color: var(--border-strong);
            box-shadow: 0 0 16px color-mix(in srgb, var(--accent) 45%, transparent);
            transform: translateY(-2px) scale(1.05);
            color: #fff;
        }
        .icon-btn.docs-btn, .icon-btn.video-docs-btn { text-decoration: none; }
        .icon-btn.docs-btn svg, .icon-btn.video-docs-btn svg { width: 20px; height: 20px; }
        /* Back Button — X modal style (red) */
        .back-home-btn {
            display: grid;
            place-items: center;
            width: 38px; height: 38px;
            border: 1px solid color-mix(in srgb, #ef4444 40%, transparent);
            border-radius: 50%;
            background: color-mix(in srgb, #ef4444 8%, transparent);
            color: #ef4444;
            text-decoration: none;
            font-family: inherit;
            transition: border-color 0.25s ease, color 0.25s ease, background 0.25s ease, transform 0.25s ease;
        }
        .back-home-btn svg {
            width: 18px; height: 18px; flex-shrink: 0;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .back-home-btn:hover {
            border-color: #ef4444;
            background: color-mix(in srgb, #ef4444 15%, transparent);
            color: #ef4444;
            transform: rotate(90deg);
        }
        .back-home-btn:active { transform: scale(0.92); }

        /* ===== Layout (YouTube-style: sidebar + content) ===== */
        .yt-layout { display: flex; padding-top: 56px; }
        .yt-sidebar {
            position: fixed;
            top: 56px; left: 0; bottom: 0;
            width: 288px;
            background: color-mix(in srgb, var(--surface-solid) 60%, transparent);
            backdrop-filter: blur(16px) saturate(150%);
            -webkit-backdrop-filter: blur(16px) saturate(150%);
            border-right: 1px solid color-mix(in srgb, var(--border) 50%, transparent);
            padding: 1.25rem 0.85rem 2rem;
            overflow-y: auto;
            overflow-x: visible;
            z-index: 100;
            transition: width 0.28s cubic-bezier(0.4, 0, 0.2, 1), padding 0.28s ease, transform 0.25s ease;
            scrollbar-width: thin;
        }
        /* Collapse button (matches index.php .sidebar-hide-btn) */
        .sidebar-hide-btn {
            position: absolute;
            top: 50%;
            right: -18px;
            transform: translateY(-50%);
            width: 36px;
            height: 36px;
            border: 2px solid var(--border);
            border-radius: 50%;
            background: var(--surface-solid);
            color: var(--text-dim);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            z-index: 15;
            box-shadow: 0 4px 12px -4px rgba(0, 0, 0, 0.4);
        }
        .sidebar-hide-btn::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 50%;
            background: conic-gradient(from 0deg, var(--accent), transparent, var(--accent));
            opacity: 0;
            z-index: -1;
            animation: spin 2s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        .sidebar-hide-btn:hover {
            color: var(--accent);
            border-color: var(--border-strong);
            transform: translateY(-50%) scale(1.15);
            box-shadow: 0 0 24px -4px color-mix(in srgb, var(--accent) 60%, transparent);
        }
        .sidebar-hide-btn:hover::before { opacity: 0.6; }
        .sidebar-hide-btn svg { width: 16px; height: 16px; transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); }
        .sidebar-hide-btn:hover svg { transform: rotate(180deg); }

        /* Section titles (matches index.php .nav-section-title) */
        .sb-section-title {
            padding: 1rem 1rem 0.4rem;
            font-size: 0.68rem; font-weight: 800; letter-spacing: 0.09em;
            text-transform: uppercase; color: var(--text-dim);
            border-bottom: 1px solid var(--border);
            transition: font-size 0.28s cubic-bezier(0.4, 0, 0.2, 1), padding 0.28s ease;
        }
        /* Nav items (matches index.php .nav-link) */
        .sb-item {
            display: flex; align-items: center; gap: 0.7rem;
            padding: 0.62rem 0.85rem;
            border-radius: 12px;
            color: var(--text-muted);
            font-size: 0.88rem; font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            position: relative;
            transition: all 0.16s ease, font-size 0.28s cubic-bezier(0.4, 0, 0.2, 1), gap 0.28s ease, padding 0.28s ease;
            border: none; background: transparent;
            width: 100%; text-align: left;
            font-family: inherit;
        }
        .sb-item svg { width: 19px; height: 19px; flex-shrink: 0; color: var(--text-muted); transition: color 0.16s ease; }
        .sb-item:hover {
            background: color-mix(in srgb, var(--surface-solid) 50%, transparent);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            color: var(--text);
        }
        .sb-item:hover svg { color: var(--text); }
        .sb-item.active {
            background: color-mix(in srgb, var(--accent) 15%, transparent);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            color: var(--accent);
            font-weight: 600;
        }
        .sb-item.active svg { color: var(--accent); }
        .sb-item.active::before {
            content: ''; position: absolute; left: -0.85rem; top: 20%; bottom: 20%;
            width: 3px; border-radius: 999px; background: var(--accent);
        }
        .sb-divider { height: 1px; background: var(--border); margin: 0.5rem 0.75rem; }

        /* Collapsed / mini sidebar (matches index.php .sidebar.mini — 64px) */
        .yt-sidebar.collapsed { width: 64px; padding: 1.25rem 0.5rem 2rem; }
        .yt-sidebar.collapsed .sb-section-title {
            font-size: 0;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--border);
            text-align: center;
            display: flex;
            justify-content: center;
        }
        .yt-sidebar.collapsed .sb-item {
            justify-content: center;
            padding: 0.62rem 0;
            font-size: 0;
            gap: 0;
        }
        .yt-sidebar.collapsed .sb-item svg { width: 20px; height: 20px; }
        .yt-sidebar.collapsed .sb-item.active::before { left: 0; }
        .yt-sidebar.collapsed .sb-divider { margin: 0.5rem 0; }
        .yt-sidebar.collapsed .sb-item::after {
            content: attr(data-tip);
            position: absolute;
            left: calc(100% + 12px);
            top: 50%;
            transform: translateY(-50%);
            padding: 0.35rem 0.7rem;
            background: var(--surface-solid);
            color: var(--text);
            font-size: 0.78rem;
            font-weight: 500;
            white-space: nowrap;
            border-radius: 8px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.15s ease;
            z-index: 100;
        }
        .yt-sidebar.collapsed .sb-item:hover::after { opacity: 1; }

        .main {
            flex: 1;
            margin-left: 288px;
            padding: 1rem 2rem 2rem;
            min-height: calc(100vh - 56px);
            transition: margin-left 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .main.sidebar-collapsed { margin-left: 64px; }

        /* ===== Filter Chips (YouTube-style horizontal scroll) ===== */
        .chip-bar {
            display: flex; gap: 0.6rem;
            overflow-x: auto;
            padding: 0.5rem 0 1rem;
            margin-bottom: 0.5rem;
            scrollbar-width: thin;
        }
        .chip-bar::-webkit-scrollbar { height: 4px; }
        .chip-bar::-webkit-scrollbar-thumb { background: var(--border-strong); border-radius: 4px; }
        .chip {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.45rem 1rem;
            border: 1px solid color-mix(in srgb, var(--accent) 25%, transparent);
            border-radius: 999px;
            background: color-mix(in srgb, var(--surface-solid) 50%, transparent);
            color: var(--text-muted);
            font-size: 0.82rem; font-weight: 500;
            font-family: inherit;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .chip:hover {
            background: color-mix(in srgb, var(--accent) 10%, transparent);
            border-color: color-mix(in srgb, var(--accent) 45%, transparent);
            color: var(--text);
        }
        .chip.active {
            background: linear-gradient(135deg, var(--accent), #059669);
            border-color: transparent;
            color: #fff;
            font-weight: 600;
            box-shadow: 0 4px 14px -4px color-mix(in srgb, var(--accent) 55%, transparent);
        }
        .chip-count {
            display: inline-flex; align-items: center; justify-content: center;
            min-width: 18px; height: 18px;
            padding: 0 5px;
            border-radius: 999px;
            font-size: 0.62rem; font-weight: 700;
            background: color-mix(in srgb, currentColor 15%, transparent);
        }
        .chip.active .chip-count { background: rgba(255, 255, 255, 0.22); }

        /* ===== Watch History (horizontal scroll, YouTube-style) ===== */
        .watch-history {
            margin-bottom: 1.5rem;
        }
        .watch-history-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 0.75rem;
        }
        .watch-history-header h3 {
            font-size: 1rem; font-weight: 700;
            display: flex; align-items: center; gap: 0.5rem;
        }
        .watch-history-header h3 svg { width: 20px; height: 20px; color: var(--accent); }
        .clear-history {
            font-size: 0.78rem; color: var(--text-muted);
            background: none; border: none;
            cursor: pointer; padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-family: inherit;
            transition: all 0.15s ease;
            outline: none;
        }
        .clear-history:hover { background: var(--surface-2); color: var(--danger); }
        .watch-history-grid {
            display: flex; gap: 0.75rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
            scrollbar-width: thin;
        }
        .watch-history-grid::-webkit-scrollbar { height: 4px; }
        .watch-history-grid::-webkit-scrollbar-thumb { background: var(--border-strong); border-radius: 4px; }
        .history-item {
            display: flex; flex-direction: column;
            min-width: 220px; max-width: 220px;
            cursor: pointer;
            border-radius: 12px;
            overflow: hidden;
            transition: background 0.15s ease;
        }
        .history-item:hover { background: var(--surface-2); }
        .history-thumb {
            width: 100%;
            aspect-ratio: 16 / 9;
            border-radius: 12px;
            background: #000;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }
        .history-thumb video { width: 100%; height: 100%; object-fit: cover; pointer-events: none; }
        .history-info { padding: 0 0.25rem; }
        .history-info h4 {
            font-size: 0.85rem; font-weight: 600;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.3;
            margin-bottom: 0.2rem;
        }
        .history-info p {
            font-size: 0.74rem; color: var(--text-muted);
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .history-time {
            font-size: 0.7rem; color: var(--text-dim);
            margin-top: 0.1rem;
        }

        /* ===== Video Grid ===== */
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.25rem 1rem;
        }
        .video-card {
            background: color-mix(in srgb, var(--surface-solid) 55%, transparent);
            backdrop-filter: blur(12px) saturate(140%);
            -webkit-backdrop-filter: blur(12px) saturate(140%);
            border: 1px solid color-mix(in srgb, var(--border) 45%, transparent);
            border-radius: 14px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
            cursor: pointer;
            padding: 0.6rem;
            transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .video-card:hover {
            border-color: color-mix(in srgb, var(--border-strong) 70%, transparent);
            transform: translateY(-4px);
            box-shadow: 0 24px 48px -16px rgba(0, 0, 0, 0.65), 0 8px 18px -6px rgba(0, 0, 0, 0.45), 0 0 0 1px color-mix(in srgb, var(--accent) 25%, transparent);
        }
        html.light .video-card:hover {
            box-shadow: 0 24px 48px -16px rgba(15, 23, 42, 0.3), 0 8px 18px -6px rgba(15, 23, 42, 0.2), 0 0 0 1px color-mix(in srgb, var(--accent) 25%, transparent);
        }
        .video-card:focus, .video-card:focus-visible,
        .video-card *:focus, .video-card *:focus-visible { outline: none !important; box-shadow: none !important; border-color: transparent !important; }
        .video-card:active { transform: none; }
        .video-card::selection { background: transparent; }
        .video-card *::selection { background: transparent; }
        .video-thumb {
            position: relative;
            aspect-ratio: 16 / 9;
            background: #000;
            overflow: hidden;
            border-radius: 10px;
        }
        .video-thumb video {
            width: 100%; height: 100%;
            object-fit: cover;
            display: block;
            pointer-events: none;
        }
        .video-thumb .duration-badge {
            position: absolute; bottom: 0.5rem; right: 0.5rem;
            padding: 0.15rem 0.45rem;
            background: rgba(0, 0, 0, 0.8);
            color: #fff;
            font-size: 0.72rem;
            font-weight: 600;
            border-radius: 6px;
        }
        .video-thumb .category-badge {
            position: absolute; top: 0.5rem; left: 0.5rem;
            padding: 0.2rem 0.55rem;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            font-size: 0.66rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            border-radius: 6px;
        }
        .video-empty {
            position: absolute; inset: 0;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            gap: 0.5rem;
            background: var(--surface-2);
            color: var(--text-dim);
        }
        .video-empty svg { width: 40px; height: 40px; }
        .video-empty span { font-size: 0.78rem; }

        /* Video info — YouTube style: avatar + title + channel + meta */
        .video-info {
            display: flex; gap: 0.75rem;
            padding: 0.75rem 0.25rem 0;
            flex: 1;
        }
        .video-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), #059669);
            display: grid; place-items: center;
            color: #fff;
            font-size: 0.75rem; font-weight: 700;
            flex-shrink: 0;
            text-transform: uppercase;
        }
        .video-info-body { flex: 1; min-width: 0; }
        .video-info h3 {
            font-size: 0.92rem; font-weight: 600;
            color: var(--text);
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 0.3rem;
        }
        .video-channel {
            font-size: 0.78rem; color: var(--text-muted);
            display: flex; align-items: center; gap: 0.3rem;
            margin-bottom: 0.2rem;
        }
        .video-channel svg { width: 13px; height: 13px; opacity: 0.7; }
        .video-meta {
            display: flex; align-items: center; gap: 0.5rem;
            font-size: 0.74rem; color: var(--text-dim);
            flex-wrap: wrap;
        }
        .video-meta span { display: flex; align-items: center; gap: 0.25rem; }
        .video-meta svg { width: 13px; height: 13px; }
        .skill-badge {
            display: inline-flex; align-items: center; gap: 0.25rem;
            padding: 0.1rem 0.45rem; border-radius: 6px;
            font-size: 0.62rem; font-weight: 700; letter-spacing: 0.02em;
            text-transform: uppercase; flex-shrink: 0;
        }
        .skill-badge.beginner { background: rgba(16, 185, 129, 0.15); color: #10b981; }
        .skill-badge.intermediate { background: rgba(59, 130, 246, 0.15); color: #3b82f6; }
        .skill-badge.advanced { background: rgba(245, 158, 11, 0.15); color: #f59e0b; }

        /* ===== Modal Enhancements ===== */
        .modal-actions {
            display: flex; align-items: center; gap: 0.5rem;
        }
        .modal-action-btn {
            width: 38px; height: 38px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--surface);
            color: var(--text-muted);
            cursor: pointer;
            display: grid; place-items: center;
            transition: background 0.18s ease, color 0.18s ease, border-color 0.18s ease, transform 0.18s ease;
        }
        .modal-action-btn:hover { background: var(--surface-2); color: var(--text); border-color: var(--border-strong); transform: translateY(-1px); }
        .modal-action-btn:active { transform: translateY(0) scale(0.95); }
        .modal-action-btn.active { color: #fbbf24; border-color: rgba(251, 191, 36, 0.4); }
        .modal-action-btn.active svg { fill: #fbbf24; }
        .modal-action-btn svg { width: 16px; height: 16px; }

        /* ===== Related Videos (YouTube sidebar style) ===== */
        .related-videos {
            padding: 0;
            background: transparent;
        }
        .related-item {
            display: flex; align-items: flex-start; gap: 0.5rem;
            padding: 0.3rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.15s ease;
        }
        .related-item:hover { background: color-mix(in srgb, var(--text) 6%, transparent); }
        .related-item-thumb {
            width: 160px;
            aspect-ratio: 16 / 9;
            border-radius: 8px;
            background: #000;
            overflow: hidden;
            flex-shrink: 0;
            position: relative;
        }
        .related-item-thumb video { width: 100%; height: 100%; object-fit: cover; pointer-events: none; }
        .related-item-info { flex: 1; min-width: 0; padding-top: 0.05rem; }
        .related-item-info h5 {
            font-size: 0.82rem; font-weight: 600;
            color: var(--text);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.3;
            margin-bottom: 0.25rem;
        }
        .related-item-info p {
            font-size: 0.72rem; color: var(--text-dim);
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }

        /* ===== Modal Player (YouTube watch layout) ===== */
        .modal-overlay {
            position: fixed; inset: 0;
            background: rgba(0, 0, 0, 0.92);
            z-index: 2000;
            display: none;
            align-items: flex-start;
            justify-content: center;
            padding: 1rem;
            animation: fadeIn 0.2s ease;
            overflow-y: auto;
        }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .modal-overlay.open { display: flex; }
        .modal-player {
            width: 100%;
            max-width: 1280px;
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 1.25rem;
            background: color-mix(in srgb, var(--surface-solid) 92%, transparent);
            backdrop-filter: blur(28px) saturate(180%);
            -webkit-backdrop-filter: blur(28px) saturate(180%);
            border: 1px solid color-mix(in srgb, var(--border) 50%, transparent);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 32px 70px -20px rgba(0, 0, 0, 0.7);
            animation: modalSlide 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            padding: 1.25rem;
        }
        @keyframes modalSlide { from { transform: scale(0.94); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .modal-main { min-width: 0; display: flex; flex-direction: column; gap: 1rem; }

        /* Topbar — minimal, floating close button */
        .modal-topbar {
            display: flex; align-items: center; gap: 0.75rem;
            padding-bottom: 0.25rem;
        }
        .modal-back {
            display: flex; align-items: center; justify-content: center;
            width: 38px; height: 38px;
            border: none; border-radius: 50%;
            background: transparent;
            color: var(--text-muted);
            cursor: pointer;
            transition: background 0.15s ease, color 0.15s ease;
            flex-shrink: 0;
        }
        .modal-back:hover { background: var(--surface-2); color: var(--text); }
        .modal-back svg { width: 22px; height: 22px; }
        .modal-topbar-title {
            font-size: 0.92rem; font-weight: 500;
            color: var(--text-muted);
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            flex: 1; min-width: 0;
        }
        .modal-actions {
            display: flex; align-items: center; gap: 0.35rem;
            flex-shrink: 0;
        }
        .modal-action-btn {
            width: 36px; height: 36px;
            border: none;
            border-radius: 50%;
            background: transparent;
            color: var(--text-muted);
            cursor: pointer;
            display: grid; place-items: center;
            transition: background 0.15s ease, color 0.15s ease;
        }
        .modal-action-btn:hover { background: var(--surface-2); color: var(--text); }
        .modal-action-btn:active { transform: scale(0.92); }
        .modal-action-btn.active { color: #fbbf24; }
        .modal-action-btn.active svg { fill: #fbbf24; }
        .modal-action-btn svg { width: 18px; height: 18px; }

        /* Video frame — full bleed, no border radius */
        .modal-video-frame {
            aspect-ratio: 16 / 9;
            background: #000;
            overflow: hidden;
            position: relative;
            border-radius: 12px;
            box-shadow: 0 12px 36px -12px rgba(0, 0, 0, 0.5);
        }
        .modal-video-frame video { width: 100%; height: 100%; object-fit: contain; display: block; }
        .modal-video-frame .video-empty {
            position: absolute; inset: 0;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            gap: 0.75rem; color: var(--text-dim); font-size: 0.85rem;
            background: #000;
        }
        .modal-video-frame .video-empty svg { width: 48px; height: 48px; opacity: 0.5; }

        /* Video info — YouTube-style below player */
        .modal-video-info { padding-top: 0.25rem; }
        .modal-video-info h3 {
            font-size: 1.15rem; font-weight: 700;
            color: var(--text);
            line-height: 1.35;
            margin-bottom: 0.75rem;
        }
        .modal-video-meta-row {
            display: flex; align-items: center; gap: 0.75rem;
            padding-bottom: 0.85rem;
            border-bottom: 1px solid var(--border);
            margin-bottom: 0.85rem;
            flex-wrap: wrap;
        }
        .modal-channel {
            display: flex; align-items: center; gap: 0.65rem;
        }
        .modal-channel-avatar {
            width: 38px; height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), #059669);
            display: grid; place-items: center;
            color: #fff;
            font-size: 0.82rem; font-weight: 700;
            flex-shrink: 0;
            text-transform: uppercase;
            box-shadow: 0 2px 8px -2px color-mix(in srgb, var(--accent) 50%, transparent);
        }
        .modal-channel-info { display: flex; flex-direction: column; line-height: 1.25; }
        .modal-channel-name { font-size: 0.88rem; font-weight: 600; color: var(--text); }
        .modal-channel-sub { font-size: 0.72rem; color: var(--text-dim); }
        .modal-video-tags {
            display: flex; gap: 0.4rem; flex-wrap: wrap;
            margin-left: auto;
        }
        .modal-desc-box {
            background: color-mix(in srgb, var(--surface-2) 50%, transparent);
            border: 1px solid color-mix(in srgb, var(--border) 35%, transparent);
            border-radius: 10px;
            padding: 0.85rem 1rem;
            font-size: 0.82rem;
            line-height: 1.55;
            color: var(--text-muted);
        }
        .modal-desc-box p { margin: 0; }

        /* Right column: related videos — no title, just the list */
        .modal-sidebar {
            display: flex; flex-direction: column;
            gap: 0.4rem;
            max-height: calc(100vh - 2.5rem);
            position: sticky;
            top: 0;
            min-height: 0;
        }
        .related-list {
            display: flex; flex-direction: column; gap: 0.4rem;
            overflow-y: auto;
            flex: 1;
            min-height: 0;
            padding-right: 0.25rem;
            scrollbar-width: thin;
            scrollbar-color: var(--border-strong) transparent;
        }
        .related-list::-webkit-scrollbar { width: 6px; }
        .related-list::-webkit-scrollbar-track { background: transparent; }
        .related-list::-webkit-scrollbar-thumb {
            background: var(--border-strong);
            border-radius: 6px;
        }
        .related-list::-webkit-scrollbar-thumb:hover { background: var(--text-dim); }

        /* ===== No Results ===== */
        .no-results {
            text-align: center;
            padding: 3rem 1.5rem;
            color: var(--text-dim);
            background: color-mix(in srgb, var(--surface-solid) 60%, transparent);
            border: 1px solid color-mix(in srgb, var(--border) 50%, transparent);
            border-radius: 20px;
            backdrop-filter: blur(16px);
            display: none;
        }
        .no-results.show { display: block; }
        .no-results svg { width: 48px; height: 48px; margin-bottom: 1rem; opacity: 0.5; }
        .no-results h3 { font-size: 1.1rem; color: var(--text-muted); margin-bottom: 0.3rem; }
        .no-results p { font-size: 0.85rem; }

        /* ===== Footer ===== */
        .footer {
            text-align: center;
            padding: 2rem;
            color: var(--text-dim);
            font-size: 0.82rem;
            border-top: 1px solid color-mix(in srgb, var(--border) 50%, transparent);
            background: color-mix(in srgb, var(--surface-solid) 40%, transparent);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            margin-top: 2rem;
        }

        /* ===== Settings Panel ===== */
        .settings-overlay {
            position: fixed; inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1200;
            display: none;
            animation: fadeIn 0.2s ease;
        }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .settings-overlay.open { display: block; }
        .settings-panel {
            position: fixed;
            top: 0; right: 0;
            width: 420px;
            max-width: 100vw;
            height: 100vh;
            background: color-mix(in srgb, var(--surface-solid) 75%, transparent);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border-left: 1px solid color-mix(in srgb, var(--border) 50%, transparent);
            z-index: 1201;
            display: none;
            flex-direction: column;
            animation: settingsSlide 0.3s ease;
        }
        @keyframes settingsSlide { from { transform: translateX(100%); } to { transform: translateX(0); } }
        .settings-panel.open { display: flex; }
        .settings-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: linear-gradient(135deg, color-mix(in srgb, var(--accent) 12%, transparent), transparent 70%);
        }
        .settings-header svg { width: 24px; height: 24px; color: var(--accent); }
        .settings-header h2 { margin: 0; font-size: 1.15rem; font-weight: 700; }
        .settings-header p { margin: 0; font-size: 0.75rem; color: var(--text-muted); }
        .settings-close {
            margin-left: auto;
            background: var(--surface-2);
            border: 1px solid var(--border);
            color: var(--text);
            width: 34px; height: 34px;
            border-radius: 10px;
            cursor: pointer;
            display: grid; place-items: center;
            font-size: 18px;
            transition: all 0.15s ease;
        }
        .settings-close:hover { background: var(--danger); color: #fff; border-color: var(--danger); }
        .settings-body { flex: 1; overflow-y: auto; padding: 1.25rem 1.5rem; }
        .settings-group { margin-bottom: 1.75rem; }
        .settings-group-title {
            font-size: 0.72rem; font-weight: 800; letter-spacing: 0.1em;
            text-transform: uppercase; color: var(--accent);
            margin-bottom: 0.75rem; padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--border);
        }
        .setting-row {
            display: flex; align-items: center; justify-content: space-between;
            padding: 0.85rem 1rem;
            margin: 0 -0.5rem;
            gap: 1rem;
            border-radius: 12px;
            transition: all 0.18s ease;
        }
        .setting-row:hover { background: var(--surface-2); }
        .setting-label { flex: 1; }
        .setting-label .s-name { font-size: 0.9rem; font-weight: 600; color: var(--text); }
        .setting-label .s-hint { font-size: 0.74rem; color: var(--text-muted); margin-top: 3px; }
        /* Toggle switch */
        .toggle {
            position: relative;
            width: 46px; height: 26px;
            border-radius: 999px;
            background: var(--surface-2);
            border: 1px solid var(--border-strong);
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
            flex-shrink: 0;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.25);
        }
        .toggle::after {
            content: '';
            position: absolute;
            top: 2.5px; left: 2.5px;
            width: 19px; height: 19px;
            border-radius: 50%;
            background: linear-gradient(145deg, #fff, #d1d5db);
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .toggle.on {
            background: linear-gradient(135deg, var(--accent), #059669);
            border-color: transparent;
            box-shadow: 0 0 14px color-mix(in srgb, var(--accent) 45%, transparent);
        }
        .toggle.on::after { transform: translateX(20px); background: #fff; }
        /* Select dropdown */
        .setting-select {
            padding: 0.55rem 2rem 0.55rem 0.85rem;
            border: 1px solid var(--border-strong);
            border-radius: 12px;
            background: var(--surface-2);
            color: var(--text);
            font-size: 0.82rem;
            font-weight: 500;
            font-family: inherit;
            cursor: pointer;
            outline: none;
            transition: all 0.18s ease;
            flex-shrink: 0;
            min-width: 130px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%238ea0b8'%3e%3cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.6rem center;
            background-size: 16px;
        }
        .setting-select:hover {
            border-color: var(--accent);
            background-color: var(--accent-soft);
        }
        .setting-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-soft);
        }
        .setting-select option {
            background: var(--surface-solid);
            color: var(--text);
            padding: 0.5rem 0.7rem;
            font-size: 0.85rem;
            font-weight: 500;
        }
        html:not(.light) .setting-select option {
            background: #11182d;
            color: #e8eef7;
        }
        html.light .setting-select option {
            background: #ffffff;
            color: #0f172a;
        }
        /* Color swatches */
        .color-swatches { display: flex; gap: 0.5rem; flex-wrap: wrap; }
        .color-swatch {
            width: 30px; height: 30px;
            border-radius: 50%;
            border: 2px solid var(--border);
            cursor: pointer;
            transition: transform 0.15s ease, border-color 0.15s ease;
        }
        .color-swatch:hover { transform: scale(1.1); }
        .color-swatch.active { border-color: #fff; box-shadow: 0 0 0 2px var(--accent); }
        /* Range slider */
        .setting-range {
            width: 120px;
            accent-color: var(--accent);
            cursor: pointer;
        }
        .setting-range-value { font-size: 0.78rem; color: var(--accent); font-weight: 600; min-width: 40px; text-align: right; }
        /* Font size preview */
        .font-preview { font-size: 0.85rem; color: var(--text-muted); margin-top: 0.3rem; }
        .settings-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border);
            display: flex;
            gap: 0.75rem;
        }
        .settings-btn {
            flex: 1;
            padding: 0.65rem;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--surface);
            color: var(--text);
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.18s ease;
            font-family: inherit;
        }
        .settings-btn:hover { background: var(--surface-2); transform: translateY(-2px); }
        .settings-btn:active { transform: translateY(0); }
        .settings-btn.primary { background: linear-gradient(135deg, var(--accent), #059669); color: #fff; border-color: transparent; }
        .settings-btn.primary:hover { background: linear-gradient(135deg, #10b981, #047857); box-shadow: 0 6px 18px -4px color-mix(in srgb, var(--accent) 50%, transparent); }
        @media (max-width: 560px) {
            .settings-panel { width: 100vw; }
        }

        /* Accessibility modes */
        body.reduce-motion *, body.reduce-motion *::before, body.reduce-motion *::after {
            animation-duration: 0.01s !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01s !important;
        }
        body.high-contrast {
            --text: #ffffff;
            --text-muted: #c0c8d4;
            --text-dim: #94a3b8;
            --border: rgba(255, 255, 255, 0.25);
            --border-strong: rgba(255, 255, 255, 0.4);
            --surface: rgba(255, 255, 255, 0.08);
            --surface-2: rgba(255, 255, 255, 0.12);
        }
        html.light body.high-contrast {
            --text: #000000;
            --text-muted: #1a1a1a;
            --text-dim: #333333;
            --border: rgba(0, 0, 0, 0.3);
            --border-strong: rgba(0, 0, 0, 0.5);
            --surface: rgba(0, 0, 0, 0.05);
            --surface-2: rgba(0, 0, 0, 0.08);
        }

        /* ===== Announcement Toast ===== */
        .announce-toast {
            position: fixed;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%) translateY(120%);
            z-index: 3000;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.85rem 1.25rem;
            background: var(--surface-solid);
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: 0 12px 32px -8px rgba(0, 0, 0, 0.4);
            color: var(--text);
            font-size: 0.88rem;
            font-weight: 500;
            opacity: 0;
            transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.35s ease;
            pointer-events: none;
            max-width: 90vw;
        }
        .announce-toast.show {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }
        .announce-toast .announce-icon {
            width: 28px; height: 28px;
            border-radius: 50%;
            display: grid; place-items: center;
            background: rgba(16, 185, 129, 0.15);
            color: #10b981;
            flex-shrink: 0;
        }
        .announce-toast .announce-icon svg { width: 16px; height: 16px; }
        .announce-toast .announce-swatch {
            width: 18px; height: 18px;
            border-radius: 50%;
            border: 2px solid var(--surface-solid);
            box-shadow: 0 0 0 1px var(--border);
            flex-shrink: 0;
        }

        @media (max-width: 1024px) {
            .yt-sidebar { transform: translateX(-100%); width: 280px; padding: 1.25rem 0.85rem 2rem; }
            .yt-sidebar.open { transform: translateX(0); }
            .yt-sidebar.collapsed { transform: translateX(-100%); width: 280px; padding: 1.25rem 0.85rem 2rem; }
            .yt-sidebar.collapsed.open { transform: translateX(0); }
            .yt-sidebar.collapsed .sb-item { justify-content: flex-start; font-size: 0.88rem; gap: 0.7rem; padding: 0.62rem 0.85rem; }
            .yt-sidebar.collapsed .sb-section-title { font-size: 0.68rem; padding: 1rem 1rem 0.4rem; justify-content: flex-start; display: block; }
            .yt-sidebar.collapsed .sb-divider { margin: 0.5rem 0.75rem; }
            .yt-sidebar.collapsed .sb-item::after { display: none; }
            .sidebar-hide-btn { display: none; }
            .main { margin-left: 0 !important; }
            .main.sidebar-collapsed { margin-left: 0 !important; }
            .header-search { display: none; }
        }
        @media (max-width: 768px) {
            .main { padding: 0.75rem 1rem 1.5rem; }
            .video-grid { grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 0.75rem; }
            .modal-player { grid-template-columns: 1fr; gap: 1rem; padding: 0.75rem; }
            .modal-sidebar { display: none; }
            .modal-video-info h3 { font-size: 1.05rem; }
            .related-item-thumb { width: 144px; }
        }
        @media (max-width: 600px) {
            .header { padding: 0 0.5rem; gap: 0.5rem; }
            .header-left { gap: 0.5rem; }
            .brand-text p { display: none; }
            .main { padding: 0.5rem 0.75rem 1rem; }
            .video-grid { grid-template-columns: 1fr; gap: 1rem; }
            .modal-player { padding: 0.5rem; }
            .modal-topbar { gap: 0.5rem; }
            .modal-topbar-title { font-size: 0.82rem; }
            .modal-video-info h3 { font-size: 0.98rem; }
            .modal-channel-avatar { width: 32px; height: 32px; font-size: 0.75rem; }
            .related-item-thumb { width: 120px; }
            .related-item-info h5 { font-size: 0.78rem; }
            .history-item { min-width: 200px; max-width: 200px; }
        }
        @media (max-width: 400px) {
            .header-actions { gap: 0.2rem; }
            .icon-btn { width: 36px; height: 36px; }
            .icon-btn svg { width: 20px; height: 20px; }
        }

        /* Mobile Search Toggle */
        .mobile-search-btn {
            display: none;
            align-items: center; justify-content: center;
            width: 40px; height: 40px;
            border: none; border-radius: 50%;
            background: transparent;
            color: var(--text);
            cursor: pointer;
            transition: background 0.15s ease;
        }
        .mobile-search-btn:hover { background: var(--surface-2); }
        .mobile-search-btn svg { width: 22px; height: 22px; }
        .mobile-search-overlay {
            position: fixed; top: 56px; left: 0; right: 0;
            z-index: 180;
            padding: 0.75rem 1rem;
            background: color-mix(in srgb, var(--surface-solid) 95%, transparent);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid var(--border);
            display: none;
            animation: slideDown 0.2s ease;
        }
        @keyframes slideDown { from { transform: translateY(-100%); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .mobile-search-overlay.open { display: flex; }
        .mobile-search-overlay .header-search-input-wrap {
            flex: 1; height: 42px;
            border-radius: 40px;
            background: var(--surface-2);
        }
        .mobile-search-overlay .header-search-btn { display: none; }
        @media (max-width: 1024px) {
            .mobile-search-btn { display: flex; }
        }

        /* Mobile Sidebar Backdrop */
        .sb-backdrop {
            position: fixed; inset: 0;
            top: 56px;
            background: rgba(0, 0, 0, 0.5);
            z-index: 140;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s ease;
        }
        .sb-backdrop.open { opacity: 1; pointer-events: auto; }

        /* Loading screen styles moved to css/loaders.css */

        /* ===== ACD_TMS Curved Vector Background ===== */
        .bg-canvas {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }
        .bg-canvas svg {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        .main, .video-modal { position: relative; z-index: 1; }
    </style>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="css/tailwind-config.js"></script>
</head>
<body>
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

    <!-- ACD_TMS Curved Vector Background -->
    <div class="bg-canvas">
        <svg viewBox="0 0 1200 800" preserveAspectRatio="xMidYMid slice" id="bg-svg-dark" style="display: none;">
            <path d="M -72 696 C 168 576, 384 640, 600 536 C 816 432, 888 352, 1056 448 C 1200 536, 1224 624, 1320 552 L 1320 816 L -72 816 Z" fill="rgba(16,185,129,0.06)"/>
            <path d="M 744 -56 C 960 56, 1080 192, 1056 352 C 1032 520, 960 552, 1164 624 L 1320 568 L 1320 -56 Z" fill="rgba(16,185,129,0.07)"/>
            <path d="M -48 0 C 72 72, 204 32, 312 144 C 408 240, 384 376, 264 408 C 48 480, -48 424, -48 352 Z" fill="rgba(16,185,129,0.05)"/>
            <path d="M 84 728 C 276 624, 480 680, 636 568 C 816 440, 864 408, 1032 480" fill="none" stroke="rgba(16,185,129,0.12)" stroke-width="1.4"/>
            <path d="M -36 496 C 144 424, 312 480, 480 392 C 672 248, 792 280, 840 288" fill="none" stroke="rgba(16,185,129,0.08)" stroke-width="1"/>
            <path d="M 180 0 C 252 128, 156 232, 228 336 C 336 448, 360 544, 288 552" fill="none" stroke="rgba(16,185,129,0.08)" stroke-width="1"/>
            <circle cx="696" cy="160" r="78" fill="rgba(16,185,129,0.05)"/>
            <circle cx="132" cy="608" r="50" fill="rgba(16,185,129,0.05)"/>
            <circle cx="468" cy="728" r="34" fill="rgba(16,185,129,0.05)"/>
            <g fill="rgba(16,185,129,0.10)">
                <circle cx="36" cy="272" r="1.8"/><circle cx="84" cy="272" r="1.8"/><circle cx="132" cy="272" r="1.8"/><circle cx="180" cy="272" r="1.8"/><circle cx="228" cy="272" r="1.8"/><circle cx="276" cy="272" r="1.8"/><circle cx="324" cy="272" r="1.8"/>
                <circle cx="36" cy="312" r="1.8"/><circle cx="84" cy="312" r="1.8"/><circle cx="132" cy="312" r="1.8"/><circle cx="180" cy="312" r="1.8"/><circle cx="228" cy="312" r="1.8"/><circle cx="276" cy="312" r="1.8"/><circle cx="324" cy="312" r="1.8"/>
                <circle cx="36" cy="352" r="1.8"/><circle cx="84" cy="352" r="1.8"/><circle cx="132" cy="352" r="1.8"/><circle cx="180" cy="352" r="1.8"/><circle cx="228" cy="352" r="1.8"/><circle cx="276" cy="352" r="1.8"/><circle cx="324" cy="352" r="1.8"/>
                <circle cx="36" cy="392" r="1.8"/><circle cx="84" cy="392" r="1.8"/><circle cx="132" cy="392" r="1.8"/><circle cx="180" cy="392" r="1.8"/><circle cx="228" cy="392" r="1.8"/><circle cx="276" cy="392" r="1.8"/><circle cx="324" cy="392" r="1.8"/>
                <circle cx="36" cy="432" r="1.8"/><circle cx="84" cy="432" r="1.8"/><circle cx="132" cy="432" r="1.8"/><circle cx="180" cy="432" r="1.8"/><circle cx="228" cy="432" r="1.8"/><circle cx="276" cy="432" r="1.8"/><circle cx="324" cy="432" r="1.8"/>
            </g>
        </svg>
        <svg viewBox="0 0 1200 800" preserveAspectRatio="xMidYMid slice" id="bg-svg-light" style="display: none;">
            <path d="M -72 696 C 168 576, 384 640, 600 536 C 816 432, 888 352, 1056 448 C 1200 536, 1224 624, 1320 552 L 1320 816 L -72 816 Z" fill="rgba(16,185,129,0.08)"/>
            <path d="M 744 -56 C 960 56, 1080 192, 1056 352 C 1032 520, 960 552, 1164 624 L 1320 568 L 1320 -56 Z" fill="rgba(14,163,113,0.08)"/>
            <path d="M -48 0 C 72 72, 204 32, 312 144 C 408 240, 384 376, 264 408 C 48 480, -48 424, -48 352 Z" fill="rgba(16,185,129,0.06)"/>
            <path d="M 84 728 C 276 624, 480 680, 636 568 C 816 440, 864 408, 1032 480" fill="none" stroke="rgba(16,185,129,0.12)" stroke-width="1.4"/>
            <path d="M -36 496 C 144 424, 312 480, 480 392 C 672 248, 792 280, 840 288" fill="none" stroke="rgba(16,185,129,0.08)" stroke-width="1"/>
            <path d="M 180 0 C 252 128, 156 232, 228 336 C 336 448, 360 544, 288 552" fill="none" stroke="rgba(16,185,129,0.08)" stroke-width="1"/>
            <circle cx="696" cy="160" r="78" fill="rgba(16,185,129,0.05)"/>
            <circle cx="132" cy="608" r="50" fill="rgba(16,185,129,0.05)"/>
            <circle cx="468" cy="728" r="34" fill="rgba(16,185,129,0.05)"/>
            <g fill="rgba(16,185,129,0.14)">
                <circle cx="36" cy="272" r="1.8"/><circle cx="84" cy="272" r="1.8"/><circle cx="132" cy="272" r="1.8"/><circle cx="180" cy="272" r="1.8"/><circle cx="228" cy="272" r="1.8"/><circle cx="276" cy="272" r="1.8"/><circle cx="324" cy="272" r="1.8"/>
                <circle cx="36" cy="312" r="1.8"/><circle cx="84" cy="312" r="1.8"/><circle cx="132" cy="312" r="1.8"/><circle cx="180" cy="312" r="1.8"/><circle cx="228" cy="312" r="1.8"/><circle cx="276" cy="312" r="1.8"/><circle cx="324" cy="312" r="1.8"/>
                <circle cx="36" cy="352" r="1.8"/><circle cx="84" cy="352" r="1.8"/><circle cx="132" cy="352" r="1.8"/><circle cx="180" cy="352" r="1.8"/><circle cx="228" cy="352" r="1.8"/><circle cx="276" cy="352" r="1.8"/><circle cx="324" cy="352" r="1.8"/>
                <circle cx="36" cy="392" r="1.8"/><circle cx="84" cy="392" r="1.8"/><circle cx="132" cy="392" r="1.8"/><circle cx="180" cy="392" r="1.8"/><circle cx="228" cy="392" r="1.8"/><circle cx="276" cy="392" r="1.8"/><circle cx="324" cy="392" r="1.8"/>
                <circle cx="36" cy="432" r="1.8"/><circle cx="84" cy="432" r="1.8"/><circle cx="132" cy="432" r="1.8"/><circle cx="180" cy="432" r="1.8"/><circle cx="228" cy="432" r="1.8"/><circle cx="276" cy="432" r="1.8"/><circle cx="324" cy="432" r="1.8"/>
            </g>
        </svg>
    </div>

    <!-- Mobile Search Overlay -->
    <div class="mobile-search-overlay" id="mobile-search-overlay">
        <div class="header-search-input-wrap">
            <svg class="header-search-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" id="mobile-search-input" placeholder="Search tutorials..." oninput="filterVideosMobile(this.value)">
        </div>
    </div>

    <!-- Sidebar Backdrop (mobile) -->
    <div class="sb-backdrop" id="sb-backdrop" onclick="closeSidebar()"></div>

    <!-- Header (YouTube-style top bar) -->
    <header class="header">
        <div class="header-left">
            <button class="sidebar-toggle" id="sidebar-toggle" onclick="toggleSidebar()" title="Toggle sidebar" aria-label="Toggle sidebar">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <a href="index.php" class="brand">
                <span class="brand-mark">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </span>
                <span class="brand-text">
                    <h1>DISPATCH</h1>
                    <p>Tutorials</p>
                </span>
            </a>
        </div>
        <div class="header-search">
            <div class="header-search-input-wrap">
                <svg class="header-search-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" id="search-input" placeholder="Search tutorials..." oninput="filterVideos()">
            </div>
            <button class="header-search-btn" onclick="filterVideos()" title="Search" aria-label="Search">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </button>
        </div>
        <button class="mobile-search-btn" onclick="toggleMobileSearch()" title="Search" aria-label="Search">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </button>
        <div class="header-actions">
            <a href="video_docs.php" class="icon-btn video-docs-btn" title="Video Docs">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6"/><path d="M10 11l5 3-5 3z" fill="currentColor" stroke="none"/></svg>
            </a>
            <a href="docs.php" class="icon-btn docs-btn" title="Documentation">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0 -3.332.477-4.5 1.253"/></svg>
            </a>
            <button class="icon-btn tour-btn" onclick="startTour()" title="Start Tour Guide" aria-label="Start tour guide">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 9m0 8V9m0 0L9 7"/></svg>
            </button>
            <button class="icon-btn theme-btn" onclick="toggleTheme()" title="Toggle theme" id="theme-btn">
                <svg class="moon-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                <svg class="sun-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display:none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </button>
            <button class="icon-btn settings-btn-top" onclick="toggleSettings()" title="Settings" aria-label="Open settings">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </button>
        </div>
    </header>

    <!-- YouTube-style layout: sidebar + main content -->
    <div class="yt-layout">
        <!-- Sidebar -->
        <aside class="yt-sidebar" id="yt-sidebar">
            <button class="sidebar-hide-btn" onclick="toggleSidebar()" title="Collapse sidebar" aria-label="Toggle sidebar" id="sidebar-toggle-btn">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 19l-7-7 7-7M19 19l-7-7 7-7"/></svg>
            </button>

            <div class="sb-section-title">Browse</div>
            <button class="sb-item nav-link active" data-cat="all" data-tip="All Tutorials" onclick="setFilter('all', this)">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <span class="sb-label">All Tutorials</span>
            </button>
            <button class="sb-item nav-link" data-cat="Getting Started" data-tip="Getting Started" onclick="setFilter('Getting Started', this)">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v16M4 4h11l-1.5 4L15 12H4"/></svg>
                <span class="sb-label">Getting Started</span>
            </button>
            <button class="sb-item nav-link" data-cat="Dispatch & Operations" data-tip="Dispatch &amp; Ops" onclick="setFilter('Dispatch & Operations', this)">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1"/></svg>
                <span class="sb-label">Dispatch &amp; Ops</span>
            </button>
            <button class="sb-item nav-link" data-cat="Fleet Management" data-tip="Fleet Management" onclick="setFilter('Fleet Management', this)">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-3H5a2 2 0 00-2 2z"/></svg>
                <span class="sb-label">Fleet Management</span>
            </button>
            <button class="sb-item nav-link" data-cat="Finance & Admin" data-tip="Finance &amp; Admin" onclick="setFilter('Finance & Admin', this)">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="sb-label">Finance &amp; Admin</span>
            </button>
            <button class="sb-item nav-link" data-cat="Safety & Compliance" data-tip="Safety &amp; Compliance" onclick="setFilter('Safety & Compliance', this)">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                <span class="sb-label">Safety &amp; Compliance</span>
            </button>
            <div class="sb-divider"></div>
            <div class="sb-section-title">Navigate</div>
            <a href="index.php" class="sb-item nav-link" data-tip="Home">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span class="sb-label">Home</span>
            </a>
            <a href="docs.php" class="sb-item nav-link" data-tip="Documentation">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span class="sb-label">Documentation</span>
            </a>
            <a href="video_docs.php" class="sb-item nav-link" data-tip="Video Docs">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                <span class="sb-label">Video Docs</span>
            </a>
        </aside>

        <!-- Main Content -->
        <div class="main" id="main-content">
        <!-- Filter Chips (YouTube-style horizontal scroll) -->
        <div class="chip-bar" id="chip-bar">
            <button class="chip active" data-cat="all" onclick="setFilter('all', this)">
                All <span class="chip-count" id="count-all">0</span>
            </button>
            <button class="chip" data-cat="Getting Started" onclick="setFilter('Getting Started', this)">
                Getting Started <span class="chip-count" id="count-Getting-Started">0</span>
            </button>
            <button class="chip" data-cat="Dispatch & Operations" onclick="setFilter('Dispatch & Operations', this)">
                Dispatch &amp; Ops <span class="chip-count" id="count-Dispatch-Operations">0</span>
            </button>
            <button class="chip" data-cat="Fleet Management" onclick="setFilter('Fleet Management', this)">
                Fleet Mgmt <span class="chip-count" id="count-Fleet-Management">0</span>
            </button>
            <button class="chip" data-cat="Finance & Admin" onclick="setFilter('Finance & Admin', this)">
                Finance &amp; Admin <span class="chip-count" id="count-Finance-Admin">0</span>
            </button>
            <button class="chip" data-cat="Safety & Compliance" onclick="setFilter('Safety & Compliance', this)">
                Safety &amp; Compliance <span class="chip-count" id="count-Safety-Compliance">0</span>
            </button>
        </div>

        <!-- Watch History -->
        <div class="watch-history" id="watch-history" style="display:none;">
            <div class="watch-history-header">
                <h3>
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Recently Watched
                </h3>
                <button class="clear-history" onclick="clearWatchHistory()">Clear History</button>
            </div>
            <div class="watch-history-grid" id="watch-history-grid"></div>
        </div>

        <!-- Video Grid -->
        <div class="video-grid" id="video-grid"></div>

        <!-- No Results -->
        <div class="no-results" id="no-results">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <h3>No tutorials found</h3>
            <p>Try a different search term or category filter</p>
        </div>

        <!-- Footer -->
        <footer class="footer">
            DISPATCH Video Tutorial Library &middot; All tutorials in one place
        </footer>
    </div><!-- end .main -->
    </div><!-- end .yt-layout -->

    <!-- Modal Player (YouTube watch layout) -->
    <div class="modal-overlay" id="modal-overlay" onclick="closeModal(event)">
        <div class="modal-player" onclick="event.stopPropagation()">
            <!-- Left: player + info -->
            <div class="modal-main">
                <div class="modal-topbar">
                    <button class="modal-back" onclick="closeModal()" aria-label="Back">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                    <span class="modal-topbar-title" id="modal-topbar-title">Video Tutorial</span>
                    <div class="modal-actions">
                        <button class="modal-action-btn" id="modal-favorite-btn" onclick="toggleFavoriteFromModal()" title="Add to favorites">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        </button>
                        <button class="modal-action-btn" id="modal-pip-btn" onclick="togglePiP()" title="Picture-in-Picture">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/></svg>
                        </button>
                        <a class="modal-action-btn" id="modal-download-btn" download title="Download video" style="display:none">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        </a>
                    </div>
                </div>
                <div class="modal-video-frame">
                    <video id="modal-video" controls autoplay playsinline></video>
                </div>
                <div class="modal-video-info">
                    <h3 id="modal-title">Video Title</h3>
                    <div class="modal-video-meta-row">
                        <div class="modal-channel">
                            <div class="modal-channel-avatar" id="modal-avatar">D</div>
                            <div class="modal-channel-info">
                                <span class="modal-channel-name" id="modal-channel-name">DISPATCH</span>
                                <span class="modal-channel-sub" id="modal-channel-sub">Tutorial</span>
                            </div>
                        </div>
                        <div class="modal-video-tags" id="modal-video-tags"></div>
                    </div>
                    <div class="modal-desc-box">
                        <p id="modal-desc">Description</p>
                    </div>
                </div>
            </div>
            <!-- Right: related videos sidebar -->
            <div class="modal-sidebar" id="related-videos">
                <div class="related-list" id="related-list"></div>
            </div>
        </div>
    </div>

    <!-- Settings Panel -->
    <div class="settings-overlay" id="settings-overlay" onclick="toggleSettings()"></div>
    <div class="settings-panel" id="settings-panel">
        <div class="settings-header">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <div>
                <h2>Settings</h2>
                <p>Customize your experience</p>
            </div>
            <button class="settings-close" onclick="toggleSettings()" aria-label="Close settings">&times;</button>
        </div>
        <div class="settings-body">
            <!-- Theme & Appearance -->
            <div class="settings-group">
                <div class="settings-group-title">Theme &amp; Appearance</div>
                <div class="setting-row">
                    <div class="setting-label">
                        <div class="s-name">Dark Mode</div>
                        <div class="s-hint">Switch between dark and light theme</div>
                    </div>
                    <div class="toggle" id="set-dark-mode" onclick="toggleSetting('dark-mode','toggle')"></div>
                </div>
                <div class="setting-row">
                    <div class="setting-label">
                        <div class="s-name">Accent Color</div>
                        <div class="s-hint">Choose your preferred accent color</div>
                    </div>
                    <div class="color-swatches" id="set-accent-colors">
                        <div class="color-swatch active" style="background:#10b981" data-color="#10b981" onclick="setAccentColor('#10b981')"></div>
                        <div class="color-swatch" style="background:#3b82f6" data-color="#3b82f6" onclick="setAccentColor('#3b82f6')"></div>
                        <div class="color-swatch" style="background:#8b5cf6" data-color="#8b5cf6" onclick="setAccentColor('#8b5cf6')"></div>
                        <div class="color-swatch" style="background:#ec4899" data-color="#ec4899" onclick="setAccentColor('#ec4899')"></div>
                        <div class="color-swatch" style="background:#f59e0b" data-color="#f59e0b" onclick="setAccentColor('#f59e0b')"></div>
                        <div class="color-swatch" style="background:#ef4444" data-color="#ef4444" onclick="setAccentColor('#ef4444')"></div>
                    </div>
                </div>
                <div class="setting-row">
                    <div class="setting-label">
                        <div class="s-name">Font Size</div>
                        <div class="s-hint">Adjust the base text size</div>
                        <div class="font-preview" id="font-preview">The quick brown fox jumps over the lazy dog</div>
                    </div>
                    <div style="display:flex;align-items:center;gap:0.5rem;">
                        <input type="range" class="setting-range" id="set-font-size" min="13" max="20" value="15" oninput="setFontSize(this.value)">
                        <span class="setting-range-value" id="font-size-value">15px</span>
                    </div>
                </div>
            </div>
            <!-- Video Preferences -->
            <div class="settings-group">
                <div class="settings-group-title">Video Preferences</div>
                <div class="setting-row">
                    <div class="setting-label">
                        <div class="s-name">Autoplay</div>
                        <div class="s-hint">Automatically play videos when opening</div>
                    </div>
                    <div class="toggle" id="set-autoplay" onclick="toggleSetting('autoplay','toggle')"></div>
                </div>
                <div class="setting-row">
                    <div class="setting-label">
                        <div class="s-name">Default Playback Speed</div>
                        <div class="s-hint">Set the default speed for all videos</div>
                    </div>
                    <select class="setting-select" id="set-playback-speed" onchange="setPlaybackSpeed(this.value)">
                        <option value="0.5">0.5x (Slow)</option>
                        <option value="0.75">0.75x</option>
                        <option value="1" selected>1x (Normal)</option>
                        <option value="1.25">1.25x</option>
                        <option value="1.5">1.5x (Fast)</option>
                        <option value="2">2x (Fastest)</option>
                    </select>
                </div>
                <div class="setting-row">
                    <div class="setting-label">
                        <div class="s-name">Video Quality</div>
                        <div class="s-hint">Preferred video quality (if available)</div>
                    </div>
                    <select class="setting-select" id="set-video-quality" onchange="setVideoQuality(this.value)">
                        <option value="auto" selected>Auto</option>
                        <option value="high">High (1080p)</option>
                        <option value="medium">Medium (720p)</option>
                        <option value="low">Low (480p)</option>
                    </select>
                </div>
            </div>

            <!-- Navigation & Layout -->
            <div class="settings-group">
                <div class="settings-group-title">Navigation &amp; Layout</div>
                <div class="setting-row">
                    <div class="setting-label">
                        <div class="s-name">Mini Sidebar (Icons Only)</div>
                        <div class="s-hint">Show only icons in the sidebar on desktop</div>
                    </div>
                    <div class="toggle" id="set-sidebar-collapsed" onclick="toggleSetting('sidebar-collapsed','toggle')"></div>
                </div>
                <div class="setting-row">
                    <div class="setting-label">
                        <div class="s-name">Sync Search</div>
                        <div class="s-hint">Keep assistant and sidebar search in sync</div>
                    </div>
                    <div class="toggle on" id="set-sync-search" onclick="toggleSetting('sync-search','toggle')"></div>
                </div>
            </div>

            <!-- Accessibility -->
            <div class="settings-group">
                <div class="settings-group-title">Accessibility</div>
                <div class="setting-row">
                    <div class="setting-label">
                        <div class="s-name">Reduce Motion</div>
                        <div class="s-hint">Minimize animations and transitions</div>
                    </div>
                    <div class="toggle" id="set-reduce-motion" onclick="toggleSetting('reduce-motion','toggle')"></div>
                </div>
                <div class="setting-row">
                    <div class="setting-label">
                        <div class="s-name">High Contrast</div>
                        <div class="s-hint">Increase contrast for better readability</div>
                    </div>
                    <div class="toggle" id="set-high-contrast" onclick="toggleSetting('high-contrast','toggle')"></div>
                </div>
                <div class="setting-row">
                    <div class="setting-label">
                        <div class="s-name">Larger Text Mode</div>
                        <div class="s-hint">Scale up all text for easier reading</div>
                    </div>
                    <div class="toggle" id="set-large-text" onclick="toggleSetting('large-text','toggle')"></div>
                </div>
            </div>
        </div>
        <div class="settings-footer">
            <button class="settings-btn" onclick="resetSettings()">Reset to Default</button>
            <button class="settings-btn primary" onclick="saveSettings()">Save Changes</button>
        </div>
    </div>

    <!-- Announcement Toast -->
    <div class="announce-toast" id="announce-toast">
        <span class="announce-icon" id="announce-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </span>
        <span id="announce-swatch-wrap"></span>
        <span id="announce-text">Settings updated</span>
    </div>

    <!-- Footer -->
    <footer class="footer">
        DISPATCH Video Tutorial Library &middot; All tutorials in one place
    </footer>

    <script>
        // ===== Video Data =====
        // path: Learning Path (role-based) | level: Beginner / Intermediate / Advanced
        const VIDEOS = [
            // Getting Started
            { id: 'dashboard', title: 'Dashboard', desc: 'Overview and statistics walkthrough', category: 'Main', path: 'Getting Started', level: 'Beginner', src: 'videos/dashboard.mp4', duration: '2:30' },
            { id: 'login-signup-tutorial', title: 'Login & Sign Up', desc: 'Account creation and secure login', category: 'Account', path: 'Getting Started', level: 'Beginner', src: 'videos/login-signup-tutorial.mp4', duration: '—' },
            { id: 'settings', title: 'Settings', desc: 'Configure and customize the system', category: 'Account', path: 'Getting Started', level: 'Beginner', src: 'videos/settings.mp4', duration: '—' },
            { id: 'notifications', title: 'Notifications', desc: 'Real-time alerts and updates', category: 'Account', path: 'Getting Started', level: 'Beginner', src: 'videos/notifications.mp4', duration: '—' },

            // Dispatch & Operations
            { id: 'my-loads', title: 'My Loads', desc: 'Create, assign and track loads through dispatch', category: 'Operations', path: 'Dispatch & Operations', level: 'Intermediate', src: 'videos/my-loads.mp4', duration: '—' },
            { id: 'my-drivers', title: 'My Drivers', desc: 'View and manage your drivers', category: 'Operations', path: 'Dispatch & Operations', level: 'Intermediate', src: 'videos/how-to-register-new-drivers.mp4', duration: '3:45' },
            { id: 'my-customers', title: 'My Customers', desc: 'Add, view and manage your customers', category: 'Operations', path: 'Dispatch & Operations', level: 'Intermediate', src: 'videos/my-customers.mp4', duration: '—' },
            { id: 'my-shippers-list', title: 'My Shippers List', desc: 'Manage your list of shippers', category: 'Operations', path: 'Dispatch & Operations', level: 'Intermediate', src: 'videos/my-shippers-list.mp4', duration: '—' },
            { id: 'my-consignee-lists', title: 'My Consignee Lists', desc: 'Manage your consignee lists and locations', category: 'Operations', path: 'Dispatch & Operations', level: 'Intermediate', src: 'videos/my-consignee-lists.mp4', duration: '—' },
            { id: 'my-brokers', title: 'My Brokers', desc: 'Add and manage your brokers', category: 'Operations', path: 'Dispatch & Operations', level: 'Intermediate', src: 'videos/my-brokers.mp4', duration: '—' },
            { id: 'driver-devices', title: 'Driver Devices', desc: 'Manage driver devices and ELD connections', category: 'Operations', path: 'Dispatch & Operations', level: 'Intermediate', src: 'videos/driver-devices.mp4', duration: '—' },
            { id: 'activity', title: 'Activity', desc: 'System activity logs', category: 'Account', path: 'Dispatch & Operations', level: 'Intermediate', src: 'videos/activity.mp4', duration: '—' },

            // Fleet Management
            { id: 'my-trucks', title: 'My Trucks', desc: 'Add, view and manage your trucks', category: 'Operations', path: 'Fleet Management', level: 'Intermediate', src: 'videos/my-trucks.mp4', duration: '—' },
            { id: 'my-trailers', title: 'My Trailers', desc: 'Add, view and manage your trailers', category: 'Operations', path: 'Fleet Management', level: 'Intermediate', src: 'videos/my-trailers.mp4', duration: '—' },
            { id: 'truck-lease-pricing', title: 'Truck Lease Pricing', desc: 'Review and configure lease pricing', category: 'Fleet', path: 'Fleet Management', level: 'Advanced', src: 'videos/truck-lease-pricing.mp4', duration: '—' },
            { id: 'truck-rentals', title: 'Truck Rentals', desc: 'Manage truck rentals and equipment', category: 'Fleet', path: 'Fleet Management', level: 'Advanced', src: 'videos/truck-rentals.mp4', duration: '—' },
            { id: 'lease-agreements', title: 'Lease Agreements', desc: 'Create, sign and track lease agreements', category: 'Fleet', path: 'Fleet Management', level: 'Advanced', src: 'videos/lease-agreements.mp4', duration: '—' },
            { id: 'hire-drivers', title: 'Hire Drivers', desc: 'Recruit and onboard new drivers', category: 'Fleet', path: 'Fleet Management', level: 'Intermediate', src: 'videos/hire-drivers.mp4', duration: '—' },
            { id: 'job-postings', title: 'Job Postings', desc: 'Create and manage driver job postings', category: 'Fleet', path: 'Fleet Management', level: 'Intermediate', src: 'videos/job-postings.mp4', duration: '—' },
            { id: 'external-drivers', title: 'External Drivers', desc: 'Manage external and owner-operator drivers', category: 'Fleet', path: 'Fleet Management', level: 'Advanced', src: 'videos/external-drivers.mp4', duration: '—' },
            { id: 'shout-out-scripts', title: 'Shout Out Scripts', desc: 'Ready-made scripts for your marketing', category: 'Fleet', path: 'Fleet Management', level: 'Advanced', src: 'videos/shout-out-scripts.mp4', duration: '—' },
            { id: 'shout-out-vlogs', title: 'Shout Out Vlogs', desc: 'Shout out vlog examples and walkthroughs', category: 'Fleet', path: 'Fleet Management', level: 'Advanced', src: 'videos/shout-out-vlogs.mp4', duration: '—' },
            { id: 'maintenance', title: 'Maintenance', desc: 'Vehicle maintenance scheduling', category: 'Account', path: 'Fleet Management', level: 'Intermediate', src: 'videos/maintenance.mp4', duration: '—' },

            // Finance & Admin
            { id: 'accounting', title: 'Accounting', desc: 'Manage accounting and financial records', category: 'Finance', path: 'Finance & Admin', level: 'Advanced', src: 'videos/accounting.mp4', duration: '—' },
            { id: 'my-payroll', title: 'My Payroll', desc: 'Run and manage payroll', category: 'Finance', path: 'Finance & Admin', level: 'Intermediate', src: 'videos/my-payroll.mp4', duration: '—' },
            { id: 'my-factoring-company', title: 'My Factoring Company', desc: 'Connect and manage your factoring company', category: 'Finance', path: 'Finance & Admin', level: 'Advanced', src: 'videos/my-factoring-company.mp4', duration: '—' },
            { id: 'fuel-reports', title: 'Fuel Reports', desc: 'View fuel spending reports and analytics', category: 'Finance', path: 'Finance & Admin', level: 'Intermediate', src: 'videos/fuel-reports.mp4', duration: '—' },
            { id: 'my-fuel-cards', title: 'My Fuel Cards', desc: 'Manage fuel cards and spending limits', category: 'Finance', path: 'Finance & Admin', level: 'Intermediate', src: 'videos/my-fuel-cards.mp4', duration: '—' },
            { id: 'loans-cash-advance', title: 'Loans/Cash Advance', desc: 'Apply for and track loans and cash advances', category: 'Finance', path: 'Finance & Admin', level: 'Advanced', src: 'videos/loans-cash-advance.mp4', duration: '—' },
            { id: 'api-integration-keys', title: 'API Integration Keys', desc: 'Generate and manage API integration keys', category: 'Finance', path: 'Finance & Admin', level: 'Advanced', src: 'videos/api-integration-keys.mp4', duration: '—' },
            { id: 'documents', title: 'Documents', desc: 'Centralized document management', category: 'Account', path: 'Finance & Admin', level: 'Intermediate', src: 'videos/documents.mp4', duration: '—' },
            { id: 'permit-insurance', title: 'Permit & Insurance', desc: 'Permits, licenses and insurance', category: 'Account', path: 'Finance & Admin', level: 'Intermediate', src: 'videos/permit-insurance.mp4', duration: '—' },
            { id: 'reporting', title: 'Reporting', desc: 'Reports and operational insights', category: 'Account', path: 'Finance & Admin', level: 'Intermediate', src: 'videos/reporting.mp4', duration: '—' },

            // Safety & Compliance
            { id: 'my-fleet', title: 'My Fleet', desc: 'Monitor your fleet safety and compliance', category: 'Safety', path: 'Safety & Compliance', level: 'Intermediate', src: 'videos/my-fleet.mp4', duration: '—' },
            { id: 'emergency-monitoring', title: 'Emergency Monitoring', desc: 'Set up and respond to emergency alerts', category: 'Safety', path: 'Safety & Compliance', level: 'Advanced', src: 'videos/emergency-monitoring.mp4', duration: '—' },
            { id: 'safety-assessments', title: 'Safety Assessments', desc: 'Run and review safety assessments', category: 'Safety', path: 'Safety & Compliance', level: 'Advanced', src: 'videos/safety-assessments.mp4', duration: '—' },
            { id: 'maintenance-monitoring', title: 'Maintenance Monitoring', desc: 'Monitor maintenance and vehicle health', category: 'Safety', path: 'Safety & Compliance', level: 'Intermediate', src: 'videos/maintenance-monitoring.mp4', duration: '—' },
            { id: 'safety-violations', title: 'Safety Violations', desc: 'Safety-related compliance issues', category: 'Safety', path: 'Safety & Compliance', level: 'Advanced', src: 'videos/safety-violations.mp4', duration: '—' },
            { id: 'compliance-monitoring', title: 'Compliance Monitoring', desc: 'Track compliance metrics in real time', category: 'Compliance', path: 'Safety & Compliance', level: 'Intermediate', src: 'videos/compliance-monitoring.mp4', duration: '—' },
            { id: 'compliance-software-options', title: 'Compliance Software Options', desc: 'Explore compliance software integrations', category: 'Compliance', path: 'Safety & Compliance', level: 'Advanced', src: 'videos/compliance-software-options.mp4', duration: '—' },
            { id: 'drug-alcohol-testing', title: 'Drug & Alcohol Testing', desc: 'Manage drug and alcohol testing programs', category: 'Compliance', path: 'Safety & Compliance', level: 'Advanced', src: 'videos/drug-alcohol-testing.mp4', duration: '—' },
            { id: 'violations', title: 'Violations', desc: 'Track compliance violations', category: 'Compliance', path: 'Safety & Compliance', level: 'Intermediate', src: 'videos/violations.mp4', duration: '—' },
            { id: 'driver-violations', title: 'Driver Violations', desc: 'Driver-specific violations', category: 'Compliance', path: 'Safety & Compliance', level: 'Advanced', src: 'videos/driver-violations.mp4', duration: '—' },
            { id: 'vehicle-violations', title: 'Vehicle Violations', desc: 'Vehicle-related violations', category: 'Compliance', path: 'Safety & Compliance', level: 'Advanced', src: 'videos/vehicle-violations.mp4', duration: '—' },
            { id: 'hos', title: 'HOS', desc: 'Hours of Service compliance', category: 'Compliance', path: 'Safety & Compliance', level: 'Advanced', src: 'videos/hos.mp4', duration: '—' },
        ];

        // Videos that actually exist on the server
        const AVAILABLE_VIDEOS = ['videos/dashboard.mp4', 'videos/how-to-register-new-drivers.mp4'];

        let currentFilter = 'all';
        let currentVideo = null;
        let watchHistory = [];
        let favorites = [];
        let videoProgress = {};

        function isAvailable(src) { return AVAILABLE_VIDEOS.indexOf(src) !== -1; }

        // Escape HTML to prevent XSS
        function escapeHtml(str) {
            if (typeof str !== 'string') return '';
            return str
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        // Load user data from localStorage
        function loadUserData() {
            try {
                watchHistory = JSON.parse(localStorage.getItem('dispatch-watch-history') || '[]');
                favorites = JSON.parse(localStorage.getItem('dispatch-favorites') || '[]');
                videoProgress = JSON.parse(localStorage.getItem('dispatch-video-progress') || '{}');
                // Validate watchHistory structure
                if (!Array.isArray(watchHistory)) watchHistory = [];
                watchHistory = watchHistory.filter(function(v) {
                    return v && typeof v.id === 'string' && typeof v.title === 'string';
                });
                // Validate favorites structure
                if (!Array.isArray(favorites)) favorites = [];
                favorites = favorites.filter(function(v) { return typeof v === 'string'; });
                // Validate videoProgress structure
                if (typeof videoProgress !== 'object' || videoProgress === null) videoProgress = {};
            } catch (e) {
                watchHistory = [];
                favorites = [];
                videoProgress = {};
            }
        }

        // Save user data to localStorage
        function saveUserData() {
            try {
                localStorage.setItem('dispatch-watch-history', JSON.stringify(watchHistory));
                localStorage.setItem('dispatch-favorites', JSON.stringify(favorites));
                localStorage.setItem('dispatch-video-progress', JSON.stringify(videoProgress));
            } catch (e) {}
        }

        // Add video to watch history
        function addToWatchHistory(video) {
            const existingIndex = watchHistory.findIndex(function(v) { return v.id === video.id; });
            if (existingIndex !== -1) {
                watchHistory.splice(existingIndex, 1);
            }
            watchHistory.unshift({
                id: video.id,
                title: video.title,
                desc: video.desc,
                src: video.src,
                category: video.category,
                timestamp: Date.now()
            });
            if (watchHistory.length > 8) watchHistory.pop();
            saveUserData();
            renderWatchHistory();
        }

        // Clear watch history
        function clearWatchHistory() {
            watchHistory = [];
            saveUserData();
            renderWatchHistory();
        }

        // Render watch history section
        function renderWatchHistory() {
            const container = document.getElementById('watch-history');
            const grid = document.getElementById('watch-history-grid');
            if (!container || !grid) return;

            if (watchHistory.length === 0) {
                container.style.display = 'none';
                return;
            }

            container.style.display = 'block';
            grid.innerHTML = '';

            watchHistory.forEach(function(v) {
                const item = document.createElement('div');
                item.className = 'history-item';
                item.onclick = function() {
                    const video = VIDEOS.find(function(vid) { return vid.id === v.id; });
                    if (video) openModal(video);
                };

                const timeAgo = getTimeAgo(v.timestamp);
                const available = isAvailable(v.src);

                // Hover-to-play for history items
                if (available) {
                    let hoverTimer = null;
                    item.addEventListener('mouseenter', function() {
                        const vid = item.querySelector('.history-thumb video');
                        if (!vid) return;
                        hoverTimer = setTimeout(function() {
                            vid.currentTime = 0;
                            vid.play().catch(function() {});
                        }, 300);
                    });
                    item.addEventListener('mouseleave', function() {
                        if (hoverTimer) { clearTimeout(hoverTimer); hoverTimer = null; }
                        const vid = item.querySelector('.history-thumb video');
                        if (!vid) return;
                        vid.pause();
                        vid.currentTime = 0;
                    });
                }

                item.innerHTML =
                    '<div class="history-thumb">' +
                        (available ? '<video muted preload="metadata"><source src="' + escapeHtml(v.src) + '" type="video/mp4"></video>' : '<div style="width:100%;height:100%;background:var(--surface-2);display:grid;place-items:center;"><svg style="width:20px;height:20px;color:var(--text-dim)" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg></div>') +
                    '</div>' +
                    '<div class="history-info">' +
                        '<h4>' + escapeHtml(v.title) + '</h4>' +
                        '<p>' + escapeHtml(v.category) + '</p>' +
                    '</div>' +
                    '<span class="history-time">' + escapeHtml(timeAgo) + '</span>';
                grid.appendChild(item);
            });
        }

        // Get time ago string
        function getTimeAgo(timestamp) {
            const seconds = Math.floor((Date.now() - timestamp) / 1000);
            if (seconds < 60) return 'Just now';
            if (seconds < 3600) return Math.floor(seconds / 60) + 'm ago';
            if (seconds < 86400) return Math.floor(seconds / 3600) + 'h ago';
            return Math.floor(seconds / 86400) + 'd ago';
        }

        // Toggle favorite
        function toggleFavorite(videoId, event) {
            if (event) event.stopPropagation();
            const index = favorites.indexOf(videoId);
            if (index === -1) {
                favorites.push(videoId);
                showAnnouncement('Added to favorites');
            } else {
                favorites.splice(index, 1);
                showAnnouncement('Removed from favorites');
            }
            saveUserData();
            renderVideos();
            updateModalFavoriteButton();
        }

        // Toggle favorite from modal
        function toggleFavoriteFromModal() {
            if (currentVideo) {
                toggleFavorite(currentVideo.id);
            }
        }

        // Update modal favorite button state
        function updateModalFavoriteButton() {
            const btn = document.getElementById('modal-favorite-btn');
            if (!btn || !currentVideo) return;
            const isFav = favorites.indexOf(currentVideo.id) !== -1;
            btn.classList.toggle('active', isFav);
        }

        // Update video progress
        function updateVideoProgress(videoId, currentTime, duration) {
            if (!duration || duration === 0) return;
            const progress = (currentTime / duration) * 100;
            videoProgress[videoId] = {
                currentTime: currentTime,
                duration: duration,
                progress: progress,
                timestamp: Date.now()
            };
            saveUserData();
        }

        // Toggle Picture-in-Picture
        function togglePiP() {
            const video = document.getElementById('modal-video');
            if (!video) return;

            if (document.pictureInPictureElement) {
                document.exitPictureInPicture().catch(function(e) {});
            } else if (video.readyState >= 2) {
                video.requestPictureInPicture().catch(function(e) {
                    showAnnouncement('Picture-in-Picture not supported');
                });
            }
        }

        // Render related videos
        function renderRelatedVideos(currentVideo) {
            const container = document.getElementById('related-videos');
            const list = document.getElementById('related-list');
            if (!container || !list || !currentVideo) return;

            const related = VIDEOS.filter(function(v) {
                return v.id !== currentVideo.id && v.path === currentVideo.path;
            }).slice(0, 8);

            // If not enough from same path, fill from same category
            if (related.length < 4) {
                const extra = VIDEOS.filter(function(v) {
                    return v.id !== currentVideo.id && v.path !== currentVideo.path && v.category === currentVideo.category;
                }).slice(0, 8 - related.length);
                related.push.apply(related, extra);
            }

            if (related.length === 0) {
                container.style.display = 'none';
                return;
            }

            container.style.display = 'flex';
            list.innerHTML = '';

            related.forEach(function(v) {
                const item = document.createElement('div');
                item.className = 'related-item';
                item.onclick = function() {
                    openModal(v);
                };

                const available = isAvailable(v.src);

                // Hover-to-play for related items
                if (available) {
                    let hoverTimer = null;
                    item.addEventListener('mouseenter', function() {
                        const vid = item.querySelector('.related-item-thumb video');
                        if (!vid) return;
                        hoverTimer = setTimeout(function() {
                            vid.currentTime = 0;
                            vid.play().catch(function() {});
                        }, 300);
                    });
                    item.addEventListener('mouseleave', function() {
                        if (hoverTimer) { clearTimeout(hoverTimer); hoverTimer = null; }
                        const vid = item.querySelector('.related-item-thumb video');
                        if (!vid) return;
                        vid.pause();
                        vid.currentTime = 0;
                    });
                }

                item.innerHTML =
                    '<div class="related-item-thumb">' +
                        (available ? '<video muted preload="metadata"><source src="' + escapeHtml(v.src) + '" type="video/mp4"></video>' : '<div style="width:100%;height:100%;background:#000;display:grid;place-items:center;"><svg style="width:20px;height:20px;color:rgba(255,255,255,0.45);opacity:0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg></div>') +
                    '</div>' +
                    '<div class="related-item-info">' +
                        '<h5>' + escapeHtml(v.title) + '</h5>' +
                        '<p>' + escapeHtml(v.category) + ' · ' + escapeHtml(v.level || 'Beginner') + '</p>' +
                    '</div>';
                list.appendChild(item);
            });
        }

        function renderVideos() {
            const grid = document.getElementById('video-grid');
            const searchTerm = document.getElementById('search-input').value.toLowerCase().trim();
            grid.innerHTML = '';

            const filtered = VIDEOS.filter(function(v) {
                const matchesFilter = currentFilter === 'all' || v.path === currentFilter;
                const matchesSearch = !searchTerm ||
                    v.title.toLowerCase().indexOf(searchTerm) !== -1 ||
                    v.desc.toLowerCase().indexOf(searchTerm) !== -1 ||
                    v.path.toLowerCase().indexOf(searchTerm) !== -1 ||
                    v.category.toLowerCase().indexOf(searchTerm) !== -1;
                return matchesFilter && matchesSearch;
            });

            if (filtered.length === 0) {
                document.getElementById('no-results').classList.add('show');
            } else {
                document.getElementById('no-results').classList.remove('show');
            }

            filtered.forEach(function(v, idx) {
                const available = isAvailable(v.src);
                const isFav = favorites.indexOf(v.id) !== -1;
                const levelClass = (v.level || 'Beginner').toLowerCase();
                const avatarLetter = v.title.charAt(0).toUpperCase();

                const card = document.createElement('div');
                card.className = 'video-card';
                card.style.animationDelay = Math.min(idx * 0.04, 0.4) + 's';
                card.onclick = function(e) {
                    if (!e.target.closest('.favorite-btn')) {
                        openModal(v);
                    }
                };
                // Hover-to-play: play the thumbnail video on mouseenter, pause on mouseleave
                if (available) {
                    let hoverTimer = null;
                    card.addEventListener('mouseenter', function() {
                        const vid = card.querySelector('.video-thumb video');
                        if (!vid) return;
                        hoverTimer = setTimeout(function() {
                            vid.currentTime = 0;
                            vid.play().catch(function() {});
                        }, 300);
                    });
                    card.addEventListener('mouseleave', function() {
                        if (hoverTimer) { clearTimeout(hoverTimer); hoverTimer = null; }
                        const vid = card.querySelector('.video-thumb video');
                        if (!vid) return;
                        vid.pause();
                        vid.currentTime = 0;
                    });
                }

                const thumb = available
                    ? '<video muted preload="metadata"><source src="' + escapeHtml(v.src) + '" type="video/mp4"></video>'
                    : '<div class="video-empty"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg><span>Coming Soon</span></div>';

                card.innerHTML =
                    '<div class="video-thumb">' +
                        '<span class="category-badge">' + escapeHtml(v.path) + '</span>' +
                        thumb +
                        '<button class="favorite-btn' + (isFav ? ' active' : '') + '" onclick="toggleFavorite(\'' + escapeHtml(v.id) + '\', event)" title="Add to favorites" style="display:none;">' +
                            '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>' +
                        '</button>' +
                        (available ? '<span class="duration-badge">' + escapeHtml(v.duration) + '</span>' : '') +
                    '</div>' +
                    '<div class="video-info">' +
                        '<div class="video-avatar">' + escapeHtml(avatarLetter) + '</div>' +
                        '<div class="video-info-body">' +
                            '<h3>' + escapeHtml(v.title) + '</h3>' +
                            '<div class="video-channel">' +
                                '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>' +
                                escapeHtml(v.category) +
                            '</div>' +
                            '<div class="video-meta">' +
                                '<span class="skill-badge ' + levelClass + '">' + escapeHtml(v.level || 'Beginner') + '</span>' +
                                (available
                                    ? '<span><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Available</span>'
                                    : '<span><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Soon</span>') +
                            '</div>' +
                        '</div>' +
                    '</div>';
                grid.appendChild(card);
            });
        }

        function setFilter(category, el) {
            currentFilter = category;
            document.querySelectorAll('.chip').forEach(function(c) { c.classList.remove('active'); });
            document.querySelectorAll('.sb-item[data-cat]').forEach(function(s) { s.classList.remove('active'); });
            // Sync both chip and sidebar controls
            document.querySelectorAll('.chip[data-cat="' + category + '"]').forEach(function(c) { c.classList.add('active'); });
            document.querySelectorAll('.sb-item[data-cat="' + category + '"]').forEach(function(s) { s.classList.add('active'); });
            renderVideos();
            // Close mobile sidebar after selection
            if (window.innerWidth <= 1024) closeSidebar();
        }

        function filterVideos() { renderVideos(); }
        function filterVideosMobile(val) {
            document.getElementById('search-input').value = val;
            renderVideos();
        }

        function openModal(v) {
            currentVideo = v;
            const overlay = document.getElementById('modal-overlay');
            const video = document.getElementById('modal-video');
            document.getElementById('modal-title').textContent = v.title;
            document.getElementById('modal-desc').textContent = v.desc;
            document.getElementById('modal-topbar-title').textContent = v.title;
            // Channel info
            const avatar = document.getElementById('modal-avatar');
            if (avatar) avatar.textContent = v.title.charAt(0).toUpperCase();
            const channelName = document.getElementById('modal-channel-name');
            if (channelName) channelName.textContent = v.category + ' · DISPATCH';
            const channelSub = document.getElementById('modal-channel-sub');
            if (channelSub) channelSub.textContent = v.path + ' · ' + (v.level || 'Beginner');
            // Tags
            const tagsEl = document.getElementById('modal-video-tags');
            if (tagsEl) {
                const levelClass = (v.level || 'Beginner').toLowerCase();
                tagsEl.innerHTML = '<span class="skill-badge ' + levelClass + '">' + escapeHtml(v.level || 'Beginner') + '</span>' +
                    (isAvailable(v.src) ? '<span class="skill-badge beginner">Available</span>' : '<span class="skill-badge advanced">Coming Soon</span>');
            }
            const settings = loadSettings();

            // Add to watch history
            addToWatchHistory(v);

            // Update favorite button
            updateModalFavoriteButton();

            // Update download button
            const dlBtn = document.getElementById('modal-download-btn');
            if (dlBtn) {
                if (isAvailable(v.src)) {
                    dlBtn.href = v.src;
                    dlBtn.download = v.id + '.mp4';
                    dlBtn.style.display = 'grid';
                } else {
                    dlBtn.removeAttribute('href');
                    dlBtn.style.display = 'none';
                }
            }

            // Render related videos
            renderRelatedVideos(v);

            // Always clean up previous state: pause old video, remove stale empty overlay
            try { video.pause(); } catch (e) {}
            const frame = video.parentElement;
            const prevEmpty = frame.querySelector('.video-empty');
            if (prevEmpty) prevEmpty.remove();

            if (isAvailable(v.src)) {
                video.innerHTML = '<source src="' + escapeHtml(v.src) + '" type="video/mp4">';
                video.style.display = 'block';
                video.load();
                video.playbackRate = parseFloat(settings['playback-speed'] || '1');

                // Restore progress and autoplay AFTER metadata loads (setting currentTime
                // before the media is ready silently fails and can block playback)
                video.onloadedmetadata = function() {
                    if (videoProgress[v.id] && videoProgress[v.id].currentTime > 0 && videoProgress[v.id].currentTime < video.duration) {
                        try { video.currentTime = videoProgress[v.id].currentTime; } catch (e) {}
                    }
                    if (settings['autoplay']) {
                        video.play().catch(function() {});
                    }
                };

                // Track progress
                video.ontimeupdate = function() {
                    updateVideoProgress(v.id, video.currentTime, video.duration);
                };
            } else {
                video.innerHTML = '';
                video.style.display = 'none';
                video.onloadedmetadata = null;
                video.ontimeupdate = null;
                let empty = document.createElement('div');
                empty.className = 'video-empty';
                empty.style.position = 'absolute';
                empty.style.inset = '0';
                empty.style.display = 'flex';
                empty.style.flexDirection = 'column';
                empty.style.alignItems = 'center';
                empty.style.justifyContent = 'center';
                empty.style.gap = '0.5rem';
                empty.style.background = 'var(--surface-2)';
                empty.style.color = 'var(--text-dim)';
                empty.innerHTML = '<svg style="width:48px;height:48px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg><span>No video available for this tutorial yet.</span>';
                frame.style.position = 'relative';
                frame.appendChild(empty);
            }
            overlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(e) {
            if (e && e.target !== document.getElementById('modal-overlay')) return;
            const overlay = document.getElementById('modal-overlay');
            const video = document.getElementById('modal-video');
            video.pause();
            video.innerHTML = '';
            const empty = video.parentElement.querySelector('.video-empty');
            if (empty) empty.remove();
            overlay.classList.remove('open');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
            // Space to play/pause when modal is open
            if (e.key === ' ' && document.getElementById('modal-overlay').classList.contains('open')) {
                e.preventDefault();
                const video = document.getElementById('modal-video');
                if (video && video.style.display !== 'none') {
                    if (video.paused) video.play(); else video.pause();
                }
            }
            // Arrow keys for navigation
            if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
                if (document.getElementById('modal-overlay').classList.contains('open') && currentVideo) {
                    const currentIndex = VIDEOS.findIndex(function(v) { return v.id === currentVideo.id; });
                    let newIndex;
                    if (e.key === 'ArrowLeft') {
                        newIndex = currentIndex > 0 ? currentIndex - 1 : VIDEOS.length - 1;
                    } else {
                        newIndex = currentIndex < VIDEOS.length - 1 ? currentIndex + 1 : 0;
                    }
                    closeModal({ target: document.getElementById('modal-overlay') });
                    setTimeout(function() { openModal(VIDEOS[newIndex]); }, 100);
                }
            }
        });

        function updateBackgroundSVG() {
            const isDark = !document.documentElement.classList.contains('light');
            const darkSVG = document.getElementById('bg-svg-dark');
            const lightSVG = document.getElementById('bg-svg-light');
            if (darkSVG) darkSVG.style.display = isDark ? 'block' : 'none';
            if (lightSVG) lightSVG.style.display = isDark ? 'none' : 'block';
        }

        // ===== Announcement Toast =====
        let announceTimer = null;
        function showAnnouncement(text, opts) {
            opts = opts || {};
            const toast = document.getElementById('announce-toast');
            const textEl = document.getElementById('announce-text');
            const iconEl = document.getElementById('announce-icon');
            const swatchWrap = document.getElementById('announce-swatch-wrap');
            if (!toast || !textEl) return;
            textEl.textContent = text;
            // Icon
            if (opts.icon === 'palette') {
                iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h8a2 2 0 002-2V5a2 2 0 00-2-2H9m4 18a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4z"/></svg>';
            } else if (opts.icon === 'theme') {
                iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>';
            } else if (opts.icon === 'reset') {
                iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>';
            } else if (opts.icon === 'sidebar') {
                iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>';
            } else {
                iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
            }
            // Color swatch
            if (opts.swatch) {
                swatchWrap.innerHTML = '<span class="announce-swatch" style="background:' + escapeHtml(opts.swatch) + '"></span>';
            } else {
                swatchWrap.innerHTML = '';
            }
            toast.classList.add('show');
            if (announceTimer) clearTimeout(announceTimer);
            announceTimer = setTimeout(function() { toast.classList.remove('show'); }, 2600);
        }

        function updateThemeIcons() {
            const isDark = !document.documentElement.classList.contains('light');
            const moonIcon = document.querySelector('.theme-btn .moon-icon');
            const sunIcon = document.querySelector('.theme-btn .sun-icon');
            if (moonIcon && sunIcon) {
                moonIcon.style.display = isDark ? 'block' : 'none';
                sunIcon.style.display = isDark ? 'none' : 'block';
            }
        }
        function toggleTheme() {
            document.documentElement.classList.toggle('light');
            const isLight = document.documentElement.classList.contains('light');
            try { localStorage.setItem('dispatch-theme', isLight ? 'light' : 'dark'); } catch (e) {}
            // Also sync to dispatch-settings
            try {
                const settings = JSON.parse(localStorage.getItem('dispatch-settings') || '{}');
                settings['dark-mode'] = !isLight;
                localStorage.setItem('dispatch-settings', JSON.stringify(settings));
            } catch (e) {}
            const darkToggle = document.getElementById('set-dark-mode');
            if (darkToggle) darkToggle.classList.toggle('on', !isLight);
            updateThemeIcons();
            updateBackgroundSVG();
            saveSettingsImmediate();
            showAnnouncement(isDark ? 'Dark mode enabled' : 'Light mode enabled', { icon: 'theme' });
        }

        // ===== Settings (synced with index.php via localStorage) =====
        const SETTINGS_DEFAULTS = {
            'dark-mode': true,
            'autoplay': false,
            'sidebar-collapsed': false,
            'sync-search': true,
            'reduce-motion': false,
            'high-contrast': false,
            'large-text': false,
            'accent-color': '#10b981',
            'font-size': '15',
            'playback-speed': '1',
            'video-quality': 'auto'
        };

        function loadSettings() {
            let saved = {};
            try { saved = JSON.parse(localStorage.getItem('dispatch-settings') || '{}'); } catch (e) {}
            return Object.assign({}, SETTINGS_DEFAULTS, saved);
        }

        function toggleSettings() {
            const panel = document.getElementById('settings-panel');
            const overlay = document.getElementById('settings-overlay');
            const isOpen = panel.classList.contains('open');
            panel.classList.toggle('open');
            overlay.classList.toggle('open');
            if (!isOpen) applySettingsToUI();
        }

        const SETTING_LABELS = {
            'dark-mode': 'Dark mode',
            'autoplay': 'Autoplay',
            'sidebar-collapsed': 'Mini sidebar',
            'sync-search': 'Sync search',
            'reduce-motion': 'Reduce motion',
            'high-contrast': 'High contrast',
            'large-text': 'Larger text'
        };

        function toggleSetting(key, type) {
            const el = document.getElementById('set-' + key);
            if (!el) return;
            const isOn = el.classList.toggle('on');
            applySetting(key, isOn);
            saveSettingsImmediate();
            const label = SETTING_LABELS[key] || key;
            showAnnouncement(label + ' ' + (isOn ? 'enabled' : 'disabled'));
        }

        function applySetting(key, value) {
            const settings = loadSettings();
            settings[key] = value;
            try { localStorage.setItem('dispatch-settings', JSON.stringify(settings)); } catch (e) {}
            switch (key) {
                case 'dark-mode':
                    if (value) document.documentElement.classList.remove('light');
                    else document.documentElement.classList.add('light');
                    try { localStorage.setItem('dispatch-theme', value ? 'dark' : 'light'); } catch(e) {}
                    updateBackgroundSVG();
                    showAnnouncement(value ? 'Dark mode enabled' : 'Light mode enabled', { icon: 'theme' });
                    break;
                case 'reduce-motion':
                    if (value) document.body.classList.add('reduce-motion');
                    else document.body.classList.remove('reduce-motion');
                    break;
                case 'high-contrast':
                    if (value) document.body.classList.add('high-contrast');
                    else document.body.classList.remove('high-contrast');
                    break;
                case 'large-text':
                    if (value) document.documentElement.style.fontSize = '18px';
                    else document.documentElement.style.fontSize = settings['font-size'] + 'px';
                    break;
                case 'sidebar-collapsed':
                    if (window.innerWidth > 1024) {
                        const sidebar = document.getElementById('yt-sidebar');
                        const main = document.getElementById('main-content');
                        if (value) {
                            sidebar.classList.add('collapsed');
                            main.classList.add('sidebar-collapsed');
                        } else {
                            sidebar.classList.remove('collapsed');
                            main.classList.remove('sidebar-collapsed');
                        }
                    }
                    showAnnouncement(value ? 'Mini sidebar enabled' : 'Full sidebar enabled', { icon: 'sidebar' });
                    break;
                case 'autoplay':
                case 'sync-search':
                    // Stored for use by other functions
                    break;
            }
        }

        function setAccentColor(color) {
            document.querySelectorAll('#set-accent-colors .color-swatch').forEach(function(s) {
                s.classList.toggle('active', s.dataset.color === color);
            });
            document.documentElement.style.setProperty('--accent', color);
            document.documentElement.style.setProperty('--accent-soft', color + '22');
            applySetting('accent-color', color);
            saveSettingsImmediate();
            showAnnouncement('Accent color changed', { icon: 'palette' });
        }

        function setFontSize(val) {
            document.getElementById('font-size-value').textContent = val + 'px';
            const settings = loadSettings();
            if (!settings['large-text']) document.documentElement.style.fontSize = val + 'px';
            applySetting('font-size', val);
            saveSettingsImmediate();
            showAnnouncement('Font size set to ' + val + 'px');
        }

        function setPlaybackSpeed(val) {
            const video = document.getElementById('modal-video');
            if (video) video.playbackRate = parseFloat(val);
            applySetting('playback-speed', val);
            saveSettingsImmediate();
            showAnnouncement('Playback speed set to ' + val + 'x');
        }

        function setVideoQuality(val) {
            applySetting('video-quality', val);
            saveSettingsImmediate();
            showAnnouncement('Video quality set to ' + val);
        }

        function saveSettingsImmediate() {
            const settings = loadSettings();
            ['dark-mode','autoplay','sidebar-collapsed','sync-search','reduce-motion','high-contrast','large-text'].forEach(function(key) {
                const el = document.getElementById('set-' + key);
                if (el) settings[key] = el.classList.contains('on');
            });
            ['playback-speed','video-quality'].forEach(function(key) {
                const el = document.getElementById('set-' + key);
                if (el) settings[key] = el.value;
            });
            const activeSwatch = document.querySelector('#set-accent-colors .color-swatch.active');
            if (activeSwatch) settings['accent-color'] = activeSwatch.dataset.color;
            const fontSizeEl = document.getElementById('set-font-size');
            if (fontSizeEl) settings['font-size'] = fontSizeEl.value;
            try { localStorage.setItem('dispatch-settings', JSON.stringify(settings)); } catch (e) {}
        }

        function saveSettings() {
            saveSettingsImmediate();
            const btn = event.target;
            const orig = btn.textContent;
            btn.textContent = 'Saved!';
            btn.style.background = '#059669';
            setTimeout(function() { btn.textContent = orig; btn.style.background = ''; }, 1500);
        }

        function resetSettings() {
            try { localStorage.removeItem('dispatch-settings'); } catch (e) {}
            document.documentElement.style.setProperty('--accent', '#10b981');
            document.documentElement.style.setProperty('--accent-soft', 'rgba(16, 185, 129, 0.14)');
            document.documentElement.style.fontSize = '15px';
            document.body.classList.remove('reduce-motion', 'high-contrast');
            document.documentElement.classList.remove('light');
            try { localStorage.setItem('dispatch-theme', 'dark'); } catch(e) {}
            updateBackgroundSVG();
            applySettingsToUI();
            showAnnouncement('Settings reset to default', { icon: 'reset' });
        }

        function applySettingsToUI() {
            const s = loadSettings();
            // Toggles
            ['dark-mode','autoplay','sidebar-collapsed','sync-search','reduce-motion','high-contrast','large-text'].forEach(function(key) {
                const el = document.getElementById('set-' + key);
                if (el) el.classList.toggle('on', !!s[key]);
            });
            // Selects
            ['playback-speed','video-quality'].forEach(function(key) {
                const el = document.getElementById('set-' + key);
                if (el) el.value = s[key];
            });
            // Font size
            const fsEl = document.getElementById('set-font-size');
            if (fsEl) { fsEl.value = s['font-size']; document.getElementById('font-size-value').textContent = s['font-size'] + 'px'; }
            // Accent color
            document.querySelectorAll('#set-accent-colors .color-swatch').forEach(function(sw) {
                sw.classList.toggle('active', sw.dataset.color === s['accent-color']);
            });
            // Apply to DOM
            document.documentElement.style.setProperty('--accent', s['accent-color']);
            document.documentElement.style.setProperty('--accent-soft', s['accent-color'] + '22');
            if (s['large-text']) document.documentElement.style.fontSize = '18px';
            else document.documentElement.style.fontSize = s['font-size'] + 'px';
            if (s['reduce-motion']) document.body.classList.add('reduce-motion'); else document.body.classList.remove('reduce-motion');
            if (s['high-contrast']) document.body.classList.add('high-contrast'); else document.body.classList.remove('high-contrast');
            if (s['dark-mode']) document.documentElement.classList.remove('light'); else document.documentElement.classList.add('light');
            updateBackgroundSVG();
        }

        function initSettingsOnLoad() {
            const s = loadSettings();
            document.documentElement.style.setProperty('--accent', s['accent-color']);
            document.documentElement.style.setProperty('--accent-soft', s['accent-color'] + '22');
            if (s['large-text']) document.documentElement.style.fontSize = '18px';
            else document.documentElement.style.fontSize = s['font-size'] + 'px';
            if (s['reduce-motion']) document.body.classList.add('reduce-motion');
            if (s['high-contrast']) document.body.classList.add('high-contrast');
            // Check dispatch-theme first, then dispatch-settings dark-mode
            const themeKey = localStorage.getItem('dispatch-theme');
            let isLight = (themeKey === 'light');
            if (!themeKey) isLight = (s['dark-mode'] === false);
            if (isLight) document.documentElement.classList.add('light');
            else document.documentElement.classList.remove('light');
            // Apply sidebar-collapsed on desktop
            if (s['sidebar-collapsed'] && window.innerWidth > 1024) {
                const sidebar = document.getElementById('yt-sidebar');
                const main = document.getElementById('main-content');
                if (sidebar) sidebar.classList.add('collapsed');
                if (main) main.classList.add('sidebar-collapsed');
            }
            updateBackgroundSVG();
        }

        // ===== Sidebar Toggle (YouTube-style) =====
        function toggleSidebar() {
            const sidebar = document.getElementById('yt-sidebar');
            const main = document.getElementById('main-content');
            const backdrop = document.getElementById('sb-backdrop');
            if (window.innerWidth <= 1024) {
                const isOpen = sidebar.classList.toggle('open');
                if (backdrop) backdrop.classList.toggle('open', isOpen);
            } else {
                sidebar.classList.toggle('collapsed');
                main.classList.toggle('sidebar-collapsed');
                const isCollapsed = sidebar.classList.contains('collapsed');
                applySetting('sidebar-collapsed', isCollapsed);
                saveSettingsImmediate();
            }
        }
        function closeSidebar() {
            const sidebar = document.getElementById('yt-sidebar');
            const backdrop = document.getElementById('sb-backdrop');
            if (window.innerWidth <= 1024) {
                sidebar.classList.remove('open');
                if (backdrop) backdrop.classList.remove('open');
            }
        }
        function toggleMobileSearch() {
            const overlay = document.getElementById('mobile-search-overlay');
            if (overlay) {
                const isOpen = overlay.classList.toggle('open');
                if (isOpen) {
                    const input = document.getElementById('mobile-search-input');
                    if (input) setTimeout(function() { input.focus(); }, 100);
                }
            }
        }

        // Initialize settings on load
        initSettingsOnLoad();
        updateThemeIcons();

        // Sync theme and settings when changed in other tabs
        window.addEventListener('storage', function(e) {
            if (e.key === 'dispatch-theme' || e.key === 'dispatch-settings') {
                initSettingsOnLoad();
                applySettingsToUI();
                updateThemeIcons();
            }
        });

        // Load user data and render watch history
        loadUserData();
        renderWatchHistory();

        // Update stats and render
        function updateStats() {
            // Update filter chip counts
            var allEl = document.getElementById('count-all');
            if (allEl) allEl.textContent = VIDEOS.length;
            var pathCounts = {};
            VIDEOS.forEach(function(v) { pathCounts[v.path] = (pathCounts[v.path] || 0) + 1; });
            // Map path names to element IDs (spaces/& replaced with -)
            var pathIdMap = {
                'Getting Started': 'count-Getting-Started',
                'Dispatch & Operations': 'count-Dispatch-Operations',
                'Fleet Management': 'count-Fleet-Management',
                'Finance & Admin': 'count-Finance-Admin',
                'Safety & Compliance': 'count-Safety-Compliance'
            };
            Object.keys(pathCounts).forEach(function(path) {
                var el = document.getElementById(pathIdMap[path] || ('count-' + path.replace(/[^a-zA-Z0-9]/g, '-')));
                if (el) el.textContent = pathCounts[path];
            });
        }

        updateStats();
        renderVideos();

        // Open modal from hash if present
        (function openFromHash() {
            const hash = window.location.hash.replace('#', '');
            if (hash) {
                const video = VIDEOS.find(function(v) { return v.id === hash; });
                if (video) setTimeout(function() { openModal(video); }, 900);
            }
        })();

        // Hide loading screen on page load
        window.addEventListener('load', function() {
            setTimeout(function() {
                const loader = document.getElementById('loader-screen');
                if (loader) loader.classList.add('hidden');
                setTimeout(function() { if (loader) loader.style.display = 'none'; }, 600);
            }, 800);
        });
    </script>
    <script src="js/tour-guide.js?v=1"></script>
</body>
</html>
