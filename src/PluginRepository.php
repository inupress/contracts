<?php

declare(strict_types=1);

namespace Inupress\Contracts;

/**
 * Read-only view of the plugins that are currently enabled.
 */
interface PluginRepository
{
    /**
     * @return array<string, PluginManifest> keyed by plugin id, in load order
     */
    public function enabled(): array;

    public function has(string $id): bool;

    public function get(string $id): ?PluginManifest;
}
