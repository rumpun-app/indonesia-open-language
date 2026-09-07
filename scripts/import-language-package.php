<?php

if ($argc < 2) { fwrite(STDERR, "Usage: php scripts/import-language-package.php path/to/manifest.json\n"); exit(1); }
$manifest = json_decode(file_get_contents($argv[1]), true, flags: JSON_THROW_ON_ERROR);
foreach (['schema_version','slug','name','native_name','license'] as $required) {
    if (!array_key_exists($required, $manifest)) { fwrite(STDERR, "Missing required field: {$required}\n"); exit(1); }
}
if (($manifest['schema_version'] ?? null) !== '1.0' || !preg_match('/^[a-z0-9-]+$/', $manifest['slug'])) { fwrite(STDERR, "Invalid language package manifest\n"); exit(1); }
fwrite(STDOUT, "Valid language package: {$manifest['slug']} ({$manifest['name']})\n");
