// js/reels.js — Facebook Reels-style vertical scroll for DISPATCH index.php
// Converts the main content area into a full-screen vertical snap-scroll feed.
// Sidebar nav clicks jump to the corresponding reel.
// Videos auto-play when scrolled into view and pause when scrolled out.
// Does NOT modify any existing HTML structure, sidebar, topbar, or chrome.

(function () {
    'use strict';

    var REELS_ACTIVE = false;
    var sections = [];
    var indicator = null;
    var activeIndex = 0;
    var io = null;
    var contentEl = null;

    // ===== Inject reel info overlays into each section =====
    function injectReelInfo() {
        if (typeof SECTION_META === 'undefined') return;
        document.querySelectorAll('.section-content').forEach(function (section) {
            if (section.querySelector('.reel-info')) return;
            var sectionId = section.id.replace(/^section-/, '');
            var meta = SECTION_META[sectionId];
            if (!meta) return;

            var info = document.createElement('div');
            info.className = 'reel-info';
            info.innerHTML =
                '<h3 class="reel-title">' + escapeHtml(meta[0]) + '</h3>' +
                '<p class="reel-subtitle">' + escapeHtml(meta[1]) + '</p>';
            section.appendChild(info);
        });

        // Inject progress bars into all video frames (like Dashboard)
        injectVideoFeatures();
    }

    // ===== Inject progress bar into all video frames =====
    function injectVideoFeatures() {
        document.querySelectorAll('.section-content').forEach(function (section) {
            var sectionId = section.id.replace(/^section-/, '');
            var frame = section.querySelector('.video-frame');
            if (!frame) return;

            // Add progress bar if missing
            if (!frame.querySelector('.progress-bar')) {
                var bar = document.createElement('div');
                bar.className = 'progress-bar';
                var fill = document.createElement('div');
                fill.className = 'progress-fill';
                fill.id = 'video-progress-' + sectionId;
                fill.style.width = '0%';
                bar.appendChild(fill);
                frame.appendChild(bar);
            }

            // Wire progress tracking if not already done
            var video = frame.querySelector('video');
            if (video && !video.dataset.reelProgressBound) {
                video.dataset.reelProgressBound = '1';
                video.addEventListener('timeupdate', function () {
                    if (video.duration && video.duration > 0) {
                        var progress = (video.currentTime / video.duration) * 100;
                        var fillEl = document.getElementById('video-progress-' + sectionId);
                        if (fillEl) fillEl.style.width = progress + '%';
                    }
                });
            }
        });
    }

    // ===== Build scroll indicator dots =====
    function buildIndicator() {
        if (indicator) return;
        indicator = document.createElement('div');
        indicator.className = 'reel-indicator';
        indicator.setAttribute('aria-hidden', 'true');

        sections.forEach(function (s, i) {
            var dot = document.createElement('div');
            dot.className = 'reel-indicator-dot';
            if (i === 0) dot.classList.add('active');
            indicator.appendChild(dot);
        });

        document.body.appendChild(indicator);
    }

    function updateIndicator(index) {
        if (!indicator) return;
        var dots = indicator.querySelectorAll('.reel-indicator-dot');
        dots.forEach(function (d, i) {
            d.classList.toggle('active', i === index);
        });
    }

    // ===== IntersectionObserver: detect active section, auto-play/pause =====
    function setupIntersectionObserver() {
        if (!('IntersectionObserver' in window)) return;
        io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) {
                    // Pause video when section leaves view
                    var video = entry.target.querySelector('video');
                    if (video && !video.paused) {
                        video.pause();
                    }
                    entry.target.classList.remove('is-active');
                    return;
                }

                // This section is now the active one
                var ratio = entry.intersectionRatio;
                if (ratio < 0.5) return;

                // Remove active from all, set this one
                sections.forEach(function (s) { s.classList.remove('is-active'); });
                entry.target.classList.add('is-active');

                // Update active index + chrome
                var idx = sections.indexOf(entry.target);
                if (idx >= 0) {
                    if (idx !== activeIndex) {
                        activeIndex = idx;
                        updateIndicator(idx);
                        updateSidebarActive(idx);
                        updatePageHead(idx);
                    }
                    // Always auto-play the video when it becomes active (Facebook Reels behavior)
                    var activeVideo = entry.target.querySelector('video');
                    if (activeVideo && !activeVideo.closest('.video-empty')) {
                        // Mute to satisfy browser autoplay policies
                        activeVideo.muted = true;
                        try {
                            activeVideo.play().catch(function () {});
                        } catch (e) {}
                    }
                }
            });
        }, {
            root: contentEl,
            threshold: [0.5, 0.75, 1.0]
        });

        sections.forEach(function (s) { io.observe(s); });

        // Wire play/pause events to auto-hide title overlay
        wireVideoPlayPause();
    }

    // ===== Wire play/pause events to toggle title overlay visibility =====
    function wireVideoPlayPause() {
        sections.forEach(function (section) {
            var video = section.querySelector('video');
            if (!video) return;
            if (video.dataset.reelPlayBound === '1') return;
            video.dataset.reelPlayBound = '1';

            video.addEventListener('play', function () {
                section.classList.add('video-playing');
            });
            video.addEventListener('pause', function () {
                section.classList.remove('video-playing');
            });
            video.addEventListener('ended', function () {
                section.classList.remove('video-playing');
            });
        });
    }

    // ===== Update sidebar active link based on scroll position =====
    function updateSidebarActive(index) {
        var section = sections[index];
        if (!section) return;
        var sectionId = section.id.replace(/^section-/, '');
        var activeLink = null;

        document.querySelectorAll('.nav-link').forEach(function (link) {
            var onclick = link.getAttribute('onclick') || '';
            var m = onclick.match(/showSection\('([^']+)'/);
            if (m && m[1] === sectionId) {
                link.classList.add('active');
                activeLink = link;
            } else {
                link.classList.remove('active');
            }
        });

        // Scroll the sidebar to keep the active link visible
        if (activeLink) {
            var sidebar = document.getElementById('sidebar');
            if (!sidebar) return;
            var linkRect = activeLink.getBoundingClientRect();
            var sidebarRect = sidebar.getBoundingClientRect();
            // If the active link is outside the visible area, scroll to it
            if (linkRect.top < sidebarRect.top + 60 || linkRect.bottom > sidebarRect.bottom - 60) {
                activeLink.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    }

    // ===== Update page-head title/subtitle/icon =====
    function updatePageHead(index) {
        var section = sections[index];
        if (!section) return;
        var sectionId = section.id.replace(/^section-/, '');

        if (typeof SECTION_META !== 'undefined' && SECTION_META[sectionId]) {
            var titleEl = document.getElementById('page-title');
            var subtitleEl = document.getElementById('page-subtitle');
            if (titleEl) titleEl.textContent = SECTION_META[sectionId][0];
            if (subtitleEl) subtitleEl.textContent = SECTION_META[sectionId][1];
        }

        if (typeof SECTION_ICONS !== 'undefined' && SECTION_ICONS[sectionId]) {
            var iconEl = document.getElementById('ph-icon');
            if (iconEl) iconEl.innerHTML = SECTION_ICONS[sectionId];
        }
    }

    // ===== Scroll to a specific section (called by sidebar nav) =====
    function scrollToSection(sectionId) {
        var target = document.getElementById('section-' + sectionId);
        if (!target) return;
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // ===== Activate reels mode =====
    function activateReels() {
        if (REELS_ACTIVE) return;
        REELS_ACTIVE = true;

        contentEl = document.querySelector('.content');
        if (!contentEl) return;

        contentEl.classList.add('reels-active');
        document.body.classList.add('reels-mode');

        // Gather all sections in DOM order
        sections = Array.prototype.slice.call(
            contentEl.querySelectorAll('.section-content')
        );

        // Inject reel info overlays
        injectReelInfo();

        // Build UI elements
        buildIndicator();

        // Set up IntersectionObserver for auto-play/pause
        setupIntersectionObserver();

        // Mark first section as active and auto-play its video
        if (sections.length > 0) {
            sections[0].classList.add('is-active');
            var firstVideo = sections[0].querySelector('video');
            if (firstVideo && !firstVideo.closest('.video-empty')) {
                firstVideo.muted = true;
                try { firstVideo.play().catch(function () {}); } catch (e) {}
            }
        }

        // Override showSection to scroll instead of toggle display
        overrideShowSection();

        // Pause all videos except the first on init
        sections.forEach(function (s, i) {
            if (i > 0) {
                var v = s.querySelector('video');
                if (v) { try { v.pause(); } catch (e) {} }
            }
        });
    }

    // ===== Override showSection to scroll in reels mode =====
    function overrideShowSection() {
        var origShowSection = window.showSection;
        if (typeof origShowSection !== 'function') return;

        window.showSection = function (sectionId, el) {
            if (REELS_ACTIVE) {
                // Scroll to the target section
                scrollToSection(sectionId);

                // Update active nav link
                document.querySelectorAll('.nav-link').forEach(function (l) {
                    l.classList.remove('active');
                });
                if (el) el.classList.add('active');

                // Update page-head
                updatePageHeadById(sectionId);

                // Close mobile sidebar
                if (window.innerWidth <= 900) {
                    var sidebar = document.getElementById('sidebar');
                    var overlay = document.getElementById('sidebar-overlay');
                    if (sidebar) sidebar.classList.remove('open');
                    if (overlay) overlay.classList.remove('show');
                }

                return;
            }

            // Fallback to original behavior
            return origShowSection.apply(this, arguments);
        };
    }

    function updatePageHeadById(sectionId) {
        if (typeof SECTION_META !== 'undefined' && SECTION_META[sectionId]) {
            var titleEl = document.getElementById('page-title');
            var subtitleEl = document.getElementById('page-subtitle');
            if (titleEl) titleEl.textContent = SECTION_META[sectionId][0];
            if (subtitleEl) subtitleEl.textContent = SECTION_META[sectionId][1];
        }
        if (typeof SECTION_ICONS !== 'undefined' && SECTION_ICONS[sectionId]) {
            var iconEl = document.getElementById('ph-icon');
            if (iconEl) iconEl.innerHTML = SECTION_ICONS[sectionId];
        }
    }

    // ===== Helpers =====
    function escapeHtml(s) {
        return String(s || '').replace(/[&<>"']/g, function (c) {
            return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
        });
    }

    // ===== Init =====
    function init() {
        // Activate reels mode
        activateReels();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Expose for debugging
    window.DISPATCH_REELS = {
        activate: activateReels,
        scrollTo: scrollToSection,
        getActiveIndex: function () { return activeIndex; }
    };
})();
