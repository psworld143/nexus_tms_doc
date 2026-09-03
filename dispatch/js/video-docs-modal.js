// video-docs-modal.js — Documentation modal, suggested videos, and hash scroll
// Used by video_docs.php. Expects window.ALL_VIDEOS to be set before this loads.

(function() {
    'use strict';

    // ===== Suggested videos =====
    function buildSuggestedVideos(currentId, category) {
        const thumbSvg = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
        var sameCat = window.ALL_VIDEOS.filter(function(v) { return v.id !== currentId && v.category === category; });
        var others = window.ALL_VIDEOS.filter(function(v) { return v.id !== currentId && v.category !== category; });
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

    // ===== Doc modal =====
    function initDocModal() {
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
            const desc = card.dataset.docHtml || card.querySelector('p').textContent;
            const category = card.dataset.category || '';
            const statusClass = card.dataset.status;
            const status = statusClass === 'available' ? 'Available' : 'Coming Soon';
            const durationEl = card.querySelector('.duration');
            const duration = durationEl ? durationEl.textContent : '';
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
                    (duration ? '<span class="duration">' + escapeHtml(duration) + '</span>' : '') +
                '</div>' +
                '<div class="doc-rich-content">' + desc + '</div>' +
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

        if (close) close.addEventListener('click', window.closeDocModal);
        overlay.addEventListener('click', function(e) { if (e.target === overlay) window.closeDocModal(); });
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape' && overlay.classList.contains('open')) window.closeDocModal(); });
    }

    // ===== Hash scroll =====
    function initHashScroll() {
        function scrollToDoc() {
            const hash = window.location.hash;
            if (!hash) return;
            const card = document.querySelector(hash);
            if (!card || !card.classList.contains('doc-card')) return;
            card.scrollIntoView({ behavior: 'smooth', block: 'center' });
            card.classList.add('highlight-flash');
            setTimeout(function() { card.classList.remove('highlight-flash'); }, 2500);
        }
        if (document.readyState === 'complete') scrollToDoc();
        else window.addEventListener('load', scrollToDoc);
    }

    // ===== Init on DOM ready =====
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            initDocModal();
            initHashScroll();
        });
    } else {
        initDocModal();
        initHashScroll();
    }
})();
