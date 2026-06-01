# Changelog

All notable changes to `console.kraite.com` are documented here.

## v0.0.6 — 2026-06-01

### Bug Fixes
- [BUG FIX] **Tailwind v4 @source globs missed Livewire / vendor compiled Blade on a fresh-deploy build.** Pheme's first console build shipped a 105.9 KB CSS — 17 KB lighter than local — because the build ran with an empty `storage/framework/views/` (the compiled-Blade cache is populated by request, not by deploy). Tailwind v4's content scanner relies on that cache to see compiled vendor templates (Livewire et al.). `npm run build` therefore stripped utilities used only by those vendor templates (`h-screen`, `space-x-2`, several Livewire layout classes), and the dashboard sidebar rendered without horizontal flex / spacing — icons stacked under labels, skeleton loader floating. Fix has two parts:
  1. `resources/css/app.css` @source list now also scans `app/**/*.php` and `routes/**/*.php` so class strings inside Livewire components and route definitions are picked up even when the view cache is empty.
  2. The deploy procedure runs `php artisan view:cache` **before** `npm run build` so the storage/framework/views directory is populated and Tailwind scans the compiled vendor Blade output. With both in place the production CSS grows from 105.9 KB → 123.9 KB and matches local.

## v0.0.5 — 2026-06-01

### Features
- [NEW FEATURE] **`laravel/horizon` installed.** `composer require laravel/horizon` + `php artisan horizon:install` scaffolds Service Provider + `config/horizon.php`. Console gets its own Horizon master on pheme so its queued jobs run under console's autoloader — cross-app queue consumption is unsafe because each Laravel app's Job classes live only in its own vendor tree.

### Improvements
- [IMPROVED] **`config/horizon.php` reads `HORIZON_ENV` for the environments block.** Adds `'env' => env('HORIZON_ENV', env('APP_ENV', 'production'))` so the master picks `environments.<HORIZON_ENV>` (rewritten at boot by `kraitebot/core`'s transformer from `kraite.horizon.workers.<HORIZON_ENV>`). Without this, Horizon would look up `environments.production` (absent in the kraite topology) and the master would report "No supervisors are running".

## v0.0.4 — 2026-05-17

### Features

- [NEW FEATURE] Users, user details, account panels, positions, toast notifications, and shell navigation now run through Blade + Livewire components.
- [NEW FEATURE] Added Playwright browser coverage for Users, user subtabs, positions, account creation UI, and save-toast flows.

### Fixes

- [BUG FIX] Playwright now runs against `APP_ENV=testing` and the isolated `kraite_tests` database instead of the normal local `kraite` database.
- [BUG FIX] Newly created account credentials are encrypted before insertion so ingestion can decrypt them consistently.

### Improvements

- [IMPROVED] Removed Turbo from the console shell and replaced it with Livewire navigation plus content-only fade transitions.
- [IMPROVED] Updated console documentation for Livewire shell discipline, browser-test isolation, and the current Blade component layout.

## v0.0.3 — 2026-05-15

### Features

- [NEW FEATURE] Full-page Users routes are now Livewire components (`/users`, `/users/create`, `/users/{user}`), with search, sort, pagination, create, and edit handled asynchronously where appropriate.
- [NEW FEATURE] Added `/accounts` as a Livewire stub page and sidebar entity so shell navigation can be exercised before the real Accounts surface lands.
- [NEW FEATURE] Added content-only page transitions via `<x-page-transition>` and `$store.pageTransition`. Sidebar clicks fade the content area out, navigate with `Livewire.navigate()`, then fade the new content in.
- [NEW FEATURE] Added Playwright browser coverage for the user flow: login, open CRUDs, navigate Users → Accounts → Users, assert the datagrid/stub render, assert the content fade occurs, assert the header stays visible, and assert the persisted sidebar DOM survives.
- [NEW FEATURE] Added `<x-toast-container>` and `$store.toast` for floating save/create notifications. User create/update now dispatches toast events instead of rendering inline success ribbons.

### Fixes

- [BUG FIX] Removed Turbo completely. The console now uses Livewire navigation only.
- [BUG FIX] Persisted the sidebar with Livewire `@persist('app-aside')` so sidebar tiles do not refresh during page navigation. The persisted aside is wrapped in a `peer contents` boundary to preserve the wrapper padding contract.
- [BUG FIX] Moved the fade transition below the topbar so breadcrumb/tools stay visually stable while page content changes; breadcrumb still updates after navigation.
- [BUG FIX] Changed sidebar search input animation from `transition-all` to `transition-colors` to avoid layout/padding animation when navigating.

### Improvements

- [IMPROVED] Override `--color-zinc-500` theme token from Tailwind default `#71717a` to `#909099`. Secondary text (table cells like email + joined-at, soft-zinc badges, breadcrumb non-active items, card subtitles, form descriptions) was too faded. Brighter shade applies globally to every `text-zinc-500` / `bg-zinc-500` / `border-zinc-500` site-wide.

## v0.0.2 — 2026-05-15

### Features

- [NEW FEATURE] Users datagrid at `/users` — paginated server-rendered table reading the shared `kraite` users table (ingestion-owned). Sortable columns (name / email / role / status / joined), search on name+email, row click opens detail.
- [NEW FEATURE] User detail page at `/users/{user}` — tabbed UI (Details / Accounts / Positions / Billing). Details is an edit form bound to `PATCH /users/{user}`. Other tabs are first-pass `<x-empty>` stubs.
- [NEW FEATURE] User create page at `/users/create` — Boltify "Add & Create" form pattern (12-col grid w/ left labels, right inputs). Random initial password; send-reset onboarding flow queued.
- [NEW FEATURE] Boltify-derived Blade components ported: `<x-table>` (+ `.head` / `.body` / `.foot` / `.tr` / `.th` / `.td`), `<x-avatar>`, `<x-card.header-child>` + `<x-card.footer-child>`, `<x-form.select>`, `<x-dropdown>` (+ `.toggle` / `.menu` / `.item` / `.divider`).

### Fixes

- [BUG FIX] Aside no longer overlaps the main content. `<aside class="peer ...">` is now a direct sibling of `<x-wrapper>` (was wrapped in `<div id="aside-permanent">`), so Tailwind's `peer-[&]:pl-[20rem]` reaches the wrapper and applies the aside-width left padding.

### Improvements

- [IMPROVED] Input + select text color softened from `text-black dark:text-white` to `text-zinc-700 dark:text-zinc-200`. Less harsh contrast across all forms.
- [IMPROVED] Status field in user forms now uses a Boltify-style dropdown (popover w/ check icon on selected item) instead of native `<select>`. Hidden input keeps the form post unchanged.
- [IMPROVED] Datagrid rows are fully clickable — entire `<x-table.tr>` navigates to the user detail page; inner edit-icon button uses `@click.stop` to keep its own target.
- [IMPROVED] `[x-cloak] { display: none !important; }` added to `app.css` base layer so Alpine-driven dropdowns don't flash open on first paint.
- [IMPROVED] Console no longer carries vestigial migrations / factories. All schema + seed data lives in `ingestion.kraite.test` (shared `kraite` DB). Console-owned `database/migrations/*` and `database/factories/UserFactory.php` removed; `User` model trimmed to auth-only (name/email/password + `is_admin` + `status` casts).
- [IMPROVED] Project `CLAUDE.md` gained two hard rules: data-ownership (no DB / factories / migrations in console — everything from ingestion) + first-pass UI policy (ship a first pass without question-gating; iterate on Bruno's feedback).
- [IMPROVED] HugeIcons added: `Search02`, `Sorting01` / `02` / `05`, `ArrowLeft01` / `ArrowLeftDouble` / `ArrowRight01` / `ArrowRightDouble`, `FloppyDisk`, `Tick02`.
