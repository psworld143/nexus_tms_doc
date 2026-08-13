# DISPATCH — Documentation & Video Tutorial Library

A small static PHP microsite that ships the user-facing **documentation**, **video tutorials**, and **long-form feature docs** for the DISPATCH trucking management system (TMS). It is served by [XAMPP](https://www.apachefriends.org/) (Apache + PHP 8.2) and has **no build step** — every page is a single self-contained `.php` file rendered server-side.

## What's inside

The site is organized around the modules of the DISPATCH TMS (Dashboard, My Loads, My Drivers, Fleet, Finance, Safety, Compliance, Account, etc.). Each module has:

- a **video tutorial** (MP4, served from `dispatch/videos/`), and
- a **short written description** plus a **long-form documentation blurb** shown inside an inline fullscreen modal.

Four pages share the same dark/light UI design language:

| Page | Purpose |
|------|---------|
| `dispatch/index.php` | Landing page — video tutorial library (cards + inline fullscreen doc modal). |
| `dispatch/tutorials.php` | Step-by-step tutorial walkthroughs. |
| `dispatch/docs.php` | Documentation index with search across sections and videos. |
| `dispatch/video_docs.php` | Documentation cards that open the long-form doc modal. |

## Folder layout

```
nexus_tms_doc/
├── README.md              ← this file
├── AGENTS.md              ← notes for AI assistants / contributors
├── .htaccess              ← Apache caching + access rules (deploy alongside dispatch/)
└── dispatch/
    ├── index.php          ← landing / video tutorial library
    ├── tutorials.php      ← tutorial walkthroughs
    ├── docs.php           ← documentation index + search
    ├── video_docs.php     ← documentation cards + modal
    ├── doc_data.php       ← SHARED data: $videoCatalog + $videoDocs (include-only)
    ├── favicon.svg
    ├── css/
    │   ├── dispatch-ui.css            ← shared graphics & motion (all pages)
    │   ├── loaders.css                ← unique loading screens (all pages)
    │   ├── tailwind-config.js
    │   ├── tutorials-animations.css
    │   └── video-card-animations.css
    └── videos/
        ├── dashboard.mp4
        └── how-to-register-new-drivers.mp4
```

## How to run it

This project is designed to run under XAMPP; it expects PHP 8.2+ and Apache.

1. Install XAMPP and start **Apache** from the XAMPP Control Panel.
2. Place the project at `C:\xampp\htdocs\nexus_tms_doc\` (it is already there in this environment).
3. Open <http://localhost/nexus_tms_doc/dispatch/index.php> in your browser.

There is no database, no Composer dependencies, and no frontend bundler — just PHP + static assets.

> **Note on `.htaccess`:** Apache's `mod_rewrite` / `mod_headers` / `mod_expires` must be enabled for the rules to take effect. They are enabled by default in a standard XAMPP install.

## Shared data file

`dispatch/doc_data.php` defines two arrays used across pages:

- `$videoCatalog` — metadata for every feature/module (id, title, description, category, duration, video `src`).
- `$videoDocs` — long-form documentation text keyed by module id, shown in the inline fullscreen doc modal.

It is meant to be **included**, never opened directly. `index.php` and `video_docs.php` already `require` it; `docs.php` currently re-declares the catalog inline (a known cleanup item — see `AGENTS.md`).

## Adding a new video

1. Drop the `.mp4` into `dispatch/videos/` (use the kebab-case id from the catalog as the filename, e.g. `my-loads.mp4`).
2. Add an entry to `$videoCatalog` in `dispatch/doc_data.php`.
3. Add a matching entry to `$videoDocs` in the same file.
4. If a page hardcodes `$availableVideos` (currently `docs.php`), update it too — or, better, derive it from the filesystem (see `AGENTS.md`).

## License

Internal project documentation. No third-party code is bundled; the only external resources loaded at runtime are Google Fonts (Poppins).
