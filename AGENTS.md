# AGENTS.md — notes for AI assistants and contributors

This file exists so that any agent (Devin, Cursor, Copilot, etc.) working in this repo can orient itself without reverse-engineering the project. Keep it updated when you learn something non-obvious.

## Project summary

Static PHP documentation/video-tutorial microsite for the **DISPATCH** trucking management system. Served by XAMPP (Apache + PHP 8.2). **No build step, no database, no Composer, no npm.**

See `README.md` for the full overview and folder layout.

## How to run

- XAMPP Apache must be running.
- Browse to <http://localhost/nexus_tms_doc/dispatch/index.php>.
- No server-side state; refreshing a page is a full re-render.

## Verify commands

There is no test suite. Use these manual checks after any change:

```powershell
# 1. PHP syntax lint every file (PHP is at C:\xampp\php\php.exe on this machine)
Get-ChildItem C:\xampp\htdocs\nexus_tms_doc\dispatch -Filter *.php |
  ForEach-Object { & C:\xampp\php\php.exe -l $_.FullName }

# 2. Load each page in a browser and confirm it renders without a 500 / blank screen:
#    http://localhost/nexus_tms_doc/dispatch/index.php
#    http://localhost/nexus_tms_doc/dispatch/tutorials.php
#    http://localhost/nexus_tms_doc/dispatch/video_docs.php
```

`php` is not on `PATH` in this environment — call `C:\xampp\php\php.exe` directly.

## Architecture notes (the non-obvious stuff)

- **`dispatch/doc_data.php` is the single source of truth** for `$videoCatalog` and `$videoDocs`. `index.php` and `video_docs.php` `require` it.

- **Each page is monolithic**: PHP + HTML + `<style>` + `<script>` all in one file (`index.php` is ~230 KB). There are 3 pages: `index.php`, `tutorials.php`, `video_docs.php`. External CSS files: `css/dispatch-ui.css` (shared graphics & motion, loaded by all pages), `css/dispatch.css` (shared settings panel + accessibility CSS, loaded by all pages), `css/loaders.css` (unique per-page loading screens, loaded by all pages), `css/tutorials-animations.css` (tutorials.php only), `css/video-card-animations.css` (video_docs.php only). Each page's loading screen uses a distinct variant via a modifier class on `.loader-screen` (`.loader-screen--home`, `.loader-screen--tutorials`, `.loader-screen--video-docs`) — the base styles and all variants live in `css/loaders.css`. `dispatch-ui.css` and `dispatch.css` are ADDITIVE — they layer on top of each page's inline `<style>`. Shared CSS variables and the topbar/sidebar markup are still duplicated in every page. When editing UI, expect to touch multiple files.

- **Shared JS**: `js/dispatch.js` contains the settings panel, theme toggle, announcement toast, and accessibility logic shared across all three pages. Each page sets `window.DISPATCH_THEME_CLASS` to `'dark'` (index.php) or `'light'` (tutorials.php, video_docs.php) before loading `dispatch.js` so the theme functions know which CSS class to toggle. Page-specific JS: `js/tour-guide.js`, `js/reels.js`, `js/views.js`, `js/activity-feed.js` (index.php), `js/tutorials-data.js`, `js/tutorials-player.js`, `js/comments.js` (tutorials.php), `js/video-docs-modal.js`, `js/video-docs-ui.js` (video_docs.php).

- **Responsive breakpoints** are standardized across all pages at: 1024px (tablet landscape / small desktop), 900px (tablet — sidebar collapses on index.php), 768px (tablet portrait — grids stack, modals simplify), 640px (large phone — padding reduces, hover effects soften), 560px (phone — settings full-width), 400px (small phone — icon buttons shrink). All pages have viewport meta tags and touch optimizations (`-webkit-tap-highlight-color: transparent`, `touch-action: manipulation` on interactive elements).

- **Security headers** are set via `header()` at the top of every page (X-Frame-Options, CSP, etc.). The CSP allows `script-src 'unsafe-inline'` because of the inline scripts. Don't loosen it further; ideally tighten it once scripts are externalized.

- **Videos are large** (`how-to-register-new-drivers.mp4` is ~48 MB) and served as raw static files. All `<video>` tags use `preload="none"` (lazy loading — only loads when scrolled to).

## Conventions

- Module ids are kebab-case and match the `src` filename stem (e.g. id `my-loads` → `videos/my-loads.mp4`).
- Categories used in the catalog: `Main`, `Operations`, `Fleet`, `Finance`, `Safety`, `Compliance`, `Account`.
- Dark theme is the default (`<html class="dark">`); pages define `:root` and `html:not(.dark)` overrides for light mode.
- Don't add comments unless asked. Don't introduce Composer/npm/build tooling unless the user asks — the zero-build property is intentional.

## Known cleanup backlog

1. Extract remaining shared CSS (variables, topbar, sidebar markup) — settings panel and accessibility CSS already moved to `css/dispatch.css`.
2. Extract remaining inline JS from `index.php` (search assistant, sidebar, doc modal) into page-specific JS files; then drop `'unsafe-inline'` from `script-src` in the CSP.
3. ~~Add `preload="metadata"` + poster images to all `<video>` elements.~~ **Done** — all `<video>` tags use `preload="none"` (lazy loading).
4. Remove the duplicate `escapeHtml` function in `index.php` modal section (dispatch.js already provides one globally).

## Framework evaluation

If the project ever outgrows the zero-build PHP architecture, the following frameworks were evaluated:

| Framework | Fit | Why |
|-----------|:---:|-----|
| **Astro** | Best | Content-heavy sites with "islands" of interactivity. Outputs static HTML. Can use Vue/Svelte for just the interactive parts. Solves code duplication with components. |
| **Next.js** | Overkill | Full SPA for a documentation site is unnecessary complexity. |
| **Laravel + Livewire** | Overkill | Requires Composer, server config changes, and a database-oriented mindset for a static content site. |
| **Vue via CDN** | Decent | Progressive enhancement, no build step, but mixing with existing vanilla JS gets messy. |

**Current recommendation:** Stay zero-build. Shared CSS/JS extraction is in progress — settings panel CSS is in `css/dispatch.css` and settings/theme JS is in `js/dispatch.js`. If the site grows significantly (user accounts, search backend, dynamic content), **Astro** is the best framework choice.
