# Implementation roadmap

The repository now contains executable foundations for all planned layers:

1. Foundation: users, RBAC, languages, dialects, regions, Sanctum.
2. Language data: sources, contributions, provenance versions, reviews, validation records.
3. Community trust: permission-gated review and publication transitions.
4. Learning: courses, lessons, activities, and user progress schema.
5. Audio: speakers, consent status, recordings, processing and review status schema.
6. AI: grounded-query API contract that returns explicit insufficient-evidence responses.
7. Public platform: versioned API, JSON language export endpoint, Docker services, and CI.

The remaining work is production hardening: PostgreSQL deployment, S3 media processing, OpenSearch adapter, background jobs, richer dictionary entities, frontend/mobile clients, and expert certification UI. These are intentionally separate from the core data integrity model.
