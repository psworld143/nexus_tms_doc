<?php
// Shared documentation data for DISPATCH.
// Used by: index.php (inline fullscreen doc modal), video_docs.php (doc cards + modal)
//
// Defines $videoCatalog (metadata for every feature/module) and $videoDocs
// (long-form documentation text keyed by module id). Include this file once
// before using either array.

if (!isset($videoCatalog)) {
    $videoCatalog = [
        ['id' => 'dashboard', 'title' => 'Dashboard', 'desc' => 'Overview and statistics walkthrough', 'category' => 'Main', 'duration' => '2:30', 'src' => 'videos/dashboard.mp4'],
        ['id' => 'my-loads', 'title' => 'My Loads', 'desc' => 'Create, assign and track loads through dispatch', 'category' => 'Operations', 'duration' => '', 'src' => 'videos/my-loads.mp4'],
        ['id' => 'my-trucks', 'title' => 'My Trucks', 'desc' => 'Add, view and manage your trucks', 'category' => 'Operations', 'duration' => '', 'src' => 'videos/my-trucks.mp4'],
        ['id' => 'my-trailers', 'title' => 'My Trailers', 'desc' => 'Add, view and manage your trailers', 'category' => 'Operations', 'duration' => '', 'src' => 'videos/my-trailers.mp4'],
        ['id' => 'driver-devices', 'title' => 'Driver Devices', 'desc' => 'Manage driver devices and ELD connections', 'category' => 'Operations', 'duration' => '', 'src' => 'videos/driver-devices.mp4'],
        ['id' => 'my-drivers', 'title' => 'My Drivers', 'desc' => 'View and manage your drivers', 'category' => 'Operations', 'duration' => '3:45', 'src' => 'videos/how-to-register-new-drivers.mp4'],
        ['id' => 'my-customers', 'title' => 'My Customers', 'desc' => 'Add, view and manage your customers', 'category' => 'Operations', 'duration' => '', 'src' => 'videos/my-customers.mp4'],
        ['id' => 'my-shippers-list', 'title' => 'My Shippers List', 'desc' => 'Manage your list of shippers', 'category' => 'Operations', 'duration' => '', 'src' => 'videos/my-shippers-list.mp4'],
        ['id' => 'my-consignee-lists', 'title' => 'My Consignee Lists', 'desc' => 'Manage your consignee lists and locations', 'category' => 'Operations', 'duration' => '', 'src' => 'videos/my-consignee-lists.mp4'],
        ['id' => 'my-brokers', 'title' => 'My Brokers', 'desc' => 'Add and manage your brokers', 'category' => 'Operations', 'duration' => '', 'src' => 'videos/my-brokers.mp4'],
        ['id' => 'truck-lease-pricing', 'title' => 'Truck Lease Pricing', 'desc' => 'Review and configure lease pricing', 'category' => 'Fleet', 'duration' => '', 'src' => 'videos/truck-lease-pricing.mp4'],
        ['id' => 'truck-rentals', 'title' => 'Truck Rentals', 'desc' => 'Manage truck rentals and equipment', 'category' => 'Fleet', 'duration' => '', 'src' => 'videos/truck-rentals.mp4'],
        ['id' => 'lease-agreements', 'title' => 'Lease Agreements', 'desc' => 'Create, sign and track lease agreements', 'category' => 'Fleet', 'duration' => '', 'src' => 'videos/lease-agreements.mp4'],
        ['id' => 'hire-drivers', 'title' => 'Hire Drivers', 'desc' => 'Recruit and onboard new drivers', 'category' => 'Fleet', 'duration' => '', 'src' => 'videos/hire-drivers.mp4'],
        ['id' => 'job-postings', 'title' => 'Job Postings', 'desc' => 'Create and manage driver job postings', 'category' => 'Fleet', 'duration' => '', 'src' => 'videos/job-postings.mp4'],
        ['id' => 'external-drivers', 'title' => 'External Drivers', 'desc' => 'Manage external and owner-operator drivers', 'category' => 'Fleet', 'duration' => '', 'src' => 'videos/external-drivers.mp4'],
        ['id' => 'shout-out-scripts', 'title' => 'Shout Out Scripts', 'desc' => 'Ready-made scripts for your marketing', 'category' => 'Fleet', 'duration' => '', 'src' => 'videos/shout-out-scripts.mp4'],
        ['id' => 'shout-out-vlogs', 'title' => 'Shout Out Vlogs', 'desc' => 'Shout out vlog examples and walkthroughs', 'category' => 'Fleet', 'duration' => '', 'src' => 'videos/shout-out-vlogs.mp4'],
        ['id' => 'accounting', 'title' => 'Accounting', 'desc' => 'Manage accounting and financial records', 'category' => 'Finance', 'duration' => '', 'src' => 'videos/accounting.mp4'],
        ['id' => 'my-payroll', 'title' => 'My Payroll', 'desc' => 'Run and manage payroll', 'category' => 'Finance', 'duration' => '', 'src' => 'videos/my-payroll.mp4'],
        ['id' => 'my-factoring-company', 'title' => 'My Factoring Company', 'desc' => 'Connect and manage your factoring company', 'category' => 'Finance', 'duration' => '', 'src' => 'videos/my-factoring-company.mp4'],
        ['id' => 'fuel-reports', 'title' => 'Fuel Reports', 'desc' => 'View fuel spending reports and analytics', 'category' => 'Finance', 'duration' => '', 'src' => 'videos/fuel-reports.mp4'],
        ['id' => 'my-fuel-cards', 'title' => 'My Fuel Cards', 'desc' => 'Manage fuel cards and spending limits', 'category' => 'Finance', 'duration' => '', 'src' => 'videos/my-fuel-cards.mp4'],
        ['id' => 'loans-cash-advance', 'title' => 'Loans/Cash Advance', 'desc' => 'Apply for and track loans and cash advances', 'category' => 'Finance', 'duration' => '', 'src' => 'videos/loans-cash-advance.mp4'],
        ['id' => 'api-integration-keys', 'title' => 'API Integration Keys', 'desc' => 'Generate and manage API integration keys', 'category' => 'Finance', 'duration' => '', 'src' => 'videos/api-integration-keys.mp4'],
        ['id' => 'my-fleet', 'title' => 'My Fleet', 'desc' => 'Monitor your fleet safety and compliance', 'category' => 'Safety', 'duration' => '', 'src' => 'videos/my-fleet.mp4'],
        ['id' => 'emergency-monitoring', 'title' => 'Emergency Monitoring', 'desc' => 'Set up and respond to emergency alerts', 'category' => 'Safety', 'duration' => '', 'src' => 'videos/emergency-monitoring.mp4'],
        ['id' => 'safety-assessments', 'title' => 'Safety Assessments', 'desc' => 'Run and review safety assessments', 'category' => 'Safety', 'duration' => '', 'src' => 'videos/safety-assessments.mp4'],
        ['id' => 'maintenance-monitoring', 'title' => 'Maintenance Monitoring', 'desc' => 'Monitor maintenance and vehicle health', 'category' => 'Safety', 'duration' => '', 'src' => 'videos/maintenance-monitoring.mp4'],
        ['id' => 'safety-violations', 'title' => 'Safety Violations', 'desc' => 'Safety-related compliance issues', 'category' => 'Safety', 'duration' => '', 'src' => 'videos/safety-violations.mp4'],
        ['id' => 'compliance-monitoring', 'title' => 'Compliance Monitoring', 'desc' => 'Track compliance metrics in real time', 'category' => 'Compliance', 'duration' => '', 'src' => 'videos/compliance-monitoring.mp4'],
        ['id' => 'compliance-software-options', 'title' => 'Compliance Software Options', 'desc' => 'Explore compliance software integrations', 'category' => 'Compliance', 'duration' => '', 'src' => 'videos/compliance-software-options.mp4'],
        ['id' => 'drug-alcohol-testing', 'title' => 'Drug & Alcohol Testing', 'desc' => 'Manage drug and alcohol testing programs', 'category' => 'Compliance', 'duration' => '', 'src' => 'videos/drug-alcohol-testing.mp4'],
        ['id' => 'violations', 'title' => 'Violations', 'desc' => 'Track compliance violations', 'category' => 'Compliance', 'duration' => '', 'src' => 'videos/violations.mp4'],
        ['id' => 'driver-violations', 'title' => 'Driver Violations', 'desc' => 'Driver-specific violations', 'category' => 'Compliance', 'duration' => '', 'src' => 'videos/driver-violations.mp4'],
        ['id' => 'vehicle-violations', 'title' => 'Vehicle Violations', 'desc' => 'Vehicle-related violations', 'category' => 'Compliance', 'duration' => '', 'src' => 'videos/vehicle-violations.mp4'],
        ['id' => 'hos', 'title' => 'HOS', 'desc' => 'Hours of Service compliance', 'category' => 'Compliance', 'duration' => '', 'src' => 'videos/hos.mp4'],
        ['id' => 'notifications', 'title' => 'Notifications', 'desc' => 'Real-time alerts and updates', 'category' => 'Account', 'duration' => '', 'src' => 'videos/notifications.mp4'],
        ['id' => 'activity', 'title' => 'Activity', 'desc' => 'System activity logs', 'category' => 'Account', 'duration' => '', 'src' => 'videos/activity.mp4'],
        ['id' => 'maintenance', 'title' => 'Maintenance', 'desc' => 'Vehicle maintenance scheduling', 'category' => 'Account', 'duration' => '', 'src' => 'videos/maintenance.mp4'],
        ['id' => 'drug-alcohol', 'title' => 'Drug & Alcohol', 'desc' => 'Testing programs and records', 'category' => 'Account', 'duration' => '', 'src' => 'videos/drug-alcohol.mp4'],
        ['id' => 'documents', 'title' => 'Documents', 'desc' => 'Centralized document management', 'category' => 'Account', 'duration' => '', 'src' => 'videos/documents.mp4'],
        ['id' => 'permit-insurance', 'title' => 'Permit & Insurance', 'desc' => 'Permits, licenses and insurance', 'category' => 'Account', 'duration' => '', 'src' => 'videos/permit-insurance.mp4'],
        ['id' => 'reporting', 'title' => 'Reporting', 'desc' => 'Reports and operational insights', 'category' => 'Account', 'duration' => '', 'src' => 'videos/reporting.mp4'],
        ['id' => 'safety', 'title' => 'Safety', 'desc' => 'Safety metrics and risk management', 'category' => 'Account', 'duration' => '', 'src' => 'videos/safety.mp4'],
        ['id' => 'settings', 'title' => 'Settings', 'desc' => 'Configure and customize the system', 'category' => 'Account', 'duration' => '', 'src' => 'videos/settings.mp4'],
        ['id' => 'login-signup-tutorial', 'title' => 'Login & Sign Up', 'desc' => 'Account creation and secure login', 'category' => 'Account', 'duration' => '', 'src' => 'videos/login-signup-tutorial.mp4']
    ];
}

if (!isset($videoDocs)) {
    $videoDocs = [
        // ===== Main =====
        'dashboard' => '<h3>Overview</h3>
<p>The <strong>Dashboard</strong> is the central command center of DISPATCH. It provides a real-time overview of your entire operation, including active loads, driver status, fleet health, compliance alerts, and key performance indicators. Use it to monitor daily activity, identify bottlenecks, and make quick decisions without navigating through multiple screens.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Real-time Stats</strong>: View active loads, available drivers, and fleet status at a glance.</li>
<li><strong>Compliance Alerts</strong>: See immediate warnings for HOS violations, expired permits, and pending inspections.</li>
<li><strong>Quick Actions</strong>: Jump directly to creating a load, adding a driver, or scheduling maintenance.</li>
<li><strong>Performance KPIs</strong>: Track on-time delivery rate, revenue, and fuel efficiency trends.</li>
<li><strong>Recent Activity</strong>: Review the latest system events, status changes, and user actions.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Log in to DISPATCH. The Dashboard loads automatically as your home screen.</li>
<li>Review the top stat cards for a snapshot of today\'s operation, active loads, available drivers, and fleet status.</li>
<li>Check the <strong>Compliance Alerts</strong> panel for any items needing immediate attention, such as HOS violations or expired documents.</li>
<li>Use the <code>Quick Actions</code> bar to jump to common tasks like <code>Add Load</code> or <code>Add Driver</code>.</li>
<li>Scroll to the <strong>Performance KPIs</strong> section to review trends over the past week or month.</li>
<li>Use the sidebar to navigate to any module for detailed management.</li>
</ol>

<blockquote><strong>Tip:</strong> Check the Dashboard every morning to identify issues before they escalate. Address compliance alerts first, they can lead to fines or out-of-service orders if ignored.</blockquote>

<h3>Who Uses This</h3>
<p>The Dashboard is designed for <strong>dispatchers</strong>, <strong>fleet managers</strong>, and <strong>company owners</strong> who need a high-level view of operations before diving into specific modules.</p>',

        // ===== Operations =====
        'my-loads' => '<h3>Overview</h3>
<p><strong>My Loads</strong> is where you create, assign, and track every shipment in your dispatch pipeline. Build new loads, assign drivers and trucks, update statuses, and view load details from pickup to delivery. It keeps your operation organized and ensures loads move on time.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Load Creation</strong>: Build detailed loads with pickup/delivery locations, dates, rates, and commodity info.</li>
<li><strong>Driver & Truck Assignment</strong>: Assign available drivers and equipment to each load with a few clicks.</li>
<li><strong>Status Tracking</strong>: Update load status from <code>Dispatched</code> to <code>Picked Up</code> to <code>Delivered</code> in real time.</li>
<li><strong>Load Details</strong>: View bill of lading numbers, stop sequences, mileage, and special instructions.</li>
<li><strong>Filter & Search</strong>: Filter loads by status, date, driver, or customer to find what you need fast.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Click <code>Add Load</code> in the My Loads section to open the load creation form.</li>
<li>Enter the <strong>shipper</strong>, <strong>consignee</strong>, pickup and delivery addresses, and scheduled dates.</li>
<li>Fill in the <strong>commodity</strong>, <strong>weight</strong>, and any special handling instructions.</li>
<li>Set the <strong>rate</strong> and payment terms (broker, customer, or factoring).</li>
<li>Assign a <strong>driver</strong> and <strong>truck/trailer</strong> from the available dropdowns.</li>
<li>Click <code>Save Load</code> to dispatch it. The load now appears in your active list.</li>
<li>Update the status as the load progresses: <code>Dispatched</code> → <code>En Route</code> → <code>Picked Up</code> → <code>Delivered</code>.</li>
</ol>

<blockquote><strong>Tip:</strong> Always verify driver HOS availability before assigning a load. DISPATCH will warn you if a driver is near their duty limit, but the final check is yours.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Dispatchers</strong> use My Loads daily to build and track shipments. <strong>Fleet managers</strong> monitor load assignments to ensure balanced utilization, and <strong>accountants</strong> reference completed loads for billing.</p>',

        'my-trucks' => '<h3>Overview</h3>
<p><strong>My Trucks</strong> lets you add, view, and manage all trucks in your fleet. Record vehicle details, maintenance history, assigned drivers, and lease or rental information so you always know which equipment is available and road-ready.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Vehicle Profiles</strong>: Store VIN, make, model, year, plate number, and gross weight for each truck.</li>
<li><strong>Assignment Tracking</strong>: See which driver is currently assigned to each truck.</li>
<li><strong>Maintenance History</strong>: Log repairs, inspections, and preventive maintenance schedules.</li>
<li><strong>Lease & Rental Info</strong>: Track whether a truck is owned, leased, or rented, with contract details.</li>
<li><strong>Status Indicators</strong>: Quickly see if a truck is <code>Active</code>, <code>In Maintenance</code>, or <code>Out of Service</code>.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Navigate to <strong>My Trucks</strong> from the sidebar.</li>
<li>Click <code>Add Truck</code> to create a new vehicle profile.</li>
<li>Enter the <strong>VIN</strong>, <strong>make</strong>, <strong>model</strong>, <strong>year</strong>, and <strong>plate number</strong>.</li>
<li>Set the truck status to <code>Active</code> and assign a driver if applicable.</li>
<li>Upload insurance and registration documents in the <strong>Documents</strong> tab.</li>
<li>Use the <code>Edit</code> button to update maintenance records or change assignment.</li>
<li>Filter by status to see only available trucks when assigning loads.</li>
</ol>

<blockquote><strong>Tip:</strong> Keep maintenance records up to date. A truck with an expired inspection can be placed out of service during a DOT roadside check, costing you a load and a fine.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Fleet managers</strong> use My Trucks to track equipment health and availability. <strong>Dispatchers</strong> reference it when assigning loads, and <strong>safety officers</strong> review maintenance records for compliance audits.</p>',

        'my-trailers' => '<h3>Overview</h3>
<p><strong>My Trailers</strong> gives you a dedicated view for managing trailers across your fleet. Track ownership, inspection dates, assignments, and capacity so dispatch and safety teams have accurate trailer data for every load.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Trailer Profiles</strong>: Store trailer type (dry van, reefer, flatbed, tanker), VIN, and plate number.</li>
<li><strong>Capacity Tracking</strong>: Record maximum weight and volume capacity for each trailer.</li>
<li><strong>Assignment Status</strong>: See which truck and driver are currently paired with each trailer.</li>
<li><strong>Inspection Records</strong>: Track annual inspections and DOT compliance dates.</li>
<li><strong>Ownership Type</strong>: Mark trailers as owned, leased, or rented with contract details.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>My Trailers</strong> from the sidebar.</li>
<li>Click <code>Add Trailer</code> to create a new profile.</li>
<li>Select the <strong>trailer type</strong> and enter the <strong>VIN</strong> and <strong>plate number</strong>.</li>
<li>Set the <strong>capacity</strong> (max weight and dimensions) for load matching.</li>
<li>Assign the trailer to a truck if it has a permanent pairing.</li>
<li>Update the <strong>inspection date</strong> and upload inspection reports.</li>
<li>Use filters to find available trailers by type when building loads.</li>
</ol>

<blockquote><strong>Tip:</strong> Match trailer type to commodity before assigning a load. A reefer trailer assigned to a dry freight load wastes capacity, while a dry van assigned to temperature-sensitive freight can ruin the cargo.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Fleet managers</strong> and <strong>dispatchers</strong> use My Trailers to ensure the right equipment is paired with each load. <strong>Safety officers</strong> track inspection dates for DOT compliance.</p>',

        'driver-devices' => '<h3>Overview</h3>
<p><strong>Driver Devices</strong> helps you manage ELD connections, mobile devices, and other hardware your drivers use. It ensures devices are properly paired, synced, and compliant with FMCSA logging and tracking requirements.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Device Registry</strong>: Track ELDs, tablets, and mobile phones assigned to each driver.</li>
<li><strong>Pairing Status</strong>: See whether a device is <code>Paired</code>, <code>Syncing</code>, or <code>Offline</code>.</li>
<li><strong>Compliance Monitoring</strong>: Verify that ELDs are transmitting HOS data as required by FMCSA.</li>
<li><strong>Firmware & Software Versions</strong>: Track which version of the ELD app each device is running.</li>
<li><strong>Troubleshooting Tools</strong>: View sync errors and connection logs to resolve device issues fast.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Driver Devices</strong> from the sidebar.</li>
<li>Click <code>Add Device</code> to register a new ELD or tablet.</li>
<li>Select the <strong>driver</strong> and enter the <strong>device serial number</strong> and <strong>type</strong>.</li>
<li>Check the <strong>pairing status</strong>: if it shows <code>Offline</code>, instruct the driver to restart the device.</li>
<li>Review the <strong>sync log</strong> for any errors or gaps in HOS data transmission.</li>
<li>Update the firmware version field after a device update to keep records current.</li>
</ol>

<blockquote><strong>Tip:</strong> An ELD that has not synced in 24 hours is a compliance risk. Address offline devices immediately, FMCSA requires HOS data to be available during inspections.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Fleet managers</strong> and <strong>compliance officers</strong> use Driver Devices to ensure ELD compliance. <strong>IT support</strong> uses it for troubleshooting device connectivity issues.</p>',

        'my-drivers' => '<h3>Overview</h3>
<p><strong>My Drivers</strong> is the hub for managing your driver workforce. Add driver profiles, store license and medical card details, track hiring status, and view assigned trucks so your team stays compliant and qualified.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Driver Profiles</strong>: Store name, contact info, CDL class, license number, and expiration dates.</li>
<li><strong>Compliance Documents</strong>: Track medical card, MVR reports, and drug test enrollment status.</li>
<li><strong>Assignment Tracking</strong>: See which truck and loads are currently assigned to each driver.</li>
<li><strong>Hiring Status</strong>: Track applicants through the hiring pipeline from <code>Applied</code> to <code>Hired</code>.</li>
<li><strong>HOS Summary</strong>: View each driver\'s current duty status and available hours.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Navigate to <strong>My Drivers</strong> from the sidebar.</li>
<li>Click <code>Add Driver</code> to create a new profile.</li>
<li>Enter the driver\'s <strong>name</strong>, <strong>phone</strong>, <strong>CDL number</strong>, and <strong>CDL class</strong>.</li>
<li>Upload the <strong>medical card</strong> and set its expiration date, DISPATCH will alert you before it expires.</li>
<li>Set the driver status to <code>Active</code> and assign a truck if available.</li>
<li>Review the <strong>HOS Summary</strong> tab before assigning loads to ensure the driver has available hours.</li>
<li>Use the search bar to find drivers by name or license number.</li>
</ol>

<blockquote><strong>Tip:</strong> Set expiration alerts for CDLs and medical cards at least 30 days in advance. A driver with an expired medical card cannot legally operate a commercial vehicle.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Dispatchers</strong> use My Drivers to assign loads and check availability. <strong>Fleet managers</strong> track assignments and compliance, and <strong>HR</strong> manages the hiring pipeline.</p>',

        'my-customers' => '<h3>Overview</h3>
<p><strong>My Customers</strong> stores customer profiles, billing details, and contact information. Use it to keep track of shipping partners, invoice addresses, and special requirements for each customer.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Customer Profiles</strong>: Store company name, contact person, phone, email, and billing address.</li>
<li><strong>Payment Terms</strong>: Track net-30, net-60, or custom payment terms for each customer.</li>
<li><strong>Load History</strong>: View all loads associated with a customer in one place.</li>
<li><strong>Special Instructions</strong>: Save routing notes, delivery requirements, and preferred drivers.</li>
<li><strong>Outstanding Balances</strong>: See unpaid invoices and aging reports per customer.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>My Customers</strong> from the sidebar.</li>
<li>Click <code>Add Customer</code> to create a new profile.</li>
<li>Enter the <strong>company name</strong>, <strong>contact person</strong>, <strong>phone</strong>, and <strong>email</strong>.</li>
<li>Fill in the <strong>billing address</strong> and set the <strong>payment terms</strong>.</li>
<li>Add any <strong>special instructions</strong> such as delivery time windows or preferred drivers.</li>
<li>Click <code>Save</code>. The customer now appears when building loads.</li>
<li>Use the <strong>Load History</strong> tab to review past shipments for that customer.</li>
</ol>

<blockquote><strong>Tip:</strong> Keep customer special instructions updated. A customer who requires a 2-hour delivery window will penalize or reject loads that arrive outside it.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Dispatchers</strong> use My Customers when building loads. <strong>Accountants</strong> reference billing details for invoicing, and <strong>sales</strong> tracks customer relationships and load history.</p>',

        'my-shippers-list' => '<h3>Overview</h3>
<p><strong>My Shippers List</strong> centralizes your recurring shipping locations. Save shipper names, addresses, and contact details so dispatchers can quickly select origin points when building loads.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Shipper Directory</strong>: Store names, addresses, phone numbers, and email for every origin point.</li>
<li><strong>Loading Instructions</strong>: Save dock numbers, loading hours, and check-in procedures.</li>
<li><strong>Quick Selection</strong>: Shippers appear as dropdown options when creating loads.</li>
<li><strong>Geographic Search</strong>: Find shippers by city, state, or zip code for route planning.</li>
<li><strong>Notes & History</strong>: Track past pickups and any issues at each location.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>My Shippers List</strong> from the sidebar.</li>
<li>Click <code>Add Shipper</code> to create a new entry.</li>
<li>Enter the <strong>company name</strong>, <strong>address</strong>, <strong>city</strong>, <strong>state</strong>, and <strong>zip code</strong>.</li>
<li>Add the <strong>contact person</strong> and <strong>phone number</strong> for the shipping dock.</li>
<li>Fill in <strong>loading hours</strong> and any <strong>check-in instructions</strong>.</li>
<li>Click <code>Save</code>. The shipper now appears in the dropdown when building loads.</li>
</ol>

<blockquote><strong>Tip:</strong> Save loading hours for every shipper. Dispatchers can then avoid assigning pickup times when the dock is closed, preventing costly detention.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Dispatchers</strong> use the Shippers List daily when building loads. <strong>Route planners</strong> use it to identify recurring pickup locations and optimize lanes.</p>',

        'my-consignee-lists' => '<h3>Overview</h3>
<p><strong>My Consignee Lists</strong> stores all delivery destination information. Maintain consignee addresses, hours, and instructions to improve routing and reduce delivery errors.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Consignee Directory</strong>: Store names, addresses, and contacts for every delivery location.</li>
<li><strong>Delivery Hours</strong>: Track receiving dock hours and appointment requirements.</li>
<li><strong>Delivery Instructions</strong>: Save gate codes, check-in procedures, and unloading requirements.</li>
<li><strong>Quick Selection</strong>: Consignees appear as dropdown options when creating loads.</li>
<li><strong>Delivery History</strong>: View past deliveries to each location for reference.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>My Consignee Lists</strong> from the sidebar.</li>
<li>Click <code>Add Consignee</code> to create a new entry.</li>
<li>Enter the <strong>company name</strong>, <strong>address</strong>, <strong>city</strong>, <strong>state</strong>, and <strong>zip code</strong>.</li>
<li>Add the <strong>receiving dock contact</strong> and <strong>phone number</strong>.</li>
<li>Fill in <strong>delivery hours</strong> and any <strong>appointment requirements</strong>.</li>
<li>Save gate codes or special unloading instructions in the <strong>Notes</strong> field.</li>
<li>Click <code>Save</code>. The consignee is now available when building loads.</li>
</ol>

<blockquote><strong>Tip:</strong> Note whether a consignee requires an appointment. Delivering without one can result in refused freight and a return trip, costing you time and money.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Dispatchers</strong> use the Consignee List when building loads and planning routes. <strong>Drivers</strong> reference delivery instructions and gate codes from the load details.</p>',

        'my-brokers' => '<h3>Overview</h3>
<p><strong>My Brokers</strong> helps you add and manage freight broker relationships. Store broker names, contact info, and notes so your team can quickly reference broker details during load negotiations.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Broker Profiles</strong>: Store company name, MC number, contact person, phone, and email.</li>
<li><strong>Rate History</strong>: Track average rates negotiated with each broker per lane.</li>
<li><strong>Payment Performance</strong>: Note how quickly each broker pays and any past issues.</li>
<li><strong>Quick Reference</strong>: Brokers appear when building brokered loads.</li>
<li><strong>Notes & Ratings</strong>: Rate broker reliability and save notes for future negotiations.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>My Brokers</strong> from the sidebar.</li>
<li>Click <code>Add Broker</code> to create a new profile.</li>
<li>Enter the <strong>company name</strong>, <strong>MC number</strong>, <strong>contact person</strong>, and <strong>phone</strong>.</li>
<li>Add the <strong>email</strong> for load confirmations and document submission.</li>
<li>Set a <strong>rating</strong> based on payment speed and reliability.</li>
<li>Use the <strong>Notes</strong> field to record rate trends or special terms.</li>
<li>Click <code>Save</code>. The broker now appears when creating brokered loads.</li>
</ol>

<blockquote><strong>Tip:</strong> Track payment performance for every broker. A broker that consistently pays late can hurt your cash flow, consider factoring those invoices or renegotiating terms.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Dispatchers</strong> and <strong>load planners</strong> use My Brokers when booking freight. <strong>Accountants</strong> reference broker details for invoicing and payment tracking.</p>',

        'hire-drivers' => '<h3>Overview</h3>
<p><strong>Hire Drivers</strong> streamlines driver recruitment and onboarding. Track applicants, collect documents, schedule interviews, and move candidates through the hiring pipeline efficiently.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Applicant Pipeline</strong>: Track candidates from <code>Applied</code> to <code>Interview</code> to <code>Hired</code>.</li>
<li><strong>Document Collection</strong>: Request and store CDL, MVR, and medical card before onboarding.</li>
<li><strong>Interview Scheduling</strong>: Schedule and track interview dates and notes.</li>
<li><strong>Background Checks</strong>: Track background check and drug test status for each applicant.</li>
<li><strong>Onboarding Checklist</strong>: Ensure new hires complete all required steps before their first load.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Hire Drivers</strong> from the sidebar.</li>
<li>Click <code>Add Applicant</code> to create a new candidate profile.</li>
<li>Enter the applicant\'s <strong>name</strong>, <strong>phone</strong>, <strong>email</strong>, and <strong>experience level</strong>.</li>
<li>Move the applicant to <code>Interview</code> status and schedule an interview date.</li>
<li>After the interview, request <strong>CDL</strong>, <strong>MVR</strong>, and <strong>medical card</strong> uploads.</li>
<li>Initiate a <strong>background check</strong> and <strong>drug test</strong> from the applicant profile.</li>
<li>Once all checks pass, move to <code>Hired</code> and complete the onboarding checklist.</li>
</ol>

<blockquote><strong>Tip:</strong> Start the background check and drug test as early as possible. These can take 3-7 days, and a delay means a longer wait before the driver can take their first load.</blockquote>

<h3>Who Uses This</h3>
<p><strong>HR managers</strong> and <strong>recruiters</strong> use Hire Drivers to manage the hiring pipeline. <strong>Fleet managers</strong> review new hires and assignments.</p>',

        // ===== Fleet =====
        'truck-lease-pricing' => '<h3>Overview</h3>
<p><strong>Truck Lease Pricing</strong> allows you to review and configure lease rates and payment terms for your equipment. Use it to compare lease options, set pricing, and understand the financial impact of each lease agreement.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Lease Rate Management</strong>: Set weekly or monthly lease rates per truck or trailer.</li>
<li><strong>Term Configuration</strong>: Define lease duration, down payment, and balloon payment terms.</li>
<li><strong>Cost Comparison</strong>: Compare leasing vs. buying scenarios side by side.</li>
<li><strong>Driver Settlement Integration</strong>: Link lease payments to driver settlements for owner-operators.</li>
<li><strong>Financial Projections</strong>: Project total lease cost over the contract term including fees.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Truck Lease Pricing</strong> from the sidebar.</li>
<li>Select a truck from the dropdown or click <code>Add Lease Rate</code> for new equipment.</li>
<li>Enter the <strong>weekly or monthly rate</strong>, <strong>term length</strong>, and <strong>down payment</strong>.</li>
<li>Add any <strong>balloon payment</strong> or <strong>buyout option</strong> at end of term.</li>
<li>Review the <strong>total cost projection</strong> to understand the full financial commitment.</li>
<li>Click <code>Save</code> to apply the pricing. It will link to the truck\'s profile and driver settlements.</li>
</ol>

<blockquote><strong>Tip:</strong> Compare the total lease cost against projected revenue for that truck. If the lease payment exceeds 25% of expected weekly revenue, consider a longer term or a different truck.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Fleet managers</strong> and <strong>finance teams</strong> use Truck Lease Pricing to evaluate equipment costs. <strong>Company owners</strong> review projections before signing lease agreements.</p>',

        'truck-rentals' => '<h3>Overview</h3>
<p><strong>Truck Rentals</strong> manages rental equipment and contracts. Track rental periods, costs, and return dates so rented trucks stay integrated with dispatch and accounting.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Rental Contracts</strong>: Store rental company, contract number, start/end dates, and rate.</li>
<li><strong>Cost Tracking</strong>: Log daily, weekly, or monthly rental costs per truck.</li>
<li><strong>Return Management</strong>: Track return dates and avoid late fees with reminders.</li>
<li><strong>Dispatch Integration</strong>: Rented trucks appear in My Trucks and can be assigned to loads.</li>
<li><strong>Damage & Inspection Logs</strong>: Record pre- and post-rental inspection photos and notes.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Truck Rentals</strong> from the sidebar.</li>
<li>Click <code>Add Rental</code> to create a new rental contract.</li>
<li>Enter the <strong>rental company</strong>, <strong>truck details</strong>, and <strong>contract number</strong>.</li>
<li>Set the <strong>start date</strong>, <strong>end date</strong>, and <strong>rental rate</strong> (daily/weekly/monthly).</li>
<li>Upload the <strong>pre-rental inspection</strong> photos to document existing damage.</li>
<li>Assign the rented truck to loads via <strong>My Loads</strong>: it appears as available equipment.</li>
<li>Before the return date, complete a <strong>post-rental inspection</strong> and log any new damage.</li>
</ol>

<blockquote><strong>Tip:</strong> Set a reminder 3 days before the rental return date. This gives you time to schedule the return inspection and avoid late fees, which can be $50-$100 per day.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Fleet managers</strong> use Truck Rentals to manage short-term equipment needs. <strong>Dispatchers</strong> assign rented trucks to loads, and <strong>accountants</strong> track rental costs.</p>',

        'lease-agreements' => '<h3>Overview</h3>
<p><strong>Lease Agreements</strong> lets you create, sign, and track lease documents digitally. Store signed contracts, renewal dates, and terms so fleet and finance teams always have the latest agreement details.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Digital Contract Storage</strong>: Upload and organize signed lease PDFs for every truck or trailer.</li>
<li><strong>Renewal Tracking</strong>: Set reminders for lease expirations and renewal windows.</li>
<li><strong>Term Details</strong>: Store payment amounts, frequency, term length, and buyout options.</li>
<li><strong>Party Information</strong>: Track lessor and lessee contact details for each agreement.</li>
<li><strong>Status Management</strong>: Mark agreements as <code>Active</code>, <code>Expiring</code>, or <code>Expired</code>.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Lease Agreements</strong> from the sidebar.</li>
<li>Click <code>Add Agreement</code> to create a new lease record.</li>
<li>Select the <strong>truck or trailer</strong> from your fleet that this agreement covers.</li>
<li>Enter the <strong>lessor name</strong>, <strong>start date</strong>, <strong>end date</strong>, and <strong>payment terms</strong>.</li>
<li>Upload the <strong>signed contract PDF</strong> for digital storage.</li>
<li>Set a <strong>renewal reminder</strong> 30-60 days before expiration.</li>
<li>Update the status to <code>Active</code> once the agreement is signed.</li>
</ol>

<blockquote><strong>Tip:</strong> Review expiring leases 60 days in advance. This gives you time to negotiate better terms, return the equipment, or purchase it at the buyout price.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Fleet managers</strong> track lease terms and renewals. <strong>Finance teams</strong> reference payment schedules, and <strong>company owners</strong> review agreements before renewal decisions.</p>',

        'job-postings' => '<h3>Overview</h3>
<p><strong>Job Postings</strong> lets you create and manage driver job openings. Post openings, track applications, and update hiring status so your recruiting efforts stay organized and visible.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Job Listing Creation</strong>: Post openings with title, requirements, pay range, and location.</li>
<li><strong>Application Tracking</strong>: View and manage applications from each posting.</li>
<li><strong>Status Management</strong>: Mark postings as <code>Open</code>, <code>Filled</code>, or <code>Closed</code>.</li>
<li><strong>Multi-Platform Posting</strong>: Share postings to job boards and social media.</li>
<li><strong>Applicant Pipeline</strong>: Move applicants from <code>Applied</code> to <code>Interview</code> to <code>Hired</code>.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Job Postings</strong> from the sidebar.</li>
<li>Click <code>Create Posting</code> to open the job listing form.</li>
<li>Enter the <strong>job title</strong> (e.g., "CDL-A Company Driver"), <strong>requirements</strong>, and <strong>pay range</strong>.</li>
<li>Specify the <strong>route type</strong> (OTR, regional, local) and <strong>home time policy</strong>.</li>
<li>Click <code>Publish</code> to make the posting visible to applicants.</li>
<li>Review applications in the <strong>Applicants</strong> tab and move qualified candidates to <code>Interview</code>.</li>
<li>Update the posting to <code>Filled</code> once the position is hired.</li>
</ol>

<blockquote><strong>Tip:</strong> Include pay range and home time policy in every posting. These are the top two factors drivers consider, vague postings receive fewer qualified applications.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Recruiters</strong> and <strong>HR managers</strong> use Job Postings to manage open positions. <strong>Fleet managers</strong> review postings to ensure requirements match fleet needs.</p>',

        'external-drivers' => '<h3>Overview</h3>
<p><strong>External Drivers</strong> helps you manage owner-operators and contracted drivers who are not direct employees. Track contact information, equipment, and independent contractor status alongside your fleet.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Contractor Profiles</strong>: Store name, MC number, insurance info, and contract terms.</li>
<li><strong>Equipment Tracking</strong>: Record the contractor\'s truck and trailer details.</li>
<li><strong>Settlement Management</strong>: Track percentage or flat-rate pay per load for each contractor.</li>
<li><strong>Insurance Compliance</strong>: Monitor certificate of insurance (COI) expiration dates.</li>
<li><strong>1099 Tracking</strong>: Track annual contractor earnings for tax reporting.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>External Drivers</strong> from the sidebar.</li>
<li>Click <code>Add Contractor</code> to create a new profile.</li>
<li>Enter the <strong>name</strong>, <strong>MC number</strong>, <strong>phone</strong>, and <strong>email</strong>.</li>
<li>Record their <strong>truck and trailer</strong> details in the equipment section.</li>
<li>Upload their <strong>certificate of insurance</strong> and set the expiration date.</li>
<li>Configure the <strong>settlement terms</strong>: percentage of load revenue or flat rate.</li>
<li>Assign loads to the contractor via <strong>My Loads</strong>: they appear alongside company drivers.</li>
</ol>

<blockquote><strong>Tip:</strong> Verify the contractor\'s COI before assigning any loads. If their insurance lapses and they get in an accident, your company could be held liable for damages.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Dispatchers</strong> assign loads to external drivers. <strong>Fleet managers</strong> track contractor compliance, and <strong>accountants</strong> manage settlements and 1099 reporting.</p>',

        'shout-out-scripts' => '<h3>Overview</h3>
<p><strong>Shout Out Scripts</strong> provides ready-made marketing and recruiting scripts. Use these templates for social media, email, or phone outreach to attract drivers and promote your brand.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Script Library</strong>: Browse pre-written scripts for recruiting, marketing, and customer outreach.</li>
<li><strong>Category Filters</strong>: Filter by purpose: driver recruitment, customer acquisition, social media.</li>
<li><strong>Customizable Templates</strong>: Edit scripts with your company name, pay, and benefits.</li>
<li><strong>Multi-Channel Formats</strong>: Scripts formatted for phone calls, emails, texts, and social posts.</li>
<li><strong>Performance Notes</strong>: Track which scripts generate the most responses.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Shout Out Scripts</strong> from the sidebar.</li>
<li>Browse the script library or use the <strong>category filter</strong> to find recruiting or marketing scripts.</li>
<li>Click a script to view the full text.</li>
<li>Click <code>Customize</code> to replace placeholders with your company name, pay rate, and benefits.</li>
<li>Copy the script to use in an email, social media post, or phone call.</li>
<li>Save your customized version for future use.</li>
</ol>

<blockquote><strong>Tip:</strong> Test different recruiting scripts and track which ones generate the most applications. A script that mentions home time and sign-on bonuses typically outperforms generic ones.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Recruiters</strong> and <strong>marketing teams</strong> use Shout Out Scripts for driver acquisition. <strong>Company owners</strong> use them for brand promotion and customer outreach.</p>',

        'shout-out-vlogs' => '<h3>Overview</h3>
<p><strong>Shout Out Vlogs</strong> offers video examples and walkthroughs for creating driver-focused content. Learn how to produce effective vlogs that showcase your fleet and recruit talent.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Vlog Examples</strong>: Watch sample vlogs from successful trucking companies.</li>
<li><strong>Production Guides</strong>: Step-by-step instructions for filming, editing, and publishing.</li>
<li><strong>Content Ideas</strong>: Browse topics that resonate with drivers: pay, home time, equipment tours.</li>
<li><strong>Platform Tips</strong>: Best practices for YouTube, TikTok, and Facebook video.</li>
<li><strong>Template Scripts</strong>: Ready-to-use narration scripts for your vlogs.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Shout Out Vlogs</strong> from the sidebar.</li>
<li>Browse the vlog library and watch example videos.</li>
<li>Review the <strong>production guide</strong> for tips on lighting, audio, and editing.</li>
<li>Select a <strong>content idea</strong> that fits your recruiting goals.</li>
<li>Use the provided <strong>template script</strong> as a starting point for your narration.</li>
<li>Film your vlog, edit it, and publish to your preferred platform.</li>
</ol>

<blockquote><strong>Tip:</strong> Authentic content outperforms polished ads. Show real drivers, real trucks, and real pay. Drivers trust transparency over production value.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Marketing teams</strong> and <strong>recruiters</strong> use Shout Out Vlogs to create content that attracts drivers. <strong>Company owners</strong> use vlogs to build brand awareness.</p>',

        'my-fleet' => '<h3>Overview</h3>
<p><strong>My Fleet</strong> provides a safety and compliance overview of all your vehicles and drivers. Track inspections, violations, CSA scores, and preventive maintenance to keep your fleet safe and roadworthy.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Fleet Dashboard</strong>: View overall fleet health, active vehicles, and out-of-service units.</li>
<li><strong>CSA Score Tracking</strong>: Monitor your Compliance, Safety, Accountability scores by category.</li>
<li><strong>Inspection Calendar</strong>: Track annual and DOT inspection dates for every vehicle.</li>
<li><strong>Violation Alerts</strong>: Receive alerts for expired registrations, inspections, or permits.</li>
<li><strong>Maintenance Overview</strong>: See which trucks are due for preventive maintenance.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>My Fleet</strong> from the sidebar.</li>
<li>Review the <strong>fleet dashboard</strong> for an overview of vehicle status and health.</li>
<li>Check the <strong>CSA Scores</strong> section for any categories above the intervention threshold.</li>
<li>Review the <strong>inspection calendar</strong> for upcoming or overdue inspections.</li>
<li>Address any <strong>violation alerts</strong> immediately to avoid fines or out-of-service orders.</li>
<li>Use the <strong>maintenance overview</strong> to schedule preventive service for due vehicles.</li>
</ol>

<blockquote><strong>Tip:</strong> A CSA score in the Unsafe Driving or Hours-of-Service categories above 65% triggers FMCSA intervention. Monitor these scores weekly and address issues before they escalate.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Fleet managers</strong> and <strong>safety officers</strong> use My Fleet to monitor compliance and vehicle health. <strong>Company owners</strong> review CSA scores and fleet status for strategic decisions.</p>',

        // ===== Finance =====
        'accounting' => '<h3>Overview</h3>
<p><strong>Accounting</strong> keeps your financial records organized. Track invoices, payments, expenses, and profit so your operation has a clear view of its financial health.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Invoice Management</strong>: Create, send, and track customer invoices with due dates and status.</li>
<li><strong>Expense Tracking</strong>: Log fuel, maintenance, payroll, and overhead expenses by category.</li>
<li><strong>Profit & Loss Reports</strong>: View revenue vs. expenses by week, month, or quarter.</li>
<li><strong>Accounts Receivable</strong>: Track outstanding invoices and aging reports.</li>
<li><strong>Accounts Payable</strong>: Manage vendor bills, broker payments, and contractor settlements.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Accounting</strong> from the sidebar.</li>
<li>Review the <strong>P&L summary</strong> on the dashboard for a snapshot of revenue and expenses.</li>
<li>Click <code>Create Invoice</code> to bill a customer for a completed load.</li>
<li>Enter the <strong>customer</strong>, <strong>load number</strong>, <strong>amount</strong>, and <strong>due date</strong>.</li>
<li>Log expenses by clicking <code>Add Expense</code> and selecting the category (fuel, maintenance, payroll).</li>
<li>Check <strong>Accounts Receivable</strong> for overdue invoices and follow up with customers.</li>
<li>Generate a <strong>P&L report</strong> for any date range to review profitability.</li>
</ol>

<blockquote><strong>Tip:</strong> Reconcile your accounting weekly. Waiting until month-end makes it harder to catch billing errors, duplicate expenses, or missing invoices.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Accountants</strong> and <strong>bookkeepers</strong> use Accounting for daily financial management. <strong>Company owners</strong> review P&L reports to assess business health.</p>',

        'my-payroll' => '<h3>Overview</h3>
<p><strong>My Payroll</strong> lets you run and manage driver and staff payroll. Calculate pay, track hours, and process payments while staying aligned with accounting records.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Pay Calculation</strong>: Calculate driver pay by mile, percentage, hourly, or salary.</li>
<li><strong>Deduction Management</strong>: Track fuel advances, insurance, and lease deductions per driver.</li>
<li><strong>Pay Periods</strong>: Run payroll weekly, bi-weekly, or semi-monthly.</li>
<li><strong>Settlement Sheets</strong>: Generate detailed settlement statements for each driver.</li>
<li><strong>Accounting Integration</strong>: Payroll expenses sync automatically with the Accounting module.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>My Payroll</strong> from the sidebar.</li>
<li>Select the <strong>pay period</strong> (e.g., last week\'s Monday to Sunday).</li>
<li>Review the list of drivers and their completed loads for the period.</li>
<li>Verify the <strong>pay calculation</strong>: miles driven, percentage of revenue, or hourly rate.</li>
<li>Add any <strong>deductions</strong> such as fuel advances, insurance, or lease payments.</li>
<li>Click <code>Run Payroll</code> to generate settlement sheets for each driver.</li>
<li>Review the <strong>settlement sheet</strong> for each driver and process payments.</li>
</ol>

<blockquote><strong>Tip:</strong> Always reconcile fuel advances before running payroll. Unrecovered advances are a common source of overpayment and driver disputes.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Accountants</strong> and <strong>payroll managers</strong> use My Payroll to process driver and staff payments. <strong>Company owners</strong> review payroll totals for budgeting.</p>',

        'my-factoring-company' => '<h3>Overview</h3>
<p><strong>My Factoring Company</strong> connects you to invoice factoring services. Manage factoring provider details, submit invoices, and track advances to improve cash flow.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Factoring Provider Profiles</strong>: Store factoring company contact info, rates, and terms.</li>
<li><strong>Invoice Submission</strong>: Submit completed load invoices to your factor for advance payment.</li>
<li><strong>Advance Tracking</strong>: Track how much of each invoice has been advanced and the reserve held.</li>
<li><strong>Fee Calculation</strong>: See factoring fees and discount rates per invoice.</li>
<li><strong>Reserve Release</strong>: Track when the factor releases the reserve balance after customer payment.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>My Factoring Company</strong> from the sidebar.</li>
<li>Set up your factoring provider profile with <strong>company name</strong>, <strong>contact</strong>, and <strong>advance rate</strong>.</li>
<li>After a load is delivered, select the invoice and click <code>Submit to Factor</code>.</li>
<li>Enter the <strong>invoice amount</strong> and <strong>customer billing info</strong>.</li>
<li>Track the <strong>advance status</strong>: typically 80-90% of the invoice is paid within 24 hours.</li>
<li>Monitor the <strong>reserve</strong>: the remaining balance is released when the customer pays.</li>
<li>Review factoring fees in the <strong>Fee Report</strong> to evaluate cost vs. benefit.</li>
</ol>

<blockquote><strong>Tip:</strong> Compare factoring fees against the cost of waiting 30-60 days for customer payment. If your customers pay slowly, factoring can be cheaper than the cash flow gap.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Accountants</strong> and <strong>finance managers</strong> use My Factoring Company to manage cash flow. <strong>Company owners</strong> review factoring costs and advance rates.</p>',

        'fuel-reports' => '<h3>Overview</h3>
<p><strong>Fuel Reports</strong> shows fuel spending, usage trends, and efficiency analytics. Use this data to identify waste, optimize routes, and manage fuel card spending.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Fuel Spend Dashboard</strong>: View total fuel cost by week, month, or truck.</li>
<li><strong>MPG Tracking</strong>: Calculate miles per gallon for each truck and driver.</li>
<li><strong>IFTA Reporting</strong>: Generate quarterly IFTA tax reports by state mileage.</li>
<li><strong>Fuel Card Transactions</strong>: Import and review fuel card purchases in real time.</li>
<li><strong>Efficiency Alerts</strong>: Flag trucks or drivers with below-average fuel efficiency.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Fuel Reports</strong> from the sidebar.</li>
<li>Review the <strong>fuel spend dashboard</strong> for total cost and trend over time.</li>
<li>Filter by <strong>truck</strong> or <strong>driver</strong> to identify outliers in fuel consumption.</li>
<li>Check the <strong>MPG tracking</strong> table, flag any truck below 6 MPG for maintenance.</li>
<li>At quarter-end, generate the <strong>IFTA report</strong> by selecting the date range.</li>
<li>Review fuel card transactions for unauthorized or off-route purchases.</li>
</ol>

<blockquote><strong>Tip:</strong> A sudden drop in MPG for a specific truck often indicates a mechanical issue, bad injectors, tire pressure, or aerodynamic damage. Address it early to avoid compounding fuel waste.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Accountants</strong> use Fuel Reports for IFTA reporting and expense tracking. <strong>Fleet managers</strong> monitor MPG to identify maintenance needs and driver behavior.</p>',

        'my-fuel-cards' => '<h3>Overview</h3>
<p><strong>My Fuel Cards</strong> lets you manage fuel card assignments and spending limits. Track cardholders, set limits, and monitor transactions to control fuel costs.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Card Assignment</strong>: Assign fuel cards to specific drivers or trucks.</li>
<li><strong>Spending Limits</strong>: Set daily, weekly, or per-transaction limits on each card.</li>
<li><strong>Transaction Monitoring</strong>: View real-time fuel purchases by card, driver, or date.</li>
<li><strong>Fraud Alerts</strong>: Receive alerts for purchases outside normal routes or hours.</li>
<li><strong>Card Status Control</strong>: Activate, deactivate, or report lost cards instantly.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>My Fuel Cards</strong> from the sidebar.</li>
<li>Click <code>Add Card</code> to register a new fuel card.</li>
<li>Enter the <strong>card number</strong>, <strong>provider</strong> (Comdata, EFS, TCH), and <strong>assigned driver</strong>.</li>
<li>Set <strong>spending limits</strong>: daily maximum, per-transaction maximum, and fuel-only restriction.</li>
<li>Monitor the <strong>transactions</strong> tab for real-time purchase activity.</li>
<li>If a card is lost or stolen, click <code>Deactivate</code> immediately to prevent fraud.</li>
<li>Review weekly transaction reports for unusual spending patterns.</li>
</ol>

<blockquote><strong>Tip:</strong> Set fuel-only limits on all cards. Drivers who can purchase non-fuel items on a fuel card are more likely to make unauthorized purchases that are hard to recover.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Fleet managers</strong> use My Fuel Cards to control fuel costs. <strong>Accountants</strong> review transactions for expense tracking, and <strong>dispatchers</strong> check card status before assigning loads.</p>',

        'loans-cash-advance' => '<h3>Overview</h3>
<p><strong>Loans and Cash Advance</strong> helps you apply for and track working capital. Record loan details, repayment schedules, and advance requests so cash flow needs are documented.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Loan Tracking</strong>: Store loan amounts, interest rates, terms, and lender details.</li>
<li><strong>Repayment Schedules</strong>: View upcoming payments and remaining balances.</li>
<li><strong>Driver Cash Advances</strong>: Track advances given to drivers and deduct from settlements.</li>
<li><strong>Working Capital Requests</strong>: Submit and track requests for business loans or credit lines.</li>
<li><strong>Payment History</strong>: Review all payments made toward each loan or advance.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Loans/Cash Advance</strong> from the sidebar.</li>
<li>Click <code>Add Loan</code> to record a business loan or credit line.</li>
<li>Enter the <strong>lender</strong>, <strong>principal amount</strong>, <strong>interest rate</strong>, and <strong>term</strong>.</li>
<li>Review the auto-generated <strong>repayment schedule</strong> for upcoming payments.</li>
<li>For driver advances, click <code>Issue Advance</code>, select the driver, and enter the amount.</li>
<li>The advance will auto-deduct from the driver\'s next settlement in <strong>My Payroll</strong>.</li>
<li>Track payment history to monitor remaining balances.</li>
</ol>

<blockquote><strong>Tip:</strong> Track driver advances carefully. Unrecovered advances can accumulate quickly, set a maximum advance limit per driver and enforce it.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Accountants</strong> and <strong>finance managers</strong> use Loans/Cash Advance to manage debt and driver advances. <strong>Company owners</strong> review loan balances for financial planning.</p>',

        'api-integration-keys' => '<h3>Overview</h3>
<p><strong>API Integration Keys</strong> lets you generate and manage keys for connecting DISPATCH with other systems. Control access and track which integrations are active.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Key Generation</strong>: Create secure API keys for external systems and integrations.</li>
<li><strong>Access Control</strong>: Set permissions per key, read-only, write, or full access.</li>
<li><strong>Integration Tracking</strong>: See which systems are connected and their last sync time.</li>
<li><strong>Key Revocation</strong>: Revoke keys instantly if an integration is no longer needed or compromised.</li>
<li><strong>Usage Logs</strong>: Track API calls and identify unusual activity.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>API Integration Keys</strong> from the sidebar.</li>
<li>Click <code>Generate Key</code> to create a new API key.</li>
<li>Name the integration (e.g., "QuickBooks Sync" or "Load Board Feed").</li>
<li>Select the <strong>permission level</strong>: <code>Read-Only</code>, <code>Write</code>, or <code>Full Access</code>.</li>
<li>Copy the generated key and paste it into your external system\'s settings.</li>
<li>Monitor the <strong>usage logs</strong> to verify the integration is syncing correctly.</li>
<li>Click <code>Revoke</code> to disable a key if the integration is discontinued.</li>
</ol>

<blockquote><strong>Tip:</strong> Use the minimum permission level needed for each integration. A load board feed only needs read access, while an accounting sync may need write access. Never grant full access unless required.</blockquote>

<h3>Who Uses This</h3>
<p><strong>IT administrators</strong> and <strong>developers</strong> use API Integration Keys to connect external systems. <strong>Company owners</strong> review active integrations for security.</p>',

        // ===== Safety =====
        'emergency-monitoring' => '<h3>Overview</h3>
<p><strong>Emergency Monitoring</strong> helps you set up and respond to critical driver and vehicle alerts. Configure notification rules, monitor panic events, and coordinate emergency response.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Panic Button Alerts</strong>: Receive instant alerts when a driver triggers the ELD panic button.</li>
<li><strong>Geofence Violations</strong>: Get notified when a truck enters or leaves a restricted zone.</li>
<li><strong>Accident Detection</strong>: Monitor sudden stops or impacts via ELD telemetry.</li>
<li><strong>Emergency Contacts</strong>: Store emergency contact info for each driver and vehicle.</li>
<li><strong>Response Coordination</strong>: Log response actions and communicate with the driver in real time.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Emergency Monitoring</strong> from the sidebar.</li>
<li>Configure <strong>notification rules</strong>: select which events trigger alerts (panic, geofence, impact).</li>
<li>Add <strong>emergency contacts</strong> for each driver, family member, fleet manager, and 911.</li>
<li>Set up <strong>geofences</strong> around restricted areas or customer locations if needed.</li>
<li>When an alert fires, review the <strong>event details</strong>: driver, location, and event type.</li>
<li>Contact the driver immediately using the phone number on file.</li>
<li>Log all <strong>response actions</strong> in the event record for future reference.</li>
</ol>

<blockquote><strong>Tip:</strong> Test your emergency notification setup monthly. A panic alert that no one receives is useless, verify that alerts reach the right people on their phones, not just email.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Safety officers</strong> and <strong>fleet managers</strong> use Emergency Monitoring to respond to critical events. <strong>Dispatchers</strong> assist with driver communication during emergencies.</p>',

        'safety-assessments' => '<h3>Overview</h3>
<p><strong>Safety Assessments</strong> lets you run and review driver and vehicle safety reviews. Schedule assessments, record results, and take action on any safety concerns.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Assessment Scheduling</strong>: Schedule periodic safety reviews for drivers and vehicles.</li>
<li><strong>Scoring System</strong>: Rate drivers and vehicles on safety criteria with pass/fail scores.</li>
<li><strong>Corrective Actions</strong>: Assign training or repairs based on assessment results.</li>
<li><strong>Assessment History</strong>: Track improvement or decline over time per driver or vehicle.</li>
<li><strong>Compliance Documentation</strong>: Generate reports for DOT audits and insurance reviews.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Safety Assessments</strong> from the sidebar.</li>
<li>Click <code>Schedule Assessment</code> and select a driver or vehicle.</li>
<li>Choose the <strong>assessment type</strong>: driver evaluation, vehicle inspection, or compliance audit.</li>
<li>Set the <strong>date</strong> and assign a <strong>reviewer</strong> (safety officer or fleet manager).</li>
<li>During the assessment, score each criterion and add notes.</li>
<li>If any item fails, assign a <strong>corrective action</strong>: training, repair, or document update.</li>
<li>Review the <strong>assessment history</strong> to track improvement over time.</li>
</ol>

<blockquote><strong>Tip:</strong> Conduct driver safety assessments quarterly. Drivers who receive regular feedback have 30% fewer preventable accidents than those who don\'t.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Safety officers</strong> use Safety Assessments to evaluate drivers and vehicles. <strong>Fleet managers</strong> review results and assign corrective actions.</p>',

        'maintenance-monitoring' => '<h3>Overview</h3>
<p><strong>Maintenance Monitoring</strong> tracks vehicle health and service schedules. Log repairs, schedule preventive maintenance, and set reminders to keep equipment in top condition.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Service Schedules</strong>: Track oil changes, PM inspections, and component replacements by mileage.</li>
<li><strong>Repair Logging</strong>: Record repairs with cost, parts, labor, and downtime.</li>
<li><strong>PM Reminders</strong>: Get alerts when a truck is due for preventive maintenance.</li>
<li><strong>Downtime Tracking</strong>: Monitor how long each truck is out of service for repairs.</li>
<li><strong>Cost Analysis</strong>: Review maintenance cost per truck to identify problem vehicles.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Maintenance Monitoring</strong> from the sidebar.</li>
<li>Review the <strong>PM due list</strong> for trucks approaching their next service interval.</li>
<li>Click <code>Log Repair</code> to record a completed repair, enter parts, labor, and cost.</li>
<li>Schedule future PM by clicking <code>Schedule Service</code> and selecting the truck and mileage interval.</li>
<li>Set <strong>reminders</strong> for upcoming service, DISPATCH will alert you 500 miles before the due mileage.</li>
<li>Review the <strong>cost analysis</strong> report to identify trucks with high maintenance costs.</li>
</ol>

<blockquote><strong>Tip:</strong> Stick to PM intervals strictly. A truck that misses an oil change by 5,000 miles may suffer engine damage that costs 10x more than the oil change would have.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Fleet managers</strong> and <strong>mechanics</strong> use Maintenance Monitoring to track service schedules. <strong>Accountants</strong> review maintenance costs for budgeting.</p>',

        'safety-violations' => '<h3>Overview</h3>
<p><strong>Safety Violations</strong> records and tracks incidents that affect your safety score. Review violation details, assign corrective actions, and monitor resolution progress.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Violation Log</strong>: Record violations with date, location, officer, and citation details.</li>
<li><strong>CSA Impact</strong>: See how each violation affects your CSA score by category.</li>
<li><strong>Corrective Actions</strong>: Assign training, repairs, or document updates to resolve violations.</li>
<li><strong>Resolution Tracking</strong>: Monitor open vs. resolved violations and time to resolution.</li>
<li><strong>Trend Analysis</strong>: Identify recurring violation types and take preventive action.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Safety Violations</strong> from the sidebar.</li>
<li>Click <code>Add Violation</code> to record a new incident.</li>
<li>Enter the <strong>date</strong>, <strong>location</strong>, <strong>officer</strong>, and <strong>violation type</strong>.</li>
<li>Link the violation to the <strong>driver</strong> and/or <strong>vehicle</strong> involved.</li>
<li>Review the <strong>CSA impact</strong> to understand how it affects your score.</li>
<li>Assign a <strong>corrective action</strong>: driver training, vehicle repair, or document update.</li>
<li>Track the violation status from <code>Open</code> to <code>Resolved</code>.</li>
</ol>

<blockquote><strong>Tip:</strong> Contest violations you believe are incorrect within the 15-day window. Uncontested violations stay on your CSA record for 3 years and can trigger FMCSA interventions.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Safety officers</strong> use Safety Violations to track and resolve incidents. <strong>Fleet managers</strong> review trends to prevent recurring issues.</p>',

        'safety' => '<h3>Overview</h3>
<p><strong>Safety</strong> is the central place for safety metrics and risk management. Monitor accident rates, training status, and violation trends to build a stronger safety culture.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Safety Dashboard</strong>: View accident rate, CSA scores, and training completion in one place.</li>
<li><strong>Accident Log</strong>: Record accidents with details, photos, and insurance claims.</li>
<li><strong>Training Tracker</strong>: Monitor which drivers have completed required safety training.</li>
<li><strong>Risk Assessment</strong>: Identify high-risk drivers and vehicles based on violation and accident history.</li>
<li><strong>Safety Reports</strong>: Generate reports for management, insurance, and DOT audits.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Safety</strong> from the sidebar.</li>
<li>Review the <strong>safety dashboard</strong> for your current accident rate and CSA scores.</li>
<li>Log a new accident by clicking <code>Add Accident</code>, enter date, location, and details.</li>
<li>Upload accident <strong>photos</strong> and link the associated <strong>insurance claim</strong>.</li>
<li>Check the <strong>training tracker</strong> for drivers with overdue safety training.</li>
<li>Review the <strong>risk assessment</strong> list for high-risk drivers who need intervention.</li>
<li>Generate a <strong>safety report</strong> for your next management or insurance review.</li>
</ol>

<blockquote><strong>Tip:</strong> A strong safety culture starts with data. Share monthly safety metrics with your drivers, transparency about accident rates and violations encourages better driving behavior.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Safety officers</strong> and <strong>fleet managers</strong> use the Safety module daily. <strong>Company owners</strong> review safety reports for insurance and compliance purposes.</p>',

        // ===== Compliance =====
        'compliance-monitoring' => '<h3>Overview</h3>
<p><strong>Compliance Monitoring</strong> gives you a real-time view of regulatory compliance. Track HOS, inspections, and certifications to avoid fines and out-of-service risk.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Compliance Dashboard</strong>: View HOS compliance, inspection status, and certification expirations.</li>
<li><strong>HOS Violation Alerts</strong>: Get notified when a driver exceeds their duty limit.</li>
<li><strong>Inspection Tracking</strong>: Monitor annual and DOT inspection dates for every vehicle.</li>
<li><strong>Certification Expirations</strong>: Track CDL, medical card, and permit expiration dates.</li>
<li><strong>Out-of-Service Risk</strong>: Identify drivers or vehicles at risk of being placed out of service.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Compliance Monitoring</strong> from the sidebar.</li>
<li>Review the <strong>compliance dashboard</strong> for any red or yellow indicators.</li>
<li>Address <strong>HOS violations</strong> immediately, coach the driver and adjust load assignments.</li>
<li>Check the <strong>inspection tracker</strong> for vehicles with upcoming or overdue inspections.</li>
<li>Review <strong>certification expirations</strong> and notify drivers 30 days before their CDL or medical card expires.</li>
<li>Resolve any <strong>out-of-service risks</strong> before the vehicle or driver is stopped at a scale.</li>
</ol>

<blockquote><strong>Tip:</strong> A driver placed out of service at a scale can cost you 10+ hours of lost time and a fine. Check the compliance dashboard every morning before dispatching loads.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Compliance officers</strong> and <strong>safety managers</strong> use Compliance Monitoring daily. <strong>Dispatchers</strong> check it before assigning loads to avoid HOS violations.</p>',

        'compliance-software-options' => '<h3>Overview</h3>
<p><strong>Compliance Software Options</strong> lets you explore and configure integrations with ELD and compliance tools. Choose the right providers and sync data for accurate compliance reporting.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Provider Directory</strong>: Browse supported ELD and compliance software providers.</li>
<li><strong>Integration Setup</strong>: Connect your ELD provider to sync HOS data automatically.</li>
<li><strong>Feature Comparison</strong>: Compare providers by features, pricing, and compliance coverage.</li>
<li><strong>Data Sync Status</strong>: Monitor whether your compliance integrations are syncing correctly.</li>
<li><strong>Multi-Provider Support</strong>: Connect multiple ELD providers if your fleet uses different brands.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Compliance Software Options</strong> from the sidebar.</li>
<li>Browse the <strong>provider directory</strong> to find your ELD or compliance tool.</li>
<li>Click <code>Connect</code> next to your provider to start the integration.</li>
<li>Enter your <strong>provider credentials</strong> or API key to authorize the sync.</li>
<li>Verify the <strong>data sync status</strong> shows <code>Active</code> and HOS data is flowing.</li>
<li>Use the <strong>feature comparison</strong> tab if you\'re considering switching providers.</li>
</ol>

<blockquote><strong>Tip:</strong> If you operate across different ELD brands, connect each one separately. DISPATCH supports multiple providers simultaneously, so all your HOS data stays in one place.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Compliance officers</strong> and <strong>IT administrators</strong> use Compliance Software Options to manage ELD integrations. <strong>Fleet managers</strong> review provider options before purchasing.</p>',

        'drug-alcohol-testing' => '<h3>Overview</h3>
<p><strong>Drug and Alcohol Testing</strong> manages testing programs and driver records. Track testing schedules, results, and program membership to meet DOT and company requirements.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Testing Schedule</strong>: Track pre-employment, random, post-accident, and reasonable suspicion tests.</li>
<li><strong>Result Management</strong>: Record test results and store lab documentation.</li>
<li><strong>Consortium Membership</strong>: Track which drivers are enrolled in a random testing pool.</li>
<li><strong>Compliance Reporting</strong>: Generate reports for DOT audits and annual MIS submissions.</li>
<li><strong>Referral Tracking</strong>: Manage SAP (Substance Abuse Professional) referrals for positive tests.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Drug & Alcohol Testing</strong> from the sidebar.</li>
<li>Review the <strong>testing schedule</strong> for upcoming random or periodic tests.</li>
<li>For a new hire, schedule a <strong>pre-employment test</strong> before their first load.</li>
<li>After a test, record the <strong>result</strong> and upload the lab report.</li>
<li>If a result is positive, initiate a <strong>SAP referral</strong> and suspend the driver from dispatch.</li>
<li>Track the driver\'s <strong>return-to-duty</strong> process until they are cleared.</li>
<li>At year-end, generate the <strong>MIS report</strong> for DOT compliance.</li>
</ol>

<blockquote><strong>Tip:</strong> Never dispatch a driver who has not completed their pre-employment drug test. A positive result after they\'ve already driven is a serious DOT violation that can cost your operating authority.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Compliance officers</strong> and <strong>HR managers</strong> use Drug & Alcohol Testing to manage testing programs. <strong>Dispatchers</strong> check test status before assigning loads.</p>',

        'violations' => '<h3>Overview</h3>
<p><strong>Violations</strong> tracks all compliance-related incidents across your operation. Review details, assign responsibility, and manage the resolution process from a single view.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Unified Violation Log</strong>: View all violations, driver, vehicle, and compliance, in one place.</li>
<li><strong>Categorization</strong>: Filter violations by type: HOS, inspection, traffic, or compliance.</li>
<li><strong>Responsibility Assignment</strong>: Assign each violation to the responsible driver, vehicle, or staff member.</li>
<li><strong>Resolution Workflow</strong>: Track violations from <code>Open</code> to <code>In Progress</code> to <code>Resolved</code>.</li>
<li><strong>Recurring Violation Alerts</strong>: Flag drivers or vehicles with repeated violations for intervention.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Violations</strong> from the sidebar.</li>
<li>Review the <strong>violation log</strong> for any new or open items.</li>
<li>Click <code>Add Violation</code> to record a new incident, enter type, date, and details.</li>
<li>Assign the violation to the responsible <strong>driver</strong> or <strong>vehicle</strong>.</li>
<li>Set the status to <code>In Progress</code> and assign a corrective action.</li>
<li>Monitor the resolution and update to <code>Resolved</code> once complete.</li>
<li>Check the <strong>recurring alerts</strong> for patterns that need systemic intervention.</li>
</ol>

<blockquote><strong>Tip:</strong> If the same driver has 3+ violations of the same type within 6 months, require mandatory retraining. Patterns indicate a knowledge gap or behavior issue that won\'t self-correct.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Compliance officers</strong> and <strong>safety managers</strong> use Violations to track and resolve incidents. <strong>Fleet managers</strong> review patterns for preventive action.</p>',

        'driver-violations' => '<h3>Overview</h3>
<p><strong>Driver Violations</strong> focuses on citations and incidents tied to individual drivers. Monitor driver history, take corrective action, and track improvements over time.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Driver-Specific Log</strong>: View all violations for a single driver in one place.</li>
<li><strong>Violation Types</strong>: Track HOS, traffic, inspection, and logbook violations per driver.</li>
<li><strong>History Timeline</strong>: See a chronological view of each driver\'s violation history.</li>
<li><strong>Corrective Actions</strong>: Assign training, coaching, or disciplinary actions per violation.</li>
<li><strong>Improvement Tracking</strong>: Monitor whether a driver\'s violation rate decreases after intervention.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Driver Violations</strong> from the sidebar.</li>
<li>Search for a driver by name or select from the list.</li>
<li>Review their <strong>violation history</strong> timeline for patterns.</li>
<li>Click <code>Add Violation</code> to record a new incident for the driver.</li>
<li>Assign a <strong>corrective action</strong>: training module, coaching session, or written warning.</li>
<li>Track the driver\'s <strong>improvement</strong> over the following months.</li>
<li>Use the history report for performance reviews or termination decisions.</li>
</ol>

<blockquote><strong>Tip:</strong> Document every corrective action in writing. If you later need to terminate a driver for repeated violations, a documented history of coaching and training protects you from wrongful termination claims.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Safety officers</strong> and <strong>fleet managers</strong> use Driver Violations to manage individual driver performance. <strong>HR</strong> references it for disciplinary actions.</p>',

        'vehicle-violations' => '<h3>Overview</h3>
<p><strong>Vehicle Violations</strong> tracks citations and defects tied to specific trucks or trailers. Use it to prioritize repairs and improve your fleet roadside inspection record.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Vehicle-Specific Log</strong>: View all violations and defects for a single truck or trailer.</li>
<li><strong>Defect Tracking</strong>: Record roadside inspection defects with severity level.</li>
<li><strong>Repair Prioritization</strong>: Flag vehicles with critical defects that need immediate repair.</li>
<li><strong>Inspection Performance</strong>: Track clean vs. violation inspections per vehicle.</li>
<li><strong>Cost Impact</strong>: Calculate fines and repair costs associated with each vehicle\'s violations.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Vehicle Violations</strong> from the sidebar.</li>
<li>Select a truck or trailer from the list to view its violation history.</li>
<li>Click <code>Add Violation</code> to record a roadside inspection finding.</li>
<li>Enter the <strong>defect type</strong>, <strong>severity</strong>, and <strong>inspection location</strong>.</li>
<li>Flag <strong>critical defects</strong> for immediate repair, the vehicle should not be dispatched until fixed.</li>
<li>Review the <strong>inspection performance</strong> report to identify problem vehicles.</li>
<li>Use the <strong>cost impact</strong> report to decide whether to repair or retire a high-violation vehicle.</li>
</ol>

<blockquote><strong>Tip:</strong> A vehicle with repeated brake or tire violations is a liability. If repairs don\'t resolve the pattern, consider retiring the truck, a catastrophic failure is far more expensive than replacement.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Fleet managers</strong> and <strong>mechanics</strong> use Vehicle Violations to prioritize repairs. <strong>Safety officers</strong> track inspection performance for compliance.</p>',

        'hos' => '<h3>Overview</h3>
<p><strong>HOS (Hours of Service)</strong> tracks driver duty and rest rules. Monitor on-duty time, breaks, and daily limits to ensure compliance and prevent driver fatigue.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Duty Status Tracking</strong>: View each driver\'s current status: <code>On Duty</code>, <code>Driving</code>, <code>Sleeper</code>, or <code>Off Duty</code>.</li>
<li><strong>11-Hour Driving Limit</strong>: Alert when a driver approaches the 11-hour driving limit.</li>
<li><strong>14-Hour Window</strong>: Track the 14-hour on-duty window and notify when it\'s closing.</li>
<li><strong>30-Minute Break</strong>: Remind drivers to take their required 30-minute break after 8 hours.</li>
<li><strong>34-Hour Restart</strong>: Track 34-hour restarts and verify they include two periods from 1-5 AM.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>HOS</strong> from the sidebar.</li>
<li>Review the <strong>driver status board</strong> for current duty status and available hours.</li>
<li>Check drivers with <strong>yellow alerts</strong>: they are approaching a limit.</li>
<li>Check drivers with <strong>red alerts</strong>: they have exceeded a limit and must stop driving.</li>
<li>Before assigning a load, verify the driver has enough <strong>available hours</strong> to complete it.</li>
<li>Review the <strong>34-hour restart log</strong> to confirm compliance with the restart rules.</li>
<li>Generate HOS reports for DOT audits when requested.</li>
</ol>

<blockquote><strong>Tip:</strong> Never dispatch a load to a driver with less than 2 hours of available drive time remaining. Traffic, weather, and loading delays can push them into an HOS violation before reaching the destination.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Dispatchers</strong> use HOS before every load assignment. <strong>Compliance officers</strong> monitor HOS for violations, and <strong>safety managers</strong> review patterns for coaching.</p>',

        'permit-insurance' => '<h3>Overview</h3>
<p><strong>Permit and Insurance</strong> tracks registration, permits, and insurance certificates. Store expiration dates and upload documents so your fleet never runs out of coverage.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Permit Tracking</strong>: Monitor state permits, IRP, IFTA, and oversize/overweight permits.</li>
<li><strong>Insurance Management</strong>: Track auto liability, cargo, and physical damage policies.</li>
<li><strong>Expiration Alerts</strong>: Get notified 30, 60, and 90 days before any permit or policy expires.</li>
<li><strong>Document Storage</strong>: Upload and organize permit and insurance PDFs by vehicle.</li>
<li><strong>COI Distribution</strong>: Send certificates of insurance to brokers and customers on demand.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Permit & Insurance</strong> from the sidebar.</li>
<li>Review the <strong>expiration dashboard</strong> for upcoming permit or insurance expirations.</li>
<li>Click <code>Add Permit</code> or <code>Add Insurance</code> to record a new document.</li>
<li>Enter the <strong>type</strong>, <strong>issue date</strong>, <strong>expiration date</strong>, and <strong>vehicle</strong>.</li>
<li>Upload the <strong>PDF document</strong> for digital storage.</li>
<li>Set <strong>alert preferences</strong>: 30, 60, or 90 days before expiration.</li>
<li>When a broker requests a COI, use <code>Send COI</code> to email it directly.</li>
</ol>

<blockquote><strong>Tip:</strong> Renew insurance and permits at least 30 days before expiration. A lapse in auto liability coverage can result in FMCSA revoking your operating authority, a death sentence for the business.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Compliance officers</strong> use Permit & Insurance to track expirations. <strong>Dispatchers</strong> send COIs to brokers, and <strong>company owners</strong> review coverage levels.</p>',

        // ===== Account =====
        'notifications' => '<h3>Overview</h3>
<p><strong>Notifications</strong> delivers real-time alerts for loads, drivers, vehicles, and compliance events. Customize what you receive so important updates never get missed.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Real-time Alerts</strong>: Receive instant notifications for load status changes, HOS violations, and emergencies.</li>
<li><strong>Custom Filters</strong>: Choose which alert types you receive, loads, compliance, maintenance, or all.</li>
<li><strong>Delivery Channels</strong>: Get alerts via in-app, email, SMS, or push notification.</li>
<li><strong>Notification History</strong>: Review past alerts and mark them as read or unread.</li>
<li><strong>Do Not Disturb</strong>: Set quiet hours for non-critical alerts outside of working time.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Notifications</strong> from the sidebar.</li>
<li>Review unread alerts at the top of the list.</li>
<li>Click <code>Settings</code> to customize which notifications you receive.</li>
<li>Select your <strong>delivery channels</strong>: in-app, email, SMS, or push.</li>
<li>Set <strong>Do Not Disturb</strong> hours for non-critical alerts (e.g., 7 PM to 6 AM).</li>
<li>Click any notification to jump to the related module for action.</li>
<li>Mark alerts as <code>Read</code> or clear them from the list.</li>
</ol>

<blockquote><strong>Tip:</strong> Keep emergency and HOS alerts on at all times, even during Do Not Disturb hours. A 3 AM HOS violation is better caught immediately than discovered the next morning.</blockquote>

<h3>Who Uses This</h3>
<p>All DISPATCH users benefit from Notifications. <strong>Dispatchers</strong> receive load alerts, <strong>safety officers</strong> get compliance alerts, and <strong>fleet managers</strong> receive maintenance alerts.</p>',

        'activity' => '<h3>Overview</h3>
<p><strong>Activity</strong> keeps a detailed log of system events and user actions. Use it for auditing, troubleshooting, and understanding how your team uses DISPATCH.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Audit Trail</strong>: Track who did what and when, logins, load changes, status updates, and deletions.</li>
<li><strong>Filter by User</strong>: View activity for a specific user or role.</li>
<li><strong>Filter by Action</strong>: Filter by event type, loads, drivers, compliance, or system changes.</li>
<li><strong>Date Range Search</strong>: Review activity for any date range or specific day.</li>
<li><strong>Export Reports</strong>: Export activity logs as CSV or PDF for compliance audits.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Activity</strong> from the sidebar.</li>
<li>Review the <strong>recent activity</strong> list for the latest system events.</li>
<li>Use the <strong>filter bar</strong> to narrow by user, action type, or date range.</li>
<li>Click any activity entry to see full details, timestamp, user, and change description.</li>
<li>If investigating an issue, filter by the affected module (e.g., <code>My Loads</code>).</li>
<li>Click <code>Export</code> to download the filtered log as a CSV or PDF.</li>
</ol>

<blockquote><strong>Tip:</strong> Review the activity log weekly for unusual patterns, such as a user making changes outside their normal hours, or repeated status reversals on the same load. These can indicate errors or misuse.</blockquote>

<h3>Who Uses This</h3>
<p><strong>System administrators</strong> use Activity for auditing and troubleshooting. <strong>Compliance officers</strong> export logs for DOT audits, and <strong>company owners</strong> review usage patterns.</p>',

        'maintenance' => '<h3>Overview</h3>
<p><strong>Maintenance</strong> schedules and tracks vehicle maintenance tasks. Plan oil changes, inspections, and repairs so your fleet stays reliable and compliant.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Maintenance Calendar</strong>: View upcoming and overdue service tasks in a calendar layout.</li>
<li><strong>Service Tasks</strong>: Create tasks for oil changes, PM inspections, tire rotations, and repairs.</li>
<li><strong>Mileage-Based Scheduling</strong>: Schedule service by mileage intervals (e.g., every 25,000 miles).</li>
<li><strong>Vendor Management</strong>: Track which shop or vendor performed each service.</li>
<li><strong>Cost Tracking</strong>: Log parts, labor, and total cost for every maintenance event.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Maintenance</strong> from the sidebar.</li>
<li>Review the <strong>calendar</strong> for upcoming and overdue tasks.</li>
<li>Click <code>Schedule Task</code> to create a new maintenance event.</li>
<li>Select the <strong>truck</strong>, <strong>task type</strong> (oil change, PM, repair), and <strong>due date or mileage</strong>.</li>
<li>Assign a <strong>vendor</strong> or internal shop to perform the work.</li>
<li>After completion, click <code>Complete Task</code> and enter parts, labor, and cost.</li>
<li>Review the <strong>cost report</strong> to identify high-maintenance vehicles.</li>
</ol>

<blockquote><strong>Tip:</strong> Schedule PM inspections 500 miles before they\'re due. This buffer ensures the truck can reach the shop without exceeding the interval, even if it\'s on a long haul.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Fleet managers</strong> and <strong>mechanics</strong> use Maintenance to plan and track service. <strong>Accountants</strong> review maintenance costs for budgeting.</p>',

        'drug-alcohol' => '<h3>Overview</h3>
<p><strong>Drug and Alcohol</strong> records testing data and program details. Maintain DOT compliance by tracking testing status, results, and program enrollments.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Testing Records</strong>: Store test dates, types, results, and lab documentation.</li>
<li><strong>Program Enrollment</strong>: Track which drivers are in the random testing consortium.</li>
<li><strong>Pre-Employment Tests</strong>: Verify new hires have passed before their first dispatch.</li>
<li><strong>Return-to-Duty Tracking</strong>: Monitor SAP referrals and return-to-duty test schedules.</li>
<li><strong>MIS Reporting</strong>: Generate annual Management Information System reports for DOT.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Drug & Alcohol</strong> from the sidebar.</li>
<li>Review the <strong>testing status board</strong> for drivers with pending or overdue tests.</li>
<li>Click <code>Add Test Record</code> to log a new test, select the driver and test type.</li>
<li>Enter the <strong>test date</strong>, <strong>lab</strong>, and <strong>result</strong>.</li>
<li>Upload the <strong>lab report</strong> PDF for documentation.</li>
<li>For positive results, initiate a <strong>SAP referral</strong> and track return-to-duty progress.</li>
<li>At year-end, generate the <strong>MIS report</strong> for DOT submission.</li>
</ol>

<blockquote><strong>Tip:</strong> Keep your random testing pool updated. Adding new hires to the consortium within 30 days of employment is a DOT requirement, missing this can result in fines during an audit.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Compliance officers</strong> and <strong>HR managers</strong> use Drug & Alcohol to manage testing programs. <strong>Company owners</strong> review MIS reports for DOT compliance.</p>',

        'documents' => '<h3>Overview</h3>
<p><strong>Documents</strong> gives you a centralized place to store and manage permits, licenses, insurance, and other important files. Organize files by driver or vehicle and access them quickly.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Document Library</strong>: Upload and organize PDFs, images, and files by category.</li>
<li><strong>Driver Documents</strong>: Store CDLs, medical cards, MVRs, and training certificates per driver.</li>
<li><strong>Vehicle Documents</strong>: Store registrations, insurance, inspection reports, and titles per truck.</li>
<li><strong>Expiration Tracking</strong>: Set expiration dates and get alerts before documents expire.</li>
<li><strong>Quick Search</strong>: Find any document by name, driver, vehicle, or category.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Documents</strong> from the sidebar.</li>
<li>Use the <strong>category filter</strong> to browse by type, driver, vehicle, permit, or insurance.</li>
<li>Click <code>Upload Document</code> to add a new file.</li>
<li>Select the <strong>document type</strong>, link it to a <strong>driver</strong> or <strong>vehicle</strong>, and upload the file.</li>
<li>Set an <strong>expiration date</strong> if applicable, DISPATCH will alert you before it expires.</li>
<li>Use the <strong>search bar</strong> to quickly find any document by name or keyword.</li>
<li>Click any document to preview or download it.</li>
</ol>

<blockquote><strong>Tip:</strong> Scan and upload every paper document immediately. A physical filing cabinet is useless during a DOT audit, having everything in DISPATCH means you can produce any document in seconds.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Compliance officers</strong> use Documents to manage permits and insurance. <strong>HR</strong> stores driver records, and <strong>fleet managers</strong> access vehicle documentation.</p>',

        'reporting' => '<h3>Overview</h3>
<p><strong>Reporting</strong> provides pre-built and custom reports for operations, safety, and finance. Generate insights that help you make data-driven decisions.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Pre-Built Reports</strong>: Access standard reports for revenue, fuel, HOS, maintenance, and more.</li>
<li><strong>Custom Report Builder</strong>: Create custom reports by selecting data fields and filters.</li>
<li><strong>Date Range Selection</strong>: Run reports for any period, daily, weekly, monthly, or custom.</li>
<li><strong>Export Formats</strong>: Export reports as PDF, CSV, or Excel for sharing and analysis.</li>
<li><strong>Scheduled Reports</strong>: Set up automatic report delivery via email on a recurring schedule.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Reporting</strong> from the sidebar.</li>
<li>Browse the <strong>pre-built reports</strong> library by category, operations, finance, safety, compliance.</li>
<li>Click any report to view it with default settings.</li>
<li>Adjust the <strong>date range</strong> and filters to customize the output.</li>
<li>For a custom report, click <code>Build Custom Report</code> and select your data fields.</li>
<li>Click <code>Export</code> to download as PDF, CSV, or Excel.</li>
<li>To schedule recurring delivery, click <code>Schedule</code> and set the frequency and email recipients.</li>
</ol>

<blockquote><strong>Tip:</strong> Schedule a weekly revenue and fuel report to be emailed every Monday morning. This gives you a head start on analyzing the previous week\'s performance before the Monday dispatch meeting.</blockquote>

<h3>Who Uses This</h3>
<p><strong>Company owners</strong> and <strong>fleet managers</strong> use Reporting for performance insights. <strong>Accountants</strong> generate financial reports, and <strong>compliance officers</strong> produce audit reports.</p>',

        'settings' => '<h3>Overview</h3>
<p><strong>Settings</strong> lets you configure your DISPATCH experience. Manage users, preferences, notifications, and system-wide options to match your workflow.</p>

<h3>Key Features</h3>
<ul>
<li><strong>User Management</strong>: Add users, assign roles, and control access to modules.</li>
<li><strong>Appearance</strong>: Customize accent color, font size, and dark/light theme.</li>
<li><strong>Notification Preferences</strong>: Configure which alerts you receive and how.</li>
<li><strong>Autoplay & Video Settings</strong>: Control video autoplay, playback speed, and quality.</li>
<li><strong>Accessibility</strong>: Enable reduce-motion, high-contrast, and large-text modes.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Open <strong>Settings</strong> from the sidebar or click the settings icon in the topbar.</li>
<li>Under <strong>Appearance</strong>, choose your <strong>theme</strong> (dark or light) and <strong>accent color</strong>.</li>
<li>Adjust <strong>font size</strong> if you need larger text for readability.</li>
<li>Under <strong>Notifications</strong>, select which alert types you want to receive.</li>
<li>Under <strong>Users</strong>, click <code>Add User</code> to create a new account and assign a role.</li>
<li>Under <strong>Accessibility</strong>, enable reduce-motion or high-contrast if needed.</li>
<li>Click <code>Save</code> to apply your changes, preferences persist across sessions.</li>
</ol>

<blockquote><strong>Tip:</strong> Assign the minimum necessary role to each user. A dispatcher doesn\'t need access to financial reports, and a driver doesn\'t need user management tools. Least-privilege access reduces security risks.</blockquote>

<h3>Who Uses This</h3>
<p><strong>System administrators</strong> use Settings for user management and configuration. All users adjust their personal appearance and notification preferences.</p>',

        'login-signup-tutorial' => '<h3>Overview</h3>
<p><strong>Login and Sign Up</strong> walks new users through creating an account and signing in securely. Learn how to set credentials, recover access, and protect your account.</p>

<h3>Key Features</h3>
<ul>
<li><strong>Account Creation</strong>: Register a new DISPATCH account with email and password.</li>
<li><strong>Secure Login</strong>: Sign in with your credentials and optional two-factor authentication.</li>
<li><strong>Password Recovery</strong>: Reset a forgotten password via email link.</li>
<li><strong>Role-Based Access</strong>: Your account role determines which modules you can access.</li>
<li><strong>Session Management</strong>: Stay logged in or set auto-logout for security.</li>
</ul>

<h3>How to Use</h3>
<ol>
<li>Navigate to the DISPATCH login page.</li>
<li>If you\'re a new user, click <code>Sign Up</code> and enter your <strong>name</strong>, <strong>email</strong>, and <strong>password</strong>.</li>
<li>Verify your email address by clicking the link sent to your inbox.</li>
<li>If you\'re an existing user, enter your <strong>email</strong> and <strong>password</strong> on the login form.</li>
<li>Click <code>Sign In</code> to access your dashboard.</li>
<li>If you forgot your password, click <code>Forgot Password</code> and follow the email reset link.</li>
<li>For security, enable <strong>two-factor authentication</strong> in Settings after your first login.</li>
</ol>

<blockquote><strong>Tip:</strong> Use a strong, unique password for DISPATCH, not one you\'ve used on other sites. Enable two-factor authentication for an extra layer of security, especially if you have admin access.</blockquote>

<h3>Who Uses This</h3>
<p>All DISPATCH users use Login and Sign Up. <strong>New users</strong> create accounts, and <strong>returning users</strong> sign in daily. <strong>Administrators</strong> manage user access and roles.</p>'
    ];
}
