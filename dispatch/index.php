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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
            font-family: 'Inter', 'Segoe UI', Tahoma, sans-serif;
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
            position: sticky;
            top: 0;
            z-index: 40;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem 0 1.75rem;
            background: color-mix(in srgb, var(--bg) 70%, transparent);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
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
            border: 1px solid var(--border);
            background: var(--surface);
            color: var(--text);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.18s ease;
        }
        .icon-btn:hover { background: var(--surface-2); border-color: var(--border-strong); transform: translateY(-1px); }
        .icon-btn svg { width: 18px; height: 18px; }
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
        .logout-btn {
            display: inline-flex; align-items: center; gap: 0.45rem;
            padding: 0.55rem 0.95rem;
            border: 1px solid color-mix(in srgb, var(--danger) 35%, transparent);
            background: color-mix(in srgb, var(--danger) 14%, transparent);
            color: var(--danger);
            border-radius: 12px; cursor: pointer;
            font-size: 0.82rem; font-weight: 600;
            transition: all 0.18s ease;
        }
        .logout-btn:hover { background: color-mix(in srgb, var(--danger) 22%, transparent); }
        .logout-btn svg { width: 16px; height: 16px; }

        /* ===== Layout ===== */
        .layout { display: flex; }
        .sidebar {
            position: sticky;
            top: 68px;
            align-self: flex-start;
            width: 288px;
            height: calc(100vh - 68px);
            overflow-y: auto;
            padding: 1.25rem 0.85rem 2rem;
            border-right: 1px solid var(--border);
            background: color-mix(in srgb, var(--surface-solid) 55%, transparent);
            backdrop-filter: blur(8px);
        }
        .search-wrap { position: relative; padding: 0 0.4rem 0.5rem; }
        .search-wrap svg { position: absolute; left: 1rem; top: 50%; transform: translateY(-60%); width: 16px; height: 16px; color: var(--text-dim); }
        .search-wrap input {
            width: 100%;
            padding: 0.7rem 0.9rem 0.7rem 2.4rem;
            background: var(--surface);
            border: 1px solid var(--border);
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
            font-size: 0.68rem; font-weight: 700; letter-spacing: 0.09em;
            text-transform: uppercase; color: var(--text-dim);
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
        .nav-link:hover { background: var(--surface-2); color: var(--text); }
        .nav-link.active {
            background: var(--accent-soft);
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

        .video-card {
            background: color-mix(in srgb, var(--surface-solid) 70%, transparent);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1rem;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .video-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 48px -20px rgba(0, 0, 0, 0.7);
        }
        .video-frame {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            background: #05070c;
            border: 1px solid var(--border);
            aspect-ratio: 16 / 9;
        }
        .video-frame video { width: 100%; height: 100%; display: block; object-fit: cover; }
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

        @media (max-width: 900px) {
            .menu-toggle { display: flex; }
            .sidebar {
                position: fixed; top: 68px; left: 0; z-index: 50;
                transform: translateX(-100%); transition: transform 0.25s ease;
                width: 280px;
                background: var(--surface-solid);
            }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay.show { display: block; position: fixed; inset: 68px 0 0 0; background: rgba(0,0,0,0.5); z-index: 45; }
            .user-chip .u-info, .logout-btn span { display: none; }
            .brand-text p { display: none; }
        }
        @media (max-width: 560px) {
            .live-pill { display: none; }
        }
    </style>
</head>
<body>
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
            <button class="icon-btn" onclick="refreshPage()" title="Refresh">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            </button>
            <button class="icon-btn" onclick="toggleTheme()" title="Toggle theme" id="theme-btn">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
            </button>
            <button class="logout-btn" onclick="logout()" title="Logout">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                <span>Logout</span>
            </button>
        </div>
    </header>

    <div class="sidebar-overlay" id="sidebar-overlay" onclick="toggleSidebar()"></div>

    <div class="layout">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="search-wrap">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" id="sidebar-search" placeholder="Search tutorials..." onkeyup="filterMenu()">
            </div>

            <div class="nav-section-title">Main Menu</div>
            <ul class="nav-list">
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('login-signup-tutorial', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                        Login &amp; Sign Up
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" onclick="showSection('dashboard', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                </li>
            </ul>

            <div class="nav-section-title">Operations &amp; Dispatch</div>
            <ul class="nav-list">
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('my-loads', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        My Loads
                    </a>
                </li>
            </ul>

            <div class="nav-section-title">Fleet Management</div>
            <ul class="nav-list">
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('my-trucks', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1"/></svg>
                        My Trucks
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('my-trailers', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 18a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6a1 1 0 011-1h14a1 1 0 011 1v10a1 1 0 01-1 1h-1m-4 0H9m-2 0H4a1 1 0 01-1-1V6z"/></svg>
                        My Trailers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('driver-devices', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a1 1 0 001-1V4a1 1 0 00-1-1H8a1 1 0 00-1 1v16a1 1 0 001 1z"/></svg>
                        Driver Devices
                    </a>
                </li>
            </ul>

            <div class="nav-section-title">Lease Management</div>
            <ul class="nav-list">
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('truck-lease-pricing', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m3-1h9a2 2 0 002-2v-6a2 2 0 00-2-2h-9a2 2 0 00-2 2v6a2 2 0 002 2zm7-3a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Truck Lease Pricing
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('truck-rentals', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1"/></svg>
                        Truck Rentals
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('lease-agreements', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Lease Agreements
                    </a>
                </li>
            </ul>

            <div class="nav-section-title">Recruitment</div>
            <ul class="nav-list">
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('hire-drivers', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        Hire Drivers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('job-postings', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Job Postings
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('external-drivers', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        External Drivers
                    </a>
                </li>
            </ul>

            <div class="nav-section-title">Marketing</div>
            <ul class="nav-list">
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('shout-out-scripts', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Shout Out Scripts
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('shout-out-vlogs', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Shout Out Vlogs
                    </a>
                </li>
            </ul>

            <div class="nav-section-title">Financial</div>
            <ul class="nav-list">
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('accounting', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m-6 4h6m-6 4h4M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/></svg>
                        Accounting
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('my-payroll', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m-3 4h.01M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 15h6"/></svg>
                        My Payroll
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('my-factoring-company', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        My Factoring Company
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('fuel-reports', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Fuel Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('my-fuel-cards', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        My Fuel Cards
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('loans-cash-advance', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3L2 9h20L12 3zM4 9v8m4-8v8m8-8v8m4-8v8M2 21h20M3 17h18"/></svg>
                        Loans/Cash Advance
                    </a>
                </li>
            </ul>

            <div class="nav-section-title">Safety and Compliance</div>
            <ul class="nav-list">
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('api-integration-keys', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                        API Integration Keys
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('my-fleet', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/></svg>
                        My Fleet
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('emergency-monitoring', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v18M3 12h18M5.6 5.6l12.8 12.8M18.4 5.6L5.6 18.4"/></svg>
                        Emergency Monitoring
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('compliance-monitoring', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h4l3 8 4-16 3 8h4"/></svg>
                        Compliance Monitoring
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('compliance-software-options', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        Compliance Software Options
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('drug-alcohol-testing', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                        Drug &amp; Alcohol Testing
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('safety-assessments', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        Safety Assessments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('maintenance-monitoring', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                        Maintenance Monitoring
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('my-drivers', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        My Drivers
                    </a>
                </li>
            </ul>

            <div class="nav-section-title">Customer Relations</div>
            <ul class="nav-list">
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('my-customers', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        My Customers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('my-shippers-list', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1"/></svg>
                        My Shippers List
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('my-consignee-lists', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        My Consignee Lists
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('my-brokers', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        My Brokers
                    </a>
                </li>
            </ul>

            <div class="nav-section-title">System</div>
            <ul class="nav-list">
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('notifications', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        Notifications
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('activity', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        Activity
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('maintenance', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Maintenance
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('documents', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Documents
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('reporting', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Reporting
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showSection('settings', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Settings
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Content -->
        <main class="content">
            <div id="page-head" class="page-head">
                <div class="ph-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <h2 id="page-title">Dashboard</h2>
                    <p id="page-subtitle">Overview and statistics walkthrough</p>
                </div>
            </div>

            <div id="section-dashboard" class="section-content">
                <div class="video-card">
                    <div class="video-frame">
                        <video controls playsinline><source src="Videos/dashboard.mp4" type="video/mp4"></video>
                    </div>
                    <p class="video-desc">Learn how to navigate the dashboard, monitor compliance, access reports, and use the available system features.</p>
                    <div class="video-meta"><span class="chip">Beginner</span><span class="chip">Getting Started</span></div>
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
                <div class="video-card">
                    <div class="video-frame"><video controls playsinline><source src="videos/my-drivers.mp4" type="video/mp4"></video></div>
                    <p class="video-desc">View and manage your drivers' compliance records.</p>
                    <div class="video-meta"><span class="chip">Safety &amp; Compliance</span></div>
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
            <div id="section-login-signup-tutorial" class="section-content" style="display:none;">
                <div class="video-card">
                    <div class="video-frame"><video controls playsinline><source src="videos/login.mp4" type="video/mp4"></video></div>
                    <p class="video-desc">Learn how to create an account and securely log in to the system.</p>
                    <div class="video-meta"><span class="chip">Getting Started</span></div>
                </div>
            </div>
        </main>
    </div>

    <script>
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

        function toggleTheme() {
            document.documentElement.classList.toggle('dark');
            try { localStorage.setItem('dispatch-theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light'); } catch (e) {}
        }
        (function () {
            try {
                const saved = localStorage.getItem('dispatch-theme');
                if (saved === 'light') document.documentElement.classList.remove('dark');
            } catch (e) {}
        })();

        function logout() {
            if (confirm('Are you sure you want to logout?')) window.location.href = 'logout.php';
        }

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('show');
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
            if (window.innerWidth <= 900) {
                document.getElementById('sidebar').classList.remove('open');
                document.getElementById('sidebar-overlay').classList.remove('show');
            }
        }

        function toggleSubmenu(submenuId, el, event) {
            event.preventDefault();
            event.stopPropagation();
            document.getElementById(submenuId).classList.toggle('expanded');
            el.classList.toggle('expanded');
        }

        document.addEventListener('DOMContentLoaded', function () {
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
