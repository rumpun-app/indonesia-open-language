# @iol/typescript-sdk

Small, dependency-free client for `/api/v1`. The package is AGPL-3.0-only like the main project.

```ts
const iol = new IndonesiaOpenLanguage({ baseUrl: 'https://example.org/api/v1', token });
const result = await iol.dictionary.search('mangan');
```
