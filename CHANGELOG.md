# Changelog

All notable changes to `console.kraite.com` are documented here.

## v0.0.2 — 2026-05-15

### Features

- [NEW FEATURE] Users datagrid at `/users` — paginated server-rendered table reading the shared `kraite` users table (ingestion-owned). Sortable columns (name / email / role / status / joined), search on name+email, row click opens detail.
- [NEW FEATURE] User detail page at `/users/{user}` — tabbed UI (Details / Accounts / Positions / Billing). Details is an edit form bound to `PATCH /users/{user}`. Other tabs are first-pass `<x-empty>` stubs.
- [NEW FEATURE] User create page at `/users/create` — Boltify "Add & Create" form pattern (12-col grid w/ left labels, right inputs). Random initial password; send-reset onboarding flow queued.
- [NEW FEATURE] Boltify-derived Blade components ported: `<x-table>` (+ `.head` / `.body` / `.foot` / `.tr` / `.th` / `.td`), `<x-avatar>`, `<x-card.header-child>` + `<x-card.footer-child>`, `<x-form.select>`, `<x-dropdown>` (+ `.toggle` / `.menu` / `.item` / `.divider`).

### Fixes

- [BUG FIX] Aside no longer overlaps the main content. `<aside class="peer ...">` is now a direct sibling of `<x-wrapper>` (was wrapped in `<div id="aside-permanent">`), so Tailwind's `peer-[&]:pl-[20rem]` reaches the wrapper and applies the aside-width left padding. Turbo SPA `data-turbo-permanent` preserved on the `<aside>` itself.

### Improvements

- [IMPROVED] Input + select text color softened from `text-black dark:text-white` to `text-zinc-700 dark:text-zinc-200`. Less harsh contrast across all forms.
- [IMPROVED] Status field in user forms now uses a Boltify-style dropdown (popover w/ check icon on selected item) instead of native `<select>`. Hidden input keeps the form post unchanged.
- [IMPROVED] Datagrid rows are fully clickable — entire `<x-table.tr>` navigates to the user detail page; inner edit-icon button uses `@click.stop` to keep its own target.
- [IMPROVED] `[x-cloak] { display: none !important; }` added to `app.css` base layer so Alpine-driven dropdowns don't flash open on first paint.
- [IMPROVED] Console no longer carries vestigial migrations / factories. All schema + seed data lives in `ingestion.kraite.test` (shared `kraite` DB). Console-owned `database/migrations/*` and `database/factories/UserFactory.php` removed; `User` model trimmed to auth-only (name/email/password + `is_admin` + `status` casts).
- [IMPROVED] Project `CLAUDE.md` gained two hard rules: data-ownership (no DB / factories / migrations in console — everything from ingestion) + first-pass UI policy (ship a first pass without question-gating; iterate on Bruno's feedback).
- [IMPROVED] HugeIcons added: `Search02`, `Sorting01` / `02` / `05`, `ArrowLeft01` / `ArrowLeftDouble` / `ArrowRight01` / `ArrowRightDouble`, `FloppyDisk`, `Tick02`.
