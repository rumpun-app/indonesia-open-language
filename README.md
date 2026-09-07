# Indonesia Open Language

Licensed under the GNU Affero General Public License v3.0-only. See [LICENSE](LICENSE).

Any distributed modified version, including software offered to users over a network, must provide the corresponding source code under the same license. Contributions and hosted deployments must preserve this freedom; no proprietary closed derivative is permitted.

Open-source language infrastructure for documenting, validating, learning, and safely reusing Indonesian regional languages.

## Current status

The repository contains the executable backend foundation for Phases 1–7: language data, provenance, community validation, learning, audio consent/processing, grounded-AI contracts, public API access, exports, SDKs, and language package schemas.

Implemented capabilities include:

- Laravel 13 API with Sanctum, RBAC, rate limiting, audit logs, PostgreSQL/Redis/S3-ready configuration
- Normalized dictionary: lexical entries, word forms, senses, phrases, examples, scripts, and grammar
- Contributions, reviews, publication workflow, immutable versions, sources, and provenance
- Community discussions, reports, moderation, reputation, and internal analytics
- Courses, lessons, progress, XP, and streaks
- Consent-aware audio upload with queue processing states
- Grounded AI provider contract that fails closed when evidence/provider is unavailable
- OpenAPI 3.1 specification, JSON/JSONL/CSV exports, scoped API tokens
- TypeScript SDK and versioned language-package schema

The production adapters for a concrete AI provider, S3 deployment, OpenSearch, and native mobile UI are configured separately and never require committing secrets.

## Backend development

```text
cd backend
composer install
php artisan migrate
php artisan test
php artisan serve
```

API base URL: `/api/v1`.

## TypeScript SDK

```text
cd packages/typescript-sdk
npm test
```

```ts
import { IndonesiaOpenLanguage } from '@iol/typescript-sdk';

const iol = new IndonesiaOpenLanguage({
  baseUrl: 'https://your-host.example/api/v1',
  token: process.env.IOL_API_TOKEN,
});

const results = await iol.dictionary.search('mangan', { language_id: 'jv' });
```

The SDK covers languages, dictionary, contributions, reviews, sources, courses, progress, community, audio, moderation, analytics, tokens, exports, search, AI, reputation, and admin read APIs.

See [docs/API.md](docs/API.md), [docs/openapi.yaml](docs/openapi.yaml), and [docs/DEPLOYMENT.md](docs/DEPLOYMENT.md).

The backend is the source of truth for domain logic. Frontend, mobile, language packages, and data tooling will be added incrementally.
