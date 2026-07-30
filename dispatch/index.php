    <?php
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
                /* Dark theme (default) */
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
                --radius: 16px;
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

            * { box-sizing: border-box; }
            html, body { height: 100%; }
            body {
                font-family: 'Poppins', 'Segoe UI', Tahoma, sans-serif;
                margin: 0;
                color: var(--text);
                background:
                    radial-gradient(1200px 600px at 80% -10%, rgba(16, 185, 129, 0.10), transparent 60%),
                    radial-gradient(900px 500px at -10% 10%, rgba(56, 189, 248, 0.08), transparent 55%),
                    linear-gradient(160deg, var(--bg-grad-1), var(--bg-grad-2));
                background-attachment: fixed;
                min-height: 100vh;
                -webkit-font-smoothing: antialiased;
            }
            a { text-decoration: none; color: inherit; }
            ::-webkit-scrollbar { width: 10px; height: 10px; }
            ::-webkit-scrollbar-thumb { background: var(--border-strong); border-radius: 999px; }
            ::-webkit-scrollbar-track { background: transparent; }

            /* ===== Top bar ===== */
            .topbar {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 200;
                height: 68px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 1.5rem 0 1.75rem;
                background: color-mix(in srgb, var(--surface-solid) 72%, transparent);
                backdrop-filter: blur(20px) saturate(180%);
                -webkit-backdrop-filter: blur(20px) saturate(180%);
                border-bottom: 1px solid color-mix(in srgb, var(--border) 60%, transparent);
            }
            .topbar-left { display: flex; align-items: center; gap: 1rem; }
            .menu-toggle {
                display: none;
                width: 40px; height: 40px;
                border: 1px solid var(--border);
                background: var(--surface);
                color: var(--text);
                border-radius: 12px;
                cursor: pointer;
                align-items: center; justify-content: center;
            }
            .brand { display: flex; align-items: center; gap: 0.75rem; }
            .brand-mark {
                width: 40px; height: 40px;
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
            .brand-text h1 { margin: 0; font-size: 1.05rem; font-weight: 800; letter-spacing: -0.01em; }
            .brand-text p { margin: 0; font-size: 0.72rem; color: var(--text-muted); font-weight: 500; }

            .live-pill {
                display: inline-flex; align-items: center; gap: 0.5rem;
                padding: 0.4rem 0.8rem;
                border-radius: 999px;
                background: var(--accent-soft);
                color: var(--accent);
                font-size: 0.78rem; font-weight: 600;
                border: 1px solid color-mix(in srgb, var(--accent) 30%, transparent);
            }
            .live-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--accent); box-shadow: 0 0 0 0 var(--accent); animation: pulse 2s infinite; }
            @keyframes pulse {
                0% { box-shadow: 0 0 0 0 color-mix(in srgb, var(--accent) 60%, transparent); }
                70% { box-shadow: 0 0 0 8px transparent; }
                100% { box-shadow: 0 0 0 0 transparent; }
            }

            .topbar-right { display: flex; align-items: center; gap: 0.6rem; }
            .icon-btn {
                width: 40px; height: 40px;
                display: grid; place-items: center;
                border: 1px solid color-mix(in srgb, var(--border) 50%, transparent);
                background: color-mix(in srgb, var(--surface-solid) 50%, transparent);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                color: var(--text);
                border-radius: 12px;
                cursor: pointer;
                transition: all 0.18s ease;
            }
            .icon-btn:hover { background: var(--surface-2); border-color: var(--border-strong); transform: translateY(-1px); }
            .icon-btn svg { width: 18px; height: 18px; }
            .icon-btn.refresh-btn {
                color: #38bdf8;
                border-color: rgba(56, 189, 248, 0.35);
                background: rgba(56, 189, 248, 0.10);
            }
            .icon-btn.refresh-btn:hover {
                background: rgba(56, 189, 248, 0.20);
                border-color: rgba(56, 189, 248, 0.6);
                box-shadow: 0 0 14px rgba(56, 189, 248, 0.35);
            }
            .icon-btn.tutorials-btn {
                color: #f472b6;
                border-color: rgba(244, 114, 182, 0.35);
                background: rgba(244, 114, 182, 0.10);
                text-decoration: none;
            }
            .icon-btn.tutorials-btn:hover {
                background: rgba(244, 114, 182, 0.20);
                border-color: rgba(244, 114, 182, 0.6);
                box-shadow: 0 0 14px rgba(244, 114, 182, 0.35);
                transform: translateY(-1px);
            }
            .icon-btn.theme-btn {
                color: #a78bfa;
                border-color: rgba(167, 139, 250, 0.35);
                background: rgba(167, 139, 250, 0.10);
            }
            .icon-btn.theme-btn:hover {
                background: rgba(167, 139, 250, 0.20);
                border-color: rgba(167, 139, 250, 0.6);
                box-shadow: 0 0 14px rgba(167, 139, 250, 0.35);
            }
            html:not(.dark) .icon-btn.theme-btn {
                color: #f59e0b;
                border-color: rgba(245, 158, 11, 0.35);
                background: rgba(245, 158, 11, 0.10);
            }
            html:not(.dark) .icon-btn.theme-btn:hover {
                background: rgba(245, 158, 11, 0.20);
                border-color: rgba(245, 158, 11, 0.6);
                box-shadow: 0 0 14px rgba(245, 158, 11, 0.35);
            }
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
            .icon-btn.tour-btn {
                color: #fbbf24;
                border-color: rgba(251, 191, 36, 0.35);
                background: rgba(251, 191, 36, 0.10);
                position: relative;
            }
            .icon-btn.tour-btn:hover {
                background: rgba(251, 191, 36, 0.20);
                border-color: rgba(251, 191, 36, 0.6);
                box-shadow: 0 0 14px rgba(251, 191, 36, 0.35);
            }
            .icon-btn.tour-btn::after {
                content: '';
                position: absolute;
                top: -3px; right: -3px;
                width: 10px; height: 10px;
                border-radius: 50%;
                background: #fbbf24;
                box-shadow: 0 0 8px #fbbf24;
                animation: tour-pulse 1.5s ease-in-out infinite;
            }
            @keyframes tour-pulse {
                0%, 100% { opacity: 1; transform: scale(1); }
                50% { opacity: 0.5; transform: scale(1.4); }
            }
            .icon-btn.tour-btn.touring::after { display: none; }

            /* ===== Tour Guide Overlay ===== */
            .tour-overlay {
                position: fixed; inset: 0;
                z-index: 2500;
                pointer-events: none;
                display: none;
            }
            .tour-overlay.active { display: block; pointer-events: auto; }
            .tour-mask {
                position: absolute; inset: 0;
                background: rgba(0, 0, 0, 0.7);
                transition: clip-path 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .tour-highlight {
                position: absolute;
                border-radius: 14px;
                box-shadow: 0 0 0 9999px rgba(0, 0, 0, 0.7), 0 0 0 3px var(--accent), 0 0 30px 4px color-mix(in srgb, var(--accent) 50%, transparent);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                pointer-events: none;
            }
            .tour-tooltip {
                position: absolute;
                background: var(--surface-solid);
                border: 1px solid color-mix(in srgb, var(--accent) 40%, transparent);
                border-radius: 20px;
                padding: 0;
                max-width: 380px;
                min-width: 300px;
                box-shadow: 0 24px 60px -16px rgba(0, 0, 0, 0.7), 0 0 0 1px color-mix(in srgb, var(--accent) 15%, transparent), 0 0 40px -8px color-mix(in srgb, var(--accent) 25%, transparent);
                transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
                z-index: 2501;
                overflow: hidden;
            }
            .tour-tooltip::before {
                content: '';
                position: absolute;
                width: 14px; height: 14px;
                background: var(--surface-solid);
                border-left: 1px solid color-mix(in srgb, var(--accent) 40%, transparent);
                border-top: 1px solid color-mix(in srgb, var(--accent) 40%, transparent);
                transform: rotate(45deg);
                z-index: 1;
            }
            .tour-tooltip.arrow-bottom::before { bottom: -8px; left: var(--arrow-x, 24px); transform: rotate(225deg); }
            .tour-tooltip.arrow-top::before { top: -8px; left: var(--arrow-x, 24px); }
            .tour-tooltip.arrow-left::before { left: -8px; top: var(--arrow-y, 24px); transform: rotate(-45deg); }
            .tour-tooltip.arrow-right::before { right: -8px; top: var(--arrow-y, 24px); transform: rotate(135deg); }

            /* Header strip with accent gradient */
            .tour-tooltip-header {
                padding: 1rem 1.5rem 0.75rem;
                background: linear-gradient(135deg, var(--accent-soft), transparent 80%);
                border-bottom: 1px solid var(--border);
            }
            .tour-step-badge {
                display: flex;
                align-items: center;
                gap: 0.6rem;
                font-size: 0.78rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.06em;
                color: var(--accent);
            }
            .tour-step-badge .badge-num {
                display: grid; place-items: center;
                width: 28px; height: 28px;
                border-radius: 50%;
                background: var(--accent);
                color: #fff;
                font-size: 0.82rem;
                box-shadow: 0 4px 12px -2px color-mix(in srgb, var(--accent) 50%, transparent);
            }
            .tour-progress {
                display: flex;
                gap: 5px;
                margin-top: 0.75rem;
            }
            .tour-dot {
                flex: 1;
                height: 5px;
                border-radius: 999px;
                background: var(--border);
                transition: all 0.25s ease;
            }
            .tour-dot.done { background: var(--accent); }
            .tour-dot.current { background: var(--accent); opacity: 0.6; box-shadow: 0 0 8px color-mix(in srgb, var(--accent) 50%, transparent); }

            /* Body content */
            .tour-tooltip-body {
                padding: 1rem 1.5rem 1.25rem;
            }
            .tour-title {
                font-size: 1.15rem;
                font-weight: 700;
                margin-bottom: 0.5rem;
                color: var(--text);
                line-height: 1.3;
            }
            .tour-desc {
                font-size: 0.92rem;
                line-height: 1.6;
                color: var(--text);
                margin-bottom: 1.25rem;
                opacity: 0.85;
            }

            /* Controls */
            .tour-controls {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }
            .tour-btn-control {
                padding: 0.6rem 1.2rem;
                border: 1px solid var(--border-strong);
                border-radius: 12px;
                background: var(--surface);
                color: var(--text);
                font-size: 0.86rem;
                font-weight: 600;
                font-family: inherit;
                cursor: pointer;
                transition: all 0.18s ease;
            }
            .tour-btn-control:hover { background: var(--surface-2); border-color: var(--text-muted); transform: translateY(-1px); }
            .tour-btn-control:active { transform: translateY(0); }
            .tour-btn-control.primary {
                background: var(--accent);
                color: #fff;
                border-color: var(--accent);
                box-shadow: 0 6px 16px -4px color-mix(in srgb, var(--accent) 50%, transparent);
            }
            .tour-btn-control.primary:hover { background: #059669; box-shadow: 0 8px 20px -4px color-mix(in srgb, var(--accent) 60%, transparent); }
            .tour-btn-control:disabled { opacity: 0.35; cursor: not-allowed; transform: none; }
            .tour-skip {
                margin-left: auto;
                color: var(--text-dim);
                font-size: 0.82rem;
                background: none;
                border: none;
                cursor: pointer;
                font-family: inherit;
                transition: color 0.15s ease;
                padding: 0.4rem;
            }
            .tour-skip:hover { color: var(--danger); }
            .user-chip {
                display: flex; align-items: center; gap: 0.6rem;
                padding: 0.35rem 0.75rem 0.35rem 0.4rem;
                border: 1px solid var(--border);
                background: var(--surface);
                border-radius: 999px;
                cursor: pointer;
                transition: all 0.18s ease;
            }
            .user-chip:hover { background: var(--surface-2); }
            .avatar {
                width: 32px; height: 32px; border-radius: 50%;
                display: grid; place-items: center;
                background: linear-gradient(135deg, #6366f1, #8b5cf6);
                color: #fff; font-weight: 700; font-size: 0.8rem;
            }
            .user-chip .u-name { font-size: 0.82rem; font-weight: 600; line-height: 1.1; }
            .user-chip .u-role { font-size: 0.68rem; color: var(--text-muted); }

            /* ===== Layout ===== */
            .layout { display: flex; padding-top: 68px; }
            .sidebar {
                position: sticky;
                top: 68px;
                align-self: flex-start;
                width: 288px;
                height: calc(100vh - 68px);
                overflow-y: auto;
                overflow-x: visible;
                padding: 1.25rem 0.85rem 2rem;
                border-right: 1px solid color-mix(in srgb, var(--border) 50%, transparent);
                background: color-mix(in srgb, var(--surface-solid) 60%, transparent);
                backdrop-filter: blur(16px) saturate(150%);
                -webkit-backdrop-filter: blur(16px) saturate(150%);
                z-index: 10;
                transition: width 0.28s cubic-bezier(0.4, 0, 0.2, 1), padding 0.28s ease;
            }
            .search-wrap { position: relative; padding: 0 0.4rem 0.5rem; }
            .search-wrap svg { position: absolute; left: 1rem; top: 50%; transform: translateY(-60%); width: 16px; height: 16px; color: var(--text-dim); }
            .search-wrap input {
                width: 100%;
                padding: 0.7rem 2rem 0.7rem 2.4rem;
                background: color-mix(in srgb, var(--surface-solid) 50%, transparent);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid color-mix(in srgb, var(--border) 50%, transparent);
                border-radius: 12px;
                color: var(--text);
                font-size: 0.85rem;
                outline: none;
                transition: all 0.18s ease;
            }
            .search-wrap input::placeholder { color: var(--text-dim); }
            .search-wrap input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px var(--accent-soft); }

            .nav-section-title {
                padding: 1rem 1rem 0.4rem;
                font-size: 0.68rem; font-weight: 800; letter-spacing: 0.09em;
                text-transform: uppercase; color: var(--text-dim);
                border-bottom: 1px solid var(--border);
            }
            .nav-section-title.main-menu {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.8rem 1rem;
                font-size: 0.72rem;
                font-weight: 800;
                letter-spacing: 0.06em;
                color: var(--accent);
                background: linear-gradient(90deg, var(--accent-soft), transparent);
                border-bottom: 2px solid var(--accent);
                border-radius: 12px 12px 0 0;
                margin-bottom: 0.3rem;
            }
            .nav-section-title.main-menu svg {
                width: 16px; height: 16px;
                filter: drop-shadow(0 0 4px color-mix(in srgb, var(--accent) 50%, transparent));
            }
            .nav-list { list-style: none; margin: 0; padding: 0; }
            .nav-item { margin: 2px 0; }
            .nav-link {
                display: flex; align-items: center; gap: 0.7rem;
                padding: 0.62rem 0.85rem;
                border-radius: 12px;
                color: var(--text-muted);
                font-size: 0.88rem; font-weight: 500;
                cursor: pointer;
                position: relative;
                transition: all 0.16s ease;
            }
            .nav-link svg { width: 19px; height: 19px; flex-shrink: 0; }
            .nav-link:hover {
                background: color-mix(in srgb, var(--surface-solid) 50%, transparent);
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                color: var(--text);
            }
            .nav-link.active {
                background: color-mix(in srgb, var(--accent) 15%, transparent);
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                color: var(--accent);
                font-weight: 600;
            }
            .nav-link.active::before {
                content: ""; position: absolute; left: -0.85rem; top: 20%; bottom: 20%;
                width: 3px; border-radius: 999px; background: var(--accent);
            }
            .nav-link.has-submenu { justify-content: space-between; }
            .nav-link.has-submenu > span { display: flex; align-items: center; gap: 0.7rem; }
            .chevron { width: 15px !important; transition: transform 0.2s ease; }
            .nav-link.expanded .chevron { transform: rotate(180deg); }
            .submenu { list-style: none; margin: 0; padding: 0; max-height: 0; overflow: hidden; transition: max-height 0.28s ease; }
            .submenu.expanded { max-height: 320px; }
            .submenu .nav-link { padding-left: 2.85rem; font-size: 0.83rem; }

            /* ===== Content ===== */
            .content { flex: 1; min-width: 0; padding: 1.75rem clamp(1rem, 3vw, 2.5rem) 3rem; }
            .page-head {
                display: flex; align-items: center; gap: 1rem;
                margin-bottom: 1.5rem;
            }
            .page-head .ph-icon {
                width: 52px; height: 52px; border-radius: 14px;
                display: grid; place-items: center;
                background: var(--accent-soft); color: var(--accent);
                border: 1px solid color-mix(in srgb, var(--accent) 25%, transparent);
            }
            .page-head .ph-icon svg { width: 26px; height: 26px; }
            .page-head h2 { margin: 0; font-size: 1.6rem; font-weight: 800; letter-spacing: -0.02em; }
            .page-head p { margin: 0.15rem 0 0; color: var(--text-muted); font-size: 0.9rem; }

            .section-content { animation: fadeIn 0.35s ease; }
            @keyframes fadeIn { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }

            .video-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
                gap: 1.5rem;
                margin-top: 0.5rem;
            }
            @media (max-width: 768px) {
                .video-grid { grid-template-columns: 1fr; gap: 1rem; }
            }
            @media (min-width: 1400px) {
                .video-grid { grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); }
            }
            .video-grid--full { display: block; }
            .video-card--full { grid-column: 1 / -1; }

            .video-card {
                background: color-mix(in srgb, var(--surface-solid) 65%, transparent);
                backdrop-filter: blur(16px) saturate(150%);
                -webkit-backdrop-filter: blur(16px) saturate(150%);
                border: 1px solid color-mix(in srgb, var(--border) 50%, transparent);
                border-radius: var(--radius);
                padding: 1rem;
                box-shadow: var(--shadow);
                display: flex;
                flex-direction: column;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }
            .video-card:hover {
                transform: translateY(-4px);
                border-color: var(--accent);
                box-shadow:
                    0 24px 48px -20px rgba(0, 0, 0, 0.7),
                    0 0 0 1px var(--accent),
                    0 0 20px color-mix(in srgb, var(--accent) 40%, transparent),
                    0 0 40px color-mix(in srgb, var(--accent) 20%, transparent);
            }
            .video-frame {
                position: relative;
                border-radius: 14px;
                overflow: hidden;
                background: #05070c;
                border: 1px solid var(--border);
                aspect-ratio: 16 / 9;
            }
            .video-frame video { width: 100%; height: 100%; display: block; object-fit: cover; }
            .dashboard-videos {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 1.5rem;
            }
            @media (max-width: 768px) {
                .dashboard-videos { grid-template-columns: 1fr; }
            }
            .documentation {
                margin-top: 1.5rem;
                padding: 1rem;
                background: color-mix(in srgb, var(--surface-solid) 60%, transparent);
                backdrop-filter: blur(16px) saturate(150%);
                -webkit-backdrop-filter: blur(16px) saturate(150%);
                border: 1px solid color-mix(in srgb, var(--border) 50%, transparent);
                border-radius: var(--radius);
            }
            .doc-header {
                display: flex;
                align-items: flex-start;
                gap: 1rem;
                padding: 1rem;
                background: color-mix(in srgb, var(--accent) 12%, transparent);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid color-mix(in srgb, var(--accent) 25%, transparent);
                border-radius: 14px;
                margin-bottom: 1rem;
            }
            .doc-icon {
                width: 48px; height: 48px;
                border-radius: 12px;
                display: grid; place-items: center;
                background: linear-gradient(135deg, var(--accent), #059669);
                color: #fff;
                flex-shrink: 0;
                box-shadow: 0 4px 14px -4px color-mix(in srgb, var(--accent) 60%, transparent);
            }
            .doc-icon svg { width: 24px; height: 24px; }
            .doc-title h3 { margin: 0 0 0.35rem 0; }
            .doc-title p { margin: 0; }
            .doc-body { padding: 0.5rem 1rem; }
            .documentation h3 {
                font-size: 1.15rem;
                color: var(--text);
                margin-bottom: 0.75rem;
                font-weight: 600;
            }
            .documentation h4 {
                font-size: 0.95rem;
                color: var(--text);
                margin-top: 1rem;
                margin-bottom: 0.5rem;
                font-weight: 600;
            }
            .documentation p {
                color: var(--text-muted);
                line-height: 1.6;
                margin-bottom: 0.75rem;
            }
            .documentation ul {
                list-style: none;
                padding: 0;
                margin: 0 0 0.75rem 0;
            }
            .documentation li {
                color: var(--text-muted);
                padding: 0.35rem 0;
                padding-left: 1.25rem;
                position: relative;
                line-height: 1.5;
            }
            .documentation li::before {
                content: "•";
                position: absolute;
                left: 0;
                color: var(--primary);
                font-weight: bold;
            }
            .documentation strong {
                color: var(--text);
                font-weight: 600;
            }
            .video-empty {
                position: absolute; inset: 0;
                display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.6rem;
                color: var(--text-dim); text-align: center; padding: 1rem;
            }
            .video-empty svg { width: 40px; height: 40px; opacity: 0.7; }
            .video-desc {
                margin: 1rem 0.35rem 0.35rem;
                color: var(--text-muted);
                line-height: 1.65;
                font-size: 0.92rem;
            }
            .video-meta { display: flex; flex-wrap: wrap; gap: 0.5rem; margin: 0.9rem 0.35rem 0; }
            .chip {
                display: inline-flex; align-items: center; gap: 0.4rem;
                padding: 0.35rem 0.7rem; border-radius: 999px;
                background: var(--surface-2); border: 1px solid var(--border);
                font-size: 0.74rem; color: var(--text-muted); font-weight: 500;
            }
            .chip svg { width: 13px; height: 13px; }

            .sidebar-overlay { display: none; }

            /* ===== Search Assistant ===== */
            .assistant-fab {
                position: fixed;
                right: 1.5rem;
                bottom: 1.5rem;
                width: 56px;
                height: 56px;
                border-radius: 50%;
                border: none;
                background: linear-gradient(135deg, var(--accent), #059669);
                color: #fff;
                cursor: pointer;
                z-index: 1100;
                display: grid;
                place-items: center;
                box-shadow: 0 8px 24px -6px rgba(16, 185, 129, 0.6);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
                animation: brand-glow 2.5s ease-in-out infinite alternate;
            }
            .assistant-fab:hover { transform: scale(1.08); }
            .assistant-fab svg { width: 26px; height: 26px; }
            .assistant-fab.active { transform: scale(0.9); }
            .assistant-panel {
                position: fixed;
                right: 1.5rem;
                bottom: 5.5rem;
                width: 400px;
                max-width: calc(100vw - 3rem);
                max-height: 520px;
                background: var(--surface-solid);
                border: 1px solid var(--border);
                border-radius: 20px;
                box-shadow: 0 24px 64px -12px rgba(0, 0, 0, 0.6);
                z-index: 1100;
                display: none;
                flex-direction: column;
                overflow: hidden;
                animation: assistantSlide 0.25s ease;
            }
            @keyframes assistantSlide {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .assistant-panel.open { display: flex; }
            .assistant-header {
                padding: 1rem 1.25rem;
                background: linear-gradient(135deg, var(--accent), #059669);
                color: #fff;
                display: flex;
                align-items: center;
                gap: 0.6rem;
            }
            .assistant-header svg { width: 22px; height: 22px; flex-shrink: 0; }
            .assistant-header h3 { margin: 0; font-size: 1rem; font-weight: 700; }
            .assistant-header p { margin: 0; font-size: 0.72rem; opacity: 0.85; }
            .assistant-close {
                margin-left: auto;
                background: rgba(255,255,255,0.2);
                border: none;
                color: #fff;
                width: 28px; height: 28px;
                border-radius: 50%;
                cursor: pointer;
                display: grid; place-items: center;
                font-size: 16px;
                transition: background 0.15s ease;
            }
            .assistant-close:hover { background: rgba(255,255,255,0.35); }
            .assistant-body {
                flex: 1;
                overflow-y: auto;
                padding: 1rem 1.25rem;
            }
            .assistant-msg {
                margin-bottom: 0.75rem;
                font-size: 0.85rem;
                line-height: 1.5;
            }
            .assistant-msg.bot {
                color: var(--text);
                background: var(--surface-2);
                padding: 0.7rem 0.9rem;
                border-radius: 12px 12px 12px 4px;
            }
            .assistant-msg.user {
                color: #fff;
                background: var(--accent);
                padding: 0.7rem 0.9rem;
                border-radius: 12px 12px 4px 12px;
                margin-left: 2rem;
                text-align: right;
            }
            .assistant-suggestions { display: flex; flex-direction: column; gap: 0.5rem; margin-top: 0.5rem; }
            .assistant-suggestion {
                display: flex;
                align-items: center;
                gap: 0.6rem;
                padding: 0.65rem 0.85rem;
                border: 1px solid var(--border);
                border-radius: 12px;
                cursor: pointer;
                transition: all 0.15s ease;
                background: var(--surface);
            }
            .assistant-suggestion:hover {
                border-color: var(--accent);
                background: var(--accent-soft);
                transform: translateX(4px);
            }
            .assistant-suggestion svg { width: 20px; height: 20px; flex-shrink: 0; }
            .assistant-suggestion .s-title { font-size: 0.84rem; font-weight: 600; color: var(--text); }
            .assistant-suggestion .s-desc { font-size: 0.72rem; color: var(--text-muted); }
            .assistant-suggestion .s-go {
                margin-left: auto;
                color: var(--accent);
                font-size: 0.72rem;
                font-weight: 600;
                white-space: nowrap;
            }
            .assistant-empty {
                text-align: center;
                padding: 1.5rem 1rem;
                color: var(--text-dim);
                font-size: 0.82rem;
            }
            .assistant-footer {
                padding: 0.75rem 1rem;
                border-top: 1px solid var(--border);
                display: flex;
                gap: 0.5rem;
            }
            .assistant-input {
                flex: 1;
                padding: 0.65rem 0.85rem;
                border: 1px solid var(--border);
                border-radius: 12px;
                background: var(--surface);
                color: var(--text);
                font-size: 0.85rem;
                font-family: inherit;
                outline: none;
                transition: border-color 0.15s ease;
            }
            .assistant-input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px var(--accent-soft); }
            .assistant-send {
                width: 40px; height: 40px;
                border: none;
                border-radius: 12px;
                background: var(--accent);
                color: #fff;
                cursor: pointer;
                display: grid; place-items: center;
                transition: background 0.15s ease;
            }
            .assistant-send:hover { background: #059669; }
            .assistant-send svg { width: 18px; height: 18px; }
            .assistant-quick {
                display: flex;
                flex-wrap: wrap;
                gap: 0.4rem;
                padding: 0 1.25rem 0.75rem;
            }
            .assistant-chip {
                padding: 0.3rem 0.7rem;
                border: 1px solid var(--border);
                border-radius: 999px;
                background: var(--surface);
                color: var(--text-muted);
                font-size: 0.75rem;
                cursor: pointer;
                transition: all 0.15s ease;
            }
            .assistant-chip:hover { border-color: var(--accent); color: var(--accent); background: var(--accent-soft); }
            @media (max-width: 560px) {
                .assistant-panel { right: 0.75rem; bottom: 4.75rem; }
                .assistant-fab { right: 0.75rem; bottom: 0.75rem; }
            }

            /* ===== Settings Panel ===== */
            .settings-overlay {
                position: fixed; inset: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1200;
                display: none;
                animation: fadeIn 0.2s ease;
            }
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
            /* Toggle switch */
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
            html.dark .setting-select option {
                background: #111c30;
                color: #e8eef7;
            }
            html:not(.dark) .setting-select option {
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
                transition: all 0.15s ease;
                font-family: inherit;
            }
            .settings-btn:hover { background: var(--surface-2); }
            .settings-btn.primary { background: var(--accent); color: #fff; border-color: var(--accent); }
            .settings-btn.primary:hover { background: #059669; }
            @media (max-width: 560px) {
                .settings-panel { width: 100vw; }
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

            /* Accessibility: Reduce Motion */
            body.reduce-motion *,
            body.reduce-motion *::before,
            body.reduce-motion *::after {
                animation-duration: 0.01s !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01s !important;
            }
            /* Accessibility: High Contrast */
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
            body.high-contrast .nav-link.active,
            body.high-contrast .video-card,
            body.high-contrast .documentation {
                border-width: 2px;
            }
            /* ===== Mini Sidebar (icons only) ===== */
            .sidebar.mini { width: 64px; padding: 1.25rem 0.5rem 2rem; }
            .sidebar.mini .search-wrap { padding: 0 0 0.5rem; }
            .sidebar.mini .search-wrap svg { left: 50%; transform: translate(-50%, -60%); }
            .sidebar.mini .search-wrap input { padding: 0.7rem; width: 40px; height: 40px; text-indent: -999px; overflow: hidden; }
            .sidebar.mini .search-wrap input::placeholder { color: transparent; }

            .sidebar.mini .nav-section-title {
                font-size: 0;
                padding: 0.5rem 0;
                border-bottom: 1px solid var(--border);
                text-align: center;
                display: flex;
                justify-content: center;
            }
            .sidebar.mini .nav-section-title.main-menu {
                padding: 0.5rem 0;
                border-radius: 8px;
                background: var(--accent-soft);
                border-bottom: 2px solid var(--accent);
                justify-content: center;
            }
            .sidebar.mini .nav-section-title.main-menu svg { width: 18px; height: 18px; }

            .sidebar.mini .nav-link {
                justify-content: center;
                padding: 0.62rem 0;
                font-size: 0;
                gap: 0;
            }
            .sidebar.mini .nav-link svg { width: 20px; height: 20px; }
            .sidebar.mini .nav-link.has-submenu { justify-content: center; }
            .sidebar.mini .nav-link.has-submenu > span { font-size: 0; gap: 0; }
            .sidebar.mini .chevron { display: none; }
            .sidebar.mini .submenu { display: none; }
            .sidebar.mini .nav-link.active::before { left: 0; }

            /* Tooltip in mini mode */
            .sidebar.mini .nav-link::after {
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
            .sidebar.mini .nav-link:hover::after { opacity: 1; }

            /* Collapsed sidebar (fully hidden — mobile/fallback) */
            .sidebar.collapsed { width: 0; overflow: hidden; padding: 0; border: none; }
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
                border-color: var(--accent);
                transform: translateY(-50%) scale(1.15);
                box-shadow: 0 0 24px -4px color-mix(in srgb, var(--accent) 60%, transparent);
            }
            .sidebar-hide-btn:hover::before { opacity: 0.6; }
            .sidebar-hide-btn svg {
                width: 16px;
                height: 16px;
                transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            }
            .sidebar-hide-btn:hover svg { transform: rotate(180deg); }

            @media (max-width: 900px) {
                .menu-toggle { display: flex; }
                .sidebar {
                    position: fixed; top: 68px; left: 0; z-index: 50;
                    transform: translateX(-100%); transition: transform 0.25s ease;
                    width: 280px;
                    background: var(--surface-solid);
                }
                .sidebar.open { transform: translateX(0); }
                .sidebar.mini { width: 280px; padding: 1.25rem 0.85rem 2rem; }
                .sidebar.mini .search-wrap input { text-indent: 0; width: 100%; padding: 0.7rem 2rem 0.7rem 2.4rem; }
                .sidebar.mini .search-wrap svg { left: 1rem; transform: translateY(-60%); }
                .sidebar.mini .nav-link { justify-content: flex-start; font-size: 0.88rem; gap: 0.7rem; padding: 0.62rem 0.85rem; }
                .sidebar.mini .nav-link.has-submenu > span { font-size: 0.88rem; gap: 0.7rem; }
                .sidebar.mini .chevron { display: block; }
                .sidebar.mini .submenu { display: block; }
                .sidebar.mini .nav-section-title { font-size: 0.68rem; padding: 1rem 1rem 0.4rem; justify-content: flex-start; }
                .sidebar.mini .nav-link::after { display: none; }
                .sidebar-overlay.show { display: block; position: fixed; inset: 68px 0 0 0; background: rgba(0,0,0,0.5); z-index: 45; }
                .user-chip .u-info { display: none; }
                .brand-text p { display: none; }
            }
            @media (max-width: 560px) {
                .live-pill { display: none; }
            }
            /* ACD_TMS curved vector background overlay */
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

        <!-- Top bar -->
        <header class="topbar">
            <div class="topbar-left">
                <button class="menu-toggle" onclick="toggleSidebar()" aria-label="Toggle menu">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <a href="index.php" class="brand">
                    <span class="brand-mark">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </span>
                    <span class="brand-text">
                        <h1>DISPATCH</h1>
                        <p>Video Tutorial Library</p>
                    </span>
                </a>
            </div>
            <div class="topbar-right">
                <button class="icon-btn refresh-btn" onclick="refreshPage()" title="Refresh">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                </button>
                <a href="tutorials.php" class="icon-btn tutorials-btn" title="Video Tutorial Library">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </a>
                <button class="icon-btn tour-btn" onclick="startTour()" title="Start Tour Guide" aria-label="Start tour guide">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 9m0 8V9m0 0L9 7"/></svg>
                </button>
                <button class="icon-btn theme-btn" onclick="toggleTheme()" title="Toggle theme" id="theme-btn">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                </button>
                <button class="icon-btn settings-btn-top" onclick="toggleSettings()" title="Settings" aria-label="Open settings">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </button>
            </div>
        </header>

        <div class="sidebar-overlay" id="sidebar-overlay" onclick="toggleSidebar()"></div>

        <!-- Search Assistant -->
        <button class="assistant-fab" id="assistant-fab" onclick="toggleAssistant()" title="Search Assistant" aria-label="Open search assistant">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 3v-3z"/></svg>
        </button>
        <div class="assistant-panel" id="assistant-panel">
            <div class="assistant-header">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                <div>
                    <h3>Search Assistant</h3>
                    <p>Ask me what you need help with</p>
                </div>
                <button class="assistant-close" onclick="toggleAssistant()" aria-label="Close">&times;</button>
            </div>
            <div class="assistant-body" id="assistant-body">
                <div class="assistant-msg bot">Hi! I'm your search assistant. Tell me what you're looking for and I'll find the right tutorial for you. For example: "how do I add a driver?" or "fuel reports"</div>
                <div class="assistant-quick" id="assistant-quick">
                    <span class="assistant-chip" onclick="assistantAsk('How do I register a new driver?')">Register a driver</span>
                    <span class="assistant-chip" onclick="assistantAsk('How do I manage my fleet?')">Manage fleet</span>
                    <span class="assistant-chip" onclick="assistantAsk('How do I view fuel reports?')">Fuel reports</span>
                    <span class="assistant-chip" onclick="assistantAsk('How do I manage payroll?')">Payroll</span>
                    <span class="assistant-chip" onclick="assistantAsk('How do I track violations?')">Violations</span>
                </div>
            </div>
            <div class="assistant-footer">
                <input type="text" class="assistant-input" id="assistant-input" placeholder="Type your question..." onkeypress="if(event.key==='Enter')assistantSend()">
                <button class="assistant-send" onclick="assistantSend()" aria-label="Send">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                </button>
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
                            <div class="s-hint">Automatically play videos when opening a section</div>
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

        <!-- Tour Guide Overlay -->
        <div class="tour-overlay" id="tour-overlay">
            <div class="tour-highlight" id="tour-highlight"></div>
            <div class="tour-tooltip" id="tour-tooltip">
                <div class="tour-tooltip-header">
                    <div class="tour-step-badge">
                        <span class="badge-num" id="tour-badge-num">1</span>
                        <span id="tour-step-label">Step 1 of 8</span>
                    </div>
                    <div class="tour-progress" id="tour-progress"></div>
                </div>
                <div class="tour-tooltip-body">
                    <div class="tour-title" id="tour-title">Welcome!</div>
                    <div class="tour-desc" id="tour-desc">Let's take a quick tour of the DISPATCH system.</div>
                    <div class="tour-controls">
                        <button class="tour-btn-control" id="tour-prev" onclick="tourPrev()">Back</button>
                        <button class="tour-btn-control primary" id="tour-next" onclick="tourNext()">Next</button>
                        <button class="tour-skip" onclick="endTour()">Skip tour</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="layout">
            <!-- Sidebar -->
            <aside class="sidebar" id="sidebar">
                <div class="search-wrap">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" id="sidebar-search" placeholder="Search tutorials..." onkeyup="filterMenu()" oninput="syncAssistantFromSidebar()" onclick="if(document.getElementById('sidebar').classList.contains('mini')){toggleSidebarMini();this.focus();}">
                </div>
                <button class="sidebar-hide-btn" onclick="toggleSidebarMini()" title="Collapse sidebar" aria-label="Toggle sidebar" id="sidebar-toggle-btn">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 19l-7-7 7-7M19 19l-7-7 7-7"/></svg>
                </button>

                <div class="nav-section-title">Main Menu</div>
                <ul class="nav-list">
                    
                    <li class="nav-item">
                        <a class="nav-link active" onclick="showSection('dashboard', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#10b981"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Dashboard
                        </a>
                    </li>
                </ul>

                <div class="nav-section-title">Operations &amp; Dispatch</div>
                <ul class="nav-list">
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('my-loads', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#3b82f6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            My Loads
                        </a>
                    </li>
                </ul>

                <div class="nav-section-title">Fleet Management</div>
                <ul class="nav-list">
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('my-trucks', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#f59e0b"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1"/></svg>
                            My Trucks
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('my-trailers', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#8b5cf6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 18a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6a1 1 0 011-1h14a1 1 0 011 1v10a1 1 0 01-1 1h-1m-4 0H9m-2 0H4a1 1 0 01-1-1V6z"/></svg>
                            My Trailers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('driver-devices', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#ec4899"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a1 1 0 001-1V4a1 1 0 00-1-1H8a1 1 0 00-1 1v16a1 1 0 001 1z"/></svg>
                            Driver Devices
                        </a>
                    </li>
                </ul>

                <div class="nav-section-title">Lease Management</div>
                <ul class="nav-list">
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('truck-lease-pricing', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#06b6d4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m3-1h9a2 2 0 002-2v-6a2 2 0 00-2-2h-9a2 2 0 00-2 2v6a2 2 0 002 2zm7-3a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            Truck Lease Pricing
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('truck-rentals', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#84cc16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1"/></svg>
                            Truck Rentals
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('lease-agreements', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#6366f1"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Lease Agreements
                        </a>
                    </li>
                </ul>

                <div class="nav-section-title">Recruitment</div>
                <ul class="nav-list">
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('hire-drivers', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#14b8a6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                            Hire Drivers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('job-postings', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#f97316"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            Job Postings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('external-drivers', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#a855f7"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            External Drivers
                        </a>
                    </li>
                </ul>

                <div class="nav-section-title">Marketing</div>
                <ul class="nav-list">
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('shout-out-scripts', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#eab308"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Shout Out Scripts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('shout-out-vlogs', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#ef4444"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Shout Out Vlogs
                        </a>
                    </li>
                </ul>

                <div class="nav-section-title">Financial</div>
                <ul class="nav-list">
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('accounting', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#22c55e"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m-6 4h6m-6 4h4M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/></svg>
                            Accounting
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('my-payroll', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#0ea5e9"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m-3 4h.01M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 15h6"/></svg>
                            My Payroll
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('my-factoring-company', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#d946ef"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            My Factoring Company
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('fuel-reports', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#f43f5e"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Fuel Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('my-fuel-cards', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#64748b"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                            My Fuel Cards
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('loans-cash-advance', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#10b981"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3L2 9h20L12 3zM4 9v8m4-8v8m8-8v8m4-8v8M2 21h20M3 17h18"/></svg>
                            Loans/Cash Advance
                        </a>
                    </li>
                </ul>

                <div class="nav-section-title">Safety and Compliance</div>
                <ul class="nav-list">
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('api-integration-keys', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#0d9488"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                            API Integration Keys
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('my-fleet', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#8b5cf6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/></svg>
                            My Fleet
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('emergency-monitoring', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#ef4444"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v18M3 12h18M5.6 5.6l12.8 12.8M18.4 5.6L5.6 18.4"/></svg>
                            Emergency Monitoring
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('compliance-monitoring', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#22c55e"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h4l3 8 4-16 3 8h4"/></svg>
                            Compliance Monitoring
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('compliance-software-options', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#3b82f6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            Compliance Software Options
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('drug-alcohol-testing', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#f59e0b"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                            Drug &amp; Alcohol Testing
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('safety-assessments', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#06b6d4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            Safety Assessments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('maintenance-monitoring', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#6366f1"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                            Maintenance Monitoring
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('my-drivers', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#ec4899"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            My Drivers
                        </a>
                    </li>
                </ul>

                <div class="nav-section-title">Customer Relations</div>
                <ul class="nav-list">
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('my-customers', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#14b8a6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            My Customers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('my-shippers-list', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#84cc16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1"/></svg>
                            My Shippers List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('my-consignee-lists', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#a855f7"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            My Consignee Lists
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('my-brokers', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#f97316"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            My Brokers
                        </a>
                    </li>
                </ul>

                <div class="nav-section-title">System</div>
                <ul class="nav-list">
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('notifications', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#6366f1"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                            Notifications
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('activity', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#22c55e"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            Activity
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('maintenance', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#8b5cf6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Maintenance
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('documents', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#64748b"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Documents
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('reporting', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#3b82f6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Reporting
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="showSection('settings', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#8b5cf6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Settings
                        </a>
                    </li>
                </ul>
            </aside>

            <!-- Content -->
            <main class="content">
                <div id="page-head" class="page-head">
                    <div class="ph-icon" id="ph-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </div>
                    <div>
                        <h2 id="page-title">Dashboard</h2>
                        <p id="page-subtitle">Overview and statistics walkthrough</p>
                    </div>
                </div>

                <div id="section-dashboard" class="section-content">
                    <div class="video-grid video-grid--full">
                        <div class="video-card video-card--full">
                            <div class="video-frame">
                                <video controls playsinline><source src="videos/dashboard.mp4" type="video/mp4"></video>
                            </div>
                            <p class="video-desc">Learn how to navigate the dashboard, monitor compliance, access reports, and use the available system features.</p>
                            <div class="video-meta"><span class="chip">Beginner</span><span class="chip">Getting Started</span></div>
                        </div>
                    </div>

                <!-- Dashboard Documentation -->
    <div class="documentation">

        <div class="doc-header">
            <div class="doc-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3v18h18M7 16V8m5 8V4m5 12v-6"/></svg>
            </div>

            <div class="doc-title">
                <h3>Dashboard Documentation</h3>
                <p>
                    The Dashboard is the main landing page of the Asset Logistics
                    system. It provides a real-time overview of fleet compliance,
                    operational performance, and important alerts.
                </p>
            </div>
        </div>

        <div class="doc-body">

            <h4>Key Features</h4>

            <ul class="feature-list">
                <li>Compliance Status – Monitor IRP, IFTA, Insurance, BOC-3, MC Authority, DOT, and other compliance documents.</li>

                <li>Analytics & Monitoring – View charts, graphs, and operational metrics.</li>

                <li>Alert Status – Track expired documents and pending compliance requirements.</li>

                <li>Safety Score – Review your fleet's safety performance.</li>

                <li>Performance Reports – Analyze operational trends and statistics.</li>

                <li>Quick Navigation – Easily access Drivers, Fleet, Maintenance, Documents, Reporting, and other modules.</li>
            </ul>

            <h4>Purpose</h4>

            <p>
                The Dashboard serves as the central control panel for monitoring fleet
                operations, compliance, and performance from one location.
            </p>
            </div>

        </div>

    </div>
                <div id="section-my-loads" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/my-loads.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Create, assign, and track loads through dispatch — from booking to delivery.</p>
                        <div class="video-meta"><span class="chip">Operations</span><span class="chip">Dispatch</span></div>
                    </div>
                </div>

                <div id="section-my-trucks" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/my-trucks.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Add, view, and manage the trucks in your fleet.</p>
                        <div class="video-meta"><span class="chip">Fleet</span></div>
                    </div>
                </div>
                <div id="section-my-trailers" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/my-trailers.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Add, view, and manage the trailers in your fleet.</p>
                        <div class="video-meta"><span class="chip">Fleet</span></div>
                    </div>
                </div>
                <div id="section-driver-devices" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/driver-devices.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Manage driver mobile devices and ELD connections.</p>
                        <div class="video-meta"><span class="chip">Fleet</span></div>
                    </div>
                </div>

                <div id="section-truck-lease-pricing" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/truck-lease-pricing.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Review and configure truck lease pricing options.</p>
                        <div class="video-meta"><span class="chip">Lease</span></div>
                    </div>
                </div>
                <div id="section-truck-rentals" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/truck-rentals.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Manage truck rentals and short-term equipment agreements.</p>
                        <div class="video-meta"><span class="chip">Lease</span></div>
                    </div>
                </div>
                <div id="section-lease-agreements" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/lease-agreements.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Create, sign, and track lease agreements.</p>
                        <div class="video-meta"><span class="chip">Lease</span></div>
                    </div>
                </div>

                <div id="section-hire-drivers" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/hire-drivers.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Recruit and onboard new drivers into your operation.</p>
                        <div class="video-meta"><span class="chip">Recruitment</span></div>
                    </div>
                </div>
                <div id="section-job-postings" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/job-postings.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Create and manage driver job postings.</p>
                        <div class="video-meta"><span class="chip">Recruitment</span></div>
                    </div>
                </div>
                <div id="section-external-drivers" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/external-drivers.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Manage external and owner-operator drivers.</p>
                        <div class="video-meta"><span class="chip">Recruitment</span></div>
                    </div>
                </div>

                <div id="section-shout-out-scripts" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/shout-out-scripts.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Access ready-made shout out scripts for your marketing.</p>
                        <div class="video-meta"><span class="chip">Marketing</span></div>
                    </div>
                </div>
                <div id="section-shout-out-vlogs" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/shout-out-vlogs.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Watch shout out vlog examples and marketing walkthroughs.</p>
                        <div class="video-meta"><span class="chip">Marketing</span></div>
                    </div>
                </div>

                <div id="section-accounting" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/accounting.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Manage accounting, invoices, and financial records.</p>
                        <div class="video-meta"><span class="chip">Financial</span></div>
                    </div>
                </div>
                <div id="section-my-payroll" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/my-payroll.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Run and manage driver and staff payroll.</p>
                        <div class="video-meta"><span class="chip">Financial</span></div>
                    </div>
                </div>
                <div id="section-my-factoring-company" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/my-factoring-company.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Connect and manage your factoring company.</p>
                        <div class="video-meta"><span class="chip">Financial</span></div>
                    </div>
                </div>
                <div id="section-fuel-reports" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/fuel-reports.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">View fuel spending reports and analytics.</p>
                        <div class="video-meta"><span class="chip">Financial</span></div>
                    </div>
                </div>
                <div id="section-my-fuel-cards" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/my-fuel-cards.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Manage fuel cards and driver spending limits.</p>
                        <div class="video-meta"><span class="chip">Financial</span></div>
                    </div>
                </div>
                <div id="section-loans-cash-advance" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/loans-cash-advance.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Apply for and track loans and cash advances.</p>
                        <div class="video-meta"><span class="chip">Financial</span></div>
                    </div>
                </div>

                <div id="section-api-integration-keys" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/api-integration-keys.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Generate and manage API integration keys.</p>
                        <div class="video-meta"><span class="chip">Safety &amp; Compliance</span></div>
                    </div>
                </div>
                <div id="section-my-fleet" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/my-fleet.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Monitor your fleet's safety and compliance status.</p>
                        <div class="video-meta"><span class="chip">Safety &amp; Compliance</span></div>
                    </div>
                </div>
                <div id="section-emergency-monitoring" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/emergency-monitoring.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Set up and respond to emergency monitoring alerts.</p>
                        <div class="video-meta"><span class="chip">Safety &amp; Compliance</span></div>
                    </div>
                </div>
                <div id="section-compliance-monitoring" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/compliance-monitoring.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Track compliance metrics in real time.</p>
                        <div class="video-meta"><span class="chip">Safety &amp; Compliance</span></div>
                    </div>
                </div>
                <div id="section-compliance-software-options" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/compliance-software-options.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Explore available compliance software integrations.</p>
                        <div class="video-meta"><span class="chip">Safety &amp; Compliance</span></div>
                    </div>
                </div>
                <div id="section-drug-alcohol-testing" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/drug-alcohol-testing.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Manage drug and alcohol testing programs.</p>
                        <div class="video-meta"><span class="chip">Safety &amp; Compliance</span></div>
                    </div>
                </div>
                <div id="section-safety-assessments" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/safety-assessments.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Run and review driver and vehicle safety assessments.</p>
                        <div class="video-meta"><span class="chip">Safety &amp; Compliance</span></div>
                    </div>
                </div>
                <div id="section-maintenance-monitoring" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/maintenance-monitoring.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Monitor maintenance schedules and vehicle health.</p>
                        <div class="video-meta"><span class="chip">Safety &amp; Compliance</span></div>
                    </div>
                </div>
                <div id="section-my-drivers" class="section-content" style="display:none;">
                    <div class="video-grid video-grid--full">
                        <div class="video-card video-card--full">
                            <div class="video-frame"><video controls playsinline><source src="videos/how-to-register-new-drivers.mp4" type="video/mp4"></video></div>
                            <p class="video-desc">Step-by-step guide on how to register new drivers in the system.</p>
                            <div class="video-meta"><span class="chip">Tutorial</span><span class="chip">Driver Management</span></div>
                        </div>
                    </div>

                    <div class="documentation">
                        <div class="doc-header">
                            <div class="doc-icon">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-2m4-4a4 4 0 11-8 0 4 4 0 018 0zm-1.5-3h.01M14 16l1.5-1.5"/></svg>
                            </div>
                            <div class="doc-title">
                                <h3>My Drivers Documentation</h3>
                                <p>The My Drivers module allows you to manage all driver profiles, track compliance status, and register new drivers into the system.</p>
                            </div>
                        </div>
                        <div class="doc-body">
                            <h4>Key Features</h4>
                            <ul class="feature-list">
                                <li>Driver Registration – Add new drivers by entering their personal details, license information, and contact data.</li>
                                <li>Driver List – View all registered drivers in a searchable, filterable table.</li>
                                <li>Compliance Tracking – Monitor each driver's CDL status, medical certificates, and HOS compliance.</li>
                                <li>Profile Management – Edit or update driver information including license renewals and address changes.</li>
                                <li>Document Upload – Attach required documents such as CDL, medical card, and background check results.</li>
                                <li>Status Indicators – Quickly see which drivers are active, inactive, or pending compliance review.</li>
                            </ul>
                            <h4>How to Register a New Driver</h4>
                            <ul class="feature-list">
                                <li>Navigate to the My Drivers section from the sidebar menu.</li>
                                <li>Click the "Add Driver" or "Register New Driver" button.</li>
                                <li>Fill in the required fields: full name, date of birth, phone number, and email address.</li>
                                <li>Enter license details including CDL number, license class, issuing state, and expiration date.</li>
                                <li>Upload necessary documents (CDL copy, medical certificate, etc.).</li>
                                <li>Review the information and click "Save" to complete the registration.</li>
                            </ul>
                            <h4>Purpose</h4>
                            <p>The My Drivers module serves as the central hub for managing your workforce, ensuring all drivers are properly registered, documented, and compliant with regulatory requirements.</p>
                        </div>
                    </div>
                </div>

                <div id="section-my-customers" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/my-customers.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Add, view, and manage your customers.</p>
                        <div class="video-meta"><span class="chip">Customer Relations</span></div>
                    </div>
                </div>
                <div id="section-my-shippers-list" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/my-shippers-list.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Manage your list of shippers.</p>
                        <div class="video-meta"><span class="chip">Customer Relations</span></div>
                    </div>
                </div>
                <div id="section-my-consignee-lists" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/my-consignee-lists.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Manage your consignee lists and locations.</p>
                        <div class="video-meta"><span class="chip">Customer Relations</span></div>
                    </div>
                </div>
                <div id="section-my-brokers" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/my-brokers.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Add and manage your brokers.</p>
                        <div class="video-meta"><span class="chip">Customer Relations</span></div>
                    </div>
                </div>

                <div id="section-violations" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/violations.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Track and manage compliance violations across your operations.</p>
                        <div class="video-meta"><span class="chip">Compliance</span></div>
                    </div>
                </div>
                <div id="section-safety-violations" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/safety violations.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Monitor safety-related violations and ensure regulatory compliance.</p>
                        <div class="video-meta"><span class="chip">Compliance</span></div>
                    </div>
                </div>
                <div id="section-driver-violations" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/driver-violations.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Track driver-specific violations and implement corrective actions.</p>
                        <div class="video-meta"><span class="chip">Compliance</span></div>
                    </div>
                </div>
                <div id="section-vehicle-violations" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/vehicle-violations.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Monitor vehicle-related violations and maintenance issues.</p>
                        <div class="video-meta"><span class="chip">Compliance</span></div>
                    </div>
                </div>
                <div id="section-notifications" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/notifications.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Stay informed with real-time alerts and system notifications.</p>
                        <div class="video-meta"><span class="chip">System</span></div>
                    </div>
                </div>
                <div id="section-activity" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/activity.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">View system activity logs and track user actions.</p>
                        <div class="video-meta"><span class="chip">System</span></div>
                    </div>
                </div>
                <div id="section-maintenance" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/maintenance.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Schedule and track vehicle maintenance to ensure optimal performance.</p>
                        <div class="video-meta"><span class="chip">System</span></div>
                    </div>
                </div>
                <div id="section-drug-alcohol" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/drug-alcohol.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Manage drug and alcohol testing programs and compliance records.</p>
                        <div class="video-meta"><span class="chip">Compliance</span></div>
                    </div>
                </div>
                <div id="section-documents" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/documents.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Store and manage all compliance documents in one centralized location.</p>
                        <div class="video-meta"><span class="chip">System</span></div>
                    </div>
                </div>
                <div id="section-permit-insurance" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/permit-insurance.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Track permits, licenses, and insurance documentation for compliance.</p>
                        <div class="video-meta"><span class="chip">Compliance</span></div>
                    </div>
                </div>
                <div id="section-reporting" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/reporting.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Generate comprehensive reports for compliance and operational insights.</p>
                        <div class="video-meta"><span class="chip">System</span></div>
                    </div>
                </div>
                <div id="section-safety" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/safety.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Monitor safety metrics and implement risk management strategies.</p>
                        <div class="video-meta"><span class="chip">Compliance</span></div>
                    </div>
                </div>
                <div id="section-hos" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/hos.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Track Hours of Service compliance and driver duty status.</p>
                        <div class="video-meta"><span class="chip">Compliance</span></div>
                    </div>
                </div>
                <div id="section-settings" class="section-content" style="display:none;">
                    <div class="video-card">
                        <div class="video-frame"><video controls playsinline><source src="videos/settings.mp4" type="video/mp4"></video></div>
                        <p class="video-desc">Configure system settings and customize your experience.</p>
                        <div class="video-meta"><span class="chip">System</span></div>
                    </div>
                </div>
        
        <script>
            const SECTION_ICONS = {
                'dashboard': '<svg fill="none" viewBox="0 0 24 24" stroke="#10b981"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>',
                'my-loads': '<svg fill="none" viewBox="0 0 24 24" stroke="#3b82f6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>',
                'my-trucks': '<svg fill="none" viewBox="0 0 24 24" stroke="#f59e0b"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>',
                'my-trailers': '<svg fill="none" viewBox="0 0 24 24" stroke="#8b5cf6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>',
                'driver-devices': '<svg fill="none" viewBox="0 0 24 24" stroke="#ec4899"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>',
                'truck-lease-pricing': '<svg fill="none" viewBox="0 0 24 24" stroke="#06b6d4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m3-1h9a2 2 0 002-2v-6a2 2 0 00-2-2h-9a2 2 0 00-2 2v6a2 2 0 002 2zm7-3a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
                'truck-rentals': '<svg fill="none" viewBox="0 0 24 24" stroke="#84cc16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1"/></svg>',
                'lease-agreements': '<svg fill="none" viewBox="0 0 24 24" stroke="#6366f1"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>',
                'hire-drivers': '<svg fill="none" viewBox="0 0 24 24" stroke="#14b8a6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>',
                'job-postings': '<svg fill="none" viewBox="0 0 24 24" stroke="#f97316"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>',
                'external-drivers': '<svg fill="none" viewBox="0 0 24 24" stroke="#a855f7"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
                'shout-out-scripts': '<svg fill="none" viewBox="0 0 24 24" stroke="#eab308"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>',
                'shout-out-vlogs': '<svg fill="none" viewBox="0 0 24 24" stroke="#ef4444"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>',
                'accounting': '<svg fill="none" viewBox="0 0 24 24" stroke="#22c55e"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                'my-payroll': '<svg fill="none" viewBox="0 0 24 24" stroke="#0ea5e9"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m3-1h9a2 2 0 002-2v-6a2 2 0 00-2-2h-9a2 2 0 00-2 2v6a2 2 0 002 2zm7-3a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
                'my-factoring-company': '<svg fill="none" viewBox="0 0 24 24" stroke="#d946ef"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>',
                'fuel-reports': '<svg fill="none" viewBox="0 0 24 24" stroke="#f43f5e"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>',
                'my-fuel-cards': '<svg fill="none" viewBox="0 0 24 24" stroke="#64748b"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>',
                'loans-cash-advance': '<svg fill="none" viewBox="0 0 24 24" stroke="#10b981"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                'api-integration-keys': '<svg fill="none" viewBox="0 0 24 24" stroke="#0d9488"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>',
                'my-fleet': '<svg fill="none" viewBox="0 0 24 24" stroke="#8b5cf6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1"/></svg>',
                'emergency-monitoring': '<svg fill="none" viewBox="0 0 24 24" stroke="#ef4444"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v18M3 12h18M5.6 5.6l12.8 12.8M18.4 5.6L5.6 18.4"/></svg>',
                'compliance-monitoring': '<svg fill="none" viewBox="0 0 24 24" stroke="#22c55e"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h4l3 8 4-16 3 8h4"/></svg>',
                'compliance-software-options': '<svg fill="none" viewBox="0 0 24 24" stroke="#3b82f6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>',
                'drug-alcohol-testing': '<svg fill="none" viewBox="0 0 24 24" stroke="#f59e0b"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>',
                'safety-assessments': '<svg fill="none" viewBox="0 0 24 24" stroke="#06b6d4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>',
                'maintenance-monitoring': '<svg fill="none" viewBox="0 0 24 24" stroke="#6366f1"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>',
                'my-drivers': '<svg fill="none" viewBox="0 0 24 24" stroke="#ec4899"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
                'my-customers': '<svg fill="none" viewBox="0 0 24 24" stroke="#14b8a6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
                'my-shippers-list': '<svg fill="none" viewBox="0 0 24 24" stroke="#84cc16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
                'my-consignee-lists': '<svg fill="none" viewBox="0 0 24 24" stroke="#a855f7"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
                'my-brokers': '<svg fill="none" viewBox="0 0 24 24" stroke="#f97316"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
                'violations': '<svg fill="none" viewBox="0 0 24 24" stroke="#f43f5e"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
                'safety-violations': '<svg fill="none" viewBox="0 0 24 24" stroke="#ef4444"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
                'driver-violations': '<svg fill="none" viewBox="0 0 24 24" stroke="#f59e0b"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
                'vehicle-violations': '<svg fill="none" viewBox="0 0 24 24" stroke="#06b6d4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
                'notifications': '<svg fill="none" viewBox="0 0 24 24" stroke="#6366f1"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>',
                'activity': '<svg fill="none" viewBox="0 0 24 24" stroke="#22c55e"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>',
                'maintenance': '<svg fill="none" viewBox="0 0 24 24" stroke="#8b5cf6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
                'drug-alcohol': '<svg fill="none" viewBox="0 0 24 24" stroke="#ec4899"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>',
                'documents': '<svg fill="none" viewBox="0 0 24 24" stroke="#64748b"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>',
                'permit-insurance': '<svg fill="none" viewBox="0 0 24 24" stroke="#10b981"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>',
                'reporting': '<svg fill="none" viewBox="0 0 24 24" stroke="#3b82f6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>',
                'safety': '<svg fill="none" viewBox="0 0 24 24" stroke="#22c55e"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>',
                'hos': '<svg fill="none" viewBox="0 0 24 24" stroke="#f59e0b"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                'settings': '<svg fill="none" viewBox="0 0 24 24" stroke="#8b5cf6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
                'login-signup-tutorial': '<svg fill="none" viewBox="0 0 24 24" stroke="#0ea5e9"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>'
            };

            const SECTION_META = {
                'dashboard': ['Dashboard', 'Overview and statistics walkthrough'],
                'my-loads': ['My Loads', 'Create, assign and track loads through dispatch'],
                'my-trucks': ['My Trucks', 'Add, view and manage your trucks'],
                'my-trailers': ['My Trailers', 'Add, view and manage your trailers'],
                'driver-devices': ['Driver Devices', 'Manage driver devices and ELD connections'],
                'truck-lease-pricing': ['Truck Lease Pricing', 'Review and configure lease pricing'],
                'truck-rentals': ['Truck Rentals', 'Manage truck rentals and equipment'],
                'lease-agreements': ['Lease Agreements', 'Create, sign and track lease agreements'],
                'hire-drivers': ['Hire Drivers', 'Recruit and onboard new drivers'],
                'job-postings': ['Job Postings', 'Create and manage driver job postings'],
                'external-drivers': ['External Drivers', 'Manage external and owner-operator drivers'],
                'shout-out-scripts': ['Shout Out Scripts', 'Ready-made scripts for your marketing'],
                'shout-out-vlogs': ['Shout Out Vlogs', 'Shout out vlog examples and walkthroughs'],
                'accounting': ['Accounting', 'Manage accounting and financial records'],
                'my-payroll': ['My Payroll', 'Run and manage payroll'],
                'my-factoring-company': ['My Factoring Company', 'Connect and manage your factoring company'],
                'fuel-reports': ['Fuel Reports', 'View fuel spending reports and analytics'],
                'my-fuel-cards': ['My Fuel Cards', 'Manage fuel cards and spending limits'],
                'loans-cash-advance': ['Loans/Cash Advance', 'Apply for and track loans and cash advances'],
                'api-integration-keys': ['API Integration Keys', 'Generate and manage API integration keys'],
                'my-fleet': ['My Fleet', 'Monitor your fleet safety and compliance'],
                'emergency-monitoring': ['Emergency Monitoring', 'Set up and respond to emergency alerts'],
                'compliance-monitoring': ['Compliance Monitoring', 'Track compliance metrics in real time'],
                'compliance-software-options': ['Compliance Software Options', 'Explore compliance software integrations'],
                'drug-alcohol-testing': ['Drug & Alcohol Testing', 'Manage drug and alcohol testing programs'],
                'safety-assessments': ['Safety Assessments', 'Run and review safety assessments'],
                'maintenance-monitoring': ['Maintenance Monitoring', 'Monitor maintenance and vehicle health'],
                'my-drivers': ['My Drivers', 'View and manage your drivers'],
                'my-customers': ['My Customers', 'Add, view and manage your customers'],
                'my-shippers-list': ['My Shippers List', 'Manage your list of shippers'],
                'my-consignee-lists': ['My Consignee Lists', 'Manage your consignee lists and locations'],
                'my-brokers': ['My Brokers', 'Add and manage your brokers'],
                'violations': ['Violations', 'Track compliance violations'],
                'safety-violations': ['Safety Violations', 'Safety-related compliance issues'],
                'driver-violations': ['Driver Violations', 'Driver-specific violations'],
                'vehicle-violations': ['Vehicle Violations', 'Vehicle-related violations'],
                'notifications': ['Notifications', 'Real-time alerts and updates'],
                'activity': ['Activity', 'System activity logs'],
                'maintenance': ['Maintenance', 'Vehicle maintenance scheduling'],
                'drug-alcohol': ['Drug & Alcohol', 'Testing programs and records'],
                'documents': ['Documents', 'Centralized document management'],
                'permit-insurance': ['Permit & Insurance', 'Permits, licenses and insurance'],
                'reporting': ['Reporting', 'Reports and operational insights'],
                'safety': ['Safety', 'Safety metrics and risk management'],
                'hos': ['HOS', 'Hours of Service compliance'],
                'settings': ['Settings', 'Configure and customize the system'],
                'login-signup-tutorial': ['Login & Sign Up', 'Account creation and secure login']
            };

            function refreshPage() { location.reload(); }

            // ===== Tour Guide =====
            const TOUR_STEPS = [
                {
                    target: '.brand',
                    title: 'Welcome to DISPATCH!',
                    desc: 'This is your video tutorial library for the DISPATCH Transportation Management System. Let me show you around in 8 quick steps.',
                    action: null
                },
                {
                    target: '#sidebar-search',
                    title: 'Search Tutorials',
                    desc: 'Type here to search through all 45+ tutorial sections. The sidebar filters in real-time as you type. The search assistant also syncs with this bar.',
                    action: null
                },
                {
                    target: '.nav-section-title.main-menu',
                    title: 'Navigation Menu',
                    desc: 'Browse tutorials by category — Operations, Fleet, Finance, Safety, Compliance, and more. Click any item to open that tutorial section.',
                    action: null
                },
                {
                    target: '.icon-btn.tour-btn',
                    title: 'Video Tutorial Library',
                    desc: 'Click this button to open the standalone video tutorial gallery — a grid view of all videos with search, category filters, and a full-screen modal player.',
                    action: null
                },
                {
                    target: '#assistant-fab',
                    title: 'AI Search Assistant',
                    desc: 'Click this floating button to open the search assistant. Ask questions in plain English like "how do I add a driver?" and it will find the right tutorial for you.',
                    action: function() {
                        if (window.innerWidth <= 900) { document.getElementById('sidebar').classList.add('open'); }
                    }
                },
                {
                    target: '.icon-btn.settings-btn-top',
                    title: 'Settings Panel',
                    desc: 'Customize your experience — change the accent color, adjust font size, toggle dark mode, set video playback speed, enable accessibility features, and more.',
                    action: null
                },
                {
                    target: '.icon-btn.theme-btn',
                    title: 'Dark & Light Theme',
                    desc: 'Toggle between dark and light mode. Your preference is saved automatically and persists across page reloads.',
                    action: null
                },
                {
                    target: '.icon-btn.refresh-btn',
                    title: 'You\'re All Set!',
                    desc: 'That\'s the tour! Use the refresh button to reload the page anytime. Explore the sidebar to find all tutorials, or use the search assistant for quick help. Enjoy learning DISPATCH!',
                    action: null
                }
            ];

            let tourCurrentStep = 0;
            let tourActive = false;

            function startTour() {
                tourActive = true;
                tourCurrentStep = 0;
                document.getElementById('tour-overlay').classList.add('active');
                document.querySelector('.icon-btn.tour-btn').classList.add('touring');
                document.body.style.overflow = 'hidden';
                renderTourProgress();
                showTourStep(0);
            }

            function showTourStep(index) {
                if (index < 0 || index >= TOUR_STEPS.length) return;
                tourCurrentStep = index;
                const step = TOUR_STEPS[index];

                // Run action if any
                if (step.action) { try { step.action(); } catch(e) {} }

                // Wait for DOM to settle, then position
                setTimeout(function() {
                    const target = document.querySelector(step.target);
                    const highlight = document.getElementById('tour-highlight');
                    const tooltip = document.getElementById('tour-tooltip');

                    if (!target) {
                        // Fallback: center tooltip
                        highlight.style.display = 'none';
                        tooltip.style.top = '50%';
                        tooltip.style.left = '50%';
                        tooltip.style.transform = 'translate(-50%, -50%)';
                    } else {
                        const rect = target.getBoundingClientRect();
                        const padding = 8;
                        highlight.style.display = 'block';
                        highlight.style.top = (rect.top - padding) + 'px';
                        highlight.style.left = (rect.left - padding) + 'px';
                        highlight.style.width = (rect.width + padding * 2) + 'px';
                        highlight.style.height = (rect.height + padding * 2) + 'px';

                        // Measure actual tooltip dimensions
                        tooltip.style.visibility = 'hidden';
                        tooltip.style.top = '0px';
                        tooltip.style.left = '0px';
                        tooltip.style.transform = 'none';
                        const tw = tooltip.offsetWidth || 340;
                        const th = tooltip.offsetHeight || 220;
                        tooltip.style.visibility = 'visible';

                        const gap = 16;
                        const targetCenterX = rect.left + rect.width / 2;
                        const targetCenterY = rect.top + rect.height / 2;
                        let tooltipTop, tooltipLeft, arrowClass = '';
                        let arrowX = 24, arrowY = 24;

                        // Determine best placement: prefer below, then above, then right, then left
                        const canFitBelow = rect.bottom + th + gap + 20 < window.innerHeight;
                        const canFitAbove = rect.top - th - gap - 20 > 0;
                        const canFitRight = rect.right + tw + gap + 16 < window.innerWidth;
                        const canFitLeft = rect.left - tw - gap - 16 > 0;

                        if (canFitBelow) {
                            // Place tooltip below the target
                            tooltipTop = rect.bottom + gap;
                            tooltipLeft = Math.max(16, Math.min(targetCenterX - tw / 2, window.innerWidth - tw - 16));
                            arrowClass = 'arrow-top';
                            // Arrow points up at the target's center
                            arrowX = Math.max(20, Math.min(targetCenterX - tooltipLeft, tw - 40));
                        } else if (canFitAbove) {
                            // Place tooltip above the target
                            tooltipTop = rect.top - th - gap;
                            tooltipLeft = Math.max(16, Math.min(targetCenterX - tw / 2, window.innerWidth - tw - 16));
                            arrowClass = 'arrow-bottom';
                            // Arrow points down at the target's center
                            arrowX = Math.max(20, Math.min(targetCenterX - tooltipLeft, tw - 40));
                        } else if (canFitRight) {
                            // Place tooltip to the right of the target
                            tooltipTop = Math.max(16, Math.min(targetCenterY - th / 2, window.innerHeight - th - 16));
                            tooltipLeft = rect.right + gap;
                            arrowClass = 'arrow-left';
                            // Arrow points left at the target's center
                            arrowY = Math.max(20, Math.min(targetCenterY - tooltipTop, th - 40));
                        } else if (canFitLeft) {
                            // Place tooltip to the left of the target
                            tooltipTop = Math.max(16, Math.min(targetCenterY - th / 2, window.innerHeight - th - 16));
                            tooltipLeft = rect.left - tw - gap;
                            arrowClass = 'arrow-right';
                            // Arrow points right at the target's center
                            arrowY = Math.max(20, Math.min(targetCenterY - tooltipTop, th - 40));
                        } else {
                            // Fallback: place below with clamped position
                            tooltipTop = Math.max(16, rect.bottom + gap);
                            tooltipLeft = Math.max(16, Math.min(targetCenterX - tw / 2, window.innerWidth - tw - 16));
                            arrowClass = 'arrow-top';
                            arrowX = Math.max(20, Math.min(targetCenterX - tooltipLeft, tw - 40));
                        }

                        tooltip.style.top = tooltipTop + 'px';
                        tooltip.style.left = tooltipLeft + 'px';
                        tooltip.style.transform = 'none';
                        tooltip.className = 'tour-tooltip ' + arrowClass;
                        tooltip.style.setProperty('--arrow-x', arrowX + 'px');
                        tooltip.style.setProperty('--arrow-y', arrowY + 'px');
                    }

                    // Update content
                    document.getElementById('tour-badge-num').textContent = (index + 1);
                    document.getElementById('tour-step-label').textContent = 'Step ' + (index + 1) + ' of ' + TOUR_STEPS.length;
                    document.getElementById('tour-title').textContent = step.title;
                    document.getElementById('tour-desc').textContent = step.desc;

                    // Update buttons
                    document.getElementById('tour-prev').disabled = (index === 0);
                    const nextBtn = document.getElementById('tour-next');
                    nextBtn.textContent = (index === TOUR_STEPS.length - 1) ? 'Finish' : 'Next';

                    // Update progress dots
                    document.querySelectorAll('.tour-dot').forEach(function(dot, i) {
                        dot.classList.remove('done', 'current');
                        if (i < index) dot.classList.add('done');
                        else if (i === index) dot.classList.add('current');
                    });
                }, 100);
            }

            function renderTourProgress() {
                const progress = document.getElementById('tour-progress');
                progress.innerHTML = '';
                for (let i = 0; i < TOUR_STEPS.length; i++) {
                    const dot = document.createElement('div');
                    dot.className = 'tour-dot';
                    progress.appendChild(dot);
                }
            }

            function tourNext() {
                if (tourCurrentStep < TOUR_STEPS.length - 1) {
                    showTourStep(tourCurrentStep + 1);
                } else {
                    endTour();
                }
            }

            function tourPrev() {
                if (tourCurrentStep > 0) { showTourStep(tourCurrentStep - 1); }
            }

            function endTour() {
                tourActive = false;
                document.getElementById('tour-overlay').classList.remove('active');
                document.querySelector('.icon-btn.tour-btn').classList.remove('touring');
                document.body.style.overflow = '';
                try { localStorage.setItem('dispatch-tour-completed', 'true'); } catch(e) {}
            }

            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (!tourActive) return;
                if (e.key === 'Escape') endTour();
                else if (e.key === 'ArrowRight') tourNext();
                else if (e.key === 'ArrowLeft') tourPrev();
            });

            // Reposition on resize
            window.addEventListener('resize', function() {
                if (tourActive) showTourStep(tourCurrentStep);
            });

            // ===== Settings Panel =====
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
                if (opts.swatch) {
                    swatchWrap.innerHTML = '<span class="announce-swatch" style="background:' + opts.swatch + '"></span>';
                } else {
                    swatchWrap.innerHTML = '';
                }
                toast.classList.add('show');
                if (announceTimer) clearTimeout(announceTimer);
                announceTimer = setTimeout(function() { toast.classList.remove('show'); }, 2600);
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

            function toggleSettings() {
                const panel = document.getElementById('settings-panel');
                const overlay = document.getElementById('settings-overlay');
                const isOpen = panel.classList.contains('open');
                panel.classList.toggle('open');
                overlay.classList.toggle('open');
                if (!isOpen) applySettingsToUI();
            }

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
                        updateBackgroundSVG();
                        showAnnouncement(value ? 'Dark mode enabled' : 'Light mode enabled', { icon: 'theme' });
                        break;
                    case 'reduce-motion':
                        document.documentElement.style.setProperty('--motion', value ? '0s' : '0.2s');
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
                        if (window.innerWidth > 900) {
                            const sidebar = document.getElementById('sidebar');
                            const btn = document.getElementById('sidebar-toggle-btn');
                            if (value) {
                                sidebar.classList.add('mini');
                                if (btn) { btn.title = 'Expand sidebar'; btn.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>'; }
                            } else {
                                sidebar.classList.remove('mini');
                                if (btn) { btn.title = 'Collapse sidebar'; btn.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 19l-7-7 7-7M19 19l-7-7 7-7"/>'; }
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
                document.querySelectorAll('video').forEach(function(v) { v.playbackRate = parseFloat(val); });
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
                // Read toggle states
                ['dark-mode','autoplay','sidebar-collapsed','sync-search','reduce-motion','high-contrast','large-text'].forEach(function(key) {
                    const el = document.getElementById('set-' + key);
                    if (el) settings[key] = el.classList.contains('on');
                });
                // Read select values
                ['playback-speed','video-quality'].forEach(function(key) {
                    const el = document.getElementById('set-' + key);
                    if (el) settings[key] = el.value;
                });
                // Read accent color
                const activeSwatch = document.querySelector('#set-accent-colors .color-swatch.active');
                if (activeSwatch) settings['accent-color'] = activeSwatch.dataset.color;
                // Read font size
                const fontSizeEl = document.getElementById('set-font-size');
                if (fontSizeEl) settings['font-size'] = fontSizeEl.value;
                try { localStorage.setItem('dispatch-settings', JSON.stringify(settings)); } catch (e) {}
            }

            function saveSettings() {
                saveSettingsImmediate();
                // Visual feedback
                const btn = event.target;
                const orig = btn.textContent;
                btn.textContent = 'Saved!';
                btn.style.background = '#059669';
                setTimeout(function() { btn.textContent = orig; btn.style.background = ''; }, 1500);
            }

            function resetSettings() {
                try { localStorage.removeItem('dispatch-settings'); } catch (e) {}
                // Reset CSS
                document.documentElement.style.setProperty('--accent', '#10b981');
                document.documentElement.style.setProperty('--accent-soft', 'rgba(16, 185, 129, 0.14)');
                document.documentElement.style.fontSize = '15px';
                document.body.classList.remove('reduce-motion', 'high-contrast');
                document.documentElement.classList.add('dark');
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
                // Apply playback speed to all videos
                document.querySelectorAll('video').forEach(function(v) { v.playbackRate = parseFloat(s['playback-speed']); });
            }

            // ===== Search Assistant =====
            const ASSISTANT_KEYWORDS = {
                'dashboard': ['dashboard', 'overview', 'statistics', 'home', 'main', 'summary', 'stats', 'report'],
                'my-loads': ['load', 'dispatch', 'assign', 'track', 'booking', 'delivery', 'shipment', 'freight'],
                'my-trucks': ['truck', 'vehicle', 'fleet truck', 'add truck', 'manage truck'],
                'my-trailers': ['trailer', 'add trailer', 'manage trailer', 'equipment'],
                'driver-devices': ['device', 'eld', 'mobile', 'phone', 'tablet', 'connection'],
                'truck-lease-pricing': ['lease', 'lease pricing', 'pricing', 'lease price', 'lease cost'],
                'truck-rentals': ['rental', 'rent', 'rent truck', 'short term', 'equipment rental'],
                'lease-agreements': ['agreement', 'contract', 'sign', 'lease agreement'],
                'hire-drivers': ['hire', 'recruit', 'onboard', 'new driver', 'hiring'],
                'job-postings': ['job', 'posting', 'career', 'job board', 'open position'],
                'external-drivers': ['external', 'owner operator', 'contractor', 'independent'],
                'shout-out-scripts': ['script', 'marketing script', 'shout out', 'shoutout'],
                'shout-out-vlogs': ['vlog', 'video blog', 'marketing video', 'shout out vlog'],
                'accounting': ['accounting', 'finance', 'invoice', 'bookkeeping', 'ledger'],
                'my-payroll': ['payroll', 'salary', 'pay', 'wages', 'compensation', 'driver pay'],
                'my-factoring-company': ['factoring', 'factor', 'invoice factoring', 'cash flow'],
                'fuel-reports': ['fuel', 'fuel report', 'fuel spending', 'fuel cost', 'diesel'],
                'my-fuel-cards': ['fuel card', 'card', 'spending limit', 'fuel payment'],
                'loans-cash-advance': ['loan', 'cash advance', 'borrow', 'credit', 'advance'],
                'api-integration-keys': ['api', 'integration', 'key', 'developer', 'webhook', 'integration key'],
                'my-fleet': ['fleet', 'fleet safety', 'fleet compliance', 'fleet management'],
                'emergency-monitoring': ['emergency', 'alert', 'sos', 'crash', 'incident'],
                'compliance-monitoring': ['compliance', 'monitor', 'regulation', 'dot', 'fmcsa'],
                'compliance-software-options': ['software', 'compliance software', 'integration', 'tool'],
                'drug-alcohol-testing': ['drug', 'alcohol', 'test', 'drug test', 'substance', 'dot test'],
                'safety-assessments': ['safety assessment', 'assessment', 'risk', 'safety review', 'evaluation'],
                'maintenance-monitoring': ['maintenance', 'repair', 'vehicle health', 'service', 'upkeep'],
                'my-drivers': ['driver', 'register driver', 'add driver', 'cdl', 'driver profile', 'new driver'],
                'my-customers': ['customer', 'client', 'add customer', 'manage customer'],
                'my-shippers-list': ['shipper', 'shipping', 'ship list'],
                'my-consignee-lists': ['consignee', 'receiver', 'delivery point', 'consignee list'],
                'my-brokers': ['broker', 'freight broker', 'add broker'],
                'violations': ['violation', 'compliance violation', 'infraction'],
                'safety-violations': ['safety violation', 'safety issue', 'safety infraction'],
                'driver-violations': ['driver violation', 'driver infraction', 'driver compliance'],
                'vehicle-violations': ['vehicle violation', 'truck violation', 'vehicle infraction'],
                'notifications': ['notification', 'alert', 'push', 'message', 'reminder'],
                'activity': ['activity', 'log', 'history', 'audit', 'activity log'],
                'maintenance': ['maintenance schedule', 'service schedule', 'pm', 'preventive'],
                'drug-alcohol': ['drug and alcohol', 'drug program', 'testing program', 'drug record'],
                'documents': ['document', 'file', 'upload', 'paperwork', 'doc'],
                'permit-insurance': ['permit', 'insurance', 'license', 'registration', 'certificate'],
                'reporting': ['report', 'reporting', 'analytics', 'insights', 'data'],
                'safety': ['safety', 'risk', 'safety metric', 'safety score', 'csa'],
                'hos': ['hos', 'hours of service', 'drive time', 'logbook', 'eld hours', 'duty status'],
                'settings': ['setting', 'config', 'configuration', 'preference', 'customize', 'account setting'],
                'login-signup-tutorial': ['login', 'sign up', 'signup', 'register', 'account', 'password', 'log in', 'authentication']
            };

            function toggleAssistant() {
                const panel = document.getElementById('assistant-panel');
                const fab = document.getElementById('assistant-fab');
                const isOpen = panel.classList.contains('open');
                panel.classList.toggle('open');
                fab.classList.toggle('active');
                if (!isOpen) {
                    setTimeout(function() { document.getElementById('assistant-input').focus(); }, 200);
                } else {
                    // When closing, reset the assistant and sidebar search
                    const body = document.getElementById('assistant-body');
                    body.innerHTML = '<div class="assistant-msg bot">Hi! I\'m your search assistant. Tell me what you\'re looking for and I\'ll find the right tutorial for you. For example: "how do I add a driver?" or "fuel reports"</div>' +
                        '<div class="assistant-quick" id="assistant-quick">' +
                        '<span class="assistant-chip" onclick="assistantAsk(\'How do I register a new driver?\')">Register a driver</span>' +
                        '<span class="assistant-chip" onclick="assistantAsk(\'How do I manage my fleet?\')">Manage fleet</span>' +
                        '<span class="assistant-chip" onclick="assistantAsk(\'How do I view fuel reports?\')">Fuel reports</span>' +
                        '<span class="assistant-chip" onclick="assistantAsk(\'How do I manage payroll?\')">Payroll</span>' +
                        '<span class="assistant-chip" onclick="assistantAsk(\'How do I track violations?\')">Violations</span>' +
                        '</div>';
                    const sidebarSearch = document.getElementById('sidebar-search');
                    if (sidebarSearch) { sidebarSearch.value = ''; filterMenu(); }
                }
            }

            function assistantAsk(question) {
                document.getElementById('assistant-input').value = question;
                assistantSend();
            }

            function syncAssistantFromSidebar() {
                const settings = loadSettings();
                if (settings['sync-search'] === false) return;
                const sidebarSearch = document.getElementById('sidebar-search');
                const assistantInput = document.getElementById('assistant-input');
                if (sidebarSearch && assistantInput) {
                    assistantInput.value = sidebarSearch.value;
                }
            }

            function assistantSend() {
                const input = document.getElementById('assistant-input');
                const query = input.value.trim();
                if (!query) return;
                const body = document.getElementById('assistant-body');
                const quick = document.getElementById('assistant-quick');

                // Clear all previous history before showing new results
                body.innerHTML = '';
                if (quick) quick.style.display = 'none';

                // Sync the sidebar search and filter the navigation (if sync-search is enabled)
                const settings = loadSettings();
                if (settings['sync-search'] !== false) {
                    const sidebarSearch = document.getElementById('sidebar-search');
                    if (sidebarSearch) {
                        sidebarSearch.value = query;
                        filterMenu();
                    }
                }

                // Show user message
                const userMsg = document.createElement('div');
                userMsg.className = 'assistant-msg user';
                userMsg.textContent = query;
                body.appendChild(userMsg);

                input.value = '';

                // Search for matches
                const results = assistantSearch(query);

                // Show bot response
                const botMsg = document.createElement('div');
                botMsg.className = 'assistant-msg bot';

                if (results.length === 0) {
                    botMsg.innerHTML = "I couldn't find a tutorial matching that. Try different keywords, or browse the sidebar menu for all available sections.";
                } else {
                    botMsg.innerHTML = results.length === 1
                        ? "I found a tutorial that matches:"
                        : "I found " + results.length + " tutorials that match:";
                }
                body.appendChild(botMsg);

                // Show suggestions
                if (results.length > 0) {
                    const sugg = document.createElement('div');
                    sugg.className = 'assistant-suggestions';
                    results.forEach(function(r) {
                        const item = document.createElement('div');
                        item.className = 'assistant-suggestion';
                        item.onclick = function() {
                            showSection(r.id);
                            toggleAssistant();
                        };
                        const icon = SECTION_ICONS[r.id] || '';
                        item.innerHTML = icon +
                            '<div><div class="s-title">' + r.title + '</div>' +
                            '<div class="s-desc">' + r.desc + '</div></div>' +
                            '<span class="s-go">Open &rarr;</span>';
                        sugg.appendChild(item);
                    });
                    body.appendChild(sugg);
                }

                body.scrollTop = body.scrollHeight;
            }

            function assistantSearch(query) {
                const q = query.toLowerCase().trim();
                const words = q.split(/\s+/);
                const results = [];

                Object.keys(ASSISTANT_KEYWORDS).forEach(function(id) {
                    const meta = SECTION_META[id];
                    if (!meta) return;
                    const title = meta[0].toLowerCase();
                    const desc = meta[1].toLowerCase();
                    const keywords = ASSISTANT_KEYWORDS[id];
                    let score = 0;

                    // Exact title match
                    if (title === q) score += 100;

                    // Title contains query
                    if (title.includes(q)) score += 50;

                    // Description contains query
                    if (desc.includes(q)) score += 20;

                    // Keyword matches
                    keywords.forEach(function(kw) {
                        if (q.includes(kw)) score += 30;
                        if (kw.includes(q)) score += 15;
                        // Word-level matches
                        words.forEach(function(w) {
                            if (w.length > 2 && (kw === w || kw.includes(w))) score += 10;
                        });
                    });

                    if (score > 0) results.push({ id: id, title: meta[0], desc: meta[1], score: score });
                });

                results.sort(function(a, b) { return b.score - a.score; });
                return results.slice(0, 5);
            }

            function toggleTheme() {
                document.documentElement.classList.toggle('dark');
                const isDark = document.documentElement.classList.contains('dark');
                try { localStorage.setItem('dispatch-theme', isDark ? 'dark' : 'light'); } catch (e) {}
                // Sync settings panel toggle
                const darkToggle = document.getElementById('set-dark-mode');
                if (darkToggle) darkToggle.classList.toggle('on', isDark);
                saveSettingsImmediate();
                updateBackgroundSVG();
                showAnnouncement(isDark ? 'Dark mode enabled' : 'Light mode enabled', { icon: 'theme' });
            }
            function updateBackgroundSVG() {
                const isDark = document.documentElement.classList.contains('dark');
                const darkSVG = document.getElementById('bg-svg-dark');
                const lightSVG = document.getElementById('bg-svg-light');
                if (darkSVG) darkSVG.style.display = isDark ? 'block' : 'none';
                if (lightSVG) lightSVG.style.display = isDark ? 'none' : 'block';
            }
            (function () {
                try {
                    const saved = localStorage.getItem('dispatch-theme');
                    if (saved === 'light') document.documentElement.classList.remove('dark');
                } catch (e) {}
                updateBackgroundSVG();
            })();

            function toggleSidebar() {
                document.getElementById('sidebar').classList.toggle('open');
                document.getElementById('sidebar-overlay').classList.toggle('show');
            }

            function toggleSidebarMini() {
                const sidebar = document.getElementById('sidebar');
                const btn = document.getElementById('sidebar-toggle-btn');
                const isMini = sidebar.classList.contains('mini');
                if (isMini) {
                    sidebar.classList.remove('mini');
                    btn.title = 'Collapse sidebar';
                    btn.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 19l-7-7 7-7M19 19l-7-7 7-7"/>';
                    try { localStorage.setItem('dispatch-sidebar-mini', 'false'); } catch (e) {}
                } else {
                    sidebar.classList.add('mini');
                    btn.title = 'Expand sidebar';
                    btn.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>';
                    // Close any open submenus
                    document.querySelectorAll('.submenu.expanded, .nav-link.expanded').forEach(function(el) {
                        el.classList.remove('expanded');
                    });
                    try { localStorage.setItem('dispatch-sidebar-mini', 'true'); } catch (e) {}
                }
            }

            // Add tooltips (data-tip) to all nav-links for mini mode
            function initSidebarTooltips() {
                document.querySelectorAll('.nav-link').forEach(function(link) {
                    if (link.classList.contains('has-submenu')) {
                        var span = link.querySelector('span');
                        if (span) {
                            var text = span.textContent.trim();
                            if (text) link.setAttribute('data-tip', text);
                        }
                    } else {
                        var text = link.textContent.trim();
                        if (text) link.setAttribute('data-tip', text);
                    }
                });
            }

            function filterMenu() {
                const term = document.getElementById('sidebar-search').value.toLowerCase().trim();
                document.querySelectorAll('.nav-section-title').forEach(title => {
                    const list = title.nextElementSibling;
                    if (!list || !list.classList.contains('nav-list')) return;
                    const sectionMatch = title.textContent.toLowerCase().includes(term);
                    let visibleCount = 0;

                    list.querySelectorAll(':scope > .nav-item').forEach(item => {
                        const link = item.querySelector('.nav-link');
                        const text = link ? link.textContent.toLowerCase() : '';
                        const submenu = item.querySelector('.submenu');
                        let match = !term || sectionMatch || text.includes(term);
                        if (submenu) {
                            submenu.querySelectorAll('.nav-link').forEach(sub => {
                                if (sub.textContent.toLowerCase().includes(term)) match = true;
                            });
                            if (term && match && !sectionMatch) { submenu.classList.add('expanded'); link.classList.add('expanded'); }
                            else if (!term) { submenu.classList.remove('expanded'); link.classList.remove('expanded'); }
                        }   
                        item.style.display = match ? '' : 'none';
                        if (match) visibleCount++;
                    });

                    title.style.display = visibleCount > 0 ? '' : 'none';
                });
            }

            function showSection(sectionId, el) {
                document.querySelectorAll('.section-content').forEach(s => s.style.display = 'none');
                const target = document.getElementById('section-' + sectionId);
                if (target) target.style.display = 'block';

                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                if (el) el.classList.add('active');

                const meta = SECTION_META[sectionId];
                if (meta) {
                    document.getElementById('page-title').textContent = meta[0];
                    document.getElementById('page-subtitle').textContent = meta[1];
                }

                const icon = SECTION_ICONS[sectionId];
                if (icon) {
                    document.getElementById('ph-icon').innerHTML = icon;
                }

                if (window.innerWidth <= 900) {
                    document.getElementById('sidebar').classList.remove('open');
                    document.getElementById('sidebar-overlay').classList.remove('show');
                }

                // Autoplay if enabled in settings
                const settings = loadSettings();
                if (settings['autoplay'] && target) {
                    const video = target.querySelector('video');
                    if (video) { try { video.play(); } catch (e) {} }
                }
            }

            function toggleSubmenu(submenuId, el, event) {
                event.preventDefault();
                event.stopPropagation();
                // In mini mode, expand the sidebar first instead of opening submenu
                var sidebar = document.getElementById('sidebar');
                if (sidebar.classList.contains('mini')) {
                    toggleSidebarMini();
                    return;
                }
                document.getElementById(submenuId).classList.toggle('expanded');
                el.classList.toggle('expanded');
            }

            // Hide loading screen on full page load
            window.addEventListener('load', function() {
                setTimeout(function() {
                    const loader = document.getElementById('loader-screen');
                    if (loader) loader.classList.add('hidden');
                    setTimeout(function() { if (loader) loader.style.display = 'none'; }, 600);
                }, 800);
            });

            document.addEventListener('DOMContentLoaded', function () {
                initSettingsOnLoad();
                // Initialize sidebar tooltips for mini mode
                initSidebarTooltips();
                // Restore sidebar mini state (desktop only)
                try {
                    if (localStorage.getItem('dispatch-sidebar-mini') === 'true' && window.innerWidth > 900) {
                        var sidebar = document.getElementById('sidebar');
                        var btn = document.getElementById('sidebar-toggle-btn');
                        sidebar.classList.add('mini');
                        btn.title = 'Expand sidebar';
                        btn.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>';
                    }
                } catch (e) {}
                // First-time visitor: auto-open tour after 1.5s
                try {
                    if (localStorage.getItem('dispatch-tour-completed') !== 'true') {
                        setTimeout(function() { startTour(); }, 1500);
                    }
                } catch (e) {}
                document.querySelectorAll('video').forEach(video => {
                    video.addEventListener('error', function () {
                        const frame = video.closest('.video-frame');
                        if (frame && !frame.querySelector('.video-empty')) {
                            const div = document.createElement('div');
                            div.className = 'video-empty';
                            div.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg><span>No video available for this module yet.</span>';
                            video.style.display = 'none';
                            frame.appendChild(div);
                        }
                    });
                });
            });
        </script>
    </body>
    </html>
