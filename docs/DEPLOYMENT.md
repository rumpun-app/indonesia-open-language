# Production deployment

Required services are PostgreSQL, Redis, and S3-compatible object storage. Configure them only through environment variables; never commit credentials.

Run the backend with queue workers and the scheduler:

```text
php artisan migrate --force
php artisan queue:work --tries=3
php artisan schedule:work
```

The AI provider, S3 disk, and optional search adapter are intentionally dependency-injected. Deployments can bind concrete adapters without changing public API contracts. The default AI binding is fail-closed and returns `insufficient_evidence` or `provider_not_configured` rather than inventing language data.
