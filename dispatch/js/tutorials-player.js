// tutorials-player.js — Video rendering, modal, watch history, favorites, progress, related videos, filters, keyboard shortcuts, cursor sync
// Used by tutorials.php. Depends on tutorials-data.js (VIDEOS, AVAILABLE_VIDEOS, state, isAvailable, escapeHtml) and tutorials-settings.js (loadSettings, showAnnouncement).

(function() {
    'use strict';

    var VIDEOS = window.VIDEOS;
    var state = window.tutorialState;

    // ===== User data =====
    function loadUserData() {
        try {
            state.watchHistory = JSON.parse(localStorage.getItem('dispatch-watch-history') || '[]');
            state.favorites = JSON.parse(localStorage.getItem('dispatch-favorites') || '[]');
            state.videoProgress = JSON.parse(localStorage.getItem('dispatch-video-progress') || '{}');
            if (!Array.isArray(state.watchHistory)) state.watchHistory = [];
            state.watchHistory = state.watchHistory.filter(function(v) {
                return v && typeof v.id === 'string' && typeof v.title === 'string';
            });
            if (!Array.isArray(state.favorites)) state.favorites = [];
            state.favorites = state.favorites.filter(function(v) { return typeof v === 'string'; });
            if (typeof state.videoProgress !== 'object' || state.videoProgress === null) state.videoProgress = {};
        } catch (e) {
            state.watchHistory = [];
            state.favorites = [];
            state.videoProgress = {};
        }
    }

    function saveUserData() {
        try {
            localStorage.setItem('dispatch-watch-history', JSON.stringify(state.watchHistory));
            localStorage.setItem('dispatch-favorites', JSON.stringify(state.favorites));
            localStorage.setItem('dispatch-video-progress', JSON.stringify(state.videoProgress));
        } catch (e) {}
    }

    function addToWatchHistory(video) {
        var existingIndex = state.watchHistory.findIndex(function(v) { return v.id === video.id; });
        if (existingIndex !== -1) state.watchHistory.splice(existingIndex, 1);
        state.watchHistory.unshift({
            id: video.id, title: video.title, desc: video.desc,
            src: video.src, category: video.category, timestamp: Date.now()
        });
        if (state.watchHistory.length > 8) state.watchHistory.pop();
        saveUserData();
        renderWatchHistory();
    }

    function clearWatchHistory() {
        state.watchHistory = [];
        saveUserData();
        renderWatchHistory();
    }

    function renderWatchHistory() {
        var container = document.getElementById('watch-history');
        var grid = document.getElementById('watch-history-grid');
        var countLabel = document.getElementById('wh-count-label');
        if (!container || !grid) return;
        if (state.watchHistory.length === 0) { container.style.display = 'none'; return; }
        container.style.display = 'block';
        grid.innerHTML = '';
        if (countLabel) countLabel.textContent = state.watchHistory.length + (state.watchHistory.length === 1 ? ' video' : ' videos') + ' · Pick up where you left off';

        state.watchHistory.forEach(function(v) {
            var item = document.createElement('div');
            item.className = 'history-item';
            item.onclick = function() {
                var video = VIDEOS.find(function(vid) { return vid.id === v.id; });
                if (video) openModal(video);
            };
            var timeAgo = getTimeAgo(v.timestamp);
            var available = isAvailable(v.src);
            var prog = state.videoProgress[v.id];
            var progressPct = (prog && prog.duration > 0) ? Math.min(100, Math.max(0, prog.progress)) : 0;
            var isContinue = progressPct > 0 && progressPct < 95;

            if (available) {
                var hoverTimer = null;
                item.addEventListener('mouseenter', function() {
                    var vid = item.querySelector('.history-thumb-wrap video');
                    if (!vid) return;
                    hoverTimer = setTimeout(function() {
                        vid.currentTime = (prog && prog.currentTime > 0) ? prog.currentTime : 0;
                        vid.play().catch(function() {});
                    }, 300);
                });
                item.addEventListener('mouseleave', function() {
                    if (hoverTimer) { clearTimeout(hoverTimer); hoverTimer = null; }
                    var vid = item.querySelector('.history-thumb-wrap video');
                    if (!vid) return;
                    vid.pause();
                    vid.currentTime = 0;
                });
            }

            var thumbInner = available
                ? '<video muted preload="metadata"><source src="' + escapeHtml(v.src) + '" type="video/mp4"></video>'
                : '<div class="history-thumb-placeholder"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg></div>';

            item.innerHTML =
                '<div class="history-thumb-wrap">' + thumbInner +
                    (isContinue ? '<span class="history-continue-badge"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 3l14 9-14 9V3z" fill="currentColor"/></svg>Continue</span>' : '') +
                    '<div class="history-play-overlay"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 4.806A1 1 0 0116 5.69v12.62a1 1 0 01-1.248.884l-9-4.5a1 1 0 010-1.788l9-4.5z" fill="currentColor"/></svg></div>' +
                    (progressPct > 0 ? '<div class="history-progress"><div class="history-progress-fill" style="width:' + progressPct.toFixed(1) + '%"></div></div>' : '') +
                '</div>' +
                '<div class="history-info"><h4>' + escapeHtml(v.title) + '</h4>' +
                    '<div class="history-meta"><span>' + escapeHtml(v.category) + '</span><span class="history-meta-dot"></span>' +
                    '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg><span>' + escapeHtml(timeAgo) + '</span></div>' +
                '</div>';
            grid.appendChild(item);
        });

        if (!grid.dataset.wheelWired) {
            grid.dataset.wheelWired = '1';
            grid.addEventListener('wheel', function(e) {
                if (Math.abs(e.deltaX) >= Math.abs(e.deltaY)) return;
                var maxScroll = grid.scrollWidth - grid.clientWidth;
                if (maxScroll <= 0) return;
                var atStart = grid.scrollLeft <= 0 && e.deltaY < 0;
                var atEnd = grid.scrollLeft >= maxScroll && e.deltaY > 0;
                if (atStart || atEnd) return;
                e.preventDefault();
                grid.scrollLeft += e.deltaY;
            }, { passive: false });
        }
    }

    function getTimeAgo(timestamp) {
        var seconds = Math.floor((Date.now() - timestamp) / 1000);
        if (seconds < 60) return 'Just now';
        if (seconds < 3600) return Math.floor(seconds / 60) + 'm ago';
        if (seconds < 86400) return Math.floor(seconds / 3600) + 'h ago';
        return Math.floor(seconds / 86400) + 'd ago';
    }

    // ===== Favorites =====
    function toggleFavorite(videoId, event) {
        if (event) event.stopPropagation();
        var index = state.favorites.indexOf(videoId);
        if (index === -1) { state.favorites.push(videoId); showAnnouncement('Added to favorites'); }
        else { state.favorites.splice(index, 1); showAnnouncement('Removed from favorites'); }
        saveUserData();
        renderVideos();
        updateModalFavoriteButton();
    }

    function toggleFavoriteFromModal() {
        if (state.currentVideo) toggleFavorite(state.currentVideo.id);
    }

    function updateModalFavoriteButton() {
        var btn = document.getElementById('modal-favorite-btn');
        if (!btn || !state.currentVideo) return;
        btn.classList.toggle('active', state.favorites.indexOf(state.currentVideo.id) !== -1);
    }

    // ===== Progress =====
    function updateVideoProgress(videoId, currentTime, duration) {
        if (!duration || duration === 0) return;
        state.videoProgress[videoId] = { currentTime: currentTime, duration: duration, progress: (currentTime / duration) * 100, timestamp: Date.now() };
        saveUserData();
    }

    function togglePiP() {
        var video = document.getElementById('modal-video');
        if (!video) return;
        if (document.pictureInPictureElement) document.exitPictureInPicture().catch(function() {});
        else if (video.readyState >= 2) video.requestPictureInPicture().catch(function() { showAnnouncement('Picture-in-Picture not supported'); });
    }

    // ===== Related videos =====
    function renderRelatedVideos(currentVideo) {
        var container = document.getElementById('related-videos');
        var list = document.getElementById('related-list');
        if (!container || !list || !currentVideo) return;
        var related = VIDEOS.filter(function(v) { return v.id !== currentVideo.id && v.path === currentVideo.path; }).slice(0, 8);
        if (related.length < 4) {
            var extra = VIDEOS.filter(function(v) { return v.id !== currentVideo.id && v.path !== currentVideo.path && v.category === currentVideo.category; }).slice(0, 8 - related.length);
            related.push.apply(related, extra);
        }
        if (related.length === 0) { container.style.display = 'none'; return; }
        container.style.display = 'flex';
        list.innerHTML = '';
        related.forEach(function(v) {
            var item = document.createElement('div');
            item.className = 'related-item';
            item.onclick = function() { openModal(v); };
            var available = isAvailable(v.src);
            if (available) {
                var hoverTimer = null;
                item.addEventListener('mouseenter', function() {
                    var vid = item.querySelector('.related-item-thumb video');
                    if (!vid) return;
                    hoverTimer = setTimeout(function() { vid.currentTime = 0; vid.play().catch(function() {}); }, 300);
                });
                item.addEventListener('mouseleave', function() {
                    if (hoverTimer) { clearTimeout(hoverTimer); hoverTimer = null; }
                    var vid = item.querySelector('.related-item-thumb video');
                    if (!vid) return;
                    vid.pause(); vid.currentTime = 0;
                });
            }
            item.innerHTML =
                '<div class="related-item-thumb">' + (available ? '<video muted preload="metadata"><source src="' + escapeHtml(v.src) + '" type="video/mp4"></video>' : '<div style="width:100%;height:100%;background:#000;display:grid;place-items:center;"><svg style="width:20px;height:20px;color:rgba(255,255,255,0.45);opacity:0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg></div>') + '</div>' +
                '<div class="related-item-info"><h5>' + escapeHtml(v.title) + '</h5><p>' + escapeHtml(v.category) + ' · ' + escapeHtml(v.level || 'Beginner') + '</p></div>';
            list.appendChild(item);
        });
    }

    // ===== Render video grid =====
    function renderVideos() {
        var grid = document.getElementById('video-grid');
        var searchTerm = document.getElementById('search-input').value.toLowerCase().trim();
        grid.innerHTML = '';
        var filtered = VIDEOS.filter(function(v) {
            var matchesFilter = state.currentFilter === 'all' || v.path === state.currentFilter;
            var matchesSearch = !searchTerm || v.title.toLowerCase().indexOf(searchTerm) !== -1 || v.desc.toLowerCase().indexOf(searchTerm) !== -1 || v.path.toLowerCase().indexOf(searchTerm) !== -1 || v.category.toLowerCase().indexOf(searchTerm) !== -1;
            return matchesFilter && matchesSearch;
        });
        if (filtered.length === 0) document.getElementById('no-results').classList.add('show');
        else document.getElementById('no-results').classList.remove('show');

        filtered.forEach(function(v, idx) {
            var available = isAvailable(v.src);
            var isFav = state.favorites.indexOf(v.id) !== -1;
            var levelClass = (v.level || 'Beginner').toLowerCase();
            var avatarLetter = v.title.charAt(0).toUpperCase();
            var card = document.createElement('div');
            card.className = 'video-card';
            card.style.animationDelay = Math.min(idx * 0.04, 0.4) + 's';
            card.onclick = function(e) { if (!e.target.closest('.favorite-btn')) openModal(v); };
            if (available) {
                var hoverTimer = null;
                card.addEventListener('mouseenter', function() {
                    var vid = card.querySelector('.video-thumb video');
                    if (!vid) return;
                    hoverTimer = setTimeout(function() { vid.currentTime = 0; vid.play().catch(function() {}); }, 300);
                });
                card.addEventListener('mouseleave', function() {
                    if (hoverTimer) { clearTimeout(hoverTimer); hoverTimer = null; }
                    var vid = card.querySelector('.video-thumb video');
                    if (!vid) return;
                    vid.pause(); vid.currentTime = 0;
                });
            }
            var thumb = available
                ? '<video muted preload="metadata"><source src="' + escapeHtml(v.src) + '" type="video/mp4"></video>'
                : '<div class="video-empty"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg><span>Coming Soon</span></div>';
            card.innerHTML =
                '<div class="video-thumb"><span class="category-badge">' + escapeHtml(v.path) + '</span>' + thumb +
                    '<button class="favorite-btn' + (isFav ? ' active' : '') + '" onclick="toggleFavorite(\'' + escapeHtml(v.id) + '\', event)" title="Add to favorites" style="display:none;">' +
                    '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg></button>' +
                    (available ? '<span class="duration-badge">' + escapeHtml(v.duration) + '</span>' : '') +
                '</div>' +
                '<div class="video-info"><div class="video-avatar">' + escapeHtml(avatarLetter) + '</div>' +
                    '<div class="video-info-body"><h3>' + escapeHtml(v.title) + '</h3>' +
                        '<div class="video-channel"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>' + escapeHtml(v.category) + '</div>' +
                        '<div class="video-meta"><span class="skill-badge ' + levelClass + '">' + escapeHtml(v.level || 'Beginner') + '</span>' +
                            (available ? '<span><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Available</span>' : '<span><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Soon</span>') +
                        '</div>' +
                    '</div>' +
                '</div>';
            grid.appendChild(card);
        });
    }

    function setFilter(category, el) {
        state.currentFilter = category;
        document.querySelectorAll('.chip').forEach(function(c) { c.classList.remove('active'); });
        document.querySelectorAll('.sb-item[data-cat]').forEach(function(s) { s.classList.remove('active'); });
        document.querySelectorAll('.chip[data-cat="' + category + '"]').forEach(function(c) { c.classList.add('active'); });
        document.querySelectorAll('.sb-item[data-cat="' + category + '"]').forEach(function(s) { s.classList.add('active'); });
        renderVideos();
        if (window.innerWidth <= 1024) closeSidebar();
    }

    function filterVideos() { renderVideos(); }
    function filterVideosMobile(val) { document.getElementById('search-input').value = val; renderVideos(); }

    // ===== Modal =====
    function openModal(v) {
        state.currentVideo = v;
        var overlay = document.getElementById('modal-overlay');
        var video = document.getElementById('modal-video');
        document.getElementById('modal-title').textContent = v.title;
        document.getElementById('modal-desc').textContent = v.desc;
        document.getElementById('modal-topbar-title').textContent = v.title;
        var avatar = document.getElementById('modal-avatar');
        if (avatar) avatar.textContent = v.title.charAt(0).toUpperCase();
        var channelName = document.getElementById('modal-channel-name');
        if (channelName) channelName.textContent = v.category + ' · DISPATCH';
        var channelSub = document.getElementById('modal-channel-sub');
        if (channelSub) channelSub.textContent = v.path + ' · ' + (v.level || 'Beginner');
        var tagsEl = document.getElementById('modal-video-tags');
        if (tagsEl) {
            var levelClass = (v.level || 'Beginner').toLowerCase();
            tagsEl.innerHTML = '<span class="skill-badge ' + levelClass + '">' + escapeHtml(v.level || 'Beginner') + '</span>' + (isAvailable(v.src) ? '<span class="skill-badge beginner">Available</span>' : '<span class="skill-badge advanced">Coming Soon</span>');
        }
        var settings = loadSettings();
        addToWatchHistory(v);
        updateModalFavoriteButton();
        var dlBtn = document.getElementById('modal-download-btn');
        if (dlBtn) {
            if (isAvailable(v.src)) { dlBtn.href = v.src; dlBtn.download = v.id + '.mp4'; dlBtn.style.display = 'grid'; }
            else { dlBtn.removeAttribute('href'); dlBtn.style.display = 'none'; }
        }
        renderRelatedVideos(v);
        try { video.pause(); } catch (e) {}
        var frame = video.parentElement;
        var prevEmpty = frame.querySelector('.video-empty');
        if (prevEmpty) prevEmpty.remove();
        if (isAvailable(v.src)) {
            video.innerHTML = '<source src="' + escapeHtml(v.src) + '" type="video/mp4">';
            video.style.display = 'block';
            video.load();
            video.playbackRate = parseFloat(settings['playback-speed'] || '1');
            video.loop = !!settings['loop-video'];
            video.onloadedmetadata = function() {
                if (state.videoProgress[v.id] && state.videoProgress[v.id].currentTime > 0 && state.videoProgress[v.id].currentTime < video.duration) {
                    try { video.currentTime = state.videoProgress[v.id].currentTime; } catch (e) {}
                }
                if (settings['autoplay']) video.play().catch(function() {});
            };
            video.ontimeupdate = function() { updateVideoProgress(v.id, video.currentTime, video.duration); };
        } else {
            video.innerHTML = '';
            video.style.display = 'none';
            video.onloadedmetadata = null;
            video.ontimeupdate = null;
            var empty = document.createElement('div');
            empty.className = 'video-empty';
            empty.style.cssText = 'position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:0.5rem;background:var(--surface-2);color:var(--text-dim);';
            empty.innerHTML = '<svg style="width:48px;height:48px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg><span>No video available for this tutorial yet.</span>';
            frame.style.position = 'relative';
            frame.appendChild(empty);
        }
        overlay.classList.add('open');
        document.body.style.overflow = 'hidden';

        // Load comments for this video
        if (window.DispatchComments) window.DispatchComments.load(v.id);
    }

    function closeModal(e) {
        if (e && e.target !== document.getElementById('modal-overlay')) return;
        var overlay = document.getElementById('modal-overlay');
        var video = document.getElementById('modal-video');
        video.pause();
        video.innerHTML = '';
        var empty = video.parentElement.querySelector('.video-empty');
        if (empty) empty.remove();
        overlay.classList.remove('open');
        document.body.style.overflow = '';
    }

    // ===== Stats =====
    function updateStats() {
        var allEl = document.getElementById('count-all');
        if (allEl) allEl.textContent = VIDEOS.length;
        var pathCounts = {};
        VIDEOS.forEach(function(v) { pathCounts[v.path] = (pathCounts[v.path] || 0) + 1; });
        var pathIdMap = {
            'Getting Started': 'count-Getting-Started',
            'Dispatch & Operations': 'count-Dispatch-Operations',
            'Fleet Management': 'count-Fleet-Management',
            'Finance & Admin': 'count-Finance-Admin',
            'Safety & Compliance': 'count-Safety-Compliance'
        };
        Object.keys(pathCounts).forEach(function(path) {
            var el = document.getElementById(pathIdMap[path] || ('count-' + path.replace(/[^a-zA-Z0-9]/g, '-')));
            if (el) el.textContent = pathCounts[path];
        });
    }

    // ===== Expose to window for inline onclick handlers =====
    window.toggleFavorite = toggleFavorite;
    window.toggleFavoriteFromModal = toggleFavoriteFromModal;
    window.togglePiP = togglePiP;
    window.setFilter = setFilter;
    window.filterVideos = filterVideos;
    window.filterVideosMobile = filterVideosMobile;
    window.openModal = openModal;
    window.closeModal = closeModal;
    window.clearWatchHistory = clearWatchHistory;
    window.renderVideos = renderVideos;

    // ===== Init on DOM ready =====
    function init() {
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
            if (e.key === ' ' && document.getElementById('modal-overlay').classList.contains('open')) {
                e.preventDefault();
                var video = document.getElementById('modal-video');
                if (video && video.style.display !== 'none') { if (video.paused) video.play(); else video.pause(); }
            }
            if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
                if (document.getElementById('modal-overlay').classList.contains('open') && state.currentVideo) {
                    var currentIndex = VIDEOS.findIndex(function(v) { return v.id === state.currentVideo.id; });
                    var newIndex;
                    if (e.key === 'ArrowLeft') newIndex = currentIndex > 0 ? currentIndex - 1 : VIDEOS.length - 1;
                    else newIndex = currentIndex < VIDEOS.length - 1 ? currentIndex + 1 : 0;
                    closeModal({ target: document.getElementById('modal-overlay') });
                    setTimeout(function() { openModal(VIDEOS[newIndex]); }, 100);
                }
            }
        });

        // Cursor-synced scroll for related-list
        (function setupCursorSyncScroll() {
            var list = document.getElementById('related-list');
            if (!list) return;
            var syncing = false;
            list.addEventListener('mousemove', function(e) {
                var maxScroll = list.scrollHeight - list.clientHeight;
                if (maxScroll <= 0) return;
                var rect = list.getBoundingClientRect();
                var ratio = Math.max(0, Math.min(1, (e.clientY - rect.top) / rect.height));
                list.scrollTop = ratio * maxScroll;
                syncing = true;
            });
            list.addEventListener('mouseenter', function() { list.classList.add('cursor-sync'); });
            list.addEventListener('mouseleave', function() { list.classList.remove('cursor-sync'); syncing = false; });
            list.addEventListener('wheel', function(e) { if (syncing) return; }, { passive: true });
        })();

        // Keyboard shortcuts (tutorials.php only — J/L/K/M/F)
        (function setupKeyboardShortcuts() {
            document.addEventListener('keydown', function(e) {
                var overlay = document.getElementById('modal-overlay');
                if (!overlay || !overlay.classList.contains('open')) return;
                var settings = loadSettings();
                if (!settings['keyboard-shortcuts']) return;
                var video = document.getElementById('modal-video');
                if (!video || !video.src) return;
                var tag = (e.target && e.target.tagName) ? e.target.tagName.toLowerCase() : '';
                if (tag === 'input' || tag === 'textarea' || tag === 'select' || e.target.isContentEditable) return;
                var key = e.key.toLowerCase();
                switch (key) {
                    case 'j': e.preventDefault(); video.currentTime = Math.max(0, video.currentTime - 10); flashShortcut('−10s'); break;
                    case 'l': e.preventDefault(); video.currentTime = Math.min(video.duration || 0, video.currentTime + 10); flashShortcut('+10s'); break;
                    case 'arrowleft': e.preventDefault(); video.currentTime = Math.max(0, video.currentTime - 5); flashShortcut('−5s'); break;
                    case 'arrowright': e.preventDefault(); video.currentTime = Math.min(video.duration || 0, video.currentTime + 5); flashShortcut('+5s'); break;
                    case 'k': case ' ': e.preventDefault(); if (video.paused) video.play().catch(function() {}); else video.pause(); flashShortcut(video.paused ? 'Paused' : 'Playing'); break;
                    case 'm': e.preventDefault(); video.muted = !video.muted; flashShortcut(video.muted ? 'Muted' : 'Unmuted'); break;
                    case 'f': e.preventDefault(); if (document.fullscreenElement) document.exitFullscreen(); else if (video.requestFullscreen) video.requestFullscreen(); flashShortcut('Fullscreen'); break;
                }
            });
            function flashShortcut(text) {
                var badge = document.getElementById('shortcut-flash');
                if (!badge) {
                    badge = document.createElement('div');
                    badge.id = 'shortcut-flash';
                    badge.style.cssText = 'position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);padding:0.5rem 1rem;border-radius:10px;font-size:0.9rem;font-weight:700;background:color-mix(in srgb, var(--surface-solid) 80%, transparent);color:var(--text);border:1px solid var(--border-strong);backdrop-filter:blur(10px);z-index:2000;pointer-events:none;opacity:0;transition:opacity 0.15s ease;';
                    document.body.appendChild(badge);
                }
                badge.textContent = text;
                badge.style.opacity = '1';
                clearTimeout(badge._t);
                badge._t = setTimeout(function() { badge.style.opacity = '0'; }, 600);
            }
        })();

        // Load user data and render
        loadUserData();
        renderWatchHistory();
        updateStats();
        renderVideos();

        // Open from hash
        (function openFromHash() {
            var hash = window.location.hash.replace('#', '');
            if (hash) {
                var video = VIDEOS.find(function(v) { return v.id === hash; });
                if (video) setTimeout(function() { openModal(video); }, 900);
            }
        })();

        // Initialize comments for the general tutorials page
        if (window.DispatchComments) window.DispatchComments.init('general');
        else setTimeout(function() { if (window.DispatchComments) window.DispatchComments.init('general'); }, 100);

        // Hide loader
        window.addEventListener('load', function() {
            setTimeout(function() {
                var loader = document.getElementById('loader-screen');
                if (loader) loader.classList.add('hidden');
                setTimeout(function() { if (loader) loader.style.display = 'none'; }, 600);
            }, 800);
        });
    }

    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
    else init();
})();
