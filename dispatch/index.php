<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMPLIANCE - Video Tutorial Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background: #1e3a8a;
            padding: 1rem 2rem;
        }
        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .logo svg {
            width: 2rem;
            height: 2rem;
        }
        .main-content {
            display: flex;
            min-height: calc(100vh - 4rem);
        }
        .main-content.with-sidebar {
            padding-left: 280px;
        }
        .sidebar {
            position: fixed;
            left: 0;
            top: 4rem;
            width: 280px;
            height: calc(100vh - 4rem);
            background: white;
            overflow-y: auto;
        }
        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }
        .sidebar-header h2 {
            margin: 0;
            font-size: 1.25rem;
            color: #374151;
        }
        .sidebar-section {
            padding: 1rem 0;
        }
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar-menu-item {
            margin: 0;
        }
        .sidebar-menu-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            color: #4b5563;
            text-decoration: none;
            transition: all 0.2s;
        }
        .sidebar-menu-link:hover {
            background: #f3f4f6;
            color: #667eea;
        }
        .sidebar-menu-link.active {
            background: #f3f4f6;
            color: #667eea;
        }
        .sidebar-menu-link svg {
            width: 1.25rem;
            height: 1.25rem;
        }
        .sidebar-menu-link.has-submenu {
            justify-content: space-between;
        }
        .sidebar-menu-link.has-submenu > span {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .submenu-arrow {
            width: 1rem;
            height: 1rem;
            transition: transform 0.2s;
        }
        .sidebar-menu-link.expanded .submenu-arrow {
            transform: rotate(180deg);
        }
        .sidebar-submenu {
            list-style: none;
            padding: 0;
            margin: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        .sidebar-submenu.expanded {
            max-height: 500px;
        }
        .sidebar-submenu-item {
            padding: 0.5rem 0;
        }
        .sidebar-submenu-link {
            display: block;
            padding: 0.5rem 1.5rem 0.5rem 2.5rem;
            color: #6b7280;
            text-decoration: none;
            font-size: 0.875rem;
        }
        .sidebar-submenu-link:hover {
            color: #667eea;
        }
        .content-area {
            flex: 1;
            padding: 2rem;
        }
        .section-content {
            animation: fadeIn 0.3s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .section-header {
            margin-bottom: 1.5rem;
        }
        .section-header h2 {
            margin: 0;
            font-size: 2rem;
            color: #1f2937;
        }
        .section-header p {
            margin: 0.5rem 0 0;
            color: #6b7280;
        }
        video {
            background: #000;
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                COMPLIANCE
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content with-sidebar">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Navigation</h2>
            </div>
            
            <div class="sidebar-section">
                <ul class="sidebar-menu">
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link" onclick="showSection('login-signup-tutorial'); return false;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Login & Sign Up Tutorial
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link active" onclick="showSection('dashboard'); return false;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link" onclick="showSection('drivers'); return false;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Drivers
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link" onclick="showSection('fleet'); return false;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                            </svg>
                            Fleet
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link has-submenu" onclick="toggleSubmenu('violations-submenu', event); return false;">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                Violations
                            </span>
                            <svg class="submenu-arrow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </a>
                        <ul class="sidebar-submenu" id="violations-submenu">
                            <li class="sidebar-submenu-item">
                                <a href="#" class="sidebar-submenu-link" onclick="showSection('safety-violations'); return false;">
                                    Safety Violations
                                </a>
                            </li>
                            <li class="sidebar-submenu-item">
                                <a href="#" class="sidebar-submenu-link" onclick="showSection('driver-violations'); return false;">
                                    Driver Violations
                                </a>
                            </li>
                            <li class="sidebar-submenu-item">
                                <a href="#" class="sidebar-submenu-link" onclick="showSection('vehicle-violations'); return false;">
                                    Vehicle Violations
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link" onclick="showSection('notifications'); return false;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            Notifications
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link" onclick="showSection('activity'); return false;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Activity
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link" onclick="showSection('maintenance'); return false;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Maintenance
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link" onclick="showSection('drug-alcohol'); return false;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                            Drug & Alcohol
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link" onclick="showSection('documents'); return false;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Documents
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link" onclick="showSection('permit-insurance'); return false;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Permit and Insurance
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link" onclick="showSection('reporting'); return false;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Reporting
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link" onclick="showSection('safety'); return false;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Safety
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link" onclick="showSection('hos'); return false;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            HOS
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link" onclick="showSection('settings'); return false;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Settings
                        </a>
                    </li>
                </ul>
            </div>
            
        </aside>
        
        <!-- Content Area -->
        <div class="content-area">
            <!-- Section: Dashboard (Default) -->
          <div id="section-dashboard" class="section-content">
            
    <div class="section-header">
        <h2>Dashboard</h2>
        <p>Overview and Statistics</p>
    </div>

    <video controls style="width:100%;">
        <source src="Videos/dashboard.mp4" type="video/mp4">
    </video>

    <p style="color: #666; margin-top: 1rem; line-height: 1.6;">
        Learn how to navigate the dashboard, monitor compliance, access reports, and use the available system features.
    </p>
</div>

            <!-- Section: Drivers -->
            <div id="section-drivers" class="section-content" style="display:none;">
                <h2>Drivers</h2>

                <video controls style="width:100%;">
                    <source src="videos/drivers.mp4" type="video/mp4">
                </video>

                <p style="color: #666; margin-top: 1rem; line-height: 1.6;">
                    Manage driver profiles, track performance, and maintain compliance records.
                </p>
            </div>

            <!-- Section: Fleet -->
            <div id="section-fleet" class="section-content" style="display:none;">
                <h2>Fleet</h2>
                <video controls style="width:100%;">
                    <source src="videos/fleet.mp4" type="video/mp4">
                </video>

                <p style="color: #666; margin-top: 1rem; line-height: 1.6;">
                    Monitor and manage your entire fleet of vehicles efficiently.
                </p>
            </div>

            <!-- Section: Violations -->
            <div id="section-violations" class="section-content" style="display:none;">
                <h2>Violations</h2>
                <video controls style="width:100%;">
                    <source src="videos/violations.mp4" type="video/mp4">
                </video>

                <p style="color: #666; margin-top: 1rem; line-height: 1.6;">
                    Track and manage compliance violations across your operations.
                </p>
            </div>

            <!-- Section: Safety Violations -->
            <div id="section-safety-violations" class="section-content" style="display:none;">
                <h2>safety Violations</h2>
                <video controls style="width:100%;">
                    <source src="videos/safety violations.mp4" type="video/mp4">
                </video>

                <p style="color: #666; margin-top: 1rem; line-height: 1.6;">
                    Monitor safety-related violations and ensure regulatory compliance.
                </p>
            </div>

            <!-- Section: Driver Violations -->
            <div id="section-driver-violations" class="section-content" style="display:none;">
                <h2>Driver Violations</h2>
                <video controls style="width:100%;">
                    <source src="videos/driver-violations.mp4" type="video/mp4">
                </video>

                <p style="color: #666; margin-top: 1rem; line-height: 1.6;">
                    Track driver-specific violations and implement corrective actions.
                </p>
            </div>

            <!-- Section: Vehicle Violations -->
            <div id="section-vehicle-violations" class="section-content" style="display:none;">
                <h2>Vehicle Violations</h2>
                <video controls style="width:100%;">
                    <source src="videos/vehicle-violations.mp4" type="video/mp4">
                </video>

                <p style="color: #666; margin-top: 1rem; line-height: 1.6;">
                    Monitor vehicle-related violations and maintenance issues.
                </p>
            </div>

            <!-- Section: Notifications -->
            <div id="section-notifications" class="section-content" style="display:none;">
                <h2>Notifications</h2>
                <video controls style="width:100%;">
                    <source src="videos/notifications.mp4" type="video/mp4">
                </video>

                <p style="color: #666; margin-top: 1rem; line-height: 1.6;">
                    Stay informed with real-time alerts and system notifications.
                </p>
            </div>

            <!-- Section: Activity -->
            <div id="section-activity" class="section-content" style="display:none;">
                <h2>Activity</h2>
                <video controls style="width:100%;">
                    <source src="videos/activity.mp4" type="video/mp4">
                </video>

                <p style="color: #666; margin-top: 1rem; line-height: 1.6;">
                    View system activity logs and track user actions.
                </p>
            </div>

            <!-- Section: Maintenance -->
            <div id="section-maintenance" class="section-content" style="display:none;">
                <h2>Maintenance</h2>
                <video controls style="width:100%;">
                    <source src="videos/maintenance.mp4" type="video/mp4">
                </video>

                <p style="color: #666; margin-top: 1rem; line-height: 1.6;">
                    Schedule and track vehicle maintenance to ensure optimal performance.
                </p>
            </div>

            <!-- Section: Drug & Alcohol -->
            <div id="section-drug-alcohol" class="section-content" style="display:none;">
                <h2>Drug & Alcohol</h2>
                <video controls style="width:100%;">
                    <source src="videos/drug-alcohol.mp4" type="video/mp4">
                </video>

                <p style="color: #666; margin-top: 1rem; line-height: 1.6;">
                    Manage drug and alcohol testing programs and compliance records.
                </p>
            </div>

            <!-- Section: Documents -->
            <div id="section-documents" class="section-content" style="display:none;">
                <h2>Documents</h2>
                <video controls style="width:100%;">
                    <source src="videos/documents.mp4" type="video/mp4">
                </video>

                <p style="color: #666; margin-top: 1rem; line-height: 1.6;">
                    Store and manage all compliance documents in one centralized location.
                </p>
            </div>

            <!-- Section: Permit and Insurance -->
            <div id="section-permit-insurance" class="section-content" style="display:none;">
                <h2>Permit and Insurance</h2>
                <video controls style="width:100%;">
                    <source src="videos/permit-insurance.mp4" type="video/mp4">
                </video>

                <p style="color: #666; margin-top: 1rem; line-height: 1.6;">
                    Track permits, licenses, and insurance documentation for compliance.
                </p>
            </div>

            <!-- Section: Reporting -->
            <div id="section-reporting" class="section-content" style="display:none;">
                <h2>Reporting</h2>
                <video controls style="width:100%;">
                    <source src="videos/reporting.mp4" type="video/mp4">
                </video>

                <p style="color: #666; margin-top: 1rem; line-height: 1.6;">
                    Generate comprehensive reports for compliance and operational insights.
                </p>
            </div>

            <!-- Section: Safety -->
            <div id="section-safety" class="section-content" style="display:none;">
                <h2>Safety</h2>
                <video controls style="width:100%;">
                    <source src="videos/safety.mp4" type="video/mp4">
                </video>

                <p style="color: #666; margin-top: 1rem; line-height: 1.6;">
                    Monitor safety metrics and implement risk management strategies.
                </p>
            </div>

            <!-- Section: HOS -->
            <div id="section-hos" class="section-content" style="display:none;">
                <h2>HOS</h2>
                <video controls style="width:100%;">
                    <source src="videos/hos.mp4" type="video/mp4">
                </video>

                <p style="color: #666; margin-top: 1rem; line-height: 1.6;">
                    Track Hours of Service compliance and driver duty status.
                </p>
            </div>

            <!-- Section: Settings -->
            <div id="section-settings" class="section-content" style="display:none;">
                <h2>Settings</h2>
                <video controls style="width:100%;">
                    <source src="videos/settings.mp4" type="video/mp4">
                </video>

                <p style="color: #666; margin-top: 1rem; line-height: 1.6;">
                    Configure system settings and customize your experience.
                </p>
            </div>

            <!-- Section: Login & Sign Up Tutorial -->
      <div id="section-login-signup-tutorial" class="section-content" style="display:none;">
    <h2>Login & Sign Up Tutorial</h2>

    <video controls style="width:100%;">
        <source src="videos/login.mp4" type="video/mp4">
    </video>

    <p style="color: #666; margin-top: 1rem; line-height: 1.6;">
        Learn how to create an account and securely log in to the system.
    </p>
</div>
    </main>
    <script>
        // Show section
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.section-content').forEach(section => {
                section.style.display = 'none';
            });
            
            // Show selected section
            const targetSection = document.getElementById('section-' + sectionId);
            if (targetSection) {
                targetSection.style.display = 'block';
            }
            
            // Update active state in sidebar
            document.querySelectorAll('.sidebar-menu-link, .sidebar-submenu-link').forEach(link => {
                link.classList.remove('active');
            });
            event.target.classList.add('active');
        }

        // Toggle submenu
        function toggleSubmenu(submenuId, event) {
            event.preventDefault();
            event.stopPropagation();
            
            const submenu = document.getElementById(submenuId);
            const parentLink = event.currentTarget;
            
            if (submenu) {
                submenu.classList.toggle('expanded');
                parentLink.classList.toggle('expanded');
            }
        }

        // Handle video errors - show message if video doesn't exist
        document.addEventListener('DOMContentLoaded', function() {
            const videos = document.querySelectorAll('video');
            videos.forEach(video => {
                video.addEventListener('error', function() {
                    const container = video.parentElement;
                    container.innerHTML = '<p style="color: #666; padding: 20px; text-align: center;">No video available for this module.</p>';
                });
            });
        });
    </script>
</body>
</html>
