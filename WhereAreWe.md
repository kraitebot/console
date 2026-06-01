# Where Are We

Last updated: 2026-05-17

## Current State

The console is now a Laravel 13 admin cockpit for Kraite operators, built with Blade, Livewire, Alpine, Tailwind 4, and the Boltify visual language. Turbo has been removed. The app shell is stable: sidebar and topbar stay mounted, while the content area transitions with Livewire navigation.

The `/users` area is the first real operational surface. It has been rebuilt as Livewire pages and Blade UI components, with async datagrid behavior, user create/edit, account panels, positions preview, toast notifications, avatar editing, and browser coverage.

## Repositories Pushed

Console repo:
- Branch: `main`
- Latest pushed commit: `8aaa21f Feature: port users console to Livewire`
- Remote is clean and aligned.

Ingestion repo:
- Branch: `master`
- Latest pushed commit: `213e7b9 docs: record dead-code sweep in v1.49.4 changelog`
- Includes the lock update to `kraitebot/core` commit `e967f31`.
- Remote is clean and aligned.

Core package:
- Branch: `master`
- Latest pushed commit: `e967f31 Docs: record core dead-code sweep`
- Remote is clean and aligned.

## What Was Built

Users:
- Replaced the old controller/request/Blade users CRUD with Livewire pages:
  - `app/Livewire/Users/UsersIndex.php`
  - `app/Livewire/Users/UserCreate.php`
  - `app/Livewire/Users/UserShow.php`
- Added `/users`, `/users/create`, and `/users/{user}` Livewire routes.
- Users datagrid now supports server-side search, sorting, pagination, and row navigation.
- User forms support admin flag, active status, password updates, avatar upload/update, and avatar removal.
- Save/create flows use toast notifications instead of inline ribbons.

Accounts:
- Added lazy user sub-tabs with counts for Details, Accounts, Positions, and Billing.
- Accounts tab fetches only when selected.
- Account rows start collapsed and expand with animation.
- Account panels now have sub-tabs for Details and Server connectivity.
- Account create UI exists inside the Accounts sub-tab.
- Exchange-specific credentials are shown/hidden based on selected exchange.
- Account form includes portfolio quote, trading quote, balance basis, leverage fields, margin rules, and validation logic.

Server connectivity:
- Console has a support workflow wrapper at `app/Support/Connectivity/AccountConnectivityWorkflow.php`.
- UI can start account server connectivity tests, poll status, show per-server result, and trigger user notification for failed server connectivity.
- Ingestion/core own the actual connectivity workflow and queue-side logic.

Positions:
- Added a first user positions panel and support reconciler:
  - `app/Support/Positions/UserPositionsReconciler.php`
  - `resources/views/components/users/positions/*`
- Browser coverage verifies the positions tab loads reconciliation/history content.

Shell and UI:
- Removed Turbo and moved SPA behavior to Livewire navigation.
- Sidebar is persisted with Livewire `@persist('app-aside')`.
- Content-only fade transitions are handled by `<x-page-transition>` and `$store.pageTransition`.
- Topbar remains mounted during page transitions while breadcrumbs update.
- Sidebar active item animation now slides/fades the green active background.
- Added reusable Blade components for lazy tabs, count badges, data display items, file fields, toast containers, account rows, account panels, and position panels.
- Added Kraite favicon wiring.

Testing:
- Added Playwright browser testing with isolated Laravel testing environment:
  - `.env.testing`
  - `playwright.config.js`
  - `scripts/prepare-e2e.sh`
  - `tests/e2e/*.spec.js`
- Browser tests rebuild and use `ingestion.kraite.test`'s `kraite_tests` database.
- Do not run browser tests against the normal local `kraite` database.

Documentation:
- Updated `README.md`, `CLAUDE.md`, and `CHANGELOG.md`.
- Console documentation now describes Livewire shell discipline, browser-test isolation, and the component layout.

## Verification Already Run

Console:
- `npm run build`
- `npm run test:e2e`
- Result: 4 Playwright tests passed.

Ingestion:
- `vendor/bin/pint database/seeders/BusinessSeeder.php tests/Feature/KraiteSeederTest.php --test`
- `php artisan test tests/Feature/KraiteSeederTest.php`
- Result: 2 feature tests passed.

Git:
- `git diff --check` was clean before commits.
- Console, ingestion, and core are clean and aligned with their remotes.

## Important Rules Going Forward

- Console does not own domain schema. Migrations belong in `ingestion.kraite.test` or `packages/kraitebot/core`.
- Console does not own seeders/factories. Test data comes from ingestion.
- Browser tests must use `APP_ENV=testing`, `http://127.0.0.1:8001`, and `kraite_tests`.
- Do not point Playwright at `https://console.kraite.test` for automated tests.
- Do not reintroduce Turbo.
- Keep the shell stable: sidebar and topbar should not remount for normal page navigation.
- Build new surfaces as Blade UI components plus Livewire page/workflow components.
- Keep copying Boltify structure/classes where there is an equivalent, but adapt behavior to Livewire/Alpine.

## Current Next Work

Likely next product work:
- Finish improving the Account create/edit UX after manual testing.
- Continue the Positions sub-tab by cloning the old `admin.kraite.test` user positions lifecycle exactly where needed.
- Build more reusable datagrid and expandable-row components as new operational surfaces arrive.
- Keep adding Playwright tests for every UI behavior Bruno can manually see in the browser.

Likely technical follow-up:
- If core changes again, push core first, then run `composer update kraitebot/core --no-interaction` in ingestion before pushing ingestion.
- Add docs to `~/Herd/docs/kraite/05-console/` when new component families become stable.
