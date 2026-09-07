# Indonesia Open Language

Licensed under the GNU Affero General Public License v3.0-only. See [LICENSE](LICENSE).

Any distributed modified version, including software offered to users over a network, must provide the corresponding source code under the same license. Contributions and hosted deployments must preserve this freedom; no proprietary closed derivative is permitted.

Open-source language infrastructure for documenting, validating, learning, and safely reusing Indonesian regional languages.

## Current status

Phase 1 foundation is in progress. The Laravel API currently includes:

- Laravel 13 backend with Sanctum API authentication
- ULID-based Language, Dialect, and Region models
- Published language listing and language detail endpoints
- Authenticated language and dialect creation endpoints
- PostgreSQL-ready migrations (SQLite is used by default for local tests)
- Feature tests for public reads and authenticated writes

## Backend development

```text
cd backend
composer install
php artisan migrate
php artisan test
php artisan serve
```

API base URL: `/api/v1`.

The backend is the source of truth for domain logic. Frontend, mobile, language packages, and data tooling will be added incrementally.
