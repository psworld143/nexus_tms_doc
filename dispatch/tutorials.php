<?php
// Dispatch Video Tutorial Library — standalone page
// Displays all dispatch tutorial videos in a clean grid layout
?>
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DISPATCH · Video Tutorial Library</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0a1220;
            --bg-grad-1: #0d1a2f;
            --bg-grad-2: #0a1220;
            --surface: rgba(255, 255, 255, 0.04);
            --surface-2: rgba(255, 255, 255, 0.06);
            --surface-solid: #111c30;
            --border: rgba(255, 255, 255, 0.08);
            --border-strong: rgba(255, 255, 255, 0.14);
            --text: #e8eef7;
            --text-muted: #8ea0b8;
            --text-dim: #5f7189;
            --accent: #10b981;
            --accent-soft: rgba(16, 185, 129, 0.14);
            --accent-2: #38bdf8;
            --danger: #f43f5e;
            --shadow: 0 20px 40px -20px rgba(0, 0, 0, 0.6);
        }
        html:not(.dark) {
            --bg: #eef2f7;
            --bg-grad-1: #f4f7fb;
            --bg-grad-2: #e7edf5;
            --surface: rgba(15, 23, 42, 0.02);
            --surface-2: rgba(15, 23, 42, 0.04);
            --surface-solid: #ffffff;
            --border: rgba(15, 23, 42, 0.08);
            --border-strong: rgba(15, 23, 42, 0.14);
            --text: #0f172a;
            --text-muted: #55627a;
            --text-dim: #8a96ab;
            --accent: #0ea371;
            --accent-soft: rgba(14, 163, 113, 0.12);
            --shadow: 0 20px 40px -24px rgba(15, 23, 42, 0.22);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Poppins', 'Segoe UI', Tahoma, sans-serif;
            color: var(--text);
            background:
                radial-gradient(1200px 600px at 80% -10%, rgba(16, 185, 129, 0.10), transparent 60%),
                radial-gradient(900px 500px at -10% 10%, rgba(56, 189, 248, 0.08), transparent 55%),
                linear-gradient(160deg, var(--bg-grad-1), var(--bg-grad-2));
            background-attachment: fixed;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* ===== Header ===== */
        .header {
            position: fixed; top: 0; left: 0; right: 0; z-index: 200;
            display: flex; align-items: center; gap: 1rem;
            padding: 0.85rem 2rem;
            background: color-mix(in srgb, var(--surface-solid) 72%, transparent);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid color-mix(in srgb, var(--border) 60%, transparent);
        }
        .brand { display: flex; align-items: center; gap: 0.75rem; }
        .brand-mark {
            width: 42px; height: 42px;
            border-radius: 12px;
            display: grid; place-items: center;
            background: linear-gradient(135deg, var(--accent), #059669);
            color: #fff;
            box-shadow: 0 8px 20px -8px rgba(16, 185, 129, 0.7);
            animation: brand-glow 2.5s ease-in-out infinite alternate;
        }
        @keyframes brand-glow {
            from { box-shadow: 0 8px 20px -8px rgba(16, 185, 129, 0.5), 0 0 12px rgba(16, 185, 129, 0.3); }
            to   { box-shadow: 0 8px 24px -6px rgba(16, 185, 129, 0.85), 0 0 22px rgba(16, 185, 129, 0.5); }
        }
        .brand-mark svg { width: 22px; height: 22px; }
        .brand-text h1 { font-size: 1.1rem; font-weight: 800; letter-spacing: -0.01em; line-height: 1.1; }
        .brand-text p { font-size: 0.72rem; color: var(--text-muted); font-weight: 500; }

        .header-actions { margin-left: auto; display: flex; align-items: center; gap: 0.6rem; }
        .icon-btn {
            display: flex; align-items: center; justify-content: center;
            width: 40px; height: 40px;
            border: 1px solid color-mix(in srgb, var(--border) 50%, transparent);
            border-radius: 12px;
            background: color-mix(in srgb, var(--surface-solid) 50%, transparent);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.18s ease;
        }
        .icon-btn:hover { background: var(--surface-2); color: var(--text); border-color: var(--border-strong); }
        .icon-btn svg { width: 18px; height: 18px; }
        .icon-btn.theme-btn { color: #a78bfa; border-color: rgba(167, 139, 250, 0.35); background: rgba(167, 139, 250, 0.10); }
        .icon-btn.theme-btn:hover { background: rgba(167, 139, 250, 0.20); border-color: rgba(167, 139, 250, 0.6); box-shadow: 0 0 14px rgba(167, 139, 250, 0.35); }
        html:not(.dark) .icon-btn.theme-btn { color: #f59e0b; border-color: rgba(245, 158, 11, 0.35); background: rgba(245, 158, 11, 0.10); }
        html:not(.dark) .icon-btn.theme-btn:hover { background: rgba(245, 158, 11, 0.20); border-color: rgba(245, 158, 11, 0.6); box-shadow: 0 0 14px rgba(245, 158, 11, 0.35); }
        .back-btn {
            display: inline-flex; align-items: center; gap: 0.55rem;
            padding: 0.55rem 1.1rem;
            border: none;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--accent), #059669);
            color: #fff;
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 600;
            letter-spacing: 0.01em;
            box-shadow: 0 4px 14px -4px color-mix(in srgb, var(--accent) 60%, transparent);
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            overflow: hidden;
        }
        .back-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.2), transparent);
            opacity: 0;
            transition: opacity 0.25s ease;
        }
        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px -6px color-mix(in srgb, var(--accent) 70%, transparent), 0 0 20px color-mix(in srgb, var(--accent) 30%, transparent);
        }
        .back-btn:hover::before { opacity: 1; }
        .back-btn:active { transform: translateY(0); }
        .back-btn svg {
            width: 16px; height: 16px;
            transition: transform 0.25s ease;
        }
        .back-btn:hover svg { transform: scale(1.1) rotate(-3deg); }

        /* ===== Main Content ===== */
        .main { max-width: 1200px; margin: 0 auto; padding: 5rem 2rem 2rem; }

        /* ===== Hero ===== */
        .hero {
            text-align: center;
            padding: 2.5rem 1rem 2rem;
        }
        .hero h2 {
            font-size: 2rem; font-weight: 800; letter-spacing: -0.02em;
            background: linear-gradient(135deg, var(--text), var(--accent));
            -webkit-background-clip: text; background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }
        .hero p { color: var(--text-muted); font-size: 1rem; max-width: 560px; margin: 0 auto; }
        .hero-stats {
            display: flex; justify-content: center; gap: 2rem;
            margin-top: 1.5rem; flex-wrap: wrap;
        }
        .stat { text-align: center; }
        .stat-num { font-size: 1.6rem; font-weight: 800; color: var(--accent); }
        .stat-label { font-size: 0.75rem; color: var(--text-dim); text-transform: uppercase; letter-spacing: 0.06em; }

        /* ===== Search ===== */
        .search-bar {
            position: relative;
            max-width: 500px;
            margin: 1.5rem auto 2rem;
        }
        .search-bar svg {
            position: absolute; left: 1rem; top: 50%; transform: translateY(-50%);
            width: 18px; height: 18px; color: var(--text-dim);
        }
        .search-bar input {
            width: 100%;
            padding: 0.85rem 1rem 0.85rem 2.8rem;
            border: 1px solid color-mix(in srgb, var(--border) 60%, transparent);
            border-radius: 14px;
            background: color-mix(in srgb, var(--surface-solid) 60%, transparent);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            color: var(--text);
            font-size: 0.9rem;
            font-family: inherit;
            outline: none;
            transition: all 0.18s ease;
        }
        .search-bar input::placeholder { color: var(--text-dim); }
        .search-bar input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px var(--accent-soft); }

        /* ===== Category Filter ===== */
        .filters {
            display: flex; justify-content: center; gap: 0.5rem;
            flex-wrap: wrap; margin-bottom: 2rem;
        }
        .filter-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.5rem 1rem;
            border: 1px solid color-mix(in srgb, var(--border) 50%, transparent);
            border-radius: 12px;
            background: color-mix(in srgb, var(--surface-solid) 50%, transparent);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            color: var(--text-muted);
            font-size: 0.8rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .filter-chip svg {
            width: 15px; height: 15px;
            opacity: 0.45;
            flex-shrink: 0;
            transition: all 0.22s ease;
        }
        .filter-chip.active {
            background: linear-gradient(135deg, var(--accent), #059669);
            border-color: var(--accent);
            color: #fff;
            box-shadow:
                0 3px 10px -4px color-mix(in srgb, var(--accent) 50%, transparent),
                inset 0 1px 0 rgba(255, 255, 255, 0.15);
        }
        .filter-chip.active svg { opacity: 1; }
        .filter-chip-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 18px; height: 18px;
            padding: 0 5px;
            border-radius: 6px;
            font-size: 0.62rem;
            font-weight: 700;
            background: color-mix(in srgb, currentColor 15%, transparent);
            transition: background 0.22s ease;
        }
        .filter-chip.active .filter-chip-count {
            background: rgba(255, 255, 255, 0.22);
        }

        /* ===== Video Grid ===== */
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.25rem;
        }
        .video-card {
            background: color-mix(in srgb, var(--surface-solid) 65%, transparent);
            backdrop-filter: blur(16px) saturate(150%);
            -webkit-backdrop-filter: blur(16px) saturate(150%);
            border: 1px solid color-mix(in srgb, var(--border) 50%, transparent);
            border-radius: 18px;
            overflow: hidden;
            transition: all 0.25s ease;
            cursor: pointer;
            display: flex;
            flex-direction: column;
        }
        .video-card:hover {
            border-color: var(--accent);
            transform: translateY(-4px);
            box-shadow:
                0 16px 32px -12px rgba(0, 0, 0, 0.4),
                0 0 0 1px var(--accent),
                0 0 20px color-mix(in srgb, var(--accent) 40%, transparent),
                0 0 40px color-mix(in srgb, var(--accent) 20%, transparent);
        }
        .video-thumb {
            position: relative;
            aspect-ratio: 16 / 9;
            background: #000;
            overflow: hidden;
            border-radius: 14px 14px 0 0;
        }
        .video-thumb video {
            width: 100%; height: 100%;
            object-fit: cover;
            display: block;
        }
        .video-thumb .play-overlay {
            position: absolute; inset: 0;
            display: flex; align-items: center; justify-content: center;
            background: rgba(0, 0, 0, 0.35);
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        .video-card:hover .play-overlay { opacity: 1; }
        .play-overlay svg {
            width: 48px; height: 48px;
            color: #fff;
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.5));
        }
        .video-thumb .duration-badge {
            position: absolute; bottom: 0.5rem; right: 0.5rem;
            padding: 0.2rem 0.5rem;
            background: rgba(0, 0, 0, 0.75);
            color: #fff;
            font-size: 0.72rem;
            font-weight: 600;
            border-radius: 6px;
            backdrop-filter: blur(4px);
        }
        .video-thumb .category-badge {
            position: absolute; top: 0.5rem; left: 0.5rem;
            padding: 0.25rem 0.6rem;
            background: color-mix(in srgb, var(--accent) 85%, transparent);
            color: #fff;
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-radius: 6px;
            backdrop-filter: blur(4px);
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

        .video-info { padding: 1rem 1.1rem 1.1rem; flex: 1; }
        .video-info h3 {
            font-size: 0.95rem; font-weight: 600;
            margin-bottom: 0.35rem;
            line-height: 1.3;
        }
        .video-info p {
            font-size: 0.82rem;
            color: var(--text-muted);
            line-height: 1.4;
        }
        .video-info .video-meta {
            display: flex; align-items: center; gap: 0.75rem;
            margin-top: 0.65rem;
            font-size: 0.74rem;
            color: var(--text-dim);
        }
        .video-info .video-meta span { display: flex; align-items: center; gap: 0.3rem; }
        .video-info .video-meta svg { width: 13px; height: 13px; }

        /* ===== Watch History Section ===== */
        .watch-history {
            margin-bottom: 2rem;
            padding: 1.25rem;
            background: color-mix(in srgb, var(--surface-solid) 40%, transparent);
            border: 1px solid color-mix(in srgb, var(--border) 50%, transparent);
            border-radius: 16px;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .watch-history-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 1rem;
        }
        .watch-history-header h3 {
            font-size: 0.95rem; font-weight: 700;
            display: flex; align-items: center; gap: 0.5rem;
        }
        .watch-history-header h3 svg { width: 18px; height: 18px; color: var(--accent); }
        .clear-history {
            font-size: 0.75rem; color: var(--text-muted);
            background: none; border: none;
            cursor: pointer; padding: 0.4rem 0.8rem;
            border-radius: 8px;
            transition: all 0.15s ease;
        }
        .clear-history:hover { background: var(--surface-2); color: var(--danger); }
        .watch-history-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 0.75rem;
        }
        .history-item {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.6rem;
            background: var(--surface);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .history-item:hover { background: var(--surface-2); transform: translateY(-1px); }
        .history-thumb {
            width: 60px; height: 34px;
            border-radius: 6px;
            background: #000;
            overflow: hidden;
            flex-shrink: 0;
        }
        .history-thumb video { width: 100%; height: 100%; object-fit: cover; }
        .history-info { flex: 1; min-width: 0; }
        .history-info h4 {
            font-size: 0.8rem; font-weight: 600;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .history-info p {
            font-size: 0.7rem; color: var(--text-muted);
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .history-time {
            font-size: 0.65rem; color: var(--text-dim);
            flex-shrink: 0;
        }

        /* ===== Progress Bar ===== */
        .progress-bar {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
            background: rgba(0, 0, 0, 0.5);
            z-index: 10;
        }
        .progress-fill {
            height: 100%;
            background: var(--accent);
            transition: width 0.3s ease;
        }

        /* ===== Favorite Button ===== */
        .favorite-btn {
            position: absolute;
            top: 0.5rem; right: 0.5rem;
            width: 32px; height: 32px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.6);
            border: none;
            color: #fff;
            cursor: pointer;
            display: grid; place-items: center;
            opacity: 0;
            transition: all 0.2s ease;
            z-index: 5;
        }
        .video-card:hover .favorite-btn { opacity: 1; }
        .favorite-btn:hover { background: rgba(0, 0, 0, 0.8); transform: scale(1.1); }
        .favorite-btn svg { width: 16px; height: 16px; transition: all 0.2s ease; }
        .favorite-btn.active { opacity: 1; }
        .favorite-btn.active svg { fill: #fbbf24; color: #fbbf24; }

        /* ===== Modal Enhancements ===== */
        .modal-actions {
            display: flex; align-items: center; gap: 0.5rem;
        }
        .modal-action-btn {
            width: 36px; height: 36px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--surface);
            color: var(--text-muted);
            cursor: pointer;
            display: grid; place-items: center;
            transition: all 0.15s ease;
        }
        .modal-action-btn:hover { background: var(--surface-2); color: var(--text); }
        .modal-action-btn.active { color: #fbbf24; }
        .modal-action-btn.active svg { fill: #fbbf24; }
        .modal-action-btn svg { width: 16px; height: 16px; }

        /* ===== Related Videos ===== */
        .related-videos {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border);
        }
        .related-videos h4 {
            font-size: 0.85rem; font-weight: 700;
            margin-bottom: 0.75rem;
            color: var(--text-muted);
        }
        .related-list {
            display: flex; flex-direction: column; gap: 0.5rem;
        }
        .related-item {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.5rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.15s ease;
        }
        .related-item:hover { background: var(--surface-2); }
        .related-item-thumb {
            width: 80px; height: 45px;
            border-radius: 6px;
            background: #000;
            overflow: hidden;
            flex-shrink: 0;
        }
        .related-item-thumb video { width: 100%; height: 100%; object-fit: cover; }
        .related-item-info { flex: 1; min-width: 0; }
        .related-item-info h5 {
            font-size: 0.8rem; font-weight: 600;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .related-item-info p {
            font-size: 0.7rem; color: var(--text-muted);
        }

        /* ===== Modal Player ===== */
        .modal-overlay {
            position: fixed; inset: 0;
            background: rgba(0, 0, 0, 0.85);
            z-index: 2000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            animation: fadeIn 0.2s ease;
        }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .modal-overlay.open { display: flex; }
        .modal-player {
            width: 100%;
            max-width: 900px;
            background: color-mix(in srgb, var(--surface-solid) 80%, transparent);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border: 1px solid color-mix(in srgb, var(--border) 50%, transparent);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 32px 64px -16px rgba(0, 0, 0, 0.7);
            animation: modalSlide 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        @keyframes modalSlide { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .modal-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border);
        }
        .modal-header h3 { font-size: 1.1rem; font-weight: 700; }
        .modal-header p { font-size: 0.8rem; color: var(--text-muted); }
        .modal-close {
            width: 36px; height: 36px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--surface);
            color: var(--text);
            cursor: pointer;
            font-size: 20px;
            display: grid; place-items: center;
            transition: all 0.15s ease;
        }
        .modal-close:hover { background: var(--danger); color: #fff; border-color: var(--danger); }
        .modal-video-frame {
            aspect-ratio: 16 / 9;
            background: #000;
            border-radius: 14px;
            overflow: hidden;
        }
        .modal-video-frame video { width: 100%; height: 100%; object-fit: contain; }

        /* ===== No Results ===== */
        .no-results {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--text-dim);
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

        /* ===== Settings Button ===== */
        .icon-btn.settings-btn-top {
            color: var(--accent);
            border-color: color-mix(in srgb, var(--accent) 35%, transparent);
            background: color-mix(in srgb, var(--accent) 10%, transparent);
        }
        .icon-btn.settings-btn-top:hover {
            background: color-mix(in srgb, var(--accent) 20%, transparent);
            border-color: color-mix(in srgb, var(--accent) 60%, transparent);
            box-shadow: 0 0 14px color-mix(in srgb, var(--accent) 35%, transparent);
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
            font-size: 0.72rem; font-weight: 800; letter-spacing: 0.08em;
            text-transform: uppercase; color: var(--text-dim);
            margin-bottom: 0.75rem; padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--border);
        }
        .setting-row {
            display: flex; align-items: center; justify-content: space-between;
            padding: 0.7rem 0;
            gap: 1rem;
        }
        .setting-label { flex: 1; }
        .setting-label .s-name { font-size: 0.88rem; font-weight: 500; color: var(--text); }
        .setting-label .s-hint { font-size: 0.74rem; color: var(--text-muted); margin-top: 2px; }
        .toggle {
            position: relative;
            width: 44px; height: 24px;
            border-radius: 999px;
            background: var(--surface-2);
            border: 1px solid var(--border-strong);
            cursor: pointer;
            transition: background 0.2s ease;
            flex-shrink: 0;
        }
        .toggle::after {
            content: '';
            position: absolute;
            top: 2px; left: 2px;
            width: 18px; height: 18px;
            border-radius: 50%;
            background: var(--text-muted);
            transition: transform 0.2s ease, background 0.2s ease;
        }
        .toggle.on { background: var(--accent); border-color: var(--accent); }
        .toggle.on::after { transform: translateX(20px); background: #fff; }
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
        .setting-select:hover { border-color: var(--accent); background-color: var(--accent-soft); }
        .setting-select:focus { border-color: var(--accent); box-shadow: 0 0 0 3px var(--accent-soft); }
        .setting-select option { background: var(--surface-solid); color: var(--text); padding: 0.5rem 0.7rem; font-size: 0.85rem; }
        html.dark .setting-select option { background: #111c30; color: #e8eef7; }
        html:not(.dark) .setting-select option { background: #ffffff; color: #0f172a; }
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
        .setting-range { width: 120px; accent-color: var(--accent); cursor: pointer; }
        .setting-range-value { font-size: 0.78rem; color: var(--accent); font-weight: 600; min-width: 40px; text-align: right; }
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
            transition: all 0.15s ease;
            font-family: inherit;
        }
        .settings-btn:hover { background: var(--surface-2); }
        .settings-btn.primary { background: var(--accent); color: #fff; border-color: var(--accent); }
        .settings-btn.primary:hover { background: #059669; }

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
        html:not(.dark) body.high-contrast {
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
            border: 1px solid var(--accent);
            border-radius: 14px;
            box-shadow: 0 12px 32px -8px rgba(0, 0, 0, 0.4), 0 0 16px color-mix(in srgb, var(--accent) 30%, transparent);
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
            background: color-mix(in srgb, var(--accent) 18%, transparent);
            color: var(--accent);
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

        @media (max-width: 600px) {
            .header { padding: 0.75rem 1rem; }
            .main { padding: 4.5rem 1rem 1rem; }
            .hero h2 { font-size: 1.5rem; }
            .video-grid { grid-template-columns: 1fr; }
            .hero-stats { gap: 1.25rem; }
        }

        /* ===== Loading Screen ===== */
        .loader-screen {
            position: fixed; inset: 0;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1.25rem;
            background: var(--bg-grad-1);
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }
        .loader-screen.hidden { opacity: 0; visibility: hidden; }
        .loader-logo {
            width: 56px; height: 56px;
            border-radius: 14px;
            display: grid; place-items: center;
            background: linear-gradient(135deg, var(--accent), #059669);
            color: #fff;
            box-shadow: 0 6px 20px -6px rgba(16, 185, 129, 0.6);
            animation: loader-logo-pulse 1.6s ease-in-out infinite;
        }
        @keyframes loader-logo-pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(0.92); opacity: 0.7; }
        }
        .loader-logo svg { width: 28px; height: 28px; }
        .loader-text {
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            color: var(--text);
            text-transform: uppercase;
        }
        .loader-bar {
            width: 180px;
            height: 3px;
            border-radius: 999px;
            background: var(--border);
            overflow: hidden;
        }
        .loader-bar-fill {
            height: 100%;
            width: 40%;
            border-radius: 999px;
            background: var(--accent);
            animation: loader-slide 1.2s ease-in-out infinite;
        }
        @keyframes loader-slide {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(250%); }
        }

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
</head>
<body>
    <!-- Loading Screen -->
    <div class="loader-screen" id="loader-screen">
        <div class="loader-logo">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
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

    <!-- Header -->
    <header class="header">
        <div class="brand">
            <span class="brand-mark">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
            </span>
            <span class="brand-text">
                <h1>DISPATCH</h1>
                <p>Video Tutorial Library</p>
            </span>
        </div>
        <div class="header-actions">
            <a href="index.php" class="back-btn">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.829 5.477 9.5 5 8 5c-1.5 0-2.829.477-4 1.253v13C5.171 18.477 6.5 18 8 18c1.5 0 2.829.477 4 1.253m0-13C13.171 5.477 14.5 5 16 5c1.5 0 2.829.477 4 1.253v13C18.829 18.477 17.5 18 16 18c-1.5 0-2.829.477-4 1.253"/></svg>
                Full Tutorial
            </a>
            <button class="icon-btn theme-btn" onclick="toggleTheme()" title="Toggle theme" id="theme-btn">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
            </button>
            <button class="icon-btn settings-btn-top" onclick="toggleSettings()" title="Settings" aria-label="Open settings">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <div class="main">
        <!-- Hero -->
        <div class="hero">
            <h2>Dispatch Video Tutorials</h2>
            <p>Watch step-by-step video guides for every feature in the DISPATCH system. Click any video to play it in full screen.</p>
            <div class="hero-stats">
                <div class="stat">
                    <div class="stat-num" id="stat-total">0</div>
                    <div class="stat-label">Total Videos</div>
                </div>
                <div class="stat">
                    <div class="stat-num" id="stat-available">0</div>
                    <div class="stat-label">Available Now</div>
                </div>
                <div class="stat">
                    <div class="stat-num" id="stat-categories">0</div>
                    <div class="stat-label">Categories</div>
                </div>
            </div>
        </div>

        <!-- Search -->
        <div class="search-bar">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" id="search-input" placeholder="Search tutorials..." oninput="filterVideos()">
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

        <!-- Category Filters -->
        <div class="filters" id="filters">
            <button class="filter-chip active" data-cat="all" onclick="setFilter('all', this)">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                All <span class="filter-chip-count" id="count-all">0</span>
            </button>
            <button class="filter-chip" data-cat="Main" onclick="setFilter('Main', this)">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Main <span class="filter-chip-count" id="count-Main">0</span>
            </button>
            <button class="filter-chip" data-cat="Operations" onclick="setFilter('Operations', this)">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Operations <span class="filter-chip-count" id="count-Operations">0</span>
            </button>
            <button class="filter-chip" data-cat="Fleet" onclick="setFilter('Fleet', this)">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1"/></svg>
                Fleet <span class="filter-chip-count" id="count-Fleet">0</span>
            </button>
            <button class="filter-chip" data-cat="Finance" onclick="setFilter('Finance', this)">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Finance <span class="filter-chip-count" id="count-Finance">0</span>
            </button>
            <button class="filter-chip" data-cat="Safety" onclick="setFilter('Safety', this)">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                Safety <span class="filter-chip-count" id="count-Safety">0</span>
            </button>
            <button class="filter-chip" data-cat="Compliance" onclick="setFilter('Compliance', this)">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Compliance <span class="filter-chip-count" id="count-Compliance">0</span>
            </button>
            <button class="filter-chip" data-cat="Account" onclick="setFilter('Account', this)">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Account <span class="filter-chip-count" id="count-Account">0</span>
            </button>
        </div>

        <!-- Video Grid -->
        <div class="video-grid" id="video-grid"></div>

        <!-- No Results -->
        <div class="no-results" id="no-results">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <h3>No tutorials found</h3>
            <p>Try a different search term or category filter</p>
        </div>
    </div>

    <!-- Modal Player -->
    <div class="modal-overlay" id="modal-overlay" onclick="closeModal(event)">
        <div class="modal-player" onclick="event.stopPropagation()">
            <div class="modal-header">
                <div>
                    <h3 id="modal-title">Video Title</h3>
                    <p id="modal-desc">Description</p>
                </div>
                <div class="modal-actions">
                    <button class="modal-action-btn" id="modal-favorite-btn" onclick="toggleFavoriteFromModal()" title="Add to favorites">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    </button>
                    <button class="modal-action-btn" id="modal-pip-btn" onclick="togglePiP()" title="Picture-in-Picture">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/></svg>
                    </button>
                    <button class="modal-close" onclick="closeModal()" aria-label="Close">&times;</button>
                </div>
            </div>
            <div class="modal-video-frame">
                <video id="modal-video" controls autoplay playsinline></video>
            </div>
            <div class="related-videos" id="related-videos" style="display:none;">
                <h4>Related Videos</h4>
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
        const VIDEOS = [
            // Main
            { id: 'dashboard', title: 'Dashboard', desc: 'Overview and statistics walkthrough', category: 'Main', src: 'videos/dashboard.mp4', duration: '2:30' },

            // Operations & Dispatch
            { id: 'my-loads', title: 'My Loads', desc: 'Create, assign and track loads through dispatch', category: 'Operations', src: 'videos/my-loads.mp4', duration: '—' },
            { id: 'my-trucks', title: 'My Trucks', desc: 'Add, view and manage your trucks', category: 'Operations', src: 'videos/my-trucks.mp4', duration: '—' },
            { id: 'my-trailers', title: 'My Trailers', desc: 'Add, view and manage your trailers', category: 'Operations', src: 'videos/my-trailers.mp4', duration: '—' },
            { id: 'driver-devices', title: 'Driver Devices', desc: 'Manage driver devices and ELD connections', category: 'Operations', src: 'videos/driver-devices.mp4', duration: '—' },

            // Fleet Management
            { id: 'truck-lease-pricing', title: 'Truck Lease Pricing', desc: 'Review and configure lease pricing', category: 'Fleet', src: 'videos/truck-lease-pricing.mp4', duration: '—' },
            { id: 'truck-rentals', title: 'Truck Rentals', desc: 'Manage truck rentals and equipment', category: 'Fleet', src: 'videos/truck-rentals.mp4', duration: '—' },
            { id: 'lease-agreements', title: 'Lease Agreements', desc: 'Create, sign and track lease agreements', category: 'Fleet', src: 'videos/lease-agreements.mp4', duration: '—' },
            { id: 'hire-drivers', title: 'Hire Drivers', desc: 'Recruit and onboard new drivers', category: 'Fleet', src: 'videos/hire-drivers.mp4', duration: '—' },
            { id: 'job-postings', title: 'Job Postings', desc: 'Create and manage driver job postings', category: 'Fleet', src: 'videos/job-postings.mp4', duration: '—' },
            { id: 'external-drivers', title: 'External Drivers', desc: 'Manage external and owner-operator drivers', category: 'Fleet', src: 'videos/external-drivers.mp4', duration: '—' },
            { id: 'shout-out-scripts', title: 'Shout Out Scripts', desc: 'Ready-made scripts for your marketing', category: 'Fleet', src: 'videos/shout-out-scripts.mp4', duration: '—' },
            { id: 'shout-out-vlogs', title: 'Shout Out Vlogs', desc: 'Shout out vlog examples and walkthroughs', category: 'Fleet', src: 'videos/shout-out-vlogs.mp4', duration: '—' },

            // Finance
            { id: 'accounting', title: 'Accounting', desc: 'Manage accounting and financial records', category: 'Finance', src: 'videos/accounting.mp4', duration: '—' },
            { id: 'my-payroll', title: 'My Payroll', desc: 'Run and manage payroll', category: 'Finance', src: 'videos/my-payroll.mp4', duration: '—' },
            { id: 'my-factoring-company', title: 'My Factoring Company', desc: 'Connect and manage your factoring company', category: 'Finance', src: 'videos/my-factoring-company.mp4', duration: '—' },
            { id: 'fuel-reports', title: 'Fuel Reports', desc: 'View fuel spending reports and analytics', category: 'Finance', src: 'videos/fuel-reports.mp4', duration: '—' },
            { id: 'my-fuel-cards', title: 'My Fuel Cards', desc: 'Manage fuel cards and spending limits', category: 'Finance', src: 'videos/my-fuel-cards.mp4', duration: '—' },
            { id: 'loans-cash-advance', title: 'Loans/Cash Advance', desc: 'Apply for and track loans and cash advances', category: 'Finance', src: 'videos/loans-cash-advance.mp4', duration: '—' },
            { id: 'api-integration-keys', title: 'API Integration Keys', desc: 'Generate and manage API integration keys', category: 'Finance', src: 'videos/api-integration-keys.mp4', duration: '—' },

            // Safety
            { id: 'my-fleet', title: 'My Fleet', desc: 'Monitor your fleet safety and compliance', category: 'Safety', src: 'videos/my-fleet.mp4', duration: '—' },
            { id: 'emergency-monitoring', title: 'Emergency Monitoring', desc: 'Set up and respond to emergency alerts', category: 'Safety', src: 'videos/emergency-monitoring.mp4', duration: '—' },
            { id: 'safety-assessments', title: 'Safety Assessments', desc: 'Run and review safety assessments', category: 'Safety', src: 'videos/safety-assessments.mp4', duration: '—' },
            { id: 'maintenance-monitoring', title: 'Maintenance Monitoring', desc: 'Monitor maintenance and vehicle health', category: 'Safety', src: 'videos/maintenance-monitoring.mp4', duration: '—' },
            { id: 'safety-violations', title: 'Safety Violations', desc: 'Safety-related compliance issues', category: 'Safety', src: 'videos/safety-violations.mp4', duration: '—' },

            // Compliance
            { id: 'compliance-monitoring', title: 'Compliance Monitoring', desc: 'Track compliance metrics in real time', category: 'Compliance', src: 'videos/compliance-monitoring.mp4', duration: '—' },
            { id: 'compliance-software-options', title: 'Compliance Software Options', desc: 'Explore compliance software integrations', category: 'Compliance', src: 'videos/compliance-software-options.mp4', duration: '—' },
            { id: 'drug-alcohol-testing', title: 'Drug & Alcohol Testing', desc: 'Manage drug and alcohol testing programs', category: 'Compliance', src: 'videos/drug-alcohol-testing.mp4', duration: '—' },
            { id: 'violations', title: 'Violations', desc: 'Track compliance violations', category: 'Compliance', src: 'videos/violations.mp4', duration: '—' },
            { id: 'driver-violations', title: 'Driver Violations', desc: 'Driver-specific violations', category: 'Compliance', src: 'videos/driver-violations.mp4', duration: '—' },
            { id: 'vehicle-violations', title: 'Vehicle Violations', desc: 'Vehicle-related violations', category: 'Compliance', src: 'videos/vehicle-violations.mp4', duration: '—' },
            { id: 'hos', title: 'HOS', desc: 'Hours of Service compliance', category: 'Compliance', src: 'videos/hos.mp4', duration: '—' },

            // People & Customers
            { id: 'my-drivers', title: 'My Drivers', desc: 'View and manage your drivers', category: 'Operations', src: 'videos/how-to-register-new-drivers.mp4', duration: '3:45' },
            { id: 'my-customers', title: 'My Customers', desc: 'Add, view and manage your customers', category: 'Operations', src: 'videos/my-customers.mp4', duration: '—' },
            { id: 'my-shippers-list', title: 'My Shippers List', desc: 'Manage your list of shippers', category: 'Operations', src: 'videos/my-shippers-list.mp4', duration: '—' },
            { id: 'my-consignee-lists', title: 'My Consignee Lists', desc: 'Manage your consignee lists and locations', category: 'Operations', src: 'videos/my-consignee-lists.mp4', duration: '—' },
            { id: 'my-brokers', title: 'My Brokers', desc: 'Add and manage your brokers', category: 'Operations', src: 'videos/my-brokers.mp4', duration: '—' },

            // Account
            { id: 'notifications', title: 'Notifications', desc: 'Real-time alerts and updates', category: 'Account', src: 'videos/notifications.mp4', duration: '—' },
            { id: 'activity', title: 'Activity', desc: 'System activity logs', category: 'Account', src: 'videos/activity.mp4', duration: '—' },
            { id: 'maintenance', title: 'Maintenance', desc: 'Vehicle maintenance scheduling', category: 'Account', src: 'videos/maintenance.mp4', duration: '—' },
            { id: 'documents', title: 'Documents', desc: 'Centralized document management', category: 'Account', src: 'videos/documents.mp4', duration: '—' },
            { id: 'permit-insurance', title: 'Permit & Insurance', desc: 'Permits, licenses and insurance', category: 'Account', src: 'videos/permit-insurance.mp4', duration: '—' },
            { id: 'reporting', title: 'Reporting', desc: 'Reports and operational insights', category: 'Account', src: 'videos/reporting.mp4', duration: '—' },
            { id: 'settings', title: 'Settings', desc: 'Configure and customize the system', category: 'Account', src: 'videos/settings.mp4', duration: '—' },
            { id: 'login-signup-tutorial', title: 'Login & Sign Up', desc: 'Account creation and secure login', category: 'Account', src: 'videos/login-signup-tutorial.mp4', duration: '—' },
        ];

        // Videos that actually exist on the server
        const AVAILABLE_VIDEOS = ['videos/dashboard.mp4', 'videos/how-to-register-new-drivers.mp4'];

        let currentFilter = 'all';
        let currentVideo = null;
        let watchHistory = [];
        let favorites = [];
        let videoProgress = {};

        function isAvailable(src) { return AVAILABLE_VIDEOS.indexOf(src) !== -1; }

        // Load user data from localStorage
        function loadUserData() {
            try {
                watchHistory = JSON.parse(localStorage.getItem('dispatch-watch-history') || '[]');
                favorites = JSON.parse(localStorage.getItem('dispatch-favorites') || '[]');
                videoProgress = JSON.parse(localStorage.getItem('dispatch-video-progress') || '{}');
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

                item.innerHTML =
                    '<div class="history-thumb">' +
                        (available ? '<video muted preload="metadata"><source src="' + v.src + '" type="video/mp4"></video>' : '<div style="width:100%;height:100%;background:var(--surface-2);display:grid;place-items:center;"><svg style="width:20px;height:20px;color:var(--text-dim)" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg></div>') +
                    '</div>' +
                    '<div class="history-info">' +
                        '<h4>' + v.title + '</h4>' +
                        '<p>' + v.category + '</p>' +
                    '</div>' +
                    '<span class="history-time">' + timeAgo + '</span>';
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
                return v.id !== currentVideo.id && v.category === currentVideo.category;
            }).slice(0, 4);

            if (related.length === 0) {
                container.style.display = 'none';
                return;
            }

            container.style.display = 'block';
            list.innerHTML = '';

            related.forEach(function(v) {
                const item = document.createElement('div');
                item.className = 'related-item';
                item.onclick = function() {
                    openModal(v);
                };

                const available = isAvailable(v.src);

                item.innerHTML =
                    '<div class="related-item-thumb">' +
                        (available ? '<video muted preload="metadata"><source src="' + v.src + '" type="video/mp4"></video>' : '<div style="width:100%;height:100%;background:var(--surface-2);display:grid;place-items:center;"><svg style="width:20px;height:20px;color:var(--text-dim)" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg></div>') +
                    '</div>' +
                    '<div class="related-item-info">' +
                        '<h5>' + v.title + '</h5>' +
                        '<p>' + v.category + '</p>' +
                    '</div>';
                list.appendChild(item);
            });
        }

        function renderVideos() {
            const grid = document.getElementById('video-grid');
            const searchTerm = document.getElementById('search-input').value.toLowerCase().trim();
            grid.innerHTML = '';

            const filtered = VIDEOS.filter(function(v) {
                const matchesFilter = currentFilter === 'all' || v.category === currentFilter;
                const matchesSearch = !searchTerm ||
                    v.title.toLowerCase().indexOf(searchTerm) !== -1 ||
                    v.desc.toLowerCase().indexOf(searchTerm) !== -1 ||
                    v.category.toLowerCase().indexOf(searchTerm) !== -1;
                return matchesFilter && matchesSearch;
            });

            if (filtered.length === 0) {
                document.getElementById('no-results').classList.add('show');
            } else {
                document.getElementById('no-results').classList.remove('show');
            }

            filtered.forEach(function(v) {
                const available = isAvailable(v.src);
                const isFav = favorites.indexOf(v.id) !== -1;
                const progress = videoProgress[v.id] ? videoProgress[v.id].progress : 0;

                const card = document.createElement('div');
                card.className = 'video-card';
                card.onclick = function(e) {
                    if (!e.target.closest('.favorite-btn')) {
                        openModal(v);
                    }
                };

                const thumb = available
                    ? '<video muted preload="metadata"><source src="' + v.src + '" type="video/mp4"></video>'
                    : '<div class="video-empty"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg><span>Coming Soon</span></div>';

                card.innerHTML =
                    '<div class="video-thumb">' +
                        '<span class="category-badge">' + v.category + '</span>' +
                        thumb +
                        '<button class="favorite-btn' + (isFav ? ' active' : '') + '" onclick="toggleFavorite(\'' + v.id + '\', event)" title="Add to favorites">' +
                            '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>' +
                        '</button>' +
                        '<div class="play-overlay"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>' +
                        (available ? '<span class="duration-badge">' + v.duration + '</span>' : '') +
                        (progress > 0 ? '<div class="progress-bar"><div class="progress-fill" style="width:' + progress + '%"></div></div>' : '') +
                    '</div>' +
                    '<div class="video-info">' +
                        '<h3>' + v.title + '</h3>' +
                        '<p>' + v.desc + '</p>' +
                        '<div class="video-meta">' +
                            '<span><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>' + v.category + '</span>' +
                            (available
                                ? '<span><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Available</span>'
                                : '<span><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Coming Soon</span>') +
                        '</div>' +
                    '</div>';
                grid.appendChild(card);
            });
        }

        function setFilter(category, el) {
            currentFilter = category;
            document.querySelectorAll('.filter-chip').forEach(function(c) { c.classList.remove('active'); });
            el.classList.add('active');
            renderVideos();
        }

        function filterVideos() { renderVideos(); }

        function openModal(v) {
            currentVideo = v;
            const overlay = document.getElementById('modal-overlay');
            const video = document.getElementById('modal-video');
            document.getElementById('modal-title').textContent = v.title;
            document.getElementById('modal-desc').textContent = v.desc;
            const settings = loadSettings();

            // Add to watch history
            addToWatchHistory(v);

            // Update favorite button
            updateModalFavoriteButton();

            // Render related videos
            renderRelatedVideos(v);

            if (isAvailable(v.src)) {
                video.innerHTML = '<source src="' + v.src + '" type="video/mp4">';
                video.style.display = 'block';
                video.load();
                video.playbackRate = parseFloat(settings['playback-speed'] || '1');

                // Restore progress if available
                if (videoProgress[v.id] && videoProgress[v.id].currentTime > 0) {
                    video.currentTime = videoProgress[v.id].currentTime;
                }

                // Track progress
                video.onloadedmetadata = function() {
                    if (settings['autoplay']) {
                        video.play().catch(function() {});
                    }
                };

                video.ontimeupdate = function() {
                    updateVideoProgress(v.id, video.currentTime, video.duration);
                };

                if (settings['autoplay']) {
                    video.play().catch(function() {});
                }
            } else {
                video.innerHTML = '';
                video.style.display = 'none';
                const frame = video.parentElement;
                let empty = frame.querySelector('.video-empty');
                if (!empty) {
                    empty = document.createElement('div');
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
            const isDark = document.documentElement.classList.contains('dark');
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
            } else {
                iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
            }
            // Color swatch
            if (opts.swatch) {
                swatchWrap.innerHTML = '<span class="announce-swatch" style="background:' + opts.swatch + '"></span>';
            } else {
                swatchWrap.innerHTML = '';
            }
            toast.classList.add('show');
            if (announceTimer) clearTimeout(announceTimer);
            announceTimer = setTimeout(function() { toast.classList.remove('show'); }, 2600);
        }

        function toggleTheme() {
            document.documentElement.classList.toggle('dark');
            const isDark = document.documentElement.classList.contains('dark');
            try { localStorage.setItem('dispatch-theme', isDark ? 'dark' : 'light'); } catch (e) {}
            const darkToggle = document.getElementById('set-dark-mode');
            if (darkToggle) darkToggle.classList.toggle('on', isDark);
            updateBackgroundSVG();
            saveSettingsImmediate();
            showAnnouncement(isDark ? 'Dark mode enabled' : 'Light mode enabled', { icon: 'theme' });
        }

        // ===== Settings (synced with index.php via localStorage) =====
        const SETTINGS_DEFAULTS = {
            'dark-mode': true,
            'autoplay': false,
            'reduce-motion': false,
            'high-contrast': false,
            'large-text': false,
            'accent-color': '#10b981',
            'font-size': '15',
            'playback-speed': '1'
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
                    if (value) document.documentElement.classList.add('dark');
                    else document.documentElement.classList.remove('dark');
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
                case 'autoplay':
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

        function saveSettingsImmediate() {
            const settings = loadSettings();
            ['dark-mode','autoplay','reduce-motion','high-contrast','large-text'].forEach(function(key) {
                const el = document.getElementById('set-' + key);
                if (el) settings[key] = el.classList.contains('on');
            });
            ['playback-speed'].forEach(function(key) {
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
            document.documentElement.classList.add('dark');
            try { localStorage.setItem('dispatch-theme', 'dark'); } catch(e) {}
            updateBackgroundSVG();
            applySettingsToUI();
            showAnnouncement('Settings reset to default', { icon: 'reset' });
        }

        function applySettingsToUI() {
            const s = loadSettings();
            ['dark-mode','autoplay','reduce-motion','high-contrast','large-text'].forEach(function(key) {
                const el = document.getElementById('set-' + key);
                if (el) el.classList.toggle('on', !!s[key]);
            });
            const psEl = document.getElementById('set-playback-speed');
            if (psEl) psEl.value = s['playback-speed'];
            const fsEl = document.getElementById('set-font-size');
            if (fsEl) { fsEl.value = s['font-size']; document.getElementById('font-size-value').textContent = s['font-size'] + 'px'; }
            document.querySelectorAll('#set-accent-colors .color-swatch').forEach(function(sw) {
                sw.classList.toggle('active', sw.dataset.color === s['accent-color']);
            });
            document.documentElement.style.setProperty('--accent', s['accent-color']);
            document.documentElement.style.setProperty('--accent-soft', s['accent-color'] + '22');
            if (s['large-text']) document.documentElement.style.fontSize = '18px';
            else document.documentElement.style.fontSize = s['font-size'] + 'px';
            if (s['reduce-motion']) document.body.classList.add('reduce-motion'); else document.body.classList.remove('reduce-motion');
            if (s['high-contrast']) document.body.classList.add('high-contrast'); else document.body.classList.remove('high-contrast');
            if (s['dark-mode']) document.documentElement.classList.add('dark'); else document.documentElement.classList.remove('dark');
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
            if (s['dark-mode']) document.documentElement.classList.add('dark'); else document.documentElement.classList.remove('dark');
            updateBackgroundSVG();
        }

        // Initialize settings on load
        initSettingsOnLoad();

        // Load user data and render watch history
        loadUserData();
        renderWatchHistory();

        // Update stats and render
        function updateStats() {
            document.getElementById('stat-total').textContent = VIDEOS.length;
            document.getElementById('stat-available').textContent = AVAILABLE_VIDEOS.length;
            const cats = {};
            VIDEOS.forEach(function(v) { cats[v.category] = true; });
            document.getElementById('stat-categories').textContent = Object.keys(cats).length;
            // Update filter chip counts
            var allEl = document.getElementById('count-all');
            if (allEl) allEl.textContent = VIDEOS.length;
            var catCounts = {};
            VIDEOS.forEach(function(v) { catCounts[v.category] = (catCounts[v.category] || 0) + 1; });
            Object.keys(catCounts).forEach(function(cat) {
                var el = document.getElementById('count-' + cat);
                if (el) el.textContent = catCounts[cat];
            });
        }

        updateStats();
        renderVideos();

        // Hide loading screen on page load
        window.addEventListener('load', function() {
            setTimeout(function() {
                const loader = document.getElementById('loader-screen');
                if (loader) loader.classList.add('hidden');
                setTimeout(function() { if (loader) loader.style.display = 'none'; }, 600);
            }, 800);
        });
    </script>
</body>
</html>
