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
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Poppins', sans-serif;
            background:
                radial-gradient(ellipse at 10% 10%, color-mix(in srgb, var(--accent-2) 25%, transparent), transparent 50%),
                radial-gradient(ellipse at 90% 20%, color-mix(in srgb, var(--accent) 18%, transparent), transparent 50%),
                radial-gradient(ellipse at 50% 100%, color-mix(in srgb, var(--accent) 15%, transparent), transparent 45%),
                linear-gradient(160deg, #121b31 0%, #0b1020 55%, #070a12 100%);
            background-attachment: fixed;
            color: var(--text);
            min-height: 100vh;
        }
        .page { max-width: 1200px; margin: 0 auto; padding: 1.5rem; }
        .topbar {
            display: flex; align-items: center; justify-content: space-between;
            gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap;
        }
        .brand { display: flex; align-items: center; gap: 0.75rem; font-weight: 800; font-size: 1.2rem; }
        .brand a { display: flex; align-items: center; gap: 0.75rem; color: var(--text); text-decoration: none; }
        .brand-icon {
            width: 42px; height: 42px; border-radius: 14px;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            display: grid; place-items: center; color: #fff;
            box-shadow: 0 8px 22px -8px color-mix(in srgb, var(--accent) 60%, transparent), 0 0 0 1px rgba(255,255,255,0.1) inset;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            animation: brand-glow 2.5s ease-in-out infinite alternate;
        }
        @keyframes brand-glow {
            from { box-shadow: 0 8px 20px -8px color-mix(in srgb, var(--accent) 50%, transparent), 0 0 0 1px rgba(255,255,255,0.08) inset; }
            to { box-shadow: 0 10px 28px -6px color-mix(in srgb, var(--accent) 85%, transparent), 0 0 0 1px rgba(255,255,255,0.14) inset; }
        }
        .brand a:hover .brand-icon { transform: rotate(-6deg) scale(1.08); }
        .brand-icon svg { width: 22px; height: 22px; }
        .brand-text { display: flex; flex-direction: column; line-height: 1.15; }
        .brand-text small { font-size: 0.72rem; color: var(--text-dim); font-weight: 500; }
        .topbar-actions { display: flex; align-items: center; gap: 0.6rem; }
        .btn {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.55rem 1rem; border-radius: 12px; text-decoration: none;
            font-size: 0.85rem; font-weight: 600; border: 1px solid var(--border-strong);
            background: var(--surface); color: var(--text);
            transition: all 0.2s ease;
        }
        .btn:hover { background: var(--surface-2); border-color: var(--accent); }
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
            transition: all 0.2s ease; position: relative; overflow: hidden; cursor: pointer;
        }
        .doc-card:hover { transform: translateY(-4px); border-color: var(--accent); box-shadow: 0 20px 40px -20px rgba(0,0,0,0.35); }
        .doc-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, var(--accent), transparent); opacity: 0; transition: 0.2s;
        }
        .doc-card:hover::before { opacity: 1; }
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
            cursor: pointer; transition: all 0.15s ease;
        }
        .status-filter button:hover { border-color: var(--accent); color: var(--text); }
        .status-filter button.active { background: var(--accent); color: #fff; border-color: var(--accent); }
        .doc-actions a {
            padding: 0.45rem 0.9rem; border-radius: 10px; font-size: 0.8rem; font-weight: 600;
            text-decoration: none; transition: all 0.15s ease; border: 1px solid transparent;
        }
        .doc-actions a.watch { background: var(--accent); color: #fff; }
        .empty { text-align: center; padding: 3rem 1rem; color: var(--text-dim); display: none; }
        .empty.show { display: block; }
        footer { text-align: center; padding: 2rem 0; color: var(--text-dim); font-size: 0.8rem; border-top: 1px solid var(--border); margin-top: 2rem; }
        @media (max-width: 640px) { .docs-grid { grid-template-columns: 1fr; } .hero h1 { font-size: 1.5rem; } }

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
                linear-gradient(160deg, #0f1625 0%, #0a0f1a 60%, #070a12 100%);
            display: flex; flex-direction: column;
            color: var(--text);
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
        .dmh-btn.primary { background: var(--accent); color: #fff; border-color: var(--accent); }
        .dmh-btn:hover { border-color: var(--accent); }
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
        @media (max-width: 640px) {
            .doc-modal h2 { font-size: 1.6rem; }
            .doc-modal-body { padding: 2rem 1.25rem; }
            .doc-modal-header { padding: 0.85rem 1.25rem; }
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="topbar">
            <div class="brand">
                <a href="docs.php">
                    <span class="brand-icon">
                        <svg width="34" height="34" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            <path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </span>
                    <span class="brand-text">DISPATCH <small>Video Docs</small></span>
                </a>
            </div>
            <div class="topbar-actions">
                <a class="btn" href="docs.php">Back to Docs</a>
                <button class="btn" id="theme-btn" onclick="toggleTheme()">Toggle theme</button>
            </div>
        </div>

        <div class="hero">
            <h1>Video Documentation</h1>
            <p>Read in-depth documentation for every DISPATCH feature and module. Use the search to quickly find a feature.</p>
        </div>

        <div class="controls">
            <div class="search">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
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

    <div class="doc-modal-overlay" id="doc-modal-overlay">
        <div class="doc-modal" role="dialog" aria-modal="true" aria-label="Documentation view">
            <div class="doc-modal-header">
                <div class="dmh-brand">DISPATCH Video Docs</div>
                <div class="dmh-actions">
                    <a class="dmh-btn primary" href="#" id="doc-modal-watch" target="_blank">Watch tutorial</a>
                    <button class="dmh-btn" id="doc-modal-close" type="button">Close</button>
                </div>
            </div>
            <div class="doc-modal-body" id="doc-modal-body"></div>
        </div>
    </div>

    <script>
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
                    '</article>';
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

        // Theme support
        (function() {
            const saved = localStorage.getItem('dispatch-theme');
            if (saved === 'light') document.documentElement.classList.add('light');
            if (saved === 'dark') document.documentElement.classList.remove('light');
        })();
        function toggleTheme() {
            document.documentElement.classList.toggle('light');
            const isLight = document.documentElement.classList.contains('light');
            try { localStorage.setItem('dispatch-theme', isLight ? 'light' : 'dark'); } catch (e) {}
        }

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
    </script>
</body>
</html>
