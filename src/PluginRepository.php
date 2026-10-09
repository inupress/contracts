<?php

declare(strict_types=1);

namespace Inupress\Contracts;

/**
 * Read-only view of the installed Inupress plugins.
 */
interface PluginRepository
{
    /**
     * @return array<string, PluginManifest> keyed by plugin id (the composer package name)
     */
    public function all(): array;

    public function has(string $id): bool;

    public function get(string $id): ?PluginManifest;
}
