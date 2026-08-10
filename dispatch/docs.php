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
<html lang="en" class="dark">
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
            --header-h: 64px;
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

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Poppins', sans-serif;
            background:
                radial-gradient(1200px 600px at 80% -10%, rgba(16, 185, 129, 0.10), transparent 60%),
                radial-gradient(900px 500px at -10% 10%, rgba(56, 189, 248, 0.08), transparent 55%),
                linear-gradient(160deg, var(--bg-grad-1), var(--bg-grad-2));
            background-attachment: fixed;
            color: var(--text);
            min-height: 100vh;
            line-height: 1.6;
            overflow-x: hidden;
            position: relative;
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
        .loader-overlay {
            position: fixed; inset: 0;
            display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 1rem;
            background:
                radial-gradient(1200px 600px at 80% -10%, rgba(16, 185, 129, 0.10), transparent 60%),
                radial-gradient(900px 500px at -10% 10%, rgba(56, 189, 248, 0.08), transparent 55%),
                linear-gradient(160deg, var(--bg-grad-1), var(--bg-grad-2));
            background-attachment: fixed;
            z-index: 1000;
            transition: opacity 0.45s ease, visibility 0.45s ease;
        }
        .loader-overlay.hidden { opacity: 0; visibility: hidden; pointer-events: none; }
        .spinner {
            width: 44px; height: 44px;
            border: 3px solid color-mix(in srgb, var(--accent) 25%, transparent);
            border-top-color: var(--accent);
            border-radius: 50%;
            animation: spin 0.9s linear infinite;
        }
        .loader-overlay p { color: var(--text-muted); font-size: 0.85rem; margin: 0; }
        @keyframes spin { to { transform: rotate(360deg); } }

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
            border-bottom: 1px solid var(--border);
        }
        .brand {
            display: flex; align-items: center; gap: 0.75rem;
            text-decoration: none; color: inherit; flex-shrink: 0;
        }
        .brand-mark {
            width: 40px; height: 40px;
            border-radius: 12px;
            background: var(--accent);
            display: grid; place-items: center;
            color: #fff;
            box-shadow: 0 8px 24px -8px rgba(16, 185, 129, 0.5);
            flex-shrink: 0;
        }
        .brand-mark svg { width: 22px; height: 22px; }
        .brand-text h1 { font-size: 1.1rem; font-weight: 800; letter-spacing: 0.02em; }
        .brand-text p { font-size: 0.72rem; color: var(--text-muted); font-weight: 500; margin-top: -0.15rem; }

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
        .header-search:hover { border-color: var(--accent); color: var(--text); }
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
        .icon-btn:hover { background: var(--surface-2); border-color: var(--accent); color: var(--accent); transform: translateY(-2px); }
        .icon-btn svg { width: 20px; height: 20px; }
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
        .menu-btn { display: none; }

        /* Unique Back Button */
        .icon-btn.back-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: flex-start;
            gap: 0.45rem;
            width: 38px;
            padding: 0 0.65rem 0 0;
            border: none;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--accent), #059669);
            color: #fff;
            overflow: hidden;
            box-shadow: 0 4px 14px -4px color-mix(in srgb, var(--accent) 60%, transparent);
            transition: width 0.28s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.2s ease, transform 0.2s ease;
        }
        .icon-btn.back-btn svg {
            width: 18px; height: 18px;
            flex-shrink: 0;
            margin-left: 0.55rem;
            transition: transform 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .icon-btn.back-btn .back-label {
            font-size: 0.78rem; font-weight: 700; letter-spacing: 0.02em;
            white-space: nowrap;
            opacity: 0;
            transform: translateX(-10px);
            transition: opacity 0.2s ease, transform 0.25s ease;
        }
        .icon-btn.back-btn:hover {
            width: 95px;
            box-shadow: 0 6px 20px -4px color-mix(in srgb, var(--accent) 70%, transparent);
            transform: translateY(-1px);
        }
        .icon-btn.back-btn:hover svg { transform: translateX(-3px); }
        .icon-btn.back-btn:hover .back-label { opacity: 1; transform: translateX(0); }

        /* Layout */
        .layout {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: grid;
            grid-template-columns: 250px minmax(0, 1fr);
            gap: 2.5rem;
            align-items: start;
        }

        /* Sidebar — unique floating glass navigation */
        .sidebar {
            position: sticky;
            top: calc(var(--header-h) + 1.5rem);
            max-height: calc(100vh - var(--header-h) - 3rem);
            overflow-y: auto;
            padding: 1.5rem 1.25rem;
            background: color-mix(in srgb, var(--surface-solid) 72%, transparent);
            backdrop-filter: blur(22px) saturate(160%);
            -webkit-backdrop-filter: blur(22px) saturate(160%);
            border: 1px solid var(--border);
            border-radius: 24px;
            box-shadow: 0 24px 50px -20px rgba(0,0,0,0.45);
            scrollbar-width: thin;
        }
        .sidebar-group { margin-bottom: 1.75rem; }
        .sidebar-group:last-child { margin-bottom: 0; }
        .sidebar-label {
            font-size: 0.68rem; font-weight: 800; letter-spacing: 0.12em;
            text-transform: uppercase; color: var(--accent);
            margin-bottom: 0.75rem;
            padding: 0.35rem 0.65rem;
            display: flex; align-items: center; gap: 0.5rem;
        }
        .sidebar-label::before {
            content: '';
            width: 7px; height: 7px;
            border-radius: 50%;
            background: var(--accent);
            box-shadow: 0 0 8px var(--accent);
        }
        .sidebar-nav { list-style: none; display: flex; flex-direction: column; gap: 0.3rem; }
        .sidebar-nav a {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.7rem 0.85rem;
            border-radius: 14px;
            text-decoration: none;
            color: var(--text-muted);
            font-size: 0.88rem; font-weight: 500;
            border-left: none;
            transition: all 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            overflow: hidden;
        }
        .sidebar-nav a::after {
            content: '';
            position: absolute; left: 0; top: 0; bottom: 0;
            width: 3px; background: var(--accent); border-radius: 14px 0 0 14px;
            transform: scaleY(0);
            opacity: 0;
            transition: transform 0.2s ease, opacity 0.2s ease;
        }
        .sidebar-nav a svg { width: 18px; height: 18px; flex-shrink: 0; opacity: 0.75; color: var(--text-muted); }
        .sidebar-nav a:hover {
            background: var(--surface);
            color: var(--text);
            transform: translateX(4px);
        }
        .sidebar-nav a:hover svg { color: var(--text); opacity: 1; }
        .sidebar-nav a.active {
            background: var(--accent-soft);
            color: var(--accent);
            font-weight: 700;
            box-shadow: 0 0 0 1px color-mix(in srgb, var(--accent) 30%, transparent);
        }
        .sidebar-nav a.active svg { opacity: 1; color: var(--accent); }
        .sidebar-nav a.active::after { transform: scaleY(1); opacity: 1; }
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
            border-color: var(--accent);
            transform: translateY(-5px) scale(1.01);
            box-shadow: 0 24px 40px -20px rgba(0,0,0,0.45);
        }
        .doc-card:hover::before { opacity: 1; }
        .doc-card svg {
            width: 38px; height: 38px;
            color: var(--accent);
            margin-bottom: 1.1rem;
            transition: transform 0.25s ease;
        }
        .doc-card:hover svg { transform: scale(1.1) rotate(-4deg); }
        .doc-card h3 { font-size: 1.1rem; font-weight: 700; margin-bottom: 0.55rem; }
        .doc-card p { font-size: 0.88rem; color: var(--text-muted); line-height: 1.5; }

        /* Sections */
        .doc-section {
            background: color-mix(in srgb, var(--surface-solid) 55%, transparent);
            border: 1px solid var(--border);
            border-top: 2px solid color-mix(in srgb, var(--accent) 45%, transparent);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 1.75rem;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            scroll-margin-top: calc(var(--header-h) + 1.25rem);
            box-shadow: 0 16px 35px -20px rgba(0,0,0,0.35);
            transition: border-color 0.2s ease;
        }
        .doc-section:hover { border-color: color-mix(in srgb, var(--accent) 50%, transparent); }
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
            font-family: 'Courier New', monospace;
            font-size: 0.85em;
            color: var(--accent-2);
        }

        /* Code block */
        .code-block-wrap { position: relative; margin: 1rem 0; }
        .code-block {
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1rem;
            padding-right: 3rem;
            font-family: 'Courier New', monospace;
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
        .copy-btn:hover { color: var(--accent); border-color: var(--accent); }
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
        }
        .doc-nav-mobile a.active { background: var(--accent); color: #fff; border-color: var(--accent); }

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
            cursor: pointer; transition: all 0.15s ease;
        }
        .status-filter button:hover { border-color: var(--accent); color: var(--text); }
        .status-filter button.active { background: var(--accent); color: #fff; border-color: var(--accent); }
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
            border-color: var(--accent);
            transform: translateY(-2px);
        }
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
        .back-to-top:hover { border-color: var(--accent); color: var(--accent); }
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
                width: 300px; background: var(--surface-solid);
                border-right: 1px solid var(--border-strong);
                border-radius: 0 24px 24px 0;
                padding: 1.5rem; z-index: 260;
                transform: translateX(-100%);
                transition: transform 0.25s ease;
            }
            .sidebar.open { transform: translateX(0); }
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
    </style>
</head>
<body>

    <div class="loader-overlay" id="loader">
        <div class="spinner"></div>
        <p>Loading documentation…</p>
    </div>

    <a href="#main-content" class="skip-link">Skip to content</a>
    <div class="progress-bar" id="progress-bar"></div>

    <header class="header">
        <button class="icon-btn menu-btn" id="menu-btn" aria-label="Open navigation" title="Menu" aria-expanded="false" aria-controls="sidebar">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        <a href="index.php" class="brand">
            <span class="brand-mark">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
            </span>
            <span class="brand-text">
                <h1>DISPATCH</h1>
                <p>Documentation</p>
            </span>
        </a>
        <button class="header-search" id="search-trigger" aria-label="Search documentation">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
            <span>Search docs and videos…</span>
            <span class="kbd">⌘K</span>
        </button>
        <div class="header-actions">
            <a href="index.php" class="icon-btn back-btn" title="Back to Full Tutorial">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                <span class="back-label">Back</span>
            </a>
            <button class="icon-btn" onclick="toggleTheme()" title="Toggle theme" id="theme-btn">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
            </button>
        </div>
    </header>

    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <div class="layout">
        <aside class="sidebar" id="sidebar" aria-label="Documentation sections">
            <div class="sidebar-group">
                <div class="sidebar-label">Getting Started</div>
                <ul class="sidebar-nav" id="doc-nav">
                    <li><a href="#overview" data-section="overview"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Overview</a></li>
                    <li><a href="#security" data-section="security"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>Security Measures</a></li>
                </ul>
            </div>
            <div class="sidebar-group">
                <div class="sidebar-label">Video Library</div>
                <ul class="sidebar-nav">
                    <li><a href="#videos" data-section="videos"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>Video Module</a></li>
                    <li><a href="#all-videos" data-section="all-videos"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Video Catalog (<?php echo $totalVideos; ?>)</a></li>
                </ul>
            </div>
            <div class="sidebar-group">
                <div class="sidebar-label">Configuration</div>
                <ul class="sidebar-nav">
                    <li><a href="#settings" data-section="settings"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>Settings &amp; Accessibility</a></li>
                </ul>
            </div>
        </aside>

        <main class="content" id="main-content">
            <section class="doc-hero">
                <h2>System Documentation</h2>
                <p>Reference guide for the DISPATCH video tutorial library, UI/UX patterns, and security measures.</p>
                <div class="hero-stats">
                    <div class="hero-stat"><strong><?php echo $totalVideos; ?></strong><span>Total tutorials</span></div>
                    <div class="hero-stat"><strong><?php echo $totalAvailable; ?></strong><span>Available now</span></div>
                    <div class="hero-stat"><strong>6</strong><span>Categories covered</span></div>
                </div>
            </section>

            <nav class="doc-nav-mobile" id="doc-nav-mobile" aria-label="Quick jump">
                <a href="#overview" data-section="overview" class="active">Overview</a>
                <a href="#security" data-section="security">Security</a>
                <a href="#videos" data-section="videos">Videos</a>
                <a href="#all-videos" data-section="all-videos">Library</a>
                <a href="#settings" data-section="settings">Settings</a>
            </nav>

            <div class="doc-grid">
                <a href="#all-videos" class="doc-card">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <h3>Video Tutorials</h3>
                    <p>Browse, search, and watch tutorials with per-video progress, watch history, and favorites.</p>
                </a>
                <a href="#settings" class="doc-card">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <h3>Settings</h3>
                    <p>Dark mode, accent color, font size, playback speed, and accessibility toggles.</p>
                </a>
            </div>

            <section class="doc-section" id="overview">
                <h3><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Overview</h3>
                <p>The <strong>DISPATCH</strong> system is a training portal for dispatch management. It includes a video tutorial library (<code>dispatch/tutorials.php</code>), searchable documentation (<code>dispatch/index.php</code>), and a shared settings layer that persists user preferences in the browser's localStorage.</p>
                <p>Pages in the system share a unified visual identity: dark glassmorphism UI, smooth transitions, Poppins typography, and a consistent emerald accent color. Themes and settings are synchronized across pages via <code>dispatch-settings</code> in localStorage.</p>
            </section>

            <section class="doc-section" id="security">
                <h3><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>Security Measures</h3>
                <p>Recent hardening includes both server-side headers and client-side sanitization to prevent common web attacks.</p>
                <ul>
                    <li><strong>PHP security headers</strong> on <code>tutorials.php</code> and <code>index.php</code>: X-Frame-Options, X-Content-Type-Options, Referrer-Policy, X-XSS-Protection, and Content-Security-Policy.</li>
                    <li><strong>.htaccess rules</strong> in the document root disable directory listing, force HTTPS, block sensitive extensions, and prevent hotlinking of video files.</li>
                    <li><strong>HTML escaping</strong>: <code>escapeHtml()</code> is used before rendering any values into <code>innerHTML</code> to prevent stored and reflected XSS.</li>
                    <li><strong>localStorage validation</strong>: User data parsed from localStorage is filtered and validated to reject malformed structures.</li>
                </ul>
                <div class="code-block-wrap">
                    <div class="code-block" id="code-sample">// Example: escaping before innerHTML
card.innerHTML = '&lt;h3&gt;' + escapeHtml(v.title) + '&lt;/h3&gt;';</div>
                    <button class="copy-btn" id="copy-btn" title="Copy to clipboard" aria-label="Copy code">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </button>
                </div>
            </section>

            <section class="doc-section" id="videos">
                <h3><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>Video Module</h3>
                <p>The tutorial library renders a hardcoded list of training videos in <code>VIDEOS</code> JavaScript array. Each video has an <code>id</code>, <code>title</code>, <code>desc</code>, <code>category</code>, <code>src</code>, and <code>duration</code>.</p>
                <ul>
                    <li><strong>Availability</strong>: Only files listed in <code>AVAILABLE_VIDEOS</code> have a playable video. Others show a "Coming Soon" placeholder.</li>
                    <li><strong>Progress tracking</strong>: Watch progress is saved to localStorage by <code>video-id</code> and restored when the modal opens.</li>
                    <li><strong>Watch history &amp; favorites</strong>: Stored locally in the browser, with a shared settings system.</li>
                </ul>
            </section>

            <section class="doc-section" id="settings">
                <h3><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>Settings &amp; Accessibility</h3>
                <p>Settings are stored under the <code>dispatch-settings</code> localStorage key and shared across <code>index.php</code> and <code>tutorials.php</code>.</p>
                <ul>
                    <li><strong>Dark mode</strong>: toggles <code>html.dark</code> class and persists as <code>dispatch-theme</code>.</li>
                    <li><strong>Font size</strong>: base 15px, adjustable via range input. Large-text mode sets 18px.</li>
                    <li><strong>Playback speed</strong>: controls the modal video playback rate.</li>
                    <li><strong>Reduce motion</strong>: disables CSS animations for users with vestibular disorders.</li>
                    <li><strong>High contrast</strong>: increases contrast for better readability.</li>
                </ul>
            </section>

            <section class="doc-section" id="all-videos">
                <h3><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Video Library</h3>
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
                        $watchLink = $isAvailable ? '<a class="watch-link" href="tutorials.php#' . htmlspecialchars($v['id']) . '">Watch video &rarr;</a>' : '';
                        echo '<div class="video-item" data-status="' . $statusClass . '" data-title="' . htmlspecialchars(strtolower($v['title'] . ' ' . $v['desc'])) . '">';
                        echo '<h5>' . htmlspecialchars($v['title']) . '</h5>';
                        echo '<p>' . htmlspecialchars($v['desc']) . '</p>';
                        echo '<div class="video-meta-row">';
                        echo '<span class="video-status ' . $statusClass . '">' . $statusText . '</span>';
                        echo '<span class="video-duration">' . htmlspecialchars($v['duration']) . '</span>';
                        echo '</div>';
                        echo $watchLink;
                        echo '</div>';
                    }
                    echo '</div></div>';
                }
                ?>
                <p class="video-empty" id="video-empty">No videos match your search. Try a different keyword or filter.</p>
            </section>

            <footer class="footer">
                <p>&copy; DISPATCH Training Portal. Built with the same UI/UX as tutorials.php and index.php.</p>
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
            { id: 'overview', title: 'Overview', sub: 'DISPATCH system, tutorials.php, index.php, shared settings' },
            { id: 'security', title: 'Security Measures', sub: 'Headers, .htaccess, HTML escaping, localStorage validation' },
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
            document.documentElement.classList.toggle('dark', !!s['dark-mode']);
        }
        function toggleTheme() {
            document.documentElement.classList.toggle('dark');
            const isDark = document.documentElement.classList.contains('dark');
            try { localStorage.setItem('dispatch-theme', isDark ? 'dark' : 'light'); } catch (e) {}
            try {
                const raw = localStorage.getItem('dispatch-settings') || '{}';
                const s = Object.assign({ 'dark-mode': isDark }, JSON.parse(raw));
                s['dark-mode'] = isDark;
                localStorage.setItem('dispatch-settings', JSON.stringify(s));
            } catch (e) {}
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

        // ---- Scrollspy: highlight active nav link (sidebar + mobile pills) ----
        (function initScrollspy() {
            const sections = Array.from(document.querySelectorAll('.doc-section[id]'));
            const sidebarLinks = Array.from(document.querySelectorAll('.sidebar-nav a'));
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

            trigger.addEventListener('click', open);
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
            }, 350);
        });
    </script>
</body>
</html>