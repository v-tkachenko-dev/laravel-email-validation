# laravel-email-validation — Project Rules

## Testing

- **Never use real registered domains as test fixtures.** In particular, do **not** use `telepac` / `telepac.pt` (a real ISP) anywhere under `tests/`. Use reserved placeholder domains — `example.com`, `example.org`, `example.net` (RFC 2606) — for subdomain/parsing fixtures instead.
- Tests are **pure PHPUnit** (no Laravel boot / no Testbench) and cover **only the code a change modifies**. Full-corpus behavior is verified with the external lev-harness differential, not additional in-repo tests.
