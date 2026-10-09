<?php

declare(strict_types=1);

namespace Inupress\Contracts;

use InvalidArgumentException;

/**
 * Immutable description of a plugin, built from the `extra.inupress` block of its composer.json.
 */
final readonly class PluginManifest
{
    /**
     * @param  array<string, string>  $requires  id => semver constraint, "core" means the Inupress core
     * @param  list<string>  $provides  capability names, e.g. "seo.meta"
     */
    public function __construct(
        public string $id,
        public string $name,
        public string $version,
        public string $provider,
        public array $requires = [],
        public array $provides = [],
    ) {}

    /**
     * @param  array<string, mixed>  $extra  the full `extra` section of the package
     */
    public static function fromComposer(string $package, string $version, array $extra): self
    {
        $meta = $extra['inupress'] ?? null;

        if (! is_array($meta)) {
            throw new InvalidArgumentException("Package [$package] has no extra.inupress section.");
        }

        $id = $meta['id'] ?? null;
        $provider = $meta['provider'] ?? null;

        if (! is_string($id) || $id === '' || ! is_string($provider) || $provider === '') {
            throw new InvalidArgumentException("Package [$package]: extra.inupress.id and extra.inupress.provider are required.");
        }

        $requires = is_array($meta['requires'] ?? null) ? $meta['requires'] : [];
        $provides = is_array($meta['provides'] ?? null) ? $meta['provides'] : [];

        return new self(
            id: $id,
            name: is_string($meta['name'] ?? null) ? $meta['name'] : $package,
            version: $version,
            provider: $provider,
            requires: array_map(strval(...), $requires),
            provides: array_values(array_map(strval(...), $provides)),
        );
    }
}
