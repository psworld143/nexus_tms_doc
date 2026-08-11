/* ============================================================
   Tailwind CSS Custom Config
   Used by: index.php, docs.php, tutorials.php, video_docs.php
   ============================================================ */

/* Tailwind Play CDN is loaded via <script> in each PHP file.
   This file contains custom Tailwind config and layer overrides. */

/* Custom Tailwind theme extension — applied via tailwind.config in each page */
window.tailwindConfig = {
    theme: {
        extend: {
            colors: {
                accent: 'var(--accent)',
                'accent-2': 'var(--accent-2)',
                'accent-soft': 'var(--accent-soft)',
                bg: 'var(--bg)',
                'bg-2': 'var(--bg-2)',
                surface: 'var(--surface)',
                'surface-solid': 'var(--surface-solid)',
                'surface-2': 'var(--surface-2)',
                border: 'var(--border)',
                'border-strong': 'var(--border-strong)',
                text: 'var(--text)',
                'text-muted': 'var(--text-muted)',
                'text-dim': 'var(--text-dim)',
                danger: 'var(--danger)',
            },
            fontFamily: {
                sans: ['Poppins', 'system-ui', 'sans-serif'],
            },
            borderRadius: {
                xl: '18px',
                '2xl': '24px',
            },
            animation: {
                'fade-in': 'fadeIn 0.3s ease',
                'slide-up': 'slideUp 0.4s cubic-bezier(0.34, 1.56, 0.64, 1)',
                'slide-down': 'slideDown 0.4s cubic-bezier(0.34, 1.56, 0.64, 1)',
                'scale-in': 'scaleIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1)',
                'pulse-glow': 'pulseGlow 2s ease-in-out infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                slideDown: {
                    '0%': { opacity: '0', transform: 'translateY(-20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                scaleIn: {
                    '0%': { opacity: '0', transform: 'scale(0.9)' },
                    '100%': { opacity: '1', transform: 'scale(1)' },
                },
                pulseGlow: {
                    '0%, 100%': { boxShadow: '0 0 0 0 color-mix(in srgb, var(--accent) 40%, transparent)' },
                    '50%': { boxShadow: '0 0 0 8px color-mix(in srgb, var(--accent) 0%, transparent)' },
                },
            },
        },
    },
    corePlugins: {
        preflight: false,
    },
};
