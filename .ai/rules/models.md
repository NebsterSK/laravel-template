---
paths:
  - 'app/Models/**'
---

# Models

## Models are strict and declare fillable attributes
Eloquent runs with `Model::shouldBeStrict()` outside production (no `Model::unguard()`): lazy loading, reading unselected/misspelled attributes, and mass assigning non-fillable attributes all throw. Every model declares its mass-assignable columns with `#[Fillable([...])]` (enforced by the arch test). Eager load relations with `with()` / `load()`. In production, lazy loading is logged as a warning instead of thrown.
