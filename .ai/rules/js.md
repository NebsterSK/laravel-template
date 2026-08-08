---
paths:
  - 'resources/js/**'
---

# Js

## Type props with the generated ambient types

Use the generated `App.Data.{Module}.*` types for props. Never hand-write DTO interfaces.

## Add UI components with the ShadCN CLI

Add ShadCN Vue components with `npx shadcn-vue@latest add <component>`; check for an existing component before writing a new one.
For frontend bugs or precise styling, use the Chrome DevTools MCP to diagnose and verify.

## Forms disable themselves while processing

Wrap form contents in `<fieldset :disabled="processing">` and put `<Spinner v-if="processing" />` in the submit button.

## Pass Wayfinder route functions directly

Pass the route function to `:href` directly; do not call `.url()`.
The homepage route is named `index`, not `home`.

## Listing pages sync state to the URL

`router.get(url, query, { preserveState: true, preserveScroll: true, replace: true })`, toggling a `loading` ref in `onStart` / `onFinish`.
Debounce only the search input (300ms) — filters, sort, clear and pagination are instant.
Disable controls while loading except the search input, and dim the table body.

## Listing page controls

Order filter controls to match the table column order.
Build multiselect filters with `DropdownMenuCheckboxItem` + `@select.prevent`.
Always provide sortable headers, pagination, and a Clear-filters button that appears only when a filter or sort is active.
