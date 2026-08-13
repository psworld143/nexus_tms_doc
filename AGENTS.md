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
#    http://localhost/nexus_tms_doc/dispatch/docs.php
#    http://localhost/nexus_tms_doc/dispatch/video_docs.php
```

`php` is not on `PATH` in this environment — call `C:\xampp\php\php.exe` directly.

## Architecture notes (the non-obvious stuff)

- **`dispatch/doc_data.php` is the single source of truth** for `$videoCatalog` and `$videoDocs`. `index.php` and `video_docs.php` `require` it. **`docs.php` currently re-declares `$videoCatalog` inline** (a copy-paste of the same array) — editing the catalog means editing two places. This is a known cleanup item: `docs.php` should `require __DIR__ . '/doc_data.php';` instead.

- **`$availableVideos` is hardcoded** in `docs.php` to `['videos/dashboard.mp4', 'videos/how-to-register-new-drivers.mp4']`. When a new MP4 is added to `dispatch/videos/`, this list must be updated by hand. Preferred fix: derive it with `glob(__DIR__ . '/videos/*.mp4')` and map back to catalog entries by `src`.

- **Each page is monolithic**: PHP + HTML + `<style>` + `<script>` all in one file (`index.php` is ~230 KB). There are 17 inline `<style>`/`<script>` blocks across the four pages. External CSS files: `css/dispatch-ui.css` (shared graphics & motion, loaded by all four pages), `css/loaders.css` (unique per-page loading screens, loaded by all four pages), `css/tutorials-animations.css` (tutorials.php only), `css/video-card-animations.css` (video_docs.php only). Each page's loading screen uses a distinct variant via a modifier class on `.loader-screen` (`.loader-screen--home`, `.loader-screen--tutorials`, `.loader-screen--docs`, `.loader-screen--video-docs`) — the base styles and all four variants live in `css/loaders.css`. `dispatch-ui.css` is ADDITIVE — it layers on top of each page's inline `<style>` and the per-page animation files, enhancing shared chrome (topbar, sidebar, icon buttons, nav links, toasts, modals) and providing reusable utilities (`.reveal`, `.grad-text`, `.glow`, `.pulse-glow`, `.live-dot`, `.skeleton`). Shared CSS variables and the topbar/sidebar markup are still duplicated in every page. When editing UI, expect to touch multiple files.

- **Security headers** are set via `header()` at the top of every page (X-Frame-Options, CSP, etc.). The CSP allows `script-src 'unsafe-inline'` because of the inline scripts. Don't loosen it further; ideally tighten it once scripts are externalized.

- **Videos are large** (`how-to-register-new-drivers.mp4` is ~48 MB) and served as raw static files. Use `preload="metadata"` and poster images on `<video>` tags to avoid fetching tens of MB on page load.

## Conventions

- Module ids are kebab-case and match the `src` filename stem (e.g. id `my-loads` → `videos/my-loads.mp4`).
- Categories used in the catalog: `Main`, `Operations`, `Fleet`, `Finance`, `Safety`, `Compliance`, `Account`.
- Dark theme is the default (`<html class="dark">`); pages define `:root` and `html:not(.dark)` overrides for light mode.
- Don't add comments unless asked. Don't introduce Composer/npm/build tooling unless the user asks — the zero-build property is intentional.

## Known cleanup backlog

1. `docs.php`: replace the inline `$videoCatalog` copy with `require __DIR__ . '/doc_data.php';`.
2. `docs.php`: derive `$availableVideos` from `glob()` instead of hardcoding.
3. Extract shared CSS (variables, topbar, sidebar) into `css/dispatch.css` and shared JS into `js/dispatch.js`; then drop `'unsafe-inline'` from `script-src` in the CSP.
4. Add `preload="metadata"` + poster images to all `<video>` elements.
