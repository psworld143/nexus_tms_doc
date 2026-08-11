<?php
// DISPATCH Documentation — System guide
// Uses the same UI/UX design language as tutorials.php and index.php

// Security headers
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('X-XSS-Protection: 1; mode=block');
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src https://fonts.gstatic.com; media-src 'self'; img-src 'self' data:; connect-src 'self';");

// Full video catalog for documentation
$videoCatalog = [
    ['id' => 'dashboard', 'title' => 'Dashboard', 'desc' => 'Overview and statistics walkthrough', 'category' => 'Main', 'duration' => '2:30', 'src' => 'videos/dashboard.mp4'],
    ['id' => 'my-loads', 'title' => 'My Loads', 'desc' => 'Create, assign and track loads through dispatch', 'category' => 'Operations', 'duration' => '—', 'src' => 'videos/my-loads.mp4'],
    ['id' => 'my-trucks', 'title' => 'My Trucks', 'desc' => 'Add, view and manage your trucks', 'category' => 'Operations', 'duration' => '—', 'src' => 'videos/my-trucks.mp4'],
    ['id' => 'my-trailers', 'title' => 'My Trailers', 'desc' => 'Add, view and manage your trailers', 'category' => 'Operations', 'duration' => '—', 'src' => 'videos/my-trailers.mp4'],
    ['id' => 'driver-devices', 'title' => 'Driver Devices', 'desc' => 'Manage driver devices and ELD connections', 'category' => 'Operations', 'duration' => '—', 'src' => 'videos/driver-devices.mp4'],
    ['id' => 'my-drivers', 'title' => 'My Drivers', 'desc' => 'View and manage your drivers', 'category' => 'Operations', 'duration' => '3:45', 'src' => 'videos/how-to-register-new-drivers.mp4'],
    ['id' => 'my-customers', 'title' => 'My Customers', 'desc' => 'Add, view and manage your customers', 'category' => 'Operations', 'duration' => '—', 'src' => 'videos/my-customers.mp4'],
    ['id' => 'my-shippers-list', 'title' => 'My Shippers List', 'desc' => 'Manage your list of shippers', 'category' => 'Operations', 'duration' => '—', 'src' => 'videos/my-shippers-list.mp4'],
    ['id' => 'my-consignee-lists', 'title' => 'My Consignee Lists', 'desc' => 'Manage your consignee lists and locations', 'category' => 'Operations', 'duration' => '—', 'src' => 'videos/my-consignee-lists.mp4'],
    ['id' => 'my-brokers', 'title' => 'My Brokers', 'desc' => 'Add and manage your brokers', 'category' => 'Operations', 'duration' => '—', 'src' => 'videos/my-brokers.mp4'],
    ['id' => 'truck-lease-pricing', 'title' => 'Truck Lease Pricing', 'desc' => 'Review and configure lease pricing', 'category' => 'Fleet', 'duration' => '—', 'src' => 'videos/truck-lease-pricing.mp4'],
    ['id' => 'truck-rentals', 'title' => 'Truck Rentals', 'desc' => 'Manage truck rentals and equipment', 'category' => 'Fleet', 'duration' => '—', 'src' => 'videos/truck-rentals.mp4'],
    ['id' => 'lease-agreements', 'title' => 'Lease Agreements', 'desc' => 'Create, sign and track lease agreements', 'category' => 'Fleet', 'duration' => '—', 'src' => 'videos/lease-agreements.mp4'],
    ['id' => 'hire-drivers', 'title' => 'Hire Drivers', 'desc' => 'Recruit and onboard new drivers', 'category' => 'Fleet', 'duration' => '—', 'src' => 'videos/hire-drivers.mp4'],
    ['id' => 'job-postings', 'title' => 'Job Postings', 'desc' => 'Create and manage driver job postings', 'category' => 'Fleet', 'duration' => '—', 'src' => 'videos/job-postings.mp4'],
    ['id' => 'external-drivers', 'title' => 'External Drivers', 'desc' => 'Manage external and owner-operator drivers', 'category' => 'Fleet', 'duration' => '—', 'src' => 'videos/external-drivers.mp4'],
    ['id' => 'shout-out-scripts', 'title' => 'Shout Out Scripts', 'desc' => 'Ready-made scripts for your marketing', 'category' => 'Fleet', 'duration' => '—', 'src' => 'videos/shout-out-scripts.mp4'],
    ['id' => 'shout-out-vlogs', 'title' => 'Shout Out Vlogs', 'desc' => 'Shout out vlog examples and walkthroughs', 'category' => 'Fleet', 'duration' => '—', 'src' => 'videos/shout-out-vlogs.mp4'],
    ['id' => 'accounting', 'title' => 'Accounting', 'desc' => 'Manage accounting and financial records', 'category' => 'Finance', 'duration' => '—', 'src' => 'videos/accounting.mp4'],
    ['id' => 'my-payroll', 'title' => 'My Payroll', 'desc' => 'Run and manage payroll', 'category' => 'Finance', 'duration' => '—', 'src' => 'videos/my-payroll.mp4'],
    ['id' => 'my-factoring-company', 'title' => 'My Factoring Company', 'desc' => 'Connect and manage your factoring company', 'category' => 'Finance', 'duration' => '—', 'src' => 'videos/my-factoring-company.mp4'],
    ['id' => 'fuel-reports', 'title' => 'Fuel Reports', 'desc' => 'View fuel spending reports and analytics', 'category' => 'Finance', 'duration' => '—', 'src' => 'videos/fuel-reports.mp4'],
    ['id' => 'my-fuel-cards', 'title' => 'My Fuel Cards', 'desc' => 'Manage fuel cards and spending limits', 'category' => 'Finance', 'duration' => '—', 'src' => 'videos/my-fuel-cards.mp4'],
    ['id' => 'loans-cash-advance', 'title' => 'Loans/Cash Advance', 'desc' => 'Apply for and track loans and cash advances', 'category' => 'Finance', 'duration' => '—', 'src' => 'videos/loans-cash-advance.mp4'],
    ['id' => 'api-integration-keys', 'title' => 'API Integration Keys', 'desc' => 'Generate and manage API integration keys', 'category' => 'Finance', 'duration' => '—', 'src' => 'videos/api-integration-keys.mp4'],
    ['id' => 'my-fleet', 'title' => 'My Fleet', 'desc' => 'Monitor your fleet safety and compliance', 'category' => 'Safety', 'duration' => '—', 'src' => 'videos/my-fleet.mp4'],
    ['id' => 'emergency-monitoring', 'title' => 'Emergency Monitoring', 'desc' => 'Set up and respond to emergency alerts', 'category' => 'Safety', 'duration' => '—', 'src' => 'videos/emergency-monitoring.mp4'],
    ['id' => 'safety-assessments', 'title' => 'Safety Assessments', 'desc' => 'Run and review safety assessments', 'category' => 'Safety', 'duration' => '—', 'src' => 'videos/safety-assessments.mp4'],
    ['id' => 'maintenance-monitoring', 'title' => 'Maintenance Monitoring', 'desc' => 'Monitor maintenance and vehicle health', 'category' => 'Safety', 'duration' => '—', 'src' => 'videos/maintenance-monitoring.mp4'],
    ['id' => 'safety-violations', 'title' => 'Safety Violations', 'desc' => 'Safety-related compliance issues', 'category' => 'Safety', 'duration' => '—', 'src' => 'videos/safety-violations.mp4'],
    ['id' => 'compliance-monitoring', 'title' => 'Compliance Monitoring', 'desc' => 'Track compliance metrics in real time', 'category' => 'Compliance', 'duration' => '—', 'src' => 'videos/compliance-monitoring.mp4'],
    ['id' => 'compliance-software-options', 'title' => 'Compliance Software Options', 'desc' => 'Explore compliance software integrations', 'category' => 'Compliance', 'duration' => '—', 'src' => 'videos/compliance-software-options.mp4'],
    ['id' => 'drug-alcohol-testing', 'title' => 'Drug & Alcohol Testing', 'desc' => 'Manage drug and alcohol testing programs', 'category' => 'Compliance', 'duration' => '—', 'src' => 'videos/drug-alcohol-testing.mp4'],
    ['id' => 'violations', 'title' => 'Violations', 'desc' => 'Track compliance violations', 'category' => 'Compliance', 'duration' => '—', 'src' => 'videos/violations.mp4'],
    ['id' => 'driver-violations', 'title' => 'Driver Violations', 'desc' => 'Driver-specific violations', 'category' => 'Compliance', 'duration' => '—', 'src' => 'videos/driver-violations.mp4'],
    ['id' => 'vehicle-violations', 'title' => 'Vehicle Violations', 'desc' => 'Vehicle-related violations', 'category' => 'Compliance', 'duration' => '—', 'src' => 'videos/vehicle-violations.mp4'],
    ['id' => 'hos', 'title' => 'HOS', 'desc' => 'Hours of Service compliance', 'category' => 'Compliance', 'duration' => '—', 'src' => 'videos/hos.mp4'],
    ['id' => 'notifications', 'title' => 'Notifications', 'desc' => 'Real-time alerts and updates', 'category' => 'Account', 'duration' => '—', 'src' => 'videos/notifications.mp4'],
    ['id' => 'activity', 'title' => 'Activity', 'desc' => 'System activity logs', 'category' => 'Account', 'duration' => '—', 'src' => 'videos/activity.mp4'],
    ['id' => 'maintenance', 'title' => 'Maintenance', 'desc' => 'Vehicle maintenance scheduling', 'category' => 'Account', 'duration' => '—', 'src' => 'videos/maintenance.mp4'],
    ['id' => 'documents', 'title' => 'Documents', 'desc' => 'Centralized document management', 'category' => 'Account', 'duration' => '—', 'src' => 'videos/documents.mp4'],
    ['id' => 'permit-insurance', 'title' => 'Permit & Insurance', 'desc' => 'Permits, licenses and insurance', 'category' => 'Account', 'duration' => '—', 'src' => 'videos/permit-insurance.mp4'],
    ['id' => 'reporting', 'title' => 'Reporting', 'desc' => 'Reports and operational insights', 'category' => 'Account', 'duration' => '—', 'src' => 'videos/reporting.mp4'],
    ['id' => 'settings', 'title' => 'Settings', 'desc' => 'Configure and customize the system', 'category' => 'Account', 'duration' => '—', 'src' => 'videos/settings.mp4'],
    ['id' => 'login-signup-tutorial', 'title' => 'Login & Sign Up', 'desc' => 'Account creation and secure login', 'category' => 'Account', 'duration' => '—', 'src' => 'videos/login-signup-tutorial.mp4']
];
$availableVideos = ['videos/dashboard.mp4', 'videos/how-to-register-new-drivers.mp4'];
$totalVideos = count($videoCatalog);
$totalAvailable = count($availableVideos);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <title>DISPATCH · Documentation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
            --header-h: 64px;
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
            line-height: 1.6;
            overflow-x: hidden;
            position: relative;
        }
        html.light body {
            background:
                radial-gradient(ellipse at 10% 10%, color-mix(in srgb, var(--accent-2) 18%, transparent), transparent 50%),
                radial-gradient(ellipse at 90% 20%, color-mix(in srgb, var(--accent) 12%, transparent), transparent 50%),
                radial-gradient(ellipse at 50% 100%, color-mix(in srgb, var(--accent) 10%, transparent), transparent 45%),
                linear-gradient(160deg, #f8fafc 0%, #ffffff 55%, #f1f5f9 100%);
        }

        a { color: inherit; }
        :focus-visible { outline: 2px solid var(--accent); outline-offset: 2px; border-radius: 6px; }

        .skip-link {
            position: fixed; top: -60px; left: 1rem; z-index: 1000;
            background: var(--accent); color: #fff; padding: 0.6rem 1rem;
            border-radius: 8px; font-size: 0.85rem; font-weight: 600; text-decoration: none;
            transition: top 0.2s ease;
        }
        .skip-link:focus { top: 1rem; }

        /* Loading screen */
        /* ===== Loading Screen ===== */
        .loader-screen {
            position: fixed; inset: 0; z-index: 9999;
            display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 1.25rem;
            background: linear-gradient(160deg, var(--bg) 0%, var(--bg-2) 55%, var(--bg) 100%);
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }
        html.light .loader-screen {
            background: linear-gradient(160deg, #f8fafc 0%, #ffffff 55%, #f1f5f9 100%);
        }
        .loader-screen.hidden { opacity: 0; visibility: hidden; pointer-events: none; }
        .loader-logo {
            width: 56px; height: 56px; border-radius: 14px;
            display: grid; place-items: center;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            color: #fff;
            box-shadow: 0 6px 20px -6px color-mix(in srgb, var(--accent) 60%, transparent);
            animation: loader-logo-pulse 1.6s ease-in-out infinite;
        }
        @keyframes loader-logo-pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(0.92); opacity: 0.7; }
        }
        .loader-logo svg { width: 28px; height: 28px; }
        .loader-text {
            font-size: 0.9rem; font-weight: 700; letter-spacing: 0.2em;
            color: var(--text); text-transform: uppercase;
        }
        .loader-bar {
            width: 180px; height: 3px; border-radius: 999px;
            background: var(--border); overflow: hidden;
        }
        .loader-bar-fill {
            height: 100%; width: 40%; border-radius: 999px;
            background: linear-gradient(90deg, var(--accent), var(--accent-2));
            animation: loader-slide 1.2s ease-in-out infinite;
        }
        @keyframes loader-slide {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(250%); }
        }

        /* Reading progress */
        .progress-bar {
            position: fixed; top: 0; left: 0; height: 3px; width: 0%;
            background: linear-gradient(90deg, var(--accent), var(--accent-2));
            z-index: 300; transition: width 0.1s ease;
        }

        /* Header */
        .header {
            position: sticky;
            top: 0;
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            height: var(--header-h);
            padding: 0 1.5rem;
            background: color-mix(in srgb, var(--bg) 70%, transparent);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .brand {
            display: flex; align-items: center; gap: 0.75rem;
            text-decoration: none; color: inherit; flex-shrink: 0;
        }
        .brand-mark {
            width: 42px; height: 42px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            display: grid; place-items: center;
            color: #fff;
            box-shadow: 0 6px 16px -8px color-mix(in srgb, var(--accent) 60%, transparent);
            flex-shrink: 0;
            transition: transform 0.2s ease;
        }
        .brand-mark svg { width: 20px; height: 20px; }
        .brand-text { display: flex; flex-direction: column; line-height: 1.15; }
        .brand-text h1 { font-size: 1.15rem; font-weight: 800; letter-spacing: 0.01em; }
        .brand-text p { font-size: 0.72rem; color: var(--text-dim); font-weight: 500; margin-top: -0.15rem; }

        .header-search {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            max-width: min(420px, calc(100% - 260px));
            display: flex; align-items: center; gap: 0.5rem;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 0.5rem 0.75rem;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .header-search:hover { border-color: var(--border-strong); color: var(--text); }
        .header-search svg { width: 17px; height: 17px; flex-shrink: 0; }
        .header-search span { font-size: 0.85rem; flex: 1; text-align: left; }
        .kbd {
            font-size: 0.7rem; font-weight: 600; color: var(--text-dim);
            border: 1px solid var(--border-strong); border-radius: 5px;
            padding: 0.1rem 0.4rem; font-family: inherit; flex-shrink: 0;
        }

        .header-actions { display: flex; gap: 0.5rem; flex-shrink: 0; }
        .icon-btn {
            width: 38px; height: 38px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: var(--surface);
            color: var(--text);
            cursor: pointer;
            display: grid; place-items: center;
            transition: all 0.2s ease;
        }
        .icon-btn:hover { background: var(--surface-2); border-color: var(--border-strong); transform: translateY(-2px); }
        .icon-btn:focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 2px;
        }
        .icon-btn:active { transform: translateY(0) scale(0.96); }
        .icon-btn svg { width: 20px; height: 20px; }
        .icon-btn.theme-btn,
        .icon-btn.settings-btn-top {
            color: var(--accent);
            border-color: var(--border-strong);
            background: color-mix(in srgb, var(--accent) 10%, transparent);
        }
        .icon-btn.theme-btn:hover,
        .icon-btn.settings-btn-top:hover {
            background: linear-gradient(135deg, color-mix(in srgb, var(--accent) 22%, transparent), color-mix(in srgb, var(--accent) 18%, transparent));
            border-color: var(--border-strong);
            box-shadow: 0 0 16px color-mix(in srgb, var(--accent) 45%, transparent);
            transform: translateY(-2px) scale(1.05);
            color: #fff;
        }
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
        .back-home-btn[title] { position: relative; }
        .back-home-btn[title]::after {
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
        .back-home-btn[title]:hover::after {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
        @media (prefers-reduced-motion: reduce) {
            .icon-btn, .icon-btn:hover { transition: none; transform: none; }
            .icon-btn:active { transform: none; }
        }
        .menu-btn { display: none; }

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
        .icon-btn.shortcut-btn {
            color: var(--accent);
            border-color: color-mix(in srgb, var(--accent) 35%, transparent);
            background: color-mix(in srgb, var(--accent) 10%, transparent);
        }
        .icon-btn.shortcut-btn:hover {
            background: linear-gradient(135deg, color-mix(in srgb, var(--accent) 22%, transparent), color-mix(in srgb, var(--accent) 18%, transparent));
            border-color: color-mix(in srgb, var(--accent) 70%, transparent);
            box-shadow: 0 0 16px color-mix(in srgb, var(--accent) 45%, transparent);
            transform: translateY(-2px) scale(1.05);
            color: #fff;
        }

        /* Layout */
        .layout {
            padding: 0 1.5rem 0 0;
            display: grid;
            grid-template-columns: 288px minmax(0, 1fr);
            gap: 2.5rem;
            align-items: start;
        }

        /* Sidebar — matching index.php navigation */
        .sidebar {
            position: sticky;
            top: var(--header-h);
            align-self: start;
            width: 288px;
            height: calc(100vh - var(--header-h));
            overflow-y: auto;
            overflow-x: visible;
            padding: 1.25rem 0.85rem 2rem;
            border-right: 1px solid color-mix(in srgb, var(--border) 50%, transparent);
            background: color-mix(in srgb, var(--surface-solid) 60%, transparent);
            backdrop-filter: blur(16px) saturate(150%);
            -webkit-backdrop-filter: blur(16px) saturate(150%);
            z-index: 10;
            scrollbar-width: thin;
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
        .search-wrap input:focus { border-color: var(--border-strong); box-shadow: 0 0 0 3px var(--accent-soft); }

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
            border-bottom: 2px solid var(--border-strong);
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
            text-decoration: none;
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
            content: ''; position: absolute; left: -0.85rem; top: 20%; bottom: 20%;
            width: 3px; border-radius: 999px; background: var(--accent);
        }

        /* Mini sidebar (collapsed) */
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
            border-bottom: 2px solid var(--border-strong);
            justify-content: center;
        }
        .sidebar.mini .nav-section-title.main-menu svg { width: 18px; height: 18px; }
        .sidebar.mini .nav-section-title.main-menu svg { width: 18px; height: 18px; }
        .sidebar.mini .nav-link {
            justify-content: center;
            padding: 0.62rem 0;
            font-size: 0;
            gap: 0;
        }
        .sidebar.mini .nav-link svg { width: 20px; height: 20px; }
        .sidebar.mini .nav-link.active::before { left: 0; }
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

        /* Collapse button */
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
        .sidebar-hide-btn svg {
            width: 16px;
            height: 16px;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .sidebar-overlay { display: none; }

        /* Content column */
        .content { padding: 2rem 0 4rem; min-width: 0; }

        /* Hero */
        .doc-hero {
            padding: 2rem 2.25rem;
            background: color-mix(in srgb, var(--surface-solid) 60%, transparent);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border);
            border-radius: 24px;
            margin-bottom: 2.5rem;
            box-shadow: 0 24px 50px -20px rgba(0,0,0,0.4);
        }
        .doc-hero h2 {
            font-size: 2.25rem;
            font-weight: 800;
            margin-bottom: 0.75rem;
            background: linear-gradient(135deg, var(--text), var(--text-muted));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .doc-hero p { color: var(--text-muted); max-width: 620px; font-size: 1rem; line-height: 1.6; }
        .hero-stats { display: flex; gap: 1.5rem; margin-top: 1.5rem; flex-wrap: wrap; }
        .hero-stat { display: flex; flex-direction: column; }
        .hero-stat strong { font-size: 1.4rem; font-weight: 800; color: var(--accent); }
        .hero-stat span { font-size: 0.78rem; color: var(--text-dim); font-weight: 500; }

        /* Cards */
        .doc-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.25rem;
            margin-bottom: 3rem;
        }
        .doc-card {
            background: color-mix(in srgb, var(--surface-solid) 55%, transparent);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 1.75rem;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
            text-decoration: none;
            color: inherit;
            display: block;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        .doc-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, var(--accent), transparent);
            opacity: 0;
            transition: opacity 0.25s ease;
        }
        .doc-card:hover {
            border-color: var(--border-strong);
            transform: translateY(-5px) scale(1.01);
            box-shadow: 0 24px 40px -20px rgba(0,0,0,0.45);
        }
        .doc-card:hover::before { opacity: 1; }
        .doc-card svg {
            width: 38px; height: 38px;
            color: var(--accent);
            margin-bottom: 1.1rem;
        }
        .doc-card h3 { font-size: 1.1rem; font-weight: 700; margin-bottom: 0.55rem; }
        .doc-card p { font-size: 0.88rem; color: var(--text-muted); line-height: 1.5; }

        /* Sections */
        .doc-section {
            background: color-mix(in srgb, var(--surface-solid) 55%, transparent);
            border: 1px solid var(--border);
            border-top: 2px solid var(--border-strong);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 1.75rem;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            scroll-margin-top: calc(var(--header-h) + 1.25rem);
            box-shadow: 0 16px 35px -20px rgba(0,0,0,0.35);
            transition: border-color 0.2s ease;
        }
        .doc-section:hover { border-color: var(--border-strong); }
        .doc-section h3 {
            font-size: 1.4rem;
            font-weight: 800;
            margin-bottom: 1.25rem;
            display: flex; align-items: center; gap: 0.75rem;
            color: var(--text);
        }
        .doc-section h3 svg { width: 26px; height: 26px; color: var(--accent); flex-shrink: 0; }
        .doc-section p { color: var(--text-muted); margin-bottom: 1rem; line-height: 1.65; }
        .doc-section ul { margin-left: 1.25rem; color: var(--text-muted); }
        .doc-section li { margin-bottom: 0.55rem; }
        .doc-section strong { color: var(--text); }
        .doc-section code {
            background: var(--surface-2);
            padding: 0.15rem 0.4rem;
            border-radius: 6px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.85em;
            color: var(--accent-2);
        }

        /* Suggested Videos Popup */
        .vid-popup-overlay {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.55);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            z-index: 400;
            display: none;
            align-items: center; justify-content: center;
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        .vid-popup-overlay.open { display: flex; opacity: 1; }
        .vid-popup {
            width: 90%; max-width: 560px;
            max-height: 80vh; overflow-y: auto;
            background: var(--surface-solid);
            border: 1px solid var(--border-strong);
            border-radius: 18px;
            box-shadow: 0 24px 60px -16px rgba(0,0,0,0.5);
            padding: 1.5rem;
            transform: translateY(12px);
            transition: transform 0.2s ease;
        }
        .vid-popup-overlay.open .vid-popup { transform: translateY(0); }
        .vid-popup-head {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 1rem;
        }
        .vid-popup-head h4 {
            font-size: 1.1rem; font-weight: 700; margin: 0;
            display: flex; align-items: center; gap: 0.5rem;
            color: var(--text);
        }
        .vid-popup-head h4 svg { width: 20px; height: 20px; color: var(--accent); }
        .vid-popup-close {
            width: 32px; height: 32px; border-radius: 50%;
            border: 1px solid var(--border); background: transparent;
            color: var(--text-muted); cursor: pointer;
            display: grid; place-items: center;
            transition: all 0.15s ease;
        }
        .vid-popup-close:hover { background: var(--surface-2); color: var(--text); }
        .vid-popup-close svg { width: 16px; height: 16px; }
        .vid-popup-list { display: flex; flex-direction: column; gap: 0.6rem; }
        .vid-popup-item {
            display: flex; align-items: center; gap: 0.85rem;
            padding: 0.75rem 0.85rem;
            border: 1px solid var(--border);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.15s ease;
            text-decoration: none;
            color: inherit;
        }
        .vid-popup-item:hover {
            border-color: var(--border-strong);
            background: color-mix(in srgb, var(--accent) 8%, transparent);
            transform: translateX(4px);
        }
        .vid-popup-thumb {
            width: 44px; height: 44px; border-radius: 10px;
            background: color-mix(in srgb, var(--accent) 15%, transparent);
            display: grid; place-items: center;
            flex-shrink: 0;
        }
        .vid-popup-thumb svg { width: 20px; height: 20px; color: var(--accent); }
        .vid-popup-info { flex: 1; min-width: 0; }
        .vid-popup-info h5 {
            font-size: 0.9rem; font-weight: 600; margin: 0 0 0.2rem;
            color: var(--text);
        }
        .vid-popup-info p {
            font-size: 0.76rem; color: var(--text-muted); margin: 0;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .vid-popup-badge {
            font-size: 0.68rem; font-weight: 600;
            padding: 0.2rem 0.5rem; border-radius: 6px;
            flex-shrink: 0;
        }
        .vid-popup-badge.available { background: rgba(16,185,129,0.15); color: #10b981; }
        .vid-popup-badge.coming { background: rgba(245,158,11,0.15); color: #f59e0b; }
        .vid-popup-empty {
            text-align: center; padding: 2rem 1rem;
            color: var(--text-muted); font-size: 0.88rem;
        }
        .vid-suggest-btn {
            display: inline-flex; align-items: center; gap: 0.4rem;
            margin-left: auto;
            padding: 0.3rem 0.7rem;
            border: 1px solid var(--border-strong);
            border-radius: 8px;
            background: transparent;
            color: var(--accent);
            font-size: 0.72rem; font-weight: 600;
            cursor: pointer; font-family: inherit;
            transition: all 0.15s ease;
        }
        .vid-suggest-btn:hover {
            background: var(--accent-soft);
            border-color: var(--border-strong);
        }
        .vid-suggest-btn svg { width: 14px; height: 14px; }

        /* Code block */
        .code-block-wrap { position: relative; margin: 1rem 0; }
        .code-block {
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1rem;
            padding-right: 3rem;
            font-family: 'Poppins', sans-serif;
            font-size: 0.85rem;
            color: var(--text);
            overflow-x: auto;
            white-space: pre;
        }
        .copy-btn {
            position: absolute; top: 0.6rem; right: 0.6rem;
            width: 30px; height: 30px; border-radius: 7px;
            background: var(--surface-solid); border: 1px solid var(--border);
            color: var(--text-muted); cursor: pointer;
            display: grid; place-items: center; transition: all 0.15s ease;
        }
        .copy-btn:hover { color: var(--accent); border-color: var(--border-strong); }
        .copy-btn svg { width: 15px; height: 15px; }
        .copy-btn.copied { color: var(--accent); }

        /* Mobile top nav pills (shown instead of sidebar on small screens) */
        .doc-nav-mobile {
            display: none;
            gap: 0.5rem; overflow-x: auto;
            padding: 0 0 1rem;
            margin-bottom: 0.5rem;
            -webkit-overflow-scrolling: touch;
        }
        .doc-nav-mobile a {
            flex-shrink: 0;
            padding: 0.45rem 0.9rem;
            border-radius: 999px;
            background: var(--surface);
            border: 1px solid var(--border);
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 500;
            white-space: nowrap;
            transition: transform 0.18s cubic-bezier(0.4, 0, 0.2, 1), border-color 0.18s ease, color 0.18s ease;
        }
        .doc-nav-mobile a:hover { transform: translateY(-3px); border-color: var(--border-strong); color: var(--text); }
        .doc-nav-mobile a:active { transform: translateY(0) scale(0.97); }
        .doc-nav-mobile a.active { background: #10b981; color: #fff; border-color: var(--border-strong); transform: translateY(-3px); }

        /* Footer */
        .footer {
            text-align: center;
            padding: 2rem 0;
            color: var(--text-dim);
            font-size: 0.8rem;
            border-top: 1px solid var(--border);
            margin-top: 3rem;
        }

        /* Video Documentation */
        .video-toolbar {
            display: flex; flex-wrap: wrap; gap: 0.75rem;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .video-search {
            flex: 1; min-width: 200px;
            display: flex; align-items: center; gap: 0.5rem;
            background: var(--surface-2); border: 1px solid var(--border);
            border-radius: 10px; padding: 0.55rem 0.8rem;
        }
        .video-search svg { width: 16px; height: 16px; color: var(--text-dim); flex-shrink: 0; }
        .video-search input {
            border: none; background: transparent; outline: none;
            color: var(--text); font-family: inherit; font-size: 0.85rem; width: 100%;
        }
        .video-search input::placeholder { color: var(--text-dim); }
        .status-filter { display: flex; gap: 0.4rem; flex-wrap: wrap; }
        .status-filter button {
            font-family: inherit;
            padding: 0.45rem 0.85rem;
            border-radius: 999px;
            border: 1px solid var(--border);
            background: var(--surface-2);
            color: var(--text-muted);
            font-size: 0.78rem; font-weight: 600;
            cursor: pointer; transition: transform 0.18s cubic-bezier(0.4, 0, 0.2, 1), border-color 0.18s ease, background 0.18s ease, color 0.18s ease;
        }
        .status-filter button:hover { transform: translateY(-3px); border-color: var(--border-strong); color: var(--text); }
        .status-filter button:active { transform: translateY(0) scale(0.97); }
        .status-filter button.active { background: var(--accent); color: #fff; border-color: var(--border-strong); transform: translateY(-3px); }
        .video-results-count { font-size: 0.78rem; color: var(--text-dim); margin-bottom: 1rem; }
        .video-empty { display: none; text-align: center; padding: 2rem; color: var(--text-dim); font-size: 0.88rem; }
        .video-empty.show { display: block; }

        .video-category { margin-bottom: 2rem; }
        .video-category.hidden { display: none; }
        .video-category h4 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--accent);
            display: flex; align-items: center; gap: 0.5rem;
        }
        .video-category h4 .count { font-size: 0.72rem; color: var(--text-dim); font-weight: 600; }
        .video-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1rem;
        }
        .video-item {
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.25rem;
            display: flex; flex-direction: column; gap: 0.5rem;
            transition: all 0.2s ease;
        }
        .video-item.hidden { display: none; }
        .video-item:hover {
            border-color: var(--border-strong);
            transform: translateY(-2px);
        }
        .video-item[data-status="available"] { cursor: pointer; }
        .video-item h5 {
            font-size: 0.98rem;
            font-weight: 600;
            color: var(--text);
        }
        .video-item p {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin: 0;
        }
        .video-meta-row {
            display: flex; align-items: center; gap: 0.75rem;
            margin-top: 0.5rem;
            flex-wrap: wrap;
        }
        .video-status {
            font-size: 0.72rem;
            font-weight: 700;
            padding: 0.18rem 0.55rem;
            border-radius: 6px;
            text-transform: uppercase;
        }
        .video-status.available { background: var(--accent-soft); color: var(--accent); }
        .video-status.coming { background: rgba(248, 113, 113, 0.14); color: #f87171; }
        .video-duration {
            font-size: 0.72rem;
            color: var(--text-dim);
            font-weight: 500;
        }
        .watch-link {
            display: inline-flex; align-items: center; gap: 0.35rem;
            margin-top: 0.5rem;
            color: var(--accent);
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 600;
        }
        .watch-link:hover { text-decoration: underline; }

        /* Back to top */
        .back-to-top {
            position: fixed; right: 1.5rem; bottom: 1.5rem;
            width: 44px; height: 44px; border-radius: 12px;
            background: var(--surface-solid); border: 1px solid var(--border-strong);
            color: var(--text); box-shadow: var(--shadow);
            display: grid; place-items: center; cursor: pointer;
            opacity: 0; pointer-events: none; transform: translateY(8px);
            transition: all 0.2s ease; z-index: 150;
        }
        .back-to-top.show { opacity: 1; pointer-events: auto; transform: translateY(0); }
        .back-to-top:hover { border-color: var(--border-strong); color: var(--accent); }
        .back-to-top svg { width: 20px; height: 20px; }


        /* Search modal (command palette) */
        .search-overlay {
            position: fixed; inset: 0; z-index: 400;
            background: rgba(5, 10, 20, 0.55);
            backdrop-filter: blur(3px);
            display: none;
            align-items: flex-start;
            justify-content: center;
            padding: 10vh 1rem 1rem;
        }
        .search-overlay.open { display: flex; }
        .search-modal {
            width: 100%; max-width: 560px;
            background: var(--surface-solid);
            border: 1px solid var(--border-strong);
            border-radius: 16px;
            box-shadow: var(--shadow);
            overflow: hidden;
            max-height: 70vh;
            display: flex; flex-direction: column;
        }
        .search-modal-input {
            display: flex; align-items: center; gap: 0.6rem;
            padding: 1rem 1.1rem;
            border-bottom: 1px solid var(--border);
        }
        .search-modal-input svg { width: 18px; height: 18px; color: var(--text-dim); flex-shrink: 0; }
        .search-modal-input input {
            flex: 1; border: none; outline: none; background: transparent;
            font-family: inherit; font-size: 0.95rem; color: var(--text);
        }
        .search-modal-input input::placeholder { color: var(--text-dim); }
        .search-modal-input .esc { font-size: 0.7rem; color: var(--text-dim); border: 1px solid var(--border-strong); border-radius: 5px; padding: 0.1rem 0.4rem; }
        .search-results { overflow-y: auto; padding: 0.5rem; }
        .search-result {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.65rem 0.75rem; border-radius: 10px;
            cursor: pointer; text-decoration: none; color: inherit;
        }
        .search-result:hover, .search-result.selected { background: var(--surface-2); }
        .search-result svg { width: 17px; height: 17px; color: var(--accent); flex-shrink: 0; }
        .search-result .sr-title { font-size: 0.86rem; font-weight: 600; }
        .search-result .sr-sub { font-size: 0.74rem; color: var(--text-dim); }
        .search-empty { padding: 2rem 1rem; text-align: center; color: var(--text-dim); font-size: 0.85rem; }
        .search-hint { padding: 0.6rem 1.1rem; font-size: 0.72rem; color: var(--text-dim); border-top: 1px solid var(--border); display: flex; gap: 1rem; }
        .search-hint span { display: flex; align-items: center; gap: 0.3rem; }

        mark { background: var(--accent-soft); color: var(--accent); border-radius: 3px; padding: 0 0.1rem; }

        /* Reduce motion */
        .reduce-motion *, .reduce-motion *::before, .reduce-motion *::after {
            animation: none !important;
            transition: none !important;
        }
        .reduce-motion html { scroll-behavior: auto; }

        /* Responsive */
        @media (max-width: 900px) {
            .layout { grid-template-columns: 1fr; padding: 0 1.25rem; }
            .menu-btn { display: grid; }
            .header-search span, .kbd { display: none; }
            .header-search { max-width: 44px; padding: 0.5rem; justify-content: center; }
            .sidebar {
                position: fixed; top: 0; left: 0; height: 100vh; max-height: none;
                width: 280px; background: var(--surface-solid);
                border-right: 1px solid var(--border-strong);
                border-radius: 0;
                padding: 1.25rem 0.85rem 2rem; z-index: 260;
                transform: translateX(-100%);
                transition: transform 0.25s ease;
            }
            .sidebar.open { transform: translateX(0); }
            .sidebar.mini { width: 280px; padding: 1.25rem 0.85rem 2rem; }
            .sidebar.mini .search-wrap input { text-indent: 0; width: 100%; padding: 0.7rem 2rem 0.7rem 2.4rem; }
            .sidebar.mini .search-wrap svg { left: 1rem; transform: translateY(-60%); }
            .sidebar.mini .nav-link { justify-content: flex-start; font-size: 0.88rem; gap: 0.7rem; padding: 0.62rem 0.85rem; }
            .sidebar.mini .nav-section-title { font-size: 0.68rem; padding: 1rem 1rem 0.4rem; justify-content: flex-start; }
            .sidebar.mini .nav-link::after { display: none; }
            .sidebar-hide-btn { display: none; }
            .sidebar-overlay {
                display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5);
                z-index: 250;
            }
            .sidebar-overlay.open { display: block; }
            .doc-nav-mobile { display: flex; }
        }
        @media (max-width: 560px) {
            .doc-hero h2 { font-size: 1.5rem; }
            .doc-section { padding: 1.25rem; }
        }
        .doc-floater {
            position: fixed;
            left: 0; top: 0;
            width: 300px;
            padding: 1.1rem;
            background: color-mix(in srgb, var(--surface-solid) 92%, transparent);
            border: 1px solid color-mix(in srgb, var(--border) 60%, transparent);
            border-radius: 16px;
            box-shadow: 0 20px 40px -16px rgba(0,0,0,0.45);
            backdrop-filter: blur(18px) saturate(160%);
            -webkit-backdrop-filter: blur(18px) saturate(160%);
            z-index: 300;
            display: none;
            pointer-events: none;
            opacity: 0;
            transform: translateY(8px);
            transition: opacity 0.18s ease, transform 0.18s ease;
        }
        .doc-floater.show { display: block; opacity: 1; transform: translateY(0); }
        .doc-floater h4 { font-size: 0.95rem; font-weight: 700; margin: 0 0 0.5rem; color: var(--text); line-height: 1.25; }
        .doc-floater p { font-size: 0.82rem; color: var(--text-muted); line-height: 1.45; margin: 0; max-height: 8.5em; overflow: hidden; }
        @media (max-width: 900px) { .doc-floater { display: none !important; } }

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
    <link rel="stylesheet" href="css/ai-assistant.css">
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

    <div class="loader-screen" id="loader">
        <div class="loader-logo">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 3H7a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V8z"/><path d="M14 3v5h5"/><path d="M9 13h6M9 17h6"/></svg>
        </div>
        <div class="loader-text">DISPATCH Documentation</div>
        <div class="loader-bar"><div class="loader-bar-fill"></div></div>
    </div>

    <a href="#main-content" class="skip-link">Skip to content</a>
    <div class="progress-bar" id="progress-bar"></div>

    <header class="header">
        <button class="icon-btn menu-btn" id="menu-btn" aria-label="Open navigation" title="Menu" aria-expanded="false" aria-controls="sidebar">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
        </button>
        <a href="index.php" class="brand">
            <span class="brand-mark">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 3H7a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V8z"/><path d="M14 3v5h5"/><path d="M9 13h6M9 17h6"/></svg>
            </span>
            <span class="brand-text">
                <h1>DISPATCH</h1>
                <p>Documentation</p>
            </span>
        </a>
        <div class="header-actions">
            <a href="tutorials.php" class="icon-btn shortcut-btn" title="Video Tutorials">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
            </a>
            <a href="video_docs.php" class="icon-btn shortcut-btn" title="Video Docs">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6"/><path d="M10 11l5 3-5 3z" fill="currentColor" stroke="none"/></svg>
            </a>
            <button class="icon-btn theme-btn" onclick="toggleTheme()" title="Toggle theme" id="theme-btn">
                <svg class="moon-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.8A9 9 0 1111.2 3 7 7 0 0021 12.8z"/></svg>
                <svg class="sun-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="display:none;"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
            </button>
            <a href="index.php" class="back-home-btn">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 18L18 6M6 6l12 12"/></svg>
            </a>
        </div>
    </header>

    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <div class="layout">
        <aside class="sidebar" id="sidebar" aria-label="Documentation sections">
            <div class="search-wrap">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
                <input type="text" id="sidebar-search" placeholder="Search sections..." onkeyup="filterMenu()" onclick="if(document.getElementById('sidebar').classList.contains('mini')){toggleSidebarMini();this.focus();}">
            </div>
            <button class="sidebar-hide-btn" onclick="toggleSidebarMini()" title="Collapse sidebar" aria-label="Toggle sidebar" id="sidebar-toggle-btn">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 19l-7-7 7-7M19 19l-7-7 7-7"/></svg>
            </button>

            <ul class="nav-list" id="doc-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#overview" data-section="overview" data-tip="Overview">
                        <svg fill="none" viewBox="0 0 24 24" stroke="#10b981"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Overview
                    </a>
                </li>
            </ul>

            <div class="nav-section-title">Video Library</div>
            <ul class="nav-list">
                <li class="nav-item">
                    <a class="nav-link" href="#videos" data-section="videos" data-tip="Video Module">
                        <svg fill="none" viewBox="0 0 24 24" stroke="#3b82f6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        Video Module
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#all-videos" data-section="all-videos" data-tip="Video Catalog (<?php echo $totalVideos; ?>)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="#f59e0b"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Video Catalog (<?php echo $totalVideos; ?>)
                    </a>
                </li>
            </ul>

            <div class="nav-section-title">Configuration</div>
            <ul class="nav-list">
                <li class="nav-item">
                    <a class="nav-link" href="#settings" data-section="settings" data-tip="Settings &amp; Accessibility">
                        <svg fill="none" viewBox="0 0 24 24" stroke="#8b5cf6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Settings &amp; Accessibility
                    </a>
                </li>
            </ul>
        </aside>

        <main class="content" id="main-content">
            <section class="doc-hero">
                <h2>System Documentation</h2>
                <p>Reference guide for the Dispatch LMS video tutorial library.</p>
                <div class="hero-stats">
                    <div class="hero-stat"><strong><?php echo $totalVideos; ?></strong><span>Total tutorials</span></div>
                    <div class="hero-stat"><strong><?php echo $totalAvailable; ?></strong><span>Available now</span></div>
                    <div class="hero-stat"><strong>6</strong><span>Categories covered</span></div>
                </div>
            </section>

            <nav class="doc-nav-mobile" id="doc-nav-mobile" aria-label="Quick jump">
                <a href="#overview" data-section="overview" class="active">Overview</a>
                <a href="#videos" data-section="videos">Videos</a>
                <a href="#all-videos" data-section="all-videos">Library</a>
                <a href="#settings" data-section="settings">Settings</a>
            </nav>

            <div class="doc-grid">
                <a href="#all-videos" class="doc-card">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <h3>Video Tutorials</h3>
                    <p>Browse, search, and watch tutorials with per-video progress and watch history.</p>
                </a>
                <a href="#settings" class="doc-card">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <h3>Settings</h3>
                    <p>Dark mode, accent color, font size, playback speed, and accessibility toggles.</p>
                </a>
            </div>

            <section class="doc-section" id="overview">
                <h3><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Overview
                    <button class="vid-suggest-btn" onclick="openVidPopup('overview', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Suggested Videos
                    </button>
                </h3>
                <p><strong>Dispatch LMS</strong> is a learning management system for dispatch operations training. It delivers a structured video tutorial library (<code>dispatch/tutorials.php</code>), searchable documentation (<code>dispatch/index.php</code>), and a shared settings layer that persists user preferences in the browser's localStorage.</p>
                <p>All pages in the LMS share a unified visual identity: dark glassmorphism UI, smooth transitions, Poppins typography, and a consistent emerald accent color. Themes and settings are synchronized across pages via <code>dispatch-settings</code> in localStorage.</p>
            </section>

            <section class="doc-section" id="videos">
                <h3><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>Video Module
                    <button class="vid-suggest-btn" onclick="openVidPopup('videos', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Suggested Videos
                    </button>
                </h3>
                <p>Each tutorial is rendered as a <strong>video card</strong> — a self-contained component built from a <code>VIDEOS</code> JavaScript array entry. Every video object has an <code>id</code>, <code>title</code>, <code>desc</code>, <code>category</code>, <code>src</code>, and <code>duration</code>. The card is assembled dynamically in <code>renderVideos()</code> and injected into the <code>.video-grid</code> container.</p>
                <ul>
                    <li><strong>Card structure</strong>: Each <code>.video-card</code> contains a <code>.video-thumb</code> (thumbnail area) and a <code>.video-info</code> (title, description, and metadata). The thumbnail holds the <code>category-badge</code>, <code>duration-badge</code>, <code>play-overlay</code>, <code>favorite-btn</code>, and a <code>progress-bar</code> when applicable.</li>
                    <li><strong>Availability</strong>: Only files listed in <code>AVAILABLE_VIDEOS</code> render a playable <code>&lt;video&gt;</code> element. Unavailable videos display a <code>.video-empty</code> "Coming Soon" placeholder inside the thumbnail instead.</li>
                    <li><strong>Category badge</strong>: A colored pill in the top-left corner of the thumbnail showing the video's <code>category</code> (e.g. Operations, Fleet, Finance). It floats and scales on card hover.</li>
                    <li><strong>Duration badge</strong>: A dark pill in the bottom-right corner showing the video's <code>duration</code>. Only rendered for available videos.</li>
                    <li><strong>Play overlay</strong>: A semi-transparent overlay with a play icon that fades in on card hover, indicating the video is clickable.</li>
                    <li><strong>Favorite button</strong>: A star toggle in the top-right corner of the thumbnail. State is persisted per <code>video-id</code> in localStorage.</li>
                    <li><strong>Progress bar</strong>: A thin bar at the bottom of the thumbnail showing watch progress (0–100%). Saved to localStorage by <code>video-id</code> and restored on render.</li>
                    <li><strong>Video metadata</strong>: Below the description, a <code>.video-meta</code> row displays the category and availability status (Available or Coming Soon) with corresponding icons.</li>
                    <li><strong>Watch history</strong>: Recently watched videos are stored locally in the browser and surfaced in a dedicated history section above the grid.</li>
                </ul>
            </section>

            <section class="doc-section" id="settings">
                <h3><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>Settings &amp; Accessibility
                    <button class="vid-suggest-btn" onclick="openVidPopup('settings', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Suggested Videos
                    </button>
                </h3>
                <ul>
                    <li><strong>Dark mode</strong>: toggles <code>html.light</code> class and persists as <code>dispatch-theme</code>.</li>
                    <li><strong>Font size</strong>: base 15px, adjustable via range input. Large-text mode sets 18px.</li>
                    <li><strong>Playback speed</strong>: controls the modal video playback rate.</li>
                    <li><strong>Reduce motion</strong>: disables CSS animations for users with vestibular disorders.</li>
                    <li><strong>High contrast</strong>: increases contrast for better readability.</li>
                </ul>
            </section>

            <section class="doc-section" id="all-videos">
                <h3><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Video Library
                    <button class="vid-suggest-btn" onclick="openVidPopup('all-videos', this)">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Suggested Videos
                    </button>
                </h3>
                <p>Complete catalog of all DISPATCH tutorial videos. Available videos link directly to the tutorial player.</p>

                <div class="video-toolbar">
                    <div class="video-search">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
                        <input type="text" id="video-search-input" placeholder="Filter <?php echo $totalVideos; ?> videos by name…" aria-label="Filter videos">
                    </div>
                    <div class="status-filter" id="status-filter" role="group" aria-label="Filter by availability">
                        <button type="button" class="active" data-filter="all">All</button>
                        <button type="button" data-filter="available">Available</button>
                        <button type="button" data-filter="coming">Coming Soon</button>
                    </div>
                </div>
                <p class="video-results-count" id="video-results-count"></p>

                <?php
                $grouped = [];
                foreach ($videoCatalog as $video) {
                    $grouped[$video['category']][] = $video;
                }
                foreach ($grouped as $category => $videos) {
                    echo '<div class="video-category" data-category="' . htmlspecialchars($category) . '">';
                    echo '<h4>' . htmlspecialchars($category) . ' <span class="count">(' . count($videos) . ')</span></h4>';
                    echo '<div class="video-list">';
                    foreach ($videos as $v) {
                        $isAvailable = in_array($v['src'], $availableVideos);
                        $statusClass = $isAvailable ? 'available' : 'coming';
                        $statusText = $isAvailable ? 'Available' : 'Coming Soon';
                        $onclick = $isAvailable ? ' onclick="location.href=\'tutorials.php#' . htmlspecialchars($v['id']) . '\'"' : '';
                        echo '<div class="video-item" data-status="' . $statusClass . '" data-title="' . htmlspecialchars(strtolower($v['title'] . ' ' . $v['desc'])) . '"' . $onclick . '>';
                        echo '<h5>' . htmlspecialchars($v['title']) . '</h5>';
                        echo '<p>' . htmlspecialchars($v['desc']) . '</p>';
                        echo '<div class="video-meta-row">';
                        echo '<span class="video-status ' . $statusClass . '">' . $statusText . '</span>';
                        echo '<span class="video-duration">' . htmlspecialchars($v['duration']) . '</span>';
                        echo '</div>';
                        echo '</div>';
                    }
                    echo '</div></div>';
                }
                ?>
                <p class="video-empty" id="video-empty">No videos match your search. Try a different keyword or filter.</p>
            </section>

            <footer class="footer">
                <p>&copy; DISPATCH Training Portal.</p>
            </footer>
        </main>
    </div>

    <button class="back-to-top" id="back-to-top" aria-label="Back to top">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
    </button>

    <div class="search-overlay" id="search-overlay">
        <div class="search-modal" role="dialog" aria-modal="true" aria-label="Search documentation">
            <div class="search-modal-input">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
                <input type="text" id="search-modal-input" placeholder="Search sections and 44 tutorial videos…" autocomplete="off">
                <span class="esc">ESC</span>
            </div>
            <div class="search-results" id="search-results"></div>
            <div class="search-hint">
                <span>↑↓ navigate</span>
                <span>↵ select</span>
                <span>esc close</span>
            </div>
        </div>
    </div>

    <script>
        // ---- Data passed from PHP for client-side search ----
        const SECTIONS = [
            { id: 'overview', title: 'Overview', sub: 'Dispatch LMS, tutorials.php, index.php, shared settings' },
            { id: 'videos', title: 'Video Module', sub: 'VIDEOS array, availability, progress tracking' },
            { id: 'settings', title: 'Settings & Accessibility', sub: 'Theme, font size, playback speed, reduce motion' },
            { id: 'all-videos', title: 'Video Library', sub: '<?php echo $totalVideos; ?> tutorials across every category' }
        ];
        const VIDEOS = <?php echo json_encode(array_map(function($v) use ($availableVideos) {
            return [
                'id' => $v['id'],
                'title' => $v['title'],
                'desc' => $v['desc'],
                'category' => $v['category'],
                'available' => in_array($v['src'], $availableVideos)
            ];
        }, $videoCatalog)); ?>;

        // ---- Theme + Shared Settings (from index.php / tutorials.php) ----
        function loadSharedSettings() {
            const defaults = {
                'dark-mode': true,
                'accent-color': '#10b981',
                'font-size': 15,
                'large-text': false,
                'reduce-motion': false,
                'high-contrast': false
            };
            let s;
            try {
                const raw = localStorage.getItem('dispatch-settings');
                const theme = localStorage.getItem('dispatch-theme');
                if (raw) {
                    s = Object.assign({}, defaults, JSON.parse(raw));
                } else if (theme === 'light') {
                    s = Object.assign({}, defaults, { 'dark-mode': false });
                } else {
                    s = defaults;
                }
            } catch (e) { s = defaults; }
            return s;
        }
        function applySharedSettings() {
            const s = loadSharedSettings();
            document.documentElement.style.setProperty('--accent', s['accent-color']);
            document.documentElement.style.setProperty('--accent-soft', s['accent-color'] + '22');
            if (s['large-text']) document.documentElement.style.fontSize = '18px';
            else document.documentElement.style.fontSize = s['font-size'] + 'px';
            document.body.classList.toggle('reduce-motion', !!s['reduce-motion']);
            document.body.classList.toggle('high-contrast', !!s['high-contrast']);
            // Check dispatch-theme first, then dispatch-settings dark-mode
            const themeKey = localStorage.getItem('dispatch-theme');
            let isLight = (themeKey === 'light');
            if (!themeKey) isLight = (s['dark-mode'] === false);
            if (isLight) document.documentElement.classList.add('light');
            else document.documentElement.classList.remove('light');
            const moonIcon = document.querySelector('.theme-btn .moon-icon');
            const sunIcon = document.querySelector('.theme-btn .sun-icon');
            if (moonIcon && sunIcon) {
                const isDark = !document.documentElement.classList.contains('light');
                moonIcon.style.display = isDark ? 'block' : 'none';
                sunIcon.style.display = isDark ? 'none' : 'block';
            }
            updateBackgroundSVG();
        }
        function toggleTheme() {
            document.documentElement.classList.toggle('light');
            const isLight = document.documentElement.classList.contains('light');
            try { localStorage.setItem('dispatch-theme', isLight ? 'light' : 'dark'); } catch (e) {}
            try {
                const raw = localStorage.getItem('dispatch-settings') || '{}';
                const s = Object.assign({ 'dark-mode': !isLight }, JSON.parse(raw));
                s['dark-mode'] = !isLight;
                localStorage.setItem('dispatch-settings', JSON.stringify(s));
            } catch (e) {}
            const moonIcon = document.querySelector('.theme-btn .moon-icon');
            const sunIcon = document.querySelector('.theme-btn .sun-icon');
            if (moonIcon && sunIcon) {
                moonIcon.style.display = isLight ? 'none' : 'block';
                sunIcon.style.display = isLight ? 'block' : 'none';
            }
            updateBackgroundSVG();
            window.dispatchEvent(new StorageEvent('storage', { key: 'dispatch-settings' }));
        }
        function updateBackgroundSVG() {
            const isLight = document.documentElement.classList.contains('light');
            const darkSVG = document.getElementById('bg-svg-dark');
            const lightSVG = document.getElementById('bg-svg-light');
            if (darkSVG) darkSVG.style.display = isLight ? 'none' : 'block';
            if (lightSVG) lightSVG.style.display = isLight ? 'block' : 'none';
        }
        (function initSettings() {
            applySharedSettings();
            window.addEventListener('storage', function (e) {
                if (e.key === 'dispatch-settings' || e.key === 'dispatch-theme') {
                    applySharedSettings();
                }
            });
        })();

        // ---- Reading progress bar ----
        (function initProgress() {
            const bar = document.getElementById('progress-bar');
            function update() {
                const h = document.documentElement;
                const scrolled = h.scrollTop;
                const height = h.scrollHeight - h.clientHeight;
                bar.style.width = height > 0 ? (scrolled / height * 100) + '%' : '0%';
            }
            document.addEventListener('scroll', update, { passive: true });
            update();
        })();

        // ---- Back to top ----
        (function initBackToTop() {
            const btn = document.getElementById('back-to-top');
            document.addEventListener('scroll', function () {
                btn.classList.toggle('show', window.scrollY > 500);
            }, { passive: true });
            btn.addEventListener('click', function () {
                window.scrollTo({ top: 0, behavior: document.body.classList.contains('reduce-motion') ? 'auto' : 'smooth' });
            });
        })();


        // ---- Mobile sidebar drawer ----
        (function initDrawer() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const menuBtn = document.getElementById('menu-btn');
            function open() {
                sidebar.classList.add('open');
                overlay.classList.add('open');
                menuBtn.setAttribute('aria-expanded', 'true');
            }
            function close() {
                sidebar.classList.remove('open');
                overlay.classList.remove('open');
                menuBtn.setAttribute('aria-expanded', 'false');
            }
            menuBtn.addEventListener('click', function () {
                sidebar.classList.contains('open') ? close() : open();
            });
            overlay.addEventListener('click', close);
            sidebar.querySelectorAll('a').forEach(function (a) {
                a.addEventListener('click', close);
            });
        })();

        // ---- Sidebar mini (collapse) ----
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
                try { localStorage.setItem('dispatch-sidebar-mini', 'true'); } catch (e) {}
            }
        }
        (function initSidebarMiniRestore() {
            try {
                if (localStorage.getItem('dispatch-sidebar-mini') === 'true' && window.innerWidth > 900) {
                    var sidebar = document.getElementById('sidebar');
                    var btn = document.getElementById('sidebar-toggle-btn');
                    sidebar.classList.add('mini');
                    btn.title = 'Expand sidebar';
                    btn.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>';
                }
            } catch (e) {}
        })();

        // ---- Sidebar search filter ----
        function filterMenu() {
            const term = document.getElementById('sidebar-search').value.toLowerCase().trim();
            document.querySelectorAll('.sidebar .nav-section-title').forEach(function (title) {
                const list = title.nextElementSibling;
                if (!list || !list.classList.contains('nav-list')) return;
                const sectionMatch = title.textContent.toLowerCase().includes(term);
                let visibleCount = 0;
                list.querySelectorAll(':scope > .nav-item').forEach(function (item) {
                    const link = item.querySelector('.nav-link');
                    const text = link ? link.textContent.toLowerCase() : '';
                    const match = !term || sectionMatch || text.includes(term);
                    item.style.display = match ? '' : 'none';
                    if (match) visibleCount++;
                });
                title.style.display = visibleCount > 0 ? '' : 'none';
            });
        }

        // ---- Scrollspy: highlight active nav link (sidebar + mobile pills) ----
        (function initScrollspy() {
            const sections = Array.from(document.querySelectorAll('.doc-section[id]'));
            const sidebarLinks = Array.from(document.querySelectorAll('.sidebar .nav-link'));
            const mobileLinks = Array.from(document.querySelectorAll('#doc-nav-mobile a'));
            function setActive(id) {
                [...sidebarLinks, ...mobileLinks].forEach(function (l) {
                    l.classList.toggle('active', l.dataset.section === id);
                });
                const activeMobile = document.querySelector('#doc-nav-mobile a.active');
                if (activeMobile) activeMobile.scrollIntoView({ block: 'nearest', inline: 'center' });
            }
            if (!('IntersectionObserver' in window) || sections.length === 0) return;
            const observer = new IntersectionObserver(function (entries) {
                let best = null;
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        if (!best || entry.boundingClientRect.top < best.boundingClientRect.top) best = entry;
                    }
                });
                if (best) setActive(best.target.id);
            }, { rootMargin: '-90px 0px -60% 0px', threshold: [0, 1] });
            sections.forEach(function (s) { observer.observe(s); });
        })();

        // ---- Copy code block ----
        (function initCopy() {
            const btn = document.getElementById('copy-btn');
            const code = document.getElementById('code-sample');
            if (!btn || !code) return;
            btn.addEventListener('click', function () {
                const text = code.innerText;
                navigator.clipboard.writeText(text).then(function () {
                    btn.classList.add('copied');
                    btn.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
                    setTimeout(function () {
                        btn.classList.remove('copied');
                        btn.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>';
                    }, 1600);
                }).catch(function () {});
            });
        })();

        // ---- Video library: search + status filter ----
        (function initVideoFilter() {
            const input = document.getElementById('video-search-input');
            const statusBtns = document.querySelectorAll('#status-filter button');
            const categories = document.querySelectorAll('.video-category');
            const countEl = document.getElementById('video-results-count');
            const emptyEl = document.getElementById('video-empty');
            let currentStatus = 'all';

            function apply() {
                const term = input.value.trim().toLowerCase();
                let visibleTotal = 0;
                categories.forEach(function (cat) {
                    let visibleInCat = 0;
                    cat.querySelectorAll('.video-item').forEach(function (item) {
                        const matchesTerm = !term || item.dataset.title.includes(term);
                        const matchesStatus = currentStatus === 'all' || item.dataset.status === currentStatus;
                        const show = matchesTerm && matchesStatus;
                        item.classList.toggle('hidden', !show);
                        if (show) { visibleInCat++; visibleTotal++; }
                    });
                    cat.classList.toggle('hidden', visibleInCat === 0);
                });
                emptyEl.classList.toggle('show', visibleTotal === 0);
                countEl.textContent = visibleTotal + (visibleTotal === 1 ? ' video' : ' videos') +
                    (term || currentStatus !== 'all' ? ' matching your filters' : ' total');
            }

            input.addEventListener('input', apply);
            statusBtns.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    statusBtns.forEach(function (b) { b.classList.remove('active'); });
                    btn.classList.add('active');
                    currentStatus = btn.dataset.filter;
                    apply();
                });
            });
            apply();
        })();

        // ---- Command-palette search (sections + videos) ----
        (function initSearchModal() {
            const overlay = document.getElementById('search-overlay');
            const trigger = document.getElementById('search-trigger');
            const modalInput = document.getElementById('search-modal-input');
            const resultsEl = document.getElementById('search-results');
            let selectedIndex = 0;
            let currentResults = [];

            function escapeHtml(str) {
                return String(str).replace(/[&<>"']/g, function (c) {
                    return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
                });
            }
            function highlight(text, term) {
                const safe = escapeHtml(text);
                if (!term) return safe;
                const idx = safe.toLowerCase().indexOf(term.toLowerCase());
                if (idx === -1) return safe;
                return safe.slice(0, idx) + '<mark>' + safe.slice(idx, idx + term.length) + '</mark>' + safe.slice(idx + term.length);
            }

            function buildResults(term) {
                const t = term.trim().toLowerCase();
                const results = [];
                SECTIONS.forEach(function (s) {
                    if (!t || s.title.toLowerCase().includes(t) || s.sub.toLowerCase().includes(t)) {
                        results.push({ type: 'section', id: s.id, title: s.title, sub: s.sub });
                    }
                });
                VIDEOS.forEach(function (v) {
                    if (!t || v.title.toLowerCase().includes(t) || v.desc.toLowerCase().includes(t) || v.category.toLowerCase().includes(t)) {
                        results.push({
                            type: 'video', id: v.id, title: v.title,
                            sub: v.category + ' · ' + (v.available ? 'Available' : 'Coming Soon'),
                            available: v.available
                        });
                    }
                });
                return results.slice(0, 40);
            }

            function render(term) {
                currentResults = buildResults(term);
                selectedIndex = 0;
                if (currentResults.length === 0) {
                    resultsEl.innerHTML = '<div class="search-empty">No matches. Try a different term.</div>';
                    return;
                }
                resultsEl.innerHTML = currentResults.map(function (r, i) {
                    const icon = r.type === 'section'
                        ? '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>'
                        : '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
                    const href = r.type === 'section' ? ('#' + r.id) : (r.available ? ('tutorials.php#' + r.id) : ('#all-videos'));
                    return '<a href="' + href + '" class="search-result' + (i === selectedIndex ? ' selected' : '') + '" data-index="' + i + '">' +
                        icon +
                        '<span><span class="sr-title">' + highlight(r.title, term) + '</span><br><span class="sr-sub">' + escapeHtml(r.sub) + '</span></span>' +
                        '</a>';
                }).join('');
            }

            function updateSelected() {
                resultsEl.querySelectorAll('.search-result').forEach(function (el, i) {
                    el.classList.toggle('selected', i === selectedIndex);
                });
                const sel = resultsEl.querySelector('.search-result.selected');
                if (sel) sel.scrollIntoView({ block: 'nearest' });
            }

            function open() {
                overlay.classList.add('open');
                modalInput.value = '';
                render('');
                setTimeout(function () { modalInput.focus(); }, 30);
            }
            function close() {
                overlay.classList.remove('open');
            }

            if (trigger) trigger.addEventListener('click', open);
            overlay.addEventListener('click', function (e) { if (e.target === overlay) close(); });
            modalInput.addEventListener('input', function () { render(modalInput.value); });
            resultsEl.addEventListener('click', function () { close(); });

            document.addEventListener('keydown', function (e) {
                const isCmdK = (e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k';
                if (isCmdK) { e.preventDefault(); overlay.classList.contains('open') ? close() : open(); return; }
                if (e.key === '/' && document.activeElement.tagName !== 'INPUT' && !overlay.classList.contains('open')) {
                    e.preventDefault(); open(); return;
                }
                if (!overlay.classList.contains('open')) return;
                if (e.key === 'Escape') { close(); return; }
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    selectedIndex = Math.min(selectedIndex + 1, currentResults.length - 1);
                    updateSelected();
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    selectedIndex = Math.max(selectedIndex - 1, 0);
                    updateSelected();
                } else if (e.key === 'Enter') {
                    const sel = resultsEl.querySelector('.search-result.selected');
                    if (sel) { sel.click(); }
                }
            });
        })();

        // Hide loading screen once page has fully loaded
        window.addEventListener('load', function () {
            setTimeout(function () {
                const loader = document.getElementById('loader');
                if (loader) loader.classList.add('hidden');
            }, 500);
        });
        (function initDocFloater() {
            const floater = document.getElementById('doc-floater');
            const titleEl = document.getElementById('doc-floater-title');
            const descEl = document.getElementById('doc-floater-desc');
            if (!floater) return;
            let hideTimer;
            function extractSectionId(link) {
                return link.dataset.section || (link.getAttribute('href') || '').replace('#','');
            }
            function showFloater(link) {
                const sectionId = extractSectionId(link);
                if (!sectionId) return;
                const section = document.getElementById(sectionId);
                if (!section) return;
                const heading = section.querySelector('h3') || section.querySelector('h2') || section.querySelector('h1');
                const paragraph = section.querySelector('p');
                titleEl.textContent = heading ? heading.textContent.trim() : link.textContent.trim();
                if (paragraph) {
                    const text = paragraph.textContent.trim().replace(/\s+/g, ' ');
                    descEl.textContent = text.length > 180 ? text.slice(0, 180) + '...' : text;
                } else {
                    descEl.textContent = '';
                }
                const rect = link.getBoundingClientRect();
                const w = 300;
                let left = rect.right + 14;
                if (left + w > window.innerWidth - 16) left = Math.max(16, rect.left - w - 14);
                floater.style.left = left + 'px';
                floater.style.top = Math.max(16, rect.top + 4) + 'px';
                floater.classList.add('show');
            }
            function hideFloater() { floater.classList.remove('show'); }
            document.querySelectorAll('.sidebar .nav-link, #doc-nav-mobile a').forEach(function(link) {
                link.addEventListener('mouseenter', function() { clearTimeout(hideTimer); showFloater(this); });
                link.addEventListener('mouseleave', function() { hideTimer = setTimeout(hideFloater, 160); });
            });
            floater.addEventListener('mouseenter', function() { clearTimeout(hideTimer); });
            floater.addEventListener('mouseleave', function() { hideTimer = setTimeout(hideFloater, 160); });
        })();
    </script>
    <div class="doc-floater" id="doc-floater" aria-hidden="true">
        <h4 id="doc-floater-title"></h4>
        <p id="doc-floater-desc"></p>
    </div>

    <!-- Suggested Videos Popup -->
    <div class="vid-popup-overlay" id="vid-popup-overlay">
        <div class="vid-popup">
            <div class="vid-popup-head">
                <h4>
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span id="vid-popup-title">Suggested Videos</span>
                </h4>
                <button class="vid-popup-close" onclick="closeVidPopup()" aria-label="Close">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="vid-popup-list" id="vid-popup-list"></div>
        </div>
    </div>

    <script>
    (function initVidPopup() {
        const overlay = document.getElementById('vid-popup-overlay');
        const listEl = document.getElementById('vid-popup-list');
        const titleEl = document.getElementById('vid-popup-title');
        if (!overlay || !listEl) return;

        const thumbSvg = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';

        // Map sections to related video categories/keywords
        const sectionMap = {
            'overview': { title: 'Overview', categories: ['Main'], keywords: ['dashboard', 'overview'] },
            'videos': { title: 'Video Module', categories: ['Main', 'Operations'], keywords: ['video', 'tutorial', 'load', 'truck'] },
            'settings': { title: 'Settings & Accessibility', categories: ['Account'], keywords: ['settings', 'notification', 'activity'] },
            'all-videos': { title: 'Video Library', categories: [], keywords: [] }
        };

        window.openVidPopup = function(sectionId, btn) {
            const config = sectionMap[sectionId] || { title: 'Suggested Videos', categories: [], keywords: [] };
            titleEl.textContent = config.title + ' — Suggested Videos';

            let suggestions;
            if (sectionId === 'all-videos') {
                suggestions = VIDEOS.slice(0, 8);
            } else {
                suggestions = VIDEOS.filter(function(v) {
                    if (config.categories.length && config.categories.indexOf(v.category) !== -1) return true;
                    if (config.keywords.length) {
                        const text = (v.title + ' ' + v.desc + ' ' + v.category).toLowerCase();
                        return config.keywords.some(function(k) { return text.indexOf(k) !== -1; });
                    }
                    return false;
                });
                if (suggestions.length < 3) {
                    const existing = new Set(suggestions.map(function(s) { return s.id; }));
                    VIDEOS.forEach(function(v) {
                        if (!existing.has(v.id) && suggestions.length < 8) {
                            suggestions.push(v);
                            existing.add(v.id);
                        }
                    });
                }
            }

            if (suggestions.length === 0) {
                listEl.innerHTML = '<div class="vid-popup-empty">No suggested videos available for this section.</div>';
            } else {
                listEl.innerHTML = suggestions.map(function(v) {
                    var badge = v.available
                        ? '<span class="vid-popup-badge available">Available</span>'
                        : '<span class="vid-popup-badge coming">Coming Soon</span>';
                    var href = v.available ? 'tutorials.php#' + v.id : 'javascript:void(0)';
                    var style = v.available ? '' : ' style="opacity:0.6;cursor:default;"';
                    return '<a class="vid-popup-item" href="' + href + '"' + style + '>' +
                        '<div class="vid-popup-thumb">' + thumbSvg + '</div>' +
                        '<div class="vid-popup-info"><h5>' + v.title + '</h5><p>' + v.desc + '</p></div>' +
                        badge + '</a>';
                }).join('');
            }

            overlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        };

        window.closeVidPopup = function() {
            overlay.classList.remove('open');
            document.body.style.overflow = '';
        };

        overlay.addEventListener('click', function(e) { if (e.target === overlay) closeVidPopup(); });
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape' && overlay.classList.contains('open')) closeVidPopup(); });
    })();
    </script>

    <!-- AI Assistant Widget -->
    <div class="ai-root">
        <button class="ai-fab" id="ai-fab" title="Ask AI Assistant" aria-label="Open AI Assistant">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="8" width="16" height="12" rx="3"/><circle cx="9" cy="14" r="1.2" fill="currentColor"/><circle cx="15" cy="14" r="1.2" fill="currentColor"/><path d="M12 8V4M9 4h6"/></svg>
        </button>
        <div class="ai-widget" id="ai-widget">
            <div class="ai-chat-header">
                <div class="ai-chat-header-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="8" width="16" height="12" rx="3"/><circle cx="9" cy="14" r="1.2" fill="currentColor"/><circle cx="15" cy="14" r="1.2" fill="currentColor"/><path d="M12 8V4M9 4h6"/></svg>
                </div>
                <div class="ai-chat-header-info">
                    <h3>DISPATCH AI</h3>
                    <p><span class="ai-status-dot"></span> Online</p>
                </div>
                <div class="ai-chat-header-actions">
                    <a href="ai-assistant.php" class="ai-header-btn" title="Open full page">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
                    </a>
                    <button class="ai-header-btn" onclick="document.getElementById('ai-widget').classList.remove('open')" title="Close">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
            <div class="ai-messages" id="ai-messages">
                <div class="ai-welcome" id="ai-welcome">
                    <div class="ai-welcome-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="8" width="16" height="12" rx="3"/><circle cx="9" cy="14" r="1.2" fill="currentColor"/><circle cx="15" cy="14" r="1.2" fill="currentColor"/><path d="M12 8V4M9 4h6"/></svg>
                    </div>
                    <h2>How can I help?</h2>
                    <p>Ask me about DISPATCH documentation, video tutorials, or video docs.</p>
                </div>
                <div class="ai-chips" id="ai-chips"></div>
            </div>
            <div class="ai-input-area">
                <div class="ai-input-row">
                    <button class="ai-mic-btn" id="ai-mic-btn" title="Voice input" aria-label="Voice input">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z"/><path d="M19 10v2a7 7 0 01-14 0v-2"/><path d="M12 19v4M8 23h8"/></svg>
                    </button>
                    <textarea class="ai-input" id="ai-input" placeholder="Ask me anything…" rows="1"></textarea>
                    <button class="ai-send-btn" id="ai-send-btn" title="Send" aria-label="Send" disabled>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="js/ai-assistant.js"></script>
    <script>
    (function(){
        const AI = window.DispatchAI;
        const fab = document.getElementById('ai-fab');
        const widget = document.getElementById('ai-widget');
        const messagesEl = document.getElementById('ai-messages');
        const welcomeEl = document.getElementById('ai-welcome');
        const chipsEl = document.getElementById('ai-chips');
        const inputEl = document.getElementById('ai-input');
        const sendBtn = document.getElementById('ai-send-btn');
        const micBtn = document.getElementById('ai-mic-btn');
        let messages = [];
        let isTyping = false;

        fab.addEventListener('click', function(){ widget.classList.toggle('open'); });

        function renderChips(){
            chipsEl.innerHTML = '';
            AI.QUICK_ACTIONS.forEach(function(a){
                const c = document.createElement('button');
                c.className = 'ai-chip';
                c.innerHTML = (AI.ICONS[a.icon]||'') + '<span>'+a.label+'</span>';
                c.addEventListener('click', function(){ inputEl.value = a.label; sendMessage(); });
                chipsEl.appendChild(c);
            });
        }
        function renderMessage(msg){
            const isUser = msg.role === 'user';
            const el = document.createElement('div');
            el.className = 'ai-msg ' + (isUser ? 'user' : 'bot');
            const avatar = document.createElement('div');
            avatar.className = 'ai-msg-avatar';
            avatar.innerHTML = isUser ? '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>' : AI.ICONS['sparkle'];
            const content = document.createElement('div');
            const bubble = document.createElement('div');
            bubble.className = 'ai-msg-bubble';
            bubble.textContent = msg.text;
            content.appendChild(bubble);
            if(!isUser && msg.actions && msg.actions.length > 0){
                const ae = document.createElement('div');
                ae.className = 'ai-msg-actions';
                msg.actions.forEach(function(a){
                    const b = document.createElement('a');
                    b.className = 'ai-action-btn';
                    b.href = a.href;
                    b.innerHTML = (AI.ICONS[a.icon]||'') + '<span>'+a.label+'</span>';
                    ae.appendChild(b);
                });
                content.appendChild(ae);
            }
            el.appendChild(avatar);
            el.appendChild(content);
            messagesEl.appendChild(el);
            messagesEl.scrollTop = messagesEl.scrollHeight;
        }
        function showTyping(){
            const e = document.createElement('div');
            e.className = 'ai-msg bot'; e.id = 'ai-typing-msg';
            e.innerHTML = '<div class="ai-msg-avatar">'+AI.ICONS['sparkle']+'</div><div><div class="ai-msg-bubble"><div class="ai-typing"><span></span><span></span><span></span></div></div></div>';
            messagesEl.appendChild(e);
            messagesEl.scrollTop = messagesEl.scrollHeight;
        }
        function hideTyping(){ const e = document.getElementById('ai-typing-msg'); if(e) e.remove(); }
        function sendMessage(){
            const text = inputEl.value.trim();
            if(!text || isTyping) return;
            if(welcomeEl) welcomeEl.style.display = 'none';
            if(chipsEl) chipsEl.style.display = 'none';
            const um = {role:'user',text:text};
            messages.push(um); renderMessage(um);
            inputEl.value = ''; inputEl.style.height = 'auto'; updateSendBtn();
            isTyping = true; showTyping();
            setTimeout(function(){
                hideTyping();
                const m = AI.findBestMatch(text) || AI.generateFallback(text);
                const bm = {role:'bot',text:m.description,actions:m.actions||[]};
                messages.push(bm); renderMessage(bm); AI.saveHistory(messages); isTyping = false;
            }, 600 + Math.random()*400);
        }
        function updateSendBtn(){ sendBtn.disabled = inputEl.value.trim().length === 0; }
        inputEl.addEventListener('input', function(){ this.style.height='auto'; this.style.height=Math.min(this.scrollHeight,100)+'px'; updateSendBtn(); });
        inputEl.addEventListener('keydown', function(e){ if(e.key==='Enter'&&!e.shiftKey){ e.preventDefault(); sendMessage(); } });
        sendBtn.addEventListener('click', sendMessage);
        if(!AI.isVoiceSupported()){ micBtn.classList.add('unsupported'); micBtn.title='Voice not supported'; }
        micBtn.addEventListener('click', function(){
            if(!AI.isVoiceSupported()) return;
            if(AI.isListening()){ AI.stopListening(); micBtn.classList.remove('listening'); }
            else { const s = AI.startListening(function(t){ inputEl.value=t; updateSendBtn(); inputEl.focus(); }, function(){ micBtn.classList.remove('listening'); }); if(s) micBtn.classList.add('listening'); }
        });
        function loadHistory(){
            const saved = AI.loadHistory();
            if(saved.length > 0){
                messages = saved;
                if(welcomeEl) welcomeEl.style.display = 'none';
                if(chipsEl) chipsEl.style.display = 'none';
                saved.forEach(renderMessage);
            }
        }
        renderChips();
        loadHistory();

        // Sync AI widget with page settings changes
        window.addEventListener('storage', function(e) {
            if (e.key === 'dispatch-settings' || e.key === 'dispatch-theme') {
                const root = document.querySelector('.ai-root');
                if (root) {
                    const accent = getComputedStyle(document.documentElement).getPropertyValue('--accent').trim();
                    if (accent) root.style.setProperty('--ai-accent', accent);
                }
            }
        });
    })();
    </script>
</body>
</html>