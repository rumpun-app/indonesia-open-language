# @iol/typescript-sdk

Small, dependency-free client for `/api/v1`. The package is AGPL-3.0-only like the main project.

```ts
const iol = new IndonesiaOpenLanguage({ baseUrl: 'https://example.org/api/v1', token });
const result = await iol.dictionary.search('mangan');
```

The client includes typed resource groups for languages, dictionary, contributions, reviews, sources, courses, learning progress, community, audio, moderation, analytics, tokens, exports, search, AI, reputation, and admin read APIs. It supports bearer tokens, JSON/FormData requests, retrying transient failures, and structured `ApiError` responses.
