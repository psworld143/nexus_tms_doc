// index-modal.js — Section icons/meta, video features, sidebar, search assistant, doc modal, doc floater
// Used by index.php. Extracted from the former inline <script> block.
// Depends on: dispatch.js (window.escapeHtml, loadSettings), window.DOC_DATA (set inline by PHP).

            const SECTION_ICONS = {
                'dashboard': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>',
                'my-loads': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>',
                'my-trucks': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>',
                'my-trailers': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>',
                'driver-devices': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>',
                'truck-lease-pricing': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m3-1h9a2 2 0 002-2v-6a2 2 0 00-2-2h-9a2 2 0 00-2 2v6a2 2 0 002 2zm7-3a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
                'truck-rentals': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1"/></svg>',
                'lease-agreements': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>',
                'hire-drivers': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>',
                'job-postings': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>',
                'external-drivers': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
                'shout-out-scripts': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>',
                'shout-out-vlogs': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>',
                'accounting': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                'my-payroll': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m3-1h9a2 2 0 002-2v-6a2 2 0 00-2-2h-9a2 2 0 00-2 2v6a2 2 0 002 2zm7-3a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
                'my-factoring-company': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>',
                'fuel-reports': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>',
                'my-fuel-cards': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>',
                'loans-cash-advance': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                'api-integration-keys': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>',
                'my-fleet': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1"/></svg>',
                'emergency-monitoring': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v18M3 12h18M5.6 5.6l12.8 12.8M18.4 5.6L5.6 18.4"/></svg>',
                'compliance-monitoring': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h4l3 8 4-16 3 8h4"/></svg>',
                'compliance-software-options': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>',
                'drug-alcohol-testing': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>',
                'safety-assessments': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>',
                'maintenance-monitoring': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>',
                'my-drivers': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
                'my-customers': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
                'my-shippers-list': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
                'my-consignee-lists': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
                'my-brokers': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
                'violations': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
                'safety-violations': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
                'driver-violations': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
                'vehicle-violations': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
                'notifications': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>',
                'activity': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>',
                'maintenance': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
                'drug-alcohol': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>',
                'documents': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>',
                'permit-insurance': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>',
                'reporting': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>',
                'safety': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>',
                'hos': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                'settings': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
                'login-signup-tutorial': '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>'
            };

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

            // ===== Documentation & Video Features =====
            let videoFavorites = [];
            let videoProgress = {};

            function loadVideoUserData() {
                try {
                    videoFavorites = JSON.parse(localStorage.getItem('dispatch-video-favorites') || '[]');
                    videoProgress = JSON.parse(localStorage.getItem('dispatch-video-progress') || '{}');
                } catch (e) {
                    videoFavorites = [];
                    videoProgress = {};
                }
                updateVideoFavoriteButtons();
                updateVideoProgressBars();
            }

            function saveVideoUserData() {
                try {
                    localStorage.setItem('dispatch-video-favorites', JSON.stringify(videoFavorites));
                    localStorage.setItem('dispatch-video-progress', JSON.stringify(videoProgress));
                } catch (e) {}
            }

            function toggleVideoFavorite(sectionId, event) {
                if (event) event.stopPropagation();
                const index = videoFavorites.indexOf(sectionId);
                if (index === -1) {
                    videoFavorites.push(sectionId);
                } else {
                    videoFavorites.splice(index, 1);
                }
                saveVideoUserData();
                updateVideoFavoriteButtons();
            }

            function updateVideoFavoriteButtons() {
                videoFavorites.forEach(function(sectionId) {
                    const btn = document.getElementById('video-fav-' + sectionId);
                    if (btn) btn.classList.add('active');
                });
            }

            function updateVideoProgressBars() {
                Object.keys(videoProgress).forEach(function(sectionId) {
                    const progressBar = document.getElementById('video-progress-' + sectionId);
                    if (progressBar && videoProgress[sectionId].progress) {
                        progressBar.style.width = videoProgress[sectionId].progress + '%';
                    }
                });
            }

            function trackVideoProgress(sectionId, video) {
                video.ontimeupdate = function() {
                    if (video.duration && video.duration > 0) {
                        const progress = (video.currentTime / video.duration) * 100;
                        videoProgress[sectionId] = {
                            currentTime: video.currentTime,
                            duration: video.duration,
                            progress: progress,
                            timestamp: Date.now()
                        };
                        saveVideoUserData();

                        const progressBar = document.getElementById('video-progress-' + sectionId);
                        if (progressBar) {
                            progressBar.style.width = progress + '%';
                        }
                    }
                };
            }

            // Initialize video features
            document.addEventListener('DOMContentLoaded', function() {
                loadVideoUserData();

                // Sticky page-head shadow on scroll
                const pageHead = document.getElementById('page-head');
                if (pageHead) {
                    const onScroll = function() {
                        if (window.scrollY > 10) pageHead.classList.add('scrolled');
                        else pageHead.classList.remove('scrolled');
                    };
                    window.addEventListener('scroll', onScroll, { passive: true });
                    onScroll();
                }

                // Add progress tracking to all videos
                document.querySelectorAll('.video-frame video').forEach(function(video) {
                    const card = video.closest('.video-card');
                    if (card) {
                        const sectionId = card.id.replace('section-', '');
                        trackVideoProgress(sectionId, video);

                        // Restore progress if available
                        if (videoProgress[sectionId] && videoProgress[sectionId].currentTime > 0) {
                            video.currentTime = videoProgress[sectionId].currentTime;
                        }
                    }
                });
            });

            // Table of Contents
            function generateTOC(docId) {
                const doc = document.getElementById(docId);
                if (!doc) return;

                const headers = doc.querySelectorAll('.doc-body h4');
                if (headers.length === 0) return;

                const toc = document.createElement('div');
                toc.className = 'doc-toc';
                toc.innerHTML = '<h4>Contents</h4><ul class="toc-list"></ul>';
                const tocList = toc.querySelector('.toc-list');

                headers.forEach(function(header, index) {
                    const li = document.createElement('li');
                    li.className = 'toc-item';
                    li.textContent = header.textContent;
                    li.onclick = function() {
                        header.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        document.querySelectorAll('.toc-item').forEach(function(item) { item.classList.remove('active'); });
                        li.classList.add('active');
                    };
                    tocList.appendChild(li);
                });

                const docHeader = doc.querySelector('.doc-header');
                if (docHeader) {
                    docHeader.parentNode.insertBefore(toc, docHeader.nextSibling);
                }
            }

            function refreshPage() { location.reload(); }

            // Tour Guide logic moved to js/tour-guide.js

            // ===== Settings Panel — moved to js/dispatch.js =====

            // ===== Search Assistant =====
            const ASSISTANT_KEYWORDS = {
                'dashboard': ['dashboard', 'overview', 'statistics', 'home', 'main', 'summary', 'stats', 'report'],
                'my-loads': ['load', 'dispatch', 'assign', 'track', 'booking', 'delivery', 'shipment', 'freight'],
                'my-trucks': ['truck', 'vehicle', 'fleet truck', 'add truck', 'manage truck'],
                'my-trailers': ['trailer', 'add trailer', 'manage trailer', 'equipment'],
                'driver-devices': ['device', 'eld', 'mobile', 'phone', 'tablet', 'connection'],
                'truck-lease-pricing': ['lease', 'lease pricing', 'pricing', 'lease price', 'lease cost'],
                'truck-rentals': ['rental', 'rent', 'rent truck', 'short term', 'equipment rental'],
                'lease-agreements': ['agreement', 'contract', 'sign', 'lease agreement'],
                'hire-drivers': ['hire', 'recruit', 'onboard', 'new driver', 'hiring'],
                'job-postings': ['job', 'posting', 'career', 'job board', 'open position'],
                'external-drivers': ['external', 'owner operator', 'contractor', 'independent'],
                'shout-out-scripts': ['script', 'marketing script', 'shout out', 'shoutout'],
                'shout-out-vlogs': ['vlog', 'video blog', 'marketing video', 'shout out vlog'],
                'accounting': ['accounting', 'finance', 'invoice', 'bookkeeping', 'ledger'],
                'my-payroll': ['payroll', 'salary', 'pay', 'wages', 'compensation', 'driver pay'],
                'my-factoring-company': ['factoring', 'factor', 'invoice factoring', 'cash flow'],
                'fuel-reports': ['fuel', 'fuel report', 'fuel spending', 'fuel cost', 'diesel'],
                'my-fuel-cards': ['fuel card', 'card', 'spending limit', 'fuel payment'],
                'loans-cash-advance': ['loan', 'cash advance', 'borrow', 'credit', 'advance'],
                'api-integration-keys': ['api', 'integration', 'key', 'developer', 'webhook', 'integration key'],
                'my-fleet': ['fleet', 'fleet safety', 'fleet compliance', 'fleet management'],
                'emergency-monitoring': ['emergency', 'alert', 'sos', 'crash', 'incident'],
                'compliance-monitoring': ['compliance', 'monitor', 'regulation', 'dot', 'fmcsa'],
                'compliance-software-options': ['software', 'compliance software', 'integration', 'tool'],
                'drug-alcohol-testing': ['drug', 'alcohol', 'test', 'drug test', 'substance', 'dot test'],
                'safety-assessments': ['safety assessment', 'assessment', 'risk', 'safety review', 'evaluation'],
                'maintenance-monitoring': ['maintenance', 'repair', 'vehicle health', 'service', 'upkeep'],
                'my-drivers': ['driver', 'register driver', 'add driver', 'cdl', 'driver profile', 'new driver'],
                'my-customers': ['customer', 'client', 'add customer', 'manage customer'],
                'my-shippers-list': ['shipper', 'shipping', 'ship list'],
                'my-consignee-lists': ['consignee', 'receiver', 'delivery point', 'consignee list'],
                'my-brokers': ['broker', 'freight broker', 'add broker'],
                'violations': ['violation', 'compliance violation', 'infraction'],
                'safety-violations': ['safety violation', 'safety issue', 'safety infraction'],
                'driver-violations': ['driver violation', 'driver infraction', 'driver compliance'],
                'vehicle-violations': ['vehicle violation', 'truck violation', 'vehicle infraction'],
                'notifications': ['notification', 'alert', 'push', 'message', 'reminder'],
                'activity': ['activity', 'log', 'history', 'audit', 'activity log'],
                'maintenance': ['maintenance schedule', 'service schedule', 'pm', 'preventive'],
                'drug-alcohol': ['drug and alcohol', 'drug program', 'testing program', 'drug record'],
                'documents': ['document', 'file', 'upload', 'paperwork', 'doc'],
                'permit-insurance': ['permit', 'insurance', 'license', 'registration', 'certificate'],
                'reporting': ['report', 'reporting', 'analytics', 'insights', 'data'],
                'safety': ['safety', 'risk', 'safety metric', 'safety score', 'csa'],
                'hos': ['hos', 'hours of service', 'drive time', 'logbook', 'eld hours', 'duty status'],
                'settings': ['setting', 'config', 'configuration', 'preference', 'customize', 'account setting'],
                'login-signup-tutorial': ['login', 'sign up', 'signup', 'register', 'account', 'password', 'log in', 'authentication']
            };

            function togglePinTopbar() {
                var topbar = document.querySelector('.topbar');
                if (!topbar) return;
                topbar.classList.toggle('pinned');
                var pinned = topbar.classList.contains('pinned');
                try { localStorage.setItem('dispatch-topbar-pinned', pinned ? '1' : '0'); } catch (e) {}
                var btn = document.getElementById('pin-btn');
                if (btn) btn.title = pinned ? 'Unpin buttons (auto-hide)' : 'Pin buttons visible';
            }
            (function() {
                try {
                    if (localStorage.getItem('dispatch-topbar-pinned') === '1') {
                        document.addEventListener('DOMContentLoaded', function() {
                            var topbar = document.querySelector('.topbar');
                            if (topbar) { topbar.classList.add('pinned'); var btn = document.getElementById('pin-btn'); if (btn) btn.title = 'Unpin buttons (auto-hide)'; }
                        });
                    }
                } catch (e) {}
            })();

            // ===== Theme functions — moved to js/dispatch.js =====

            

            function toggleSidebar() {
                document.getElementById('sidebar').classList.toggle('open');
                document.getElementById('sidebar-overlay').classList.toggle('show');
            }

            function toggleSidebarFromTopbar() {
                if (window.innerWidth <= 900) {
                    toggleSidebar();
                } else {
                    toggleSidebarMini();
                    var btn = document.getElementById('menu-toggle-btn');
                    var sidebar = document.getElementById('sidebar');
                    if (sidebar.classList.contains('mini')) {
                        btn.classList.add('collapsed');
                        btn.title = 'Expand sidebar';
                    } else {
                        btn.classList.remove('collapsed');
                        btn.title = 'Collapse sidebar';
                    }
                }
            }

            function toggleSidebarMini() {
                const sidebar = document.getElementById('sidebar');
                const btn = document.getElementById('sidebar-toggle-btn');
                const topbarBtn = document.getElementById('menu-toggle-btn');
                const content = document.querySelector('.content');
                const isMini = sidebar.classList.contains('mini');
                if (isMini) {
                    sidebar.classList.remove('mini');
                    if (content) content.classList.remove('sidebar-mini');
                    btn.title = 'Collapse sidebar';
                    btn.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 19l-7-7 7-7M19 19l-7-7 7-7"/>';
                    if (topbarBtn) { topbarBtn.classList.remove('collapsed'); topbarBtn.title = 'Collapse sidebar'; }
                    try { localStorage.setItem('dispatch-sidebar-mini', 'false'); } catch (e) {}
                } else {
                    sidebar.classList.add('mini');
                    if (content) content.classList.add('sidebar-mini');
                    btn.title = 'Expand sidebar';
                    btn.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>';
                    if (topbarBtn) { topbarBtn.classList.add('collapsed'); topbarBtn.title = 'Expand sidebar'; }
                    // Close any open submenus
                    document.querySelectorAll('.submenu.expanded, .nav-link.expanded').forEach(function(el) {
                        el.classList.remove('expanded');
                    });
                    try { localStorage.setItem('dispatch-sidebar-mini', 'true'); } catch (e) {}
                }
            }

            // Add tooltips (data-tip) to all nav-links for mini mode
            function initSidebarTooltips() {
                document.querySelectorAll('.nav-link').forEach(function(link) {
                    if (link.classList.contains('has-submenu')) {
                        var span = link.querySelector('span');
                        if (span) {
                            var text = span.textContent.trim();
                            if (text) link.setAttribute('data-tip', text);
                        }
                    } else {
                        var text = link.textContent.trim();
                        if (text) link.setAttribute('data-tip', text);
                    }
                });
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

                const icon = SECTION_ICONS[sectionId];
                if (icon) {
                    document.getElementById('ph-icon').innerHTML = icon;
                }

                if (window.innerWidth <= 900) {
                    document.getElementById('sidebar').classList.remove('open');
                    document.getElementById('sidebar-overlay').classList.remove('show');
                }

                // Autoplay if enabled in settings
                const settings = loadSettings();
                if (settings['autoplay'] && target) {
                    const video = target.querySelector('video');
                    if (video) { try { video.play(); } catch (e) {} }
                }
            }

            function toggleSubmenu(submenuId, el, event) {
                event.preventDefault();
                event.stopPropagation();
                // In mini mode, expand the sidebar first instead of opening submenu
                var sidebar = document.getElementById('sidebar');
                if (sidebar.classList.contains('mini')) {
                    toggleSidebarMini();
                    return;
                }
                document.getElementById(submenuId).classList.toggle('expanded');
                el.classList.toggle('expanded');
            }

            // Hide loading screen on full page load
            window.addEventListener('load', function() {
                // TOC not generated for video documentation sections

                setTimeout(function() {
                    const loader = document.getElementById('loader-screen');
                    if (loader) loader.classList.add('hidden');
                    setTimeout(function() { if (loader) loader.style.display = 'none'; }, 600);
                }, 800);
            });

            document.addEventListener('DOMContentLoaded', function () {
                // Settings/theme init handled by js/dispatch.js
                // Initialize sidebar tooltips for mini mode
                initSidebarTooltips();
                // Restore sidebar mini state (desktop only)
                try {
                    if (localStorage.getItem('dispatch-sidebar-mini') === 'true' && window.innerWidth > 900) {
                        var sidebar = document.getElementById('sidebar');
                        var btn = document.getElementById('sidebar-toggle-btn');
                        var topbarBtn = document.getElementById('menu-toggle-btn');
                        var content = document.querySelector('.content');
                        sidebar.classList.add('mini');
                        if (content) content.classList.add('sidebar-mini');
                        btn.title = 'Expand sidebar';
                        btn.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>';
                        if (topbarBtn) { topbarBtn.classList.add('collapsed'); topbarBtn.title = 'Expand sidebar'; }
                    }
                } catch (e) {}
                // Tour auto-start handled by js/tour-guide.js
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
                // ===== Inject download buttons below each video frame =====
                document.querySelectorAll('.video-card').forEach(function(card) {
                    if (card.querySelector('.dl-btn-row')) return;
                    const frame = card.querySelector('.video-frame');
                    if (!frame) return;
                    const video = frame.querySelector('video source');
                    if (!video) return;
                    const src = video.getAttribute('src');
                    if (!src) return;
                    const filename = src.split('/').pop() || 'video.mp4';
                    const ext = (filename.split('.').pop() || 'mp4').toUpperCase();

                    const row = document.createElement('div');
                    row.className = 'dl-btn-row';
                    row.innerHTML =
                        '<a class="modal-download-btn" href="' + src + '" download="' + filename + '" title="Download video">' +
                            '<span class="dl-icon-wrap">' +
                                '<svg class="dl-arrow" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v11m0 0l-4-4m4 4l4-4"/></svg>' +
                                '<svg class="dl-check" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>' +
                                '<svg class="dl-ring" viewBox="0 0 36 36"><circle class="dl-ring-track" cx="18" cy="18" r="15" fill="none" stroke="currentColor" stroke-width="2"/><circle class="dl-ring-fill" cx="18" cy="18" r="15" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" transform="rotate(-90 18 18)"/></svg>' +
                            '</span>' +
                            '<span class="dl-label">Download File</span>' +
                        '</a>' +
                        '<span class="dl-btn-meta">' + ext + '</span>';
                    frame.parentNode.insertBefore(row, frame.nextSibling);

                    const btn = row.querySelector('.modal-download-btn');
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        if (btn.classList.contains('downloading') || btn.classList.contains('complete')) return;
                        const dlSrc = btn.href;
                        const dlName = btn.download;
                        const label = btn.querySelector('.dl-label');

                        btn.classList.add('downloading');
                        if (label) label.textContent = 'Downloading…';

                        setTimeout(function() {
                            btn.classList.remove('downloading');
                            btn.classList.add('complete');
                            if (label) label.textContent = 'Saved';
                            const tmp = document.createElement('a');
                            tmp.href = dlSrc;
                            tmp.download = dlName;
                            document.body.appendChild(tmp);
                            tmp.click();
                            document.body.removeChild(tmp);

                            setTimeout(function() {
                                btn.classList.remove('complete');
                                if (label) label.textContent = 'Download File';
                            }, 1800);
                        }, 1400);
                    });
                });
            });

        (function initDocsLinks() {
            const docIconSvg = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 3H7a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V8z"/><path d="M14 3v5h5"/><path d="M9 13h6M9 17h6"/></svg>';
            document.querySelectorAll('.section-content').forEach(function(section) {
                const videoCard = section.querySelector('.video-card');
                if (!videoCard) return;
                if (videoCard.querySelector('.docs-link')) return;
                const sectionId = section.id.replace('section-', '');
                const btn = document.createElement('a');
                btn.className = 'docs-link';
                // Keep the href as a fallback (middle-click / open-in-new-tab),
                // but a normal click opens the fullscreen doc modal inline so
                // the current page UI is preserved.
                btn.href = 'video_docs.php#doc-' + sectionId;
                btn.dataset.docId = sectionId;
                btn.innerHTML = docIconSvg + ' View Documentation';
                btn.addEventListener('click', function(e) {
                    if (e.metaKey || e.ctrlKey || e.shiftKey || e.button === 1) return;
                    e.preventDefault();
                    if (typeof window.openDocModal === 'function') {
                        window.openDocModal(sectionId);
                    } else {
                        window.location.href = btn.href;
                    }
                });
                videoCard.appendChild(btn);
            });
        })();

        // ===== Inline fullscreen documentation modal =====
        // Doc data injected from PHP (shared doc_data.php). Opens the selected
        // module's documentation full-screen without navigating away, so the
        // underlying page UI stays intact.
        (function initDocModal() {
            const overlay = document.getElementById('doc-modal-overlay');
            const body = document.getElementById('doc-modal-body');
            const closeBtn = document.getElementById('doc-modal-close');
            const watchLink = document.getElementById('doc-modal-watch');
            if (!overlay || !body) return;

            const DOC_DATA = window.DOC_DATA;
            const ALL_DOCS = Object.values(DOC_DATA);

            function buildSuggestedVideos(currentId, category) {
                const thumbSvg = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
                const sameCat = ALL_DOCS.filter(function(v) { return v.id !== currentId && v.category === category; });
                const others = ALL_DOCS.filter(function(v) { return v.id !== currentId && v.category !== category; });
                const suggestions = sameCat.concat(others).slice(0, 6);
                if (suggestions.length === 0) {
                    return '<div class="dm-suggest"><div class="dm-suggest-empty">No suggested videos available.</div></div>';
                }
                const cards = suggestions.map(function(v) {
                    const badge = v.available
                        ? '<span class="dm-suggest-badge available">Available</span>'
                        : '<span class="dm-suggest-badge coming">Coming Soon</span>';
                    const disabled = v.available ? '' : ' disabled';
                    const href = v.available ? 'tutorials.php#' + encodeURIComponent(v.id) : '#';
                    return '<a class="dm-suggest-card' + disabled + '" href="' + href + '"' + (v.available ? ' target="_blank" rel="noopener"' : '') + '>' +
                        '<div class="dm-suggest-thumb">' + thumbSvg + '</div>' +
                        '<div class="dm-suggest-info"><h5>' + escapeHtml(v.title) + '</h5><p>' + escapeHtml(v.desc) + '</p></div>' +
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

            function openModal(id) {
                const doc = DOC_DATA[id];
                if (!doc) return;
                const statusClass = doc.available ? 'available' : 'coming';
                const status = doc.available ? 'Available' : 'Coming Soon';
                const watchHref = 'tutorials.php#' + encodeURIComponent(id);
                if (watchLink) {
                    watchLink.href = watchHref;
                    watchLink.style.display = doc.available ? '' : 'none';
                }
                body.innerHTML =
                    '<article class="doc-modal-article">' +
                    '<div class="dm-category">' + escapeHtml(doc.category) + '</div>' +
                    '<h2>' + escapeHtml(doc.title) + '</h2>' +
                    '<div class="dm-meta">' +
                        '<span class="status-badge ' + statusClass + '">' + status + '</span>' +
                        '<span class="duration">' + escapeHtml(doc.duration) + '</span>' +
                    '</div>' +
                    '<div class="doc-rich-content">' + doc.docText + '</div>' +
                    '</article>' +
                    buildSuggestedVideos(id, doc.category);
                body.scrollTop = 0;
                overlay.classList.add('open');
                document.body.style.overflow = 'hidden';
            }

            function closeModal() {
                overlay.classList.remove('open');
                document.body.style.overflow = '';
            }

            window.openDocModal = openModal;
            window.closeDocModal = closeModal;

            if (closeBtn) closeBtn.addEventListener('click', closeModal);
            overlay.addEventListener('click', function(e) { if (e.target === overlay) closeModal(); });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && overlay.classList.contains('open')) closeModal();
            });
        })();
        (function initDocFloater() {
            const floater = document.getElementById('doc-floater');
            const titleEl = document.getElementById('doc-floater-title');
            const descEl = document.getElementById('doc-floater-desc');
            if (!floater) return;
            let hideTimer;
            function extractSectionId(link) {
                const onclick = link.getAttribute('onclick') || '';
                const m = onclick.match(/showSection\('([^']+)'/);
                if (m) return 'section-' + m[1];
                return link.dataset.section || (link.getAttribute('href') || '').replace('#','') || '';
            }
            function showFloater(link) {
                const sectionId = extractSectionId(link);
                if (!sectionId) return;
                const section = document.getElementById(sectionId);
                if (!section) return;
                const heading = section.querySelector('.doc-title h3') || section.querySelector('h3') || section.querySelector('h2') || section.querySelector('h1');
                const paragraph = section.querySelector('.doc-title p') || section.querySelector('.video-desc') || section.querySelector('p');
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
            document.querySelectorAll('.nav-link').forEach(function(link) {
                if (link.closest('.submenu')) return;
                link.addEventListener('mouseenter', function() { clearTimeout(hideTimer); showFloater(this); });
                link.addEventListener('mouseleave', function() { hideTimer = setTimeout(hideFloater, 160); });
            });
            floater.addEventListener('mouseenter', function() { clearTimeout(hideTimer); });
            floater.addEventListener('mouseleave', function() { hideTimer = setTimeout(hideFloater, 160); });
        })();
