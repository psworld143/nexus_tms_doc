import { useState, useEffect, useCallback } from 'react';

export function useTheme() {
    const [isLight, setIsLight] = useState(() => {
        try {
            return localStorage.getItem('dispatch-theme') === 'light';
        } catch {
            return false;
        }
    });

    const applyTheme = useCallback((light) => {
        setIsLight(light);
        try {
            localStorage.setItem('dispatch-theme', light ? 'light' : 'dark');
        } catch {}
        if (light) {
            document.documentElement.classList.add('light');
        } else {
            document.documentElement.classList.remove('light');
        }
        try {
            const settings = JSON.parse(localStorage.getItem('dispatch-settings') || '{}');
            settings['dark-mode'] = !light;
            localStorage.setItem('dispatch-settings', JSON.stringify(settings));
        } catch {}
    }, []);

    const toggleTheme = useCallback(() => {
        applyTheme(!isLight);
    }, [isLight, applyTheme]);

    return { isLight, toggleTheme };
}
