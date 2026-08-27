// video-docs-settings.js — Theme, settings, and announcement toast logic
// Used by video_docs.php. Functions are attached to window for inline onclick handlers.

(function() {
    'use strict';

    // ===== Theme support =====
    function syncThemeFromStorage() {
        const themeKey = localStorage.getItem('dispatch-theme');
        let isLight = (themeKey === 'light');
        if (!themeKey) {
            try {
                const settings = JSON.parse(localStorage.getItem('dispatch-settings') || '{}');
                isLight = (settings['dark-mode'] === false);
            } catch (e) {}
        }
        if (isLight) document.documentElement.classList.add('light');
        else document.documentElement.classList.remove('light');
        updateThemeIcons();
        updateBackgroundSVG();
    }

    function updateBackgroundSVG() {
        const isLight = document.documentElement.classList.contains('light');
        const darkSVG = document.getElementById('bg-svg-dark');
        const lightSVG = document.getElementById('bg-svg-light');
        if (darkSVG) darkSVG.style.display = isLight ? 'none' : 'block';
        if (lightSVG) lightSVG.style.display = isLight ? 'block' : 'none';
    }

    function updateThemeIcons() {
        const isLight = document.documentElement.classList.contains('light');
        const moonIcon = document.querySelector('.theme-btn .moon-icon');
        const sunIcon = document.querySelector('.theme-btn .sun-icon');
        if (moonIcon && sunIcon) {
            moonIcon.style.display = isLight ? 'none' : 'block';
            sunIcon.style.display = isLight ? 'block' : 'none';
        }
    }

    function toggleTheme() {
        document.documentElement.classList.toggle('light');
        const isLight = document.documentElement.classList.contains('light');
        try { localStorage.setItem('dispatch-theme', isLight ? 'light' : 'dark'); } catch (e) {}
        try {
            const settings = JSON.parse(localStorage.getItem('dispatch-settings') || '{}');
            settings['dark-mode'] = !isLight;
            localStorage.setItem('dispatch-settings', JSON.stringify(settings));
        } catch (e) {}
        updateThemeIcons();
        updateBackgroundSVG();
    }

    // ===== Settings =====
    const SETTINGS_DEFAULTS = {
        'dark-mode': true,
        'autoplay': false,
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
        let saved = {};
        try { saved = JSON.parse(localStorage.getItem('dispatch-settings') || '{}'); } catch (e) {}
        return Object.assign({}, SETTINGS_DEFAULTS, saved);
    }

    function escapeHtml(str) {
        if (typeof str !== 'string') return '';
        return str
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // ===== Announcement toast =====
    let announceTimer = null;
    function showAnnouncement(text, opts) {
        opts = opts || {};
        const toast = document.getElementById('announce-toast');
        const textEl = document.getElementById('announce-text');
        const iconEl = document.getElementById('announce-icon');
        const swatchWrap = document.getElementById('announce-swatch-wrap');
        if (!toast || !textEl) return;
        textEl.textContent = text;
        if (opts.icon === 'palette') {
            iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h8a2 2 0 002-2V5a2 2 0 00-2-2H9m4 18a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4z"/></svg>';
        } else if (opts.icon === 'theme') {
            const isDark = !document.documentElement.classList.contains('light');
            if (isDark) {
                iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>';
            } else {
                iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>';
            }
        } else if (opts.icon === 'reset') {
            iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>';
        } else if (opts.icon === 'sidebar') {
            iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>';
        } else {
            iconEl.innerHTML = '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
        }
        if (opts.swatch) {
            swatchWrap.innerHTML = '<span class="announce-swatch" style="background:' + escapeHtml(opts.swatch) + '"></span>';
        } else {
            swatchWrap.innerHTML = '';
        }
        toast.classList.add('show');
        if (announceTimer) clearTimeout(announceTimer);
        announceTimer = setTimeout(function() { toast.classList.remove('show'); }, 2600);
    }

    // ===== Settings panel =====
    function toggleSettings() {
        const panel = document.getElementById('settings-panel');
        const overlay = document.getElementById('settings-overlay');
        const isOpen = panel.classList.contains('open');
        panel.classList.toggle('open');
        overlay.classList.toggle('open');
        if (!isOpen) applySettingsToUI();
    }

    const SETTING_LABELS = {
        'dark-mode': 'Dark mode',
        'autoplay': 'Autoplay',
        'sidebar-collapsed': 'Mini sidebar',
        'sync-search': 'Sync search',
        'reduce-motion': 'Reduce motion',
        'high-contrast': 'High contrast',
        'large-text': 'Larger text'
    };

    function toggleSetting(key, type) {
        const el = document.getElementById('set-' + key);
        if (!el) return;
        const isOn = el.classList.toggle('on');
        applySetting(key, isOn);
        saveSettingsImmediate();
        const label = SETTING_LABELS[key] || key;
        showAnnouncement(label + ' ' + (isOn ? 'enabled' : 'disabled'));
    }

    function applySetting(key, value) {
        const settings = loadSettings();
        settings[key] = value;
        try { localStorage.setItem('dispatch-settings', JSON.stringify(settings)); } catch (e) {}
        switch (key) {
            case 'dark-mode':
                if (value) document.documentElement.classList.remove('light');
                else document.documentElement.classList.add('light');
                try { localStorage.setItem('dispatch-theme', value ? 'dark' : 'light'); } catch(e) {}
                updateThemeIcons();
                updateBackgroundSVG();
                showAnnouncement(value ? 'Dark mode enabled' : 'Light mode enabled', { icon: 'theme' });
                break;
            case 'reduce-motion':
                if (value) document.body.classList.add('reduce-motion');
                else document.body.classList.remove('reduce-motion');
                break;
            case 'high-contrast':
                if (value) document.body.classList.add('high-contrast');
                else document.body.classList.remove('high-contrast');
                break;
            case 'large-text':
                if (value) document.documentElement.style.fontSize = '18px';
                else document.documentElement.style.fontSize = settings['font-size'] + 'px';
                break;
            case 'sidebar-collapsed':
                if (window.innerWidth > 900) {
                    const sidebar = document.getElementById('sidebar');
                    const btn = document.getElementById('sidebar-toggle-btn');
                    if (value) {
                        sidebar.classList.add('mini');
                        if (btn) { btn.title = 'Expand sidebar'; btn.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>'; }
                    } else {
                        sidebar.classList.remove('mini');
                        if (btn) { btn.title = 'Collapse sidebar'; btn.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 19l-7-7 7-7M19 19l-7-7 7-7"/>'; }
                    }
                }
                showAnnouncement(value ? 'Mini sidebar enabled' : 'Full sidebar enabled', { icon: 'sidebar' });
                break;
            case 'autoplay':
            case 'sync-search':
                break;
        }
    }

    function setAccentColor(color) {
        document.querySelectorAll('#set-accent-colors .color-swatch').forEach(function(s) {
            s.classList.toggle('active', s.dataset.color === color);
        });
        document.documentElement.style.setProperty('--accent', color);
        document.documentElement.style.setProperty('--accent-soft', color + '22');
        applySetting('accent-color', color);
        saveSettingsImmediate();
        showAnnouncement('Accent color changed', { icon: 'palette', swatch: color });
    }

    function setFontSize(val) {
        document.getElementById('font-size-value').textContent = val + 'px';
        const settings = loadSettings();
        if (!settings['large-text']) document.documentElement.style.fontSize = val + 'px';
        applySetting('font-size', val);
        saveSettingsImmediate();
        showAnnouncement('Font size set to ' + val + 'px');
    }

    function setPlaybackSpeed(val) {
        document.querySelectorAll('video').forEach(function(v) { v.playbackRate = parseFloat(val); });
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
        const settings = loadSettings();
        ['dark-mode','autoplay','sidebar-collapsed','sync-search','reduce-motion','high-contrast','large-text'].forEach(function(key) {
            const el = document.getElementById('set-' + key);
            if (el) settings[key] = el.classList.contains('on');
        });
        ['playback-speed','video-quality'].forEach(function(key) {
            const el = document.getElementById('set-' + key);
            if (el) settings[key] = el.value;
        });
        const activeSwatch = document.querySelector('#set-accent-colors .color-swatch.active');
        if (activeSwatch) settings['accent-color'] = activeSwatch.dataset.color;
        const fontSizeEl = document.getElementById('set-font-size');
        if (fontSizeEl) settings['font-size'] = fontSizeEl.value;
        try { localStorage.setItem('dispatch-settings', JSON.stringify(settings)); } catch (e) {}
    }

    function saveSettings() {
        saveSettingsImmediate();
        const btn = event.target;
        const orig = btn.textContent;
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
        updateThemeIcons();
        applySettingsToUI();
        showAnnouncement('Settings reset to default', { icon: 'reset' });
    }

    function applySettingsToUI() {
        const s = loadSettings();
        ['dark-mode','autoplay','sidebar-collapsed','sync-search','reduce-motion','high-contrast','large-text'].forEach(function(key) {
            const el = document.getElementById('set-' + key);
            if (el) el.classList.toggle('on', !!s[key]);
        });
        ['playback-speed','video-quality'].forEach(function(key) {
            const el = document.getElementById('set-' + key);
            if (el) el.value = s[key];
        });
        const fsEl = document.getElementById('set-font-size');
        if (fsEl) { fsEl.value = s['font-size']; document.getElementById('font-size-value').textContent = s['font-size'] + 'px'; }
        document.querySelectorAll('#set-accent-colors .color-swatch').forEach(function(sw) {
            sw.classList.toggle('active', sw.dataset.color === s['accent-color']);
        });
        document.documentElement.style.setProperty('--accent', s['accent-color']);
        document.documentElement.style.setProperty('--accent-soft', s['accent-color'] + '22');
        if (s['large-text']) document.documentElement.style.fontSize = '18px';
        else document.documentElement.style.fontSize = s['font-size'] + 'px';
        if (s['reduce-motion']) document.body.classList.add('reduce-motion'); else document.body.classList.remove('reduce-motion');
        if (s['high-contrast']) document.body.classList.add('high-contrast'); else document.body.classList.remove('high-contrast');
        if (s['dark-mode']) document.documentElement.classList.remove('light'); else document.documentElement.classList.add('light');
        updateThemeIcons();
        updateBackgroundSVG();
    }

    // ===== Expose to window for inline onclick handlers =====
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
    window.syncThemeFromStorage = syncThemeFromStorage;
    window.showAnnouncement = showAnnouncement;
    window.loadSettings = loadSettings;
    window.escapeHtml = escapeHtml;

    // ===== Init =====
    syncThemeFromStorage();
    applySettingsToUI();

    // Sync theme across tabs
    window.addEventListener('storage', function(e) {
        if (e.key === 'dispatch-theme' || e.key === 'dispatch-settings') {
            syncThemeFromStorage();
            applySettingsToUI();
        }
    });
})();
