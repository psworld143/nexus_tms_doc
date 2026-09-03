// comments.js — Comment system for DISPATCH tutorials
// YouTube-style: reactions (like/dislike), pinned, hearted, sorting, search, pagination, timestamps, mentions

(function() {
    'use strict';

    var API_URL = 'api/comments.php';
    var currentVideoId = null;
    var likedComments = {};
    var dislikedComments = {};
    var myEditTokens = {};
    var userId = '';
    var EDIT_WINDOW = 900;
    var PAGE_SIZE = 10;
    var currentSort = 'newest';
    var currentLimit = PAGE_SIZE;
    var searchQuery = '';
    var allComments = [];
    var modalVideoId = null;
    var lastSeenTimestamp = 0;
    var pollTimer = null;
    var hasInitialized = false;

    try { likedComments = JSON.parse(localStorage.getItem('dispatch-liked-comments') || '{}'); } catch (e) { likedComments = {}; }
    try { dislikedComments = JSON.parse(localStorage.getItem('dispatch-disliked-comments') || '{}'); } catch (e) { dislikedComments = {}; }
    try { myEditTokens = JSON.parse(localStorage.getItem('dispatch-edit-tokens') || '{}'); } catch (e) { myEditTokens = {}; }
    try { currentSort = localStorage.getItem('dispatch-comment-sort') || 'newest'; } catch (e) {}
    try { userId = localStorage.getItem('dispatch-user-id') || ''; } catch (e) {}
    if (!userId) {
        userId = 'u_' + Math.random().toString(36).substr(2, 12) + Date.now().toString(36);
        try { localStorage.setItem('dispatch-user-id', userId); } catch (e) {}
    }

    function saveLiked() { try { localStorage.setItem('dispatch-liked-comments', JSON.stringify(likedComments)); } catch (e) {} }
    function saveDisliked() { try { localStorage.setItem('dispatch-disliked-comments', JSON.stringify(dislikedComments)); } catch (e) {} }
    function saveEditTokens() { try { localStorage.setItem('dispatch-edit-tokens', JSON.stringify(myEditTokens)); } catch (e) {} }
    function saveSort() { try { localStorage.setItem('dispatch-comment-sort', currentSort); } catch (e) {} }

    function canEdit(comment) {
        if (!comment || comment.deleted) return false;
        var hasToken = !!myEditTokens[comment.id];
        var withinWindow = (Math.floor(Date.now() / 1000) - (comment.timestamp || 0)) < EDIT_WINDOW;
        return hasToken && withinWindow;
    }

    function getSavedName() { try { return localStorage.getItem('dispatch-comment-name') || ''; } catch (e) { return ''; } }
    function saveName(name) { try { localStorage.setItem('dispatch-comment-name', name); } catch (e) {} }

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

    function formatMessage(msg) {
        var escaped = escapeHtml(msg);
        escaped = escaped.replace(/@(\w+)/g, '<span class="comment-mention">@$1</span>');
        escaped = escaped.replace(/@(\d{1,2}:\d{2}(?::\d{2})?)/g, function(match, time) {
            return '<span class="comment-timestamp-badge" data-time="' + escapeHtml(time) + '">' + escapeHtml(time) + '</span>';
        });
        return escaped;
    }

    function parseTimestamp(timeStr) {
        var parts = timeStr.split(':').map(Number);
        if (parts.length === 2) return parts[0] * 60 + parts[1];
        if (parts.length === 3) return parts[0] * 3600 + parts[1] * 60 + parts[2];
        return 0;
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

        fetch(API_URL + '?video_id=' + encodeURIComponent(videoId) + '&sort=' + encodeURIComponent(currentSort))
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (!data.ok) throw new Error(data.error || 'Failed to load');
                allComments = data.comments || [];
                renderComments(container);
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

    function filterComments(comments) {
        if (!searchQuery) return comments;
        var q = searchQuery.toLowerCase();
        return comments.filter(function(c) {
            if (c.deleted) return false;
            return (c.name && c.name.toLowerCase().indexOf(q) !== -1) ||
                   (c.message && c.message.toLowerCase().indexOf(q) !== -1);
        });
    }

    function renderComments(container) {
        var filtered = filterComments(allComments);
        if (!filtered || filtered.length === 0) {
            container.innerHTML =
                '<div class="comments-empty">' +
                '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h8M8 8h8m-8 8h4M3 5a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H7l-4 4V5z"/></svg>' +
                '<p>' + (searchQuery ? 'No comments match your search' : 'No comments yet') + '</p>' +
                '<p class="comments-empty-hint">' + (searchQuery ? 'Try a different search term' : 'Be the first to share your thoughts!') + '</p>' +
                '</div>';
            return;
        }
        container.innerHTML = '';
        var toShow = filtered.slice(0, currentLimit);
        toShow.forEach(function(c, idx) {
            var el = renderComment(c, false, idx);
            el.style.animationDelay = Math.min(idx * 0.04, 0.4) + 's';
            container.appendChild(el);
        });
        if (filtered.length > currentLimit) {
            var moreBtn = document.createElement('button');
            moreBtn.className = 'comment-load-more';
            moreBtn.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg> Show more comments (' + (filtered.length - currentLimit) + ' remaining)';
            moreBtn.onclick = function() {
                currentLimit += PAGE_SIZE;
                renderComments(container);
            };
            container.appendChild(moreBtn);
        }
        var showingEl = document.createElement('div');
        showingEl.className = 'comment-showing-count';
        showingEl.textContent = 'Showing ' + toShow.length + ' of ' + filtered.length + ' comments';
        container.appendChild(showingEl);
    }

    function renderComment(comment, isReply, idx) {
        var item = document.createElement('div');
        item.className = isReply ? 'comment-reply' : 'comment-item';
        item.dataset.id = comment.id;
        if (comment.pinned) item.classList.add('pinned');

        var isLiked = !!likedComments[comment.id];
        var isDisliked = !!dislikedComments[comment.id];
        var initials = getInitials(comment.name);
        var color = comment.avatar_color || '#10b981';
        var replies = comment.replies || [];
        var editable = canEdit(comment);
        var deleted = comment.deleted;

        var html =
            '<div class="comment-item-header">' +
                '<div class="comment-avatar" style="background:' + escapeHtml(color) + '">' + escapeHtml(initials) + '</div>' +
                '<div class="comment-meta">' +
                    '<div class="comment-name-row">' +
                        '<span class="comment-name">' + escapeHtml(comment.name) + '</span>' +
                        (comment.hearted ? '<span class="comment-heart-badge" title="Hearted"><svg fill="currentColor" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg></span>' : '') +
                        (comment.pinned ? '<span class="comment-pinned-badge"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 00-2 2v6a2 2 0 002 2h4l1 4 1-4h4a2 2 0 002-2V7a2 2 0 00-2-2H5z"/></svg>Pinned</span>' : '') +
                    '</div>' +
                    '<div class="comment-time">' + escapeHtml(timeAgo(comment.timestamp)) + (comment.edited ? ' <span class="comment-edited">(edited)</span>' : '') + '</div>' +
                '</div>' +
            '</div>' +
            '<div class="comment-body">' + (deleted ? '<span class="comment-deleted-text">[Comment deleted]</span>' : formatMessage(comment.message)) + '</div>' +
            '<div class="comment-actions">' +
                '<button class="comment-action-btn like-btn' + (isLiked ? ' liked' : '') + '" data-id="' + escapeHtml(comment.id) + '">' +
                    '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3"/></svg>' +
                    '<span class="comment-likes-count">' + (comment.likes || 0) + '</span>' +
                '</button>' +
                '<button class="comment-action-btn dislike-btn' + (isDisliked ? ' disliked' : '') + '" data-id="' + escapeHtml(comment.id) + '">' +
                    '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 15v4a3 3 0 003 3l4-9V2H5.72a2 2 0 00-2 1.7l-1.38 9a2 2 0 002 2.3zM17 2h2.67A2.31 2.31 0 0122 4v7a2.31 2.31 0 01-2.33 2H17"/></svg>' +
                    '<span class="comment-dislikes-count">' + (comment.dislikes || 0) + '</span>' +
                '</button>' +
                (isReply ? '' :
                    '<button class="comment-action-btn reply-btn" data-id="' + escapeHtml(comment.id) + '">' +
                        '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>' +
                        'Reply' +
                    '</button>') +
                (editable ?
                    '<button class="comment-action-btn edit-btn" data-id="' + escapeHtml(comment.id) + '">' +
                        '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>' +
                        'Edit' +
                    '</button>'
                : '') +
                (editable ?
                    '<button class="comment-action-btn delete-btn" data-id="' + escapeHtml(comment.id) + '">' +
                        '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>' +
                        'Delete' +
                    '</button>'
                : '') +
                '<button class="comment-action-btn report-btn" data-id="' + escapeHtml(comment.id) + '" title="Report">' +
                    '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/></svg>' +
                '</button>' +
            '</div>';

        if (editable && !deleted) {
            html +=
                '<div class="comment-edit-form" id="edit-form-' + escapeHtml(comment.id) + '">' +
                    '<textarea class="comment-form-textarea" id="edit-text-' + escapeHtml(comment.id) + '" maxlength="1000">' + escapeHtml(comment.message) + '</textarea>' +
                    '<div class="comment-form-footer">' +
                        '<button class="comment-form-submit edit-submit-btn" data-id="' + escapeHtml(comment.id) + '">' +
                            '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>' +
                            'Save' +
                        '</button>' +
                        '<button class="comment-action-btn cancel-edit-btn" data-id="' + escapeHtml(comment.id) + '">Cancel</button>' +
                    '</div>' +
                '</div>';
        }

        if (!isReply) {
            html +=
                '<div class="comment-reply-form" id="reply-form-' + escapeHtml(comment.id) + '">' +
                    '<div class="comment-form-row">' +
                        '<input type="text" class="comment-form-name" placeholder="Your name (optional)" value="' + escapeHtml(getSavedName()) + '" id="reply-name-' + escapeHtml(comment.id) + '">' +
                    '</div>' +
                    '<textarea class="comment-form-textarea" placeholder="Write a reply..." id="reply-text-' + escapeHtml(comment.id) + '"></textarea>' +
                    '<div class="comment-form-footer">' +
                        '<button class="comment-form-submit reply-submit-btn" data-parent="' + escapeHtml(comment.id) + '">' +
                            '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>' +
                            'Post Reply' +
                        '</button>' +
                        '<button class="comment-action-btn cancel-reply-btn" data-id="' + escapeHtml(comment.id) + '">Cancel</button>' +
                    '</div>' +
                '</div>';
        }

        if (replies.length > 0) {
            html += '<div class="comment-replies">';
            replies.forEach(function(r) { html += renderReplyHtml(r); });
            html += '</div>';
        }

        item.innerHTML = html;
        wireCommentActions(item);
        return item;
    }

    function renderReplyHtml(comment) {
        var isLiked = !!likedComments[comment.id];
        var isDisliked = !!dislikedComments[comment.id];
        var initials = getInitials(comment.name);
        var color = comment.avatar_color || '#10b981';
        var editable = canEdit(comment);
        var deleted = comment.deleted;
        return '<div class="comment-reply" data-id="' + escapeHtml(comment.id) + '">' +
            '<div class="comment-item-header">' +
                '<div class="comment-avatar" style="background:' + escapeHtml(color) + '">' + escapeHtml(initials) + '</div>' +
                '<div class="comment-meta">' +
                    '<div class="comment-name-row">' +
                        '<span class="comment-name">' + escapeHtml(comment.name) + '</span>' +
                        (comment.hearted ? '<span class="comment-heart-badge"><svg fill="currentColor" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg></span>' : '') +
                    '</div>' +
                    '<div class="comment-time">' + escapeHtml(timeAgo(comment.timestamp)) + (comment.edited ? ' <span class="comment-edited">(edited)</span>' : '') + '</div>' +
                '</div>' +
            '</div>' +
            '<div class="comment-body">' + (deleted ? '<span class="comment-deleted-text">[Comment deleted]</span>' : formatMessage(comment.message)) + '</div>' +
            '<div class="comment-actions">' +
                '<button class="comment-action-btn like-btn' + (isLiked ? ' liked' : '') + '" data-id="' + escapeHtml(comment.id) + '">' +
                    '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3"/></svg>' +
                    '<span class="comment-likes-count">' + (comment.likes || 0) + '</span>' +
                '</button>' +
                '<button class="comment-action-btn dislike-btn' + (isDisliked ? ' disliked' : '') + '" data-id="' + escapeHtml(comment.id) + '">' +
                    '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 15v4a3 3 0 003 3l4-9V2H5.72a2 2 0 00-2 1.7l-1.38 9a2 2 0 002 2.3zM17 2h2.67A2.31 2.31 0 0122 4v7a2.31 2.31 0 01-2.33 2H17"/></svg>' +
                    '<span class="comment-dislikes-count">' + (comment.dislikes || 0) + '</span>' +
                '</button>' +
                (editable ?
                    '<button class="comment-action-btn edit-btn" data-id="' + escapeHtml(comment.id) + '">' +
                        '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>' +
                        'Edit' +
                    '</button>'
                : '') +
                (editable ?
                    '<button class="comment-action-btn delete-btn" data-id="' + escapeHtml(comment.id) + '">' +
                        '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>' +
                        'Delete' +
                    '</button>'
                : '') +
                '<button class="comment-action-btn report-btn" data-id="' + escapeHtml(comment.id) + '" title="Report">' +
                    '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/></svg>' +
                '</button>' +
            '</div>' +
            (editable && !deleted ?
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

    // ===== Wire up actions =====
    function wireCommentActions(item) {
        var likeBtn = item.querySelector('.like-btn');
        if (likeBtn) likeBtn.addEventListener('click', function() { handleReact(likeBtn, 'like'); });

        var dislikeBtn = item.querySelector('.dislike-btn');
        if (dislikeBtn) dislikeBtn.addEventListener('click', function() { handleReact(dislikeBtn, 'dislike'); });

        var replyBtn = item.querySelector('.reply-btn');
        if (replyBtn) {
            replyBtn.addEventListener('click', function() {
                var form = item.querySelector('.comment-reply-form');
                if (form) { form.classList.toggle('open'); if (form.classList.contains('open')) { var ta = form.querySelector('textarea'); if (ta) ta.focus(); } }
            });
        }

        var replySubmit = item.querySelector('.reply-submit-btn');
        if (replySubmit) replySubmit.addEventListener('click', function() { handleReplySubmit(replySubmit, item); });

        var cancelBtn = item.querySelector('.cancel-reply-btn');
        if (cancelBtn) cancelBtn.addEventListener('click', function() { var form = item.querySelector('.comment-reply-form'); if (form) form.classList.remove('open'); });

        var reportBtn = item.querySelector('.report-btn');
        if (reportBtn) reportBtn.addEventListener('click', function() { handleReport(reportBtn); });

        var editBtns = item.querySelectorAll('.edit-btn');
        editBtns.forEach(function(editBtn) {
            editBtn.addEventListener('click', function() {
                var form = item.querySelector('.comment-edit-form');
                if (form) { form.classList.toggle('open'); if (form.classList.contains('open')) { var ta = form.querySelector('textarea'); if (ta) { ta.focus(); ta.setSelectionRange(ta.value.length, ta.value.length); } } }
            });
        });

        var editSubmitBtns = item.querySelectorAll('.edit-submit-btn');
        editSubmitBtns.forEach(function(editSubmitBtn) { editSubmitBtn.addEventListener('click', function() { handleEditSubmit(editSubmitBtn, item); }); });

        var cancelEditBtns = item.querySelectorAll('.cancel-edit-btn');
        cancelEditBtns.forEach(function(cancelEditBtn) { cancelEditBtn.addEventListener('click', function() { var form = item.querySelector('.comment-edit-form'); if (form) form.classList.remove('open'); }); });

        var deleteBtns = item.querySelectorAll('.delete-btn');
        deleteBtns.forEach(function(deleteBtn) { deleteBtn.addEventListener('click', function() { handleDelete(deleteBtn); }); });

        var tsBadges = item.querySelectorAll('.comment-timestamp-badge');
        tsBadges.forEach(function(badge) {
            badge.addEventListener('click', function() {
                var time = badge.dataset.time;
                var seconds = parseTimestamp(time);
                var video = document.getElementById('modal-video');
                if (video && video.src) {
                    try { video.currentTime = seconds; video.play().catch(function() {}); } catch (e) {}
                    showToast('Jumped to ' + time);
                }
            });
        });
    }

    function handleReact(btn, type) {
        var id = btn.dataset.id;
        var isLike = type === 'like';
        var stateMap = isLike ? likedComments : dislikedComments;
        var otherMap = isLike ? dislikedComments : likedComments;
        var otherBtnSelector = isLike ? '.dislike-btn' : '.like-btn';
        var otherCountSelector = isLike ? '.comment-dislikes-count' : '.comment-likes-count';
        var thisCountSelector = isLike ? '.comment-likes-count' : '.comment-dislikes-count';
        var activeClass = isLike ? 'liked' : 'disliked';

        var newType;
        if (stateMap[id]) {
            newType = 'none';
            delete stateMap[id];
            btn.classList.remove(activeClass);
        } else {
            newType = type;
            stateMap[id] = true;
            btn.classList.add(activeClass);
            if (otherMap[id]) {
                delete otherMap[id];
                var otherBtn = btn.parentElement.querySelector(otherBtnSelector);
                if (otherBtn) otherBtn.classList.remove(isLike ? 'disliked' : 'liked');
            }
        }
        if (isLike) saveLiked(); else saveDisliked();
        if (isLike) saveDisliked(); else saveLiked();

        btn.disabled = true;
        fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'react', id: id, type: newType, user_id: userId })
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            btn.disabled = false;
            if (data.ok) {
                var thisCount = btn.querySelector(thisCountSelector);
                if (thisCount) thisCount.textContent = isLike ? data.likes : data.dislikes;
                var otherBtn = btn.parentElement.querySelector(otherBtnSelector);
                if (otherBtn) {
                    var otherCount = otherBtn.querySelector(otherCountSelector);
                    if (otherCount) otherCount.textContent = isLike ? data.dislikes : data.likes;
                }
                if (isLike && newType === 'like') btn.classList.add('pop');
            }
        })
        .catch(function() { btn.disabled = false; });
    }

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
            if (data.ok) { showToast('Comment reported. Thank you.'); btn.style.color = '#ef4444'; btn.textContent = 'Reported'; }
        })
        .catch(function() { btn.disabled = false; });
    }

    function handleDelete(btn) {
        var id = btn.dataset.id;
        if (!confirm('Delete this comment? This cannot be undone.')) return;
        btn.disabled = true;
        var token = myEditTokens[id] || '';
        fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'delete', id: id, edit_token: token })
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            btn.disabled = false;
            if (data.ok) {
                showToast('Comment deleted');
                fetchComments(currentVideoId);
                if (modalVideoId) fetchModalComments(modalVideoId);
            } else { showToast(data.error || 'Failed to delete'); }
        })
        .catch(function() { btn.disabled = false; showToast('Failed to delete'); });
    }

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
            } else { showToast(data.error || 'Failed to edit'); }
        })
        .catch(function() { btn.disabled = false; btn.innerHTML = origText; showToast('Failed to edit'); });
    }

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
                if (data.comment && data.comment.edit_token) { myEditTokens[data.comment.id] = data.comment.edit_token; saveEditTokens(); }
                if (nameInput) nameInput.value = '';
                if (textInput) textInput.value = '';
                showToast('Reply posted!');
                lastSeenTimestamp = Math.floor(Date.now() / 1000);
                clearBellBadge();
                fetchComments(currentVideoId);
            } else { btn.innerHTML = 'Post Reply'; showToast(data.error || 'Failed to post reply'); }
        })
        .catch(function() { btn.disabled = false; btn.innerHTML = 'Post Reply'; showToast('Failed to post reply'); });
    }

    // ===== Character counter =====
    function setupCharCounter(textarea, counterEl, submitBtn) {
        function update() {
            var len = textarea.value.length;
            if (counterEl) {
                counterEl.textContent = len + '/1000';
                counterEl.classList.toggle('warning', len > 900);
                counterEl.classList.toggle('max', len >= 1000);
            }
            if (submitBtn) submitBtn.disabled = len === 0 || len >= 1000;
        }
        textarea.addEventListener('input', update);
        update();
    }

    // ===== Sort toggle =====
    function setupSortToggle() {
        var container = document.getElementById('comment-sort-toggle');
        if (!container) return;
        var btns = container.querySelectorAll('.sort-btn');
        btns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                currentSort = btn.dataset.sort;
                saveSort();
                currentLimit = PAGE_SIZE;
                btns.forEach(function(b) { b.classList.remove('active'); });
                btn.classList.add('active');
                fetchComments(currentVideoId);
            });
            if (btn.dataset.sort === currentSort) btn.classList.add('active');
        });
    }

    // ===== Search =====
    function setupSearch() {
        var input = document.getElementById('comment-search');
        if (!input) return;
        var clearBtn = document.getElementById('comment-search-clear');
        var container = document.getElementById('comments-list');
        input.addEventListener('input', function() {
            searchQuery = input.value.trim();
            if (clearBtn) clearBtn.style.display = searchQuery ? 'flex' : 'none';
            currentLimit = PAGE_SIZE;
            if (allComments.length > 0) renderComments(container);
        });
        if (clearBtn) {
            clearBtn.addEventListener('click', function() {
                input.value = '';
                searchQuery = '';
                clearBtn.style.display = 'none';
                currentLimit = PAGE_SIZE;
                if (allComments.length > 0) renderComments(container);
            });
        }
    }

    // ===== Main form =====
    function initMainForm() {
        var form = document.getElementById('comment-form');
        if (!form) return;
        var nameInput = form.querySelector('#comment-name');
        var textInput = form.querySelector('#comment-textarea');
        var submitBtn = form.querySelector('#comment-submit');
        var avatarEl = document.getElementById('comment-form-avatar');
        var counterEl = document.getElementById('comment-char-counter');

        if (nameInput) nameInput.value = getSavedName();

        function updateAvatar() {
            if (!avatarEl || !nameInput) return;
            var name = nameInput.value.trim() || 'A';
            avatarEl.textContent = getInitials(name);
        }
        if (nameInput) nameInput.addEventListener('input', updateAvatar);
        updateAvatar();

        if (textInput) setupCharCounter(textInput, counterEl, submitBtn);

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
                    if (data.comment && data.comment.edit_token) { myEditTokens[data.comment.id] = data.comment.edit_token; saveEditTokens(); }
                    if (textInput) textInput.value = '';
                    if (nameInput) nameInput.value = '';
                    if (avatarEl) avatarEl.textContent = 'A';
                    if (counterEl) { counterEl.textContent = '0/1000'; counterEl.classList.remove('warning', 'max'); }
                    showToast('Comment posted!');
                    lastSeenTimestamp = Math.floor(Date.now() / 1000);
                    clearBellBadge();
                    currentLimit = PAGE_SIZE;
                    fetchComments(currentVideoId);
                } else { showToast(data.error || 'Failed to post comment'); }
            })
            .catch(function() { submitBtn.disabled = false; submitBtn.innerHTML = origText; showToast('Failed to post comment'); });
        });
    }

    // ===== Notification polling =====
    function startNotificationPolling() {
        if (pollTimer) clearInterval(pollTimer);
        pollTimer = setInterval(checkNewComments, 30000);
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
                    lastSeenTimestamp = data.latest_timestamp || 0;
                    hasInitialized = true;
                    if (data.count > 0) { badge.textContent = data.count; badge.style.display = ''; }
                    return;
                }
                if (data.latest_timestamp > lastSeenTimestamp && data.count > 0) {
                    bell.classList.add('has-new');
                    var newCount = data.count;
                    badge.textContent = newCount;
                    badge.style.display = '';
                    badge.classList.add('pop');
                    setTimeout(function() { badge.classList.remove('pop'); }, 400);
                    showToast(data.latest_name ? data.latest_name + ' posted a new comment' : 'New comment available');
                    lastSeenTimestamp = data.latest_timestamp;
                    setTimeout(function() { bell.classList.remove('has-new'); }, 2000);
                }
            })
            .catch(function() {});
    }

    // ===== Bell tooltip =====
    function setupBellTooltip() {
        var bell = document.getElementById('comments-bell');
        if (!bell) return;
        var tooltip = null;
        var timer = null;
        bell.addEventListener('mouseenter', function() {
            timer = setTimeout(function() {
                fetch(API_URL + '?action=count&video_id=general')
                    .then(function(r) { return r.json(); })
                    .then(function(data) {
                        if (!data.ok || !data.latest_name) return;
                        tooltip = document.createElement('div');
                        tooltip.className = 'comment-bell-tooltip';
                        tooltip.innerHTML = '<strong>' + escapeHtml(data.latest_name) + '</strong>: ' + escapeHtml(data.latest_message || '');
                        document.body.appendChild(tooltip);
                        var rect = bell.getBoundingClientRect();
                        tooltip.style.position = 'fixed';
                        tooltip.style.bottom = (window.innerHeight - rect.top + 8) + 'px';
                        tooltip.style.left = (rect.left + rect.width / 2 - tooltip.offsetWidth / 2) + 'px';
                    })
                    .catch(function() {});
            }, 300);
        });
        bell.addEventListener('mouseleave', function() {
            if (timer) { clearTimeout(timer); timer = null; }
            if (tooltip) { tooltip.remove(); tooltip = null; }
        });
    }

    window.scrollToComments = function() {
        var section = document.getElementById('comments-section');
        if (section) {
            section.scrollIntoView({ behavior: 'smooth', block: 'start' });
            section.style.transition = 'box-shadow 0.3s ease';
            section.style.boxShadow = '0 0 0 3px color-mix(in srgb, var(--accent) 20%, transparent)';
            setTimeout(function() { section.style.boxShadow = ''; }, 1500);
        }
        lastSeenTimestamp = Math.floor(Date.now() / 1000);
        clearBellBadge();
    };

    // ===== Modal comments =====
    function fetchModalComments(videoId) {
        modalVideoId = videoId;
        var container = document.getElementById('modal-comments-list');
        var countBadge = document.getElementById('modal-comments-count');
        if (!container) return;
        container.innerHTML = '<div class="comments-loading">Loading comments</div>';
        fetch(API_URL + '?video_id=' + encodeURIComponent(videoId) + '&sort=' + encodeURIComponent(currentSort))
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (!data.ok) throw new Error(data.error || 'Failed to load');
                allComments = data.comments || [];
                renderModalComments(container);
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

    function renderModalComments(container) {
        var filtered = filterComments(allComments);
        if (!filtered || filtered.length === 0) {
            container.innerHTML = '<div class="comments-empty"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h8M8 8h8m-8 8h4M3 5a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H7l-4 4V5z"/></svg><p>No comments yet</p><p class="comments-empty-hint">Be the first to comment!</p></div>';
            return;
        }
        container.innerHTML = '';
        var toShow = filtered.slice(0, currentLimit);
        toShow.forEach(function(c, idx) {
            var el = renderComment(c, false, idx);
            el.style.animationDelay = Math.min(idx * 0.04, 0.4) + 's';
            container.appendChild(el);
        });
        if (filtered.length > currentLimit) {
            var moreBtn = document.createElement('button');
            moreBtn.className = 'comment-load-more';
            moreBtn.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg> Show more (' + (filtered.length - currentLimit) + ')';
            moreBtn.onclick = function() { currentLimit += PAGE_SIZE; renderModalComments(container); };
            container.appendChild(moreBtn);
        }
    }

    function initModalForm() {
        var submitBtn = document.getElementById('modal-comment-submit');
        if (!submitBtn) return;
        var nameInput = document.getElementById('modal-comment-name');
        var textInput = document.getElementById('modal-comment-textarea');
        var counterEl = document.getElementById('modal-comment-char-counter');
        if (textInput) setupCharCounter(textInput, counterEl, submitBtn);
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
                    if (data.comment && data.comment.edit_token) { myEditTokens[data.comment.id] = data.comment.edit_token; saveEditTokens(); }
                    if (textInput) textInput.value = '';
                    if (nameInput) nameInput.value = '';
                    if (counterEl) { counterEl.textContent = '0/1000'; counterEl.classList.remove('warning', 'max'); }
                    showToast('Comment posted!');
                    lastSeenTimestamp = Math.floor(Date.now() / 1000);
                    clearBellBadge();
                    currentLimit = PAGE_SIZE;
                    fetchModalComments(modalVideoId);
                    if (currentVideoId === modalVideoId) fetchComments(currentVideoId);
                } else { showToast(data.error || 'Failed to post comment'); }
            })
            .catch(function() { submitBtn.disabled = false; submitBtn.innerHTML = origText; showToast('Failed to post comment'); });
        });
    }

    // ===== Public API =====
    window.DispatchComments = {
        load: function(videoId) { currentLimit = PAGE_SIZE; fetchComments(videoId); },
        loadModal: function(videoId) { currentLimit = PAGE_SIZE; fetchModalComments(videoId); },
        init: function(videoId) {
            function doInit() {
                initMainForm();
                initModalForm();
                setupSortToggle();
                setupSearch();
                setupBellTooltip();
                fetchComments(videoId);
                startNotificationPolling();
            }
            if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', doInit);
            else doInit();
        }
    };

    setTimeout(function() {
        if (currentVideoId === null) {
            console.log('[comments] Self-initializing with video_id=general');
            window.DispatchComments.init('general');
        }
    }, 2000);
})();
