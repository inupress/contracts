<?php

declare(strict_types=1);

namespace Inupress\Contracts;

/**
 * Immutable description of an installed plugin. Built by the core from the plugin's composer.json.
 * Composer is the only source of truth: installed means active, `composer remove` means gone.
 */
final readonly class PluginManifest
{
    public function __construct(
        public string $id,
        public string $name,
        public string $version,
        public string $path,
    ) {}
}
