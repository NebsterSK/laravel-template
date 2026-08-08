---
paths:
  - 'app/Http/Controllers/**'
---

# Controllers

## Validate every request with a Data object

Type-hint a `spatie/laravel-data` Data object on every action that takes input, including `index()` query params (e.g. `store(PostData $data)`). laravel-data validates before the method body runs and a failed validation redirects back with errors that Inertia picks up. Never create FormRequests.

## Return Data objects from Inertia::render

Build output from models with `SomeData::from($model)` / `SomeData::collect(...)` and return those from `Inertia::render`. `store`/`update`/`destroy` `return back()`.

## Build index queries with laravel-query-builder

Query with `spatie/laravel-query-builder`: `allowedFilters(...)`, `allowedSorts(...)`, `defaultSort(...)`, `->paginate(20)`.
Pass spread arguments to `allowedFilters()` / `allowedSorts()`, never an array.
Search → `AllowedFilter::partial`. Filters → `AllowedFilter::exact` (comma-separated input becomes a `whereIn`).
Sort a related column with `AllowedSort::callback()` + a correlated subquery, not a join.

## Index responses carry meta, options and current state

Return `SomeData::collect($paginator->getCollection())` plus a `meta` array, the filter options, and the current `filters` / `sort`.

## Wrap writes in try/catch

Wrap `store`/`update`/`destroy` bodies in `try/catch (Throwable)`.
Log `exception_message`, `exception_file`, `exception_line`, plus `user_id` when authenticated.
On catch, redirect back with an `error` flash message.
