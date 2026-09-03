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
    var indicatorScroll = null;

    function buildIndicator() {
        if (indicator) return;
        indicator = document.createElement('div');
        indicator.className = 'reel-indicator';
        indicator.setAttribute('aria-hidden', 'true');

        indicatorScroll = document.createElement('div');
        indicatorScroll.className = 'reel-indicator-scroll';

        sections.forEach(function (s, i) {
            var sectionId = s.id.replace(/^section-/, '');
            var meta = (typeof SECTION_META !== 'undefined' && SECTION_META[sectionId]) ? SECTION_META[sectionId] : null;
            var label = meta ? meta[0] : sectionId.replace(/-/g, ' ');

            var item = document.createElement('div');
            item.className = 'reel-indicator-item';
            item.setAttribute('role', 'button');
            item.setAttribute('tabindex', '0');
            item.setAttribute('aria-label', 'Jump to ' + label);
            item.dataset.index = i;
            if (i === 0) item.classList.add('active');

            var dot = document.createElement('div');
            dot.className = 'reel-indicator-dot';

            var name = document.createElement('span');
            name.className = 'reel-indicator-name';
            name.textContent = label;

            item.appendChild(dot);
            item.appendChild(name);

            item.addEventListener('click', function() { jumpToReel(i); });
            item.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); jumpToReel(i); }
            });

            indicatorScroll.appendChild(item);
        });

        indicator.appendChild(indicatorScroll);
        document.body.appendChild(indicator);
    }

    function updateIndicator(index) {
        if (!indicator) return;
        var items = indicator.querySelectorAll('.reel-indicator-item');
        items.forEach(function (item, i) {
            item.classList.toggle('active', i === index);
            item.classList.remove('preview');
            if (item.classList.contains('active')) {
                item.setAttribute('aria-current', 'true');
            } else {
                item.removeAttribute('aria-current');
            }
        });
        // Auto-scroll the indicator to keep the active item centered
        var scrollEl = indicatorScroll || indicator;
        var activeItem = items[index];
        if (activeItem) {
            var itemTop = activeItem.offsetTop;
            var itemHeight = activeItem.offsetHeight;
            var scrollTop = itemTop - (scrollEl.clientHeight / 2) + (itemHeight / 2);
            scrollEl.scrollTop = scrollTop;
        }
    }

    function updateIndicatorPreview(index) {
        if (!indicator) return;
        var items = indicator.querySelectorAll('.reel-indicator-item');
        items.forEach(function (item, i) {
            if (i === index) {
                if (!item.classList.contains('active')) {
                    item.classList.add('preview');
                }
            } else {
                item.classList.remove('preview');
            }
        });
        // Auto-scroll the indicator to follow the preview item
        var scrollEl = indicatorScroll || indicator;
        var previewItem = items[index];
        if (previewItem) {
            var itemTop = previewItem.offsetTop;
            var itemHeight = previewItem.offsetHeight;
            var scrollTop = itemTop - (scrollEl.clientHeight / 2) + (itemHeight / 2);
            scrollEl.scrollTop = scrollTop;
        }
    }

    // ===== Scroll-based active section detection (more accurate than IO for snap) =====
    var scrollTimer = null;

    function setupScrollDetection() {
        contentEl.addEventListener('scroll', function () {
            if (scrollTimer) cancelAnimationFrame(scrollTimer);
            scrollTimer = requestAnimationFrame(detectActiveSection);
        }, { passive: true });

        // Also detect on init
        detectActiveSection();
    }

    function detectActiveSection() {
        if (!contentEl) return;
        var scrollTop = contentEl.scrollTop;
        var sectionHeight = contentEl.clientHeight;
        // Calculate which section is most visible (floor for preview, round for active)
        var previewIdx = Math.floor((scrollTop + sectionHeight * 0.3) / sectionHeight);
        previewIdx = Math.max(0, Math.min(sections.length - 1, previewIdx));
        var idx = Math.round(scrollTop / sectionHeight);
        idx = Math.max(0, Math.min(sections.length - 1, idx));

        // Real-time preview tracking during scroll
        if (previewIdx !== idx) {
            updateIndicatorPreview(previewIdx);
        } else {
            // Clear preview when settled on a section
            var previewItems = indicator ? indicator.querySelectorAll('.reel-indicator-item.preview') : [];
            previewItems.forEach(function (item) { item.classList.remove('preview'); });
        }

        // Pause all videos except the active one
        sections.forEach(function (s, i) {
            if (i !== idx) {
                var v = s.querySelector('video');
                if (v && !v.paused) v.pause();
                s.classList.remove('is-active');
            }
        });

        // Set active section
        var active = sections[idx];
        if (active) {
            active.classList.add('is-active');

            if (idx !== activeIndex) {
                activeIndex = idx;
                updateIndicator(idx);
                updateSidebarActive(idx);
                updatePageHead(idx);
            }

            // Auto-play the active video (muted)
            var activeVideo = active.querySelector('video');
            if (activeVideo && !activeVideo.closest('.video-empty') && activeVideo.paused) {
                activeVideo.muted = true;
                try { activeVideo.play().catch(function () {}); } catch (e) {}
            }
        }
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

    // ===== Jump to a reel by index (called by indicator dots) =====
    function jumpToReel(index) {
        if (!sections[index]) return;
        sections[index].scrollIntoView({ behavior: 'smooth', block: 'start' });
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

        // Set up scroll-based detection (also handles initial active state)
        setupScrollDetection();

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
