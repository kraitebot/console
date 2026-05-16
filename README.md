# Kraite Console

Sysadmin admin console for the Kraite trading platform. Deployed at **`console.kraite.com`** (production target).

## Stack

- **Laravel 13** (PHP 8.4)
- **Blade** for server-rendered templating — Inertia/React framing is intentionally **not** used here
- **Livewire** for SPA-style navigation and async UI workflows
- **Alpine.js 3** + `@alpinejs/collapse` for client-side interactivity
- **Tailwind 4** (Oxide) via `@tailwindcss/vite`
- **Vite** for the asset pipeline
- **Pest 4** for tests (when business logic lands)

## What it does

Console is the **operator UI** for Kraite — separate from the trader-facing `admin.kraite.com`. It is the modern successor to the legacy `/system/*` Blade screens on `admin.kraite.com`. Today's surface:

- `/login` — Fortify-style email/password auth, guarded by `EnsureUserIsAdmin` middleware. Non-admins are bounced to the trader URL.
- `/dashboard` — operator overview (placeholder pending real widgets).
- `/users` — datagrid over the shared `kraite` users table (paginate / search / sort / row-click → detail).
- `/users/create` — add user form (Boltify "Add & Create" pattern).
- `/users/{user}?tab=details|accounts|positions|billing` — tabbed user detail with edit form on the Details tab; other tabs queued as stubs.
- `/accounts` — Livewire stub page used to validate shell navigation and content-only transitions.

More `/system/*` surfaces (sql-query, commands, steps, lifecycle, backtracking, billing-admin) are documented at `~/Herd/docs/kraite/05-console/` and will land incrementally — that doc set is mid-rewrite.

## Data ownership — hard rule

**Console has NO database of its own and NO factories.** All domain data (users, accounts, positions, exchanges, symbols) is owned by `ingestion.kraite.test` locally and by zeus in production. Console is a thin Blade/Livewire/Alpine UI that reads (and writes via console-local model views) the same MySQL `kraite` database.

- **No migrations in this repo.** Schema changes go into `~/Herd/ingestion.kraite.test/database/migrations/` or the `kraitebot/core` package.
- **No factories or seeders.** Test data comes from ingestion.
- **`App\Models\User` is the console-local auth view** of the shared `users` table — fillable on `name`, `email`, `password`, `is_admin`, `status`.

## UI build discipline

This repo is a **port** of the Boltify React/TypeScript admin template (`~/Herd/boltify.test`) into Blade + Livewire + Alpine + Tailwind 4. **UI is not invented here** — every component cites its Boltify source path + class/function anchor where it has a Boltify equivalent. The full porting playbook lives in `CLAUDE.md` and the component inventory at `~/Herd/docs/kraite/05-console/components/`.

Highlights:

- Components live in `resources/views/components/` with folder-nested naming (`<x-card.header>`, `<x-form.input>`, `<x-table.tr>`).
- Page surfaces live as Livewire components and render through the shared Blade shell with `wire:navigate`.
- Sidebar entity navigation is Livewire SPA navigation mediated by `$store.pageTransition`, so the content area fades while the sidebar is persisted.
- The sidebar is wrapped in Livewire `@persist('app-aside')` and a `peer contents` boundary; do not remove that boundary or the wrapper padding breaks.
- Every component root carries `data-component-name="..."`.
- Dynamic Tailwind classes are written as `match()` returning literal strings (Tailwind 4's scanner purges concatenated strings).
- Alpine stores own client-side state: `$store.aside` (sidebar open/closed, active tab), `$store.pageTransition` (content fade + Livewire navigation), and `$store.theme` (light/dark/system + `cycle()`).
- Toast notifications use `<x-toast-container>` plus `$store.toast`; Livewire components dispatch browser `toast` events for save/create feedback instead of inline ribbons.
- `[x-cloak] { display: none !important; }` is in the CSS base layer to suppress Alpine-bound popover flashes.

## Build & dev

```bash
npm install
composer install

npm run dev      # Vite HMR
npm run build    # Production assets → public/build/
npm run test:e2e # Playwright browser tests
```

`npm run test:e2e` never targets the normal local `kraite` database. Playwright starts
the console through `APP_ENV=testing` on `http://127.0.0.1:8001`, and
`scripts/prepare-e2e.sh` rebuilds `ingestion.kraite.test`'s `kraite_tests`
database before the browser opens. Keep browser fixtures deterministic there; do
not point Playwright at `https://console.kraite.test` for automated runs.

After any Blade / CSS / JS edit, run `npm run build` before reloading the page.
Add Playwright coverage for user-facing shell/navigation behavior, layout-sensitive UI, Livewire async flows, datagrid interactions, and forms.

## Repo layout

```
app/
├── Http/
│   ├── Controllers/         # LoginController
│   ├── Middleware/          # EnsureUserIsAdmin
│   └── Requests/
├── Livewire/                # Page components and async workflows
└── Models/                  # User (auth-only)

resources/
├── views/
│   ├── components/          # Blade components ported from Boltify
│   ├── icons/               # HugeIcons SVGs (extracted via scripts/extract-icons.sh)
│   ├── layouts/             # app.blade.php + admin.blade.php
│   ├── partials/            # aside + header partials
│   └── livewire/            # users/* + accounts/index
├── css/app.css              # Tailwind 4 entry + theme tokens (Urbanist, primary green, 15px root)
└── js/app.js                # Alpine stores used by Livewire's Alpine runtime

routes/web.php               # /login + /logout + /dashboard + /users + /accounts
config/menu.php              # Blade-side equivalent of Boltify's pages.ts (nav metadata)
scripts/extract-icons.sh     # Extract HugeIcons SVGs from boltify.test into Blade partials
tests/e2e/                   # Playwright user-like browser coverage
```

## Reference

- Boltify source: `~/Herd/boltify.test`
- Console functional docs (rewrite in progress): `~/Herd/docs/kraite/05-console/`
- Component inventory: `~/Herd/docs/kraite/05-console/components/README.md`
- Sister Kraite apps:
  - `ingestion.kraite.test` (trading engine — scheduler + dispatcher + queue workers)
  - `admin.kraite.test` (legacy operator + trader Blade UI)
  - `kraite.test` (public marketing)
  - `syntax.kraite.test` (public Next.js docs)

## License

MIT.
