// tutorials-settings.js — Theme, settings, announcements, sidebar, and mobile search
// Used by tutorials.php. Depends on tutorials-data.js (escapeHtml).

(function() {
    'use strict';

    // ===== Background SVG =====
    function updateBackgroundSVG() {
        var isDark = !document.documentElement.classList.contains('light');
        var darkSVG = document.getElementById('bg-svg-dark');
        var lightSVG = document.getElementById('bg-svg-light');
        if (darkSVG) darkSVG.style.display = isDark ? 'block' : 'none';
        if (lightSVG) lightSVG.style.display = isDark ? 'none' : 'block';
    }

    // ===== Announcement Toast =====
    var announceTimer = null;
    function showAnnouncement(text, opts) {
        opts = opts || {};
        var toast = document.getElementById('announce-toast');
        var textEl = document.getElementById('announce-text');
        var iconEl = document.getElementById('announce-icon');
        var swatchWrap = document.getElementById('announce-swatch-wrap');
        if (!toast || !textEl) return;
        textEl.textContent = text;
        if (opts.icon === 'palette') {
            iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h8a2 2 0 002-2V5a2 2 0 00-2-2H9m4 18a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4z"/></svg>';
        } else if (opts.icon === 'theme') {
            iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>';
        } else if (opts.icon === 'reset') {
            iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>';
        } else if (opts.icon === 'sidebar') {
            iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>';
        } else {
            iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
        }
        if (opts.swatch) swatchWrap.innerHTML = '<span class="announce-swatch" style="background:' + escapeHtml(opts.swatch) + '"></span>';
        else swatchWrap.innerHTML = '';
        toast.classList.add('show');
        if (announceTimer) clearTimeout(announceTimer);
        announceTimer = setTimeout(function() { toast.classList.remove('show'); }, 2600);
    }

    // ===== Theme =====
    function updateThemeIcons() {
        var isDark = !document.documentElement.classList.contains('light');
        var moonIcon = document.querySelector('.theme-btn .moon-icon');
        var sunIcon = document.querySelector('.theme-btn .sun-icon');
        if (moonIcon && sunIcon) {
            moonIcon.style.display = isDark ? 'block' : 'none';
            sunIcon.style.display = isDark ? 'none' : 'block';
        }
    }

    function toggleTheme() {
        document.documentElement.classList.toggle('light');
        var isLight = document.documentElement.classList.contains('light');
        try { localStorage.setItem('dispatch-theme', isLight ? 'light' : 'dark'); } catch (e) {}
        try {
            var settings = JSON.parse(localStorage.getItem('dispatch-settings') || '{}');
            settings['dark-mode'] = !isLight;
            localStorage.setItem('dispatch-settings', JSON.stringify(settings));
        } catch (e) {}
        var darkToggle = document.getElementById('set-dark-mode');
        if (darkToggle) darkToggle.classList.toggle('on', !isLight);
        updateThemeIcons();
        updateBackgroundSVG();
        saveSettingsImmediate();
        showAnnouncement(!isLight ? 'Dark mode enabled' : 'Light mode enabled', { icon: 'theme' });
    }

    // ===== Settings =====
    var SETTINGS_DEFAULTS = {
        'dark-mode': true,
        'autoplay': false,
        'loop-video': false,
        'keyboard-shortcuts': true,
        'sidebar-collapsed': false,
        'sync-search': true,
        'reduce-motion': false,
        'high-contrast': false,
        'large-text': false,
        'accent-color': '#10b981',
        'font-size': '15',
        'playback-speed': '1',
        'video-quality': 'auto'
    };

    function loadSettings() {
        var saved = {};
        try { saved = JSON.parse(localStorage.getItem('dispatch-settings') || '{}'); } catch (e) {}
        return Object.assign({}, SETTINGS_DEFAULTS, saved);
    }

    function toggleSettings() {
        var panel = document.getElementById('settings-panel');
        var overlay = document.getElementById('settings-overlay');
        var isOpen = panel.classList.contains('open');
        panel.classList.toggle('open');
        overlay.classList.toggle('open');
        if (!isOpen) applySettingsToUI();
    }

    var SETTING_LABELS = {
        'dark-mode': 'Dark mode', 'autoplay': 'Autoplay', 'loop-video': 'Loop video',
        'keyboard-shortcuts': 'Keyboard shortcuts', 'sidebar-collapsed': 'Mini sidebar',
        'sync-search': 'Sync search', 'reduce-motion': 'Reduce motion',
        'high-contrast': 'High contrast', 'large-text': 'Larger text'
    };

    function toggleSetting(key, type) {
        var el = document.getElementById('set-' + key);
        if (!el) return;
        var isOn = el.classList.toggle('on');
        applySetting(key, isOn);
        saveSettingsImmediate();
        var label = SETTING_LABELS[key] || key;
        showAnnouncement(label + ' ' + (isOn ? 'enabled' : 'disabled'));
    }

    function applySetting(key, value) {
        var settings = loadSettings();
        settings[key] = value;
        try { localStorage.setItem('dispatch-settings', JSON.stringify(settings)); } catch (e) {}
        switch (key) {
            case 'dark-mode':
                if (value) document.documentElement.classList.remove('light');
                else document.documentElement.classList.add('light');
                try { localStorage.setItem('dispatch-theme', value ? 'dark' : 'light'); } catch(e) {}
                updateBackgroundSVG();
                showAnnouncement(value ? 'Dark mode enabled' : 'Light mode enabled', { icon: 'theme' });
                break;
            case 'reduce-motion':
                if (value) document.body.classList.add('reduce-motion'); else document.body.classList.remove('reduce-motion');
                break;
            case 'high-contrast':
                if (value) document.body.classList.add('high-contrast'); else document.body.classList.remove('high-contrast');
                break;
            case 'large-text':
                if (value) document.documentElement.style.fontSize = '18px';
                else document.documentElement.style.fontSize = settings['font-size'] + 'px';
                break;
            case 'sidebar-collapsed':
                if (window.innerWidth > 1024) {
                    var sidebar = document.getElementById('yt-sidebar');
                    var main = document.getElementById('main-content');
                    if (value) { sidebar.classList.add('collapsed'); main.classList.add('sidebar-collapsed'); }
                    else { sidebar.classList.remove('collapsed'); main.classList.remove('sidebar-collapsed'); }
                }
                showAnnouncement(value ? 'Mini sidebar enabled' : 'Full sidebar enabled', { icon: 'sidebar' });
                break;
            case 'autoplay': case 'sync-search': case 'loop-video': case 'keyboard-shortcuts': break;
        }
    }

    function setAccentColor(color) {
        document.querySelectorAll('#set-accent-colors .color-swatch').forEach(function(s) { s.classList.toggle('active', s.dataset.color === color); });
        document.documentElement.style.setProperty('--accent', color);
        document.documentElement.style.setProperty('--accent-soft', color + '22');
        applySetting('accent-color', color);
        saveSettingsImmediate();
        showAnnouncement('Accent color changed', { icon: 'palette' });
    }

    function setFontSize(val) {
        document.getElementById('font-size-value').textContent = val + 'px';
        var settings = loadSettings();
        if (!settings['large-text']) document.documentElement.style.fontSize = val + 'px';
        applySetting('font-size', val);
        saveSettingsImmediate();
        showAnnouncement('Font size set to ' + val + 'px');
    }

    function setPlaybackSpeed(val) {
        var video = document.getElementById('modal-video');
        if (video) video.playbackRate = parseFloat(val);
        applySetting('playback-speed', val);
        saveSettingsImmediate();
        showAnnouncement('Playback speed set to ' + val + 'x');
    }

    function setVideoQuality(val) {
        applySetting('video-quality', val);
        saveSettingsImmediate();
        showAnnouncement('Video quality set to ' + val);
    }

    function saveSettingsImmediate() {
        var settings = loadSettings();
        ['dark-mode','autoplay','loop-video','keyboard-shortcuts','sidebar-collapsed','sync-search','reduce-motion','high-contrast','large-text'].forEach(function(key) {
            var el = document.getElementById('set-' + key);
            if (el) settings[key] = el.classList.contains('on');
        });
        ['playback-speed','video-quality'].forEach(function(key) {
            var el = document.getElementById('set-' + key);
            if (el) settings[key] = el.value;
        });
        var activeSwatch = document.querySelector('#set-accent-colors .color-swatch.active');
        if (activeSwatch) settings['accent-color'] = activeSwatch.dataset.color;
        var fontSizeEl = document.getElementById('set-font-size');
        if (fontSizeEl) settings['font-size'] = fontSizeEl.value;
        try { localStorage.setItem('dispatch-settings', JSON.stringify(settings)); } catch (e) {}
    }

    function saveSettings() {
        saveSettingsImmediate();
        var btn = event.target;
        var orig = btn.textContent;
        btn.textContent = 'Saved!';
        btn.style.background = '#059669';
        setTimeout(function() { btn.textContent = orig; btn.style.background = ''; }, 1500);
    }

    function resetSettings() {
        try { localStorage.removeItem('dispatch-settings'); } catch (e) {}
        document.documentElement.style.setProperty('--accent', '#10b981');
        document.documentElement.style.setProperty('--accent-soft', 'rgba(16, 185, 129, 0.14)');
        document.documentElement.style.fontSize = '15px';
        document.body.classList.remove('reduce-motion', 'high-contrast');
        document.documentElement.classList.remove('light');
        try { localStorage.setItem('dispatch-theme', 'dark'); } catch(e) {}
        updateBackgroundSVG();
        applySettingsToUI();
        showAnnouncement('Settings reset to default', { icon: 'reset' });
    }

    function applySettingsToUI() {
        var s = loadSettings();
        ['dark-mode','autoplay','loop-video','keyboard-shortcuts','sidebar-collapsed','sync-search','reduce-motion','high-contrast','large-text'].forEach(function(key) {
            var el = document.getElementById('set-' + key);
            if (el) el.classList.toggle('on', !!s[key]);
        });
        ['playback-speed','video-quality'].forEach(function(key) {
            var el = document.getElementById('set-' + key);
            if (el) el.value = s[key];
        });
        var fsEl = document.getElementById('set-font-size');
        if (fsEl) { fsEl.value = s['font-size']; document.getElementById('font-size-value').textContent = s['font-size'] + 'px'; }
        document.querySelectorAll('#set-accent-colors .color-swatch').forEach(function(sw) { sw.classList.toggle('active', sw.dataset.color === s['accent-color']); });
        document.documentElement.style.setProperty('--accent', s['accent-color']);
        document.documentElement.style.setProperty('--accent-soft', s['accent-color'] + '22');
        if (s['large-text']) document.documentElement.style.fontSize = '18px';
        else document.documentElement.style.fontSize = s['font-size'] + 'px';
        if (s['reduce-motion']) document.body.classList.add('reduce-motion'); else document.body.classList.remove('reduce-motion');
        if (s['high-contrast']) document.body.classList.add('high-contrast'); else document.body.classList.remove('high-contrast');
        if (s['dark-mode']) document.documentElement.classList.remove('light'); else document.documentElement.classList.add('light');
        updateBackgroundSVG();
    }

    function initSettingsOnLoad() {
        var s = loadSettings();
        document.documentElement.style.setProperty('--accent', s['accent-color']);
        document.documentElement.style.setProperty('--accent-soft', s['accent-color'] + '22');
        if (s['large-text']) document.documentElement.style.fontSize = '18px';
        else document.documentElement.style.fontSize = s['font-size'] + 'px';
        if (s['reduce-motion']) document.body.classList.add('reduce-motion');
        if (s['high-contrast']) document.body.classList.add('high-contrast');
        var themeKey = localStorage.getItem('dispatch-theme');
        var isLight = (themeKey === 'light');
        if (!themeKey) isLight = (s['dark-mode'] === false);
        if (isLight) document.documentElement.classList.add('light');
        else document.documentElement.classList.remove('light');
        if (s['sidebar-collapsed'] && window.innerWidth > 1024) {
            var sidebar = document.getElementById('yt-sidebar');
            var main = document.getElementById('main-content');
            if (sidebar) sidebar.classList.add('collapsed');
            if (main) main.classList.add('sidebar-collapsed');
        }
        updateBackgroundSVG();
    }

    // ===== Sidebar =====
    function toggleSidebar() {
        var sidebar = document.getElementById('yt-sidebar');
        var main = document.getElementById('main-content');
        var backdrop = document.getElementById('sb-backdrop');
        if (window.innerWidth <= 1024) {
            var isOpen = sidebar.classList.toggle('open');
            if (backdrop) backdrop.classList.toggle('open', isOpen);
        } else {
            sidebar.classList.toggle('collapsed');
            main.classList.toggle('sidebar-collapsed');
            var isCollapsed = sidebar.classList.contains('collapsed');
            applySetting('sidebar-collapsed', isCollapsed);
            saveSettingsImmediate();
        }
    }

    function closeSidebar() {
        var sidebar = document.getElementById('yt-sidebar');
        var backdrop = document.getElementById('sb-backdrop');
        if (window.innerWidth <= 1024) {
            sidebar.classList.remove('open');
            if (backdrop) backdrop.classList.remove('open');
        }
    }

    function toggleMobileSearch() {
        var overlay = document.getElementById('mobile-search-overlay');
        if (overlay) {
            var isOpen = overlay.classList.toggle('open');
            if (isOpen) { var input = document.getElementById('mobile-search-input'); if (input) setTimeout(function() { input.focus(); }, 100); }
        }
    }

    // ===== Expose to window =====
    window.toggleTheme = toggleTheme;
    window.toggleSettings = toggleSettings;
    window.toggleSetting = toggleSetting;
    window.setAccentColor = setAccentColor;
    window.setFontSize = setFontSize;
    window.setPlaybackSpeed = setPlaybackSpeed;
    window.setVideoQuality = setVideoQuality;
    window.saveSettings = saveSettings;
    window.resetSettings = resetSettings;
    window.applySettingsToUI = applySettingsToUI;
    window.loadSettings = loadSettings;
    window.showAnnouncement = showAnnouncement;
    window.updateThemeIcons = updateThemeIcons;
    window.updateBackgroundSVG = updateBackgroundSVG;
    window.toggleSidebar = toggleSidebar;
    window.closeSidebar = closeSidebar;
    window.toggleMobileSearch = toggleMobileSearch;

    // ===== Init =====
    initSettingsOnLoad();
    updateThemeIcons();

    window.addEventListener('storage', function(e) {
        if (e.key === 'dispatch-theme' || e.key === 'dispatch-settings') {
            initSettingsOnLoad();
            applySettingsToUI();
            updateThemeIcons();
        }
    });
})();
