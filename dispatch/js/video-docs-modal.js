// video-docs-modal.js — Documentation modal, suggested videos, and hash scroll
// Used by video_docs.php. Expects window.ALL_VIDEOS to be set before this loads.

(function() {
    'use strict';

    function escapeHtml(str) {
        if (typeof str !== 'string') return '';
        return str.replace(/&/g, '\x26amp;').replace(/</g, '\x26lt;').replace(/>/g, '\x26gt;').replace(/"/g, '\x26quot;').replace(/'/g, '&#039;');
    }

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

    // ===== Feedback success popup =====
    function showFeedbackPopup(title, message) {
        var popup = document.getElementById('fb-success-popup');
        if (!popup) return;
        var titleEl = popup.querySelector('#fb-success-title');
        var msgEl = popup.querySelector('#fb-success-message');
        if (titleEl) titleEl.textContent = title || 'Feedback Sent!';
        if (msgEl) msgEl.textContent = message || 'Thank you for helping us improve.';
        popup.classList.add('show');
        // Auto-dismiss after 8 seconds if no action
        clearTimeout(popup._timer);
        popup._timer = setTimeout(function() { popup.classList.remove('show'); }, 8000);
    }

    function hideFeedbackPopup() {
        var popup = document.getElementById('fb-success-popup');
        if (popup) { popup.classList.remove('show'); clearTimeout(popup._timer); }
    }

    // ===== "Was this helpful?" feedback footer =====
    var FEEDBACK_KEY = 'dispatch-doc-feedback';
    var FEEDBACK_API = 'api/feedback.php';

    function getFeedbackMap() {
        try { return JSON.parse(localStorage.getItem(FEEDBACK_KEY) || '{}'); }
        catch (e) { return {}; }
    }

    function setFeedback(id, value) {
        var map = getFeedbackMap();
        map[id] = value;
        try { localStorage.setItem(FEEDBACK_KEY, JSON.stringify(map)); } catch (e) {}
    }

    function buildFeedbackFooter(id, title) {
        var existing = getFeedbackMap()[id];
        var state = '';
        if (existing === 'up') state = ' data-state="up"';
        else if (existing === 'down') state = ' data-state="down"';
        return '<div class="dm-feedback"' + state + ' data-doc-id="' + escapeHtml(id) + '" data-doc-title="' + escapeHtml(title) + '">' +
            '<div class="dm-feedback-prompt">' +
                '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 12h8M8 8h8m-8 8h4M3 5a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H7l-4 4V5z"/></svg>' +
                '<div class="dm-feedback-prompt-text">' +
                    '<span class="dm-feedback-prompt-title">Was this article helpful?</span>' +
                    '<span class="dm-feedback-prompt-sub">Your feedback helps us improve the DISPATCH documentation.</span>' +
                '</div>' +
            '</div>' +
            '<div class="dm-feedback-actions">' +
                '<button class="dm-feedback-btn dm-feedback-up" type="button" data-vote="up" aria-label="Yes, this article was helpful">' +
                    '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3"/></svg>' +
                    '<span class="dm-feedback-btn-text">' +
                        '<span class="dm-feedback-btn-label">Yes</span>' +
                        '<span class="dm-feedback-btn-desc">This article was clear and useful</span>' +
                    '</span>' +
                '</button>' +
                '<button class="dm-feedback-btn dm-feedback-down" type="button" data-vote="down" aria-label="No, this article needs improvement">' +
                    '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M10 15v4a3 3 0 003 3l4-9V2H5.72a2 2 0 00-2 1.7l-1.38 9a2 2 0 002 2.3zM17 2h3a2 2 0 012 2v7a2 2 0 01-2 2h-3"/></svg>' +
                    '<span class="dm-feedback-btn-text">' +
                        '<span class="dm-feedback-btn-label">No</span>' +
                        '<span class="dm-feedback-btn-desc">I found this confusing or incomplete</span>' +
                    '</span>' +
                '</button>' +
            '</div>' +
            '<div class="dm-feedback-thanks">Thanks for your feedback</div>' +
            '<div class="dm-feedback-chat">' +
                '<div class="dm-feedback-chat-header">' +
                    '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 10h8M8 14h5M21 12a8 8 0 01-8 8 8 8 0 01-3.6-.85L3 21l1.85-4.4A8 8 0 0113 4a8 8 0 018 8z"/></svg>' +
                    '<span>Tell us how to improve this article</span>' +
                '</div>' +
                '<textarea class="dm-feedback-chat-input" placeholder="What was missing or confusing? How can we make this better?" maxlength="2000"></textarea>' +
                '<div class="dm-feedback-chat-footer">' +
                    '<span class="dm-feedback-chat-count">0/2000</span>' +
                    '<button class="dm-feedback-chat-send" type="button">Send Feedback</button>' +
                '</div>' +
            '</div>' +
        '</div>';
    }

    function wireFeedback(container, id, title) {
        var footer = container.querySelector('.dm-feedback');
        if (!footer) return;
        var upBtn = footer.querySelector('.dm-feedback-up');
        var downBtn = footer.querySelector('.dm-feedback-down');
        var thanks = footer.querySelector('.dm-feedback-thanks');
        var chatBox = footer.querySelector('.dm-feedback-chat');
        var chatInput = footer.querySelector('.dm-feedback-chat-input');
        var chatSend = footer.querySelector('.dm-feedback-chat-send');
        var chatCount = footer.querySelector('.dm-feedback-chat-count');

        function submitToApi(vote, message) {
            var payload = { doc_id: id, doc_title: title, vote: vote, name: 'Anonymous', message: message || '' };
            try {
                fetch(FEEDBACK_API, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                }).catch(function() {});
            } catch (e) {}
        }

        function vote(value, btn) {
            setFeedback(id, value);
            footer.setAttribute('data-state', value);
            if (upBtn) upBtn.classList.toggle('selected', value === 'up');
            if (downBtn) downBtn.classList.toggle('selected', value === 'down');
            if (upBtn) upBtn.disabled = true;
            if (downBtn) downBtn.disabled = true;
            submitToApi(value, '');
            if (value === 'up') {
                if (thanks) { thanks.textContent = 'Thanks for your feedback'; thanks.classList.add('show'); }
                if (chatBox) chatBox.classList.remove('show');
                showFeedbackPopup('Thanks for your feedback!', 'Glad this article was helpful. Your input shapes our documentation.');
            } else {
                if (thanks) { thanks.textContent = 'Thanks — tell us how to improve'; thanks.classList.add('show'); }
                if (chatBox) {
                    chatBox.classList.add('show');
                    if (chatInput) setTimeout(function() { chatInput.focus(); }, 300);
                }
            }
        }

        if (upBtn) upBtn.addEventListener('click', function() { vote('up', upBtn); });
        if (downBtn) downBtn.addEventListener('click', function() { vote('down', downBtn); });

        if (chatInput) {
            chatInput.addEventListener('input', function() {
                var len = chatInput.value.length;
                if (chatCount) chatCount.textContent = len + '/2000';
                if (chatCount) chatCount.classList.toggle('warning', len > 1800);
                if (chatSend) chatSend.disabled = len < 2;
            });
        }

        if (chatSend) {
            chatSend.addEventListener('click', function() {
                if (!chatInput) return;
                var msg = chatInput.value.trim();
                if (msg.length < 2) return;
                chatSend.disabled = true;
                var origText = chatSend.textContent;
                chatSend.textContent = 'Sending...';
                try {
                    fetch(FEEDBACK_API, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ doc_id: id, doc_title: title, vote: 'down', name: 'Anonymous', message: msg })
                    }).then(function(r) { return r.json(); })
                    .then(function(data) {
                        chatSend.textContent = 'Sent!';
                        chatInput.value = '';
                        if (chatCount) chatCount.textContent = '0/2000';
                        if (thanks) { thanks.textContent = 'Thank you! Your feedback helps us improve.'; thanks.classList.add('show'); }
                        if (chatBox) chatBox.classList.remove('show');
                        setTimeout(function() { chatSend.textContent = origText; chatSend.disabled = false; }, 2000);
                        showFeedbackPopup('Feedback Sent!', 'Thank you for telling us how to improve. We review every message.');
                    })
                    .catch(function() {
                        chatSend.textContent = origText;
                        chatSend.disabled = false;
                        if (thanks) { thanks.textContent = 'Saved locally — thank you!'; thanks.classList.add('show'); }
                        if (chatBox) chatBox.classList.remove('show');
                    });
                } catch (e) {
                    chatSend.textContent = origText;
                    chatSend.disabled = false;
                }
            });
        }

        // Restore prior vote state on reopen.
        var existing = getFeedbackMap()[id];
        if (existing === 'up' && upBtn) { upBtn.classList.add('selected'); upBtn.disabled = true; if (thanks) { thanks.textContent = 'Thanks for your feedback'; thanks.classList.add('show'); } }
        if (existing === 'down' && downBtn) { downBtn.classList.add('selected'); downBtn.disabled = true; if (thanks) { thanks.textContent = 'Thanks — tell us how to improve'; thanks.classList.add('show'); } if (chatBox) chatBox.classList.add('show'); }
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
                buildFeedbackFooter(id, title);
            wireFeedback(body, id, title);
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

        // Wire feedback popup close/dismiss buttons
        var popup = document.getElementById('fb-success-popup');
        if (popup) {
            var closeBtn = popup.querySelector('#fb-success-close');
            var dismissBtn = popup.querySelector('#fb-success-dismiss');
            if (closeBtn) closeBtn.addEventListener('click', hideFeedbackPopup);
            if (dismissBtn) dismissBtn.addEventListener('click', hideFeedbackPopup);
            popup.addEventListener('click', function(e) { if (e.target === popup) hideFeedbackPopup(); });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && popup.classList.contains('show')) hideFeedbackPopup();
            });
        }
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
