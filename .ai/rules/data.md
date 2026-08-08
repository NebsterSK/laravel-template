---
paths:
  - 'app/Data/**'
---

# Data

## One Data object per payload

Create one `spatie/laravel-data` `Data` object per payload in `app/Data/{Module}` and annotate it with `#[TypeScript]`.
Data objects serve **both** roles: validating incoming requests and typing output to the frontend. Do not create FormRequests and do not hand-map arrays.

## Define rules in a static rules() method

Define validation in a static `rules(ValidationContext $context): array` method using Laravel's array syntax (it mirrors a FormRequest's `rules()`).
Use validation attributes (`#[Required]`, `#[Max(255)]`, …) only for trivial single-rule fields.
Authorize in a static `authorize(): bool`; put custom messages and attribute names in static `messages()` / `attributes()`.

## Never use from() for a write payload

`SomeData::from($request)` skips validation. Type-hint the object in the controller action (laravel-data resolves and validates it before the method body runs) or call `SomeData::validateAndCreate($request)`.

## Query-param Data objects for index actions

Validate `index()` query params with their own Data object: `filter.*`, `sort` via `Rule::in([...])`, and `page` as `integer|min:1`. Model a nested `filter` as a nested Data object.

## Regenerate TypeScript after every change

Run `php artisan typescript:transform` after adding or changing a Data object.
The transformer is `AttributedClassTransformer` + `->replaceType(\Illuminate\Support\Carbon::class, 'string')` — do not use laravel-data's `DataTypeScriptTransformer`.
