---
paths:
  - 'database/migrations/**'
  - 'database/seeders/**'
---

# Migrations

## Never reference app classes

Do not reference enums, models, or other app classes in migrations — they change or disappear while old migrations must still run.

## Seed with the query builder

Hardcode seeded values and write them with `DB::table(...)`, not Eloquent models.
