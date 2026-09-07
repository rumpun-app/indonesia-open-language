import manifestSchema from '../language-package.schema.json' with { type: 'json' };

export const LANGUAGE_PACKAGE_SCHEMA_VERSION = '1.0';

export function validateManifest(manifest) {
  const required = manifestSchema.required.filter((key) => manifest?.[key] === undefined);
  const validSlug = typeof manifest?.slug === 'string' && /^[a-z0-9-]+$/.test(manifest.slug);
  const validVersion = manifest?.schema_version === LANGUAGE_PACKAGE_SCHEMA_VERSION;
  return { valid: required.length === 0 && validSlug && validVersion, errors: [...required.map((key) => `Missing ${key}`), ...(validSlug ? [] : ['Invalid slug']), ...(validVersion ? [] : ['Unsupported schema_version'])] };
}

export { manifestSchema };
