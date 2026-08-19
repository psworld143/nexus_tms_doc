/* ===== DISPATCH Tour Guide / Onboarding ===== */
/* Shared across all pages — loaded via <script> before </body> */

(function () {
    'use strict';

    // ===== Page-aware tour steps =====
    var TOUR_STEPS = {
        // index.php — dashboard
        home: [
            { target: '.brand', title: 'Welcome to DISPATCH!', desc: 'This is your video tutorial library for the DISPATCH trucking management system. It covers 47 modules across Operations, Fleet, Finance, Safety, Compliance, and more. Let me show you around.', action: null },
            { target: '#sidebar-search', title: 'Search Tutorials', desc: 'Type here to search through all 47 tutorial sections. The sidebar filters in real-time as you type — matching titles, categories, and sub-items instantly.', action: null },
            { target: '.nav-section-title.main-menu', title: 'Navigation Categories', desc: 'Browse tutorials by category — Operations & Dispatch, Fleet Management, Lease Management, Recruitment, Marketing, Financial, Safety & Compliance, Customer Relations, and System. Click any item to jump to that section.', action: null },
            { target: '#sidebar-toggle-btn', title: 'Collapse the Sidebar', desc: 'Click this button to collapse the sidebar into a compact icon-only mode for more screen space, or expand it back to full width. Your preference is saved automatically.', action: null },
            { target: '.page-head', title: 'Section Header', desc: 'This header shows the title and description of the tutorial section you are currently viewing. It stays at the top of the content area as you navigate.', action: null },
            { target: '.icon-btn.tutorials-btn', title: 'Tutorial Gallery', desc: 'Click this button to open the standalone tutorial gallery — a full grid view of every video with search, category filters, watch history, and a full-screen modal player.', action: null },
            { target: '.icon-btn.docs-btn', title: 'Documentation', desc: 'This button opens the searchable documentation index. Next to it is the Video Docs button, which shows documentation cards that open a fullscreen reader modal.', action: null },
            { target: '.icon-btn.settings-btn-top', title: 'Settings Panel', desc: 'Customize your experience — change the accent color, adjust font size, toggle dark mode, set video autoplay, enable accessibility features, and sync search across panels.', action: null },
            { target: '.icon-btn.theme-btn', title: 'Dark & Light Theme', desc: 'Toggle between dark and light mode with one click. Your preference is saved automatically and persists across page reloads and all DISPATCH pages.', action: null },
            { target: '.icon-btn.tour-btn', title: "You're All Set!", desc: "That's the tour! Click this button anytime to replay it. Use the sidebar to browse all 47 tutorials, the search bar for quick lookup, or the gallery button for the full video grid.", action: null }
        ],
        // tutorials.php
        tutorials: [
            { target: '.hero', title: 'Video Tutorial Library', desc: 'Welcome to the DISPATCH video tutorial gallery. Every tutorial is listed here as a card with a thumbnail, title, duration, and category badge.', action: null },
            { target: '.search-bar', title: 'Search Tutorials', desc: 'Type here to instantly filter the video grid by title or description. Results update in real-time as you type.', action: null },
            { target: '.filters', title: 'Category Filters', desc: 'Click any category chip to filter videos by section — Main, Operations, Fleet, Finance, Safety, Compliance, or Account. Click "All" to reset.', action: null },
            { target: '.video-grid', title: 'Video Cards', desc: 'Click any card to open the full-screen video player modal. Cards show a play overlay, duration badge, and category tag. Available videos have a green badge.', action: null },
            { target: '.icon-btn.settings-btn-top', title: 'Settings', desc: 'Open settings to customize autoplay, playback speed, font size, accent color, dark mode, and accessibility options like reduce-motion and high-contrast.', action: null },
            { target: '.icon-btn.theme-btn', title: 'Theme Toggle', desc: 'Switch between dark and light mode. Your choice is saved and synced across all DISPATCH pages.', action: null },
            { target: '.icon-btn.tour-btn', title: "You're All Set!", desc: "That's the tour! Use the search bar and filters to find tutorials, click any card to watch, and revisit this tour anytime via this button.", action: null }
        ],
        // video_docs.php
        'video-docs': [
            { target: '.topbar', title: 'Video Documentation', desc: 'Welcome to the DISPATCH video documentation page. Here you\'ll find in-depth written guides for every feature, presented as searchable cards.', action: null },
            { target: '.vd-search', title: 'Search Documentation', desc: 'Type here to instantly filter documentation cards by title or content. Results update in real-time as you type.', action: null },
            { target: '.vd-filter', title: 'Category Filters', desc: 'Click any filter chip to narrow the documentation by category. Use this to quickly find guides for a specific module area.', action: null },
            { target: '.vd-grid', title: 'Documentation Cards', desc: 'Each card represents a documentation article. Click a card to open the full-screen reader modal with the complete guide text.', action: null },
            { target: '.icon-btn.tour-btn', title: "You're All Set!", desc: "That's the tour! Use search and filters to find documentation, click any card to read the full guide, and replay this tour anytime.", action: null }
        ]
    };

    // Detect which page we're on
    function getPageKey() {
        var path = window.location.pathname.split('/').pop() || '';
        if (path === 'index.php' || path === '' || path === '/') return 'home';
        if (path === 'tutorials.php') return 'tutorials';
        if (path === 'video_docs.php') return 'video-docs';
        return 'home';
    }

    var steps = TOUR_STEPS[getPageKey()] || TOUR_STEPS.home;
    var tourCurrentStep = 0;
    var tourActive = false;

    // ===== Inject tour HTML if not present =====
    function ensureTourHTML() {
        if (document.getElementById('tour-overlay')) return;
        var html = '<div class="tour-overlay" id="tour-overlay">' +
            '<div class="tour-highlight" id="tour-highlight"></div>' +
            '<div class="tour-tooltip" id="tour-tooltip">' +
                '<div class="tour-tooltip-header">' +
                    '<div class="tour-step-badge">' +
                        '<span class="badge-num" id="tour-badge-num">1</span>' +
                        '<span id="tour-step-label">Step 1 of 1</span>' +
                    '</div>' +
                    '<div class="tour-progress" id="tour-progress"></div>' +
                '</div>' +
                '<div class="tour-tooltip-body">' +
                    '<div class="tour-title" id="tour-title">Welcome!</div>' +
                    '<div class="tour-desc" id="tour-desc">Let\'s take a quick tour.</div>' +
                    '<div class="tour-controls">' +
                        '<button class="tour-btn-control" id="tour-prev">Back</button>' +
                        '<button class="tour-btn-control primary" id="tour-next">Next</button>' +
                        '<button class="tour-skip" id="tour-skip">Skip tour</button>' +
                    '</div>' +
                '</div>' +
            '</div>' +
        '</div>';
        var div = document.createElement('div');
        div.innerHTML = html;
        document.body.appendChild(div.firstChild);

        // Wire buttons
        document.getElementById('tour-prev').addEventListener('click', tourPrev);
        document.getElementById('tour-next').addEventListener('click', tourNext);
        document.getElementById('tour-skip').addEventListener('click', endTour);
    }

    // ===== Inject tour button into topbar if not present =====
    function ensureTourButton() {
        if (document.querySelector('.icon-btn.tour-btn')) return;
        var actions = document.querySelector('.header-actions') || document.querySelector('.topbar-actions') || document.querySelector('.topbar .flex');
        if (!actions) {
            // Fallback: find the topbar and append
            var topbar = document.querySelector('.topbar') || document.querySelector('header');
            if (!topbar) return;
            var wrap = document.createElement('div');
            wrap.style.cssText = 'display:flex;align-items:center;gap:0.6rem;margin-left:auto;';
            topbar.appendChild(wrap);
            actions = wrap;
        }
        var btn = document.createElement('button');
        btn.className = 'icon-btn tour-btn';
        btn.title = 'Start Tour Guide';
        btn.setAttribute('aria-label', 'Start tour guide');
        btn.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 9m0 8V9m0 0L9 7"/></svg>';
        btn.addEventListener('click', startTour);
        actions.appendChild(btn);
    }

    // ===== Tour logic =====
    function startTour() {
        ensureTourHTML();
        tourActive = true;
        tourCurrentStep = 0;
        document.getElementById('tour-overlay').classList.add('active');
        var btn = document.querySelector('.icon-btn.tour-btn');
        if (btn) btn.classList.add('touring');
        document.body.style.overflow = 'hidden';
        renderTourProgress();
        showTourStep(0);
    }

    function showTourStep(index) {
        if (index < 0 || index >= steps.length) return;
        tourCurrentStep = index;
        var step = steps[index];

        if (step.action) { try { step.action(); } catch (e) {} }

        setTimeout(function () {
            var target = document.querySelector(step.target);
            var highlight = document.getElementById('tour-highlight');
            var tooltip = document.getElementById('tour-tooltip');

            if (!target) {
                highlight.style.display = 'none';
                tooltip.style.top = '50%';
                tooltip.style.left = '50%';
                tooltip.style.transform = 'translate(-50%, -50%)';
                tooltip.className = 'tour-tooltip';
            } else {
                var rect = target.getBoundingClientRect();
                var padding = 8;
                highlight.style.display = 'block';
                highlight.style.top = (rect.top - padding) + 'px';
                highlight.style.left = (rect.left - padding) + 'px';
                highlight.style.width = (rect.width + padding * 2) + 'px';
                highlight.style.height = (rect.height + padding * 2) + 'px';

                tooltip.style.visibility = 'hidden';
                tooltip.style.top = '0px';
                tooltip.style.left = '0px';
                tooltip.style.transform = 'none';
                var tw = tooltip.offsetWidth || 340;
                var th = tooltip.offsetHeight || 220;
                tooltip.style.visibility = 'visible';

                var gap = 16;
                var targetCenterX = rect.left + rect.width / 2;
                var targetCenterY = rect.top + rect.height / 2;
                var tooltipTop, tooltipLeft, arrowClass = '';
                var arrowX = 24, arrowY = 24;

                var canFitBelow = rect.bottom + th + gap + 20 < window.innerHeight;
                var canFitAbove = rect.top - th - gap - 20 > 0;
                var canFitRight = rect.right + tw + gap + 16 < window.innerWidth;
                var canFitLeft = rect.left - tw - gap - 16 > 0;

                if (canFitBelow) {
                    tooltipTop = rect.bottom + gap;
                    tooltipLeft = Math.max(16, Math.min(targetCenterX - tw / 2, window.innerWidth - tw - 16));
                    arrowClass = 'arrow-top';
                    arrowX = Math.max(20, Math.min(targetCenterX - tooltipLeft, tw - 40));
                } else if (canFitAbove) {
                    tooltipTop = rect.top - th - gap;
                    tooltipLeft = Math.max(16, Math.min(targetCenterX - tw / 2, window.innerWidth - tw - 16));
                    arrowClass = 'arrow-bottom';
                    arrowX = Math.max(20, Math.min(targetCenterX - tooltipLeft, tw - 40));
                } else if (canFitRight) {
                    tooltipTop = Math.max(16, Math.min(targetCenterY - th / 2, window.innerHeight - th - 16));
                    tooltipLeft = rect.right + gap;
                    arrowClass = 'arrow-left';
                    arrowY = Math.max(20, Math.min(targetCenterY - tooltipTop, th - 40));
                } else if (canFitLeft) {
                    tooltipTop = Math.max(16, Math.min(targetCenterY - th / 2, window.innerHeight - th - 16));
                    tooltipLeft = rect.left - tw - gap;
                    arrowClass = 'arrow-right';
                    arrowY = Math.max(20, Math.min(targetCenterY - tooltipTop, th - 40));
                } else {
                    tooltipTop = Math.max(16, rect.bottom + gap);
                    tooltipLeft = Math.max(16, Math.min(targetCenterX - tw / 2, window.innerWidth - tw - 16));
                    arrowClass = 'arrow-top';
                    arrowX = Math.max(20, Math.min(targetCenterX - tooltipLeft, tw - 40));
                }

                tooltip.style.top = tooltipTop + 'px';
                tooltip.style.left = tooltipLeft + 'px';
                tooltip.style.transform = 'none';
                tooltip.className = 'tour-tooltip ' + arrowClass;
                tooltip.style.setProperty('--arrow-x', arrowX + 'px');
                tooltip.style.setProperty('--arrow-y', arrowY + 'px');
            }

            document.getElementById('tour-badge-num').textContent = (index + 1);
            document.getElementById('tour-step-label').textContent = 'Step ' + (index + 1) + ' of ' + steps.length;
            document.getElementById('tour-title').textContent = step.title;
            document.getElementById('tour-desc').textContent = step.desc;

            document.getElementById('tour-prev').disabled = (index === 0);
            var nextBtn = document.getElementById('tour-next');
            nextBtn.textContent = (index === steps.length - 1) ? 'Finish' : 'Next';

            document.querySelectorAll('.tour-dot').forEach(function (dot, i) {
                dot.classList.remove('done', 'current');
                if (i < index) dot.classList.add('done');
                else if (i === index) dot.classList.add('current');
            });
        }, 100);
    }

    function renderTourProgress() {
        var progress = document.getElementById('tour-progress');
        progress.innerHTML = '';
        for (var i = 0; i < steps.length; i++) {
            var dot = document.createElement('div');
            dot.className = 'tour-dot';
            progress.appendChild(dot);
        }
    }

    function tourNext() {
        if (tourCurrentStep < steps.length - 1) {
            showTourStep(tourCurrentStep + 1);
        } else {
            endTour();
        }
    }

    function tourPrev() {
        if (tourCurrentStep > 0) { showTourStep(tourCurrentStep - 1); }
    }

    function endTour() {
        tourActive = false;
        var overlay = document.getElementById('tour-overlay');
        if (overlay) overlay.classList.remove('active');
        var btn = document.querySelector('.icon-btn.tour-btn');
        if (btn) btn.classList.remove('touring');
        document.body.style.overflow = '';
        try { localStorage.setItem('dispatch-tour-completed', 'true'); } catch (e) {}
    }

    // ===== Keyboard navigation =====
    document.addEventListener('keydown', function (e) {
        if (!tourActive) return;
        if (e.key === 'Escape') { e.preventDefault(); endTour(); }
        else if (e.key === 'ArrowRight') { e.preventDefault(); tourNext(); }
        else if (e.key === 'ArrowLeft') { e.preventDefault(); tourPrev(); }
    });

    // ===== Reposition on resize/scroll =====
    window.addEventListener('resize', function () {
        if (tourActive) showTourStep(tourCurrentStep);
    });

    // ===== Expose to global scope =====
    window.startTour = startTour;
    window.endTour = endTour;
    window.tourNext = tourNext;
    window.tourPrev = tourPrev;

    // ===== Init on DOM ready =====
    function init() {
        ensureTourButton();
        // Auto-start for first-time visitors
        try {
            if (localStorage.getItem('dispatch-tour-completed') !== 'true') {
                setTimeout(function () { startTour(); }, 1500);
            }
        } catch (e) {}
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
