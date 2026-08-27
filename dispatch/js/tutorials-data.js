// tutorials-data.js — Video catalog data, state variables, and helper functions
// Used by tutorials.php. Must load before tutorials-player.js and tutorials-settings.js.

window.VIDEOS = [
    // Getting Started
    { id: 'dashboard', title: 'Dashboard', desc: 'Overview and statistics walkthrough', category: 'Main', path: 'Getting Started', level: 'Beginner', src: 'videos/dashboard.mp4', duration: '2:30' },
    { id: 'login-signup-tutorial', title: 'Login & Sign Up', desc: 'Account creation and secure login', category: 'Account', path: 'Getting Started', level: 'Beginner', src: 'videos/login-signup-tutorial.mp4', duration: '' },
    { id: 'settings', title: 'Settings', desc: 'Configure and customize the system', category: 'Account', path: 'Getting Started', level: 'Beginner', src: 'videos/settings.mp4', duration: '' },
    { id: 'notifications', title: 'Notifications', desc: 'Real-time alerts and updates', category: 'Account', path: 'Getting Started', level: 'Beginner', src: 'videos/notifications.mp4', duration: '' },

    // Dispatch & Operations
    { id: 'my-loads', title: 'My Loads', desc: 'Create, assign and track loads through dispatch', category: 'Operations', path: 'Dispatch & Operations', level: 'Intermediate', src: 'videos/my-loads.mp4', duration: '' },
    { id: 'my-drivers', title: 'My Drivers', desc: 'View and manage your drivers', category: 'Operations', path: 'Dispatch & Operations', level: 'Intermediate', src: 'videos/how-to-register-new-drivers.mp4', duration: '3:45' },
    { id: 'my-customers', title: 'My Customers', desc: 'Add, view and manage your customers', category: 'Operations', path: 'Dispatch & Operations', level: 'Intermediate', src: 'videos/my-customers.mp4', duration: '' },
    { id: 'my-shippers-list', title: 'My Shippers List', desc: 'Manage your list of shippers', category: 'Operations', path: 'Dispatch & Operations', level: 'Intermediate', src: 'videos/my-shippers-list.mp4', duration: '' },
    { id: 'my-consignee-lists', title: 'My Consignee Lists', desc: 'Manage your consignee lists and locations', category: 'Operations', path: 'Dispatch & Operations', level: 'Intermediate', src: 'videos/my-consignee-lists.mp4', duration: '' },
    { id: 'my-brokers', title: 'My Brokers', desc: 'Add and manage your brokers', category: 'Operations', path: 'Dispatch & Operations', level: 'Intermediate', src: 'videos/my-brokers.mp4', duration: '' },
    { id: 'driver-devices', title: 'Driver Devices', desc: 'Manage driver devices and ELD connections', category: 'Operations', path: 'Dispatch & Operations', level: 'Intermediate', src: 'videos/driver-devices.mp4', duration: '' },
    { id: 'activity', title: 'Activity', desc: 'System activity logs', category: 'Account', path: 'Dispatch & Operations', level: 'Intermediate', src: 'videos/activity.mp4', duration: '' },

    // Fleet Management
    { id: 'my-trucks', title: 'My Trucks', desc: 'Add, view and manage your trucks', category: 'Operations', path: 'Fleet Management', level: 'Intermediate', src: 'videos/my-trucks.mp4', duration: '' },
    { id: 'my-trailers', title: 'My Trailers', desc: 'Add, view and manage your trailers', category: 'Operations', path: 'Fleet Management', level: 'Intermediate', src: 'videos/my-trailers.mp4', duration: '' },
    { id: 'truck-lease-pricing', title: 'Truck Lease Pricing', desc: 'Review and configure lease pricing', category: 'Fleet', path: 'Fleet Management', level: 'Advanced', src: 'videos/truck-lease-pricing.mp4', duration: '' },
    { id: 'truck-rentals', title: 'Truck Rentals', desc: 'Manage truck rentals and equipment', category: 'Fleet', path: 'Fleet Management', level: 'Advanced', src: 'videos/truck-rentals.mp4', duration: '' },
    { id: 'lease-agreements', title: 'Lease Agreements', desc: 'Create, sign and track lease agreements', category: 'Fleet', path: 'Fleet Management', level: 'Advanced', src: 'videos/lease-agreements.mp4', duration: '' },
    { id: 'hire-drivers', title: 'Hire Drivers', desc: 'Recruit and onboard new drivers', category: 'Fleet', path: 'Fleet Management', level: 'Intermediate', src: 'videos/hire-drivers.mp4', duration: '' },
    { id: 'job-postings', title: 'Job Postings', desc: 'Create and manage driver job postings', category: 'Fleet', path: 'Fleet Management', level: 'Intermediate', src: 'videos/job-postings.mp4', duration: '' },
    { id: 'external-drivers', title: 'External Drivers', desc: 'Manage external and owner-operator drivers', category: 'Fleet', path: 'Fleet Management', level: 'Advanced', src: 'videos/external-drivers.mp4', duration: '' },
    { id: 'shout-out-scripts', title: 'Shout Out Scripts', desc: 'Ready-made scripts for your marketing', category: 'Fleet', path: 'Fleet Management', level: 'Advanced', src: 'videos/shout-out-scripts.mp4', duration: '' },
    { id: 'shout-out-vlogs', title: 'Shout Out Vlogs', desc: 'Shout out vlog examples and walkthroughs', category: 'Fleet', path: 'Fleet Management', level: 'Advanced', src: 'videos/shout-out-vlogs.mp4', duration: '' },
    { id: 'maintenance', title: 'Maintenance', desc: 'Vehicle maintenance scheduling', category: 'Account', path: 'Fleet Management', level: 'Intermediate', src: 'videos/maintenance.mp4', duration: '' },

    // Finance & Admin
    { id: 'accounting', title: 'Accounting', desc: 'Manage accounting and financial records', category: 'Finance', path: 'Finance & Admin', level: 'Advanced', src: 'videos/accounting.mp4', duration: '' },
    { id: 'my-payroll', title: 'My Payroll', desc: 'Run and manage payroll', category: 'Finance', path: 'Finance & Admin', level: 'Intermediate', src: 'videos/my-payroll.mp4', duration: '' },
    { id: 'my-factoring-company', title: 'My Factoring Company', desc: 'Connect and manage your factoring company', category: 'Finance', path: 'Finance & Admin', level: 'Advanced', src: 'videos/my-factoring-company.mp4', duration: '' },
    { id: 'fuel-reports', title: 'Fuel Reports', desc: 'View fuel spending reports and analytics', category: 'Finance', path: 'Finance & Admin', level: 'Intermediate', src: 'videos/fuel-reports.mp4', duration: '' },
    { id: 'my-fuel-cards', title: 'My Fuel Cards', desc: 'Manage fuel cards and spending limits', category: 'Finance', path: 'Finance & Admin', level: 'Intermediate', src: 'videos/my-fuel-cards.mp4', duration: '' },
    { id: 'loans-cash-advance', title: 'Loans/Cash Advance', desc: 'Apply for and track loans and cash advances', category: 'Finance', path: 'Finance & Admin', level: 'Advanced', src: 'videos/loans-cash-advance.mp4', duration: '' },
    { id: 'api-integration-keys', title: 'API Integration Keys', desc: 'Generate and manage API integration keys', category: 'Finance', path: 'Finance & Admin', level: 'Advanced', src: 'videos/api-integration-keys.mp4', duration: '' },
    { id: 'documents', title: 'Documents', desc: 'Centralized document management', category: 'Account', path: 'Finance & Admin', level: 'Intermediate', src: 'videos/documents.mp4', duration: '' },
    { id: 'permit-insurance', title: 'Permit & Insurance', desc: 'Permits, licenses and insurance', category: 'Account', path: 'Finance & Admin', level: 'Intermediate', src: 'videos/permit-insurance.mp4', duration: '' },
    { id: 'reporting', title: 'Reporting', desc: 'Reports and operational insights', category: 'Account', path: 'Finance & Admin', level: 'Intermediate', src: 'videos/reporting.mp4', duration: '' },

    // Safety & Compliance
    { id: 'my-fleet', title: 'My Fleet', desc: 'Monitor your fleet safety and compliance', category: 'Safety', path: 'Safety & Compliance', level: 'Intermediate', src: 'videos/my-fleet.mp4', duration: '' },
    { id: 'emergency-monitoring', title: 'Emergency Monitoring', desc: 'Set up and respond to emergency alerts', category: 'Safety', path: 'Safety & Compliance', level: 'Advanced', src: 'videos/emergency-monitoring.mp4', duration: '' },
    { id: 'safety-assessments', title: 'Safety Assessments', desc: 'Run and review safety assessments', category: 'Safety', path: 'Safety & Compliance', level: 'Advanced', src: 'videos/safety-assessments.mp4', duration: '' },
    { id: 'maintenance-monitoring', title: 'Maintenance Monitoring', desc: 'Monitor maintenance and vehicle health', category: 'Safety', path: 'Safety & Compliance', level: 'Intermediate', src: 'videos/maintenance-monitoring.mp4', duration: '' },
    { id: 'safety-violations', title: 'Safety Violations', desc: 'Safety-related compliance issues', category: 'Safety', path: 'Safety & Compliance', level: 'Advanced', src: 'videos/safety-violations.mp4', duration: '' },
    { id: 'compliance-monitoring', title: 'Compliance Monitoring', desc: 'Track compliance metrics in real time', category: 'Compliance', path: 'Safety & Compliance', level: 'Intermediate', src: 'videos/compliance-monitoring.mp4', duration: '' },
    { id: 'compliance-software-options', title: 'Compliance Software Options', desc: 'Explore compliance software integrations', category: 'Compliance', path: 'Safety & Compliance', level: 'Advanced', src: 'videos/compliance-software-options.mp4', duration: '' },
    { id: 'drug-alcohol-testing', title: 'Drug & Alcohol Testing', desc: 'Manage drug and alcohol testing programs', category: 'Compliance', path: 'Safety & Compliance', level: 'Advanced', src: 'videos/drug-alcohol-testing.mp4', duration: '' },
    { id: 'violations', title: 'Violations', desc: 'Track compliance violations', category: 'Compliance', path: 'Safety & Compliance', level: 'Intermediate', src: 'videos/violations.mp4', duration: '' },
    { id: 'driver-violations', title: 'Driver Violations', desc: 'Driver-specific violations', category: 'Compliance', path: 'Safety & Compliance', level: 'Advanced', src: 'videos/driver-violations.mp4', duration: '' },
    { id: 'vehicle-violations', title: 'Vehicle Violations', desc: 'Vehicle-related violations', category: 'Compliance', path: 'Safety & Compliance', level: 'Advanced', src: 'videos/vehicle-violations.mp4', duration: '' },
    { id: 'hos', title: 'HOS', desc: 'Hours of Service compliance', category: 'Compliance', path: 'Safety & Compliance', level: 'Advanced', src: 'videos/hos.mp4', duration: '' },
];

// Videos that actually exist on the server
window.AVAILABLE_VIDEOS = ['videos/dashboard.mp4', 'videos/how-to-register-new-drivers.mp4'];

// State
window.tutorialState = {
    currentFilter: 'all',
    currentVideo: null,
    watchHistory: [],
    favorites: [],
    videoProgress: {}
};

function isAvailable(src) { return window.AVAILABLE_VIDEOS.indexOf(src) !== -1; }

function escapeHtml(str) {
    if (typeof str !== 'string') return '';
    return str
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}
