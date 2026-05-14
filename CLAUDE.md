# Kraite Console — Project Instructions

This file extends `~/.claude-personal/CLAUDE.md`. Repo-specific rules below take precedence over global rules where they conflict.

## What this project is

**`console.kraite.test`** is Kraite's admin console. Bruno is porting the Boltify React/TypeScript admin template (at `/Users/falcaob/Herd/boltify.test`) into **Laravel 13 + Blade + Alpine.js 3 + Tailwind 4**. The port lives at this repo; deployed target is `console.kraite.com` (production).

The Inertia/React SPA design described in earlier `Herd/docs/kraite/05-console/` docs is **dead**. Current stack is Blade + Alpine. Trust the code, not the old docs (which are being rewritten alongside this CLAUDE.md).

## The Boltify rule — non-negotiable

**You do NOT invent UI. You port from Boltify.**

- Bruno paid for Boltify. Every visual decision (spacing, colors, layout, animation, component behavior) is already made.
- Before building any UI, locate the equivalent in Boltify and cite `file:line`. If the equivalent does not exist, ask Bruno before inventing.
- The Boltify source map lives in memory (`reference_boltify_source.md`). Re-read it when unsure where things are.
- The memory `feedback_no_vibe_coding.md` is binding: read Boltify source end-to-end + inventory before any UI port. Partial reads have already cost two slips.

When porting:
- Cite the Boltify source path AND a class/function anchor (e.g. `boltify.test/src/components/ui/Card.tsx::Card`) in commit messages AND in the component's inventory doc.
- Translate React idioms to Blade + Alpine equivalents (see the conventions doc), but preserve every Tailwind class and structural decision unless Bruno explicitly authorizes a change.
- Heavy React deps (framer-motion → Alpine `x-collapse`, @floating-ui/react → vanilla Floating UI, @tanstack/react-table → server-rendered Laravel tables, react-toastify → Alpine toast, etc.) get re-platformed, not deleted.

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
2. Translate to Blade + Alpine. Preserve every Tailwind class.
3. Add `data-component-name="..."` to root element.
4. Add `match()` for any color/variant prop that hits Tailwind (never string concat).
5. Add the component to `Herd/docs/kraite/05-console/components/<parent>.md` with Boltify ref.
6. Mention "Pending" entries — when a component is queued but not yet ported, the inventory's "Pending" table tracks it with the Boltify source + which feature it's needed for.

### Theme tokens

- All theme tokens live in `resources/css/app.css`. Primary palette (green) at lines 18-28 mirrors Boltify exactly.
- Root font-size is `13px` (`resources/css/app.css:33`) — matches Boltify's `themeConfig.fontSize: 13`. Every `rem` unit scales off this. Don't override.
- Urbanist font imported via Google Fonts at top of `app.css`. Don't add other web fonts.

### Alpine stores

Single source of truth for client-side state. Defined in `resources/js/app.js`.

- `$store.aside` — `status` (open/closed), `activeTab` (dashboard/apps/documentation/examples). localStorage keys: `aside_status`, `bolt_activeTab`.
- `$store.theme` — `mode` (light/dark/system), `cycle()` method. localStorage key: `theme`.

When adding new client-side state, prefer extending a store over inventing new x-data scopes.

### Animation

- Collapse / expand: Alpine `x-collapse` plugin (already installed). See `resources/views/components/nav/collapse.blade.php` for canonical usage.
- Hide / show transitions: prefer `:class` driven opacity/translate-x with `transition-all duration-300 ease-in-out` over `x-show` pop (Boltify uses framer-motion; we don't have it — Tailwind transitions are the substitute). Example: `resources/views/partials/aside-header.blade.php` shows the logo slide-out pattern.

## Backend discipline

Standard Laravel 13 conventions per global CLAUDE.md (`~/.claude/rules/laravel.md`). Highlights specific to this repo:

- Routes: file-based for now (`routes/web.php`). When adding real controllers, follow conventions doc.
- No business logic exists yet. UI scaffolding only until Bruno greenlights real features (Dashboard + Users CRUD are next).
- Database is SQLite default; migrations untouched from skeleton.

## Build & dev

- `npm run dev` — Vite dev server (HMR)
- `npm run build` — production build (writes `public/build/`)
- After any Blade / CSS / JS change → `npm run build`. Don't wait to be reminded.
- Compiled assets are served via `@vite([...])` in `resources/views/layouts/app.blade.php`. Don't reference raw asset paths.

## Icons

- ~68 HugeIcons SVGs at `resources/views/icons/<Name>.blade.php`, extracted from Boltify by `scripts/extract-icons.sh`.
- Use via `<x-icon name="UserMultiple" color="primary" size="text-2xl" />`. Color prop uses `match()` map.
- To add more icons: append to the `ICONS=()` array in `scripts/extract-icons.sh`, run the script. Don't hand-author SVG markup.
- Kraite brand logos at `public/brand/` (`snake-green.svg`, `snake-white.svg`, `wordmark-horizontal.svg`) — sourced from `admin.kraite.test/public/logos/`.

## What to do before building Dashboard / Users CRUD

Per Bruno's instructions in the brainstorming session:

1. **Doc prep first.** Rewrite the dead Inertia-era docs at `Herd/docs/kraite/05-console/`. Seed the components inventory with the existing 33 ported Blade components.
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
