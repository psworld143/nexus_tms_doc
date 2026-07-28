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
            position: sticky; top: 0; z-index: 100;
            display: flex; align-items: center; gap: 1rem;
            padding: 0.85rem 2rem;
            background: color-mix(in srgb, var(--surface-solid) 80%, transparent);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
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
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--surface);
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
            display: flex; align-items: center; gap: 0.5rem;
            padding: 0.5rem 0.85rem;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--surface);
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.18s ease;
        }
        .back-btn:hover { color: var(--accent); border-color: var(--accent); background: var(--accent-soft); }
        .back-btn svg { width: 16px; height: 16px; }

        /* ===== Main Content ===== */
        .main { max-width: 1200px; margin: 0 auto; padding: 2rem; }

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
            border: 1px solid var(--border);
            border-radius: 14px;
            background: var(--surface-solid);
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
            padding: 0.45rem 1rem;
            border: 1px solid var(--border);
            border-radius: 999px;
            background: var(--surface);
            color: var(--text-muted);
            font-size: 0.82rem;
            font-weight: 500;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .filter-chip:hover { border-color: var(--border-strong); color: var(--text); }
        .filter-chip.active {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }

        /* ===== Video Grid ===== */
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.25rem;
        }
        .video-card {
            background: var(--surface-solid);
            border: 1px solid var(--border);
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
            box-shadow: 0 16px 32px -12px rgba(0, 0, 0, 0.4), 0 0 0 1px var(--accent-soft);
        }
        .video-thumb {
            position: relative;
            aspect-ratio: 16 / 9;
            background: #000;
            overflow: hidden;
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
            background: var(--surface-solid);
            border: 1px solid var(--border);
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
            border-top: 1px solid var(--border);
            margin-top: 2rem;
        }

        @media (max-width: 600px) {
            .header { padding: 0.75rem 1rem; }
            .main { padding: 1rem; }
            .hero h2 { font-size: 1.5rem; }
            .video-grid { grid-template-columns: 1fr; }
            .hero-stats { gap: 1.25rem; }
        }
    </style>
</head>
<body>
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
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Full Tutorial
            </a>
            <button class="icon-btn theme-btn" onclick="toggleTheme()" title="Toggle theme" id="theme-btn">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
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

        <!-- Category Filters -->
        <div class="filters" id="filters">
            <button class="filter-chip active" onclick="setFilter('all', this)">All</button>
            <button class="filter-chip" onclick="setFilter('Main', this)">Main</button>
            <button class="filter-chip" onclick="setFilter('Operations', this)">Operations</button>
            <button class="filter-chip" onclick="setFilter('Fleet', this)">Fleet</button>
            <button class="filter-chip" onclick="setFilter('Finance', this)">Finance</button>
            <button class="filter-chip" onclick="setFilter('Safety', this)">Safety</button>
            <button class="filter-chip" onclick="setFilter('Compliance', this)">Compliance</button>
            <button class="filter-chip" onclick="setFilter('Account', this)">Account</button>
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
                <button class="modal-close" onclick="closeModal()" aria-label="Close">&times;</button>
            </div>
            <div class="modal-video-frame">
                <video id="modal-video" controls autoplay playsinline></video>
            </div>
        </div>
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

        function isAvailable(src) { return AVAILABLE_VIDEOS.indexOf(src) !== -1; }

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
                const card = document.createElement('div');
                card.className = 'video-card';
                card.onclick = function() { openModal(v); };

                const thumb = available
                    ? '<video muted preload="metadata"><source src="' + v.src + '" type="video/mp4"></video>'
                    : '<div class="video-empty"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg><span>Coming Soon</span></div>';

                card.innerHTML =
                    '<div class="video-thumb">' +
                        '<span class="category-badge">' + v.category + '</span>' +
                        thumb +
                        '<div class="play-overlay"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>' +
                        (available ? '<span class="duration-badge">' + v.duration + '</span>' : '') +
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
            const overlay = document.getElementById('modal-overlay');
            const video = document.getElementById('modal-video');
            document.getElementById('modal-title').textContent = v.title;
            document.getElementById('modal-desc').textContent = v.desc;
            if (isAvailable(v.src)) {
                video.innerHTML = '<source src="' + v.src + '" type="video/mp4">';
                video.style.display = 'block';
                video.load();
                video.play().catch(function() {});
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
        });

        function toggleTheme() {
            document.documentElement.classList.toggle('dark');
            try { localStorage.setItem('dispatch-theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light'); } catch (e) {}
        }

        // Restore theme
        try {
            if (localStorage.getItem('dispatch-theme') === 'light') {
                document.documentElement.classList.remove('dark');
            }
        } catch (e) {}

        // Update stats and render
        function updateStats() {
            document.getElementById('stat-total').textContent = VIDEOS.length;
            document.getElementById('stat-available').textContent = AVAILABLE_VIDEOS.length;
            const cats = {};
            VIDEOS.forEach(function(v) { cats[v.category] = true; });
            document.getElementById('stat-categories').textContent = Object.keys(cats).length;
        }

        updateStats();
        renderVideos();
    </script>
</body>
</html>
