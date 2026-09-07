# API v1

The public API is rooted at `/api/v1`.

Current endpoints:

```text
GET  /languages
GET  /languages/{language}
GET  /languages/{language}/dialects
GET  /dictionary?q={term}&language_id={id}
GET  /dictionary/{lexicalEntry}
POST /dictionary                 contribution.create permission
POST /languages                 authenticated
POST /dialects                  authenticated
GET  /contributions
GET  /contributions/{contribution}
POST /contributions/{contribution}/publish  entry.publish permission
POST /contributions              contribution.create permission
POST /contributions/{id}/submit  contribution.submit permission
GET  /sources
POST /sources                    contribution.create permission
GET  /audio
POST /audio                      audio.upload permission; requires speaker consent
```

Collection endpoints use Laravel pagination. Write endpoints validate input through Form Requests and use Sanctum authentication where indicated.
