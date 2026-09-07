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
GET  /courses/{course}
GET  /me/progress                 authenticated
POST /me/progress                 authenticated
POST /analytics/events
GET  /me/reputation               authenticated
GET  /search?q={term}
GET  /languages/{language}/statistics
GET  /languages/{language}/scripts
GET  /languages/{language}/grammar
GET  /scripts/{script}
GET  /moderation/reports          moderation.manage permission
POST /moderation/reports/{id}/resolve
GET  /admin/statistics            moderation.manage permission
GET  /admin/audit-logs            moderation.manage permission
```

Collection endpoints use Laravel pagination. Write endpoints validate input through Form Requests and use Sanctum authentication where indicated.
