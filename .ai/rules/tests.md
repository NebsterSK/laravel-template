---
paths:
  - 'tests/**'
---

# Tests

## Three access tests for anything behind auth

For a feature or page behind auth, write all three: an unauthenticated user can't access it, an authenticated-but-unauthorized user can't access it, and an authorized user can.

## Run only what changed

Run only the tests covering the changed code (`--filter=`), once, as the final step. Never run the whole suite.
