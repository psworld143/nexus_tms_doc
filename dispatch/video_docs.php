<?php
// DISPATCH Video Documentation — read the purpose of every feature

// Security headers
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('X-XSS-Protection: 1; mode=block');
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src https://fonts.gstatic.com; media-src 'self'; img-src 'self' data:; connect-src 'self';");

// Full video catalog
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
    ['id' => 'drug-alcohol', 'title' => 'Drug & Alcohol', 'desc' => 'Testing programs and records', 'category' => 'Account', 'duration' => '—', 'src' => 'videos/drug-alcohol.mp4'],
    ['id' => 'documents', 'title' => 'Documents', 'desc' => 'Centralized document management', 'category' => 'Account', 'duration' => '—', 'src' => 'videos/documents.mp4'],
    ['id' => 'permit-insurance', 'title' => 'Permit & Insurance', 'desc' => 'Permits, licenses and insurance', 'category' => 'Account', 'duration' => '—', 'src' => 'videos/permit-insurance.mp4'],
    ['id' => 'reporting', 'title' => 'Reporting', 'desc' => 'Reports and operational insights', 'category' => 'Account', 'duration' => '—', 'src' => 'videos/reporting.mp4'],
    ['id' => 'safety', 'title' => 'Safety', 'desc' => 'Safety metrics and risk management', 'category' => 'Account', 'duration' => '—', 'src' => 'videos/safety.mp4'],
    ['id' => 'settings', 'title' => 'Settings', 'desc' => 'Configure and customize the system', 'category' => 'Account', 'duration' => '—', 'src' => 'videos/settings.mp4'],
    ['id' => 'login-signup-tutorial', 'title' => 'Login & Sign Up', 'desc' => 'Account creation and secure login', 'category' => 'Account', 'duration' => '—', 'src' => 'videos/login-signup-tutorial.mp4']
];

$videoDocs = [
    'dashboard' => 'The Dashboard is the central command center of DISPATCH. It gives you a real-time overview of your operations, including active loads, driver status, fleet health, and key performance indicators. Use it to monitor daily activity, identify bottlenecks, and make quick decisions without navigating through multiple screens.',
    'my-loads' => 'My Loads is where you create, assign, and track every shipment in your dispatch pipeline. You can build new loads, assign drivers and trucks, update statuses, and view load details from pickup to delivery. It keeps your operation organized and ensures loads move on time.',
    'my-trucks' => 'My Trucks lets you add, view, and manage all trucks in your fleet. Record vehicle details, maintenance history, assigned drivers, and lease or rental information so you always know which equipment is available and road-ready.',
    'my-trailers' => 'My Trailers gives you a dedicated view for managing trailers across your fleet. Track ownership, inspection dates, assignments, and capacity so dispatch and safety teams have accurate trailer data for every load.',
    'driver-devices' => 'Driver Devices helps you manage ELD connections, mobile devices, and other hardware your drivers use. It ensures devices are properly paired, synced, and compliant with logging and tracking requirements.',
    'my-drivers' => 'My Drivers is the hub for managing your driver workforce. Add driver profiles, store license and medical card details, track hiring status, and view assigned trucks so your team stays compliant and qualified.',
    'my-customers' => 'My Customers stores customer profiles, billing details, and contact information. Use it to keep track of shipping partners, invoice addresses, and special requirements for each customer.',
    'my-shippers-list' => 'My Shippers List centralizes your recurring shipping locations. Save shipper names, addresses, and contact details so dispatchers can quickly select origin points when building loads.',
    'my-consignee-lists' => 'My Consignee Lists stores all delivery destination information. Maintain consignee addresses, hours, and instructions to improve routing and reduce delivery errors.',
    'my-brokers' => 'My Brokers helps you add and manage freight broker relationships. Store broker names, contact info, and notes so your team can quickly reference broker details during load negotiations.',
    'truck-lease-pricing' => 'Truck Lease Pricing allows you to review and configure lease rates and payment terms for your equipment. Use it to compare lease options, set pricing, and understand the financial impact of each lease agreement.',
    'truck-rentals' => 'Truck Rentals manages rental equipment and contracts. Track rental periods, costs, and return dates so rented trucks stay integrated with dispatch and accounting.',
    'lease-agreements' => 'Lease Agreements lets you create, sign, and track lease documents digitally. Store signed contracts, renewal dates, and terms so fleet and finance teams always have the latest agreement details.',
    'hire-drivers' => 'Hire Drivers streamlines driver recruitment and onboarding. Track applicants, collect documents, schedule interviews, and move candidates through the hiring pipeline efficiently.',
    'job-postings' => 'Job Postings lets you create and manage driver job openings. Post openings, track applications, and update hiring status so your recruiting efforts stay organized and visible.',
    'external-drivers' => 'External Drivers helps you manage owner-operators and contracted drivers who are not direct employees. Track contact information, equipment, and independent contractor status alongside your fleet.',
    'shout-out-scripts' => 'Shout Out Scripts provides ready-made marketing and recruiting scripts. Use these templates for social media, email, or phone outreach to attract drivers and promote your brand.',
    'shout-out-vlogs' => 'Shout Out Vlogs offers video examples and walkthroughs for creating driver-focused content. Learn how to produce effective vlogs that showcase your fleet and recruit talent.',
    'accounting' => 'Accounting keeps your financial records organized. Track invoices, payments, expenses, and profit so your operation has a clear view of its financial health.',
    'my-payroll' => 'My Payroll lets you run and manage driver and staff payroll. Calculate pay, track hours, and process payments while staying aligned with accounting records.',
    'my-factoring-company' => 'My Factoring Company connects you to invoice factoring services. Manage factoring provider details, submit invoices, and track advances to improve cash flow.',
    'fuel-reports' => 'Fuel Reports shows fuel spending, usage trends, and efficiency analytics. Use this data to identify waste, optimize routes, and manage fuel card spending.',
    'my-fuel-cards' => 'My Fuel Cards lets you manage fuel card assignments and spending limits. Track cardholders, set limits, and monitor transactions to control fuel costs.',
    'loans-cash-advance' => 'Loans and Cash Advance helps you apply for and track working capital. Record loan details, repayment schedules, and advance requests so cash flow needs are documented.',
    'api-integration-keys' => 'API Integration Keys lets you generate and manage keys for connecting DISPATCH with other systems. Control access and track which integrations are active.',
    'my-fleet' => 'My Fleet provides a safety and compliance overview of all your vehicles and drivers. Track inspections, violations, CSA scores, and preventive maintenance to keep your fleet safe and roadworthy.',
    'emergency-monitoring' => 'Emergency Monitoring helps you set up and respond to critical driver and vehicle alerts. Configure notification rules, monitor panic events, and coordinate emergency response.',
    'safety-assessments' => 'Safety Assessments lets you run and review driver and vehicle safety reviews. Schedule assessments, record results, and take action on any safety concerns.',
    'maintenance-monitoring' => 'Maintenance Monitoring tracks vehicle health and service schedules. Log repairs, schedule preventive maintenance, and set reminders to keep equipment in top condition.',
    'safety-violations' => 'Safety Violations records and tracks incidents that affect your safety score. Review violation details, assign corrective actions, and monitor resolution progress.',
    'compliance-monitoring' => 'Compliance Monitoring gives you a real-time view of regulatory compliance. Track HOS, inspections, and certifications to avoid fines and out-of-service risk.',
    'compliance-software-options' => 'Compliance Software Options lets you explore and configure integrations with ELD and compliance tools. Choose the right providers and sync data for accurate compliance reporting.',
    'drug-alcohol-testing' => 'Drug and Alcohol Testing manages testing programs and driver records. Track testing schedules, results, and program membership to meet DOT and company requirements.',
    'violations' => 'Violations tracks all compliance-related incidents across your operation. Review details, assign responsibility, and manage the resolution process from a single view.',
    'driver-violations' => 'Driver Violations focuses on citations and incidents tied to individual drivers. Monitor driver history, take corrective action, and track improvements over time.',
    'vehicle-violations' => 'Vehicle Violations tracks citations and defects tied to specific trucks or trailers. Use it to prioritize repairs and improve your fleet roadside inspection record.',
    'hos' => 'HOS, or Hours of Service, tracks driver duty and rest rules. Monitor on-duty time, breaks, and daily limits to ensure compliance and prevent driver fatigue.',
    'notifications' => 'Notifications delivers real-time alerts for loads, drivers, vehicles, and compliance events. Customize what you receive so important updates never get missed.',
    'activity' => 'Activity keeps a detailed log of system events and user actions. Use it for auditing, troubleshooting, and understanding how your team uses DISPATCH.',
    'maintenance' => 'Maintenance schedules and tracks vehicle maintenance tasks. Plan oil changes, inspections, and repairs so your fleet stays reliable and compliant.',
    'drug-alcohol' => 'Drug and Alcohol records testing data and program details. Maintain DOT compliance by tracking testing status, results, and program enrollments.',
    'documents' => 'Documents gives you a centralized place to store and manage permits, licenses, insurance, and other important files. Organize files by driver or vehicle and access them quickly.',
    'permit-insurance' => 'Permit and Insurance tracks registration, permits, and insurance certificates. Store expiration dates and upload documents so your fleet never runs out of coverage.',
    'reporting' => 'Reporting provides pre-built and custom reports for operations, safety, and finance. Generate insights that help you make data-driven decisions.',
    'safety' => 'Safety is the central place for safety metrics and risk management. Monitor accident rates, training status, and violation trends to build a stronger safety culture.',
    'settings' => 'Settings lets you configure your DISPATCH experience. Manage users, preferences, notifications, and system-wide options to match your workflow.',
    'login-signup-tutorial' => 'Login and Sign Up walks new users through creating an account and signing in securely. Learn how to set credentials, recover access, and protect your account.'
];

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
    <title><?php echo $site; ?> Video Documentation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/video-card-animations.css">
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
            width: 42px; height: 42px; border-radius: 14px;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            display: grid; place-items: center; color: #fff;
            box-shadow: 0 6px 16px -8px color-mix(in srgb, var(--accent) 60%, transparent);
            transition: transform 0.2s ease;
        }
        .brand a:hover .brand-icon { transform: rotate(-6deg) scale(1.08); }
        .brand-icon svg { width: 20px; height: 20px; }
        .brand-text { display: flex; flex-direction: column; line-height: 1.15; }
        .brand-text h1 { font-size: 1.15rem; font-weight: 800; letter-spacing: -0.01em; line-height: 1.1; }
        .brand-text p { font-size: 0.72rem; color: var(--text-dim); font-weight: 500; }
        .topbar-actions { margin-left: auto; display: flex; align-items: center; gap: 0.6rem; }

        /* ===== Loading Screen ===== */
        .loader-screen {
            position: fixed; inset: 0; z-index: 9999;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            gap: 1.25rem; text-align: center;
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
            text-align: center;
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
            background: var(--surface); border: 1px solid var(--border);
            border-radius: var(--radius); padding: 2.5rem 2rem;
            margin-bottom: 2rem; text-align: center;
            backdrop-filter: blur(16px); box-shadow: var(--shadow);
        }
        .hero h1 { font-size: 2rem; margin-bottom: 0.5rem; }
        .hero p { color: var(--text-muted); max-width: 600px; margin: 0 auto; }
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
        @media (max-width: 640px) {
            .docs-grid { grid-template-columns: 1fr; }
            .hero h1 { font-size: 1.5rem; }
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
        .dmh-actions { display: flex; align-items: center; gap: 0.5rem; }
        .dmh-btn {
            padding: 0.5rem 1rem; border-radius: 10px; font-size: 0.8rem; font-weight: 600;
            text-decoration: none; border: 1px solid var(--border-strong); cursor: pointer;
            color: var(--text); background: var(--surface-2); transition: all 0.15s ease;
            font-family: inherit;
        }
        .dmh-btn.primary { background: var(--accent); color: #fff; border-color: var(--border-strong); }
        .dmh-btn:hover { border-color: var(--border-strong); }
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
        }
        .dm-suggest-card.disabled { opacity: 0.55; cursor: default; pointer-events: none; }
        .dm-suggest-thumb {
            width: 38px; height: 38px; border-radius: 9px;
            background: color-mix(in srgb, var(--accent) 15%, transparent);
            display: grid; place-items: center; flex-shrink: 0;
        }
        .dm-suggest-thumb svg { width: 17px; height: 17px; color: var(--accent); }
        .dm-suggest-info { flex: 1; min-width: 0; }
        .dm-suggest-info h5 { font-size: 0.82rem; font-weight: 600; margin: 0 0 0.15rem; color: var(--text); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .dm-suggest-info p { font-size: 0.7rem; color: var(--text-muted); margin: 0; line-height: 1.3; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
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

    <!-- Loading Screen -->
    <div class="loader-screen" id="loader-screen">
        <div class="loader-logo">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6"/><path d="M10 11l5 3-5 3z" fill="currentColor" stroke="none"/></svg>
        </div>
        <div class="loader-text">DISPATCH Video Docs</div>
        <div class="loader-bar"><div class="loader-bar-fill"></div></div>
    </div>

    <div class="page">
        <div class="topbar">
            <div class="brand">
                <a href="docs.php">
                    <span class="brand-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6"/><path d="M10 11l5 3-5 3z" fill="currentColor" stroke="none"/></svg>
                    </span>
                    <span class="brand-text"><h1>DISPATCH</h1><p>Video Docs</p></span>
                </a>
            </div>
            <div class="topbar-actions">
                <a href="tutorials.php" class="theme-btn shortcut-btn" title="Video Tutorials" style="text-decoration:none;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </a>
                <a href="docs.php" class="theme-btn shortcut-btn" title="Documentation" style="text-decoration:none;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 3H7a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V8z"/><path d="M14 3v5h5"/><path d="M9 13h6M9 17h6"/></svg>
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
            <h1>Video Documentation</h1>
            <p>Read in-depth documentation for every DISPATCH feature and module. Use the search to quickly find a feature.</p>
        </div>

        <div class="controls">
            <div class="search">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
                <input type="text" id="filter" placeholder="Filter features…" aria-label="Filter features">
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
            <div class="category-title">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 4H5m0 4h14M5 7h14"/></svg>
                <?php echo htmlspecialchars($category); ?>
                <span class="duration">(<?php echo count($videos); ?>)</span>
            </div>
            <div class="docs-grid">
                <?php foreach ($videos as $v):
                    $docText = isset($videoDocs[$v['id']]) ? $videoDocs[$v['id']] : $v['desc'];
                    $isAvailable = in_array($v['src'], $availableVideos);
                    $statusClass = $isAvailable ? 'available' : 'coming';
                    $statusText = $isAvailable ? 'Available' : 'Coming Soon';
                ?>
                <div class="doc-card" id="doc-<?php echo htmlspecialchars($v['id']); ?>" data-title="<?php echo htmlspecialchars(strtolower($v['title'] . ' ' . $docText)); ?>" data-status="<?php echo $statusClass; ?>" data-category="<?php echo htmlspecialchars($category); ?>">
                    <h3><?php echo htmlspecialchars($v['title']); ?></h3>
                    <p><?php echo htmlspecialchars($docText); ?></p>
                    <div class="doc-meta">
                        <span class="status-badge <?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                        <span class="duration"><?php echo htmlspecialchars($v['duration']); ?></span>
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
                <div class="dmh-brand"><svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L4.5 13.5h6L11 22l8.5-11.5h-6L13 2z"/></svg> DISPATCH Video Docs</div>
                <div class="dmh-actions">
                    <a class="dmh-btn primary" href="#" id="doc-modal-watch" target="_blank">Watch tutorial</a>
                    <button class="dmh-btn" id="doc-modal-close" type="button">Close</button>
                </div>
            </div>
            <div class="doc-modal-body" id="doc-modal-body"></div>
        </div>
    </div>

    <script>
        const ALL_VIDEOS = <?php echo json_encode(array_map(function($v) use ($availableVideos) {
            return [
                'id' => $v['id'],
                'title' => $v['title'],
                'desc' => $v['desc'],
                'category' => $v['category'],
                'duration' => $v['duration'],
                'available' => in_array($v['src'], $availableVideos)
            ];
        }, $videoCatalog)); ?>;

        // Build suggested videos HTML for the doc modal
        function buildSuggestedVideos(currentId, category) {
            const thumbSvg = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
            // Find related videos: same category first, then fill with others
            var sameCat = ALL_VIDEOS.filter(function(v) { return v.id !== currentId && v.category === category; });
            var others = ALL_VIDEOS.filter(function(v) { return v.id !== currentId && v.category !== category; });
            var suggestions = sameCat.concat(others).slice(0, 6);
            if (suggestions.length === 0) {
                return '<div class="dm-suggest"><div class="dm-suggest-empty">No suggested videos available.</div></div>';
            }
            var cards = suggestions.map(function(v) {
                var badge = v.available
                    ? '<span class="dm-suggest-badge available">Available</span>'
                    : '<span class="dm-suggest-badge coming">Coming Soon</span>';
                var disabled = v.available ? '' : ' disabled';
                var href = v.available ? 'tutorials.php#' + encodeURIComponent(v.id) : '#';
                return '<a class="dm-suggest-card' + disabled + '" href="' + href + '"' + (v.available ? ' target="_blank"' : '') + '>' +
                    '<div class="dm-suggest-thumb">' + thumbSvg + '</div>' +
                    '<div class="dm-suggest-info"><h5>' + v.title + '</h5><p>' + v.desc + '</p></div>' +
                    badge + '</a>';
            }).join('');
            return '<div class="dm-suggest">' +
                '<div class="dm-suggest-head">' +
                '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>' +
                'Suggested Videos' +
                '</div>' +
                '<div class="dm-suggest-grid">' + cards + '</div>' +
                '</div>';
        }

        // Documentation full-screen modal
        (function initDocModal() {
            const overlay = document.getElementById('doc-modal-overlay');
            const body = document.getElementById('doc-modal-body');
            const close = document.getElementById('doc-modal-close');
            if (!overlay || !body) return;

            function escapeHtml(str) {
                return String(str).replace(/[&<>"']/g, function (c) {
                    return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
                });
            }

            const watchLink = document.getElementById('doc-modal-watch');

            function openModal(card) {
                const id = card.id.replace('doc-', '');
                const title = card.querySelector('h3').textContent;
                const desc = card.querySelector('p').textContent;
                const category = card.dataset.category || '';
                const statusClass = card.dataset.status;
                const status = statusClass === 'available' ? 'Available' : 'Coming Soon';
                const duration = card.querySelector('.duration').textContent;
                const watchHref = 'tutorials.php#' + encodeURIComponent(id);
                if (watchLink) {
                    watchLink.href = watchHref;
                    watchLink.style.display = statusClass === 'available' ? '' : 'none';
                }
                body.innerHTML =
                    '<article class="doc-modal-article">' +
                    '<div class="dm-category">' + escapeHtml(category) + '</div>' +
                    '<h2>' + escapeHtml(title) + '</h2>' +
                    '<div class="dm-meta">' +
                        '<span class="status-badge ' + statusClass + '">' + status + '</span>' +
                        '<span class="duration">' + escapeHtml(duration) + '</span>' +
                    '</div>' +
                    '<p>' + escapeHtml(desc) + '</p>' +
                    '</article>' +
                    buildSuggestedVideos(id, category);
                overlay.classList.add('open');
                document.body.style.overflow = 'hidden';
            }

            window.openDocModal = function(el) { openModal(el); };
            window.closeDocModal = function() {
                overlay.classList.remove('open');
                document.body.style.overflow = '';
            };

            document.querySelectorAll('.doc-card').forEach(function(card) {
                card.addEventListener('click', function(e) {
                    if (e.target.closest('a') || e.target.closest('button')) return;
                    openModal(card);
                });
            });

            if (close) close.addEventListener('click', closeDocModal);
            overlay.addEventListener('click', function(e) { if (e.target === overlay) closeDocModal(); });
            document.addEventListener('keydown', function(e) { if (e.key === 'Escape' && overlay.classList.contains('open')) closeDocModal(); });
        })();

        // Scroll to doc card from URL hash and open its modal
        (function initHashScroll() {
            function scrollToDoc() {
                const hash = window.location.hash;
                if (!hash) return;
                const card = document.querySelector(hash);
                if (!card || !card.classList.contains('doc-card')) return;
                card.scrollIntoView({ behavior: 'smooth', block: 'center' });
                card.classList.add('doc-highlight');
                setTimeout(function() { card.classList.remove('doc-highlight'); }, 2500);
            }
            if (document.readyState === 'complete') scrollToDoc();
            else window.addEventListener('load', scrollToDoc);
        })();

        // Theme support
        function syncThemeFromStorage() {
            // Check dispatch-theme first, then dispatch-settings dark-mode
            const themeKey = localStorage.getItem('dispatch-theme');
            let isLight = (themeKey === 'light');
            if (!themeKey) {
                try {
                    const settings = JSON.parse(localStorage.getItem('dispatch-settings') || '{}');
                    isLight = (settings['dark-mode'] === false);
                } catch (e) {}
            }
            if (isLight) document.documentElement.classList.add('light');
            else document.documentElement.classList.remove('light');
            updateThemeIcons();
            updateBackgroundSVG();
        }
        function updateBackgroundSVG() {
            const isLight = document.documentElement.classList.contains('light');
            const darkSVG = document.getElementById('bg-svg-dark');
            const lightSVG = document.getElementById('bg-svg-light');
            if (darkSVG) darkSVG.style.display = isLight ? 'none' : 'block';
            if (lightSVG) lightSVG.style.display = isLight ? 'block' : 'none';
        }
        (function() {
            syncThemeFromStorage();
        })();
        function updateThemeIcons() {
            const isLight = document.documentElement.classList.contains('light');
            const moonIcon = document.querySelector('.theme-btn .moon-icon');
            const sunIcon = document.querySelector('.theme-btn .sun-icon');
            if (moonIcon && sunIcon) {
                moonIcon.style.display = isLight ? 'none' : 'block';
                sunIcon.style.display = isLight ? 'block' : 'none';
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
            updateThemeIcons();
            updateBackgroundSVG();
        }
        // Sync theme across tabs (dispatch-theme or dispatch-settings)
        window.addEventListener('storage', function(e) {
            if (e.key === 'dispatch-theme' || e.key === 'dispatch-settings') {
                syncThemeFromStorage();
                applySettingsToUI();
            }
        });

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
                const isDark = !document.documentElement.classList.contains('light');
                if (isDark) {
                    iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>';
                } else {
                    iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>';
                }
            } else if (opts.icon === 'reset') {
                iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>';
            } else if (opts.icon === 'sidebar') {
                iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>';
            } else {
                iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
            }
            if (opts.swatch) {
                swatchWrap.innerHTML = '<span class="announce-swatch" style="background:' + escapeHtml(opts.swatch) + '"></span>';
            } else {
                swatchWrap.innerHTML = '';
            }
            toast.classList.add('show');
            if (announceTimer) clearTimeout(announceTimer);
            announceTimer = setTimeout(function() { toast.classList.remove('show'); }, 2600);
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
                    updateThemeIcons();
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
            showAnnouncement('Accent color changed', { icon: 'palette', swatch: color });
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
            updateThemeIcons();
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
            updateThemeIcons();
            updateBackgroundSVG();
        }

        // Initialize settings on load
        applySettingsToUI();

        // Filter
        (function() {
            const input = document.getElementById('filter');
            const cards = Array.from(document.querySelectorAll('.doc-card'));
            const blocks = Array.from(document.querySelectorAll('.category-block'));
            const countEl = document.getElementById('count');
            const empty = document.getElementById('empty');

            const statusBtns = document.querySelectorAll('#status-filter button');
            let currentStatus = 'all';

            function applyFilter() {
                const t = input.value.trim().toLowerCase();
                let shown = 0;
                cards.forEach(function(c) {
                    const matchesTerm = !t || c.dataset.title.includes(t);
                    const matchesStatus = currentStatus === 'all' || c.dataset.status === currentStatus;
                    const show = matchesTerm && matchesStatus;
                    c.style.display = show ? '' : 'none';
                    if (show) shown++;
                });
                blocks.forEach(function(b) {
                    const visible = Array.from(b.querySelectorAll('.doc-card')).some(function(c) { return c.style.display !== 'none'; });
                    b.style.display = visible ? '' : 'none';
                });
                countEl.textContent = shown + ' feature' + (shown === 1 ? '' : 's') + (t || currentStatus !== 'all' ? ' matching' : '');
                empty.classList.toggle('show', shown === 0);
            }

            input.addEventListener('input', applyFilter);
            statusBtns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    statusBtns.forEach(function(b) { b.classList.remove('active'); });
                    btn.classList.add('active');
                    currentStatus = btn.dataset.filter;
                    applyFilter();
                });
            });
            applyFilter();
        })();

        // Hide loader on load
        window.addEventListener('load', function() {
            const loader = document.getElementById('loader-screen');
            if (loader) {
                setTimeout(function() { loader.classList.add('hidden'); }, 500);
            }
        });
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
