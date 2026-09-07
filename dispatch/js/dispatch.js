// dispatch.js — Shared settings, theme, and announcement logic
// Used by: index.php, tutorials.php, video_docs.php
//
// Pages must set window.DISPATCH_THEME_CLASS before loading this script:
//   'dark'  — page toggles .dark on <html> (index.php approach)
//   'light' — page toggles .light on <html> (tutorials/video_docs approach)
//
// Functions are attached to window for inline onclick handlers.

(function() {
    'use strict';

    var THEME_CLASS = window.DISPATCH_THEME_CLASS || 'dark';
    var IS_DARK_MODE = (THEME_CLASS === 'dark');

    function isLight() {
        if (IS_DARK_MODE) return !document.documentElement.classList.contains('dark');
        return document.documentElement.classList.contains('light');
    }

    function setLight(light) {
        if (IS_DARK_MODE) {
            if (light) document.documentElement.classList.remove('dark');
            else document.documentElement.classList.add('dark');
        } else {
            if (light) document.documentElement.classList.add('light');
            else document.documentElement.classList.remove('light');
        }
    }

    // ===== Theme =====
    function syncThemeFromStorage() {
        var themeKey = null;
        try { themeKey = localStorage.getItem('dispatch-theme'); } catch (e) {}
        var light = (themeKey === 'light');
        if (!themeKey) {
            try {
                var settings = JSON.parse(localStorage.getItem('dispatch-settings') || '{}');
                light = (settings['dark-mode'] === false);
            } catch (e) {}
        }
        setLight(light);
        try { localStorage.setItem('dispatch-theme', light ? 'light' : 'dark'); } catch (e) {}
        updateThemeIcons();
        updateBackgroundSVG();
    }

    function updateBackgroundSVG() {
        var light = isLight();
        var darkSVG = document.getElementById('bg-svg-dark');
        var lightSVG = document.getElementById('bg-svg-light');
        if (darkSVG) darkSVG.style.display = light ? 'none' : 'block';
        if (lightSVG) lightSVG.style.display = light ? 'block' : 'none';
    }

    function updateThemeIcons() {
        var light = isLight();
        var moonIcon = document.querySelector('.theme-btn .moon-icon');
        var sunIcon = document.querySelector('.theme-btn .sun-icon');
        if (moonIcon && sunIcon) {
            moonIcon.style.display = light ? 'none' : 'block';
            sunIcon.style.display = light ? 'block' : 'none';
        }
    }

    function toggleTheme() {
        var light = !isLight();
        setLight(light);
        try { localStorage.setItem('dispatch-theme', light ? 'light' : 'dark'); } catch (e) {}
        try {
            var settings = JSON.parse(localStorage.getItem('dispatch-settings') || '{}');
            settings['dark-mode'] = !light;
            localStorage.setItem('dispatch-settings', JSON.stringify(settings));
        } catch (e) {}
        updateThemeIcons();
        updateBackgroundSVG();
    }

    // ===== Settings =====
    var SETTINGS_DEFAULTS = {
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
        var saved = {};
        try { saved = JSON.parse(localStorage.getItem('dispatch-settings') || '{}'); } catch (e) {}
        var merged = {};
        for (var k in SETTINGS_DEFAULTS) { if (SETTINGS_DEFAULTS.hasOwnProperty(k)) merged[k] = SETTINGS_DEFAULTS[k]; }
        for (var k2 in saved) { if (saved.hasOwnProperty(k2)) merged[k2] = saved[k2]; }
        return merged;
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
            var dark = !isLight();
            if (dark) {
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
    var SETTING_LABELS = {
        'dark-mode': 'Dark mode',
        'autoplay': 'Autoplay',
        'sidebar-collapsed': 'Mini sidebar',
        'sync-search': 'Sync search',
        'reduce-motion': 'Reduce motion',
        'high-contrast': 'High contrast',
        'large-text': 'Larger text'
    };

    function toggleSettings() {
        var panel = document.getElementById('settings-panel');
        var overlay = document.getElementById('settings-overlay');
        var isOpen = panel.classList.contains('open');
        panel.classList.toggle('open');
        overlay.classList.toggle('open');
        if (!isOpen) applySettingsToUI();
    }

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
                setLight(!value);
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
                    var sidebar = document.getElementById('sidebar');
                    var btn = document.getElementById('sidebar-toggle-btn');
                    var content = document.querySelector('.content');
                    if (value) {
                        if (sidebar) sidebar.classList.add('mini');
                        if (content) content.classList.add('sidebar-mini');
                        if (btn) { btn.title = 'Expand sidebar'; btn.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>'; }
                    } else {
                        if (sidebar) sidebar.classList.remove('mini');
                        if (content) content.classList.remove('sidebar-mini');
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
        var el = document.getElementById('font-size-value');
        if (el) el.textContent = val + 'px';
        var settings = loadSettings();
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
        var settings = loadSettings();
        ['dark-mode','autoplay','sidebar-collapsed','sync-search','reduce-motion','high-contrast','large-text'].forEach(function(key) {
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
        setLight(false);
        try { localStorage.setItem('dispatch-theme', 'dark'); } catch(e) {}
        updateThemeIcons();
        updateBackgroundSVG();
        applySettingsToUI();
        showAnnouncement('Settings reset to default', { icon: 'reset' });
    }

    function applySettingsToUI() {
        var s = loadSettings();
        ['dark-mode','autoplay','sidebar-collapsed','sync-search','reduce-motion','high-contrast','large-text'].forEach(function(key) {
            var el = document.getElementById('set-' + key);
            if (el) el.classList.toggle('on', !!s[key]);
        });
        ['playback-speed','video-quality'].forEach(function(key) {
            var el = document.getElementById('set-' + key);
            if (el) el.value = s[key];
        });
        var fsEl = document.getElementById('set-font-size');
        if (fsEl) { fsEl.value = s['font-size']; var fv = document.getElementById('font-size-value'); if (fv) fv.textContent = s['font-size'] + 'px'; }
        document.querySelectorAll('#set-accent-colors .color-swatch').forEach(function(sw) {
            sw.classList.toggle('active', sw.dataset.color === s['accent-color']);
        });
        document.documentElement.style.setProperty('--accent', s['accent-color']);
        document.documentElement.style.setProperty('--accent-soft', s['accent-color'] + '22');
        if (s['large-text']) document.documentElement.style.fontSize = '18px';
        else document.documentElement.style.fontSize = s['font-size'] + 'px';
        if (s['reduce-motion']) document.body.classList.add('reduce-motion'); else document.body.classList.remove('reduce-motion');
        if (s['high-contrast']) document.body.classList.add('high-contrast'); else document.body.classList.remove('high-contrast');
        setLight(!s['dark-mode']);
        updateThemeIcons();
        updateBackgroundSVG();
        // Apply playback speed to all videos
        document.querySelectorAll('video').forEach(function(v) { v.playbackRate = parseFloat(s['playback-speed']); });
    }

    function initSettingsOnLoad() {
        syncThemeFromStorage();
        applySettingsToUI();
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
    window.syncThemeFromStorage = syncThemeFromStorage;
    window.showAnnouncement = showAnnouncement;
    window.loadSettings = loadSettings;
    window.escapeHtml = escapeHtml;
    window.initSettingsOnLoad = initSettingsOnLoad;

    // ===== Init =====
    initSettingsOnLoad();

    // Sync theme across tabs
    window.addEventListener('storage', function(e) {
        if (e.key === 'dispatch-theme' || e.key === 'dispatch-settings') {
            syncThemeFromStorage();
            applySettingsToUI();
        }
    });
})();
