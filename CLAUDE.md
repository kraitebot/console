# Kraite Console — Project Instructions

This file extends `~/.claude-personal/CLAUDE.md`. Repo-specific rules below take precedence over global rules where they conflict.

## What this project is

**`console.kraite.test`** is Kraite's admin console. Bruno is porting the Boltify React/TypeScript admin template (at `/Users/falcaob/Herd/boltify.test`) into **Laravel 13 + Blade + Livewire + Alpine.js 3 + Tailwind 4**. The port lives at this repo; deployed target is `console.kraite.com` (production).

The Inertia/React SPA design described in earlier `Herd/docs/kraite/05-console/` docs is **dead**. Turbo is also removed. Current stack is Blade + Livewire + Alpine. Trust the code, not stale docs.

## Data ownership — hard rule

**Console has NO database of its own and NO factories.** All domain data (users, accounts, positions, exchanges, symbols, anything) is owned by **`ingestion.kraite.test`** locally and by zeus in production. Console is a thin Blade/Livewire/Alpine UI that reads (and writes through ingestion-owned models) the same MySQL database (`DB_DATABASE=kraite`).

What this means in practice:
- **Do NOT create migrations in this repo.** The three skeleton migrations (`create_users_table`, `create_cache_table`, `create_jobs_table`) are vestigial — they will be removed. Schema changes belong in `~/Herd/ingestion.kraite.test/database/migrations/`.
- **Do NOT create model factories or seeders here.** Test data comes from ingestion's seeders. The console-local `UserFactory` is vestigial.
- **Do NOT create local models that shadow ingestion's domain.** When a domain model (e.g. `User`, `Account`, `Position`) is needed, source it from the ingestion-owned package (currently `kraitebot/core` in ingestion's vendor tree) once console pulls it in via composer. Until then, ask Bruno before adding any model.
- Console's `.env` must point `DB_*` at the same `kraite` database ingestion uses. If it doesn't, login is broken and any "Users" read returns empty.
- Auth tables (`users`, `sessions`, `password_reset_tokens`) are owned by ingestion and shared with console — console never migrates them.

If a feature seems to need a console-local table, **stop and ask Bruno**. The only documented exception (legacy doc) is the Lifecycle scenario configurator, and even that is on hold.

## First-pass UI policy

When Bruno asks for a **new UI feature** (page, datagrid, detail view, form, etc.), **ship a first pass without question-gating**. The flow is:

1. Read Boltify reference end-to-end (the "no vibe coding" rule still applies — it's about reading, not asking).
2. Make every implementation decision yourself: column shape, copy, placeholder text, route names, stub content, where the "New X" button goes, what the detail page shows.
3. Use sensible Kraite-shape defaults: Livewire page components, server-paginated tables, search by `name|email`, sortable headers, breadcrumb in the header-left section, page actions in the subheader right slot.
4. Build it, `npm run build`, report what shipped.
5. Bruno iterates by saying "change X" — refinement comes after the first pass exists, not before.

**Only ask** when the question is **strictly necessary**, meaning the answer changes the data model, the URL scheme, or whether the feature should even exist. Examples:

| Worth asking | NOT worth asking |
|---|---|
| "Real users from ingestion or seeded fakes?" (data source) | "What columns should the table have?" — pick Kraite-shape defaults |
| "Should `/users/{user}` exist as a route?" (URL scheme) | "What should the detail page look like?" — ship a first pass |
| "Is this a console-owned table or ingestion-owned?" (data ownership) | "Should the Edit button be a pencil icon?" — yes, match Boltify |
| "Mid tier or full tier (column visibility + bulk select)?" (feature scope) | "Should pageSize default to 10 or 20?" — pick 10, Boltify default |

Bias toward shipping. A "wrong" first pass that Bruno corrects in one turn is faster than a Q&A pre-amble that delays the first paint.

## The Boltify rule — non-negotiable

**You do NOT invent UI. You port from Boltify.**

- Bruno paid for Boltify. Every visual decision (spacing, colors, layout, animation, component behavior) is already made.
- Before building any UI, locate the equivalent in Boltify and cite `file:line`. If the equivalent does not exist, ask Bruno before inventing.
- The Boltify source map lives in memory (`reference_boltify_source.md`). Re-read it when unsure where things are.
- The memory `feedback_no_vibe_coding.md` is binding: read Boltify source end-to-end + inventory before any UI port. Partial reads have already cost two slips.

When porting:
- Cite the Boltify source path AND a class/function anchor (e.g. `boltify.test/src/components/ui/Card.tsx::Card`) in commit messages AND in the component's inventory doc.
- Translate React idioms to Blade + Livewire + Alpine equivalents (see the conventions doc), but preserve every Tailwind class and structural decision unless Bruno explicitly authorizes a change.
- Heavy React deps (framer-motion → Alpine `x-collapse`, @floating-ui/react → vanilla Floating UI, @tanstack/react-table → server-rendered Laravel tables, react-toastify → Alpine toast, etc.) get re-platformed, not deleted.

## Livewire shell discipline

- Full-page surfaces live in `app/Livewire/*` and render through `#[Layout('layouts.admin')]`.
- Livewire page views live in `resources/views/livewire/<area>/...` and should start with a root element carrying `data-component-name`.
- The app shell is `layouts/app.blade.php` + `layouts/admin.blade.php`. Keep the shell stable: sidebar and topbar are outside the content transition.
- Sidebar navigation uses `$store.pageTransition.navigate($event, url)` and then `Livewire.navigate()`. Do not put `wire:navigate` back on `<x-nav.item>` links unless the transition store is changed accordingly.
- The sidebar is persisted with `@persist('app-aside')` inside `<div data-component-name="AsidePersist" class="peer contents">`. The `peer contents` wrapper is required because Livewire inserts an `x-persist` wrapper; without the outer peer boundary, `<x-wrapper>` loses its aside padding.
- `<x-page-transition>` wraps subheader + content only. The topbar/header stays mounted and visible during page changes, while page-specific breadcrumb content updates via Livewire sections.
- Turbo is gone. Do not add `@hotwired/turbo`, `data-turbo-*`, or Turbo frames.

## UI build discipline

### Components live in `resources/views/components/`

- Folder-nested naming: `<x-card.header>`, `<x-form.input>`, `<x-nav.collapse>`. Sub-components live in subfolders, never flat (`<x-card-header>` is wrong).
- Every component gets a `data-component-name="..."` attribute on its root element — matches Boltify's pattern and lets us inspect tree in DevTools.
- Props use kebab-case in markup (`first-icon`, `is-active`), camelCase in the `@props` declaration.
- Dynamic Tailwind classes MUST be literal strings — `match()` over a typed prop, never `'text-' . $color . '-500'`. Tailwind 4's scanner purges anything it can't see literally. The `match()` pattern at `resources/views/components/icon.blade.php:3-15` is the reference.

### Component inventory at `Herd/docs/kraite/05-console/components/`

- **One MD file per parent component**, parent-merged (e.g. `card.md` covers `x-card` + all `<x-card.header>` / `<x-card.body>` / etc. sub-slots).
- Atom components (button, badge, icon, breadcrumb, container, wrapper) get standalone files.
- Each file MUST include: Kraite path, **Boltify source path + class/function anchor**, status (ported / pending), props table, slot description, usage example, notes.
- `components/README.md` is the index — one table per category (Layout / Display / Action / Form) + a "Pending" section listing components needed but not yet ported.

### Adding a new component

1. Read the Boltify equivalent end-to-end. Note the file path + line of the React component, plus class/function name (e.g. `Modal.tsx::Modal`).
2. Translate to Blade + Livewire + Alpine as appropriate. Preserve every Tailwind class.
3. Add `data-component-name="..."` to root element.
4. Add `match()` for any color/variant prop that hits Tailwind (never string concat).
5. Add the component to `Herd/docs/kraite/05-console/components/<parent>.md` with Boltify ref.
6. Mention "Pending" entries — when a component is queued but not yet ported, the inventory's "Pending" table tracks it with the Boltify source + which feature it's needed for.

### Theme tokens

- All theme tokens live in `resources/css/app.css`. Primary palette (green) at lines 18-28 mirrors Boltify exactly.
- Root font-size is `15px` (`resources/css/app.css`) — Bruno asked to uptick the whole UI from the original Boltify base. Every `rem` unit scales off this. Don't override casually.
- Urbanist font imported via Google Fonts at top of `app.css`. Don't add other web fonts.

### Alpine stores

Single source of truth for client-side state. Defined in `resources/js/app.js`.

- `$store.aside` — `status` (open/closed), `activeTab` (dashboard/apps/documentation/examples). localStorage keys: `aside_status`, `bolt_activeTab`.
- `$store.pageTransition` — content fade state and sidebar-link navigation. Calls `Livewire.navigate()` after the fade-out delay.
- `$store.toast` — floating notification queue. Livewire components dispatch `toast` browser events with `message` and `type`; `<x-toast-container>` listens globally.
- `$store.theme` — `mode` (light/dark/system), `cycle()` method. localStorage key: `theme`.

When adding new client-side state, prefer extending a store over inventing new x-data scopes.

### Animation

- Collapse / expand: Alpine `x-collapse` plugin (already installed). See `resources/views/components/nav/collapse.blade.php` for canonical usage.
- Hide / show transitions: prefer `:class` driven opacity/translate-x with `transition-all duration-300 ease-in-out` over `x-show` pop (Boltify uses framer-motion; we don't have it — Tailwind transitions are the substitute). Example: `resources/views/partials/aside-header.blade.php` shows the logo slide-out pattern.

## Backend discipline

Standard Laravel 13 conventions per global CLAUDE.md (`~/.claude/rules/laravel.md`). Highlights specific to this repo:

- Routes: file-based for now (`routes/web.php`). Full-page UI routes should usually point to Livewire page components.
- Business logic is still thin. Keep page behavior close to Livewire components until a shared domain/service boundary is needed.
- Database points at the shared `kraite` database. This repo should not add migrations/factories.

## Build & dev

- `npm run dev` — Vite dev server (HMR)
- `npm run build` — production build (writes `public/build/`)
- `npm run test:e2e` — Playwright browser tests. This boots console with
  `APP_ENV=testing` on `http://127.0.0.1:8001`; `scripts/prepare-e2e.sh`
  first rebuilds `ingestion.kraite.test`'s `kraite_tests` database. Do not run
  automated browser tests against `https://console.kraite.test` / `kraite`.
- After any Blade / CSS / JS change → `npm run build`. Don't wait to be reminded.
- Compiled assets are served via `@vite([...])` in `resources/views/layouts/app.blade.php`. Don't reference raw asset paths.

## Browser testing

- Add Playwright tests for user-visible behavior: shell navigation, layout stability, Livewire async flows, datagrid interactions, and forms.
- Browser tests must use deterministic rows from the testing seed. Avoid
  hardcoded IDs from the normal local database; after a test seed, the admin
  login is `admin@kraite.test` / `password`, and Karine is `/users/2`.
- Existing coverage lives in `tests/e2e/users.spec.js` and verifies login, CRUDs sidebar navigation, Users → Accounts → Users, content fade, header stability, breadcrumb update, and sidebar persistence.
- Prefer browser assertions for issues Bruno can see in Safari/Chrome screenshots. Feature tests are still useful for backend behavior, but they do not catch shell morphing or layout regressions.

## Icons

- ~68 HugeIcons SVGs at `resources/views/icons/<Name>.blade.php`, extracted from Boltify by `scripts/extract-icons.sh`.
- Use via `<x-icon name="UserMultiple" color="primary" size="text-2xl" />`. Color prop uses `match()` map.
- To add more icons: append to the `ICONS=()` array in `scripts/extract-icons.sh`, run the script. Don't hand-author SVG markup.
- Kraite brand logos at `public/brand/` (`snake-green.svg`, `snake-white.svg`, `wordmark-horizontal.svg`) — sourced from `admin.kraite.test/public/logos/`.

## What to do before building Dashboard / Users CRUD

Per Bruno's instructions in the brainstorming session:

1. **Doc prep first.** Keep `Herd/docs/kraite/05-console/` aligned with the current Blade + Livewire + Alpine implementation.
2. **Brainstorm before building.** When Bruno wants Dashboard, he describes what he wants — I propose which Boltify components fit (cite refs), which need porting, then we build. Same for Users CRUD.
3. **Port on demand.** Don't port Boltify components we won't use. The "Pending" inventory table tracks queued ports per feature.
4. **No charts yet.** ApexCharts is a heavy dep. Defer until Bruno explicitly asks for charts.

## What NOT to do

- Don't refactor Blade components to use `@apply` for shared classes unless Bruno asks. The duplication is intentional — components match Boltify 1:1 and `@apply` makes that harder to verify.
- Don't introduce new design tokens (extra color palettes, custom shadows, spacing scales) without Bruno's nod. Boltify's palette is the design system.
- Don't add new npm deps without asking. Current deps (`alpinejs`, `@alpinejs/collapse`, `tailwindcss`, `@tailwindcss/vite`, `vite`, `laravel-vite-plugin`, `concurrently`) are the floor. Heavy adds like ApexCharts, Floating UI, SortableJS, etc., are case-by-case.
- Don't create `CHANGELOG.md` unsolicited.
- Don't run `/push` without Bruno explicitly saying so.

## Reference paths

- Boltify source: `/Users/falcaob/Herd/boltify.test`
- Boltify source map (memory): `~/.claude-personal/projects/-Users-falcaob-Herd-console-kraite-test/memory/reference_boltify_source.md`
- Project memory: same dir, `project_kraite_console_goal.md`
- Console docs: `/Users/falcaob/Herd/docs/kraite/05-console/`
- Components inventory: `/Users/falcaob/Herd/docs/kraite/05-console/components/`
- Sibling Kraite repos: `admin.kraite.test` (kraitebot/admin), `ingestion.kraite.test` (kraitebot/ingestion), `kraite.test` (brunocfalcao/kraite — marketing)
- This repo's remote: `github.com/kraitebot/console` (public)
