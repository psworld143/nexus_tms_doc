<?php
// DISPATCH Video Documentation — read the purpose of every feature

// Security headers
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('X-XSS-Protection: 1; mode=block');
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src https://fonts.gstatic.com; media-src 'self'; img-src 'self' data:; connect-src 'self';");

// Full video catalog + long-form documentation text live in doc_data.php
// so they can be shared with index.php (inline fullscreen doc modal).
require __DIR__ . '/doc_data.php';

$totalVideos = count($videoCatalog);

// Determine which videos actually have source files
function getAvailableVideos($dir = 'videos') {
    $available = [];
    if (!is_dir($dir)) return $available;
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        if (pathinfo($file, PATHINFO_EXTENSION) === 'mp4') {
            $available[] = $dir . '/' . $file;
        }
    }
    return $available;
}

$availableVideos = getAvailableVideos();

// Group by category for display
$grouped = [];
foreach ($videoCatalog as $video) {
    $grouped[$video['category']][] = $video;
}

$site = 'DISPATCH';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="favicon.svg?v=2">
    <link rel="shortcut icon" href="favicon.svg?v=2">
    <title><?php echo $site; ?> Video Documentation</title>
    <script>
        // Apply saved theme BEFORE body renders to prevent loading screen flash
        (function(){try{var t=localStorage.getItem('dispatch-theme');if(t==='light'){document.documentElement.classList.add('light');}else{document.documentElement.classList.remove('light');}}catch(e){}})();
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/video-card-animations.css">
    <link rel="stylesheet" href="css/dispatch-ui.css">
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
        /* Theme button */
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
        /* Custom tooltips for header icons */
        .theme-btn[title] { position: relative; }
        .theme-btn[title]::after {
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
            z-index: 300;
        }
        .theme-btn[title]:hover::after {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
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
        }
        html.light body {
            background:
                radial-gradient(ellipse at 10% 10%, color-mix(in srgb, var(--accent-2) 18%, transparent), transparent 50%),
                radial-gradient(ellipse at 90% 20%, color-mix(in srgb, var(--accent) 12%, transparent), transparent 50%),
                radial-gradient(ellipse at 50% 100%, color-mix(in srgb, var(--accent) 10%, transparent), transparent 45%),
                linear-gradient(160deg, #f8fafc 0%, #ffffff 55%, #f1f5f9 100%);
        }
        .page { max-width: 1200px; margin: 0 auto; padding: 1.5rem; padding-top: 5rem; }
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
            transition: transform 0.18s cubic-bezier(0.4, 0, 0.2, 1),
                        box-shadow 0.18s ease,
                        filter 0.18s ease;
        }
        .brand a:hover .brand-icon {
            transform: translateY(-2px) scale(1.05);
            filter: brightness(1.06);
            box-shadow: 0 10px 24px -8px color-mix(in srgb, var(--accent) 80%, transparent),
                        inset 0 1px 0 rgba(255,255,255,0.22);
        }
        .brand-icon:active { transform: translateY(0) scale(0.98); }
        .brand-icon svg { width: 20px; height: 20px; }
        .brand-text { display: flex; flex-direction: column; line-height: 1.15; }
        .brand-text h1 { font-size: 1.15rem; font-weight: 800; letter-spacing: -0.01em; line-height: 1.1; }
        .brand-text p { font-size: 0.72rem; color: var(--text-dim); font-weight: 500; }
        .topbar-actions { margin-left: auto; display: flex; align-items: center; gap: 0.6rem; }

        /* Loading screen styles moved to css/loaders.css */
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
            transition: border-color 0.25s ease, color 0.25s ease, background 0.25s ease, box-shadow 0.25s ease, transform 0.25s ease;
        }
        .back-home-btn svg {
            width: 18px; height: 18px; flex-shrink: 0;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .back-home-btn:hover {
            border-color: #ef4444;
            background: color-mix(in srgb, #ef4444 15%, transparent);
            color: #ef4444;
            box-shadow: 0 0 14px -4px color-mix(in srgb, #ef4444 50%, transparent);
            transform: rotate(90deg);
        }
        .back-home-btn:active { transform: scale(0.92); }
        /* Shortcut icons — green */
        .theme-btn.shortcut-btn {
            color: var(--accent);
            border-color: color-mix(in srgb, var(--accent) 35%, transparent);
            background: color-mix(in srgb, var(--accent) 10%, transparent);
        }
        .theme-btn.shortcut-btn:hover {
            background: linear-gradient(135deg, color-mix(in srgb, var(--accent) 22%, transparent), color-mix(in srgb, var(--accent) 18%, transparent));
            border-color: color-mix(in srgb, var(--accent) 70%, transparent);
            box-shadow: 0 0 16px color-mix(in srgb, var(--accent) 45%, transparent);
            transform: translateY(-2px) scale(1.05);
            color: #fff;
        }
        .hero {
            position: relative; overflow: hidden;
            border: 1px solid var(--border);
            border-radius: var(--radius); padding: 3.5rem 2rem;
            margin-bottom: 2rem; text-align: center;
            backdrop-filter: blur(16px); box-shadow: var(--shadow);
            background:
                radial-gradient(ellipse 600px 300px at 20% 0%, color-mix(in srgb, var(--accent) 18%, transparent), transparent 70%),
                radial-gradient(ellipse 500px 250px at 85% 100%, color-mix(in srgb, var(--accent-2) 12%, transparent), transparent 70%),
                radial-gradient(ellipse 400px 200px at 50% 50%, color-mix(in srgb, var(--accent) 6%, transparent), transparent 60%),
                var(--surface);
        }
        /* Animated grid overlay */
        .hero::before {
            content: ''; position: absolute; inset: 0;
            background-image:
                linear-gradient(color-mix(in srgb, var(--accent) 8%, transparent) 1px, transparent 1px),
                linear-gradient(90deg, color-mix(in srgb, var(--accent) 8%, transparent) 1px, transparent 1px);
            background-size: 40px 40px;
            mask-image: radial-gradient(ellipse 80% 70% at 50% 50%, black 30%, transparent 80%);
            -webkit-mask-image: radial-gradient(ellipse 80% 70% at 50% 50%, black 30%, transparent 80%);
            animation: hero-grid-drift 20s linear infinite;
            pointer-events: none;
        }
        @keyframes hero-grid-drift {
            0%   { background-position: 0 0, 0 0; }
            100% { background-position: 40px 40px, 40px 40px; }
        }
        /* Glowing orb */
        .hero::after {
            content: ''; position: absolute;
            top: -60px; right: -40px;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: radial-gradient(circle, color-mix(in srgb, var(--accent) 30%, transparent), transparent 70%);
            filter: blur(30px);
            animation: hero-orb-float 8s ease-in-out infinite;
            pointer-events: none;
        }
        @keyframes hero-orb-float {
            0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.6; }
            50%      { transform: translate(-20px, 30px) scale(1.15); opacity: 0.9; }
        }
        .hero > * { position: relative; z-index: 1; }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.3rem 0.85rem; border-radius: 999px;
            font-size: 0.72rem; font-weight: 600; letter-spacing: 0.04em;
            text-transform: uppercase;
            color: var(--accent); background: color-mix(in srgb, var(--accent) 12%, transparent);
            border: 1px solid color-mix(in srgb, var(--accent) 25%, transparent);
            margin-bottom: 1.2rem;
            animation: hero-badge-in 0.6s cubic-bezier(0.22, 1, 0.36, 1) 0.1s both;
        }
        .hero-badge svg { width: 14px; height: 14px; }
        @keyframes hero-badge-in {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .hero h1 {
            font-size: 2.4rem; font-weight: 800; margin-bottom: 0.6rem;
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, var(--text) 0%, color-mix(in srgb, var(--accent-2) 70%, var(--text)) 100%);
            -webkit-background-clip: text; background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: hero-title-in 0.6s cubic-bezier(0.22, 1, 0.36, 1) 0.2s both;
        }
        @keyframes hero-title-in {
            from { opacity: 0; transform: translateY(15px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .hero p {
            color: var(--text-muted); max-width: 600px; margin: 0 auto;
            font-size: 0.95rem; line-height: 1.6;
            animation: hero-desc-in 0.6s cubic-bezier(0.22, 1, 0.36, 1) 0.3s both;
        }
        @keyframes hero-desc-in {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        /* Floating accent dots */
        .hero-dots {
            position: absolute; inset: 0; pointer-events: none; z-index: 0;
        }
        .hero-dot {
            position: absolute; width: 4px; height: 4px;
            border-radius: 50%; background: var(--accent);
            opacity: 0; animation: hero-dot-float 6s ease-in-out infinite;
        }
        .hero-dot:nth-child(1) { top: 20%; left: 15%; animation-delay: 0s; }
        .hero-dot:nth-child(2) { top: 70%; left: 80%; animation-delay: 1s; }
        .hero-dot:nth-child(3) { top: 40%; left: 90%; animation-delay: 2s; }
        .hero-dot:nth-child(4) { top: 80%; left: 10%; animation-delay: 3s; }
        .hero-dot:nth-child(5) { top: 15%; left: 70%; animation-delay: 1.5s; }
        @keyframes hero-dot-float {
            0%, 100% { opacity: 0; transform: translateY(0) scale(0.5); }
            50%      { opacity: 0.5; transform: translateY(-15px) scale(1); }
        }
        .controls {
            display: flex; gap: 1rem; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap;
        }
        .search {
            flex: 1; min-width: 240px; display: flex; align-items: center; gap: 0.6rem;
            background: var(--surface); border: 1px solid var(--border); border-radius: 12px; padding: 0.65rem 0.9rem;
        }
        .search input { flex: 1; border: none; outline: none; background: transparent; color: var(--text); font-family: inherit; font-size: 0.9rem; }
        .search input::placeholder { color: var(--text-dim); }
        .count { font-size: 0.85rem; color: var(--text-dim); margin-left: auto; }
        .category-block { margin-bottom: 2rem; }
        .category-title { font-size: 1.1rem; font-weight: 700; color: var(--accent); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem; }
        .docs-grid {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.25rem;
        }
        .doc-card {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: 18px; padding: 1.5rem; display: flex; flex-direction: column;
            position: relative; overflow: hidden; cursor: pointer;
        }
        .doc-card h3 { font-size: 1.05rem; font-weight: 700; margin-bottom: 0.5rem; }
        .doc-card p { font-size: 0.88rem; color: var(--text-muted); line-height: 1.55; margin-bottom: 1.2rem; flex: 1; }
        .doc-meta { display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; }
        .doc-meta span { font-size: 0.72rem; }
        .status-badge { padding: 0.18rem 0.55rem; border-radius: 6px; font-weight: 700; text-transform: uppercase; }
        .status-badge.available { background: var(--accent-soft); color: var(--accent); }
        .status-badge.coming { background: rgba(248, 113, 113, 0.14); color: var(--danger); }
        .duration { color: var(--text-dim); }
        .doc-actions { display: flex; gap: 0.5rem; margin-top: 1rem; }
        .status-filter { display: flex; gap: 0.4rem; flex-wrap: wrap; }
        .status-filter button {
            font-family: inherit; padding: 0.45rem 0.85rem; border-radius: 999px;
            border: 1px solid var(--border); background: var(--surface-2);
            color: var(--text-muted); font-size: 0.78rem; font-weight: 600;
            cursor: pointer; transition: transform 0.18s cubic-bezier(0.4, 0, 0.2, 1), border-color 0.18s ease, background 0.18s ease, color 0.18s ease;
        }
        .status-filter button:hover { transform: translateY(-3px); border-color: var(--border-strong); color: var(--text); }
        .status-filter button:active { transform: translateY(0) scale(0.97); }
        .status-filter button.active { background: var(--accent); color: #fff; border-color: var(--border-strong); transform: translateY(-3px); }
        .doc-actions a {
            padding: 0.45rem 0.9rem; border-radius: 10px; font-size: 0.8rem; font-weight: 600;
            text-decoration: none; transition: all 0.15s ease; border: 1px solid transparent;
        }
        .doc-actions a.watch { background: var(--accent); color: #fff; }
        .empty { text-align: center; padding: 3rem 1rem; color: var(--text-dim); display: none; }
        .empty.show { display: block; }
        footer { text-align: center; padding: 2rem 0; color: var(--text-dim); font-size: 0.8rem; border-top: 1px solid var(--border); margin-top: 2rem; }

        /* ===== UI/UX Enhancements ===== */
        /* Scroll reveal */
        .doc-card { opacity: 0; transform: translateY(20px); transition: opacity 0.5s ease, transform 0.5s cubic-bezier(0.22, 1, 0.36, 1), border-color 0.22s ease, box-shadow 0.22s ease; }
        .doc-card.revealed { opacity: 1; transform: translateY(0); }
        .doc-card:hover {
            border-color: color-mix(in srgb, var(--accent) 35%, transparent);
            box-shadow: 0 12px 32px -12px color-mix(in srgb, var(--accent) 25%, transparent), 0 0 0 1px color-mix(in srgb, var(--accent) 15%, transparent);
            transform: translateY(-4px);
        }
        .doc-card:focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 2px;
        }
        .doc-card.highlight-flash {
            animation: card-flash 1.2s ease;
        }
        @keyframes card-flash {
            0%, 100% { box-shadow: 0 0 0 0 transparent; }
            30% { box-shadow: 0 0 0 4px color-mix(in srgb, var(--accent) 40%, transparent), 0 0 30px color-mix(in srgb, var(--accent) 30%, transparent); }
        }

        /* Search highlight */
        .search-mark { background: color-mix(in srgb, var(--accent) 25%, transparent); color: var(--accent); border-radius: 3px; padding: 0 2px; font-weight: 600; }
        .search-clear {
            display: none; width: 22px; height: 22px; border-radius: 50%;
            border: none; background: var(--surface-2); color: var(--text-muted);
            cursor: pointer; place-items: center; flex-shrink: 0;
            transition: all 0.18s ease;
        }
        .search-clear.show { display: grid; }
        .search-clear:hover { background: var(--danger); color: #fff; transform: scale(1.1); }
        .search-clear svg { width: 12px; height: 12px; }
        .search.has-text { border-color: color-mix(in srgb, var(--accent) 30%, transparent); }

        /* Category collapse */
        .category-title { cursor: pointer; user-select: none; transition: color 0.18s ease; }
        .category-title:hover { color: var(--accent-2); }
        .category-title .cat-chevron {
            margin-left: auto; transition: transform 0.3s cubic-bezier(0.22, 1, 0.36, 1);
            width: 20px; height: 20px; color: var(--text-dim);
        }
        .category-block.collapsed .cat-chevron { transform: rotate(-90deg); }
        .category-block.collapsed .docs-grid {
            max-height: 0; overflow: hidden; opacity: 0; margin-top: 0;
            transition: max-height 0.3s ease, opacity 0.2s ease;
        }
        .docs-grid { transition: max-height 0.3s ease, opacity 0.2s ease; }

        /* Back-to-top */
        .back-to-top {
            position: fixed; bottom: 1.5rem; right: 1.5rem; z-index: 100;
            width: 44px; height: 44px; border-radius: 50%;
            border: 1px solid var(--border-strong); background: var(--surface-solid);
            color: var(--text); cursor: pointer; place-items: center;
            box-shadow: 0 8px 24px -8px rgba(0,0,0,0.4);
            opacity: 0; transform: translateY(20px) scale(0.8); pointer-events: none;
            transition: all 0.3s cubic-bezier(0.22, 1, 0.36, 1);
            display: grid;
        }
        .back-to-top.show { opacity: 1; transform: translateY(0) scale(1); pointer-events: auto; }
        .back-to-top:hover {
            background: var(--accent); color: #fff; border-color: var(--accent);
            transform: translateY(-2px) scale(1.08);
            box-shadow: 0 12px 28px -8px color-mix(in srgb, var(--accent) 50%, transparent);
        }
        .back-to-top svg { width: 20px; height: 20px; }

        /* Count badge animation */
        .count { transition: color 0.2s ease; }
        .count.pulse { animation: count-pulse 0.3s ease; }
        @keyframes count-pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); color: var(--accent); }
            100% { transform: scale(1); }
        }

        /* Filter pill indicator */
        .status-filter { position: relative; }
        .status-filter::after {
            content: ''; position: absolute; bottom: -2px; left: 0;
            height: 2px; background: var(--accent); border-radius: 2px;
            transition: all 0.3s cubic-bezier(0.22, 1, 0.36, 1);
            width: 0; opacity: 0;
        }

        @media (max-width: 640px) {
            .docs-grid { grid-template-columns: 1fr; }
            .hero { padding: 2.5rem 1.5rem; }
            .hero h1 { font-size: 1.6rem; }
            .hero::after { width: 120px; height: 120px; }
            .topbar { padding: 0.7rem 1rem; }
            .page { padding: 1rem; padding-top: 4.5rem; }
            .brand-text h1 { font-size: 1rem; }
            .brand-text p { font-size: 0.65rem; }
        }

        /* Documentation full-screen modal */
        .doc-modal-overlay {
            position: fixed; inset: 0; z-index: 500;
            display: none;
        }
        .doc-modal-overlay.open { display: block; }
        .doc-modal {
            position: fixed; inset: 0;
            background:
                radial-gradient(ellipse at 15% 10%, color-mix(in srgb, var(--accent-2) 18%, transparent), transparent 50%),
                radial-gradient(ellipse at 90% 90%, color-mix(in srgb, var(--accent) 14%, transparent), transparent 50%),
                linear-gradient(160deg, var(--bg) 0%, var(--bg-2) 60%, var(--bg) 100%);
            display: flex; flex-direction: column;
            color: var(--text);
        }
        html.light .doc-modal {
            background:
                radial-gradient(ellipse at 15% 10%, color-mix(in srgb, var(--accent-2) 12%, transparent), transparent 50%),
                radial-gradient(ellipse at 90% 90%, color-mix(in srgb, var(--accent) 10%, transparent), transparent 50%),
                linear-gradient(160deg, #f8fafc 0%, #ffffff 60%, #f1f5f9 100%);
        }
        .doc-modal-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border);
            background: color-mix(in srgb, var(--surface-solid) 70%, transparent);
            backdrop-filter: blur(16px);
            position: sticky; top: 0; z-index: 2;
            gap: 1rem;
        }
        .dmh-brand { font-weight: 800; font-size: 1.1rem; display: flex; align-items: center; gap: 0.5rem; color: var(--accent); }
        .dmh-brand-icon {
            width: 28px; height: 28px; border-radius: 8px;
            display: grid; place-items: center; color: #fff;
            border: 1px solid color-mix(in srgb, var(--accent) 60%, transparent);
            background: linear-gradient(135deg, var(--accent), color-mix(in srgb, var(--accent) 70%, #0ea371));
            box-shadow: 0 4px 12px -4px color-mix(in srgb, var(--accent) 70%, transparent),
                        inset 0 1px 0 rgba(255,255,255,0.18);
            flex-shrink: 0;
        }
        .dmh-brand-icon svg { width: 16px; height: 16px; }
        .dmh-actions { display: flex; align-items: center; gap: 0.75rem; }

        /* Watch tutorial — enhanced primary action */
        .dmh-watch {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.55rem 1.15rem;
            border-radius: 12px;
            font-size: 0.82rem; font-weight: 700; letter-spacing: 0.01em;
            text-decoration: none; cursor: pointer;
            font-family: inherit;
            color: #fff;
            border: 1px solid color-mix(in srgb, var(--accent) 60%, transparent);
            background: linear-gradient(135deg, var(--accent), color-mix(in srgb, var(--accent) 70%, #0ea371));
            box-shadow: 0 6px 18px -8px color-mix(in srgb, var(--accent) 70%, transparent),
                        inset 0 1px 0 rgba(255,255,255,0.18);
            transition: transform 0.18s cubic-bezier(0.4, 0, 0.2, 1),
                        box-shadow 0.18s ease,
                        filter 0.18s ease;
        }
        .dmh-watch:hover { transform: translateY(-2px) scale(1.03); filter: brightness(1.06); box-shadow: 0 10px 24px -8px color-mix(in srgb, var(--accent) 80%, transparent), inset 0 1px 0 rgba(255,255,255,0.22); }
        .dmh-watch:active { transform: translateY(0) scale(0.98); }
        .dmh-watch svg { width: 15px; height: 15px; flex-shrink: 0; }
        .dmh-watch[hidden] { display: none; }

        /* Generic secondary action (kept for backwards compat) */
        .dmh-btn {
            padding: 0.5rem 1rem; border-radius: 10px; font-size: 0.8rem; font-weight: 600;
            text-decoration: none; border: 1px solid var(--border-strong); cursor: pointer;
            color: var(--text); background: var(--surface-2); transition: all 0.15s ease;
            font-family: inherit;
        }
        .dmh-btn.primary { background: var(--accent); color: #fff; border-color: var(--border-strong); }
        .dmh-btn:hover { border-color: var(--border-strong); }

        /* Close (X) button — copied from tutorials.php .back-home-btn */
        .dmh-close {
            display: grid; place-items: center;
            width: 38px; height: 38px;
            border: 1px solid color-mix(in srgb, #ef4444 40%, transparent);
            border-radius: 50%;
            background: color-mix(in srgb, #ef4444 8%, transparent);
            color: #ef4444;
            text-decoration: none;
            font-family: inherit;
            cursor: pointer;
            transition: border-color 0.25s ease, color 0.25s ease, background 0.25s ease, box-shadow 0.25s ease, transform 0.25s ease;
        }
        .dmh-close svg {
            width: 18px; height: 18px; flex-shrink: 0;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .dmh-close:hover {
            border-color: #ef4444;
            background: color-mix(in srgb, #ef4444 15%, transparent);
            color: #ef4444;
            box-shadow: 0 0 14px -4px color-mix(in srgb, #ef4444 50%, transparent);
            transform: rotate(90deg);
        }
        .dmh-close:active { transform: scale(0.92); }
        @media (max-width: 640px) {
            .dmh-watch { padding: 0.5rem 0.9rem; font-size: 0.78rem; }
            .dmh-close { width: 34px; height: 34px; }
        }
        .doc-modal-body {
            flex: 1; overflow-y: auto;
            padding: 3rem 1.5rem;
        }
        .doc-modal-article {
            max-width: 720px; margin: 0 auto; width: 100%;
        }
        .doc-modal h2 { font-size: 2.4rem; font-weight: 800; margin: 0 0 0.75rem; line-height: 1.1; }
        .doc-modal .dm-category { color: var(--accent); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 0.5rem; }
        .doc-modal p { font-size: 1.15rem; color: var(--text-muted); line-height: 1.8; margin: 1.5rem 0; }
        .doc-modal .dm-meta { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem; flex-wrap: wrap; }

        /* Rich documentation content inside modal */
        .doc-rich-content h3 { font-size: 1.2rem; font-weight: 700; margin: 1.5rem 0 0.5rem; color: var(--text); }
        .doc-rich-content h3:first-child { margin-top: 0; }
        .doc-rich-content p { font-size: 1rem; line-height: 1.75; margin-bottom: 0.85rem; color: var(--text); opacity: 0.9; }
        .doc-rich-content ul, .doc-rich-content ol { margin: 0.5rem 0 1.25rem 1.5rem; }
        .doc-rich-content li { font-size: 1rem; line-height: 1.75; margin-bottom: 0.5rem; color: var(--text); opacity: 0.9; }
        .doc-rich-content strong { color: var(--text); font-weight: 700; }
        .doc-rich-content code { background: var(--surface-2); padding: 2px 7px; border-radius: 5px; font-size: 0.88rem; font-family: 'Courier New', monospace; color: var(--accent); }
        .doc-rich-content blockquote {
            border-left: 3px solid var(--accent);
            padding: 0.85rem 1.1rem;
            margin: 1.25rem 0;
            background: var(--surface);
            border-radius: 0 10px 10px 0;
            font-size: 0.95rem;
            line-height: 1.7;
            color: var(--text);
        }
        .doc-rich-content blockquote strong { color: var(--accent); }

        /* Suggested Videos inside doc modal */
        .dm-suggest { max-width: 720px; margin: 2rem auto 0; width: 100%; }
        .dm-suggest-head {
            display: flex; align-items: center; gap: 0.5rem;
            font-size: 1rem; font-weight: 700; color: var(--text);
            margin-bottom: 1rem; padding-bottom: 0.6rem;
            border-bottom: 1px solid var(--border);
        }
        .dm-suggest-head svg { width: 20px; height: 20px; color: var(--accent); }
        .dm-suggest-grid {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 0.75rem;
        }
        .dm-suggest-card {
            display: flex; align-items: center; gap: 0.7rem;
            padding: 0.7rem 0.85rem;
            border: 1px solid var(--border); border-radius: 12px;
            text-decoration: none; color: inherit;
            cursor: pointer;
            transition: border-color 0.18s ease, transform 0.18s ease, box-shadow 0.18s ease;
        }
        .dm-suggest-card:hover {
            border-color: var(--border-strong);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px -8px rgba(0, 0, 0, 0.35);
        }
        .dm-suggest-card.disabled { cursor: default; pointer-events: none; }
        .dm-suggest-card.disabled .dm-suggest-thumb { opacity: 0.5; }
        .dm-suggest-card.disabled .dm-suggest-info h5,
        .dm-suggest-card.disabled .dm-suggest-info p { color: var(--text); }
        .dm-suggest-thumb {
            width: 38px; height: 38px; border-radius: 9px;
            background: color-mix(in srgb, var(--accent) 15%, transparent);
            display: grid; place-items: center; flex-shrink: 0;
        }
        .dm-suggest-thumb svg { width: 17px; height: 17px; color: var(--accent); }
        .dm-suggest-info { flex: 1; min-width: 0; }
        .dm-suggest-info h5 { font-size: 0.82rem; font-weight: 700; margin: 0 0 0.15rem; color: var(--text); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .dm-suggest-info p { font-size: 0.7rem; font-weight: 500; color: var(--text-muted); margin: 0; line-height: 1.3; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .dm-suggest-badge {
            font-size: 0.62rem; font-weight: 600; padding: 0.15rem 0.45rem;
            border-radius: 5px; flex-shrink: 0;
        }
        .dm-suggest-badge.available { background: rgba(16,185,129,0.15); color: #10b981; }
        .dm-suggest-badge.coming { background: rgba(245,158,11,0.15); color: #f59e0b; }
        .dm-suggest-empty { text-align: center; color: var(--text-muted); font-size: 0.85rem; padding: 1.5rem; }
        @media (max-width: 640px) {
            .doc-modal h2 { font-size: 1.6rem; }
            .doc-modal-body { padding: 2rem 1.25rem; }
            .doc-modal-header { padding: 0.85rem 1.25rem; }
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
            border-color: var(--border-strong);
            background-color: var(--accent-soft);
        }
        .setting-select:focus {
            border-color: var(--border-strong);
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
    </style>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="css/tailwind-config.js"></script>
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
        <div class="topbar">
            <div class="brand">
                <a href="index.php">
                    <span class="brand-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </span>
                    <span class="brand-text"><h1>DISPATCH</h1><p>Video Docs</p></span>
                </a>
            </div>
            <div class="topbar-actions">
                <a href="tutorials.php" class="theme-btn shortcut-btn" title="Video Tutorials" style="text-decoration:none;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
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

        <div class="hero">
            <div class="hero-dots">
                <span class="hero-dot"></span>
                <span class="hero-dot"></span>
                <span class="hero-dot"></span>
                <span class="hero-dot"></span>
                <span class="hero-dot"></span>
            </div>
            <h1>Video Documentation</h1>
            <p>Read in-depth documentation for every DISPATCH feature and module. Use the search to quickly find a feature.</p>
        </div>

        <div class="controls">
            <div class="search" id="search-wrap">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
                <input type="text" id="filter" placeholder="Filter features…" aria-label="Filter features">
                <button class="search-clear" id="search-clear" type="button" aria-label="Clear search">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="status-filter" id="status-filter" role="group" aria-label="Filter by availability">
                <button type="button" class="active" data-filter="all">All</button>
                <button type="button" data-filter="available">Available</button>
                <button type="button" data-filter="coming">Coming Soon</button>
            </div>
            <div class="count" id="count"><?php echo $totalVideos; ?> features</div>
        </div>

        <?php foreach ($grouped as $category => $videos): ?>
        <div class="category-block" data-category="<?php echo htmlspecialchars($category); ?>">
            <div class="category-title" tabindex="0" role="button" aria-expanded="true">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 4H5m0 4h14M5 7h14"/></svg>
                <?php echo htmlspecialchars($category); ?>
                <span class="duration">(<?php echo count($videos); ?>)</span>
                <svg class="cat-chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 9l-7 7-7-7"/></svg>
            </div>
            <div class="docs-grid">
                <?php foreach ($videos as $v):
                    $rawDoc = isset($videoDocs[$v['id']]) ? $videoDocs[$v['id']] : $v['desc'];
                    $docText = strip_tags($rawDoc);
                    if (strlen($docText) > 150) { $docText = substr($docText, 0, 150) . '...'; }
                    $isAvailable = in_array($v['src'], $availableVideos);
                    $statusClass = $isAvailable ? 'available' : 'coming';
                    $statusText = $isAvailable ? 'Available' : 'Coming Soon';
                ?>
                <div class="doc-card" id="doc-<?php echo htmlspecialchars($v['id']); ?>" tabindex="0" role="button" aria-label="<?php echo htmlspecialchars($v['title']); ?> documentation" data-title="<?php echo htmlspecialchars(strtolower($v['title'] . ' ' . $docText)); ?>" data-status="<?php echo $statusClass; ?>" data-category="<?php echo htmlspecialchars($category); ?>" data-doc-html="<?php echo htmlspecialchars($rawDoc); ?>">
                    <h3><?php echo htmlspecialchars($v['title']); ?></h3>
                    <p><?php echo htmlspecialchars($docText); ?></p>
                    <div class="doc-meta">
                        <span class="status-badge <?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                        <?php if (!empty($v['duration'])): ?>
                        <span class="duration"><?php echo htmlspecialchars($v['duration']); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="doc-actions">
                        <?php if ($isAvailable): ?>
                        <a class="watch" href="tutorials.php#<?php echo htmlspecialchars($v['id']); ?>">Watch tutorial</a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>

        <div class="empty" id="empty">No features match your search.</div>

        <footer>
            <p>&copy; DISPATCH Training Portal.</p>
        </footer>
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

    <div class="doc-modal-overlay" id="doc-modal-overlay">
        <div class="doc-modal" role="dialog" aria-modal="true" aria-label="Documentation view">
            <div class="doc-modal-header">
                <div class="dmh-brand"><span class="dmh-brand-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg></span> DISPATCH Video Docs</div>
                <div class="dmh-actions">
                    <a class="dmh-watch" href="#" id="doc-modal-watch" target="_blank" rel="noopener">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Watch tutorial
                    </a>
                    <button class="dmh-close" id="doc-modal-close" type="button" aria-label="Close documentation">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
            <div class="doc-modal-body" id="doc-modal-body"></div>
        </div>
    </div>

    <button class="back-to-top" id="back-to-top" type="button" aria-label="Back to top" title="Back to top">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 10l7-7 7 7M12 3v18"/></svg>
    </button>

    <script>
        // Video catalog data (generated by PHP, consumed by video-docs-modal.js)
        window.ALL_VIDEOS = <?php echo json_encode(array_map(function($v) use ($availableVideos) {
            return [
                'id' => $v['id'],
                'title' => $v['title'],
                'desc' => $v['desc'],
                'category' => $v['category'],
                'duration' => $v['duration'],
                'available' => in_array($v['src'], $availableVideos)
            ];
        }, $videoCatalog)); ?>;
    </script>
    <script src="js/video-docs-settings.js?v=1"></script>
    <script src="js/video-docs-modal.js?v=2"></script>
    <script src="js/video-docs-ui.js?v=1"></script>
</body>
</html>
