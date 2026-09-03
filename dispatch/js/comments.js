// comments.js — Comment system for DISPATCH tutorials
// Fetches, renders, and submits comments via api/comments.php
// Supports threaded replies, likes (localStorage), and report/flag.

(function() {
    'use strict';

    var API_URL = 'api/comments.php';
    var currentVideoId = null;
    var likedComments = {};
    var myEditTokens = {}; // comment id -> edit_token (for comments posted from this browser)
    var EDIT_WINDOW = 900; // 15 minutes in seconds

    // Load liked comments from localStorage
    try { likedComments = JSON.parse(localStorage.getItem('dispatch-liked-comments') || '{}'); } catch (e) { likedComments = {}; }
    // Load edit tokens from localStorage
    try { myEditTokens = JSON.parse(localStorage.getItem('dispatch-edit-tokens') || '{}'); } catch (e) { myEditTokens = {}; }

    function saveLiked() {
        try { localStorage.setItem('dispatch-liked-comments', JSON.stringify(likedComments)); } catch (e) {}
    }
    function saveEditTokens() {
        try { localStorage.setItem('dispatch-edit-tokens', JSON.stringify(myEditTokens)); } catch (e) {}
    }

    function canEdit(comment) {
        return true;
    }

    // Load saved name from localStorage
    function getSavedName() {
        try { return localStorage.getItem('dispatch-comment-name') || ''; } catch (e) { return ''; }
    }
    function saveName(name) {
        try { localStorage.setItem('dispatch-comment-name', name); } catch (e) {}
    }

    function escapeHtml(str) {
        if (typeof str !== 'string') return '';
        return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#039;');
    }

    function timeAgo(timestamp) {
        var seconds = Math.floor((Date.now() / 1000 - timestamp));
        if (seconds < 60) return 'Just now';
        if (seconds < 3600) return Math.floor(seconds / 60) + 'm ago';
        if (seconds < 86400) return Math.floor(seconds / 3600) + 'h ago';
        if (seconds < 604800) return Math.floor(seconds / 86400) + 'd ago';
        if (seconds < 2592000) return Math.floor(seconds / 604800) + 'w ago';
        return Math.floor(seconds / 2592000) + 'mo ago';
    }

    function getInitials(name) {
        var parts = name.trim().split(/\s+/);
        if (parts.length >= 2) return (parts[0].charAt(0) + parts[1].charAt(0)).toUpperCase();
        return name.trim().charAt(0).toUpperCase() || '?';
    }

    function showToast(text) {
        var toast = document.getElementById('comment-toast');
        if (!toast) return;
        toast.querySelector('.comment-toast-text').textContent = text;
        toast.classList.add('show');
        clearTimeout(toast._t);
        toast._t = setTimeout(function() { toast.classList.remove('show'); }, 2500);
    }

    function clearBellBadge() {
        var bell = document.getElementById('comments-bell');
        var badge = document.getElementById('comments-bell-badge');
        if (bell) bell.classList.remove('has-new');
        if (badge) { badge.style.display = 'none'; badge.textContent = '0'; }
    }

    // ===== Fetch comments =====
    function fetchComments(videoId) {
        currentVideoId = videoId;
        var container = document.getElementById('comments-list');
        var countBadge = document.getElementById('comments-count');
        if (!container) return;
        container.innerHTML = '<div class="comments-loading">Loading comments</div>';

        fetch(API_URL + '?video_id=' + encodeURIComponent(videoId))
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (!data.ok) throw new Error(data.error || 'Failed to load');
                renderComments(data.comments, container);
                if (countBadge) {
                    countBadge.textContent = data.count + (data.count === 1 ? ' comment' : ' comments');
                    countBadge.style.display = data.count > 0 ? '' : 'none';
                }
            })
            .catch(function(err) {
                console.error('Comment load error:', err);
                container.innerHTML = '<div class="comments-error">Failed to load comments. Please try again later.</div>';
            });
    }

    // ===== Render comments =====
    function renderComments(comments, container) {
        if (!comments || comments.length === 0) {
            container.innerHTML =
                '<div class="comments-empty">' +
                '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h8M8 8h8m-8 8h4M3 5a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H7l-4 4V5z"/></svg>' +
                '<p>No comments yet</p>' +
                '<p class="comments-empty-hint">Be the first to share your thoughts!</p>' +
                '</div>';
            return;
        }
        container.innerHTML = '';
        comments.forEach(function(c) { container.appendChild(renderComment(c, false)); });
    }

    function renderComment(comment, isReply) {
        var item = document.createElement('div');
        item.className = isReply ? 'comment-reply' : 'comment-item';
        item.dataset.id = comment.id;

        var isLiked = !!likedComments[comment.id];
        var initials = getInitials(comment.name);
        var color = comment.avatar_color || '#10b981';
        var replies = comment.replies || [];

        var html =
            '<div class="comment-item-header">' +
                '<div class="comment-avatar" style="background:' + escapeHtml(color) + '">' + escapeHtml(initials) + '</div>' +
                '<div class="comment-meta">' +
                    '<div class="comment-name">' + escapeHtml(comment.name) + '</div>' +
                    '<div class="comment-time">' + escapeHtml(timeAgo(comment.timestamp)) + (comment.edited ? ' <span class="comment-edited">(edited)</span>' : '') + '</div>' +
                '</div>' +
            '</div>' +
            '<div class="comment-body">' + escapeHtml(comment.message) + '</div>' +
            '<div class="comment-actions">' +
                '<button class="comment-action-btn like-btn' + (isLiked ? ' liked' : '') + '" data-id="' + escapeHtml(comment.id) + '">' +
                    '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3"/></svg>' +
                    '<span class="comment-likes-count">' + (comment.likes || 0) + '</span>' +
                '</button>' +
                (isReply ? '' :
                    '<button class="comment-action-btn reply-btn" data-id="' + escapeHtml(comment.id) + '">' +
                        '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>' +
                        'Reply' +
                    '</button>') +
                (canEdit(comment) ?
                    '<button class="comment-action-btn edit-btn" data-id="' + escapeHtml(comment.id) + '" title="Edit your comment">' +
                        '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>' +
                        'Edit' +
                    '</button>'
                : '') +
                '<button class="comment-action-btn report-btn" data-id="' + escapeHtml(comment.id) + '" title="Report this comment">' +
                    '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/></svg>' +
                    'Report' +
                '</button>' +
            '</div>' +
            (canEdit(comment) ?
                '<div class="comment-edit-form" id="edit-form-' + escapeHtml(comment.id) + '">' +
                    '<textarea class="comment-form-textarea" id="edit-text-' + escapeHtml(comment.id) + '" maxlength="1000">' + escapeHtml(comment.message) + '</textarea>' +
                    '<div class="comment-form-footer">' +
                        '<button class="comment-form-submit edit-submit-btn" data-id="' + escapeHtml(comment.id) + '">' +
                            '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>' +
                            'Save' +
                        '</button>' +
                        '<button class="comment-action-btn cancel-edit-btn" data-id="' + escapeHtml(comment.id) + '">Cancel</button>' +
                    '</div>' +
                '</div>'
            : '');

        // Reply form (inline, hidden by default)
        if (!isReply) {
            html +=
                '<div class="comment-reply-form" id="reply-form-' + escapeHtml(comment.id) + '">' +
                    '<div class="comment-form-row">' +
                        '<input type="text" class="comment-form-name" placeholder="Your name (optional)" value="' + escapeHtml(getSavedName()) + '" id="reply-name-' + escapeHtml(comment.id) + '">' +
                    '</div>' +
                    '<textarea class="comment-form-textarea" placeholder="Write a reply..." id="reply-text-' + escapeHtml(comment.id) + '"></textarea>' +
                    '<div class="comment-form-footer">' +
                        '<button class="comment-form-submit" data-parent="' + escapeHtml(comment.id) + '">' +
                            '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>' +
                            'Post Reply' +
                        '</button>' +
                        '<button class="comment-action-btn cancel-reply-btn" data-id="' + escapeHtml(comment.id) + '">Cancel</button>' +
                    '</div>' +
                '</div>';
        }

        // Threaded replies
        if (replies.length > 0) {
            html += '<div class="comment-replies">';
            replies.forEach(function(r) { html += renderCommentHtml(r, true); });
            html += '</div>';
        }

        item.innerHTML = html;
        wireCommentActions(item);
        return item;
    }

    // Render reply as HTML string (for nested replies)
    function renderCommentHtml(comment, isReply) {
        var isLiked = !!likedComments[comment.id];
        var initials = getInitials(comment.name);
        var color = comment.avatar_color || '#10b981';
        var editable = canEdit(comment);
        return '<div class="comment-reply" data-id="' + escapeHtml(comment.id) + '">' +
            '<div class="comment-item-header">' +
                '<div class="comment-avatar" style="background:' + escapeHtml(color) + '">' + escapeHtml(initials) + '</div>' +
                '<div class="comment-meta">' +
                    '<div class="comment-name">' + escapeHtml(comment.name) + '</div>' +
                    '<div class="comment-time">' + escapeHtml(timeAgo(comment.timestamp)) + (comment.edited ? ' <span class="comment-edited">(edited)</span>' : '') + '</div>' +
                '</div>' +
            '</div>' +
            '<div class="comment-body">' + escapeHtml(comment.message) + '</div>' +
            '<div class="comment-actions">' +
                '<button class="comment-action-btn like-btn' + (isLiked ? ' liked' : '') + '" data-id="' + escapeHtml(comment.id) + '">' +
                    '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3"/></svg>' +
                    '<span class="comment-likes-count">' + (comment.likes || 0) + '</span>' +
                '</button>' +
                (editable ?
                    '<button class="comment-action-btn edit-btn" data-id="' + escapeHtml(comment.id) + '" title="Edit your comment">' +
                        '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>' +
                        'Edit' +
                    '</button>'
                : '') +
                '<button class="comment-action-btn report-btn" data-id="' + escapeHtml(comment.id) + '" title="Report this comment">' +
                    '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/></svg>' +
                    'Report' +
                '</button>' +
            '</div>' +
            (editable ?
                '<div class="comment-edit-form" id="edit-form-' + escapeHtml(comment.id) + '">' +
                    '<textarea class="comment-form-textarea" id="edit-text-' + escapeHtml(comment.id) + '" maxlength="1000">' + escapeHtml(comment.message) + '</textarea>' +
                    '<div class="comment-form-footer">' +
                        '<button class="comment-form-submit edit-submit-btn" data-id="' + escapeHtml(comment.id) + '">' +
                            '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>' +
                            'Save' +
                        '</button>' +
                        '<button class="comment-action-btn cancel-edit-btn" data-id="' + escapeHtml(comment.id) + '">Cancel</button>' +
                    '</div>' +
                '</div>'
            : '') +
        '</div>';
    }

    // ===== Wire up actions within a comment element =====
    function wireCommentActions(item) {
        // Like button
        var likeBtn = item.querySelector('.like-btn');
        if (likeBtn) {
            likeBtn.addEventListener('click', function() { handleLike(likeBtn); });
        }
        // Reply button
        var replyBtn = item.querySelector('.reply-btn');
        if (replyBtn) {
            replyBtn.addEventListener('click', function() {
                var form = item.querySelector('.comment-reply-form');
                if (form) { form.classList.toggle('open'); if (form.classList.contains('open')) { var ta = form.querySelector('textarea'); if (ta) ta.focus(); } }
            });
        }
        // Reply submit
        var replySubmit = item.querySelector('.comment-form-submit[data-parent]');
        if (replySubmit) {
            replySubmit.addEventListener('click', function() { handleReplySubmit(replySubmit, item); });
        }
        // Cancel reply
        var cancelBtn = item.querySelector('.cancel-reply-btn');
        if (cancelBtn) {
            cancelBtn.addEventListener('click', function() {
                var form = item.querySelector('.comment-reply-form');
                if (form) form.classList.remove('open');
            });
        }
        // Report button
        var reportBtn = item.querySelector('.report-btn');
        if (reportBtn) {
            reportBtn.addEventListener('click', function() { handleReport(reportBtn); });
        }
        // Edit button
        var editBtns = item.querySelectorAll('.edit-btn');
        editBtns.forEach(function(editBtn) {
            editBtn.addEventListener('click', function() {
                var form = item.querySelector('.comment-edit-form');
                if (form) {
                    form.classList.toggle('open');
                    if (form.classList.contains('open')) {
                        var ta = form.querySelector('textarea');
                        if (ta) { ta.focus(); ta.setSelectionRange(ta.value.length, ta.value.length); }
                    }
                }
            });
        });
        // Edit submit
        var editSubmitBtns = item.querySelectorAll('.edit-submit-btn');
        editSubmitBtns.forEach(function(editSubmitBtn) {
            editSubmitBtn.addEventListener('click', function() { handleEditSubmit(editSubmitBtn, item); });
        });
        // Cancel edit
        var cancelEditBtns = item.querySelectorAll('.cancel-edit-btn');
        cancelEditBtns.forEach(function(cancelEditBtn) {
            cancelEditBtn.addEventListener('click', function() {
                var form = item.querySelector('.comment-edit-form');
                if (form) form.classList.remove('open');
            });
        });
    }

    // ===== Edit submit handler =====
    function handleEditSubmit(btn, item) {
        var id = btn.dataset.id;
        var form = (item || document).querySelector('.comment-edit-form');
        var textArea = form ? form.querySelector('textarea') : null;
        if (!textArea) return;
        var newMessage = textArea.value.trim();
        if (!newMessage) { textArea.focus(); return; }
        var token = myEditTokens[id] || '';

        btn.disabled = true;
        var origText = btn.innerHTML;
        btn.innerHTML = 'Saving...';

        fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'edit', id: id, edit_token: token, message: newMessage })
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            btn.disabled = false;
            btn.innerHTML = origText;
            if (data.ok) {
                showToast('Comment edited!');
                lastSeenTimestamp = Math.floor(Date.now() / 1000);
                clearBellBadge();
                fetchComments(currentVideoId);
                if (modalVideoId) fetchModalComments(modalVideoId);
            } else {
                showToast(data.error || 'Failed to edit comment');
            }
        })
        .catch(function(err) {
            btn.disabled = false;
            btn.innerHTML = origText;
            console.error('Comment edit error:', err);
            showToast('Failed to edit comment');
        });
    }

    // ===== Like handler =====
    function handleLike(btn) {
        var id = btn.dataset.id;
        if (likedComments[id]) {
            showToast('You already liked this comment');
            return;
        }
        btn.disabled = true;
        fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'like', id: id })
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            btn.disabled = false;
            if (data.ok) {
                likedComments[id] = true;
                saveLiked();
                btn.classList.add('liked');
                var count = btn.querySelector('.comment-likes-count');
                if (count) count.textContent = data.likes;
            }
        })
        .catch(function() { btn.disabled = false; });
    }

    // ===== Report handler =====
    function handleReport(btn) {
        var id = btn.dataset.id;
        if (!confirm('Report this comment for inappropriate content?')) return;
        btn.disabled = true;
        fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'report', id: id })
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            btn.disabled = false;
            if (data.ok) {
                showToast('Comment reported. Thank you.');
                btn.style.color = '#ef4444';
                btn.textContent = 'Reported';
            }
        })
        .catch(function() { btn.disabled = false; });
    }

    // ===== Reply submit =====
    function handleReplySubmit(btn, item) {
        var parentId = btn.dataset.parent;
        var form = (item || document).querySelector('.comment-reply-form');
        var nameInput = form ? form.querySelector('.comment-form-name') : null;
        var textInput = form ? form.querySelector('textarea') : null;
        if (!textInput) return;
        var name = (nameInput ? nameInput.value.trim() : '') || 'Anonymous';
        var message = textInput.value.trim();
        if (!message) { textInput.focus(); return; }
        btn.disabled = true;
        btn.innerHTML = 'Posting...';
        saveName(name);

        fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'add', name: name, message: message, video_id: currentVideoId, parent_id: parentId })
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            btn.disabled = false;
            if (data.ok) {
                if (nameInput) nameInput.value = '';
                if (textInput) textInput.value = '';
                try { localStorage.removeItem('dispatch-comment-name'); } catch (e) {}
                showToast('Reply posted!');
                lastSeenTimestamp = Math.floor(Date.now() / 1000);
                clearBellBadge();
                fetchComments(currentVideoId);
            } else {
                btn.innerHTML = 'Post Reply';
                showToast(data.error || 'Failed to post reply');
            }
        })
        .catch(function() {
            btn.disabled = false;
            btn.innerHTML = 'Post Reply';
            showToast('Failed to post reply');
        });
    }

    // ===== Main form submit =====
    function initMainForm() {
        var form = document.getElementById('comment-form');
        if (!form) return;
        var nameInput = form.querySelector('#comment-name');
        var textInput = form.querySelector('#comment-textarea');
        var submitBtn = form.querySelector('#comment-submit');
        var avatarEl = document.getElementById('comment-form-avatar');

        // Restore saved name
        if (nameInput) nameInput.value = getSavedName();

        // Update avatar preview
        function updateAvatar() {
            if (!avatarEl || !nameInput) return;
            var name = nameInput.value.trim() || 'A';
            avatarEl.textContent = getInitials(name);
        }
        if (nameInput) nameInput.addEventListener('input', updateAvatar);
        updateAvatar();

        if (!submitBtn) return;
        submitBtn.addEventListener('click', function() {
            var name = (nameInput ? nameInput.value.trim() : '') || 'Anonymous';
            var message = textInput ? textInput.value.trim() : '';
            if (!message) { textInput.focus(); return; }
            submitBtn.disabled = true;
            var origText = submitBtn.innerHTML;
            submitBtn.innerHTML = 'Posting...';
            saveName(name);

            fetch(API_URL, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'add', name: name, message: message, video_id: currentVideoId, parent_id: null })
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = origText;
                if (data.ok) {
                    if (data.comment && data.comment.edit_token) {
                        myEditTokens[data.comment.id] = data.comment.edit_token;
                        saveEditTokens();
                    }
                    if (textInput) textInput.value = '';
                    if (nameInput) nameInput.value = '';
                    if (avatarEl) avatarEl.textContent = 'A';
                    try { localStorage.removeItem('dispatch-comment-name'); } catch (e) {}
                    showToast('Comment posted!');
                    lastSeenTimestamp = Math.floor(Date.now() / 1000);
                    clearBellBadge();
                    fetchComments(currentVideoId);
                } else {
                    showToast(data.error || 'Failed to post comment');
                }
            })
            .catch(function(err) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = origText;
                console.error('Comment post error:', err);
                showToast('Failed to post comment');
            });
        });
    }

    // ===== Notification polling =====
    var lastSeenTimestamp = 0;
    var pollTimer = null;
    var hasInitialized = false;

    function startNotificationPolling() {
        if (pollTimer) clearInterval(pollTimer);
        // Poll every 30 seconds for new comments
        pollTimer = setInterval(checkNewComments, 30000);
        // Also check once after 5 seconds
        setTimeout(checkNewComments, 5000);
    }

    function checkNewComments() {
        fetch(API_URL + '?action=count&video_id=general')
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (!data.ok) return;
                var bell = document.getElementById('comments-bell');
                var badge = document.getElementById('comments-bell-badge');
                if (!bell || !badge) return;

                if (!hasInitialized) {
                    // First load — set baseline, don't show notification
                    lastSeenTimestamp = data.latest_timestamp || 0;
                    hasInitialized = true;
                    if (data.count > 0) {
                        badge.textContent = data.count;
                        badge.style.display = '';
                    }
                    return;
                }

                if (data.latest_timestamp > lastSeenTimestamp && data.count > 0) {
                    // New comment(s) detected
                    bell.classList.add('has-new');
                    badge.textContent = data.count;
                    badge.style.display = '';
                    // Show toast notification
                    showToast(data.latest_name ? data.latest_name + ' posted a new comment' : 'New comment available');
                    lastSeenTimestamp = data.latest_timestamp;
                    setTimeout(function() { bell.classList.remove('has-new'); }, 2000);
                }
            })
            .catch(function() {});
    }

    // Scroll to comments section
    window.scrollToComments = function() {
        var section = document.getElementById('comments-section');
        if (section) {
            section.scrollIntoView({ behavior: 'smooth', block: 'start' });
            section.style.transition = 'box-shadow 0.3s ease';
            section.style.boxShadow = '0 0 0 3px color-mix(in srgb, var(--accent) 20%, transparent)';
            setTimeout(function() { section.style.boxShadow = ''; }, 1500);
        }
        // Clear the bell badge since the user is now viewing comments
        lastSeenTimestamp = Math.floor(Date.now() / 1000);
        clearBellBadge();
    };

    // ===== Modal comments (per-video inside the player modal) =====
    var modalVideoId = null;

    function fetchModalComments(videoId) {
        modalVideoId = videoId;
        var container = document.getElementById('modal-comments-list');
        var countBadge = document.getElementById('modal-comments-count');
        if (!container) return;
        container.innerHTML = '<div class="comments-loading">Loading comments</div>';

        fetch(API_URL + '?video_id=' + encodeURIComponent(videoId))
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (!data.ok) throw new Error(data.error || 'Failed to load');
                renderComments(data.comments, container);
                if (countBadge) {
                    countBadge.textContent = data.count;
                    countBadge.style.display = data.count > 0 ? '' : 'none';
                }
            })
            .catch(function(err) {
                console.error('Modal comment load error:', err);
                container.innerHTML = '<div class="comments-error">Failed to load comments.</div>';
            });
    }

    function initModalForm() {
        var submitBtn = document.getElementById('modal-comment-submit');
        if (!submitBtn) return;
        var nameInput = document.getElementById('modal-comment-name');
        var textInput = document.getElementById('modal-comment-textarea');

        submitBtn.addEventListener('click', function() {
            var name = (nameInput ? nameInput.value.trim() : '') || 'Anonymous';
            var message = textInput ? textInput.value.trim() : '';
            if (!message) { if (textInput) textInput.focus(); return; }
            submitBtn.disabled = true;
            var origText = submitBtn.innerHTML;
            submitBtn.innerHTML = 'Posting...';

            fetch(API_URL, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'add', name: name, message: message, video_id: modalVideoId, parent_id: null })
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = origText;
                if (data.ok) {
                    if (data.comment && data.comment.edit_token) {
                        myEditTokens[data.comment.id] = data.comment.edit_token;
                        saveEditTokens();
                    }
                    if (textInput) textInput.value = '';
                    if (nameInput) nameInput.value = '';
                    showToast('Comment posted!');
                    lastSeenTimestamp = Math.floor(Date.now() / 1000);
                    clearBellBadge();
                    fetchModalComments(modalVideoId);
                    // Also refresh the main comments list if it's showing the same video
                    if (currentVideoId === modalVideoId) fetchComments(currentVideoId);
                } else {
                    showToast(data.error || 'Failed to post comment');
                }
            })
            .catch(function(err) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = origText;
                console.error('Modal comment post error:', err);
                showToast('Failed to post comment');
            });
        });
    }

    // ===== Public API =====
    window.DispatchComments = {
        load: function(videoId) { fetchComments(videoId); },
        loadModal: function(videoId) { fetchModalComments(videoId); },
        init: function(videoId) {
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() { initMainForm(); initModalForm(); fetchComments(videoId); startNotificationPolling(); });
            } else {
                initMainForm();
                initModalForm();
                fetchComments(videoId);
                startNotificationPolling();
            }
        }
    };

    // Self-init fallback: if no one calls init within 2s, init with 'general'
    setTimeout(function() {
        if (currentVideoId === null) {
            console.log('[comments] Self-initializing with video_id=general');
            window.DispatchComments.init('general');
        }
    }, 2000);
})();
