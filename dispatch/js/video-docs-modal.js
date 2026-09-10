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

    // ===== "Was this helpful?" feedback footer =====
    var FEEDBACK_KEY = 'dispatch-doc-feedback';

    function getFeedbackMap() {
        try { return JSON.parse(localStorage.getItem(FEEDBACK_KEY) || '{}'); }
        catch (e) { return {}; }
    }

    function setFeedback(id, value) {
        var map = getFeedbackMap();
        map[id] = value;
        try { localStorage.setItem(FEEDBACK_KEY, JSON.stringify(map)); } catch (e) {}
    }

    function buildFeedbackFooter(id) {
        var existing = getFeedbackMap()[id];
        var state = '';
        if (existing === 'up') state = ' data-state="up"';
        else if (existing === 'down') state = ' data-state="down"';
        return '<div class="dm-feedback"' + state + '>' +
            '<div class="dm-feedback-prompt">' +
                '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 12h8M8 8h8m-8 8h4M3 5a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H7l-4 4V5z"/></svg>' +
                '<span>Was this article helpful?</span>' +
            '</div>' +
            '<div class="dm-feedback-actions">' +
                '<button class="dm-feedback-btn dm-feedback-up" type="button" data-vote="up" aria-label="Yes, helpful">' +
                    '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3"/></svg>' +
                    '<span>Yes</span>' +
                '</button>' +
                '<button class="dm-feedback-btn dm-feedback-down" type="button" data-vote="down" aria-label="No, not helpful">' +
                    '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M10 15v4a3 3 0 003 3l4-9V2H5.72a2 2 0 00-2 1.7l-1.38 9a2 2 0 002 2.3zM17 2h3a2 2 0 012 2v7a2 2 0 01-2 2h-3"/></svg>' +
                    '<span>No</span>' +
                '</button>' +
            '</div>' +
            '<div class="dm-feedback-thanks">Thanks for your feedback</div>' +
        '</div>';
    }

    function wireFeedback(container, id) {
        var footer = container.querySelector('.dm-feedback');
        if (!footer) return;
        var upBtn = footer.querySelector('.dm-feedback-up');
        var downBtn = footer.querySelector('.dm-feedback-down');
        var thanks = footer.querySelector('.dm-feedback-thanks');

        function vote(value, btn) {
            setFeedback(id, value);
            footer.setAttribute('data-state', value);
            if (upBtn) upBtn.classList.toggle('selected', value === 'up');
            if (downBtn) downBtn.classList.toggle('selected', value === 'down');
            if (thanks) {
                thanks.textContent = value === 'up'
                    ? 'Thanks for your feedback'
                    : 'Thanks — tell us how to improve';
                thanks.classList.add('show');
            }
            if (upBtn) upBtn.disabled = true;
            if (downBtn) downBtn.disabled = true;
        }

        if (upBtn) upBtn.addEventListener('click', function() { vote('up', upBtn); });
        if (downBtn) downBtn.addEventListener('click', function() { vote('down', downBtn); });

        // Restore prior vote state on reopen.
        var existing = getFeedbackMap()[id];
        if (existing === 'up' && upBtn) { upBtn.classList.add('selected'); upBtn.disabled = true; if (thanks) thanks.classList.add('show'); }
        if (existing === 'down' && downBtn) { downBtn.classList.add('selected'); downBtn.disabled = true; if (thanks) thanks.classList.add('show'); }
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
                buildSuggestedVideos(id, category) +
                buildFeedbackFooter(id);
            wireFeedback(body, id);
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
